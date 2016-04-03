<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReturnHtmlFile extends Controller
{
  function index()
  {
    return view('test.index');
  } 
}
