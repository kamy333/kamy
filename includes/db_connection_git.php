<?php

$server_name = $_SERVER['SERVER_NAME'];
$server_local = "localhost";
$server_phpstorm = "PhpStorm 8.0.3";
$server_phpstorm3 = "PhpStorm 9.0";

if ($server_name == $server_local) {
    define("DB_SERVER", "localhost");
    define("DB_NAME", "ikamych");
} elseif ($server_name == $server_phpstorm3) {
    define("DB_SERVER", "localhost");
    define("DB_NAME", "ikamych");
} else {
	//infomaniak
    define("DB_SERVER", "");
    define("DB_NAME", "");
}

define("DB_USER", "");
define("DB_PASS", "");




// 1. Create a database connection
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Test if connection succeeded
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . " (" .
        mysqli_connect_errno() . ")");
}
?>
