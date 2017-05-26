<?php
class Stock{
  private $wineID;
  private $centreID;
  private $quantity;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }

}

 ?>
