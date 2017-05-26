<?php
require_once('../Model/dbConn.php');
if (!isset($_GET['search'])) {
    $wines=getAllWines();
    $wineTypes=getAllWineTypes();
    //$stocks=getStock();


    header('../View/wines.php');
} else {
    if ($_GET['search']=='wine'||$_GET['search']=='wines') {
        $wines=getAllWines();
    } elseif ($_GET['search']=='newArrival') {
        $wines=searchWine('Yes');
    } else {
        $wines=searchWine($_GET['search']);
    }
}
