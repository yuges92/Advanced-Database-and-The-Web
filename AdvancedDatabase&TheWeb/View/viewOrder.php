<?php require_once('../Controller/checkout.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>
      <title>Check out</title>
  </head>
  <body>

    <?php require_once 'navigation.php'; ?>
<section class="section">
<h1>  Order Summary</h1>
  <h3>Order Items</h3>

<?php foreach ($customerBasket as $list ):
  $wine=getWineByID($list->wineID); ?>
  <section class=" orderItem">
  <label for="">Wine ID: <?=$wine->wineID?></label>
  <label for="">Wine Description: <?=$wine->description?></label>
  <label for="">Case or Bottle: <?= $list->caseOrBottle?></label>
  <label for="">Quantity: <?= $list->quantity?></label>
  <?php if($list->caseOrBottle=='Case'){
    $wineCost=$wine->costPerCase;
  }else {
    $wineCost=$wine->costPerBottle;
  }
   ?>
  <label for="">price: <?= $wineCost?></label>
</section>
<?php endforeach; ?>

  <label for="">Subtotal:</label> <?=$subTotal?>
  <label for="">Delivery Charge:</label> <?=$deliveryCharge?>
  <label for="">Total:</label> <?=$total?>
  <a href="shoppingBasket.php">Edit Shopping Basket</a>
</section>


<form name="newDeliveryAddressForm" class="section" action="../Controller/checkout.php" method="post">
<section class="section" >
  <h2>Delivery Address</h2>
Choose Delivery Address
<label for="">Current Address</label>
  <input type="radio" name="deliveryAddress" id="currentAddressRadio" value="currentAddress" checked="true" required><label for="currentAddressRadio"><?=$currentAddress?></label>

<a href="#" id="newDeliveryAddressBtn"  onclick="showNewDeliveryAddress();">New Address</a>
<section id="newDeliveryAddress" class="">
  <input type="radio" name="deliveryAddress" id="newAddressRadio" value="newDeliveryAddress">
  <h3>New Delivery Address</h3>
    <label for="deliveryfirstLineAddress">First Line Of Address: </label>
    <input type="text" name="deliveryFirstLineAddress" id="deliveryfirstLineAddress" placeholder="First Line of Address">
    <label for="deliveryTown">Town: </label>
    <input type="text" name="deliveryTown" value="" id="deliveryTown"  placeholder="Town">
    <label for="deliveryPostcode">Postcode: </label>
    <input type="text" name="deliveyPostcode" id="deliveryPostcode"  placeholder="Postcode">
</section>
</section>
<section class="section">
  Choose your delivery date:
  <input type="date" name="" value="">
  Delivery charge
</section>

<input type="submit" value="Confirm Order" name="confirmOrder">
</form>

  </body>
</html>
