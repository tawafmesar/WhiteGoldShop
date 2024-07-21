<?php
  session_start();
  $nonavbar = '';
  $pagetitle = 'Login';
  if (isset($_SESSION['userses'])) {
    header('Location: homeitems.php');    // redirect to dashboard page
  }

 include 'ini.php';


    // check if user coming from http post request

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = $_POST['email'];
        $password = $_POST['pass'];
        $hashpass = sha1($password);

        // check if user exist in database

        $stmt = $con->prepare("SELECT
                                    user_id  ,  user_name, user_password
                               FROM
                                      users
                               WHERE
                                              user_email = ?
                               AND
                                              user_password = ?
                               AND user_groupID = 1
                               LIMIT 1 ");

        $stmt->execute(array($email , $hashpass));
        $row   = $stmt->fetch();
        $count = $stmt->rowCount();

        //if count > 0 this mean the datebase contain record about this Username
        if ($count > 0) {
             $_SESSION['userses'] = $row['user_name'];       // register session name
             $_SESSION['ID']      = $row['user_id'];  // register session ID
             header('Location: homeitems.php');      // redirect to dashboard page
              exit();

        }
}


 ?>

        <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
          <h2 class="text-center">تسجيل الدخول لأدارة الموقع</h4>
          <input class="form-control" type="text" name="email" placeholder="البريد الألكتروني" autocomplete="off">
          <input class="form-control"  type="password" name="pass" placeholder="كلمة المرور" autocomplete="new-password">
          <input class="btn btn-primary btn-block"  type="submit" name="" value="تسجيل الدخول">

        </form>



 <?php include $tpl . 'footer.php';?>
