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
 ini_set('display_errors', 'On');
 $array = civicrm_api3('contact', 'get', array());

 $array['values'] = array_map(function($item){
  $item['given_name'] = $item['first_name'];      
  unset($item['first_name']);
  $item['family_name'] = $item['last_name'];      
  unset($item['last_name']);
  $item['additional_name'] = $item['middle_name'];      
  unset($item['middle_name']);
  $item['honorific_prefix'] = $item['prefix_id'];      
  unset($item['prefix_id']);
  $item['honorific_suffix'] = $item['suffix_id'];      
  unset($item['suffix_id']);
  $item['gender'] = $item['gender_id'];      
  unset($item['gender_id']);
  $item['birthdate'] = $item['birth_date'];      
  unset($item['birth_date']);
  /*
  NOTE: To add a new OSDI format field, Paste 2 LoCs above, replace the placholders & uncomment
  $item['OSDI_Field'] = $item['CiviCRM_Field'];      
  unset($item['CiviCRM_Field']);
  */
  return $item;
}, $array['values']);

 print_r($array);
}