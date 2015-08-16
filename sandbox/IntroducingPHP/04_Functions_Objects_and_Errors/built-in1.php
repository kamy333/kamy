<?php
$version = phpversion();

$name = 'DAVID';
echo strtolower($name) . '<br>';

// PHP allows you to pass a function as an argument to another function.
// The function passed as the argument is executed first, 
// and the return value is passed as an argument to the outer function.
$name = ucfirst(strtolower($name));
echo $name;