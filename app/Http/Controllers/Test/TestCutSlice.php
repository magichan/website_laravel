<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestCutSlice extends Controller
{
  private $host;
  public function  __construct()
  {
    $host = env(QINIU_STORAGE_HOST); // 获取存储 照片 url 的 HOST 地址 
  }
  public function slice_host()
  {
    $path = 

  }
  
}
