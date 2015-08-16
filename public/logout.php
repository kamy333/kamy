<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/functions.php"); ?>

<?php require_once('../includes/initialize.php'); ?>


<?php
	// v1: simple logout
	// session_start();
	//$_SESSION["admin_id"] = null;
//	$_SESSION["username"] = null;
//	$_SESSION["nom"] = null;
//    $_SESSION["user_type"] = null;

log_action('Login', "{$_SESSION["username"]} logged out.");


	foreach($_SESSION as $key =>$val){
	$_SESSION[$key]=null;
	}
	
	redirect_to("login.php");
?>

<?php
	// v2: destroy session
	// assumes nothing else in session to keep
	// session_start();
	// $_SESSION = array();
	// if (isset($_COOKIE[session_name()])) {
	//   setcookie(session_name(), '', time()-42000, '/');
	// }
	// session_destroy(); 
	// redirect_to("login.php");
?>
