<?php require_once('../includes/initialize.php'); ?>



<?php $layout_context = "admin"; ?>
<?php  $active_menu="admin" ?>
<?php $stylesheets="courses"  ?>
<?php $javascript="admin_course" ?>
<?php $fluid_view=false ?>
<?php $incl_message_error=true ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>


<h4 class="text-center">Manage something template </h4>



<div class="row">
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
        </ul>

    </div>
    </div>
    <hr>
    </div>




<div id="form_recherche" class="row">

<form class="form-inline " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<div class="row">

    <div class="form-group">
            <label for="exampleInputName2">Name</label>
            <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail2">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
        </div>
    </div>


    <div class="row">
        <div class="form-group">
            <label for="exampleInputName2">Name</label>
            <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail2">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


<div class="row">
<div class="panel panel-default col-md-12"  id="mes_courses">
    <!-- Default panel contents -->
    <div class="panel-heading">
   Recherche parameters of get request

    </div>




<div class="table-responsive">
   <table class='table table-striped table-bordered table-hover table-condensed'>
        <tr>
            <th class="col-1">Col1</th>  <?php //  ?>
            <th class="col-2">Col2</th>
            <th class="col-3">Col3</th>
        </tr>

        <tr class="success hide-success">
            <td class="col-1">Col1 td</td>
            <td class="col-2">Col1 td</td>
            <td class="col-3">Col1 td</td>
        </tr>

        <tr  class=" danger hide-danger">
           <td class="col-1">Col1 td</td>
           <td class="col-2">Col1 td</td>
           <td class="col-3">Col1 td</td>
        </tr>

        <tr  class="hide-others">
           <td class="col-1">Col1 td</td>
           <td class="col-2">Col1 td</td>
           <td class="col-3">Col1 td</td>
        </tr>

    </table>

</div>    <!--table resonsive-->
</div>    <!--div panel->
</div>   <!-- roe -->



<script type="text/javascript">
    $("document").ready(function() {
        //$("p").css("border", "3px solid red");
        //$(".a").css("border", "3px solid red");
        //$("#example").css("border", "3px solid red");
        //$("p.b").css("border", "3px solid red");
    });



</script>




<?php include ("../includes/layouts/footer_2.php");?>
