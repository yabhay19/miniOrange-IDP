<?php
/**
 * @file
 * Contains form for customer setup.
 */

/**
 * Customer setup form().
 */
function miniorange_saml_idp_customer_setup($form, &$form_state) {

  $current_status = variable_get('miniorange_saml_idp_status', '');
  if ($current_status == 'MOIDP_VALIDATE_OTP') {
    $form['miniorange_saml_idp_customer_otp_token'] = array(
      '#type' => 'textfield',
      '#title' => t('OTP'),
    );

    $form['miniorange_saml_idp_customer_validate_otp_button'] = array(
      '#type' => 'submit',
      '#value' => t('Validate OTP'),
      '#submit' => array('miniorange_saml_idp_validate_otp_submit'),
    );

    $form['miniorange_saml_idp_customer_setup_resendotp'] = array(
      '#type' => 'submit',
      '#value' => t('Resend OTP'),
      '#submit' => array('miniorange_saml_idp_resend_otp'),
    );

    $form['miniorange_saml_idp_customer_setup_back'] = array(
      '#type' => 'submit',
      '#value' => t('Back'),
      '#submit' => array('miniorange_saml_idp_back'),
    );

    return $form;
  }
  elseif ($current_status == 'MOIDP_VERIFY_LICENSE') {
    $hostname = MiniorangeSAMLIdpConstants::BASE_URL;
	$form['markup_idp_header'] = array(
      '#markup' => '<h3>Verify Your License</h3>',
    );
	
	$form['markup_idp_lk'] = array(
      '#markup' => '<div id="myidpkey" class="in collapse" style="height: auto;">'
	  . 'You can find all your used and unused keys under the <i>View License Key</i> Section. '
	  . '<a href="' . $hostname . '/moas/login?requestOrigin=joomla_saml_idp_basic_plan&amp;redirectUrl=' . $hostname . '/moas/viewlicensekeys"'
	  . 'target="_blank">Click Here</a> to see your keys.' 
	  . '</div>',
    );
	
	$form['miniorange_saml_idp_lkey'] = array (
	  '#type' => 'textfield',
      '#title' => t('License Key'),
      '#attributes' => array('placeholder' => 'Enter your license key'),
      '#required' => TRUE,
	);
	
	$form['markup_idp_tnc'] = array (
	  '#markup' => '<p><b><font color="#FF0000">*</font>Please check this to confirm that you have read it: </b>&nbsp;&nbsp;<b>'
	  . '<input required="" type="checkbox" name="license_conditions" id="license-chk" class="form-control idp-checkbox"></b></p>'
	  . '<ol><li>License key you have entered here is associated with this site instance. In future, if you are re-installing the plugin or'
	  . 'your site for any reason, you should deregister licence key from Accounts tab before deleting the plugin. So that you can resuse the' 
	  . 'same license key.</li><br><li><b>This is not a developers license.</b> Making any kind of change to the plugins code will delete all'
	  . 'your configuration and make the plugin unusable.</li></ol>',
	);
	
	$form['miniorange_saml_idp_activate_license'] = array(
      '#type' => 'submit',
      '#value' => t('Activate License'),
      '#submit' => array('miniorange_saml_idp_activate_license'),
    );
	
	return $form;
  }
  elseif ($current_status == 'MOIDP_PLUGIN_CONFIGURATION') {
    // Show customer configuration here.
    $form['markup_idp_top'] = array(
      '#markup' => '<div>Thank you for registering with miniOrange</div>'
      . '<h4>Your Profile: </h4>',
    );

    $header = array(
      'email' => array('data' => t('Customer Email')),
      'customerid' => array('data' => t('Customer ID')),
      'token' => array('data' => t('Token Key')),
      'apikey' => array('data' => t('API Key')),
    );

    $options = array();

    $options[0] = array(
      'email' => variable_get('miniorange_saml_idp_customer_admin_email', ''),
      'customerid' => variable_get('miniorange_saml_idp_customer_id', ''),
      'token' => variable_get('miniorange_saml_idp_customer_admin_token', ''),
      'apikey' => variable_get('miniorange_saml_idp_customer_api_key', ''),
    );

    $form['fieldset']['customerinfo'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $options,
    );

    return $form;
  }

  $form['markup_idp_1'] = array(
    '#markup' => '<h3>Register with miniOrange</h3>',
  );

  $form['markup_idp_2'] = array(
    '#markup' => 'Just complete the short registration below to configure'
    . ' the SAML IDP Plugin. Please enter a valid email id <br>that you have'
    . ' access to. You will be able to move forward after verifying an OTP'
    . ' that we will send to this email.',
  );

  $form['miniorange_saml_idp_customer_setup_username'] = array(
    '#type' => 'textfield',
    '#title' => t('Email'),
    '#required' => TRUE,
  );

  $form['miniorange_saml_idp_customer_setup_phone'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone'),
  );

  $form['markup_idp_3'] = array(
    '#markup' => '<b>NOTE:</b> We will only call if you need support.',
  );

  $form['miniorange_saml_idp_customer_setup_password'] = array(
    '#type' => 'password_confirm',
    '#required' => TRUE,
  );

  $form['miniorange_saml_idp_customer_setup_button'] = array(
    '#type' => 'submit',
    '#value' => t('Register'),
    '#submit' => array('miniorange_saml_idp_customer_setup_submit'),
  );

  return $form;

}

/**
 * Validate OTP.
 */
function miniorange_saml_idp_validate_otp_submit(&$form, $form_state) {

  $otp_token = $form['miniorange_saml_idp_customer_otp_token']['#value'];
  $username = variable_get('miniorange_saml_idp_customer_admin_email', NULL);
  $phone = variable_get('miniorange_saml_idp_customer_admin_phone', NULL);
  $tx_id = variable_get('miniorange_saml_idp_tx_id', NULL);
  $customer_config = new MiniorangeSAMLIdpCustomer($username, $phone, NULL, $otp_token);

  // Validate OTP.
  $validate_otp_response = json_decode($customer_config->validateOtp($tx_id));
  if ($validate_otp_response->status == 'SUCCESS') {
    // OTP Validated. Show Configuration page.
    $current_status = 'MOIDP_VERIFY_LICENSE';
    variable_set('miniorange_saml_idp_status', $current_status);
    variable_del('miniorange_saml_idp_tx_id');

    // OTP Validated. Create customer.
    $password = variable_get('miniorange_saml_idp_customer_admin_password', '');
    $customer_config = new MiniorangeSAMLIdpCustomer($username, $phone, $password, NULL);
    $create_customer_response = json_decode($customer_config->createCustomer());
    if ($create_customer_response->status == 'SUCCESS') {
      // Customer created.
      $current_status = 'MOIDP_VERIFY_LICENSE';
      variable_set('miniorange_saml_idp_status', $current_status);
      variable_set('miniorange_saml_idp_customer_admin_email', $username);
      variable_set('miniorange_saml_idp_customer_admin_phone', $phone);
      variable_set('miniorange_saml_idp_customer_admin_token', $create_customer_response->token);
      variable_set('miniorange_saml_idp_customer_id', $create_customer_response->id);
      variable_set('miniorange_saml_idp_customer_api_key', $create_customer_response->apiKey);
	  variable_del('miniorange_saml_idp_customer_admin_password');

      drupal_set_message(t('Customer account created. Please acticate your license.'));
    }
    else {
      drupal_set_message(t('Error creating customer'), 'error');
    }
  }
  else {
    drupal_set_message(t('Error validating OTP'), 'error');
  }

}

/**
 * Resend OTP.
 */
function miniorange_saml_idp_resend_otp(&$form, $form_state) {

  variable_del('miniorange_saml_idp_tx_id');
  $username = variable_get('miniorange_saml_idp_customer_admin_email', NULL);
  $phone = variable_get('miniorange_saml_idp_customer_admin_phone', NULL);
  $customer_config = new MiniorangeSAMLIdpCustomer($username, $phone, NULL, NULL);
  $send_otp_response = json_decode($customer_config->sendOtp());
  if ($send_otp_response->status == 'SUCCESS') {
    // Store txID.
    variable_set('miniorange_saml_idp_tx_id', $send_otp_response->txId);
    $current_status = 'MOIDP_VALIDATE_OTP';
    variable_set('miniorange_saml_idp_status', $current_status);
    drupal_set_message(t('Verify email address by entering the passcode sent to @username', array('@username' => $username)));
  }
  else {
	$current_status = 'MOIDP_VALIDATE_OTP';
    variable_set('miniorange_saml_idp_status', $current_status);
	drupal_set_message(t('There was an error in sending OTP to your email. Please try again.'));
  }
}

/**
 * Handles License.
 */
function miniorange_saml_idp_activate_license(&$form, $form_state) {
  $lkey = $form['miniorange_saml_idp_lkey']['#value'];

  if( !empty($lkey)){
	$customer = new MiniorangeSAMLIdpCustomer(NULL, NULL, NULL, NULL);
	$response = $customer->check_status($lkey);

	if(strcasecmp($response['status'], 'SUCCESS') == 0){
		$result = json_decode($customer->ccl());
    $usersCount = array_key_exists('noOfUsers', $result) ? $result->noOfUsers : null;
    $key = variable_get('miniorange_saml_idp_customer_admin_token', '');
    variable_set('mo_idp_cnt', Utilities::encrypt(0, $key));
    variable_set('mo_idp_lmt', Utilities::encrypt($usersCount, $key));
	variable_set('mo_idp_year_license',time());
		$current_status = 'MOIDP_PLUGIN_CONFIGURATION';
		variable_set('miniorange_saml_idp_status', $current_status);
		$stored_key = Utilities::encrypt($lkey, $key);
		variable_set('miniorange_saml_idp_sml_lk', $stored_key);
		drupal_set_message(t('Your license has been verified. You can configure your Service Provider settings now.'));
		
	} else{
		$current_status = 'MOIDP_VERIFY_LICENSE';
		variable_set('miniorange_saml_idp_status', $current_status);
		if(strcasecmp($response['isExpired'], '1') == 0)
			drupal_set_message(t('Your license key is expired. Please try with different key or contact info@miniorange.com'));
		else
			drupal_set_message(t($response['message'].'. Please try with different key or contact info@miniorange.com'));
	}
	
  }else{
	$current_status = 'MOIDP_VERIFY_LICENSE';
	variable_set('miniorange_saml_idp_status', $current_status);
	drupal_set_message(t('Error activating your license. Please try again or contact info@miniorange.com'));
  }
	
}

/**
 * Handle submit for customer setup.
 */
function miniorange_saml_idp_customer_setup_submit(&$form, $form_state) {
  $username = $form['miniorange_saml_idp_customer_setup_username']['#value'];
  $phone = $form['miniorange_saml_idp_customer_setup_phone']['#value'];
  $password = $form['miniorange_saml_idp_customer_setup_password']['#value']['pass1'];

  $customer_config = new MiniorangeSAMLIdpCustomer($username, $phone, $password, NULL);
  $check_customer_response = json_decode($customer_config->checkCustomer());
 
  if ($check_customer_response->status == 'CURL_ERROR') {
    drupal_set_message(t('cURL is not enabled. Please enable cURL'), 'error');
  }
  else if ($check_customer_response->status == 'CUSTOMER_NOT_FOUND') {
    // Create customer.
    // Store email and phone.
    variable_set('miniorange_saml_idp_customer_admin_email', $username);
    variable_set('miniorange_saml_idp_customer_admin_phone', $phone);
    variable_set('miniorange_saml_idp_customer_admin_password', $password);

    $send_otp_response = json_decode($customer_config->sendOtp());
    if ($send_otp_response->status == 'SUCCESS') {
      // Store txID.
      variable_set('miniorange_saml_idp_tx_id', $send_otp_response->txId);
      $current_status = 'MOIDP_VALIDATE_OTP';
      variable_set('miniorange_saml_idp_status', $current_status);
      drupal_set_message(t('Verify email address by entering the passcode sent to @username', array('@username' => $username)));
    }
  }
  else {
    // Customer exists. Retrieve keys.
    $customer_keys_response = json_decode($customer_config->getCustomerKeys());
    if (json_last_error() == JSON_ERROR_NONE) {
      variable_set('miniorange_saml_idp_customer_id', $customer_keys_response->id);
      variable_set('miniorange_saml_idp_customer_admin_token', $customer_keys_response->token);
      variable_set('miniorange_saml_idp_customer_admin_email', $username);
      variable_set('miniorange_saml_idp_customer_admin_phone', $phone);
      variable_set('miniorange_saml_idp_customer_api_key', $customer_keys_response->apiKey);
      $current_status = 'MOIDP_VERIFY_LICENSE';
      variable_set('miniorange_saml_idp_status', $current_status);
      drupal_set_message(t('Successfully retrieved your account. Please activate your license.'));
    }
    else {
      drupal_set_message(t('Invalid credentials'), 'error');
    }
  }
}

/**
 * Handle back button submit for customer setup.
 */
function miniorange_saml_idp_back(&$form, $form_state) {
  $current_status = 'MOIDP_CUSTOMER_SETUP';
  variable_set('miniorange_saml_idp_status', $current_status);
  variable_del('miniorange_saml_idp_customer_admin_email');
  variable_del('miniorange_saml_idp_customer_admin_phone');
  variable_del('miniorange_saml_idp_tx_id');
  drupal_set_message(t('Register/Login with your miniOrange Account'));
}
