<?php


include "\101\x73\x73\145\x72\164\151\x6f\156\x2e\160\x68\160";
class SAML2_Response
{
    private $assertions;
    private $destination;
    public function __construct(DOMElement $Kz = NULL)
    {
        $this->assertions = array();
        if (!($Kz === NULL)) {
            goto YA;
        }
        return;
        YA:
        if (!$Kz->hasAttribute("\x44\x65\163\x74\151\x6e\x61\164\x69\x6f\156")) {
            goto V0;
        }
        $this->destination = $Kz->getAttribute("\x44\x65\x73\164\x69\156\141\164\x69\157\156");
        V0:
        $Dw = $Kz->firstChild;
        Xv:
        if (!($Dw !== NULL)) {
            goto EE;
        }
        if (!($Dw->namespaceURI !== "\165\x72\x6e\x3a\157\141\163\151\x73\72\156\x61\155\x65\163\x3a\x74\143\x3a\123\x41\x4d\114\72\x32\56\60\72\x61\x73\x73\x65\x72\164\151\157\156")) {
            goto Wk;
        }
        goto Mt;
        Wk:
        if (!($Dw->localName === "\x41\163\163\x65\162\164\151\157\156" || $Dw->localName === "\x45\156\143\x72\171\x70\x74\145\144\101\x73\x73\145\162\164\151\x6f\x6e")) {
            goto pu;
        }
        $this->assertions[] = new SAML2_Assertion($Dw);
        pu:
        Mt:
        $Dw = $Dw->nextSibling;
        goto Xv;
        EE:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $yD)
    {
        $this->assertions = $yD;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $Si = parent::toUnsignedXML();
        foreach ($this->assertions as $KE) {
            $KE->toXML($Si);
            DS:
        }
        Or1:
        return $Si;
    }
}
