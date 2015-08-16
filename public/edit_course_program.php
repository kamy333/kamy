<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>



<?php
$query_string="?".$_SERVER['QUERY_STRING'];
if (isset($_GET["url"])) {
    $url=$_GET["url"].$query_string;
} else {
    $url="view_program_history.php".$query_string;

}



?>
<?php
if(isset($_GET["program_id"])){
    $program=find_program_by_id($_GET["program_id"]);

}

if (!$program) {
// admin ID was missing or invalid or
// admin couldn't be found in database
$_SESSION["message"] = "Program Course does not exist in  database.";
redirect_to($url);
}


$chauffeur_existing=$program["chauffeur"];

if (is_chauffeur() && ($program["validated_chauffeur"]==1 || $program["validated_chauffeur"]==2) ) {

    if ($_SESSION['nom']!==$chauffeur_existing){

        $_SESSION["message"] = " La course a déjà été validé ou Annulé par ".htmlentities( $chauffeur_existing , ENT_COMPAT, 'utf-8'). " Que lui ou elle peut updater";
        redirect_to($url);
    }
}


?>
<?php $missing=array(); ?>
<?php $expected=array("course_date","heure","pseudo","pseudo_autres","chauffeur","depart","arrivee","nom_patient","bon_no","prix_course","remarque"); ?>



<?php if(isset($_GET["program_id"])&&!isset($_POST["submit"])) {
    $missing=array();

    $program=find_program_by_id($_GET["program_id"]);

    if($program){



    $required_fields=array("course_date","heure","pseudo","chauffeur","depart","arrivee","prix_course");

    foreach ($program as $key => $value) {
        $temp = is_array($value) ? $value : trim($value);
        if (empty($temp) && in_array($key, $required_fields)) {
        //    $missing[] = $key;
            $$key = '';
        } elseif(in_array($key, $expected)) {
            $$key = $temp;
        }
    }

// true =warnings  -  empty or false=errors
    validate_presences_non_post($required_fields, $program,true);
    validate_chauffeur_by_name($chauffeur,true);
    validation_pseudo_clients($pseudo,true);
    validate_pseudo($pseudo,$pseudo_autres,$nom_patient,true);
    check_date_vs_now($course_date,true);
    validate_pseudo_bon_no($pseudo,$bon_no,true);






}



} elseif( isset($_POST["submit"])) {
  $required_fields=array("course_date","heure","pseudo","chauffeur",);
  $warning_fields=array("depart",'arrivee',"prix_course");


    if(is_chauffeur()){
        $_POST["chauffeur"]= $_SESSION["nom"];
        $_POST["prix_course"]=["prix_course"];
    }

    if(!$_POST["prix_course"]){
        $_POST["prix_course"]=$program["prix_course"];
    }

    if(!isset($_POST["heure"])){
        $_POST["heure"]="";
    }

    if(!isset($_POST["pseudo"])){
        $_POST["pseudo"]="";
    }

    settype($prix_course,"float");
    settype($client_id,"integer");
    settype($validated_chauffeur,"integer");
    settype($validated_mgr,"integer");
    settype($validated_final,"integer");

   // var_dump($_POST);


    foreach ($_POST as $key => $value) {
        $temp = is_array($value) ? $value : trim($value);
        if (empty($temp) && in_array($key, $required_fields)) {

          // $missing[] = $key;
            $$key = '';
        } elseif(in_array($key, $expected)) {
            $$key = $temp;
        }
    }



    if (isset($pseudo)){
        $type_transport=type_transport($pseudo);

    }
    $aller_retour="AllerSimple";





    validate_presences($required_fields);
    validate_presences($warning_fields,true);

    validate_chauffeur_by_name($chauffeur);
//    validation_pseudo_clients($pseudo);
//    validate_pseudo($pseudo,$pseudo_autres,$nom_patient,true);
//    validate_pseudo_bon_no($pseudo,$bon_no,true);


    if(isset($chauffeur)){validate_chauffeur_by_name($chauffeur);}
    if(isset($pseudo)){validation_pseudo_clients($pseudo);}

    if(isset($pseudo)&& isset($pseudo_autres)&& isset($nom_patient)){
        validate_pseudo($pseudo,$pseudo_autres,$nom_patient,true);

    }

    if(isset($pseudo) && isset($bon_no)){
        validate_pseudo_bon_no($pseudo,$bon_no,true);}


if(isset($pseudo)&& isset($pseudo_autres)&& isset($nom_patient)&& isset($bon_no) &&isset($chauffeur)) {

    list($msg_pseudo_autres, $msg_nom_patient) = validate_pseudo($pseudo, $pseudo_autres, $nom_patient, true);
    $msg_bon_no = validate_pseudo_bon_no($pseudo, $bon_no, true);
    $msg_chauffeur = validate_chauffeur_by_name($chauffeur, false);
    $msg_pseudo = validation_pseudo_clients($pseudo);

    $msg_pseudo_autres = get_warning_error_p($msg_pseudo_autres, true);
    $msg_nom_patient = get_warning_error_p($msg_nom_patient, true);
    $msg_bon_no = get_warning_error_p($msg_bon_no, true);
    $msg_chauffeur = get_warning_error_p($msg_chauffeur, false);
    $msg_pseudo = get_warning_error_p($msg_pseudo, false);

    $client=find_client_from_pseudo($pseudo);

}







// non post from GET

    $missing=validate_presences_non_post($required_fields,$_POST,false);
    foreach ($_POST as $key => $val){
        $msg_key= "msg_presence_error_".$key;
      //  var_dump($msg_key);
        $text="<strong>&nbsp;&nbsp;  ".ucfirst($key)."</strong> est à compléter impérativement";
        $$msg_key= array_key_exists ($key, $missing)? get_warning_error_p($text,false)  : "" ;
        //    $$msg_key= array_key_exists ($key, $missing)? get_warning_error($missing[$key],true)  : "" ;

    }




    $missing=validate_presences_non_post($warning_fields,$_POST,true);
    foreach ($_POST as $key => $val){
        $msg_key= "msg_presence_warning_".$key;
        $text="<strong>&nbsp;&nbsp;  ".ucfirst($key)."</strong> est à compléter";
        $$msg_key= array_key_exists ($key, $missing)? get_warning_error_p($text,true)  : "" ;
        //    $$msg_key= array_key_exists ($key, $missing)? get_warning_error($missing[$key],true)  : "" ;

    }





    if(empty($errors)){
        $validated_chauffeur=$program["validated_chauffeur"];
        $validated_mgr=$program["validated_mgr"];
        $validated_final=$program["validated_final"];
        $course_date=mysql_prep($course_date);
    //    $modele_id=(int) $modele_id;
        $client_id= (int) $client["id"];
        $pseudo= mysql_prep($pseudo);
        $pseudo_autres= mysql_prep($pseudo_autres);
        $heure= mysql_prep($heure);
        $aller_retour= mysql_prep($aller_retour);
        $chauffeur= mysql_prep($chauffeur);
        $depart= mysql_prep($depart);
        $arrivee= mysql_prep($arrivee);
        $type_transport=mysql_prep($type_transport);
        $nom_patient=mysql_prep($nom_patient);
        $bon_no=mysql_prep($bon_no);
        $prix_course=  mysql_prep($prix_course);
        $remarque=mysql_prep($remarque);
        $username=mysql_prep($_SESSION['username']);

        $id = $program["id"];


        $table="programmed_courses ";
        $query  = "UPDATE {$table} SET" . " ";

        $query.="validated_chauffeur={$validated_chauffeur}, ";
        $query.="validated_mgr={$validated_mgr}, ";
        $query.="validated_final={$validated_final}, ";
        $query.="course_date='{$course_date}', ";
        $query.="client_id={$client_id}, ";
        $query.="pseudo='{$pseudo}', ";
        $query.="pseudo_autres='{$pseudo_autres}', ";
        $query.="heure='{$heure}', ";
        $query.="aller_retour='{$aller_retour}', ";
        $query.="chauffeur='{$chauffeur}', ";
        $query.="depart='{$depart}', ";
        $query.="arrivee='{$arrivee}', ";
        $query.="type_transport='{$type_transport}', ";
        $query.="nom_patient='{$nom_patient}', ";
        $query.="bon_no='{$bon_no}', ";
        $query.="prix_course={$prix_course}, ";
        $query.="remarque='{$remarque}', ";
        $query.="username='{$username}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";

   //     echo $query;

        $result = mysqli_query($connection, $query);

  //      $last_id=mysqli_insert_id($connection);

  //      var_dump($last_id);

        list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($course_date);


        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Course program updated.";
            $_SESSION["OK"]=true;
            redirect_to($url);

        } elseif ($result && mysqli_affected_rows($connection) == 0) {
            $_SESSION["message"] = "Course update failed because no change was made compare to what existed in db already.";
            redirect_to($url);
            unset($_POST);

        } else {
            // Failure
            $_SESSION["message"] = "Course program update failed.";
        }




    }




} else {


}


?>



<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php $incl_message_error=true ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>




<?php if(isset($_GET["program_id"])&&!isset($_POST["submit"])) {

 list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($program["course_date"]);

    // GET request
    $fiedset_msg= " Client " . $program["pseudo"];
    $fiedset_msg.= " en date de " . $date_fr_short;
    $fiedset_msg.=" ID ". $_GET["program_id"] ;


    // validation warning


   $date_msg=  get_warning_error_p(check_date_vs_now($program['course_date']),true) ;

    list($msg_pseudo_autres,$msg_nom_patient)=validate_pseudo($pseudo,$pseudo_autres,$nom_patient,true);
    $msg_bon_no=validate_pseudo_bon_no($pseudo,$bon_no,true);


//    echo $msg_pseudo_autres;
//    echo $msg_nom_patient;

    $msg_pseudo_autres= get_warning_error_p($msg_pseudo_autres,true);
    $msg_nom_patient= get_warning_error_p($msg_nom_patient,true);
    $msg_bon_no= get_warning_error_p($msg_bon_no,true);




// non post from GET
$missing=validate_presences_non_post($required_fields,$program,true);
    foreach ($program as $key => $val){
        $msg_key= "msg_presence_warning_".$key;
        $text="<strong>&nbsp;&nbsp;  ".ucfirst($key)."</strong> est à compléter";
        $$msg_key= array_key_exists ($key, $missing)? get_warning_error_p($text,true)  : "" ;
    //    $$msg_key= array_key_exists ($key, $missing)? get_warning_error($missing[$key],true)  : "" ;

    }



}else {
    $fiedset_msg=""    ;
    $date_msg="";
} ?>







<div class="row">
    <div class="col-md-4 col-md-offset-2 col-lg-7 col-lg-offset-2">


        <div class ="background_light_blue">


            <form name="form1" id="" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?program_id=<?php echo urlencode($program["id"]); ?>">

                <fieldset id="login" title="Course">
                    <legend class="text-center" style="color: #0000ff">Update course <?php echo htmlentities($fiedset_msg, ENT_COMPAT, 'utf-8'); ?></legend>

                    <?php if(!is_chauffeur()) { ?>
                        <div class="form-group">
                            <?php echo isset($msg_presence_error_prix_course)? $msg_presence_error_prix_course:""; ?>
                            <?php echo isset($msg_presence_warning_prix_course)? $msg_presence_warning_prix_course:""; ?>

                            <label  class="col-sm-3 control-label" for="prix_course">Prix</label>
                            <div class="col-sm-9">
                                <input  class="form-control"  type="text" name="prix_course"  value="<?php if (isset($prix_course)) { echo $prix_course;} ?>" id="prix_course" placeholder="prix (numeric)"  >
                            </div></div>


                    <?php  } ?>


<!--                    --><?php // if(isset($_GET["program_id"])&& $date_msg){ ?>
<!--                    <div class="form-group">-->
<!--                        <div class="col-sm-9 col-sm-offset-3">-->
<!--                            --><?php //  echo $date_msg;?>
<!--                        </div></div>-->
<!--                    --><?php //} ?>


                    <div class="form-group">


                        <?php echo isset($date_msg)? $date_msg :"" ?>
                        <?php echo isset($msg_presence_error_course_date)? $msg_presence_error_course_date:""; ?>
                        <?php echo isset($msg_presence_warning_course_date)? $msg_presence_warning_course_date:""; ?>

                        <label class="col-sm-3 control-label" for="course_date">Date Course</label>

                        <div class="col-sm-9">

                                <?php $example_date= strftime("%Y-%m-%d",strtotime('now'))  ?>

                            <input  class="form-control"  type="date" placeholder=" date AAAA-MM-JJ eg <?php  echo $example_date?> " name="course_date" id="course_date" value="<?php if(isset($course_date)) {echo htmlentities($course_date, ENT_COMPAT, 'utf-8') ;}?>"
                                    pattern="\d{4}-\d{2}-\d{2}" title="YYYY-MM-DD">
                        </div></div>

                    <div class="form-group">
                        <?php echo isset($msg_chauffeur)? $msg_chauffeur:""; ?>
                        <?php if(!is_chauffeur()){echo isset($msg_presence_error_chauffeur)? $msg_presence_error_chauffeur : "";}  ?>
                        <?php if(!is_chauffeur()){echo isset($msg_presence_warning_chauffeur)? $msg_presence_warning_chauffeur : "";}  ?>

                        <label class="col-sm-3 control-label" for="chauffeur">Nom Chauffeur</label>
                        <div class="col-sm-9">
                            <select  class="form-control"  name="chauffeur" id="chauffeur">
                                <?php // todo check for employee ?>
                                <?php if(is_chauffeur()){ $chauffeur=$_SESSION["nom"];} ?>

                                <option value="<?php if(isset($chauffeur)) { echo htmlentities($chauffeur, ENT_COMPAT, 'utf-8') ;}?>" selected><?php if(isset($chauffeur)) {echo htmlentities($chauffeur, ENT_COMPAT, 'utf-8');}?></option>

                                <?php  if( !is_chauffeur()) { ?>
                                    <?php echo selection_chauffeurs ($chauffeur); ?>
                                <?php }?>

                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <?php echo isset($msg_presence_warning_heure)? $msg_presence_warning_heure:""; ?>
                        <?php echo isset($msg_presence_error_heure)? $msg_presence_error_heure:""; ?>

                        <label  class="col-sm-3 control-label"  for="heure">Heure départ</label>

                        <div class="col-sm-9">
                            <select  class="form-control"  name="heure" id="heure">
                                <?php
                                if ((isset($_POST['heure']) || $_GET) && (isset($heure)) ) {
                                    echo "<option value="."'". htmlentities($heure,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities(visu_heure($heure),ENT_COMPAT,'utf-8')."</option>";

                                }  else {
                                    echo "<option value='' disabled selected>Heure départ </option>";
                                }
                                ?>
                                <?php include("../includes/dataforms/hournew.php"); ?>
                            </select>
                        </div></div>


                    <div class="form-group">
                        <?php echo isset($msg_pseudo)? $msg_pseudo:""; ?>
                        <?php echo isset($msg_presence_error_pseudo)? $msg_presence_error_pseudo:""; ?>
                        <?php echo isset($msg_presence_warning_pseudo)? $msg_presence_warning_pseudo:""; ?>

                        <label  class="col-sm-3 control-label" for="pseudo">Nom du Client</label>
                        <div class="col-sm-9">
                            <select  class="form-control"  name="pseudo" id="pseudo" onchange="mypseudochange()">

                                <?php if ((isset($_POST['pseudo']) ||  $_GET) && (isset($pseudo))) {
                                    echo "<option value="."'". htmlentities($pseudo,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities($pseudo,ENT_COMPAT,'utf-8')."</option>";
                                }  else {
                                    echo "<option value='' disabled selected>Client pseudo</option>";
                                }
                                echo output_clients_select_list_all();

                                ?>
                            </select>
                        </div></div>

                    <!--                        --><?php // if(isset($_GET["program_id"])&& $msg_pseudo_autres){ ?>
                    <!--                            <div class="form-group">-->
                    <!--                                <div class="col-sm-9 col-sm-offset-3">-->
                    <!--                                    --><?php //  echo $msg_pseudo_autres;?>
                    <!--                                </div></div>-->
                    <!--                        --><?php //} ?>

                    <div class="form-group listnom">
                        <p class="help-block col-sm-offset-3" style="font-size:0.9em;color:#ff0000" id="errorMessagePseudo"></p>
                        <?php echo isset($msg_pseudo_autres)?$msg_pseudo_autres:""; ?>
                        <?php echo isset($msg_presence_error_pseudo_autres)? $msg_presence_error_pseudo_autres:""; ?>
                        <?php echo isset($msg_presence_warning_pseudo_autres)? $msg_presence_warning_pseudo_autres:""; ?>

                        <label  class="col-sm-3 control-label" for="pseudo_autres" >Nom
                        </label>
                        <div class="col-sm-9">
                            <input   class="form-control" type="text" name="pseudo_autres" id="pseudo_autres" value="<?php if (isset($pseudo_autres)) { echo htmlentities($pseudo_autres, ENT_COMPAT,'utf-8');} ?>" oninput="mynameChange()" placeholder="Nom du client si autres en selection dessus" >
                        </div></div>


<!--                    --><?php // if(isset($_GET["program_id"])&& $msg_nom_patient){ ?>
<!--                        <div class="form-group">-->
<!--                            <div class="col-sm-9 col-sm-offset-3">-->
<!--                                --><?php //  echo $msg_nom_patient;?>
<!--                            </div></div>-->
<!--                    --><?php //} ?>

                    <div class="form-group listnompatient">
                        <p class="help-block col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorNomPatient"></p>
                        <?php echo isset($msg_nom_patient)?$msg_nom_patient:""; ?>
                        <?php echo isset($msg_presence_error_nom_patient)? $msg_presence_error_nom_patient:""; ?>
                        <?php echo isset($msg_presence_warning_nom_patient)? $msg_presence_warning_nom_patient:""; ?>


                        <label  class="col-sm-3 control-label" for="nom_patient" id="labelNom_Patient">Tour Nom Patient
                        </label>
                        <div class="col-sm-9">
                            <input  class="form-control"  type="text" name="nom_patient" id="nom_patient"  value="<?php if (isset($nom_patient)) { echo htmlentities($nom_patient, ENT_COMPAT,'utf-8');} ?>" oninput="mypatientChange()" placeholder="Tour Patient insérez nom du patient">
                        </div></div>


                    <!--                    <li style="font-size:0.9em;color:Red" id="errorBonNo"></li>-->


<!--                    --><?php // if(isset($_GET["program_id"])&& $msg_bon_no){ ?>
<!--                        <div class="form-group">-->
<!--                            <div class="col-sm-9 col-sm-offset-3">-->
<!--                                --><?php //  echo $msg_bon_no;?>
<!--                            </div></div>-->
<!--                    --><?php //} ?>

                    <div class="form-group listbonno">
                        <p class="help-block col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorBonNo"></p>
                        <?php echo isset($msg_bon_no)?$msg_bon_no:""; ?>
                        <?php echo isset($msg_presence_error_bon_no)? $msg_presence_error_bon_no:""; ?>
                        <?php echo isset($msg_presence_warning_bon_no)? $msg_presence_warning_bon_no:""; ?>

                        <label  class="col-sm-3 control-label" for="bon_no" id="labelBon_No">Bon No
                        </label>
                        <div class="col-sm-9">
                            <input  class="form-control"  type="text" name="bon_no"  value="<?php if (isset($bon_no)) {
                                echo htmlentities($bon_no, ENT_COMPAT,'utf-8');} ?>" id="bon_no" oninput="mysangChange()" placeholder="Tour Carouge Sang Bon   No">
                        </div></div>

                    <div id="hidelist1">
                        <?php     //todo Add to forms  autocomplete="off" list="liste_address"
                        if(isset($_POST["pseudo"])){
                            $pseudo_list=$_POST["pseudo"];
                        }
                        elseif(isset($_GET["program_id"])){
                            $pseudo_list=$program["pseudo"];
                        }else{
                            $pseudo_list=null;}

                        echo dataliste_address($pseudo_list);  ?>
                    </div>

                    <div class="form-group">
                        <?php echo isset($msg_presence_error_depart)? $msg_presence_error_depart:""; ?>
                        <?php echo isset($msg_presence_warning_depart)? $msg_presence_warning_depart:""; ?>

                        <label  class="col-sm-3 control-label" for="depart">Départ</label>
                        <div class="col-sm-9">
                            <input  class="form-control"  type="text" name="depart" autocomplete="off" list="liste_address" value="<?php if (isset($depart)) {echo htmlentities($depart, ENT_COMPAT,'utf-8');} ?>" id="depart" placeholder="Adresse Depart" >
                        </div></div>


                    <p class="text-center" > <span id="reverse_adresse" class="glyphicon glyphicon-refresh" aria-hidden="true" data-toggle="tooltip" title="Inverse addresse"></span></p>


                    <div class="form-group">
                        <?php echo isset($msg_presence_error_arrivee)? $msg_presence_error_arrivee:""; ?>
                        <?php echo isset($msg_presence_warning_arrivee)? $msg_presence_warning_arrivee:""; ?>

                        <label  class="col-sm-3 control-label" for="arrivee">Arrivée</label>
                        <div class="col-sm-9">
                            <input  class="form-control"  type="text" name="arrivee"  autocomplete="off" list="liste_address" value="<?php if (isset($arrivee)) { echo htmlentities($arrivee, ENT_COMPAT,'utf-8');} ?>" id="arrivee" placeholder="Adresse Arrivee" >
                        </div></div>



                    <div class="form-group">
                        <label  class="col-sm-3 control-label" for="remarque">Remarque</label>
                        <div class="col-sm-9">
                            <textarea  class="form-control" name="remarque" id="remarque"><?php if (isset($remarque)) {                            echo htmlentities($remarque, ENT_COMPAT,'utf-8') ;} ?></textarea>
                        </div></div>



                </fieldset>

                <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                    <button type="submit" name="submit" value="ajouter" class="btn btn-primary">Update</button>
                </div>


                <div class="text-right " >
                    <a href="manage_program.php" class="btn btn-info " role="button">Cancel</a>
                </div>



            </form>
        </div>
    </div>


    <div class="col-md-3 ">
        <?php echo nav_menu_pills_program(); ?>
        <?php  echo  get_output_panel_program('now');?>
        <?php echo nav_menu_pills_program(); ?>
        <?php  echo  get_output_panel_program('yesterday');?>

    </div>

</div>


<?php

unset($GET);
unset($_POST);
?>




<?php include("../includes/layouts/footer_2.php"); ?>
