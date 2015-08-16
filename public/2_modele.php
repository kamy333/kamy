<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<h4 class="text-center"><mark></mark></h4>

<?php

$query="SELECT *, CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-',id,pseudo) ELSE '' END as error_chauffeur , CASE WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-',id,'depart / arrivee') WHEN ((depart='' OR depart is NULL)  ) then CONCAT_WS('-',id,'depart') WHEN ( (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-',id,'arrivee') ELSE '' END as error_address , CASE WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN 'nom patient' WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN 'autres' WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-',id,'sang') ELSE ''
END as error_pseudo, CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-',id,'erreur') WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then  CONCAT_WS('-',id,'erreur') WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN CONCAT_WS('-',id,'erreur') WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN CONCAT_WS('-',id,'erreur')
WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-',id,'erreur') ELSE '' END as erreur FROM programmed_courses ;
";


    $date_set = mysqli_query($connection, $query);
    confirm_query($date_set);
//    return $date_set;


while($result=mysqli_fetch_assoc($date_set)){

    foreach($result as $key=> $val){

    echo $key ."---" .$val."<br>";
    }


}


mysqli_free_result($date_set);


?>

<?php include("../includes/layouts/footer_2.php"); ?>
