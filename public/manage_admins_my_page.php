<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>

<?php
  $admin = find_admin_by_id($_SESSION["admin_id"]);
  
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_admins.php");
  }
?>



<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<div class="row">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
</div>

<div class="row">
    <div class="col-md-12  col-lg-12 ">

      <div class=" row text-center" ">
    <h2>Bienvenue sur votre page <mark><?php echo htmlentities($admin["nom"]);?></mark></h2>
      </div>
    </div>




          <div class="row">

               <div class="col-md-3 col-md-offset-4  col-lg-3 col-md-offset-4 ">
                <?php echo "<p><span>". get_user_img(18,20) ."</span></p>" ?>
              </div>

              <div class="text-left col-md-5 col-lg-5">
                    <br><br>
                    <dl class="dl-horizontal">
                    <dt>Username</dt>
                    <dd><mark><?php echo $_SESSION["username"];?></mark></dd>
                    <dt>Nom</dt>
                    <dd><mark><?php echo $_SESSION["nom"];?></mark></dd>
                    <dt>User Type</dt>
                    <dd><mark><?php echo $_SESSION["user_type"];?></mark></dd>
                    <dt>Email</dt>
                    <dd><mark><?php echo $admin["email"];?></mark></dd>
                    <dt> </dt>
                    <dd> </dd>
                    <dt> </dt>
                    <dd><a href="edit_admin_individual.php">Edit password or email</a></dd>
                </dl>
              </div>



          </div>

<?php include("../includes/layouts/footer_2.php"); ?>
