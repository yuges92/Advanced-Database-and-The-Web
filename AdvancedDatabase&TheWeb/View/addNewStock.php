<?php require_once('../Controller/manage.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>
    <title></title>
</head>

<body>
    <?php require_once('adminNavigation.php'); ?>

    <div class="container-form" id="addNewWineStock">
        <form class="add-form" id="addNewWineStockForm" method="post">
            <div class="container-row">
                <label for="">Centre</label><select class="" name="distributionCentre">
              <?php foreach ($centres as $centre): ?>
                  <option value="<?=$centre->centreID?>"><?=$centre->centreID?></option>
              <?php endforeach; ?>
              </select>
            </div>
            <div class="container-row">
                <label for="">Wine</label>
                <select class="" name="wineStock">
                  <?php foreach ($wines as $wine): ?>
                      <option value="<?=$wine->wineID?>"><?=$wine->wineID?></option>
                  <?php endforeach; ?>
                  </select>
            </div>
            <div class="container-row">
                <label for="">Quantity </label>
                <input type="number" name="stockQuantity" min="0" required>
            </div>
            <div class="container-row">
                <input type="submit" name='addStock' value="Add Stock">
            </div>
        </form>
    </div>
</body>

</html>
