<?php
class WineType implements JsonSerializable{
  private $wineTypeID;
  private $country;
  private $colour;
  private $newArrival;

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
