<?php
/**
 * @package     Joomla.Plugins
 * @subpackage  system.joomlaidplogin
 *
 * @copyright   Copyright 2015 miniOrange. All Rights Reserved.
 * @license     http://miniorange.com/usecases/miniOrange_User_Agreement.pdf
 */

include 'Assertion.php';

/**
 * Class for SAML2 Response messages.
 *
 */
class SAML2_Response
{
    /**
     * The assertions in this response.
     */
    private $assertions;
	
	/**
     * The destination URL in this response.
     */
	private $destination;

    /**
     * Constructor for SAML 2 response messages.
     *
     * @param DOMElement|NULL $xml The input message.
     */
    public function __construct(DOMElement $xml = NULL)
    {

        $this->assertions = array();

        if ($xml === NULL) {
            return;
        }
		
		/* set the destination from saml response */
		if ($xml->hasAttribute('Destination')) {
            $this->destination = $xml->getAttribute('Destination');
        }
		
		for ($node = $xml->firstChild; $node !== NULL; $node = $node->nextSibling) {
			if ($node->namespaceURI !== 'urn:oasis:names:tc:SAML:2.0:assertion') {
				continue;
			}
			
			if ($node->localName === 'Assertion' || $node->localName === 'EncryptedAssertion') {
				$this->assertions[] = new SAML2_Assertion($node);
			}
			
		}
    }

    /**
     * Retrieve the assertions in this response.
     *
     * @return SAML2_Assertion[]|SAML2_EncryptedAssertion[]
     */
    public function getAssertions()
    {	
        return $this->assertions;
    }

    /**
     * Set the assertions that should be included in this response.
     *
     * @param SAML2_Assertion[]|SAML2_EncryptedAssertion[] The assertions.
     */
    public function setAssertions(array $assertions)
    {
        $this->assertions = $assertions;
    }
	
	public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Convert the response message to an XML element.
     *
     * @return DOMElement This response.
     */
    public function toUnsignedXML()
    {
        $root = parent::toUnsignedXML();

        /** @var SAML2_Assertion|SAML2_EncryptedAssertion $assertion */
        foreach ($this->assertions as $assertion) {

            $assertion->toXML($root);
        }

        return $root;
    }

}
