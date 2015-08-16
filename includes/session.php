<?php
session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			//$output = "<div class=\"message\" >";
            if (isset($_SESSION["OK"])) {
                $output = "<div class=\"alert alert-success  fade in\"  role='alert' >";
                $output.="<a href='#' class='close' data-dismiss='alert'>&times;</a>";
                $output.="<span class=\"glyphicon glyphicon-ok\" aria-hidden='true'></span>";
                $output.="<span class=\"sr-only\">Error:</span>";
            } else {
                $output = "<div class=\"alert alert-danger fade in\" role='alert' >";
                $output.="<a href='#' class='close' data-dismiss='alert'>&times;</a>";
                $output.="<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden='true'></span>";
                $output.="<span class=\"sr-only\">Error:</span>";
            }
			$output .= " &nbsp;".htmlentities($_SESSION["message"], ENT_COMPAT, 'utf-8');
			$output .= "</div>";
			// clear message after use
			$_SESSION["message"] = null;
            $_SESSION["OK"] = null;
            return $output;
		}

	}




	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}


function warnings() {
    if (isset($_SESSION["warnings"])) {
        $warnings = $_SESSION["warnings"];

        // clear message after use
        $_SESSION["warnings"] = null;

        return $warnings;
    }
}
?>