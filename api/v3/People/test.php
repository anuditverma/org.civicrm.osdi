<?php

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1}&options[limit]=0&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$array = json_decode($json, true);

function array_walk_recursive_delete(array &$array, callable $callback, $userdata = null)
{
    foreach($array['values'] as $key => $value) {
        if (is_array($value)) {
            $value = array_walk_recursive_delete($value, $callback, $userdata);
        }
        if ($callback($value, $key, $userdata)) {
            unset($array[$key]);
        }
    }

    return $array;
}



$result = array_walk_recursive_delete($array, function ($value, $key) {
     if (is_array($value)) {
            return empty($value);
         }
            return ($value === null);
        });



echo json_encode($result);
