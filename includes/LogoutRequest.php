<?php


include_once "\x55\x74\151\154\151\x74\x69\x65\x73\56\x70\150\x70";
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
    public function __construct(DOMElement $Kz = NULL)
    {
        $this->tagName = "\114\157\147\157\x75\164\122\x65\161\x75\145\x73\164";
        $this->id = Utilities::generateID();
        $this->issueInstant = time();
        $this->certificates = array();
        $this->validators = array();
        if (!($Kz === NULL)) {
            goto cU;
        }
        return;
        cU:
        if ($Kz->hasAttribute("\x49\x44")) {
            goto lq;
        }
        throw new Exception("\x4d\151\x73\x73\151\x6e\x67\40\111\104\40\x61\x74\x74\x72\151\142\x75\x74\145\x20\x6f\x6e\40\123\101\115\x4c\40\155\145\x73\x73\141\x67\145\x2e");
        lq:
        $this->id = $Kz->getAttribute("\x49\x44");
        if (!($Kz->getAttribute("\x56\x65\x72\x73\151\157\x6e") !== "\x32\56\x30")) {
            goto Qf;
        }
        throw new Exception("\125\156\163\165\160\x70\157\x72\164\x65\144\x20\x76\145\162\163\x69\157\156\72\x20" . $Kz->getAttribute("\x56\145\162\163\x69\x6f\156"));
        Qf:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($Kz->getAttribute("\x49\x73\163\165\145\x49\156\163\x74\141\x6e\164"));
        if (!$Kz->hasAttribute("\104\145\x73\x74\x69\156\x61\164\151\x6f\x6e")) {
            goto wG;
        }
        $this->destination = $Kz->getAttribute("\x44\145\163\x74\151\x6e\x61\x74\151\157\156");
        wG:
        $Qn = Utilities::xpQuery($Kz, "\56\57\163\141\155\x6c\137\x61\x73\x73\x65\162\164\151\157\156\72\x49\x73\163\x75\x65\162");
        if (empty($Qn)) {
            goto Od;
        }
        $this->issuer = trim($Qn[0]->textContent);
        Od:
        try {
            $B9 = Utilities::validateElement($Kz);
            if (!($B9 !== FALSE)) {
                goto GD;
            }
            $this->certificates = $B9["\x43\x65\162\x74\x69\146\151\143\x61\x74\145\x73"];
            $this->validators[] = array("\106\165\156\143\164\x69\x6f\x6e" => array("\x55\164\151\x6c\151\164\151\x65\163", "\166\x61\x6c\151\144\141\164\145\123\x69\147\156\x61\x74\165\x72\145"), "\x44\x61\x74\x61" => $B9);
            GD:
        } catch (Exception $e9) {
        }
        $this->sessionIndexes = array();
        if (!$Kz->hasAttribute("\116\x6f\164\117\x6e\x4f\x72\101\146\x74\145\x72")) {
            goto GX;
        }
        $this->notOnOrAfter = Utilities::xsDateTimeToTimestamp($Kz->getAttribute("\116\x6f\164\x4f\156\x4f\162\x41\x66\164\145\162"));
        GX:
        $fW = Utilities::xpQuery($Kz, "\x2e\57\163\141\x6d\x6c\137\x61\x73\163\x65\162\x74\151\x6f\156\72\116\x61\x6d\145\111\104\x20\x7c\40\56\57\163\141\x6d\154\x5f\x61\163\x73\145\162\x74\151\157\x6e\72\105\156\143\162\171\160\x74\x65\144\x49\104\57\170\x65\x6e\x63\x3a\105\156\143\x72\171\x70\x74\x65\144\x44\141\164\141");
        if (empty($fW)) {
            goto HS;
        }
        if (count($fW) > 1) {
            goto Fn;
        }
        goto fK;
        HS:
        throw new Exception("\x4d\151\163\x73\151\156\x67\x20\74\x73\141\x6d\x6c\72\116\141\155\x65\111\104\76\40\157\x72\40\x3c\163\141\155\154\x3a\x45\x6e\143\162\171\160\x74\145\x64\x49\104\76\x20\151\156\x20\74\x73\141\155\154\x70\x3a\x4c\x6f\x67\157\165\x74\122\145\x71\165\145\x73\164\x3e\x2e");
        goto fK;
        Fn:
        throw new Exception("\115\157\162\145\40\x74\x68\141\x6e\x20\157\x6e\x65\x20\74\163\141\x6d\x6c\x3a\x4e\x61\x6d\x65\111\104\76\40\157\162\40\x3c\x73\x61\x6d\x6c\72\105\x6e\143\x72\171\160\x74\x65\x64\104\76\40\151\156\40\x3c\163\141\155\x6c\160\x3a\x4c\157\147\157\x75\164\122\145\161\x75\145\x73\164\x3e\x2e");
        fK:
        $fW = $fW[0];
        if ($fW->localName === "\105\x6e\x63\x72\171\x70\x74\x65\144\x44\141\164\x61") {
            goto q3;
        }
        $this->nameId = Utilities::parseNameId($fW);
        goto ZS;
        q3:
        $this->encryptedNameId = $fW;
        ZS:
        $U4 = Utilities::xpQuery($Kz, "\56\57\163\x61\x6d\154\x5f\160\162\x6f\x74\x6f\143\x6f\x6c\x3a\123\x65\x73\x73\x69\157\156\111\156\144\145\170");
        foreach ($U4 as $mp) {
            $this->sessionIndexes[] = trim($mp->textContent);
            Dy:
        }
        Xl:
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($be)
    {
        $this->notOnOrAfter = $be;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Ej;
        }
        return TRUE;
        Ej:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $p1)
    {
        $sd = new DOMDocument();
        $Si = $sd->createElement("\x72\x6f\157\164");
        $sd->appendChild($Si);
        SAML2_Utils::addNameId($Si, $this->nameId);
        $fW = $Si->firstChild;
        SAML2_Utils::getContainer()->debugMessage($fW, "\145\156\143\x72\171\160\x74");
        $Cx = new XMLSecEnc();
        $Cx->setNode($fW);
        $Cx->type = XMLSecEnc::Element;
        $RX = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $RX->generateSessionKey();
        $Cx->encryptKey($p1, $RX);
        $this->encryptedNameId = $Cx->encryptNode($RX);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $p1, array $y7 = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto KC;
        }
        return;
        KC:
        $fW = SAML2_Utils::decryptElement($this->encryptedNameId, $p1, $y7);
        SAML2_Utils::getContainer()->debugMessage($fW, "\144\x65\x63\162\171\x70\164");
        $this->nameId = SAML2_Utils::parseNameId($fW);
        $this->encryptedNameId = NULL;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto VJ;
        }
        throw new Exception("\101\x74\x74\145\155\x70\x74\x65\x64\x20\164\157\40\162\145\164\x72\x69\145\166\145\x20\x65\x6e\143\x72\x79\x70\164\x65\x64\40\116\x61\155\145\111\104\40\x77\x69\164\x68\x6f\x75\164\40\x64\x65\x63\x72\x79\x70\x74\x69\x6e\x67\40\151\164\x20\x66\x69\162\163\164\56");
        VJ:
        return $this->nameId;
    }
    public function setNameId($fW)
    {
        $this->nameId = $fW;
    }
    public function getSessionIndexes()
    {
        return $this->sessionIndexes;
    }
    public function setSessionIndexes(array $U4)
    {
        $this->sessionIndexes = $U4;
    }
    public function getSessionIndex()
    {
        if (!empty($this->sessionIndexes)) {
            goto tw;
        }
        return NULL;
        tw:
        return $this->sessionIndexes[0];
    }
    public function setSessionIndex($mp)
    {
        if (is_null($mp)) {
            goto mY;
        }
        $this->sessionIndexes = array($mp);
        goto jx;
        mY:
        $this->sessionIndexes = array();
        jx:
    }
    public function toUnsignedXML()
    {
        $Si = parent::toUnsignedXML();
        if (!($this->notOnOrAfter !== NULL)) {
            goto qw;
        }
        $Si->setAttribute("\x4e\157\x74\x4f\x6e\x4f\x72\x41\x66\x74\x65\162", gmdate("\131\x2d\155\x2d\144\134\x54\x48\72\151\x3a\x73\x5c\132", $this->notOnOrAfter));
        qw:
        if ($this->encryptedNameId === NULL) {
            goto ML;
        }
        $mm = $Si->ownerDocument->createElementNS(SAML2_Const::NS_SAML, "\163\x61\155\x6c\x3a" . "\x45\x6e\x63\x72\x79\160\164\145\144\111\104");
        $Si->appendChild($mm);
        $mm->appendChild($Si->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto xE;
        ML:
        SAML2_Utils::addNameId($Si, $this->nameId);
        xE:
        foreach ($this->sessionIndexes as $mp) {
            SAML2_Utils::addString($Si, SAML2_Const::NS_SAMLP, "\x53\145\x73\x73\x69\x6f\x6e\111\156\x64\x65\170", $mp);
            MN:
        }
        NL:
        return $Si;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($Iw)
    {
        $this->id = $Iw;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($PG)
    {
        $this->issueInstant = $PG;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function setDestination($U0)
    {
        $this->destination = $U0;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($Qn)
    {
        $this->issuer = $Qn;
    }
}
