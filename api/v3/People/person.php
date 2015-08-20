<?php

header("Content-Type:application/hal+json");

include 'blank.php';

require_once '/srv/www/buildkit/build/drupal-demo/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$key = $_GET['id'];
$key--;
$i = $array['values'][$key]['contact_id'];

$hal = new \Nocarrier\Hal('/sites/default/ext/osdi/api/v3/People/person.php'.'?id='.$i,
   ['given_name' => $array['values'][$key]['given_name'],
    'family_name' => $array['values'][$key]['family_name'],
        'email_addresses' => array(
            array(
                'primary' => true,
                'address' => $array['values'][$key]['email'])),
    'identifiers' => array('civi_crm:'.$i),
    'id'=> $array['values'][$key]['contact_id'],
    'created_date' => date("c", strtotime($array2['values'][$i]['created_date'])),
    'modified_date' => date("c", strtotime($array2['values'][$i]['modified_date'])),
    'custom_fields' => array(),
    'postal_addresses' => array(
            array(
            'address_lines' => array(
                array($array['values'][$key]['postal_addresses']),
                ),
    'postal_code' => $array['values'][$key]['zip_code'],
    'address_status' => 'Verified/Not Verified',
    'primary' => 'True/False',)),
    'phone_numbers' => array(
        array(
        'number' => $array['values'][$key]['number'],))]
 );

echo $hal->asJson();
