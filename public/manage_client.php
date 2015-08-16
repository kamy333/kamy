<?php require_once('../includes/initialize.php'); ?>


<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php

$query_all=true;

$pseudo=null;
$liste_restrictive=null;
$web_view=null;
$last_name=null;
$first_name=null;
$address=null;
$liste_rank=null;
$query_recherche=false;

if(isset($_GET['submit'])){



    if (ISSET($_GET['pseudo']))   {
        $pseudo=$_GET['pseudo'];
        $query_recherche=true;
    }

    if (ISSET($_GET['liste_restrictive']))   {
        $liste_restrictive=$_GET['liste_restrictive'];
        $query_recherche=true;
    }

    if (ISSET($_GET['web_view']))   {
        $web_view=$_GET['web_view'];
        $query_recherche=true;
    }

    if (ISSET($_GET['last_name']))   {
        $last_name=$_GET['last_name'];
        $query_recherche=true;
    }
    if (ISSET($_GET['first_name']))   {
        $first_name =$_GET['first_name'];
        $query_recherche=true;
    }

    if (ISSET($_GET['address']))   {
        $address  =$_GET['address'];
        $query_recherche=true;
    }

    if (ISSET($_GET['liste_rank']))   {
        $liste_rank  =$_GET['liste_rank'];
        $query_recherche=true;
    }


}


?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="manage_client" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php if(isset($errors)) echo form_errors($errors); ?>

</div>

    <div class="row">

        <div class="col-md-4 col-md-offset-3">
        <h3  class="page-header text-center" >Manage Clients</h3>
         </div>


    <div class="col-md-2  ">
        <div class="btn-group">
            <button type="button" class="btn btn-danger">Action</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li class="a-rech" id="button_recherche_voir"><a href="#">Recherche Avancée</a></li>
                <li class="a-rech" id="button_recherche_cache"><a href="#">Cacher Recherche Avancée</a></li>

                <li class="a-rech divider"></li>
                <li class="a-rech" id="show-row-all"><a href="#">show all</a></li>
                <li class="a-rech" id="show-row-success"><a href="#">show valid success</a></li>
                <li class="a-rech" id="show-row-danger"><a href="#">show valid danger</a></li>
                <li class="a-rech" id="show-row-others"><a href="#">show others</a></li>
                <li class="a-rech divider "></li>
                <li class="a-rech" id="hide-row-success"><a href="#">Cacher valid success</a></li>
                <li class="a-rech" id="hide-row-danger"><a href="#">Cacher valid danger</a></li>
                <li class="a-rech" id="hide-row-others"><a href="#">cacher others</a></li>
            </ul>

        </div>
    </div>

</div>






        <div id="form_recherche" class="background_light_blue">

        <div class="row">
            <div class="col-md-10 col-lg-offset-2 col-md-10 col-lg-offset-2 ">

        <form class="form-inline " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <fieldset>
             <legend>Recherche de clients</legend>

                <div class="row">
<!--                    <div class="col-md-10 col-lg-offset-2 col-md-10 col-lg-offset-2 ">-->

                    <?php echo choisir_distinct_form('pseudo',"clients");?>
                <?php echo choisir_distinct_form('liste_restrictive',"clients");?>
                <?php echo choisir_distinct_form('web_view',"clients");?>
                </div>
<!--            </div>-->

                <div class="row">
<!--                    <div class="col-md-10 col-lg-offset-2 col-md-10 col-lg-offset-2 ">-->

                    <?php echo choisir_distinct_form('last_name',"clients");?>
                <?php echo choisir_distinct_form('first_name',"clients");?>
                <?php echo choisir_distinct_form('liste_rank',"clients");?>
            </div>
<!--            </div>-->

                <div class="row">
<!--                    <div class="col-md-10 col-lg-offset-2 col-md-10 col-lg-offset-2 ">-->
                    <?php echo choisir_distinct_form('address',"clients");?>
                </div>
<!--                </div>-->

                <div class="row">
                    <div class="col-md-4 col-lg-offset-1 col-md-4 col-lg-offset-1 ">
                    <button  type="submit" name="submit" class="btn btn-info btn-block">Chercher</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
    </div>
    </div>

<br>

<div class="panel panel-default col-md-12"  id="mes_courses">
    <!-- Default panel contents -->
    <div class="panel-heading">


<!--        <div id="mes_courses">-->
            <?php
            $output="";

            $sp="<span style='color: #0000ff'><strong>";
            $spe="</strong></span>";

            $text=null;
            if(isset($_GET['submit'])){
                $text =  "<span><a href='manage_client.php'>Clients <span class='glyphicon glyphicon-zoom-out' aria-hidden='true'></span></a></span>";

            } else {
                $text =  "<span >Tous les clients <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></span>";
            }
            if(isset($_GET['submit'])){
                if(isset($_GET['pseudo'])){$output.="Client: {$sp} {$pseudo} {$spe}";}
                if(isset($_GET['liste_restrictive'])){$output.=" - liste restrictive: {$sp} {$liste_restrictive} {$spe}  ";}
                if(isset($_GET['web_view'])){$output.=" - web view: {$sp} {$web_view} {$spe}  ";}
                if(isset($_GET['last_name'])){$output.=" - Nom: {$sp} {$last_name}  {$spe}  ";}
                if(isset($_GET['first_name'])){$output.=" - Prénom: {$sp} {$first_name} {$spe}  ";}
                if(isset($_GET['address'])){$output.=" - Adresse: {$sp} {$address} {$spe} ";}
                if(isset($_GET['liste_rank'])){$output.=" - Rank : {$sp} {$liste_rank} {$spe}";}

            }?>
        <?php
//                if ($output) {echo "<br><hr>Critère de recherche: {$output}<br><br><br>";}

                if ($output) {
                    echo "<h4>{$text}<small>&nbsp;&nbsp;Critère de recherche: {$output}</small>></h4>";
                } else {
                    echo "<h4>{$text}></h4>";}

        ?>
            </div>
            <?php



            if ($query_recherche==true){
                echo  output_all_client($query_recherche, $pseudo,$liste_restrictive,$web_view,$last_name,$first_name,$address,$liste_rank);
            }else{
                echo output_all_client($query_recherche);
            }


            ?>

        </div>










<?php //echo str_repeat("<br>", 30); ?>
<?php include("../includes/layouts/footer_2.php"); ?>

