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

<?php

if (!isset($_GET["id"])) {
    redirect_to("manage_client.php");
}

$client = find_client_by_id($_GET["id"]);


if (!$client) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    $_SESSION["message"] = "Client does not exist in client database.";
    redirect_to("manage_client.php");
}

if (is_chauffeur()){
    $_SESSION["message"] = "Chauffeur can statut change only manager can.";
    redirect_to("admin.php");
}


$id = $client["id"];

$liste_restrictive=$client["liste_restrictive"];

if($liste_restrictive==1){
    $id_restrict=0;
}else{
    $id_restrict=1;
}

$query  = "UPDATE clients SET" . " ";
$query .= "liste_restrictive = {$id_restrict} ";
$query .= "WHERE id = {$id} ";
$query .= "LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Restriction successfully statut change.";
    $_SESSION["OK"]=true;
    redirect_to("manage_client.php");

} elseif ($result && mysqli_affected_rows($connection) == 0) {
    $_SESSION["message"] = "Restriction update failed because no change was made compare to what existed in db already.";
    redirect_to("manage_client.php");
    unset($_POST);

} else {
    // Failure
    $_SESSION["message"] = "Restriction statut change failed.";
    redirect_to("manage_client.php");
}