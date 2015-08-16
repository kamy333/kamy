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
    $url="manage_courses_modele.php".$query_string;

}

if (!isset($_GET["modele_id"])) {
    redirect_to($url);
}



$modele = find_modele_by_id ($_GET["modele_id"]);
if (!$modele) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    redirect_to($url);
}


$id = $modele["id"];
$query = "DELETE FROM programmed_courses_modele WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Course modele successfully deleted.";
    $_SESSION["OK"]=true;
    redirect_to($url);
} else {
    // Failure
    $_SESSION["message"] = "Course modele deletion failed.";
    redirect_to($url);
}

?>
