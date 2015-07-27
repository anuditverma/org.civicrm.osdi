<?php
require_once '/opt/buildkit/build/dmaster/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$hal = new \Nocarrier\Hal('/sites/default/ext/org.civicrm.osdi/api/v3/People/', ['per_page' => 25,'page' => 1,'total_records' => 25]);

$resource = new \Nocarrier\Hal(
    '/People?contact_id=x',
    array(
    	'given_name' => 'first_name',
    	'family_name' => 'last_name',
        'email_addresses' => array(
        	'primary' => true,
        	'address' => 'foo@bar.com'),
        'identifiers' => array('osdi-person-X'),
        'id'=> 'X',
        'created_date' => date("Y/m/d"),
        'modified_date' => date("Y/m/d"),
        'custom_fields' => array(
        	'email' => 'foo@bar.com',
        	'full_name' => 'Full Name',
        	'event_code' => 'xx',
        	'address' => 'Address',
        	'zip' => 'zip-code',
        	'pledge' => 'num'),
        'postal_addresses' => array(
        	array(
        	'address_lines' => array(null),
        	'postal_code' => 'Postal Code',
        	'address_status' => 'Verified/Not Verified',
        	'primary' => 'True/False',)),
        'phone_numbers' => array(
        	array(
        	'number' => 'Phone number',)),
        '_embedded' => array(
        	'osdi:tags' => array())
   		)
	);

$resource->addLink('addresses', 'http://api.opensupporter.org/api/v1/people/X/addresses');
$resource->addLink('question_answers', 'http://api.opensupporter.org/api/v1/people/X/question_answers');
$resource->addLink('self', 'http://api.opensupporter.org/api/v1/people/X');
$resource->addLink('osdi-tags', 'http://api.opensupporter.org/api/v1/people/X/tags');

for ($i = 0; $i <= 25; $i++) {
$hal->addResource('osdi-people', $resource);
}

echo $hal->asJson();
