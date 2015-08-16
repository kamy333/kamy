<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="modele" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<?php

?>

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>

</div>

<h2 class="text-center">test<a href="manage_courses_modele.php">toutes les courses</a> </h2>
<?php







?>





<div class="container-fluid">

<?php echo $_GET['str_time']; ?>

<div class="col-md-6">
<?php echo table_historical(); ?>
</div>

<div class="col-md-3 col-md-offset-1 ">
    <?php  echo  get_output_panel_program($_GET['str_time']);?>
</div>

</div>





























<?php


//$today=strtotime("today");
//$today_day_name=strftime("%A" ,$today);
//$today_no=day_eng_no($today_day_name);
//$today_french_name=day_fr($today_no);
//$today_date_sql = strftime("%Y-%m-%d" ,$today);
//
//
//echo "today;". $today."<br>";
//echo "today_day_name;". $today_day_name."<br>";
//echo "today_no;".$today_no."<br>";
//echo "today_french_name;".$today_french_name."<br>";
//echo "today_date_sql;".$today_date_sql."<br>";



//$now=strtotime("now");
//$tomorrow =strtotime("tomorrow");
//$now_no=day_eng_no(strftime("%A" ,$now));
//$tomorrow_no=day_eng_no(strftime("%A" ,$tomorrow));
//echo "now;". $now." - ".strftime("%d-%m-%Y" ,$now)."<br>";
//echo "tomorrow;". $tomorrow."<br>";
//echo "now_no;".$now_no."<br>";
//echo "tomorrow_no;".$tomorrow_no."<br>";
//
//echo "<hr>";


//for($a=1;$a<=7;$a++){
//    $b=day_eng($a);
//
//    $today= strtotime("today");
//    $today= strftime("%d-%m-%Y" ,$today);
//    $last= strtotime("Last {$b}");
//    $last= strftime("%d-%m-%Y" ,$last);
//    $next= strtotime("Next {$b}");
//    $next= strftime("%d-%m-%Y" ,$next);
//
//    echo $a." - ";
//
//    echo $b." - ";
//    echo strtotime("today")." - today {$today} ";
//    echo strtotime("Last {$b}")." - last {$last}  ";
//    echo strtotime("Next {$b}")." - next {$next}  ";
//
//    echo "<br>";
//
//
//
//}

?>





<?php include("../includes/layouts/footer_2.php"); ?>
