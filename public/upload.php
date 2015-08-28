<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>
<?php  if(!is_admin() && !is_kamy() ) {redirect_to('manage_program.php');} ?>


<?php

// In an application, this could be moved to a config file
$upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
  UPLOAD_ERR_OK 				=> "No errors.",
  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
  UPLOAD_ERR_NO_FILE 		=> "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
);

if(isset($_POST['submit'])) {
	// process the form data
	$tmp_file = $_FILES['file_upload']['tmp_name'];
	$target_file = basename($_FILES['file_upload']['name']);
	$upload_dir = SITE_ROOT.DS."uploads";
	$path_filenme = $upload_dir."/".$target_file;

	chmod($upload_dir,0777);
    chmod($path_filenme,0777);
    chmod($tmp_file,0777);


    // You will probably want to first use file_exists() to make sure
	// there isn't already a file by the same name.
	
	// move_uploaded_file will return false if $tmp_file is not a valid upload file 
	// or if it cannot be moved for any other reason
	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
		log_action('Upload file success', "{$_SESSION['username']} uploaded file {$path_filenme} ". $temp_file." - ".$target_file);
		$message = "File uploaded successfully.";
        chmod($path_filenme,0777);
    } else {
        log_action('Upload file error', "{$_SESSION['username']} uploaded file {$path_filenme} ". $temp_file." - ".$target_file);

        $error = $_FILES['file_upload']['error'];
		$message = $upload_errors[$error];
	}
	
}	

?>

	
<?php
// The maximum file size (in bytes) must be declared before the file input field
// and can't be larger than the setting for upload_max_filesize in php.ini.
//
// This form value can be manipulated. You should still use it, but you rely 
// on upload_max_filesize as the absolute limit.
//
// Think of it as a polite declaration: "Hey PHP, here comes a file less than X..."
// PHP will stop and complain once X is exceeded.
// 
// 1 megabyte is actually 1,048,576 bytes.
// You can round it unless the precision matters.
?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=false; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>



<!--		--><?php //if(!empty($message)) { echo "<p>{$message}</p>"; } ?>

<p>
<?php /*if(isset($upload_dir) && isset($target_file)) { */?><!--
    <a href="<?php /*echo "../uploads/".$target_file */?>"><?php /*echo $target_file */?></a>
    <br>
    <?php
/*    echo "<strong>fileperms my dir</strong> ".substr(decoct(fileperms($upload_dir)), 2)."<br>";
    echo "<strong>fileperms</strong> ".substr(decoct(fileperms($path_filenme)), 2)."<br>";
    echo "<strong>tmp_file</strong> ". $tmp_file."<br>";
    echo "<strong>fileperms tmp_file</strong> ".substr(decoct(fileperms($tmp_file)), 2)."<br>";
    echo "<strong>Target_file</strong> ".$target_file."<br>";
    echo "<strong>upload_dir</strong> ".$upload_dir."<br>" ;
    echo "<strong>full_path</strong> ".$path_filenme."<br>";
    */?>
--><?php /*}*/?>
</p>

<!--<p><a href="../includes/config.php">php info</a> </p>-->

	<div class="row">
		<div class="col-md-6 col-md-offset-2 col-lg-7 col-lg-offset-2">


			<div class ="background_light_blue">

		<form action="upload.php" class="form-inline" enctype="multipart/form-data" method="POST">

			<fieldset id="login" title="Course">
				<legend class="text-center" style="color: #0000ff">Upload file or image</legend>


<!--				<div class="col-sm-9">-->
					<div class="form-group">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
						<label class="sr-only" for="file_upload">File to upload</label>
						<input type="file" class="form-control" id="file_upload" name="file_upload" />
				<p class="help-block"><?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
					<?php if(isset($upload_dir) && isset($target_file)) { ?>
						<a href="<?php echo "../uploads/".$target_file ?>"><?php echo $target_file ?></a>
                    <?php }?>

				</p>

			</div>
<!--					</div>-->

<!--		  <input type="submit" name="submit" value="Upload" />-->

<!--			<div class="col-sm-offset-3 col-sm-3 col-xs-3">-->
				<button type="submit" name="submit" value="Upload" class="btn btn-primary">Upload</button>
<!--			</div>-->
				</fieldset>
		</form>

		</div>
			</div>
		</div>




<?php



	$dir=SITE_ROOT.DS."uploads";
	if(is_dir($dir)) {
	$dir_array = scandir($dir);
echo "<ul class='list-group'>";
	foreach($dir_array as $file) {
	if(stripos($file, '.') > 0) {

		$output= " &nbsp; &nbsp; last modified (content) - ".strftime('%d/%m/%Y %H:%M', filemtime($dir."/".$file)) . " | ";
		$output.= "last changed (content or metadata) - ".strftime('%d/%m/%Y %H:%M', filectime($dir."/".$file)) . " | ";
		$output.= "last accessed (any read/change) - ".strftime('%d/%m/%Y %H:%M', fileatime($dir."/".$file)) . " | ";

		echo "<li class='list-group-item'><a href='../uploads/{$file}'>{$file}</a>{$output}</li>";

	}
	}
		echo "</ul>";
	}


	//
	?>

<?php include("../includes/layouts/footer_2.php"); ?>