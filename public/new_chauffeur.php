<?php
/**
 * Created by PhpStorm.User: Kamy Date: 11/1/2014 Time: 10:05 PM
 */
?>
<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>
<?php //require_once("../includes/validation_functions.php"); ?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>




<?php if (isset($_POST['submit'])) {

    $required_fields = array( "chauffeur", "initial", "company");
    validate_presences($required_fields);


    $chauffeur = mysql_prep(trim($_POST["chauffeur"]));
    $company= mysql_prep(trim($_POST["company"]));
    $initial= mysql_prep(strtoupper(trim($_POST["initial"])));

   // has_max_length($initial, 3);

    if (empty($errors)) {

    $query="INSERT INTO chauffeurs (chauffeur_name,initial,company) VALUES ('{$chauffeur}', '{$initial}', '{$company}')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        // Success
        $_SESSION["message"] = "Chauffeur successfully created.";
        $_SESSION["OK"]=true;

        unset( $_POST);
    } else {
        // Failure
        $_SESSION["message"] = "Chauffeur creation failed.";
    }


}



}

?>



<?php $layout_context = "admin"; ?>
<?php  $active_menu="adminNew" ?>
<?php $stylesheets=""  ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row" id="main">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row visible-lg visible-md">
    <h1>Nouveau chauffeur</h1>
    <hr>

</div>


<div  class="row">
    <div class="text-left col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2">

        <div class ="background_light_blue-small">

            <form id="myform" class="group" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


            <fieldset id="login" title="Nouveau chauffeur">
                <legend class="text-center" style="color: #0000ff">New Chauffeur</legend>



                    <div class="form-group">
                        <label for="chauffeur">Nom du chauffeur *</label>
                        <input  class="form-control"  type="text" name="chauffeur" id="chauffeur" value="" required>
                    </div>


                <div class="form-group">
                    <label for="initial">initial</label>
                    <input  class="form-control"  type="text" name="initial" id="initial" value="" required placeholder="initial max. 3 caractère">
                </div>



                <div class="form-group">
                        <label for="company">Company (Transmed Defaut) *</label>
                        <input  class="form-control" type="text" name="company" id="company" value="Transmed" required>
                    </div>




                <p class="help-block"><strong>Note: </strong>Nom du chauffeur doit être même que le nom complet</p>


                <div class="row">
                <div class="text-left col-md-6 col-xs-2" >
                 <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php // echo str_repeat("&nbsp", 30); ?>
                <div class="text-right col-md-6" >
                    <a href="manage_chauffeur.php" class="btn btn-info " role="button">Cancel</a>
                </div>
                </div>

            </fieldset>
        </form>



        </div>
    </div>
</div>







<?php include("../includes/layouts/footer_2.php"); ?>
