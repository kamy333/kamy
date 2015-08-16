<?php

// will assign the post name as variable eg Post['name']=1  -> $name=1
// will check in required if empty will add to missing
// used after

foreach ($_POST as $key => $value) {
    $temp = is_array($value) ? $value : trim($value);
    if (empty($temp) && in_array($key, $required_fields)) {
        $missing[] = $key;
        $$key = '';
    } elseif(in_array($key, $expected)) {
        $$key = $temp;
    }
}?>
