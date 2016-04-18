<?php 
namespace App\Service\Contracts;

Interface MultiAttributesContract
{

  public function readJsonFile();
  public function writeJsonFile();
  public function addAttributes($type,$array);
  public function getAttributes($type);
  public function deleteAttributes($type);
  public function updateAttributes($type,$newarray);
  public function checkAttributes($type);
}
