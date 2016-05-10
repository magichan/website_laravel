<?php
namespace App\Service;

use Qiniu\Auth;

class QiniuService {
  private $accessKey;
  private $secertKey;
  function __construct()
  {
    $this->accessKey = env('QINIU_SECERT_KEY');
    $this->secertKey = env('QINIU_SECERT_KEY');
  }
  /* 获得针对特定库的 uptoken 
   * */
  function getUpToken($bucket)
  {
    $auth = new Auth($this->accessKey,$this->secertKey);
    $uptoken = $auth->uploadToken($bucket);
    return $uptoken;
  }
  function fake()
  {
    return "OK";
  }
}
