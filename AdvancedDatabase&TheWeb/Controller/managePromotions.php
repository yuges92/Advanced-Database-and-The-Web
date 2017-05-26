<?php
require_once('../Model/dbConn.php');
error_reporting(0);
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->userType=='Admin') {
        $winePromotionList=getAllPromo();
        $promoTypes=getAllPromoType();
        $wines=getAllWines();

        if (isset($_POST['getPromoType'])) {
            $promotionID=$_POST['getPromoType'];
            $result=getPromoTypeByID($promotionID);
            if ($result) {
                echo $result->promoType;
            } else {
                echo "failed";
            }
        }

        if (isset($_POST['addNewPromo'])) {
            parse_str($_POST['addNewPromo'], $formdata);
            $promotionID=$formdata['promotionID'];
            $wineID=$formdata['wineID'];
            $validFrom=$formdata['validFrom'];
            $validUntil=$formdata['validUntil'];

            $winePromotion= new WinePromotion();
            $winePromotion->promotionID=$promotionID;
            $winePromotion->wineID=$wineID;
            $winePromotion->validFrom=$validFrom;
            $winePromotion->validUntil=$validUntil;

            $result=addNewWinePromo($winePromotion);
            if ($result) {
                echo "added";
            } else {
                echo "failed";
            }
        }
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}
