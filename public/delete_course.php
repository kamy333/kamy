<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/functions_courses.php"); ?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>

<?php

if (!isset($_GET["id"])) {
	redirect_to("admin.php");
}

$course = find_course_by_id($_GET["id"]);


  if (!$course) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
      $_SESSION["message"] = "Course does not exist or was previously deleted.";
      redirect_to("admin.php");
  }

// TODO some checking to delete and book course retour---reverse retour?


/*if ($_SESSION['user_type_id']==4 && $course['validated']==1) {
    $_SESSION["message"] = "Course cannot be deleted. It was validated already by manager.";
    redirect_to("admin.php");
}



if(($_SESSION['nom']!== $course['chauffeur']) && $_SESSION['user_type_id']==4 ){
    $_SESSION["message"] = "Course cannot be deleted. You can only delete your course.";
    redirect_to("admin.php");
}*/
  
  $id = $course["id"];
  $query = "DELETE FROM courses WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Course successfully deleted.";
      $_SESSION["OK"]=true;
        redirect_to("admin.php");
  } else {
    // Failure
    $_SESSION["message"] = "Admin deletion failed.";
    redirect_to("admin.php");
  }