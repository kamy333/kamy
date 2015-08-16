<?php
$firstName = 'David';
$lastName = 'Powers';
$book = '"Hitchhiker\'s Guide to the Galaxy"';
$author = 'Douglas Adams';
$timesListened = 25;
$fullName = $firstName . ' ' . $lastName;
$recommendation = "$book by $author";

// <?= is shorthand for <?php echo, but it's not supported on all servers until PHP 5.4.

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?= $fullName; ?> Recommends</title>
</head>

<body>
<h1>Listen to This!</h1>
<p>Hi, I'm <?= $fullName; ?>. I'm a great fan of <?= $recommendation; ?>. I've listened to the radio version at least <?= $timesListened; ?> times.</p>
</body>
</html>