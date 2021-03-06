<?php
$errors = array();
$missing = array();
if (isset($_POST['send'])) {
	$to = 'david@example.com';
	$subject = 'Feedback from contact form';
	$expected = array('name', 'email', 'comments', 'gender');
	$required = array('name', 'email', 'comments', 'gender');
	if (!isset($_POST['gender'])) {
		$_POST['gender'] = '';
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
    <fieldset><legend>Gender: <?php
    if ($missing && in_array('gender', $missing)) { ?>
	<span class="warning">Please select a value</span>
    <?php } ?>
    </legend><p>
        <input type="radio" name="gender" value="f" id="gender_f"
        <?php
		if ($_POST && $gender == 'f') {
			echo 'checked';
		}
		?>
        >
        <label for="gender_f">Female</label>
        <input type="radio" name="gender" value="m" id="gender_m"
        <?php
		if ($_POST && $gender == 'm') {
			echo 'checked';
		}
		?>
        >
        <label for="gender_m">Male</label>
        <input type="radio" name="gender" value="won't say" id="gender_0"
        <?php
		/* Sets this radio button as the default */
		if (!$_POST || $gender == "won't say") {
			echo 'checked';
		}
		/* Use this version if no default is set
		if ($_POST && $gender == "won't say") {
			echo 'checked';
		}
		*/
		?>
        >
       <label for="gender_0">Rather not say</label>
    </p></fieldset>
    <p>
        <input type="submit" name="send" id="send" value="Send Comments">
    </p>
</form>
</body>
</html>