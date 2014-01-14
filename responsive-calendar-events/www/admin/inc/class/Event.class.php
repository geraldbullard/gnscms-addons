<?php 
/**
 * Class to handle events
 */ 
class Event {
  
 /**
  * @var int The event ID from the database
  */
  public $id = null;
  
 /**
  * @var string The event title from the database
  */
  public $title = null;
  
 /**
  * @var string The event description from the database
  */
  public $description = null;
  
 /**
  * @var date The event date from the database
  */
  public $eventDate = null;
  
 /**
  * @var string The event start time from the database
  */
  public $startTime = null;
  
 /**
  * @var string The event end time from the database
  */
  public $endTime = null;
  
 /**
  * @var string The event location from the database
  */
  public $location = null;
  
 /**
  * @var string The event map url from the database
  */
  public $map = null;
  
 /**
  * @var int The event status from the database
  */
  public $status = null;
  
 /**
  * @var date The event last modified date from the database
  */
  public $lastModified = null;
  
 
 /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */ 
  public function __construct( $data=array() ) {
    
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['description'] ) ) $this->description = $data['description'];
    if ( isset( $data['eventDate'] ) ) $this->eventDate = (int) $data['eventDate'];
    if ( isset( $data['startTime'] ) ) $this->startTime = $data['startTime'];
    if ( isset( $data['endTime'] ) ) $this->endTime = $data['endTime'];
    if ( isset( $data['location'] ) ) $this->location = $data['location'];
    if ( isset( $data['map'] ) ) $this->map = $data['map'];
    if ( isset( $data['status'] ) ) $this->status = (int) $data['status'];
    if ( isset( $data['lastModified'] ) ) $this->lastModified = (int) $data['lastModified'];
    
  }
 
 
 /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */  
  public function storeFormValues ( $params ) {
    
    // Store all the parameters
    $this->__construct( $params );

    // Parse and store the publication date
    if ( isset($params['eventDate']) ) {
      $eventDate = explode ( '-', $params['eventDate'] );
      if ( count($eventDate) == 3 ) {
        list ( $y, $m, $d ) = $eventDate;
        $this->eventDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }

    // Parse and store the publication date
    if ( isset($params['lastModified']) ) {
      $lastModified = explode ( '-', $params['lastModified'] );
      if ( count($lastModified) == 3 ) {
        list ( $y, $m, $d ) = $lastModified;
        $this->lastModified = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
    
  }
 
 /**
  * Returns all Event objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the content (default="date DESC")
  * @return Array|false A two-element array : results => array, a list of Event objects; totalRows => Total number of Event items
  */  
  public static function getAll( $numRows = 1000000, $order = "eventDate DESC" ) {
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(eventDate) AS eventDate, UNIX_TIMESTAMP(lastModified) AS lastModified FROM " . DB_PREFIX . "events ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $event = new Event( $row );
      $list[] = $event;
    }
 
    // Now get the total number of content objects that matched the criteria
    foreach ($list as $item) {
      $events[] = $item->id;
    }
    
    $conn = null;
    
    return ( array ( "results" => $list, "totalRows" => count($events) ) );
  } 
} 
?>