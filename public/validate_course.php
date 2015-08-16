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
    $_SESSION["message"] = "Course does not exist in course database.";
    redirect_to("admin.php");
}

if (is_chauffeur()){
    $_SESSION["message"] = "Chauffeur cannot validate only manager can.";
    redirect_to("admin.php");
}


// TODO some checking to validation and book course retour
if ( $course['validated']==1) {
    $_SESSION["message"] = "Course cannot be deleted. It was  already validated by a manager.";
    redirect_to("admin.php");
}



$id = $course["id"];

$query  = "UPDATE courses SET ";
$query .= "validated = 1 ";
$query .= "WHERE id = {$id} ";
$query .= "LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Course successfully validated.";
    $_SESSION["OK"]=true;

            if($course["aller_retour1"]==0  ) {
                redirect_to("admin.php");
            }

} else {
    // Failure
    $_SESSION["message"] = "Course validation failed.";

            if($course["aller_retour1"]==0 ) {
                redirect_to("admin.php");
            }
}



if($course["aller_retour1"]==1 && $course["retour_booked"]==0  ){

    $retour_booked=1;
    $validated=1;
    $datecourse=$course["course_date"];
    $client_id=1;
    $pseudo=$course["pseudo"];
    $pseudo_autres=$course["pseudo_autres"];
    $heure_retour=$course["heure_retour"];
    $aller_retour1=$course["aller_retour1"];
    $chauffeur=$course["chauffeur"];
    $arrivee=$course["arrivee"];
    $depart=$course["depart"];
    $type_transport=$course["type_transport"];
    $autres_prestations=$course["autres_prestations"];
    $prix_course=$course["prix_course"];

    $nom_patient=$course["nom_patient"];
    $bon_no=$course["bon_no"];
    $remarque=$course["remarque"];
    $username=$course["username"];
    $user_id=$course["user_id"];
    $user_fullname=$course["user_fullname"];
    $username_validation=$_SESSION['username'];

    $todaytime = date("Y-m-d H:i:s");
    $date_validation=$todaytime;


    $query="INSERT INTO courses (retour_booked,validated,programed,invoiced,course_date,client_id,pseudo,pseudo_autres,heure,heure_retour,aller_retour,aller_retour1,chauffeur,depart,arrivee,type_transport,autres_prestations,prix_course,nom_patient,bon_no,remarque, username, user_id , user_fullname,username_validation,date_validation ) VALUES  ({$retour_booked},{$validated},0,0,'{$datecourse}',{$client_id},'{$pseudo}','{$pseudo_autres}','{$heure_retour}', '','Retour',{$aller_retour1},'{$chauffeur}','{$arrivee}','{$depart}','{$type_transport}','{$autres_prestations}', {$prix_course},'{$nom_patient}', '{$bon_no}', '{$remarque}', '{$username}', {$user_id}, '{$user_fullname}','{$username_validation}','{$date_validation}')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        // Success
        $_SESSION["message"] .= " with return.";
        $_SESSION["OK"]=true;
        redirect_to("admin.php");


    } else {
        // Failure
        $_SESSION["message"] .= " Returned failed.";
        redirect_to("admin.php");

    }

    redirect_to("admin.php");



}