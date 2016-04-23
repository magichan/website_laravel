<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestAjax extends Controller
{
  public function  index()
  {
    return view('test.testajax');
  }
  public function getpost(Request $request)
  { 
    $portrait_url = $request->input('portrait_url');

    if( isset($portrait_url) === FALSE )
    {
      return response()->json(['status'=>'error','reason'=>'the portrait_url value not exist']);
      /* return response()->json(['name' => 'Abigail', 'state' => 'CA']); */
    }elseif( filter_var($portrait_url,FILTER_VALIDATE_URL) === FALSE ){
     
      return response()->json(['status'=>'error','reason'=>'the portrait_url value is not a url']);
    }else{
      return response()->json(['status'=>'success']);
    }
  }
}

