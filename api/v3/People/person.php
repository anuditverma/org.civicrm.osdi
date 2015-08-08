<?php
require_once '/srv/www/buildkit/build/drupal-demo/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1}&options[limit]=0&&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$json2 = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=DashboardContact&action=get&json={"sequential":1}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$json3 = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Pledge&action=get&json={"sequential":1}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$array = json_decode($json, true);
$array2 = json_decode($json2, true);
$array3 = json_decode($json3, true);

$key = $_GET['id'];
$key--;
$i = $array['values'][$key]['contact_id'];

$hal = new \Nocarrier\Hal('/sites/default/ext/osdi/api/v3/People/person.php'.'?id='.$i,
   ['given_name' => $array['values'][$key]['given_name'],
    'family_name' => $array['values'][$key]['family_name'],
    'email_addresses' => array(
        'primary' => true,
    'address' => $array['values'][$key]['email']),
    'identifiers' => array('civi_crm:'.'['.$i.']'),
    'id'=> $array['values'][$key]['contact_id'],
    'created_date' => $array2['values'][$i]['created_date'],
    'modified_date' => date("Y/m/d"),
    'custom_fields' => array(
        'email' => $array['values'][$key]['email'],
        'full_name' => $array['values'][$key]['given_name'].' '.$array['values'][$key]['family_name'],
        'event_code' => 'xx',
        'address' => null,
        'zip' => null,
        'pledge' => $array3['values'][$i]['pledge_id']),
    'postal_addresses' => array(
        array(
        'address_lines' => array(
            array($array['values'][$key]['postal_addresses'],
                  $array['values'][$key]['supplemental_address_1'],
                  $array['values'][$key]['supplemental_address_2'],
                  $array['values'][$key]['state_province'].', '.$array['values'][$key]['country']),
                ),
        'postal_code' => $array['values'][$key]['zip_code'],
        'address_status' => 'Verified/Not Verified',
        'primary' => 'True/False',)),
    'phone_numbers' => array(
        array(
        'number' => $array['values'][$key]['number'],))]
 );
echo $hal->asJson();
