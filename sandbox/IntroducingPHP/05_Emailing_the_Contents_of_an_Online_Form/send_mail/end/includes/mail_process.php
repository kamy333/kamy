<?php
$suspect = false;
$pattern = '/Content-Type:|Bcc:|Cc:/i';

function isSuspect($val, $pattern, &$suspect) {
	if (is_array($val)) {
		foreach ($val as $item) {
			isSuspect($item, $pattern, $suspect);
		}
	} else {
		if (preg_match($pattern, $val)) {
			$suspect = true;
		}
	}
}

isSuspect($_POST, $pattern, $suspect);

if (!$suspect) {
	foreach ($_POST as $key => $value) {
		$temp = is_array($value) ? $value : trim($value);
		if (empty($temp) && in_array($key, $required)) {
			$missing[] = $key;
			$$key = '';
		} elseif(in_array($key, $expected)) {
			$$key = $temp;
		}
	}
}

if (!$suspect && !empty($email)) {
	$validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	if ($validemail) {
		$headers .= "\r\nReply-to: $validemail";
	} else {
		$errors['email'] = true;
	}
}

if (!$suspect && !$missing && !$errors) {
	$message = '';
	foreach ($expected as $item) {
		if (isset($$item) && !empty($$item)) {
		    $val = $$item;
		} else {
			$val = 'Not selected';
		}
		if (is_array($val)) {
			$val = implode(', ', $val);
		}
		$item = str_replace(array('_', '-'), ' ', $item);
		$message .= ucfirst($item) . ": $val\r\n\r\n";
	}
	$message = wordwrap($message, 70);
	
	$mailSent = mail($to, $subject, $message, $headers, $authenticate);	
	if (!$mailSent) {
		$errors['mailfail'] = true;
	}
}