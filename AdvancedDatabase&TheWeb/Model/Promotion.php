<?php
class Promotion{
  private $promotionID;
  private $promoType;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }
}


 ?>
