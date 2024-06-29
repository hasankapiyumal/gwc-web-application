<?php
session_start();
require "connection.php";
$id = $_GET["id"];
$qty = $_GET["qty"];
$email = $_SESSION["user"]["email"];

$array;
$order_id = uniqid();

$product_data = DATABASE::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
$product = $product_data->fetch_assoc();

$product_title = $product["title"];
$delivery = $product["delivery_fee"];
$amount = $product["price"] * $qty + $delivery;

$fname = $_SESSION['user']["fname"];
$lname = $_SESSION['user']["lname"];
$mobile = $_SESSION['user']["mobile"];

$address_id =
    $address_data = DATABASE::search("SELECT `address`.`line1`,`address`.`line2`,`city`.`name` FROM `address` INNER JOIN `user` ON `address`.`id` =`user`.`address_id` INNER JOIN `city` ON `city`.`id_city`=`address`.`city_id` WHERE `user`.`email`='" . $email . "';");
$address_fetch = $address_data->fetch_assoc();

$line1 = $address_fetch["line1"];
$line2 = $address_fetch["line2"];
$city = $address_fetch["name"];


$array["order_id"]  = $order_id;
$array["title"] =  $product_title;
$array["amount"] = $amount;
$array["fname"] = $fname;
$array["lname"] =  $lname;
$array["email"] =  $email;
$array["mobile"] = $mobile;
$array["line1"] = $line1;
$array["line2"] = $line2;
$array["city"] = $city;
$array["id"] = $id;
$array["qty"] = $qty;



echo json_encode($array);
