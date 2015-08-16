<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>
<?php if(is_secretary()){ redirect_to('manage_program.php' );}?>


<?php

if (!isset($_GET["id"])) {
	redirect_to("manage_admins.php");
}

  $admin = find_admin_by_id($_GET["id"]);
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_admins.php");
  }

if (is_chauffeur()){
    $_SESSION["message"] = "Chauffeur cannot delete add edit a user.";
    redirect_to("admin.php");
}



if ($admin["username"]=="admin") {
    $_SESSION["message"] = "Cannot delete Admin password. Only user to keep";
    redirect_to("manage_admins.php");
}



  
  $id = $admin["id"];
  $query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Admin deleted.";
      $_SESSION["OK"]=true;
    redirect_to("manage_admins.php");
  } else {
    // Failure
    $_SESSION["message"] = "Admin deletion failed.";
    redirect_to("manage_admins.php");
  }
  
?>
