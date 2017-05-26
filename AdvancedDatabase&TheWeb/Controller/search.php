<?php
require_once('../Model/dbConn.php');

if(isset($_GET['searchWine'])){
  if($_GET['searchWine']=='wines'||$_GET['searchWine']=='wine'){
    $wines=getAllWines();
  }else{
  $wines=searchWine($_GET['searchWine']);
}

}
require_once('../View/wines.php');
 ?>
