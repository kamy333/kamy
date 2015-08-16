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

$program = find_program_by_id($_GET["program_id"]);

$query_string="?".$_SERVER['QUERY_STRING'];
if (isset($_GET["url"])) {
    $url=$_GET["url"].$query_string;
} else {
    $url="view_program_history.php".$query_string;

}

if (!isset($_GET["program_id"])) {
    redirect_to($url);
}




if (!$program) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    $_SESSION["message"] = "Program Course does not exist in  database.";
 //   redirect_to("manage_program.php");
    redirect_to($url);

}




$chauffeur_existing=$program["chauffeur"];
$chauffeur=$_SESSION["nom"];
// todo error report kevin course on another page
validate_chauffeur_by_name($chauffeur);



if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
  //  redirect_to("manage_program.php");
    redirect_to($url);

}

$safe_chauffeur=mysql_prep($chauffeur);
$validated_chauffeur=$program["validated_chauffeur"];

if (is_chauffeur() && $validated_chauffeur==1 ) {

    if ($_SESSION['nom']!==$chauffeur_existing){

    $_SESSION["message"] = " La course a déjà été validé par ".htmlentities( $chauffeur_existing , ENT_COMPAT, 'utf-8');
  //  redirect_to("manage_program.php");
        redirect_to($url);


    }
}



if (empty($errors)) {

    $id = $program["id"];


    if ($validated_chauffeur == 1) {
        $id_valid = 0;
    } else {
        $id_valid = 1;
    }

    $query = "UPDATE programmed_courses SET" . " ";
    $query .= "validated_chauffeur = {$id_valid}, ";
    $query .= "chauffeur = '{$safe_chauffeur}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        // Success
        $_SESSION["message"] = "Validation successfully statut change.";
        $_SESSION["OK"] = true;
        unset($_GET);

     //   redirect_to("manage_program.php");
        redirect_to($url);


    } elseif ($result && mysqli_affected_rows($connection) == 0) {
        $_SESSION["message"] = "Validation update failed because no change was made compare to what existed in db already.";
      //  redirect_to("manage_program.php");
        redirect_to($url);

        unset($_GET);

    } else {
        // Failure
        $_SESSION["message"] = "Validation statut change failed.";
     //   redirect_to("manage_program.php");
        redirect_to($url);

    }

} else {
   // redirect_to("manage_program.php");
    redirect_to($url);

}