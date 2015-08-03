<?php
require_once '/srv/www/buildkit/build/drupal-demo/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1}&options[limit]=0&&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$json2 = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=DashboardContact&action=get&json={"sequential":1}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');



$array = json_decode($json, true);
$array2 = json_decode($json2, true);

$hal = new \Nocarrier\Hal('/sites/default/ext/org.civicrm.osdi/api/v3/People/', ['per_page' => 236,'page' => 1,'total_records' => 236]);

foreach($array['values'] as $key => $value){
    $i = $array['values'][$key]['contact_id'];
$resource = new \Nocarrier\Hal(
    '/People?contact_id='.$array['values'][$i]['contact_id'],
    array(
        'given_name' => $array['values'][$i]['given_name'],
        'family_name' => $array['values'][$i]['family_name'],
        'email_addresses' => array(
            'primary' => true,
            'address' => $array['values'][$i]['email']),
        'identifiers' => array('osdi-person-'.'['.$i.']'),
        'id'=> $array['values'][$i]['contact_id'],
        'created_date' => $array2['values'][$i]['created_date'],
        'modified_date' => date("Y/m/d"),
        'custom_fields' => array(
            'email' => $array['values'][$i]['email'],
            'full_name' => $array['values'][$i]['given_name'].' '.$array['values'][$i]['family_name'],
            'event_code' => 'xx',
            'address' => $array['values'][$i]['postal_addresses'],
            'zip' => $array['values'][$i]['zip_code'],
            'pledge' => 'num'),
        'postal_addresses' => array(
            array(
            'address_lines' => array(null),
            'postal_code' => $array['values'][$i]['zip_code'],
            'address_status' => 'Verified/Not Verified',
            'primary' => 'True/False',)),
        'phone_numbers' => array(
            array(
            'number' => $array['values'][$i]['number'],)),
        '_embedded' => array(
            'osdi:tags' => array())
        )
    );


$resource->addLink('addresses', 'http://api.opensupporter.org/api/v1/people/X/addresses');
$resource->addLink('question_answers', 'http://api.opensupporter.org/api/v1/people/X/question_answers');
$resource->addLink('self', 'http://api.opensupporter.org/api/v1/people/X');
$resource->addLink('osdi-tags', 'http://api.opensupporter.org/api/v1/people/X/tags');

$hal->addResource('osdi-people', $resource);
}

echo $hal->asJson();
