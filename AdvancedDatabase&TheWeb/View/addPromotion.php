<?php require_once('../Controller/managePromotions.php'); ?>
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
    <div class="container-form">
      <form class="add-form" name="addPromotionTypeForm" id="addPromotionTypeForm" action="managePromotions.php" method="post">

        <div class="container-row">
          <label for="">Promotion ID</label>
          <select id="promotionID" class="" name="promotionID" required>
            <option value=""></option>
            <?php foreach ($promoTypes as $type):?>
            <option value="<?=$type->promotionID?>"><?=$type->promotionID?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="container-row">
          <label for="">Promotion Type</label>
          <input id="promoType" type="text" name="promotionType" placeholder="Promotion Type" readonly>
        </div>

        <div class="container-row">
          <label for="">Wine ID</label>
          <select class="" name="wineID" required>
            <option value=""></option>
            <?php foreach ($wines as $wine):?>
            <option value="<?=$wine->wineID?>"><?=$wine->wineID?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="container-row">
          <label for="">Valid From Date</label>
          <input type="Date" min="<?=date("Y-m-d");?>" name="validFrom" required>
        </div>

        <div class="container-row">
          <label for="">Valid Until Date</label>
          <input type="Date" min="<?=date("Y-m-d");?>" name="validUntil" required>
        </div>

        <div class="container-row">
            <input type="submit"  value="Add Admin">
        </div>
      </form>
    </div>
    <footer>
    </footer>
</body>

</html>
