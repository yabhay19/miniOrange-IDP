<?php


include_once "\x55\164\151\154\151\164\x69\145\163\56\160\x68\x70";
class SAML2_LogoutRequest
{
    private $tagName;
    private $id;
    private $issuer;
    private $destination;
    private $issueInstant;
    private $certificates;
    private $validators;
    private $notOnOrAfter;
    private $encryptedNameId;
    private $nameId;
    private $sessionIndexes;
    public function __construct(DOMElement $vM = NULL)
    {
        $this->tagName = "\114\157\x67\x6f\165\x74\x52\x65\161\165\145\163\164";
        $this->id = Utilities::generateID();
        $this->issueInstant = time();
        $this->certificates = array();
        $this->validators = array();
        if (!($vM === NULL)) {
            goto dk;
        }
        return;
        dk:
        if ($vM->hasAttribute("\x49\104")) {
            goto Ee;
        }
        throw new Exception("\x4d\x69\x73\x73\151\156\x67\40\x49\x44\x20\141\x74\164\162\151\x62\165\164\145\40\157\156\x20\123\101\x4d\114\40\x6d\x65\163\163\141\147\x65\x2e");
        Ee:
        $this->id = $vM->getAttribute("\111\104");
        if (!($vM->getAttribute("\126\145\162\x73\151\157\156") !== "\62\56\x30")) {
            goto hx;
        }
        throw new Exception("\125\x6e\163\165\160\x70\x6f\162\164\x65\x64\40\166\x65\162\163\151\x6f\x6e\x3a\x20" . $vM->getAttribute("\126\x65\162\x73\151\157\x6e"));
        hx:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($vM->getAttribute("\111\x73\x73\x75\x65\111\x6e\x73\x74\x61\156\x74"));
        if (!$vM->hasAttribute("\x44\145\163\x74\151\x6e\x61\164\x69\157\156")) {
            goto rR;
        }
        $this->destination = $vM->getAttribute("\x44\x65\163\x74\151\x6e\141\164\151\157\156");
        rR:
        $SB = Utilities::xpQuery($vM, "\56\57\163\x61\x6d\154\x5f\141\x73\163\145\x72\x74\151\x6f\x6e\x3a\111\x73\163\165\x65\x72");
        if (empty($SB)) {
            goto K5;
        }
        $this->issuer = trim($SB[0]->textContent);
        K5:
        try {
            $M3 = Utilities::validateElement($vM);
            if (!($M3 !== FALSE)) {
                goto bK;
            }
            $this->certificates = $M3["\x43\x65\x72\164\151\x66\151\x63\141\x74\145\163"];
            $this->validators[] = array("\106\x75\156\143\x74\x69\x6f\x6e" => array("\x55\164\x69\154\x69\x74\151\x65\x73", "\166\x61\x6c\151\144\x61\164\145\123\x69\147\156\x61\164\x75\162\145"), "\104\x61\164\x61" => $M3);
            bK:
        } catch (Exception $bx) {
        }
        $this->sessionIndexes = array();
        if (!$vM->hasAttribute("\x4e\157\x74\117\156\x4f\x72\101\x66\164\x65\x72")) {
            goto WO;
        }
        $this->notOnOrAfter = Utilities::xsDateTimeToTimestamp($vM->getAttribute("\116\157\x74\117\x6e\x4f\x72\101\x66\164\145\x72"));
        WO:
        $ZU = Utilities::xpQuery($vM, "\56\x2f\x73\x61\155\x6c\x5f\x61\163\163\145\162\164\x69\x6f\156\x3a\x4e\141\155\145\111\104\40\174\x20\x2e\57\x73\x61\155\154\137\x61\163\x73\x65\x72\x74\151\157\x6e\72\x45\x6e\143\x72\x79\160\x74\145\x64\111\x44\x2f\x78\x65\x6e\x63\72\105\x6e\x63\162\171\x70\x74\x65\x64\104\141\x74\141");
        if (empty($ZU)) {
            goto rA;
        }
        if (count($ZU) > 1) {
            goto MN;
        }
        goto PY;
        rA:
        throw new Exception("\x4d\151\x73\x73\151\x6e\x67\x20\74\163\141\x6d\154\72\x4e\x61\x6d\145\111\104\76\40\157\x72\x20\74\163\x61\155\x6c\72\x45\156\143\x72\x79\160\164\x65\x64\x49\x44\76\x20\x69\x6e\x20\74\163\x61\155\x6c\x70\x3a\x4c\x6f\147\x6f\165\x74\122\x65\x71\165\x65\163\x74\76\x2e");
        goto PY;
        MN:
        throw new Exception("\115\157\x72\x65\x20\x74\x68\141\156\40\157\156\145\40\74\163\141\155\154\x3a\116\x61\155\145\111\x44\76\x20\157\162\40\74\x73\x61\155\154\72\105\x6e\x63\162\171\x70\x74\145\x64\x44\x3e\x20\151\156\x20\x3c\x73\x61\x6d\154\x70\x3a\x4c\157\x67\157\x75\x74\x52\145\x71\165\x65\x73\164\76\x2e");
        PY:
        $ZU = $ZU[0];
        if ($ZU->localName === "\x45\x6e\143\x72\171\160\x74\145\144\104\x61\x74\141") {
            goto mp;
        }
        $this->nameId = Utilities::parseNameId($ZU);
        goto Fr;
        mp:
        $this->encryptedNameId = $ZU;
        Fr:
        $Se = Utilities::xpQuery($vM, "\56\x2f\163\x61\155\x6c\137\160\162\157\x74\x6f\143\157\154\x3a\x53\x65\x73\163\151\x6f\x6e\111\x6e\144\145\170");
        foreach ($Se as $Rp) {
            $this->sessionIndexes[] = trim($Rp->textContent);
            ch:
        }
        s6:
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($MT)
    {
        $this->notOnOrAfter = $MT;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto QO;
        }
        return TRUE;
        QO:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $Nv)
    {
        $aQ = new DOMDocument();
        $Sw = $aQ->createElement("\x72\x6f\x6f\164");
        $aQ->appendChild($Sw);
        SAML2_Utils::addNameId($Sw, $this->nameId);
        $ZU = $Sw->firstChild;
        SAML2_Utils::getContainer()->debugMessage($ZU, "\145\156\x63\x72\171\160\164");
        $f9 = new XMLSecEnc();
        $f9->setNode($ZU);
        $f9->type = XMLSecEnc::Element;
        $Lp = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $Lp->generateSessionKey();
        $f9->encryptKey($Nv, $Lp);
        $this->encryptedNameId = $f9->encryptNode($Lp);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $Nv, array $g6 = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto sK;
        }
        return;
        sK:
        $ZU = SAML2_Utils::decryptElement($this->encryptedNameId, $Nv, $g6);
        SAML2_Utils::getContainer()->debugMessage($ZU, "\144\x65\x63\162\x79\x70\164");
        $this->nameId = SAML2_Utils::parseNameId($ZU);
        $this->encryptedNameId = NULL;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto kx;
        }
        throw new Exception("\101\164\x74\x65\155\160\164\x65\144\x20\x74\157\40\x72\145\x74\162\x69\x65\x76\145\40\145\156\x63\x72\171\160\164\x65\x64\x20\116\x61\x6d\x65\x49\104\x20\167\151\164\150\157\165\164\x20\x64\145\143\162\x79\160\164\x69\x6e\x67\x20\151\x74\40\x66\x69\x72\163\164\56");
        kx:
        return $this->nameId;
    }
    public function setNameId($ZU)
    {
        $this->nameId = $ZU;
    }
    public function getSessionIndexes()
    {
        return $this->sessionIndexes;
    }
    public function setSessionIndexes(array $Se)
    {
        $this->sessionIndexes = $Se;
    }
    public function getSessionIndex()
    {
        if (!empty($this->sessionIndexes)) {
            goto zM;
        }
        return NULL;
        zM:
        return $this->sessionIndexes[0];
    }
    public function setSessionIndex($Rp)
    {
        if (is_null($Rp)) {
            goto T9;
        }
        $this->sessionIndexes = array($Rp);
        goto Ch;
        T9:
        $this->sessionIndexes = array();
        Ch:
    }
    public function toUnsignedXML()
    {
        $Sw = parent::toUnsignedXML();
        if (!($this->notOnOrAfter !== NULL)) {
            goto Zv;
        }
        $Sw->setAttribute("\116\x6f\x74\x4f\x6e\117\162\101\x66\x74\x65\162", gmdate("\131\x2d\x6d\55\144\134\x54\x48\72\151\72\163\x5c\132", $this->notOnOrAfter));
        Zv:
        if ($this->encryptedNameId === NULL) {
            goto CX;
        }
        $x1 = $Sw->ownerDocument->createElementNS(SAML2_Const::NS_SAML, "\163\x61\x6d\154\72" . "\x45\x6e\143\x72\171\x70\164\145\x64\111\x44");
        $Sw->appendChild($x1);
        $x1->appendChild($Sw->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto TE;
        CX:
        SAML2_Utils::addNameId($Sw, $this->nameId);
        TE:
        foreach ($this->sessionIndexes as $Rp) {
            SAML2_Utils::addString($Sw, SAML2_Const::NS_SAMLP, "\123\x65\x73\163\x69\x6f\x6e\x49\156\144\145\x78", $Rp);
            pV:
        }
        v8:
        return $Sw;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($o0)
    {
        $this->id = $o0;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($Xl)
    {
        $this->issueInstant = $Xl;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function setDestination($I4)
    {
        $this->destination = $I4;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($SB)
    {
        $this->issuer = $SB;
    }
}
