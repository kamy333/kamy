<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php
$chauffeur = find_chauffeur_by_id($_GET["id"]);
if (!$chauffeur) {
    // admin ID was missing or invalid or
    // admin couldn't be found in database
    redirect_to("manage_admins.php");
}

?>


<?php if (isset($_POST['submit'])) {

    $required_fields = array( "chauffeur", "initial", "company");
    validate_presences($required_fields);


    $chauffeur_post = mysql_prep($_POST["chauffeur"]);
    $company= mysql_prep($_POST["company"]);
    $initial= mysql_prep(strtoupper(trim($_POST["initial"])));

   // has_max_length($initial,3);


    $id = $chauffeur["id"];

    if (empty($errors)) {


        $query  = "UPDATE chauffeurs SET" . " ";
        $query .= "chauffeur_name = '{$chauffeur_post}' , ";
        $query .= "initial = '{$initial}' , ";
        $query .= "company = '{$company}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Chauffeur successfully updated.";
            $_SESSION["OK"]=true;
            unset( $_POST);
            redirect_to("manage_chauffeur.php");


        } elseif ($result && mysqli_affected_rows($connection) == 0) {
            $_SESSION["message"] = "Chauffeur update failed because no change was made compare to what existed in db already.";

            unset($_POST);
            redirect_to("manage_chauffeur.php");



        } else {
            // Failure
            $_SESSION["message"] = "Chauffeur update failed.";
        }


    }



}

?>




<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=false ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row" id="main">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row visible-lg visible-md">
    <h1>Editer chauffeur</h1>
    <hr>

</div>


<div  class="row">
    <div class="text-left col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1">

        <div class ="background_light_blue-small">

            <form id="myform" class="group" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo urlencode($chauffeur["id"]); ?>" method="post">


                <fieldset id="login" title="Nouveau chauffeur">
                    <legend style="color: #0000ff">Editer Chauffeur</legend>



                    <div class="form-group">
                        <label for="chauffeur">Nom du chauffeur *</label>
                        <input  class="form-control"  type="text" name="chauffeur" id="chauffeur" value="<?php echo htmlentities($chauffeur["chauffeur_name"],ENT_COMPAT,'utf-8') ?>" required>
                    </div>



                    <div class="form-group">
                        <label for="initial">initial</label>
                        <input  class="form-control"  type="text" name="initial" id="initial" value="<?php echo htmlentities($chauffeur["initial"],ENT_COMPAT,'utf-8') ?>" required>
                    </div>


                    <div class="form-group">
                        <label for="company">Company (Transmed Defaut) *</label>
                        <input  class="form-control" type="text" name="company" id="company" value="<?php echo  htmlentities($chauffeur["company"],ENT_COMPAT,'utf-8') ?>" required>
                    </div>



                    <p class="help-block"><strong>Note: </strong>Nom du chauffeur doit être même que le nom complet de l'utilisateur</p>


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
chauffeur
    <?php print_r($chauffeur) ?>
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




<?php include("../includes/layouts/footer_2.php"); ?>
