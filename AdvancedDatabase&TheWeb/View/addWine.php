<?php
  require_once '../Controller/addWine.php';
 ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="../contents/myScript.js"></script>
        <title>Add New Wine</title>
    </head>
    <body>
        <?php require_once('adminNavigation.php'); ?>
        <?=$feedback?>
        <div class="container-form">
            <form class="add-form" action="../Controller/addWine.php" method="post">
                <div class="container-row">
                    <label for="wineTypeID">WineType ID</label>
                    <select class="" name="wineTypeID" id="wineTypeID" required>
                      <option></option>
          <?php foreach ($wineTypes as $wineType): ?>
                      <option value="<?= $wineType->wineTypeID?>"> <?= $wineType->wineTypeID?> </option>
          <?php endforeach; ?>
                  </select>
                </div>
                <div class="container-row">
                    <label for="">Country</label>
                    <input type="text" id="country" value="" readOnly>
                </div>

                <div class="container-row">
                    <label for="">Colour</label>
                    <input type="text" id="colour" value="" readOnly>
                </div>

                <div class="container-row">
                    <label for="">New Arrival</label>
                    <input type="text" id="newArrival" value="" readOnly>
                </div>

                <div class="container-row">
                    <label for="rating">Rating</label>
                    <select class="" name="rating" id="rating" required>
                      <option></option>
                      <option value="Dry">Dry</option>
                      <option value="Sweet">Sweet</option>
                      <option value="Light">Light</option>
                      <option value="Full-Bodied">Full-Bodied</option>
                    </select>

                </div>

                <div class="container-row">
                    <label for="">Description</label>
                    <textarea name="description" id="description" rows="5" cols="40" required></textarea>
                </div>

                <div class="container-row">
                    <label for="bottleSize">BottleSize</label>
                    <select class="bottleSize" name="bottleSize" id="bottleSize" required>
      <option></option>
      <option value="20cl">20cl</option>
      <option value="35cl">35cl</option>
      <option value="50cl">50cl</option>
      <option value="75cl">75cl</option>
      <option value="1.5cl">1.5l</option>
      <option value="3l">3l</option>
    </select>
                </div>

                <div class="container-row">
                    <label for="noOfBottleInACase">No of Bottle in a Case</label>
                    <select class="" name="noOfBottleInACase" id="noOfBottleInACase" required>
      <option></option>
      <option value="16">6</option>
      <option value="12">12</option>
    </select>
                </div>

                <div class="container-row">
                    <label for="">Cost Per Case</label>
                    <input type="number" name="costPerCase" value="" step="0.01" min="0"required>
                </div>

                <div class="container-row">
                    <label for="">Cost Per Bottle</label>
                    <input type="number" name="costPerBottle" value="" step="0.01" min="0" required>
                </div>

                <div class="container-row">
                    <input type="submit" name="addWine" value="Add Wine">
                </div>


            </form>

        </div>

    </body>

    </html>
