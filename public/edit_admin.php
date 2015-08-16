<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>


<?php
  $admin = find_admin_by_id($_GET["id"]);
  
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
    $required_fields = array("username","email","user_type_id","nom");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);
    validate_email(array("email"));








  
  if (empty($errors)) {
    
    // Perform Update

      if($_POST["user_type_id"]==1) {
          $_POST["user_type"] = "admin";
      } elseif  ($_POST["user_type_id"]==2){
          $_POST["user_type"] = "manager";
      } elseif  ($_POST["user_type_id"]==3){
          $_POST["user_type"] = "secretary";
      } elseif  ($_POST["user_type_id"]==4) {
          $_POST["user_type"] = "employee";
      } else {
          $_POST["user_type"] = "bug in program";
      }



    $id = $admin["id"];
    $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
	$email = mysql_prep($_POST["email"]);
	$user_type= mysql_prep($_POST["user_type"]);
	$nom= mysql_prep($_POST["nom"]);
    $user_type_id=mysql_prep($_POST["user_type_id"]);


    $query  = "UPDATE admins SET" . " ";
    $query .= "username = '{$username}', ";
    $query .= "email = '{$email}', ";
    $query .= "user_type = '{$user_type}', ";
    $query .= "user_type_id = {$user_type_id}, ";

      $query .= "nom = '{$nom}', ";

      if ($_POST["password"]){
              $query .= "hashed_password = '{$hashed_password}' ";
      }

    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Admin updated.";
        $_SESSION["OK"]=true;
      redirect_to("manage_admins.php");

    } elseif ($result && mysqli_affected_rows($connection) == 0) {
        $_SESSION["message"] = "Admin update failed because no change was made compare to what existed in db already.";
        redirect_to("manage_admins.php");
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
<?php $stylesheets="" // custum_forn ?>
<?php $javascript="form_admin" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

      <div class="row">
          <div class="col-md-3 col-lg-3 ">

              <h4 class="text-left">Edit user: <?php echo "<mark>". htmlentities($admin["username"])."</mark>"; ?>
                  <?php
                  $username=$admin["username"];
                  if(file_exists("img/{$username}.JPG")){
                      echo "<span><img class='img-thumbnail img-responsive'  src='img/{$username}.JPG' alt='{$username}'style='width:5em;height:5em;'</span>";
                  }
                  ?>
              </h4>

          </div>


          <div class="col-md-7  col-lg-7 ">

              <div class ="background_light_blue">


          <form  id="frmCourse" class="group form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo urlencode($admin["id"]); ?>" method="post">


     <fieldset id="admin_user" title="Edit Update a user">
    <legend>Edit Update a user</legend>



            <div class="form-group">
            <label  class="col-sm-2 control-label" for="username">Username</label>
            <div class="col-sm-10">
            <input type="text"  class="form-control" name="username" id="username" value="<?php echo htmlentities($admin["username"], ENT_COMPAT, 'utf-8'); ?>" required />
            </div>
            </div>


            <div class="form-group">
            <label class="col-sm-2 control-label" for="password">New Password</label>
            <div class="col-sm-10">
            <input type="password"  class="form-control" name="password" id="password" value="" />
            </div></div>


            <div class="form-group">
            <label class="col-sm-2 control-label" for="email">Email</label>
            <div class="col-sm-10">
            <input type="email"  class="form-control" name="email" id="email" value="<?php echo htmlentities($admin["email"], ENT_COMPAT, 'utf-8'); ?>" required />
            </div></div>


            <div class="form-group">
            <label  class="col-sm-2 control-label" for="nom">Fullname</label>
            <div class="col-sm-10">
            <input type="text"  class="form-control" name="nom" id="nom" value="<?php echo htmlentities($admin["nom"], ENT_COMPAT, 'utf-8'); ?>" required>
            </div></div>


<!--            <div class="form-group">-->
<!--            <label  class="col-sm-2 control-label" for="user_type">User type</label>-->
<!--            <div class="col-sm-10">-->
<!---->
<!--            <select  class="form-control"  name="user_type" id="user_type" >-->
<!--            <option value="--><?php //echo htmlentities($admin["user_type"]); ?><!--" selected>--><?php //echo htmlentities($admin["user_type"]); ?><!--</option>-->
<!--            <option value="admin">admin</option>-->
<!--            <option value="manager">manager</option>-->
<!--            <option value="secretary">secretary</option>-->
<!--            <option value="employee">employee</option>-->
<!--            </select>-->
<!--            </div></div>-->



            <div class="form-group">
            <label  class="col-sm-2 control-label" for="user_type_id">User type ID</label>
            <div class="col-sm-10">
            <select  class="form-control"  name="user_type_id" id="user_type_id" required>
            <option value="<?php echo htmlentities($admin["user_type_id"]); ?>" selected><?php echo htmlentities($admin["user_type"]); ?></option>
            <option value="1">admin</option>
            <option value="2">manager</option>
            <option value="3">secretary</option>
            <option value="4">employee</option>
            </select>
            </div></div>
      
      
      

   


         <div class="col-sm-offset-2 col-sm-7 col-xs-2">
             <button type="submit" name="submit" class="btn btn-primary">Edit Admin</button>
         </div>

         <div class="text-right " >
             <a href="manage_admins.php" class="btn btn-info " role="button">Cancel</a>
         </div>



     </fieldset> 
    </form>

              </div>
          </div>



          </div>
  <!--  <br />
    <a href="manage_admins.php">Cancel</a>-->

<?php if (is_admin()) {?>


<?php echo str_repeat("<br>", 4); ?>

    <div class="row hide-admin">
    <div class="col-md-4">

            <pre>
            <p><u>Only seen by Admin</u></p>
                <?php  print_r($admin);?>
            </pre>
    </div>
    </div>
<?php } ?>



<?php include("../includes/layouts/footer_2.php"); ?>
