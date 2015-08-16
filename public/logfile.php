<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>


<?php

  $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';

if (isset($_GET['clear'])){
    if($_GET['clear'] == 'true' && isset($_GET['clear'])) {
        file_put_contents($logfile, "");
        // Add the first log entry
        log_action('Logs Cleared', "by User ID {$_SESSION["username"]}");
        // redirect to this same page so that the URL won't
        // have "clear=true" anymore
        redirect_to('logfile.php');
    }
}

?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<a href="index.php">&laquo; Back</a><br />
<br />

<h4 class="text-center"><mark><a href="<?php echo $_SERVER["PHP_SELF"] ?>">Log File</a> </mark></h4>


<p><a href="logfile.php?clear=true">Clear log file</a><p>

<?php

  if( file_exists($logfile) && is_readable($logfile) && 
			$handle = fopen($logfile, 'r')) {  // read
    echo "<ul class=\"list-group\">";
		while(!feof($handle)) {
			$entry = fgets($handle);
			if(trim($entry) != "") {
				echo "<li class=\"list-group-item\">{$entry}</li>";
			}
		}
		echo "</ul>";
    fclose($handle);
  } else {
    echo "Could not read from {$logfile}.";
  }

?>

<?php include("../includes/layouts/footer_2.php"); ?>
