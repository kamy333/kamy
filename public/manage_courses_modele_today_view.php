<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>


<?php $text_fr=""; ?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<?php

// changed from
if (isset($_GET['date_next_last'])&& isset($_GET['week_day'])) {
$day=$_GET["week_day"];
$day_french= day_fr($day);
$day_english= day_eng($day);

$date_next_last=$_GET["date_next_last"];

$time= $_GET["date_next_last"] ." " . $day_english;

    if ($date_next_last=="next") {
        $text_fr = $day_french . " la semaine prochaine";
    } else {
        $text_fr=$day_french ." la semaine dernière";

    }


}

if (isset($_GET["modele_visible"])){
    $visible=$_GET["modele_visible"];
    } else {
    $visible=1;
}


?>

<div class="row">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>

</div>

<?php //include("../includes/testing/Test_post_get_global.php"); ?>





<h4 class="text-center"><a href="manage_courses_modele_today_view.php"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
    </a>
    Course Aujourd'hui et demain <small><a href="manage_courses_modele.php">toutes les courses</a></small></h4>

<div class="row" id="form_recherche">

    <div class="col-md-2 col-md-offset-1">

        <ul class="nav nav-pills">
            <li role="presentation" class="<?php if($visible==1){echo "active";}?>"><a href="<?php echo $_SERVER['PHP_SELF'];?>?modele_visible=<?php echo urlencode(1); ?>">Visible</a></li>

            <li role="presentation" class="<?php if($visible==0){echo "active";}?>"><a href="<?php echo $_SERVER['PHP_SELF'];?>?modele_visible=<?php echo urlencode(0); ?>">Invisible</a></li>

        </ul>

    </div>

    <div class="col-md-7  background_light_yellow text-center">
        <form class="form-inline " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div class="form-group">
                <?php echo form_select_week_day() ?>
            </div>
            <div class="form-group">
                <?php echo form_radio_next_last() ?>
            </div>
            &nbsp;&nbsp;&nbsp;
            <button type="submit"  name="submit" class="btn btn-danger" value="true">Chercher</button>

            <p><input  type="hidden" name="modele_visible" id="modele_visible" value="<?php echo $visible; ?>"></p>


        </form>
    </div>
</div>

<hr>




<div class="row">

    <div class="col-md-4 ">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">
                <h3 class="panel-title text-center">Aujourdhui</h3>
            </div>
            <?php  echo output_all_modele_pivot_today($visible)?>
        </div>
    </div>


<div class="col-md-4 ">
<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading text-center">
        <h3 class="panel-title">Demain</h3>
    </div>
    <?php  echo output_all_modele_pivot_tomorrow($visible)?>
</div>
</div>

    <?php if (isset($_GET) && isset($time)){?>

    <div class="col-md-4 ">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">
                <h3 class="panel-title"><?php if(isset($text_fr)){echo $text_fr ;} ?></h3>
            </div>
            <?php  echo output_all_modele_pivot_search($time)?>
        </div>
    </div>
    <?php } ?>

</div>
<?php include("../includes/layouts/footer_2.php"); ?>
