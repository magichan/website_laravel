<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Auth;
use Mail;
use Redirect;
use App\User;
use App\ActiveLog;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActiveController extends Controller
{
   private $from_mail='xiyouant@163.com';
  public function Active()
  {
    $user = Auth::user();
    if($user == null)
    {
      return Redirect::home();
    }

    $activelog = $this->createNewActiveLog($user->email); 
    // delete old log and create  new log
    $activelog->save(); 

    Mail::send('user.active_email',['token'=>$activelog->token,'email'=>$user->email],function ($m) use ($user) {
      $m->from('xiyouant@163.com','西邮计算院网络科技协会');
      $m->to($user->email,$user->name)->subject("激活您的账号");
    });

    return redirect('/home');

  }
  public  function ActiveUser(Request $request, $token = null )
  {

    if(is_null($token))
    {
      return "用户邮件激活失败";
    }
    $email = $request->input('email');

    $active_log = ActiveLog::where('token',$token)->where('email',$email)->firstOrFail();

    $user = User::where('email',$email)->firstOrFail();
    $user->active = true;
    $user->save();

    Auth::login($user); // 登陆
    return  "邮件激活成功";// 重定向

  }

  public function createNewActiveLog( $email)
  {
    $delete_flag = ActiveLog::where('email',$email)->delete();

    $activelog = new ActiveLog;
    $activelog->email = $email;
    $activelog->token = ActiveLog::CreateToken();
    /* $activelog->created_at = time(); */

    return $activelog; 

  }

   //
}
