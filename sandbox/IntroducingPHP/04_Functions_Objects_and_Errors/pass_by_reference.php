<?php
$number = 2;

// pass by value
/*function doubleIt($num) {
	return $num *= 2;
}*/


// pass by reference
function doubleIt(&$num) {
	$num *= 2;
}

$doubled = doubleIt($number);

echo '$doubled is: ' . $doubled . '<br>';
echo '$number is: ' . $number . '<br>';
// var_dump($doubled);