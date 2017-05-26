<?php require_once('../Model/dbConn.php');
  $wines=searchWine('Yes');
  $promotions=getAllValidPromoTypes();
