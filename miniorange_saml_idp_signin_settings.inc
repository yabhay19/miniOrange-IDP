<?php
/**
 * @file
 * Set up Sign In Settings for miniOrange SAML IDP Module.
 */

 /**
 * Showing Sign in Settings info.
 */
function miniorange_saml_idp_signin_settings($form, &$form_state) {
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
  
  $form['markup_idp_login_header'] = array(
    '#markup' => '<h3>IDP Initiated Login</h3>',
  );
  
  $form['markup_idp_login_info'] = array(
    '#markup' => '<div><b>Add a link to user dashboard for login into your Service Provider.</b></div>',
  );
  
  $form['markup_idp_login_note'] = array(
    '#markup' => '<div><b>Note: </b>Add the following link such that it is only visible to your logged in users only.</div>',
  );
  
  $form['markup_idp_login_link'] = array(
    '#markup' => '<div style="color:#3071a9;"><b><span class="site-url">' . $base_url . '</span>/?q=saml_user_login'
	. '&amp;sp=&lt;Your SP Name&gt;</b></div>',
  );
  
  return $form;
}