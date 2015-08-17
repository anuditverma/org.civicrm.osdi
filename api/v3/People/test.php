<?php

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1}&options[limit]=0&&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$json2 = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=DashboardContact&action=get&json={"sequential":1}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$json3 = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Pledge&action=get&json={"sequential":1}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$array = json_decode($json, true);
$array2 = json_decode($json2, true);
$array3 = json_decode($json3, true);

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

$array = array_filter_recursive($array);
$array2 = array_filter_recursive($array2);
$array3 = array_filter_recursive($array3);
