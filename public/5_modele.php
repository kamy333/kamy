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

<?php


$admin=find_admin_by_username("kamy");
//foreach($admin as $key=>$val){
//    echo $key." :".$val."<br>";
//}

echo " database hashed :<br>". $admin["hashed_password"]."<br>";
$existing_password=$admin["hashed_password"];
$password="kamy";


$existing_password=password_encrypt($password);
echo " password encrypt :<br>". $existing_password."<br>";
$existing_password=password_encrypt($password);
echo " password encrypt :<br>". $existing_password."<br>";

$check=password_check($password,$existing_password);

echo "<br>";
if($check){
    echo "password match";
} else {
    echo "password did not match";
}

//var_dump($admin);

?>


<?php include("../includes/layouts/footer_2.php"); ?>
