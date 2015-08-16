<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>String Functions</title>
	</head>
	<body>
	<?php

	$first = "The quick brown fox";
	$second = " jumped over the lazy dog.";
	
	$third = $first;
	$third .= $second;
	echo $third;

	?>
	<br />
	Lowercase: <?php echo strtolower($third); ?><br />
	Uppercase: <?php echo strtoupper($third); ?><br />
	Uppercase first: <?php echo ucfirst($third); ?><br />
	Uppercase words: <?php echo ucwords($third); ?><br />
	<br />
	Length: <?php echo strlen($third); ?><br />
	Trim: <?php echo "A" . trim(" B C D ") . "E"; ?><br />
	Find: <?php echo strstr($third, "brown"); ?><br />
	Replace by string: <?php echo str_replace("quick", "super-fast", $third); ?><br />

	<br />
	Repeat: <?php echo str_repeat($third, 2); ?><br />
	Make substring: <?php echo substr($third, 5, 10); ?><br />
	Find position: <?php echo strpos($third, "brown"); ?><br />
	Find character: <?php echo strchr($third, "z"); ?><br />

    <?php
    $heure_aller="00h00";
    $heure_retour="11h15";
    $heure_aller_integer= (float)str_replace("h", ".", $heure_aller);
    $heure_retour_integer= (float)str_replace("h", ".", $heure_retour);

    echo $heure_aller_integer."<br>";
    echo $heure_retour_integer."<br>";

    if($heure_aller_integer>$heure_retour_integer) {
        echo "FALSE heure aller superieur heure retour";
    }else{

        echo "OK heure aller inferieur heure retour";

    }

    echo "<hr>";
    echo substr($heure_aller,0,1)."<br>";
    echo substr($heure_retour,0,1)."<br>";
    echo "<hr>";


    //format hours for vizualization form
    function visu_heure($heure){
         $first=(int)substr($heure,0,1);
         $len=strlen($heure);
         $heure= str_replace("h", ":", $heure);
         $heure_no_0=substr($heure,1,$len-1);

              if ($first==0){
                  return $heure_no_0;
              }else {
                  return $heure;
              }
            }



     echo "<hr>";

    echo $heure=visu_heure($heure_aller)."<br>";
    echo $heure=visu_heure($heure_retour)."<br>";


?>
	
	</body>
</html>
