<?php require_once('../Controller/manage.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../contents/myScript.js"></script>
  <title>Manage Wines</title>
</head>
<body>
  <?php require_once 'adminNavigation.php'; ?>
<div class="manage-wines">
  <span id="feedbackForWine"><?=$feedbackForWine ?></span>
  <div class="">
      <a class="button" href="addWine.php">Add New Wine</a>
  </div>

    <table class="table-wines">
      <tr>
        <th>Wine ID</th>
        <th>Country</th>
        <th>Colour</th>
        <th>New</th>
        <th>Description</th>
        <th>Bottle Size</th>
        <th>Rating</th>
        <th>No Of Bottle In a Case</th>
        <th>Cost Per Case</th>
        <th>Cost Per Bottle</th>
        <th>Quantity</th>
        <th></th>
      </tr>
        <?php foreach ($wines as $wine): ?>
      <tr id="wineRow<?=$wine->wineID?>">
        <td><?= $wine->wineID?></td>
        <td><?= $wine->country?></td>
        <td><?= $wine->colour?></td>
        <td><?= $wine->newArrival?></td>
        <td><?= $wine->description ?></td>
        <td> <?= $wine->bottleSize ?></td>
        <td> <?= $wine->rating ?></td>
        <td><?= $wine->noOfBottleInACase ?></td>
        <td><?= $wine->costPerCase?></td>
        <td><?= $wine->costPerBottle?></td>
        <td><?= $wine->costPerBottle?></td>

        <td><a class="button" name="editWineBtn" href="editWine.php?wineID=<?= $wine->wineID?>"> edit</a>
        <td><a href="" class="deleteBtn" id="<?=$wine->wineID?>" rel=""onclick="deleteWine(this.id);return false"> Delete</a></td></td>

      </tr>
  <?php endforeach ?>
    </table>
</div>

<div class="manage-wines">
  <span id="feedbackForWineType"><?=$feedbackForWineType ?></span>

<div class="">
  <a  class="button" href="addWineType.php">Add New Wine Type</a>
</div>

<table>
<th>WineTypeID</th>
<th>Country</th>
<th>Colour</th>
<th>New Arrival</th>
<th></th>
  <?php foreach ($wineTypes as $type): ?>
<tr id="wineTypeRow<?=$type->wineTypeID?>">
    <td><?=$type->wineTypeID?></td>
    <td><?=$type->country?></td>
    <td><?=$type->colour?></td>
    <td><?=$type->newArrival?></td>
    <td><a href="" class="deleteBtn" id="<?=$type->wineTypeID?>" onclick="deleteWineType(this.id);return false"> Delete</a></td>
</tr>
<?php endforeach; ?>
</table>

</div>

<div class="manage-wines">
  <div class="">
      <a class="button" href="addNewStock.php">Add New Stock</a>
  </div>

  <table>
    <tr>
      <th>Distribution Centre</th>
      <th>Wine</th>
      <th>quantity</th>
      <th></th>
    </tr>
    <?php foreach ($stocks as $stock): ?>
      <tr>
        <td id="stockCentreIDwineID<?=$stock->wineID.'centreID'.$stock->centreID?>"><?=$stock->centreID?></td>
        <td id="stockWineIDwineID<?=$stock->wineID.'centreID'.$stock->centreID?>"><?=$stock->wineID?></td>
        <td contenteditable id="stockQuantityIDwineID<?=$stock->wineID.'centreID'.$stock->centreID?>"><?=$stock->quantity?></td>
        <td><a class="button" id="wineID<?=$stock->wineID.'centreID'.$stock->centreID?>" href="" onclick="updateWineStock(this.id);return false"> update Stock</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>


<footer>
</footer>
</body>
</html>
