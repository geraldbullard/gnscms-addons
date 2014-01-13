<?php
  $events = array("event" => 
                   array("title" => 'Dicks Wings',
                         "desc" => 'Dicks Wings & Grille on the north side of Jax!!!',
                         "date" => '20140110',
                         "start" => '9:00',
                         "end" => '1:30',
                         "loc" => 'Alta Rd Jacksonville, FL 32226',
                         "map" => 'http://goo.gl/maps/VIrnD'
                         ), 
                   array("title" => 'Dicks Wings',
                         "desc" => 'Dicks Wings & Grille on the north side of Jax!!!',
                         "date" => '20140111',
                         "start" => '9:00',
                         "end" => '1:30',
                         "loc" => 'Alta Rd Jacksonville, FL 32226',
                         "map" => 'http://goo.gl/maps/VIrnD'
                         ), 
                   array("title" => 'Dicks Wings',
                         "desc" => 'Dicks Wings & Grille on the north side of Jax!!!',
                         "date" => '20140207',
                         "start" => '9:00',
                         "end" => '1:30',
                         "loc" => 'Alta Rd Jacksonville, FL 32226',
                         "map" => 'http://goo.gl/maps/VIrnD'
                         ), 
                   array("title" => 'Dicks Wings',
                         "desc" => 'Dicks Wings & Grille on the north side of Jax!!!',
                         "date" => '20140208',
                         "start" => '9:00',
                         "end" => '1:30',
                         "loc" => 'Alta Rd Jacksonville, FL 32226',
                         "map" => 'http://goo.gl/maps/VIrnD'
                         )
                  );
?>
  <script src="inc/js/calendar.js"></script>
  <script>
    $(document).ready(function() {
      var hasCalendaer = $(".calendar").is(":visible");
      if (hasCalendaer) set_calendar_events(); 
    });
    function set_calendar_events() {
      <?php foreach ($events as $event) { ?>
      $(".calendar")
        .find("[strtime='<?php echo $event['date']; ?>']")
        .append('<div style="margin:23px 30px 0 5px;"><?php echo $event['title']; ?></div>')
        .addClass("have-events")
        .attr("onclick", "load_date_specific_data('<?php echo $event['title']; ?>', '<?php echo $event['desc']; ?>', '<?php echo $event['start']; ?>', '<?php echo $event['end']; ?>', '<?php echo $event['loc']; ?>', '<?php echo $event['map']; ?>');")
        .find(".event-n-holder")
        .append('<div class="event-n"></div>'+
                '<div data-role="day" data-day="<?php echo $event['date']; ?>">'+
                '  <div data-role="event" data-name="<?php echo $event['title']; ?>" data-start="<?php echo $event['start']; ?>" data-end="<?php echo $event['end']; ?>" data-location="<?php echo $event['location']; ?>"></div>'+
                '</div>');
      <?php } ?>
    }
    function load_date_specific_data(title, desc, start, end, loc, map) {
      $(".specific-day").prepend('<i class="fa fa-chevron-left calendar-day-back"></i>');
      $(".s-scheme").append('<div class="s-event">'+
                            '  <h1>' + title + '</h1>'+
                            '  <p data-role="desc">' + desc + '</p>'+
                            '  <p>&nbsp;</p>'+
                            '  <p data-role="dur">Showtime: ' + start + ' - ' + end + '</p>'+
                            '  <p data-role="loc">Location: ' + loc + '</p>'+
                            '  <p data-role="map" class="calendar-map"><a href="' + map + '" target="_blank" class="calendar-map-link">Google Map <i class="fa fa-external-link calendar-map-icon"></i></a></p>'+
                            '</div>');
    }
  </script>
