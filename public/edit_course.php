<?php require_once('../includes/initialize.php'); ?>


<?php confirm_logged_in(); ?>

<?php $course= find_course_by_id($_GET['id']);

if (!$course) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("admin.php");
}
?>
<?php
$today = date("Y-m-d");
$todaytime = date("Y-m-d H:i:s");
$year=(int) date("Y");
$month=date ("M");
?>

<?php if (isset($_POST['submit'])) {


    $required_fields = array("DateCourse","Chauffeur", "Heure", "AllerRetour","Pseudo","Depart","Arrivee");


    validate_presences($required_fields);

    $chauffeur = mysql_prep($_POST["Chauffeur"]);

    $pseudo= mysql_prep($_POST["Pseudo"]);
    $pseudo_autres= mysql_prep($_POST["name"]);
    $nom_patient= mysql_prep($_POST["Nom_Patient"]);

    $heure_aller= mysql_prep($_POST["Heure"]);
    $aller_retour= mysql_prep($_POST["AllerRetour"]);

    if (isset($_POST['HeureRetour'])) {
        $heure_retour = mysql_prep($_POST["HeureRetour"]);
    }  else {
        $heure_retour="";
    }

    if ($heure_retour=="NA"){$heure_retour="";}

    $type_transport= type_transport($pseudo);

    validate_pseudo($pseudo,$pseudo_autres,$nom_patient);
    validate_heure($heure_aller,$aller_retour,$heure_retour);
    validate_chauffeur_by_name($chauffeur);
    validation_pseudo_clients($pseudo);


    if (empty($errors)) {

        $to = 'nafisspour@bluewin.ch';
        $subject = 'EDITION Detail de la course par ' . $_POST["Chauffeur"] . " saisie " . $todaytime  ;


        $message=   "Subject:   $subject\r\n";
        $message .= "Date Course:  {$_POST['DateCourse']}\r\n\r\n";
        $message .= "Nom Client:   {$_POST['Pseudo']}\r\n";
        $message .= "Départ de:   {$_POST['Depart']}\r\n";
        $message .= "Arrivée à:   {$_POST['Arrivee']}\r\n";
        $message .= "Aller Retour:   {$_POST['AllerRetour']}\r\n";
        $message .= "Heure:  {$_POST['Heure']}\r\n\r\n";
        $message .= "Heure Retour:  {$_POST['HeureRetour']}\r\n\r\n";
        $message .= "Nom (autres):  {$_POST['name']}\r\n\r\n";
        $message .= "Nom Patient Tour:  {$_POST['Nom_Patient']}\r\n\r\n";
        $message .= "Bon No:  {$_POST['Bon_No']}\r\n\r\n";
        $message .= "Type transport:  {$type_transport}\r\n\r\n";

        $new_remarque=wordwrap($_POST['Remarque'],70);

        if ($_POST['Remarque']) {
            $message .= "Remarque:  {$new_remarque}\r\n";
        }

//webmaster@ikamy.ch
        $_POST['emailAddress'] = "nafisspour@bluewin.ch";
        $to = "nafisspour@bluewin.ch";
//$subject = "test";
        $body = $message;

        $headers = "From: " . $_POST['emailAddress'] . "\n";
        $headers .= "Content-type: text/plain; charset=utf-8";


        mail($to,$subject,$body,$headers);




        $datecourse = mysql_prep($_POST["DateCourse"]);

        $client=find_client_from_pseudo($pseudo);
        $client_id= $client['id'] ;

        if ($aller_retour=="AllerSimple") {
            $aller_retour1=0;
        } else {
            $aller_retour1=1;
        }

        If ($aller_retour1==1){
            $heure_retour= mysql_prep($_POST["HeureRetour"]);

        } else {
            $heure_retour="";
        }

        $depart= mysql_prep($_POST["Depart"]);
        $arrivee= mysql_prep($_POST["Arrivee"]);
        $autres_prestations="";
        $prix_course= mysql_prep($_POST["Prix_Course"]);

        $bon_no= mysql_prep($_POST["Bon_No"]);

        $remarque= mysql_prep($_POST["Remarque"]);


        $username= mysql_prep($_SESSION['username']);
        $user_id= (int) $_SESSION["admin_id"];
        $user_fullname=mysql_prep($_SESSION['nom']);


        $id=$course['id'];



        $query  = "UPDATE courses SET" . " ";
        // $query .= "validated = '{$validated}', ";
        $query .= "pseudo = '{$pseudo}', ";
        $query .= "client_id = {$client_id}, ";
        $query .= "pseudo_autres = '{$pseudo_autres}', ";
        $query .= "heure = '{$heure_aller}', ";
        $query .= "aller_retour = '{$aller_retour}', ";
        $query .= "aller_retour1 = {$aller_retour1}, ";
        //$query .= "retour_booked = '{}', ";
        $query .= "heure_retour = '{$heure_retour}', ";
        $query .= "chauffeur = '{$chauffeur}', ";
        $query .= "depart = '{$depart}', ";
        $query .= "arrivee = '{$arrivee}', ";
        $query .= "type_transport = '{$type_transport}', ";
        $query .= "autres_prestations = '{$autres_prestations}', ";
        $query .= "prix_course = {$prix_course}, ";
        $query .= "nom_patient = '{$nom_patient}', ";
        $query .= "bon_no = '{$bon_no}', ";
        $query .= "remarque = '{$remarque}', ";
        //  $query .= "input_date = '{$today}', ";
        //  $query .= "year = '{$year}', ";
        //  $query .= "month = '{}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_id = {$user_id} ";
        //  $query .= "user_fullname = '{$user_fullname}', ";
        // $query .= "username_validation = '{$username_validation}', ";
        //  $query .= "date_validation = '{$date_validation}', ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Course updated.";
            $_SESSION["OK"]=true;
            redirect_to("admin.php");
            unset( $_POST);
        } elseif ($result && mysqli_affected_rows($connection) == 0) {
            $_SESSION["message"] = "Course update failed because no change was made compare to what existed in db already.";
            redirect_to("admin.php");
            unset($_POST);

        } else {
            // Failure
            $_SESSION["message"] = "Course update failed.";

        }






    } else {

    }

}



?>

<?php $layout_context = "admin"; ?>
<?php  $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row" id="main">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row">
    <h1>Editer la course</h1>
    <hr>

</div>

<div class="row">

    <div class="col-md-7 col-md-offset-1 col-lg-7 col-lg-offset-1">

        <div class ="background_light_blue">

            <form name="form1" id="" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo urlencode($course["id"]); ?>">


                <?php if(!is_chauffeur()) {?>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label" for="Prix_Course">Prix Course</label>
                        <div class="col-sm-9">
                            <input  type="text" class="form-control" name="Prix_Course" id="Prix_Course" value=
                            " <?php echo htmlentities($course['prix_course'], ENT_COMPAT, 'utf-8');?>">
                        </div>
                    </div>
                <?php  }?>



                <div class="form-group">
                    <label class="col-sm-3 control-label" for="DateCourse">Date Course</label>
                    <div class="col-sm-9">
                        <input  type="date"  class="form-control" name="DateCourse" id="DateCourse" value=
                        "<?php echo htmlentities($course['course_date'], ENT_COMPAT, 'utf-8'); ?>"
                                pattern="\d{4}-\d{2}-\d{2}" title="YYYY-MM-DD" required>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="Chauffeur">Chauffeur</label>
                    <div class="col-sm-9">
                        <select  class="form-control" name="Chauffeur" id="Chauffeur" required>
                            <option value=
                            "<?php echo htmlentities($course['chauffeur'], ENT_COMPAT, 'utf-8');?>"
                             selected>
                            <?php echo htmlentities($course['chauffeur'], ENT_COMPAT, 'utf-8');?>
                            </option>

                            <?php  if( !is_chauffeur()) { ?>
                                <?php echo selection_chauffeurs ($course['chauffeur']); ?>
                            <?php }?>

                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="Heure">Heure départ</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="Heure" id="Heure" required>
                            <option value=
                            "<?php echo htmlentities($course['heure'], ENT_COMPAT, 'utf-8');?>"  selected>
                                <?php echo htmlentities(visu_heure($course['heure']));?></option>

                            <option value = ></option>

                            <?php include("../includes/dataforms/hournew.php"); ?>
                        </select>
                    </div>
                </div>


                <?php

                ?>


                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="AllerRetour">Aller Retour</label>
                    <div class="col-sm-9">
                        <select name="AllerRetour"  class="form-control" id="AllerRetour" required onchange="myheureRetourchange()">
                            <option value="<?php echo htmlentities($course['aller_retour'], ENT_COMPAT, 'utf-8');?>" selected><?php echo htmlentities ( aller_retour_visu( $course['aller_retour']), ENT_COMPAT, 'utf-8');?></option>


                            <option value='AllerSimple'>Aller Simple</option>
                            <option value='AllerRetour'>Aller Retour</option>

                        </select>
                    </div>
                </div>



                <div class="form-group listheureretour">
                    <p class="col-sm-offset-3" style="font-size:0.9em;color:#ff0000" id="errorMessageHeure"></p>
                    <label  class="col-sm-3 control-label" for="HeureRetour" id="LabelHeureRetour">Heure Retour</label>
                    <div class="col-sm-9">
                        <select  class="form-control" name="HeureRetour" id="HeureRetour" onchange="myheureRetourchange()" >
                            <option value="<?php echo htmlentities($course['heure_retour'], ENT_COMPAT, 'utf-8');?>"
                                    selected><?php echo htmlentities (visu_heure($course['heure_retour']));?></option>
                            <option value ="" ></option>
                            <option value = 'NA'>NA</option>
                            <?php include("../includes/dataforms/hournew.php"); ?>
                        </select>


                    </div>
                </div>


                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="Pseudo">Nom Client</label>
                    <div class="col-sm-9">
                        <select  class="form-control" name="Pseudo" id="Pseudo" required onchange="mypseudochange()">
                            <option value="<?php echo htmlentities($course['pseudo'], ENT_COMPAT, 'utf-8');?>" selected><?php echo htmlentities($course['pseudo']);?></option>
                            <?php
                            echo output_clients_select_list_all();
                            ?>

                        </select>
                    </div>
                </div>



                <div class="form-group listnom">
                    <p class="col-sm-offset-3" style="font-size:0.9em;color:#ff0000" id="errorMessagePseudo"></p>

                    <label  class="col-sm-3 control-label" for="name" id="LabelName">Nom</label>
                    <div class="col-sm-9">
                        <input   class="form-control" type="text" value=" <?php echo htmlentities($course['pseudo_autres'], ENT_COMPAT, 'utf-8');?>" name="name" id="name"  placeholder="Nom du client si autres en selection dessus" >
                    </div>
                </div>


                <div class="form-group listnompatient">
                    <p class="col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorNomPatient"></p>

                    <label class="col-sm-3 control-label" for="Nom_Patient" id="labelNom_Patient">Tour Nom Patient</label>
                    <div class="col-sm-9">
                        <input  class="form-control" type="text" value=" <?php echo htmlentities($course['nom_patient'], ENT_COMPAT, 'utf-8');?>" name="Nom_Patient" id="Nom_Patient" oninput="mypatientChange()" placeholder="Tour Patient insérez nom du patient">
                    </div>
                </div>



                <div class="form-group listbonno">
                    <p class="col-sm-offset-3" style="font-size:0.9em;color:#ff0000" id="errorBonNo"></p>

                    <label class="col-sm-3 control-label" for="Bon_No" id="labelBon_No">Bon No</label>
                    <div class="col-sm-9">
                        <input   class="form-control" type="text" value=" <?php echo htmlentities($course['bon_no'], ENT_COMPAT, 'utf-8');?>" name="Bon_No" id="Bon_No"  placeholder="Tour Carouge Sang Bon   No">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label" for="Depart">Départ</label>
                    <div class="col-sm-9">
                        <input  class="form-control" type="text" autocomplete="off" list="liste_address" value=" <?php echo htmlentities($course['depart'], ENT_COMPAT, 'utf-8');?>" name="Depart" id="Depart" placeholder="Adresse Depart" required >
                    </div>
                </div>


                <div id="hidelist1">
                    <?php     //todo Add to forms  autocomplete="off" list="liste_address"
                    if(isset($_POST["Pseudo"])){
                        $pseudo_list=$_POST["Pseudo"];
                    }
                    elseif(isset($course["pseudo"])){
                        $pseudo_list=$course["pseudo"];
                    }else{
                        $pseudo_list=null;}

                    echo dataliste_address($pseudo_list);  ?>
                </div
                    >




                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="Arrivee">Arrivée</label>
                    <div class="col-sm-9">
                        <input  class="form-control" type="text" autocomplete="off" list="liste_address" value=" <?php echo htmlentities($course['arrivee'], ENT_COMPAT, 'utf-8');?>" name="Arrivee" id="Arrivee" placeholder="Adresse Arrivee" required >
                    </div>
                </div>



                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="Remarque">Remarque</label>
                    <div class="col-sm-9">
                        <textarea  class="form-control" name="Remarque" id="Remarque" ><?php echo htmlentities( $course['remarque'], ENT_COMPAT, 'utf-8');?> </textarea>
                    </div>
                </div>


                <div id="hidelist2">
                    <p><input hidden="hidden" type="text" name="DateInput" id="DateInput" value="<?php echo htmlentities($course['input_date'], ENT_COMPAT, 'utf-8');?>"></p>
                    <p><input hidden="hidden" type="text" name="DateMonth" id="DateMonth" value=" <?php echo htmlentities($course['month'], ENT_COMPAT, 'utf-8');?>""></p>
                    <p><input hidden="hidden" type="text" name="DateYear" id="DateYear" value=" <?php echo htmlentities($course['year'], ENT_COMPAT, 'utf-8');?>""></p>
                    <p><input hidden="hidden"  type="text" name="Type_transport" id="Type_transport" value=" <?php echo htmlentities($course['type_transport'], ENT_COMPAT, 'utf-8');?>"></p>
                    <p><input hidden="hidden" type="text" name="useradmin_name" id="useradminname" value=" <?php echo htmlentities($course['username']);?>"></p>
                    <p><input hidden="hidden" type="text" name="admin_id" id="admin_id" value=" <?php echo htmlentities($course['user_id'], ENT_COMPAT, 'utf-8');?>""></p>

                </div>


                <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                    <button type="submit" name="submit" class="btn btn-primary">&nbsp;Edit&nbsp;</button>
                </div>

                <div class="text-right " >
                    <a href="admin.php" class="btn btn-info " role="button">Cancel</a>
                </div>

            </form>
        </div>

    </div>





    <div class="col-md-4 col-lg-4 ">

        <div class ="background_light_pink">

            <dl class="dl-horizontal">
                <?php

                // todo check btw aller retour when validated to user ensure that he may need to change the return

                if($course["validated"]==1 && ($course["aller_retour"]=="AllerRetour" ||$course["aller_retour"]=="Retour")) {
                    if($course["aller_retour"]=="AllerRetour"){

                        echo "<dt>Attention</dt>";
                        echo "<dd><mark>Course <strong> aller </strong> donc il se peut que le <strong> retour </strong> doit aussi etre changé!</mark></dd>";

                    } else {

                        echo "<dt>Attention</dt>";
                        echo "<dd><mark>Course <strong> retour </strong> donc il se peut que l'<strong> aller </strong>doit aussi etre changé!</mark></dd>";

                    }


                    echo "<br>";
                }

                if($course["validated"]==0) {
                    echo "<dt>Validation</dt>";
                    echo "<dd>Course non valide</dd>";
                }  else {
                    echo "<dt>Validation</dt>";
                    echo "<dd>Course Validé</dd>";
                }

                if(!is_chauffeur()){
                    echo "<dt>Prix course</dt>";
                    echo "<dd>".htmlentities($course["prix_course"])." fr.-</dd>";
                }


                echo "<dt>Date course</dt>";
                echo "<dd>".htmlentities($course["course_date"])."</dd>";

                echo "<dt>Chauffeur</dt>";
                echo "<dd>".htmlentities($course["chauffeur"])."</dd>";

                echo "<dt>Pseudo</dt>";
                echo "<dd>".htmlentities($course["pseudo"])."</dd>";

                echo "<dt>Aller_retour</dt>";
                echo "<dd>".htmlentities($course["aller_retour"])."</dd>";

                echo "<dt>Heure aller</dt>";
                echo "<dd>".htmlentities($course["heure"])."</dd>";

                echo "<dt>Heure_retour</dt>";
                echo "<dd>".htmlentities($course["heure_retour"])."</dd>";

                echo "<dt>Adresse Depart</dt>";
                echo "<dd>".htmlentities($course["depart"])."</dd>";

                echo "<dt>Adresse Arrivee</dt>";
                echo "<dd>".htmlentities($course["arrivee"])."</dd>";

                echo "<dt>Type transport</dt>";
                echo "<dd>".htmlentities($course["type_transport"])."</dd>";

                echo "<hr>";

                if($course["pseudo_autres"]) {
                    echo "<dt>Pseudo Autres</dt>";
                    echo "<dd>".htmlentities($course["pseudo_autres"])."</dd>";
                }

                if($course["bon_no"]) {
                    echo "<dt>bon_no</dt>";
                    echo "<dd>".htmlentities($course["bon_no"])."</dd>";
                }

                if($course["nom_patient"]) {
                    echo "<dt>Nom patient</dt>";
                    echo "<dd>" . htmlentities($course["nom_patient"]) . "</dd>";
                }

                if($course["autres_prestations"]) {
                    echo "<dt>Nom patients</dt>";
                    echo "<dd>" . htmlentities($course["autres_prestations"]) . "</dd>";
                }

                if($course["remarque"]) {
                    echo "<dt>Nom patients</dt>";
                    echo "<dd>" . htmlentities($course["remarque"]) . "</dd>";
                }


                ?>

            </dl>
        </div>
    </div>

</div>

<?php if (is_admin()) {?>

    <?php echo str_repeat("<br>", 4); ?>

    <div class="row">
        <div class="col-md-4">

                    <pre>
                 <p><u>Only seen by Admin</u></p>
                        <?php  print_r($course);?>
                     </pre>
        </div>
    </div>
<?php } ?>

<?php include("../includes/layouts/footer_2.php"); ?>

