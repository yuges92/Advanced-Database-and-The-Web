<?php
require_once('../Model/dbConn.php');
error_reporting(0);
$feedback=false;

if(isset($_POST['usernameCheck'])){
  $username= htmlentities($_POST['username']);
  $result=checkUsername($username);
  print_r( $result);
}

if(isset($_POST['emailCheck'])){
  $email= htmlentities($_POST['emailCheck']);
  $result=checkUsername($email);
  print_r( $result);
}


if(isset($_POST['register'])){
  parse_str($_POST['register'], $formdata);
  if(empty($formdata['username'])||
  empty($formdata['password'])||
  empty($formdata['firstname'])||
  empty($formdata['lastname'])||
  empty($formdata['dob'])||
  empty($formdata['firstLineAddress'])||
  empty($formdata['town'])||
  empty($formdata['postcode'])||
  empty($formdata['region'])||
  empty($formdata['email'])){
    echo "error";
  }else {
  $userType='Customer';
  $username=$formdata['username'];
  $password=$formdata['password'];
  $firstname=ucwords($formdata['firstname']);
  $lastname=ucwords($formdata['lastname']);
  $dob=ucwords($formdata['dob']);
  $firstLineAddress=ucwords($formdata['firstLineAddress']);
  $town=ucwords($formdata['town']);
  $postcode=strtoupper($formdata['postcode']);
  $region=ucwords($formdata['region']);
  $email=$formdata['email'];

if(isset($formdata['phoneNo'])){
  $phoneNo=$formdata['phoneNo'];
}else {
  $phoneNo=null;
}
$customer= new Customer();
$customer->userType=($userType);
$customer->username=htmlentities($username);
$customer->password=htmlentities($password);
$customer->firstname=htmlentities($firstname);
$customer->lastname=htmlentities($lastname);
$customer->dob=htmlentities($dob);
$customer->firstLineAddress=htmlentities($firstLineAddress);
$customer->town=htmlentities($town);
$customer->postcode=htmlentities($postcode);
$customer->region=htmlentities($region);
$customer->email=htmlentities($email);
$customer->phoneNo=htmlentities($phoneNo);
$result=addCustomer($customer);

print_r($result);
// if($result==true){
//   echo "true";
// }else {
//   echo "false";
//
// }


//header('Location: ../index.php');

}
}

 ?>
