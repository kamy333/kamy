<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="modele" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<?php

?>

<div class="row">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
<h4 class="text-center"><a href="view_program_history.php">Historique des courses</a> </h4>
<br>
</div>

<?php




function find_distinct_course_date(){
    global $connection;

    if(isset($_GET["historical_course_date"])){
        $safe_course_date=  mysql_prep($_GET["historical_course_date"]);  }

    if(isset($_GET["historical_monthname_course_date"])){
        $safe_monthname_course_date= mysql_prep($_GET["historical_monthname_course_date"]) ;  }

    if(isset($_GET["historical_year_course_date"])){
        $safe_year_course_date= mysql_prep($_GET["historical_year_course_date"]) ;  }


    if(isset($_GET["historical_yearweek_course_date"])){
        $safe_yearweek_course_date= mysql_prep($_GET["historical_yearweek_course_date"]) ;  }



    $query="SELECT * FROM summary_by_course_date_program ";

    if(isset($safe_course_date)){
     $query.="WHERE course_date='{$safe_course_date}' " ;
        $whereAnd=" AND ";
    } else {
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


//    if (isset($_GET)  ){
//        if(isset($_GET["course_date"])){
//            $safe_course_date= mysql_prep($_GET["course_date"]);
//            $query="WHERE course_date = {$safe_course_date} ";
//        }
//    }
    $date_set = mysqli_query($connection, $query);
    confirm_query($date_set);
    return $date_set;
}


function table_historical(){
    $date_set =   find_distinct_course_date();

    $output="";

    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";


    $output .="<tr>";
    // $output .= "<td class='text-center alert-danger'>Jour</td>"; //Heure
    $output .= "<th class='text-center' style='vertical-align:middle;'>Année</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Mois</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Semaine</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Date</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Total courses</th>";
    if(!is_chauffeur()){
        $output .= "<th class='text-center' style='vertical-align:middle;'>Prix course à 0</th>";
    }

    $output .= "<th class='text-center' style='vertical-align:middle;'>Non Valid Chauff</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Valid Chauff</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Annulé</th>";

if(!is_chauffeur()) {

    $output .= "<th class='text-center' style='vertical-align:middle;'>Non Valid Manager</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Valid Manager</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Non Valid final</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Valid final</th>";
}
    $output .= "<th class='text-center' style='vertical-align:middle;'>Err Chauffeur</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Err Adresse</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Err Autres</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Err Patients</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Err Sang</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Err total</th>";


    $output .="</tr>";



    $prev_year="";
    $prev_mth="";
    $prev_wk="";

while($date = mysqli_fetch_assoc($date_set)) {

foreach ($date as $key=>$val){
    $$key=htmlentities(trim($val),ENT_COMPAT,'utf-8');

}



    if (isset($monthname)) {$monthname=mth_fr_name($monthname);}


    $today_date_sql = strftime("%Y-%m-%d" ,time());
    $tomorrow_date_sql=strftime("%Y-%m-%d" ,strtotime("tomorrow"));
    $yesterday_date_sql=strftime("%Y-%m-%d" ,strtotime("yesterday"));

//    var_dump($date["course_date"]);
//    var_dump($tomorrow_date_sql);
//    var_dump($yesterday_date_sql);

    if($today_date_sql==$date["course_date"]){
        $color="success";
    } elseif ($tomorrow_date_sql==$date["course_date"]) {
        $color="warning";
    } elseif ($yesterday_date_sql==$date["course_date"]) {
        $color="danger";

    } else {
        $color="";
    }



    $output .="<tr class='{$color}'>";

    if (isset($year)) {
        if($year==$prev_year){
           $output.="<td></td>";
        } else {
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            $output .="";
            $output .=$year;
            $output .="</td>";
            $prev_year=$year;
        }

    } else {$output.="<td></td>";}

    if (isset($monthname)) {
        if($monthname==$prev_mth){
            $output.="<td></td>";
        } else {
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= $monthname;
            $output .= "</td>";
            $prev_mth=$monthname;
        }

    }else {$output.="<td></td>";}

    if (isset($week)) {
        if($week==$prev_wk){
            $output.="<td></td>";
        } else {
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= "";
            $output .= $week;
            $output .= "</td>";
        }
        $prev_wk=$week;
    }else {$output.="<td></td>";}

    $href=$_SERVER['PHP_SELF'];
    if (isset($str_time)) {
        $href.= "?str_time=". urlencode($str_time);
            }



    if (isset($date_format) && isset($course_date)) {
           $href_Course_date="&historical_course_date=".urlencode($course_date);
           $href_Course_date.="&submit=".urlencode('historical_details');

        //


        $output .="<td class='text-center' style='vertical-align: middle;'>";

        $output .= "<a href='{$href}{$href_Course_date}'>";
        $output .=$date_format;
        $output .="</a>";
        $output .="</td>";
    } else {$output.="<td></td>";}

    if (isset($total_course)) {
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .=$total_course;
        $output .="</td>";
    } else {$output.="<td></td>";}

    if(!is_chauffeur()) {
        if (isset($prix_course_0)) {
            $href_valid_0 = $href . "&prix_course=" . urlencode(0);
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_valid_0}'>";
            $output .= $prix_course_0;
            $output .= "</a>";
            $output .= "</td>";
        } else {
            $output .= "<td></td>";
        }
    }


    if (isset($valid_chauf_0)) {
        $href_valid_0=$href."&validation_chauffeur=". urlencode(0);
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_valid_0}'>";
        $output .=$valid_chauf_0;
        $output .="</a>";
        $output .="</td>";
    } else {$output.="<td></td>";}

    if (isset($valid_chauf_1)) {
        $href_valid_1=$href."&validation_chauffeur=". urlencode(1);
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_valid_1}'>";
        $output .=$valid_chauf_1;
        $output .="</a>";
        $output .="</td>";
    } else {$output.="<td></td>";}

    if (isset($valid_chauf_2)) {
        $href_valid_2=$href."&validation_chauffeur=". urlencode(2);
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_valid_2}'>";
        $output .=$valid_chauf_2;
        $output .="</a>";
        $output .="</td>";
    } else {$output.="<td></td>";}


    if(!is_chauffeur()) {
        if (isset($valid_mgr_0)) {
            $href_mgr_0 = $href . "&validation_mgr=" . urlencode(0);
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_mgr_0}'>";
            $output .= $valid_mgr_0;
            $output .= "</a>";
            $output .= "</td>";
        }
    }

    if(!is_chauffeur()) {
        if (isset($valid_mgr_1)) {
            $href_mgr_1 = $href . "&validation_mgr=" . urlencode(1);
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_mgr_1}'>";
            $output .= $valid_mgr_1;
            $output .= "</a>";
            $output .= "</td>";
        } else {
            $output .= "<td></td>";
        }
    }

    if(!is_chauffeur()) {
        if (isset($valid_fina1_0)) {
            $href_final_0 = $href . "&validation_final=" . urlencode(0);
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_final_0}'>";
            $output .= $valid_fina1_0;
            $output .= "</a>";
            $output .= "</td>";
        } else {
            $output .= "<td></td>";
        }
    }


    if(!is_chauffeur()) {
        if (isset($valid_fina1_1)) {
            $href_final_1 = $href . "&validation_final=" . urlencode(1);
            $output .= "<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_final_1}'>";
            $output .= $valid_fina1_1;
            $output .= "</a>";

            $output .= "</td>";
        } else {
            $output .= "<td></td>";
        }
    }


    if (isset($erreur_chauffeur)) {
        $href_erreur_chauffeur=$href."&erreur_chauffeur=". urlencode('yes');
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_erreur_chauffeur}'>";
        $output .=$erreur_chauffeur;
        $output .="</a>";

        $output .="</td>";
    } else {$output.="<td></td>";}


    if (isset($erreur_address)) {
        $href_erreur_address=$href."&erreur_address=". urlencode('yes');
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_erreur_address}'>";
        $output .=$erreur_address;
        $output .="</a>";

        $output .="</td>";
    } else {$output.="<td></td>";}


    if (isset($erreur_autres)) {
        $href_error_autres=$href."&erreur_autres=". urlencode('yes');
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_error_autres}'>";
        $output .=$erreur_autres;
        $output .="</a>";

        $output .="</td>";
    } else {$output.="<td></td>";}


    if (isset($erreur_patients)) {
        $href_error_patients=$href."&erreur_patients=". urlencode('yes');
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_error_patients}'>";
        $output .=$erreur_patients;
        $output .="</a>";

        $output .="</td>";
    } else {$output.="<td></td>";}


    if (isset($erreur_sang)) {
        $href_error_sang=$href."&erreur_sang=". urlencode('yes');
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_error_sang}'>";
        $output .=$erreur_sang;
        $output .="</a>";

        $output .="</td>";
    } else {$output.="<td></td>";}


    if (isset($erreur_general)) {
        $href_error_general=$href."&error_general=". urlencode('yes');
        $output .="<td class='text-center' style='vertical-align: middle;'>";
        $output .= "<a href='{$href_error_general}'>";
        $output .=$erreur_general;
        $output .="</a>";

        $output .="</td>";
    } else {$output.="<td></td>";}

    $output .="</tr>";


}





    $output .="</table>";
    mysqli_free_result($date_set);
    $output .="</div>";

    return $output;

}




?>



<?php
function nav_menu_historical(){
   $a= $_SERVER["QUERY_STRING"];

    $href=$_SERVER['PHP_SELF'];

    $href.="?str_time_historic=";

//   var_dump($a);

    if(isset($_GET['str_time_historic'])){
        $str_time_historic=$_GET['str_time_historic'];
    }
//    $href=$_SERVER['PHP_SELF'];
//    if(isset($_GET['str_time_historic'])){
//        $href.="?str_time_historic=";
//      $href.=$_GET['str_time_historic'];
//    } else {
//
//    }

    $output="";


    $output.="  <ul class='nav nav-pills'>";

    $text_code="yesterday";
        if((isset($str_time_historic)) && $str_time_historic==$text_code){$active='active';} else {$active='';}
        $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode($text_code)."&str_time=".urlencode($text_code);
    $output.="'>Hier";
    $output.=" </a></li>";

    $text_code="now";

    if((isset($str_time_historic)) && $str_time_historic==$text_code){$active='active';} else {$active='';}

    $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode($text_code)."&str_time=".urlencode($text_code);
    $output.="'>Aujourd'hui";
    $output.=" </a></li>";

    $text_code="tomorrow";
    if((isset($str_time_historic)) && $str_time_historic==$text_code){$active='active';} else {$active='';}

    $output.="  <li role='presentation' class='{$active}'><a href='";
    $output.= $href.urlencode($text_code)."&str_time=".urlencode($text_code);
    $output.="'>Demain";
    $output.=" </a></li>";

    $output.="</ul>";

    return $output;

}
?>


<?php

function get_modal_recherche_program (){
    $output="";

//    <!-- Button trigger modal -->
$output.="<button type='button' class='btn btn-primary btn-xm'
    data-toggle='modal' data-target='#myModalRecherche'>";
$output.="        Recherche";

$output.="    </button>";


$output.="<!-- Modal -->";
    $output.="<div class='modal fade' id='myModalRecherche' tabindex='-1' role='dialog'
    aria-labelledby='myModalLabel'>";
$output.="  <div class='modal-dialog' role='document'>";
    $output.="    <div class='modal-content'>";

$output.="      <div class='modal-header'>";
    $output.="        <button type='button' class='close' data-dismiss='modal'
    aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
$output.="        <h4 class='modal-title' id='myModalLabel'>Recherche une course</h4>";
    $output.="      </div>";

$output.="      <div class='modal-body'>";

    $output.=get_modal_body_recherche_program();

  //  $output.="</div>";

$output.="      </div>";
    $output.="      <div class='modal-footer'>";

$output.="        <button type='button' class='btn btn-default'
    data-dismiss='modal'>Close</button>";
//$output.="        <button type='button' class='btn btn-primary'>Rechercher</button>";
$output.="      </div>";
    $output.="    </div>";

$output.="  </div>";
    $output.="</div>";

return $output;


}

function get_modal_body_recherche_program(){
    $output="";

    $output.=" <div class='container-fluid'>";

  //  $output.="<p class='text-center'><strong><mark></mark>Details</mark></strong> </p>";

$output.="<a class='btn btn-primary' role='button' data-toggle='collapse' href='#collapseSearchDetails' aria-expanded='false' aria-controls='collapseSearchDetails'>
        Recherche détails
    </a>";

$output.="&nbsp;&nbsp;";

    $output.="<a class='btn btn-danger' role='button' data-toggle='collapse' href='#collapseSearchDetailsLike' aria-expanded='false' aria-controls='collapseSearchDetailsLike'>
        Recherche like
    </a>";

    $output.="&nbsp;&nbsp;";

    $output.="<a class='btn btn-warning' role='button' data-toggle='collapse' href='#collapseSearchSummary' aria-expanded='false' aria-controls='collapseSearchSummary'>
        Recherche résumé
    </a>";


    $output.="<div class='collapse' id='collapseSearchDetails'>";
    $output.="<div class='well'>";


    $output.="<form name='form_client'  class='form-horizontal' ";
    $output.="method='get' ";
    $output.= "action='".$_SERVER['PHP_SELF']."'";
    $output.=">";

    $output.=" <div class='row'>";
    $output.=" <div class='col-md-4'>";
    $output.=choisir_distinct_form("pseudo","programmed_courses","historical");
    $output.=" </div>";
    $output.=" <div class='col-md-4 '>";
    $output.=choisir_distinct_form("chauffeur","programmed_courses","historical");
    $output.=" </div>";
    $output.=" <div class='col-md-4 '>";
    $output.=choisir_distinct_form("course_date","programmed_courses","historical");
    $output.=" </div>";
    $output.=" <div class='col-md-4 '>";
    $output.=choisir_distinct_form("type_transport","programmed_courses","historical");
    $output.=" </div>";
    $output.=" <div class='col-md-4 '>";
    $output.=choisir_distinct_form("prix_course","programmed_courses","historical");
    $output.=" </div>";
    $output.=" </div>"; //row

    $output.=" <div class='row'>";
    $output.=" <div class='col-md-4'>";
    $output.=choisir_distinct_form("course_date","programmed_courses","historical",'monthname');
    $output.=" </div>"; // md-4
    $output.=" <div class='col-md-4'>";
    $output.=choisir_distinct_form("course_date","programmed_courses","historical",'year');
    $output.=" </div>";
    $output.=" <div class='col-md-4'>";
    $output.=choisir_distinct_form("course_date","programmed_courses","historical",'yearweek');
    $output.=" </div>";
    $output.=" <div class='col-md-4'>";
    $output.=choisir_distinct_form("course_date","programmed_courses","historical",'dayname');
    $output.=" </div>";
    $output.=" </div>"; // row


    $output.="<div class='col-sm-offset-3 col-sm-7 col-xs-3'>
                        <button type='submit' name='submit' value='historical_details' class='btn btn-primary'>Rechercher Details&nbsp;&nbsp;</button>
                    </div>";
    $output.="</form>";
    $output.="</div></div>"; // end collape

// like
    $output.="<div class='collapse' id='collapseSearchDetailsLike'>";
    $output.="<div class='well'>";

    $output.="<form name='form_client'  class='form-horizontal' ";
    $output.="method='get' ";
    $output.= "action='".$_SERVER['PHP_SELF']."'";
    $output.=">";
    $output.=" <div class='row'>";
    $output.=" <div class='col-md-4'>";
    $output.=choisr_form_like("pseudo","programmed_courses","historical");
    $output.=" </div>";
    $output.=" <div class='col-md-4'>";
    $output.=choisr_form_like("depart","programmed_courses","historical");
    $output.=" </div>";
    $output.=" <div class='col-md-4'>";
    $output.=choisr_form_like("arrivee","programmed_courses","historical");
    $output.=" </div>";

    $output.=" </div>";

    $output.="<div class='col-sm-offset-3 col-sm-7 col-xs-3'>
                        <button type='submit' name='submit' value='historical_details' class='btn btn-danger'>Rechercher like&nbsp;&nbsp;</button>
                    </div>";
    $output.="</form>";
    $output.="</div></div>"; // end collape
//like


    $output.="<div class='collapse' id='collapseSearchSummary'>";
    $output.="<div class='well'>";

    $output.="<form name='form_client'  class='form-horizontal' ";
    $output.="method='get' ";
    $output.= "action='".$_SERVER['PHP_SELF']."'";
    $output.=">";

   // $output.="<p class='text-center'><strong>Resumé</strong> </p>";

    $output.=" <div class='row'>";
    $output.=" <div class='col-md-3'>";
    $output.=choisir_distinct_form("year","summary_by_course_date_program");
    $output.=" </div>";
    $output.=" <div class='col-md-3'>";
    $output.=choisir_distinct_form("monthname","summary_by_course_date_program");
    $output.=" </div>";
    $output.=" <div class='col-md-3'>";
    $output.=choisir_distinct_form("week","summary_by_course_date_program");
    $output.=" </div>";
    $output.=" </div>"; // row

    $output.="<div class='col-sm-offset-3 col-sm-7 col-xs-3'>
                        <button type='submit' name='submit' value='historical_summary' class='btn btn-warning'>Rechercher resumé&nbsp;&nbsp;</button>
                    </div>";
    $output.="</form>";



    $output.="</div></div>"; // end collape

    $output.=" </div>"; // container fluid

    return $output;
}


function output_historical_program_details(){

    $output="";
    $program_set=find_all_programmed_courses();

    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";


    $output .="<tr>";
    // $output .= "<td class='text-center alert-danger'>Jour</td>"; //Heure
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Année</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Mois</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Semaine</th>";


    $output .= "<th class='text-center' style='vertical-align:middle;'>Validation</th>";

    if(!is_chauffeur()){
        $output .= "<th class='text-center' style='vertical-align:middle;'>Val Mgr</th>";
        $output .= "<th class='text-center' style='vertical-align:middle;'>Val Final</th>";

    }

    $output .= "<th class='text-center' style='vertical-align:middle;'>ID</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Date</th>";
  //  $output .= "<th class='text-center' style='vertical-align:middle;'>Client ID</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Pseudo</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Heure</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Chauffeur</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>départ</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Arrivée</th>";

if(!is_chauffeur()){
    $output .= "<th class='text-center' style='vertical-align:middle;'>Prix Course</th>";
}
    $output .= "<th class='text-center' style='vertical-align:middle;'>Pseudo Autres</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Nom Patient</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Bon_no</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Action</th>";


    $output .="</tr>";

    $prev_year="";
    $prev_mth="";
    $prev_wk="";

    while($program=mysqli_fetch_assoc($program_set)) {

        foreach ($program as $key=>$val){
            $$key=htmlentities(trim($val),ENT_COMPAT,'utf-8');

        }

        $today_date_sql = strftime("%Y-%m-%d" ,time());
        $tomorrow_date_sql=strftime("%Y-%m-%d" ,strtotime("tomorrow"));
        $yesterday_date_sql=strftime("%Y-%m-%d" ,strtotime("yesterday"));

//    var_dump($date["course_date"]);
//    var_dump($tomorrow_date_sql);
//    var_dump($yesterday_date_sql);

        if($today_date_sql==$program["course_date"]){
            $color="success";
        } elseif ($tomorrow_date_sql==$program["course_date"]) {
            $color="warning";
        } elseif ($yesterday_date_sql==$program["course_date"]) {
            $color="danger";

        } else {
            $color="";
        }


        $href=$_SERVER['PHP_SELF'];
       // $query_string=$_SERVER['QUERY_STRING'];
       // $query_string=str_replace("str_time","str_time_old",$query_string);



   //     var_dump($query_string);
        if (isset($course_date)) {
            $href.= "?str_time=". urlencode($course_date);
            $href.="&historical_course_date=". urlencode($course_date);
            $href.="&submit=". urlencode("historical_details");

        }

        $output .="<tr class='{$color}'>";

//        if (isset($year)) {
//            if($year==$prev_year){
//                $output.="<td></td>";
//            } else {
//                $output .="<td class='text-center' style='vertical-align: middle;'>";
//                $output .="";
//                $output .=$year;
//                $output .="</td>";
//                $prev_year=$year;
//            }
//
//        } else {$output.="<td></td>";}
//
//        if (isset($monthname)) {
//            if($monthname==$prev_mth){
//                $output.="<td></td>";
//            } else {
//                $output .= "<td class='text-center' style='vertical-align: middle;'>";
//                $output .= $monthname;
//                $output .= "</td>";
//                $prev_mth=$monthname;
//            }
//
//        }else {$output.="<td></td>";}
//
//        if (isset($week)) {
//            if($week==$prev_wk){
//                $output.="<td></td>";
//            } else {
//                $output .= "<td class='text-center' style='vertical-align: middle;'>";
//                $output .= "";
//                $output .= $week;
//                $output .= "</td>";
//            }
//            $prev_wk=$week;
//        }else {$output.="<td></td>";}

        if (isset($validated_chauffeur)) {
            if ($validated_chauffeur==0){ $validated_chauffeur_view="<span class='glyphicon glyphicon-question-sign' style='color:#0000ff' aria-hidden='true'></span>";
            } elseif ($validated_chauffeur==1) { $validated_chauffeur_view="<span class='glyphicon glyphicon-ok' style='color: green' aria-hidden='true'></span>";
            } elseif ($validated_chauffeur==2){ $validated_chauffeur_view="<span class='glyphicon glyphicon-remove' style='color: #ff0000' aria-hidden='true'></span>";
            } else { $validated_chauffeur_view="bug"; }


            $href_chauffeur=$href."&validation_chauffeur=". urlencode($validated_chauffeur);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_chauffeur}'>";
            $output .=$validated_chauffeur_view;
            $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}

        if(!is_chauffeur()) {
            if (isset($validated_mgr)) {
                if ($validated_mgr == 0) {
                    $validated_mgr_view = "<span class='glyphicon glyphicon-question-sign' style='color:#0000ff' aria-hidden='true'></span>";
                } elseif ($validated_mgr == 1) {
                    $validated_mgr_view = "<span class='glyphicon glyphicon-ok' style='color: green' aria-hidden='true'></span>";
                } else {
                    $validated_mgr_view = "bug";
                }


                $href_mgr = $href . "&validation_mgr=" . urlencode($validated_mgr);
                $output .= "<td class='text-center' style='vertical-align: middle;'>";
                $output .= "<a href='{$href_mgr}'>";
                $output .= $validated_mgr_view;
                $output .= "</a>";
                $output .= "</td>";
            } else {
                $output .= "<td></td>";
            }


            if (isset($validated_final)) {
                if ($validated_final == 0) {
                    $validated_final_view = "<span class='glyphicon glyphicon-question-sign' style='color:#0000ff' aria-hidden='true'></span>";
                } elseif ($validated_final == 1) {
                    $validated_final_view = "<span class='glyphicon glyphicon-ok' style='color: green' aria-hidden='true'></span>";
                } else {
                    $validated_final_view = "bug";
                }


                $href_final = $href . "&validation_final=" . urlencode($validated_final);
                $output .= "<td class='text-center' style='vertical-align: middle;'>";
                $output .= "<a href='{$href_final}'>";
                $output .= $validated_final_view;
                $output .= "</a>";
                $output .= "</td>";
            } else {
                $output .= "<td></td>";
            }

        }

        if (isset($id)) {
            $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_id}'>";
            $output .=$id;
            $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if (isset($course_date)) {
            list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($course_date);

            $output .="<td class='text-center' style='vertical-align: middle;'>";

            $output .= "<a href='{$href}'>";
            $output .=$date_fr_short;
            $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}



        if (isset($pseudo) && isset($id)) {
          //  $href_id=$href."&program_id=". urlencode($id);
            $href_pseudo=$_SERVER['PHP_SELF'];
            $href_pseudo.="?historical_pseudo=". urlencode($pseudo);
            $href_pseudo.="&submit=". urlencode("historical_details");

            $output .="<td class='text-center' style='vertical-align: middle;'>";
            $output .= "<a href='{$href_pseudo}'>";
            $output .=$pseudo;
            $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}




        if (isset($heure) ) {
          //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
      //      $output .= "<a href='{$href_id}'>";
            $output .=$heure;
       //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if (isset($chauffeur) ) {
            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$chauffeur;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if (isset($depart) ) {
            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$depart;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if (isset($arrivee) ) {
            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$arrivee;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}

        if (isset($prix_course) ) {
            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$prix_course;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if (isset($pseudo_autres) ) {
            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$pseudo_autres;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if (isset($nom_patient) && isset($error_pseudo)  ) {
            if($nom_patient){
                $nom_patient_view=$nom_patient;
            } else {
                if($error_pseudo=="Erreur:nom patient vide") {
                    $nom_patient_view=$error_pseudo;

                } else {
                    $nom_patient_view=$nom_patient;

                }

            }

            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$nom_patient_view;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}

        if (isset($bon_no) ) {
            //  $href_id=$href."&program_id=". urlencode($id);
            $output .="<td class='text-center' style='vertical-align: middle;'>";
            //      $output .= "<a href='{$href_id}'>";
            $output .=$bon_no;
            //     $output .="</a>";
            $output .="</td>";
        } else {$output.="<td></td>";}


        if(isset($id) && isset($course_date)) {


            $output .= "<td>";

            $url="&url=".urlencode($_SERVER['PHP_SELF']);
                $query_string="&str_time=".urlencode($course_date);
                $query_string.="&historical_course_date=".urlencode($course_date);
                $query_string.="&submit=".urlencode('historical_details');

            $p_edit ="<li><a href=' "."edit_course_program.php?program_id=".urlencode($id).$query_string.$url."'>Edit</a>";
            $p_del = "<li><a href=' "."delete_course_program.php?program_id=".urlencode($id).$query_string.$url."'>Delete</a>";
            $p_new = "<li><a href=' "."new_course_program.php?program_id=".urlencode($id).$query_string.$url."'>Add</a>";
            $p_annulation="<li><a href=' "."edit_annuler_course_program.php?program_id=".urlencode($id).$query_string.$url."'>Annuler</a>";
            $p_validation="<li><a href=' "."edit_validation_chauffeur_program.php?program_id=".urlencode($id).$query_string.$url."'>Valid chauffeur</a>";
            $p_validation_mgr="<li><a href=' "."edit_validation_mgr_program.php?program_id=".urlencode($id).$query_string.$url."'>Valid mgr</a>";
            $p_validation_final="<li><a href=' "."edit_validation_final_program.php?program_id=".urlencode($id).$query_string.$url."'>Valid final</a>";





            $output .= "     <div class='dropdown'>
  <button id='dLabel' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Action &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' aria-labelledby='dLabel'>
   {$p_edit}{$p_del}{$p_new}{$p_annulation} {$p_validation} {$p_validation_mgr} {$p_validation_final}
  </ul>
</div> ";


            $output .= "";


            $output .= "</td>";
        } else {$output.="<td></td>";}

        $output .="</tr>";







   } // end while
    $output .="</table>";
    $output .="</div>";
    mysqli_free_result($program_set);


    return $output;


}



?>


<div class="container-fluid">

    <div class="row">
<div class="col-md-9">
    <div class="row">
    <div class="col-md-2 col-md-offset-1">

        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseSummaryByDate" aria-expanded="false" aria-controls="collapseSummaryByDate">
           Resumé
        </a>
    </div>
        <div class="col-md-2 col-md-offset-2">
        <?php echo get_modal_recherche_program() ?>

</div>
</div>
    <div class="collapse" id="collapseSummaryByDate">
    <?php echo table_historical(); ?>
    </div>

<?php if(isset($_GET["submit"])) {echo output_historical_program_details();} ?>


</div>


<?php if (isset($_GET['str_time'])) { ?>
<div class="col-md-3  ">
    <?php  echo nav_menu_historical();?>
    <?php  echo nav_menu_pills_program() ;?>
    <?php  echo  get_output_panel_program($_GET['str_time']);?>
</div>
<?php } elseif(isset($_GET['program_id'])) {?>
        <div class="col-md-3  ">
    <?php  echo nav_menu_historical();?>
    <?php  echo nav_menu_pills_program() ;?>
    <?php $program=find_program_by_id($_GET['program_id']) ?>
    <?php if($program) {echo  get_output_panel_program($program["course_date"]);}?>
        </div>
<?php } ?>
    </div>


<div class="row">
<?php  // echo output_historical_program_details(); ?>
</div>

</div>






























<?php


//$today=strtotime("today");
//$today_day_name=strftime("%A" ,$today);
//$today_no=day_eng_no($today_day_name);
//$today_french_name=day_fr($today_no);
//$today_date_sql = strftime("%Y-%m-%d" ,$today);
//
//
//echo "today;". $today."<br>";
//echo "today_day_name;". $today_day_name."<br>";
//echo "today_no;".$today_no."<br>";
//echo "today_french_name;".$today_french_name."<br>";
//echo "today_date_sql;".$today_date_sql."<br>";



//$now=strtotime("now");
//$tomorrow =strtotime("tomorrow");
//$now_no=day_eng_no(strftime("%A" ,$now));
//$tomorrow_no=day_eng_no(strftime("%A" ,$tomorrow));
//echo "now;". $now." - ".strftime("%d-%m-%Y" ,$now)."<br>";
//echo "tomorrow;". $tomorrow."<br>";
//echo "now_no;".$now_no."<br>";
//echo "tomorrow_no;".$tomorrow_no."<br>";
//
//echo "<hr>";


//for($a=1;$a<=7;$a++){
//    $b=day_eng($a);
//
//    $today= strtotime("today");
//    $today= strftime("%d-%m-%Y" ,$today);
//    $last= strtotime("Last {$b}");
//    $last= strftime("%d-%m-%Y" ,$last);
//    $next= strtotime("Next {$b}");
//    $next= strftime("%d-%m-%Y" ,$next);
//
//    echo $a." - ";
//
//    echo $b." - ";
//    echo strtotime("today")." - today {$today} ";
//    echo strtotime("Last {$b}")." - last {$last}  ";
//    echo strtotime("Next {$b}")." - next {$next}  ";
//
//    echo "<br>";
//
//
//
//}

?>





<?php include("../includes/layouts/footer_2.php"); ?>
