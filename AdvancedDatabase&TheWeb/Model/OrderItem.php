<?php
class OrderItem{
  private $wineID;
  private $caseOrBottle;
  private $cost;
  private $deliveryDate;
  private $status;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }
}

 ?>
