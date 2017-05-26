<?php require_once('../Controller/shoppingBasket.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../contents/myScript.js"></script>
  <title>Shopping Basket</title>
</head>
<body>
<?php
require_once 'banner.php';
require_once('navigation.php');
require_once 'search.php';?>

<span id="shoppingBasketFeedback" ></span>


<div class="shoppingList-container">
  <?php foreach ($shoppingBasketList as $list):
    $wine=getWineByID($list->wineID);
    if ($list->caseOrBottle=='Bottle') {
        $wineCost=$wine->costPerBottle;
    } else {
        $wineCost=$wine->costPerCase;
    }?>

      <div class="shoppingBasketList" id="divCaseOrBottle<?= $wine->wineID?>">
        <div class="list">
        <div class="">
          <span>Description: </span><?= $wine->description ?>
        </div>
        <div class="">
          <span>Country: </span><?= $wine->country ?>
        </div>
        <div class="">
          <span>Colour: </span><?= $wine->colour ?>
        </div>
        <div class="">
          <span>Bottle Size: </span><?= $wine->bottleSize ?>
        </div>
        <div class="">
          <span>Rating: </span><?= $wine->rating ?>
        </div>
        <div class="">
            <span>Case Or Bottle: </span><span id="caseOrBottle<?= $wine->wineID?>"><?= $list->caseOrBottle ?></span>
        </div>
        <div class="">
          <span>Price: </span><?=$wineCost ?>
        </div>

    </div>
    <div class="list-quantity">
      <input type="number" value="<?= $list->quantity ?>">
    </div>
    <div class="list-total">
        <span>£</span><?= $subTotal=$list->quantity*$wineCost?>
    </div>
      <?php $total+=$subTotal?>
      <div class="shoppingList-button">
  <td><a href="" class="deleteBtn " id="<?= $wine->wineID?>" onclick="deleteFromSB(this.id); return false;"> &#x2717</a></td>
</div>
</div>
  <?php endforeach; ?>
  <div class="shoppingBasket-total" id="totalCostLBLDiv" >
  <label id="totalCostLBL">Total:</label> <input type="text" value="<?=$total?>" id="totalCost" disabled>
  </div>
</div>

</body>
</html>
