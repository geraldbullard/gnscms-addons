<?php
  function newEvent() {
    if ( isset( $_POST['saveChanges'] ) ) {
      $_POST['eventDate'] = date('Y-m-d');
      $_POST['lastModified'] = date('Y-m-d');
      $event = new Event;
      $event->storeFormValues( $_POST );
      $event->insert();
      header( "Location: index.php?action=listEvent&success=eventCreated" );
    }
  }
?>