<?php require_once("../Model/dbConn.php");?>
<?php require_once('../Controller/index.php'); ?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>

    <title>Welcome to 10 Green Bottle</title>
</head>

<body>
    <?php
    require 'banner.php';
    require_once 'navigation.php';
    require_once 'search.php';
    //require_once 'categories.php';?>

<div class=" container-main">


<div class="promotion-container container-main-row1" >
  <h1>Our Latest Promotions</h1>
  <div class="promotion-content">
    <div class="promo">
  <span class="promoHead">FREE Delivery</span>
  <span class="">For purchases over £100</span>


    </div>
<?php foreach ($promotions as $promo): ?>
  <div class="promo" onclick="location.href='wines.php?search=<?= getWineByID($promo->wineID)->description ?>'">
<span class="promoHead"><?= getPromoTypeByID($promo->promotionID)->promoType; ?></span>
<span class="">Wine ID: <?= $promo->wineID ?></span>
<span class=""><?= getWineByID($promo->wineID)->description ?></span>
<span class="">Valid From: <?= $promo->validFrom ?></span>
<span class="">Valid Until: <?= $promo->validUntil ?></span>

  </div>
<?php endforeach; ?>
  </div>
</div>
<div class="container-main-row2">


        <h1>New Arrivals </h1>
        <div class="wine-container">

            <?php foreach ($wines as $wine): ?>
            <div class="wine-items">
                <div class="wineType">
                    <div class="wine-desc-desc row">
                        <span class=" title col1">Description: </span>
                        <span class="col2"><a href="wine.php?wineID=<?= $wine->wineID?> "><?= $wine->description ?></a></span>
                    </div>

                    <div class=" row">
                        <span class=" title col1">Country: </span>
                        <span class="col2"><?= $wine->country?></span>

                    </div>
                    <div class=" row">
                        <span class=" title col1">Colour: </span>
                        <span class="col2"><?= $wine->colour?></span>

                    </div>
                </div>

                <div class="wine-desc">
                    <div class="row">
                        <span class="title col1">New Arrival : </span>
                        <span class="col2"><?= $wine->newArrival?></span>
                    </div>
                    <div class="row">
                        <span class="title col1">Bottle Size: </span>
                        <span class="col2"><?= $wine->bottleSize ?></span>

                    </div>

                    <div class="row">
                        <span class="title col1">Rating: </span>
                        <span class="col2"><?= $wine->rating ?></span>

                    </div>

                    <div class="row">
                        <span class="title col1">No Of Bottle In a Case: </span>
                        <span class="col2"><?= $wine->noOfBottleInACase ?></span>

                    </div>

                    <div class="row">
                        <span class="title col1">Cost Per Case: </span>
                        <span class="col2">£<?= $wine->costPerCase?></span>

                    </div>

                    <div class="row">
                        <span class="title col1">Cost Per Bottle: </span>
                        <span class="col2">£<?= $wine->costPerBottle?></span>

                    </div>

                    <div class="row">
                        <?php $availability=getWineQuantity($wine->wineID);?>
                        <input type="text" name="availability<?=$wine->wineID?>" value="<?=$availability?>" hidden="">

                        <input type="text" name="noOfBottleInACase<?=$wine->wineID?>" value="<?= $wine->noOfBottleInACase ?>" hidden="">
                        <span class="title col1">Available: </span>
                        <span class="col2">  <?=$availability>0 ? $availability : 'not available';?></span>
                    </div>
                    <div class="row">
                        <span class="title col1">Case or Bottle: </span>
                        <select class="col2" name="caseOrBottle<?= $wine->wineID?>">
                       <option value="Bottle">Bottle</option>
                       <option value="Case">Case</option>
                     </select>

                    </div>

                    <div class="row">
                        <span class="title col1">Quantity: </span>
                        <input class="col2" type="number" name="quantity<?= $wine->wineID?>" min="1">
                    </div>
                    <div class="row">
                        <img src="../images/default_image.png" class="wine-image">
                    </div>

                    <div class="row">
                        <a class="button" href="" id="<?=$wine->wineID?>" name="addToShoppingBasket" rel="<?=$wine->wineID?>" onclick="addToShoppingBasket(this.id);return false;">Add to Basket</a>
                    </div>
                    <div class="row">
                      <a class="button" href="" name="addToWishList" rel="<?=$wine->wineID?>" onclick="addToWishList(rel);return false;">Add to Wish List</a>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        </div>
</div>
        <footer>All rigths reserved </footer>

</body>

</html>
