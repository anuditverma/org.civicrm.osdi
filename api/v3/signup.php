<?php 

header("Content-type: application/json"); 
$received = 0;
$received = json_decode(file_get_contents('php://input'));

$family_name = $received->{"family_name"};
$additional_name = $received->{"additional_name"};
$given_name = $received->{"given_name"};
$email = $received->{"email"};
$location_type_id = $received->{"location_type_id"};
$postal_addresses = $received->{"postal_addresses"};
$phone = $received->{"phone"};
$gender = $received->{"gender"};
$action = $received->{"action"};

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

 $ch = curl_init('http://camus.fuzion.co.nz/sites/all/modules/civicrm/extern/rest.php?entity=Contact&action=create&json={"sequential":1,"contact_type":"Individual","first_name":"'.$given_name.'","middle_name":"'.$additional_name.'","last_name":"'.$family_name.'","gender_id":"'.$gender.'","api.Address.create":{"location_type_id":"'.$location_type_id.'","street_address":"'.$postal_addresses.'"},"api.Email.create":{"email":"'.$email.'"},"api.Phone.create":{"phone":'.$phone.'}}&api_key=9BivcYv1cOT7md6Rxom8Stiz&key=gNhqb5uGUaiLAHrZ');

curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        //'Authorization: '.$authToken,
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($data)
));

$response = curl_exec($ch);

if($response === FALSE){
    die(curl_error($ch));
}

if ($received != 0) {
    echo "These response are added in the ";
    print_r($data);
}
else{
    echo "Please pass the data in JSON format";
}

?>
