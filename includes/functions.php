<?php

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}




	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"alert alert-danger\" role='alert'>";
            $output.="<a href='#' class='close' data-dismiss='alert'>&times;</a>";
            $output.="<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden='true'></span>";
            $output.="<span class=\"sr-only\"><strong>Error:</strong></span>";
		  $output .= " <strong>Please fix the following errors:</strong>";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error, ENT_COMPAT, 'utf-8');
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}


    function form_warnings($warnings=array()) {
    $output = "";
    if (!empty($warnings)) {
        $output .= "<div class=\"alert alert-warning\" role='alert'>";
        $output.="<a href='#' class='close' data-dismiss='alert'>&times;</a>";
        $output.="<span class=\"glyphicon glyphicon-warning-sign\" aria-hidden='true'></span>";
        $output.="<span class=\"sr-only\"><strong>Notice:</strong></span>";
        $output .= "<strong> Prendre note des avertissements meme si la donnée est enregistrée:</strong>";
        $output .= "<ul>";
        foreach ($warnings as $key => $warning) {
            $output .= "<li>";
            $output .= htmlentities($warning, ENT_COMPAT, 'utf-8');
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}
	
	function find_all_subjects($public=true) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		if ($public) {
			$query .= "WHERE visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		return $subject_set;
	}
	
	function find_pages_for_subject($subject_id, $public=true) {
		global $connection;
		
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE subject_id = {$safe_subject_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		return $page_set;
	}
	
	function find_all_admins() {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "ORDER BY username ASC";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		return $admin_set;
	}


	
	function find_subject_by_id($subject_id, $public=true) {
		global $connection;
		
		$safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = {$safe_subject_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$subject_set = mysqli_query($connection, $query);
		confirm_query($subject_set);
		if($subject = mysqli_fetch_assoc($subject_set)) {
			return $subject;
		} else {
			return null;
		}
	}

	function find_page_by_id($page_id, $public=true) {
		global $connection;
		
		$safe_page_id = mysqli_real_escape_string($connection, $page_id);
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "LIMIT 1";
		$page_set = mysqli_query($connection, $query);
		confirm_query($page_set);
		if($page = mysqli_fetch_assoc($page_set)) {
			return $page;
		} else {
			return null;
		}
	}
	
	function find_admin_by_id($admin_id) {
		global $connection;
		
		$safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}

	function find_admin_by_username($username) {
		global $connection;
		
		$safe_username = mysqli_real_escape_string($connection, $username);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE username = '{$safe_username}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	
	function find_admin_by_email($email) {
		global $connection;
		
		$safe_email = mysqli_real_escape_string($connection, $email);
		
		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE email = '{$safe_email}' ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
	}
	

	function find_default_page_for_subject($subject_id) {
		$page_set = find_pages_for_subject($subject_id);
		if($first_page = mysqli_fetch_assoc($page_set)) {
			return $first_page;
		} else {
			return null;
		}
	}
	
	function find_selected_page($public=false) {
		global $current_subject;
		global $current_page;
		
		if (isset($_GET["subject"])) {
			$current_subject = find_subject_by_id($_GET["subject"], $public);
			if ($current_subject && $public) {
				$current_page = find_default_page_for_subject($current_subject["id"]);
			} else {
				$current_page = null;
			}
		} elseif (isset($_GET["page"])) {
			$current_subject = null;
			$current_page = find_page_by_id($_GET["page"], $public);
		} else {
			$current_subject = null;
			$current_page = null;
		}
	}

	// navigation takes 2 arguments
	// - the current subject array or null
	// - the current page array or null
	function navigation($subject_array, $page_array) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects(false);
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"manage_content.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"], ENT_COMPAT, 'utf-8');
			$output .= "</a>";
			
			$page_set = find_pages_for_subject($subject["id"], false);
			$output .= "<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($page_array && $page["id"] == $page_array["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"manage_content.php?page=";
				$output .= urlencode($page["id"]);
				$output .= "\">";
				$output .= htmlentities($page["menu_name"], ENT_COMPAT, 'utf-8');
				$output .= "</a></li>";
			}
			mysqli_free_result($page_set);
			$output .= "</ul></li>";
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

	function public_navigation($subject_array, $page_array) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects();
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($subject_array && $subject["id"] == $subject_array["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"index.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"], ENT_COMPAT, 'utf-8');
			$output .= "</a>";
			
			if ($subject_array["id"] == $subject["id"] || 
					$page_array["subject_id"] == $subject["id"]) {
				$page_set = find_pages_for_subject($subject["id"]);
				$output .= "<ul class=\"pages\">";
				while($page = mysqli_fetch_assoc($page_set)) {
					$output .= "<li";
					if ($page_array && $page["id"] == $page_array["id"]) {
						$output .= " class=\"selected\"";
					}
					$output .= ">";
					$output .= "<a href=\"index.php?page=";
					$output .= urlencode($page["id"]);
					$output .= "\">";
					$output .= htmlentities($page["menu_name"],ENT_COMPAT,'ut8');
					$output .= "</a></li>";
				}
				$output .= "</ul>";
				mysqli_free_result($page_set);
			}

			$output .= "</li>"; // end of the subject li
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

	function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}
	
	function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	}
	
	function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$admin = find_admin_by_username($username);
		if ($admin) {
			// found admin, now check password
			if (password_check($password, $admin["hashed_password"])) {
				// password matches
				return $admin;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['admin_id']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}


function log_action($action, $message="") {
    $logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
    $new = file_exists($logfile) ? false : true;
    if($handle = fopen($logfile, 'a')) { // append
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if($new) { chmod($logfile, 0755); }
    } else {
        echo "Could not open log file for writing.";
    }
}


function is_chauffeur() {
	
	if ($_SESSION['user_type_id']==4) {
		$session_chauffeur=true;
	} else {
		$session_chauffeur=false;
	}
	
	return $session_chauffeur;
}

function is_kamy() {

    if ($_SESSION['username']=="kamy") {
        $session_username=true;
    } else {
        $session_username=false;
    }

    return $session_username;
}

function is_secretary(){
    if ($_SESSION['user_type_id']==3) {
        $session_secretary=true;
    } else {
        $session_secretary=false;
    }

    return $session_secretary;

}

function is_manager (){
    if ($_SESSION['user_type_id']==2) {
        $session_manager=true;
    } else {
        $session_manager=false;
    }

    return $session_manager;

}

function is_admin (){
    if ($_SESSION['user_type_id']==1) {
        $session_admin=true;
    } else {
        $session_admin=false;
    }

    return $session_admin;

}

function aller_retour_visu($aller_retour){
    $aller_retour_visu=$aller_retour;

    if ($aller_retour=="AllerSimple"){
        $aller_retour_visu="Aller Simple";
    }elseif ( $aller_retour=="AllerRetour"){
        $aller_retour_visu="Aller Retour";
    } else {

    }
    return $aller_retour_visu;
}

//format hours for vizualization form
function visu_heure($heure){
    $first=(int)substr($heure,0,1);
    $len=strlen($heure);
    $heure= str_replace("h", ":", $heure);
    $heure_no_0=substr($heure,1,$len-1);

    if ($first==0){
        return $heure_no_0;
    }else {
        return $heure;
    }
}

function find_all_chauffeurs () {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM chauffeurs ";
    $query .= "ORDER BY id ASC";
    $chauffeur_set = mysqli_query($connection, $query);
    confirm_query($chauffeur_set);
    return $chauffeur_set;
}

function find_chauffeur_by_id($chauffeur_id) {
    global $connection;

    $safe_chauffeur_id = mysqli_real_escape_string($connection, $chauffeur_id);

    $query  = "SELECT * ";
    $query .= "FROM chauffeurs ";
    $query .= "WHERE id = {$safe_chauffeur_id} ";
    $query .= "LIMIT 1";
    $chauffeur_set = mysqli_query($connection, $query);
    confirm_query($chauffeur_set);
    if($chauffeur = mysqli_fetch_assoc($chauffeur_set)) {
        return $chauffeur;
    } else {
        return null;
    }
}

function find_chauffeur_by_name($chauffeur_name) {
    global $connection;

    $safe_chauffeur_name = mysqli_real_escape_string($connection, $chauffeur_name);

    $query  = "SELECT * ";
    $query .= "FROM chauffeurs ";
    $query .= "WHERE chauffeur_name = '{$safe_chauffeur_name}' ";
    $query .= "LIMIT 1";
    $chauffeur_set = mysqli_query($connection, $query);
    confirm_query($chauffeur_set);
    if($chauffeur = mysqli_fetch_assoc($chauffeur_set)) {
        return $chauffeur;
    } else {
        return null;
    }
}

function selection_chauffeurs($chauffeur_name="ALL"){
    $chauffeur_set=find_all_chauffeurs();
    $chauffeur_name=strtolower($chauffeur_name);
    $output="";
while($chauffeur = mysqli_fetch_assoc($chauffeur_set)) {

    $chauffeur_name_db= strtolower($chauffeur['chauffeur_name']);

    if ($chauffeur_name !=$chauffeur_name_db  ) {
        $output .= "<option ";
        $output .= "value=\"";
        $output .=htmlentities($chauffeur['chauffeur_name'],ENT_COMPAT,'ut8');
        $output .=" \" >";
        $output .= htmlentities($chauffeur['chauffeur_name'],ENT_COMPAT,'ut8');
        $output .= "</option>";

        // $output.= "<option value=\'AllerSimple\'>Aller Simple</option>";
    }
}
    mysqli_free_result($chauffeur_set);
    return $output;

}


// todo this function may not be used anywhere
function slugify($text,$strict = false) {
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);

    // trim
    $text = trim($text, '-');
    setlocale(LC_CTYPE, 'en_GB.utf8');
    // transliterate
    if (function_exists('iconv')) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    // lowercase
    $text = strtolower($text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w.]+~', '', $text);
    if (empty($text)) {
        return 'empty_$';
    }
    if ($strict) {
        $text = str_replace(".", "_", $text);
    }
    return $text;
}

function get_user_img($width=5,$height=5){
    // $width=5,$height=5
    $username=  $_SESSION["username"];

    $style="style=\"width:{$width}em; height:{$height}em;\"";

    //$style="style=\"width:3em; height:3em;\"";
    if(file_exists("img/{$username}.JPG")){
        $output= "<img class='img-thumbnail img-responsive'  src='img/{$username}.JPG' alt='{$username}' {$style} >";
    } else {
        $output= "<img class='img-thumbnail img-responsive'  src='img/no_user.png' {$style} alt='No User'>";

    }

    // $output="hello world";
    return $output;
}


function get_img($image,$width=5,$height=5){
    // $width=5,$height=5
   // $username=  $_SESSION["username"];

    $style="style=\"width:{$width}em; height:{$height}em;\"";

    //$style="style=\"width:3em; height:3em;\"";
    if(file_exists("img/{$image}.JPG")){
        $output= "<img class='img-thumbnail img-responsive'  src='img/{$image}.JPG' alt='{$image}' {$style} >";
    } else {
        $output= "<img class='img-thumbnail img-responsive'  src='img/no_user.png' {$style} alt='No User'>";

    }

    // $output="hello world";
    return $output;
}


function choisr_form_like($column_name,$table_name,$precede_name=""){
    global $connection;

    if ($precede_name){
       $final_column_name=$precede_name."_like_".$column_name;
           } else {
        $final_column_name=$column_name;
    }


    $query="SELECT DISTINCT {$column_name} FROM {$table_name} ORDER BY {$column_name} ASC";
$return_query_set = mysqli_query($connection, $query);
confirm_query($return_query_set);

    $output = "";
    $output_form = "";

    $output="<datalist id=\"liste_{$column_name}\">";

    while ($return_query = mysqli_fetch_assoc($return_query_set)) {
        $data= htmlentities($return_query[$column_name], ENT_COMPAT, 'utf-8');

        $output.="<option value='{$data}'>";
        $output.=htmlentities($data, ENT_COMPAT, 'utf-8');
        $output.="</option>";
    }
    $output.="</datalist>";


    $class=" class=\"form-control\" ";

    mysqli_free_result($return_query_set);

    $output_form.=$output;
    $output_form.="<div class=\"form-group\" >";
    $output_form.="<label for='{$final_column_name}'></label>";
    $output_form.="   <input  {$class}  type='text' name='{$final_column_name}'  autocomplete='off'
 list='liste_{$column_name}'  id='Arrivee' placeholder='{$column_name}' > ";
    $output_form.="</div>";

    return $output_form;
}

function choisir_distinct_form($column_name,$table_name,$precede_name="",$date_return=""){
//$column_name
//$table_name
//$precede_name
//  $date_return only for date will add the date function
//



    global $connection;
    //$table_name="clients";
    // $column_name='pseudo';

    $output = "";
    $output_form = "";

    // $table_mysql=array('admins','chauffeurs','clients');

    $col_date=array('course_date','str_time');
    $col_heure=array('heure');
    $col_day=array('week_day_rank');
    $col_monthname=array('monthname');
    $col_week=array('week');
    $col_year=array('year');


    $column_name_display="";

    $col_date_return=array('monthname','year','day','week','yearweek','dayname');
    if ($date_return && in_array($date_return,$col_date_return)){

        $format_col_name="{$date_return}({$column_name}) as {$column_name}";
        //   var_dump($format_col_name1);

        // $format_col_name=$column_name;

    } else {
        $format_col_name=$column_name;

    }


    $array_dec =array('course_date');
    $asc_desc=" ASC";
    if (isset($array_dec) && in_array($column_name,$array_dec)){
        $asc_desc=" DESC";
    }



    $query = "SELECT DISTINCT ";
    $query .= " {$format_col_name} ";

    $query .= "FROM {$table_name} ";

    $query .= "ORDER BY {$column_name} {$asc_desc} ";

// var_dump($query);


    if ($precede_name){
        if($date_return && in_array($date_return,$col_date_return)){
            $final_column_name=$precede_name."_".$date_return."_".$column_name;

        } else {
            $final_column_name=$precede_name."_".$column_name;

        }
    } else {

        $final_column_name=$column_name;

    }




    $return_query_set = mysqli_query($connection, $query);
    confirm_query($return_query_set);

    while ($return_query = mysqli_fetch_assoc($return_query_set)) {
        $data= htmlentities($return_query[$column_name], ENT_COMPAT, 'utf-8');

        $output.="<option value='{$data}'>";

        if(in_array($column_name,$col_date)){
            list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($data);

            if ($date_return=="monthname"){
                $output.=htmlentities(mth_fr_name($data), ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("Mois", ENT_COMPAT, 'utf-8');
            } elseif ($date_return=="year") {
                $output.=htmlentities($data, ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("year", ENT_COMPAT, 'utf-8');
            } elseif ($date_return=="week") {
                $output.=htmlentities($data, ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("Semaine", ENT_COMPAT, 'utf-8');
            } elseif ($date_return=="day") {
                $output.=htmlentities($data, ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("Jour No", ENT_COMPAT, 'utf-8');
            } elseif ($date_return=="dayname") {
                $output.=htmlentities( day_fr(day_eng_no ($data))  , ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("Jour semaine", ENT_COMPAT, 'utf-8');
            } elseif ($date_return=="yearweek") {
                $data_out=substr($data, 0, 4)."-".substr($data, 4, 2);
                $output.=htmlentities($data_out, ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("An _Semaine", ENT_COMPAT, 'utf-8');


            } else {
                $output.=htmlentities($date_fr_short, ENT_COMPAT, 'utf-8');
                $column_name_display=htmlentities("Date", ENT_COMPAT, 'utf-8');

            }

        }elseif(in_array($column_name,$col_heure)) {
            $output.=htmlentities(visu_heure($data), ENT_COMPAT, 'utf-8');
            $column_name_display=htmlentities("Heure", ENT_COMPAT, 'utf-8');

        }elseif(in_array($column_name,$col_day)) {
            $output.=htmlentities(day_fr($data), ENT_COMPAT, 'utf-8');
            $column_name_display=htmlentities("Jour", ENT_COMPAT, 'utf-8');

        }elseif(in_array($column_name,$col_monthname)) {
            $output.=htmlentities(mth_fr_name($data), ENT_COMPAT, 'utf-8');
            $column_name_display=htmlentities("Mois", ENT_COMPAT, 'utf-8');

        }elseif(in_array($column_name,$col_week)) {
            $output.=htmlentities("Semaine ".$data, ENT_COMPAT, 'utf-8');
            $column_name_display=htmlentities("Semaine", ENT_COMPAT, 'utf-8');


        }elseif(in_array($column_name,$col_year)) {
            $output.=htmlentities($data, ENT_COMPAT, 'utf-8');
            $column_name_display=htmlentities("Année", ENT_COMPAT, 'utf-8');

        }else {
            $output.=$data;
            $column_name_display=htmlentities(ucfirst(str_replace('_',' ',$column_name)), ENT_COMPAT, 'utf-8');
        }
        $output.="</option>";

    }

    //$style="style='background-color:  #2c2fff;width:150px;color: #f3f2ff;text-align: center'";

    //   $class="pure-input-1-2";
    $class=" class=\"form-control\" ";

    mysqli_free_result($return_query_set);







    //   $output_form.="<div class='col-lg-2 col-md-2'>";
    $output_form.="<div class=\"form-group\" >";
    $output_form.="<label for='{$final_column_name}'></label>";
    $output_form.="<select  {$class} name='{$final_column_name}' id='{$final_column_name}' >";
    $output_form.="<option value='' disabled selected>{$column_name_display}</option>";
    $output_form.= $output;
    $output_form.="</select>";
    $output_form.="</div>";
    //  $output_form.="</div>";

    return $output_form;

}




function date_fr($str_time='now'){
    $unix_time = strtotime($str_time);
    $day_wk_no = day_eng_no(strftime("%A" ,$unix_time));
    $nom_jour=day_fr($day_wk_no);
    $nom_jour_short=substr($nom_jour, 0, 3);

    $jour_no=strftime("*%d",$unix_time);
    $jour_no= str_replace('*0','',$jour_no);
    $jour_no= str_replace('*','',$jour_no);

    $now_month=mth_fr_name(strftime("%B" ,$unix_time));
    $now_month_short=substr($now_month, 0, 4);
    $now_year= strftime("%Y" ,$unix_time);
    $now_year_short=substr($now_year, 2, 2);

    $hour_minute=strftime("*%H:%M" ,$unix_time);
    $hour_minute= str_replace('*0','',$hour_minute);
    $hour_minute= str_replace('*','',$hour_minute);

    $date_fr=$jour_no.".".$now_month.".".$now_year;
    $date_fr_short = $nom_jour_short." ".$jour_no." ".$now_month_short." ".$now_year_short;
    $date_fr_long=$nom_jour." ".$jour_no." ".$now_month." ".$now_year;

    $date_fr_hr=$jour_no.".".$now_month.".".$now_year." - ".$hour_minute;
    $date_fr_short_hr = $nom_jour_short." ".$jour_no." ".$now_month_short." ".$now_year_short." - ".$hour_minute;
    $date_fr_long_hr=$nom_jour." ".$jour_no." ".$now_month." ".$now_year." - ".$hour_minute;
    $date_fr_full_hr=$nom_jour." ".$jour_no." ".$now_month." ".$now_year." à ".$hour_minute;


    return array($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr);

//    list ($date_fr,$date_fr_short,$date_fr_long,$date_fr_hr,$date_fr_short_hr,$date_fr_long_hr,$date_fr_full_hr)= date_fr($date_sql);


}




?>

