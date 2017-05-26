<?php
require_once('WineType.php');
class Wine extends WineType implements JsonSerializable{
  private $wineID;
  private $description;
  private $bottleSize;
  private $rating;
  private $noOfBottleInACase;
  private $costPerCase;
  private $costPerBottle;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }
  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

}


 ?>
