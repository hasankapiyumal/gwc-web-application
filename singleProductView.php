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

<body>
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
                                <div class="row">

                                </div>


                            </div>

                        </div>

                        <?php


                        if (isset($_GET['id'])) {


                            $pid = $_GET["id"];



                            $productrs = Database::search("SELECT * FROM `product` WHERE `id`= '" . $pid . "'  ;");
                            $pn = $productrs->num_rows;

                            if ($pn == 1) {
                                $pd = $productrs->fetch_assoc();




                        ?>


                                <div class="col-12 p-3 gx-3" id="view"></div>
                                <div class="col-12" id="category">
                                    <div class="row">

                                        <div class="col-12  col-lg-6 mt-0">
                                            <div class="row">

                                                <div class="col-12 c text-white fs-5">
                                                    <div class="row">
                                                        <?php
                                                        $image_data = DATABASE::search("SELECT * FROM `product_images` WHERE `product_id`='" . $pid . "'LIMIT 3");
                                                        $image_row = $image_data->num_rows;
                                                        $result = array();
                                                        for ($x = 0; $x < $image_row; $x++) {

                                                            $image = $image_data->fetch_assoc();
                                                            $image_name = $image["image"];
                                                            $result[] = $image_name;
                                                        }

                                                        ?>
                                                        <div id="carouselExampleControls" class="carousel " data-bs-ride="carousel">
                                                            <div class="carousel-inner">


                                                                <div class="carousel-item active">
                                                                    <img src="<?php echo $result[0]; ?>" class="d-block w-100" alt="..." width="400px" height="400px">
                                                                </div>
                                                                <?php
                                                                if ($image_row == 2) {

                                                                ?>
                                                                    <div class="carousel-item">
                                                                        <img src="<?php echo $result[1]; ?>" class="d-block w-100" alt="" width="400px" height="400px">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="resources/icon-image-not-found-free-vector.jpg" class="d-block w-100" alt="" width="400px" height="400px">
                                                                    </div>
                                                                <?php

                                                                } elseif ($image_row == 1) {
                                                                ?>
                                                                    <div class="carousel-item">
                                                                        <img src="resources/icon-image-not-found-free-vector.jpg" class="d-block w-100" alt="" width="400px" height="400px">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="resources/icon-image-not-found-free-vector.jpg" class="d-block w-100" alt="" width="400px" height="400px">
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="carousel-item">
                                                                        <img src="<?php echo $result[1]; ?>" class="d-block w-100" alt="" width="400px" height="400px">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="<?php echo $result[2]; ?>" class="d-block w-100" alt="..." width="400px" height="400px">
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>





                                                            </div>
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6   text-white">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="text-center"><?php echo $pd["title"]; ?></h2>
                                                </div>





                                                <div class="col-12">
                                                    <label class="form-label fs-2 text-warning fw-bold mt-3"> <?php echo $pd["price"]; ?>. 00 USD</label>




                                                    <div class="col-12 mb-3">

                                                        <b class="text-primary fs-6">In Stock : </b><label id="stock" class="text-primary fs-6"><?php echo $pd["qty"]; ?> </label><b class="text-primary fs-6"> Items Left</b>
                                                    </div>
                                                    <div class="col-12 mb-3">

                                                        <b class="text-primary fs-6">Product Number: </b><label class="text-primary fs-6" id="product_id"><?php echo $pid; ?></label>
                                                    </div>






                                                    <div class="col-12">
                                                        <label class="text-start text-white"><?php echo $pd["description"]; ?></label>
                                                    </div>



                                                    <div class="col-12">
                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-mb-6">
                                                                <?php
                                                                $color_data = DATABASE::search("SELECT * FROM `color` WHERE `id`='" . $pd['color_id'] . "'");
                                                                $color = $color_data->fetch_assoc();
                                                                ?>
                                                                <label class="fs-6 mt-1">Colour Options : </label><br>
                                                                <button class="btn btn-sm btn-primary"><?php echo $color["color"]; ?></button>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="hrbreak1">

                                                    <div class="col-12">
                                                        <div class="row mt-2 mb-3">
                                                            <div class="col-md-6">
                                                                <div class="row">


                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start position-relative product_qty">
                                                                        <span class="mt-2">QTY :</span>
                                                                        <input id="qtyinput" class="border-0 fs-6 fw-bold test-start mt-2" type="number" min="1" pattern="[0-9]*" value="1">
                                                                        <div class="position-absolute qty-buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-inc">
                                                                                <i class="fas fa-chevron-up" onclick="qty_inc();"></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty-dec">
                                                                                <i class="fas fa-chevron-down" onclick="qty_dec();"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-12">
                                                            <div class="row">
                                                                <div class="col-10 col-md-5">
                                                                    <div class="row">
                                                                        <div class="col-12 d-grid">
                                                                            <button class="btn btn-primary mt-3" onclick="addToCart(<?php echo $pid; ?>)">Add to cart</button>
                                                                        </div>
                                                                        <!-- <div class="col-6 d-grid mt-3">
                                                                            <button class="btn btn-warning text-white" id="payhere-payment" type="submit" onclick="paynow(<?php echo $pid; ?>);"> Buy now</button>
                                                                        </div> -->
                                                                        <div id="paypal-payment-button" class="col-12 d-grid mt-3">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1 mt-2 mt-4">
                                                                    <i class="fa fa-heart fs-5 bg-light text-black-50 rounded"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 offset-lg-1 col-lg-10" id="product">
                                        <div class="row">
                                            

                                            <!-- card -->
                                            <div class="row row-cols-1 row-cols-md-4 g-4">
                                                <?php

                                                

                                                $data_new = DATABASE::search("SELECT * FROM `product` WHERE status_id='1'  ORDER BY `product_date`  DESC  LIMIT 4 OFFSET 0  ;");
                                                $new_data_row = $data_new->num_rows;
                                                while ($new_data_fetch = $data_new->fetch_assoc()) {


                                                    $pid = $new_data_fetch["id"];
                                                    $pqty = $new_data_fetch["qty"];
                                                ?>
                                                    <div class="col">
                                                        <div class="card h-100">
                                                            <?php
                                                            $img_data = DATABASE::search("SELECT * FROM product_images WHERE product_id='" . $pid . "' LIMIT 1 OFFSET 0");
                                                            $img_fetch = $img_data->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $img_fetch["image"]; ?>" class="card-img-top" alt="..." style="height: 200px;">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $new_data_fetch["title"]; ?><span class="badge bg-danger">
                                                                        <?php
                                                                        if ($pqty <= 0) {
                                                                        ?>
                                                                            Out Of Stock
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            In Stock
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </span></h5>
                                                                <h5 class="card-title"><?php echo $new_data_fetch["price"]; ?></h5>
                                                                <a class="btn" onclick="addToWatchList(<?php echo $pid; ?>);"><i class="bi bi-heart-fill"></i></a><input type="number" class="form-control mb-1" id="qtytxt<?php echo $pid; ?>" Value=<?php echo $pqty; ?> />
                                                                <div class="col-12 ">
                                                                    <div class="row">
                                                                        <a href="singleProductView.php?id=<?php echo $new_data_fetch["id"]; ?>" class="col-lg-5 col-md-12 col-12 btn btn-outline-primary ">Buy
                                                                            Now</a>
                                                                        <button class="col-lg-5 offset-lg-1 col-md-12 col-12 btn btn-outline-success  mt-1 mt-md-0" onclick="addToCart(<?php echo $pid; ?>)">Add
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
                                            <!-- card -->


                                            
                                            <!-- new card -->
                                        </div>
                                    </div>

                            <?php
                            } else {

                                echo "Error";
                            }
                        }

                            ?>


                                </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=AV8XC2A_ZopFM-C_FN3d85d4rrpbQqhvoScjIAYpVrLFS7r7tIOfTlIL5nlrcHesCbWtG1f4hZaeFRTl"></script>
    <script src="script.js"></script>

    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>