<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php $client = find_client_by_id($_GET["id"]); ?>


<?php

if (isset($_POST["submit"])){

    $required_fields = array("pseudo", "liste_restrictive","liste_rank");
    validate_presences($required_fields);


    $pseudo=  mysql_prep($_POST["pseudo"]);
    $liste_restrictive= mysql_prep($_POST["liste_restrictive"]);
    $liste_rank= mysql_prep($_POST["liste_rank"]);

    $last_name=  mysql_prep($_POST["last_name"]);
    $first_name=  mysql_prep($_POST["$first_name"]);
    $web_view=  mysql_prep($_POST["$web_view"]);
    $address=  mysql_prep($_POST["$address"]);
    $cp=  mysql_prep($_POST["cp"]);
    $city=  mysql_prep($_POST["city"]);
    $country=  mysql_prep($_POST["country"]);
    $default_price=  mysql_prep($_POST["default_price"]);
    $default_aller=  mysql_prep($_POST["default_aller"]);
    $default_arrivee=  mysql_prep($_POST["default_arrivee"]);

    if (!$web_view ){
        if ($last_name && $first_name){
            $web_view= $last_name ." ".$first_name;
        } else {
            $web_view=$pseudo;

        }
    }



    if (empty($errors)) {

        $id=$client["id"];

        $table="clients";

        $query  = "UPDATE {$table} SET" . " ";
        $query.="pseudo = '{$pseudo}', ";
        $query.="liste_restrictive = {$liste_restrictive}, ";
        $query.="web_view = '{$web_view}', ";
        $query.="last_name = '{$last_name}', ";
        $query.="first_name = '{$first_name}', ";
        $query.="address= '{$address}', ";
        $query.="cp = '{$cp}', ";
        $query.="city = '{$city}', ";
        $query.="country = '{$country}', ";
        $query.="default_price ={$default_price},  ";
        $query.="default_aller = '{$default_aller}', ";
        $query.="default_arrivee = '{$default_arrivee}', ";
        $query.="liste_rank = {$liste_rank} ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";


        $result = mysqli_query($connection, $query);


        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Client updated updated.";
            $_SESSION["OK"] = true;
            unset($_POST);
            redirect_to("manage_client.php");


        } elseif ($result && mysqli_affected_rows($connection) == 0) {
            $_SESSION["message"] = "Client  update failed because no change was made compare to what existed in DB already.";
            unset($_POST);
            redirect_to("manage_client.php");


        } else {
            // Failure
            $_SESSION["message"] = "Client Course update failed.";

        }




    }



}


?>





<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row visible-lg visible-md">
    <h1 class="text-center">Edit client</h1>
    <hr>
</div>


<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">

        <div class ="background_light_blue">




            <div id="page">
                <form name="form_client"  class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo urlencode($client["id"]); ?>">

                    <fieldset id="login" title="Client">
                        <legend class="text-center" style="color: #0000ff">Edit Client</legend>


                        <div class="form-group">
                            <label   class="col-sm-3 control-label" for="pseudo">Pseudo facturation</label>
                            <div class="col-sm-9">
                                <input   class="form-control"  type="text" name="pseudo" id="pseudo" required placeholder="Pseudo du client selon facturation Access" value="<?php echo htmlentities($client["pseudo"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>

                        <div class="form-group">
                            <label   class="col-sm-3 control-label" for="last_name" >Nom</label>
                            <div class="col-sm-9">
                                <input   class="form-control"  type="text" name="last_name" id="last_name"  placeholder="Nom du client" value="<?php echo htmlentities($client["last_name"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>

                        <div class="form-group" >
                            <label   class="col-sm-3 control-label" for="first_name" >Prénom</label>
                            <div class="col-sm-9">
                                <input   class="form-control"  type="text" name="first_name" id="first_name"  placeholder="Nom du client si autres en selection dessus"  value="<?php echo htmlentities($client["first_name"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>

                        <div  class="form-group">
                            <label   class="col-sm-3 control-label" for="web_view" >Nom Web</label>
                            <div class="col-sm-9">
                                <input   class="form-control" type="text" name="web_view" id="web_view"  placeholder="Nom du client à afficher"  value="<?php echo htmlentities($client["web_view"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>



                        <!--                <div class="col-sm-9 col-sm-offset-3">-->
                        <div  class="form-group">

                            <label   class="col-sm-3 control-label" >Liste Restrictive</label>

                            <label class="radio-inline"  for="restrict_no">
                                <input type="radio" name="liste_restrictive" value="0"
                               <?php if ($client["liste_restrictive"] == 0) { echo "checked"; } ?>                                       id="restrict_no"  />
                                Non
                            </label>

                            <label  class="radio-inline"  for="restrict_yes">
                                <input type="radio" name="liste_restrictive" value="1"
                                    <?php if ($client["liste_restrictive"] == 1) { echo "checked"; } ?>
                                       id="restrict_yes"  />
                                Oui
                            </label>
                        </div>




                        <div  class="form-group">
                            <label   class="col-sm-3 control-label" for="liste_rank" >Ordre des données (No)</label>
                            <div class="col-sm-9">
                                <input   class="form-control"  type="number"  min="0" required name="liste_rank" id="liste_rank"  placeholder="Chiffre pour l'ordre"  value="<?php echo htmlentities($client["liste_rank"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>


                    </fieldset>
                    <fieldset id="other" class="hidden" title="Autres Info">
                        <legend>Autres</legend>


                        <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="address" >Adresse du client</label>
                            <div class="col-sm-9">
                                <input  type="text"   name="address" id="address"  placeholder="Adresse du client"  value="<?php echo htmlentities($client["address"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>


                        <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="cp" >Code postale</label>
                            <div class="col-sm-9">
                                <input  type="text"  name="cp" id="cp"  placeholder="Code postale" value="<?php echo htmlentities($client["cp"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>


                        <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="city" >Ville</label>
                            <div class="col-sm-9">
                                <input  type="text"  name="city" id="cp"  placeholder="city" value="<?php echo htmlentities($client["city"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>


                        <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="country" >Pays</label>
                            <div class="col-sm-9">
                                <input  type="text"  name="country" id="cp"  placeholder="Pays"  value="<?php echo htmlentities($client["country"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>


                        <div class="hide form-group" >
                            <label   class="col-sm-3 control-label" for="default_price" >Prix Course par défault</label>
                            <div class="col-sm-9">
                                <input  type="text"   name="default_price" id="default_price"  placeholder="Prix course par défaut" value="<?php echo htmlentities($client["default_price"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>


                        <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="default_aller" >Addresse départ par défaut</label>
                            <div class="col-sm-9">
                                <input  type="text"  name="default_aller" id="default_aller"  placeholder="Addresse départ par défaut" value="<?php echo htmlentities($client["default_aller"],ENT_COMPAT, 'utf-8')  ?>" >
                            </div></div>

                        <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="default_arrivee" >Addresse arrivée par défaut</label>
                            <div class="col-sm-9">
                                <input  type="text"  name="default_arrivee" id="default_arrivee"  placeholder="Addresse arrivée par défaut" value="<?php echo htmlentities($client["default_arrivee"],ENT_COMPAT, 'utf-8')  ?>">
                            </div></div>





                    </fieldset>

                    <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                        <button type="submit" name="submit" class="btn btn-primary">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
                    </div>

                    <div class="text-right " >
                        <a href="manage_client.php" class="btn btn-info " role="button">Cancel</a>
                    </div>



                </form>



            </div>


        </div>


    </div>



    <?php include("../includes/layouts/footer_2.php"); ?>


