<?php
$input = '<p>Hi, <script>alert("Boo!");</script><a href="http://www.example.com/">visit my site</a>.</p>';

// strip_tags() takes either one or two arguments.
// The second, optional argument consists of a string containing tags you want to preserve.
echo strip_tags($input);
echo strip_tags($input, '<p><a>');