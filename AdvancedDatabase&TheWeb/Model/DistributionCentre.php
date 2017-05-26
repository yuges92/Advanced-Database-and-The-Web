<?php
class DistributionCentre{
  private $centreID;
  private $firstLineAddress;
  private $town;
  private $postcode;
  private $region;
  private $phoneNo;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }

}

 ?>
