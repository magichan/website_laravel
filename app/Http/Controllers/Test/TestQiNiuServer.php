<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Service\QiniuService;
use App\Service\TestService;
use App\Service\SocialUrlConnect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestQiNiuServer extends Controller
{
  private $qiniuService;
  function __construct(QiniuService $qiniuService)
  {
    $this->qiniuService = $qiniuService;

  }
  /* 得到 写在 .env 里的 bucket 的 uptoken 
   * */
  function getuptoken()
  {
    $json_value = array('uptoken'=>$this->qiniuService->getEnvBucketUpToken());

    return response()->json($json_value);
  }
}
