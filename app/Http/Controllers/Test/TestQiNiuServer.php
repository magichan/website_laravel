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
  function getuptoken()
  {
    $buket = "self";
    /* $this->qiniuService = new QiniuService(); */
    return view('test.test')->withVar($this->qiniuService->getUpToken($buket));

  }
}
