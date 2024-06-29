<?php
session_start();
require "connection.php";

if(isset($_SESSION["user"])){


    $first_name = $_POST["f"];
    $last_name = $_POST["l"];
    $mobile_number = $_POST["m"];
    $line_1 = $_POST["a1"];
    $line_2 = $_POST["a2"];
    $city_number = $_POST["c"];
    $img = $_FILES["i"];


    
    if(empty($first_name)){

        echo "Please Enter the First Name";

    }else if(empty($last_name)){

        echo "Please Enter the Last name";

    }else if(empty($mobile_number)){

        echo "Please Enter the mobile Numer ";

    }else if (strlen($mobile_number)!=10){

        echo "mobile number must be at least 10 characters.....";

    }else if(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile_number)==0){

        echo"Invalid Mobile Number.....";

    }else if(empty($line_1)){

        echo "Please Enter the line 1";
        
    }else{
               
        // echo $first_name;
        // echo $last_name;
        // echo $mobile_number;
        // echo $_SESSION["user"]["email"];

   
            Database::iud("UPDATE `user` SET 
            `fname`='".$first_name."',
            `lname`='".$last_name."',
            `mobile`='".$mobile_number."'
             WHERE  `email`='".$_SESSION["user"]["email"]."' ;");

             $_SESSION["user"]["fname"]=$first_name;
             $_SESSION["user"]["lname"]=$last_name;
             $_SESSION["user"]["mobile"]=$mobile_number;

            

            //  echo "User Table Update";

             $address = Database::search("SELECT * FROM `address` WHERE `id`='" . $_SESSION["user"]["address_id"] . "' ");
             $nr = $address->num_rows;
             
           
             if ($nr == 1) {
                 // update
     
                //  $ucity = Database::search("SELECT `id` FROM `city` WHERE `name` = '" . $city . "' ");
                //  $unr = $ucity->fetch_assoc();
                //  $city=$address->fetch_assoc();   

                 Database::iud("UPDATE `address` SET 
                 `line1` = '" . $line_1 . "'
                 , `line2` = '" . $line_2 . "'
                 , `city_id` = '" . $city_number. "' WHERE `id`='".$_SESSION["user"]["address_id"]."' ");
     
                //  echo "Re-new address added";
     
                //  $last_id = Database::$conection->insert_id;
        
     


             
            $useremails = $_SESSION["user"]["email"];
            if(isset($_FILES["i"])){
            $allowed_image_extensions = array("image/jpeg", "image/jpg","image/png","image/svg");
            $fileex = $img["type"];

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
                        $file_name = "resources//profile_img//" . uniqid() . $newimgextention;
                        // echo $file_name;
                            move_uploaded_file($img["tmp_name"], $file_name);

                          $profileimages = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$useremails."';");
                          $upimg = $profileimages->num_rows;

                          if($upimg == 1){

                            Database::iud("UPDATE `profile_img` SET `code` ='".$file_name."' WHERE `user_email`='".$useremails."';");

                            echo "product image added to the database successfully";

                               echo "success";



                          }else{
                                 
                            Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES('".$file_name."','".$useremails."');");
                            echo "product image added to the database successfully";
                            
                                   echo "success";
                          }
                         
                             

                    }

            }else{
                echo "Please Select an Image";
            }

           

           
          

        } else {
            // add new

            $code=hexdec( uniqid() ); 
            $_SESSION["user"]["address_id"]=$code;
            
       

            Database::iud("INSERT INTO `address` (`id`,`line1`,`line2`,`city_id`) VALUES 
            ('" . $code. "','" . $line_1 . "','" . $line_2 . "','" . $city_number. "') ");

Database::iud("UPDATE `user` SET `address_id` ='".$code."' WHERE `email`='".$_SESSION["user"]["email"]."';");
                
$_SESSION["user"]["address_id"]=$code;
            
        }
         
        $search_user =  Database::search("SELECT * FROM `user` WHERE `email`= '".$_SESSION["user"]["email"] ."';");
        $user_rs = $search_user-> num_rows;

        $userData = $search_user->fetch_assoc();

        $_SESSION["user"] = $userData;
        
    }
}
?>