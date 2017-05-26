<?php
require_once('../Model/dbConn.php');
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->userType=='Admin') {
        if (!isset($feedback)) {
            $feedback='';
        }
        $wineTypes=getAllWineTypes();

    //need to use ajax to dynamically update the colour,country and newarrival field
    if (isset($_REQUEST['wineTypeID'])) {
        $wineTypes=getWineTypesByIDJson($_REQUEST['wineTypeID']);
        echo($wineTypes);
    }
    //addWine
    if (isset($_POST['addWine'])) {
        $wineTypeID=$_POST['wineTypeID'];
    //$country=$_POST['country'];
    //$colour=$_POST['colour'];
    //$newArrival=$_POST['newArrival'];
    $rating=ucwords($_POST['rating']);
        $description=ucwords($_POST['description']);
        $bottleSize=$_POST['bottleSize'];
        $noOfBottleInACase=$_POST['noOfBottleInACase'];
        $costPerCase=$_POST['costPerCase'];
        $costPerBottle=$_POST['costPerBottle'];

        $wine= new Wine();
        $wine->wineTypeID=htmlentities($wineTypeID);
        $wine->rating=htmlentities($rating);
        $wine->description=htmlentities($description);
        $wine->bottleSize=htmlentities($bottleSize);
        $wine->noOfBottleInACase=htmlentities($noOfBottleInACase);
        $wine->costPerCase=htmlentities($costPerCase);
        $wine->costPerBottle=htmlentities($costPerBottle);
        $check=addWine($wine);

        if ($check) {
            $feedback='New Wine Added';
            header('location:../View/manage.php');
        } else {
            $feedback='Wine not Added';
            header('location:../View/manage.php');
        }
    }
    } else {
        header('location:../index.php');
    }
} else {
    header('location:../index.php');
}
