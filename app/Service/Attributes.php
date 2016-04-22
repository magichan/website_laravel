<?php 
namespace App\Service;

use App\Service\Contracts\MultiAttributesContract;

class Attributes implements MultiAttributesContract
{
  public $attributesJsonFile;
  public $attributes;

  public function __construct($jsonFile = './AttributesList.json')
  {
    $this->setJsonFile($jsonFile);
    $this->readJsonFile();

  }

  public function setJsonFile($jsonFile){
    $this->attributesJsonFile  = $jsonFile;
  }

  public function readJsonFile(){

    if(file_exists($this->attributesJsonFile))
    {

      $json_string = file_get_contents($this->attributesJsonFile);
      $this->attributes = json_decode($json_string==null?'{}':$json_string,true);
    }else{
      $fd = fopen($this->attributesJsonFile,'w');
      fclose($fd);
      $this->attributes = array();
    }
  }
  public function writeJsonFile(){
    $fd = fopen($this->attributesJsonFile,'w');
    $json_string = json_encode($this->attributes,JSON_PRETTY_PRINT);
    fwrite($fd,$json_string);
    fclose($fd);
  } 
  public function addAttributes($type,$array){
    $this->attributes[$type] = $array;
  }

  public function getAttributes($type){
    if(array_key_exists($type,$this->attributes))
    {
       return   $this->attributes[$type];
    }else{
      return null;
    }
  }
  public function deleteAttributes($type){
     if(array_key_exists($type,$this->attributes))
      {
        unset($this->attributes[$type]);
        return true;
      }else{
        return false;
      }

  }
    public function updateAttributes($type,$newarray){
      if(array_key_exists($type,$this->attributes))
      {
        $this->attributes[$type] = $newarray;
        return true;
      }else{
        return false;
      }
    }
  public function checkAttributes($type){
   return array_key_exists($type,$this->attributes);
  }
  

}
