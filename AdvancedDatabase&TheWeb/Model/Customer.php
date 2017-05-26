<?php
require_once('User.php');
class Customer extends User{
  private $customerID;
  private $firstname;
  private $lastname;
  private $dob;
  private $firstLineAddress;
  private $town;
  private $postcode;
  private $region;
  private $email;
  private $phoneNo;


  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }

  function getCustomerAddress(){

    return ("$this->firstLineAddress, $this->town, $this->postcode, $this->region");
  }
}

 ?>
