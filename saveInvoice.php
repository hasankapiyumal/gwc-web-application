<?php
session_start();
require "connection.php";

if(isset($_SESSION["user"])){

    $order_id =$_POST["order"];
    $title =$_POST["title"];
    $amount=$_POST["price"];
    $line1=$_POST["first_line"];
    $line2 =$_POST["second_line"];
    $city =$_POST["city_name"];
    $product_id= $_POST["pid"];
    $qty=$_POST["quantity"];
    $email =$_SESSION["user"]["email"];

   // echo $qty;
    
    
    $product_data =DATABASE::search("SELECT * FROM `product` WHERE `id` ='".$product_id."'");
    $product= $product_data->fetch_assoc();
    $old_qty =$product["qty"];
   // echo $old_qty;
    $new_qty =$old_qty-$qty;

    DATABASE::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$product_id."' ");
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimeZone($tz);
    $date = $d->format('Y-m-d H:i:s');

    Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`)
    VALUES('".$order_id."','".$product_id."','".$email."','".$date."','".$amount."','".$qty."') ;");

// echo $qty;
// echo "<br>";
// echo $old_qty;
// echo "<br>";
// echo $new_qty;
// echo "<br>";
    echo "1";


}else{
    ?>
<script>
    window.location="index.php";
</script>
    <?php
}
?>




