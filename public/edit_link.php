<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>
<?php if(is_chauffeur()){ redirect_to('manage_program.php');}?>

<?php $link = find_links_by_id($_GET["links_id"]);?>


<?php
$errors = array();
$missing = array();

if (isset($_GET["url"])) {
    $url=$_GET["url"];
} else {
    $url="mylinks.php";

}


if (isset($_POST['submit_links'])) {

// see introducing php
$expected = array("name","web_address","description","category","sub_category_1","sub_category_2","privacy","rank","username");

$required_fields = array("name","web_address","category","username","rank");
//  validate_presences($required_fields);



    foreach ($_POST as $key => $value) {
        $temp = is_array($value) ? $value : trim($value);
        if (empty($temp) && in_array($key, $required_fields)) {
            $missing[] = $key;
            $$key = '';
        } elseif(in_array($key, $expected)) {
            $$key = mysql_prep($temp);
        }
    }

    $id=$link['id'];

    if(empty($missing) && empty($errors)){



        $query  = "UPDATE links SET" . " ";
        $query .= "name = '{$name}' , ";
        $query .= "web_address = '{$web_address}' , ";
        $query .= "description = '{$description}' , ";
        $query .= "category = '{$category}' , ";
        $query .= "sub_category_1 = '{$sub_category_1}' , ";
        $query .= "sub_category_2 = '{$sub_category_2}' , ";
        $query .= "privacy = {$privacy} , ";
        $query .= "rank = {$rank} , ";
        $query .= "username = '{$username}' ";
        $query .= "WHERE id = {$id} ";
        $query .= "LIMIT 1";


         $result = mysqli_query($connection, $query);


        if ($result && mysqli_affected_rows($connection) == 1) {
            // Success
            $_SESSION["message"] = "Link successfully updated.";
            $_SESSION["OK"] = true;
         //   unset($_POST);
            redirect_to($url);

        } elseif ($result && mysqli_affected_rows($connection) == 0) {
            $_SESSION["message"] = "link update failed because no change was made compare to what existed in db already.";

         //   unset($_POST);
            redirect_to($url);



        } else {
            // Failure
            $_SESSION["message"] = "Link update failed.";
         //   unset($_POST);
            redirect_to($url);

        }





    }



}




?>




<?php $layout_context = "admin"; ?>
<?php $active_menu="admin" ?>
<?php $stylesheets=""  ?>
<?php $fluid_view=true ?>
<?php $javascript="" ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<!--<h4 class="text-center"><mark>Add a link</mark></h4>-->

<div class="row">
    <?php echo message(); ?>
    <?php if(isset($errors)) echo form_errors($errors); ?>
    <pre>
<!--    --><?php //if(isset($query)){echo $query;} ?>
<?php if(isset($_POST)){print_r($_POST) ;} ?>
<!--    --><?php //if(isset($name)){echo ($name) ;} ?>
<!--    --><?php //if(isset($missing)){echo ($missing) ;} ?>
    </pre>
</div>


<div class="row">
    <div class="col-md-5 col-md-offset-2 col-lg-5 col-lg-offset-2">

        <div class ="background_light_blue">



            <form name="form_client"  class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?links_id=<?php echo urlencode($link["id"]); ?>">

                <fieldset id="login" title="Client">
                    <legend class="text-center" style="color: #0000ff">New link</legend>

                   <div class="col-md-offset-3">
                        <?php if ($errors || $missing) { ?>
                            <p class="my_warning">Please fix the item(s) indicated.</p>
                            <br>
                        <?php }?>
                    </div>

                    <div class="form-group">


                        <label   class="col-sm-3 control-label" for="name">Nom</label>
                        <div class="col-sm-9">
                            <?php if ($missing && in_array('name', $missing)) { ?>
                            <span class="my_warning">Please enter your name</span>
                            <?php } ?>
                            <input   class="form-control"  type="text" name="name" id="name"  placeholder="nom pour table" value="<?php if(isset($link)) {echo htmlentities($link['name'], ENT_COMPAT, 'utf-8');}?>" >
                        </div></div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label" for="web_address">www</label>
                        <div class="col-sm-9">
                            <?php if ($missing && in_array('web_address', $missing)) { ?>
                            <span class="my_warning">Please enter your www address</span>
                            <?php } ?>
                            <textarea name="web_address"  class="form-control"  id="web_address"><?php  if(isset($link)) {  echo htmlentities($link['web_address'], ENT_COMPAT, 'utf-8');}?></textarea>
                        </div></div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label" for="description">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description"  class="form-control"  id="description"><?php  if(isset($link)) {  echo htmlentities($link['description'], ENT_COMPAT, 'utf-8');}?></textarea>
                        </div></div>


                    <div class="form-group">
                        <label  class="col-sm-3 control-label"  for="category">category</label>
                        <div class="col-sm-9">
                            <?php if ($missing && in_array('category', $missing)) { ?>
                                <span class="my_warning">Please enter your category</span>
                            <?php } ?>
                            <select  class="form-control"  name="category" id="category" required>
                                <?php
                                if ((isset($link))) {
                                    echo "<option value="."'". htmlentities($link['category'],ENT_COMPAT,'utf-8') . "'". " selected>" . htmlentities($link['category'],ENT_COMPAT,'utf-8')."</option>";
                                }  else {
                                    echo "<option value='' disabled selected>category eg php</option>";
                                }
                                ?>
                                <?php echo get_links_category_option();?>
                            </select>
                        </div></div>


                    <div class="form-group">
                        <label   class="col-sm-3 control-label" for="sub_category_1">Sub Category 1</label>
                        <?php if ($missing && in_array('sub_category_1', $missing)) { ?>
                            <span class="my_warning">Please enter your sub_category_1</span>
                        <?php } ?>
                        <div class="col-sm-9">
                            <input   class="form-control"  type="text" name="sub_category_1" id="sub_category_1"  placeholder="Sub Category 1" value="<?php if(isset($link)) {echo  htmlentities($link['sub_category_1'], ENT_COMPAT, 'utf-8');}?>" >
                        </div></div>

                    <div class="form-group">
                        <label   class="col-sm-3 control-label" for="sub_category_2">Sub Category 2</label>
                        <?php if ($missing && in_array('sub_category_2', $missing)) { ?>
                            <span class="my_warning">Please enter your sub_category_2</span>
                        <?php } ?>
                        <div class="col-sm-9">
                            <input   class="form-control"  type="text" name="sub_category_2" id="sub_category_2"  placeholder="Sub Category 2" value="<?php if(isset($link)) {echo
htmlentities($link['sub_category_2'], ENT_COMPAT, 'utf-8');}?>" >
                        </div></div>

                    <div class="col-md-offset-3">

                    <?php if ($missing && in_array('privacy', $missing)) { ?>
                        <span class="my_warning">Please enter your privacy</span>
                    <?php } ?>
                        </div>
                    <div class="form-group">

                        <label   class="col-sm-3 control-label" >Privacy</label>
                        <label class="radio-inline" for="privacy_no">
                        <input type="radio" name="privacy" value="0"  id="privacy_no" <?php if(isset($link)&& $link['privacy']==0 ) {echo  'checked';} ?>  >
                            Non
                        </label>

                        <label class="radio-inline" for="privacy_yes">
                            <input type="radio" name="privacy" value="1"  id="privacy_yes" <?php if(isset($link)&& $link['privacy']==1) {echo  'checked';}?> >
                            Oui
                        </label>
                    </div>


                    <div  class="form-group">

                        <label   class="col-sm-3 control-label" for="rank" >Ordre des données (No)</label>
                        <div class="col-sm-9">
                            <?php if ($missing && in_array('rank', $missing)) { ?>
                                <span class="my_warning">Please enter rank</span>
                            <?php } ?>
                            <input   class="form-control"  type="text"  name="rank" id="rank"  placeholder="Chiffre pour l'ordre" value="<?php if(isset($link)) {echo  htmlentities($link['rank'], ENT_COMPAT, 'utf-8');}?>">
                        </div></div>


                    <div class="hide form-group">
                            <label   class="col-sm-3 control-label" for="username">Username</label>
                            <div class="col-sm-9">
                                <?php if ($missing && in_array('username', $missing)) { ?>
                                    <span class="my_warning">Please enter your username</span>
                                <?php } ?>
                                <input   class="form-control"  type="text" name="username" id="username"  placeholder="username" value=<?php if(isset($_SESSION["username"])) {echo  htmlentities($_SESSION["username"], ENT_COMPAT, 'utf-8');}?> >
                            </div></div>


                </fieldset>

                <div class="col-sm-offset-3 col-sm-7 col-xs-3">
                    <button type="submit" name="submit_links" class="btn btn-primary">Edit</button>
                </div>

                <div class="text-right " >
                    <a href="<?php if(isset($url)){echo $url;} ?>" class="btn btn-info " role="button">Cancel</a>
                </div>


            </form>
</div>
        </div>
<!--    </div>-->
<!---->
<!---->
<!---->
<!--<div class="row">-->

</div>







<?php include("../includes/layouts/footer_2.php"); ?>
