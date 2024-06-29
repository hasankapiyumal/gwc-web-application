<?php
session_start();
require "connection.php";
$category =$_POST["c"];
$brand =$_POST["b"];
$model=$_POST["m"];
$title=$_POST["t"];
$condition=$_POST["con"];
$color =$_POST["col"];
$qty=(int)$_POST["q"];
$price=(int)$_POST["p"];
$delivery_cost=(int)$_POST["d"];
$description=$_POST["des"];




$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$adminemail = "hasankapiyumal7@gmail.com";

if ($category == "0") {
    echo "Please select a category";
} elseif ($brand == "0") {
    echo "Please select a brand";
} elseif ($model == "0") {
    echo "Please select a model";
}elseif (empty($title)) {
    echo "Please add a title";
} elseif (strlen($title) > 100) {
    echo "Title must contain 100 or less than 100 characters";
} elseif($color=="0"){
   echo "Please Select Your Color";
} elseif ($qty == "0" || $qty == "e") {
    echo "Please add the quantity of your product";
} elseif (!is_int($qty)) { 
    echo "Please add a valid quantity";
} elseif (empty($qty)) {
    echo "Please add the quantity of your product";
} elseif ($qty < 0) {
    echo "Please add a valid quantity";
} elseif (empty($price)) {
    echo "Please add the price of your product";
} elseif (!is_int($price)) {
    echo "Please insert a valid price";
} elseif (empty($delivery_cost)) {
    echo "Please add the delevery cost";
} elseif (!is_int($delivery_cost)) {
    echo "Please insert a valid price";
} elseif (empty($delivery_cost)) {
    echo "Please add the delevery cost";
} elseif (empty($description)) {
    echo "Please enter the description of your product";
} else{
    
$data_base=DATABASE::iud("INSERT INTO `product`(`title`,`description`,`product_date`,`price`,`qty`,`delivery_fee`,`category_id`,`status_id`,`condtion_id`,`brand_id`,`model_id`,`admin_email`,`color_id`) VALUES('".$title."','".$description."','".$date."','".$price."','".$qty."','".$delivery_cost."','".$category."','".$status."','".$condition."','".$brand."','".$model."','".$adminemail."','".$color."')");
$last_id = Database::$conection->insert_id;




   
    if(isset($_FILES["fileToUpload"])){
        $count = count($_FILES['fileToUpload']['name']);
        
        for ($i = 0; $i < $count; $i++) {
          
            
        
        
                    $allowed_image_extensions = array("image/jpeg", "image/jpg","image/png","image/svg");
                    $fileex = $_FILES["fileToUpload"]["type"][$i];
        
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
                            $file_name = "resources//product_images//" . uniqid() . $newimgextention;
                            
                                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $file_name);
        
                                Database::iud("INSERT INTO `product_images` (`image`,`product_id`) VALUES('".$file_name."','".$last_id."')");
        
                                
                             

        
                        }
        
        }

        if($last_id != null){


            echo "product Added to the database sucessfully";
        }else{

            echo "Error";
        }
        
        }else{
           // echo "Please Select an Image";
        }

        
    }
 

?>