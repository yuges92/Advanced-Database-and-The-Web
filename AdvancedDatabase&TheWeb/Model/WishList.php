<?php
class WishList{
  private $wineID;
  private $customerID;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }
}

 ?>
