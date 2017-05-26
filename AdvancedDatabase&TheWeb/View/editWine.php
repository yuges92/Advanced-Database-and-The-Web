<?php require_once('../Controller/editWine.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>
    <title>Edit New Wine</title>
</head>

<body>
    <?php require_once('adminNavigation.php'); ?>
<div class="container-form">


    <form class="add-form" action="../Controller/editWine.php" method="post">
  <input type="text" name="wineID" value="<?=$wine->wineID ?>" hidden="hidden">
      <div class="container-row">
        <label for="wineTypeID">WineType ID</label>
        <select class="" name="wineTypeID" id="wineTypeID" required>
      <option></option>
      <?php foreach ($wineTypes as $wineType): ?>
        <option value="<?= $wineType->wineTypeID?>"
        <?= $wineType->wineTypeID==$wine->wineTypeID ? "selected='selected'" : ""; ?> > <?= $wineType->wineTypeID?> </option>
      <?php endforeach; ?>
      </select>
      </div>
      <div class="container-row">
        <label for="">Country</label>
        <input type="text" name="country" id="country" value="<?= $wine->country?>" disabled="">

      </div>

      <div class="container-row">
        <label for="">Colour</label>
        <input type="text" name="colour" id="colour" value="<?= $wine->colour?>" disabled="">
      </div>
      <div class="container-row">
        <label for="">New Arrival</label>
        <input type="text" name="newArrival" id="newArrival" value="<?= $wine->newArrival?>" disabled="">
      </div>
      <div class="container-row">
        <label for="rating">Rating</label>
        <select class="" name="rating" id="rating" required>
    <option></option>
    <option value="Dry" <?= $wine->rating=='dry' ? "selected='selected'" : ""; ?>>Dry</option>
    <option value="Sweet" <?= $wine->rating=='sweet' ? "selected='selected'" : ""; ?>>Sweet</option>
    <option value="Light" <?= $wine->rating=='light'? "selected='selected'" : ""; ?>>Light</option>
    <option value="Full-Bodied" <?= $wine->rating=='full-bodied' ? "selected='selected'" : ""; ?>>Full-Bodied</option>
  </select>
      </div>
      <div class="container-row">
        <label for="description">Description</label>
        <textarea name="description" rows="5" cols="40" required id="description"><?= $wine->description?></textarea>

      </div>
      <div class="container-row">
        <label for="bottleSize">BottleSize</label>
        <select class="bottleSize" name="bottleSize" id="bottleSize" required>
      <option></option>
      <option value="20cl" <?= $wine->bottleSize=='20cl' ? "selected='selected'" : ""; ?>>20cl</option>
      <option value="35cl" <?= $wine->bottleSize=='35cl' ? "selected='selected'" : ""; ?>>35cl</option>
      <option value="50cl" <?= $wine->bottleSize=='50cl' ? "selected='selected'" : ""; ?>>50cl</option>
      <option value="75cl" <?= $wine->bottleSize=='75cl' ? "selected='selected'" : ""; ?>>75cl</option>
      <option value="1.5l" <?= $wine->bottleSize=='1.5l' ? "selected='selected'" : ""; ?>>1.5l</option>
      <option value="3l" <?= $wine->bottleSize=='3l' ? "selected='selected'" : ""; ?>>3l</option>
      </select>

      </div>
      <div class="container-row">
        <label for="noOfBottleInACase">No of Bottle in a Case</label>
        <select class="" name="noOfBottleInACase" id="noOfBottleInACase" required>
      <option></option>
      <option value="6" <?= $wine->noOfBottleInACase=='6' ? "selected='selected'" : ""; ?>>6</option>
      <option value="12" <?= $wine->noOfBottleInACase=='12' ? "selected='selected'" : ""; ?>>12</option>
      </select>
      </div>
      <div class="container-row">
        <label for="">Cost Per Case</label>
        <input type="text" name="costPerCase" value="<?= $wine->costPerCase?>" required>

      </div>
      <div class="container-row">
        <label for="">Cost Per Bottle</label>
        <input type="text" name="costPerBottle" value="<?= $wine->costPerBottle?>" required>

      </div>
      <div class="container-row">
  <input type="submit" name="updateWine" value="Update Wine">
      </div>

    </form>
    </div>
</body>

</html>
