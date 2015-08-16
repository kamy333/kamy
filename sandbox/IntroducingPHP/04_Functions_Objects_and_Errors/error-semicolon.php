<?php
$name = 'Arthur';
$today = 'Thursday';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Missing Semicolon</title>
</head>

<body>
<h1>Notable Quotes</h1>
<p>
<?php
if ($name == 'Arthur' && $today == 'Thursday') {
	echo "$name: I could never get the hang of Thursdays";
} elseif ($name == 'Marvin' || $today == 'Wednesday') {
	echo "I've got this terrible pain in all the diodes down my left-hand side";
} else {
	echo 'Is that really a piece of fairy cake?'
}
?>
</p>
</body>
</html>