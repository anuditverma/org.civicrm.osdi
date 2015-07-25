<?php
/**
 * People.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_people_Get_spec(&$spec) {
  $spec['magicword']['api.required'] = 1;
}
/**
 * People.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_people_Get($params) {
 $array = civicrm_api3('contact', 'get', array());
    foreach($array['values'] as $key => $value){
       $default[$key] = array(
                         'contact_id' => $value['contact_id'],
                         'contact_type' => $value['contact_type'],
                         'contact_sub_type' => $value['contact_sub_type'],
                         'display_name' => $value['display_name'],
                         'do_not_email' => $value['do_not_email'],
                         'do_not_phone' => $value['do_not_phone'],
                         'do_not_mail' => $value['do_not_mail'],
                         'do_not_sms' => $value['do_not_sms'],
                         'do_not_trade' => $value['do_not_trade'],
                         'is_opt_out' => $value['is_opt_out'],
                         'legal_identifier' => $value['legal_identifier'],
                         'external_identifier' => $value['external_identifier'],
                         'nick_name' => $value['nick_name'],
                         'legal_name' => $value['legal_name'],
                         'image_URL' => $value['image_URL'],
                         'preferred_communication_method' => $value['preferred_communication_method'],
                         'languages_spoken' => $value['preferred_language'],
                         'preferred_mail_format' => $value['preferred_mail_format'],
                         'given_name' => $value['first_name'],
                         'additional_name' => $value['middle_name'],
                         'family_name' => $value['last_name'],
                         'honorific_prefix' => $value['prefix_id'],
                         'honorific_suffix' => $value['suffix_id'],
                         'formal_title' => $value['formal_title'],
                         'communication_style_id' => $value['communication_style_id'],
                         'job_title' => $value['job_title'],
                         'gender' => $value['gender_id'],
                         'birthdate' => $value['birth_date'],
                         'is_deceased' => $value['is_deceased'],
                         'deceased_date' => $value['deceased_date'],
                         'household_name' => $value['household_name'],
                         'organization_name' => $value['organization_name'],
                         'sic_code' => $value['sic_code'],
                         'contact_is_deleted' => $value['contact_is_deleted'],
                         'current_employer' => $value['current_employer'],
                         'address_id' => $value['address_id'],
                         'postal_addresses' => $value['street_address'],
                         'supplemental_address_1' => $value['supplemental_address_1'],
                         'supplemental_address_2' => $value['supplemental_address_2'],
                         'city' => $value['city'],
                         'postal_code_suffix' => $value['postal_code_suffix'],
                         'postal_code' => $value['postal_code'],
                         'geo_code_1' => $value['geo_code_1'],
                         'geo_code_2' => $value['geo_code_2'],
                         'state_province_id' => $value['state_province_id'],
                         'country_id' => $value['country_id'],
                         'phone_id' => $value['phone_id'],
                         'phone_type_id' => $value['phone_type_id'],
                         'phone' => $value['phone'],
                         'email_id' => $value['email_id'],
                         'email' => $value['email'],
                         'on_hold' => $value['on_hold'],
                         'im_id' => $value['im_id'],
                         'provider_id' => $value['provider_id'],
                         'im' => $value['im'],
                         'worldregion_id' => $value['worldregion_id'],
                         'world_region' => $value['world_region'],
                         'individual_prefix' => $value['individual_prefix'],
                         'individual_suffix' => $value['individual_suffix'],
                         'individual_suffix' => $value['individual_suffix'],
                         'communication_style' => $value['communication_style'],
                         'gender' => $value['gender'],
                         'state_province_name' => $value['state_province_name'],
                         'state_province' => $value['state_province'],
                         'country' => $value['country'],
                         'id' => $value['id'],
                         /*
                          Get.php V2
                          Reformatting CiviCRM fields into OSDI without rearrangement of the elememt_IDs  
                         'OSDI_Field' => $value['CiviCRM_Field'],
                         */
                         );
    }
                         
 return (civicrm_api3_create_success($default, 'People', 'get')); //Added CiviCRM coding standard
}
