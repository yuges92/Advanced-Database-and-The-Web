<?php
require_once('../Model/dbConn.php');
error_reporting(0);

if(isset($_SESSION['user'])){

if($_SESSION['user']->userType=='Admin'){


if(isset($_POST['addAdminForm'])){
parse_str($_POST['addAdminForm'],$adminData);

if(empty($adminData['username'])||
empty($adminData['firstname'])||
empty($adminData['lastname'])||
empty($adminData['email'])){
  echo 'field is empty';
}else {
  $username=$adminData['username'];
  $password='password';
  $firstname=ucwords($adminData['firstname']);
  $lastname=ucwords($adminData['lastname']);
  $email=$adminData['email'];

  $admin = New Admin();
  $admin->userType='Admin';
  $admin->username=htmlentities($username);
  $admin->password='password';
  $admin->firstname=htmlentities($firstname);
  $admin->lastname=htmlentities($lastname);
  $admin->email=htmlentities($email);
  $add=addAdmin($admin);

  if($add){
    echo 'admin added';
  }else {
  echo 'failed to add';
  }
}
}




}else {
  header('Location: ../index.php');
}
}else {
  header('Location: ../index.php');
}


 ?>
