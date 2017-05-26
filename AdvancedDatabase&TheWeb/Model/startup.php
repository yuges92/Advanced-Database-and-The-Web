<?php

require_once("User.php");
require_once("Admin.php");
require_once("Customer.php");
require_once("CustomerOrder.php");
require_once("DistributionCentre.php");
require_once("OrderItem.php");
require_once("Promotion.php");
require_once("ShoppingBasket.php");
require_once("Stock.php");
require_once("Wine.php");
require_once("WinePromotion.php");
require_once("WineType.php");
require_once("WishList.php");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
 ?>
