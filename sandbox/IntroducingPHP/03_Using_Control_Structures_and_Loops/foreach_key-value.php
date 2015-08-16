<?php
$descriptions = array('Earth'  => 'mostly harmless',
                      'Marvin' => 'the paranoid android',
                      'Zaphod' => 'President of the Imperial Galactic Government');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Using a foreach Loop</title>
</head>

<body>
<h1>Descriptions</h1>
<?php
// Create two variables separated by => to access the key and value
// of each element in an associative array.
foreach ($descriptions as $key => $description) {
	echo "<p>$key is $description.</p>";
}
?>
</body>
</html>