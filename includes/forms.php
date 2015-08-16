<?php
/**
 * Created by PhpStorm.
 * User: Kamy
 * Date: 11/14/2014
 * Time: 12:34 AM
 *
 * this can be deleted
 */

require_once("session.php");
require_once("db_connection.php");

class Forms {


public $output = "";
public  $output_form = "";
public $table_name="";

    public function choisir_chauffeur(){
        global $connection;

        $query = "SELECT DISTINCT ";
        $query .= "pseudo ";
        $query .= "FROM courses ";

        if(is_chauffeur()){
            $query .= "WHERE chauffeur ='{$_SESSION['nom']}' ";
        }

        $query .= "ORDER BY pseudo DESC ";

    }





} 