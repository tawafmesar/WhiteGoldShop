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

  $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

  // START MANAGE page

  if ($do == 'manage') {

    // start manage items page


    // select all users exept Admin

    $stmt = $con->prepare("SELECT
                                                *
                                                FROM items

                                               where items_homeorder = 0
                                               ORDER BY
                                               items_id 
                                                DESC
                                                 ");

    // execute the statement

    $stmt->execute();
    $items = $stmt->fetchall();



    $stmt2 = $con->prepare("SELECT
                                                *
                                                FROM homepage
                                                 ");

    // execute the statement

    $stmt2->execute();
    $texts = $stmt2->fetchall();





    $stmt3 = $con->prepare("SELECT
    *
    FROM items

  where items_homeorder != 0
  ORDER BY
  items_homeorder 
    ASC
    ");

    // execute the statement

    $stmt3->execute();
    $items3 = $stmt3->fetchall();

    if (!empty($items)) {


      ?>

      <h2 class="text-center mb-4 mt-4">يتم ترتيب النصوص والمنتجات في الصفحة الرئيسية كما يلي</h2>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-4 col-lg-4 col-sm-12 mb-5">
            <img src="../upload/home1.png" class="adminimg img-fluid">
          </div>
          <div class="col-12 col-md-4 col-lg-4 col-sm-12 mb-5">
            <img src="../upload/home3.png" class="adminimg img-fluid">
          </div>
          <div class="col-12 col-md-4 col-lg-4 col-sm-12 mb-5">
            <img src="../upload/home2.png" class="adminimg img-fluid">
          </div>

        </div>

        <h2 class="text-center mb-4 mt-4">النصوص التي تظهر في الصفحة الرئيسية </h2>
        <div class="container">
          <div class="table-responsive">

            <table class="main-table text-center table table-borderd">

              <tr>
                <td>رقم ترتيب النص</td>
                <td>النص الرئيسي</td>
                <td>النص الفرعي</td>
                <td>التحكم</td>
              </tr>


              <?php

              foreach ($texts as $text) {
                echo "<tr>";
                echo "<td>" . $text['homepage_id'] . "</td>";
                echo "<td>" . $text['homepage_title'] . "</td>";
                echo "<td>" . $text['homepage_text'] . "</td>";
                echo "<td>
                                        <a href='homeitems.php?do=Edit&itemid=" . $text['homepage_id'] . "' class=' btn btn-success'><i class='fa fa-edit' ></i> تعديل</a>";
                echo "</td>";
                echo "</tr>";
              }

              ?>

            </table>

          </div>
        </div>

        <h2 class="text-center mb-4 mt-4">المنتجات التاليه هي التي تظهر في الصفحة الرئيسية </h2>
        <div class="container">
          <div class="table-responsive">

            <table class="main-table text-center table table-borderd">

              <tr>
                <td>#ID</td>
                <td>الاسم</td>
                <td>السعر الحالي</td>
                <td>الصورة</td>
                <td>رقم الترتيب</td>

              </tr>


              <?php

              foreach ($items3 as $item) {

                echo "<tr>";
                echo "<td>" . $item['items_id'] . "</td>";
                echo "<td>" . $item['items_name'] . "</td>";
                echo "<td>" . $item['items_price'] . "</td>";
                echo "<td style='width: 20%;'><img src='../upload/items/" . $item['items_image'] . "' class='img-fluid rounded object-cover w-full' >
                                   </td>";
               echo "<td>" . $item['items_homeorder'] . "</td>";

                echo "</tr> ";
              }

              ?>

            </table>

          </div>
        </div>


        <h2 class="text-center mb-4 mt-4">المنتجات التاليه <span style="color: red;">لا</span> تظهر في الصفحة الرئيسية </h2>
        <h4 class="text-center mb-4 mt-4">   لأظهار احد المنتجات التالية بدل منتج ظاهر في الصفحة الرئيسية قم بتحديد رقم الترتيب ثم اضغط حفظ</h4>

        <div class="container">

          <div class="table-responsive">

            <table class="main-table text-center table table-borderd">

              <tr>
                <td>#ID</td>
                <td>الاسم</td>
                <td>السعر الحالي</td>
                <td>الصورة</td>
                <td>رقم الترتيب</td>

              </tr>


              <?php

              foreach ($items as $item) {
                echo '<form  action="homeitems.php?do=Update" method="post">
                                        <input type="hidden" value="' . $item['items_id'] . '" name="itemid">';
                echo "<tr>";
                echo "<td>" . $item['items_id'] . "</td>";
                echo "<td>" . $item['items_name'] . "</td>";
                echo "<td>" . $item['items_price'] . "</td>";
                echo "<td style='width: 20%;'><img src='../upload/items/" . $item['items_image'] . "' class='img-fluid rounded object-cover w-full' >
                                                 </td>";
                echo '<td ><select class="form-control m-1"  name="ordering"  required >
                                                 <option value="" req >.....</option>
                                                 <option value="1"  >الترتيب رقم 1</option>
                                                 <option value="2"  >الترتيب رقم 2</option>
                                                 <option value="3"  >الترتيب رقم 3</option>
                                                 <option value="4"  >الترتيب رقم 4</option>
                                                 <option value="5"  >الترتيب رقم 5</option>
                                                 <option value="6"  >الترتيب رقم 6</option>
                                                 <option value="7"  >الترتيب رقم 7</option>
                                                 <option value="8"  >الترتيب رقم 8</option>
                                                 <option value="9"  >الترتيب رقم 9</option>
                                                 <option value="10"  >الترتيب رقم 10</option>
                                                 <option value="11"  >الترتيب رقم 11</option>

                                                 </select>
                                           <button type="submit" class="btn btn-primary m-1 " >حفظ</button>
                                           </td> ';
                echo "</tr> </form>";
              }

              ?>

            </table>

          </div>
        </div>


      <?php } else {
      echo '<div class="container">';
      echo '<div class="nice-message">لأيوجد أصناف لعرضها</div>';

      echo '</div>';

    }
    // end manage items page


  } elseif ($do == 'Update') {

    // start update page
    echo '<h1 class="text-center">Update Item</h1>';
    echo "<div class='container'>";

    // check if user come from forms or any page

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


      //   if($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK){
      //     $file_path = imageUpload("fileToUpload");

      //   }else{
      //     $file_path = filterRequest("oldphoto");

      //   }

      $itemid = $_POST['itemid'];
      $ordering = $_POST['ordering'];


      $stmt = $con->prepare("SELECT
                                * 
                                FROM items 

                                WHERE
                                items_homeorder = ? ");

      // Execute query
      $stmt->execute(array($ordering));
      $count = $stmt->rowCount();

      if ($count > 0) {

        $item = $stmt->fetch();

        $olditemid = $item['items_id'];

        $stmt = $con->prepare("UPDATE
                                        items
                                    SET
                                    items_homeorder         = 0
                                    WHERE
                                       items_id       = ?  ");
        $stmt->execute(array($olditemid));


        $count = $stmt->rowCount();

        if ($count > 0) {

          $stmt = $con->prepare("UPDATE
                                    items
                                        SET
                                        items_homeorder         = ?
                                        WHERE
                                        items_id   = ?  ");
          $stmt->execute(array($ordering, $itemid));

          $count2 = $stmt->rowCount();
          if ($count2 > 0) {

            $theMsg = '<div class="alert alert-success">تم حفظ التعديلات</div>';

            redirectHome($theMsg, 'back');
          }

        }

      }



    } else {

      $theMsg = '<div class="alert alert-danger">sorry you cant browse this page dirctory</div>';

      redirectHome($theMsg);

    }

    echo "</div>";
    echo "</div>";


  } elseif ($do == 'Edit') {


    $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid'])) ? intval($_GET['itemid']) : 0;

    $stmt = $con->prepare("SELECT * FROM homepage WHERE homepage_id   = ?");

    // ececute query

    $stmt->execute(array($itemid));

    // FETCH THE DATA

    $item = $stmt->fetch();

    // the row coun

    $count = $stmt->rowCount();

    // if there is such id show the form

    if ($count > 0) {
      ?>

        <h1 class="text-center">تعديل نص الصفحة الرئيسية </h1>
        <div class="container">
          <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
            <!-- start Name field -->

            <h2 class="text-center">رقم ترتيب النص
              :
              <?php echo $itemid; ?>
            </h2>

            <div class="form-group form-group-lg">
              <label class="col-sm-2 control-label">النص الرئيسي</label>
              <div class="col-sm-10 col-md-4">
                <input type="text" name="title" class="form-control" required="recuired" placeholder="النص الرئيسي"
                  value="<?php echo $item['homepage_title']; ?>" />
              </div>
            </div>
            <!-- end name field -->
            <!-- start Description field -->
            <div class="form-group form-group-lg">
              <label class="col-sm-2 control-label">النص الفرعي</label>
              <div class="col-sm-10 col-md-4">

                <textarea name="texts" class="form-control" required="required" placeholder="النص الفرعي" cols="30"
                  rows="5"><?php echo $item['homepage_text']; ?></textarea>

              </div>
            </div>
            <!-- end Description field -->

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

      $theMsg = '<div class="alert alert-danger">لايوجد هذا  العنصر</div>';

      redirectHome($theMsg, 4);

      echo "</div>";

    }

  } elseif ($do == 'Approve') {



    echo '<h1 class="text-center">Approve Item</h1>';
    echo "<div class='container'>";


    // Check if get request userid is numeric and get the integer value of it

    /*  if (isset($_GET['userid']) && is_numeric($_ ['userid'])){
        echo intval($_ ['userid']);
      }else { echo 0; }  */
    $itemid = (isset($_GET['itemid']) && is_numeric($_GET['itemid'])) ? intval($_GET['itemid']) : 0;

    // select all data depend on this id


    $checkid = checkItem('Item_ID', 'items', $itemid);

    // if there is such id show the form

    if ($checkid > 0) {


      $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");

      $stmt->execute(array($itemid));

      // WE CAN USE THIS QUERY BUT CHING :ZUSER ? $stmt->execute(array($userid));

      $theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . '  Record update' . '</div>';

      redirectHome($theMsg, 'back');

      echo '</div>';


    } else {


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