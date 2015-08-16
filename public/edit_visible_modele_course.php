<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/24/2014
 * Time: 4:53 PM
 */
?>
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

$modele= find_modele_by_id($_GET["modele_id"]);



if (!$modele) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    $_SESSION["message"] = "Modele does not exist in  database.";
    redirect_to($url);
}

if (is_chauffeur()){
    $_SESSION["message"] = "Chauffeur cannot modify or change only manager can.";
    redirect_to("manage_program.php");
}


$id = $modele["id"];

$visible=$modele["visible"];

if($visible==1){
    $visible_new=0;
}else{
    $visible_new=1;
}

$query  = "UPDATE programmed_courses_modele SET" . " ";
$query .= "visible = {$visible_new} ";
$query .= "WHERE id = {$id} ";
$query .= "LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Visibility statut successfully  change.";
    $_SESSION["OK"]=true;
    redirect_to($url);

} elseif ($result && mysqli_affected_rows($connection) == 0) {
    $_SESSION["message"] = "Visibility update failed because no change was made compare to what existed in db already.";
    unset($_POST);
    redirect_to($url);

} else {
    // Failure
    $_SESSION["message"] = "Visibility statut change failed.";
    redirect_to($url);
}