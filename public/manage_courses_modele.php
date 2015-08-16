<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/25/2014
 * Time: 12:47 AM
 */
?>


<?php require_once('../includes/initialize.php'); ?>


<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php
if (isset($_GET["modele_visible"])){
    $visible=$_GET["modele_visible"];
} else {
    $visible=1;
}

?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="modele" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

    <div class="row">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php if(isset($errors)) echo form_errors($errors); ?>

    </div>

    <div class="row">
<h4 class="text-center">Modèle de courses&nbsp;&nbsp;  <a href="manage_courses_modele_today_view.php">details</a></h4>
</div>

<div class="row">

    <div class="col-md-2 col-md-offset-3">

    <ul class="nav nav-pills">
        <li role="presentation" class="<?php if($visible==1){echo "active";}?>"><a href="<?php echo $_SERVER['PHP_SELF'];?>?modele_visible=<?php echo urlencode(1); ?>">Visible</a></li>

        <li role="presentation" class="<?php if($visible==0){echo "active";}?>"><a href="<?php echo $_SERVER['PHP_SELF'];?>?modele_visible=<?php echo urlencode(0); ?>">Invisible</a></li>

    </ul>

</div>



<!---->
<!--    <div class="row">-->
<!--    <div class="col-md-12 ">-->


    <!-- Split button -->

    <div class="col-md-2 col-md-offset-1">
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
                <li class="a-rech" id="show-row-today"><a href="#">show aujourd'hui</a></li>
                <li class="a-rech" id="show-row-tomorrow"><a href="#">show demain</a></li>
                <li class="a-rech" id="show-row-others"><a href="#">show autres</a></li>
                <li class="a-rech divider "></li>
                <li class="a-rech" id="hide-row-today"><a href="#">Cacher aujourd'hui</a></li>
                <li class="a-rech" id="hide-row-tomorrow"><a href="#">Cacher demain</a></li>
                <li class="a-rech" id="hide-row-others"><a href="#">cacher autres</a></li>




            </ul>
        </div>
    </div>

</div>





    <div id="page" class="row">
        <?php echo message(); ?>
        <?php echo str_repeat("<br>", 2); ?>
    </div>

    <div id="table-modele-tous" class="row">

     <div class="col-md-12 " >

<?php echo output_all_modele_pivot($visible) ?>

         </div>
    </div>


<?php include("../includes/layouts/footer_2.php"); ?>