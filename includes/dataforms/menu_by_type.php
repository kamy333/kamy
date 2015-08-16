


<div>
<li><a href="admin.php">Admin</a></li>

<li><a href="_basic_test.php">basic_test</a></li>

    <hr>
    Mes details
<li><a href="edit_admin_individual.php"> Edit my details</a></li>

    <hr>

Course
<li><a href="admin.php">Main</a></li>
<li><a href="new_course.php">Input Course</a></li>



<?php  if( is_chauffeur()) { ?>


<?php  } elseif (is_secretary()) {?>




<?php  } elseif (is_manager()) {?>


    <hr>
    Administration
    <li><a href="manage_content.php">Manage Website </a></li>
    <li><a href="manage_admins.php">Manage Admin Users</a></li>
    <li><a href="manage_chauffeur.php">Manage Chauffeur</a></li>
    <li><a href="manage_client.php">Manage Client</a></li>

    <li><a href="manage_courses_programme.php">Programmation course</a></li>
    <hr>
    Modele
    <li><a href="manage_courses_modele.php">Modele Course</a></li>
    <li><a href="new_course_modele.php">New Modele Course</a></li>





<?php } else { ?>
    <hr>
    Administration
    <li><a href="manage_content.php">Manage Website </a></li>
    <li><a href="manage_admins.php">Manage Admin Users</a></li>
    <li><a href="manage_chauffeur.php">Manage Chauffeur</a></li>
    <li><a href="manage_client.php">Manage Client</a></li>

    <li><a href="manage_courses_programme.php">Programmation course</a></li>
    <hr>
    Modele
    <li><a href="manage_courses_modele.php">Modele Course</a></li>
    <li><a href="new_course_modele.php">New Modele Course</a></li>



<?php  } ?>

    <hr>
    <li><a href="logout.php">Logout</a></li>

</div>


