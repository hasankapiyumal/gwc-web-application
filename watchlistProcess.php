<?php
session_start();
require "connection.php";
if(isset($_SESSION["user"])){

    $pid=$_POST["p"];
    $qty=$_POST["q"];
   $email= $_SESSION["user"]["email"];

   $database= DATABASE ::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
  $database_row=$database->num_rows;

  if($database_row==1){

    echo "This Product Already Exists";

  }else{

    // DATABASE::iud("INSERT INTO `cart`(`product_id`,`user_email`)VALUES('".$pid."','".$email."') ");
    // echo "success";

    $productrs = Database::search("SELECT `qty` FROM `product` WHERE `id`= '".$pid."'  ;");
        $pr = $productrs->fetch_assoc();

        if($pr['qty']>= $qty){

        Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`,`qty`) VALUES ('".$pid."','".$email."','".$qty."') ;");
        echo "success";
        }else{
            echo "Please enter a valid Quantity..".$pr['qty'].".";
        }

  }


}else{

    echo "Pease Log In First";

}

?>