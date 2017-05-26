<?php
require_once '../Model/dbConn.php';

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->userType=='Admin') {
        if (isset($_POST['country'])) {
            $country=ucwords($_POST['country']);
            $colour=$_POST['colour'];
            $newArrival=$_POST['newArrival'];
            $wineType= new WineType();
            $wineType->country=htmlentities($country);
            $wineType->colour=htmlentities($colour);
            $wineType->newArrival=htmlentities($newArrival);
            $check=checkWineTypeExist($wineType);
            if ($check) {
                addWineType($wineType);
                $feedback='Record Successfully Added!';
                header('location:../View/manage.php');
            } else {
                $feedback='Record Already exist!';
            }
        }
    } else {
        header('location:../index.php');
    }
} else {
    header('location:../index.php');
}
