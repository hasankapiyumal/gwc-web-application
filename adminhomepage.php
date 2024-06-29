<?php
session_start();
require "connection.php";
if (isset($_SESSION["admin"])) {
?>
<!DOCTYPE html>
<html>

<head>
    <title>GWC Computers|Admin Homepage</title>

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
                <div class="row">
                    <div class="col-12  mt-0" style="height: 5px; background-color: red;"></div>
                    <div class="col-12 " style="background-color: black;">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="col-12 text-primary text-warning logo">
                                        <a style="text-decoration: none;" href="index.php"> gwc computers </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="offset-lg-3 offset-md-0 col-md-6 col-lg-3 col-12 offset-0 text-white mt-lg-3 mt-md-3 ">
                                <?php


                                    $admin = $_SESSION['admin'];
                                    ?>
                                <i class="bi bi-door-open-fill"></i><label class="fs-5"><?php echo $admin["name"];  ?>
                                </label>




                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  mt-0">
                <div class="row">
                    <div class="col-lg-2 d-none d-lg-block">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <a class="fs-5 fw-light mt-3 text-dark admin_options " href="viewOrders.php"><i
                                            class="bi bi-binoculars-fill"></i> view orders</a>
                                    <a class="fs-5 fw-light mt-3  text-dark admin_options" onclick="addcategory();"><i
                                            class="bi bi-tags-fill"></i> add category</a>
                                    <a class="fs-5 fw-light mt-3  text-dark admin_options" href="addproduct.php"><i
                                            class="bi bi-plus-circle-fill"></i> add product</a>
                                    <a class="fs-5 fw-light mt-3  text-dark admin_options" href="manageproduct.php"><i
                                            class="bi bi-box"></i>
                                        manage product</a>
                                    <a class="fs-5 fw-light mt-3  text-dark admin_options" href="manageUser.php"><i
                                            class="bi bi-people-fill"></i> manage users</a>
                                    <a class="fs-5 fw-light mt-3  text-dark admin_options" href="manageUser.php"><i
                                            class="bi bi-door-closed-fill"></i> log out</a>

                                </div>
                            </div>

                        </div>
                    </div>


                    <button class="btn btn-outline-primary d-block d-lg-none mt-3" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        view option Menu
                    </button>

                    <div class="offcanvas offcanvas-start d-block d-lg-none" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Options</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <a class="fs-5 fw-light mt-3  text-dark admin_options " href="viewOrders.php"><i
                                    class="bi bi-binoculars-fill"></i>
                                view orders</a><br>
                            <a class="fs-5 fw-light mt-3  text-dark admin_options " onclick="addcategory();"><i
                                    class="bi bi-tags-fill"></i> add
                                category</a><br>
                            <a class="fs-5 fw-light mt-3  text-dark admin_options" href="addproduct.php"><i
                                    class="bi bi-plus-circle-fill"></i>
                                add product</a><br>
                            <a class="fs-5 fw-light mt-3  text-dark admin_options" href="manageproduct.php"><i
                                    class="bi bi-box"></i>
                                manage product</a><br>
                            <a class="fs-5 fw-light mt-3  text-dark admin_options" href="manageUser.php"><i
                                    class="bi bi-people-fill"></i>
                                manage users</a><br>
                            <!-- <a class="fs-5 fw-light mt-3  text-dark admin_options" href="#"><i
                                    class="bi bi-door-closed-fill"></i>
                                log out</a> -->
                        </div>
                    </div>
                    <!-- homepage body  -->
                    <div class="col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 offset-lg-1  col-lg-3 mt-3 rounded-3" style="background-color: #041562;">
                                <h5 class="display-6 text-white mt-3 text-center">Daily Earnings </h5>
                                <?php
                                $d = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $d->setTimeZone($tz);
                                $date = $d->format('Y-m-d');
                                $daily_details_data =DATABASE::search("SELECT SUM(`total`) AS `daily_price` , COUNT(order_id) AS `orders` FROM invoice WHERE DATE(date) = '".$date."';   ");
                                $daily_details=$daily_details_data->fetch_assoc();

                                if($daily_details["daily_price"]==null){
                                ?>
                                <h5 class="display-6 text-white mt-3 text-center">0</h5>
                                <?php
                                }else{
                                ?>
                                <h5 class="display-6 text-white mt-3 text-center">
                                    <?php echo $daily_details["daily_price"]; ?> </h5>
                                <?php
                                }
                                ?>

                            </div>

                            <div class="col-12 offset-lg-1  col-lg-3 mt-3 rounded-3" style="background-color: #041562;">
                                <h5 class="display-6 text-white mt-3 text-center">Daily Orders </h5>
                                <h5 class="display-6 text-white mt-3 text-center"><?php echo $daily_details["orders"]; ?> </h5>
                            </div>

                            <div class="col-12 offset-lg-1 f col-lg-3 mt-3 rounded-3" style="background-color: #041562;">
                                <h5 class="display-6 text-white mt-3 text-center">New Users </h5>
                                <?php
                               $new_users_data =DATABASE::search("SELECT  COUNT(email) AS `users` FROM user WHERE DATE(register_date) = '".$date."';");
                               $new_user =$new_users_data->fetch_assoc();
                                ?>
                                <h5 class="display-6 text-white mt-3 text-center"><?php echo $new_user["users"]; ?> </h5>
                            </div>

                            <div id="barchart_material" class=" d-none d-lg-block col-lg-10 mt-3"
                                style="height: 500px;"></div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
    <!-- Modal add category-->
    <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" id="categorytxt">
                </div>
                <div class="col-12 mb-3">
                    <div class="row p-2">
                        <div class="col-12">
                            <label class="form-label lbl1">Add Product Image</label>
                        </div>

                        <img class="img-fluid col-4 col-md-2 ms-3 img-thumbnail" src="resources/addproductimg.svg"
                            id="prev">

                        <div class="col-12 mt-1">
                            <input class="d-none" type="file" accept="img/*" id="imguploader">
                            <label class="col-4 col-md-2 ms-1 btn btn-primary" for="imguploader"
                                onclick="changeImg();">Upload</label>
                        </div>
                    </div>
                </div>
                <!--product img -->

                <hr class="hrbreak1">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveCategory()">Save Category</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Sold Out Items', 'Total Orders'],
            <?php
             $year_data =DATABASE ::search("SELECT DISTINCT YEAR(`date`) AS `year` FROM `invoice`; ");
             $year_num =$year_data->num_rows;

             for($x=0; $x<$year_num; $x++){
                $year_details =$year_data->fetch_assoc();
               $performance_year= $year_details["year"];

               $total_data =DATABASE::search("SELECT SUM(`total`) AS addition FROM `invoice` WHERE YEAR(`date`) = '".$performance_year."';");
               $total =$total_data->fetch_assoc();

               $product_data =DATABASE::search("SELECT SUM(`qty`) AS `sold_out_products` FROM `invoice` WHERE YEAR(`date`) = '".$performance_year."';");
               $total_products =$product_data->fetch_assoc();
               $orders_data =DATABASE::search("SELECT COUNT(`order_id`) AS orders_count FROM `invoice` WHERE YEAR(`date`) = '".$performance_year."';");
               $orders =$orders_data->fetch_assoc();
               ?>['<?php echo $performance_year; ?>', <?php echo $total["addition"]; ?>,
                <?php echo $total_products["sold_out_products"]; ?>, <?php echo $orders["orders_count"]; ?>],
            <?php

             }
             
 ?>



        ]);

        var options = {
            chart: {
                title: 'GWC Computers Performance',
                subtitle: 'Sales, Sold Out Items, Total Orders',
            },
            bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    </script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>


<?php
} else {

    echo "Please sign in";
}
?>