<?php

session_start();
require "connection.php";

$text = $_GET["s"];

if ($text == "") {
    $productrs = Database::search("SELECT * FROM `user` ");
} else {
    $productrs = Database::search("SELECT * FROM `user` WHERE `fname` LIKE '%".$text. "%' OR `lname` LIKE '%".$text."%' OR `email` LIKE '%".$text."%';  ");
}
$uid = "0";

$row = $productrs->num_rows;
$c = "0";

for ($i = 0; $i < $row; $i++) {
    $u = $productrs->fetch_assoc();

    $uid = $u["email"];

    $product_img = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $u["email"] . "' ORDER BY `id` DESC LIMIT 1 ");
    $pin = $product_img->num_rows;
    $pid = $product_img->fetch_assoc();

    $c = $c + 1;

?>

    <div class="row mt-1">
        <!-- <div class="col-lg-1 col-2 bg-primary text-white fw-bold pt-2">
            <span><?php echo $c; ?></span>
        </div>
        <div class="col-lg-2 bg-light fw-bold d-none d-lg-block">
            <div class="row">
                <div class="col-6" onclick="singleviewmodal(<?php echo $u['id']; ?>);">
                   

                </div>
            </div>
        </div> -->
        <div class="col-lg-3 col-3 bg-dark text-white fw-bold p-2">
            <span><?php echo $uid; ?></span>
        </div>
        <?php

        ?>
        <div class="col-lg-2 bg-warning fw-bold p-2 d-none d-lg-block" data-toggle="tooltip" title="This is a tooltip">
            <span><?php echo $u['fname']; ?></span>
        </div>
        <div class="col-2 col-lg-2 bg-dark text-white fw-bold p-2">
            <span><?php echo $u['lname']; ?></span>
        </div>
        <div class="col-lg-2 col-4  bg-warning fw-bold p-2">
            <span><?php echo $u['mobile']; ?></span>
        </div>
        <div class="col-lg-2 bg-dark text-white fw-bold p-2 d-none d-lg-block">
            <span><?php echo $u['register_date']; ?></span>
        </div>
        <div class="col-3 col-lg-1 bg-warning fw-bold p-2 ">
            <button class="btn btn-primary" type="button" onclick="userDetails('<?php echo $uid; ?>');">More</button>

        </div>
    </div>


<?php
}
?>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel"><?php echo $uid; ?></h5>

        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

    </div>
</div>

<!-- modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Product details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="view">
                <!-- <?php
                $product_imges = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $uid . "' ORDER BY `id` DESC LIMIT 1 ");

                $pim = $product_imges->fetch_assoc();
                ?>
                <img src="<?php echo $pid["code"]; ?>" class="img-fluid" width="200px;" height="150px;">
                <?php

                ?> -->
                <!-- <div id="view"></div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<?php


?>