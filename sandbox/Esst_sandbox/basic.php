<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin"; ?>
<?php $layout_header="footer" ?>
<?php include("../includes/layouts/header.php"); ?>



<?php
echo substr(md5(rand()), 0, 7);
?>

<?php

$query="SELECT DISTINCT ";
$query.="month(course_date)as mth ";
$query.="FROM courses ";
$query.="ORDER BY mth ASC";
$subject_set = mysqli_query($connection, $query);
confirm_query($subject_set);

while($subject = mysqli_fetch_assoc($subject_set)) {

   //echo "<pre>" . print_r($subject) ."</pre>";
    echo $subject['mth']."<br>";

}


?>







<?php include("../includes/layouts/footer.php"); ?>
