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

    <div class="manage-wines">
        <div class="">
            <a class="button" href="addPromotion.php">Add Promotions</a>
        </div>

        <table class="table-wines">
            <tr>
                <th>Promotion ID</th>
                <th>Promotion Type</th>
                <th>Wine ID</th>
                <th>Valid From Date</th>
                <th>Valid Until Date</th>
                <th></th>

            </tr>
            <?php foreach ($winePromotionList as $winePromotion):
              $promoType=getPromoTypeByID($winePromotion->promotionID);
              ?>
            <tr id="wineRow<?=$winePromotion->wineID?>">
                <td><?=$winePromotion->promotionID?></td>
                <td><?=$promoType->promoType?></td>
                <td><?=$winePromotion->wineID?></td>
                <td><?=$winePromotion->validFrom?></td>
                <td><?=$winePromotion->validUntil?></td>
                <td><a href="" class="deleteBtn" id="<?=$wine->wineID?>" rel="" onclick=""> Delete</a></td>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
    <footer>
    </footer>
</body>

</html>
