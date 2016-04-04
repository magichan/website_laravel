<?php

namespace App\Http\Controllers\User;

use Auth;
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
        return view('')->withUser($user);
        break;
      case 'two':
        return view('')->withUser($user);
        
        break;
      case 'three':
        return view('')->withUser($user);
        break;
      case 'four':
        return view('')->withUser($user);
        break;
      default:
        return "log 内部错误";
      }
    }else{
      redirect('user/init/'.$this->logtourl($log->step)); // 服从 数据库记录，将页面重定向。
    }

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
