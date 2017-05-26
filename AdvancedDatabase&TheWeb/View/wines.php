<?php require_once('../Controller/wines.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>
    <title>Welcome to 10 Green Bottle</title>
</head>

<body>
    <?php require_once 'banner.php';?>
    <?php  require_once 'navigation.php';?>
    <?php require_once 'search.php';?>

<h1>Wine List</h1>

<div class="wineListContainer">
  <div class="row1">
    <h3>Categories</h3>
    <?php require_once 'categories.php';?>
  </div>

     <div class="row2 wine-container">
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
</body>

</html>
