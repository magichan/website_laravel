<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service\QiniuService;

class QiNiuServiceController extends Controller
{
   private $qiniuService;
  function __construct(QiniuService $qiniuService)
  {
    $this->qiniuService = $qiniuService;

  }
  /* 得到 写在 .env 里的 bucket 的 uptoken 
   * */
  function getUserPhotoBucketUpToken()
  {
    $json_value = array('uptoken'=>$this->qiniuService->getEnvBucketUpToken());

    return response()->json($json_value);
  }
   //
}
