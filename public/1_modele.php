<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<h4 class="text-center"><mark><a href="<?php echo $_SERVER["PHP_SELF"] ?>">my modele</a> </mark></h4>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Summary</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
           aaaaaaaaaaaa
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
bbbbbbbbbb
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            ccccccccc
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">

            <div class="col-md-3  ">
                <?php echo nav_menu_pills_program() ;?>
                <?php  echo  get_output_panel_program();?>
            </div>
        </div>
    </div>

</div>



<?php include("../includes/layouts/footer_2.php"); ?>
