<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php

if (!isset($_GET["id"])) {
    redirect_to("admin.php");
}

$client = find_client_by_id($_GET["id"]);
if (!$client) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    redirect_to("manage_client.php");
}


$id = $client["id"];
$query = "DELETE FROM clients WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Client successfully deleted.";
    $_SESSION["OK"]=true;
    redirect_to("manage_client.php");
} else {
    // Failure
    $_SESSION["message"] = "Client deletion failed.";
    redirect_to("manage_client.php");
}

?>
