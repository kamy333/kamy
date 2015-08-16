<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>



<?php  // check
if (is_chauffeur()){
    $_SESSION["message"] = "Chauffeur cannot delete add  a user.";
    redirect_to("admin.php");
}
?>


<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password","email","nom","user_type_id");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);

   validate_email(array("email"));



    if (empty($errors)) {
    // Perform Create

        if($_POST["user_type_id"]==1) {
            $_POST["user_type"] = "admin";
        } elseif  ($_POST["user_type_id"]==2){
            $_POST["user_type"] = "manager";
        } elseif  ($_POST["user_type_id"]==3){
            $_POST["user_type"] = "secretary";
        } elseif  ($_POST["user_type_id"]==4) {
            $_POST["user_type"] = "employee";
        } else {
            $_POST["user_type"] = "not such type error";
        }





        $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
	$email = mysql_prep($_POST["email"]);
	$user_type= mysql_prep($_POST["user_type"]);
	$nom= mysql_prep($_POST["nom"]);
	$user_type_id= mysql_prep($_POST["user_type_id"]);


        $table="admins";
    
    $query  = "INSERT INTO {$table} (";
    $query .= "  username, hashed_password, email, user_type, user_type_id, nom";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}', '{$email}', '{$user_type}', {$user_type_id}, '{$nom}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Admin created.";
        $_SESSION["OK"]=true;
      redirect_to("manage_admins.php");
    } else {
      // Failure
      $_SESSION["message"] = "Admin creation failed.";
    }

} else {
    // This is probably a GET request
}
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="" //custom_form  ?>
<?php $javascript="form_admin" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>





<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row visible-lg visible-md">
<div class ="">

    <h2 class="text-center">Create a new Admin</h2>
</div>
    </div>


<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">

        <div class ="background_light_blue">

        <form id=""  class="group form-horizontal" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


    <fieldset id="" title="Create a new user">
    <legend class="text-center" style="color: #0000ff">New user</legend>



        <div class="form-group">
            <label   class="col-sm-3 control-label"  for="username">Username</label>
                <div class="col-sm-9">
            <input  class="form-control" type="text" autocomplete="off" name="username" id="username" value="" required />
            </div></div>

            <div class="form-group">
            <label   class="col-sm-3 control-label" for="password">Password</label>
                <div class="col-sm-9">
            <input  class="form-control" type="password" autocomplete="off" name="password" id="password" value="" required />
            </div></div>

            <div class="form-group">
            <label  class="col-sm-3 control-label"  for="email">Email</label>
                <div class="col-sm-9">
            <input  class="form-control" type="email" name="email" id="email" placeholder="Enail" required />
            </div></div>


                <div class="form-group">
            <label  class="col-sm-3 control-label"  for="nom">Fullname</label>
                    <div class="col-sm-9">
            <input  class="form-control" type="text" name="nom" id="nom" value="" required="" placeholder="prénom nom"/>
                </div></div>


                        <div class="form-group">
            <label  class="col-sm-3 control-label"  for="user_type_id">User type id</label>
                            <div class="col-sm-9">
            <select  class="form-control"  name="user_type_id" id="user_type_id" required>
            <option value="" disabled selected>Choisir type user ID</option>
            <option value="1">admin</option>
            <option value="2">manager</option>
            <option value="3">secretary</option>
            <option value="4">employee</option>
            </select>
            </div></div>


        <div class="col-sm-offset-3 col-sm-7 col-xs-2">
            <button type="submit" name="submit" class="btn btn-primary">New Admin</button>
        </div>

        <div class="text-right" >
            <a href="manage_admins.php" class="btn btn-info " role="button">Cancel</a>
        </div>


      </fieldset>
    </form>
   <!-- <br />
    <a href="manage_admins.php">Cancel</a>-->
    </div>
  </div>
</div>

<?php include("../includes/layouts/footer_2.php"); ?>
