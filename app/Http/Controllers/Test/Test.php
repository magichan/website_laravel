<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Test extends Controller
{
  public function runcode()
  {
    /*在 blade 模板引擎之中执行某些代码 */
    return view('test.var');
  }
}
