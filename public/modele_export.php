<?php require_once('../includes/initialize.php'); ?>


<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>


<?php

if(isset($_GET['modele_date']) && isset( $_GET['modele_id'])){

    $date="'". mysql_prep($_GET['modele_date']) ."'";
//    $week_day_rank=  mysql_prep($_GET['jour'])  ;
    $id=mysql_prep($_GET['modele_id'])  ;
    $urlencode="?str_time=".urlencode($_GET['modele_date']);
    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($_GET['modele_date']);

    $msg=" en date du " . htmlentities($date_fr_short,ENT_COMPAT,'utf-8');


    $query=" INSERT INTO programmed_courses ( week_day_rank , modele_id , client_id , heure , depart , arrivee , prix_course , chauffeur , course_date, pseudo ) SELECT  programmed_courses_modele.week_day_rank , programmed_courses_modele.id , programmed_courses_modele.client_id , programmed_courses_modele.heure , programmed_courses_modele.depart , programmed_courses_modele.arrivee , if (programmed_courses_modele.prix_course is null , 0 , programmed_courses_modele.prix_course ) , programmed_courses_modele.chauffeur ,{$date} , clients.pseudo FROM programmed_courses_modele INNER JOIN clients ON programmed_courses_modele.client_id = clients.id WHERE programmed_courses_modele.id = {$id}";


    $result = mysqli_query($connection, $query);

    if ($result) {
        // Success
        $_SESSION["message"] = "Modèle successfully exported to program for Modele id={$id} {$msg}.";
        $_SESSION["OK"]=true;
        unset( $_GET);
        redirect_to("view_program_history.php".$urlencode);
    } else {
        // Failure
        $_SESSION["message"] = "Program creation failed.";
        unset( $_GET);
        redirect_to("view_program_history.php".$urlencode);
    }


}




if(isset($_GET['modele_date']) && isset( $_GET['jour'])){


// only visible
$date="'". mysql_prep($_GET['modele_date']) ."'";
$week_day_rank=  mysql_prep($_GET['jour'])  ;

$urlencode="?str_time=".urlencode($_GET['modele_date']);
//$msg=htmlentities(day_fr( $_GET['jour']),ENT_COMPAT,'utf-8');
    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($_GET['modele_date']);

    $msg=" en date du " . htmlentities($date_fr_short,ENT_COMPAT,'utf-8');
 // $msg.=" en date du " . htmlentities($_GET['modele_date'],ENT_COMPAT,'utf-8');



  $query=" INSERT INTO programmed_courses ( modele_id , client_id , heure , depart , arrivee , prix_course , chauffeur , course_date, pseudo,type_transport ) SELECT   programmed_courses_modele.id , programmed_courses_modele.client_id , programmed_courses_modele.heure , programmed_courses_modele.depart , programmed_courses_modele.arrivee , if (programmed_courses_modele.prix_course is null , 0 , programmed_courses_modele.prix_course ) , programmed_courses_modele.chauffeur ,{$date} , clients.pseudo, programmed_courses_modele.type_transport FROM programmed_courses_modele INNER JOIN clients ON programmed_courses_modele.client_id = clients.id WHERE programmed_courses_modele.visible = 1 and programmed_courses_modele.week_day_rank = {$week_day_rank}";


    $result = mysqli_query($connection, $query);



    if ($result) {
        // Success
        $_SESSION["message"] = "Modèle successfully exported to program for {$msg}.";
        $_SESSION["OK"]=true;
        unset( $_GET);
        redirect_to("view_program_history.php".$urlencode);
    } else {
        // Failure
        $_SESSION["message"] = "Course creation failed.";
        unset( $_GET);
        redirect_to("view_program_history.php".$urlencode);
    }


}

?>

