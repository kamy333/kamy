<?php
$characters = array('Athur Dent', 'Ford Prefect', 'Zaphod Beeblebrox', 'Marvin', 'Slartibartfast'); 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Using a For Loop</title>
</head>

<body>
<h1>Character List</h1>
<ul>
<?php
/* A for loop has three statements between the parentheses:
   The first initializes any variables to be used in the loop.
   The second sets the condition the controls how long the loop runs.
   The third statement is executed at the end of each iteration, usually
   to increment the counter.
   
   Use continue to skip the rest of the code in the loop for the current iteration.
   Use break to bring the loop to an end.

*/
for ($i = 0; $i < count($characters); $i++) {
	/*if ($i == 3) {
		continue;
	}*/
	echo '<li>' . $characters[$i] . '</li>';
	if ($characters[$i] == 'Zaphod Beeblebrox') {
	   break;	
	}
}
?>
</ul>
</body>
</html>