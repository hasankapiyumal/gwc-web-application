<!DOCTYPE html>
<html>

<head>
    <title>GWC Computers Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/onlinelogomaker-110321-1822-7532-2000-transparent.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="wallcolor">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                require "header.php";
                ?>
            </div>
            <div class="col-12 text-white">
                <label class="form-label fs-1" for="">Cart</label><i class="bi bi-cart-check fs-1"></i>
            </div>
            <div class="col-12 ">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <?php
                            $user = $_SESSION["user"]["email"];
                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }
                            $page_data = DATABASE::search("SELECT * FROM `cart` WHERE `user_email`= '" . $user . "'");
                            $page_data_row = $page_data->num_rows;
                            $results_per_page = 6;

                            $number_of_pages = ceil($page_data_row / $results_per_page);

                            $page_first_result = ((int)$pageno - 1) * $results_per_page;


                            $total = "0";
                            $subtotal = "0";
                            $shipping = "0";
                            $items="0";
                            $cart_data = DATABASE::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");
                            $cart_data_row = $cart_data->num_rows;



                            if ($cart_data_row == 0) {
                            ?>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 emptycart"></div>
                                        <div class="col-12 text-center text-white">
                                            <label class="form-label fs-1 fw-bolder">You have no items in your
                                                Basket.</label>
                                        </div>
                                        <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4 text-white">
                                            <a href="index.php" class="btn btn-primary fs-3">Start Shopping...</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {


                                for ($x = 0; $x < $cart_data_row; $x++) {
                                  
                                    $cart_details = $cart_data->fetch_assoc();
                                    $product_id = $cart_details["product_id"];
                                    $product_data = DATABASE::search("SELECT `product`.`title`,`cart`.`qty`,`color`.`color`,`product_images`.`image`,`product`.`price`,`product`.`delivery_fee` FROM `product` INNER JOIN `color`  ON `product`.`color_id` =`color`.`id` INNER JOIN `product_images` ON `product`.`id`=`product_images`.`product_id` INNER JOIN `cart` ON `product`.`id`=`cart`.`product_id` WHERE `product`.`id`='" . $product_id . "'  LIMIT 1 ;");
                                    $product_row = $product_data->num_rows;
                                    $product_fetch = $product_data->fetch_assoc();
                                    $address_id = $_SESSION["user"]["address_id"];
                                    $address_data = DATABASE::search("SELECT `address`.`line1`,`address`.`line2`,`city`.`name` FROM `address` INNER JOIN `city` ON `address`.`city_id`=`city`.`id_city` WHERE `id`='" . $address_id . "';");
                                    $address_row = $address_data->num_rows;
                                    $address_fetch = $address_data->fetch_assoc();
                                    $cart_id = $cart_details["id"];
                                    $ship=$product_fetch["delivery_fee"];
                                    $cart_qty = $product_fetch["qty"];
                                ?>
                                    <div class="card mb-3 mt-2">
                                        <div class="row g-0">
                                            <div class="col-md-4 mt-3">
                                                <img style="height:250px ;" src="<?php echo $product_fetch["image"]; ?>" class="img-fluid rounded-start col-12 col-lg-4" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="card-title fs-4 fw-bold"><?php echo $product_fetch["title"]; ?></h5>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-6">
                                                        <h5> Price :<?php echo $product_fetch["price"]; ?></h5>
                                                            <h6 class=" fs-6 fw-bold">Product_id :<?php echo $product_id; ?></h6>
                                                            <h6> Qty :<?php echo $product_fetch["qty"]; ?></h6>
                                                            <h6>Color :<?php echo $product_fetch["color"]; ?></h6>
                                                            <h6>Delivery Fee :<?php echo $ship; ?></h6>
                                                            <h6>Delivery Address : <?php echo $address_fetch["line1"] ?>,<?php echo $address_fetch["line2"] ?>,<?php echo $address_fetch["name"]; ?></h6>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-6">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <a class="btn btn-outline-primary d-grid col-10 offset-1" href="<?php echo "singleproductview.php?id=".($product_id) ?>">Buy
                                                                        Now</a>
                                                                    <button class="btn btn-outline-danger d-grid col-10 offset-1 mt-2" onclick="deletefromCart(<?php echo $cart_id; ?>);">Remove
                                                                        From Cart</button>
                                                                </div>


                                                            </div>



                                                        </div>
                                                        <hr>
                                                        <div class="col-md-12 mt-3 mb-3">
                                                            <div class="row">
                                                                <div class="col-6 col-md-6">
                                                                    <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                                </div>
                                                                <div class="col-6 col-md-6 text-end">
                                                                    <span class="fw-bold fs-5 text-black-50">Rs.
                                                                        <?php echo ($product_fetch["price"] * $cart_details["qty"]) + $ship; ?> . 00 </i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $shipping =$shipping+$ship;
                                $items =$items+$cart_qty;
                                 $total = $total + ($product_fetch["price"]*$cart_details["qty"]);
                                }
                               
                                ?>
                                <div class="col-12 offset-lg-9  col-lg-3 text-white" >
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label  fs-3 fw-bolder">Summary</label>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-6">
                                <span class="fs-6 fw-bold">Items (<?php echo $items; ?>)</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold">Rs .<?php echo  $total; ?> . 00</span>
                            </div>
                            <div class="col-6 mt-3">
                                <span class="fs-6 fw-bold ">Shipping</span>
                            </div>
                            <div class="col-6 text-end mt-3">
                                <span class="fs-6 fw-bold">Rs . <?php echo $shipping; ?> . 00</span>
                            </div>
                            <div class="col-12 mt-3">
                                <hr>
                            </div>
                            <div class="col-6">
                                <span class="fs-4 fw-bold mt-3">Total</span>
                            </div>
                            <div class="col-6 text-end mt-3">
                                <span class="fs-5 fw-bold">Rs. <?php echo $total + $shipping; ?> . 00</span>
                            </div>
                            <div class="col-12 mt-3 mb-3 d-grid">
                                <button class="btn btn-primary fs-5 fw-bold" onclick="paynow(<?php echo $cr["product_id"]; ?>);" >CHECKOUT...</button>
                            </div>

                        </div>
                    </div>

                                <div class="col-12 mt-3 mb-3">
                                    <div class="row">

                                        <div class="text-center">
                                            <div class="pagination">
                                                <a href="<?php

                                                            if ($pageno <= 1) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno - 1);
                                                            }

                                                            ?>">&laquo;</a>

                                                <?php

                                                for ($page = 1; $page <= $number_of_pages; $page++) {
                                                    if ($page == $pageno) {
                                                ?>
                                                        <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                                <?php
                                                    }
                                                }

                                                ?>

                                                <a href="<?php

                                                            // if ($pageno <= 1) {
                                                            //     echo "?page=" . ($pageno + 1);
                                                            // } else {
                                                            //   echo "#";
                                                            // }

                                                            // or

                                                            if ($pageno >= $number_of_pages) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno + 1);
                                                            }


                                                            ?>">&raquo;</a>
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
            <?php
            require "footer.php";
            ?>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
</body>

</html>