<?php
/**
 * @file
 * Contains Licensing information for miniOrange SAML IDP Module.
 */

 /**
 * Showing Licensing form info.
 */
 function miniorange_saml_idp_licensing() {

 

  $dyi_plan = "'drupal_saml_idp_basic_plan'";
  $premium_plan = "'drupal_saml_idp_premium_plan'";
  $admin_username = "'" . variable_get('miniorange_saml_idp_customer_admin_email', '') . "'";
  $host_name = MiniorangeSAMLIdpConstants::BASE_URL;
  $host_name = "'" . $host_name . "'";

  $form['markup_1'] = array(
    '#markup' => '<div class="mo_saml_table_layout">'
    . '<table class="mo_saml_local_pricing_table">'
    . '<h2>Licensing Plans</h2><hr>'
    . '<tr style="vertical-align:top;">',
  );

  $form['markup_2'] = array(
    '#markup' => '<td style="vertical-align:top;width:22%;padding:8px 4px;">'
	. '<div class="mo_saml_local_thumbnail mo_saml_local_pricing_free_tab" >'
    . '<h3 class="mo_saml_local_pricing_header">Free</h3><p class="mo_saml_local_pricing_text" style="padding-bottom:8px;">'
	. '( You are automatically on this plan. )</p>'
    . '<hr>'
    . '<p class="mo_saml_local_pricing_text" style="padding:10px;">$0 - One Time Payment<br /><br /></p><hr>'
    . '<p class="mo_saml_local_pricing_text">'
    . 'Unlimited Authentications via 1 SP<br>SP Inittiated Login</p><p></<p><br /><br /><br /><br /><br /><br /><br /><br /><hr>'
	. '<p class="mo_saml_local_pricing_text" >Basic Support by Email</p></div></td>',
  );
  
  $form['markup_4'] = array(
    '#markup' => '<td style="vertical-align:top;width:26%;padding:8px 4px;">'
	. '<div class="mo_saml_local_thumbnail mo_saml_local_pricing_paid_tab" >'
    . '<h3 class="mo_saml_local_pricing_header">Do it yourself</h3><p></p>'
    . '<h4 class="mo_saml_local_pricing_sub_header" style="padding-bottom:8px !important;">'
    . '<a class="btn btn-primary btn-large" style="padding:5px;" onclick="payment(' . $dyi_plan .', ' 
    . $admin_username .', '. $host_name .');">Click to Upgrade</a>*</h4><hr>'
    . '<p class="mo_saml_local_pricing_text" style="padding:10px;">$449 - One Time Payment<br /><br /></p><hr>'
    . '<p class="mo_saml_local_pricing_text">'
    . 'Unlimited Authentications via Multiple SPs are Supported<br>SP Initiated Login<br>IDP Initiated Login<br>'
    . 'Customized Role Mapping<br>Customized Attribute Mapping<br>Signed Assertion<br>Signed Response<br>'
    . 'Encrypted Assertion<br>HTTP-POST Binding<br>Metadata XML File<br><br/></p><hr>'
    . '<p class="mo_saml_local_pricing_text" >Basic Support by Email</p></div></td>',
  );

  $form['markup_3'] = array(
    '#markup' => '<td style="vertical-align:top;width:26%;padding:8px 4px;">'
	. '<div class="mo_saml_local_thumbnail mo_saml_local_pricing_free_tab" >'
    . '<h3 class="mo_saml_local_pricing_header">Premium</h3><p></p>'
    . '<h4 class="mo_saml_local_pricing_sub_header" style="padding-bottom:8px !important;">'
    . '<a class="btn btn-primary btn-large" style="padding:5px;" onclick="payment(' . $premium_plan .', ' 
    . $admin_username .', '. $host_name .');">Click to upgrade</a>*</h4><hr>'
    . '<p class="mo_saml_local_pricing_text" style="padding:10px;">$449 - One Time Payment<br />($45 per hour)</p><hr>'
    . '<p class="mo_saml_local_pricing_text">'
    . 'Unlimited Authentications via Multiple SPs are supported.<br>SP Initiated Login<br>IDP Initiated Login<br>'
    . 'Customized Role Mapping<br>Customized Attribute Mapping<br>Signed Assertion<br>Signed Response<br>'
    . 'Encrypted Assertion<br>HTTP-POST Binding<br>Metadata XML File<br>End to End Configuration **<br/></p><hr>'
	. '<p class="mo_saml_local_pricing_text">Premium Support Plans Available</p>'
    . '</div></td></tr></table>'
  );

  $form['markup_5'] = array(
    '#markup' => '<h3>Steps to Upgrade to Premium Module</h3>'
    . '<ol><li>You will be redirected to miniOrange Login Console. Enter your password with which you created an'
    . ' account with us. After that you will be redirected to payment page.</li>'
    . '<li>Enter you card details and complete the payment. On successful payment completion, you will see the '
    . 'link to download the premium module.</li>'
    . 'Once you download the premium module, just unzip it and replace the folder with existing module. Clear Drupal Cache.</li></ol>'
  );

  $form['markup_6'] = array(
    '#markup' => '<h3>** End to End Identity Provider Integration</h3>'
    . ' We will setup a Conference Call / Gotomeeting and do end to end configuration for you to setup dupal as IDP.'
    . ' We provide services to do the configuration on your behalf.<br /><br />'
	. ' If you have any doubts regarding the licensing plans, you can mail us at'
	. ' <a href="mailto:info@miniorange.com"><i>info@miniorange.com</i></a> or submit a query' 
	. ' using the support form on right.', 
  );

  return $form;

 }