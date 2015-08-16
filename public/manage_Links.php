<?php require_once('../includes/initialize.php'); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php $layout_context = "public"; // public or admin?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php  $active_menu="links" ?>
<?php include("../includes/layouts/nav.php"); ?>

<!--<div class="page-header">
  <h2> <small>My links</small></h2>
</div>-->

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>


<div class="row">
    <div class="col-lg-9 col-sm-5">
    <?php echo get_search_category(); ?>
     </div>
</div>

<br>

<div class="row">
    <div class="col-lg-6 col-sm-5">
    <?php echo output_links(); ?>
</div>
</div>



 <!-- end div row -->








<?php include ("../includes/layouts/footer_2.php");?>


