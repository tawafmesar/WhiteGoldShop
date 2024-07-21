<?php

  include 'connect.php';
    // Rotes

    $tpl  = 'includes/templates/';  // templates Directory
    $lang = 'includes/languages/';  // languages Directory
    $func = 'includes/functions/';  // function Directory
    $css  = 'layout/css/';          // css Directory
    $js   = 'layout/js/';           // js Directory


 // include the Important file

  include $func . '/func.php';
  include $lang . 'en.php';
  include $tpl . 'header.php';

 // include navbar on all page expect the one whith $nonavbar  variables
 if (!isset($nonavbar)) { include $tpl . 'navbar.php'; }
