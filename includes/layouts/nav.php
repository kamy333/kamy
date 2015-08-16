<div class="row">
    	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

          <a class="navbar-brand active" href="http://www.ikamy.ch/public/index.php">ikamy.ch<?php if ($layout_context == "admin") { echo " Admin"; } ?></a>

            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li
                        <?php if ( isset($active_menu) && $active_menu=="home") {echo "class=\"active\"";} ?>
                        ><a href="index.php">Home</a></li>


                    <li
                        <?php if ( isset($active_menu) && $active_menu=="about"){echo " class=\"dropdown active\"";} else {echo " class=\" dropdown\"";}?>
                        ><a href="#" data-toggle="dropdown">About us<span class="caret"></span></a>
                    	<ul class="dropdown-menu">
                            <li><a href="about_us.php">About us</a></li>
                            <li><a href="about_us_2.php">About us 2</a></li>
<!--                            <li><a href="about_us_2.php#pablo_arza">Pablo Arza</a></li>-->
<!--                            <li><a href="about_us_2.php#djamila_amrani">Djamila AMRANI</a></li>-->
<!--                            <li><a href="about_us_2.php#pierre_alain_bonfils">Pierre-Alain BONFILS</a></li>-->
<!--                            <li><a href="about_us_2.php#luan_haziri">Luan HAZIRI</a></li>-->
<!--                            <li><a href="about_us_2.php#vincent_dubouloz">Vincent DUBOULOZ</a></li>-->
                            <li><a href="about_us_2.php#kamran_nafisspour">Kamran NAFISSPOUR</a></li>

                        </ul>
                    </li>


                    <li
                        <?php if ( isset($active_menu) && $active_menu=="links") {echo "class=\"active\"";} ?>
                        ><a href="myLinks.php?category=Others">Links</a></li>

                    <li
                        <?php if ( isset($active_menu) && $active_menu=="contact") {echo "class=\"active\"";} ?>
                        ><a href="contact.php">Contact</a></li>



                    <?php  if (isset($_SESSION['user_type_id']) &&(is_chauffeur())) { ?>

                        <li
                            <?php if ( isset($active_menu) && $active_menu=="admin"){echo " class=\"dropdown active\"";} else {echo " class=\" dropdown\"";}?>
                            ><a href="#" data-toggle="dropdown">Mon Menu<span class="caret"></span></a>

                            <ul class="dropdown-menu">
                                <li><a href="manage_program.php">Program du jour</a></li>
                                <li><a href="new_course_program.php">Nouvelle course</a></li>
<!--                                <li><a href="admin.php">Courses manuel</a></li>-->
<!--                                <li><a href="new_course.php">Nouvelle course</a></li>-->

                            </ul>
                        </li>


                    <?php } ?>



                <?php  if (isset($_SESSION['user_type_id']) && (is_manager() || is_admin() || is_secretary() ) ) { ?>


                    <li
                        <?php if ( isset($active_menu) && $active_menu=="admin"){echo " class=\"dropdown active\"";} else {echo " class=\" dropdown\"";}?>
                        ><a href="#" data-toggle="dropdown">Administration<span class="caret"></span></a>

                    	<ul class="dropdown-menu">
                            <li><a href="manage_program.php">Manage Program</a></li>
                            <li><a href="admin.php">Manage Courses</a></li>
                            <li><a href="manage_chauffeur.php">Manage Chauffeur</a></li>
                            <li><a href="manage_client.php">Manage Client</a></li>
                            <li><a href="manage_admins.php">Manage Users</a></li>
                            <li><a href="manage_courses_modele.php">Table Modele</a></li>
                            <li><a href="manage_courses_modele_today_view.php">Aujourd'hui-Demain</a></li>
                            <li><a href="manage_links.php?category=Others">Manage Links</a></li>
                            <?php if(isset($_SESSION["admin_id"]) and is_admin() ) { ?>
                                <li><a href="logfile.php">Log File</a></li>
                            <?php } ?>

                            <li><a href="#">Manage Website</a></li>

                        </ul>
					</li>



                    <li
                        <?php if ( isset($active_menu) && $active_menu=="adminNew"){echo " class=\"dropdown active\"";} else {echo " class=\" dropdown\"";}?>
                        ><a href="#" data-toggle="dropdown">New<span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="new_course_program.php">Nouvelle course</a></li>
<!--                            <li><a href="new_course.php">New course</a></li>-->
                            <li><a href="new_course_modele.php">New Model </a></li>
                            <li><a href="new_client.php">New Client</a></li>
                            <li><a href="new_admin.php">New User</a></li>
                            <li><a href="new_chauffeur.php">New Chauffeur</a></li>
                            <li><a href="new_link.php">New_link</a></li>


                        </ul>
                    </li>


                    <li
                        <?php if ( isset($active_menu) && $active_menu=="modele"){echo " class=\"dropdown active\"";} else {echo " class=\" dropdown\"";}?>
                        ><a href="#" data-toggle="dropdown">Modele &amp;Program<span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="view_program_history.php">Course historique</a></li>
                            <li><a href="manage_program.php">Manage Program</a></li>
                            <li><a href="manage_courses_modele_today_view.php">Modele Aujourd'hui-Demain</a></li>
                            <li><a href="manage_courses_modele.php">Table Modele</a></li>
                            <li><a href="new_course_modele.php">NewModele</a></li>

                        </ul>
					</li>



                    <li
                        <?php if ( isset($active_menu) && $active_menu=="report"){echo " class=\"dropdown active\"";} else {echo " class=\" dropdown\"";}?>
                        ><a href="#" data-toggle="dropdown">Lesson<span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li><a href="lesson_git.php">Git</a></li>


                        </ul>
                    </li>




                <?php // } ?>
                <?php } ?>



                </ul>



                <?php

                ?>




                <ul class="nav navbar-nav navbar-right">
                    <?php
                    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)=date_fr();?>

                    <p class="navbar-text " style=""><?php echo $date_fr_long_hr; ?></p>

                    <?php  if (isset($_SESSION['user_type_id'])){ ?>

                       <li class="active"><a href="logout.php" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span><?php  echo "&nbsp;&nbsp;" ?><?php echo $username."&nbsp;&nbsp;"; ?>
                               <?php
                               $username=$_SESSION["username"];
                               if(file_exists("img/{$username}.JPG")){
                                   echo "<span><img class='img-thumbnail img-responsive img-circle'  src='img/{$username}.JPG' alt='{$username}'style='width:2em;height:2em;'</span>";
                               }
                               ?>
                               <span class="caret"></span></a>
                               <ul class="dropdown-menu">

                                   <?php if(isset($_SESSION["admin_id"]) and is_admin() ) { ?>
                                       <li><a href="logfile.php">Log File</a></li>
                                       <li><a href="upload.php">Upload file photo</a></li>

                                   <?php } ?>
                                   <li><a href="manage_admins_my_page.php">My Page</a></li>
                                   <li><a href="edit_admin_individual.php">Edit Info</a></li>
                                   <li class="divider"></li>
                                   <li><a href="logout.php">Logout</a></li>

                               </ul>



                           </li>

                    <?php } else {   ?>





                        <li<?php if ( isset($active_menu) && $active_menu=="login") {echo " class=\"active \"";} ?>
                            ><a href="login.php"><span class='glyphicon glyphicon-user' aria-hidden='true'></span><?php  echo "&nbsp;&nbsp;" ?>Login<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></a></li><?php } ?>






                </ul>




            </div>
         </nav>
    </div>

<?php  //  echo "<p class='text-left'><small>".$complete_date."</small></p>";?>


<?php  if (isset($_SESSION['user_type_id']) && (is_manager() || is_admin()|| is_chauffeur() ) ) { ?>

    <?php if ($layout_context == "admin") { ?>



<ol class="breadcrumb">

    <li
        <?php if ( isset($javascript) && $javascript=="admin_course") {echo "class=\"active \"";} // example good remove href for active?>
        ><a href="admin.php">Course</a></li>

    <li
        <?php if ( isset($active_menu) && $active_menu=="new_course") {echo "class=\"active \"";} ?>
        ><a href="new_course.php">New Course</a></li>

    <li
        <?php if ( isset($active_menu) && $active_menu=="new_modele") {echo "class=\"active \"";} ?>
        ><a href="manage_admins_my_page.php">My Page</a></li>

    <li
        <?php if ( isset($active_menu) && $active_menu=="new_modele") {echo "class=\"active \"";} ?>
        ><a href="edit_admin_individual.php">Edit Info</a></li>

<!--  <li><a href="google_map.php">Google map</a></li>-->
<!--    <li><a href="new_link.php">New_link</a></li>-->

    <li><a href="manage_courses_modele_today_view.php">Modele today</a></li>
    <li><a href="manage_program.php">Manage Program</a></li>
    <li><a href="view_program_history.php">Historic Program</a></li>
    <li><a href="new_course_program.php">New course program</a></li>






    <?php if(is_admin()&& is_kamy()) { ?>
&nbsp;&nbsp;

        <div class="btn-group">
            <button type="button" class="btn btn-default">Test</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="new_course_program.php?program_id=13">new_course_program id 13</a></li>
                <li><a href="new_course_program.php?program_id=27">new_course_program id 27</a></li>
                <li><a href="new_course_program.php?program_id=4">new_course_program id 4 </a></li>
                <li><a href="2_modele.php">ModeleTest2</a></li>



                <li class="a-rech divider"></li>

                <li><a href="1_modele.php">Modele1</a></li>
                <li><a href="1_modele.php?program_id=27">Modele1 id 27</a></li>
                <li><a href="1_modele.php?program_id=27">Modele1 No id </a></li>


                <li><a href="5_modele.php">ModeleTest5</a></li>
                <li><a href="6_modele.php">ModeleTest6</a></li>
                <li><a href="7_modele.php">ModeleTest7</a></li>
                <li><a href="8_modele.php">ModeleTest8</a></li>

                <li><a href="3_modele_recherche.php">recherche</a></li>

                <li class="a-rech divider"></li>
                <li><a href="4_modele_time.php">Test_time</a></li>
                <li><a href="10_modele_time.php">Alert collapse </a></li>

                <li class="divider"></li>

            </ul>
        </div>


    <?php } ?>
</ol>

    <?php } ?>


<?php } ?>



<?php if(isset($incl_message_error) &&($incl_message_error)) {?>

    <div class="row">
        <?php echo message(); ?>
        <?php if(isset($errors)) echo form_errors($errors); ?>
        <?php if(isset($warnings)) echo form_warnings($warnings); ?>

    </div>


<?php } ?>



