<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>


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

            $table="clients";

            $query  = "INSERT INTO {$table} (";
            $query.="pseudo, ";
            $query.="liste_restrictive, ";
            $query.="web_view, ";
            $query.="last_name, ";
            $query.="first_name, ";
            $query.="address, ";
            $query.="cp, ";
            $query.="city, ";
            $query.="country, ";
            $query.="default_price, ";
            $query.="default_aller, ";
            $query.="default_arrivee, ";
            $query.="liste_rank ";

            $query .= ") VALUES (";

            $query.="'{$pseudo}', ";
            $query.="{$liste_restrictive}, ";
            $query.="'{$web_view}', ";
            $query.="'{$last_name}', ";
            $query.="'{$first_name}', ";
            $query.="'{$address}', ";
            $query.="'{$cp}', ";
            $query.="'{$city}', ";
            $query.="'{$country}', ";
            $query.="{$default_price}, ";
            $query.="'{$default_aller}', ";
            $query.="'{$default_arrivee}', ";
            $query.="{$liste_rank} ";


            $query .= ")";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Success
                $_SESSION["message"] = "Client created.";
                $_SESSION["OK"]=true;
                redirect_to("manage_client.php");
            } else {
                // Failure
                $_SESSION["message"] = "Client creation failed.";
            }


        }


}


?>





<?php $layout_context = "admin"; ?>
<?php $active_menu="adminNew" ?>
<?php $stylesheets=""  ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
    <?php if(isset($query)){echo $query;} ?>

</div>

<div class="row visible-lg visible-md">
    <h1 class="text-center">Nouveau client</h1>
    <hr>
</div>


<div class="row">
    <div class="col-md-7 col-md-offset-2 col-lg-7 col-lg-offset-2">

        <div class ="background_light_blue">





        <form name="form_client"  class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <fieldset id="login" title="Client">
                <legend class="text-center" style="color: #0000ff">Client</legend>


                <div class="form-group">
                <label   class="col-sm-3 control-label" for="pseudo">Pseudo facturation</label>
                    <div class="col-sm-9">
                    <input   class="form-control"  type="text" name="pseudo" id="pseudo" required placeholder="Pseudo du client selon facturation Access" >
                    </div></div>

                <div class="form-group">
                <label   class="col-sm-3 control-label" for="last_name" >Nom</label>
                        <div class="col-sm-9">
                        <input   class="form-control"  type="text" name="last_name" id="last_name"  placeholder="Nom du client" >
                    </div></div>

                    <div class="form-group" >
                        <label   class="col-sm-3 control-label" for="first_name" >Prénom</label>
                        <div class="col-sm-9">
                        <input   class="form-control"  type="text" name="first_name" id="first_name"  placeholder="Nom du client si autres en selection dessus" >
                    </div></div>

                    <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="web_view" >Nom Web</label>
                        <div class="col-sm-9">
                        <input   class="form-control" type="text" name="web_view" id="web_view"  placeholder="Nom du client à afficher" >
                    </div></div>



<!--                <div class="col-sm-9 col-sm-offset-3">-->
                    <div  class="form-group">

                    <label   class="col-sm-3 control-label" >Liste Restrictive</label>

                    <label class="radio-inline"  for="restrict_no">
                           <input type="radio" name="liste_restrictive" value="0" checked id="restrict_no"  />
                            Non
                            </label>

                            <label  class="radio-inline"  for="restrict_yes">
                           <input type="radio" name="liste_restrictive" value="1" id="restrict_yes"  />
                             Oui
                            </label>
                    </div>




                    <div  class="form-group">
                        <label   class="col-sm-3 control-label" for="liste_rank" >Ordre des données (No)</label>
                        <div class="col-sm-9">
                        <input   class="form-control"  type="number" value="200" min="0" required name="liste_rank" id="liste_rank"  placeholder="Chiffre pour l'ordre" >
                    </div></div>


            </fieldset>
            <fieldset id="other" class="hidden" title="Autres Info">
                <legend>Autres</legend>


                    <div class="hide form-group">
                        <label   class="col-sm-3 control-label" for="address" >Adresse du client</label>
                        <div class="col-sm-9">
                        <input  type="text"   name="address" id="address"  placeholder="Adresse du client" >
                    </div></div>


                    <div class="hide form-group">
                        <label   class="col-sm-3 control-label" for="cp" >Code postale</label>
                        <div class="col-sm-9">
                        <input  type="text"  name="cp" id="cp"  placeholder="Code postale" >
                    </div></div>


                <div class="hide form-group">
                    <label   class="col-sm-3 control-label" for="city" >Ville</label>
                    <div class="col-sm-9">
                        <input  type="text"  name="city" id="cp"  placeholder="city" >
                    </div></div>


                <div class="hide form-group">
                        <label   class="col-sm-3 control-label" for="country" >Pays</label>
                        <div class="col-sm-9">
                        <input  type="text"  name="country" id="cp"  placeholder="Pays" >
                    </div></div>


                    <div class="hide form-group" >
                        <label   class="col-sm-3 control-label" for="default_price" >Prix Course par défault</label>
                        <div class="col-sm-9">
                        <input  type="number" min="0" value="0" name="default_price" id="default_price"  placeholder="Prix course par défaut" >
                    </div></div>


                    <div class="hide form-group">
                        <label   class="col-sm-3 control-label" for="default_aller" >Addresse départ par défaut</label>
                        <div class="col-sm-9">
                        <input  type="text"  name="default_aller" id="default_aller"  placeholder="Addresse départ par défaut" >
                    </div></div>

                    <div class="hide form-group">
                        <label   class="col-sm-3 control-label" for="default_arrivee" >Addresse arrivée par défaut</label>
                        <div class="col-sm-9">
                        <input  type="text"  name="default_arrivee" id="default_arrivee"  placeholder="Addresse arrivée par défaut" >
                    </div></div>





            </fieldset>



            <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            </div>

            <div class="text-right " >
                <a href="manage_client.php" class="btn btn-info " role="button">Cancel</a>
            </div>



        </form>



    </div>


</div>


   </div>



<?php include("../includes/layouts/footer_2.php"); ?>


