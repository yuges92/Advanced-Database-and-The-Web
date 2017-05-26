<?php require_once('../Controller/manageAdmin.php'); ?>
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
  <form class="add-form" name="addAdminForm" id="addAdminForm" action="manageAdmin.php" method="post">
    <div class="container-row">
      <label for="">Username</label>
      <input type="text" name="username" required placeholder="Username">
    </div>
    <div class="container-row">
      <label for="">Firstname</label>
      <input type="text" name="firstname" required placeholder="Firstname">
    </div>
    <div class="container-row">
      <label for="">Lastname</label>
      <input type="text" name="lastname" required placeholder="Lastname">
    </div>
    <div class="container-row">
      <label for="">Email</label>
      <input type="email" name="email" required placeholder="Email">
    </div>
    <div class="container-row">
        <input type="submit"  value="Add Admin">
    </div>

  </form>
</div>

<div class="container-form">
  <form class="add-form" action="" id="changePassword" method="post">
    <div class="container-row">
  <label for="">Enter Old Password</label>
  <input type="password" name="oldPassword" placeholder="Old Password">
    </div>
    <div class="container-row">
    <label for="">Enter New Password</label>
    <input type="password" name="newPassword" placeholder="New Password">
      </div>
      <div class="container-row">
      <label for="">Confirm Old Password</label>
      <input type="password" name="confirmPassword" placeholder="Confirm Password">
        </div>
        <div class="container-row">
            <input type="submit" value="Change Password">
        </div>

  </form>
  </div>
<footer>
</footer>
</body>
</html>
