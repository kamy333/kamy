<?php
$characters = array('Athur Dent', 'Ford Prefect', 'Zaphod Beeblebrox', 'Marvin', 'Slartibartfast'); 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Missing Curly Brace</title>
</head>

<body>
<h1>The Hitchhiker's Guide to the Galaxy</h1>
<p>The Hitchhiker's Guide to the Galaxy contains many weird and wonderful characters, including:</p>
<ul>
<?php
foreach ($characters as $name) {
	echo "<li>$name</li>";
?>
</ul>
<p>I particularly like Slartibartfast, the planet builder from Magrathea who won an award for his work on the fjords of Norway.</p>
</body>
</html>