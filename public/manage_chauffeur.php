<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>

<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php $chauffeur_set=find_all_chauffeurs () ?>


<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>


<h4 class="text-center"><mark>Table des chauffeurs</mark></h4>

<!--<div id="main">-->
<!---->
<!--    <div id="page">-->
<!--        --><?php //echo message(); ?>
<!--        <h2>Administrer Chauffeur</h2>-->
<!--        <br>-->
<!--        <hr>-->
<!--    </div>-->
<!---->
<!--</div-->

        <div class="row">
            <div class="col-md-5 col-md-offset-3">


>

        <div class='table-responsive'>



        <table class='table table-striped table-bordered table-hover table-condensed'>



            <tr>
                <th class="text-center">Nom</th>
                <th class="text-center">Initial</th>
                <th class="text-center">Company</th>


                <th colspan="2" style="text-align: center;">Actions</th>
            </tr>

            <?php while($chauff = mysqli_fetch_assoc($chauffeur_set)) { ?>
                <tr>
                    <td  class="text-center"><?php echo htmlentities($chauff["chauffeur_name"], ENT_COMPAT, 'utf-8'); ?></td>
                    <td  class="text-center"><?php echo htmlentities($chauff["initial"], ENT_COMPAT, 'utf-8'); ?></td>
                    <td  class="text-center"><?php echo htmlentities($chauff["company"], ENT_COMPAT, 'utf-8'); ?></td>


                    <td   class="text-center"><a href="edit_chauffeur.php?id=<?php echo urlencode($chauff["id"]); ?>">Edit</a></td>
                    <td   class="text-center"><a href="delete_chauffeur.php?id=<?php echo urlencode($chauff["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

    </div>


        <br />
       <p class="text-right"> <a href="new_chauffeur.php">Add new chauffeur</a> </p>

    </div>
</div>
<?php include("../includes/layouts/footer_2.php"); ?>


