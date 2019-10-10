<?php


include "\x41\163\x73\x65\162\x74\151\x6f\x6e\56\160\150\160";
class SAML2_Response
{
    private $assertions;
    private $destination;
    public function __construct(DOMElement $vM = NULL)
    {
        $this->assertions = array();
        if (!($vM === NULL)) {
            goto oU;
        }
        return;
        oU:
        if (!$vM->hasAttribute("\x44\x65\163\x74\x69\x6e\141\164\x69\x6f\156")) {
            goto la;
        }
        $this->destination = $vM->getAttribute("\x44\x65\x73\164\x69\x6e\x61\x74\x69\157\156");
        la:
        $B9 = $vM->firstChild;
        ja:
        if (!($B9 !== NULL)) {
            goto ZT;
        }
        if (!($B9->namespaceURI !== "\x75\x72\x6e\x3a\157\141\163\x69\163\x3a\156\141\x6d\x65\x73\x3a\x74\x63\72\x53\101\115\114\72\x32\x2e\60\72\x61\x73\x73\145\162\164\151\157\x6e")) {
            goto R0;
        }
        goto E8;
        R0:
        if (!($B9->localName === "\101\x73\163\145\162\x74\151\157\156" || $B9->localName === "\105\156\x63\x72\171\160\164\x65\144\101\163\163\145\162\164\x69\x6f\156")) {
            goto PD;
        }
        $this->assertions[] = new SAML2_Assertion($B9);
        PD:
        E8:
        $B9 = $B9->nextSibling;
        goto ja;
        ZT:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $Sf)
    {
        $this->assertions = $Sf;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function toUnsignedXML()
    {
        $Sw = parent::toUnsignedXML();
        foreach ($this->assertions as $NV) {
            $NV->toXML($Sw);
            oR1:
        }
        d4:
        return $Sw;
    }
}
