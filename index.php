<!DOCTYPE html>
<html>

<head>
    <title>gwc computers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/onlinelogomaker-110321-1822-7532-2000-transparent.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body style="background-color: #1C1C1C;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- header -->
                <?php
                  require "header.php";
                  ?>
                <!-- header -->
                <div class="col-12">
                    <div class="row">

                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="background-color:#1C1C1C;">
                        <div class="row">
                            <div class="col-12 col-lg-5 offset-lg-2 mt-2">

                                <input class="form-control me-2" list="datalistOptions" type="search"
                                    placeholder="Search" aria-label="Search" id="search_txt">
                                <datalist id="datalistOptions">
                                    <option value="Categories">
                                        <?php
                                    $cat=database::search("SELECT `name` FROM `category`");
                                    $a=$cat->num_rows;
                                    for($z=0;$z<$a;$z++){
                                      $d=$cat->fetch_assoc();
                                        ?>
                                    <option value="<?php echo $d["name"]; ?>">

                                        <?php
                                    }
                                    ?>


                                </datalist>

                            </div>
                            <div class="col-12 col-lg-4 mt-2 ">
                                <button class="btn btn-warning  col-12 col-lg-6 " onclick="search();">search</button>
                                <a href="advancedSearch.php" id="advanced" class="col-lg-1 offset-lg-1 col-12">Advanced</a>
                                
                            </div>
                        </div>
                        
                        <div class="col-12 p-3 gx-3" id="view"></div>
                        <div class="col-12" id="category">
                            <div class="row">
                           
                                <div class="col-12 d-none d-lg-block col-lg-2 mt-0">
                                    <div class="row">
                                        <?php
                                        $data=Database::search("SELECT * FROM `category`");
                                        $category=$data->num_rows;
                                        for($x=0;$x<$category;$x++){
                                            $details=$data->fetch_assoc();
                                            $category_id=$details["id"];
                                            ?>
                                        <div class="col-12 text-white fs-5" onclick="categoryProducts(<?php echo $category_id; ?>);">
                                            <div class="row">
                                                <div class="col-12 mt-2 categorybox ">
                                                    <div class="row">

                                                        <div class="col-3">
                                                            <img class="col-12" src="<?php echo $details["image"]; ?>"
                                                                alt="">
                                                        </div>
                                                        <div class="col-9 gx-5"><?php echo $details["name"]; ?></div>
                                                    </div>


                                                </div>

                                            </div>


                                        </div>
                                        <?php   
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="col-lg-10  d-none d-lg-block text-danger" id="slider">
                                    <div class="row">
                                        <div class="col-9 offset-lg-1 mt-3">
                                            <div id="carouselExampleIndicators" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                                        data-bs-slide-to="0" class="active" aria-current="true"
                                                        aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img src="resources/bravo15.jpg" class="d-block w-100"
                                                            alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="resources/MSI graphic card.jpg" class="d-block w-100"
                                                            alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="resources/AMD processors.jpg" class="d-block w-100"
                                                            alt="...">
                                                    </div>

                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 offset-lg-2 col-lg-10" id="product">
                            <div class="row">
                                <div class="row row-cols-1 row-cols-md-4 g-4">
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
                                            <img src="<?php echo $img_fetch["image"]; ?>" class="card-img-top" alt="..."
                                                style="height: 200px;">
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
                                                <a  class="btn" onclick="addToWatchList(<?php echo $pid; ?>);"><i class="bi bi-heart-fill"></i></a><input type="number" class="form-control mb-1" id ="qtytxt<?php echo $pid; ?>" Value=<?php echo $pqty;?> />
                                                <div class="col-12 ">
                                                    <div class="row">
                                                        <a href="singleProductView.php?id=<?php echo $new_data_fetch["id"]; ?>"
                                                            class="col-lg-5 col-md-12 col-12 btn btn-outline-primary ">Buy
                                                            Now</a>
                                                        <button
                                                            class="col-lg-5 offset-lg-1 col-md-12 col-12 btn btn-outline-success  mt-1 mt-md-0" onclick="addToCart(<?php echo $pid; ?>)">Add
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

    

    <!-- footer -->
    <?php
require "footer.php";
?>
    <!-- footer -->
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>