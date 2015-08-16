<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row" id="main">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>





<?php

function count_prog_by_date_doubled ($date_sql,$pseudo,$heure){
global $connection;
$safe_date=mysql_prep($date_sql);
$safe_pseudo=mysql_prep($pseudo);
$safe_heure=mysql_prep($heure);

$query = "SELECT COUNT(*) AS c FROM programmed_courses WHERE course_date ='{$safe_date}' ";
$query.="AND pseudo = '{$safe_pseudo} ";
$query.="AND heure = '{$safe_heure} ";
$result = mysqli_query($connection, $query);
confirm_query($result);
$row = mysqli_fetch_assoc($result);
return $row['c']; //
}
?>


<div class="row text-center">
<div class="col-md-3 col-md-offset-1">

    <?php

    ?>


    <?php echo nav_menu_pills_program(); ?>


</div>


    <div class="col-md-3 col-md-offset-1 visible-lg visible-md">

    <h4 class="text-center">Manage Program</h4>

        </div>
</div>

<hr>

<div class="row">

    <div class="col-md-3 ">
        <?php  echo  get_output_panel_program('now');?>
    </div>

    <div class="col-md-3 ">
        <?php  echo  get_output_panel_program('tomorrow');?>
    </div>

    <div class="col-md-3 ">
        <?php  echo  get_output_panel_program('yesterday');?>
    </div>

    <div class="col-md-3 ">
        <?php  echo  get_output_panel_program('2 days ago');?>
    </div>

</div>




        <?php if (is_admin() && $_SESSION['username']=="admin") {?>
    <?php echo str_repeat("<br>", 5); ?>
    <div class="row">
        <div class="col-md-3"><pre>post<?php if(isset($_POST)){print_r($_POST);} ?></pre> </div>
        <div class="col-md-3"><pre>GET <?php if(isset($_GET)) { print_r($_GET);} ?></pre></div>
        <div class="col-md-3"><pre>programs <?php // if(isset($program_set)) { print_r($program_set);} ?></pre></div>

    </div>
    <hr>
    <div class="col-md-12"><pre>query<?php if(isset($query)) {echo $query;} ?></pre> </div>
    <?php echo str_repeat("<br>", 5); ?>
<?php } ?>








<?php include("../includes/layouts/footer_2.php"); ?>
