<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>


<?php require_once('../includes/initialize.php'); ?>

<?php
$username = null;
$server_name=$_SERVER['PHP_SELF'];
$new_password=null;
?>




  <?php
  
//  -begin lost
 
 if (isset($_POST['submit'])) {

     $email=$_POST['email'];

     $required_fields = array("email");
     validate_presences($required_fields);
     validate_email("email");

     if (empty($errors)) {

  }
      $found_admin= find_admin_by_email($email);

            if ($found_admin) {
				
			// do not execute on localhost	(db connection)
			  if ($server_name != $server_local) {	
				
				$username=$found_admin['username'];
				$new_password=substr(md5(rand()), 0, 7);
				$id=$found_admin['id'];
				$hashed_password = password_encrypt($new_password);
	  
				$query  = "UPDATE admins SET ";
				$query .= "username = '{$username}', ";
				$query .= "hashed_password = '{$hashed_password}' ";
				$query .= "WHERE id = {$id} ";
				$query .= "LIMIT 1";
				$result = mysqli_query($connection, $query);
			
					if ($result && mysqli_affected_rows($connection) == 1) {
					  // Success
					  $_SESSION["message"] = "Admin updated.";
                        $_SESSION["OK"]=true;

                    } else {
					  // Failure
					  $_SESSION["message"] = "Admin update failed.";
					   redirect_to("login_lost_pwd.php");
					}	
			  }
             $to= htmlentities($found_admin["email"]);
			 $subject= "hi " . htmlentities($found_admin["nom"]) ;

             $message .= "{$subject}\r\n\r\n";
             $message.="  \r\n";
			 $message .= "username: {$found_admin['username']}\r\n";
			 $message .= "new password: {$new_password}\r\n";
			 $message.="  \r\n";
			 $message.=" You can change your password and details in the my page \r\n";
			 $message.="  \r\n";
			 $message.= "Best regards \r\n";
			 $message.= "ikamy.ch \r\n";
			
			 $_POST['emailAddress'] = "webmaster@ikamy.ch";
             $headers = "From: " . $_POST['emailAddress'] . "\n";
			//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
             $headers .= "Content-type: text/plain; charset=utf-8";

                $body = $message;
            mail($to,$subject,$body,$headers);

            $_SESSION["message"] .="Check your Email ( {$email} with password details. " ;
            $_SESSION["OK"]=true;


            } else {

             $_SESSION["message"] .= "Please try again email did not found this email in our system. " ;

            }
 }


?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" // custum_forn ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
</div>


<div class="col-md-6 col-md-offset-2  col-lg-6 col-md-offset-2">

    <div class ="background_light_blue">

  <form id="" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
 <!-- <li>
     <a href="index.php">&laquo; Public area</a><br />
    </li>-->
  <fieldset id="login" title="Get a new password">
    <legend>Lost login & password</legend>





<p class="help-block col-lg-offset-2 col-md-offset-2"><a style="color:blue-decoration: underline" href="login.php">back to login</a></p>

      <div class="help-block col-lg-offset-2 col-md-offset-2">
          <p>Please enter your email address below to send you a new password</p>
      </div>
<div class="form-group">

<label class="col-sm-2 control-label" for="email">Email</label>
<div class="col-sm-10">
<input type="email"  class="form-control" name="email" id="email"  />
</div></div>



<div class="col-sm-offset-2 col-sm-7 col-xs-2">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>


      </fieldset>
  </form>



    </div>
</div>

<?php include("../includes/layouts/footer_2.php"); ?>
