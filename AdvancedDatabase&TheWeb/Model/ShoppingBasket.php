<?php
class ShoppingBasket{
  private $wineID;
  private $customerID;
  private $caseOrBottle;
  private $quantity;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }
}

 ?>
