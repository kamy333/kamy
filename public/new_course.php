<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>

<?php
$today = date("Y-m-d");
$todaytime = date("Y-m-d H:i:s");
$year=(int) date("Y");
$month=date ("M");
?>

<?php if (isset($_POST['submit'])) {

    $required_fields = array("DateCourse", "Chauffeur", "Heure", "AllerRetour","Pseudo","Depart","Arrivee");
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
        $subject = 'Detail de la course par ' . $_POST["Chauffeur"] . " saisie " . $_POST["DateTime"]  ;

        // DateCourse  , Chauffeur  , Heure , AllerRetour , HeureRetour
        // Pseudo , name ,

//Nom_Patient , Bon_No , Depart , Arrivee , Remarque, DateInput, DateTime, DateMonth, DateYear, Type_transport,Prix_Course


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
        //echo "<h1>". $message . "</h1>";

//webmaster@ikamy.ch
        $_POST['emailAddress'] = "nafisspour@bluewin.ch";
        $to = "nafisspour@bluewin.ch";
//$subject = "test";
        $body = $message;

        $headers = "From: " . $_POST['emailAddress'] . "\n";
//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "Content-type: text/plain; charset=utf-8";

//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
//$headers .= 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";


        mail($to,$subject,$body,$headers);




        $datecourse = mysql_prep($_POST["DateCourse"]);
        //$datecourse=strftime("%Y-%m-%d",$_POST["DateCourse"]);

        // to find throught queries and check if client exists
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



        $query="INSERT INTO courses (validated,programed,invoiced,course_date,client_id,pseudo,pseudo_autres,heure,heure_retour,aller_retour,aller_retour1,chauffeur,depart,arrivee,type_transport,autres_prestations,prix_course,nom_patient,bon_no,remarque, username, user_id , user_fullname) VALUES  (0,0,0,'{$datecourse}',{$client_id},'{$pseudo}','{$pseudo_autres}','{$heure_aller}', '{$heure_retour}','{$aller_retour}',{$aller_retour1},'{$chauffeur}','{$depart}','{$arrivee}','{$type_transport}','{$autres_prestations}', {$prix_course},'{$nom_patient}', '{$bon_no}', '{$remarque}', '{$username}', {$user_id}, '{$user_fullname}')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success
            $_SESSION["message"] = "Course successfully created.";
            $_SESSION["OK"]=true;
            unset( $_POST);
        } else {
            // Failure
            $_SESSION["message"] = "Course creation failed.";
        }


        //the code below is for when we want to add the return record

        /*If ($aller_retour1==1){
                $query="INSERT INTO courses (year,month,validated,programed,invoiced,course_date,client_id,pseudo,pseudo_autres,heure,heure_retour,aller_retour,aller_retour1,chauffeur,depart,arrivee,type_transport,autres_prestations,prix_course,nom_patient,bon_no,remarque, username, user_id , user_fullname) VALUES  ({$year},'{$month}',0,0,0,'{$datecourse}',{$client_id},'{$pseudo}','{$pseudo_autres}','{$heure_retour}', '','Retour',{$aller_retour1},'{$chauffeur}','{$arrivee}','{$depart}','{$type_transport}','{$autres_prestations}', {$prix_course},'{$nom_patient}', '{$bon_no}', '{$remarque}', '{$username}', {$user_id}, '{$user_fullname}')";
            $result = mysqli_query($connection, $query);

            if ($result) {
              // Success
              $_SESSION["message"] .= " with return.";
            } else {
              // Failure
              $_SESSION["message"] .= " Returned failed.";
            }

            }*/


        //redirect_to("thanks_admin.php");

    }


} //if (isset($_POST['submit']
?>



<?php $layout_context = "admin"; ?>
<?php $active_menu="adminNew" ?>
<?php $stylesheets=""  ?>
<?php $javascript="form_course" // form_course ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>



<?php if (isset($_POST['DateCourse'])){$datecourse= $_POST['DateCourse']; }else {$datecourse = date("Y-m-d");}?>
<?php if (isset($_POST['Chauffeur'])){$chauffeur= $_POST['Chauffeur']; }else {$chauffeur = $_SESSION['nom'];}?>
<?php if (isset($_POST['Heure'])){$heure_aller= $_POST['Heure']; $heure_aller_visu=visu_heure($heure_aller); }else {$heure_aller =null;}?>
<?php if (isset($_POST['AllerRetour'])){
$aller_retour= $_POST['AllerRetour'];
if ($aller_retour=="AllerSimple"){$aller_retour_visu='Aller Simple'; } else {$aller_retour_visu='Aller Retour';}
    }else {
$aller_retour =null;}?>

<?php
if (isset($_POST['HeureRetour'])){
    if($aller_retour=="AllerSimple")
        {$heure_retour=null;
        }else {
        $heure_retour= $_POST['HeureRetour'];
        $heure_retour_visu=visu_heure($heure_retour);
         }
}else {
$heure_retour =null;
}?>

<?php if (isset($_POST['Pseudo'])){$pseudo= $_POST['Pseudo']; }else {$pseudo =null;}?>
<?php if (isset($_POST['name'])){$pseudo_autres= $_POST['name']; }else {$pseudo_autres =null;}?>
<?php if (isset($_POST['Nom_Patient'])){$nom_patient= $_POST['Nom_Patient']; }else {$nom_patient =null;}?>
<?php if (isset($_POST['Bon_No'])){$bon_no= $_POST['Bon_No']; }else {$bon_no =null;}?>
<?php if (isset($_POST['Depart'])){$depart= $_POST['Depart']; }else {$depart =null;}?>
<?php if (isset($_POST['Arrivee'])){$arrivee= $_POST['Arrivee']; }else {$arrivee =null;}?>
<?php if (isset($_POST['Remarque'])){$remarque= $_POST['Remarque']; }else {$remarque =null;}?>

<?php //echo htmlentities($datecourse, ENT_COMPAT, 'utf-8')-"<br>"; ?>
<?php // echo htmlentities($chauffeur, ENT_COMPAT, 'utf-8')-"<br>"; ?>
<?php //if ( isset($type_transport)){ echo $type_transport ; }?>



<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row visible-lg visible-md">
    <h1 class="text-center">Nouvelle course</h1>
    <hr>
</div>


<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">


        <div class ="background_light_blue">


        <form name="form1" id="" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <fieldset id="login" title="Course">
                <legend class="text-center" style="color: #0000ff">Nouvelle course</legend>


<div class="form-group">
<label class="col-sm-3 control-label" for="DateCourse">Date Course</label>
    <div class="col-sm-9">
<input  class="form-control"  type="date" name="DateCourse" id="DateCourse" value="<?php echo htmlentities($datecourse, ENT_COMPAT, 'utf-8') ; ?>"
pattern="\d{4}-\d{2}-\d{2}" title="YYYY-MM-DD" required>
</div></div>

<div class="form-group">
<label class="col-sm-3 control-label" for="Chauffeur">Nom Chauffeur</label>
    <div class="col-sm-9">
<select  class="form-control"  name="Chauffeur" id="Chauffeur" required>


<option value="<?php echo htmlentities($chauffeur, ENT_COMPAT, 'utf-8') ;?>" selected>
<?php echo htmlentities($chauffeur, ENT_COMPAT, 'utf-8') ;?></option>

<?php  if( !is_chauffeur()) { ?>
<?php echo selection_chauffeurs ($chauffeur); ?>
<?php }?>

</select>
                        </div>
</div>


<div class="form-group">
<label  class="col-sm-3 control-label"  for="Heure">Heure départ</label>
    <div class="col-sm-9">
<select  class="form-control"  name="Heure" id="Heure" required>
    <?php
    if (isset($_POST['heure']) && (isset($heure)) && isset( $heure_aller_visu)) {
        echo "<option value="."'". htmlentities($heure_aller,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities(visu_heure($heure_aller),ENT_COMPAT,'utf-8')."</option>";
    }  else {
        echo "<option value='' disabled selected>Heure de départ </option>";
    }
    ?>
    <?php include("../includes/dataforms/hournew.php"); ?>
</select>
</div></div>



<div class="form-group chosen-results">
<label  class="col-sm-3 control-label" for="AllerRetour">Aller Retour*</label>
    <div class="col-sm-9">
<select  class="form-control" name="AllerRetour" id="AllerRetour" required onchange="myheureRetourchange()">
    <?php
    if (isset($_POST['AllerRetour']) && (isset($aller_retour)) && isset( $aller_retour_visu)) {
        echo "<option value="."'". htmlentities($aller_retour,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities(visu_heure($aller_retour_visu),ENT_COMPAT,'utf-8')."</option>";
    }  else {
        echo "<option value='' disabled selected>Aller simple ou Aller Retour</option>";
    }
    ?>


<?php if (!isset($_POST['AllerRetour'])) { ?>
<option value='AllerSimple'>Aller Simple</option>
<option value='AllerRetour'>Aller Retour</option>
<?php } elseif ($aller_retour=="AllerSimple") { ?>
<option value='AllerRetour'>Aller Retour</option>
<?php } else { ?>
<option value='AllerSimple'>Aller Simple</option>
<?php } ?>

</select>
</div></div>

<!--                    <li style="font-size:0.9em;color:#ff0000" id="errorMessageHeure1"></li>-->


            <div class="form-group listheureretour">
                <p class="help-block col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorMessageHeure"></p>
                <label  class="col-sm-3 control-label" for="HeureRetour" id="LabelHeureRetour">Heure Retour
                </label>
                <div class="col-sm-9">
                    <select  class="form-control"  name="HeureRetour" id="HeureRetour" onchange="myheureRetourchange()" >
                        <?php
                        if (isset($_POST['HeureRetour']) && (isset($heure_retour)) && isset( $heure_retour_visu)) {
                            echo "<option value="."'". htmlentities($heure_retour,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities(visu_heure($heure_retour),ENT_COMPAT,'utf-8')."</option>";
                        }  else {
                            echo "<option value='' disabled selected>Choisir l'heure retour si Aller Retour</option>";
                        }
                        ?>
                        <option value="" ></option>
                        <option value = 'NA'>NA</option>

                        <?php include("../includes/dataforms/hournew.php"); ?>
                    </select>
                </div></div>




            <div class="form-group">
                <label  class="col-sm-3 control-label" for="Pseudo">Nom du Client</label>
                <div class="col-sm-9">
                    <select  class="form-control"  name="Pseudo" id="Pseudo" required onchange="mypseudochange()">

                        <?php if (isset($_POST['Pseudo']) && (isset($pseudo))) {
                            echo "<option value="."'". htmlentities($pseudo,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities($pseudo,ENT_COMPAT,'utf-8')."</option>";
                        }  else {
                            echo "<option value='' disabled selected>Ciient pseudo</option>";
                            echo output_clients_select_list_all();
                        }
                        ?>
                    </select>
                </div></div>


<!--                    <p style="font-size:0.9em;color:#ff0000;" id="errorMessagePseudo"></p>-->

<div class="form-group listnom">
<p class="help-block col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorMessagePseudo"></p>
<label  class="col-sm-3 control-label" for="name" id="LabelName">Nom
</label>
    <div class="col-sm-9">
<input   class="form-control" type="text" name="name" id="name" value="<?php echo $pseudo_autres;?>" oninput="mynameChange()" placeholder="Nom du client si autres en selection dessus" >
</div></div>

<!--                    <li style="font-size:0.9em;color:#ff0000;" id="errorNomPatient"></li>-->

<div class="form-group listnompatient">
<p class="help-block col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorNomPatient"></p>
<label  class="col-sm-3 control-label" for="Nom_Patient" id="labelNom_Patient">Tour Nom Patient
</label>
    <div class="col-sm-9">
<input  class="form-control"  type="text" name="Nom_Patient" id="Nom_Patient"  value="<?php echo $nom_patient;?>" oninput="mypatientChange()" placeholder="Tour Patient insérez nom du patient">
</div></div>


<!--                    <li style="font-size:0.9em;color:Red" id="errorBonNo"></li>-->

<div class="form-group listbonno">
<p class="help-block col-sm-offset-2" style="font-size:0.9em;color:#ff0000" id="errorBonNo"></p>
<label  class="col-sm-3 control-label" for="Bon_No" id="labelBon_No">Bon No
</label>
    <div class="col-sm-9">
<input  class="form-control"  type="text" name="Bon_No"  value="<?php echo $bon_no;?>" id="Bon_No" oninput="mysangChange()" placeholder="Tour Carouge Sang Bon   No">
</div></div>

<div class="form-group">
<label  class="col-sm-3 control-label" for="Depart">Départ</label>
    <div class="col-sm-9">
<input  class="form-control"  type="text" name="Depart" autocomplete="off" list="liste_address" value="<?php echo $depart;?>" id="Depart" placeholder="Adresse Depart" required >
</div></div>


<div id="hidelist1">
<?php     //todo Add to forms  autocomplete="off" list="liste_address"
if(isset($_POST["Pseudo"])){
$pseudo_list=$_POST["Pseudo"];
}
elseif(isset($_GET["Pseudo"])){
$pseudo_list=$_GET["Pseudo"];
}else{
$pseudo_list=null;}

echo dataliste_address($pseudo_list);  ?>
</div>




<div class="form-group">
<label  class="col-sm-3 control-label" for="Arrivee">Arrivée</label>
<div class="col-sm-9">
<input  class="form-control"  type="text" name="Arrivee"  autocomplete="off" list="liste_address" value="<?php echo $arrivee;?>" id="Arrivee" placeholder="Adresse Arrivee" required >
</div></div>



<div class="form-group">
<label  class="col-sm-3 control-label" for="Remarque">Remarque</label>
    <div class="col-sm-9">
<textarea  class="form-control" name="Remarque" id="Remarque"><?php echo $remarque;?></textarea>
</div></div>


<div id="hidelist2">
<p><input  type="hidden" name="DateInput" id="DateInput" value="<?php echo $today; ?>"></p>
<p><input  type="hidden" name="DateTime" id="DateTime" value="<?php echo $todaytime; ?>"></p>
<p><input  type="hidden" name="DateMonth" id="DateMonth" value="<?php echo $month; ?>"></p>
<p><input  type="hidden" name="DateYear" id="DateYear" value="<?php echo $year; ?>"></p>
<p><input  type="hidden" name="Type_transport" id="Type_transport" value="Standard"></p>
<p><input  type="hidden" name="Prix_Course" id="Prix_Course" value=0></p>
<p><input  type="hidden" name="useradmin_name" id="useradminname" value="<?php echo $_SESSION['nom'];?>"></p>
<p><input  type="hidden" name="admin_id" id="admin_id" value="<?php echo $_SESSION['admin_id'];?>"></p>
</div>

</fieldset>

    <div class="col-sm-offset-3 col-sm-7 col-xs-3">
        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
    </div>

    <div class="text-right " >
        <a href="admin.php" class="btn btn-info " role="button">Cancel</a>
    </div>




        </form>
        </div>
    </div>
</div>



<?php include("../includes/layouts/footer_2.php"); ?>

