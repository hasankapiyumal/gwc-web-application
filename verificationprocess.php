<?php
session_start();
require "connection.php";

if(isset($_POST["code"])){

    $code=$_POST["code"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification` ='".$code."' ;");
    $an = $admin_rs->num_rows;

    if($an == 1 ){

        $ar = $admin_rs->fetch_assoc();

    
        $_SESSION["admin"] = $ar;

        echo "success";


    }else{
       
        echo "Error enter a valid number";


    }

}else{

    echo"Error please try again.";

} 

?>