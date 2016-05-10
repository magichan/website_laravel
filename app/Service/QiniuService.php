<?php
namespace App\Service;

use Qiniu\Auth;

class QiniuService {
  private $accessKey;
  private $secertKey;
  private $bucket;

  function __construct()
  {
    $this->accessKey = env('QINIU_SECERT_KEY');
    $this->secertKey = env('QINIU_SECERT_KEY');
    $this->bucket    = env('QINIU_BUCKET');
  }
  function getEnvBucketUpToken()
  {
    $auth = new Auth($this->accessKey,$this->secertKey);
    $uptoken = $auth->uploadToken($this->bucket);
    return $uptoken;
  }


}
