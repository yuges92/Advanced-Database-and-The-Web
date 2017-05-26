<?php
require_once('../Model/dbConn.php');

if (!isset($_SESSION['user'])) {
    header('location:../View/login.php');
}

if (isset($_SESSION['user'])&& $_SESSION['user']->userType=='Customer') {
    $userID=$_SESSION['user']->userID;
    $customer=getCustomerByUserID($userID);
    $customerID=$customer->customerID;
    $customerBasket=getShoppingBasket($customerID);

    if ($customerBasket) {
        $total=0;
        $subTotal=0;
        foreach ($customerBasket as $basket) {
            $quantity=$basket->quantity;
            $wine=getWineByID($basket->wineID);
            if ($basket->caseOrBottle=='Case') {
                $wineCost=$wine->costPerCase;
            } else {
                $wineCost=$wine->costPerBottle;
            }

            $subTotal+=($quantity*$wineCost);
        }

        if ($subTotal<50) {
            $deliveryCharge=5.00;
        } elseif ($subTotal>50 and $subTotal<=100) {
            $deliveryCharge=10.00;
        } else {
            $deliveryCharge=0.00;
        }

        $total=$subTotal+$deliveryCharge;
        $currentAddress=$customer->getCustomerAddress();

        if (isset($_REQUEST['confirmOrder'])) {
            $customerOrder= new CustomerOrder();
            $customerOrder->customerID=$customerID;
            $customerOrder->orderDate=date("Y-m-d");
            $customerOrder->total=$total;
            $customerOrder->deliveryCharge=$deliveryCharge;
            if ($_POST['deliveryAddress']=='newDeliveryAddress') {
                $customerOrder->deliveryAddressFirstLine=htmlentities($_POST['deliveryFirstLineAddress']);
                $customerOrder->town=htmlentities($_POST['deliveryTown']);
                $customerOrder->postcode=htmlentities($_POST['deliveyPostcode']);
                $customerOrder->region=htmlentities($_POST['deliveryRegion']);
            } else {
                $customerOrder->deliveryAddressFirstLine=$customer->firstLineAddress;
                $customerOrder->town=$customer->town;
                $customerOrder->postcode=$customer->postcode;
                $customerOrder->region=$customer->region;
            }

            $orderID=addOrder($customerOrder);

            if ($orderID) {
                foreach ($customerBasket as $basket) {
                    $orderItem= new OrderItem();
                    $orderItem->orderID=$orderID;
                    $orderItem->wineID=$basket->wineID;
                    $orderItem->quantity=$basket->quantity;
                    $orderItem->caseOrBottle=$basket->caseOrBottle;
                    $orderItem->cost=$subTotal;
                    $orderItem->deliveryDate=$_POST['deliveryDate'];
                    $orderItem->status='Order in Process';
                    $addResult=addOrderItem($orderItem);
                    if ($addResult) {
                        $centre=getCentreByRegion($customerOrder->region);

                        if (!$centre) {
                            $centre=getCentreByRegion('london');
                        }
                        $stock = new Stock();
                        $stock->wineID=$orderItem->wineID;
                        $stock->centreID=$centre->centreID;
                        $wineStockQuantity=getStockByWIDAndCID($stock)->quantity;

                        if ($orderItem->caseOrBottle=='Case') {
                            $wine=getWineByID($stock->wineID);
                            $caseQuantity=$wine->noOfBottleInACase*$orderItem->quantity;
                            $stock->quantity=$wineStockQuantity-$caseQuantity;
                        } else {
                            $stock->quantity=$wineStockQuantity-$orderItem->quantity;
                        }
                        updateWineStock($stock);
                        deleteSBRow($basket);
                    }
                }
            }
            header('Location: ../View/orderFeedback.php');
        }
    } else {
        if (isset($_POST['checkBasket'])) {
            if (empty($customerBasket)) {
                echo "basket empty";
            }
        }
    }
} else {
    header('Location: ../View/login.php');
}
