<?php
  $exists = (mysql_num_rows(mysql_query("SHOW COLUMNS FROM " . DB_PREFIX . "groups LIKE 'events'"))) ? true : false;
  if ($exists !== true) {
    mysql_query("ALTER TABLE " . DB_PREFIX . "_groups ADD events TINYINT(1) UNSIGNED NOT NULL DEFAULT '1'");
  }
  
  require_once('inc/class/Event.class.php');
  
  // Get the access level for events
  $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $sql = "SELECT events FROM " . DB_PREFIX . "groups WHERE id = :id";
  
  $st = $conn->prepare ( $sql );
  $st->bindValue( ":id", User::getGroupID($_SESSION['authuser']), PDO::PARAM_INT );
  $st->execute();
  
  $row = $st->fetch();
    
  $_SESSION['access']->events = $row['events'];
  
  $conn = null;
?>
