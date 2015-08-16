<?php
$errors = array();
$missing = array();
if (isset($_POST['send'])) {
	$to = 'david@example.com';
	$subject = 'Feedback from contact form';
	$expected = array('name', 'email', 'comments', 'extras');
	$required = array('name', 'email', 'comments');
	if (!isset($_POST['extras'])) {
		$_POST['extras'] = array();
	}
	$minimumChecked = 2;
	if (count($_POST['extras']) < $minimumChecked) {
		$errors['extras'] = true;
	}
	$headers = "From: webmaster@example.com\r\n";
	$headers .= "Content-type: text/plain; charset=utf-8";
	require './includes/mail_process.php';
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Contact Us</h1>
<?php if ($_POST && $suspect) { ?>
<p class="warning">Sorry your mail could not be be sent.</p>
<?php } elseif ($errors || $missing) { ?>
<p class="warning">Please fix the item(s) indicated.</p>
<?php }?>
<form name="contact" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p>
        <label for="name">Name:
        <?php if ($missing && in_array('name', $missing)) { ?>
        <span class="warning">Please enter your name</span>
        <?php } ?>
        </label>
        <input type="text" name="name" id="name"
        <?php
		if ($errors || $missing) {
			echo 'value="' . htmlentities($name, ENT_COMPAT, 'utf-8') . '"';
		}
		?>
        >
    </p>
    <p>
        <label for="email">Email:
        <?php if ($missing && in_array('email', $missing)) { ?>
        <span class="warning">Please enter your email address</span>
        <?php } elseif (isset($errors['email'])) { ?>
        <span class="warning">Invalid email address</span>
        <?php } ?>
        </label>
        <input type="text" name="email" id="email"
        <?php
		if ($errors || $missing) {
			echo 'value="' . htmlentities($email, ENT_COMPAT, 'utf-8') . '"';
		}
		?>
        >
    </p>
    <p>
        <label for="comments">Comments:
        <?php if ($missing && in_array('comments', $missing)) { ?>
        <span class="warning">You forgot to add your comments</span>
        <?php } ?>
        </label>
        <textarea name="comments" id="comments"><?php 
		if ($errors || $missing) {
			echo htmlentities($comments, ENT_COMPAT, 'utf-8');
		}
		?></textarea>
    </p>
    <fieldset><legend>Optional Extras: <?php if (isset($errors['extras'])) { ?>
    <span class="warning">Please select at least <?php echo $minimumChecked; ?></span>
    <?php } ?>
    </legend><p>
      
        <input type="checkbox" name="extras[]" value="sun roof" id="extras_0"
        <?php
		if ($_POST && in_array('sun roof', $extras)) {
			echo 'checked';
		}
		?>
        >
      <label for="extras_0">Sun roof</label>
      <br>
      
        <input type="checkbox" name="extras[]" value="aircon" id="extras_1"
        <?php
		if ($_POST && in_array('aircon', $extras)) {
			echo 'checked';
		}
		?>
        >
      <label for="extras_1">Air conditioning</label>
      <br>
      
        <input type="checkbox" name="extras[]" value="automatic" id="extras_2"
        <?php
		if ($_POST && in_array('automatic', $extras)) {
			echo 'checked';
		}
		?>
        >
      <label for="extras_2"> Automatic transmission</label>
    </p></fieldset>
    <p>
        <input type="submit" name="send" id="send" value="Send Comments">
    </p>
</form>
</body>
</html>