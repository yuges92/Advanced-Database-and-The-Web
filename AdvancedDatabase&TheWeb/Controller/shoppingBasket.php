<?php
require_once('../Model/dbConn.php');

if (!isset($_SESSION['ShoppingBasket'])) {
    $_SESSION['ShoppingBasket']=array();
}

if (isset($_POST['checkBasketEmpty'])) {
    if (!isset($_SESSION['user'])) {
        if (empty($_SESSION['ShoppingBasket'])) {
            echo "Your Shopping Basket is empty";
        }
    } elseif ($_SESSION['user']->userType=='Customer') {
        $customer=getCustomerByUserID($_SESSION['user']->userID);
        $shoppingBasketList=getShoppingBasket($customer->customerID);
        if (empty($shoppingBasketList)) {
            echo "Your Shopping Basket is empty";
        }
    }
}


//for adding to shopping list
if (isset($_REQUEST['addToShoppingBasket'])) {
    $wineID=$_REQUEST['wineID'];
    $caseOrBottle=$_REQUEST['caseOrBottle'];
    $quantity=$_REQUEST['quantity'];

    $shoppingBasket= new ShoppingBasket();
    $shoppingBasket->customerID='1';
    $shoppingBasket->wineID=htmlentities($wineID);
    $shoppingBasket->caseOrBottle=htmlentities($caseOrBottle);
    $shoppingBasket->quantity=htmlentities($quantity);

    if (isset($_SESSION['user'])&&$_SESSION['user']->userType=='Customer') {
        $customer=getCustomerByUserID($_SESSION['user']->userID);
        $shoppingBasket->customerID=$customer->customerID;
        if ($shoppingBasket->quantity>0) {
            $result=addToShoppingBasket($shoppingBasket);
            if ($result) {
                echo 'true';
            } else {
                echo "false";
            }
        }

//  header('Location: shoppingBasket.php');
    } else {
        if ($shoppingBasket->quantity>0) {
            array_push($_SESSION['ShoppingBasket'], $shoppingBasket);
            echo "true";
        }
    }
}

//adding to the database from the session when the user login
if (isset($_SESSION['user'])&&$_SESSION['user']->userType=='Customer') {
    if (isset($_SESSION['ShoppingBasket'])&&!empty($_SESSION['ShoppingBasket'])) {
        $customer=getCustomerByUserID($_SESSION['user']->userID);
        $shoppingBasketList=$_SESSION['ShoppingBasket'];

        foreach ($shoppingBasketList as $list) {
            $list->customerID=$customer->customerID;
            if ($list->quantity>0) {
                addToShoppingBasket($list);
            }
        }
        unset($_SESSION['ShoppingBasket']);
//header('Location: shoppingBasket.php');
    }
    $customer=getCustomerByUserID($_SESSION['user']->userID);
    $shoppingBasketList=getShoppingBasket($customer->customerID);
} elseif (isset($_SESSION['user'])&&$_SESSION['user']->userType=='Admin') {
    header('Location: ../index.php');
} else {
    $shoppingBasketList=$_SESSION['ShoppingBasket'];
}

$total=0;
$subTotal=0;
