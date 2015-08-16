<?php

$errors = array();
$warnings=array();


function get_warning_error_div($msg_arg,$warning_me=false)    {
    // formats text in alert view
    $msg="";

    if($warning_me){$alert="warning"; $gliphicon="warning-sign";$txt="Warning"; }else { $alert="danger"; $gliphicon="exclamation-sign";$txt="Error";  }

    //   {$alert} {$gliphicon} {$txt}
    if($msg_arg){
        $msg.= "<div class=\"alert alert-{$alert}\" role='alert'>";
        $msg.="<a href='#' class='close' data-dismiss='alert'>&times;</a>";
        $msg.="<span class=\"glyphicon glyphicon-{$gliphicon}\" aria-hidden='true'></span>";
        $msg.="<span class=\"sr-only\"><strong>{$txt}:</strong></span>";
        $msg.=" ". $msg_arg;
        $msg .= "</div>";
    } else {
        $msg="";
    }

    return $msg;


}

function get_warning_error_p($msg_arg,$warning_me=false)    {
    // formats text in alert view

 //   <p class="help-block col-sm-offset-3" style="font-size:0.9em;color:#ff0000" id="errorMessagePseudo"></p>

    $msg="";

    if($warning_me){$alert="warning"; $gliphicon="warning-sign";$txt="Warning"; }else { $alert="danger"; $gliphicon="exclamation-sign";$txt="Error";  }

    //   {$alert} {$gliphicon} {$txt}
    if($msg_arg){
        $msg.= "<p class=\"alert alert-{$alert} help-block col-sm-offset-3\" role='alert'>";
        $msg.="<a href='#' class='close' data-dismiss='alert'>&times;</a>";
        $msg.="<span class=\"glyphicon glyphicon-{$gliphicon}\" aria-hidden='true'></span>";
        $msg.="<span class=\"sr-only\"><strong>{$txt}:</strong></span>";
        $msg.=" ". $msg_arg;
        $msg .= "</p>";
    } else {
        $msg="";
    }

    return $msg;


}


function fieldname_as_text($fieldname) {
  $fieldname = str_replace("_", " ", $fieldname);
  $fieldname = ucfirst($fieldname);
  return $fieldname;
}

// * presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function has_presence($value) {
	return isset($value) && $value !== "";
}

function validate_presences($required_fields, $warning_me=false) {
    // second arg to get as warning
  global $errors;
  global $warnings;

  $msg_presence=array();

  foreach($required_fields as $field) {
    $value = trim($_POST[$field]);
  	if (!has_presence($value)) {
        if ($warning_me) {
            $warnings[$field] = fieldname_as_text($field) . " can't be blank";
          //  $msg_presence[$field]=get_warning_error($warnings[$field],$warning_me);
            $msg_presence[$field]=$warnings[$field];

        }else{
  		    $errors[$field] = fieldname_as_text($field) . " can't be blank";
         //   $msg_presence[$field]=get_warning_error($errors[$field],$warning_me);;
            $msg_presence[$field]=$errors[$field];


        }

    }
  }

   return $msg_presence;

}

function validate_presences_non_post($required_fields, $record,$warning_me=false) {
// not coming from post but by query db returning record set eg program 1 record as arrey
    global $errors;
    global $warnings;

    $msg_presence=array();
    foreach($required_fields as $field) {
        $value = trim($record[$field]);
        if (!has_presence($value)) {

            if ($warning_me) {
                $warnings[$field] = fieldname_as_text($field) . " n'est pas rempli";

                $msg_presence[$field]=$warnings[$field];
            //    $msg_presence[$field]=get_warning_error($warnings[$field],$warning_me);

                //  var_dump($warnings[$field]);
            }else{
                $errors[$field] = fieldname_as_text($field) . " n'est pas rempli ";
                $msg_presence[$field]=$errors[$field];
             //   $msg_presence[$field]=get_warning_error($errors[$field],$warning_me);;


            }
            //   var_dump(debug_backtrace());

        }
    }

    return $msg_presence;
}

// taken from W3C used in email

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_email($fields_with_email,$warning_me=false){
    global $errors;
    global $warnings;

    $msg_email="";

    foreach($fields_with_email as $field) {
        $email = test_input($_POST[$field]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           // $emailErr = "Invalid email format";
            if ($warning_me) {
                $warnings[$field] = fieldname_as_text($field) . " Invalid email format";
                $msg_email=$warnings[$field];
            }else{
                $errors[$field] = fieldname_as_text($field) . " Invalid email format";
                $msg_email=$errors[$field];
            }

        }
    }
}

// * string length
// max length
function has_max_length($value, $max) {
	return strlen($value) <= $max;
}

function validate_max_lengths($fields_with_max_lengths,$warning_me=false) {
	global $errors;
    global $warnings;
	// Expects an assoc. array
	foreach($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
	  if (!has_max_length($value, $max)) {

          if($warning_me){
              $warnings[$field] = fieldname_as_text($field) . " is too long";

          }else {
              $errors[$field] = fieldname_as_text($field) . " is too long";
          }
	  }
	}
}

// * inclusion in a set
function has_inclusion_in($value, $set) {
	return in_array($value, $set);
}


// specifit< to course

function validate_pseudo_bon_no($pseudo,$bon_no,$warning_me=false){
    global $errors;
    global $warnings;

    $pseudo = strtolower(trim($pseudo));
    $bon_no= strtolower(trim($bon_no));
    $pseudo_sang=array("tour_sang", "carouge_sang");

    $field = "Client Sang ou Materiel: {$pseudo} ";

    $msg_bon_no="";

    if (in_array($pseudo, $pseudo_sang) && $bon_no === "") {
        if($warning_me){
            $warnings[$field] = fieldname_as_text($field) . " manque dans le Bon No pour ";

        }else{
            $errors[$field] = fieldname_as_text($field) . " manque dans le Bon No pour ";
        }

      $msg_bon_no= $field . " manque dans le Bon No pour ";

    }

    return $msg_bon_no;

}


function validate_pseudo($pseudo,$pseudo_autres,$nom_patient,$warning_me=false){
    global $errors;
    global $warnings;


    $pseudo_view="".htmlentities(trim($pseudo),ENT_COMPAT,'utf-8')."";

    $pseudo = strtolower(trim($pseudo));
    $pseudo_autres = strtolower(trim($pseudo_autres));
    $nom_patient = strtolower(trim($nom_patient));


    $field = "Nom du client: {$pseudo_view} ";
    $field2 = "Indiquer pour transporteur {$pseudo_view} :";

    $msg_pseudo_autres="";
    $msg_nom_patient="";

    //     if ((sangname.value=="Tour_Sang") || (sangname.value=="Carouge_Sang")) {


    $pseudo_nom = array("autres", "colline");
    $pseudo_patient = array("tour_patient", "tag", "partners", "mines_icbl", "cash", "aude", "aloha");


    if (in_array($pseudo, $pseudo_nom) && $pseudo_autres === "") {

        if($warning_me){
        $warnings[$field] = fieldname_as_text($field) . " manque dans le champ nom pour le nom {$pseudo_view} ";

        }else{
        $errors[$field] = fieldname_as_text($field) . " manque dans le champ nom pour le nom {$pseudo_view} ";
            //    echo $errors[$field] . "<br >";
        }

        $msg_pseudo_autres="{$field}". " manque dans le champ Nom pour le client {$pseudo_view} ";


    }


    if (in_array($pseudo, $pseudo_patient) && $nom_patient === "") {
        if($warning_me){
         $warnings[$field2] = fieldname_as_text($field2) . " le nom du patient afin de facturer {$pseudo_view}";

        }else{
            $errors[$field2] = fieldname_as_text($field2) . " le nom du patient  afin de facturer {$pseudo_view}";
            //    echo $errors[$field2] . "<br >";
        }

        $msg_nom_patient="{$field2}". " le nom du patient pour facturer {$pseudo_view} ";

    }

    return array($msg_pseudo_autres,$msg_nom_patient);

 //   list($msg_pseudo_autres,$msg_nom_patient)=validate_pseudo($pseudo,$pseudo_autres,$nom_patient,true);

}


function validate_heure($heure_aller , $aller_retour, $heure_retour,$warning_me=false){
// recherche si heure départ n'est pas supérieur à heure d'arriver. Aller-retour ne marche si ça tombe sur 2 jours alors faire 2 courses distinctes

    global $errors;
    global $warnings;


    settype($heure_aller_integer,'float');
    settype($heure_retour_integer,'float');

    $heure_aller_integer= (float)str_replace("h", ".", $heure_aller);
    $heure_retour_integer= (float)str_replace("h", ".", $heure_retour);


    // $aller_retour=strtolower($aller_retour);
    $field="oupsss";
    $field2="Aller_Retour";
    $field3="Heure_retour";




    if(($aller_retour=="AllerRetour") && ($heure_retour)==""){

        if($warning_me){
            $warnings[$field2] = fieldname_as_text($field2) . " étant choisi vous devez indiquer l'heure de retour  ";

        }else {
            $errors[$field2] = fieldname_as_text($field2) . " étant choisi vous devez indiquer l'heure de retour  ";

        }
    }

    if (($aller_retour=="AllerRetour") && ($heure_retour!=="") && ( $heure_aller_integer>$heure_retour_integer)) {
        if($warning_me){
           $warnings[$field] = fieldname_as_text($field) . " heure de l'aller ne peut etre supérieur à l'heure retour dans la même journée ";

        }else {
            $errors[$field] = fieldname_as_text($field) . " heure de l'aller ne peut etre supérieur à l'heure retour dans la même journée ";

        }
    }

    if (($aller_retour=="AllerSimple") && ($heure_retour!=="")){
        if($warning_me){
            $warnings[$field3] = fieldname_as_text($field3) . " doit être vide si vous avez fait aller simple. Corriger svp le formulaire";

        }else {
            $errors[$field3] = fieldname_as_text($field3) . " doit être vide si vous avez fait aller simple. Corriger svp le formulaire";

        }


    }
}


function type_transport($pseudo) {
// recherche d'après le pseudo le type de transport. Si un nouveau rejouter dans le array correspondant

    $pseudo=strtolower($pseudo);

    $pseudo_sang=array("tour_sang","carouge_sang");
    $pseudo_liste_patients=array("tour_patient","tag","partners","mines_icbl","aude","aloha");
    $pseudo_cash=array("cash");

    if(in_array($pseudo,$pseudo_sang)){
        return "Sang";
    } elseif (in_array($pseudo,$pseudo_liste_patients) ){
        return "Liste Patients";

    } elseif (in_array($pseudo,$pseudo_cash) ){
        return "Cash";

    }else{
        return "Standard";

    }


}

function validate_chauffeur_by_name($chauffeur_name,$warning_me=false){
// check to see the input chauffeur is indeed a chauffeur and not just coming from login session name

    global $connection;
    global $errors;
    global $warnings;


    $safe_chauffeur = mysqli_real_escape_string($connection, $chauffeur_name);
    $field = $safe_chauffeur;

    $msg_chauffeur="";

    $query  = "SELECT * ";
    $query .= "FROM chauffeurs ";
    $query .= "WHERE chauffeur_name = '{$safe_chauffeur}' ";
    $query .= "LIMIT 1";
    $chauffeur_set = mysqli_query($connection, $query);
    confirm_query($chauffeur_set);

    $chauffeur_count = mysqli_num_rows($chauffeur_set);
    if($chauffeur_count == 0) {

   // $text="<br><a href='new_chauffeur.php'>Ajouter un chauffeur</a> ";

        if($warning_me){
            $warnings[$field] = fieldname_as_text($field) . " n'est pas inclus dans la liste des chauffeurs. Si c'est un nouveau chauffeur demander à l'adminstrateur de le rajouter";
            $msg_chauffeur=$warnings[$field];
        }else{

            $errors[$field] = fieldname_as_text($field) . " n'est pas inclus dans la liste des chauffeurs. Si c'est un nouveau chauffeur demander à l'adminstrateur de le rajouter";
            $msg_chauffeur=$errors[$field];
        }



    }


    mysqli_free_result($chauffeur_set);
    return $msg_chauffeur;
}


function validate_date($date){

}


function validation_pseudo_clients($pseudo,$warning_me=false){


    global $connection;
    global $errors;
    global $warnings;




    $safe_pseudo= mysqli_real_escape_string($connection,$pseudo);
    $field = $safe_pseudo;


    $query  = "SELECT * ";
    $query .= "FROM clients ";
    $query .= "WHERE pseudo = '{$safe_pseudo}' ";
    $query .= "LIMIT 1";
    $client_set = mysqli_query($connection, $query);
    confirm_query($client_set);

    $msg="";
    $txt=" n'est pas inclus dans la liste des clients. Si c'est un nouveau client veuillez le rajouter dans la table client  ou sinon utilisez AUTRES puis rajouter le nom dans le champs nom";

    $pseudo_count = mysqli_num_rows($client_set);
    if($pseudo_count == 0) {

        if($warning_me){
            $warnings[$field] = fieldname_as_text($field) . $txt;
            $msg= $warnings[$field];
        }else{
            $errors[$field] = fieldname_as_text($field) . $txt;
            $msg= $errors[$field];
        }


    }
    mysqli_free_result($client_set);

    return $msg;
}


function is_modele_exists($week_day_rank,$cliend_id,$heure,$warning_me=false){

    global $connection;
    global $errors;
    global $warnings;

    $week_day_rank_safe=mysql_prep($week_day_rank);
    $cliend_id_safe=mysql_prep($cliend_id);
    $heure_safe=mysql_prep($heure);


    $query  = "SELECT * ";
    $query .= "FROM programmed_courses_modele ";
    $query .= "WHERE week_day_rank = {$week_day_rank_safe} ";
    $query .= "AND client_id = {$cliend_id_safe} ";
    $query .= "AND heure = '{$heure_safe}' ";

    //   $query .= "ORDER BY position ASC";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    // $result= $result;

    $row_count=mysqli_num_rows($result);
    //  printf("Result set has %d rows.\n",$rowcount);
    // Free result set
    mysqli_free_result($result);

    $client=find_client_by_id($cliend_id);
    $pseudo=$client['pseudo'];

    $field="Le modèle du ";
    $field.="".day_fr($week_day_rank)." ";
    $field.=" pour ".$pseudo." ";
    $field.="à ". $heure." ";

    if($row_count==0) {
    } else {

        if($warning_me){
            $warnings[$field] = fieldname_as_text($field) . " existe déjà et ne peut etre créé ou édité";

        }else{
            $errors[$field] = fieldname_as_text($field) . " existe déjà et ne peut etre créé ou édité";

        }
    }

  //  return $row_count;

}


function check_date_vs_now($str_time,$warning_me=false){

    // attention contrairement aux autres validation $warning_me part défaut true
    // pour error  rajouter false en appellant la fonction après la date

    global $errors;
    global $warnings;

    $unix_time_date = strtotime($str_time);
    $unix_time_now = strtotime('now');

    $date_input= strftime("%Y-%m-%d" ,$unix_time_date);
    $date_now= strftime("%Y-%m-%d" ,$unix_time_now);

    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($date_input);

    $date_input_fr=$date_fr_short;

    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($date_now);

    $date_now_fr=$date_fr_short;

    $field="Attention date";

    $msg="";
    $text_array="";
    $text_return="Attention la date est au <strong>{$date_input_fr}</strong> aujourd'hui est <strong>{$date_now_fr}</strong>. Assurez-vous si nécéssaire de rentrer la bonne date ";

    if($date_input===$date_now){
     return null;
    } else {

     if ($warning_me)  {
     $warnings[$field] = fieldname_as_text($field) . " car elle n'est pas aujourd'hui. Assurez-vous de changer la date si nécéssaire ";

     return $text_return;

     } else {

         $errors[$field] = fieldname_as_text($field) . " car elle n'est pas aujourd'hui. Assurez-vous de changer la date si nécéssaire ";

     return $text_return;

     }

    }


}



?>