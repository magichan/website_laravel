<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Service\QiniuService;
use App\Service\SocialUrlConnect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestQiNiuServer extends Controller
{
  private $qiniuService;
  function __consrtuct(QiniuService $qiniuService)
  {
    $this->qiniuService = $qiniuService;

    /* $this->qiniuService = new QiniuService(); */
  }
  function getuptoken()
  {
    $buket = "self";
    $social = new SocialUrlConnect();
    /* return view('test.test')->withVar($this->qiniuService->getUpToken($buket)); */
    /* return view('test.test')->withVar($social); */
    return view('test.test')->withVar($this->qiniuService);
    /* return view('test.test')->withVar($this->qiniuService->fake()); */
    /* return view('test.test')->withVar('asfd'); */

  }
}
