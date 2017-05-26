<?php require_once('../Controller/navigation.php'); ?>
<nav>
<ul>
<li><a href="../index.php">TenGB</a></li>

<li class="dropDown">
    <a href="wines.php">Wines</a>

</li>


<li><a href="wishList.php">Wish List</a></li>
<li><a href="shoppingBasket.php">Shopping Basket</a></li>
<li><a href="orderHistory.php">Order History</a></li>



<div class="rightAlignBtn">
  <li><a id="checkoutBtn" href="checkout.php">Checkout</a></li>
  <li><a  id="registerBtn" href="register.php" >Register</a></li>
  <li><a  id="loginBtn" href="login.php" >Login</a></li>
  <li><a id="logoutBtn" href="../Controller/logout.php">LogOut</a></li>

</div>

  </ul>

</nav>
