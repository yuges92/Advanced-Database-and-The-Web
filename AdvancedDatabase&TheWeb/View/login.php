<?php require_once("../Controller/login.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="../contents/myScript.js"></script>
  <title>Login</title>

</head>
<body>
<?php require 'banner.php';?>
<?php require 'navigation.php'; ?>

<div class="container-form">
  <form id="loginForm" class="loginForm" action="login.php" method="post">
        <h1>Login</h1>
    <div class="container-row">
      <label for="username">Username:</label>
      <input type="text" name="username" id="loginUsername" required placeholder="Username">
    </div>

    <div class="container-row">
      <label for="password" >Password:</label>
      <input type="password" name="password" id="loginPassword" required placeholder="Password">
    </div>

    <div class="container-row">
          <input type="submit" name="login" value="Login">
    </div>

    <div class="container-row">
          <span id="loginError"></span>
    </div>



  </form>
</div>


</body>
</html>
