<?php
require "connection.php";
$Product_id = $_POST["pid"];
$product_imges = Database::search("SELECT * FROM `product_images` WHERE `product_id` = '" . $Product_id . "' ORDER BY `id` DESC LIMIT 1 ");
$pim = $product_imges->fetch_assoc();
?>
<div class="col-12">
<img src="<?php echo $pim["image"]; ?>" class="img-fluid" >
</div>

<?php
$product_data = DATABASE::search("SELECT `title`,`description`,`product_date`,`price`,`qty`,`delivery_fee`,`status`,`condtion_type`,`brand_name`,`model_name`,`color`,`name`,`status_id`
FROM `product`
INNER JOIN `category` ON `product`.`category_id` =`category`.`id`
INNER JOIN STATUS ON
`product`.`status_id` =`status`.`id`
INNER JOIN `condtion` ON `product`.`condtion_id` =`condtion`.`id`
INNER JOIN `brand` ON `product`.`brand_id` =`brand`.`id`
INNER JOIN `model` ON `product`.`model_id` =`model`.`id`
INNER JOIN `color` ON `product`.`color_id` =`color`.`id`WHERE `product`.`id` ='" . $Product_id . "';");

$product_details = $product_data->fetch_assoc();

?>
<div class="offset-1 col-10  fw-bold p-2">
    <div class="row">
        <div class="col-4"><label class="col-12 fs-6">product id</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $Product_id; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product title</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["title"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product description</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["description"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product date</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["product_date"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product price</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["price"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product quantity</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["qty"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product delivery fee</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["delivery_fee"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product status</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["status"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product condition</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["condtion_type"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product category</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["name"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product brand name</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["brand_name"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product model name</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["model_name"]; ?></label></div>

        <div class="col-4"><label class="col-12 fs-6">product color</label></div>
        <div class="col-8"><label class="col-12 fs-6"><?php echo $product_details["color"]; ?></label></div>
        <?php
        $status_type =$product_details["status_id"];
        if($status_type==1){

            ?>

            <button type="button" id="product_id" value="<?php echo $Product_id; ?>" class="btn btn-danger" onclick="changeProductStatus(<?php echo $status_type; ?>);">Deactivate product</button>
            <?php
        }else{
            ?>
            <button type="button" id="product_id" value="<?php echo $Product_id; ?>"  class="btn btn-primary" onclick="changeProductStatus(<?php echo $status_type; ?>);" >Active product</button>
            <?php
        }
        ?>
    </div>
</div>
<?php
?>