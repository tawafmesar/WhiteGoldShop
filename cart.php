<?php
ob_start();
session_start();
$pagetitle = 'Show Items';
include 'files/ini.php';

echo '<!-- Start Hero Section -->
<div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>سلة المشتريات</h1>
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
} else {


    $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

    // START MANAGE page

  if ($do == 'manage'){ 
  
    $userid = $_SESSION['userid'];


    $stmt = $con->prepare("
                                SELECT 
                                        c.cart_id,
                                        c.cart_usersid,
                                        i.items_id, 
                                        i.items_image, 
                                        i.items_name, 
                                        i.items_price 
                                    FROM 
                                        cart c 
                                    JOIN 
                                        items i ON c.cart_itemsid = i.items_id 
                                    WHERE 
                                        c.cart_status = 1 AND
                                        c.cart_usersid = ?  ORDER BY
                                        cart_id 
                                        DESC;
                                        ");


    $stmt->execute(array($userid));

    $allItems = $stmt->fetchall();

    if (!empty($allItems)) {
        ?>

        <div class="untree_co-section before-footer-section">
            <div class="container">
                <div class="row mb-5">
                <form class="col-md-12" action="cart.php?do=Add" method="post">
    <div class="site-blocks-table">
        <table class="table ">
            <thead>
                <tr>
                    <th class="product-thumbnail">صورة المنتج</th>
                    <th class="product-name">الاسم</th>
                    <th class="product-price">السعر</th>
                    <th class="product-quantity">الكمية</th>
                    <th class="product-total">المجموع</th>
                    <th class="product-remove">حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $firstTotal = 0.00;

                foreach ($allItems as $item) {
                    $cart_usersid = $item['cart_usersid'];
                    $firstTotal+= $item['items_price'];

                    ?>
                <tr>
                    <td class="product-thumbnail">
                        <img src="upload/items/<?php echo $item['items_image'];?>" alt="Image" class="img-fluid">
                    </td>
                    <td class="product-name">
                        <h2 class="h5 text-black"><?php echo $item['items_name'];?></h2>
                    </td>
                    <td id="price<?php echo $item['items_id'];?>"><?php echo $item['items_price'] . '.00';?></td>
                    <td>
                        <div class="quantity">
                            <div class="select-quantity">
                            <input type="number" name="quantity<?php echo $item['items_id'];?>" id="quantity<?php echo $item['items_id'];?>" min="1" value="1" oninput="calculateTotal(<?php echo $item['items_id'];?>); calculateCartTotal()">
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="text" id="total<?php echo $item['items_id'];?>" name="total" value="<?php echo $item['items_price'] . '.00';?>" disabled>
                    </td>
                    <td><a href="cart.php?do=Delete&cartid=<?php echo $item['cart_id'];?>" class="btn btn-black btn-sm">X</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    
	<div class="row mt-5">
		<div class="col-md-6">
			<div class="row mb-5">
				<div class="col-md-6">
					<button class="btn btn-outline-black btn-sm btn-block">متابعة التسوق</button>
				</div>
			</div>
		</div>
		<div class="col-md-6 pl-5">
			<div class="row justify-content-end">
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-12 text-right border-bottom mb-5">
							<h3 class="text-black h4 text-uppercase"> الفاتورة</h3>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-md-6">
							<span class="text-black">المجموع</span>
						</div>
						<div class="col-md-6 text-right">
							<strong class="text-black" id="cartTotal"> <?php echo $firstTotal.'.00';?></strong>
                                <input type="hidden" name="cartTotal" value="<?php echo $firstTotal;?>" >
                                <input type="hidden" name="cart_usersid" value="<?php echo $cart_usersid;?>" >

                                
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-black btn-lg py-3 btn-block"
								type="submit" name="Add">تأكيد الطلب</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
    function calculateTotal(itemId) {
        var price = parseFloat(document.getElementById('price' + itemId).innerText);
        var quantity = parseInt(document.getElementById('quantity' + itemId).value);
        var total = price * quantity;
        document.getElementById('total' + itemId).value = total.toFixed(2);
    }

    function calculateCartTotal() {
        var cartTotal = 0;
        <?php foreach ($allItems as $item) { ?>
            var price = parseFloat(document.getElementById('price<?php echo $item['items_id'];?>').innerText);
            var quantity = parseInt(document.getElementById('quantity<?php echo $item['items_id'];?>').value);
            cartTotal += price * quantity;
        <?php } ?>
        document.getElementById('cartTotal').innerText = cartTotal.toFixed(2);
    }
</script>

                </div>



            </div>
        </div>



    <?php } else {
        echo '		<div class="untree_co-section before-footer-section">
                         <div class="container">
                            <h1>لايوجد منتجات في السلة</h>
                        </div>
                    </div>
                    ';
    }

    ?>


<?php 
} elseif ($do == 'Add' ) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {



                    $user  = $_POST['cart_usersid'];
                    $total  = $_POST['cartTotal'];


                    $stmt = $con->prepare("INSERT INTO
                    confirmorder(order_userid, order_total )
                    VALUES(:zuserid, :ztotal)");
                      
                      $stmt->execute(array(

                        'zuserid' => $user,
                        'ztotal' => $total

                        ));

                        $countt  = $stmt->rowCount();



                      
                      if ($countt > 0) {
                        $orderId = $con->lastInsertId();
                        



                        $stmt = $con->prepare("
                        SELECT 
                                c.cart_id,
                                c.cart_usersid,
                                i.items_price ,
                                i.items_id 
                    
                            FROM 
                                cart c 
                            JOIN 
                                items i ON c.cart_itemsid = i.items_id 
                            WHERE 
                                c.cart_status = 1 AND
                                c.cart_usersid = ?  ORDER BY
                                cart_id 
                                DESC;
                                ");
                    
                    
                    $stmt->execute(array($user));
                    
                    $allItems = $stmt->fetchall();
                    
                        foreach ($allItems as $item) {
                            $itemId = $item['items_id'];
                            $quantity = $_POST['quantity' . $itemId]; 
                            $price = $item['items_price'];
                    

                            $stmt = $con->prepare("INSERT INTO
                                 order_items(confirmorder_id , item_id , quantity,price )
                            VALUES(:zconfirmorder_id, :zitem_id , :zquantity , :zprice )");
                              
                              $stmt->execute(array(
        
                                'zconfirmorder_id' => $orderId,
                                'zitem_id' => $itemId,
                                'zquantity' => $quantity,

                                'zprice' => $price
        
                                ));
                    
                            
                            $counttt = $stmt->execute();

                            
                        if ($counttt > 0){

                            $stmt = $con->prepare("UPDATE cart SET cart_status = 2 WHERE cart_usersid = ? AND cart_status = 1");
                            $stmt->execute(array($user)); 

                            echo "<script>
                            Swal.fire({
                                title: 'تم تأكيد الطلب سيتم التواصل بك في اقرب وقت',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2500,
                            });
                          </script>";
                          header("refresh:2.5;url=index.php");

                        }

                        }
                    


      
  
                  
                                      }



                }
}elseif ($do == 'Delete') {

    $cartid = (isset($_GET['cartid']) && is_numeric($_GET['cartid'])) ?  intval($_GET['cartid']) : 0;
    $stmt = $con->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->execute(array($cartid)); 
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
        header("refresh:1.5;url=cart.php");

    }

}
} 

include 'files/footer.php';
ob_end_flush();
?>


</body>

</html>