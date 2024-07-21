

<?php

/*
**
** Get ALL  function v2.0
** function to get ALL records  from any database table
*/

define("MB", 1048576); // Define MB as 1 megabyte

function getAllFrom($field, $table, $where = NULL , $and = NULL , $orderfield , $ordering="DESC" )
{
 global $con;

 $getAll = $con->prepare("SELECT $field FROM	$table $where $and ORDER BY $orderfield $ordering");

 $getAll->execute();

 $all = $getAll->fetchall();

 return $all;

}















/*
** title functon v1.0
**  title function that echo the page title in case the page
** has the variable $pagetitle and echo defult title for other page
*/


function gettitle()
{

  global $pagetitle;

  if (isset($pagetitle)) {

    echo $pagetitle;
  }
}


/*
**
** Home redirect Function v1.0
**THIS fINCTION ACCEPT PARAMETERS
** $errorMsg = Echo the error message
** $seconds  = seconds befors redirect
*/

function redirectHome1($errorMsg  ,  $seconds = 2)
{


      echo "<div class='alert alert-info'>You will be redirect to home page after $seconds seconds. </div>";

     header("refresh:$seconds;url=index.php");

     exit();
}

 /*
 **
 ** Home redirect Function v2.0
 **THIS fINCTION ACCEPT PARAMETERS
 ** $theMsg = Echo the message [ error | success | warning ]
 ** $usl =
 ** $seconds  = seconds befors redirect
 */


  function redirectHome($theMsg ,$url = null ,  $seconds = 2)
  {

    if ($url == null ) {

         $url = 'index.php';

    //     $link = 'Homepage';

    } else {
         // $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ?   $url = $_SERVER['HTTP_REFERER'] :  $url =  'index.php';
         if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {

             $url = $_SERVER['HTTP_REFERER'];

            //     $link = 'Previous';

         } else {

             $url =  'index.php';
         }
    }

    echo $theMsg;


   header("refresh:$seconds;url=$url");

   exit();

  }


 /*
 **
 **check items function v1.0
 **function to check item in database [ function ACCEPT PARAMETERS ]
 ** $select = the item to select   [ Example : user  , item  , category]
 ** $form   = the table to select  [ Example : users , items , Categories]
 ** $value  = the value of select  [ Example : osama , box   , electronics]
 */


 function checkItem( $select , $form , $value )
 {
   global $con;

   $stmnt = $con->prepare("SELECT $select FROM $form WHERE $select = ? ");

   $stmnt->execute(array($value));

   $countrow = $stmnt->rowcount();

   return $countrow;


 }

 /*
 **
 ** count Numbers of itsems function v1.0
 ** function to count number of items rows
 ** $item = the item to count
 ** $table = the table to count from
 */

function countItems($item , $table)
{


   global $con;

   $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

   $stmt2->execute();

   return $stmt2->fetchColumn();

}



 /*
 **
 ** Get latest records  function v1.0
 ** function to get latest irems from database [ users , items , comments]
 ** $select = field to select
 ** $table = the table to choose from
 ** $limit = number of records to get
 ** $order = the colom
 */

function getlatest($select , $table , $order , $limit = 5   )
{
  global $con;


  $getstmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit ");

  $getstmt->execute();

  $rows = $getstmt->fetchall();

  return $rows;



}


function insertData($table, $data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
//     if ($json == true) {
//     if ($count > 0) {
//         echo json_encode(array("status" => "success"));
//     } else {
//         echo json_encode(array("status" => "failure"));
//     }
//   }
    return $count;
}


function filterRequest($requestname)
{
  return  htmlspecialchars(strip_tags($_POST[$requestname]));
}


function imageUpload($imageRequest)
{
  global $msgError;


  if (isset($_FILES[$imageRequest])) {
    $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
    $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
    $imagesize  = $_FILES[$imageRequest]['size'];
    $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
    $strToArray = explode(".", $imagename);
    $ext        = end($strToArray);
    $ext        = strtolower($ext);

    if (!empty($imagename) && !in_array($ext, $allowExt)) {
        $msgError = "EXT";
      }
      if ($imagesize > 2 * MB) {
        $msgError = "size";
      }
      if (empty($msgError)) {
        move_uploaded_file($imagetmp,  "../upload/items/" . $imagename);
        return $imagename;
      } else {
        return "fail";
      }
    } else {
    $msgError = "File not set in the request.";
    return "fail";
}


}

