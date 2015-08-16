<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Contact Us</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Contact Us</h1>
<p class="warning">Please fix the item(s) indicated.</p>
<form name="contact" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p>
        <label for="name">Name:
        <span class="warning">Please enter your name</span>
        </label>
        <input type="text" name="name" id="name">
    </p>
    <p>
        <label for="email">Email:
        <span class="warning">Please enter your email address</span>
        </label>
        <input type="text" name="email" id="email">
    </p>
    <p>
        <label for="comments">Comments:
        <span class="warning">You forgot to add your comments</span>
        </label>
        <textarea name="comments" id="comments"></textarea>
    </p>
    <p>
        <input type="submit" name="send" id="send" value="Send Comments">
    </p>
</form>
</body>
</html>