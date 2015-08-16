<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Array Functions</title>
	</head>
	<body>




		
		<?php $numbers = array(8,23,15,42,16,4); 
		      $name = array ("fname" => "kam", 
			  				 "lname" => "nafiss");
							 
				$name["Adr"]="68 voll";
		?>
        
        Begin: 	 			<?php sort($numbers);  print_r($numbers); ?><br />
		
		Count: 			<?php echo count($numbers); ?><br />
		Max value: 		<?php echo max($numbers); 	?><br />
		Min value: 		<?php echo min($numbers); 	?><br />
		<br />
		<pre>
		Sort: 	 			<?php sort($numbers);  print_r($numbers); ?><br />
		Reverse sort: 		<?php rsort($numbers); print_r($numbers); ?><br />
		</pre>
		<br />
		Implode: 			<?php echo $num_string = implode(" * ", $numbers); ?><br />
		Explode: 			<?php print_r(explode(" * ", $num_string)); ?><br />
		<br />
		
		15 in array?: <?php echo in_array(15, $numbers); // returns T/F ?><br />
		19 in array?: <?php echo in_array(19, $numbers); // returns T/F ?><br /><br />
        <hr/>
        <pre>
        
        Begin            <?php   print_r($name); ?><br />
    	Sort: 	 	     <?php //sort($name);  print_r($name); ?><br />
        after sort			<?php   print_r($name); ?><br />
		</pre>
		
        <hr/>
		Implode: 			<?php echo $num_string = implode(" , ", $name); ?><br />
		 after implode	<pre>		<?php   print_r($name); ?><pre></pre><br />

        <hr/>
        Array key			<?php print_r(array_keys($name));  ?>
        after array <br/> <pre> <?php   print_r($name); ?></pre><br />
        <hr/>
        <?php //$array = array(0 => 100, "color" => "red"); ?>
        <?php // print_r(array_keys($array)); ?>
       
        <br/>
        <?php 
		
		function kkk ($numbers) {
		$a=-1;
		foreach ($numbers as &$m) {
			
			$a++;
		echo  $a. "   " . $m ."<br/>";	
		}}
		
		kkk($numbers);

		?>


            <?php
            echo "<hr>";

            $array1 = array('blue'  => 1, 'red'  => 2, 'purple' => 3);
            print_r($array1);

            $array2 = array('blue' => 1, 'yellow' => 5, 'cyan'  => 6);
            print_r($array2);
//            var_dump(array_diff($array1, $array2));

            $result = array_diff($array1, $array2);

            print_r($result);


            echo "<hr>";

            $array1 = array("a" => "green", "red", "blue", "red");
            print_r($array1);
$array2 = array("b" => "green", "yellow", "red");
            print_r($array2);
$result = array_diff($array1, $array2);

print_r($result);

     ?>


    </body>
</html>
