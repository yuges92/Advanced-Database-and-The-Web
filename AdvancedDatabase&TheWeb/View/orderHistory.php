<?php require_once('../Controller/orderHistory.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>
    <title>Order History</title>
</head>

<body>
    <?php require_once 'banner.php';?>
    <?php require_once 'navigation.php'; ?>
    

    <div class="container-flex">
        <div class="orderSummary">
            <?php foreach ($customerOrders as $customerOrder): ?>
            <div class="orders">
                <div class="orderMain">
                    <div class="">
                        <label for="">Order ID: <span><?=$customerOrder->orderID?></span></label>
                    </div>
                    <div class="">
                        <label for="">Order Date: <span><?=$customerOrder->orderDate?></span> </label>
                    </div>
                    <div class="">
                        <label for="">Total: <span>£<?=$customerOrder->total?></span></label>
                    </div>
                </div>
                <?php foreach (getOrderItems($customerOrder->orderID) as $item): ?>
                <div class="orderItems">
                    <div class="">
                        <label for="">Wine ID: <span><?=$item->wineID?></span></label>
                    </div>
                    <div class="">
                        <label for="">Wine Description: <span><?=getWineByID($item->wineID)->description?></span></label>
                    </div>
                    <div class="">
                        <label for="">Case or Bottle: <span><?=$item->caseOrBottle?></span></label>
                    </div>
                    <div class="">
                        <label for="">Quantity: <span><?=$item->quantity?></span></label>
                    </div>
                    <div class="">
                        <label for="">Delivery Date: <span><?=$item->deliveryDate?></span></label>
                    </div>
                    <div class="">
                        <label for="">Status: <span><?=$item->status?></span></label>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
