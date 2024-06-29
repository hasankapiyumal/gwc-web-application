<?php

require "connection.php";

if (isset($_POST['k'])) {


    $k = $_POST['k'];
    $c = $_POST['c'];
    $b = $_POST['b'];
    $m = $_POST['m'];
    $con = $_POST['con'];
    $clr = $_POST['clr'];
    $pf = $_POST['pf'];
    $pt = $_POST['pt'];

    if (empty($k)  && empty($c) && empty($b) && empty($m)  && empty($con) && empty($clr) && empty($pf) && empty($pt)) {

        echo "please enter product or detail or select option";
    } else if (empty($k)  && empty($c) && empty($b) && empty($m)  && empty($con) && empty($clr) && empty($pf) && !empty($pt)) {









?>


        <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `price`>= '" . $pt . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `price`>= '" . $pt . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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


    } else if (empty($k)  && empty($c) && empty($b) && empty($m) && empty($con) && empty($clr) && !empty($pf) && empty($pt)) {



    

        ?>


          
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `price`<= '" . $pf . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `price`<= '" . $pf . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && empty($b) && empty($m) && empty($con) && !empty($clr) && empty($pf) && empty($pt)) {


       
        ?>


           
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `color_id`>= '" . $clr . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `color_id`>= '" . $clr . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && empty($b) && empty($m) && !empty($con) && empty($clr) && empty($pf) && empty($pt)) {


       

        ?>


           
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `condtion_id` = '" . $con . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `condtion_id`= '" . $con . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && empty($b) && !empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {



       

        ?>


            
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `model_id`='" . $m . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product`  WHERE `model_id`='" . $m . "'   LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && !empty($b) && empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {




     

        ?>


           
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `brand_id`='" . $b . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `brand_id`='" . $b . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && !empty($c) && empty($b) && empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {



        $productrs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $c . "' ;");
        $pb = $productrs->num_rows;

        for ($i = 0; $i < $pb; $i++) {}

            $abr = $productrs->fetch_assoc();

        ?>


            
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $c . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `category_id` = '" . $c . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (!empty($k)  && empty($c) && empty($b) && empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {

        ?>


        
            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' OR `description` LIKE '%" . $k . "%' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' OR `description` LIKE '%" . $k . "%'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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
        
    } else if (empty($k)  && empty($c) && empty($b) && empty($m) && empty($con) && empty($clr) && !empty($pf) && !empty($pt)) {



        ?>


           <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `price` >= '" . $pt . "' AND `price` <= '" . $pf . "'    ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `price` >= '" . $pt . "' AND `price` <= '" . $pf . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && empty($b) && empty($m) && !empty($con) && !empty($clr) && empty($pf) && empty($pt)) {


       

        ?>


            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `color_id` = '" . $clr . "' AND `condition_id`='" . $con . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `color_id` = '" . $clr . "' AND `condition_id`='" . $con . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && !empty($b) && !empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {



        

        ?>

<!-- card -->
<div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `model_id`='" . $m . "' AND  `brand_id` = '" . $b . "'  ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `model_id`='" . $m . "' AND  `brand_id` = '" . $b . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        

        echo "no items";
    } else if (empty($k)  && !empty($c) && !empty($b) && empty($m) && empty($con) && empty($clr) && empty($pf) && empty($pt)) {


      

        ?>


          <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $c . "' AND `brand_id` = '" . $b . "' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `category_id` = '" . $c . "' AND `brand_id` = '" . $b . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && empty($c) && !empty($b) && !empty($m) && !empty($con) && !empty($clr) && !empty($pf) && !empty($pt)) {





        ?>

<!-- card -->
<div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `brand_id`='" . $b . "' AND `model_id`='" . $m . "' AND `condtion_id`= '".$con."' AND `color_id` ='".$clr."' AND `price` >= '" . $pt . "' AND `price` <= '" . $pf . "'  ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `brand_id`='" . $b . "' AND `model_id`='" . $m . "' AND `condtion_id`= '".$con."' AND `color_id` ='".$clr."' AND `price` >= '" . $pt . "' AND `price` <= '" . $pf . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else if (empty($k)  && !empty($c) && !empty($b) && !empty($m) && !empty($con) && !empty($clr) && !empty($pf) && !empty($pt)) {




      

        ?>


           <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `brand_id`='" . $b . "' AND `model_id`='" . $m . "' AND `condtion_id`= '".$con."' AND `color_id` ='".$clr."' AND `price` >= '" . $pt . "' AND `price` <= '" . $pf . "' AND `category_id` ='".$c."' ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` SELECT * FROM `product` WHERE `brand_id`='" . $b . "' AND `model_id`='" . $m . "' AND `condtion_id`= '".$con."' AND `color_id` ='".$clr."' AND `price` >= '" . $pt . "' AND `price` <= '" . $pf . "' AND `category_id` ='".$c."' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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

        
    } else {



        ?>


            <!-- card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' OR `category_id` = '" . $c . "' OR `description` LIKE '%" . $k . "%'
            OR `brand_id` = '" . $b . "' OR `color_id` = '" . $clr . "' OR `price` >= '" . $pt . "' OR `price` <= '" . $pf . "'  OR `model_id`='" . $m . "' OR `condtion_id`= '".$con."'  ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $k . "%' OR `category_id` = '" . $c . "' OR `description` LIKE '%" . $k . "%'
            OR `brand_id` = '" . $b . "' OR `color_id` = '" . $clr . "' OR `price` >= '" . $pt . "' OR `price` <= '" . $pf . "'  OR `model_id`='" . $m . "' OR `condtion_id`= '".$con."'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
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


        <!-- pagination -->


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
}
?>