<?php
    if(isset($_FILES["fileToUpload"])){
$count = count($_FILES['fileToUpload']['name']);

for ($i = 0; $i < $count; $i++) {
    // echo 'Name: '.$_FILES['fileToUpload']['name'][$i].'<br/>';
    


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

                        // Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES('".$file_name."','".$last_id."')");
                        echo "product image added to the database successfully";

                }

}

}else{
    echo "Please Select an Image";
}

?>