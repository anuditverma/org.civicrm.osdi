<?php

header("Content-Type:application/hal+json");

include 'country_codes.php';

require_once '/srv/www/buildkit/build/drupal-demo/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$id = $_GET['id'];

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1,"id":'.$id.'}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$json3 = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Address&action=get&json={"sequential":1,"id":'.$id.'}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$array = json_decode($json, true);
$array3 = json_decode($json3, true);

foreach($array['values'] as $key => $value){
$hal = new \Nocarrier\Hal('/sites/default/ext/osdi/api/v3/People/person.php'.'?id='.$id,
   ['given_name' => $array['values'][$key]['given_name'],
    'family_name' => $array['values'][$key]['family_name'],
        'email_addresses' => array(
            array(
                'primary' => true,
                'address' => $array['values'][$key]['email'])),
    'identifiers' => array('civi_crm:'.$id),
    'id'=> $array['values'][$key]['contact_id'],
    'created_date' => date("c", strtotime($array2['values'][$i]['created_date'])),
    'modified_date' => date("c", strtotime($array2['values'][$i]['modified_date'])),
    'custom_fields' => array(),
    'postal_addresses' => array(
         array(
            'address_lines' => array(
                array($array['values'][$key]['postal_addresses']),
                ),
            'locality' => $array['values'][$key]['city'],
            'region' => $array['values'][$key]['state_province_name'],
            'postal_code' => $array['values'][$key]['postal_code'],
            'country'=> array_search($array['values'][$key]['country'], $countrycodes),
            'primary' => filter_var($array3['values'][$key]['is_primary'], FILTER_VALIDATE_BOOLEAN))),
    'phone_numbers' => array(
        array(
        'number' => $array['values'][$key]['number'],))]
 );
}

echo $hal->asJson();
