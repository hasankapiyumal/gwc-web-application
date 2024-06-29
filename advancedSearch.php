<!DOCTYPE html>
<html>

<head>
    <title>
        gwc computers | Advanced Search
    </title>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/onlinelogomaker-110321-1822-7532-2000-transparent.png" />
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body class="wallcolor">
    <div class="container-fluid" id="maindiv">
        <div class="row">

            <!-- header start  -->
            <div class="col-12 bg-body ">
                <?php require "header.php"; 
               
                ?>
            </div>
            <!-- header close  -->

            <div class="col-12 " style="background-color: 1C1C1C;">
                <div class="row">
                    <div class="offset-1 offset-lg-4 col-12 col-lg-4">
                        <div class="row">

                            <!-- logo -->
                            <div class="col-2 mt-2">
                                <div class="mb-3 logo"> </div>
                            </div>

                            <div class="col-10">
                                <label class="form-label text-warning  fw-bold fs-2 mt-4">Advanced Search</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!--body design start -->
            <div class="offset-0 offset-lg-2 col-12 col-lg-8 advanced_color mt-3 mb-3 rounded">
                <div class="row">


                    <!-- search start -->
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input type="text" class="form-control" placeholder="Type Keyword to Search..."
                                    id="k" />
                            </div>
                            <div class="col-4 col-lg-2 mt-3 mb-2">
                                <button class="btn btn-primary searchbutton1"
                                    onclick="advancedSearch();">Search</button>
                            </div>
                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                    <!-- search close -->

                    <!-- category,brand,model start-->
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-lg-4 col-12 mb-3">
                                        <select class="form-select" id="c">
                                            <option value="0">Select Category</option>

                                            <?php
                    $categoryrs = Database::search("SELECT * FROM  `category` ;");  
                    $cn = $categoryrs->num_rows;
                    for($a = 0 ; $a < $cn; $a++){
                        $cr = $categoryrs->fetch_assoc();
                        ?>
                                            <option value="<?php echo $cr['id']; ?>"><?php echo  $cr['name']; ?>
                                            </option>
                                            <?php
                    }
                ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-3">
                                        <select class="form-select" id="b">
                                            <option value="0">Select Brand</option>
                                            <?php
                    $brandrs = Database::search("SELECT * FROM  `brand` ;");  
                    $bn = $brandrs->num_rows;
                    for($a = 0 ; $a < $bn; $a++){
                        $br = $brandrs->fetch_assoc();
                        ?>
                                            <option value="<?php echo $br['id']; ?>"><?php echo  $br['brand_name']; ?>
                                            </option>
                                            <?php
                    }
                ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-12 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>

                                            <?php
                    $modelrs = Database::search("SELECT * FROM  `model` ;");  
                    $mn = $modelrs->num_rows;
                    for($a = 0 ; $a < $mn; $a++){
                        $mr = $modelrs->fetch_assoc();
                        ?>
                                            <option value="<?php echo $mr['id']; ?>"><?php echo  $mr['model_name']; ?>
                                            </option>
                                            <?php
                    }
                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- category,brand,model start-->

                    <!-- condition , colour start -->
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <select class="form-select" id="con">
                                    <option value="0">Select Condition</option>

                                    <?php
                    $conditionrs = Database::search("SELECT * FROM  `condtion` ;");  
                    $con = $conditionrs->num_rows;
                    for($a = 0 ; $a < $con; $a++){
                        $con_r = $conditionrs->fetch_assoc();
                        ?>
                                    <option value="<?php echo $con_r['id']; ?>"><?php echo  $con_r['condtion_type']; ?>
                                    </option>
                                    <?php
                    }
                ?>
                                </select>
                            </div>

                            <div class="col-lg-6 col-12 mb-3">
                                <select class="form-select" id="clr">
                                    <option value="0">Select Colour</option>

                                    <?php
                    $color_rs = Database::search("SELECT * FROM  `color` ;");  
                    $col = $color_rs->num_rows;
                    for($a = 0 ; $a < $col; $a++){
                        $colrs = $color_rs->fetch_assoc();
                        ?>
                                    <option value="<?php echo $colrs['id']; ?>"><?php echo  $colrs['color']; ?></option>
                                    <?php
                    }
                ?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <!-- condition , colour close -->

                    <!-- price start -->
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-lg-5 offset-lg-1 mb-3">
                                <input class="form-control" placeholder="Price From" id="pf" />
                            </div>
                            <div class="col-12 col-lg-5 mb-3">
                                <input class="form-control" placeholder="Price To" id="pt" />
                            </div>

                        </div>
                    </div>
                    <!-- price close -->


                    <!-- card open -->
                    <div class=" col-12 col-lg-12  mt-3 mb-3 rounded advanced_color" >
                        <div class="row">
                            <div class="col-12 offset-0 col-lg-10 offset-lg-1 text-center">
                                <div class="row" id="viewResults">

                                    <div class="row row-cols-1 row-cols-md-2 g-4">
                                        <?php
                               $data_new= DATABASE::search("SELECT * FROM product WHERE status_id='1'  ORDER BY `product_date`  DESC  LIMIT 4 OFFSET 0");
                               $new_data_row=$data_new->num_rows;
                               for($a=0; $a<$new_data_row; $a++){

                                $new_data_fetch=$data_new->fetch_assoc();
                                $pid=$new_data_fetch["id"];
                               $pqty=$new_data_fetch["qty"];
                               ?>
                                        <div class="col">
                                            <div class="card h-100">
                                                <?php
                                            $img_data=DATABASE::search("SELECT * FROM product_images WHERE product_id='".$pid."' LIMIT 1 OFFSET 0");
                                            $img_fetch=$img_data->fetch_assoc();
                                            ?>
                                                <img src="<?php echo $img_fetch["image"]; ?>" class="card-img-top"
                                                    alt="..." style="height: 200px;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $new_data_fetch["title"]; ?><span
                                                            class="badge bg-danger">
                                                            <?php
                                                    if($pqty<=0){
                                                    ?>
                                                            Out Of Stock
                                                            <?php    
                                                    }else{
                                                    ?>
                                                            In Stock
                                                            <?php
                                                    }
                                                    ?>
                                                        </span></h5>
                                                    <h5 class="card-title"><?php echo $new_data_fetch["price"]; ?></h5>
                                                    <a class="btn" onclick="addToWatchList(<?php echo $pid; ?>);"><i
                                                            class="bi bi-heart-fill"></i></a><input type="number"
                                                        class="form-control mb-1" id="qtytxt<?php echo $pid; ?>"
                                                        Value=<?php echo $pqty;?> />
                                                    <div class="col-12 ">
                                                        <div class="row">
                                                            <a href="singleProductView.php?id=<?php echo $new_data_fetch["id"]; ?>"
                                                                class="col-lg-5 col-md-12 col-12 btn btn-outline-primary ">Buy
                                                                Now</a>
                                                            <button
                                                                class="col-lg-5 offset-lg-1 col-md-12 col-12 btn btn-outline-success  mt-1 mt-md-0"
                                                                onclick="addToCart(<?php echo $pid; ?>)">Add
                                                                to
                                                                Cart</button>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                               }
                                    ?>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    </div>



    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>