<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); // find true as argument ?>

<?php $layout_context = "admin"; ?>
<?php  $active_menu="admin" ?>
<?php $stylesheets=""?>
<?php $fluid_view=true ?>
<?php $javascript="manage_course" ?>
<?php $incl_message_error=true; ?>

<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


    <h4 class="page-header text-center">Bienvenue dans votre espace <?php echo htmlentities($_SESSION["nom"]); ?></h4>





        <?php
        //   $a="Kamran NAFISSPOUR";
        $simple_query=false;
        $number_course_limit=false;
        $number_course=10000;
        $chauffeur=null;
        $pseudo=null;
        $validated=null;
        $course_date=null;
        $month=null;

        if(isset($_GET['submit'])){


            if (ISSET($_GET['chauffeur']))   {
                $chauffeur=$_GET['chauffeur'];}

            if (ISSET($_GET['pseudo']))   {
                $pseudo=$_GET['pseudo'];}

            if (ISSET($_GET['validated']))   {
                $validated=$_GET['validated'];}

            if (ISSET($_GET['course_date']))   {
                $course_date=$_GET['course_date'];}

            if (ISSET($_GET['month']))   {
                $month=$_GET['month'];}

        }
        ?>

<div class="row">
<div class="col-md-12 ">


    <!-- Split button -->

                <div class="col-md-2 col-md-offset-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li class="a-rech" id="button_recherche_voir"><a href="#">Recherche Avancée</a></li>
                        <li class="a-rech" id="button_recherche_cache"><a href="#">Cacher Recherche Avancée</a></li>

                        <li class="a-rech divider"></li>
                        <li class="a-rech" id="show-row-all"><a href="#">show all</a></li>
                        <li class="a-rech" id="show-row-success"><a href="#">show valid success</a></li>
                        <li class="a-rech" id="show-row-danger"><a href="#">show valid danger</a></li>
                        <li class="a-rech" id="show-row-others"><a href="#">show others</a></li>
                        <li class="a-rech divider "></li>
                        <li class="a-rech" id="hide-row-success"><a href="#">Cacher valid success</a></li>
                        <li class="a-rech" id="hide-row-danger"><a href="#">Cacher valid danger</a></li>
                        <li class="a-rech" id="hide-row-others"><a href="#">cacher others</a></li>

                        <li class="divider"></li>
                        <li id="Ajout_course"><a href="new_course.php">Ajout course</a></li>
                        <li class="divider"></li>
                        <li id="button_panel_cache"><a href="#">Cacher paneau courses</a></li>
                        <li id="button_panel_voir"><a href="#">Voir  paneau courses</a></li>
                        <li class="a-rech divider"></li>
                        <li class="a-rech" id="button_remarque_voir"><a href="#">Voir remarque</a></li>
                        <li class="a-rech" id="button_remarque_cache"><a href="#">Cacher remarque</a></li>
                        <li class="divider"></li>

            <!--            <li id=""><a href="#"></a></li>-->
            <!--            <li id=""><a href="#"></a></li>-->
            <!--            <li id=""><a href="#"></a></li>-->



                    </ul>
                </div>
                </div>


<!-- begin testing button    -->

</div>
</div>



        <div class="row">
            <div id="form_recherche" class="text-center col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 background_light_pink">


            <form class="form-inline " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

                <div class="row">


                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <?php echo choisir_mois();?>
                        </div>
                    </div>

                      <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <?php echo choisir_course_date(); ?>
                        </div>
                    </div>
    

                      <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <?php echo choisir_pseudo(); ?>
                        </div>
                    </div>
					
<!--                      <div class="col-lg-2 col-md-2">-->
<!--                    <div class="form-group">-->
<!--                            --><?php //echo choisir_num_courses($number_course);?>
<!--                        </div>-->
<!--                    </div>-->
             

                        <?php   if (!is_chauffeur()) {?>
                          <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <?php echo choisir_validation();?>
                            </div>
                            </div>
                        <?php } ?>

                    <?php if (!is_chauffeur()) { ?>
                          <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <?php echo  choisir_chauffeur();?>
                            </div>
                        </div>
                    <?php } ?>

                    </div>

                        <?php // if(isset($_POST['nbcourses'])) {$number_course=$_POST['nbcourses'];} else{ $number_course=2 ;}?>



                    <br>

                    <div class="row">
                    <div class="text-center col-md-6 col-md-offset-3">
                    <button type="submit"  name="submit" class="btn btn-info  btn-block" value="true">Chercher</button>
                    </div>
                    </div>


            </form>


        </div>
</div>

<div class="panel panel-default col-md-12"  id="mes_courses">
    <!-- Default panel contents -->
    <div class="panel-heading">

            <?php
            $output="";
            $monthName=null;
            $validated_name=null;

            if(isset($_GET["month"])){
            $dateObj   = DateTime::createFromFormat('!m', $_GET["month"]);
            $monthName = $dateObj->format('F'); } // March}

            if(isset($_GET["validated"])==0) {
                $validated_name = "Non Valide";
            } else {
                $validated_name = "Valid";
            }

            $date1_format=null;
            if(isset($_GET["course_date"])) {
                $date1_format = htmlentities($_GET["course_date"]);
                $date1_format = date('d-m-Y', strtotime(str_replace('-', '/', $date1_format)));
            }

            $sp="<span style='color: #0000ff'><strong>";
            $spe="</strong></span>";

            $text=null;
            if(isset($_GET['submit'])){
                $text =  "<span><a href='admin.php'>Courses <span class='glyphicon glyphicon-zoom-out' aria-hidden='true'></span></a></span>";

            } else {
                $text =  "<span >Toutes les Courses <span class='glyphicon glyphicon-download-alt' aria-hidden='true'></span></span>";
            }


            if(isset($_GET['submit'])) {
                if (isset($_GET['chauffeur'])) {
                    $output .= "Chauffeur:{$sp} {$chauffeur}{$spe}";
                }
                if (isset($_GET['pseudo'])) {
                    $output .= " - Client: {$sp} {$pseudo} {$spe}";
                }
                if (isset($_GET['validated'])) {
                    $output .= " - Statut: {$sp} {$validated_name}{$spe}  ";
                }
                if (isset($_GET['month'])) {
                    $output .= " - Mois: {$sp} {$monthName} {$spe} ";
                }
                if (isset($_GET['course_date'])) {
                    $output .= " - Date: {$sp}{$date1_format} {$spe}  ";
                }
                if (isset($_GET['number_course'])) {
                    $output .= " - Nbre de Courses:{$sp} {$number_course} {$spe}";
                }
            }

                if ($output) {
                    echo "<h4>{$text}<small>&nbsp;&nbsp;Critère de recherche: {$output}</small>></h4>";
                } else {
                    echo "<h4>{$text}></h4>";}


           ?>

        </div>


            <?php echo output_courses($simple_query,$number_course_limit,$number_course,$chauffeur,$pseudo,$validated,$course_date,$month);?>

            </div>


            <?php

            $_GET=null; ?>


<!--        </div>-->







<?php include("../includes/layouts/footer_2.php"); ?>



