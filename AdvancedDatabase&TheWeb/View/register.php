<?php require_once('../Controller/register.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../contents/styleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../contents/myScript.js"></script>

    <title>Register New Account</title>
</head>

<body>
    <?php require 'banner.php';
    require 'navigation.php'; ?>

    <form name 'registerForm' id="registerForm" class="registerForm" action="../Controller/register.php" method="post">
        <h1>Please Enter your details</h1>

        <label for="firstname">Firstname: </label>
        <input type="text" name="firstname" id="firstname" required placeholder="Firstname"><span id="firstnameFeedback"></span>
        <label for="lastname">Lastname: </label>
        <input type="text" name="lastname" id="lastname" required placeholder="Lastname">
        <label for="dob">DOB: </label>
        <input type="date" name="dob" value="" id="dob" required>
        <label for="gender">Gender: </label>
        <select name="gender" id="gender" required>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required placeholder="Username"><span id="usernameFeed"></span>
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required placeholder="Password">
        <label for="confirmPassword">Confirm Password: </label>
        <input type="password" id="confirmPassword" required placeholder="Confirm Password"><span id="confirmMatchPassword"></span>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required placeholder="Email"><span id="emailFeed"></span>

        <label for="firstLineAddress">First Line Of Address: </label>
        <input type="text" name="firstLineAddress" value="" id="firstLineAddress" required placeholder="First Line of Address"><span id=""></span>
        <label for="town">Town: </label>
        <input type="text" name="town" value="" id="town" required placeholder="Town"><span id=""></span>
        <label for="postcode">Postcode: </label>
        <input type="text" name="postcode" id="postcode" required placeholder="Postcode"><span id=""></span>
        <label for="region">Region/County</label>
        <input id="region" type="text" name="region" required placeholder="Region/County"><span id=""></span>
        <label for="phoneNo">Phone Number: <span>(Optional)</span></label>
        <input type="text" name="phoneNo" id="phoneNo" placeholder="Phone Number">
        <span id="error"></span>
        <input type="submit" name="register" value="Create Account">
        <input type="reset" value="Reset">

    </form>
</body>

</html>
