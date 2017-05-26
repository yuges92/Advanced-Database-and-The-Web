<?php
require_once('../Model/dbConn.php');

if (isset($_GET['wineID'])) {
    $wineTypes=getAllWineTypes();
    $wine=getWineByID($_GET['wineID']);
//require_once '../View/editWine.php';
}

if (isset($_POST['updateWine'])) {
    $wineID=$_POST['wineID'];
    $wineTypeID=$_POST['wineTypeID'];
    $rating=ucwords($_POST['rating']);
    $description=ucwords($_POST['description']);
    $bottleSize=$_POST['bottleSize'];
    $noOfBottleInACase=$_POST['noOfBottleInACase'];
    $costPerCase=$_POST['costPerCase'];
    $costPerBottle=$_POST['costPerBottle'];

    $wine= new Wine();
    $wine->wineID=htmlentities($wineID);
    $wine->wineTypeID=htmlentities($wineTypeID);
    $wine->rating=htmlentities($rating);
    $wine->description=htmlentities($description);
    $wine->bottleSize=htmlentities($bottleSize);
    $wine->noOfBottleInACase=htmlentities($noOfBottleInACase);
    $wine->costPerCase=htmlentities($costPerCase);
    $wine->costPerBottle=htmlentities($costPerBottle);
    $check=updateWine($wine);

    header('Location:../View/manage.php');
}
