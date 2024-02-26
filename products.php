<?php
session_start();

include 'files/ini.php';

$stmt = $con->prepare("SELECT
  items.* 
  FROM items

  ORDER BY
  items_id 
  DESC
  ");


$stmt->execute();


$allItems = $stmt->fetchall();

if (!empty($allItems)) {




    ?>

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>منتجاتنا</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                <?php foreach ($allItems as $item) { ?>

                <div class="col-6 col-md-4 col-lg-3 col-sm-6 mb-5">
                <a class="product-item" href="details.php?itemid=<?php echo $item['items_id'];?>">
                        <img src="upload/items/<?php echo $item['items_image'];?>" class="img-fluid product-thumbnail">
                        <h3 class="product-title"><?php echo $item['items_name'];?></h3>
                        <strong class="product-price"><?php echo $item['items_price'];?></strong>
                        <span class="icon-cross">
                            <img src="images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                    </div>

                <?php } ?>




            </div>
        </div>
    </div>

    <?php

}


include 'files/footer.php';
ob_end_flush();
?>


</body>

</html>