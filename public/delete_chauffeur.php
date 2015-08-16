<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php

if (!isset($_GET["id"])) {
    redirect_to("admin.php");
}

$chauffeur = find_chauffeur_by_id($_GET["id"]);
if (!$chauffeur) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    redirect_to("manage_chauffeur.php");
}


$id = $chauffeur["id"];
$query = "DELETE FROM chauffeurs WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Chauffeur successfully deleted.";
    $_SESSION["OK"]=true;
    redirect_to("manage_chauffeur.php");
} else {
    // Failure
    $_SESSION["message"] = "Chauffeur deletion failed.";
    redirect_to("manage_chauffeur.php");
}

?>
