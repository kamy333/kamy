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
<?php if(is_chauffeur()){redirect_to("view_program_history.php");} ?>

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


// validation mgr all data must be completed


settype($validated_mgr,"integer");
settype($validated_chauffeur,"integer");
settype($validated_final,"integer");


$validated_mgr= (int) $program["validated_mgr"];
$validated_chauffeur= (int) $program["validated_chauffeur"];
$validated_final= (int) $program["validated_final"];



if($validated_chauffeur==2) {
    $required_fields = array("course_date", "heure", "pseudo");

} else {
    $required_fields = array("course_date", "chauffeur", "heure", "pseudo", "depart", "arrivee");
}



validate_presences_non_post($required_fields,$program);

$pseudo=$program["pseudo"];
$pseudo_autres=$program["pseudo_autres"];
$nom_patient=$program["nom_patient"];

$prix_course=$program["prix_course"];
$chauffeur=$program["chauffeur"];



if($validated_chauffeur===0){
    $errors["validation_chauffeur"] = fieldname_as_text($field) . " doit etre auparavant validé ou annulé par chauffeur avant manager!";

}

if($validated_mgr===0){
    $errors["validation_manager"] = fieldname_as_text($field) . " doit etre auparavant validé ou annulé par chauffeur avant manager!";

}



if(!$validated_chauffeur==2) {

    validate_pseudo($pseudo, $pseudo_autres, $nom_patient);
    validate_chauffeur_by_name($chauffeur);
    validation_pseudo_clients($pseudo);

}



if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    //  redirect_to("manage_program.php");
    redirect_to($url);

}




if (empty($errors)) {

    $id = $program["id"];

    settype($id_valid,"integer");

    if ($validated_final === 1) {
        $id_valid = 0;
    } else {
        $id_valid = 1;
    }

    $query = "UPDATE programmed_courses SET" . " ";
    $query .= "validated_final = {$id_valid} ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        // Success
        $_SESSION["message"] = "Validation finale successfully statut change.";
        $_SESSION["OK"] = true;
        unset($_GET);

        //   redirect_to("manage_program.php");
        redirect_to($url);


    } elseif ($result && mysqli_affected_rows($connection) == 0) {
        $_SESSION["message"] = "Validation finale update failed because no change was made compare to what existed in db already.";
        //  redirect_to("manage_program.php");
        redirect_to($url);

        unset($_GET);

    } else {
        // Failure
        $_SESSION["message"] = "Validation final statut change failed.";
        //   redirect_to("manage_program.php");
        redirect_to($url);

    }

} else {
    // redirect_to("manage_program.php");
    redirect_to($url);

}