<?php

/*

============================================================
=== manage users page
=== you can add | edit | delete users from here
============================================================
*/

session_start();

  $pagetitle = 'users';

  if (isset($_SESSION['userses'])) {

      include 'ini.php';

        $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

        // START MANAGE page

      if ($do == 'manage'){ // start manage users page



                  // select all users exept Admin

                  $stmt = $con->prepare("SELECT * FROM users WHERE user_groupID != 1    ORDER BY
                      user_id 
                      DESC");

                  // execute the statement

                  $stmt->execute();

                  // assign to variable

                  $rows = $stmt->fetchall();

                  if (! empty($rows)) {


                ?>

              <h1 class="text-center">أدارة المستخدمين</h1>
              <div class="container">
              <a href="?do=Add" class="btn btn-primary mb-4"><i class="fa fa-plus"> مستخدم جديد</i></a>

                    <div class="table-responsive">
                          <table class="main-table text-center table table-borderd">
                                <tr>
                                    <td>#ID</td>
                                    <td>اسم المستخدم</td>
                                    <td>البريد الألكتروني</td>
                                    <td>الجوال</td>
                                    <td>تاريخ التسجيل</td>
                                    <td>Control</td>
                                </tr>

                                <?php

                                    foreach ($rows as $row) {

                                      $user_create= $row['user_create'];
                                      $timestamp = strtotime($user_create);                                    
                                      $date = date('Y-m-d', $timestamp);

                                          echo "<tr>";
                                                echo "<td>" . $row['user_id'] . "</td>" ;
                                                echo "<td>" . $row['user_name'] . "</td>" ;
                                                echo "<td>" . $row['user_email'] . "</td>" ;
                                                echo "<td>" . $row['user_phone'] . "</td>" ;
                                                echo "<td>" . $date ."</td>" ;

                                              echo "<td>
                                                  <a href='users.php?do=Edit&userid=" . $row['user_id'] . "' class=' btn btn-success'><i class='fa fa-edit' ></i> تعديل</a>
                                                  <a href='users.php?do=Delete&userid=" . $row['user_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' ></i> حذف</a>";


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
          } elseif ($do == 'Add' ) { // add users page  ?>

                  <h1 class="text-center">إضافة مستخدم جديد</h1>
                  <div class="container">
                    <form class="form-horizontal" action="users.php?do=Insert" method="POST" >
                          <!-- start username field -->
                      <div class="form-group">
                           <label class="col-sm-2 control-label">اسم المستخدم</label>
                           <div class="col-sm-10 col-md-4">
                                 <input type="text" name="username" class="form-control"  autocomplete="off" required="recuired" placeholder="الأسم الكامل للمستخدم">
                           </div>
                      </div>
                       <!-- end username field -->
                      <!-- start email field -->
                      <div class="form-group">
                             <label class="col-sm-2 control-label">البريدالألكتروني</label>
                             <div class="col-sm-10 col-md-4">
                                   <input type="email" name="email" class="form-control" required="recuired" placeholder="البريد الألكتروني للمستخدم">
                             </div>
                        </div>
                         <!-- end emil field -->
                       <!-- start password field -->
                       <div class="form-group">
                            <label class="col-sm-2 control-label">كلمة المرور</label>
                            <div class="col-sm-10 col-md-4">
                                  <input type="password" name="password" class="password form-control" autocomplete="new-password" required="required" placeholder="كلمة المرور "/>
                                  <i class="show-pass fa fa-eye fa-2x"></i>
                            </div>
                       </div>
                        <!-- end password field -->

                         <!-- start full name field -->
                         <div class="form-group mb-4">
                              <label class="col-sm-2 control-label">رقم الجوال</label>
                              <div class="col-sm-10 col-md-4">
                                    <input type="phone" name="phone"  class="form-control" required="recuired" placeholder="رقم الجوال">
                              </div>
                         </div>
                          <!-- end full name field -->
                          <!-- start username field -->
                          <div class="form-group">
                               <div class="col-sm-offset-2 col-sm-10">
                                     <input type="submit" value="إضافة" class="btn btn-lg btn-primary">
                               </div>
                          </div>
                           <!-- end username field -->
                    </form>

                  </div>

                  <?php

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



        }elseif ($do == 'Edit') { //start edite page

          // Check if get request userid is numeric and get the integer value of it

          /*  if (isset($_GET['userid']) && is_numeric($_ ['userid'])){
              echo intval($_ ['userid']);
            }else { echo 0; }  */
            $userid = (isset($_GET['userid']) && is_numeric($_GET['userid'])) ?  intval($_GET['userid']) : 0;

          // select all data depend on this id

            $stmt = $con->prepare("SELECT * FROM users WHERE user_id  = ? LIMIT 1 ");

                // ececute query

                    $stmt->execute(array($userid));

                // FETCH THE DATA

                    $row   = $stmt->fetch();

                // the row coun

                    $count = $stmt->rowCount();

                // if there is such id show the form

                if ($count > 0) {

                   ?>

                           <h1 class="text-center">تعديل مستخدم</h1>

                           <div class="container">
                             <form class="form-horizontal" action="users.php?do=Update" method="POST" >
                                  <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                               <!-- start username field -->
                               <div class="form-group">
                                    <label class="col-sm-2 control-label">اسم المستخدم</label>
                                    <div class="col-sm-10 col-md-4">
                                          <input type="text" name="username" class="form-control" value="<?php echo $row['user_name'] ; ?>" autocomplete="off" required="recuired">
                                    </div>
                               </div>
                                <!-- end username field -->
                                <!-- start email field -->
                                <div class="form-group">
                                      <label class="col-sm-2 control-label">البريد الألكتروني</label>
                                      <div class="col-sm-10 col-md-4">
                                            <input type="email" name="email" value="<?php echo $row['user_email'] ; ?>" class="form-control" required="recuired">
                                      </div>
                                 </div>
                                  <!-- end emil field -->
                                <!-- start password field -->
                                <div class="form-group">
                                     <label class="col-sm-2 control-label">كلمة المرور</label>
                                     <div class="col-sm-10 col-md-4">
                                           <input type="hidden" name="oldpassword" value="<?php echo $row['user_password'] ; ?>" />
                                           <input type="password" name="newpassword" class="form-control" autocomplete="new-password"  placeholder="  يبقى هذا الحقل فارغ اذا لا تريد تغيير كلمة المرور"/>
                                     </div>
                                </div>
                                 <!-- end password field -->

                                  <!-- start full name field -->
                                  <div class="form-group mb-4">
                                       <label class="col-sm-2 control-label">رقم الجوال</label>
                                       <div class="col-sm-10 col-md-4">
                                             <input type="phone" name="phone" value="<?php echo $row['user_phone'] ; ?>" class="form-control" required="recuired" >
                                       </div>
                                  </div>
                                   <!-- end full name field -->
                                   <!-- start username field -->
                                   <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                              <input type="submit" value="حقظ" class="btn btn-lg btn-primary">
                                        </div>
                                   </div>
                                    <!-- end username field -->
                             </form>



                           </div>

                           <?php

                         } else {

                              // IF THERE IS NO SUCH ID SHOW ERROR MESSAGE

                                echo "<div class='container'>";

                                      $theMsg = '<div class="alert alert-danger">لايوجد هذا المستخدم</div>';

                                       redirectHome($theMsg ,  4);

                                echo "</div>";

                                }
                   }  // end edit page
                   elseif ( $do == 'Update') { // start update page
                      echo '<h1 class="text-center">تحديث بيانات مستخدم</h1>';
                      echo "<div class='container'>";

                            // check if user come from forms or any page

                      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                          // Get variables from the page

                          $id    = $_POST['userid'];
                          $user  = $_POST['username'];
                          $email = $_POST['email'];
                          $phone  = $_POST['phone'];



                          // password Trick
                          // by condition ? true : false :

                          $pass = empty($_POST['newpassword']) ? $pass = $_POST['oldpassword'] : $pass = sha1($_POST['newpassword']) ;

                          // Validate the form

                           $formErrors = array();

                           if (strlen($user) < 4) {

                            $formErrors[] = 'اسم المستخدم يجب ان يكون اطول من 4 احرف';

                           }


                          if (empty($user)) {

                            $formErrors[] = 'اسم المستخدم  لا يمكن ان يكون فارغ';

                          }
                          if (empty($email)) {

                            $formErrors[] = 'البريد الألكتروني لا يمكن ان يكون فارغ';

                          }


                          //loop into errors array and echo it
                          foreach ($formErrors as $error) {

                              echo  '<div class="alert alert-danger">' .  $error . '</div>';
                          }


                          // check if there's no error proceed the update operation

                          if (empty($formErrors)) {


                            $st = $con->prepare("SELECT * FROM users WHERE user_email	 = ? AND user_id  != ?
                                      ");

                            $st->execute(array($email,$id));

                            $count = $st->rowCount();

                            if ($count == 1) {

                              $theMsg =  '<div class="alert alert-danger">هذا المستخدم غير موجود</div>';

                              redirectHome($theMsg );

                            }

                            else {


                           $stmt = $con->prepare("UPDATE users SET user_name = ? , user_email = ? , user_phone = ? , user_password = ? WHERE user_id  = ?  ");
                           $stmt->execute(array($user,$email, $phone ,$pass ,$id ));

                           // echo success message


                           $theMsg =  '<div class="alert alert-success">تم حفظ التعديلات</div>';

                             redirectHome($theMsg ,'back', 4);
                           }
                          }
                          } else {

                        $theMsg =  '<div class="alert alert-danger">لايمكن فتح هذا الصفحة</div>';

                        redirectHome($theMsg );

                          }

                          echo "</div>";

                }  // end update page

        elseif ($do =='Delete') { //  start delelt member page

            echo '<h1 class="text-center">حذف مستخدم</h1>';
            echo "<div class='container'>";


            // Check if get request userid is numeric and get the integer value of it

            /*  if (isset($_GET['userid']) && is_numeric($_ ['userid'])){
                echo intval($_ ['userid']);
              }else { echo 0; }  */
              $userid = (isset($_GET['userid']) && is_numeric($_GET['userid'])) ?  intval($_GET['userid']) : 0;

                  // check user if not exesit

                      $check = checkItem('user_id' , 'users' , $userid );

                  // if there is such id show the form

                  if ($check > 0) {


                         $stmt = $con->prepare("DELETE FROM users WHERE user_id  = :zuser");

                         $stmt->bindParam(":zuser" , $userid );

                         $stmt->execute();
                      // WE CAN USE THIS QUERY BUT CHING :ZUSER ? $stmt->execute(array($userid));

                    $theMsg = '<div class="alert alert-success">تم حذف المستخدم</div>';

                    redirectHome($theMsg , 'back' ,4);

                    echo '</div>';


                  }  else {


                      $error = '<div class="alert alert-danger">لايوجد هذا المستخدم</div>';

                      redirectHome($error);

                    }


                echo '</div>';

        }


      include $tpl . 'footer.php';

  } else {

      header('Location: index.php');

      exit();
  }
