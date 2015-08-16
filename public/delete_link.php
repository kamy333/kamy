<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php //if(is_chauffeur()){ redirect_to('mylinks?category=Others.php' );}?>

<?php

if (!isset($_GET["links_id"])) {
    redirect_to("mylinks?category=Others.php");
}

$link = find_links_by_id($_GET["links_id"]);
if (!$link) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    redirect_to("myLinks.php?category=Others");
}


$id = $link["id"];
$query = "DELETE FROM links WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "links successfully deleted.";
    $_SESSION["OK"]=true;
    redirect_to("myLinks.php?category=Others");
} else {
    // Failure
    $_SESSION["message"] = "links deletion failed.";
    redirect_to("myLinks.php?category=Others");
}

?>
