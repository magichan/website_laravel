<?php

namespace App\Http\Controllers\User;
use Auth;
use Input;
use App\SocialConnect;
use App\User;
use App\InfoInitLog;
use App\Service\SocialUrlConnect;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
  private $optional_choices = ['position','gender','company','tel','address']; 
  /* 为信息初始化的步骤二 : 选择不被一般成员查询的私人信息 作的安全防备
   * 只有在该数组的中的选择才会被通过，否则就会报错
   * */

  private $host ;
  /* 成员照片 url 的 host 部分  http://.....com/...
   * 来自 .env 配置文件
   * */


  public function init(Request $request, $step = null)
  {
    if(is_null($step))
    {
      return "访问非法网址:".Rquest::url();
    }

    $user = Auth::user();
    $log = $user->InfoInitLog;
    if(is_null($log))
    {
      $log = InfoInitLog::create(['user_id'=>$user->id]);
    }

    if($this->checkStep($step,$log))// 查看请求的 step 和 记录的是否匹配
    {  // 匹配直接返回 对应的页面
      switch($step)
      {
      case 'one':
        return view('user.init.one')->withuser($user);
        break;
      case 'two':
        
        return view('user.init.two')->withUser($user);
        break;
      case 'three':
        return view('user.init.three')->withvar($user);
        break;
      case 'four':
        $socialurl = new SocialUrlConnect(); // 读取配置文件，获取已存在社交属性
        return view('user.init.four')->withSocialUrlConnects($socialurl->allConnects());
        break;
      case 'finish':
        return view('user.init.finish');
      default:
        return "log 内部错误";
      }
    }else{

     return  redirect('user/init/'.$this->logtourl($log->step)); // 服从 数据库记录，将页面重定向。
    }

  } 

  public function  getInit(Request $request ,$step = null )
  {// 获取 init 过程中的数据输入 

   switch($step)
      {
      case 'one':
       
       $request->merge(array_map('trim',$request->all())); // 去掉输入的左右空白符

       $this->validate($request,[
      'real_name'=>'required',
      'name'=>'required',
      'gender'=>'required|in:female,male',
      'tel'=>'size:11',
      'admission_year'=>'required',
      'status'=>'required|in:student,graduate'
       ]); // 检验输入

      return   $this->getOneInit($request);

      case 'two':

        if(!$this->checkInthePrivateChoice($request->input('private_choice')) ) 
        { // 检查输入是否在 private_choice 之中
          return redirect('error');
        }

        return $this->getTwoInit($request);

      case 'three':
        $user = Auth::user();
        $infoInitLog = $user->InfoInitLog;
        $infoInitLog->step = 4;
        $infoInitLog->save();

        return  redirect('user/init/'.$this->logtourl($infoInitLog->step)); // 服从 数据库记录，将页面重定向。

      case 'four':
        
       return $this->getFourInit($request);


      default:

        return "log 内部错误".$step;
      }

  }
 
  private function changeUserInitLogStep($infoInitLog,$step)
  {
        $infoInitLog->step = $step ;
        $infoInitLog->save();
  }
  private function getOneInit($request)
  {
    $user = Auth::user();


    $new_data = $request->all();
    array_splice($new_data,0,1); // 删除 laravel 框架 自带的 token 值 ，注意这里默认 token 值 放在数组的第一位 

    $user->update($new_data);//  利用数组赋值，速度快但不太安全。

    $infoInitLog = $user->InfoInitLog;
    $this->changeUserInitLogStep($infoInitLog,2);
  

    return  redirect('user/init/'.$this->logtourl($infoInitLog->step)); // 服从 数据库记录，将页面重定向。
  }

  private function getTwoInit($request)
  {
        $user = Auth::user();
        $this->clearUserPrivateChoice($user);
        // 将当前用户的 私有信息 的设置 设置成全部可访问状态

        if(empty($request->input('private_choice')))
        { // 未被定义，说明所有的都是可以看的

        }else{
          foreach($request->input('private_choice') as $choice )
          {
            $choice = $choice."_authority"; // 利用变量命名规范: 描述访问权限的变量名直接在变量名后面 + _authority 
              $user->update([$choice=>0]) ;
          }
        }

        $infoInitLog = $user->InfoInitLog;
        $this->changeUserInitLogStep($infoInitLog,3);

        return  redirect('user/init/'.$this->logtourl($infoInitLog->step)); // 服从 数据库记录，将页面重定向。
  }

 /* 输入 json 
   *"sourceLink":图片的 URl,
   "a_x": ,
   "a_y": ,
   "e_width": ,
   "e_height": 
   * */
  
  private function getThreeInit($request)
  {
    $user = Auht::user();
    $portrait_url = $request->input('sourceLink');
    $a_x          = $request->input('a_x');
    $a_y          = $request->input('a_y');
    $e_width      = $request->input('e_width');
    $e_height     = $request->input('e_height');// 获取对应的参数

    if( isset($portrait_url) === FALSE ) { 
      return response()->json(['status'=>'error','reason'=>'the portrait_url value not exist']); 
    }elseif( filter_var($portrait_url,FILTER_VALIDATE_URL) === FALSE ){ // 检测 url 是否合法 
      return response()->json(['status'=>'error','reason'=>'the portrait_url value is not a url']);
    }else{ 

      $this->host = env('PORTRAIT_QINIUSERVER_HOST');// 
      if(is_null($this->host))
      {
        $this->host = $this->sliceUrlToGetHost($portrait_url);
        /* ??? 写环境变量遇到问题
         * */
      }else{
        if($this->host != $this->sliceUrlToGetHost($portrait_url)){
          // 默认设置的 host 和 发送过来的 host 不一样 ,返回错误并且提示修改 设置
          return ('errors.cry');
        }else{
          $photoUrlWithoutHost  =$this->sliceUrlToGetPath($portrait_url).$this->constantPath.$e_width.'x'.$e_height.'a'.$a_x.'a'.$a_y;//将 传入参数 拼接  成 符合特定格式的 url 

          $user->protrait = $photoUrlWithoutHost ;
          $user->save();
          // 存入到数据库中

          return response()->json(['status'=>'success']); 
        }

      }
     
    }


  }

 /* 切割获取的 url ,将 host 部分取出  
   * */
  private function sliceUrlToGetHost($url)
  {
    $urlComponetArray = parse_url($url); // 返回 含有 协议， host, user, 等信息的数组 
    $url = $urlComponetArray['scheme'].'://'.$urlComponetArray['host'];
    return $url;
  }

  private function sliceUrlToGetPath($url)
  {
    return  parse_url($url,PHP_URL_PATH); // 返回 含有 协议， host, user, 等信息的数组 
  }

  private function getFourInit($request)
  {
        $request->merge(array_map('trim',$request->all())); // 去掉输入的左右空白符

        $socialUrlConnect = new SocialUrlConnect();
        $connects = $socialUrlConnect->allConnects(); // 获取存放 属性 的数据文件

        $user = Auth::user();
        $all_data = $request->all(); // 获取所有输入
        foreach($all_data as $key => $value )
        {
          if( in_array( $key , array_keys($connects) ) && !empty($value) ) // 查看 key 值是合法的值 并且 对应的值不为空
          {
            $user_connect = SocialConnect::where('user_id',$user->id)->where('connect_name',$key)->first();
            if(empty($user_connect))
            {
              $user_connect = new SocialConnect();
              $user_connect->connect_name = $key;
              $user_connect->user_id = $user->id;
            } // 之前没有的话，创建一个新的
            $user_connect->connect_value = $value;
            $user_connect->save();
          }
        }

        $infoInitLog = $user->InfoInitLog;
        $this->changeUserInitLogStep($infoInitLog,5);

        return  redirect('user/init/'.$this->logtourl($infoInitLog->step)); // 服从 数据库记录，将页面重定向。
  }


  private function checkStep($step,$log)
  {
    if($step=='one' && ($log->step==0||$log->step==1))
    {
    }elseif($step == 'two' && $log->step==2){
    }elseif($step == 'three' && $log->step==3){
    }elseif($step == 'four' && $log->step==4){
    }elseif($step == 'finish' && $log->step==5 ){
    }elseif($step == 'error'){
    }else{
      return false;
    }
    return true;

  }

  private function logtourl($step)
  {
    switch($step)
    {
      case 0:
      case 1: return "one";
      case 2: return "two";
      case 3: return "three";
      case 4: return "four";
      case 5: return "finish";
      default:return "error";
    }
  }
  

  private function checkInthePrivateChoice($choices)
  {

     if(is_null($choices))
       return  true; // 没有传参数 是 成功 的

    // 检查所有的选择是否符合条件, 成功返回 true 失败返回 false 
    foreach($choices as $choice )
    {
      if(in_array($choice,$this->optional_choices))
      {
        continue;
      }
      else{
        return false;
      }
    }
    return true;
  }

  private function clearUserPrivateChoice($user)
  {
    // 因为 checkbox 的性质，只发送没有被选择的，需要先行将 记录 归为初始状态

    foreach($this->optional_choices as $choice )
    {
        $choice = $choice.'_authority';
        $user->update([$choice=>1]); 
    }
  }

}
