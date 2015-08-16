<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/25/2014
 * Time: 12:57 AM
 */

function find_all_modele_view () {

     global $connection;
    $query  = "SELECT * ";
    $query .= "FROM modele ";
  //  $query .= "ORDER BY username ASC";
    $modele_set = mysqli_query($connection, $query);
    confirm_query($modele_set);
    return $modele_set;

}


function find_all_modele_pivot ($visible=1) {

    global $connection;
    $query  = "SELECT * ";

    if($visible==1){
        $query .= "FROM modele_pivot_visible_yes ";
    } else {

    $query .= "FROM modele_pivot_visible_no";

    }

    //  $query .= "ORDER BY username ASC";
    $modele_set = mysqli_query($connection, $query);
    confirm_query($modele_set);
    return $modele_set;

}




/**
 * @param $id
 * @return bool|mysqli_result
 */
function find_modele_by_id ($id) {
    global $connection;
    $safe_modele_id=mysql_prep($id);


    $query  = "SELECT * ";
    $query .= "FROM programmed_courses_modele ";
    $query .= "WHERE id = {$safe_modele_id} ";
    $query .= "LIMIT 1";
    $modele_set = mysqli_query($connection, $query);
    confirm_query($modele_set);
    if($modele = mysqli_fetch_assoc($modele_set)) {
        return $modele;
    } else {
        return null;
    }


}


function count_modele_by_day($day_no,$visible=1){
    global $connection;
    $safe_day_no=mysql_prep($day_no);
    $safe_visu=mysql_prep($visible);
    $query = "SELECT COUNT(*) AS c FROM programmed_courses_modele WHERE week_day_rank ={$safe_day_no} AND visible=  {$safe_visu} ";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row['c']; //
}




function output_all_modele(){

    $modele_set=find_all_modele_view();

    $page_name="modele_export.php"; // page which import the day

    $style5px="style=\"text-align: center; width: 5px;\"";
    $style10px="style=\"text-align: center; width: 10px;\"";
    $style30px="style=\"text-align: center; width: 30px;\"";
    //  $style60px="style=\"text-align: center; width: 60px;\"";
    $style70px="style=\"text-align: center; width: 70px;\"";
    $style100px="style=\"text-align: center; width: 100px;\"";
    $style160px="style=\"text-align: center; width: 160px;\"";


    //$output= "<div class=\"CSSTableGeneratorGray\">";
    //$output= "<div class=\"CSSTableGeneratorGreen\">";
    //$output= "<div class=\"CSSTableGeneratorPink\">";
    //blue
    //$output= "<div class=\"CSSTableGeneratorPink\">";


    $output= "<div class=\"CSSTableGeneratorYellow\">";


    $output .= "<table>";
    $output .="<tr>";
 //   $output .= "<td colspan=\"2\" style=\"text-align: center;width: 5px\">Actions</td>";
//    $output .= "<td {$style30px}>heure</td>";
//    $output .= "<td {$style10px}>Lundi</td>";
//    $output .= "<td {$style30px}>Mardi</td>";
//    $output .= "<td {$style30px}>Mercredi</td>";
//    $output .= "<td {$style70px}>Jeudi</td>";
//    $output .= "<td {$style30px}>Vendredi</td>";
//    $output .= "<td {$style160px}>Samedi</td>";
//    $output .= "<td {$style30px}>Dimanche</td>";


      $output .= "<td {$style30px}>heure</td>";

    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(1);
    $output .="\" onclick=\"return confirm('Importer Lundi?');";
    $output .="\">Lundi</a></td>";

    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(2);
    $output .="\" onclick=\"return confirm('Importer Mardi?');";
    $output .="\">Mardi</a></td>";

    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(3);
    $output .="\" onclick=\"return confirm('Importer Mercredi?');";
    $output .="\">Mercredi</a></td>";

    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(4);
    $output .="\" onclick=\"return confirm('Importer Jeudi?');";
    $output .="\">Jeudi</a></td>";

    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(5);
    $output .="\" onclick=\"return confirm('Importer Vendredi?');";
    $output .="\">Vendredi</a></td>";

    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(6);
    $output .="\" onclick=\"return confirm('Importer Samedi?');";
    $output .="\">Samedi</a></td>";


    $output .="<td {$style30px}><a href=\"{$page_name}?jour=";
    $output .= urlencode(7);
    $output .="\" onclick=\"return confirm('Importer dimanche?');";
    $output .="\">Dimanche</a></td>";


    $output .="</tr>";

//    $output .= "<td {$style160px}>Samedi</td>";

    $jour="";

    // TODO be able to include in table multiple client for same hour or same week
    while($modele = mysqli_fetch_assoc($modele_set)) {

        $output .="<tr>";
        $first_heure=$modele["heure"];

        if ($first_heure==$jour){
            $output .="<td></td>";
        }else {
            $output .="<td>". htmlentities($modele["heure"])."</td>";
        }

        $jour=$modele["jour"];

        if($jour==1){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        if($jour==2){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        if($jour==3){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        if($jour==4){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        if($jour==5){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        if($jour==6){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        if($jour==7){
            $output .="<td>". htmlentities($modele["pseudo"])."</td>";
        }else {
            $output .="<td></td>";
        }

        $output .="</tr>";

    }

    $output .="</table>";
    mysqli_free_result($modele_set);
    $output .="</div>";

    return $output;

    }


function mth_fr_name($month_name){
    switch($month_name){
        case "January":       return "janvier" ;    break;
        case "February":      return "février" ;    break;
        case "March":         return "mars" ;       break;
        case "April":         return "avril" ;      break;
        case "May":           return "mai";         break;
        case "June":          return "juin";        break;
        case "July":          return "juillet";     break;
        case "August":        return "aout";        break;
        case "September":     return "septembre";   break;
        case "October":       return "octobre";     break;
        case "November":      return "novembre";    break;
        case "December":      return "décembre";    break;

        default:
            return "ATTENTION ";
            break;
    }
}



function mth_fr_no($month_no){
    switch($month_no){
        case "01":       return "janvier" ;    break;
        case "02":       return "février" ;    break;
        case "03":       return "mars" ;       break;
        case "04":       return "avril" ;      break;
        case "05":       return "mai";         break;
        case "06":       return "juin";        break;
        case "07":       return "juillet";     break;
        case "08":       return "août";        break;
        case "09":       return "septembre";   break;
        case "10":       return "octobre";     break;
        case "11":       return "novembre";    break;
        case "12":       return "décembre";    break;

        default:
            return "ATTENTION ";
            break;
    }
}






function day_eng( $numb=0){

    switch($numb){
        case 1:            return "Monday";            break;
        case 2:            return "Tuesday";           break;
        case 3:            return "Wednesday";         break;
        case 4:            return "Thursday";          break;
        case 5:            return "Friday";            break;
        case 6:            return "Saturday";          break;
        case 7:            return "Sunday";            break;
        default:
            return "ATTENTION Day english name CHIFFRE DOIT ETRE ENTRE 1-7";
            break;


    }

}






function day_fr( $numb=0){

    switch($numb){
        case 1:    return "Lundi";         break;
        case 2:    return "Mardi";         break;
        case 3:    return "Mercredi";      break;
        case 4:    return "Jeudi";         break;
        case 5:    return "Vendredi";      break;
        case 6:    return "Samedi";        break;
        case 7:    return "Dimanche";      break;
        default:
            return "ATTENTION CHIFFRE DOIT ETRE ENTRE 1-7";
            break;


    }

}
function day_eng_no($jour){
    switch($jour){
        case "Monday":       return 1 ;   break;
        case "Tuesday":      return 2 ;   break;
        case "Wednesday":    return 3 ;   break;
        case "Thursday":     return 4 ;   break;
        case "Friday":       return 5;    break;
        case "Saturday":     return 6;    break;
        case "Sunday":       return 7;    break;
        default:
            return "ATTENTION day french CHIFFRE DOIT ETRE ENTRE 1-7";
            break;
    }


}

function day_no($jour){
    switch($jour){
        case "Lundi":            return 1;       break;
        case "Mardi":            return 2 ;      break;
        case "Mercredi":         return 3;       break;
        case "Jeudi":            return 4;       break;
        case "Vendredi":         return 5;       break;
        case "Samedi":           return 6;       break;
        case "Dimanche":         return 7;       break;
        default:
            return "ATTENTION CHIFFRE DOIT ETRE ENTRE 1-7";
            break;
    }


}

function get_modal_body ($modele_id,$date_sql=null){
    $modele = find_modele_by_id ($modele_id);
     $client= find_client_by_id($modele["client_id"]);

    $style_width_button="style='width: 11em;'";
    $p_export="modele_export.php";


    $url="&url=".urlencode($_SERVER['PHP_SELF']);
    if(isset($_GET["week_day"])) {
        $url .= "&week_day=" . urlencode($_GET["week_day"]);
    }
    if(isset($_GET["date_next_last"])){
        $url.="&date_next_last=".urlencode($_GET["date_next_last"]);
    }
    if(isset($_GET["modele_visible"])){
        $url.="&modele_visible=".urlencode($_GET["modele_visible"]);
    }

    $export_button="";
    if ($date_sql){
        list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($date_sql);
            //    $date_fr=date_in_french_short($date_sql);
        $export_button .= "<p class='btn'><a class='btn btn-success' {$style_width_button} href='{$p_export}?modele_id=".urlencode($modele_id)."&modele_date=".urlencode($date_sql).$url. "'>Exp {$date_fr} </a></p>";

    }

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
    // $modal_body="<dl>";
    // $modal_body .="{$grid}<dt><strong>Pseudo</strong></dt><dd>". htmlentities($client['pseudo'], ENT_COMPAT, 'utf-8')."</dd>{$grid1}";
    // $modal_body .="{$grid}<dt><strong>Nom</strong></dt><dd>".htmlentities($client['web_view'], ENT_COMPAT, 'utf-8') ."</dd>{$grid1}";


    $modal_text="<dl class='dl-horizontal dd-color-blue'>";





    foreach ($modele as $key =>$val){
        $key_clean= ucfirst(str_replace("_", "  ", $key));
        if($key=="week_day_rank") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>Jour:"."</strong></dt>";
            $modal_body .= "";
            $modal_body .= "<dd>" . htmlentities(day_fr($val), ENT_COMPAT, 'utf-8'). "</dd>";
            $modal_body .= "{$grid_2_DIV}";
        } elseif($key=="heure") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";
        } elseif($key=="client_habituel") {
            if ($val==0){$val_yes_no="Non";}else {$val_yes_no="Oui";}
            $modal_text .= "{$grid_head}";
            $modal_text .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_text .= "<dd> " . htmlentities($val_yes_no , ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_text .= "{$grid_2_DIV}";



        } elseif($key=="visible") {
            if ($val==0){$val_yes_no="Non";}else {$val_yes_no="Oui";}
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";

          //  $modal_body .= "";
            $link="<strong><span><a style='color: palevioletred' href='edit_visible_modele_course.php?modele_id=". urlencode($modele["id"])."'>".htmlentities($val_yes_no , ENT_COMPAT, 'utf-8')."</a> </span>";


            $modal_body .= "<dd> " . $link  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        } elseif($key=="client_id") {
        } elseif($key=="inverse_addresse") {
        } elseif($key=="input_date") {
        } elseif($key=="username") {
        } elseif($key=="prix_course") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . " frs</dd>";
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
    $div_id="mycollapeid{$modele_id}";

   $modal_body.="<div class='col-xm-2 col-md-offset-2'>";
    $modal_body .= " <button class='btn btn-info' type='button' data-toggle='collapse' data-target='#{$div_id}' {$style_width_button} aria-expanded='false' aria-controls='collapseExample'>+ info</button>";

    $modal_body .= $export_button;

    $modal_body .= "<div class='collapse' id='{$div_id}'>";
    $modal_body .= "                <div class='well'>";
    $modal_body .= $modal_text;
    $modal_body .= "</div></div>";

    $modal_body .= "</div>";

    return $modal_body;

}


function get_modal_modele($modele_id,$date_sql=null){

    // modal

    $modele = find_modele_by_id ($modele_id);
    $client= find_client_by_id($modele["client_id"]);


    $div_id="myModalmodele{$modele_id}";

    $output = "";

    //   $output .= "";

    $output="";
    $output.= "<a href='#' data-toggle='modal' data-target='#{$div_id}'>";
    $output.= htmlentities($client['web_view'],ENT_COMPAT, 'utf-8');
//    $output.="<span class=\"glyphicon glyphicon-info-sign\" style='color: green;' aria-hidden='true'></span>";
    $output.= "</a>";


// below is modal mode not shown (hidden)
    $output .= "<div class='modal fade' id='{$div_id}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    $output .= "    <div class='modal-dialog'>";
    $output .= "        <div class='modal-content'>";
    $output .= "            <div class='modal-header'>";
    $output .= "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $output .= "                <h5 class='modal-title' id='myModalLabel'>Modele ".htmlentities( day_fr( $modele['week_day_rank']), ENT_COMPAT, 'utf-8'). " - Pseudo :<strong>". htmlentities($client['pseudo'], ENT_COMPAT, 'utf-8')."</strong> Nom :". htmlentities($client['web_view'], ENT_COMPAT, 'utf-8')."</strong></h5>";
    $output .= "            </div>";
    $output .= "            <div class='modal-body'>";

    //function of body of modal
    $p_edit="edit_course_modele.php";
    $p_del="delete_course_modele.php";
    $p_new="new_course_modele.php";
    $p_export="modele_export.php";

    $url="&url=".urlencode($_SERVER['PHP_SELF']);
    if(isset($_GET["week_day"])) {
        $url .= "&week_day=" . urlencode($_GET["week_day"]);
    }
    if(isset($_GET["date_next_last"])){
     $url.="&date_next_last=".urlencode($_GET["date_next_last"]);
    }
    if(isset($_GET["modele_visible"])){
        $url.="&modele_visible=".urlencode($_GET["modele_visible"]);
    }

    $style_width_button="style='width: 7em;'";


    $output .= "<div class='container-fluid text-left'> ";

    $output .= get_modal_body($modele_id,$date_sql);;

 //   $output .= "                <button type='button' class='btn btn-default' data-dismiss='modal'>&nbsp;Close&nbsp;</button>";


  //  $output .= "<div class='col-xm-2 col-md-offset-2'>";
  //  if ($date_sql){
    //    $output .= "<p class='btn'><a class='btn btn-success' {$style_width_button} href='{$p_export}?modele_id=".urlencode($modele_id)."&modele_date=".urlencode($date_sql).$url. "'>&nbsp;Export to prog&nbsp;&nbsp;</a></p>";
 //   }
 //   $output .= "</div>";
    $output .= "</div>";



    $output .= "            </div>";
    $output .= "            <div class='modal-footer'>";
    $output .= "                <div class='btn-group btn-group-justified' role='group' aria-label='...'>";

    $style_width_button="style='width: 4em;'";

    $output .= "                <p class='btn'><a  class='btn btn-primary  btn-xm' {$style_width_button} href='{$p_edit}?modele_id=".urlencode($modele_id).$url."'>Edit</a></p>";
    $output .= "                <p class='btn'><a class='btn btn-danger  btn-xm' {$style_width_button} href='{$p_del}?modele_id=".urlencode($modele_id).$url
."'>Delete</a></p>";
    $output .= "                <p class='btn'><a class='btn btn-success  btn-xm' {$style_width_button} href='{$p_new}?modele_id=".urlencode($modele_id).$url."'>add</a></p>";
    $output .= "                <p class='btn' data-dismiss='modal'><a  class=' btn btn-info btn-xm'{$style_width_button}>close</a> </p>";

    $output .= "                </div>";

    $output .= "            </div>";
    $output .= "        </div>";
    $output .= "    </div>";
    $output .= "</div>";


    return $output;
}







function tooltips_modele($modele_id,$text_input=""){
    $modele = find_modele_by_id ($modele_id);




    $tooltip_text="";
    foreach ($modele as $key =>$val){
        $key_clean= ucfirst(str_replace("_", "  ", $key));
        if($key=="week_day_rank") {
            $tooltip_text .= "Jour" . ": " . htmlentities(day_fr($val), ENT_COMPAT, 'utf-8') . "<br>";
        } elseif($key=="client_habituel") {
            if ($val==0){$val_yes_no="Non";}else {$val_yes_no="Oui";}
            $tooltip_text .= htmlentities($key_clean, ENT_COMPAT, 'utf-8')  . ": " . htmlentities($val_yes_no, ENT_COMPAT, 'utf-8')  . "<br>";
        } elseif($key=="client_id") {
        } elseif($key=="inverse_addresse") {
        } elseif($key=="input_date") {
        } elseif($key=="prix_course") {
            $tooltip_text .= htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ": " . htmlentities($val, ENT_COMPAT, 'utf-8')  . " frs<br>";


        } else {
            $tooltip_text .= htmlentities( $key_clean, ENT_COMPAT, 'utf-8') . ": " .htmlentities($val, ENT_COMPAT, 'utf-8')  . "<br>";

        }

    }


    $output="";
    $output.="<a class=''  href='#' data-toggle='tooltip' data-html='true' data-placement='top' title='";
    $output.=$tooltip_text;
    $output.="'>";
    $output.=$text_input;
    $output.="<span class=\"glyphicon glyphicon-info-sign\" style='color: #000000;' aria-hidden='true'></span>";
    $output.="</a>";

    return $output;
}




function output_all_modele_pivot($visible=1){

    $modele_set=find_all_modele_pivot($visible);

    $page_name="modele_export.php"; // page which import the day

    $output="";


    $stylegreen="style=\" color: #2b9741;font-weight: bold;font-size: 120%;text-decoration: blink;\"";


    $now=strtotime("now");
    $tomorrow =strtotime("tomorrow");
    $now_no=day_eng_no(strftime("%A" ,$now));
    $tomorrow_no=day_eng_no(strftime("%A" ,$tomorrow));

//
//    $output= "<div class=\"CSSTableGeneratorYellow\">";
//    $output .= "<table>";

    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";


    $output .="<tr>";
   // $output .= "<td class='text-center alert-danger'>Jour</td>"; //Heure
    $output .= "<th class='text-center' style='vertical-align:middle;'>&nbsp;Heure&nbsp;</th>";


    for($a=1;$a<=7;$a++){
        $day=day_fr($a); // func return Lundi, Mardi...


        $today=strtotime("today");
        $today_day_name=strftime("%A" ,$today);
        $today_no=day_eng_no($today_day_name);

        $tomorrow=strtotime("tomorrow");
        $tomorrow_day_name=strftime("%A" ,$tomorrow);
        $tomorrow_no=day_eng_no($tomorrow_day_name);

        $b=day_eng($a);

        if($today_no>$a){
            $last_today_next="Last {$b}";
        }elseif($today_no==$a){
            $last_today_next="today";
        }else{
            $last_today_next="Next {$b}";
        }

        $day_date=strtotime($last_today_next);

       // strftime("%d-%m-%Y" ,$day);

        $date="";
        $date_sql="";

         if ($today_no==$a){
             $date .= strftime("%d-%m-%Y" ,$day_date);
             $date_sql =strftime("%Y-%m-%d" ,$day_date);
         } elseif ($tomorrow_no==$a) {
             $date .= strftime("%d-%m-%Y" ,$day_date);
             $date_sql =strftime("%Y-%m-%d" ,$day_date);

         } else {
             $date .=strftime("%d-%m-%Y", $day_date);
             $date_sql =strftime("%Y-%m-%d" ,$day_date);

         }




        $output .="<td class='text-center alert-danger' style='color: white'><strong>";
        $output.="<a href=\"{$page_name}?jour=";
        $output .= urlencode($a);
        $output.="&";
        $output.="modele_date=";
        $output.=urldecode($date_sql);
        $output .="\" onclick=\"return confirm('Importer {$day}?');";
        $output .="\">";
        $output .=$day." <br> ".$date;
        $output.="&nbsp;";
        $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
        $output .="</a>";
        $output.="</strong></td>";
    }
    $output .="</tr>";


    $output .="<tr>";
    $output .= "<td></td>";

    for($a=1;$a<=7;$a++){
        $day=day_fr($a); // func return Lundi, Mardi...

        if ($a==$now_no){
            $txt="".htmlentities("Aujourd'hui", ENT_COMPAT, 'utf-8');
        }elseif(($a==$tomorrow_no)){
            $txt="".htmlentities("Demain", ENT_COMPAT, 'utf-8');
        }else{
            $txt="";
        }

        if ($a==$now_no) {

            $output .= "<td class='success text-center show-today' {$stylegreen}>";
            $output .= $txt;
            $output .= "</td>";
        } elseif(($a==$tomorrow_no)) {

            $output .= "<td class='warning text-center show-tomorrow' {$stylegreen}>";
            $output .= $txt;
            $output .= "</td>";
        } else {

            $output .= "<td class='text-center show-others' {$stylegreen}>";
            $output .= $txt;
            $output .= "</td>";
        }



    }
    $output .="</tr>";

 //   $output .="<tr>";
 //   $output .= "<th class='text-center'>Heure</th>";

    for($a=1;$a<=7;$a++){

        $today=strtotime("today");
        $today_day_name=strftime("%A" ,$today);
        $today_no=day_eng_no($today_day_name);

        $tomorrow=strtotime("tomorrow");
        $tomorrow_day_name=strftime("%A" ,$tomorrow);
        $tomorrow_no=day_eng_no($tomorrow_day_name);

        $b=day_eng($a);

        if($today_no>$a){
            $last_today_next="Last {$b}";
           }elseif($today_no==$a){
            $last_today_next="today";
        }else{
            $last_today_next="Next {$b}";
        }

      $day=strtotime($last_today_next);



       // $day=strtotime("Last Monday");
        if ($today_no==$a){
     //   $output .= "<th class=' text-center show-today'><strong>".strftime("%d-%m-%Y" ,$day)."</strong></th>";

        } elseif ($tomorrow_no==$a) {
    //        $output .= "<th class='text-center show-tomorrow'><strong>".strftime("%d-%m-%Y" ,$day)."</strong></th>";

        } else {
    //        $output .= "<th class='text-center show-others'><strong>" . strftime("%d-%m-%Y", $day) . "</strong></th>";
        }

        }

  //  $output .="</tr>";

//    $output .= "<td {$style160px}>Samedi</td>";

    $old_heure="";

    // TODO be able to include in table multiple client for same hour or same week

    while($modele = mysqli_fetch_assoc($modele_set)) {



        $output .= "<tr>";

       $new_heure=$modele['heure'];

        if($new_heure!==$old_heure){
            $output .="<th class='text-center' style='vertical-align:middle;'><strong>". htmlentities(   visu_heure($modele["heure"]), ENT_COMPAT, 'utf-8')."</strong></th>";
                  }else{
            $output .= "<th></th>";
                   }
        $old_heure=$modele["heure"];


        $p_edit="edit_course_modele.php";
        $p_del="delete_course_modele.php";
        $p_new="new_course_modele.php";

        $web_view=htmlentities($modele["web_view"], ENT_COMPAT, 'utf-8');
        $pseudo=htmlentities($modele["pseudo"], ENT_COMPAT, 'utf-8');
        $heure=$modele['heure'];
        $client_id=$modele['client_id'];

        if($web_view){
            $client_name=$web_view;
        }else{
            $client_name=$pseudo;

        }




         // $output .="<td>". htmlentities($modele["heure"])."</td>";
        $today=strtotime("today");
        $today_day_name=strftime("%A" ,$today);
        $today_no=day_eng_no($today_day_name);
        $today_french_name=day_fr($today_no);

        $tomorrow=strtotime("tomorrow");
        $tomorrow_day_name=strftime("%A" ,$tomorrow);
        $tomorrow_no=day_eng_no($tomorrow_day_name);
        $tomorrow_french_name=day_fr($tomorrow_no);


        for($a=1;$a<=7;$a++){
            $day=day_fr($a); // func return Lundi, Mardi...
            $modele_id=$modele[$day]; // return value of array

            //------------------------------------------------------
            $today=strtotime("today");
            $today_day_name=strftime("%A" ,$today);
            $today_no=day_eng_no($today_day_name);

            $tomorrow=strtotime("tomorrow");
            $tomorrow_day_name=strftime("%A" ,$tomorrow);
            $tomorrow_no=day_eng_no($tomorrow_day_name);

            $b=day_eng($a);

            if($today_no>$a){
                $last_today_next="Last {$b}";
            }elseif($today_no==$a){
                $last_today_next="today";
            }else{
                $last_today_next="Next {$b}";
            }

            $day_date=strtotime($last_today_next);

            // strftime("%d-%m-%Y" ,$day);

            $date="";
            $date_sql="";

            if ($today_no==$a){
                $date .= strftime("%d-%m-%Y" ,$day_date);
                $date_sql =strftime("%Y-%m-%d" ,$day_date);
            } elseif ($tomorrow_no==$a) {
                $date .= strftime("%d-%m-%Y" ,$day_date);
                $date_sql =strftime("%Y-%m-%d" ,$day_date);

            } else {
                $date .=strftime("%d-%m-%Y", $day_date);
                $date_sql =strftime("%Y-%m-%d" ,$day_date);

            }

            // -------------------------------------------------------------

            if ($modele[$day]) {

              //  $old_heure=$modele['heure'];
              //  "<img src="/images_web/check.png" alt="Mountain View" style="width:304px;height:228px">";
                //   $output .="<td>". htmlentities($modele["heure"])."</td>";




                if ($day==$today_french_name){
                $output .= "<td class='success text-left show-today'>";

                } elseif($day==$tomorrow_french_name){
                    $output .= "<td class='text-left show-tomorrow'>";
                } else {
                 $output .= "<td class='text-left show-others'>";
                }


             //  $output .= htmlentities($client_name, ENT_COMPAT, 'utf-8') ;
              //  $output .= "                <p class='btn'><a class='btn btn-primary  btn-xm' href='{$p_edit}?modele_id=".urlencode($modele_id)."'>&nbsp;Edit&nbsp;</a></p>";

            //    $output .= "  &nbsp";

                $output .= "<p class='btn'>";
                if($visible==1){
                $output .= "<a class='btn btn-primary  btn-xm ' style='width:14em;' ";
                } else {
                $output .= "<a class='btn btn-info btn-block btn-xm '  style='width:14em;' ";

                }
                $output.=get_modal_modele($modele_id,$date_sql);
                $output .= "</a>";
                $output .= "</p>";
             //   $output .= "  &nbsp";
              //  $output.= tooltips_modele($modele_id);


                //------------------- start before modal--------------------------------
//                $output .= "<br>";
//
//                $output .= "<a href=\"{$p_edit}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id) . "&jour_id=" . urlencode($a);
//                $output .= " \" onclick=\"return confirm('Editer modele {$pseudo} ?');";
//                $output .= " \">";
//                $output .= "<span class='glyphicon glyphicon-pencil'style='color:blue;' aria-hidden='true'></span>";
//                $output .= "</a>";
//                $output .= "  &nbsp &nbsp";
//
//                $output .= "<a href=\"{$p_new}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Nouveau modele {$pseudo} ?');";
//                $output .= " \">";
//                $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
//                $output .= "</a>";
//                $output .= "  &nbsp &nbsp";
//
//                $output .= "<a href=\"{$p_del}?modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Delete modele {$pseudo} {$day} à {$heure}?');";
//                $output .= " \">";
//                $output .= "<span class='glyphicon glyphicon-remove'style='color:red;' aria-hidden='true'></span>";
//                $output .= "</a>";

                // -------------------------end before modale------------------------------

                $output .= "</td>";

            } else {

                if ($day==$today_french_name){
                    $output .= "<td class='success'></td>";

                } else {
                    $output .= "<td></td>";
                }


            }

        }


        $output .="</tr>";

    }

    $output .="</table>";
    mysqli_free_result($modele_set);
    $output .="</div>";

    return $output;

}




function output_all_modele_pivot_today($visible=1){

    $modele_set=find_all_modele_pivot($visible);

    $page_name="modele_export.php"; // page which import the day

    $output="";


    $now = strtotime("now");
    $now_no = day_eng_no(strftime("%A" ,$now));
    $now_date_formatted = strftime("%d-%m-%Y" ,$now);
    $today_day_name_french = day_fr($now_no);
    $now_date_sql = strftime("%Y-%m-%d" ,$now);

//    $tomorrow = strtotime("tomorrow");
//    $tomorrow_no= day_eng_no(strftime("%A" ,$tomorrow));
//    $tomorrow_date_formatted = strftime("%d-%m-%Y" ,$tomorrow);
//    $tomorrow_day_name_french = day_fr($tomorrow_no);
//
//
//    echo "now - <strong>".$now."</strong><br>";
//    echo "now_no - <strong>".$now_no."</strong><br>";
//    echo "now_date_formatted - <strong>".$now_date_formatted."</strong><br>";
//    echo "today_day_name_french - <strong>".$today_day_name_french."</strong><br>";
//
//    echo "<hr>";
//
//    echo "tomorrow - <strong>".$tomorrow."</strong><br>";
//    echo "tomorrow_no - <strong>".$tomorrow_no."</strong><br>";
//    echo "tomorrow_date_formatted - <strong>".$tomorrow_date_formatted."</strong><br>";
//    echo "tomorrow_day_name_french - <strong>".$tomorrow_day_name_french."</strong><br>";




    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";


    $output .="<tr>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Heure</th>";

    for($a=1;$a<=7;$a++) {
        $day = day_fr($a); // func return Lundi, Mardi...

        if($a==$now_no){

            $output .="<td class='text-center alert-danger' style='color: white'><strong>";
            $output.="<a href=\"{$page_name}?jour=";
            $output .= urlencode($a);
            $output.="&";
            $output.="modele_date=";
            $output.=urldecode($now_date_sql);
            $output .="\" onclick=\"return confirm('Importer {$day}?');";
            $output .="\">";
            $output .=$day." ".$now_date_formatted;
            $output.="&nbsp;&nbsp&nbsp";
            $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
            $output.="&nbsp;&nbsp&nbsp";
            $output .="</a>";
            $output.="</strong>";
            $output.="</td>";

       //     $output .= "<td class='text-center' colspan='3'>Actions</td>";
            $output .="</tr>";

            $output .="<tr>";
            //  $output .= "<td></td>";

        } // end if


    }  // end for

    $old_heure="";

    while($modele = mysqli_fetch_assoc($modele_set)) {

        for($a=1;$a<=7;$a++) {
            $day = day_fr($a); // func return Lundi, Mardi...
            $modele_id = $modele[$day]; // return value of array


            if ($a == $now_no && $modele[$day]) {


                $output .= "<tr>";

                $new_heure = $modele['heure'];


                if ($new_heure !== $old_heure) {
                    $output .= "<td class='text-center' style='vertical-align:middle;'><strong>" . htmlentities ( visu_heure($modele["heure"]), ENT_COMPAT, 'utf-8') . "</strong></td>";
                } else {
                    $output .= "<td></td>";
                }
                $old_heure = $modele["heure"];

            }
        }






        $p_edit="edit_course_modele.php";
        $p_del="delete_course_modele.php";
        $p_new="new_course_modele.php";

        $web_view=htmlentities($modele["web_view"]);
        $pseudo=htmlentities($modele["pseudo"]);
        $heure=$modele['heure'];
        $client_id=$modele['client_id'];

        if($web_view){
            $client_name=$web_view;
        }else{
            $client_name=$pseudo;

        }

        for($a=1;$a<=7;$a++) {
            $day = day_fr($a); // func return Lundi, Mardi...
            $modele_id = $modele[$day]; // return value of array


            if ($a==$now_no && $modele[$day] ) {

                //  $old_heure=$modele['heure'];
                //  "<img src="/images_web/check.png" alt="Mountain View" style="width:304px;height:228px">";
                //   $output .="<td>". htmlentities($modele["heure"])."</td>";


                if ($day == $today_day_name_french) {
                    $output .= "<td class='text-center'>";
                }

           //     $output .= " {$client_name}";
            //    $output.= tooltips_modele($modele_id,$client_name);

                $output.= tooltips_modele($modele_id);

                $output .= "<span class='btn'>";
                if($visible==1){
                    $output .= "<a class='btn btn-primary  btn-xm' style='width:14em;' ";
                } else {
                    $output .= "<a class='btn btn-info  btn-xm' style='width:14em;' ";

                }

                $output.=get_modal_modele($modele_id,$now_date_sql);
                $output .= "</a>";
                $output .= "</span>";


                //    $output .= "<br>";
                $output .= "</td>";

//                $output .= "<td>";
//                $output .= "<a href=\"{$p_edit}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id) . "&jour_id=" . urlencode($a);
//                $output .= " \" onclick=\"return confirm('Editer modele {$pseudo} ?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-pencil'style='color:blue;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";
//
//                $output .= "<td>";
//                $output .= "<a href=\"{$p_new}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Nouveau modele {$pseudo} ?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";
//
//
//                $output .= "<td>";
//                $output .= "<a href=\"{$p_del}?modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Delete modele {$pseudo} {$day} à {$heure}?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-remove'style='color:red;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";



                $output .="</tr>";

            }
        }


    } // while





    $output .="</table>";
    mysqli_free_result($modele_set);
    $output .="</div>";

    return $output;

}


function output_all_modele_pivot_tomorrow($visible=1){

    $modele_set=find_all_modele_pivot($visible);

    $page_name="modele_export.php"; // page which import the day

    $output="";


//    $now = strtotime("now");
//    $now_no = day_eng_no(strftime("%A" ,$now));
//    $now_date_formatted = strftime("%d-%m-%Y" ,$now);
//    $today_day_name_french = day_fr($now_no);

    $tomorrow = strtotime("tomorrow");
    $tomorrow_no= day_eng_no(strftime("%A" ,$tomorrow));
    $tomorrow_date_formatted = strftime("%d-%m-%Y" ,$tomorrow);
    $tomorrow_day_name_french = day_fr($tomorrow_no);
    $tomorrow_date_sql = strftime("%Y-%m-%d" ,$tomorrow);


//    echo "now - <strong>".$now."</strong><br>";
//    echo "now_no - <strong>".$now_no."</strong><br>";
//    echo "now_date_formatted - <strong>".$now_date_formatted."</strong><br>";
//    echo "today_day_name_french - <strong>".$today_day_name_french."</strong><br>";
//
//    echo "<hr>";
//
//    echo "tomorrow - <strong>".$tomorrow."</strong><br>";
//    echo "tomorrow_no - <strong>".$tomorrow_no."</strong><br>";
//    echo "tomorrow_date_formatted - <strong>".$tomorrow_date_formatted."</strong><br>";
//    echo "tomorrow_day_name_french - <strong>".$tomorrow_day_name_french."</strong><br>";




    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";


    $output .="<tr>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Heure</th>";

    for($a=1;$a<=7;$a++) {
        $day = day_fr($a); // func return Lundi, Mardi...

        if($a==$tomorrow_no){

            $output .="<td class='text-center alert-danger' style='color: white'><strong>";
            $output.="<a href=\"{$page_name}?jour=";
            $output .= urlencode($a);
            $output.="&";
            $output.="modele_date=";
            $output.=urldecode($tomorrow_date_sql);
            $output .="\" onclick=\"return confirm('Importer {$day}?');";
            $output .="\">";
            $output .=$day." ".$tomorrow_date_formatted;
            $output.="&nbsp;&nbsp&nbsp";
            $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
            $output.="&nbsp;&nbsp&nbsp";
            $output .="</a>";
            $output.="</strong>";
            $output.="</td>";

 //           $output .= "<td class='text-center' colspan='3'>Actions</td>";
            $output .="</tr>";

            $output .="<tr>";
            //  $output .= "<td></td>";

        } // end if


    }  // end for

    $old_heure="";

    while($modele = mysqli_fetch_assoc($modele_set)) {

        for($a=1;$a<=7;$a++) {
            $day = day_fr($a); // func return Lundi, Mardi...
            $modele_id = $modele[$day]; // return value of array


            if ($a == $tomorrow_no && $modele[$day]) {


                $output .= "<tr>";

                $new_heure = $modele['heure'];


                if ($new_heure !== $old_heure) {
                    $output .= "<td class='text-center' style='vertical-align:middle;'><strong>" . htmlentities( visu_heure($modele["heure"]), ENT_COMPAT, 'utf-8') . "</strong></td>";
                } else {
                    $output .= "<td></td>";
                }
                $old_heure = $modele["heure"];

            }
        }






        $p_edit="edit_course_modele.php";
        $p_del="delete_course_modele.php";
        $p_new="new_course_modele.php";

        $web_view=htmlentities($modele["web_view"]);
        $pseudo=htmlentities($modele["pseudo"]);
        $heure=$modele['heure'];
        $client_id=$modele['client_id'];

        if($web_view){
            $client_name=$web_view;
        }else{
            $client_name=$pseudo;

        }

        for($a=1;$a<=7;$a++) {
            $day = day_fr($a); // func return Lundi, Mardi...
            $modele_id = $modele[$day]; // return value of array


            if ($a==$tomorrow_no && $modele[$day] ) {

                //  $old_heure=$modele['heure'];
                //  "<img src="/images_web/check.png" alt="Mountain View" style="width:304px;height:228px">";
                //   $output .="<td>". htmlentities($modele["heure"])."</td>";


                if ($day == $tomorrow_day_name_french) {
                    $output .= "<td class='text-center'>";
                }

          //      $output .= " {$client_name}";
         //       $output.= tooltips_modele($modele_id,$client_name);



                $output.= tooltips_modele($modele_id);

                $output .= "<span class='btn'>";
                if($visible==1){
                    $output .= "<a class='btn btn-primary  btn-xm'  style='width:14em;'";
                } else {
                    $output .= "<a class='btn btn-info  btn-xm'  style='width:14em;' ";

                }

                $output.=get_modal_modele($modele_id,$tomorrow_date_sql);
                $output .= "</a>";
                $output .= "</span>";


                //   $output .= "<br>";
                $output .= "</td>";

//                $output .= "<td>";
//                $output .= "<a href=\"{$p_edit}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id) . "&jour_id=" . urlencode($a);
//                $output .= " \" onclick=\"return confirm('Editer modele {$pseudo} ?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-pencil'style='color:blue;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";
//           //     $output.="&nbsp;&nbsp&nbsp";
//
//                $output .= "<td>";
//                $output .= "<a href=\"{$p_new}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Nouveau modele {$pseudo} ?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";
//
//                $output .= "<td>";
//                $output .= "<a href=\"{$p_del}?modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Delete modele {$pseudo} {$day} à {$heure}?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-remove'style='color:red;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//
//                $output .= "</td>";

                $output .="</tr>";

            }
        }


    } // while





    $output .="</table>";
    mysqli_free_result($modele_set);
    $output .="</div>";

    return $output;

}



function output_all_modele_pivot_search($time="tomorrow"){

    global $visible;
    $modele_set=find_all_modele_pivot($visible);

    $page_name="modele_export.php"; // page which import the day

    $output="";


//    $now = strtotime("now");
//    $now_no = day_eng_no(strftime("%A" ,$now));
//    $now_date_formatted = strftime("%d-%m-%Y" ,$now);
//    $today_day_name_french = day_fr($now_no);

    $tomorrow = strtotime($time);
    $tomorrow_no= day_eng_no(strftime("%A" ,$tomorrow));
    $tomorrow_date_formatted = strftime("%d-%m-%Y" ,$tomorrow);
    $tomorrow_day_name_french = day_fr($tomorrow_no);
    $tomorrow_date_sql = strftime("%Y-%m-%d" ,$tomorrow);


//    echo "now - <strong>".$now."</strong><br>";
//    echo "now_no - <strong>".$now_no."</strong><br>";
//    echo "now_date_formatted - <strong>".$now_date_formatted."</strong><br>";
//    echo "today_day_name_french - <strong>".$today_day_name_french."</strong><br>";
//
//    echo "<hr>";
//
//    echo "tomorrow - <strong>".$tomorrow."</strong><br>";
//    echo "tomorrow_no - <strong>".$tomorrow_no."</strong><br>";
//    echo "tomorrow_date_formatted - <strong>".$tomorrow_date_formatted."</strong><br>";
//    echo "tomorrow_day_name_french - <strong>".$tomorrow_day_name_french."</strong><br>";




    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";


    $output .="<tr>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>Heure</th>";

    for($a=1;$a<=7;$a++) {
        $day = day_fr($a); // func return Lundi, Mardi...

        if($a==$tomorrow_no){

            $output .="<td class='text-center alert-danger' style='color: white'><strong>";
            $output.="<a href=\"{$page_name}?jour=";
            $output .= urlencode($a);
            $output.="&";
            $output.="modele_date=";
            $output.=urldecode($tomorrow_date_sql);
            $output .="\" onclick=\"return confirm('Importer {$day}?');";
            $output .="\">";
            $output .=$day." ".$tomorrow_date_formatted;
            $output.="&nbsp;&nbsp&nbsp";
            $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
            $output.="&nbsp;&nbsp&nbsp";
            $output .="</a>";
            $output.="</strong>";
            $output.="</td>";

        //    $output .= "<td class='text-center' colspan='3'>Actions</td>";
            $output .="</tr>";

            $output .="<tr>";
            //  $output .= "<td></td>";

        } // end if


    }  // end for

    $old_heure="";

    while($modele = mysqli_fetch_assoc($modele_set)) {

        for($a=1;$a<=7;$a++) {
            $day = day_fr($a); // func return Lundi, Mardi...
            $modele_id = $modele[$day]; // return value of array


            if ($a == $tomorrow_no && $modele[$day]) {


                $output .= "<tr>";

                $new_heure = $modele['heure'];


                if ($new_heure !== $old_heure) {
                    $output .= "<td class='text-center' style='vertical-align:middle;'><strong>" . htmlentities(visu_heure($modele["heure"]), ENT_COMPAT, 'utf-8') . "</strong></td>";
                } else {
                    $output .= "<td></td>";
                }
                $old_heure = $modele["heure"];

            }
        }






        $p_edit="edit_course_modele.php";
        $p_del="delete_course_modele.php";
        $p_new="new_course_modele.php";

        $web_view=htmlentities($modele["web_view"]);
        $pseudo=htmlentities($modele["pseudo"]);
        $heure=$modele['heure'];
        $client_id=$modele['client_id'];

        if($web_view){
            $client_name=$web_view;
        }else{
            $client_name=$pseudo;

        }

        for($a=1;$a<=7;$a++) {
            $day = day_fr($a); // func return Lundi, Mardi...
            $modele_id = $modele[$day]; // return value of array


            if ($a==$tomorrow_no && $modele[$day] ) {



                if ($day == $tomorrow_day_name_french) {
                    $output .= "<td class='text-center'>";
                }

//                $output.= tooltips_modele($modele_id,$client_name);


                $output.= tooltips_modele($modele_id);

                $output .= "<span class='btn'>";
                if($visible==1){
                    $output .= "<a class='btn btn-primary  btn-xm' style='width:14em;' ";
                } else {
                    $output .= "<a class='btn btn-info  btn-xm' style='width:14em;' ";

                }

                $output.=get_modal_modele($modele_id,$tomorrow_date_sql);
                $output .= "</a>";
                $output .= "</span>";


                $output .= "</td>";

//                $output .= "<td>";
//                $output .= "<a href=\"{$p_edit}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id) . "&jour_id=" . urlencode($a);
//                $output .= " \" onclick=\"return confirm('Editer modele {$pseudo} ?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-pencil'style='color:blue;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";
//
//                $output .= "<td>";
//                $output .= "<a href=\"{$p_new}?client_id=";
//                $output .= urlencode($client_id) . "&modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Nouveau modele {$pseudo} ?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-plus'style='color:green;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//                $output .= "</td>";
//
//
//                $output .= "<td>";
//                $output .= "<a href=\"{$p_del}?modele_id=" . urlencode($modele_id);
//                $output .= " \" onclick=\"return confirm('Delete modele {$pseudo} {$day} à {$heure}?');";
//                $output .= " \">";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "<span class='glyphicon glyphicon-remove'style='color:red;' aria-hidden='true'></span>";
//                $output.="&nbsp;&nbsp&nbsp";
//                $output .= "</a>";
//
//                $output .= "</td>";

                $output .="</tr>";

            }
        }


    } // while





    $output .="</table>";
    mysqli_free_result($modele_set);
    $output .="</div>";

    return $output;

}



function form_select_week_day(){
    $output="";

    $output.="<label  class='control-label' for='week_day''>jour&nbsp;&nbsp;&nbsp;&nbsp;</label>";
    $output.="<select class='form-control' name='week_day' id='week_day' required >";

    $output.="<option value='1'>Lundi</option>";
    $output.="<option value='2'>Mardi</option>";
    $output.="<option value='3'>Mercredi</option>";
    $output.="<option value='4'>Jeudi</option>";
    $output.="<option value='5'>Vendredi</option>";
    $output.="<option value='6'>Samedi</option>";
    $output.="<option value='7'>Dimanche</option>";

    $output.="</select>";


  return $output;

}

function form_radio_next_last(){

    $output="";

    $output.="&nbsp;&nbsp;&nbsp;";
    $output.="<div class='radio'>";

//    $output.="<label class='checkbox-inline'>";
//    $output.="<input type='radio' name='date_next_last' value='today' id='radio_today'  checked>";
//    $output.="Aujourd'hui";
//    $output.="</label>";
//
//    $output.="&nbsp;&nbsp;&nbsp;";
//
//    $output.="<label class='checkbox-inline'>";
//    $output.="<input type='radio' name='date_next_last' value='tomorrow' id='radio_tomorrow'>";
//    $output.="Demain";
//    $output.="</label>";

    $output.="&nbsp;&nbsp;&nbsp;";

    $output.="<label class='checkbox-inline'>";
    $output.="<input type='radio' name='date_next_last' value='next' id='radio_next'  checked>";
    $output.="Next";
    $output.="</label>";

    $output.="&nbsp;&nbsp;&nbsp;";

    $output.="<label class='checkbox-inline'>";
    $output.="<input type='radio' name='date_next_last' value='last' id='radio_last' >";
    $output.="Last";
    $output.="</label>";

    $output.="</div>";

    return $output;

}



?>