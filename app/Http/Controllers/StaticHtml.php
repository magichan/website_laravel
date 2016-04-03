<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StaticHtml extends Controller
{
    function index()
    {
      return view('index');
    } 
    function contact()
    {
      return view('contact');
    }
    function about()
    {
      return view('about');
    }
}
