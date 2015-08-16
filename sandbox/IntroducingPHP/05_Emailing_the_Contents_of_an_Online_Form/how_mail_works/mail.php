<?php
$to = 'David Powers <david@example.com>, another@example.com';
$subject = 'Subject of the email';
$body = 'This is the body of the email message.';
$headers = "From: webmaster@example.com\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";
$headers .= "Cc: myfriend@example.com";

$success = mail($to, $subject, $body, $headers, '-fdavid@example.com');