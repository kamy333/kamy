<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<h4 class="text-center"><mark><a href="<?php echo $_SERVER["PHP_SELF"] ?>">my modele</a> </mark></h4>




<?php include("../includes/layouts/footer_2.php"); ?>
