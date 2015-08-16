<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/db_connection.php"); ?>
<?php //require_once("../includes/functions.php"); ?>


<?php require_once('../includes/initialize.php'); ?>

<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('admin.php');}?>


<?php
  $admin_set = find_all_admins();
?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets="custom_form"  ?>
<?php $javascript="form_admin" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<div class="row">
    <?php echo message(); ?>
    <?php $errors = errors(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>

    <h4 class="text-center">Administration user <small> Your actually using username:<mark> <?php echo $_SESSION["username"];?></mark></small>
        <?php
        $username=$_SESSION["username"];
        if(file_exists("img/{$username}.JPG")){
            echo "<span><img class='img-thumbnail img-responsive img-circle'  src='img/{$username}.JPG' alt='{$username}'style='width:3em;height:3em;'</span>";
        }
        ?>
    </h4>
</div>

<?php  ?>

<div class="row">
    <div class="col-md-9 col-md-offset-1 col-lg-9 col-lg-offset-1">
      <div class='table-responsive'>
      <table class='table table-striped table-bordered table-hover table-condensed'>


      <tr>

          <th class="text-center">Username</th>
          <th class="text-center">Email</th>
          <th class="text-center" >Name</th>
          <th class="text-center">User type</th>
          <th class="text-center">User type id</th>
          <th class="text-center">photo</th>

          <th colspan="2" class="text-center">Actions</th>
      </tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
      <tr>
        <td class='text-center'><?php echo htmlentities($admin["username"]); ?></td>
<!--    <td><?php //echo htmlentities($admin["hashed_password"]); ?></td>--> 
       <td class='text-center'><?php echo htmlentities($admin["email"]); ?></td>
        <td class='text-center'><?php echo htmlentities($admin["nom"]); ?></td>
        <td class='text-center'><?php echo htmlentities($admin["user_type"]); ?></td>
        <td class="text-center"><?php echo htmlentities($admin["user_type_id"]); ?></td>
          <?php
          $username=$admin["username"];
          if(file_exists("img/{$admin["username"]}.JPG")){
          echo "<td class='text-center'><img class='img-thumbnail img-responsive'  src='img/{$username}.JPG' alt='{$username}'style='width:2em;height:2em;'></td>";
          }else{
          // if no picture
          echo"<td></td>";
          }
          ?>


        <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
        <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
      </tr>
    <?php } ?>
    </table>

      </div>

</div>
</div>


    
   <div class="row">
    <p class="text-center"><a href="new_admin.php">Add new admin</a></p>
</div>



<?php include("../includes/layouts/footer_2.php"); ?>


            