<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestAjax extends Controller
{
  private $constantPath = "?imageMogr2/crop/!";// 七牛处理图片的必要前缀
  public function  index()
  {
    return view('test.testajax');
  }
  /* 输入 json 
   *"sourceLink":图片的 URl,
   "a_x": ,
   "a_y": ,
   "e_width": ,
   "e_height": 
   * */
  public function getpost(Request $request)
  { 
    $portrait_url = $request->input('sourceLink');
    $a_x          = $request->input('a_x');
    $a_y          = $request->input('a_y');
    $e_width      = $request->input('e_width');
    $e_height     = $request->input('e_height');

    if( isset($portrait_url) === FALSE )
    {
      return response()->json(['status'=>'error','reason'=>'the portrait_url value not exist']);
      /* return response()->json(['name' => 'Abigail', 'state' => 'CA']); */
    }elseif( filter_var($portrait_url,FILTER_VALIDATE_URL) === FALSE ){
     
      return response()->json(['status'=>'error','reason'=>'the portrait_url value is not a url']);
    }else{
     
      $photo_url = $this->sliceUrlToGetHost($portrait_url).$this->sliceUrlToGetPath($portrait_url).$this->constantPath.$e_width.'x'.$e_height.'a'.$a_x.'a'.$a_y;//将 传入参数 拼接  成 符合特定格式的 url 
      return response()->json(['status'=>'success']); 
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
}

