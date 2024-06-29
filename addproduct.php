<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>GWC Computers|Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/onlinelogomaker-110321-1822-7532-2000-transparent.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Image Upload Preview</title>
    <!--Font Awesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- heading -->
            <div class="col-12 mt-2 mb-3">
                <h3 class="h2 text-center text-primary">Product Listing</h3>
            </div>
            <!-- heading -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-4 p-3">
                        <div class="row">
                            <h5>Select Product Category</h5>
                            <div class="col-12">
                                <div class="row">
                                    <select class="form-select" name="" id="category">
                                        <option value="0">Select Product</option>
                                        <?php
                                       $category= DATABASE::search("SELECT * FROM `category`");
                                       $category_num_rows =$category->num_rows;
                                       for($i=0;$i<$category_num_rows;$i++){
                                          
                                        $category_details=$category->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $category_details["id"]; ?>">
                                            <?php echo $category_details["name"]; ?></option>
                                        <?php
                                       }

                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 p-3 ">
                        <div class="row">
                            <h5>Select Product Brand</h5>
                            <div class="col-12">
                                <div class="row">
                                    <select class="form-select" name="" id="brand">
                                        <option value="0">Select Product Brand</option>
                                        <?php
                                       $brand= DATABASE::search("SELECT * FROM `brand`");
                                       $brand_num_rows =$brand->num_rows;
                                       for($i=0;$i<$brand_num_rows;$i++){
                                          
                                        $brand_details=$brand->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $brand_details["id"]; ?>">
                                            <?php echo $brand_details["brand_name"]; ?></option>
                                        <?php
                                       }

                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 p-3">
                        <div class="row">
                            <h5>Select Product Model</h5>
                            <div class="col-12">
                                <div class="row">
                                    <select class="form-select" name="" id="model">
                                        <option value="0">Select Product Model</option>
                                        <?php
                                       $model= DATABASE::search("SELECT * FROM `model`");
                                       $model_num_rows =$model->num_rows;
                                       for($i=0;$i<$model_num_rows;$i++){
                                          
                                        $model_details=$model->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $model_details["id"]; ?>">
                                            <?php echo $model_details["model_name"]; ?></option>
                                        <?php
                                       }

                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <h5 class="">Add Your Product Title</h5>
                            <div class="col-12 col-lg-10 ">
                                <input class="form-control " id="title" type="text">
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-4 p-3">
                                <div class="row">
                                    <h5>Add Your Product Condition</h5>
                                    <div class="offset-lg-1 col-12 col-lg-3 form-check ms-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                            id="brand_new" checked>
                                        <label class="form-check-label" for="brand_name">
                                            Brandnew
                                        </label>
                                    </div>

                                    <div class="offset-lg-1 col-12 col-lg-3 form-check ms-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="used">
                                        <label class="form-check-label" for="used">
                                            Used
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 p-3">
                                <div class="row">
                                    <h5>Select Your Product Color</h5>
                                    <div class="col-12">
                                        <select class="form-select" id="color">
                                            <option value="0">Select Color</option>
                                            <?php 
                                            $color = DATABASE::search("SELECT * FROM `color`");
                                            $color_row =$color->num_rows;
                                            for($a=0;$a<$color_row; $a++){

                                                $color_data =$color->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $color_data["id"]; ?>">
                                                <?php echo $color_data["color"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 p-3">
                                <div class="row">
                                    <h5>Add Product Quantity </h5>
                                    <div class="col-12">
                                        <input type="text" id="qty" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div cla ss="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-4 p-3">
                                <div class="row">
                                    <h5>Add Product Price</h5>
                                    <div class="col-12">
                                        <input type="text" id="price" class="form-control " />
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 offset-lg-1 col-lg-4 p-3">
                                <div class="row">
                                    <h5>Add Product Delivery Cost</h5>
                                    <div class="col-12">
                                        <input type="text" id="delivery_cost" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <h5>Add Product Description</h5>
                            <div class="col-12 ">
                                <textarea class="form-control bg-light" id="description" cols="100" rows="30"
                                    id="desc"></textarea>
                            </div>
                        </div>

                    </div>
                    <!--product img -->
                    <div class="col-12 mb-3">
                        <div class="row p-2">
                            <div class="col-12">
                                <h5>Add Product Image</h5>
                            </div>
                               
                            <input id="fileToUpload" type="file" accept="image/*" multiple/>
                            <!-- <div class="user-image mb-3 text-center">
                                <div class="imgGallery">

                                </div>
                            </div>

                            <div class="custom-file">
                                <input type="file" name="fileUpload[]" class="d-none" id="chooseFile"
                                    multiple>
                                <label class="col-4 col-md-2 ms-1 btn btn-primary" for="chooseFile">Select file</label>
                            </div>

                          


                            <?php if(!empty($response)) {?>
                            <div class="alert <?php echo $response["status"]; ?>">
                                <?php echo $response["message"]; ?>
                            </div>
                            <?php }?> -->
                            <!-- <input  type="file" name="upload_file" class="d-none form-control" placeholder="Enter Name" id="upload_file" onchange="getImagePreview(event)"/>
                         
                            <div id="preview">
                           
                            </div>
                            <label class="col-4 col-md-2 ms-1 btn btn-primary" for="upload_file" >Upload</label> -->

                            <!-- <input type="file" id="file-input" accept="image/png, image/jpeg" onchange="preview()"
                                multiple>
                            <label for="file-input" class="col-4 col-md-2 ms-1 btn btn-primary">
                                <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                                &nbsp; Choose A Photo
                            </label>
                            <p id="num-of-files">No Files Chosen</p>
                            <div class="col-4 col-md-2">
                                <div class="row">
                                    <div class="col-6" id="images">
                                        <img class="col-12"
                                            src="resources/addproductimg copy.svg" alt="">
                                    </div>
                                </div>
                            </div> -->

                            
                          

                           



                        </div>
                    </div>
                    <!--product img -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-4 col-lg-8 p-2">
                                <button class="d-grid btn btn-primary" onclick="addProduct();">Add Product</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="bootstrap.js"></script>


</body>

</html>