<?php
/**
 * Created by PhpStorm.
 * User: Kamran
 * Date: 6/10/2015
 * Time: 11:22 AM
 */

function find_links_by_id ($link_id){
    global $connection;

    $safe_link_id = mysqli_real_escape_string($connection, $link_id);

    $query  = "SELECT * ";
    $query .= "FROM links ";
    $query .= "WHERE id = {$safe_link_id} ";
//    if ($public) {
//        $query .= "AND visible = 1 ";
//    }
    $query .= "ORDER BY category ASC ";
    $query .= "LIMIT 1";
    $link_set = mysqli_query($connection, $query);
    confirm_query($link_set);
    if($link = mysqli_fetch_assoc($link_set)) {
        return $link;
    } else {
        return null;
    }
}


function find_all_links (){

    global $connection;

    // get request

    if (isset($_GET['category'])){
        $category= $_GET['category'];
    } else {
        $category= null;

    }

    $query  = "SELECT * ";
    $query .= "FROM links ";

    if ($category) {
        $query .= "WHERE category = '{$category}'";

    }

    $query .= "ORDER BY rank ASC";
    $link_set = mysqli_query($connection, $query);
    confirm_query($link_set);
    return $link_set;

}

function find_name_category_links ($name_category=null){

    global $connection;

    $safe_name_category=mysql_prep($name_category);

    $query  = "SELECT * ";
    $query .= "FROM links ";

    if ($name_category) {
        $query .= "WHERE category = '{$safe_name_category}'";

    }

    $query .= "ORDER BY rank ASC";
    $link_set = mysqli_query($connection, $query);
    confirm_query($link_set);
    return $link_set;

}

function find_all_category_from_links (){

    global $connection;

//    if (isset($_GET['category'])){
//        $category= $_GET['category'];
//    } else {
//        $category= null;
//
//    }

    $query  = "SELECT DISTINCT category FROM links ";
    //$query .= "FROM links_category ";

//    if ($category) {
//        $query .= "WHERE category = '{$category}'";
//
//    }

    $query .= "ORDER BY id ASC";
    $category_set = mysqli_query($connection, $query);
    confirm_query($category_set);
    return $category_set;

}






function find_all_category (){

    global $connection;

//    if (isset($_GET['category'])){
//        $category= $_GET['category'];
//    } else {
//        $category= null;
//
//    }

    $query  = "SELECT * ";
    $query .= "FROM links_category ";

//    if ($category) {
//        $query .= "WHERE category = '{$category}'";
//
//    }

    $query .= "ORDER BY id ASC";
    $category_set = mysqli_query($connection, $query);
    confirm_query($category_set);
    return $category_set;

}

function get_search_category(){

    $category_set = find_all_category_from_links();



    $output="";
    $output.="<ul class='nav nav-pills '>";


    if (!isset($_GET['category'])){
        $active1="active";
    } else {
        $active1="";
    }


    $output.="<li role='presentation' class='{$active1}'><a href=" ;
    $output.="new_link.php";
    $output.=">New</a></li>";

    $output.="<li role='presentation' class='{$active1}'><a href=" ;
    $output.=$_SERVER['PHP_SELF'];
    $output.=">All</a></li>";


    while($category = mysqli_fetch_assoc($category_set)) {

        $categ=$category['category'];



        if (isset($_GET['category']) && $_GET['category']==$categ){
            $active="active";
        } else {
            $active="";
        }

        $output.="<li role='presentation' class='{$active}'><a href=" ;
        $output.=$_SERVER['PHP_SELF'];
        $output.="?category=";
        $output.=urlencode($categ);
        $output.=">{$categ}</a></li>";


    }


    $output.="</ul>";
    mysqli_free_result($category_set);

    return $output;

}


function get_modal_body_links ($link_id){
    $link = find_links_by_id($link_id);
    //   $client= find_client_by_id($program["client_id"]);

    $grid = "<div class='row'>";
    $grid1 = "<div class='col-md-12  col-lg-12'>";
//   $grid2="<div class='col-md-10 col-lg-10'>";
//
//   $grid3="</div>";
    $grid_2_DIV = "</div></div>";

    $grid = "";
    $grid1 = "";
    $grid2 = "";
    $grid_2_DIV = "";

    $grid_head = $grid . $grid1;

    $modal_body = "<dl class='dl-horizontal dd-color-blue'>";
    // $modal_body="<dl>";
    // $modal_body .="{$grid}<dt><strong>Pseudo</strong></dt><dd>". htmlentities($client['pseudo'], ENT_COMPAT, 'utf-8')."</dd>{$grid1}";
    // $modal_body .="{$grid}<dt><strong>Nom</strong></dt><dd>".htmlentities($client['web_view'], ENT_COMPAT, 'utf-8') ."</dd>{$grid1}";


    foreach ($link as $key => $val) {
        $key_clean = ucfirst(str_replace("_", "  ", $key));
        if ($key == "name") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>Nom:" . "</strong></dt>";
            $modal_body .= "";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8') . "</dd>";
            $modal_body .= "{$grid_2_DIV}";
        } elseif ($key == "privacy") {
            if ($val == 0) {
                $val_yes_no = "Non";
            } else {
                $val_yes_no = "Oui";
            }
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>" . htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd> " . htmlentities($val_yes_no, ENT_COMPAT, 'utf-8') . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        } elseif ($key == "rank") {

            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>" . htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd> " . htmlentities($val, ENT_COMPAT, 'utf-8') . "</dd>";
            $modal_body .= "{$grid_2_DIV}";


        } elseif ($key == "description") {
            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>" . htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd> " . htmlentities($val, ENT_COMPAT, 'utf-8') . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

            //  $modal_body .= "";
            //     $link="<span><a style='color: palevioletred' href='edit_visible_modele_course.php?modele_id=". urlencode($modele["id"])."'>".htmlentities($val_yes_no , ENT_COMPAT, 'utf-8')."</a> </span>";


            //    $modal_body .= "<dd> " . $link  . "</dd>";

        } elseif ($key == "web_address") {
        } elseif ($key == "username") {
//        } elseif($key=="prix_course") {
//            if(!is_chauffeur()){
//                $modal_body .= "{$grid_head}";
//                $modal_body .= "<dt><strong>".htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
//                $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . " frs</dd>";
//                $modal_body .= "{$grid_2_DIV}";
//            }
//        } else {
//            $modal_body .= "{$grid_head}";
//            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
//            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
//            $modal_body .= "{$grid_2_DIV}";
//        }



        } else {

            $modal_body .= "{$grid_head}";
            $modal_body .= "<dt><strong>". htmlentities($key_clean, ENT_COMPAT, 'utf-8') . ":</strong></dt>";
            $modal_body .= "<dd>" . htmlentities($val, ENT_COMPAT, 'utf-8')  . "</dd>";
            $modal_body .= "{$grid_2_DIV}";

        }


    }

    $modal_body .= "</dl>";

    return $modal_body;



}

function get_modal_link($link_id){

    // modal

    $link = find_links_by_id($link_id);

    $div_id="myLinkprogram{$link_id}";

    $output = "";

    //   $output .= "";



    $output="";



    $output.= "<a class='' style='width:1em;' href='#' data-toggle='modal' data-target='#{$div_id}'>";
    $output.="<span class=\"glyphicon glyphicon-info-sign\" style='color: #0000ff;' aria-hidden='true'>";
    // $output.= "".htmlentities($link['id'],ENT_COMPAT, 'utf-8');
    $output.="</span>";
    $output.= "</a>";


// below is modal mode not shown (hidden)
    $output .= "<div class='modal fade' id='{$div_id}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    $output .= "    <div class='modal-dialog'>";
    $output .= "        <div class='modal-content'>";
    $output .= "            <div class='modal-header'>";
    $output .= "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $output .= "                <h5 class='modal-title' id='myModalLabel'>link".htmlentities( $link['name'], ENT_COMPAT, 'utf-8')."</strong> Categ :". htmlentities($link['category'], ENT_COMPAT, 'utf-8')."</strong></h5>";
    $output .= "            </div>";
    $output .= "            <div class='modal-body'>";

    //function of body of modal
    $p_edit="edit_link.php";
    $p_del="delete_link.php";
    $p_new="new_link.php";
    // $p_validation="";
    // $p_validation_mgr="";

    $output .= "<div class='container-fluid text-left'> ";

    $output .= get_modal_body_links($link_id);;

    //   $output .= "<div class='container-fluid text-right'> ";
    //   $output .= "                <button type='button' class='btn btn-default' data-dismiss='modal'>&nbsp;Close&nbsp;</button>";
    //  $output .= "</div>";





    $output .= "</div>";


    $output .= "            </div>";

    $style_width_button="style='width: 6em;'";


    $output .= "            <div class='modal-footer'>";
    $output .= "                <div class='btn-group btn-group-justified' role='group' aria-label='...'>";
    $output .= "                <p class='btn'  ><a class='btn btn-primary btn-xm'{$style_width_button} href='{$p_edit}?links_id=".urlencode($link_id)."'>Edit</a></p>";
    $output .= "                <p class='btn'><a class='btn btn-danger btn-xm' {$style_width_button} href='{$p_del}?links_id=".urlencode($link_id)."'>Delete</a></p>";
    $output .= "                <p class='btn' ><a class='btn btn-success btn-xm' {$style_width_button} href='{$p_new}?links_id=".urlencode($link_id)."'>add</a></p>";

    $output .= "                <p class='btn' data-dismiss='modal'><a class=' btn btn-info btn-xm' {$style_width_button}>close</a> </p>";

    $output .= "                </div>";



    $output .= "            </div>";
    $output .= "        </div>";
    $output .= "    </div>";
    $output .= "</div>";


    return $output;
}


function get_links_category_option(){
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM links_category ";
    $query .= "ORDER BY id";
    $category_set = mysqli_query($connection, $query);
    confirm_query($category_set);
    //   return $link_set;

    $output="";

    while($category = mysqli_fetch_assoc($category_set)) {

        $output.="<option value='";
        $output.=htmlentities($category['category'], ENT_COMPAT, 'utf-8');
        $output.="'>";
        $output.=htmlentities($category['category'], ENT_COMPAT, 'utf-8');
        $output.="</option>";

    }

    return $output;
}



function get_links_category_list(){
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM links_category ";
    $query .= "ORDER BY id";
    $category_set = mysqli_query($connection, $query);
    confirm_query($category_set);
    //   return $link_set;
    $output="";

    $output.="   <div class='panel panel-default'>";
    $output.=" <!-- Default panel contents -->";
    $output.=" <div class='panel-heading text-center'>Category</div>";
    //  $output.=" <div class='panel-body'>";
    // $output.="   <p>Category</p>";
    //  $output.=" </div>";


    $output.=" <ul class='list-group'>";
//     $output.="   <li class='list-group-item'>Cras justo odio</li>";
//     $output.="   <li class='list-group-item'>Dapibus ac facilisis in</li>";
//     $output.="   <li class='list-group-item'>Morbi leo risus</li>";
//     $output.="   <li class='list-group-item'>Vestibulum at eros</li>";



    while($category = mysqli_fetch_assoc($category_set)) {
        $edit="";
        $del="";

        $categ=htmlentities($category['category'], ENT_COMPAT, 'utf-8');
        $edit.="<a href='edit_link_category.php?categ=".urlencode($category['id']);
        $edit.="'>";
        $edit.="<span class='glyphicon glyphicon-pencil' style='color: #0000ff;' aria-hidden='true'>";
        $edit.="</span>";
        $edit.="'</a>";

        $del.="<a href=\"delete_link_category.php?categ=";
        $del.=urlencode($category['id']);
        $del .=" \" onclick=\"return confirm('Are you sure to delete {$categ} ?');";
        $del.="\">";
        $del.="<span class='glyphicon glyphicon-remove' style='color: #ff0000;' aria-hidden='true'>";
        $del.="</span>";
        $del.="'</a>";

        $output.="   <li class='list-group-item text-center'>{$categ} &nbsp;&nbsp; {$edit}&nbsp;&nbsp; {$del}</li>";



    }
    $output.=" </ul>";
    $output.="</div>";
    return $output;
}



function output_links($name_category=null){


    If(!$name_category){
        $link_set=find_all_links();

        if (isset($_GET['category'])){
            $category= $_GET['category'];
        } else {
            $category= "All";

        }
    } else {
        $link_set=find_name_category_links($name_category);
        $category=$name_category;
    }

    $output="";

    $output .="<div class='table-responsive'>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";





    $output .="<tr>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Action</th>";
    $output .= "<th class='text-center' style='vertical-align:middle;'>{$category}</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Category</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Description</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Category1</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>Category2</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>privacy</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>rank</th>";
//    $output .= "<th class='text-center' style='vertical-align:middle;'>username</th>";


    $output.="</tr>";
//    $output.="";
//    $output.="";
//    $output.="";
//    $output.="";



    while($link = mysqli_fetch_assoc($link_set)) {

        $link_id=$link{'id'};
        $web=$link['web_address'];
        $name=htmlentities($link['name'], ENT_COMPAT, 'utf-8');
        $href="<a target='_blank' href='{$web}'>{$name}</a>";
        $modal="<small>".get_modal_link($link_id)."</small>";

        $output .="<tr>";
        //  $output.= "<td class='text-center'>" . "" . "</td>";


        If(!$name_category) {
            $output .= "<td class='text-center'>" . $href . "&nbsp;&nbsp; " . $modal . "</td>";

        } else {
            $output.="<td class='text-center'>".$href."&nbsp;&nbsp; "."</td>";

        }


        // $output.="<td class='text-center'>".htmlentities($link['category'], ENT_COMPAT, 'utf-8')."</td>";


//        $output.="<td class='text-center'>".htmlentities($link['description'], ENT_COMPAT, 'utf-8')."</td>";
//        $output.="<td class='text-center'>".htmlentities($link['sub_category_1'], ENT_COMPAT, 'utf-8')."</td>";
//        $output.="<td class='text-center'>".htmlentities($link['sub_category_2'], ENT_COMPAT, 'utf-8')."</td>";
//        $output.="<td class='text-center'>".htmlentities($link['privacy'], ENT_COMPAT, 'utf-8')."</td>";
//        $output.="<td class='text-center'>".htmlentities($link['rank'], ENT_COMPAT, 'utf-8')."</td>";
//        $output.="<td class='text-center'>".htmlentities($link['username'], ENT_COMPAT, 'utf-8')."</td>";


        $output .="</tr>";
    }



    $output .="</table>";
    mysqli_free_result($link_set);
    $output .="</div>";

    return $output;

}

