<?php
// Begin by assuming there are no suspect phrases.
$suspect = false;
// Create a Perl-compatible regular expression (PCRE) for suspect phrases.
$pattern = '/Content-Type:|Bcc:|Cc:/i';

// Define a recursive function to detect suspect phrases.
function isSuspect($val, $pattern, &$suspect) {
	if (is_array($val)) {
		foreach ($val as $item) {
			isSuspect($item, $pattern, $suspect);
		}
	} else {
		// If the pattern matches, set $suspect to true.
		if (preg_match($pattern, $val)) {
			$suspect = true;
		}
	}
}

// Pass the $_POST array to the isSuspect() function to detect suspect phrases.
isSuspect($_POST, $pattern, $suspect);

// If no suspect phrases are found, loop through the $_POST array
if (!$suspect) {
	foreach ($_POST as $key => $value) {
		// Assign the current element's value to a temporary variable,
		// stripping leading and trailing white space from text values.
		$temp = is_array($value) ? $value : trim($value);
		// If the value is empty, and the current element's key is in the $required array
		if (empty($temp) && in_array($key, $required)) {
			// add the key to the $missing array and use a variable variable to create
			// a new variable based on the key name and initialize it as an empty string.
			$missing[] = $key;
			$$key = '';
		} elseif(in_array($key, $expected)) {
			// If the value is not empty, but is in the $expected array,
			// assign its value to a new variable based on the key name
			// using a variable variable.
			$$key = $temp;
		}
	}
}

// If no suspect phrases have been found, and the email field is not empty,
// use the filter_input() function to validate the email
if (!$suspect && !empty($email)) {
	$validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	// If the email address is in a valid format, use it in a Reply-to header.#
	// Otherwise add an element to the $errors array.
	if ($validemail) {
		$headers .= "\r\nReply-to: $validemail";
	} else {
		$errors['email'] = true;
	}
}

// If no suspect phrases have been found, no required fields are blank,
// and there are no errors, build the email body ready for sending.
if (!$suspect && !$missing && !$errors) {
	// Initialize the $message as an empty string.
	$message = '';
	// Loop through the $expected array.
	foreach ($expected as $item) {
		// Use a variable variable to access each item.
		// If it exists and isn't empty, assign its value to $val.
		// Otherwise assign the string 'Not selected' to $val.
		if (isset($$item) && !empty($$item)) {
		    $val = $$item;
		} else {
			$val = 'Not selected';
		}
		// If the value is an array, convert it to a comma-separated string.
		if (is_array($val)) {
			$val = implode(', ', $val);
		}
		// Replace any underscores and hyphens in the form field names with a space.
		$item = str_replace(array('_', '-'), ' ', $item);
		// Convert the first letter of the form field name to uppercase
		// and use it as a label for the current value.
		$message .= ucfirst($item) . ": $val\r\n\r\n";
	}
	// When the message has been built, word-wrap it at 70 characters.
	$message = wordwrap($message, 70);
	
	// For testing purposes, assume the main was sent successfully.
	$mailSent = true;
}