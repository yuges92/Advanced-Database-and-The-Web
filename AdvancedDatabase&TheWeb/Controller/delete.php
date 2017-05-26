<?php
require_once('../Model/dbConn.php');

if (isset($_REQUEST['deleteFromSB'])) {
    $wineID=htmlentities($_REQUEST['wineID']);
    $caseOrBottle=htmlentities($_REQUEST['caseOrBottle']);

    $shoppingBasket= new ShoppingBasket();
    $shoppingBasket->customerID='1';
    $shoppingBasket->wineID=htmlentities($wineID);
    $shoppingBasket->caseOrBottle=htmlentities($caseOrBottle);
  //$shoppingBasket->quantity=htmlentities($quantity);

if (isset($_SESSION['user'])) {
    $customer=getCustomerByUserID($_SESSION['user']->userID);
    $customerID=$customer->customerID;
    $shoppingBasket->customerID=$customerID;
    $deleteSB=deleteSBRow($shoppingBasket);

    if ($deleteSB) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    //still need to work on this
  if (isset($_SESSION['ShoppingBasket'])&&!empty($_SESSION['ShoppingBasket'])) {
      foreach ($_SESSION['ShoppingBasket'] as $key => $basket) {
          unset($_SESSION['ShoppingBasket'][$key]);
          echo "true";
          die();
      }
  }
}
}
