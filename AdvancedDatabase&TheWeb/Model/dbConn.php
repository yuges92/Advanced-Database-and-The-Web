<?php
error_reporting(0);
require_once('startup.php');
$host="kunet";
$dbname="db_k1321984";
$dbUsername="k1321984";
$dbPassword="myPassword";
try {
    $pdo= new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
} catch (Exception $e) {
    echo "Connection failed";
}

function getAllWines()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT *
                            FROM `Wine`
                            INNER JOIN WineType ON Wine.wineTypeID=WineType.wineTypeID');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'Wine');
    return $result;
}

function getWineByID($id)
{
    global $pdo;
    $statement=$pdo->prepare("SELECT *
                            FROM `Wine`
                            INNER JOIN WineType ON Wine.wineTypeID=WineType.wineTypeID
                            WHERE wineID = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'Wine');
    $result=$statement->fetch();
    return $result;
}

function getWineTypeByID($id)
{
    global $pdo;
    $statement=$pdo->prepare("SELECT * FROM WineType WHERE wineTypeID = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_CLASS, 'WineType');
    $result=$statement->fetch();
    return ($result);
}

function getWineTypesByIDJson($id)
{
    $result=getWineTypeByID($id);
    return json_encode($result);
}

function getAllWineTypes()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `WineType`');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'WineType');
    return $result;
}


function searchWine($search)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT *
                            FROM Wine
                            INNER JOIN WineType ON Wine.wineTypeID=WineType.wineTypeID
                            WHERE WineType.country=:search OR WineType.colour=:search OR WineType.newArrival=:search OR Wine.rating=:search OR Wine.description LIKE "%":search "%"');
    $statement->bindParam(':search', $search);
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'Wine');
    return $result;
}



function addToShoppingBasket($list)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO ShoppingBasket (`wineID`, `customerID`, `caseOrBottle`, `quantity`)
  VALUES (:wineID,:customerID,:caseOrBottle,:quantity)');
    $statement->bindParam(':wineID', $list->wineID);
    $statement->bindParam(':customerID', $list->customerID);
    $statement->bindParam(':caseOrBottle', $list->caseOrBottle);
    $statement->bindParam(':quantity', $list->quantity);
    $result= $statement->execute();
    return $result;
}



function getShoppingBasket($customerID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `ShoppingBasket` WHERE customerID=:customerID');
    $statement->bindParam(':customerID', $customerID);
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'ShoppingBasket');
    return $result;
}


function deleteSBRow($shoppingBasket)
{
    global $pdo;
    $statement=$pdo->prepare('DELETE FROM `ShoppingBasket` WHERE customerID=:customerID AND wineID=:wineID AND caseOrBottle=:caseOrBottle');
    $statement->bindParam(':customerID', $shoppingBasket->customerID);
    $statement->bindParam(':wineID', $shoppingBasket->wineID);
    $statement->bindParam(':caseOrBottle', $shoppingBasket->caseOrBottle);
    $statement->execute();
    $statement->fetch();
    return $statement;
}

function deleteSBByCID($customerID)
{
    global $pdo;
    $statement=$pdo->prepare('DELETE FROM `ShoppingBasket` WHERE customerID=:customerID');
    $statement->bindParam(':customerID', $customerID);
    $statement->execute();
    $result=$statement->fetch();
    return $result;
}
//use the return value to assign to the items orderID
function addOrder($customerOrder)
{
    global $pdo;
    $statement =$pdo->prepare('INSERT INTO `CustomerOrder`(customerID,`total`, `deliveryCharge`, `deliveryAddressFirstLine`, `town`, `postcode`,region)
  VALUES (:customerID,:total,:deliveryCharge,:deliveryAddressFirstLine,:town,:postcode,:region)');
    $statement->bindParam(':customerID', $customerOrder->customerID);
//  $statement->bindParam(':orderDate',$orderItems->orderDate);
  $statement->bindParam(':total', $customerOrder->total);
    $statement->bindParam(':deliveryCharge', $customerOrder->deliveryCharge);
    $statement->bindParam(':deliveryAddressFirstLine', $customerOrder->deliveryAddressFirstLine);
    $statement->bindParam(':town', $customerOrder->town);
    $statement->bindParam(':postcode', $customerOrder->postcode);
    $statement->bindParam(':region', $customerOrder->region);
    $result=$statement->execute();
    $lastID=$pdo->lastInsertId();
    if ($result) {
        return  $lastID;
    } else {
        return false;
    }
}


function addOrderItem($orderItem)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO `OrderItem`(`orderID`, `wineID`, `caseOrBottle`,quantity, `cost`, `deliveryDate`, `status`)
  VALUES (:orderID,:wineID,:caseOrBottle,:quantity,:cost,:deliveryDate,:status)');
    $statement->bindParam(':orderID', $orderItem->orderID);
    $statement->bindParam(':wineID', $orderItem->wineID);
    $statement->bindParam(':caseOrBottle', $orderItem->caseOrBottle);
    $statement->bindParam(':quantity', $orderItem->quantity);
    $statement->bindParam(':cost', $orderItem->cost);
    $statement->bindParam(':deliveryDate', $orderItem->deliveryDate);
    $statement->bindParam(':status', $orderItem->status);
    $result=$statement->execute();
    $statement->fetch();
    return $result;
}


function getOrder($customerID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `CustomerOrder` WHERE customerID=:customerID');
    $statement->bindParam(':customerID', $customerID);
    $statement->execute();
    $order=$statement->fetchAll(PDO::FETCH_CLASS, 'CustomerOrder');
    return $order;
}

function getOrderItems($orderID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `OrderItem` WHERE orderID=:orderID');
    $statement->bindParam(':orderID', $orderID);
    $statement->execute();
    $orderItems=$statement->fetchAll(PDO::FETCH_CLASS, 'OrderItem');
    return $orderItems;
}

function checkWineTypeExist($wineType)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM WineType WHERE country=:country AND colour=:colour');
    $statement->bindParam(':country', $wineType->country);
    $statement->bindParam(':colour', $wineType->colour);
    $statement->execute();
    $count=$statement->rowCount();
    if ($count==0) {
        return true;
    } else {
        return false;
    }
}

function addWineType($wineType)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO `WineType`(`country`, `colour`, `newArrival`)
  VALUES (:country,:colour,:newArrival)');
    $statement->bindParam(':country', $wineType->country);
    $statement->bindParam(':colour', $wineType->colour);
    $statement->bindParam(':newArrival', $wineType->newArrival);
    $result=  $statement->execute();
    return $result;
}

function getCountries()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT DISTINCT country FROM `WineType`');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function countWines()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT COUNT(*) FROM `Wine');
    $statement->execute();
    $count=$statement->fetchColumn();
    return $count;
}

function addWine($wine)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO `Wine`(`wineTypeID`, `description`, `bottleSize`, `rating`, `noOfBottleInACase`, `costPerCase`, `costPerBottle`)
  VALUES (:wineTypeID,:description,:bottleSize,:rating,:noOfBottleInACase,:costPerCase,:costPerBottle)');
    $statement->bindParam(':wineTypeID', $wine->wineTypeID);
    $statement->bindParam(':description', $wine->description);
    $statement->bindParam(':bottleSize', $wine->bottleSize);
    $statement->bindParam(':rating', $wine->rating);
    $statement->bindParam(':noOfBottleInACase', $wine->noOfBottleInACase);
    $statement->bindParam(':costPerCase', $wine->costPerCase);
    $statement->bindParam(':costPerBottle', $wine->costPerBottle);
    $result=$statement->execute();
    return $result;
}

function updateWine($wine)
{
    global $pdo;
    $statement=$pdo->prepare('UPDATE `Wine`
    SET `wineTypeID`=:wineTypeID,`description`=:description,
        `bottleSize`=:bottleSize,`rating`=:rating,`noOfBottleInACase`=:noOfBottleInACase,
        `costPerCase`=:costPerCase,`costPerBottle`=:costPerBottle
    WHERE wineID=:wineID');
    $statement->bindParam(':wineID', $wine->wineID);
    $statement->bindParam(':wineTypeID', $wine->wineTypeID);
    $statement->bindParam(':description', $wine->description);
    $statement->bindParam(':bottleSize', $wine->bottleSize);
    $statement->bindParam(':rating', $wine->rating);
    $statement->bindParam(':noOfBottleInACase', $wine->noOfBottleInACase);
    $statement->bindParam(':costPerCase', $wine->costPerCase);
    $statement->bindParam(':costPerBottle', $wine->costPerBottle);
    $statement->execute();
    $statement->fetch();
}
//UPDATE `Stock` SET `quantity`=50 WHERE wineID=1 AND centreID=1

function updateWineStock($stock)
{
    global $pdo;
    $statement=$pdo->prepare('UPDATE `Stock` SET `quantity`=:quantity WHERE wineID=:wineID AND centreID=:centreID');
    $statement->bindParam(':quantity', $stock->quantity);
    $statement->bindParam(':wineID', $stock->wineID);
    $statement->bindParam(':centreID', $stock->centreID);
    $result=$statement->execute();
    return $result;
}

function addStock($stock)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO `Stock`(`wineID`, `centreID`, `quantity`)
                            VALUES (:wineID,:centreID,:quantity)');
    $statement->bindParam(':wineID', $stock->wineID);
    $statement->bindParam(':centreID', $stock->centreID);
    $statement->bindParam(':quantity', $stock->quantity);
    $result=$statement->execute();
    return $result;
}

function getStock()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM Stock');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'Stock');
    return $result;
}

function getStockByWineID($wineID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM Stock WHERE wineID=:wineID');
    $statement->bindParam(':wineID', $wineID);
    $statement->execute();
    $result=$statement->setFetchMode(PDO::FETCH_CLASS, 'Stock');
    $result=$statement->fetch();
    return $result;
}

function getStockByWIDAndCID($stock)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM Stock WHERE wineID=:wineID AND centreID=:centreID');
    $statement->bindParam(':wineID', $stock->wineID);
    $statement->bindParam(':centreID', $stock->centreID);
    $statement->execute();
    $result=$statement->setFetchMode(PDO::FETCH_CLASS, 'Stock');
    $result=$statement->fetch();
    return $result;
}

function getWineQuantity($wineID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT SUM(quantity) AS quantity FROM `Stock` WHERE wineID=:wineID');
    $statement->bindParam(':wineID', $wineID);
    $statement->execute();
    $result=$statement->fetchColumn();
    return $result;
}


function getAllCentres()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `DistributionCentre`');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'DistributionCentre');
    return $result;
}

function getCentreByRegion($region)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `DistributionCentre` WHERE region=:region');
    $statement->bindParam(':region', $region);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'DistributionCentre');
    $result=$statement->fetch();
    return $result;
}


function deleteWine($wineID)
{
    global $pdo;
    $statement=$pdo->prepare('DELETE FROM `Wine` WHERE wineID=:wineID');
    $statement->bindParam(':wineID', $wineID);
    $result=$statement->execute();
    return $result;
}

function deleteWineType($wineTypeID)
{
    global $pdo;
    $statement=$pdo->prepare('DELETE FROM `WineType` WHERE wineTypeID=:wineTypeID');
    $statement->bindParam(':wineTypeID', $wineTypeID);
    $result=$statement->execute();
    return $result;
}

function addCustomer($customer)
{
    global $pdo;
    $added=addUser($customer);
    if ($added) {
        $user=getUserByUsername($customer->username);
        $statement=$pdo->prepare('INSERT INTO `Customer`( `userID`, `firstname`, `lastname`, `dob`, `firstLineAddress`, `town`, `postcode`, `region`, `email`, `phoneNo`)
    VALUES (:userID,:firstname,:lastname,:dob,:firstLineAddress,:town,:postcode,:region,:email,:phoneNo)');
        $statement->bindParam(':userID', $user->userID);
        $statement->bindParam(':firstname', $customer->firstname);
        $statement->bindParam(':lastname', $customer->lastname);
        $statement->bindParam(':dob', $customer->dob);
        $statement->bindParam(':firstLineAddress', $customer->firstLineAddress);
        $statement->bindParam(':town', $customer->town);
        $statement->bindParam(':postcode', $customer->postcode);
        $statement->bindParam(':region', $customer->region);
        $statement->bindParam(':email', $customer->email);
        $statement->bindParam(':phoneNo', $customer->phoneNo);
        $result= $statement->execute();
        if ($result) {
            return 'true';
        } else {
            return "false";
        }
    } else {
        return 'false';
    }
}

function addUser($user)
{
    global $pdo;

    $statement=$pdo->prepare('INSERT INTO `User`(`userType`, `username`, `password`)
  VALUES (:userType,:username,:password)');
    $password=password_hash($user->password, PASSWORD_DEFAULT);
    $statement->bindParam(':userType', $user->userType);
    $statement->bindParam(':username', $user->username);
    $statement->bindParam(':password', $password);
    $result= $statement->execute();
    return $result;
}

function addAdmin($admin)
{
    global $pdo;
    $addUser=addUser($admin);
    if ($addUser) {
        $userAcc=getUserByUsername($admin->username);
        $statement=$pdo->prepare('INSERT INTO `Admin`(`userID`, `firstname`, `lastname`, `email`)
  VALUES (:userID,:firstname,:lastname,:email)');
        $statement->bindParam(':userID', $userAcc->userID);
        $statement->bindParam(':firstname', $admin->firstname);
        $statement->bindParam(':lastname', $admin->lastname);
        $statement->bindParam(':email', $admin->email);
        $result=$statement->execute();
        $result;
        if ($result) {
            return 'true';
        } else {
            return 'false';
        }
    }
}

function deleteUserByUsername($username)
{
    global $pdo;
}

function checkUsername($username)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT username FROM `User` WHERE username=:username');
    $statement->bindParam(':username', $username);
    $statement->execute();
    $count=$statement->rowCount();
    if ($count==0) {
        return "true";
    } else {
        return "false";
    }
}

function checkEmail($email)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT email FROM `Customer` WHERE email=:email');
    $statement->bindParam(':email', $email);
    $statement->execute();
    $count=$statement->rowCount();
    if ($count==0) {
        return "true";
    } else {
        return "false";
    }
}



function getUserByUsername($username)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `User` WHERE username=:username');
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user=$statement->fetch();
    return $user;
}

function login($username, $password)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `User` WHERE username=:username');
    $statement->bindParam(':username', $username);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user=$statement->fetch();
    if (!empty($user)) {
        if (password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
}


function getCustomerByUserID($userID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `Customer` WHERE userID=:userID');
    $statement->bindParam(':userID', $userID);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'Customer');
    $user=$statement->fetch();
    return $user;
}

function getAdminByID($userID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `Admin` WHERE userID=:userID');
    $statement->bindParam(':userID', $userID);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'Admin');
    $user=$statement->fetch();
}

function changePassword($username, $password)
{
    global $pdo;
    $password=password_hash($password, PASSWORD_DEFAULT);
    $statement=$pdo->prepare('UPDATE User SET password=:password WHERE username=:username');
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $result=$statement->execute();
    return $result;
}

function addToWishList($wineID, $customerID)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO `WishList`(`wineID`, `customerID`) VALUES (:wineID,:customerID)');
    $statement->bindParam(':wineID', $wineID);
    $statement->bindParam(':customerID', $customerID);
    $result=$statement->execute();
    return $result;
}

function getWishListByCID($customerID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT wineID FROM `WishList` WHERE `customerID`=:customerID');
    $statement->bindParam(':customerID', $customerID);
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function removeWineFromList($wineID, $customerID)
{
    global $pdo;
    $statement=$pdo->prepare('DELETE FROM `WishList` WHERE `wineID`=:wineID');
    $statement->bindParam(':wineID', $wineID);
    $result=$statement->execute();
    return $result;
}

function getAllPromo()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `WinePromotion`');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'WinePromotion');
    return $result;
}

function getAllPromoType()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `Promotion`');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'Promotion');
    return $result;
}

function getPromoTypeByID($promotionID)
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `Promotion` WHERE promotionID=:promotionID');
    $statement->bindParam(':promotionID', $promotionID);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_CLASS, 'Promotion');
    $result=$statement->fetch();
    return $result;
}

function addNewWinePromo($winePromotion)
{
    global $pdo;
    $statement=$pdo->prepare('INSERT INTO `WinePromotion`(`promotionID`, `wineID`, `validFrom`, `validUntil`)
                              VALUES (:promotionID,:wineID,:validFrom,:validUntil)');
    $statement->bindParam(':promotionID', $winePromotion->promotionID);
    $statement->bindParam(':wineID', $winePromotion->wineID);
    $statement->bindParam(':validFrom', $winePromotion->validFrom);
    $statement->bindParam(':validUntil', $winePromotion->validUntil);
    $result=$statement->execute();
    return $result;
}

function getAllValidPromoTypes()
{
    global $pdo;
    $statement=$pdo->prepare('SELECT * FROM `WinePromotion` where `validUntil` >= CURDATE()');
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_CLASS, 'Promotion');
    return $result;
}
