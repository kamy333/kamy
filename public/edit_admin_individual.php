<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>

<?php
  
  $admin = find_admin_by_id($_SESSION["admin_id"]);
  
  
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_admins.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password","email");
  $_POST["username"]=$admin["username"];
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);

    validate_email(array("email"));

  if (empty($errors)) {
    
    // Perform Update

    $id = $admin["id"];
    $username = mysql_prep($admin["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
    $email = mysql_prep($_POST["email"]);
	$user_type= mysql_prep($_POST["user_type"]);
	$nom= mysql_prep($admin["nom"]);

  
    $query  = "UPDATE admins SET" . " ";
    //$query .= "username = '{$username}', ";
    $query .= "hashed_password = '{$hashed_password}', ";
    $query .= "email = '{$email}', ";
    //$query .= "user_type = '{$user_type}', ";
    $query .= "nom = '{$nom}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "New info updated sucessfully.";
        $_SESSION["OK"]=true;
        $_POST=null;
      redirect_to("manage_admins_my_page.php");

    } elseif ($result && mysqli_affected_rows($connection) == 0) {
        $_SESSION["message"] = " Your Admin update failed because no change was made compare to what existed in db already.";
        redirect_to("manage_admins_my_page.php");
        unset($_POST);


    } else {
      // Failure
      $_SESSION["message"] = "Admin update failed.";
    }
  
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

    <div class="row text-center">
    <h3>Editez vos infos <mark> <?php echo htmlentities($admin["nom"]);?></mark></h3>
      </div>

<hr>
          <div  class="row">
              <div class="text-left col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1">

                  <div class ="background_light_blue-small">

                  <form id="myform" class="group" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


              <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" class="form-control" name="password" value="" placeholder="Enter new password or re-enter same" />
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($admin["email"]); ?>" placeholder="Enter new email" required />
              </div>

<!--              <div class="form-group hide-form">-->
<!--                  <label for="exampleInputFile">File input</label>-->
<!--                  <input type="file" id="exampleInputFile">-->
<!--                  <p class="help-block">Example block-level help text here.</p>-->
<!--              </div>-->

              <p class="help-block"><strong>Note: </strong>Both password and email need to be completed whether new or not</p>

               <div class="text-left col-md-6 col-xs-2" >
              <span><button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button></span>
                  </div>
              <?php // echo str_repeat("&nbsp", 30); ?>
              <div class="text-right " >
                  <a href="manage_admins_my_page.php" class="btn btn-info " role="button">Cancel</a>
                      </div>



          </form>

    </div>


          </div>







<!--          <div class="col-md-3 col-md-offset-4  col-lg-3 col-md-offset-4 ">-->



              <div class="text-left col-md-4 col-lg-4">
                  <br>
                  <aside>
                   <dl class="dl-horizontal">
                      <dt>Username</dt>
                      <dd><mark><?php echo $_SESSION["username"];?></mark></dd>
                      <dt>Nom</dt>
                      <dd><mark><?php echo $_SESSION["nom"];?></mark></dd>
                      <dt>User Type</dt>
                      <dd><mark><?php echo $_SESSION["user_type"];?></mark></dd>
                      <dt>Email</dt>
                      <dd><mark><?php echo $admin["email"];?></mark></dd>
                  </dl>
              </aside>
              </div>

              <div class="col-md-2  col-lg-2 ">
                  <?php echo "<p><span>". get_user_img(12,12) ."</span></p>" ?>
              </div>

            </div>



 <script>
$("document").ready(function() {
     
			
	$(".hide").hide();

	  
		
    });
    </script>


<?php include("../includes/layouts/footer_2.php"); ?>
