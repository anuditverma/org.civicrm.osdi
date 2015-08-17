<?php

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1}&options[limit]=0&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$array = json_decode($json, true);

$ff = array_filter_recursive($array);
echo json_encode($ff);

function array_filter_recursive($input, $callback = null) {
    if (!is_array($input)) {
        return $input;
    }
    if (null === $callback) {
        $callback = function ($v) { return !empty($v);};
    }
    $input = array_map(function($v) use ($callback) { return array_filter_recursive($v, $callback); }, $input);
    return array_filter($input, $callback);
}


$result = array_walk_recursive_delete($array, function ($value, $key) {
     if (is_array($value)) {
            return empty($value);
         }
            return ($value === null);
        });
