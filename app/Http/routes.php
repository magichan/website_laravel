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


Route::group(['middleware'=>'web'],function(){
  // 对外开放的网页  index about contact
  Route::get('/home','StaticHtml@index');
  Route::get('/','StaticHtml@index');
  Route::get('/index','StaticHtml@index');
  Route::get('/about','StaticHtml@about');
  Route::get('/contact','StaticHtml@contact');
});

Route::group(['prefix'=>'user','namespace'=>'User','middleware'=>['web','auth']],function(){
  Route::get('/active','ActiveController@Active'); //请求激活
  Route::get('/init/{step?}','UserInfoController@init');

});
Route::get('user/active/{token?}','User\ActiveController@ActiveUser'); //通过 Url 激活

Route::auth();



Route::group(['prefix'=>'test','namespace'=>'Test','middleware'=>['web']],function(){
     /* Route::get('/oldtonew','OldDatabaseToNewDatabase@index'); */
        Route::get('/index','ReturnHtmlFile@index');
        Route::get('/email','TestEmail@index');
});
