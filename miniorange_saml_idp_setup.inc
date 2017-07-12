<?php
/**
 * @file
 * Set up Identity Provide for miniOrange SAML IDP Module.
 */

 /**
 * Showing IdP Setup form info.
 */
 function miniorange_saml_idp_setup($form, &$form_state) {
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
  
  
  $form['markup_idp_header'] = array(
    '#markup' => '<h3>Configure Identity Provider</h3>',
  );
  
  $form['markup_idp_note'] = array(
    '#markup' => '<div>Please note down the following information from your Service Provider'
	. ' and keep it handy to configure your Identity Provider.</div>',
  );
  
  $form['markup_idp_list'] = array(
    '#markup' => '<b><ol><li>SP Entity ID / Issuer</li>'
	. ' <li>ACS URL</li>'
	. ' <li>NameID Format</li>'
	. ' <li>Relay State</li>'
	. ' <li>X.509 Certificate for Signing if you are using HTTP-POST Binding. (Optional)</li>'
	. ' <li>X.509 Certificate for Encryption. (Optional)</li>'
	. ' </ol></b><br />',
  );
  
  if(!isset($mo_admin_email) || !isset($sml_lk)){
    $form['markup_saml_idp_disabled'] = array(
      '#markup' => '<div style="position: absolute;margin: 7% 33%;font-weight: bold;z-index: 1;">'
	  . ' </div><div style="background-color: rgba(218, 218, 218, 0);padding: 2%;opacity: 0.3;">',
    );
  }
  
  $form['miniorange_saml_idp_sp_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Service Provider Name'),
    '#default_value' => variable_get('miniorange_saml_idp_sp_name', ''),
	'#disabled' => $disabled,
    '#attributes' => array('placeholder' => 'Service Provider Name'),
    '#required' => TRUE,
  );

  $form['miniorange_saml_idp_sp_entity_id'] = array(
    '#type' => 'textfield',
    '#title' => t('SP Entity ID or Issuer'),
    '#default_value' => variable_get('miniorange_saml_idp_sp_entity_id', ''),
	'#disabled' => $disabled,
    '#attributes' => array('placeholder' => 'SP Entity ID or Issuer'),
    '#required' => TRUE,
  );

  $form['miniorange_saml_idp_acs_url'] = array(
    '#type' => 'textfield',
    '#title' => t('ACS URL'),
    '#default_value' => variable_get('miniorange_saml_idp_acs_url', ''),
	'#disabled' => $disabled,
    '#attributes' => array('placeholder' => 'ACS URL'),
    '#required' => TRUE,
  );
  
   $form['miniorange_saml_idp_relay_state'] = array(
    '#type' => 'textfield',
    '#title' => t('Relay State'),
    '#default_value' => variable_get('miniorange_saml_idp_relay_state', ''),
	'#disabled' => $disabled,
    '#attributes' => array('placeholder' => 'Realy State (optional)'),
    '#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_certificate_signed'] = array(
    '#type' => 'textarea',
    '#title' => t('X.509 Certificate [For Signed Request]'),
    '#default_value' => variable_get('miniorange_saml_idp_certificate_signed', ''),
	'#disabled' => $disabled,
    '#attributes' => array('placeholder' => ''),
    '#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_cert_format'] = array(
	 '#markup' => '<br /><strong>NOTE :</strong> Format of the certificate:<br /><strong>-----BEGIN CERTIFICATE-----<br />'
	 . 'XXXXXXXXXXXXXXXXXXXXXXXXXXX<br />-----END CERTIFICATE-----</strong><br /><br />',
  );
  
  $form['miniorange_saml_idp_certificate_encrypted'] = array(
    '#type' => 'textarea',
    '#title' => t('X.509 Certificate [For Encrypted Assertion]'),
    '#default_value' => variable_get('miniorange_saml_idp_certificate_encrypted', ''),
	'#disabled' => $disabled,
    '#attributes' => array('placeholder' => ''),
    '#required' => FALSE,
  );
  
  $form['miniorange_saml_idp_nameid_format'] = array(
    '#type' => 'select',
	'#title' => t('NameID Format:'),
	'#options' => array(
	  '1.1:nameid-format:emailAddress' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress'),
	  '1.1:nameid-format:unspecified' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified'),
	  '2.0:nameid-format:transient' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:transient'),
	  '2.0:nameid-format:persistent' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:persistent'),
	),
	'#default_value' => variable_get('miniorange_saml_idp_nameid_format', ''),
	'#disabled' => $disabled,
	'#description' => t('(<b>NOTE:</b> urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress is selected by default)'),
  );
  
  $form['miniorange_saml_idp_response_signed'] = array(
    '#type' => 'checkbox',
    '#title' => t('Response Signed (Check If you want to sign SAML Response.)'),
    '#required'=>FALSE,
	'#disabled' => $disabled,
    '#default_value' => variable_get('miniorange_saml_idp_response_signed', FALSE),
  );
  
  $form['miniorange_saml_idp_assertion_signed'] = array(
    '#type' => 'checkbox',
    '#title' => t('Assertion Signed (Check If you want to sign SAML Assertion.)'),
    '#required'=>FALSE,
	'#disabled' => $disabled,
    '#default_value' => variable_get('miniorange_saml_idp_assertion_signed', FALSE),
  );
  
  $form['miniorange_saml_idp_encrypted_assertion'] = array(
    '#type' => 'checkbox',
    '#title' => t('Encrypted Assertion (Check If you want to encrypt SAML Assertion.)<br /><b>Note:</b> If you are checking this option then you have to enter'
	. ' the certificate for X.509 Certificate [For Encrypted Assertion].'),
    '#required'=>FALSE,
	'#disabled' => $disabled,
    '#default_value' => variable_get('miniorange_saml_idp_encrypted_assertion', FALSE),
	'#suffix' => '<br />',
  );
  
  $form['miniorange_saml_idp_config_submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save Configuration'),
	'#disabled' => $disabled,
    '#submit' => array('miniorange_saml_idp_save_idp_config'),
  );

  $form['miniorange_saml_idp_test_config_button'] = array(
    '#markup' => '<a class="btn btn-primary btn-large" style="padding:6px 12px;" onclick="testIdpConfig(\'' . getTestUrl() . '\');">'
    . 'Test Configuration</a><br><br>'
  );
  
  return $form;

 }

 function getTestUrl() {
  global $base_url;
  $issuer = variable_get('miniorange_saml_idp_sp_entity_id');
  $acs = variable_get('miniorange_saml_idp_acs_url');
  $testUrl = $base_url . '/?q=mo_testIdpConfig';

  return $testUrl; 
 }

 /**
 * Configure IdP.
 */
 function miniorange_saml_idp_save_idp_config($form, &$form_state) {
  global $base_url;
  $mo_admin_email = variable_get('miniorange_saml_idp_customer_admin_email',NULL);
  
  if(!isset($mo_admin_email)){
    drupal_set_message(t('Please register with miniOrange to enable Drupal as IDP.'));
	drupal_goto($base_url . '/?q=admin/config/people/miniorange_saml_idp');
  }
  
  $sp_name = $form['miniorange_saml_idp_sp_name']['#value'];
  $issuer = $form['miniorange_saml_idp_sp_entity_id']['#value'];
  $acs_url = $form['miniorange_saml_idp_acs_url']['#value'];
  $relay_state = $form['miniorange_saml_idp_relay_state']['#value'];
  
  $signed_certificate = $form['miniorange_saml_idp_certificate_signed']['#value'];
  if(!empty($signed_certificate))
	$signed_certificate = Utilities::sanitize_certificate($form['miniorange_saml_idp_certificate_signed']['#value']);
  
  $encrypted_certificate = $form['miniorange_saml_idp_certificate_encrypted']['#value'];
  if(!empty($encrypted_certificate))
	$encrypted_certificate = Utilities::sanitize_certificate($form['miniorange_saml_idp_certificate_encrypted']['#value']);
	
  $nameid_format = $form['miniorange_saml_idp_nameid_format']['#value'];
  $is_response_signed = $form['miniorange_saml_idp_response_signed']['#value'] == 1 ? TRUE : FALSE;
  $is_assertion_signed = $form['miniorange_saml_idp_assertion_signed']['#value'] == 1 ? TRUE : FALSE;
  $is_encrypted_assertion = $form['miniorange_saml_idp_encrypted_assertion']['#value'] == 1 ? TRUE : FALSE;
  
  variable_set('miniorange_saml_idp_sp_name', $sp_name);
  variable_set('miniorange_saml_idp_sp_entity_id', $issuer);
  variable_set('miniorange_saml_idp_acs_url', $acs_url);
  variable_set('miniorange_saml_idp_relay_state', $relay_state);
  variable_set('miniorange_saml_idp_certificate_signed', $signed_certificate);
  variable_set('miniorange_saml_idp_certificate_encrypted', $encrypted_certificate);
  variable_set('miniorange_saml_idp_nameid_format', $nameid_format);
  variable_set('miniorange_saml_idp_response_signed', $is_response_signed);
  variable_set('miniorange_saml_idp_assertion_signed', $is_assertion_signed);
  
  if(!empty($encrypted_certificate))
    variable_set('miniorange_saml_idp_encrypted_assertion', $is_encrypted_assertion);
  
  drupal_set_message(t('Your Service Provider Configuration are successfully saved. You can click on Test Configuration button below to test these configurations.'));

 }
