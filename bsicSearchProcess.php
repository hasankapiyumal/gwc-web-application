<?php
require "connection.php";

if(isset($_POST["s"])){

    $text= $_POST["s"];

if($text==""){
echo "Please Enter Text to Search";
}else{
?>
<div class="row">
    <!-- <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
                               $data_new= DATABASE::search("SELECT product.id AS pid,product.title,product.price,product.qty,category.name 
                               FROM `product`
                              INNER JOIN `category` ON `product`.`category_id` =`category`.`id`
                              WHERE  ( `product`.`title` LIKE '%".$text."%' OR `category`.`name` LIKE '%".$text."%' ) AND `product`.`status_id` IN('1') ;");
                               $new_data_row=$data_new->num_rows;
                               for($a=0; $a<$new_data_row; $a++){

                                $new_data_fetch=$data_new->fetch_assoc();
                                $pid=$new_data_fetch["pid"];
                               $pqty=$new_data_fetch["qty"];
                               ?>
        <div class="col">
            <div class="card h-100">
                <?php
                                            $img_data=DATABASE::search("SELECT * FROM product_images WHERE product_id='".$pid."' LIMIT 1 OFFSET 0");
                                            $img_fetch=$img_data->fetch_assoc();
                                            ?>
                <img src="<?php echo $img_fetch["image"]; ?>" class="card-img-top" alt="..." style="height: 200px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $new_data_fetch["title"]; ?><span class="badge bg-danger">
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
                    <a  class="btn" onclick="addToWatchList(<?php echo $pid; ?>);"><i class="bi bi-heart-fill"></i></a>
                    <div class="col-12 ">
                        <div class="row">
                            <a  href="singleProductView.php?id=(<?php echo $pid; ?>);" class="col-lg-5 col-md-12 col-12 btn btn-outline-primary ">Buy
                                Now</a>
                            <button
                                class="col-lg-5 offset-lg-1 col-md-12 col-12 btn btn-outline-success  mt-1 mt-md-0"  onclick="addToCart(<?php echo $pid; ?>)">Add
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


    </div> -->

    <!-- new  card -->
    <!-- card -->
    <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $productrs = Database::search("SELECT product.id AS pid,product.title,product.price,product.qty,category.name 
            FROM `product`
           INNER JOIN `category` ON `product`.`category_id` =`category`.`id`
           WHERE  ( `product`.`title` LIKE '%".$text."%' OR `category`.`name` LIKE '%".$text."%' ) AND `product`.`status_id` IN('1') ;");
            $pb = $productrs->num_rows;
            $abr = $productrs->fetch_assoc();

            $results_per_page = 10;

            $number_of_pages = ceil($pb / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;


            $data_new = DATABASE::search("SELECT product.id AS pid,product.title,product.price,product.qty,category.name 
            FROM `product`
           INNER JOIN `category` ON `product`.`category_id` =`category`.`id`
           WHERE  ( `product`.`title` LIKE '%".$text."%' OR `category`.`name` LIKE '%".$text."%' ) AND `product`.`status_id` IN('1')  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ;");
            $new_data_row = $data_new->num_rows;
            while ($new_data_fetch = $data_new->fetch_assoc()) {


                $pid = $new_data_fetch["pid"];
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
                                    <a href="singleProductView.php?id=<?php echo $new_data_fetch["pid"]; ?>" class="col-lg-5 col-md-12 col-12 btn btn-outline-primary ">Buy
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
    <!-- new  card -->
</div>

<?php
}

}
?>