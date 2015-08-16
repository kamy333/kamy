<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/16/2014
 * Time: 11:12 PM
 */

function find_all_clients() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM clients ";
    $query .= "ORDER BY liste_rank ASC , pseudo ASC";
    $client_set = mysqli_query($connection, $query);
    confirm_query($client_set);
    return $client_set;
}


function find_client_by_id($client_id) {
    global $connection;

    $safe_client_id = mysqli_real_escape_string($connection, $client_id);

    $query  = "SELECT * ";
    $query .= "FROM clients ";
    $query .= "WHERE id = {$safe_client_id} ";
    $query .= "LIMIT 1";
    $client_set = mysqli_query($connection, $query);
    confirm_query($client_set);
    if($client = mysqli_fetch_assoc($client_set)) {
    //    mysqli_free_result($client_set);
        return $client;

    } else {
        return null;
    }
}



function find_client_from_pseudo($pseudo){
    global $connection;

    $safe_pseudo= mysqli_real_escape_string($connection,$pseudo);

    $query  = "SELECT * ";
    $query .= "FROM clients ";
    $query .= "WHERE pseudo = '{$safe_pseudo}' ";
    $query .= "LIMIT 1";
    $client_set = mysqli_query($connection, $query);
    confirm_query($client_set);
    if($client = mysqli_fetch_assoc($client_set)) {
        return $client;
    } else {
        return null;
    }


}











function  find_client_query( $pseudo=null,$liste_restrictive=null,$web_view=null,$last_name=null,$first_name=null,$address=null,$liste_rank=null){

    global $connection;
    global $errors;

    //$table_name="clients";
    $safe_pseudo= mysqli_real_escape_string($connection,$pseudo);
    $safe_liste_restrictive= mysqli_real_escape_string($connection,$liste_restrictive);
    $safe_web_view= mysqli_real_escape_string($connection,$web_view);
    $safe_last_name= mysqli_real_escape_string($connection,$last_name);
    $safe_first_name= mysqli_real_escape_string($connection,$first_name);
    $safe_address= mysqli_real_escape_string($connection,$address);
    $safe_liste_rank= mysqli_real_escape_string($connection,$liste_rank);





    $query ="SELECT * FROM clients ";

    $whereAnd="WHERE ";

    if($safe_pseudo){
        $query.="{$whereAnd} pseudo='{$safe_pseudo}' ";
        $whereAnd=" AND ";
    }


    if($safe_liste_restrictive !==""){
        $safe_liste_restrictive= (int) $safe_liste_restrictive;
        $query.="{$whereAnd} liste_restrictive={$safe_liste_restrictive} ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND "){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }

    if($safe_web_view){
        $query.=" {$whereAnd} web_view='{$safe_web_view}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND"){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if($safe_last_name){
        $query.=" {$whereAnd} last_name='{$safe_last_name}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND"){
        $whereAnd=" AND ";
    } else{
        $whereAnd=" WHERE ";
    }


    if($safe_first_name){
        $query.=" {$whereAnd} first_name='{$safe_first_name}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND"){
        $whereAnd=" AND ";
    } else{
        $whereAnd="WHERE ";
    }


    if($safe_address){
        $query.=" {$whereAnd} address='{$safe_address}' ";
        $whereAnd=" AND ";
    } elseif($whereAnd==" AND"){
        $whereAnd=" AND ";
    } else{
        $whereAnd="WHERE ";
    }

    if($safe_liste_rank){
        $query.=" {$whereAnd} liste_rank={$safe_liste_rank} ";
    }



    $query .= "ORDER BY pseudo ASC";
    // $query .= " LIMIT 2";


//    if($limit) {
//        $query .= " LIMIT {$safe_limit_no} ";
//    }

    $clients_set = mysqli_query($connection, $query);
    confirm_query($clients_set);
    return $clients_set;


}



function output_all_client($query_recherche=false,$pseudo=null,$liste_restrictive=null,$web_view=null,$last_name=null,$first_name=null,$address=null,$liste_rank=null){

if($query_recherche==true){
    $client_set= find_client_query( $pseudo,$liste_restrictive,$web_view,$last_name,$first_name,$address,$liste_rank);
}else {
    $client_set= find_all_clients();

}



    $output="";


//    $style5px="style=\"text-align: center; width: 5px;\"";
//    $style10px="style=\"text-align: center; width: 10px;\"";
//    $style30px="style=\"text-align: center; width: 30px;\"";
//    //  $style60px="style=\"text-align: center; width: 60px;\"";
//    $style70px="style=\"text-align: center; width: 70px;\"";
//    $style100px="style=\"text-align: center; width: 100px;\"";
//    $style160px="style=\"text-align: center; width: 160px;\"";


    $style5px="";
    $style10px="";
    $style30px="";
    //  $style60px="style=\"text-align: center; width: 60px;\"";
    $style60px="";
    $style70px="";
    $style100px="";


 //   $output= "<div class=\"CSSTableGenerator\">";

    $output .="<div class='table-responsive'>";
 //   $output .= "<table>";
    $output .= "<table class='table table-striped table-bordered table-hover table-condensed'>";
    $output .="<tr>";
 //   $output .= "<th colspan=\"2\" style=\"text-align: center;width: 5px\">Actions</th>";
    $output .= "<th class='text-center' colspan='2'>Actions</th>";

    $output .= "<th class='text-center' {$style30px}>Restrict</th>";
    $output .= "<th class='text-center'  {$style10px}>Id</th>";
    $output .= "<th class='text-center'  {$style30px}>pseudo</th>";
    $output .= "<th class='text-center'  {$style30px}>web_view</th>";
    $output .= "<th class='text-center'  {$style70px}>Nom</th>";
    $output .= "<th class='text-center' {$style30px}>Prénom</th>";
    $output .= "<th class='text-center hide-columns' {$style60px}>addresse</th>";
    $output .= "<th class='text-center hide-columns' {$style30px}>CP</th>";
    $output .= "<th class='text-center hide-columns' {$style30px}>Ville</th>";
    $output .= "<th class='text-center hide-columns' {$style30px}>Pays</th>";
    $output .= "<th class='text-center' {$style30px}>Prix</th>";
    $output .= "<th class='text-center' {$style30px}>Départ</th>";
    $output .= "<th class='text-center' {$style30px}>Arrivée</th>";
    $output .= "<th class='text-center' {$style30px}>Rank</th>";

    $output .="</tr>";

    while($clients = mysqli_fetch_assoc($client_set)) {

        //----------------restrict--------------------
        $restrict=$clients["liste_restrictive"];


        if($restrict==1) {
            $output .= "<tr class='success hide-success'>";
        } else {
            $output .= "<tr class='hide-others'>";
        }

        $output .="<td style='width: 5px;'><a href=\"edit_client.php?id=";
        $output .= urlencode($clients["id"]);
        $output .="\">";
 //       $output .="Edit";
        $output .= "<span class='glyphicon glyphicon-pencil'style='color:blue;' aria-hidden='true'></span>";
        $output .="</a></td>";


        $output .="<td style='width: 5px;'><a href=\"delete_client.php?id=";
        $output .= urlencode($clients["id"]);
        $output .="\" onclick=\"return confirm('Are you sure to delete?');";
        $output .="\">";
//        $output .="Delete";
        $output .= "<span class='glyphicon glyphicon-remove'style='color:red;' aria-hidden='true'></span>";
        $output .="</a></td>";

        if($restrict==1){
            $output .="<td><a href=\"edit_client_list_restrict.php?id=";
        } else {
            $output .="<td ><a href=\"edit_client_list_restrict.php?id=";
        }

      //  $output .="<td style='width: 5px;'><a href=\"edit_client_list_restrict.php?id=";
        $output .= urlencode($clients["id"]);
        $output .="\" onclick=\"return confirm('Are you sure to change restrict?');";

        //TODO take val list restrict put words oui 1 non 0

        if($restrict==1){
            $output .="\">";
 //           $output .="Oui";
            $output .="<span class='glyphicon glyphicon-ok' style='color:green;' aria-hidden='true'></span>";
            $output .="</a></td>";
        } else {
            $output .="\">";
            $output .="Non";
            $output .="</a></td>";
        }

        //---------------end Restrict------------------------
        // $output .="<td>". htmlentities($clients["liste_restrictive"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["id"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["pseudo"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["web_view"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["last_name"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["first_name"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td class='hide-columns'>". htmlentities($clients["address"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td class='hide-columns'>". htmlentities($clients["cp"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td class='hide-columns'>". htmlentities($clients["city"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td class='hide-columns'>". htmlentities($clients["country"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["default_price"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["default_aller"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["default_arrivee"], ENT_COMPAT, 'utf-8')."</td>";
        $output .="<td>". htmlentities($clients["liste_rank"], ENT_COMPAT, 'utf-8')."</td>";


        $output .="</tr>";

    }

    $output .="</table>";
    mysqli_free_result($client_set);
    $output .="</div>";



    return $output;

}


function output_clients_select_list_all(){
    global $connection;

    $table_name='clients';
    $liste_rank=true;

    if (is_chauffeur()){
        $liste_restrictive=true;

    }else{
        $liste_restrictive=false;


    }



    $output = "";
   // $output_form = "";

    $query = "SELECT ";
    $query .= " * ";
    $query .= "FROM {$table_name} ";

    if ($liste_restrictive){
        $query .= "WHERE liste_restrictive = 1 ";
    }


    $query .= "ORDER BY liste_rank ASC, liste_restrictive DESC, pseudo ASC ";


    $return_query_set = mysqli_query($connection, $query);
    confirm_query($return_query_set);

    while ($return_query = mysqli_fetch_assoc($return_query_set)) {
        $data= htmlentities($return_query['pseudo'], ENT_COMPAT, 'utf-8');
        $web_view= htmlentities($return_query['web_view'], ENT_COMPAT, 'utf-8');

        $output.="<option value= '{$data}'>";
        $output.=$web_view;
        $output.="</option>";

    }

    mysqli_free_result($return_query);

    return $output;
}



