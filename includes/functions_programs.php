<?php




function find_program_error_query  () {
  $query="  , CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-','Erreur:','Chauffeur est vide') ELSE '' END as error_chauffeur , CASE WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-','Erreur:','depart / arrivee vide') WHEN ((depart='' OR depart is NULL)  ) then CONCAT_WS('-','Erreur:','depart vide') WHEN ( (arrivee='' OR arrivee is NULL) ) then CONCAT_WS('-','Erreur:','arrivee vide') ELSE '' END as error_address , CASE WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN CONCAT_WS('-','Erreur:','nom patient vide') WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN CONCAT_WS('-','Erreur:','Autres Colline vide')  WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-','Erreur:','sang bon no vide') ELSE ''
  END as error_pseudo, CASE WHEN chauffeur='' OR chauffeur IS NULL THEN CONCAT_WS('-','Erreur:','Au moins une erreur') WHEN ((depart='' OR depart is NULL) AND (arrivee='' OR arrivee is NULL) ) then  CONCAT_WS('-','Err:','Au moins une erreur') WHEN (pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL) THEN CONCAT_WS('-','Err:','Au moins une erreur') WHEN pseudo='autres' OR pseudo='colline' AND (pseudo_autres='' OR pseudo_autres IS NULL) THEN CONCAT_WS('-','Err:','Au moins une erreur')
  WHEN pseudo='tour_sang' OR pseudo='carouge_sang' AND (bon_no='' OR bon_no IS NULL) THEN CONCAT_WS('-','Err :','Au moins une erreur') ELSE '' END as erreur "  ;

    return $query;

}

function query_date_function_sql($date_col_name="course_date"){

   // $date_col_name="course_date";

     $query=" ,monthname({$date_col_name}) as mois, year({$date_col_name}) AS année, day({$date_col_name}) as jour_no, week({$date_col_name}) as semaine, yearweek({$date_col_name}) as annee_semaine, dayname ({$date_col_name}) as nom_jour ";

    return $query;
}




function choisir_distinct_form_date($col_name,$table_name){




}



function where_error_query (){

    $query="";
    $erreur_chauffeur="(chauffeur='' OR chauffeur IS NULL)";
    $erreur_address="(depart='' OR depart is NULL OR arrivee='' OR arrivee is NULL)";

    $erreur_autres="((pseudo='autres' OR pseudo='colline') AND (pseudo_autres='' OR pseudo_autres IS NULL))";

    $erreur_patients="((pseudo='tour_patient' OR pseudo='tag' OR pseudo= 'partners' OR pseudo='mines_icbl' OR pseudo='cash' or pseudo= 'aude' or pseudo= 'aloha') AND (nom_patient='' OR nom_patient IS NULL))";

    $erreur_sang="((pseudo='tour_sang' OR pseudo='carouge_sang') AND (bon_no='' OR bon_no IS NULL))";

    $or=" OR ";
    $erreur_general="(".$erreur_chauffeur.$or.$erreur_address.$or.$erreur_autres.$or.$erreur_patients.$or.$erreur_sang. ")";

    if (isset($_GET["erreur_chauffeur"])){
        $query.="AND ";
        $query.= $erreur_chauffeur;

    }

    if (isset($_GET["erreur_address"])){
        $query.="AND ";
        $query.= $erreur_address;

    }

    if (isset($_GET["erreur_autres"])){
        $query.="AND ";
        $query.= $erreur_autres;
    }


    if (isset($_GET["erreur_patients"])){
        $query.="AND ";
         $query.= $erreur_patients;
    }


    if (isset($_GET["erreur_sang"])){
        $query.="AND ";
        $query.= $erreur_sang;
    }


    if (isset($_GET["erreur_general"])){
        $query.="AND ";
        $query.=$erreur_general;
    }

    return $query;

}

function find_program_by_id ($id) {
    global $connection;
    $safe_program_id=mysql_prep($id);
    $query  = "SELECT * ";
    $query.= find_program_error_query();
    $query.= query_date_function_sql();
    $query .= "FROM programmed_courses ";
    $query .= "WHERE id = {$safe_program_id} ";
    $query .= "LIMIT 1";
    $program_set = mysqli_query($connection, $query);
    confirm_query($program_set);
    if($program = mysqli_fetch_assoc($program_set)) {
        return $program;
    } else {
        return null;
    }
}

function find_program_by_date ($date=false) {
    global $connection;

    if (isset($_GET["program_id"])){
        $id= (int) $_GET["program_id"];

    }

    if (isset($_GET["validation_chauffeur"])){
        $valid_chauffeur=$_GET["validation_chauffeur"];
          } else {
        $valid_chauffeur=3;
       }

    if (isset($_GET["validation_mgr"])){
        $valid_mgr=$_GET["validation_mgr"];
    } else {
        $valid_mgr=3;
    }

    if (isset($_GET["validation_final"])){
        $valid_final=$_GET["validation_final"];
    } else {
        $valid_final=3;
    }

    if (isset($_GET["prix_course"])){
        $prix_course=$_GET["prix_course"];
    }

    if (isset($_GET["pseudo"])){
        $pseudo= mysql_prep($_GET["pseudo"]);
    }








    $safe_date=mysql_prep($date);

    if (isset($id) ){
        $query_choose  = "WHERE id =  $id ";
    } else {
        $query_choose = "WHERE course_date = '{$safe_date}' ";
    }
 //  $safe_valid_chauffeur=mysql_prep($valid_chauffeur);

    $query  = "SELECT * ";
    $query.= find_program_error_query();
    $query.= query_date_function_sql();
    $query .= "FROM programmed_courses ";
    $query .=$query_choose ;

//    var_dump($query);
//    var_dump(query_date_function_sql());

//    if (isset($id) ){
//    $query  .= "AND id =  $id ";
//    }

    if (isset($pseudo) ){
   //     $query  .= "AND pseudo =  $pseudo ";
    }

    if ($valid_chauffeur==0 || $valid_chauffeur==1 || $valid_chauffeur==2 ){
    $query  .= "AND validated_chauffeur = $valid_chauffeur ";
    }

    if ($valid_mgr==0 || $valid_mgr==1 ){
        $query  .= "AND validated_mgr = $valid_mgr ";
    }

    if ($valid_final==0 || $valid_final==1 ){
        $query  .= "AND validated_final = $valid_final ";
    }

    if (isset($prix_course)) {
        if ($prix_course){
            $query  .= "AND prix_course = $prix_course ";
        }
    }



    $query.=where_error_query ();

    $query .= "ORDER BY course_date, heure ";

    // $query .= "LIMIT 1";
    $program_set = mysqli_query($connection, $query);
    confirm_query($program_set);
    return $program_set;

}

function find_all_programmed_courses(){
    global $connection;

if(isset($_GET["submit"]) && $_GET["submit"]=="historical_details"){

    if(isset($_GET["historical_id"])){
        $safe_id=  mysql_prep($_GET["historical_id"]);  }

    if(isset($_GET["historical_validated_chauffeur"])){
        $safe_validated_chauffeur=  mysql_prep($_GET["historical_validated_chauffeur"]);
    }

//    var_dump($_GET);

    if(isset($_GET["historical_validated_mgr"])){
        $safe_validated_mgr=  mysql_prep($_GET["historical_validated_mgr"]);  }


    if(isset($_GET["historical_validated_final"])){
        $safe_validated_final=  mysql_prep($_GET["historical_validated_final"]);  }


    if(isset($_GET["historical_course_date"])){
      $safe_course_date=  mysql_prep($_GET["historical_course_date"]);  }

    if(isset($_GET["historical_chauffeur"])){
            $safe_chauffeur= mysql_prep($_GET["historical_chauffeur"]) ;  }

    if(isset($_GET["historical_pseudo"])){
        $safe_pseudo= mysql_prep($_GET["historical_pseudo"]) ;  }

    if(isset($_GET["historical_pseudo_autres"])){
        $safe_pseudo_autres= mysql_prep($_GET["historical_pseudo_autres"]) ;  }

    if(isset($_GET["historical_depart"])){
        $safe_depart= mysql_prep($_GET["historical_depart"]) ;  }

    if(isset($_GET["historical_arrivee"])){
        $safe_arrivee= mysql_prep($_GET["historical_historical_arrivee"]) ;  }

    if(isset($_GET["historical_type_transport"])){
        $safe_type_transport= mysql_prep($_GET["historical_type_transport"]) ;  }

    if(isset($_GET["historical_nom_patient"])){
        $safe_nom_patient= mysql_prep($_GET["historical_nom_patient"]) ;  }

    if(isset($_GET["historical_bon_no"])){
        $safe_bon_no= mysql_prep($_GET["historical_bon_no"]) ;  }

    if(isset($_GET["historical_prix_course"])){
        $safe_prix_course= mysql_prep($_GET["historical_prix_course"]) ;  }

    if(isset($_GET["historical_monthname_course_date"])){
        $safe_monthname_course_date= mysql_prep($_GET["historical_monthname_course_date"]) ;  }

    if(isset($_GET["historical_year_course_date"])){
        $safe_year_course_date= mysql_prep($_GET["historical_year_course_date"]) ;  }

    if(isset($_GET["historical_yearweek_course_date"])){
        $safe_yearweek_course_date= mysql_prep($_GET["historical_yearweek_course_date"]) ;  }

    if(isset($_GET["historical_like_pseudo"])){
        $safe_like_pseudo= mysql_prep($_GET["historical_like_pseudo"]) ;  }

    if(isset($_GET["historical_like_depart"])){
        $safe_like_depart= mysql_prep($_GET["historical_like_depart"]) ;  }

    if(isset($_GET["historical_like_arrivee"])){
        $safe_like_arrivee= mysql_prep($_GET["historical_like_arrivee"]) ;  }


}
    $query  = "SELECT * ";
    $query.= find_program_error_query();
    $query.= query_date_function_sql();
    $query .= "FROM programmed_courses ";

    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
        $whereAnd=" AND ";
    } elseif (isset($safe_chauffeur) ) {
        if($safe_chauffeur){
            $query.="WHERE chauffeur='{$safe_chauffeur}' ";
        } else {
            $query .= "WHERE (chauffeur='' or chauffeur is null) ";
        }
     //   $query.="WHERE chauffeur='{$safe_chauffeur}' ";
        $whereAnd=" AND ";
    } else {
        $whereAnd=" WHERE ";
    }


    if( isset($safe_id) && $safe_id){
        $query.="{$whereAnd} id='{$safe_id}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else {
        $whereAnd = " WHERE ";
    }


    if( isset($safe_validated_chauffeur) && $safe_validated_chauffeur){
        $query.="{$whereAnd} validated_chauffeur='{$safe_validated_chauffeur}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else {
        $whereAnd = " WHERE ";
    }

    if( isset($safe_validated_mgr) && $safe_validated_mgr){
        $query.="{$whereAnd} validated_mgr='{$safe_validated_mgr}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else {
        $whereAnd = " WHERE ";
    }

    if( isset($safe_validated_final) && $safe_validated_final){
        $query.="{$whereAnd} validated_final='{$safe_validated_final}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if( isset($safe_course_date) && $safe_course_date){
        $query.="{$whereAnd} course_date='{$safe_course_date}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if( isset($safe_monthname_course_date) && $safe_monthname_course_date){
        $query.="{$whereAnd} monthname(course_date)='{$safe_monthname_course_date}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if( isset($safe_year_course_date) && $safe_year_course_date){
        $query.="{$whereAnd} year(course_date)='{$safe_year_course_date}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if( isset($safe_yearweek_course_date) && $safe_yearweek_course_date){
        $query.="{$whereAnd} yearweek(course_date)='{$safe_yearweek_course_date}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if( isset($safe_pseudo) && $safe_pseudo){
        $query.="{$whereAnd} pseudo='{$safe_pseudo}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if( isset($safe_type_transport) && $safe_type_transport){
        $query.="{$whereAnd} type_transport='{$safe_type_transport}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if( isset($safe_prix_course) && $safe_prix_course){
        $query.="{$whereAnd} prix_course='{$safe_prix_course}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if( isset($safe_like_pseudo) && $safe_like_pseudo){
        $query.="{$whereAnd} pseudo like '%{$safe_like_pseudo}%' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if( isset($safe_like_depart) && $safe_like_depart){
        $query.="{$whereAnd} depart like '%{$safe_like_depart}%' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if( isset($safe_like_arrivee) && $safe_like_arrivee){
        $query.="{$whereAnd} arrivee like '%{$safe_like_arrivee}%' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }



    $query .= "ORDER BY course_date DESC";
    $program_set = mysqli_query($connection, $query);
    confirm_query($program_set);
    return $program_set;

}



function count_prog_by_date($date_sql){
    global $connection;
    $safe_date=mysql_prep($date_sql);
    $query = "SELECT COUNT(*) AS c FROM programmed_courses WHERE course_date ='{$safe_date}' ";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row['c']; //
}


function count_prog_by_date_validated_chauffeur($date_sql){
    global $connection;
    $safe_date=mysql_prep($date_sql);
    $query = "SELECT COUNT(*) AS c FROM programmed_courses WHERE course_date ='{$safe_date}' AND validated_chauffeur =1 ";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row['c']; //
}



function get_modal_body_program ($program_id){
    $program = find_program_by_id ($program_id);
    $client= find_client_by_id($program["client_id"]);


    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($program["course_date"]);

    $grid="<div class='row'>";
    $grid1="<div class='col-md-12  col-lg-12'>";
//   $grid2="<div class='col-md-10 col-lg-10'>";
//
//   $grid3="</div>";
    $grid_2_DIV="</div></div>";

    $grid="";
    $grid1="";
    $grid2="";
    $grid_2_DIV="";

    $grid_head=$grid . $grid1;

    $modal_body="<dl class='dl-horizontal dd-color-blue'>";
    $modal_text="<dl class='dl-horizontal dd-color-blue'>";

    // $modal_body="<dl>";
    // $modal_body .="{$grid}<dt><strong>Pseudo</strong></dt><dd>". htmlentities($client['pseudo'], ENT_COMPAT, 'utf-8')."</dd>{$grid1}";
    // $modal_body .="{$grid}<dt><strong>Nom</strong></dt><dd>".htmlentities($client['web_view'], ENT_COMPAT, 'utf-8') ."</dd>{$grid1}";


    foreach ($program as $key =>$val){
        $key_clean= ucfirst(str_replace("_", "  ", $key));
        if($key=="course_date") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>Jour:"."</strong></dt>";
            $modal_body .= "";
            $modal_body .= "<dd>" . htmlentities($date_fr_short, ENT_COMPAT, 'utf-8'). "</dd>";
            $modal_body .= "{$grid_2_DIV}";
        } elseif($key=="validated_chauffeur") {
            if ($val==0){$val_yes_no="Non validé"; }elseif($val==2) { $val_yes_no="Annulé"; }else {$val_yes_no="Oui validé";}
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd> " . htmlentities($val_yes_no , ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";


        } elseif($key=="validated_mgr") {
            if ($val==0){$val_yes_no="Non validé";}else {$val_yes_no="Oui validé";}
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd> " . htmlentities($val_yes_no , ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        } elseif($key=="validated_final") {
            if(!is_chauffeur()){
                if ($val==0){$val_yes_no="Non validé";}else {$val_yes_no="Oui validé";}
                $modal_text .= "{$grid_head}";
                $modal_text .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
                $modal_text .= "<dd> " . htmlentities($val_yes_no , ENT_COMPAT, 'utf-8')  . "</dd>";
                $modal_text .= "{$grid_2_DIV}";
            }

        } elseif($key=="chauffeur") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";
        } elseif($key=="pseudo") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";


        } elseif($key=="heure") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        } elseif($key=="depart") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        } elseif($key=="arrivee") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        } elseif($key=="client_id") {
        } elseif($key=="modele_id") {
        } elseif($key=="input_date") {
        } elseif($key=="username") {
        } elseif($key=="prix_course") {
                if(!is_chauffeur()){
                        $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . " frs</dd>";
            $modal_body .= "{$grid_2_DIV}";
                }
        } else {
            $modal_text .= "{$grid_head}";
            $modal_text .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_text .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_text .= "{$grid_2_DIV}";
        }
    }

    $modal_body .="</dl>";
    $modal_text .="</dl>";

    $style_width_button="style='width: 7em;'";
    $div_id="mycollapeid{$program["id"]}";

    $modal_body.="<div class='col-xm-2'>";
    $modal_body .= " <button class='btn btn-info' type='button' data-toggle='collapse' data-target='#{$div_id}' {$style_width_button} aria-expanded='false' aria-controls='collapseExample'>+ info</button>";


    $modal_body .= "<div class='collapse' id='{$div_id}'>";
    $modal_body .= "                <div class='well'>";
    $modal_body .= $modal_text;
    $modal_body .= "</div></div>";

    $modal_body .= "</div>";


    return $modal_body;

}




function get_modal_program($program_id){

    // modal

    $program = find_program_by_id ($program_id);
    $client= find_client_by_id($program["client_id"]);

    $div_id="myModalprogram{$program_id}";

    $output = "";

    //   $output .= "";



    if($program["validated_chauffeur"]==1) {
        $color = "success";
    } elseif ($program["validated_chauffeur"]==2)    {
        $color = "danger";
    } else {
        $color="info";
    }




    $output.= "<a class='btn btn-{$color}' style='width:14em;' href='#' data-toggle='modal' data-target='#{$div_id}'>";
    $output.= "".htmlentities($client['web_view'],ENT_COMPAT, 'utf-8');

    //  $output.="<span class=\"glyphicon glyphicon-info-sign\" style='color: green;' aria-hidden='true'>";
  //  $output.="</span>";
    $output.= "</a>";
  //  $output.= "&nbsp;&nbsp; ";

    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($program["course_date"]);
// below is modal mode not shown (hidden)
    $output .= "<div class='modal fade' id='{$div_id}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    $output .= "    <div class='modal-dialog'>";
    $output .= "        <div class='modal-content'>";
    $output .= "            <div class='modal-header'>";
    $output .= "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $output .= "                <h5 class='modal-title' id='myModalLabel'>";
    $output .= "<span style='color: #ff0000;'><strong>".htmlentities( $date_fr_long, ENT_COMPAT, 'utf-8');
    $output .=  "</strong></span> &nbsp;&nbsp;- &nbsp;Pseudo :<strong>". htmlentities($client['pseudo'], ENT_COMPAT, 'utf-8');
    $output .= "</strong><br> Nom: <strong>". htmlentities($client['web_view'], ENT_COMPAT, 'utf-8');
    $output .= "</strong></h5>";



    $output .= "            </div>";
    $output .= "            <div class='modal-body'>";

    //function of body of modal
    $p_edit="edit_course_program.php";
    $p_del="delete_course_program.php";
    $p_new="new_course_program.php";
    $p_annulation="edit_annuler_course_program.php";
    $p_validation="edit_validation_chauffeur_program.php";
    $p_validation_mgr="edit_validation_mgr_program.php";
    $p_validation_final="edit_validation_final_program.php";
    $url="&url=".urlencode($_SERVER['PHP_SELF']);
    $query_string="&str_time=".urlencode($program['course_date']);

    $output .= "<div class='container-fluid text-left'> ";

    $output .= get_modal_body_program($program_id);;

 //   $output .= "<div class='container-fluid text-right'> ";
 //   $output .= "                <button type='button' class='btn btn-default' data-dismiss='modal'>&nbsp;Close&nbsp;</button>";
  //  $output .= "</div>";
    $output .= "</div>";


    $output .= "            </div>";


            $enable_accessr=true;

            $enable_access_valider=true;
            $enable_access_valider_mgr=true;
            $enable_access_valider_final=true;
            $enable_access_delete=true;
            $enable_access_annuler=true;
            $enable_access_edit=true;

            settype($p_val_chauf, "integer");
            settype($p_val_mgr, "integer");
            settype($p_val_final, "integer");

            $p_val_chauf= $program["validated_chauffeur"];
            $p_val_mgr= $program["validated_mgr"];
            $p_val_final= $program["validated_final"];


    if(is_chauffeur()){
        $enable_access_delete=false;
        $enable_access_valider_mgr=false;
        $enable_access_valider_final=false;
    }

    if($p_val_chauf==1) {
        $text_validation="Reactiver";
        $text_validation_annuler="Annuler";
        $enable_access_annuler=false;

                 if(is_chauffeur() && ( $_SESSION ["nom"] !==$program["chauffeur"] )){
                $enable_access_valider=false;
                $enable_access_annuler=false;
                 $enable_access_edit=false;

                 }

                // course annullé
    } elseif($p_val_chauf==2) {
        $text_validation="Reactiver";
        $text_validation_annuler="Re-Annuler";
        $enable_access_valider=false;

                if(is_chauffeur() && ( $_SESSION ["nom"] !==$program["chauffeur"] )){
                    $enable_access_annuler=false;
                    $enable_access_valider=false;
                    $enable_access_edit=false;

                }
    } else {
            $text_validation="Valider";
            $text_validation_annuler="Annuler";

        $enable_access_valider_mgr=false;
        $enable_access_valider_final=false;


    }



    if( $p_val_mgr==1){
        $enable_access_valider=false;
    //    $enable_access_valider_mgr=false;
    //    $enable_access_valider_final=false;
        $enable_access_delete=false;
        $enable_access_annuler=false;
        $enable_access_edit=false;

        $text_validation_mgr="Re- Mgr";

     } else {
        $text_validation_mgr = "Val Mgr";
        }


    if( $p_val_final==1){
        $enable_access_delete=false;
        $enable_access_annuler=false;
        $enable_access_valider=false;
        $enable_access_edit=false;
        $enable_access_valider_mgr=false;

        $text_validation_final="Re- final";
    } else {
        $text_validation_final="Val final";

    }


    // for testing re enable all-------------------------
//    $enable_access_valider=true;
//    $enable_access_valider_mgr=true;
//    $enable_access_valider_final=true;
//    $enable_access_delete=true;
//    $enable_access_annuler=true;
//    $enable_access_edit=true;

//----------------------------------------



    $style_width_button="style='width: 6em;'";


    $output .= "            <div class='modal-footer'>";
    $output .= "                <div class='btn-group btn-group-justified' role='group' aria-label='...'>";

    if($enable_access_edit) {
        $output .= "                <p class='btn'  ><a class='btn btn-primary btn-xm'{$style_width_button} href='{$p_edit}?program_id=" . urlencode($program_id).$query_string.$url . "'>Edit</a></p>";
    }

    if($enable_access_delete){
        if(!is_chauffeur()){
            $output .= "                <p class='btn'><a class='btn btn-danger btn-xm' {$style_width_button} href='{$p_del}?program_id=".urlencode($program_id).$query_string.$url."'>Delete</a></p>";
        }
    }

    if($enable_access_annuler){

            $output .= "                <p class='btn'><a class='btn btn-danger btn-xm' {$style_width_button} href='{$p_annulation}?program_id=".urlencode($program_id).$query_string.$url."'>{$text_validation_annuler}</a></p>";
            }

    $output .= "                <p class='btn' ><a class='btn btn-warning btn-xm' {$style_width_button} href='{$p_new}?program_id=".urlencode($program_id).$query_string.$url."'>add</a></p>";

    $output .= "                </div>";

    $output .= "            <div class='modal-footer'>";
    $output .= "                <div class='btn-group btn-group-justified' role='group' aria-label='...'>";


    if($enable_access_valider) {
        $output .= "                <p class='btn' ><a class='btn btn-success btn-group-sm '{$style_width_button} href='{$p_validation}?program_id=" . urlencode($program_id).$query_string.$url . "'>{$text_validation}</a></p>";
    }

    if($enable_access_valider_mgr) {
        if (!is_chauffeur()) {
            $output .= "                <p class='btn'><a class='btn btn-primary btn-xm' {$style_width_button} href='{$p_validation_mgr}?program_id=" . urlencode($program_id).$query_string.$url . "'>{$text_validation_mgr}</a></p>";

        }
    }


    if($enable_access_valider_final) {
        if (!is_chauffeur()) {
            $output .= "                <p class='btn'><a class='btn btn-primary btn-xm' {$style_width_button} href='{$p_validation_final}?program_id=" . urlencode($program_id) .$query_string.$url . "'>{$text_validation_final}</a></p>";

        }
    }




    $output .= "                <p class='btn' data-dismiss='modal'><a class=' btn btn-info btn-xm' {$style_width_button}>close</a> </p>";

    $output .= "                </div>";



    $output .= "            </div>";
    $output .= "        </div>";
    $output .= "    </div>";
    $output .= "</div>";


    return $output;
}


function output_program_day($string_date='now'){
    $date_unix = strtotime($string_date);
    $day_no = day_eng_no(strftime("%A" ,$date_unix));
    $date_formatted = strftime("%d %b %Y" ,$date_unix);
    $day_name_french = day_fr($day_no);
    $date_sql = strftime("%Y-%m-%d" ,$date_unix);
    $full_date_formatted= $day_name_french." ".$date_formatted;

    $output="";

    $program_set=find_program_by_date($date_sql);

    if(count_prog_by_date($date_sql) ==0){

        $output.= "<p class='text-center' style='vertical-align:middle;'>pas de résultat pour le {$full_date_formatted}</p>" ;

    } else {

        //  $output .=  Get_badges_program ($string_date);

        $output .="<div class='table-responsive'>";
        $output .= "<table class='table table-striped table-bordered table-hover table-condensed '>";


        $output .="<tr>";
        // $output .= "<td class='text-center alert-danger'>Jour</td>"; //Heure

        if (isset($_GET["validation_chauffeur"])){
            $valid_chauffeur=$_GET["validation_chauffeur"];
            if ($valid_chauffeur==1) {
                $color = "";
                $style = "color: white; background-color:green;";

            } elseif  ($valid_chauffeur==2){
                $color = "";
                $style = "color: white; background-color:palevioletred;";

            } elseif  ($valid_chauffeur==0){
                $color = "";
                $style = "color: white; background-color:lightskyblue;";

            } else {
                $color="";
                $style="";
            }
        } else {
            $valid_chauffeur=3;
            $color="";
            $style="";
        }


        $output .= "<th class='text-center {$color}' style='vertical-align:middle; {$style}'>&nbsp;Heure&nbsp;</th>";
        $output .= "<th class='text-center {$color}' style='vertical-align:middle;{$style} '>{$full_date_formatted
}</th>";
        //   $output .= "<th class='text-center {$color}' style='vertical-align:middle;{$style} '></th>";
        $output .="</tr>";


        while ($program = mysqli_fetch_assoc($program_set)) {
            $output .="<tr>";
            $client = find_client_by_id($program['client_id']);
            $heure = htmlentities(visu_heure($program['heure']), ENT_COMPAT, 'utf-8');
            $client_web_view = htmlentities($client['web_view'], ENT_COMPAT, 'utf-8');

            if($program["validated_chauffeur"]==1){
                $succes="success";
                $color1 = "success";
            } elseif ($program["validated_chauffeur"]==2) {
                $succes="";
                $color1 = "danger";
            } else {
                $succes="";
                $color1="info";
            }



//                if($program['chauffeur'] && ($program["validated_chauffeur"]==1 || $program["validated_chauffeur"]==2)) {
//                    $chauffeur =find_chauffeur_by_name(trim($program['chauffeur']));
//                    if ($chauffeur){
//                        $initial=$chauffeur['initial'];
//                    } else {
//                        $initial="";
//                    }
//
//                } else {
//                    $initial="";
//                }




            /* if($program["validated_chauffeur"]==1){
                 $output.=  "<td class='text-center {$succes}'  style='vertical-align:middle;'>". $heure."</td>";
             } else {
                 $output.=  "<td class='text-center'  style='vertical-align:middle;'>". $heure."</td>";
             }*/

            $output.=  "<td class='text-center {$succes}'  style='vertical-align:middle;'>". $heure."</td>";
            $output.=  "<td class='text-center {$succes}'>" . get_modal_program($program{'id'}) . "</td>";

//                $output.= "<td class='text-center {$succes}'><h5><span class='label label-{$color1}'  style='width:6em;'>";
//                $output.= "".htmlentities($initial,ENT_COMPAT, 'utf-8')."";
//                $output.= "</h5></span></td>";

            $output .="</tr>";

        }

        $output .="</table>";
        $output .="</div>";

    }


    mysqli_free_result($program_set);

    return $output;

}


function get_output_panel_program  ($string_date='now'){
    $date_unix = strtotime($string_date);
    $day_no = day_eng_no(strftime("%A" ,$date_unix));
    $date_formatted = strftime("%d %b %Y" ,$date_unix);
    $day_name_french = day_fr($day_no);
    $date_sql = strftime("%Y-%m-%d" ,$date_unix);
    $full_date_formatted= $day_name_french." ".$date_formatted;

    $Dif= count_prog_by_date($date_sql)-count_modele_by_day($day_no);

    $glyph_ok = "<span class='glyphicon glyphicon-ok'style='color:red;' aria-hidden='true'></span>";

    $count_valid="&nbsp;&nbsp;<span class='badge'>"."{$glyph_ok}&nbsp;".count_prog_by_date_validated_chauffeur($date_sql)."</span>&nbsp;";

    $count_prog="&nbsp;<span class='badge'>". count_prog_by_date($date_sql)."</span>";

    if (!is_chauffeur()){
        if($Dif==0){
            $count_mod="";
        } else {
            $count_mod="<span class='badge'>"."M ".count_modele_by_day($day_no)."</span>&nbsp;&nbsp;&nbsp;";
        }
    } else {
        $count_mod="";
    }

    $output="";

    if ($string_date=="now") {                      $text="Aujourdhui ";
    } elseif($string_date=="yesterday") {           $text="Hier ";
    } elseif($string_date=="tomorrow")  {           $text="demain ";
    } elseif($string_date=="2 day ago") {           $text= "{$string_date}";

    } else {                                        $text="{$string_date}";
    }

    //$output.="<div class='row'>" ;
    //$output.="<div class='col-md-3 '>" ;

    if (isset($_GET["validation_chauffeur"])){
        $valid_chauffeur=$_GET["validation_chauffeur"];
        if ($valid_chauffeur==1){
            $color="success";

        } elseif ($valid_chauffeur==2) {
            $color="danger";

        } elseif ($valid_chauffeur==0) {
            $color="info";

        } else {
            $color="primary";
        }
    } else {
        $valid_chauffeur=3;
        $color="primary";
    }


    $output.="<div class='panel panel-{$color}'>" ;
    //<!-- Default panel contents -->
    $output.="<div class='panel-heading text-center'>" ;
    $output.="<h3 class='panel-title text-center'>{$count_mod}{$text} {$count_prog}{$count_valid}</h3>" ;
    $output.="</div>" ;
    $output.=output_program_day($string_date) ;
    $output.="</div>" ;
    //  $output.="</div>" ;
    //  $output.="</div>" ;


    return $output;
}


function nav_menu_pills_program(){

    $style_pills="";
    if (isset($_GET["validation_chauffeur"])){
        $valid_chauffeur=$_GET["validation_chauffeur"];
        if($valid_chauffeur==1) {
            $style_pills = "customKamy_green";

        } elseif(($valid_chauffeur==2)){
            $style_pills = "customKamy_red";

        } elseif(($valid_chauffeur==0)){
            $style_pills = "customKamy_info";

        } else {$style_pills="";}

    } else {
        $valid_chauffeur=3;
        $style_pills="";
    }


    $href=$_SERVER['PHP_SELF'];

    if(isset($_GET['str_time'])){
        $href.="?str_time=";
        $href.=$_GET['str_time'];
    }

    if(!isset($_GET['str_time'])){
        $href.="?";
    } else {$href.="&";}

    $href.="validation_chauffeur=";

    $output="";

    $output.="  <ul class='nav nav-pills $style_pills '>";

    if($valid_chauffeur==0){$active='active';} else {$active='';}
    $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode(0);
    $output.="'>Ouvert";
    $output.=" </a></li>";

    if($valid_chauffeur==1){$active='active';} else {$active='';}
    $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode(1);
    $output.="'>Validé";
    $output.=" </a></li>";

    if($valid_chauffeur==2){$active='active';} else {$active='';}
    $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode(2);
    $output.="'>Annulé";
    $output.=" </a></li>";

    if($valid_chauffeur==3){$active='active';} else {$active='';}
    $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode(3);
    $output.="'>Tous";
    $output.=" </a></li>";

    $output.="</ul>";

    return $output;
}






?>