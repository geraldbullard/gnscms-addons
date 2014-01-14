<?php
  function listEvent() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['lang']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'event') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['lang'] . '/' . $page_file);
    if ($_SESSION['access']->listEvent > 0) {
      require( "inc/layout/listEvent.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>