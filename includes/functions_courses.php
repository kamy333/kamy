<?php

function choisir_mois(){

    global $connection;
    $output="";
    $output_form="";

    $query="SELECT DISTINCT ";
    $query.="month(course_date)as mth ";
    $query.="FROM courses ";
    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
    }

    $query.="ORDER BY mth ASC";



    $month_course_set = mysqli_query($connection, $query);
    confirm_query($month_course_set);

    while($subject = mysqli_fetch_assoc($month_course_set)) {

        $monthNum  = htmlentities($subject['mth'], ENT_COMPAT, 'utf-8');
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March

        $output.="<option value='{$monthNum}'>";
        $output.=$monthName;
        $output.="</option>";

    }




    mysqli_free_result($month_course_set);

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";

    $class="class='form-control'";

    $output_form="<label for='month'></label>";
    $output_form.="<select  {$class} name='month' id='month' >";
    $output_form.="<option value='' disabled selected>mois</option>";
    $output_form.=$output;
    $output_form.="</select>";

    return $output_form;
}


function choisir_chauffeur()
{


    global $connection;
    $output = "";
    $output_form = "";

    $query = "SELECT DISTINCT ";
    $query .= "chauffeur ";
    $query .= "FROM courses ";
    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
    }


    $query .= "ORDER BY chauffeur ASC ";



    $chauffeur_set = mysqli_query($connection, $query);
    confirm_query($chauffeur_set);

    while ($chauffeur = mysqli_fetch_assoc($chauffeur_set)) {
    $chauf= htmlentities($chauffeur['chauffeur'], ENT_COMPAT, 'utf-8');

        $output.="<option '{$chauf}'>";
        $output.=$chauf;
        $output.="</option>";

    }

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";

    $class="class='form-control'";


    mysqli_free_result($chauffeur_set);

    $output_form="<label for='chauffeur'></label>";
    $output_form.="<select  {$class} name='chauffeur' id='chauffeur' >";
    $output_form.="<option value='' disabled selected>Chauffeur</option>";
    $output_form.=$output;
    $output_form.="</select>";

    return $output_form;

}



function choisir_course_date(){


    global $connection;
    $output = "";
    $output_form = "";

    $query = "SELECT DISTINCT ";
    $query .= "course_date ";
    $query .= "FROM courses ";
    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
    }

    $query .= "ORDER BY course_date DESC ";



    $date_set = mysqli_query($connection, $query);
    confirm_query($date_set);

    while ($course_date = mysqli_fetch_assoc($date_set)) {
        $date= htmlentities($course_date['course_date']);

        $date_visu = date('d-m-Y', strtotime(str_replace('-', '/', $date)));

        $output.="<option value='{$date}'>";
        $output.=$date_visu;
        $output.="</option>";

    }

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";

    $class="class='form-control'";


    mysqli_free_result($date_set);

    $output_form="<label for='course_date'></label>";
    $output_form.="<select  {$class} name='course_date' id='course_date' >";
    $output_form.="<option value='' disabled selected>Date</option>";
    $output_form.=$output;
    $output_form.="</select>";

    return $output_form;

}




function choisir_pseudo(){


    global $connection;
    $output = "";
    $output_form = "";

    $query = "SELECT DISTINCT ";
    $query .= "pseudo ";
    $query .= "FROM courses ";

    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
    }

    $query .= "ORDER BY pseudo DESC ";



    $pseudo_set = mysqli_query($connection, $query);
    confirm_query($pseudo_set);

    while ($pseudo = mysqli_fetch_assoc($pseudo_set)) {
        $data= htmlentities($pseudo['pseudo'], ENT_COMPAT, 'utf-8');

        $output.="<option '{$data}'>";
        $output.=$data;
        $output.="</option>";
    }

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";

    $class="class='form-control'";


    mysqli_free_result($pseudo_set);

    $output_form="<label for='pseudo'></label>";
    $output_form.="<select  {$class} name='pseudo' id='pseudo' >";
    $output_form.="<option value='' disabled selected>Pseudo</option>";
    $output_form.=$output;
    $output_form.="</select>";

    return $output_form;

}


function choisir_validation(){


    global $connection;
    $output = "";
    $output_form = "";

    $query = "SELECT DISTINCT ";
    $query .= "validated ";
    $query .= "FROM courses ";

    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
    }

    $query .= "ORDER BY validated DESC";




    $validated_set = mysqli_query($connection, $query);
    confirm_query($validated_set);

    while ($validated = mysqli_fetch_assoc($validated_set)) {
        $data= htmlentities($validated['validated']);

        if($data==0){
            $data_visu="Non validé";
        } else {
            $data_visu="validé";

        }

        $output.="<option value= '{$data}'>";
        $output.=$data_visu;
        $output.="</option>";

    }

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";
    $class="class='form-control'";


    mysqli_free_result($validated_set);

    $output_form="<label for='validated'></label>";
    $output_form.="<select {$class} name='validated' id='validated' >";
    $output_form.="<option value='' disabled selected>valid ?</option>";
    $output_form.=$output;
    $output_form.="</select>";

    return $output_form;

}


function  find_courses_query($limit=false,$limit_no=10,$chauffeur,$pseudo,$validated,$course_date,$month){

    global $connection;
    global $errors;

    $safe_chauffeur= mysqli_real_escape_string($connection,$chauffeur);
    $safe_pseudo= mysqli_real_escape_string($connection,$pseudo);


    $safe_validated= mysqli_real_escape_string($connection,$validated);
    $safe_course_date= mysqli_real_escape_string($connection,$course_date);
    $safe_month= mysqli_real_escape_string($connection,$month);
    $safe_limit_no= mysqli_real_escape_string($connection,$limit_no);



    //$field="Champs";

    if ($chauffeur=="" && $pseudo=="" && $validated=="" && $course_date=="" && $month==""){

    //$errors[$field] = fieldname_as_text($field) . " vide choisir au moins une option ";

    }


    $query ="SELECT * FROM courses ";

    if(is_chauffeur()){
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
        $whereAnd=" AND ";
    } elseif ($safe_chauffeur) {
        $query.="WHERE chauffeur='{$safe_chauffeur}' ";
        $whereAnd=" AND ";
    } else {
        $whereAnd=" WHERE ";
    }


    if($safe_pseudo){
    $query.="{$whereAnd} pseudo='{$safe_pseudo}' ";
    $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
    $whereAnd=" AND ";
    } else{
    $whereAnd=" WHERE ";
    }


    if($safe_validated !==""){
        $safe_validated= (int) $safe_validated;
        $query.="{$whereAnd} validated={$safe_validated} ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if($safe_course_date){
        $query.=" {$whereAnd} course_date='{$safe_course_date}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd="WHERE ";
    }

    if($safe_month){
        $query.=" {$whereAnd} month(course_date)={$safe_month} ";
       // $whereAnd="AND ";
    } elseif($whereAnd==" AND "){
       // $whereAnd="AND ";
    } else{
       // $whereAnd="WHERE ";
    }


    $query .= " ORDER BY id DESC";
   // $query .= " LIMIT 2";


    if($limit) {
        $query .= " LIMIT {$safe_limit_no} ";
    }

    $courses_set = mysqli_query($connection, $query);
    confirm_query($courses_set);
    return $courses_set;


}


// start courses

function find_all_courses($limit=false,$limit_no=10){
    global $connection;

    $safe_limit_no= mysqli_real_escape_string($connection,$limit_no);

    $query  = "SELECT * ";
    $query .= "FROM courses ";



    if(is_chauffeur()) {
        $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
    }

    $query .= "ORDER BY id DESC";

    if($limit) {
        $query .= " LIMIT {$safe_limit_no} ";
    }

    $courses_set = mysqli_query($connection, $query);
    confirm_query($courses_set);
    return $courses_set;

}

/**
 * @param $limit
 */

function output_courses($simplequery=true,$limit=false,$limit_no=10,$chauffeur="",$pseudo="",$validated="",$course_date="",$month=""){
    // global $connection;

    if($simplequery) {
        $courses_set = find_all_courses($limit, $limit_no);
    } else {
        $courses_set =find_courses_query($limit,$limit_no,$chauffeur,$pseudo,$validated,$course_date,$month);
    }
    $output="";

//    $style5px="style=\"text-align: center; width: 5px;\"";
//    $style10px="style=\"text-align: center; width: 10px;\"";
//    $style30px="style=\"text-align: center; width: 30px;\"";
//    //  $style60px="style=\"text-align: center; width: 60px;\"";
//    $style70px="style=\"text-align: center; width: 70px;\"";
//    $style100px="style=\"text-align: center; width: 100px;\"";

    $style5px="";
    $style10px="";
    $style30px="";
    //  $style60px="style=\"text-align: center; width: 60px;\"";
    $style70px="";
    $style100px="";

//    $output= "<div class=\"CSSTableGenerator\">";

    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";
    $output .="<tr>";

    if(!is_chauffeur()) {
//        $output .= "<td colspan=\"3\" style=\"text-align: center;width: 5px\">Actions</td>";
        $output .= "<th class='text-center' colspan='3'>Actions</th>";

    } else {
//        $output .= "<td colspan=\"2\" style=\"text-align: center;width: 5px\">Actions</td>";
        $output .= "<th class='text-center' colspan='2'>Actions</th>";

    }

    //        $output .=" <td {$style5px}>year</td>";
    //        $output .="<td {$style5px} >month</td>";
    $output .="<th class='text-center' {$style5px} >id</th>";

    if(!is_chauffeur()){
    //    $output .="<td {$style5px}>valid</td>";
    }

    if(!is_chauffeur()) {
        $output .= "<th class='text-center' {$style30px}>Prix Course</th>";
    }
    //        $output .="<td {$style5px} >prog</td>";
    $output .="<th class='text-center' {$style70px}>Date Course</th>";
    //        $output .="<td {$style5px}>client id</td>";
    $output .="<th class='text-center' {$style30px} >Pseudo</th>";
    $output .="<th class='text-center' {$style70px}>Pseudo autres</th>";
    $output .="<th class='text-center' {$style10px}>Heure</th>";
    $output .="<th class='text-center' {$style30px}>Aller Retour</th>";
    $output .="<th class='text-center' {$style10px}>Hr Retour</th>";
    $output .="<th class='text-center' {$style100px}>Chauffeur".str_repeat("&nbsp", 0)."</th>";
    $output .="<th class='text-center' {$style100px}>Départ</th>";
    $output .="<th class='text-center' {$style100px}>Arrivée</th>";
    $output .="<th class='text-center' {$style70px}>Type</th>";



    $output .="<th class='text-center'{$style70px}>Nom patient</th>";

    if(!is_chauffeur()) {
        $output .= "<th class='text-center' {$style30px}>User</th>";
    }
    $output .="<th class='text-left hide-remarque' {$style100px}>Remarque</button></th>";


    $output .="</tr>";

    while($courses = mysqli_fetch_assoc($courses_set)) {

        if (is_chauffeur() && $courses["validated"]==1 ){

        }else {


          if($courses["validated"]==1 && $courses["prix_course"]==0){
        $output .="<tr class='danger hide-danger'>"; // see class for js filter
          } elseif ($courses["validated"]==1 && !$courses["prix_course"]==0) {
              $output .="<tr class='success hide-success'>";
          } elseif ($courses["prix_course"]==0 ){
              $output .="<tr class='hide-others'>";
          } else {
        $output .="<tr class='hide-others'>";
          }

//            $output .="<td style='width: 5px;'><a href=\"edit_course.php?id=";
            $output .="<td class='text-center'><a href=\"edit_course.php?id=";
            $output .= urlencode($courses["id"]);
//            $output .="\" onclick=\"return confirm('Do you want to edit la course?');";
            $output .= "\">";
//            $output .= "Edit";
            $output .= "<span class='glyphicon glyphicon-pencil'style='color:blue;' aria-hidden='true'></span>";
            $output .=" </a></td>";
//            $output .="<td style='width: 5px;'><a href=\"delete_course.php?id=";
            $output .="<td class='text-center'><a href=\"delete_course.php?id=";
            $output .= urlencode($courses["id"]);
            $output .="\" onclick=\"return confirm('Are you sure to delete?');";
            $output .= "\">";
//            $output .= "Delete";
            $output .= "<span class='glyphicon glyphicon-remove'style='color:red;' aria-hidden='true'></span>";
            $output .=" </a></td>";


        if(!is_chauffeur()) {

            if($courses["validated"]==0){



                $output .= "<td class='warning text-center'>";
                $output .= "<a href=\"validate_course.php?id=";
                $output .= urlencode($courses["id"]);
                $price_sql=$courses["prix_course"];

                     if ($courses["retour_booked"]==1){
                            if($price_sql==0){
                        $output .= "\" onclick=\"return confirm('Attention ! Le prix est 0 frs, etes-vou sure de valider?');";
                              } else{
                        $output .= "\" onclick=\"return confirm('valider la course?');";
                                }
                         $output .= "\">";
                         $output .= "validate";
                         $output .=" </a></td>";

                     } elseif($courses["aller_retour1"]==1 && $courses["retour_booked"]==0) {
                            if($price_sql==0){
                         $output .= "\" onclick=\"return confirm('Attention ! Le prix est 0 frs, etes-vou sure de valider avec retour?');";
                         } else{
                         $output .= "\" onclick=\"return confirm('Validation avec retour?');";
                            }
                         $output .= "\">";
                         $output .= "validé + R";
                         $output .=" </a></td>";



                     } else {
                         if($price_sql==0){
                             $output .= "\" onclick=\"return confirm('Attention ! Le prix est 0 frs, etes-vou sure de valider?');";
                         } else{
                             $output .= "\" onclick=\"return confirm('Are you sure to validate?');";
                         }

                         $output .= "\">";
                         $output .= "validate";
                         $output .=" </a></td>";

                     }

            } else {
//                $output .= "<td style='width: 5px;color: green;'><strong>Valid</strong></td>";
//                $output .= "<td class='success'>Valid</td>";
                $output .= "<td class='success text-center'><span class='glyphicon glyphicon-ok' style='color:green;' aria-hidden='true'></span></td>";






            }

        }



            //    $output .="<td>".htmlentities($courses["year"], ENT_COMPAT, 'utf-8')."</td>";
        //    $output .="<td>".htmlentities($courses["month"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td class='text-center'>".htmlentities($courses["id"])."</td>";

        if(!is_chauffeur()) {
         //   $output .= "<td>" . htmlentities($courses["validated"]) . "</td>";
        }
        //    $output .="<td>".htmlentities($courses["programed"], ENT_COMPAT, 'utf-8')."</td>";




            if(!is_chauffeur()) {
               $price_sql=$courses["prix_course"];
               $price= number_format($courses["prix_course"], 2, ',', "'");
                if($price_sql==0){
//                    $output .= "<td class='danger text-right'>" . htmlentities($price_sql) . "</td>";
                    $output .= "<td class='danger text-right'>";
                    $output .= "<a href=\"edit_course.php?id=";
                    $output .= urlencode($courses["id"]);
                    $output .= "\">";
                    $output .= htmlentities($price_sql);
                    $output .="</a></td>";

                    } else{
 //                   $output .= "<td class='text-right'>" . htmlentities($price) . "</td>";
                    $output .= "<td class='text-right'>";
                    $output .= "<a href=\"edit_course.php?id=";
                    $output .= urlencode($courses["id"]);
                    $output .= "\">";
                    $output .= htmlentities($price_sql);
                    $output .="</a></td>";

                }
            }

        $date1=htmlentities($courses["course_date"]);
        $date = date('d-m-Y', strtotime(str_replace('-', '/', $date1)));

        //$output .="<td>".htmlentities($courses["course_date"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td class='text-center'><small> $date </small></td>";

        //    $output .="<td>". htmlentities($courses["client_id"])."</td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["pseudo"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["pseudo_autres"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["heure"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["aller_retour"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["heure_retour"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["chauffeur"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-justify'><small>". htmlentities($courses["depart"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-justify'><small>". htmlentities($courses["arrivee"], ENT_COMPAT, 'utf-8')."</small></td>";
        $output .="<td class='text-center'><small>". htmlentities($courses["type_transport"], ENT_COMPAT, 'utf-8')."</small></td>";



        $output .="<td class='text-center'>". htmlentities($courses["nom_patient"], ENT_COMPAT, 'utf-8')."</small></td>";

        if(!is_chauffeur()) {
            $output .= "<td class='text-center'><small>" . htmlentities($courses["username"], ENT_COMPAT, 'utf-8') . "</small></td>";
        }

        $output .="<td class='text-nowrap hide-remarque text-center'><small>". htmlentities($courses["remarque"], ENT_COMPAT, 'utf-8')."</td>";


        $output .="</tr>";
        }
    }
    $output .="</table>";
    mysqli_free_result($courses_set);


    $output .="</div>";



    return $output;

}

function find_course_by_id($course_id) {
    global $connection;



    $safe_course_id = mysqli_real_escape_string($connection, $course_id);

    $query  = "SELECT * ";
    $query .= "FROM courses ";
    $query .= "WHERE id = {$safe_course_id} ";

    $restrict=is_chauffeur();

    if($restrict) {
        $query .= " AND chauffeur ='{$_SESSION['nom']}' ";
    }


    $query .= "LIMIT 1";
    $course_set = mysqli_query($connection, $query);
    confirm_query($course_set);
    if($course = mysqli_fetch_assoc($course_set)) {
        return $course;
    } else {
        return null;
    }
}



function choisir_num_courses($number_course=10){

    $output = "";

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";
    $class="class='form-control'";


    $output.= "<label for='nbcourses'></label>";
$output.= "<select {$class} name='nbcourses' id='nbcourses'>";
$output.= "<option value='{$number_course}' selected {$number_course}></option>";
$output.="<option value='100000'>Tous(1000)</option>";
$output.="<option value='2'>2</option>";
$output.="<option value='5'>5</option>";
$output.="<option value='10'>10</option>";
$output.="<option value='20'>30</option>";
$output.="<option value='50'>50</option>";
$output.="</select>";

return $output;

}


/**
 *
 */
function dataliste_address($pseudo=null){

    //todo create datalist for client addresse
    global $connection;

    $safe_pseudo=mysql_prep($pseudo);

$query="SELECT DISTINCT ";
//$query.=" pseudo, ";

    if($pseudo){
        $query.= " pseudo, ";
    }
    $query.=" trim(depart) as address ";

    $query.="FROM programmed_courses ";
    if($pseudo){
    $query.="WHERE pseudo='{$safe_pseudo}' ";
    }

$query.="UNION ";

    $query="SELECT DISTINCT ";
//$query.=" pseudo, ";

    if($pseudo){
        $query.= " pseudo, ";
    }
    $query.=" trim(arrivee) as address ";

  //  $query.="SELECT DISTINCT pseudo , trim(arrivee) as address ";
    $query.="FROM programmed_courses ";
    if($pseudo){
        $query.="WHERE pseudo='{$safe_pseudo}' ";
    }


    $output="<datalist id=\"liste_address\">";

$address_set = mysqli_query($connection, $query);
    confirm_query($address_set);



    while($address= mysqli_fetch_assoc($address_set)) {

        $output.="<option value='";
        $output.= htmlentities($address['address'], ENT_COMPAT, 'utf-8');
        $output.="'>".htmlentities($address['address'], ENT_COMPAT, 'utf-8')."</option>";
    }

    $output.="</datalist>";

    return $output;

}




?>