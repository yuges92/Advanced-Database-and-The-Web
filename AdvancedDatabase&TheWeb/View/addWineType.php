<?php require_once('../Controller/addWineType.php'); ?><!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../contents/myScript.js"></script>
  <title>Add Wine Type</title>
</head>
<body>

  <?php require_once('adminNavigation.php'); ?>

<div class="container-form">
  <form class="add-form" action="../Controller/addWineType.php" method="post">
      <div class="container-row">
        <label for="country">Country</label>
        <input type="text" name="country" required id="country">
        </div>
        <div class="container-row">
          <label for="colour">Colour</label>
          <select class="" name="colour" required id="colour">
            <option></option>
            <option value="Red">Red</option>
            <option value="White">White</option>
            <option value="Rose">Rose</option>
          </select>
          </div>
          <div class="container-row">
              <label for="newArrival" required >New</label>
              <div class="">
                <input type="radio" name="newArrival" value="Yes" required id="newArrival">Yes
                <input type="radio" name="newArrival" value="No">No
              </div>
            </div>

            <div class="container-row">
              <input type="Submit" name="" value="Submit">

              </div>




  </form>
</div>


</body>
</html>
