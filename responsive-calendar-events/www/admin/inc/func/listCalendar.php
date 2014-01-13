<?php
  function listCalendar() {
    global $lang;
    $page_lang = scandir('inc/lang/' . $_SESSION['lang']);
    foreach ($page_lang as $file) {
      if ($file != '.' && $file != '..') {
        $parts = explode(".", $file); 
        $page = $parts[0];
        if ($page == 'calendar') {
          $page_file = $file;
        }
      }
    }
    include_once('inc/lang/' . $_SESSION['lang'] . '/' . $page_file);
    if ($_SESSION['access']->listCalendar > 0) {
      require( "inc/layout/listCalendar.php" );
    } else {
      require( "inc/layout/noAccess.php" );
    }
  }
?>