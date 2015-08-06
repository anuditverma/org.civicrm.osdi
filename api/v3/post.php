<?php
 echo("CiviCRM Person-signup Helper | Data Status : ");

$config = array(
        'url'=>'https://osdi-sample-system.org/api/v1/people/person_signup_helper/',
        'key'=>'529c6305d4e249b8ffc9cbdf3e6586e6'
        );

$data = array(
    'family_name' => $_POST['family_name'],
    'given_name'  => $_POST['given_name'],
    'additional_name' => $_POST['additional_name'],
    'origin_system' =>  $_POST['origin_system'],
    'email_addresses' => $_POST['address'],    
    'postal_addresses' => $_POST['postal_addresses'],
    'phone_numbers' =>$_POST['phone_numbers'],
    'gender' =>$_POST['gender'],
    'add_tags' =>$_POST['add_tags'],
    'add_lists' =>$_POST['add_lists']

);
if (isset($_POST['submit'])) {
    echo "SENT";
     POSTdata();
   }

function POSTdata(){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $config['url']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_USERAGENT, 'curl/x.y.z');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/HAL+json', 'API-Key: '.$config['key']));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result=curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
}

?>

<img src="http://camus.fuzion.co.nz/sites/default/files/logo.png" alt="civilogo" align="left" style="width:30px;height:30px;">
<form action="post.php" method="post">
   <p>First name: <input type="text" name="family_name" /></p>
   <p>Last name: <input type="text" name="given_name" /></p>
   <p>Nick Name: <input type="text" name="additional_name" /></p>
   <p>Origin System: <input type="text" name="origin_system" /></p>
   <p>Email Addresses: <input type="text" name="address" /></p>
   <p>Postal Addresses: <input type="text" name="given_name" /></p>
   <p>Phone Numbers: <input type="text" name="postal_addresses" /></p>
   <p>Gender: <input type="text" name="gender" /></p>
   <p>Add Tags: <input type="text" name="add_tags" /></p>
   <p>Add Lists: <input type="text" name="add_lists" /></p>
   <input type="submit" name="submit" value="Submit" />
</form>
