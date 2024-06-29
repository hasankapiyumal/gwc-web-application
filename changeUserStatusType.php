<?php
require "connection.php";
$status_id =$_POST["sid"];
$product_id =$_POST["pid"];

DATABASE::iud("UPDATE `product` SET `status_id`='".$status_id."' WHERE `id`='".$product_id."' ");
if($status_id=="1"){

    echo "Product Activated Successfully";

}elseif($status_id=="2"){

    echo "Product Deactivated Successfully";

}

?>