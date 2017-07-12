<?php
define('DRUPAL_ROOT', dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))));

require_once DRUPAL_ROOT . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
  
global $base_url;	
$site_url = substr($base_url, 0, strpos($base_url, 'sites'));   

$entity_id = $site_url . '?q=admin/config/people/miniorange_saml_idp/';
$login_url = $site_url . '?q=initiatelogon';
$logout_url = $site_url;
$certificate = file_get_contents( DRUPAL_ROOT . DIRECTORY_SEPARATOR . 'sites' . DIRECTORY_SEPARATOR . 'all' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'miniorange_saml_idp' . DIRECTORY_SEPARATOR .  'resources' . DIRECTORY_SEPARATOR . 'idp-signing.crt' );

$certificate = preg_replace("/[\r\n]+/", "", $certificate);
$certificate = str_replace( "-----BEGIN CERTIFICATE-----", "", $certificate );
$certificate = str_replace( "-----END CERTIFICATE-----", "", $certificate );
$certificate = str_replace( " ", "", $certificate );


header('Content-Type: text/xml');
echo'<?xml version="1.0" encoding="UTF-8"?><md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata" entityID="'.$entity_id.'"><md:IDPSSODescriptor WantAuthnRequestsSigned="false" protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol"><md:KeyDescriptor 
			use="signing">
			<ds:KeyInfo 
				xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
				<ds:X509Data>
					<ds:X509Certificate>'.$certificate.'</ds:X509Certificate>
				</ds:X509Data>
			</ds:KeyInfo>
		</md:KeyDescriptor>

		<md:NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress</md:NameIDFormat>
		<md:NameIDFormat>urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified</md:NameIDFormat>
		<md:SingleSignOnService 
			Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" 
			Location="'.$login_url.'"/>
		<md:SingleSignOnService 
			Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect" 
			Location="'.$login_url.'"/>
	</md:IDPSSODescriptor>
</md:EntityDescriptor>';