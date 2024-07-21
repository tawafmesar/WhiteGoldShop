<?php

/*

============================================================
=== manage users page
=== you can add | edit | delete users from here
============================================================
*/

session_start();


  if (isset($_SESSION['userses'])) {

      include 'ini.php';

        $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

        // START MANAGE page

      if ($do == 'manage'){ // start manage users page



                  // select all users exept Admin

                  $stmt = $con->prepare("      SELECT 
                  o.order_id,
                  o.order_total,
                  o.order_status,
                  o.order_date,
                  u.user_id,
                  u.user_name,
                  u.user_phone,
                  u.user_email
              FROM 
                  confirmorder o 
              JOIN 
                  users u ON o.order_userid = u.user_id
              ORDER BY 
                  o.order_id DESC");

                  // execute the statement

                  $stmt->execute();

                  // assign to variable

                  $rows = $stmt->fetchall();

                  if (! empty($rows)) {


                ?>

              <h1 class="text-center">أدارة الطلبات</h1>
              <div class="container">
                    <div class="table-responsive">
                          <table class="main-table text-center table table-borderd">
                                <tr>
                                    <td>رقم الطلب</td>
                                    <td>المبلغ</td>
                                    <td>التاريخ والوفت</td>
                                    <td>اسم العميل</td>
                                    <td>رقم العميل</td>
                                    <td> ايميل العميل </td>
                                    <td>تفاصيل الطلب</td>
                                    <td>التحكم</td>
                                </tr>

                                <?php

                                    foreach ($rows as $row) {

                                    //   $user_create= $row['user_create'];
                                    //   $timestamp = strtotime($user_create);                                    
                                    //   $date = date('Y-m-d', $timestamp);
                
                                          echo "<tr>";
                                                echo "<td>" . $row['order_id'] . "</td>" ;
                                                echo "<td>" . $row['order_total'] . "</td>" ;
                                                echo "<td>" . $row['order_date'] . "</td>" ;
                                                echo "<td>" . $row['user_name'] . "</td>" ;
                                                echo "<td>" . $row['user_phone'] . "</td>" ;
                                                echo "<td>" . $row['user_email'] . "</td>" ;

                                                echo "<td>   
                                                 <a href='orders.php?do=Details&orderid=" . $row['order_id'] . "' class=' btn btn-success'><i class='fa fa-invose' ></i> تفاصيل</a>                                                </td>";

                                              echo "<td>";
                                              
                                              if ($row['order_status'] == 1) {

                                                echo "<a href='orders.php?do=Finish&orderid=" . $row['order_id'] . "' class='btn btn-info activate'><i class='fa fa-check-square-o' ></i> تم التسليم</a>";

                                             }

                                             echo" <a href='orders.php?do=Delete&orderid=" . $row['order_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' ></i> حذف</a>";


                                          echo  "</td>";
                                          echo "</tr>";
                                    }

                                 ?>

                          </table>
                    </div>



              </div>

            <?php }else {

              echo 'لا يوجد اي مستخدم';

            }

             ?>


      <?php    // end manage users page
               // start users page
          } elseif ($do == 'Details' ) { // add users page

            $orderid = (isset($_GET['orderid']) && is_numeric($_GET['orderid'])) ?  intval($_GET['orderid']) : 0;

            $stmt = $con->prepare(" SELECT 
            o.order_id,
            o.order_total,
            o.order_status,
            o.order_date,
            u.user_id,
            u.user_name,
            u.user_phone,
            u.user_email
        FROM 
            confirmorder o 
        JOIN 
            users u ON o.order_userid = u.user_id
        WHERE  
            o.order_id = ?
        ORDER BY 
            o.order_id DESC");


            $stmt->execute(array($orderid));

            // assign to variable

            $order = $stmt->fetch();

            if (! empty($order)) { 
             ?>
         <div class="container home-stats text-center mb-5">
         <h1>تفاصيل الطلب</h1>
         <div class="row">
            <div class="col-md-3">
              <div class="stat st-members">
               
                  <div class="info">
                  
                          رقم الطلب
                          <span> <?php echo $order['order_id']; ?>
                          </span>
                
                  </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat st-pending">
                  
                   <div class="info">
                   
                          العميل
                          <span> <?php echo $order['user_name']; ?>
                       
                  </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat st-items">
                 
                    <div class="info">
                      
                        رقم الجوال 
                        <span> <?php echo $order['user_phone']; ?>
                            </span>
                       
                    </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat st-comments">
                  <div class="info">
                    البريد الألكتروني
                    <span> <?php echo $order['user_email']; ?>
                  </div>
              </div>
            </div>

         </div>
    </div>

    <?php
    $stmt = $con->prepare("SELECT 
                               
    oi.order_items_id,
    i.items_name,
    i.items_price,
    oi.quantity
FROM 
    order_items oi
JOIN 
    items i ON oi.item_id = i.items_id
JOIN 
    confirmorder co ON oi.confirmorder_id = co.order_id
WHERE 
    co.order_id = ?
                                                 ");

                   // execute the statement

                   $stmt->execute(array($orderid));

                   // assign to variable

                   $items = $stmt->fetchall();

                   if (! empty($items)) {


                 ?>

               <div class="container">
                     <div class="table-responsive">
                           <table class="main-table text-center table table-borderd">
                                 <tr>
                                     <td>#ID</td>
                                     <td>الاسم</td>
                                     <td >المبلغ</td>
                                     <td >الكمية</td>
                                     <td >اجمالي المبلغ</td>

                                 </tr>
                                 <?php


                                 $totalprice = 0;
                                 $ordertotalprice = 0;

                                     foreach ($items as $item) {
                                        $totalprice = $item['items_price'] * $item['quantity'];
                                           echo "<tr>";
                                                 echo "<td>" . $item['order_items_id'] . "</td>" ;
                                                 echo "<td>" . $item['items_name'] . "</td>" ;
                                                 echo "<td>" . $item['items_price'] . "</td>" ;
                                                 echo "<td>" . $item['quantity'] . "</td>" ;
                                                 echo "<td>" . $totalprice ."</td>" ;
                                           echo "</tr>";
                                           $ordertotalprice+=$totalprice;
                                     }

                                  ?>
                                 <tr>
                                     <td></td>
                                     <td></td>
                                     <td ></td>
                                     <td >الأجمالي</td>
                                     <td style="border: solid 2px #C1175A;"><?php echo $ordertotalprice ; ?> </td>

                                 </tr>
                           </table>
                     </div>
               </div>

                  <?php } }

      }elseif ($do == 'Insert') { // insert member page


                      // check if user come from forms or any page

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  echo '<h1 class="text-center">إضافة مستخدم</h1>';
                  echo "<div class='container'>";

                    // Get variables from the page

                    $user  = $_POST['username'];
                    $pass  = $_POST['password'];
                    $email = $_POST['email'];
                    $phone  = $_POST['phone'];

                    $hashpass = sha1($_POST['password']);

                    // Validate the form

                     $formErrors = array();

                     if (strlen($user) < 4) {

                      $formErrors[] = 'اسم المستخدم يجب ان يكون اطول من 4 احرف';

                     }



                     if (empty($pass)) {

                       $formErrors[] = 'كلمة المرور لا يمكن ان تكون فارغة';

                     }


                    if (empty($user)) {

                      $formErrors[] = 'اسم المستخدم  لا يمكن ان يكون فارغ';

                    }


                    //loop into errors array and echo it
                    foreach ($formErrors as $error) {

                        echo  '<div class="alert alert-danger">' .  $error . '</div>';
                    }

                    // check if there's no error proceed the update operation

                    if (empty($formErrors)) {

                      // check if user exist in database

                      $check = checkItem("user_email", "users" , $email);

                      if ($check == 1 ) {

                          $msg = "للأسف البريد الألكتروني مسجل بحساب  سابق";
                          redirectHome($msg , 'back' );

                      } else {

                            // insert user info into the datebase     VALUES(:zuser, :zpass , :zmail , :zname)");

                            $stmt = $con->prepare("INSERT INTO
                                                    users(user_name, user_password, user_email , user_phone	 , user_approve )
                                                    VALUES(:zuser, :zpass , :zmail , :zphone , 2 )");
                            $stmt->execute(array(

                                  'zuser' => $user,
                                  'zpass' => $hashpass,
                                  'zmail' => $email,
                                  'zphone' => $phone

                            ));

        
                           // echo success message

                           $the =  '<div class="alert alert-success">'.$stmt->rowCount() . '  Record inserted'.'</div>';

                            redirectHome($the , 'back' );

                         }

                       }

                    } else {

                        echo "<div class='container'>";


                           $error = " <div class='alert alert-danger'>لايمكن فتح هذه الصفحة  </div>";

                           redirectHome($error , 3);

                        echo "</div>";

                    }

                    echo "</div>";



        } // end edit page
                   elseif ( $do == 'Finish') { // start update page

                    
            echo '<h1 class="text-center">تم التسليم </h1>';
            echo "<div class='container'>";


              $orderid = (isset($_GET['orderid']) && is_numeric($_GET['orderid'])) ?  intval($_GET['orderid']) : 0;

                  // check user if not exesit

                      $check = checkItem('order_id' , 'confirmorder' , $orderid );

                  // if there is such id show the form

                  if ($check > 0) {


                    $stmt = $con->prepare("UPDATE confirmorder SET order_status = 2  WHERE order_id   = ?  ");
                    $stmt->execute(array($orderid ));


                      // WE CAN USE THIS QUERY BUT CHING :ZUSER ? $stmt->execute(array($userid));

                    $theMsg = '<div class="alert alert-success">تم حفظ الطلب </div>';

                    redirectHome($theMsg , 'back' ,4);

                    echo '</div>';


                  }  else {


                      $error = '<div class="alert alert-danger">لايوجد هذا الطلب</div>';

                      redirectHome($error);

                    }


                echo '</div>';

                }  // end update page

        elseif ($do =='Delete') { //  start delelt member page

            echo '<h1 class="text-center">حذف طلب</h1>';
            echo "<div class='container'>";


            // Check if get request userid is numeric and get the integer value of it

            /*  if (isset($_GET['userid']) && is_numeric($_ ['userid'])){
                echo intval($_ ['userid']);
              }else { echo 0; }  */
              $orderid = (isset($_GET['orderid']) && is_numeric($_GET['orderid'])) ?  intval($_GET['orderid']) : 0;

                  // check user if not exesit

                      $check = checkItem('order_id' , 'confirmorder' , $orderid );

                  // if there is such id show the form

                  if ($check > 0) {


                         $stmt = $con->prepare("DELETE FROM confirmorder WHERE order_id  = :zorder");

                         $stmt->bindParam(":zorder" , $orderid );

                         $stmt->execute();
                      // WE CAN USE THIS QUERY BUT CHING :ZUSER ? $stmt->execute(array($userid));

                    $theMsg = '<div class="alert alert-success">تم حذف الطلب</div>';

                    redirectHome($theMsg , 'back' ,4);

                    echo '</div>';


                  }  else {


                      $error = '<div class="alert alert-danger">لايوجد هذا الطلب</div>';

                      redirectHome($error);

                    }


                echo '</div>';

        }


      include $tpl . 'footer.php';

  } else {

      header('Location: index.php');

      exit();
  }
