<?php
$characters = array('Athur Dent', 'Ford Prefect', 'Zaphod Beeblebrox', 'Marvin', 'Slartibartfast'); 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Using a foreach Loop</title>
</head>

<body>
<h1>Character List</h1>
<ul>
<?php
// Use a temporary variable to access the value of each element in an array.
foreach ($characters as $name) {
	echo "<li>$name</li>";
}
?>
</ul>
</body>
</html>