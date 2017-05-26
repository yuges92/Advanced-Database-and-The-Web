<?php
require_once('../Model/dbConn.php');

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->userType=='Customer') {
        $customer=getCustomerByUserID($_SESSION['user']->userID);
        $customerOrders=getOrder($customer->customerID);
        //$orderItems=getOrderItems($customerOrder[0]->orderID);
    } else {
        header('location: ../index.php');
    }
} else {
    header('location: ../View/login.php');
}
