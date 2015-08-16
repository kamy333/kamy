<?php
$name = 'Paranoid Android';

switch ($name) {
	case 'Arthur':
        echo 'I could never get the hang of Thursdays';
		break;
	// Stacking case values matches either value.
    case 'Marvin':
	case 'Paranoid Android':
	    echo "I've got this terrible pain in all the diodes down my left-hand side";
		break;
	// Adding default at the end of a switch statement is optional.
	// If omitted, and there are no matches, the switch statement exits silently.	
    default:
	    echo 'Is that really a piece of fairy cake?';
}