<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Route::get('/', function () { */
/*     return view('welcome'); */
/* }); */

Route::get('error',function(){
    return view('errors.cry');
});

Route::group(['middleware'=>'web'],function(){
  // 对外开放的网页  index about contact
  Route::get('/home','StaticHtml@index');
  Route::get('/','StaticHtml@index');
  Route::get('/index','StaticHtml@index');
  Route::get('/about','StaticHtml@about');
  Route::get('/contact','StaticHtml@contact');
});

Route::group(['prefix'=>'user','namespace'=>'User','middleware'=>['auth']],function(){
  //用户的操作
  Route::get('/active','ActiveController@Active'); //请求激活
  Route::get('/init/{step?}','UserInfoController@init');
  Route::post('/init/{step?}','UserInfoController@getInit');

});
Route::group(['prefix'=>'admin','namespace'=>'Root','middleware'=>['auth']],function(){
  Route::get('/',function(){
  return "Hello World";
  });
  Route::resource('socialurl','AdminSocialUrlController',['only'=>['index','create','store','destroy']]);
});


Route::get('user/active/{token?}','User\ActiveController@ActiveUser'); //通过 Url 激活

Route::auth();



/* Route::group(['prefix'=>'test','namespace'=>'Test','middleware'=>['web']],function(){ */
Route::group(['prefix'=>'test','namespace'=>'Test'],function(){
     /* Route::get('/oldtonew','OldDatabaseToNewDatabase@index'); */
        Route::get('/index','ReturnHtmlFile@index');
        Route::get('/email','TestEmail@index');
        Route::get('/runcode','Test@runcode');

        // 测试表单提交 和 错误返回
        Route::get('/val','TestVal@index');
        Route::post('/val','TestVal@get');
});
