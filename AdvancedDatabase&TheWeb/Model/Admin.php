<?php
require_once('User.php');
class Admin extends User{
  private $adminID;
  private $firstName;
  private $lastName;
  private $email;
  private $phoneNo;

  function __get($name){
    return $this->$name;
  }

  function __set($name,$value){
    $this->$name=$value;
  }
}

 ?>
