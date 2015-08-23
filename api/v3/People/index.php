<?php

header("Content-Type:application/hal+json");

include 'blank.php';

require_once '/srv/www/buildkit/build/drupal-demo/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$count=sizeof($array['values']);

$hal = new \Nocarrier\Hal('/sites/default/ext/osdi/api/v3/People/index.php', ['per_page' => $count,'page' => 1,'total_records' => $count]);

foreach($array['values'] as $key => $value){
    $i = $array['values'][$key]['id'];
 $resource = new \Nocarrier\Hal(
    '/People?contact_id='.$array['values'][$key]['id'],
    array(
        'given_name' => $array['values'][$key]['given_name'],
        'family_name' => $array['values'][$key]['family_name'],
        'email_addresses' => array(
            array(
                'primary' => true,
                'address' => $array['values'][$key]['email'])),
        'identifiers' => array('civi_crm:'.$i),
        'id'=> $array['values'][$key]['id'],
        'created_date' => date("c", strtotime($array2['values'][$i]['created_date'])),
        'modified_date' => date("c", strtotime($array['values'][$i]['modified_date'])),
        'custom_fields' => array(),
        'postal_addresses' => array(
            array(
            'address_lines' => array(
                array($array['values'][$key]['postal_addresses']),
                ),
            'locality' => $array['values'][$key]['city'],
            'region' => $array['values'][$key]['state_province_name'],
            'postal_code' => $array['values'][$key]['postal_code'],
            'country'=> $array['values'][$key]['country'],
            'primary' => filter_var($array3['values'][$key]['is_primary'], FILTER_VALIDATE_BOOLEAN))),
        'phone_numbers' => array(
            array(
            'number' => $array['values'][$key]['number'],))
        )
    );

$resource->addLink('self', '/sites/default/ext/osdi/api/v3/People/person.php'.'?id='.$i);

$hal->addResource('osdi-people', $resource);
}
$hal->addLink('next', '/sites/default/ext/osdi/api/v3/People'.'?page='.($page+1));
$hal->addLink('previous', '/sites/default/ext/osdi/api/v3/People'.'?page='.($page-1));

echo $hal->asJson();
