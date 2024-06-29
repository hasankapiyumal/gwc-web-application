<?php

session_start();


require "connection.php" ;

$email = $_POST["email"];
$password = $_POST["password"];
$remember = $_POST["remember"];



if(empty($email)){
    echo "Enter your email address";

}elseif(empty($password)){
echo "Enter your password";
}
else{

    $rs = Database:: search( "SELECT * FROM `user` WHERE `email` ='".$email."' AND  `password` ='".$password."' ");

    $n = $rs->num_rows;

    if($n==1){
           

            $d = $rs->fetch_assoc();

            $_SESSION["user"] = $d;

            if($remember=="true"){
                setcookie("e",$email,time()+(60*60*24*365));
                setcookie("p",$password,time()+(60*60*24*365));
            }else{
                setcookie("e","",-1);
                setcookie("p","",-1);
            }
    

        }else{
            echo "Invalid details";

    }

    echo "Success";
}
?>