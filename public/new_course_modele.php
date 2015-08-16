<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/29/2014
 * Time: 12:49 AM
 */
?>
<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php  ?>

<?php

//TODO complete the data for population

if (isset($_GET)){
            if(!isset($_POST['submit'])) {




            }


}



if (isset($_POST['submit'])) {

    //TODO validate so there is no double modele check client id. heure, day

    $required_fields = array("week_day_rank","client_habituel", "heure","pseudo", "visible");

    validate_presences($required_fields);

        $week_day_rank=mysql_prep( $_POST["week_day_rank"]);
        $client_habituel=mysql_prep($_POST["client_habituel"]);
        $heure = mysql_prep(trim($_POST["heure"]));
        $remarque= mysql_prep(trim($_POST["remarque"]));
        $visible= mysql_prep($_POST["visible"]);


//        if(isset($_POST["chauffeur"])){
//            $chauffeur = mysql_prep($_POST["chauffeur"]);
//        } else {
//            $chauffeur="";
//        }

    $chauffeur = mysql_prep($_POST["chauffeur"]);


    $pseudo= mysql_prep($_POST["pseudo"]);
    $type_transport= mysql_prep(type_transport($pseudo));

    $client=find_client_from_pseudo($pseudo);

        $client_id=$client["id"];

     is_modele_exists($week_day_rank,$client_id,$heure);

    $prix_course=mysql_prep( $_POST["prix_course"]);

    if ($prix_course){
        $prix_course=mysql_prep($client["prix_course"]);
    }

    if (!$prix_course){
        $prix_course=0;
    }

    $depart=mysql_prep(trim($_POST["depart"]));
    $arrivee=mysql_prep(trim($_POST["arrivee"]));


        if (!$depart){
            $depart=mysql_prep(trim($client["default_aller"]));
        }

        if (!$arrivee){
            $arrivee=mysql_prep(trim($client["default_arrivee"]));
        }

        if (!$depart){
            $depart=null;
        }

        if (!$arrivee){
            $arrivee=null;
        }






        $username= mysql_prep($_SESSION['username']);

if (empty($errors)) {

    $table="programmed_courses_modele ";

    $query=" INSERT INTO {$table} ";
    $query.="(";

    $query.="visible, ";
    $query.="week_day_rank, ";
    $query.="client_habituel, ";
    $query.="client_id, ";
    $query.="type_transport, ";

    $query.="heure, ";

  //if(isset($depart)) {
     $query .= "depart, ";
    //}
    //if(isset($arrivee)) {
    $query .= "arrivee, ";
    //}
    $query.="prix_course, ";

   // if(isset($chauffeur)) {
        $query.="chauffeur, ";
   // }

    $query.="remarque, ";
    $query.="username";

    $query.=") ";
    $query.=" VALUES ";
    $query.=" (";

    $query.="{$visible}, ";
    $query.="{$week_day_rank}, ";
    $query.="{$client_habituel}, ";
    $query.="{$client_id}, ";
    $query.="'{$type_transport}', ";
    $query.="'{$heure}', ";

  //  if(isset($depart)) {
        $query .= "'{$depart}', ";
  //  }
    //if(isset($arrivee)) {
        $query .= "'{$arrivee}', ";
    //}
    $query.="{$prix_course}, ";
  //  if(isset($chauffeur)) {
        $query .= "'{$chauffeur}', ";
 //   }
    $query.="'{$remarque}', ";
    $query.="'{$username}'";

    $query.=" )";





    $result = mysqli_query($connection, $query);


    if ($result) {
        // Success
        $_SESSION["message"] = "Modele successfully created.";
        $_SESSION["OK"] = true;
        unset($_POST);
    } else {
        // Failure
        $_SESSION["message"] = "Modele creation failed.";
    }

} else {

}


}


?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="adminNew" ?>
<?php $stylesheets="custom_form"  ?>
<?php $javascript="" // form_course ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>



</div>

<div class="row visible-lg visible-md">

<h1 class="text-center">Nouveau Modèle</h1>

</div>



<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">

        <div class ="background_light_blue">

        <form name="form_modele"   class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">


            <fieldset id="login" title="Course modele ">
                <legend class="text-center" style="color: #0000ff">Nouveau Modèle</legend>



                <div class="form-group">
                    <label   class="col-sm-3 control-label" >Visible</label>

                    <label class="radio-inline" for="Visible_no">
                        <input type="radio" name="visible" value="0"
                            <?php
                            if(isset($_POST["visible"]) && isset($visible)){
                                if ($visible == 0) { echo "checked"; }
                            }
                             ?>
                               id="visible_no"  />
                        Non
                    </label>

                    <label class="radio-inline" for="visible_yes">
                        <input type="radio" name="visible" value="1"
                            <?php
                            if(isset($_POST["visible"]) && isset($visible)){
                                if ($visible == 1) { echo "checked"; }
                            } else {echo "checked";}
                            ?>
                               id="visible_yes"  />
                        Oui
                    </label>

                </div>





                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="week_day_rank">Jour de la semaine*</label>
                    <div class="col-sm-9">
                        <select name="week_day_rank" class="form-control" id="week_day_rank" required onchange="">
                            <?php
                            if (isset($_POST['week_day_rank']) && (isset($week_day_rank))) {
                                echo "<option value='".htmlentities($week_day_rank,ENT_COMPAT,'utf-8') ."' selected>".htmlentities(day_fr($week_day_rank),ENT_COMPAT,'utf-8')."</option>";
                            }  else {
                                echo "<option value='' disabled selected>-- Choisir le jour --</option>";
                            }
                            ?>
                            <?php include("../includes/dataforms/week_day.php"); ?>
                        </select>
                    </div></div>



                <div class="form-group">
                    <label   class="col-sm-3 control-label" >Client habituel</label>


                                <label class="radio-inline" for="client_habituel_no">
                                <input type="radio" name="client_habituel" value="0" id="client_habituel_no"  />
                                Non
                                </label>

                                <label class="radio-inline" for="client_habituel_yes">
                                <input type="radio" name="client_habituel" value="1" checked id="client_habituel_yes"  />
                                Oui
                                </label>



                    </div>




                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="pseudo">Nom du Client</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pseudo" id="pseudo" required >

                            <?php
                            if (isset($_POST['pseudo']) && (isset($pseudo))) {
                                echo "<option value=" . "'".htmlentities($pseudo,ENT_COMPAT,'utf-8') ."'". " selected>".htmlentities($pseudo,ENT_COMPAT,'utf-8')."</option>";
                            }  else {
                                echo "<option value='' disabled selected>-- Choisir le nom du client ou Autres et inscrire Nom --</option>";
                            }
                            echo output_clients_select_list_all();
                            ?>
                        </select>

                    </div></div>




                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="heure">Heure départ</label>
                    <div class="col-sm-9">
                        <select  class="form-control"  name="heure" id="heure" required>
                            <?php
                            if (isset($_POST['heure']) && (isset($heure))) {
                                echo "<option value="."'". htmlentities($heure,ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities(visu_heure($heure),ENT_COMPAT,'utf-8')."</option>";
                            }  else {
                                echo "<option value='' disabled selected>-- Choisir heure de départ --</option>";
                            }
                            ?>
                            <?php include("../includes/dataforms/hournew.php"); ?>
                        </select>
                    </div></div>


                <div>
                    <?php     //todo Add to forms  autocomplete="off" list="liste_address"
                    if(isset($_POST["pseudo"])){
                        $pseudo_list=$_POST["pseudo"];
                    }
                    elseif(isset($_GET["pseudo"])){
                        $pseudo_list=$_GET["pseudo"];
                    }else{
                        $pseudo_list=null;}

                    echo dataliste_address($pseudo_list);  ?>
                </div>



                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="depart">Départ</label>
                    <div class="col-sm-9">
                        <input  type="text" class="form-control"  name="depart" autocomplete="off" list="liste_address" value="<?php if(isset($depart)) {echo $depart;}?>" id="depart" placeholder="Adresse Depart"  >
                    </div></div>

                <p class="text-center" > <span id="reverse_adresse" class="glyphicon glyphicon-refresh" aria-hidden="true" data-toggle="tooltip" title="Inverse addresse"></span></p>


                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="arrivee">Arrivée</label>
                    <div class="col-sm-9">
                        <input  type="text" class="form-control"  name="arrivee" autocomplete="off" list="liste_address" value="<?php  if(isset($arrivee)) { echo htmlentities($arrivee) ;}?>" id="arrivee" placeholder="Adresse Arrivee"  >
                    </div></div>

                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="prix_course">Prix Course</label>
                    <div class="col-sm-9">
                        <input  type="text"  class="form-control"  name="prix_course"  value="<?php if(isset($prix_course)) {echo  $prix_course;}?>" id="prix_course" placeholder="Prix Course"  >
                    </div></div>

                    <?php if (isset($_POST['chauffeur'])){$chauffeur= $_POST['chauffeur']; }else {$chauffeur = null;}?>

                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="chauffeur">Nom Chauffeur*</label>
                    <div class="col-sm-9">
                        <select class="chosen-select1"  class="form-control"  name="chauffeur" id="chauffeur">

                            <option value="<?php if(isset($chauffeur)) { echo "'". htmlentities($chauffeur, ENT_COMPAT, 'utf-8')."'" ;}?>" selected><?php if(isset($chauffeur)) { echo htmlentities($chauffeur, ENT_COMPAT, 'utf-8') ;} ?></option>

                            <?php  if( !is_chauffeur()) { ?>
                                <?php echo selection_chauffeurs ($chauffeur); ?>
                            <?php }?>

                        </select>
                    </div></div>

                <div class="form-group">
                        <label  class="col-sm-3 control-label" for="remarque">Remarque</label>
                    <div class="col-sm-9">
                        <textarea name="remarque"  class="form-control"  id="remarque"><?php  if(isset($remarque)) {  echo htmlentities($remarque, ENT_COMPAT, 'utf-8');}?></textarea>
                    </div></div>


            </fieldset>


            <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            </div>

            <div class="text-right " >
                <a href="manage_courses_modele.php" class="btn btn-info " role="button">Cancel</a>
            </div>

        </form>

</div>
</div>
</div>




<!--    -->
<!--<pre>-->
<?php //if(isset($query)) echo ($query); ?>
<!--</pre>-->


<?php include("../includes/layouts/footer_2.php"); ?>
