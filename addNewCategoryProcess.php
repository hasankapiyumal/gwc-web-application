<?php
session_start();
require "connection.php";
if(isset($_SESSION["admin"])){
 $category=$_POST["category"];
$image=$_FILES["image"];

if(empty($category)){
    echo " You must to Enter a Category... ";
}else{
    $categoryrs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '".$category."' ; ");
    $n = $categoryrs->num_rows;


    if($n == 1 ){
        echo "The Category already exists..";
    }else{

        // Database::iud("INSERT INTO `category` (`name`) VALUES ('".$category."') ");
        if(isset($_FILES["image"])){
            $allowed_image_extensions = array("image/jpeg", "image/jpg","image/png","image/svg");
            $fileex = $image["type"];

            if(!in_array($fileex,$allowed_image_extensions)){
            echo "Please Select a valid image";
            }else{
                $newimgextention;
                if($fileex = "image/jpeg"){
                    $newimgextention =".jpeg";
                }else if($fileex = "image/jpg"){
                    $newimgextention = ".jpg";
                }else if($fileex = "image/svg"){
                    $newimgextention = ".svg";
                }else if ($fileex = "image/png"){
                    $newimgextention = ".png";
                }
                    $file_name = "resources//category_images//" . uniqid() . $newimgextention;
                    
                        move_uploaded_file($image["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `category` (`image`,`name`) VALUES('".$file_name."','".$category."')");
                        echo "success";

                }

            }else{
                echo "Please Select an Image";
            }

        
    }
}

}else{

    echo"error";

}





?>