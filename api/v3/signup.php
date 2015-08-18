<?php 

header("Content-type: application/json"); 

$received = json_decode(file_get_contents('php://input'));

$contact_type = $received->{"contact_type"};
$family_name = $received->{"family_name"};
$given_name = $received->{"given_name"};
$additional_name = $received->{"additional_name"};
$origin_system = $received->{"origin_system"};
$email_addresses = $received->{"email_addresses"};
$postal_addresses = $received->{"postal_addresses"};
$phone_numbers = $received->{"phone_numbers"};
$gender = $received->{"gender"};

$postData= array(
    'contact_type' => $contact_type,
    'first_name' => $given_name,
    'middle_name' => $additional_name,
    'last_name' => $family_name,
    'email' => $email_addresses,
    'street_address' => $postal_addresses,
    'phone' => $phone_numbers,
    'gender' => $gender,
);
//Right now only for given & family name and contact type 
$ch = curl_init('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Contact&action=create&json={"sequential":1,"contact_type":"'.$contact_type.'","first_name":"'.$given_name.'","last_name":"'.$family_name.'"}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        //'Authorization: '.$authToken,
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

$response = curl_exec($ch);

if($response === FALSE){
    die(curl_error($ch));
}

echo "These response are added in the ";

print_r($postData);

?>
