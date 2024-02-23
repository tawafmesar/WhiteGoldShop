<?php
ob_start();
session_start();
$pagetitle = 'Show Items';
include 'files/ini.php';

$itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid'])) ? intval($_GET['itemid']) : 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!isset($_SESSION['user'])) {
    echo "<script>
    Swal.fire({
        title: 'يجب عليك تسجيل الدخول',
        icon: 'error',
        showConfirmButton: false,
        timer: 1950,
    });
  </script>";

  header("refresh:1.5;url=login.php");

  }else{

    
    if (isset($_POST['cart'])) {
      $userid = $_SESSION['userid'];
      $itemid = $_POST['itemid'];
  
      $data = array(
        "cart_itemsid" => $itemid,
        "cart_usersid" => $userid,
      );
  
      $countt = insertData("cart", $data);
      if ($countt > 0) {
        echo "<script>
                        Swal.fire({
                            title: 'تم اضافة المنتج للسلة',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1950,
                        });
                      </script>";
  
                      }


    }

    if (isset($_POST['delcart'])) {
      $userid = $_SESSION['userid'];
      $itemid = $_POST['itemid'];
   
    try {
      $stmt = $con->prepare("SELECT * FROM cart WHERE cart_usersid = ? AND cart_itemsid = ? AND cart_status = 1");
      $stmt->execute(array($userid, $itemid)); 
      $count = $stmt->rowCount();
      $fav=$stmt->fetch();

      $cart_id =$fav['cart_id'];
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
    
    $stmt = $con->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->execute(array($cart_id)); 
    $count2 = $stmt->rowCount();
    if ($count2 > 0) {
            echo "<script>
                      Swal.fire({
                          title: 'تم حذف المنتج من  السلة',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 1950,
                      });
                    </script>";

    }
  }

  if (isset($_POST['fav'])) {
    

    $userid = $_SESSION['userid'];
    $itemid = $_POST['itemid'];

    $data = array(
      "favorite_itemsid" => $itemid,
      "favorite_usersid" => $userid,
    );

    $countt = insertData("favorite", $data);
    if ($countt > 0) {
      echo "<script>
                      Swal.fire({
                          title: 'تم اضافة المنتج للمفضلة',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 1950,
                      });
                    </script>";

       header("refresh:1.5;url=details.php?itemid=" . $itemid);
                    }
    

  }

  if (isset($_POST['delfav'])) {
      $userid = $_SESSION['userid'];
      $itemid = $_POST['itemid'];
   
    try {
      $stmt = $con->prepare("SELECT * FROM favorite WHERE favorite_usersid = ? AND favorite_itemsid = ?");
      $stmt->execute(array($userid, $itemid)); 
      $count = $stmt->rowCount();
      $fav=$stmt->fetch();

      $fav_id =$fav['favorite_id'];
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
    
    $stmt = $con->prepare("DELETE FROM favorite WHERE favorite_id = ?");
    $stmt->execute(array($fav_id)); 
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

       header("refresh:1.5;url=details.php?itemid=" . $itemid);
    }
  }

  
  }

  /////
  




  
}

$stmt = $con->prepare("SELECT
                           * 

                           FROM items 

                    WHERE
                    items_id = ? ");

// Execute query
$stmt->execute(array($itemid));
$count = $stmt->rowCount();

if ($count > 0) {
  $item = $stmt->fetch();

  echo $itemid;
  ?>

  <!-- Start Hero Section -->
  <div class="details">
    <div class="container">
      <div class="flex flex-wrap row">
        <div class="headerr">
          <h3>
            منتجاتنا

          </h3>
          <h3>
            <i class="fa-solid fa-angle-left"></i>
          </h3>
          <h3>
            <?php echo $item['items_name']; ?>

          </h3>
        </div>
        <div class="img col-lg-6 col-md-12 col-12 w-full">
          <div class="col-md-10 w-full h-full ">
            <img src="upload/items/<?php echo $item['items_image']; ?>" class="img-fluid rounded object-cover w-full ">

          </div>
        </div>
        <div class="col-lg-5 col-md-12 col-12 mt-4">
          <div class="intro-excerpt">
            <h1>
              <?php echo $item['items_name']; ?><span>.</span> <span clsas="d-block"></span>
            </h1>

            <p class="mb-4">
              <?php echo $item['items_desc']; ?>
            </p>
            <div class="number mb-4">
              <h3>
                رقم 
                <?php echo $item['items_old_price']; ?>   
              </h3>
            </div>

            <div class="price mb-4">
              <span>
                <?php echo $item['items_old_price']; ?> ر.س
              </span>
              <h3>
                <?php echo $item['items_price']; ?> ر.س
              </h3>
            </div>

            <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="hidden" name="itemid" value="<?php echo $item['items_id']; ?>">
              <!-- <div class="quantity">
                <div class="select-quantity">
                  <h3>الكمية</h3>
                  <input type="number" name="quantity" value="1">
                </div>
              </div>
               -->
              <div class="sub-btn">
              <!-- <button name="cart" class="submit"><i class="fa-solid fa-cart-shopping"></i><span class="test">أضافة للسلة</span></button> -->
              
           
              <?php  
                if (!isset($_SESSION['user'])) {
                  echo '<button name="cart" class="submit"><i class="fa-solid fa-cart-shopping"></i><span class="test">أضافة للسلة</span></button>';
                  echo '<button name="fav" class="submit2"><i class="fa-solid fa-heart"></i><span class="test">أضافة للمفضلة</span></button>';

                }else{
                  $userid = $_SESSION['userid'];
                  $itemsid = $item['items_id'];
                  
                  $stmtCart = $con->prepare("SELECT * FROM cart WHERE cart_usersid = ? AND cart_itemsid = ?  AND cart_status = 1");
                  $stmtCart->execute(array($userid, $itemsid)); 
                  $countCart = $stmtCart->rowCount();

                  if (!$countCart > 0) {
                    echo '<button name="cart" class="submit"><i class="fa-solid fa-cart-shopping"></i><span class="test">أضافة للسلة</span></button>';
                  }else{
                    echo '<button name="delcart" class="submit"><i class="fa-solid fa-cart-shopping"></i><span class="test">حذف من السلة </span></button>';
                    }    
                  $stmt = $con->prepare("SELECT * FROM favorite WHERE favorite_usersid = ? AND favorite_itemsid = ?");
                  $stmt->execute(array($userid, $itemsid)); 
                  $count = $stmt->rowCount();
                  if (!$count > 0) {
                      echo '<button name="fav" class="submit2"><i class="fa-solid fa-heart"></i><span class="test">أضافة للمفضلة</span></button>';
                  }else{
                   echo '<button name="delfav" class="submit2"><i class="fa-solid fa-heart-crack"></i><span class="test"> حذف من المفضلة</span></button>';
                  }
                }
              

     

                      ?>
              
                 
            </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- End Hero Section -->

<?php }

include 'files/footer.php';
ob_end_flush();
?>


</body>

</html>