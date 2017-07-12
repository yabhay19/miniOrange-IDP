<?php
/**
 * @file
 * Contains Service Provider information for miniOrange SAML Login Module.
 */

 /**
 * Showing Service Provider information.
 */
 function miniorange_sp_information($form, &$form_state) {

  global $base_url;
  $issuer = $base_url . '/?q=admin/config/people/miniorange_saml_idp/';
  $url = $base_url . '/';
  $login_url = $url . '?q=initiatelogon';
  
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
  
  $form['header'] = array(
    '#markup' => '<center><h3>You will need the following information to'
    . ' configure your Service Provider. Copy it and keep it handy</h3></center>',
  );

  $header = array(
    'attribute' => array('data' => t('Attribute')),
    'value' => array('data' => t('Value')),
  );

  $options = array();

  $options[0] = array(
    'attribute' => t('IDP-Entity ID / Issuer'),
    'value' => $issuer,
  );

  $options[1] = array(
    'attribute' => t('SAML Login URL'),
    'value' => $login_url,
  );

  $options[2] = array(
    'attribute' => t('SAML Logout URL'),
    'value' => $url,
  );

  $options[3] = array(
    'attribute' => t('Certificate (Optional)'),
    'value' => t('<a href="' . $base_url . '/sites/all/modules/miniorange_saml_idp/resources/idp-signing.crt">Download</a>'),
  );

  $options[4] = array(
    'attribute' => t('Response Signed'),
    'value' => 'You can choose to sign your response in'
	. ' <a href="' . $base_url . '/?q=admin/config/people/miniorange_saml_idp/idp_setup">Identity Provider</a>',
  );

  $options[5] = array(
    'attribute' => t('Assertion Signed'),
    'value' => 'You can choose to sign your response in'
	. ' <a href="' . $base_url . '/?q=admin/config/people/miniorange_saml_idp/idp_setup">Identity Provider</a>',
  );

  $form['fieldset']['spinfo'] = array(
    '#theme' => 'table',
    '#header' => $header,
    '#rows' => $options,
  );

  $form['markup_idp_sp'] = array(
    '#markup' => '<center><h2>OR</h2></center>',
  );

  $form['markup_idp_sp_1'] = array(
    '#markup' => 'You can provide this metadata URL to your Service Provider.<br />',
  );

  $form['markup_idp_sp_2'] = array(
    '#markup' => '<code style="background-color:gainsboro;"><b>'
	. '<a target="_blank" href="' . $base_url . '/sites/all/modules/miniorange_saml_idp/includes/metadata/metadata.php">' . $base_url . '/sites/all/modules/miniorange_saml_idp/includes/metadata/metadata.php' . '</a></b></code>',
  );

  return $form;
 }
