<?php
$characters = array('Athur Dent', 'Zaphod Beeblebrox', 'Marvin', 'Slartibartfast', 'Ford Prefect'); 
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
// Ths sort() and rsort() functions change the original value of the array passed to them as an argument.
sort($characters);
//rsort($characters);
foreach ($characters as $name) {
	echo "<li>$name</li>";
}
?>
</ul>
</body>
</html>