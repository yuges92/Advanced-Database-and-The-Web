<?php
require_once('../Model/dbConn.php');
//error_reporting(0);
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->userType=='Admin') {
        $wines=getAllWines();
        $wineTypes=getAllWineTypes();
        $stocks=getStock();
        $centres=getAllCentres();

        $feedbackForWine='';
        $feedbackForWineType='';


        if (isset($_POST['deleteWineID'])) {
            $deleteWineID=$_POST['deleteWineID'];
            $deleteResult=deleteWine($deleteWineID);

            if ($deleteResult) {
                echo "Wine Deleted";
            } else {
                echo "unsuccessfull";
            }
        }

        if (isset($_POST['deleteWineTypeID'])) {
            $deleteWineTypeID=$_POST['deleteWineTypeID'];
            $result=deleteWineType($deleteWineTypeID);

            if ($result) {
                echo "WineType Deleted";
            } else {
                echo "unsuccessfull";
            }
        }

        if (isset($_POST['addNewWineStockForm'])) {
            parse_str($_POST['addNewWineStockForm'], $formdata);
            if (empty($formdata['stockQuantity'])) {
                echo "quantity needed";
            } else {
                $wineID=trim($formdata['wineStock']);
                $centreID=trim($formdata['distributionCentre']);
                $quantity=trim($formdata['stockQuantity']);

                $stock = new Stock();
                $stock->wineID=$wineID;
                $stock->centreID=$centreID;
                $stock->quantity=$quantity;

                $result=addStock($stock);
                if ($result) {
                    echo "New Stock Added";
                } else {
                    echo "failed to Add";
                }
            }
        }

        if (isset($_POST['updateStock'])) {
            if ($_POST['quantity']<0) {
                echo "Incorrect Quantity";
            } else {
                $wineID=trim($_POST['wineID']);
                $centreID=trim($_POST['centreID']);
                $quantity=trim($_POST['quantity']);

                $stock = new Stock();
                $stock->wineID=$wineID;
                $stock->centreID=$centreID;
                $stock->quantity=$quantity;

                $result=updateWineStock($stock);

                if ($result) {
                    echo "Successfully Updated";
                } else {
                    echo "Failed To update";
                }
            }
        }
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}
