<?php


include_once "\125\x74\151\154\151\164\x69\145\x73\56\160\150\x70";
class SAML2_Assertion
{
    private $id;
    private $issueInstant;
    private $issuer;
    private $nameId;
    private $encryptedNameId;
    private $encryptedAttribute;
    private $encryptionKey;
    private $notBefore;
    private $notOnOrAfter;
    private $validAudiences;
    private $sessionNotOnOrAfter;
    private $sessionIndex;
    private $authnInstant;
    private $authnContextClassRef;
    private $authnContextDecl;
    private $authnContextDeclRef;
    private $AuthenticatingAuthority;
    private $attributes;
    private $nameFormat;
    private $signatureKey;
    private $certificates;
    private $signatureData;
    private $requiredEncAttributes;
    private $SubjectConfirmation;
    protected $wasSignedAtConstruction = FALSE;
    public function __construct(DOMElement $vM = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\162\x6e\72\x6f\x61\x73\x69\x73\72\x6e\x61\155\145\x73\x3a\x74\143\72\x53\101\x4d\x4c\72\61\x2e\x31\72\x6e\x61\x6d\x65\x69\144\55\146\x6f\162\155\141\164\72\x75\156\163\160\x65\143\151\146\151\x65\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($vM === NULL)) {
            goto eJ;
        }
        return;
        eJ:
        if (!($vM->localName === "\x45\x6e\143\162\171\160\x74\145\x64\x41\x73\x73\145\162\164\151\157\x6e")) {
            goto C2;
        }
        $GW = Utilities::xpQuery($vM, "\56\57\x78\x65\x6e\143\x3a\105\x6e\143\x72\171\x70\164\145\144\x44\x61\x74\141");
        $Oa = Utilities::xpQuery($vM, "\x2e\57\170\x65\156\143\72\105\x6e\143\x72\171\x70\x74\145\x64\104\x61\x74\x61\57\144\x73\x3a\x4b\145\171\111\156\x66\x6f\x2f\x78\x65\156\143\72\x45\x6e\x63\162\171\x70\164\x65\144\113\145\171");
        $Gb = '';
        if (empty($Oa)) {
            goto vc;
        }
        $Gb = $Oa[0]->firstChild->getAttribute("\x41\154\x67\157\162\151\x74\150\x6d");
        goto zy;
        vc:
        $Oa = Utilities::xpQuery($vM, "\x2e\x2f\x78\x65\x6e\143\72\x45\x6e\x63\162\x79\160\x74\x65\x64\x4b\x65\x79\x2f\x78\145\156\143\x3a\x45\x6e\x63\162\x79\x70\x74\151\x6f\156\115\x65\x74\x68\157\x64");
        $Gb = $Oa[0]->getAttribute("\x41\x6c\x67\157\162\151\164\x68\155");
        zy:
        $uh = Utilities::getEncryptionAlgorithm($Gb);
        if (count($GW) === 0) {
            goto DQ;
        }
        if (count($GW) > 1) {
            goto zo;
        }
        goto Mx;
        DQ:
        throw new Exception("\115\x69\x73\x73\151\156\147\x20\x65\x6e\x63\x72\x79\x70\164\x65\x64\40\144\x61\x74\141\40\151\156\40\74\x73\141\x6d\x6c\72\105\156\143\162\x79\160\164\x65\144\101\163\x73\x65\x72\x74\x69\157\156\x3e\x2e");
        goto Mx;
        zo:
        throw new Exception("\x4d\157\x72\x65\40\x74\150\x61\156\x20\x6f\156\x65\x20\x65\x6e\143\x72\x79\x70\164\x65\144\40\x64\141\164\141\40\x65\154\145\155\x65\x6e\164\40\x69\156\40\74\163\141\155\154\72\105\x6e\x63\162\171\x70\164\145\144\101\163\163\x65\162\x74\151\157\156\x3e\56");
        Mx:
        $Nv = new XMLSecurityKey($uh, array("\164\171\x70\x65" => "\x70\x72\151\166\x61\164\145"));
        $bl = plugin_dir_path(__FILE__) . "\162\x65\x73\x6f\x75\162\143\145\x73" . DIRECTORY_SEPARATOR . "\163\x70\55\153\145\x79\56\x6b\145\x79";
        $Nv->loadKey($bl, TRUE);
        $tp = new XMLSecurityKey($uh, array("\164\171\x70\x65" => "\x70\x72\151\166\x61\164\145"));
        $vX = plugin_dir_path(__FILE__) . "\x72\x65\163\157\165\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\155\151\x6e\151\x6f\x72\x61\156\147\x65\x5f\x73\x70\x5f\160\162\x69\166\137\x6b\145\x79\56\153\145\171";
        $tp->loadKey($vX, TRUE);
        $g6 = array();
        $vM = Utilities::decryptElement($GW[0], $Nv, $g6, $tp);
        C2:
        if ($vM->hasAttribute("\x49\x44")) {
            goto sb;
        }
        throw new Exception("\x4d\151\x73\x73\151\x6e\x67\40\x49\104\x20\141\x74\164\x72\x69\x62\165\164\145\x20\x6f\156\40\123\x41\115\114\40\141\163\x73\145\x72\x74\151\157\156\56");
        sb:
        $this->id = $vM->getAttribute("\111\x44");
        if (!($vM->getAttribute("\x56\145\x72\163\x69\x6f\156") !== "\62\56\x30")) {
            goto c2;
        }
        throw new Exception("\125\x6e\163\x75\x70\160\x6f\162\164\145\x64\x20\x76\x65\x72\163\151\x6f\x6e\72\40" . $vM->getAttribute("\126\145\x72\x73\151\x6f\156"));
        c2:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($vM->getAttribute("\x49\x73\x73\x75\145\x49\156\x73\x74\141\x6e\x74"));
        $SB = Utilities::xpQuery($vM, "\56\57\x73\x61\x6d\x6c\137\x61\x73\163\x65\162\x74\151\157\156\x3a\x49\x73\163\165\x65\x72");
        if (!empty($SB)) {
            goto nE;
        }
        throw new Exception("\115\151\x73\163\151\x6e\147\x20\74\x73\141\155\154\x3a\x49\163\x73\x75\145\162\x3e\x20\x69\x6e\x20\x61\x73\x73\145\162\164\x69\x6f\x6e\56");
        nE:
        $this->issuer = trim($SB[0]->textContent);
        $this->parseConditions($vM);
        $this->parseAuthnStatement($vM);
        $this->parseAttributes($vM);
        $this->parseEncryptedAttributes($vM);
        $this->parseSignature($vM);
        $this->parseSubject($vM);
    }
    private function parseSubject(DOMElement $vM)
    {
        $R1 = Utilities::xpQuery($vM, "\56\57\163\141\x6d\154\x5f\x61\163\x73\145\x72\164\x69\x6f\156\72\123\x75\x62\152\145\143\164");
        if (empty($R1)) {
            goto HJ;
        }
        if (count($R1) > 1) {
            goto Rq;
        }
        goto SF;
        HJ:
        return;
        goto SF;
        Rq:
        throw new Exception("\115\x6f\162\145\40\164\150\x61\x6e\40\x6f\x6e\x65\40\74\x73\x61\x6d\x6c\x3a\123\x75\142\152\145\143\x74\76\40\x69\156\40\x3c\163\x61\x6d\x6c\72\101\x73\163\x65\162\x74\151\157\156\76\x2e");
        SF:
        $R1 = $R1[0];
        $ZU = Utilities::xpQuery($R1, "\56\57\x73\x61\x6d\154\x5f\141\163\x73\x65\162\164\151\x6f\156\x3a\116\141\x6d\145\x49\104\x20\x7c\x20\x2e\57\x73\141\155\x6c\x5f\141\x73\x73\145\x72\164\x69\x6f\156\x3a\105\x6e\143\162\x79\160\x74\145\x64\x49\104\x2f\x78\x65\x6e\x63\x3a\x45\156\143\x72\171\x70\164\x65\x64\x44\141\164\141");
        if (empty($ZU)) {
            goto Ab;
        }
        if (count($ZU) > 1) {
            goto TA;
        }
        goto i5;
        Ab:
        throw new Exception("\x4d\x69\163\x73\151\156\x67\x20\x3c\163\141\x6d\x6c\x3a\x4e\x61\155\145\x49\x44\x3e\x20\157\162\40\x3c\x73\141\155\x6c\72\105\156\x63\162\171\160\164\145\x64\x49\x44\76\40\151\156\40\x3c\x73\x61\155\x6c\72\x53\x75\142\x6a\x65\143\164\x3e\x2e");
        goto i5;
        TA:
        throw new Exception("\x4d\157\x72\x65\x20\164\150\141\x6e\x20\x6f\156\x65\x20\x3c\163\x61\x6d\x6c\72\x4e\141\155\145\x49\x44\x3e\40\x6f\162\x20\x3c\x73\141\155\154\x3a\105\x6e\x63\162\x79\160\164\145\x64\x44\76\x20\x69\x6e\x20\74\163\141\155\154\72\123\165\142\x6a\145\x63\x74\x3e\x2e");
        i5:
        $ZU = $ZU[0];
        if ($ZU->localName === "\x45\156\143\x72\x79\160\x74\x65\x64\104\141\x74\141") {
            goto vJ;
        }
        $this->nameId = Utilities::parseNameId($ZU);
        goto qv;
        vJ:
        $this->encryptedNameId = $ZU;
        qv:
    }
    private function parseConditions(DOMElement $vM)
    {
        $g7 = Utilities::xpQuery($vM, "\56\x2f\163\x61\155\154\137\x61\x73\x73\x65\x72\164\151\x6f\156\x3a\x43\157\156\144\x69\164\151\x6f\x6e\163");
        if (empty($g7)) {
            goto jS;
        }
        if (count($g7) > 1) {
            goto RQ;
        }
        goto TW;
        jS:
        return;
        goto TW;
        RQ:
        throw new Exception("\115\x6f\162\145\x20\164\x68\x61\156\x20\x6f\x6e\x65\40\x3c\163\141\x6d\154\x3a\103\x6f\156\144\x69\164\151\157\156\163\x3e\40\151\x6e\40\x3c\x73\x61\155\x6c\72\101\163\x73\145\162\164\x69\157\156\x3e\56");
        TW:
        $g7 = $g7[0];
        if (!$g7->hasAttribute("\116\157\x74\x42\145\146\157\162\x65")) {
            goto Pk;
        }
        $Ye = Utilities::xsDateTimeToTimestamp($g7->getAttribute("\116\157\164\102\145\146\157\162\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $Ye)) {
            goto Nk;
        }
        $this->notBefore = $Ye;
        Nk:
        Pk:
        if (!$g7->hasAttribute("\x4e\157\x74\x4f\x6e\x4f\x72\101\146\x74\145\162")) {
            goto Ks;
        }
        $MT = Utilities::xsDateTimeToTimestamp($g7->getAttribute("\x4e\157\164\x4f\156\x4f\x72\101\x66\164\x65\162"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $MT)) {
            goto Kl;
        }
        $this->notOnOrAfter = $MT;
        Kl:
        Ks:
        $B9 = $g7->firstChild;
        MA:
        if (!($B9 !== NULL)) {
            goto XI;
        }
        if (!$B9 instanceof DOMText) {
            goto v7;
        }
        goto Ed;
        v7:
        if (!($B9->namespaceURI !== "\165\x72\156\x3a\157\x61\x73\x69\163\72\156\x61\155\x65\x73\72\x74\x63\72\x53\101\115\114\72\62\x2e\x30\x3a\x61\163\x73\x65\x72\164\x69\x6f\156")) {
            goto p1;
        }
        throw new Exception("\125\156\x6b\x6e\157\x77\156\x20\x6e\141\x6d\145\x73\x70\x61\x63\145\x20\x6f\x66\40\143\x6f\156\144\x69\x74\x69\x6f\156\x3a\40" . var_export($B9->namespaceURI, TRUE));
        p1:
        switch ($B9->localName) {
            case "\x41\165\144\151\x65\x6e\143\x65\122\145\x73\x74\x72\x69\x63\164\151\157\x6e":
                $Zh = Utilities::extractStrings($B9, "\x75\162\x6e\72\157\x61\x73\x69\x73\x3a\x6e\x61\155\x65\163\72\164\143\x3a\x53\x41\x4d\x4c\72\62\56\x30\x3a\x61\163\163\145\162\x74\x69\x6f\x6e", "\101\x75\x64\x69\145\156\143\x65");
                if ($this->validAudiences === NULL) {
                    goto f1;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $Zh);
                goto AX;
                f1:
                $this->validAudiences = $Zh;
                AX:
                goto eg;
            case "\x4f\x6e\x65\x54\x69\x6d\x65\125\163\x65":
                goto eg;
            case "\x50\x72\x6f\170\x79\122\145\163\x74\x72\151\x63\164\x69\x6f\x6e":
                goto eg;
            default:
                throw new Exception("\x55\156\x6b\156\157\167\156\40\x63\x6f\x6e\x64\x69\164\x69\x6f\x6e\72\x20" . var_export($B9->localName, TRUE));
        }
        ap:
        eg:
        Ed:
        $B9 = $B9->nextSibling;
        goto MA;
        XI:
    }
    private function parseAuthnStatement(DOMElement $vM)
    {
        $u_ = Utilities::xpQuery($vM, "\56\57\x73\x61\x6d\x6c\x5f\x61\x73\163\x65\162\x74\x69\x6f\156\72\x41\x75\164\150\x6e\x53\164\x61\164\145\x6d\145\x6e\164");
        if (empty($u_)) {
            goto d6;
        }
        if (count($u_) > 1) {
            goto cR;
        }
        goto AB;
        d6:
        $this->authnInstant = NULL;
        return;
        goto AB;
        cR:
        throw new Exception("\x4d\x6f\162\x65\40\x74\x68\x61\164\40\x6f\x6e\145\40\x3c\x73\141\155\x6c\72\x41\165\164\150\156\x53\x74\x61\x74\145\155\145\x6e\164\x3e\x20\x69\x6e\x20\74\163\141\155\x6c\72\101\163\163\x65\162\x74\151\157\156\x3e\40\156\x6f\x74\x20\163\165\x70\x70\157\162\x74\145\144\56");
        AB:
        $aA = $u_[0];
        if ($aA->hasAttribute("\x41\165\164\x68\156\x49\156\163\x74\141\x6e\164")) {
            goto cL;
        }
        throw new Exception("\115\x69\x73\163\x69\156\x67\x20\x72\145\161\165\151\162\x65\144\40\x41\x75\164\x68\x6e\x49\156\163\x74\141\156\x74\x20\x61\164\164\162\x69\142\x75\x74\x65\40\x6f\156\x20\x3c\x73\x61\155\x6c\x3a\101\165\164\150\156\123\164\x61\x74\145\x6d\145\x6e\164\x3e\56");
        cL:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($aA->getAttribute("\x41\x75\164\x68\156\111\x6e\163\x74\x61\156\x74"));
        if (!$aA->hasAttribute("\123\145\x73\163\x69\157\156\116\x6f\x74\x4f\156\x4f\x72\101\146\x74\145\162")) {
            goto yw;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($aA->getAttribute("\x53\x65\x73\x73\x69\x6f\x6e\116\x6f\x74\117\156\117\162\101\146\164\x65\162"));
        yw:
        if (!$aA->hasAttribute("\x53\145\x73\x73\151\x6f\x6e\111\x6e\144\x65\x78")) {
            goto gq;
        }
        $this->sessionIndex = $aA->getAttribute("\x53\145\163\x73\151\x6f\x6e\x49\156\144\145\170");
        gq:
        $this->parseAuthnContext($aA);
    }
    private function parseAuthnContext(DOMElement $Mq)
    {
        $pB = Utilities::xpQuery($Mq, "\x2e\57\x73\x61\x6d\x6c\137\x61\x73\163\x65\x72\x74\151\157\156\72\101\165\164\x68\x6e\103\157\156\164\145\170\x74");
        if (count($pB) > 1) {
            goto gW;
        }
        if (empty($pB)) {
            goto ZG;
        }
        goto r_;
        gW:
        throw new Exception("\x4d\157\x72\145\x20\x74\x68\141\156\x20\x6f\156\x65\x20\x3c\x73\x61\155\154\x3a\x41\165\x74\150\x6e\103\x6f\x6e\164\x65\170\164\76\40\x69\x6e\40\x3c\x73\x61\155\x6c\72\101\165\x74\150\x6e\123\164\x61\x74\145\155\x65\x6e\x74\x3e\x2e");
        goto r_;
        ZG:
        throw new Exception("\x4d\151\x73\x73\x69\x6e\147\40\162\145\161\165\151\x72\x65\x64\x20\x3c\163\141\x6d\154\x3a\101\x75\x74\150\x6e\103\x6f\x6e\x74\x65\170\x74\76\40\x69\x6e\x20\x3c\x73\x61\155\x6c\x3a\x41\165\x74\x68\156\123\164\141\164\145\x6d\145\156\164\x3e\56");
        r_:
        $E9 = $pB[0];
        $gI = Utilities::xpQuery($E9, "\56\x2f\163\x61\155\x6c\x5f\x61\x73\x73\x65\x72\x74\151\x6f\x6e\x3a\x41\165\x74\150\x6e\103\157\156\164\x65\x78\x74\104\x65\x63\154\122\x65\x66");
        if (count($gI) > 1) {
            goto RL;
        }
        if (count($gI) === 1) {
            goto er;
        }
        goto NM;
        RL:
        throw new Exception("\x4d\157\x72\145\x20\164\x68\141\156\40\x6f\156\x65\40\74\163\141\155\x6c\72\101\165\x74\x68\156\103\157\x6e\x74\x65\x78\x74\104\145\143\x6c\x52\145\146\76\40\146\157\x75\x6e\144\77");
        goto NM;
        er:
        $this->setAuthnContextDeclRef(trim($gI[0]->textContent));
        NM:
        $AG = Utilities::xpQuery($E9, "\56\57\163\141\x6d\x6c\x5f\141\x73\163\145\x72\164\x69\157\x6e\72\x41\165\x74\x68\x6e\103\157\x6e\164\x65\170\164\104\x65\143\154");
        if (count($AG) > 1) {
            goto Mf;
        }
        if (count($AG) === 1) {
            goto iz;
        }
        goto O1;
        Mf:
        throw new Exception("\x4d\x6f\162\145\x20\x74\x68\141\156\40\157\x6e\145\x20\74\x73\x61\x6d\154\72\x41\165\x74\x68\x6e\x43\x6f\156\164\145\x78\164\x44\145\143\154\x3e\x20\146\x6f\x75\x6e\x64\77");
        goto O1;
        iz:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($AG[0]));
        O1:
        $oK = Utilities::xpQuery($E9, "\56\57\x73\x61\x6d\154\137\141\x73\163\x65\162\x74\x69\x6f\x6e\x3a\x41\x75\x74\150\x6e\x43\x6f\156\x74\145\170\164\103\x6c\x61\163\x73\x52\x65\x66");
        if (count($oK) > 1) {
            goto SO;
        }
        if (count($oK) === 1) {
            goto UT;
        }
        goto u7;
        SO:
        throw new Exception("\x4d\x6f\162\145\40\164\x68\x61\156\40\x6f\156\145\40\x3c\163\x61\155\x6c\x3a\x41\165\x74\150\x6e\x43\157\x6e\x74\x65\x78\164\103\x6c\x61\163\x73\x52\x65\x66\76\40\x69\x6e\40\74\163\x61\x6d\x6c\72\101\x75\164\150\x6e\x43\157\156\164\145\170\164\x3e\x2e");
        goto u7;
        UT:
        $this->setAuthnContextClassRef(trim($oK[0]->textContent));
        u7:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto H8;
        }
        throw new Exception("\x4d\151\163\163\151\156\147\40\145\x69\164\150\x65\162\x20\x3c\x73\141\x6d\x6c\x3a\x41\165\164\x68\x6e\103\157\x6e\164\x65\x78\x74\103\x6c\141\163\x73\122\145\x66\76\x20\x6f\x72\40\74\x73\141\x6d\x6c\x3a\x41\165\164\150\x6e\x43\x6f\156\164\145\x78\x74\104\x65\143\x6c\122\x65\146\76\40\157\x72\40\74\x73\141\155\x6c\72\x41\165\x74\150\x6e\x43\157\156\164\145\170\164\104\145\x63\154\76");
        H8:
        $this->AuthenticatingAuthority = Utilities::extractStrings($E9, "\165\162\156\x3a\157\141\163\151\x73\x3a\156\141\155\145\163\72\x74\x63\72\x53\101\115\x4c\72\62\56\x30\x3a\x61\163\x73\145\162\164\x69\157\x6e", "\101\x75\x74\150\145\x6e\x74\x69\143\x61\164\151\x6e\x67\101\x75\x74\150\x6f\x72\x69\164\171");
    }
    private function parseAttributes(DOMElement $vM)
    {
        $Cf = TRUE;
        $m0 = Utilities::xpQuery($vM, "\x2e\57\163\141\x6d\154\137\141\163\x73\x65\x72\164\x69\x6f\x6e\72\x41\x74\164\162\x69\142\165\164\145\123\164\x61\164\x65\155\145\x6e\164\57\163\x61\155\x6c\x5f\x61\163\x73\145\x72\x74\x69\x6f\x6e\x3a\101\164\164\x72\151\x62\x75\x74\145");
        foreach ($m0 as $Vq) {
            if ($Vq->hasAttribute("\x4e\141\x6d\145")) {
                goto IL;
            }
            throw new Exception("\x4d\x69\x73\163\x69\x6e\147\x20\x6e\141\155\x65\x20\157\156\x20\x3c\163\x61\155\154\72\101\x74\x74\x72\x69\142\165\x74\145\x3e\x20\x65\x6c\x65\155\x65\156\x74\x2e");
            IL:
            $zu = $Vq->getAttribute("\x4e\141\155\x65");
            if ($Vq->hasAttribute("\116\x61\155\x65\x46\157\x72\155\x61\x74")) {
                goto ss;
            }
            $Kk = "\x75\162\x6e\x3a\x6f\x61\x73\151\x73\x3a\x6e\141\x6d\x65\163\x3a\x74\x63\x3a\x53\101\115\114\72\61\x2e\61\72\x6e\x61\x6d\x65\x69\x64\x2d\x66\157\x72\x6d\141\164\x3a\x75\156\x73\160\x65\x63\x69\146\151\145\144";
            goto jg;
            ss:
            $Kk = $Vq->getAttribute("\116\141\155\x65\106\157\x72\x6d\141\x74");
            jg:
            if ($Cf) {
                goto zu;
            }
            if (!($this->nameFormat !== $Kk)) {
                goto vg;
            }
            $this->nameFormat = "\165\162\156\72\x6f\x61\163\151\163\72\156\x61\x6d\x65\x73\x3a\164\x63\72\123\101\115\x4c\72\61\x2e\x31\72\x6e\x61\155\145\151\144\55\146\157\162\x6d\x61\164\72\x75\156\x73\160\145\143\x69\x66\151\145\144";
            vg:
            goto iF1;
            zu:
            $this->nameFormat = $Kk;
            $Cf = FALSE;
            iF1:
            if (array_key_exists($zu, $this->attributes)) {
                goto cM;
            }
            $this->attributes[$zu] = array();
            cM:
            $X3 = Utilities::xpQuery($Vq, "\56\57\x73\x61\x6d\x6c\137\141\163\x73\145\x72\x74\x69\157\156\x3a\101\x74\x74\162\x69\142\x75\x74\x65\126\x61\x6c\165\x65");
            foreach ($X3 as $aw) {
                $this->attributes[$zu][] = trim($aw->textContent);
                DV:
            }
            O3:
            ws:
        }
        b6:
    }
    private function parseEncryptedAttributes(DOMElement $vM)
    {
        $this->encryptedAttribute = Utilities::xpQuery($vM, "\56\x2f\163\x61\155\154\x5f\x61\x73\163\x65\162\164\x69\157\x6e\x3a\101\x74\x74\162\151\x62\165\164\x65\123\164\x61\164\145\155\x65\x6e\164\57\x73\141\155\x6c\137\x61\163\163\145\162\164\x69\x6f\156\x3a\105\156\x63\162\x79\x70\x74\145\144\101\x74\164\162\151\142\165\164\145");
    }
    private function parseSignature(DOMElement $vM)
    {
        $M3 = Utilities::validateElement($vM);
        if (!($M3 !== FALSE)) {
            goto KX;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $M3["\103\145\x72\x74\151\146\151\x63\141\x74\145\163"];
        $this->signatureData = $M3;
        KX:
    }
    public function validate(XMLSecurityKey $Nv)
    {
        if (!($this->signatureData === NULL)) {
            goto IG;
        }
        return FALSE;
        IG:
        Utilities::validateSignature($this->signatureData, $Nv);
        return TRUE;
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
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($SB)
    {
        $this->issuer = $SB;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto Qg;
        }
        throw new Exception("\x41\x74\x74\145\x6d\x70\x74\x65\x64\x20\164\x6f\40\162\x65\x74\x72\x69\x65\166\x65\x20\x65\156\x63\162\x79\x70\164\145\x64\40\116\141\155\145\x49\104\x20\167\x69\164\x68\x6f\x75\164\40\x64\145\143\x72\x79\x70\164\x69\156\x67\x20\151\x74\x20\146\151\162\163\164\x2e");
        Qg:
        return $this->nameId;
    }
    public function setNameId($ZU)
    {
        $this->nameId = $ZU;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto U2;
        }
        return TRUE;
        U2:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $Nv)
    {
        $aQ = new DOMDocument();
        $Sw = $aQ->createElement("\162\x6f\157\x74");
        $aQ->appendChild($Sw);
        Utilities::addNameId($Sw, $this->nameId);
        $ZU = $Sw->firstChild;
        Utilities::getContainer()->debugMessage($ZU, "\x65\x6e\143\x72\x79\160\164");
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
            goto jB;
        }
        return;
        jB:
        $ZU = Utilities::decryptElement($this->encryptedNameId, $Nv, $g6);
        Utilities::getContainer()->debugMessage($ZU, "\x64\x65\143\x72\171\160\164");
        $this->nameId = Utilities::parseNameId($ZU);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $Nv, array $g6 = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto E1;
        }
        return;
        E1:
        $Cf = TRUE;
        $m0 = $this->encryptedAttribute;
        foreach ($m0 as $dQ) {
            $Vq = Utilities::decryptElement($dQ->getElementsByTagName("\105\156\143\162\x79\x70\164\145\144\104\141\164\x61")->item(0), $Nv, $g6);
            if ($Vq->hasAttribute("\x4e\141\x6d\145")) {
                goto tA;
            }
            throw new Exception("\x4d\x69\x73\163\x69\156\x67\40\x6e\141\155\x65\40\157\x6e\x20\74\163\141\155\x6c\x3a\101\x74\164\162\151\142\x75\164\145\x3e\x20\145\154\x65\155\x65\156\x74\x2e");
            tA:
            $zu = $Vq->getAttribute("\116\141\x6d\x65");
            if ($Vq->hasAttribute("\x4e\141\x6d\145\106\157\x72\155\141\164")) {
                goto nx;
            }
            $Kk = "\x75\162\x6e\72\157\141\x73\151\x73\72\x6e\141\x6d\x65\163\72\x74\x63\x3a\123\101\115\x4c\72\62\56\60\72\x61\164\164\x72\156\x61\155\145\x2d\x66\157\x72\x6d\141\164\72\165\156\x73\160\x65\143\x69\x66\151\x65\144";
            goto iw;
            nx:
            $Kk = $Vq->getAttribute("\x4e\141\x6d\145\106\157\162\x6d\141\x74");
            iw:
            if ($Cf) {
                goto vr;
            }
            if (!($this->nameFormat !== $Kk)) {
                goto ad;
            }
            $this->nameFormat = "\x75\x72\156\x3a\x6f\141\x73\151\x73\72\x6e\x61\155\x65\163\x3a\x74\143\x3a\123\x41\115\114\x3a\x32\56\60\72\141\164\x74\x72\156\x61\x6d\x65\x2d\x66\x6f\162\x6d\141\x74\72\x75\x6e\163\x70\145\143\x69\x66\x69\145\x64";
            ad:
            goto D7;
            vr:
            $this->nameFormat = $Kk;
            $Cf = FALSE;
            D7:
            if (array_key_exists($zu, $this->attributes)) {
                goto KT;
            }
            $this->attributes[$zu] = array();
            KT:
            $X3 = Utilities::xpQuery($Vq, "\x2e\x2f\163\141\155\x6c\x5f\141\163\x73\145\x72\164\151\x6f\156\x3a\101\x74\x74\x72\151\x62\165\164\145\126\141\154\165\145");
            foreach ($X3 as $aw) {
                $this->attributes[$zu][] = trim($aw->textContent);
                IH:
            }
            i8:
            OV:
        }
        o3:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($Ye)
    {
        $this->notBefore = $Ye;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($MT)
    {
        $this->notOnOrAfter = $MT;
    }
    public function setEncryptedAttributes($FY)
    {
        $this->requiredEncAttributes = $FY;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $vH = NULL)
    {
        $this->validAudiences = $vH;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($jN)
    {
        $this->authnInstant = $jN;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($Wm)
    {
        $this->sessionNotOnOrAfter = $Wm;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($Rp)
    {
        $this->sessionIndex = $Rp;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto c8;
        }
        return $this->authnContextClassRef;
        c8:
        if (empty($this->authnContextDeclRef)) {
            goto FO;
        }
        return $this->authnContextDeclRef;
        FO:
        return NULL;
    }
    public function setAuthnContext($T7)
    {
        $this->setAuthnContextClassRef($T7);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($fA)
    {
        $this->authnContextClassRef = $fA;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $ym)
    {
        if (empty($this->authnContextDeclRef)) {
            goto Bl;
        }
        throw new Exception("\101\165\x74\x68\156\103\157\156\x74\145\x78\164\104\x65\143\x6c\122\x65\146\40\x69\x73\x20\141\x6c\x72\145\141\x64\x79\40\162\145\147\x69\x73\164\145\x72\145\x64\x21\40\x4d\x61\x79\40\x6f\156\x6c\x79\40\x68\141\166\145\40\x65\151\164\150\145\162\40\141\x20\104\145\x63\x6c\40\157\x72\x20\141\x20\x44\145\x63\x6c\122\x65\x66\x2c\x20\x6e\157\x74\x20\x62\157\x74\150\x21");
        Bl:
        $this->authnContextDecl = $ym;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($Vu)
    {
        if (empty($this->authnContextDecl)) {
            goto Wz;
        }
        throw new Exception("\101\x75\164\150\x6e\103\x6f\x6e\164\x65\x78\164\104\x65\x63\x6c\x20\x69\x73\40\141\x6c\x72\145\141\144\x79\x20\x72\145\x67\x69\x73\x74\x65\x72\145\x64\x21\40\x4d\x61\171\x20\x6f\x6e\x6c\x79\x20\x68\141\166\145\40\x65\151\x74\150\x65\x72\x20\141\40\x44\x65\143\154\x20\x6f\162\40\141\x20\104\x65\143\154\x52\145\x66\54\x20\156\157\x74\40\x62\157\x74\x68\41");
        Wz:
        $this->authnContextDeclRef = $Vu;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($O8)
    {
        $this->AuthenticatingAuthority = $O8;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $m0)
    {
        $this->attributes = $m0;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($Kk)
    {
        $this->nameFormat = $Kk;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $wz)
    {
        $this->SubjectConfirmation = $wz;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function setSignatureKey(XMLsecurityKey $wN = NULL)
    {
        $this->signatureKey = $wN;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $zq = NULL)
    {
        $this->encryptionKey = $zq;
    }
    public function setCertificates(array $Lj)
    {
        $this->certificates = $Lj;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $mj = NULL)
    {
        if ($mj === NULL) {
            goto aq;
        }
        $Pc = $mj->ownerDocument;
        goto Vz;
        aq:
        $Pc = new DOMDocument();
        $mj = $Pc;
        Vz:
        $Sw = $Pc->createElementNS("\x75\x72\156\x3a\157\x61\163\151\163\72\x6e\141\155\145\x73\72\x74\x63\x3a\123\101\115\x4c\72\x32\56\60\72\x61\163\x73\x65\x72\x74\x69\x6f\156", "\x73\x61\155\154\x3a" . "\x41\163\163\145\x72\164\151\157\x6e");
        $mj->appendChild($Sw);
        $Sw->setAttributeNS("\165\162\x6e\72\157\x61\x73\151\x73\72\x6e\x61\x6d\145\x73\72\x74\143\72\x53\101\x4d\x4c\72\x32\x2e\x30\x3a\x70\162\x6f\164\x6f\x63\x6f\x6c", "\x73\141\155\154\x70\72\x74\x6d\x70", "\x74\x6d\x70");
        $Sw->removeAttributeNS("\x75\162\156\72\x6f\x61\163\x69\x73\x3a\156\141\x6d\145\163\x3a\x74\143\x3a\x53\101\x4d\x4c\x3a\62\56\x30\72\x70\x72\x6f\x74\x6f\x63\157\154", "\164\x6d\x70");
        $Sw->setAttributeNS("\x68\164\x74\x70\x3a\57\x2f\x77\x77\x77\x2e\167\63\x2e\157\162\x67\x2f\62\60\60\x31\57\130\115\114\x53\143\150\x65\x6d\141\55\x69\x6e\x73\164\x61\x6e\x63\x65", "\x78\x73\x69\72\164\x6d\x70", "\164\x6d\x70");
        $Sw->removeAttributeNS("\x68\164\x74\160\72\57\x2f\x77\167\x77\x2e\167\x33\56\157\x72\x67\x2f\62\60\x30\x31\57\x58\x4d\x4c\123\143\150\x65\x6d\x61\x2d\x69\156\x73\164\141\x6e\143\145", "\x74\155\x70");
        $Sw->setAttributeNS("\x68\x74\164\160\72\x2f\x2f\x77\167\x77\x2e\x77\x33\56\157\x72\x67\57\62\60\60\x31\x2f\130\115\114\x53\143\150\x65\155\x61", "\170\163\x3a\164\x6d\160", "\x74\x6d\x70");
        $Sw->removeAttributeNS("\150\164\164\160\72\x2f\x2f\167\x77\x77\56\167\63\x2e\157\x72\147\57\x32\60\x30\61\x2f\x58\115\114\x53\143\150\x65\x6d\141", "\x74\155\160");
        $Sw->setAttribute("\x49\104", $this->id);
        $Sw->setAttribute("\x56\x65\x72\163\151\x6f\156", "\62\56\x30");
        $Sw->setAttribute("\111\163\163\165\x65\x49\156\163\x74\x61\x6e\x74", gmdate("\x59\55\x6d\x2d\x64\x5c\124\110\72\x69\72\x73\134\132", $this->issueInstant));
        $SB = Utilities::addString($Sw, "\165\162\x6e\x3a\157\x61\x73\151\163\x3a\156\x61\155\145\x73\72\164\143\x3a\x53\101\x4d\114\x3a\62\56\x30\x3a\x61\x73\163\x65\x72\x74\151\x6f\x6e", "\163\x61\155\154\x3a\111\x73\x73\165\145\162", $this->issuer);
        $this->addSubject($Sw);
        $this->addConditions($Sw);
        $this->addAuthnStatement($Sw);
        if ($this->requiredEncAttributes == FALSE) {
            goto zG;
        }
        $this->addEncryptedAttributeStatement($Sw);
        goto di;
        zG:
        $this->addAttributeStatement($Sw);
        di:
        if (!($this->signatureKey !== NULL)) {
            goto V0;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $Sw, $SB->nextSibling);
        V0:
        return $Sw;
    }
    private function addSubject(DOMElement $Sw)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto rz;
        }
        return;
        rz:
        $R1 = $Sw->ownerDocument->createElementNS("\165\x72\156\x3a\157\x61\163\x69\163\x3a\156\141\155\x65\163\72\164\143\72\123\x41\x4d\114\x3a\62\x2e\x30\72\141\x73\163\x65\x72\x74\x69\x6f\156", "\163\141\155\x6c\x3a\x53\165\142\x6a\x65\143\x74");
        $Sw->appendChild($R1);
        if ($this->encryptedNameId === NULL) {
            goto RV;
        }
        $x1 = $R1->ownerDocument->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\151\163\72\x6e\141\x6d\145\163\72\x74\143\x3a\x53\101\115\x4c\x3a\x32\56\60\x3a\141\x73\163\145\x72\x74\x69\x6f\156", "\163\141\155\x6c\72" . "\105\x6e\143\x72\x79\160\164\x65\x64\111\x44");
        $R1->appendChild($x1);
        $x1->appendChild($R1->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto LD;
        RV:
        Utilities::addNameId($R1, $this->nameId);
        LD:
        foreach ($this->SubjectConfirmation as $N9) {
            $N9->toXML($R1);
            QY:
        }
        mO:
    }
    private function addConditions(DOMElement $Sw)
    {
        $Pc = $Sw->ownerDocument;
        $g7 = $Pc->createElementNS("\x75\162\x6e\72\157\x61\163\151\x73\x3a\156\x61\x6d\x65\x73\72\164\143\72\123\x41\x4d\x4c\72\62\x2e\x30\72\141\163\163\x65\162\164\x69\157\156", "\x73\x61\155\x6c\72\x43\x6f\156\x64\x69\164\x69\x6f\x6e\163");
        $Sw->appendChild($g7);
        if (!($this->notBefore !== NULL)) {
            goto I3;
        }
        $g7->setAttribute("\116\x6f\x74\102\x65\146\x6f\162\x65", gmdate("\x59\x2d\x6d\55\x64\134\x54\110\x3a\151\72\x73\134\132", $this->notBefore));
        I3:
        if (!($this->notOnOrAfter !== NULL)) {
            goto TX;
        }
        $g7->setAttribute("\116\157\164\117\x6e\117\x72\101\146\x74\145\162", gmdate("\131\55\155\55\x64\x5c\x54\110\72\151\x3a\163\x5c\x5a", $this->notOnOrAfter));
        TX:
        if (!($this->validAudiences !== NULL)) {
            goto o0;
        }
        $z2 = $Pc->createElementNS("\x75\x72\x6e\72\x6f\x61\163\x69\x73\72\156\141\155\145\x73\72\164\x63\x3a\123\101\x4d\114\x3a\62\x2e\x30\72\x61\163\x73\145\162\164\x69\157\x6e", "\163\x61\155\154\x3a\x41\165\144\x69\145\156\143\x65\122\x65\x73\x74\x72\x69\143\x74\x69\157\x6e");
        $g7->appendChild($z2);
        Utilities::addStrings($z2, "\165\162\x6e\72\157\x61\163\151\163\72\156\x61\x6d\145\163\72\x74\143\x3a\x53\x41\x4d\x4c\72\62\x2e\60\72\141\163\x73\x65\162\164\x69\157\156", "\163\x61\155\x6c\x3a\x41\165\x64\151\145\156\x63\x65", FALSE, $this->validAudiences);
        o0:
    }
    private function addAuthnStatement(DOMElement $Sw)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto uZ;
        }
        return;
        uZ:
        $Pc = $Sw->ownerDocument;
        $Mq = $Pc->createElementNS("\165\x72\156\72\157\141\x73\x69\163\x3a\156\141\x6d\x65\x73\72\x74\x63\72\x53\101\115\114\72\62\x2e\x30\72\141\163\x73\145\x72\164\151\x6f\156", "\x73\141\155\x6c\72\101\165\x74\x68\x6e\x53\164\141\x74\145\155\x65\156\x74");
        $Sw->appendChild($Mq);
        $Mq->setAttribute("\101\165\x74\x68\156\111\156\x73\164\141\x6e\x74", gmdate("\131\x2d\155\x2d\144\x5c\124\110\72\151\72\163\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto SV;
        }
        $Mq->setAttribute("\123\x65\x73\163\x69\x6f\156\116\x6f\164\117\x6e\117\162\101\146\x74\x65\x72", gmdate("\131\55\x6d\55\144\x5c\124\110\x3a\x69\72\163\134\x5a", $this->sessionNotOnOrAfter));
        SV:
        if (!($this->sessionIndex !== NULL)) {
            goto M_;
        }
        $Mq->setAttribute("\123\x65\x73\163\x69\157\156\x49\156\x64\145\170", $this->sessionIndex);
        M_:
        $E9 = $Pc->createElementNS("\x75\x72\156\72\157\x61\163\x69\163\72\x6e\x61\x6d\145\x73\x3a\x74\143\x3a\123\x41\115\114\72\62\56\x30\x3a\141\163\x73\145\x72\x74\x69\x6f\156", "\x73\141\x6d\x6c\x3a\x41\165\164\150\156\x43\157\x6e\164\145\170\x74");
        $Mq->appendChild($E9);
        if (empty($this->authnContextClassRef)) {
            goto tG;
        }
        Utilities::addString($E9, "\x75\162\x6e\x3a\x6f\141\163\x69\x73\72\156\141\155\x65\x73\x3a\164\143\72\123\101\x4d\114\x3a\x32\x2e\60\x3a\141\x73\163\145\162\x74\151\157\156", "\163\x61\155\154\72\x41\x75\x74\150\156\x43\157\156\x74\145\170\164\x43\x6c\x61\163\x73\x52\145\x66", $this->authnContextClassRef);
        tG:
        if (empty($this->authnContextDecl)) {
            goto ff;
        }
        $this->authnContextDecl->toXML($E9);
        ff:
        if (empty($this->authnContextDeclRef)) {
            goto pO;
        }
        Utilities::addString($E9, "\165\x72\156\x3a\157\x61\163\151\163\x3a\156\x61\155\x65\163\72\x74\143\x3a\x53\x41\x4d\x4c\x3a\62\x2e\x30\x3a\x61\163\163\x65\162\x74\151\x6f\x6e", "\x73\141\155\x6c\x3a\101\x75\x74\x68\156\x43\x6f\x6e\x74\x65\x78\x74\104\x65\x63\x6c\x52\x65\146", $this->authnContextDeclRef);
        pO:
        Utilities::addStrings($E9, "\165\162\156\x3a\x6f\141\x73\151\x73\72\x6e\141\155\145\x73\72\164\143\x3a\123\x41\x4d\x4c\x3a\x32\56\60\x3a\x61\x73\163\145\x72\164\151\157\x6e", "\163\141\x6d\x6c\x3a\101\x75\164\x68\145\x6e\x74\x69\143\x61\x74\x69\156\147\x41\x75\164\x68\x6f\x72\x69\164\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $Sw)
    {
        if (!empty($this->attributes)) {
            goto kd;
        }
        return;
        kd:
        $Pc = $Sw->ownerDocument;
        $Jl = $Pc->createElementNS("\165\162\156\72\157\141\163\x69\x73\x3a\156\141\155\x65\x73\x3a\164\x63\x3a\x53\101\x4d\114\x3a\62\56\x30\x3a\141\x73\x73\145\162\x74\151\x6f\156", "\x73\141\155\154\x3a\x41\164\164\x72\x69\142\x75\x74\145\x53\x74\x61\164\x65\x6d\145\156\164");
        $Sw->appendChild($Jl);
        foreach ($this->attributes as $zu => $X3) {
            $Vq = $Pc->createElementNS("\x75\x72\x6e\x3a\157\141\x73\151\163\72\156\141\x6d\x65\163\72\x74\143\x3a\x53\x41\115\114\72\x32\56\60\x3a\x61\163\163\145\x72\164\151\x6f\x6e", "\x73\x61\155\154\72\x41\164\x74\x72\151\x62\x75\x74\145");
            $Jl->appendChild($Vq);
            $Vq->setAttribute("\x4e\141\155\145", $zu);
            if (!($this->nameFormat !== "\x75\162\156\x3a\157\x61\163\151\x73\72\156\141\155\x65\163\72\x74\x63\72\x53\x41\x4d\114\x3a\x32\56\60\x3a\x61\164\x74\x72\156\x61\x6d\x65\x2d\x66\x6f\162\x6d\141\164\72\x75\x6e\163\x70\145\x63\x69\146\151\x65\x64")) {
                goto Tc;
            }
            $Vq->setAttribute("\x4e\141\x6d\x65\x46\157\x72\x6d\141\x74", $this->nameFormat);
            Tc:
            foreach ($X3 as $aw) {
                if (is_string($aw)) {
                    goto ON;
                }
                if (is_int($aw)) {
                    goto It;
                }
                $Xr = NULL;
                goto Tg;
                ON:
                $Xr = "\x78\163\72\163\x74\162\151\156\147";
                goto Tg;
                It:
                $Xr = "\x78\163\x3a\151\156\164\145\147\145\162";
                Tg:
                $lu = $Pc->createElementNS("\x75\x72\x6e\x3a\157\141\163\x69\x73\x3a\x6e\x61\155\145\163\72\164\x63\72\123\x41\x4d\x4c\x3a\x32\x2e\x30\x3a\141\x73\x73\x65\x72\x74\x69\157\x6e", "\163\141\x6d\x6c\72\x41\x74\x74\x72\151\x62\165\164\x65\x56\x61\x6c\x75\145");
                $Vq->appendChild($lu);
                if (!($Xr !== NULL)) {
                    goto rc;
                }
                $lu->setAttributeNS("\150\x74\164\x70\x3a\x2f\57\167\x77\167\x2e\167\63\56\x6f\162\x67\57\x32\60\x30\x31\x2f\130\x4d\x4c\123\143\x68\145\155\x61\x2d\151\156\163\x74\141\x6e\x63\145", "\x78\x73\151\72\164\171\160\x65", $Xr);
                rc:
                if (!is_null($aw)) {
                    goto UI;
                }
                $lu->setAttributeNS("\x68\164\164\160\72\x2f\x2f\167\x77\167\x2e\167\x33\x2e\157\x72\x67\x2f\62\x30\60\x31\57\130\x4d\114\x53\143\x68\x65\x6d\141\x2d\x69\x6e\x73\164\x61\x6e\143\x65", "\x78\x73\151\x3a\x6e\151\154", "\x74\162\x75\x65");
                UI:
                if ($aw instanceof DOMNodeList) {
                    goto ib;
                }
                $lu->appendChild($Pc->createTextNode($aw));
                goto ni;
                ib:
                $RJ = 0;
                Au:
                if (!($RJ < $aw->length)) {
                    goto Om;
                }
                $B9 = $Pc->importNode($aw->item($RJ), TRUE);
                $lu->appendChild($B9);
                Xs:
                $RJ++;
                goto Au;
                Om:
                ni:
                iV:
            }
            oE:
            cX:
        }
        Qc:
    }
    private function addEncryptedAttributeStatement(DOMElement $Sw)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto pD;
        }
        return;
        pD:
        $Pc = $Sw->ownerDocument;
        $Jl = $Pc->createElementNS("\x75\x72\x6e\x3a\x6f\141\x73\x69\163\72\x6e\x61\155\145\x73\72\164\x63\72\x53\101\115\x4c\72\62\56\60\72\141\163\163\x65\x72\x74\151\x6f\x6e", "\163\x61\155\x6c\x3a\x41\x74\164\x72\x69\x62\x75\164\x65\123\x74\x61\x74\145\155\x65\156\164");
        $Sw->appendChild($Jl);
        foreach ($this->attributes as $zu => $X3) {
            $ln = new DOMDocument();
            $Vq = $ln->createElementNS("\x75\162\x6e\x3a\157\x61\x73\x69\163\72\156\141\x6d\145\x73\x3a\164\143\72\x53\101\x4d\114\72\62\56\x30\x3a\141\163\163\x65\x72\x74\151\157\156", "\163\141\x6d\154\72\101\x74\x74\x72\x69\142\165\x74\x65");
            $Vq->setAttribute("\116\141\155\145", $zu);
            $ln->appendChild($Vq);
            if (!($this->nameFormat !== "\x75\x72\x6e\x3a\157\141\x73\x69\x73\72\x6e\x61\x6d\145\x73\72\x74\x63\72\x53\101\x4d\x4c\x3a\x32\x2e\x30\72\x61\164\x74\162\156\x61\x6d\145\55\146\157\x72\155\141\x74\72\x75\156\x73\160\145\x63\151\x66\x69\145\x64")) {
                goto Pw;
            }
            $Vq->setAttribute("\x4e\141\155\145\x46\157\162\155\141\x74", $this->nameFormat);
            Pw:
            foreach ($X3 as $aw) {
                if (is_string($aw)) {
                    goto se;
                }
                if (is_int($aw)) {
                    goto Vx;
                }
                $Xr = NULL;
                goto zx;
                se:
                $Xr = "\170\163\72\x73\164\162\151\156\x67";
                goto zx;
                Vx:
                $Xr = "\x78\x73\72\151\156\164\145\147\145\x72";
                zx:
                $lu = $ln->createElementNS("\x75\x72\x6e\x3a\x6f\141\x73\x69\163\x3a\156\x61\155\145\163\72\x74\143\72\123\x41\x4d\114\72\62\56\x30\x3a\x61\163\x73\145\x72\x74\151\x6f\x6e", "\x73\x61\155\x6c\72\x41\x74\x74\162\x69\x62\x75\x74\x65\126\141\154\x75\x65");
                $Vq->appendChild($lu);
                if (!($Xr !== NULL)) {
                    goto hB;
                }
                $lu->setAttributeNS("\150\164\x74\160\72\57\x2f\x77\167\167\56\x77\x33\x2e\x6f\x72\x67\57\x32\60\60\x31\x2f\130\x4d\x4c\123\x63\x68\145\x6d\x61\55\151\x6e\x73\164\141\x6e\x63\x65", "\x78\x73\151\x3a\164\x79\160\x65", $Xr);
                hB:
                if ($aw instanceof DOMNodeList) {
                    goto JW;
                }
                $lu->appendChild($ln->createTextNode($aw));
                goto OR1;
                JW:
                $RJ = 0;
                Ns:
                if (!($RJ < $aw->length)) {
                    goto ui;
                }
                $B9 = $ln->importNode($aw->item($RJ), TRUE);
                $lu->appendChild($B9);
                e0:
                $RJ++;
                goto Ns;
                ui:
                OR1:
                Cx:
            }
            f7:
            $p1 = new XMLSecEnc();
            $p1->setNode($ln->documentElement);
            $p1->type = "\150\x74\x74\160\x3a\57\57\167\167\x77\56\167\x33\56\x6f\x72\147\57\x32\60\60\x31\57\60\x34\x2f\170\x6d\154\x65\x6e\x63\x23\x45\154\145\155\x65\156\x74";
            $Lp = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $Lp->generateSessionKey();
            $p1->encryptKey($this->encryptionKey, $Lp);
            $dk = $p1->encryptNode($Lp);
            $Pu = $Pc->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\151\x73\72\156\141\155\145\x73\x3a\164\x63\72\x53\101\x4d\114\x3a\62\x2e\x30\72\x61\x73\x73\145\162\x74\151\157\x6e", "\163\141\155\x6c\72\105\156\143\x72\x79\x70\164\x65\x64\x41\x74\x74\x72\151\x62\x75\x74\x65");
            $Jl->appendChild($Pu);
            $eR = $Pc->importNode($dk, TRUE);
            $Pu->appendChild($eR);
            yy:
        }
        G_:
    }
}
