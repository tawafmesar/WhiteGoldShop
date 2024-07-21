<?php

/*

============================================================

=== Items page

============================================================

*/

session_start();

  $pagetitle = 'Items';

  if (isset($_SESSION['userses'])) {

      include 'ini.php';

        $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

        // START MANAGE page

         if ($do == 'manage'){

                // start manage items page


                   // select all users exept Admin

                   $stmt = $con->prepare("SELECT
                                                *
                                                FROM items

                                               
                                               ORDER BY
                                               items_id 
                                                DESC
                                                 ");

                   // execute the statement

                   $stmt->execute();

                   // assign to variable

                   $items = $stmt->fetchall();

                   if (! empty($items)) {


                 ?>

               <h1 class="text-center">إدارة المنتجات</h1>
               <div class="container">
               <a href="items.php?do=Add" class="btn btn-primary mb-4"><i class="fa fa-plus"> إضافة جديد</i></a>

                     <div class="table-responsive">
                           <table class="main-table text-center table table-borderd">
                                 <tr>
                                     <td>#ID</td>
                                     <td>الاسم</td>
                                     <td>الوصف</td>
                                     <td>السعر الحالي</td>
                                     <td>السعر السابق</td>
                                     <td >الصورة</td>
                                     <td >التحكم</td>

                                 </tr>
                                 <?php

                                     foreach ($items as $item) {
                                           echo "<tr>";
                                                 echo "<td>" . $item['items_id'] . "</td>" ;
                                                 echo "<td>" . $item['items_name'] . "</td>" ;
                                                 echo "<td>" . $item['items_name'] . "</td>" ;
                                                 echo "<td>" . $item['items_price'] . "</td>" ;
                                                 echo "<td>" . $item['items_old_price'] ."</td>" ;
                                                 echo "<td style='width: 20%;'><img src='../upload/items/".$item['items_image']."' class='img-fluid rounded object-cover w-full' >
                                                 </td>" ;
                                               echo "<td>
                                                   <a href='items.php?do=Edit&itemid=" . $item['items_id'] . "' class=' btn btn-success'><i class='fa fa-edit' ></i> تعديل</a>
                                                   <a href='items.php?do=Delete&itemid=" . $item['items_id'] . "' class='btn btn-danger confirm'><i class='fa fa-trash-o' ></i>  حذف </a>";

                                           echo  "</td>";
                                           echo "</tr>";
                                     }

                                  ?>

                           </table>
                     </div>
               </div>


             <?php   }else {
               echo '<div class="container">';
                 echo '<div class="nice-message">لأيوجد أصناف لعرضها</div>';
                 echo '<a href="items.php?do=Add" class="btn btn-sm btn-primary">
                     <i class="fa fa-plus"></i> أضافة جديد
                   </a>';
               echo '</div>';

             }
              // end manage items page


           }

         elseif ($do == 'Add' ) { // add category page  ?>

                 <h1 class="text-center">أضافة منتج جديد</h1>
                 <div class="container">
                   <form class="form-horizontal" action="?do=Insert" method="POST"  enctype="multipart/form-data">
                         <!-- start Name field -->
                     <div class="form-group form-group-lg">
                          <label class="col-sm-2 control-label">الاسم</label>
                          <div class="col-sm-10 col-md-4">
                                <input
                                   type="text"
                                   name="file_name"
                                   class="form-control"
                                   required="recuired"
                                   placeholder="اسم المنتج">
                          </div>
                     </div>
                      <!-- end name field -->
                      <!-- start Description field -->
                     <div class="form-group form-group-lg">
                       <label class="col-sm-2 control-label">الوصف</label>
                       <div class="col-sm-10 col-md-4">
                             <input
                                 type="text"
                                 name="description"
                                 class="form-control"
                                 required="recuired"
                                placeholder="وصف للمنتج">
                       </div>
                     </div>
                     <!-- end Description field -->
                     <!-- start PRICE field -->
                    <div class="form-group form-group-lg">
                      <label class="col-sm-2 control-label">السعر الحالي</label>
                      <div class="col-sm-10 col-md-4">
                            <input
                                type="text"
                                name="price"
                                class="form-control"
                                required="recuired"
                               placeholder="سعر المنتج الحالي">
                      </div>
                    </div>
                    <!-- end PRICE field -->
                    <!-- start PRICE field -->
                    <div class="form-group form-group-lg">
                      <label class="col-sm-2 control-label">السعر السابق</label>
                      <div class="col-sm-10 col-md-4">
                            <input
                                type="text"
                                name="oldprice"
                                class="form-control"
                                required="recuired"
                               placeholder="سعر المنتج السايق">
                      </div>
                    </div>
                    <!-- end PRICE field -->
                  <!-- start PRICE field -->
                  <div class="form-group form-group-lg mb-4">
                      <label class="col-sm-2 control-label">صورة المنتج</label>
                      <div class="col-sm-10 col-md-4">
                            <input
                                class="form-control"
                                type="file" name="fileToUpload"
                                required="recuired"
                              >
                      </div>
                    </div>
                    <!-- end PRICE field -->
 
                   
                           <!-- start button field -->
                           <div class="form-group ">
                                <div class="col-sm-offset-2 col-sm-10">
                                      <input type="submit" value="أضافة" class="btn btn-lg btn-primary">
                                </div>
                           </div>
                            <!-- end button field -->
                   </form>



                 </div>

                 <?php


        }elseif ($do == 'Insert') { // insert items page

                  // check if user come from forms or any page

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

              echo '<h1 class="text-center">أضافة منتج</h1>';
              echo "<div class='container'>";


              $file_name = filterRequest("file_name") ; 
              $desc  = filterRequest("description") ; 
              $price = filterRequest("price") ; 
              $oldprice = filterRequest("oldprice") ; 
            
              $file_path = imageUpload("fileToUpload");
              
              $data = array(
                  "items_name"  =>   $file_name ,
                  "items_desc"  =>   $desc,
                  "items_image"  =>   $file_path,
                  "items_price"  =>   $price,
                   "items_old_price"  =>   $oldprice
              
                  
              );
              
              
             $count = insertData("items" ,$data) ; 

              
             if ($count > 0) {
             
              $theMsg = '<div class="alert alert-success">تم إضافة المنتج بنجاح</div>';

              redirectHome($theMsg , 'back' );

            }



                } else {

                    echo "<div class='container'>";


                       $error = " <div class='alert alert-danger'>sorry you cant browse this page dirctory </div>";

                       redirectHome($error , 3);

                    echo "</div>";

                }

                echo "</div>";




       }elseif ($do == 'Edit') { //start edite page


           $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid'])) ?  intval($_GET['itemid']) : 0;


           $stmt = $con->prepare("SELECT * FROM items WHERE items_id  = ?");

               // ececute query

                   $stmt->execute(array($itemid));

               // FETCH THE DATA

                   $item   = $stmt->fetch();

               // the row coun

                   $count = $stmt->rowCount();

               // if there is such id show the form

               if ($count > 0) {
                    ?>

                       <h1 class="text-center">تعديل منتج </h1>
                       <div class="container">
                       <div class="col-md-10 w-full h-full mb-4 ">
                                <img src="../upload/items/<?php echo $item['items_image']; ?>" class="img-fluid rounded object-cover w-full ">
                         </div>
                         <form class="form-horizontal" action="?do=Update" method="POST"  enctype="multipart/form-data">
                           <input type="hidden" name="itemid" value="<?php echo $itemid ; ?>">
                               <!-- start Name field -->
                           <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">اسم المنتج</label>
                                <div class="col-sm-10 col-md-4">

                                      <input
                                         type="text"
                                         name="file_name"
                                         class="form-control"
                                         required="recuired"
                                         placeholder="Name of the items"
                                         value="<?php echo $item['items_name'] ; ?>"
                                         />
                                </div>
                           </div>
                            <!-- end name field -->
                            <!-- start Description field -->
                           <div class="form-group form-group-lg">
                             <label class="col-sm-2 control-label">الوصف</label>
                             <div class="col-sm-10 col-md-4">
                                   <input
                                       type="text"
                                       name="description"
                                       class="form-control"
                                       required="recuired"
                                       placeholder="Description of the items"
                                       value="<?php echo $item['items_desc'] ; ?>"
                                      />
                             </div>
                           </div>
                           <!-- end Description field -->
                           <!-- start PRICE field -->
                          <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">السعر الحالي</label>
                            <div class="col-sm-10 col-md-4">
                                  <input
                                      type="text"
                                      name="price"
                                      class="form-control"
                                      required="recuired"
                                      placeholder="سعر المنتج الحالي"
                                      value="<?php echo $item['items_price'] ; ?>"
                                     />
                            </div>
                          </div>
                          <!-- end PRICE field -->
                        <!-- start PRICE field -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">السعر السابق</label>
                            <div class="col-sm-10 col-md-4">
                                  <input
                                      type="text"
                                      name="oldprice"
                                      class="form-control"
                                      required="recuired"
                                      placeholder="سعر المنتج السابق"
                                      value="<?php echo $item['items_old_price'] ; ?>"
                                     />
                            </div>
                          </div>
                          <!-- end PRICE field -->

                          <input type="hidden" name="oldphoto" value="<?php echo $item['items_image']; ?>" />

                  <!-- start PRICE field -->
                  <div class="form-group form-group-lg mb-4">
                      <label class="col-sm-2 control-label">صورة المنتج</label>
                      <div class="col-sm-10 col-md-4">
                            <input
                                class="form-control"
                                type="file" name="fileToUpload"
                              >
                      </div>
                    </div>
                    <!-- end PRICE field -->



                                 <!-- start button field -->
                                 <div class="form-group ">
                                      <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" value="حفظ" class="btn btn-lg btn-primary">
                                      </div>
                                 </div>
                                  <!-- end button field -->
                         </form>


                       </div>

                    <?php
                    } else {

                           // IF THERE IS NO SUCH ID SHOW ERROR MESSAGE

                             echo "<div class='container'>";

                                   $theMsg = '<div class="alert alert-danger">Theres no such ID</div>';

                                    redirectHome($theMsg ,  4);

                             echo "</div>";

                             }
                    // end edit page
         } elseif ( $do == 'Update') {

           // start update page
           echo '<h1 class="text-center">Update Item</h1>';
           echo "<div class='container'>";

                 // check if user come from forms or any page

           if ($_SERVER['REQUEST_METHOD'] == 'POST') {


              if($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK){
                $file_path = imageUpload("fileToUpload");

              }else{
                $file_path = filterRequest("oldphoto");

              }

               $id      = $_POST['itemid'];
               $file_name = filterRequest("file_name") ; 
               $desc  = filterRequest("description") ; 
               $price = filterRequest("price") ; 
               $oldprice = filterRequest("oldprice") ; 
               

               
                $stmt = $con->prepare("UPDATE
                                            items
                                        SET
                                           items_name         = ? ,
                                             items_desc  = ? ,
                                             items_price   = ? ,
                                             items_old_price = ?,
                                             items_image     = ? 
                                        WHERE
                                          items_id       = ?  ");
                $stmt->execute(array($file_name,$desc, $price ,$oldprice ,$file_path , $id ));

                // echo success message


                $theMsg =  '<div class="alert alert-success">تم حفظ التعديلات</div>';

                  redirectHome($theMsg ,'back');

               
               } else {

             $theMsg =  '<div class="alert alert-danger">sorry you cant browse this page dirctory</div>';

             redirectHome($theMsg );

               }

               echo "</div>";


  } elseif ($do =='Delete') {
    //  start delelt member page

       echo '<h1 class="text-center">حذف</h1>';
       echo "<div class='container'>";



         $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid'])) ?  intval($_GET['itemid']) : 0;


             // the row coun

                 $check = checkItem('items_id', 'items' , $itemid );

             // if there is such id show the form

             if ($check > 0) {

                    $stmt = $con->prepare("DELETE FROM items WHERE items_id  = :zid");

                    $stmt->bindParam(":zid" , $itemid );

                    $stmt->execute();
                 // WE CAN USE THIS QUERY BUT CHING :ZUSER ? $stmt->execute(array($userid));

               $theMsg = '<div class="alert alert-success">'.$stmt->rowCount() . 'عنصر تم حذفه'.'</div>';

               redirectHome($theMsg , 'back' );

               echo '</div>';


             }  else {


                 $error = '<div class="alert alert-danger">هذا المفتاح غير موجود</div>';

                 redirectHome($error);

               }


           echo '</div>';



  } elseif ($do == 'Approve') {



              echo '<h1 class="text-center">Approve Item</h1>';
              echo "<div class='container'>";


              // Check if get request userid is numeric and get the integer value of it

              /*  if (isset($_GET['userid']) && is_numeric($_ ['userid'])){
                  echo intval($_ ['userid']);
                }else { echo 0; }  */
                $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid'])) ?  intval($_GET['itemid']) : 0;

              // select all data depend on this id


                        $checkid = checkItem('Item_ID' , 'items', $itemid );

                    // if there is such id show the form

                    if ($checkid> 0) {


                           $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");

                           $stmt->execute(array($itemid));

                        // WE CAN USE THIS QUERY BUT CHING :ZUSER ? $stmt->execute(array($userid));

                      $theMsg = '<div class="alert alert-success">'.$stmt->rowCount() . '  Record update'.'</div>';

                      redirectHome($theMsg , 'back');

                      echo '</div>';


                    }  else {


                        $error = '<div class="alert alert-danger">This ID is not exist</div>';

                        redirectHome($error);

                      }


                  echo '</div>';




        }
      include $tpl . 'footer.php';

  } else {

      header('Location: index.php');

      exit();
  }

    ob_end_flush(); // Release the Output
/*

  SELECT
        users.user_id,
        user.name,
        lang.lang_name

  FROM
        'users'  ,'langs'
  WHERE
          users.user_id = lang.lang_id


          SELECT
                 users.user_id,
                 user.name,
                 lang.lang_name

          FROM
                'users'
          INNER JOIN
                'langs'
          ON
                  users.user_id = lang.lang_id

*/


   ?>
