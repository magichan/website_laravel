<?php 
namespace  App\Service;

use App\Service\Attributes;

class SocialUrlConnect extends Attributes{
  
  function __struct($jsonFile = './SocialUrlConnectList.json'){
    parent::__struct($jsonFile);
  }
  /* 以数组的形式返回所有的 记录
   * */
  public function allConnects(){
  return $this->attributes;
  }

  /* 替代构造函数的功能
   */
  public function init($filename = './SocialUrlConnectList.json')
  {
    $this->setJsonFile($filename);
    $this->readJsonFile();
    return $this;
  }


  /*  添加 url 类型的记录 到文件中
   * */
  public function addUrlConnect($typename,$aliesname)
  {

    if($this->checkAttributes($typename) )
    {
       return false;
    }else{
      $config = array('aliases'=>$aliesname,'count'=>0);
      $this->addAttributes($typename,$config);

      $this->writeJsonFile();
      return true;
    }
  }
  /*  添加 非 url 的记录到 文件 中 
   * */
  public function addConnect($typename,$aliesname)
  {
    if( $this->checkAttributes($typename)) 
    {
      return false;
    }else{
      $config = array('type'=>'no_url','aliases'=>$aliesname,'count'=>0);
      $this->addAttributes($typename,$config);
      $this->writeJsonFile();
      return true;
    }
  }
  /* 返回 type 对应的属性组
   */
  public function getConnect($type)
  {
    return  $this->getAttributes($type);
  }

  // 返回 对应 记录的 url      
  public function getUrlConnectUrl($type)
  {
    if($this->checkAttributes($type) || $this->getConnectType($type)!='url')
    {
      return false;
    }else{
      return $this->attributes[$type]['url'];
    }
  } 


  public function getConnectAliases($type)
  {
    if($this->checkAttributes($type) )
    {
      return false;
    }else{
      return $this->attributes[$type]['aliases'];
    }
  }
  public function deleteConnect($type)
  {
     $flag =  $this->deleteAttributes($type);
     if($flag == true )
     {
      $this->writeJsonFile();
     }
     return $flag;
  }
}
