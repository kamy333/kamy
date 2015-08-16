<?php
if (isset($_POST['send'])) {
	require './includes/somefile.php';
	header('Location: error_headers2.php');
	exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Headers Already Sent</title>
</head>

<body>
<h1>Headers Already Sent</h1>
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="send" id="send" value="Redirect to Other Page">
</form>
</body>
</html>