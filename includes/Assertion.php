<?php


include_once "\x55\164\151\x6c\151\164\151\x65\x73\x2e\x70\150\x70";
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
    public function __construct(DOMElement $Kz = NULL)
    {
        $this->id = Utilities::generateId();
        $this->issueInstant = Utilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = Utilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\x75\162\x6e\72\157\x61\163\151\x73\x3a\x6e\141\x6d\145\163\72\x74\x63\72\123\101\115\114\x3a\61\56\61\72\x6e\141\x6d\145\x69\x64\55\146\157\162\x6d\x61\x74\x3a\x75\x6e\163\160\145\143\151\x66\x69\x65\144";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($Kz === NULL)) {
            goto WK;
        }
        return;
        WK:
        if (!($Kz->localName === "\x45\x6e\x63\x72\171\x70\164\145\x64\x41\x73\x73\x65\x72\x74\x69\x6f\156")) {
            goto S6;
        }
        $UQ = Utilities::xpQuery($Kz, "\x2e\57\x78\145\x6e\x63\72\x45\156\x63\162\x79\x70\164\x65\144\104\141\x74\141");
        $jC = Utilities::xpQuery($Kz, "\x2e\x2f\170\x65\x6e\x63\x3a\x45\x6e\x63\x72\171\x70\164\145\x64\x44\x61\x74\141\x2f\x64\163\72\113\x65\x79\x49\156\146\x6f\57\170\145\x6e\143\x3a\105\156\x63\162\x79\160\164\145\x64\113\x65\x79");
        $h8 = '';
        if (empty($jC)) {
            goto My;
        }
        $h8 = $jC[0]->firstChild->getAttribute("\x41\154\147\x6f\162\151\x74\150\x6d");
        goto AY;
        My:
        $jC = Utilities::xpQuery($Kz, "\x2e\x2f\x78\x65\x6e\143\x3a\x45\x6e\143\162\171\160\164\145\x64\113\x65\x79\57\x78\x65\x6e\143\x3a\105\x6e\143\x72\171\160\164\x69\x6f\x6e\x4d\145\164\x68\x6f\x64");
        $h8 = $jC[0]->getAttribute("\101\154\147\157\x72\151\164\x68\155");
        AY:
        $pk = Utilities::getEncryptionAlgorithm($h8);
        if (count($UQ) === 0) {
            goto AF;
        }
        if (count($UQ) > 1) {
            goto WN;
        }
        goto eY;
        AF:
        throw new Exception("\115\151\163\163\x69\156\147\x20\145\x6e\x63\162\x79\160\x74\145\x64\x20\144\x61\x74\141\40\151\156\x20\74\163\x61\155\154\x3a\105\x6e\x63\162\171\160\x74\x65\144\101\163\x73\145\162\164\x69\157\x6e\76\56");
        goto eY;
        WN:
        throw new Exception("\115\157\x72\145\40\164\150\141\x6e\x20\157\x6e\x65\40\145\156\143\162\x79\x70\164\x65\144\40\x64\141\x74\x61\x20\x65\x6c\x65\x6d\145\156\x74\40\x69\156\x20\x3c\x73\x61\x6d\154\72\x45\x6e\143\162\x79\160\x74\x65\144\x41\x73\163\x65\x72\x74\151\x6f\x6e\x3e\x2e");
        eY:
        $p1 = new XMLSecurityKey($pk, array("\164\171\x70\145" => "\x70\x72\x69\166\x61\164\x65"));
        $U8 = plugin_dir_path(__FILE__) . "\162\145\x73\x6f\x75\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\x73\x70\x2d\153\145\x79\56\153\x65\x79";
        $p1->loadKey($U8, TRUE);
        $sL = new XMLSecurityKey($pk, array("\164\171\x70\x65" => "\x70\162\151\x76\141\164\145"));
        $EO = plugin_dir_path(__FILE__) . "\162\x65\x73\x6f\165\x72\143\x65\163" . DIRECTORY_SEPARATOR . "\x6d\151\156\x69\x6f\162\141\156\x67\x65\137\163\x70\x5f\x70\x72\x69\x76\137\153\145\171\x2e\153\145\171";
        $sL->loadKey($EO, TRUE);
        $y7 = array();
        $Kz = Utilities::decryptElement($UQ[0], $p1, $y7, $sL);
        S6:
        if ($Kz->hasAttribute("\111\104")) {
            goto Si;
        }
        throw new Exception("\x4d\x69\x73\x73\x69\156\x67\x20\111\104\40\141\164\x74\162\151\x62\165\164\145\40\157\156\40\123\101\x4d\x4c\40\x61\163\163\x65\162\x74\x69\157\156\56");
        Si:
        $this->id = $Kz->getAttribute("\111\x44");
        if (!($Kz->getAttribute("\126\145\162\163\151\157\156") !== "\x32\x2e\x30")) {
            goto t0;
        }
        throw new Exception("\125\156\x73\x75\160\x70\157\x72\x74\145\144\x20\166\x65\162\x73\x69\157\156\x3a\x20" . $Kz->getAttribute("\126\x65\162\x73\x69\157\x6e"));
        t0:
        $this->issueInstant = Utilities::xsDateTimeToTimestamp($Kz->getAttribute("\111\x73\x73\165\145\x49\x6e\x73\x74\141\x6e\164"));
        $Qn = Utilities::xpQuery($Kz, "\56\x2f\x73\x61\x6d\154\x5f\141\163\163\x65\x72\x74\151\x6f\156\72\111\x73\163\x75\145\x72");
        if (!empty($Qn)) {
            goto Al;
        }
        throw new Exception("\115\x69\163\163\151\x6e\x67\x20\74\163\141\x6d\x6c\72\111\x73\x73\x75\x65\162\76\x20\x69\156\x20\141\x73\x73\x65\162\164\x69\157\x6e\x2e");
        Al:
        $this->issuer = trim($Qn[0]->textContent);
        $this->parseConditions($Kz);
        $this->parseAuthnStatement($Kz);
        $this->parseAttributes($Kz);
        $this->parseEncryptedAttributes($Kz);
        $this->parseSignature($Kz);
        $this->parseSubject($Kz);
    }
    private function parseSubject(DOMElement $Kz)
    {
        $dg = Utilities::xpQuery($Kz, "\x2e\57\x73\x61\155\x6c\137\141\163\x73\145\x72\x74\151\x6f\156\x3a\123\165\142\x6a\145\x63\x74");
        if (empty($dg)) {
            goto Us;
        }
        if (count($dg) > 1) {
            goto Uk;
        }
        goto Vg;
        Us:
        return;
        goto Vg;
        Uk:
        throw new Exception("\115\157\x72\145\x20\164\150\x61\156\x20\157\x6e\x65\40\x3c\163\x61\155\154\x3a\123\165\142\152\145\143\164\x3e\x20\151\x6e\40\74\x73\141\x6d\x6c\72\x41\x73\163\145\162\164\x69\157\156\76\56");
        Vg:
        $dg = $dg[0];
        $fW = Utilities::xpQuery($dg, "\x2e\x2f\x73\x61\x6d\x6c\x5f\141\x73\163\x65\162\164\x69\157\x6e\x3a\116\141\x6d\145\x49\104\40\x7c\40\x2e\57\x73\x61\155\154\137\x61\163\x73\145\162\x74\x69\157\156\x3a\x45\x6e\143\162\171\160\164\145\144\111\104\57\170\145\x6e\143\x3a\105\156\143\162\x79\x70\x74\145\x64\104\x61\164\x61");
        if (empty($fW)) {
            goto JS;
        }
        if (count($fW) > 1) {
            goto ZB;
        }
        goto hM;
        JS:
        throw new Exception("\115\x69\163\163\x69\156\x67\40\74\163\x61\155\x6c\72\x4e\141\x6d\145\x49\x44\76\x20\x6f\162\x20\74\x73\x61\155\154\x3a\x45\156\x63\x72\x79\x70\164\x65\x64\x49\x44\x3e\x20\151\x6e\40\74\163\141\x6d\x6c\x3a\123\165\142\152\x65\x63\164\x3e\x2e");
        goto hM;
        ZB:
        throw new Exception("\115\x6f\x72\145\x20\x74\150\x61\x6e\40\x6f\x6e\145\40\74\163\141\155\x6c\x3a\x4e\x61\x6d\145\111\x44\76\x20\x6f\162\40\x3c\163\x61\155\154\72\105\x6e\x63\x72\171\160\164\x65\x64\x44\76\40\151\156\40\x3c\163\141\155\x6c\72\x53\x75\142\152\145\143\164\76\x2e");
        hM:
        $fW = $fW[0];
        if ($fW->localName === "\x45\156\143\x72\171\x70\x74\145\x64\104\141\164\x61") {
            goto sj;
        }
        $this->nameId = Utilities::parseNameId($fW);
        goto IL;
        sj:
        $this->encryptedNameId = $fW;
        IL:
    }
    private function parseConditions(DOMElement $Kz)
    {
        $ty = Utilities::xpQuery($Kz, "\x2e\x2f\x73\141\x6d\x6c\137\141\163\x73\x65\162\x74\x69\x6f\156\x3a\103\157\156\144\x69\164\151\157\x6e\x73");
        if (empty($ty)) {
            goto q1;
        }
        if (count($ty) > 1) {
            goto uP;
        }
        goto i0;
        q1:
        return;
        goto i0;
        uP:
        throw new Exception("\115\x6f\162\x65\40\x74\x68\x61\156\40\157\156\x65\x20\74\x73\141\x6d\x6c\x3a\103\x6f\x6e\x64\x69\x74\x69\157\x6e\163\x3e\x20\151\156\x20\x3c\x73\x61\155\x6c\72\101\x73\163\x65\162\x74\x69\x6f\156\x3e\56");
        i0:
        $ty = $ty[0];
        if (!$ty->hasAttribute("\x4e\x6f\x74\102\145\146\157\162\145")) {
            goto sH;
        }
        $rx = Utilities::xsDateTimeToTimestamp($ty->getAttribute("\x4e\x6f\x74\x42\145\146\157\162\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $rx)) {
            goto ws;
        }
        $this->notBefore = $rx;
        ws:
        sH:
        if (!$ty->hasAttribute("\x4e\157\x74\x4f\x6e\117\162\x41\x66\164\145\x72")) {
            goto m3;
        }
        $be = Utilities::xsDateTimeToTimestamp($ty->getAttribute("\116\157\x74\117\156\x4f\162\101\x66\164\x65\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $be)) {
            goto up;
        }
        $this->notOnOrAfter = $be;
        up:
        m3:
        $Dw = $ty->firstChild;
        CN:
        if (!($Dw !== NULL)) {
            goto Jc;
        }
        if (!$Dw instanceof DOMText) {
            goto d_;
        }
        goto OS;
        d_:
        if (!($Dw->namespaceURI !== "\165\162\x6e\x3a\x6f\x61\163\x69\163\x3a\x6e\141\155\x65\x73\72\164\x63\72\123\101\x4d\114\x3a\x32\x2e\x30\72\141\163\163\x65\x72\x74\x69\x6f\x6e")) {
            goto Wr;
        }
        throw new Exception("\125\x6e\x6b\x6e\157\167\x6e\x20\x6e\x61\x6d\x65\163\x70\141\143\x65\40\157\x66\40\143\157\x6e\144\x69\x74\x69\157\x6e\x3a\40" . var_export($Dw->namespaceURI, TRUE));
        Wr:
        switch ($Dw->localName) {
            case "\x41\x75\x64\x69\145\x6e\143\145\122\145\163\164\x72\x69\143\164\x69\157\156":
                $rc = Utilities::extractStrings($Dw, "\x75\x72\156\x3a\157\x61\x73\x69\163\x3a\156\141\x6d\145\163\72\x74\143\72\123\x41\x4d\114\72\x32\56\60\x3a\x61\163\x73\x65\162\x74\x69\x6f\156", "\x41\165\144\151\x65\156\143\145");
                if ($this->validAudiences === NULL) {
                    goto VG;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $rc);
                goto o_;
                VG:
                $this->validAudiences = $rc;
                o_:
                goto j1;
            case "\117\x6e\145\124\151\x6d\x65\x55\163\x65":
                goto j1;
            case "\x50\162\x6f\170\171\122\x65\163\164\162\x69\143\x74\x69\x6f\x6e":
                goto j1;
            default:
                throw new Exception("\125\156\x6b\x6e\157\167\x6e\x20\143\157\156\144\151\164\x69\x6f\156\72\40" . var_export($Dw->localName, TRUE));
        }
        Tv:
        j1:
        OS:
        $Dw = $Dw->nextSibling;
        goto CN;
        Jc:
    }
    private function parseAuthnStatement(DOMElement $Kz)
    {
        $QB = Utilities::xpQuery($Kz, "\x2e\x2f\163\x61\x6d\x6c\x5f\141\163\x73\x65\162\x74\151\157\156\72\x41\165\x74\x68\156\123\x74\141\164\145\x6d\145\156\164");
        if (empty($QB)) {
            goto Ii;
        }
        if (count($QB) > 1) {
            goto je;
        }
        goto kW;
        Ii:
        $this->authnInstant = NULL;
        return;
        goto kW;
        je:
        throw new Exception("\x4d\x6f\162\x65\40\164\150\141\x74\x20\x6f\156\x65\x20\x3c\163\141\x6d\x6c\x3a\x41\x75\164\150\156\x53\164\x61\164\x65\155\x65\156\x74\x3e\40\x69\x6e\x20\x3c\163\141\x6d\154\72\101\163\x73\145\x72\x74\x69\157\x6e\76\x20\156\157\164\40\163\165\160\x70\157\x72\x74\145\x64\56");
        kW:
        $P9 = $QB[0];
        if ($P9->hasAttribute("\x41\165\164\x68\x6e\111\156\163\164\141\x6e\164")) {
            goto kV;
        }
        throw new Exception("\x4d\151\163\x73\151\x6e\x67\x20\162\x65\x71\165\151\162\145\144\x20\x41\165\x74\x68\156\x49\x6e\163\x74\x61\156\x74\40\x61\164\x74\162\x69\x62\x75\x74\145\x20\157\x6e\40\74\163\141\x6d\x6c\72\x41\165\x74\150\156\x53\164\x61\164\145\155\x65\x6e\164\x3e\56");
        kV:
        $this->authnInstant = Utilities::xsDateTimeToTimestamp($P9->getAttribute("\101\x75\164\x68\x6e\111\x6e\163\x74\x61\156\x74"));
        if (!$P9->hasAttribute("\123\x65\163\163\151\x6f\x6e\x4e\157\x74\117\x6e\117\162\x41\146\164\x65\x72")) {
            goto pe;
        }
        $this->sessionNotOnOrAfter = Utilities::xsDateTimeToTimestamp($P9->getAttribute("\123\145\x73\x73\x69\157\x6e\116\x6f\164\117\156\x4f\x72\101\x66\x74\x65\x72"));
        pe:
        if (!$P9->hasAttribute("\123\145\163\x73\x69\x6f\156\x49\156\144\145\x78")) {
            goto Aj;
        }
        $this->sessionIndex = $P9->getAttribute("\123\x65\x73\x73\151\157\156\x49\x6e\x64\x65\170");
        Aj:
        $this->parseAuthnContext($P9);
    }
    private function parseAuthnContext(DOMElement $na)
    {
        $i_ = Utilities::xpQuery($na, "\56\x2f\x73\x61\155\x6c\137\141\163\163\x65\x72\164\151\x6f\156\72\101\x75\x74\150\156\103\157\156\x74\x65\170\164");
        if (count($i_) > 1) {
            goto V1;
        }
        if (empty($i_)) {
            goto eV;
        }
        goto TW;
        V1:
        throw new Exception("\115\157\162\145\x20\x74\150\x61\156\x20\157\x6e\x65\x20\x3c\163\141\155\154\72\x41\x75\x74\x68\x6e\x43\157\156\164\x65\x78\x74\76\x20\x69\156\40\x3c\x73\x61\155\x6c\72\101\165\x74\150\x6e\123\164\141\164\x65\155\x65\156\164\x3e\x2e");
        goto TW;
        eV:
        throw new Exception("\115\151\163\x73\151\x6e\147\40\162\145\x71\165\151\x72\145\144\40\74\163\141\x6d\x6c\x3a\x41\x75\164\150\x6e\x43\157\x6e\x74\145\170\x74\76\x20\x69\156\x20\74\163\141\155\x6c\72\101\165\x74\150\156\x53\x74\x61\x74\x65\155\145\156\164\x3e\x2e");
        TW:
        $PS = $i_[0];
        $vJ = Utilities::xpQuery($PS, "\x2e\57\x73\x61\155\154\x5f\141\x73\163\145\x72\164\x69\157\x6e\x3a\x41\165\164\x68\x6e\103\x6f\156\164\145\170\164\104\x65\x63\x6c\x52\x65\146");
        if (count($vJ) > 1) {
            goto x_;
        }
        if (count($vJ) === 1) {
            goto CZ;
        }
        goto gG;
        x_:
        throw new Exception("\x4d\x6f\162\x65\40\x74\x68\141\x6e\x20\x6f\156\x65\40\74\x73\141\155\x6c\x3a\101\165\x74\150\156\103\x6f\156\x74\x65\170\x74\104\x65\143\154\x52\145\146\x3e\x20\x66\x6f\x75\x6e\x64\77");
        goto gG;
        CZ:
        $this->setAuthnContextDeclRef(trim($vJ[0]->textContent));
        gG:
        $BD = Utilities::xpQuery($PS, "\56\x2f\163\x61\155\154\137\x61\x73\163\x65\162\x74\x69\157\156\x3a\101\x75\x74\x68\156\x43\x6f\x6e\164\x65\x78\164\104\145\143\x6c");
        if (count($BD) > 1) {
            goto eE;
        }
        if (count($BD) === 1) {
            goto xc;
        }
        goto y7;
        eE:
        throw new Exception("\115\157\x72\x65\x20\x74\x68\141\x6e\40\157\156\145\x20\74\x73\141\x6d\x6c\72\x41\x75\x74\150\156\x43\157\156\164\145\x78\x74\x44\x65\x63\x6c\x3e\40\146\x6f\x75\x6e\144\x3f");
        goto y7;
        xc:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($BD[0]));
        y7:
        $ji = Utilities::xpQuery($PS, "\56\57\163\141\155\x6c\137\x61\x73\x73\145\x72\x74\151\x6f\x6e\x3a\x41\165\x74\x68\156\103\157\156\164\145\x78\x74\x43\154\141\163\163\122\145\146");
        if (count($ji) > 1) {
            goto J4;
        }
        if (count($ji) === 1) {
            goto ne;
        }
        goto ca;
        J4:
        throw new Exception("\115\157\162\x65\40\x74\x68\x61\156\40\157\156\145\x20\x3c\163\x61\x6d\x6c\72\101\x75\x74\x68\x6e\x43\157\x6e\164\x65\x78\164\x43\x6c\x61\163\x73\122\145\x66\76\40\151\156\40\74\163\x61\155\x6c\x3a\x41\165\164\150\x6e\103\157\156\164\x65\170\164\76\56");
        goto ca;
        ne:
        $this->setAuthnContextClassRef(trim($ji[0]->textContent));
        ca:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto f_;
        }
        throw new Exception("\x4d\151\x73\x73\151\x6e\147\x20\x65\151\164\x68\x65\162\40\x3c\163\141\x6d\x6c\x3a\x41\x75\x74\150\x6e\x43\x6f\x6e\x74\145\170\164\103\154\x61\x73\163\122\x65\146\76\x20\157\x72\x20\x3c\163\x61\155\x6c\72\101\165\164\x68\x6e\x43\157\156\164\145\x78\x74\104\145\143\x6c\x52\x65\146\76\40\x6f\162\40\74\163\141\155\154\x3a\x41\x75\x74\150\x6e\x43\x6f\156\x74\145\170\164\104\x65\x63\x6c\76");
        f_:
        $this->AuthenticatingAuthority = Utilities::extractStrings($PS, "\165\162\156\72\x6f\141\x73\x69\163\72\156\x61\155\145\163\x3a\164\143\72\x53\101\115\114\x3a\62\x2e\60\72\x61\x73\x73\x65\162\x74\x69\x6f\156", "\101\165\164\150\145\x6e\164\151\x63\x61\x74\151\156\147\101\x75\x74\x68\157\x72\x69\164\x79");
    }
    private function parseAttributes(DOMElement $Kz)
    {
        $d8 = TRUE;
        $Fc = Utilities::xpQuery($Kz, "\56\x2f\x73\141\155\x6c\137\x61\163\x73\x65\162\164\x69\157\x6e\72\101\164\x74\x72\x69\142\165\x74\145\123\x74\141\x74\x65\x6d\145\156\164\57\163\141\x6d\x6c\x5f\x61\x73\x73\145\162\x74\151\x6f\156\x3a\x41\x74\164\x72\151\x62\165\164\x65");
        foreach ($Fc as $KN) {
            if ($KN->hasAttribute("\x4e\x61\x6d\145")) {
                goto p2;
            }
            throw new Exception("\115\x69\x73\x73\151\x6e\x67\40\156\x61\x6d\145\x20\157\x6e\x20\74\x73\141\155\x6c\x3a\101\x74\x74\162\x69\x62\x75\164\x65\x3e\40\x65\154\x65\x6d\x65\156\x74\56");
            p2:
            $LF = $KN->getAttribute("\116\141\x6d\x65");
            if ($KN->hasAttribute("\x4e\141\155\145\106\x6f\x72\x6d\141\164")) {
                goto GP;
            }
            $F_ = "\165\162\x6e\x3a\x6f\141\163\151\163\72\x6e\141\155\x65\163\x3a\164\143\x3a\x53\101\115\x4c\x3a\61\x2e\x31\x3a\156\141\x6d\x65\151\x64\x2d\146\x6f\162\155\141\164\72\165\156\x73\160\145\x63\x69\146\151\145\x64";
            goto EI;
            GP:
            $F_ = $KN->getAttribute("\116\141\155\x65\x46\157\x72\x6d\141\x74");
            EI:
            if ($d8) {
                goto jA;
            }
            if (!($this->nameFormat !== $F_)) {
                goto gb;
            }
            $this->nameFormat = "\x75\162\x6e\x3a\157\x61\x73\x69\x73\72\156\x61\x6d\x65\x73\x3a\x74\x63\72\123\101\x4d\114\x3a\x31\56\61\x3a\x6e\141\155\145\151\x64\55\x66\x6f\162\x6d\141\x74\x3a\165\156\x73\160\x65\143\151\146\x69\x65\x64";
            gb:
            goto Zj;
            jA:
            $this->nameFormat = $F_;
            $d8 = FALSE;
            Zj:
            if (array_key_exists($LF, $this->attributes)) {
                goto jv;
            }
            $this->attributes[$LF] = array();
            jv:
            $eE = Utilities::xpQuery($KN, "\56\57\163\x61\155\x6c\x5f\141\x73\x73\x65\x72\164\151\x6f\156\72\101\164\x74\162\x69\142\165\x74\x65\126\141\x6c\x75\145");
            foreach ($eE as $OK) {
                $this->attributes[$LF][] = trim($OK->textContent);
                LF:
            }
            Y5:
            Sa:
        }
        Ty:
    }
    private function parseEncryptedAttributes(DOMElement $Kz)
    {
        $this->encryptedAttribute = Utilities::xpQuery($Kz, "\x2e\x2f\x73\x61\x6d\154\137\x61\x73\163\145\162\x74\x69\157\x6e\x3a\x41\164\x74\x72\x69\142\165\164\x65\123\164\141\x74\x65\x6d\145\x6e\x74\x2f\163\141\x6d\x6c\137\x61\x73\163\145\x72\164\x69\x6f\156\x3a\x45\x6e\x63\162\171\160\164\x65\x64\x41\x74\x74\162\x69\142\165\164\x65");
    }
    private function parseSignature(DOMElement $Kz)
    {
        $B9 = Utilities::validateElement($Kz);
        if (!($B9 !== FALSE)) {
            goto fo;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $B9["\103\x65\x72\164\x69\146\151\143\x61\164\145\163"];
        $this->signatureData = $B9;
        fo:
    }
    public function validate(XMLSecurityKey $p1)
    {
        if (!($this->signatureData === NULL)) {
            goto TA;
        }
        return FALSE;
        TA:
        Utilities::validateSignature($this->signatureData, $p1);
        return TRUE;
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
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($Qn)
    {
        $this->issuer = $Qn;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto c5;
        }
        throw new Exception("\x41\164\x74\x65\155\160\164\145\x64\40\164\157\x20\162\145\164\162\x69\x65\166\145\40\x65\x6e\143\162\x79\x70\x74\x65\144\x20\x4e\x61\x6d\145\111\x44\40\167\x69\164\x68\x6f\165\x74\x20\144\145\x63\162\x79\160\x74\151\156\x67\40\151\x74\40\146\151\162\163\164\56");
        c5:
        return $this->nameId;
    }
    public function setNameId($fW)
    {
        $this->nameId = $fW;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto NZ;
        }
        return TRUE;
        NZ:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $p1)
    {
        $sd = new DOMDocument();
        $Si = $sd->createElement("\x72\157\x6f\164");
        $sd->appendChild($Si);
        Utilities::addNameId($Si, $this->nameId);
        $fW = $Si->firstChild;
        Utilities::getContainer()->debugMessage($fW, "\x65\x6e\x63\x72\171\160\x74");
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
            goto Fc;
        }
        return;
        Fc:
        $fW = Utilities::decryptElement($this->encryptedNameId, $p1, $y7);
        Utilities::getContainer()->debugMessage($fW, "\x64\145\x63\162\171\160\x74");
        $this->nameId = Utilities::parseNameId($fW);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $p1, array $y7 = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto Ll;
        }
        return;
        Ll:
        $d8 = TRUE;
        $Fc = $this->encryptedAttribute;
        foreach ($Fc as $jm) {
            $KN = Utilities::decryptElement($jm->getElementsByTagName("\x45\156\143\162\171\x70\x74\145\144\x44\141\x74\141")->item(0), $p1, $y7);
            if ($KN->hasAttribute("\116\x61\155\145")) {
                goto Qk;
            }
            throw new Exception("\115\151\163\163\151\x6e\147\x20\x6e\141\x6d\145\x20\x6f\156\x20\74\x73\141\155\x6c\72\x41\164\164\x72\x69\142\x75\164\x65\76\40\145\x6c\x65\155\x65\x6e\164\56");
            Qk:
            $LF = $KN->getAttribute("\116\141\155\x65");
            if ($KN->hasAttribute("\116\x61\x6d\145\x46\157\162\x6d\141\164")) {
                goto qA;
            }
            $F_ = "\165\x72\156\72\157\141\163\x69\163\x3a\156\x61\155\145\x73\72\164\x63\72\123\x41\x4d\x4c\72\62\x2e\x30\72\141\164\x74\162\x6e\141\155\x65\x2d\x66\x6f\162\x6d\141\x74\72\x75\156\x73\x70\x65\x63\151\x66\x69\x65\x64";
            goto Ye;
            qA:
            $F_ = $KN->getAttribute("\x4e\141\x6d\145\106\157\x72\x6d\141\x74");
            Ye:
            if ($d8) {
                goto DV;
            }
            if (!($this->nameFormat !== $F_)) {
                goto GU;
            }
            $this->nameFormat = "\165\x72\156\x3a\157\x61\x73\x69\163\72\x6e\141\155\145\163\x3a\164\143\72\x53\101\x4d\x4c\x3a\62\x2e\60\72\x61\x74\164\162\156\x61\x6d\x65\x2d\146\x6f\162\x6d\x61\164\72\165\156\163\x70\145\143\x69\x66\151\145\144";
            GU:
            goto ru;
            DV:
            $this->nameFormat = $F_;
            $d8 = FALSE;
            ru:
            if (array_key_exists($LF, $this->attributes)) {
                goto WM;
            }
            $this->attributes[$LF] = array();
            WM:
            $eE = Utilities::xpQuery($KN, "\x2e\57\x73\x61\155\154\x5f\141\163\163\145\x72\164\x69\157\156\x3a\x41\164\x74\x72\x69\142\165\164\145\126\x61\x6c\x75\x65");
            foreach ($eE as $OK) {
                $this->attributes[$LF][] = trim($OK->textContent);
                p0:
            }
            w8:
            G7:
        }
        WP:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($rx)
    {
        $this->notBefore = $rx;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($be)
    {
        $this->notOnOrAfter = $be;
    }
    public function setEncryptedAttributes($I3)
    {
        $this->requiredEncAttributes = $I3;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $ZA = NULL)
    {
        $this->validAudiences = $ZA;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($Hr)
    {
        $this->authnInstant = $Hr;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($NX)
    {
        $this->sessionNotOnOrAfter = $NX;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($mp)
    {
        $this->sessionIndex = $mp;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto cY;
        }
        return $this->authnContextClassRef;
        cY:
        if (empty($this->authnContextDeclRef)) {
            goto C4;
        }
        return $this->authnContextDeclRef;
        C4:
        return NULL;
    }
    public function setAuthnContext($jZ)
    {
        $this->setAuthnContextClassRef($jZ);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($lK)
    {
        $this->authnContextClassRef = $lK;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $ja)
    {
        if (empty($this->authnContextDeclRef)) {
            goto Y2;
        }
        throw new Exception("\x41\x75\164\150\156\x43\157\x6e\x74\145\170\164\x44\x65\x63\154\122\145\146\40\151\x73\40\x61\x6c\162\145\x61\x64\x79\x20\x72\x65\147\151\x73\x74\145\162\145\x64\x21\x20\115\x61\171\40\x6f\156\154\171\40\150\x61\166\145\x20\145\x69\x74\x68\145\162\x20\141\x20\x44\x65\143\x6c\40\157\x72\40\141\x20\x44\x65\x63\154\122\x65\x66\54\40\x6e\157\164\x20\142\x6f\164\x68\x21");
        Y2:
        $this->authnContextDecl = $ja;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($is)
    {
        if (empty($this->authnContextDecl)) {
            goto rg;
        }
        throw new Exception("\101\x75\164\150\x6e\103\x6f\x6e\x74\145\170\164\104\x65\x63\154\40\x69\163\x20\x61\x6c\162\x65\x61\x64\171\40\x72\x65\147\151\163\x74\x65\x72\145\x64\x21\x20\115\x61\x79\40\157\156\154\x79\40\x68\x61\x76\145\x20\145\x69\x74\150\145\162\40\x61\40\104\145\143\154\40\x6f\x72\40\141\x20\x44\x65\143\154\122\145\x66\54\x20\x6e\x6f\x74\40\142\157\x74\150\41");
        rg:
        $this->authnContextDeclRef = $is;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($ZS)
    {
        $this->AuthenticatingAuthority = $ZS;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $Fc)
    {
        $this->attributes = $Fc;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($F_)
    {
        $this->nameFormat = $F_;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $oC)
    {
        $this->SubjectConfirmation = $oC;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function setSignatureKey(XMLsecurityKey $i3 = NULL)
    {
        $this->signatureKey = $i3;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $z8 = NULL)
    {
        $this->encryptionKey = $z8;
    }
    public function setCertificates(array $Tw)
    {
        $this->certificates = $Tw;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $Zv = NULL)
    {
        if ($Zv === NULL) {
            goto nL;
        }
        $iv = $Zv->ownerDocument;
        goto pF;
        nL:
        $iv = new DOMDocument();
        $Zv = $iv;
        pF:
        $Si = $iv->createElementNS("\x75\x72\x6e\72\x6f\141\163\151\x73\72\156\x61\x6d\x65\163\x3a\164\x63\72\123\x41\x4d\x4c\72\x32\x2e\x30\x3a\x61\x73\163\145\162\164\151\x6f\x6e", "\x73\x61\x6d\x6c\72" . "\x41\x73\163\x65\162\x74\x69\x6f\156");
        $Zv->appendChild($Si);
        $Si->setAttributeNS("\x75\162\x6e\72\157\141\x73\151\x73\x3a\x6e\141\155\145\163\x3a\x74\x63\72\123\x41\115\114\72\62\x2e\60\72\x70\x72\x6f\x74\157\x63\x6f\154", "\163\x61\x6d\x6c\x70\72\164\x6d\160", "\164\x6d\160");
        $Si->removeAttributeNS("\165\x72\156\72\x6f\x61\x73\151\x73\72\156\x61\155\145\163\x3a\x74\x63\x3a\x53\101\x4d\114\x3a\x32\56\60\x3a\160\x72\x6f\x74\x6f\143\157\154", "\164\x6d\160");
        $Si->setAttributeNS("\150\x74\164\x70\x3a\x2f\x2f\167\167\x77\x2e\167\63\56\157\x72\147\57\x32\x30\60\x31\57\x58\115\114\x53\143\x68\145\155\x61\55\151\156\163\x74\x61\x6e\143\x65", "\170\x73\151\x3a\164\155\160", "\x74\x6d\x70");
        $Si->removeAttributeNS("\x68\x74\164\160\72\x2f\x2f\x77\167\167\56\x77\x33\x2e\x6f\162\x67\57\x32\60\x30\61\x2f\130\x4d\x4c\123\x63\x68\145\155\x61\55\151\156\x73\164\141\x6e\x63\x65", "\164\155\160");
        $Si->setAttributeNS("\x68\164\x74\160\72\57\x2f\x77\167\167\x2e\x77\x33\x2e\157\162\x67\57\62\60\x30\61\57\130\x4d\114\123\x63\x68\x65\155\141", "\170\x73\72\164\155\x70", "\164\155\160");
        $Si->removeAttributeNS("\x68\x74\164\x70\72\57\57\x77\167\x77\x2e\x77\x33\56\x6f\x72\147\x2f\x32\60\x30\61\x2f\x58\x4d\x4c\123\x63\150\x65\155\141", "\x74\x6d\x70");
        $Si->setAttribute("\x49\x44", $this->id);
        $Si->setAttribute("\126\145\162\x73\x69\157\x6e", "\62\56\60");
        $Si->setAttribute("\111\x73\x73\165\x65\x49\156\163\164\x61\x6e\164", gmdate("\x59\55\155\x2d\x64\x5c\x54\110\x3a\x69\x3a\163\134\x5a", $this->issueInstant));
        $Qn = Utilities::addString($Si, "\165\162\x6e\72\157\x61\x73\151\163\72\156\x61\155\x65\x73\72\x74\143\72\x53\101\x4d\114\72\x32\56\x30\x3a\141\163\x73\145\x72\x74\x69\157\x6e", "\163\141\155\x6c\x3a\111\163\x73\165\145\162", $this->issuer);
        $this->addSubject($Si);
        $this->addConditions($Si);
        $this->addAuthnStatement($Si);
        if ($this->requiredEncAttributes == FALSE) {
            goto ga;
        }
        $this->addEncryptedAttributeStatement($Si);
        goto R0;
        ga:
        $this->addAttributeStatement($Si);
        R0:
        if (!($this->signatureKey !== NULL)) {
            goto DR;
        }
        Utilities::insertSignature($this->signatureKey, $this->certificates, $Si, $Qn->nextSibling);
        DR:
        return $Si;
    }
    private function addSubject(DOMElement $Si)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto Wt;
        }
        return;
        Wt:
        $dg = $Si->ownerDocument->createElementNS("\x75\162\156\72\157\x61\163\151\163\72\x6e\x61\155\145\163\x3a\x74\143\x3a\123\x41\x4d\x4c\72\x32\56\x30\x3a\x61\163\x73\x65\162\164\151\x6f\156", "\163\141\x6d\x6c\72\x53\165\x62\x6a\x65\x63\164");
        $Si->appendChild($dg);
        if ($this->encryptedNameId === NULL) {
            goto pN;
        }
        $mm = $dg->ownerDocument->createElementNS("\x75\162\x6e\72\x6f\141\163\x69\x73\72\156\x61\155\x65\163\72\164\x63\x3a\123\x41\x4d\x4c\72\x32\56\60\x3a\x61\x73\163\145\162\164\x69\x6f\156", "\163\x61\155\x6c\x3a" . "\105\156\x63\162\x79\x70\x74\145\x64\111\104");
        $dg->appendChild($mm);
        $mm->appendChild($dg->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto u8;
        pN:
        Utilities::addNameId($dg, $this->nameId);
        u8:
        foreach ($this->SubjectConfirmation as $x8) {
            $x8->toXML($dg);
            s4:
        }
        B1:
    }
    private function addConditions(DOMElement $Si)
    {
        $iv = $Si->ownerDocument;
        $ty = $iv->createElementNS("\165\x72\x6e\x3a\157\x61\x73\x69\163\72\x6e\141\155\x65\163\x3a\x74\x63\72\x53\101\x4d\x4c\72\x32\x2e\60\72\x61\163\x73\x65\162\164\x69\157\x6e", "\x73\141\x6d\x6c\x3a\x43\x6f\x6e\144\151\164\151\157\x6e\163");
        $Si->appendChild($ty);
        if (!($this->notBefore !== NULL)) {
            goto sP;
        }
        $ty->setAttribute("\116\x6f\x74\102\145\x66\157\162\x65", gmdate("\x59\x2d\x6d\x2d\x64\134\124\x48\x3a\x69\x3a\x73\x5c\x5a", $this->notBefore));
        sP:
        if (!($this->notOnOrAfter !== NULL)) {
            goto zW;
        }
        $ty->setAttribute("\116\157\x74\x4f\x6e\x4f\162\101\x66\x74\x65\x72", gmdate("\x59\55\x6d\x2d\x64\x5c\124\110\72\151\72\163\134\x5a", $this->notOnOrAfter));
        zW:
        if (!($this->validAudiences !== NULL)) {
            goto BG;
        }
        $hh = $iv->createElementNS("\165\x72\156\x3a\x6f\x61\163\151\x73\72\x6e\141\155\145\163\x3a\164\x63\x3a\x53\x41\115\x4c\x3a\x32\x2e\x30\x3a\x61\163\163\x65\x72\x74\x69\x6f\156", "\x73\141\x6d\x6c\x3a\x41\x75\144\x69\145\156\143\x65\x52\x65\163\164\x72\151\143\x74\x69\157\x6e");
        $ty->appendChild($hh);
        Utilities::addStrings($hh, "\x75\162\x6e\72\x6f\141\x73\151\x73\x3a\156\141\x6d\x65\163\x3a\x74\143\72\123\101\x4d\114\72\x32\x2e\60\x3a\x61\163\163\145\162\x74\151\x6f\x6e", "\163\x61\x6d\154\x3a\x41\165\x64\x69\x65\156\x63\145", FALSE, $this->validAudiences);
        BG:
    }
    private function addAuthnStatement(DOMElement $Si)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto Q_;
        }
        return;
        Q_:
        $iv = $Si->ownerDocument;
        $na = $iv->createElementNS("\165\162\x6e\72\x6f\x61\163\151\x73\x3a\156\x61\155\145\163\x3a\164\143\x3a\x53\101\x4d\114\x3a\62\x2e\60\x3a\141\163\163\x65\162\x74\151\157\x6e", "\x73\141\x6d\154\x3a\x41\x75\x74\150\x6e\123\164\x61\x74\x65\x6d\145\x6e\x74");
        $Si->appendChild($na);
        $na->setAttribute("\x41\x75\164\150\156\x49\x6e\163\x74\x61\x6e\164", gmdate("\x59\x2d\155\x2d\x64\x5c\124\x48\x3a\x69\x3a\x73\134\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto OO;
        }
        $na->setAttribute("\x53\x65\163\x73\151\157\156\x4e\x6f\164\117\x6e\117\162\101\146\164\x65\x72", gmdate("\x59\55\x6d\55\x64\x5c\124\x48\72\151\x3a\x73\134\132", $this->sessionNotOnOrAfter));
        OO:
        if (!($this->sessionIndex !== NULL)) {
            goto iO;
        }
        $na->setAttribute("\x53\145\x73\x73\151\157\156\111\x6e\144\145\170", $this->sessionIndex);
        iO:
        $PS = $iv->createElementNS("\165\162\156\72\x6f\141\x73\151\163\x3a\x6e\141\155\145\x73\72\x74\143\72\x53\101\x4d\114\x3a\62\x2e\x30\x3a\141\x73\x73\145\162\164\151\x6f\156", "\163\x61\x6d\x6c\72\x41\165\x74\x68\156\103\157\156\x74\145\x78\164");
        $na->appendChild($PS);
        if (empty($this->authnContextClassRef)) {
            goto PC;
        }
        Utilities::addString($PS, "\165\162\x6e\x3a\x6f\x61\x73\x69\x73\72\156\x61\155\x65\163\x3a\x74\x63\72\123\101\115\114\x3a\62\56\60\72\x61\163\x73\x65\162\x74\151\x6f\156", "\x73\141\x6d\154\x3a\101\165\164\150\x6e\103\157\156\x74\145\x78\x74\103\x6c\141\163\x73\x52\x65\x66", $this->authnContextClassRef);
        PC:
        if (empty($this->authnContextDecl)) {
            goto kp;
        }
        $this->authnContextDecl->toXML($PS);
        kp:
        if (empty($this->authnContextDeclRef)) {
            goto CR;
        }
        Utilities::addString($PS, "\165\162\156\72\x6f\141\x73\x69\x73\72\156\141\x6d\145\x73\72\x74\143\72\x53\101\x4d\x4c\x3a\x32\56\60\x3a\141\x73\x73\x65\162\164\x69\157\x6e", "\163\141\x6d\154\72\x41\x75\164\150\x6e\x43\157\x6e\x74\145\x78\x74\x44\145\143\x6c\122\x65\x66", $this->authnContextDeclRef);
        CR:
        Utilities::addStrings($PS, "\x75\162\156\72\157\141\163\151\x73\x3a\x6e\x61\x6d\x65\x73\72\164\x63\x3a\x53\x41\115\x4c\x3a\x32\x2e\x30\72\x61\163\x73\145\162\164\151\157\x6e", "\x73\141\x6d\x6c\72\x41\165\164\x68\x65\156\164\x69\x63\141\164\151\156\x67\101\165\164\x68\x6f\x72\151\x74\x79", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $Si)
    {
        if (!empty($this->attributes)) {
            goto Xk;
        }
        return;
        Xk:
        $iv = $Si->ownerDocument;
        $VB = $iv->createElementNS("\165\162\156\72\x6f\x61\163\x69\163\x3a\156\x61\155\145\163\x3a\x74\143\72\x53\101\x4d\x4c\72\62\56\x30\x3a\141\x73\x73\145\162\164\151\x6f\156", "\163\141\155\x6c\x3a\x41\164\164\162\151\x62\165\x74\x65\x53\x74\141\x74\x65\x6d\145\156\164");
        $Si->appendChild($VB);
        foreach ($this->attributes as $LF => $eE) {
            $KN = $iv->createElementNS("\x75\x72\x6e\72\x6f\x61\x73\151\x73\72\156\x61\x6d\x65\x73\x3a\164\143\72\x53\x41\115\x4c\72\62\56\x30\72\x61\x73\x73\x65\x72\164\151\x6f\x6e", "\163\141\155\154\x3a\x41\164\x74\x72\151\142\x75\x74\x65");
            $VB->appendChild($KN);
            $KN->setAttribute("\116\141\155\145", $LF);
            if (!($this->nameFormat !== "\x75\162\156\x3a\157\x61\x73\x69\163\x3a\x6e\141\x6d\145\163\72\164\x63\x3a\123\x41\x4d\114\x3a\62\56\x30\72\141\x74\x74\162\156\x61\x6d\x65\x2d\x66\x6f\162\155\x61\164\72\165\156\163\160\x65\143\x69\x66\x69\145\144")) {
                goto YG;
            }
            $KN->setAttribute("\x4e\141\155\x65\106\x6f\162\x6d\141\x74", $this->nameFormat);
            YG:
            foreach ($eE as $OK) {
                if (is_string($OK)) {
                    goto qJ;
                }
                if (is_int($OK)) {
                    goto YK;
                }
                $hn = NULL;
                goto kA;
                qJ:
                $hn = "\170\x73\x3a\x73\164\x72\x69\156\x67";
                goto kA;
                YK:
                $hn = "\170\x73\x3a\x69\x6e\x74\145\x67\145\162";
                kA:
                $Xd = $iv->createElementNS("\165\162\156\x3a\157\141\163\151\163\72\x6e\141\155\145\x73\72\x74\x63\72\x53\x41\x4d\114\x3a\62\x2e\60\x3a\141\x73\x73\x65\x72\x74\x69\157\156", "\x73\141\155\154\x3a\101\164\x74\162\151\142\x75\x74\x65\126\x61\x6c\x75\145");
                $KN->appendChild($Xd);
                if (!($hn !== NULL)) {
                    goto o4;
                }
                $Xd->setAttributeNS("\150\x74\x74\x70\x3a\x2f\57\x77\x77\167\x2e\167\x33\x2e\157\162\x67\x2f\62\60\60\61\57\x58\115\x4c\123\143\150\145\x6d\141\x2d\x69\156\163\164\x61\x6e\143\x65", "\x78\x73\151\x3a\x74\171\160\x65", $hn);
                o4:
                if (!is_null($OK)) {
                    goto x6;
                }
                $Xd->setAttributeNS("\150\x74\x74\x70\72\57\57\167\167\x77\x2e\x77\x33\56\157\162\x67\x2f\x32\60\60\x31\x2f\130\115\114\x53\x63\x68\145\x6d\141\55\x69\x6e\x73\x74\x61\x6e\x63\145", "\170\x73\151\x3a\x6e\x69\x6c", "\x74\x72\x75\145");
                x6:
                if ($OK instanceof DOMNodeList) {
                    goto yY;
                }
                $Xd->appendChild($iv->createTextNode($OK));
                goto jt;
                yY:
                $no = 0;
                XW:
                if (!($no < $OK->length)) {
                    goto XH;
                }
                $Dw = $iv->importNode($OK->item($no), TRUE);
                $Xd->appendChild($Dw);
                T8:
                $no++;
                goto XW;
                XH:
                jt:
                ts:
            }
            Tk:
            np:
        }
        G1:
    }
    private function addEncryptedAttributeStatement(DOMElement $Si)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto FE;
        }
        return;
        FE:
        $iv = $Si->ownerDocument;
        $VB = $iv->createElementNS("\165\162\x6e\x3a\157\141\x73\151\163\x3a\156\x61\155\x65\x73\72\x74\x63\72\x53\x41\x4d\114\x3a\62\56\x30\72\141\x73\163\145\x72\x74\x69\157\x6e", "\163\x61\155\x6c\72\101\164\x74\162\151\x62\x75\x74\x65\123\164\x61\164\145\155\x65\x6e\164");
        $Si->appendChild($VB);
        foreach ($this->attributes as $LF => $eE) {
            $TB = new DOMDocument();
            $KN = $TB->createElementNS("\165\x72\x6e\x3a\x6f\x61\x73\x69\x73\x3a\x6e\x61\x6d\145\x73\72\164\x63\72\123\x41\115\114\x3a\x32\56\60\x3a\141\163\x73\x65\x72\164\151\x6f\x6e", "\163\x61\155\154\72\x41\164\x74\x72\x69\x62\x75\164\145");
            $KN->setAttribute("\x4e\x61\x6d\145", $LF);
            $TB->appendChild($KN);
            if (!($this->nameFormat !== "\165\162\x6e\x3a\x6f\x61\x73\x69\x73\72\156\141\x6d\145\x73\x3a\x74\143\x3a\123\x41\115\x4c\x3a\x32\56\60\72\141\x74\x74\162\x6e\141\155\x65\x2d\146\x6f\162\x6d\141\164\x3a\165\156\163\160\145\x63\x69\x66\x69\x65\144")) {
                goto xo;
            }
            $KN->setAttribute("\x4e\x61\155\145\106\x6f\x72\155\x61\164", $this->nameFormat);
            xo:
            foreach ($eE as $OK) {
                if (is_string($OK)) {
                    goto s9;
                }
                if (is_int($OK)) {
                    goto F8;
                }
                $hn = NULL;
                goto sm;
                s9:
                $hn = "\170\163\72\x73\x74\x72\x69\x6e\x67";
                goto sm;
                F8:
                $hn = "\x78\163\72\x69\156\164\x65\147\x65\162";
                sm:
                $Xd = $TB->createElementNS("\x75\162\x6e\x3a\x6f\141\163\x69\163\x3a\156\x61\x6d\x65\163\x3a\164\143\x3a\123\101\x4d\114\72\62\x2e\x30\x3a\141\163\x73\145\162\164\151\x6f\156", "\x73\x61\x6d\x6c\x3a\x41\164\x74\162\151\x62\165\x74\145\x56\141\x6c\x75\145");
                $KN->appendChild($Xd);
                if (!($hn !== NULL)) {
                    goto xV;
                }
                $Xd->setAttributeNS("\x68\x74\164\x70\x3a\57\x2f\x77\x77\167\x2e\167\63\56\157\162\147\57\x32\x30\x30\61\x2f\130\115\x4c\123\143\x68\145\x6d\x61\55\151\x6e\x73\164\141\x6e\143\145", "\x78\163\x69\x3a\164\x79\160\x65", $hn);
                xV:
                if ($OK instanceof DOMNodeList) {
                    goto j4;
                }
                $Xd->appendChild($TB->createTextNode($OK));
                goto aN;
                j4:
                $no = 0;
                Bc:
                if (!($no < $OK->length)) {
                    goto gf;
                }
                $Dw = $TB->importNode($OK->item($no), TRUE);
                $Xd->appendChild($Dw);
                j8:
                $no++;
                goto Bc;
                gf:
                aN:
                Xm:
            }
            Sk:
            $P5 = new XMLSecEnc();
            $P5->setNode($TB->documentElement);
            $P5->type = "\x68\164\164\160\72\57\x2f\167\x77\167\56\x77\63\x2e\x6f\x72\x67\x2f\x32\60\60\61\x2f\60\64\57\170\x6d\x6c\x65\x6e\143\x23\x45\x6c\x65\155\x65\x6e\164";
            $RX = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $RX->generateSessionKey();
            $P5->encryptKey($this->encryptionKey, $RX);
            $r4 = $P5->encryptNode($RX);
            $kp = $iv->createElementNS("\165\x72\156\x3a\157\141\163\151\x73\72\156\141\x6d\x65\x73\x3a\164\143\72\x53\101\x4d\x4c\x3a\x32\x2e\x30\x3a\141\x73\163\145\162\164\x69\x6f\156", "\163\x61\x6d\x6c\x3a\105\156\x63\x72\x79\160\164\x65\144\101\164\164\x72\151\x62\165\x74\x65");
            $VB->appendChild($kp);
            $Fp = $iv->importNode($r4, TRUE);
            $kp->appendChild($Fp);
            Cx:
        }
        TL:
    }
}
