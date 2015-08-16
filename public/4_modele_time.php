<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="modele"; ?>
<?php $stylesheets=""; ?>
<?php $fluid_view=false; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<?php

?>



<h2 class="text-center">test<a href="manage_courses_modele.php">toutes les courses</a> </h2>
<?php

echo "<hr>";
$date="2015-05-27";

$today=strtotime($date);
$today_day_name=strftime("%A" ,$today);
$today_no=day_eng_no($today_day_name);
$today_french_name=day_fr($today_no);
$today_date_sql = strftime("%Y-%m-%d" ,$today);
$today_month_name=strftime("%B" ,$today);;
$today_month_no=strftime("%m" ,$today);;

$today_month_name_fr=mth_fr_name($today_month_name);
$today_month_no_fr=mth_fr_no($today_month_no);


echo "Date first variable - ". $date."<br>";
echo "mktime(0,0,0,5,27,2015)  - ". mktime(0,0,0,5,27,2015)."<br>";
echo "day - strtotime('2015-05-27') - ". $today."<br>";
echo "day_day_name - strftime('%A' ,$today) - ". $today_day_name."<br>";
echo "day_no - day_eng_no($today_day_name) - ".$today_no."<br>";
echo "day_french_name - day_fr($today_no) - ".$today_french_name."<br>";
echo "day_date_sql - strftime('%Y-%m-%d' ,$today) - ".$today_date_sql."<br>";
echo "today_month_name  strftime('%B' ) - ". $today_month_name."<br>";
echo "today_month_no  strftime('%m' ) - ". $today_month_no."<br>";
echo "today_month_name_fr  mth_fr_name($today_month_name) - ". $today_month_name_fr."<br>";
echo "today_month_no:fr mth_fr_no($today_month_name) ) - ". $today_month_no_fr."<br>";

echo strftime("%I %M",$today);

echo "<br>";
echo "mktime(0,0,0,5,27,2015)  - ". mktime(0,0,0,5,27,2015)."<br>";



echo "<hr>";


for( $a=1;$a>13;$a++){

}


?>





































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
