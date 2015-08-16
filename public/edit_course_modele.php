<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/30/2014
 * Time: 5:55 AM
 */
?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php

$query_string="?".$_SERVER['QUERY_STRING'];
if (isset($_GET["url"])) {
    $url=$_GET["url"];
} else {
    $url="manage_courses_modele.php".$query_string;

}






if (!isset($_GET["modele_id"])) {
    $_SESSION["message"] = "Fatal error edit modele call administrator modele id";
   redirect_to($url);
}

//if (!isset($_GET["clientid"])) {
//    $_SESSION["message"] = "Fatal error edit modele call administrator client id";
//    redirect_to($url);
//}
//?>



<?php
//we can remove the get variable only $_GET["modeleid"]
$modele = find_modele_by_id ($_GET["modele_id"]);
$client= find_client_by_id($modele["client_id"]);



if (!$client || !$modele ) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    $_SESSION["message"] = "Fatal error edit modele call administrator database client id";
    redirect_to($url);
}
?>


<?php




if(isset($_POST['submit'])) {
    $required_fields = array("week_day_rank","client_habituel", "heure","pseudo", "visible");
    validate_presences($required_fields);


    $week_day_rank=mysql_prep( $_POST["week_day_rank"]);
    $client_habituel=mysql_prep($_POST["client_habituel"]);
    $heure = mysql_prep($_POST["heure"]);
    $remarque= mysql_prep(trim($_POST["remarque"]));
    $visible= mysql_prep($_POST["visible"]);




    if(isset($_POST["chauffeur"])){
        $chauffeur = mysql_prep($_POST["chauffeur"]);
    } else {

        $chauffeur=null;
    }


    $pseudo= mysql_prep($_POST["pseudo"]);
   $type_transport= mysql_prep(type_transport($pseudo));



    $client_new=find_client_from_pseudo($pseudo);

    $client_id=$client_new["id"];

    $depart=mysql_prep($_POST["depart"]);
    $arrivee=mysql_prep($_POST["arrivee"]);
    $prix_course=mysql_prep($_POST["prix_course"]);


//    if (!$depart){
//        $depart=mysql_prep($client_new["default_aller"]);
//    }
//
//    if (!$arrivee){
//        $arrivee=mysql_prep($client_new["default_arrivee"]);
//    }

    if (!$depart){
        $depart=null;
    }

    if ($arrivee==''){
        $arrivee=null;
    }


    $prix_course=mysql_prep( $_POST["prix_course"]);


//    if ($prix_course){
//        $prix_course=mysql_prep($client["prix_course"]);
//    }

    if (!$prix_course){
        $prix_course=0;
    }


    // to do if not
    $username= mysql_prep($_SESSION['username']);

    if($modele["week_day_rank"]!= $_POST["week_day_rank"]
    || $modele["client_id"]!= $client_new["id"]
    && $modele["heure"]!= $_POST["heure"]

    ){

        is_modele_exists($week_day_rank,$client_id,$heure);

}





//    $type_transport

    $id=$modele["id"];

if (empty($errors)) {

$query = "UPDATE programmed_courses_modele SET" . " ";
$query .= "visible = {$visible}, ";
$query .= "week_day_rank = {$week_day_rank}, ";
$query .= "client_habituel = {$client_habituel}, ";
$query .= "client_id = {$client_id}, ";
$query .= "type_transport = '{$type_transport}', ";


$query .= "heure = '{$heure}', ";

    if($depart){
    $query .= "depart = '{$depart}', ";
    } else {
     $query .= "depart = '', ";
    }

    if ($arrivee){
        $query .= "arrivee = '{$arrivee}', ";

    } else {
        $query .= "arrivee = '', ";
    }



$query .= "prix_course = {$prix_course}, ";
$query .= "chauffeur = '{$chauffeur}', ";
$query .= "remarque = '{$remarque}', ";
$query .= "username = '{$username}' ";
$query .= "WHERE id = {$id} ";
$query .= "LIMIT 1";



    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
        // Success
        $_SESSION["message"] = "Modèle Course updated.";
        $_SESSION["OK"] = true;
         unset($_POST);
      redirect_to($url);


    } elseif ($result && mysqli_affected_rows($connection) == 0) {
        $_SESSION["message"] = "Modèle Course update failed because no change was made compare to what existed in DB already.";
        unset($_POST);
        redirect_to($url);


    } else {
        // Failure
        $_SESSION["message"] = "Modèle Course update failed.";

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

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>


<div class="row visible-lg visible-md">
    <h1>Editer le modele</h1>
    <hr>

</div>



<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">

        <div class ="background_light_blue">

        <form name="form1"  id="frmCourse" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?modele_id=<?php echo urlencode($modele["id"]); ?>">

<!--        <form  id="" class="group" method="post" action="new_course_modele.php">-->


            <fieldset id="login" title="Course modele ">
                <legend class="text-center" style="color: #0000ff">Modele course</legend>

                <div class="form-group">
                    <label   class="col-sm-3 control-label" >Visible</label>

                    <label class="radio-inline" for="Visible_no">
                        <input type="radio" name="visible" value="0"
                            <?php if ($modele["visible"] == 0) { echo "checked"; } ?>
                               id="visible_no"  />
                        Non
                    </label>

                    <label class="radio-inline" for="visible_yes">
                        <input type="radio" name="visible" value="1"
                            <?php if ($modele["visible"] == 1) { echo "checked"; } ?>
                               id="visible_yes"  />
                        Oui
                    </label>

                </div>




                <div  class="form-group">
                    <label   class="col-sm-3 control-label" for="week_day_rank">Jour de la semaine*</label>
                    <div class="col-sm-9">
                        <select name="week_day_rank"  class="form-control"  id="week_day_rank" required onchange="">
                            <option value=
                            "<?php echo htmlentities($modele['week_day_rank']) ?>">
                            <?php echo htmlentities(day_fr($modele['week_day_rank'],ENT_COMPAT,'utf-8')); ?>
                            </option>
                            <?php include("../includes/dataforms/week_day.php"); ?>
                        </select>
                    </div></div>





                <div class="form-group">
                    <label   class="col-sm-3 control-label" >Client habituel</label>

                    <label class="radio-inline" for="client_habituel_no">
                        <input type="radio" name="client_habituel" value="0"
                            <?php if ($modele["client_habituel"] == 0) { echo "checked"; } ?>
                               id="client_habituel_no"  />
                        Non
                    </label>

                    <label class="radio-inline" for="client_habituel_yes">
                        <input type="radio" name="client_habituel" value="1"
                            <?php if ($modele["client_habituel"] == 1) { echo "checked"; } ?>
                               id="client_habituel_yes"  />
                        Oui
                    </label>



                </div>




                <div  class="form-group">
                    <label   class="col-sm-3 control-label" for="pseudo">Nom du Client*</label>
                    <div class="col-sm-9">
                        <select  class="form-control"  name="pseudo" id="pseudo" required onchange="">

                            <option value="<?php echo htmlentities($client['pseudo'],ENT_COMPAT,'utf-8') ?>">
                                <?php echo htmlentities($client['web_view'],ENT_COMPAT,'utf-8') ?>
                            </option>



                            <?php
                            echo output_clients_select_list_all();
                            //include("../includes/dataforms/client.php");
                            ?>
                        </select>
                    </div></div>



                <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="heure">Heure départ*; </label>
                    <div class="col-sm-9">
                        <select  class="form-control"  name="heure" id="heure" required>
                            <option value="<?php echo htmlentities($modele['heure'],ENT_COMPAT,'utf-8') ?>">
                            <?php echo htmlentities(visu_heure($modele['heure']),ENT_COMPAT,'utf-8') ?>
                            </option>


                            <?php include("../includes/dataforms/hournew.php"); ?>
                        </select>
                    </div></div>


                <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="depart">Départ</label>
                    <div class="col-sm-9">
                        <input  type="text"  class="form-control" name="depart" autocomplete="off" list="liste_address"   value="<?php echo htmlentities(trim($modele['depart']),ENT_COMPAT,'utf-8') ?>" id="depart" placeholder="Adresse Depart"  >
                    </div></div>




                <div>
                    <?php     //todo Add to forms  autocomplete="off" list="liste_address"
                    if(isset($_POST["pseudo"])){
                        $pseudo_list=$_POST["pseudo"];

                    } elseif(isset($_GET["pseudo"])){
                        $pseudo_list=$_GET["pseudo"];

                    } elseif(isset($client['pseudo'])){
                        $pseudo_list=$client['pseudo'];

                    }else{
                        $pseudo_list=null;}

                    echo dataliste_address($pseudo_list);  ?>
                </div>





                <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="arrivee">Arrivée</label>
                    <div class="col-sm-9">
                        <input  type="text"  class="form-control" name="arrivee"  autocomplete="on" list="liste_address" value="<?php echo htmlentities(trim($modele['arrivee']),ENT_COMPAT,'utf-8') ?>" id="arrivee" placeholder="Adresse Arrivee"  >
                    </div></div>

                <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="prix_course">Prix Course</label>
                    <div class="col-sm-9">
                        <input  type="text"  class="form-control" name="prix_course"  value=
                            "<?php echo (int) trim($modele['prix_course']) ?>"
                         id="prix_course" placeholder="Prix Course"  >
                    </div></div>

<!--                    --><?php //if (isset($_POST['chauffeur'])){$chauffeur= $_POST['chauffeur']; } else { $chauffeur = $_SESSION['nom'];}?>
<!--                    --><?php //if (!$modele['chauffeur']){$chauffeur= $_SESSION['nom']; } else {$chauffeur = $modele['chauffeur'];}?>

                <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="chauffeur">Nom Chauffeur*</label>
                    <div class="col-sm-9">
                        <select class="form-control"  name="chauffeur" id="chauffeur"  >
                             <option value=
                            "<?php echo htmlentities($modele['chauffeur'],ENT_COMPAT,'utf-8') ?>">

                             <?php echo htmlentities($modele['chauffeur'],ENT_COMPAT,'utf-8') ?>
                            </option>


                            <?php  if( !is_chauffeur()) { ?>
                                <?php if (isset($chauffeur)) {echo selection_chauffeurs($chauffeur);
                                } else {echo selection_chauffeurs();} ?>
                            <?php }?>

                        </select>
                    </div></div>


                <div  class="form-group">
                        <label  class="col-sm-3 control-label" for="remarque">Remarque</label>
                    <div class="col-sm-9">
                        <textarea name="remarque"  class="form-control"  id="remarque">
                            <?php echo htmlentities(trim($modele['remarque']),ENT_COMPAT,'utf-8') ?>
                        </textarea>
                    </div></div>
            </fieldset>

            <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
            </div>

            <div class="text-right " >
                <a href="<?php if(isset($url)){echo $url;} ?>" class="btn btn-info " role="button">Cancel</a>
            </div>
        </form>

    </div>
</div>
</div>


<?php if (is_admin()) {?>
<?php echo str_repeat("<br>", 5); ?>


<div class="row">

<div class="col-md-3">
<pre>
 post
<?php if(isset($_POST)){print_r($_POST);}  ?>
</pre>
</div>


<div class="col-md-3">
<pre>
modele
<?php print_r($modele) ?>
</pre>
</div>


    <div class="col-md-3">
<pre>
client
    <?php print_r($client); ?>
</pre>
    </div>

    <div class="col-md-3">
<pre>
client New
    <?php if(isset($query)) { print_r($client);} ?>
</pre>
    </div>
</div>
<hr>

    <div class="col-md-12">
<pre>
query
<?php if(isset($query)) {echo $query;} ?>
  </pre>
</div>

<?php } ?>









<?php echo str_repeat("<br>", 30); ?>
<?php include("../includes/layouts/footer_2.php"); ?>
