<!DOCTYPE html>
<html>

<head>
    <title>gwc computers | Invoice</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/onlinelogomaker-110321-1822-7532-2000-transparent.png" />

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #f7f7ff;">
    <div class="container-fluid">

        <div class="row">
            <?php

            ?>
            <div class="col-12">
                <!-- header -->
                <?php
                require "header.php";
                //   require "connection.php";

                if (isset($_SESSION["user"])) {

                    $umail = $_SESSION["user"]['email'];
                    $oid = $_GET["id"];



                ?>
            </div>


            <div class="col-12">
                <hr />
            </div>

            <!-- save & print -->
            <div class="col-12" style="background-color:#1C1C1C;"></div>


            <div class="col-12 btn-toolbar justify-content-end">
                <button class="btn btn-dark me-2" onclick="printDiv();"><i class="bi bi-printer-fill"></i> &nbsp;Print</button>
                <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i>&nbsp;Save as
                    PDF</button>
            </div>



            <div class="col-12">
                <hr />
            </div>

            <div id="GFG">
                <div class="col-12">
                    <div class="row">

                        <div class="col-6">
                            <div class="invoiceheaderimg"></div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-end text-decoration-underline text-primary">
                                    <h2>GWC Computers</h2>
                                </div>
                                <div class=" col-12 text-end fw-bold">
                                    <span>Maradana, Colombo 10, Sri Lanka.</span><br />
                                    <span>gwccomputers@gmail.com</span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>
                        <div class="col-12 mb-4">
                            <div class="row">

                                <div class="col-6">
                                    <h5>INVOICE TO :</h5>
                                    <?php

                                    $addressrs = Database::search("SELECT `address`.`line1`,`address`.`line2`,`city`.`name` FROM `address` INNER JOIN `user` ON `address`.`id` =`user`.`address_id` INNER JOIN `city` ON `city`.`id_city`=`address`.`city_id` WHERE `user`.`email`='" . $umail . "';");
                                    $ar = $addressrs->fetch_assoc();
                                    ?>
                                    <h2><?php echo $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></h2>
                                    <span class="fw-bold"><?php echo $ar["line1"] . " " . $ar["line2"]; ?></span><br />
                                    <span class="fw-bold"><?php echo $ar["name"]; ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>

                                <?php
                                $invoicers = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ;");
                                $in = $invoicers->num_rows;
                                $ir = $invoicers->fetch_assoc();


                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary fw-bold">INVOICE 0<?php echo $ir["id"]; ?></h1>
                                    <span class="fw-bold">Date and Time of invoice :</span> &nbsp;
                                    <span class="wf-bold"><?php echo $ir["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <!-- table -->
                        <div class="col-12">
                            <table class="table ">

                                <!-- table head -->
                                <thead>
                                    <tr class=" border border-1 border-white">
                                        <th>#</th>
                                        <th>Order Id & product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>

                                <!-- table body -->
                                <tbody>
                                    <?php

                                    $invo = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ;");
                                    $inr = $invo->num_rows;


                                    $subtotal = "0";



                                    for ($i = 0; $i < $inr; $i++) {

                                        $irs = $invo->fetch_assoc();
                                        $product_id = $irs["product_id"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $product_id . "' ;");
                                        $pr = $productrs->fetch_assoc();


                                        $subtotal = $subtotal + $irs["total"];

                                    ?>
                                        <tr style="height: 70px;">
                                            <td class="bg-primary text-white fs-3"><?php echo $irs["id"]; ?></td>
                                            <td><a href="#" class="fs-6 fw-bold p-2"><?php echo  $irs["order_id"]; ?></a> <br>

                                                <a href="#" class="fs-6 fw-bold p-2"><?php echo $pr["title"]; ?></a>
                                            </td>

                                            <td class="fs-6 text-end pt-3" style="background-color: rgb(199, 199, 199)">Rs .
                                                <?php echo $pr["price"]; ?> .00</td>
                                            <td class="fs-6 text-end pt-3"><?php echo $irs["qty"]; ?></td>
                                            <td class="fs-6 text-end pt-3 bg-primary text-white">Rs . <?php echo $irs["total"]; ?> .00</td>

                                        </tr>
                                </tbody>
                            <?php
                                    }
                            ?>

                            <!-- table footer -->

                            <tfoot>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                    <td class="fs-5 text-end">Rs . <?php echo $subtotal; ?> .00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end border-primary">Discount</td>
                                    <td class="fs-5 text-end border-primary">Rs . 00 .00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0"></td>
                                    <td colspan="2" class="fs-5 text-end border-0 border-primary">GRAND TOTAL</td>
                                    <td class="fs-5  text-end border-0 border-primary">Rs . <?php echo $subtotal; ?> .00</td>
                                </tr>
                            </tfoot>

                            </table>
                        </div>
                        <!-- table  close-->

                        <div class="col-4 text-center" style="margin-top : -100px; margin-bottom :50px;">
                            <span class="fs-1"> Thank You !</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 ms-1 mb-3 border border-start border-end-0 border-top-0 border-bottom-0 border-5 border-primary rounded" style="background-color: #e7f2ff">
                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <label class="form-label fs-5 fw-bold">NOTICE :</label> <br>
                        <label class="form-label fs-5 ">Purchased items can return befor 7 days of delivery .. </label>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <hr class="border border-1 border-primary" />
            </div>

            <div class="col-12 mb-3 text-center">
                <label class="form-label fs-6 text-black-50 ">Invoice was created on a computer and is valid without the
                    Signature and Seal . </label>
            </div>




            <!-- footer -->
            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>

    <script src="bootstrap.bundle.js"></script>
</body>

</html>


<?php
                }
?>