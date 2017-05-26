<?php require_once('../Controller/wine.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>
    <title>Wine</title>
  </head>
  <body>
    <?php require_once'banner.php';?>
<?php require_once('navigation.php'); ?>



  <div class="container-form">

<form class="add-form" action="shoppingBasket.php" method="post">
  <div class="container-row">
    <img src="../images/default_image.png" class="banner-image">
  </div>

  <div class="container-row">
    <label for="">Description</label>
    <input type="text" name="<?= $wine->description ?>" value="<?= $wine->description ?>" readonly>
  </div>
  <div class="container-row">
    <label for="">Country</label>
<input type="text" name="<?= $wine->country?>" value="<?= $wine->country?>" readonly>
  </div>
  <div class="container-row">
    <label for="">Colour</label>
    <input type="text" name="<?= $wine->colour?>" value="<?= $wine->colour?>" readonly>
  </div>
  <div class="container-row">
    <label for="">New</label>
    <input type="text" name="<?= $wine->newArrival?>" value="<?= $wine->newArrival?>" readonly>

  </div>

  <div class="container-row">
    <label for="">Bottle Size</label>
    <input type="text" name="<?= $wine->bottleSize ?>" value="<?= $wine->bottleSize ?>" readonly>

  </div>
  <div class="container-row">
    <label for="">Rating</label>
    <input type="text" name="<?= $wine->rating ?>" value="<?= $wine->rating ?>" >

  </div>
  <div class="container-row">
    <label for="">No of bottle in a case</label>
    <input type="text" name="<?= $wine->noOfBottleInACase ?>" value="<?= $wine->noOfBottleInACase ?>" readonly>

  </div>
  <div class="container-row">
    <label for="">Cost per case</label>
    <input type="text" name="<?= $wine->costPerCase?>" value="<?= $wine->costPerCase?>" readonly>

  </div>
  <div class="container-row">
    <label for="">Cost per bottle</label>
    <input type="text" name="<?= $wine->costPerBottle?>" value="<?= $wine->costPerBottle?>" readonly>

  </div>

    <input type="text" name="wineID" value="<?= $wine->wineID?>" hidden>

  <div class="container-row">
    <label for="">Choose :Bottle or Case</label>
    <select class="" name="caseOrBottle">
      <option value="Bottle">Bottle</option>
      <option value="Case">Case</option>
    </select>
  </div>
  <div class="container-row">
    <label for="">Quantity</label>
    <input type="number" name="quantity" min="1" value='1' >
  </div>
  <div class="container-row">
      <input type="submit" name="addToShoppingBasket" value="Add to Basket">
  </div>




</form>
</div>
  </body>
</html>
