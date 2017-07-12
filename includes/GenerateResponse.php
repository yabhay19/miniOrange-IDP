<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  system.joomlaidplogin
 *
 * @copyright   Copyright 2015 miniOrange. All Rights Reserved.
 * @license     http://miniorange.com/usecases/miniOrange_User_Agreement.pdf
 */
	class GenerateResponse{
		
		private $xml;
		private $acsUrl;
		private $issuer;
		private $audience;
		private $username;
		private $email;
		private $name_id_attr;
		private $name_id_attr_format;
		private $mo_idp_response_signed;
		private $mo_idp_assertion_signed;
		private $mo_idp_encrypted_assertion;
		private $mo_idp_cert_encrypt;
		private $encryptionKey;
		private $attributes;
		private $inResponseTo;
		private $subject;
		
		function __construct($email,$username, $acs_url, $issuer, $audience, $name_id_attr=null, 
			$mo_idp_response_signed=null, $mo_idp_assertion_signed=null, $mo_idp_encrypted_assertion=null, $mo_idp_cert_encrypt=null, $attributes = array(), $name_id_attr_format = '', $inResponseTo=null){
			
			$this->xml = new DOMDocument("1.0", "utf-8");
			$this->acsUrl = $acs_url;		
			$this->issuer = $issuer;		
			$this->audience = $audience;
			$this->email = $email;
			$this->username = $username;
			$this->name_id_attr = $name_id_attr;
			$this->name_id_attr_format = $name_id_attr_format;
			$this->mo_idp_response_signed = $mo_idp_response_signed;
			$this->mo_idp_assertion_signed = $mo_idp_assertion_signed;
			$this->mo_idp_encrypted_assertion = $mo_idp_encrypted_assertion;
			$this->mo_idp_cert_encrypt = $mo_idp_cert_encrypt;
			$this->attributes = $attributes;
			$this->inResponseTo = $inResponseTo;
			
		}
		
		function createSamlResponse(){
			
			$response_params = $this->getResponseParams();

			//Create Response Element
			$resp = $this->createResponseElement($response_params);
			$this->xml->appendChild($resp);
			
			//Build Issuer
			$issuer = $this->buildIssuer();
			$resp->appendChild($issuer);
			
			//Build Status
			$status = $this->buildStatus();
			$resp->appendChild($status);
			
			//Build Status Code
			$statusCode = $this->buildStatusCode();
			$status->appendChild($statusCode);
			
			//Build Assertion
			$assertion = $this->buildAssertion($response_params);
			$resp->appendChild($assertion);
			
			
			//Sign Assertion
			if($this->mo_idp_assertion_signed){
				$private_key = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'idp-signing.key';
				$this->signNode($private_key, $assertion, $this->subject,$response_params);
			}

			//Encrypt Assertion
			if($this->mo_idp_encrypted_assertion){ 
				$encryptedAssertion = $this->buildEncryptedAssertion($assertion);
				$resp->removeChild($assertion);
				$resp->appendChild($encryptedAssertion);
				
			}
			
			//Sign Response
			if($this->mo_idp_response_signed){
				$private_key = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'idp-signing.key';
				$this->signNode($private_key, $resp, $status,$response_params);
			}

			$samlResponse = $this->xml->saveXML();

			return $samlResponse;								
			
		}
		
		/**
	     * Return the key we should use to encrypt the assertion.
	     *
	     * @return XMLSecurityKey|NULL The key, or NULL if no key is specified..
	     *
	     */
	    public function getEncryptionKey()
	    {
	        return $this->encryptionKey;
	    }
		
		/**
	     * Set the private key we should use to encrypt the attributes.
	     *
	     * @param XMLSecurityKey|NULL $Key
	    */
	    public function setEncryptionKey(XMLSecurityKey $Key = NULL)
	    {
	        $this->encryptionKey = $Key;
	    }
		
		function getResponseParams(){
			$response_params = array();
			$time = time();
			$response_params['IssueInstant'] = str_replace('+00:00','Z',gmdate("c",$time));
			$response_params['NotOnOrAfter'] = str_replace('+00:00','Z',gmdate("c",$time+300));
			$response_params['NotBefore'] = str_replace('+00:00','Z',gmdate("c",$time-30));
			$response_params['AuthnInstant'] = str_replace('+00:00','Z',gmdate("c",$time-120));
			$response_params['SessionNotOnOrAfter'] = str_replace('+00:00','Z',gmdate("c",$time+3600*8));
			$response_params['ID'] = $this->generateUniqueID(40);
			$response_params['AssertID'] = $this->generateUniqueID(40);
			$response_params['Issuer'] = $this->issuer;
			$public_key = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'idp-signing.crt';
			$objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256,array( 'type' => 'public'));
			$objKey->loadKey($public_key, TRUE,TRUE);
			$response_params['x509'] = $objKey->getX509Certificate();
			$response_params['Attributes'] = $this->attributes;
			return $response_params;
		}
		
		function createResponseElement($response_params){
			$resp = $this->xml->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol','samlp:Response');
			$resp->setAttribute('ID',$response_params['ID']);
			$resp->setAttribute('Version','2.0');
			$resp->setAttribute('IssueInstant',$response_params['IssueInstant']);
			$resp->setAttribute('Destination',$this->acsUrl);
			if(isset($this->inResponseTo) && !is_null($this->inResponseTo)){
				$resp->setAttribute('InResponseTo',$this->inResponseTo);
			}
			
			return $resp;
		}
		
		function buildIssuer(){
			$issuer = $this->xml->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion','saml:Issuer',$this->issuer);
			return $issuer;
		}
		
		function buildStatus(){
			$status = $this->xml->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol','samlp:Status');
			return $status;
		}
		
		function buildStatusCode(){
			$statusCode = $this->xml->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol','samlp:StatusCode');
			$statusCode->setAttribute('Value', 'urn:oasis:names:tc:SAML:2.0:status:Success');
			return $statusCode;
		}
		
		function buildAssertion($response_params){
			$assertion = $this->xml->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion','saml:Assertion');
			$assertion->setAttribute('ID',$response_params['AssertID']);
			$assertion->setAttribute('IssueInstant',$response_params['IssueInstant']);
			$assertion->setAttribute('Version','2.0');
			
			//Build Issuer
			$issuer = $this->buildIssuer($response_params);
			$assertion->appendChild($issuer);

			//Build Subject
			$subject = $this->buildSubject($response_params);
			$this->subject = $subject;
			$assertion->appendChild($subject);
			
			//Build Condition
			$condition = $this->buildCondition($response_params);
			$assertion->appendChild($condition);
			
			//Build AuthnStatement
			$authnstat = $this->buildAuthnStatement($response_params);
			$assertion->appendChild($authnstat);
			
			//Build AttributeStatements
			$attributes = $response_params['Attributes'];
		    if(!empty($attributes)) {
				$attrStatement = $this->buildAttrStatement($response_params);
				$assertion->appendChild($attrStatement);
		    }

			return $assertion;
		}
		
		function buildSubject($response_params){
			$subject = $this->xml->createElement('saml:Subject');
			$nameid = $this->buildNameIdentifier();
			$subject->appendChild($nameid);
			$confirmation = $this->buildSubjectConfirmation($response_params);
			$subject->appendChild($confirmation);
			return $subject;
		}
		
		function buildNameIdentifier(){
			
			if($this->name_id_attr==="emailAddress")
				$nameid = $this->xml->createElement('saml:NameID',$this->email);
			else
				$nameid = $this->xml->createElement('saml:NameID',$this->username);
			if(empty($this->name_id_attr_format)) {
				$nameid->setAttribute('Format','urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress');
			} else {
				$nameid->setAttribute('Format','urn:oasis:names:tc:SAML:'.$this->name_id_attr_format);
			}
			$nameid->setAttribute('SPNameQualifier',$this->audience);
			return $nameid;
		}
		
		function buildSubjectConfirmation($response_params){
			$confirmation = $this->xml->createElement('saml:SubjectConfirmation');
			$confirmation->setAttribute('Method','urn:oasis:names:tc:SAML:2.0:cm:bearer');
			$confirmationdata = $this->getSubjectConfirmationData($response_params);
			$confirmation->appendChild($confirmationdata);
			return $confirmation;
		}
		
		function getSubjectConfirmationData($response_params){
			$confirmationdata = $this->xml->createElement('saml:SubjectConfirmationData');
			$confirmationdata->setAttribute('NotOnOrAfter',$response_params['NotOnOrAfter']);
			$confirmationdata->setAttribute('Recipient',$this->acsUrl);
			if(isset($this->inResponseTo) && !is_null($this->inResponseTo)){
				$confirmationdata->setAttribute('InResponseTo',$this->inResponseTo);
			}
			return $confirmationdata;
		}
		
		function buildCondition($response_params){
			$condition = $this->xml->createElement('saml:Conditions');
			$condition->setAttribute('NotBefore',$response_params['NotBefore']);
			$condition->setAttribute('NotOnOrAfter',$response_params['NotOnOrAfter']);
			
			//Build AudienceRestriction
			$audiencer = $this->buildAudienceRestriction();
			$condition->appendChild($audiencer);
			
			return $condition;
		}
		
		function buildAudienceRestriction(){
			$audiencer = $this->xml->createElement('saml:AudienceRestriction');
			$audience = $this->xml->createElement('saml:Audience',$this->audience);
			$audiencer->appendChild($audience);
			return $audiencer;
		}
		
		function buildAuthnStatement($response_params){
			$authnstat = $this->xml->createElement('saml:AuthnStatement');
			$authnstat->setAttribute('AuthnInstant',$response_params['AuthnInstant']);
			$authnstat->setAttribute('SessionIndex','_'.$this->generateUniqueID(30));
			$authnstat->setAttribute('SessionNotOnOrAfter',$response_params['SessionNotOnOrAfter']);
			
			$authncontext = $this->xml->createElement('saml:AuthnContext');
			$authncontext_ref = $this->xml->createElement('saml:AuthnContextClassRef','urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport');
			$authncontext->appendChild($authncontext_ref);
			$authnstat->appendChild($authncontext);
			
			return $authnstat;
		}
		
		function buildAttrStatement($response_params){
			$attrStatement = $this->xml->createElement('saml:AttributeStatement');
			$my_sp_attr = $response_params['Attributes'];
			foreach ($my_sp_attr as $attr => $value) {
				$attrs = $this->buildAttribute($attr,$value);
				$attrStatement->appendChild($attrs);
			}
			return $attrStatement;
		}
		
		function buildAttribute($attrName, $attrValue){
			$attrs = $this->xml->createElement('saml:Attribute');
		   
			$attrs->setAttribute('Name',$attrName);  
			$attrs->setAttribute('NameFormat','urn:oasis:names:tc:SAML:2.0:attrname-format:basic');
		   
			if(is_array($attrValue)){
				foreach ($attrValue as $key => $val) {
				    $attrsValueElement = $this->xml->createElement('saml:AttributeValue',$val);
				    $attrs->appendChild($attrsValueElement);
				}
			}else{
				$attrsValueElement = $this->xml->createElement('saml:AttributeValue',$attrValue);
				$attrs->appendChild($attrsValueElement);
			}
			return $attrs;
	   }
		
		function buildEncryptedAssertion($assertion) {
			$encryptedAssertion = $this->xml->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion','samlp:EncryptedAssertion');	

			//Build Encrypted Data
			$encryptedData = $this->buildEncryptedData($assertion);
			$encryptedAssertion->appendChild($encryptedAssertion->ownerDocument->importNode($encryptedData, TRUE));

			return $encryptedAssertion;
		}
		
		function buildEncryptedData($assertion) {
			$encryptedData = new XMLSecEnc();
			$encryptedData->setNode($assertion);
			$encryptedData->type = 'http://www.w3.org/2001/04/xmlenc#Element';

			$spEncryptCert = $this->mo_idp_cert_encrypt;
			
			$encryptKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256,array( 'type' => 'public'));
			$encryptKey->loadKey($spEncryptCert,FALSE, TRUE);
			$this->setEncryptionKey($encryptKey);

			$symmetricKey = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $symmetricKey->generateSessionKey();
            $encryptedData->encryptKey($this->encryptionKey, $symmetricKey);
            $EncrNode = $encryptedData->encryptNode($symmetricKey, FALSE);

            return $EncrNode;
		}
		
		function signNode($private_key, $node, $subject,$response_params){
			//Private KEY	
			$objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256,array( 'type' => 'private'));
			$objKey->loadKey($private_key, TRUE);
						
			//Sign the Assertion
			$objXMLSecDSig = new XMLSecurityDSig();
			$objXMLSecDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

			$objXMLSecDSig->addReferenceList(array($node), XMLSecurityDSig::SHA256,
				array('http://www.w3.org/2000/09/xmldsig#enveloped-signature', XMLSecurityDSig::EXC_C14N),array('id_name'=>'ID','overwrite'=>false));
			$objXMLSecDSig->sign($objKey);
			$objXMLSecDSig->add509Cert($response_params['x509']);
			$objXMLSecDSig->insertSignature($node,$subject);
		}
		
		function generateUniqueID($length) {
			$chars = "abcdef0123456789";
			$chars_len = strlen($chars);
			$uniqueID = "";
			for ($i = 0; $i < $length; $i++)
				$uniqueID .= substr($chars,rand(0,15),1);
			return 'a'.$uniqueID;
		}
		
	}