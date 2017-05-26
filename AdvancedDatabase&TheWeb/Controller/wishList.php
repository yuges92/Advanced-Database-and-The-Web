<?php
require_once('../Model/dbConn.php');
if (!isset($_SESSION['WishList'])) {
    $_SESSION['WishList']=array();
}

$feedbackForWishList='';
if (isset($_POST['addToWishList'])) {
    $wineID=$_POST['addToWishList'];
    if (isset($_SESSION['user'])&&$_SESSION['user']->userType=='Customer') {
        $wineID=$_POST['addToWishList'];
        $customer=getCustomerByUserID($_SESSION['user']->userID);
        $customerID=$customer->customerID;
        $wineID=$_POST['addToWishList'];
        $result=addToWishList($wineID, $customerID);
        if ($result) {
            echo "added";
        } else {
            echo "failed to add";
        }
    } else {
        if (in_array($wineID, $_SESSION['WishList'])) {
            echo "exist";
        } else {
            array_push($_SESSION['WishList'], $wineID);
            echo "added";
        }
    }
}


if (isset($_SESSION['user'])&&$_SESSION['user']->userType=='Customer') {
    $customer=getCustomerByUserID($_SESSION['user']->userID);
    $customerID=$customer->customerID;

    if (isset($_POST['removeWineFromList'])) {
        $wineID=$_POST['removeWineFromList'];
        $result=removeWineFromList($wineID, $customerID);
        if ($result) {
            echo "removed";
        } else {
            echo "failed to remove";
        }
    }

    if (isset($_SESSION['WishList'])&&!empty($_SESSION['WishList'])) {
        $wishLists=$_SESSION['WishList'];

        foreach ($wishLists as $wineID) {
            addToWishList($wineID, $customerID);
        }
        unset($_SESSION['WishList']);
    }
    $wishList='';
    $wishListFromDB=getWishListByCID($customerID);
    foreach ($wishListFromDB as $list) {
        $wishList[]=$list['wineID'];
    }
} elseif (isset($_SESSION['user'])&&$_SESSION['user']->userType=='Admin') {
    header('Location: ../index.php');
} else {
    $wishList=$_SESSION['WishList'];

    if (isset($_POST['removeWineFromList'])) {
        $wineID=$_POST['removeWineFromList'];
        $result=array_search($wineID, $_SESSION['WishList']);
        if ($result!==false) {
            unset($_SESSION['WishList'][$result]);
            echo "removed";
        } else {
            echo "failed to remove";
        }
    }
}
