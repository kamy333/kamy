<?php
// Instantiate an new DateTime object.
$now = new DateTime();

// Use the format() method to  format the output.
echo $now->format('F j, Y h:ia') . '<br>';

// Cteate a new DateTimeZone object for Tokyo.
$tokyo = new DateTimeZone('Asia/Tokyo');

// Change the time zone of the DateTime object.
$now->setTimezone($tokyo);

// Display the new value.
echo $now->format('F j, Y h:ia');
