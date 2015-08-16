<?php
$descriptions = array('Earth'  => 'mostly harmless',
                      'Marvin' => 'the paranoid android',
                      'Zaphod' => 'President of the Imperial Galactic Government');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Undefined Index Error</title>
</head>

<body>
<h1>Earth</h1>
<p><?php ehco "In the revised version of the Hitchhiker's Guide, Earth is described as {$descriptions['earth']}."; ?></p>
</body>
</html>