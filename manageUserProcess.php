<?php
require "connection.php";
$user_email = $_POST["pid"];
$product_imges = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $user_email . "' ORDER BY `id` DESC LIMIT 1 ");
$pim = $product_imges->fetch_assoc();
?>
<div class="col-12">
    <img src="<?php echo $pim["code"]; ?>" class="img-fluid">
</div>

<?php
$product_data = DATABASE::search("SELECT * FROM user INNER JOIN gender ON gender.id =user.gender_id INNER JOIN address ON address.id =user.address_id
INNER JOIN city ON city.id_city =address.city_id  WHERE email ='" . $user_email . "'");

$user_details = $product_data->fetch_assoc();

?>
<div class="offset-1 col-10  fw-bold p-2">
    <div class="row">
        <div class="col-4"><label class="col-12 fs-6">User email</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_email; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">First name</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["fname"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">Last name</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["lname"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">Mobile</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["mobile"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">Gender</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["gender"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">Register date</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["register_date"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">Address Line1</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["line1"]; ?></label></div>
        
        
        <div class="col-4"><label class="col-12 fs-6">Address Line2</label></div>
       <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["line2"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">City</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $user_details["name"]; ?></label></div>


        <!-- <?php
                $status_type = $user_details["status_id"];
                if ($status_type == 1) {

                ?>

            <button type="button" id="product_id" value="<?php echo $Product_id; ?>" class="btn btn-danger" onclick="changeProductStatus(<?php echo $status_type; ?>);">Deactivate product</button>
            <?php
                } else {
            ?>
            <button type="button" id="product_id" value="<?php echo $Product_id; ?>"  class="btn btn-primary" onclick="changeProductStatus(<?php echo $status_type; ?>);" >Active product</button>
            <?php
                }
            ?> -->
    </div>
</div>
<?php
?>