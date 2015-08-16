<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>
<?php require_once('../includes/initialize.php'); ?>

<?php
$username = "";


// todo FOR TESTING
//$_POST['username'] = 'kamy';
//$_POST['password'] = 'kamy1';
//$_POST['submit'] = 'submit';
// todo END FOR TESTING




if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Attempt Login

		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      // Success
			// Mark user as logged in
			$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
			$_SESSION["nom"] = $found_admin["nom"];
        	$_SESSION["user_type"] = $found_admin["user_type"];
            $_SESSION["user_type_id"] = $found_admin["user_type_id"];

 log_action('Login', "{$found_admin['username']} logged in. "." | REMOTE_ADDR: ". $_SERVER['REMOTE_ADDR'] ." | REMOTE_PORT: ". $_SERVER['REMOTE_PORT']." | REQUEST_TIME: ". $_SERVER['REQUEST_TIME']);



      redirect_to("manage_program.php");
	  
    } else {
      // Failure
      $_SESSION["message"] = "Username / password not found.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php  $active_menu="login" ?>
<?php include("../includes/layouts/nav.php"); ?>




<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>




<div class="row">

    <div class="col-md-4 col-md-offset-4  col-lg-4 col-lg-offset-4 ">
        <form id="myform" class="form-signin " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h2 class="form-signin-heading text-center">Please sign into ikamy.ch </h2>
        <h6><a href="login_lost_pwd.php">Forgot login?</a></h6>

            <label for="username" class="sr-only">username</label>
         <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus <?php echo 'value="'.htmlentities($username, ENT_COMPAT, 'utf-8') . '"';?>>

            <label for="password" class="sr-only">Password</label>
        <input type="password"  name="password" id="password" class="form-control" placeholder="Password" required>

         <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="submit">Sign in</button>
      </form>

    	</div>
    
</div>




<?php include("../includes/layouts/footer_2.php"); ?>
