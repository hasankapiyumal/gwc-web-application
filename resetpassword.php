<?php
require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if(empty($e)){
    echo "Missing email address ";
}elseif(empty($np)){
    echo "Please enter your new Password";
}else if (empty($rnp)){
    echo "please Re-type your  Password";
}else if($np != $rnp){
    echo "Password and Re-type password does not match";
}else if (empty($vc)){
    echo "Please enter your varification code";
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' AND `verification_code`='".$vc."' ");
if($rs->num_rows==1){
     
    Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`='".$e."' ");
    echo "1";
}else{
        echo "Error";
    }

}
?>