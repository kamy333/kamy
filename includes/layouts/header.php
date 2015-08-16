 
<?php if (!isset($layout_context)) {$layout_context = "public";	}?>
<?php  if (isset($_SESSION["nom"])) {$nom=$_SESSION["nom"]; } else { $nom=false;}?>
<?php  if (isset($_SESSION["username"])) {$username=$_SESSION["username"]; } else { $username=false;}?>

<?php $page_name = $_SERVER['PHP_SELF'];?>
<?php //|| $page_name=="/public/new_course.php")?>


<!-- TODO stylesheet footer  header below layout context -->
<?php if (!isset($layout_header)) {$layout_header = "normal";	}?>





<!doctype html>

<html lang="fr">
<head>
    <meta charset="UTF-8">


    <title>ikamy.ch <?php if ($layout_context == "admin") { echo "Admin"; } ?></title>


    <?php  ?>

        <?php if($page_name=="/kamy/public/login.php" ||$page_name== "public/login.php")  {?>
        
        <link rel="stylesheet" type="text/css" href="stylesheets/normalize.css">

                    <?php if($layout_header==("footer" ))  {?>
                        <link href="stylesheets/style_footer.css" rel="stylesheet" type="text/css" />
                    <?php  } else { ?>
                         <link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
                    <?php };?>

        <?php  } else { ?>
        <link rel="stylesheet" type="text/css" href="stylesheets/normalize.css">

            <?php if($layout_header==("footer" ))  {?>
                <link href="stylesheets/style_footer.css" rel="stylesheet" type="text/css" />
            <?php  } else { ?>
                <link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
            <?php };?>

       <?php };?>

        <link href="stylesheets/normalize.css" rel="stylesheet" type="text/css" >
        <link href="stylesheets/mystyle.css" media="all" rel="stylesheet" type="text/css" />
		<link href="stylesheets/frmcourse.css" rel="stylesheet" type="text/css">


    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">

<!--<script src="javascripts/jquery-1.11.1.min.js"></script>-->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>


    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
    <!--<![endif]-->


    <!--[if lt IE 8]>
	<style>
		legend {
			display: block;
			padding: 0;
			padding-top: 30px;
			font-weight: bold;
			font-size: 1.25em;
			color: #FFD98D;
			margin: 0 auto;
		}
	</style>
<![endif]-->

    <!--[if lt IE 7]>
    <style type="text/css">
        #wrapper { height:100%; }
    </style>
    <![endif]-->


    </head>
    
	<body>



    <?php if($layout_header==("footer" ))  {?>
    <div id="wrapper">
    <?php };?>

        <?php
        //section picture

        if(file_exists("images/{$username}.JPG")){
            $picture= "<img  src='images/{$username}.JPG' alt='kamy' style='width:50px;height:50px'>";
        }else{
            // if no picture
            $picture="Logout {$nom}";
        }
        ?>



    <div id="header">
      <h1>
      <div  id="headerName"><a href="index.php" style="color:white;text-decoration:none;">ikamy.ch <?php if ($layout_context == "admin") { echo "Admin"; } ?></a></div>


      <?php 
	  if ($nom) {
		  $div="<div class=\"img\" id=\"loginheader\"><sup>";
		  //$div.= $nom."    "."    ";
		  //$div.="<a href=\"logout.php\">Logout {$nom}</a>";
          $div.="<a href=\"logout.php\" title=\"Logout {$nom}\">{$picture}</a>";
          //$div.=$picture;
		  $div.="</sup>";

          $div.="<div/>";

		  echo $div;
	  } else {
		  $div="<div id=\"loginheader\"><sup>";
		  //$div.= $nom."    "."    ";
		  $div.="<a href=\"login.php\">Login</a>";
		  $div.="</sup><div/>";
		  echo $div;
		  
	  }

	  ?>

      </h1>
    </div>
