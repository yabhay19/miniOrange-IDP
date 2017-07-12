<?php
/**
 * @file
 * Set up Attribute Mapping for miniOrange SAML IDP Module.
 */

 /**
 * Showing Attribute Mappping form info.
 */
 function miniorange_saml_idp_attribute_mapping($form, &$form_state) {
  global $base_url;
  
  $mo_admin_email = variable_get('miniorange_saml_idp_customer_admin_email',NULL);
  $sml_lk = variable_get('miniorange_saml_idp_sml_lk', NULL);
  
  if(!isset($mo_admin_email)){
    $form['markup_saml_idp_regsitration_message'] = array(
	  '#markup' => '<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);'
	  . ' padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">'
	  . ' Please <a href="' . $base_url . '/?q=admin/config/people/miniorange_saml_idp">Register or Login with miniOrange</a>'
	  . ' to enable Drupal IDP.</div>'
	);
  } else if(!isset($sml_lk)) {
    $form['markup_saml_idp_license_message'] = array(
	  '#markup' => '<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);'
	  . ' padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">'
	  . ' Please <a href="' . $base_url . '/?q=admin/config/people/miniorange_saml_idp">activate the license</a>'
	  . ' to enable Drupal IDP.</div>'
	);
  }
  
  $disabled = isset($mo_admin_email) && isset($sml_lk) ? FALSE : TRUE;
 
  $form['markup_idp_attr_header'] = array(
    '#markup' => '<h3>1. Attribute Mapping(Optional)</h3>',
  );
  
  if(!isset($mo_admin_email) || !isset($sml_lk)){
    $form['markup_saml_idp_disabled'] = array(
      '#markup' => '<div style="position: absolute;margin: 7% 33%;font-weight: bold;z-index: 1;">'
	  . ' </div><div style="background-color: rgba(218, 218, 218, 0);padding: 2%;opacity: 0.3;">',
    );
  }
  
  $form['miniorange_saml_idp_nameid_attr_map'] = array(
    '#type' => 'select',
	'#title' => t('NameID Attribute:'),
	'#options' => array(
	  '' => t('Select a NameID attribute value to be sent in the SAML Response'),
	  'emailAddress' => t('Drupal Email Address'),
	  'username' => t('Drupal Username'),
	),
	'#default_value' => variable_get('miniorange_saml_idp_nameid_attr_map', ''),
	'#disabled' => $disabled,
	'#description' => t('(<b>NOTE:</b> This attribute value is sent in SAML Response. Users in your Service Provider<br />'
	. ' will be searched (existing users) or created (new users) based on this attribute.<br />'
	. ' Use <b>EmailAddress</b> by default.)'),
  );
  
  $form['markup_idp_attr_header2'] = array(
    '#markup' => '<h3>2. Attribute Statement(Optional)</h3>',
  );
  
  $form['miniorange_saml_idp_attr1_name'] = array(
	'#type' => 'textfield',
	'#title' => t('Attribute Name 1'),
	'#default_value' => variable_get('miniorange_saml_idp_attr1_name', ''),
	'#disabled' => $disabled,
	'#attributes' => array('placeholder' => 'Enter Attribute Name'),
	'#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_attr1_value'] = array(
	'#type' => 'select',
	'#title' => t('Attribute Value'),
	'#options' => array(
	  '' => t('Select Attribute Value'),
	  'mail' => t('Email Address'),
	  'name' => t('Username'),
	  'status' => t('User Status'),
	  'roles' => t('User Roles'),
	),
	'#disabled' => $disabled,
	'#default_value' => variable_get('miniorange_saml_idp_attr1_value', ''),
  );
  
  $form['miniorange_saml_idp_attr2_name'] = array(
	'#type' => 'textfield',
	'#title' => t('Attribute Name 2'),
	'#default_value' => variable_get('miniorange_saml_idp_attr2_name', ''),
	'#disabled' => $disabled,
	'#attributes' => array('placeholder' => 'Enter Attribute Name'),
	'#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_attr2_value'] = array(
	'#type' => 'select',
	'#title' => t('Attribute Value'),
	'#options' => array(
	  '' => t('Select Attribute Value'),
	  'mail' => t('Email Address'),
	  'name' => t('Username'),
	  'status' => t('User Status'),
	  'roles' => t('User Roles'),
	),
	'#disabled' => $disabled,
	'#default_value' => variable_get('miniorange_saml_idp_attr2_value', ''),
  );
  
  $form['miniorange_saml_idp_attr3_name'] = array(
	'#type' => 'textfield',
	'#title' => t('Attribute Name 3'),
	'#default_value' => variable_get('miniorange_saml_idp_attr3_name', ''),
	'#disabled' => $disabled,
	'#attributes' => array('placeholder' => 'Enter Attribute Name'),
	'#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_attr3_value'] = array(
	'#type' => 'select',
	'#title' => t('Attribute Value'),
	'#options' => array(
	  '' => t('Select Attribute Value'),
	  'mail' => t('Email Address'),
	  'name' => t('Username'),
	  'status' => t('User Status'),
	  'roles' => t('User Roles'),
	),
	'#disabled' => $disabled,
	'#default_value' => variable_get('miniorange_saml_idp_attr3_value', ''),
  );
  
  $form['miniorange_saml_idp_attr4_name'] = array(
	'#type' => 'textfield',
	'#title' => t('Attribute Name 4'),
	'#default_value' => variable_get('miniorange_saml_idp_attr4_name', ''),
	'#disabled' => $disabled,
	'#attributes' => array('placeholder' => 'Enter Attribute Name'),
	'#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_attr4_value'] = array(
	'#type' => 'select',
	'#title' => t('Attribute Value'),
	'#options' => array(
	  '' => t('Select Attribute Value'),
	  'mail' => t('Email Address'),
	  'name' => t('Username'),
	  'status' => t('User Status'),
	  'roles' => t('User Roles'),
	),
	'#disabled' => $disabled,
	'#default_value' => variable_get('miniorange_saml_idp_attr4_value', ''),
  );
  
  $form['miniorange_saml_idp_attr_map_submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
	'#disabled' => $disabled,
    '#submit' => array('miniorange_saml_idp_save_attribute_mapping'),
  );
  
  return $form;

 }
 
 /**
 * Configure IdP.
 */
 function miniorange_saml_idp_save_attribute_mapping($form, &$form_state) {
  
  global $base_url;
  $mo_admin_email = variable_get('miniorange_saml_idp_customer_admin_email',NULL);
  
  if(!isset($mo_admin_email)){
    drupal_set_message(t('Please register with miniOrange to enable Drupal as IDP.'));
	drupal_goto($base_url . '/?q=admin/config/people/miniorange_saml_idp');
  }
  
  $nameid_attr = $form['miniorange_saml_idp_nameid_attr_map']['#value'];
  if($nameid_attr == ''){
    $nameid_attr = 'emailAddress';
  }
  variable_set('miniorange_saml_idp_nameid_attr_map', $nameid_attr);
  
  $attr1_name = $form['miniorange_saml_idp_attr1_name']['#value'];
  $attr1_value = $form['miniorange_saml_idp_attr1_value']['#value'];
  $attr2_name = $form['miniorange_saml_idp_attr2_name']['#value'];
  $attr2_value = $form['miniorange_saml_idp_attr2_value']['#value'];
  $attr3_name = $form['miniorange_saml_idp_attr3_name']['#value'];
  $attr3_value = $form['miniorange_saml_idp_attr3_value']['#value'];
  $attr4_name = $form['miniorange_saml_idp_attr4_name']['#value'];
  $attr4_value = $form['miniorange_saml_idp_attr4_value']['#value'];
  
  variable_set('miniorange_saml_idp_attr1_name', $attr1_name);
  variable_set('miniorange_saml_idp_attr1_value', $attr1_value);
  variable_set('miniorange_saml_idp_attr2_name', $attr2_name);
  variable_set('miniorange_saml_idp_attr2_value', $attr2_value);
  variable_set('miniorange_saml_idp_attr3_name', $attr3_name);
  variable_set('miniorange_saml_idp_attr3_value', $attr3_value);
  variable_set('miniorange_saml_idp_attr4_name', $attr4_name);
  variable_set('miniorange_saml_idp_attr4_value', $attr4_value);
  
  drupal_set_message(t('Your settings are saved successfully.'));
 
 }