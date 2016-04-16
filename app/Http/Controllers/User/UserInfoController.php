<?php

namespace App\Http\Controllers\User;

use Auth;
use Input;
use App\User;
use App\InfoInitLog;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
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
        return view('test.test')->withvar($user);
        break;
      case 'four':
        return view('test.test')->withvar($user);
        break;
      default:
        return "log 内部错误";
      }
    }else{

     return  redirect('user/init/'.$this->logtourl($log->step)); // 服从 数据库记录，将页面重定向。
    }

  } 

  public function  getInit(Request $request ,$step = null )
  {// 获取 init 过程中的数据输入 
    $request->merge(array_map('trim',$request->all()));

   switch($step)
      {
      case 'one':

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
        return view('test.test')->withVar($user);
        
        break;
      case 'three':
        return view('test.test')->withVar($user);
        break;
      case 'four':
        return view('test.test')->withVar($user);
        break;
      default:
        return "log 内部错误";
      }

  }
 
  private function getOneInit($request)
  {
    $user = Auth::user();


    $new_data = $request->all();
    array_splice($new_data,0,1); // 删除 laravel 框架 自带的 token 值 ，注意这里默认 token 值 放在数组的第一位 

    $user->update($new_data);//  利用数组赋值，速度快但不太安全。

    $infoInitLog = $user->InfoInitLog;
    $infoInitLog->step = 2;
    $infoInitLog->save(); // 改变信息初始化过程的状态标示 
  

    return  redirect('user/init/'.$this->logtourl($infoInitLog->step)); // 服从 数据库记录，将页面重定向。
  }


  private function checkStep($step,$log)
  {
    if($step=='one' && ($log->step==0||$log->step==1))
    {
    }elseif($step == 'two' && $log->step==2){
    }elseif($step == 'three' && $log->step==3){
    }elseif($step == 'four' && $log->step==4){
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
      default:return "error";
    }

  }
}
