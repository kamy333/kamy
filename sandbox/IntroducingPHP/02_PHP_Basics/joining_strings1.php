<?php
$firstName = 'David';
$lastName = 'Powers';
// The double quotes inside the single-quoted string become part of the string,
// but the apopstrophe needs to be escaped with a backslash.
$book = '"Hitchhiker\'s Guide to the Galaxy"';
$author = 'Douglas Adams';
$timesListened = 25;
// Double quotes convert \r into a carriage return and \n into a new line character
$newLines = "\r\n\r\n";

$fullName = $firstName . ' ' . $lastName;
//echo $fullName . '<br>';

// Variables are processed in a double-quoted string
$recommendation = "$book by $author";
//echo $recommendation;

$message = "Name: $fullName $newLines";
$message .= "Recommendation: $recommendation $newLines";
$message .= "Times listened: $timesListened";
echo $message;