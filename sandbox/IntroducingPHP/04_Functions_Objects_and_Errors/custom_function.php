<?php

echo convertSeconds(3407);


function convertSeconds($seconds) {
	// Convert to whole minutes by dividing by 60 and rounding down with floor()
	$minutes = floor($seconds / 60);
	// Obtain the number of seconds by using modulo division.
	$seconds = $seconds % 60;
	// Add a leading zero if the number of seconds is less than 10.
	$seconds = ($seconds < 10) ? '0' . $seconds : $seconds;
	// Use a double-quoted string to return the result.
	return "$minutes:$seconds";
}

