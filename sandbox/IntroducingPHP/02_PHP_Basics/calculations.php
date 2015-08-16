<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Increment and Decrement</title>
</head>

<body>
<?php $number = 5; ?>
<p>$number is initialized as <?php echo $number; ?></p>
<?php $result = ++$number * 2; ?>
<p><code>$result = ++$number * 2;</code></p>
<p>$result is <?php echo $result; ?>. $number is now <?php echo $number; ?>.</p>
<?php $result = $number++ * 2; ?>
<p><code>$result = $number++ * 2;</code></p>
<p>$result is <?php echo $result; ?>. $number is now <?php echo $number; ?>.</p>
<?php $result = $number-- * 2; ?>
<p><code>$result = $number-- * 2;</code></p>
<p>$result is <?php echo $result; ?>. $number is now <?php echo $number; ?>.</p>
<?php $result = --$number * 2; ?>
<p><code>$result = --$number * 2;</code></p>
<p>$result is <?php echo $result; ?>. $number is now <?php echo $number; ?>.</p>
</body>
</html>