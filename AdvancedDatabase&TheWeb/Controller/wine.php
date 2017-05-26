<?php
require_once('../Model/dbConn.php');
if(isset($_GET['wineID'])){
$wine=getWineByID($_GET['wineID']);

}else {
  header('Location: ../index.php');
}
 ?>
