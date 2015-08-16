<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<h4 class="text-center"><mark>Google map</mark></h4>

<!-- Responsive iFrame -->
<div class="Flexible-container">
    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ch/maps?f=q&amp;source=s_q&amp;hl=de&amp;geocode=&amp;q=Geneva&amp;aq=&amp;sll=46.813187,8.22421&amp;sspn=3.379772,8.453979&amp;ie=UTF8&amp;hq=&amp;hnear=Geneva&amp;t=m&amp;z=12&amp;ll=46.947922,7.444608&amp;output=embed&amp;iwloc=near"></iframe>
</div>



<?php include("../includes/layouts/footer_2.php"); ?>
