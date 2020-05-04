<!doctype html><!--ISINYA LIST LIST VENDOR -->
<html class="no-js" lang="zxx">

<?php 
    include('header.php'); 
    require 'CONFIG.php';

    $key = getConnection();
?>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Future filter and sort area!!</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <div class="wrapper-list row"> 
        <?php
            $sql = "SELECT * FROM partner_product";
            $result = $key->prepare($sql);
            $result->execute();
            $i = 1;
            while($fetchdata = $result->fetch()):
                $imagesql = "SELECT image_path FROM product_image WHERE image_id = ?";
                $imageresult = $key->prepare($imagesql);
                $imageresult->execute([$fetchdata['image_id']]);
                $imagepath = $imageresult->fetch();
                $path = $imagepath['image_path'];

                $reviewsql = "SELECT SUM(rating) as rating, COUNT(rating) as total FROM review_product WHERE product_id = ?";
                $reviewresult = $key->prepare($reviewsql);
                $reviewresult->execute([$fetchdata['product_id']]);
                $reviewfetch = $reviewresult->fetch();
                $rating = 0;
                if($reviewfetch['total'] != 0){
                    $rating = $reviewfetch['rating'] / $reviewfetch['total'];
                }
                


                if($i > 3){
                    echo "<br>";
                    $i = 1;
                }
        ?> 
        <div class="col col-4"> 
            <!-- Card for vendor Start -->
            <!-- Container Start -->
            <div class="container-card">
                <!-- Card Start -->
                <div class="card"> 
                    <!-- Card : Head Start -->
                    <div class="card-head">
                        <img src="<?= $path?>" class="card-picture">
                    </div>
                    <!-- Card : Head End -->

                    <!-- Card : Body Start -->
                    <div class="card-body">
                        <!-- Product Desc Start -->
                        <div class="product-desc">
                            <!-- Nama Vendor -->
                            <span class="product-title">
                                <?= $fetchdata['product_title'] ?>
                            </span>

                            <!-- Jenis Vendor -->
                            <span class="product-caption">
                                <?= $fetchdata['product_type'] ?>
                            </span>

                            <!-- Lokasi Vendor -->
                            <span class="product-caption">
                                JAKARTA
                            </span>

                            <!-- Rating Bintang Vendor -->
                            <span class="product-rating">
                                <?php 
                                    if($rating < 1):
                                ?>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>

                                <?php
                                    elseif($rating >= 1 && $rating < 2):
                                ?>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>

                                <?php
                                    elseif($rating >= 2 && $rating < 3):
                                ?>

                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>

                                <?php 
                                    elseif($rating >= 3 && $rating < 4):
                                ?>

                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star grey"></i>
                                <i class="fa fa-star grey"></i>

                                <?php
                                    elseif($rating >= 4 && $rating < 5):
                                ?>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star grey"></i>

                                <?php
                                    else:
                                ?>

                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>

                                <?php
                                    endif;
                                ?>
                            <!-- Rating Angka Vendor -->
                            <span class="badge">
                                <?= $rating?> / 5
                            </span>
                            <!-- Review yang sudah diterima si Vendor -->
                            <span class="badge">
                                <?= $reviewfetch['total']?> Review
                            </span>

                            <!-- Tombol untuk akses info vendor -->
                            <a href="vendor_detail.php" class="card-button block"> View Pricelist</a>
                            

                        </div> <!-- Product Desc End -->
                    </div> <!-- Card : Body End -->
                </div> <!-- Container End -->
            </div> <!-- Card for vendor End -->
        </div>
        <?php
            $i = $i + 1;
        endwhile;
        ?>
    </div>


    <?php include('footer.php'); ?>
</html>