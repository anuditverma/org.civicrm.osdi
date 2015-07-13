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
 $display=array();
    foreach ($array as $value) {
      foreach ($value as $value2) {
        $display [] = array (
                         'contact_id' => $value2['contact_id'],
                         'contact_type' => $value2['contact_type'],
                         'contact_sub_type' => $value2['contact_sub_type'],
                         'display_name' => $value2['display_name'],
                         'do_not_email' => $value2['do_not_email'],
                         'do_not_phone' => $value2['do_not_phone'],
                         'do_not_mail' => $value2['do_not_mail'],
                         'do_not_sms' => $value2['do_not_sms'],
                         'do_not_trade' => $value2['do_not_trade'],
                         'is_opt_out' => $value2['is_opt_out'],
                         'legal_identifier' => $value2['legal_identifier'],
                         'external_identifier' => $value2['external_identifier'],
                         'nick_name' => $value2['nick_name'],
                         'legal_name' => $value2['legal_name'],
                         'image_URL' => $value2['image_URL'],
                         'preferred_communication_method' => $value2['preferred_communication_method'],
                         'languages_spoken' => $value2['preferred_language'],
                         'preferred_mail_format' => $value2['preferred_mail_format'],
                         'given_name' => $value2['first_name'],
                         'additional_name' => $value2['middle_name'],
                         'family_name' => $value2['last_name'],
                         'honorific_prefix' => $value2['prefix_id'],
                         'honorific_suffix' => $value2['suffix_id'],
                         'formal_title' => $value2['formal_title'],
                         'communication_style_id' => $value2['communication_style_id'],
                         'job_title' => $value2['job_title'],
                         'gender' => $value2['gender_id'],
                         'birthdate' => $value2['birth_date'],
                         'is_deceased' => $value2['is_deceased'],
                         'deceased_date' => $value2['deceased_date'],
                         'household_name' => $value2['household_name'],
                         'organization_name' => $value2['organization_name'],
                         'sic_code' => $value2['sic_code'],
                         'contact_is_deleted' => $value2['contact_is_deleted'],
                         'current_employer' => $value2['current_employer'],
                         'address_id' => $value2['address_id'],
                         'postal_addresses' => $value2['street_address'],
                         'supplemental_address_1' => $value2['supplemental_address_1'],
                         'supplemental_address_2' => $value2['supplemental_address_2'],
                         'city' => $value2['city'],
                         'postal_code_suffix' => $value2['postal_code_suffix'],
                         'postal_code' => $value2['postal_code'],
                         'geo_code_1' => $value2['geo_code_1'],
                         'geo_code_2' => $value2['geo_code_2'],
                         'state_province_id' => $value2['state_province_id'],
                         'country_id' => $value2['country_id'],
                         'phone_id' => $value2['phone_id'],
                         'phone_type_id' => $value2['phone_type_id'],
                         'phone' => $value2['phone'],
                         'email_id' => $value2['email_id'],
                         'email' => $value2['email'],
                         'on_hold' => $value2['on_hold'],
                         'im_id' => $value2['im_id'],
                         'provider_id' => $value2['provider_id'],
                         'im' => $value2['im'],
                         'worldregion_id' => $value2['worldregion_id'],
                         'world_region' => $value2['world_region'],
                         'individual_prefix' => $value2['individual_prefix'],
                         'individual_suffix' => $value2['individual_suffix'],
                         'individual_suffix' => $value2['individual_suffix'],
                         'communication_style' => $value2['communication_style'],
                         'gender' => $value2['gender'],
                         'state_province_name' => $value2['state_province_name'],
                         'state_province' => $value2['state_province'],
                         'country' => $value2['country'],
                         'id' => $value2['id'],
                         /*
                          Get.php V2
                          Reformaatting CiviCRM fields into OSDI without rearrangement of the elememt_IDs  
                         'OSDI_Field' => $value2['CiviCRM_Field'],
                         */
                         );
              }
    }

 echo json_encode($display); //For returning the JSON representation of a value
}
