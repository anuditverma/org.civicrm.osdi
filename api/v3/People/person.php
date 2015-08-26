<?php

header("Content-Type:application/hal+json");

include 'country_codes.php';

require_once '/srv/www/buildkit/build/drupal-demo/sites/all/libraries/vendor/autoload.php';

use Nocarrier\Hal;

$id = $_GET['id'];

$json = file_get_contents('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=People&action=get&json={"sequential":1,"id":'.$id.'}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

$array = json_decode($json, true);

foreach($array['values'] as $key => $value){
    $family_name_old = $array['values'][$key]['family_name'];
    $additional_name_old = $array['values'][$key]['middle_name'];
    $given_name_old = $array['values'][$key]['given_name'];
    $email_old = $array['values'][$key]['email'];
    $location_type_id_old = $array['values'][$key]['location_type_id'];
    $postal_addresses_old = $array['values'][$key]['postal_addresses'];
    $phone_old = $array['values'][$key]['phone'];
    $gender_old = $array['values'][$key]['gender'];
}

$received = json_decode(file_get_contents('php://input'));
$method = $_SERVER['REQUEST_METHOD'];

$family_name = $received->{"family_name"};
$additional_name = $received->{"additional_name"};
$given_name = $received->{"given_name"};
$email = $received->{"email"};
$location_type_id = $received->{"location_type_id"};
$postal_addresses = $received->{"postal_addresses"};
$phone = $received->{"phone"};
$gender = $received->{"gender"};

if ($family_name == "") {
    $family_name = $family_name_old;
}
if ($additional_name == "") {
    $additional_name = $additional_name_old;
}
if ($given_name == "") {
    $given_name = $given_name_old;
}
if ($email == "") {
    $email = $email_old;
}
if ($location_type_id == "") {
    $location_type_id = "Home";
}
if ($postal_addresses == "") {
    $postal_addresses = $postal_addresses_old;
}
if ($phone == "") {
    $phone = $phone_old;
}
if ($gender == "") {
    $gender = $gender_old;
}

$data= array(
    'first_name' => $given_name,
    'middle_name' => $additional_name,
    'last_name' => $family_name,
    'email' => $email,
    'location_type_id' => $location_type_id,
    'street_address' => $postal_addresses,
    'phone' => $phone,
    'gender' => $gender,
);

//DELETE
if($method == "DELETE"){

    $ch = curl_init('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Contact&action=delete&json={"sequential":1,"id":'.$id.'}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

 curl_setopt_array($ch, array(   
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HEADER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        //'Authorization: '.$authToken,
        'Content-Type: application/json'
    )));

$response = curl_exec($ch);

if($response === FALSE){
    die(curl_error($ch));
    }
}

//PUT
elseif($method == "PUT"){

$ch = curl_init('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Contact&action=create&json={"sequential":1,"id":'.$id.',"contact_type":"Individual","first_name":"'.$given_name.'","middle_name":"'.$additional_name.'","last_name":"'.$family_name.'","gender_id":"'.$gender.'","api.Address.create":{"location_type_id":"'.$location_type_id.'","street_address":"'.$postal_addresses.'"},"api.Email.create":{"email":"'.$email.'"},"api.Phone.create":{"phone":'.$phone.'}}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

curl_setopt_array($ch, array(
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_HEADER => FALSE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        //'Authorization: '.$authToken,
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS, http_build_query($data)
));

$response = curl_exec($ch);

if($response === FALSE){
    die(curl_error($ch));
    }

}



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
