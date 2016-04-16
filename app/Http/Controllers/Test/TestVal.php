<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestVal extends Controller
{
  public function index()
  {
    return view('test.val');
  }
  public function get(Request $request)
  {
    $this->validate($request,[
      'name'=>'required',
    ]);
    return "OK";

  }
}
