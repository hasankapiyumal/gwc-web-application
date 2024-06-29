<?php
session_start();
require "connection.php";
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>GWC Computers|View Orders</title>

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
                                <div class="offset-lg-3 offset-md-0 col-md-6 col-lg-3 col-12 offset-0 text-white mt-lg-3 mt-md-3 ">
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
                <div class="col-6 offset-3">
                    <h2 class="text-center">View Orders</h2>




                </div>

                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col ">product name</th>
                                <th scope="col">date</th>
                                <th scope="col">total</th>
                                <th scope="col">view more Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $order_data = DATABASE::search("SELECT `invoice`.`order_id`,`invoice`.`user_email`,`invoice`.`date`,`invoice`.`total`,`invoice`.`qty`,`product`.`id`,`product`.`title`,`product`.`price`,`product`.`delivery_fee`,`user`.`fname`,`user`.`lname`,`user`.`mobile`,`address`.`line1`,`address`.`line2`,`city`.`name` FROM `invoice` INNER JOIN `product` ON `invoice`.`product_id` =`product`.`id` INNER JOIN `user` ON `invoice`.`user_email` =`user`.`email` INNER JOIN `address` ON `user`.`address_id` =`address`.`id` INNER JOIN `city` ON `address`.`city_id` =`city`.`id_city` ORDER BY `invoice`.`date` DESC; ");
                            $order_num_rows  = $order_data->num_rows;

                            for ($x = 0; $x < $order_num_rows; $x++) {
                            $order_fetch=$order_data->fetch_assoc();
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $order_fetch["order_id"]; ?></th>
                                    <td><?php echo $order_fetch["title"]; ?></td>
                                    <td><?php echo $order_fetch["date"]; ?></td>
                                    <td><?php echo $order_fetch["total"]; ?></td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">more</button>

                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                            <div class="offcanvas-header">
                                                <h5 id="offcanvasRightLabel"><?php echo $order_fetch["title"] ?></h5>
                                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                               <h5>product id  <?php echo $order_fetch["id"]; ?>  </h5>
                                               <h5>product name : <?php echo $order_fetch["title"]; ?></h5>
                                               <h5>product price  <?php echo $order_fetch["price"]; ?></h5>
                                               <h5>product delivery fee <?php echo $order_fetch["delivery_fee"]; ?></h5>
                                               <h5>user first name <?php echo $order_fetch["fname"]; ?> </h5>
                                               <h5>user last name  <?php echo $order_fetch["lname"]; ?></h5>
                                               <h5>user email <?php echo $order_fetch["user_email"]; ?> </h5>
                                               <h5>mobile number  <?php echo $order_fetch["mobile"]; ?></h5>
                                               <h5>user addres  <?php echo $order_fetch["line1"]; ?> <?php echo $order_fetch["line2"]; ?> <?php echo $order_fetch["name"];?> </h5>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php
                            }

                            ?>



                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        </div>

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