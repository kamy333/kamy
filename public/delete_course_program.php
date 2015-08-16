<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>


<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php


$query_string="?".$_SERVER['QUERY_STRING'];


if (isset($_GET["url"])) {
    $url=$_GET["url"].$query_string;
} else {
    $url="manage_program.php".$query_string;

}



if (!isset($_GET["program_id"])) {
	redirect_to($url);
}

  $program = find_program_by_id($_GET["program_id"]);
  if (!$program) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to($url);
  }

if (is_chauffeur()){
    $_SESSION["message"] = "Chauffeur cannot delete add edit a course.";
    redirect_to("admin.php");
}


  $id = $program["id"];
  $query = "DELETE FROM programmed_courses WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Program course deleted.";
      $_SESSION["OK"]=true;
    redirect_to($url);
  } else {
    // Failure
    $_SESSION["message"] = "Program course deletion failed.";
    redirect_to($url);
  }
  
?>
