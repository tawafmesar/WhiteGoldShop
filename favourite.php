<?php
session_start();

include 'files/ini.php';

echo'    <!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>المفضلات</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->';

if (!isset($_SESSION['user'])) {
    echo '
<script>
    Swal.fire({
        title: "يجب عليك تسجيل الدخول",
        icon: "error",
        showConfirmButton: false,
        timer: 1950,
    });
  </script>';
    header("refresh:1.5;url=login.php");
}else{

    
    $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

    // START MANAGE page

  if ($do == 'manage'){ 
  

    $userid = $_SESSION['userid'];
 

    $stmt = $con->prepare("
                                SELECT 
                                        f.favorite_id ,
                                        f.favorite_usersid  ,
                                        f.favorite_itemsid  ,
                                        
                                        i.items_id, 
                                        i.items_image, 
                                        i.items_name, 
                                        i.items_name, 
                                        i.items_old_price,
                                       i.items_price 

                                    FROM 
                                          favorite f 
                                    JOIN 
                                        items i ON f.favorite_itemsid = i.items_id 
                                    WHERE 
                                        f.favorite_usersid = ?  ORDER BY
                                          favorite_id 
                                         DESC;
                                        
                                        ");


    $stmt->execute(array($userid));

    $allItems = $stmt->fetchall();

if (!empty($allItems)) {

    ?>
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
                    <a  href="favourite.php?do=Delete&favid=<?php echo $item['favorite_id'];?>">
                    حذف
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

} else {
    echo '		<div class="untree_co-section before-footer-section">
                     <div class="container">
                        <h1>لايوجد منتجات في المفضلة</h>
                    </div>
                </div>
                ';
}
} elseif ($do == 'Delete' ) {
    
    $favid = (isset($_GET['favid']) && is_numeric($_GET['favid'])) ?  intval($_GET['favid']) : 0;


    $stmt = $con->prepare("DELETE FROM favorite WHERE favorite_id = ?");
    $stmt->execute(array($favid)); 
    $count2 = $stmt->rowCount();

    
    if ($count2 > 0) {
                echo "<script>
                Swal.fire({
                    title: 'تم حذف المنتج من المفضلة',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1950,
                });
            </script>";

         header("refresh:1.5;url=favourite.php");

    }
    }
}

include 'files/footer.php';
ob_end_flush();
?>


</body>

</html>