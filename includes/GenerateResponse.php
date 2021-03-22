<?php


class GenerateResponse
{
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
    function __construct($kY, $HZ, $xD, $SB, $kw, $AZ = null, $dF = null, $h_ = null, $K5 = null, $F_ = null, $m0 = array(), $LB = '', $aC = null)
    {
        $this->xml = new DOMDocument("\x31\x2e\60", "\x75\164\x66\55\70");
        $this->acsUrl = $xD;
        $this->issuer = $SB;
        $this->audience = $kw;
        $this->email = $kY;
        $this->username = $HZ;
        $this->name_id_attr = $AZ;
        $this->name_id_attr_format = $LB;
        $this->mo_idp_response_signed = $dF;
        $this->mo_idp_assertion_signed = $h_;
        $this->mo_idp_encrypted_assertion = $K5;
        $this->mo_idp_cert_encrypt = $F_;
        $this->attributes = $m0;
        $this->inResponseTo = $aC;
    }
    function createSamlResponse()
    {
        $this->licenseCheck();
        $S8 = $this->getResponseParams();
        $fP = $this->createResponseElement($S8);
        $this->xml->appendChild($fP);
        $SB = $this->buildIssuer();
        $fP->appendChild($SB);
        $QP = $this->buildStatus();
        $fP->appendChild($QP);
        $Ml = $this->buildStatusCode();
        $QP->appendChild($Ml);
        $NV = $this->buildAssertion($S8);
        $fP->appendChild($NV);
        $K7 = '';
        $K7 = variable_get("\x6d\x69\156\151\157\162\x61\156\x67\145\137\x73\x61\x6d\154\x5f\151\144\x70\x5f\x70\x72\151\x76\x61\164\145\x5f\143\145\162\164\151\146\x69\x63\141\164\145");
        if (!$this->mo_idp_assertion_signed) {
            goto yG;
        }
        if (!empty($K7)) {
            goto Cc;
        }
        $nP = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\x65\x73\x6f\165\x72\x63\x65\x73" . DIRECTORY_SEPARATOR . "\151\144\160\x2d\163\x69\147\x6e\151\x6e\147\x2e\153\x65\x79";
        goto YE;
        Cc:
        $nP = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\x65\x73\x6f\x75\x72\x63\145\x73" . DIRECTORY_SEPARATOR . "\x43\x75\163\164\157\155\137\120\162\151\166\141\164\x65\x5f\103\x65\162\164\151\x66\151\143\141\164\145\x2e\153\x65\x79";
        YE:
        $this->signNode($nP, $NV, $this->subject, $S8);
        yG:
        if (!$this->mo_idp_encrypted_assertion) {
            goto Lp;
        }
        $K0 = $this->buildEncryptedAssertion($NV);
        $fP->removeChild($NV);
        $fP->appendChild($K0);
        Lp:
        if (!$this->mo_idp_response_signed) {
            goto yY;
        }
        if (!empty($K7)) {
            goto xL;
        }
        $nP = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\145\x73\157\165\162\143\x65\163" . DIRECTORY_SEPARATOR . "\151\x64\160\x2d\x73\151\147\x6e\151\156\147\x2e\153\145\x79";
        goto HB;
        xL:
        $nP = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\x75\162\x63\145\x73" . DIRECTORY_SEPARATOR . "\103\x75\x73\164\157\x6d\x5f\120\162\151\x76\x61\164\145\137\x43\x65\x72\x74\x69\x66\x69\143\141\x74\145\x2e\153\x65\171";
        HB:
        $this->signNode($nP, $fP, $QP, $S8);
        yY:
        $qN = $this->xml->saveXML();
        return $qN;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $zq = NULL)
    {
        $this->encryptionKey = $zq;
    }
    function getResponseParams()
    {
        $S8 = array();
        $lP = time();
        $S8["\111\x73\163\165\145\x49\x6e\x73\164\x61\156\164"] = str_replace("\53\60\60\72\x30\60", "\132", gmdate("\143", $lP));
        $S8["\x4e\x6f\x74\x4f\156\x4f\162\x41\x66\x74\145\x72"] = str_replace("\x2b\x30\x30\72\x30\x30", "\x5a", gmdate("\143", $lP + 300));
        $S8["\x4e\157\x74\x42\145\x66\x6f\x72\145"] = str_replace("\53\x30\x30\72\x30\60", "\x5a", gmdate("\x63", $lP - 30));
        $S8["\x41\x75\164\150\x6e\x49\x6e\163\x74\141\x6e\x74"] = str_replace("\53\x30\x30\x3a\x30\x30", "\132", gmdate("\143", $lP - 120));
        $S8["\x53\145\163\x73\x69\157\x6e\116\157\x74\x4f\156\117\162\x41\x66\164\145\162"] = str_replace("\53\60\x30\x3a\x30\60", "\x5a", gmdate("\143", $lP + 3600 * 8));
        $S8["\111\x44"] = $this->generateUniqueID(40);
        $S8["\x41\163\163\145\x72\x74\111\104"] = $this->generateUniqueID(40);
        $S8["\111\x73\163\165\145\x72"] = $this->issuer;
        $Ej = '';
        $Ej = variable_get("\155\x69\x6e\x69\157\162\x61\x6e\x67\145\137\163\x61\x6d\x6c\x5f\151\x64\x70\x5f\160\x75\x62\x6c\x5f\143\145\162\164\x69\146\x69\143\141\x74\x65");
        if ($Ej != '') {
            goto qi;
        }
        $X8 = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\x75\162\x63\145\163" . DIRECTORY_SEPARATOR . "\151\144\x70\55\163\151\x67\156\151\156\x67\x2e\143\162\x74";
        goto ur;
        qi:
        $X8 = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\162\x65\163\x6f\165\162\143\x65\x73" . DIRECTORY_SEPARATOR . "\x43\x75\163\x74\x6f\155\x5f\120\165\142\x6c\x69\x63\x5f\103\145\x72\x74\x69\146\151\x63\x61\164\x65\x2e\x63\x72\x74";
        ur:
        $Ab = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\171\x70\145" => "\x70\165\142\154\x69\143"));
        $Ab->loadKey($X8, TRUE, TRUE);
        $S8["\170\65\x30\71"] = $Ab->getX509Certificate();
        $S8["\101\164\x74\x72\x69\x62\165\x74\x65\x73"] = $this->attributes;
        return $S8;
    }
    function createResponseElement($S8)
    {
        $fP = $this->xml->createElementNS("\x75\162\x6e\72\157\x61\x73\151\163\72\156\x61\155\x65\x73\72\x74\x63\x3a\x53\x41\x4d\x4c\72\62\x2e\60\72\160\x72\x6f\x74\x6f\143\x6f\x6c", "\x73\141\155\x6c\x70\72\122\x65\x73\x70\157\156\x73\145");
        $fP->setAttribute("\111\104", $S8["\x49\104"]);
        $fP->setAttribute("\126\145\x72\163\x69\157\156", "\62\56\60");
        $fP->setAttribute("\x49\163\163\165\x65\111\156\163\x74\141\156\x74", $S8["\111\x73\x73\165\x65\111\x6e\x73\x74\141\156\x74"]);
        $fP->setAttribute("\x44\145\163\164\151\156\x61\x74\x69\157\x6e", $this->acsUrl);
        if (!(isset($this->inResponseTo) && !is_null($this->inResponseTo))) {
            goto yp;
        }
        $fP->setAttribute("\111\156\x52\x65\163\160\x6f\156\163\x65\x54\157", $this->inResponseTo);
        yp:
        return $fP;
    }
    function buildIssuer()
    {
        $SB = $this->xml->createElementNS("\165\162\156\x3a\x6f\x61\x73\151\163\x3a\156\141\x6d\145\x73\72\x74\143\72\x53\101\115\114\72\62\x2e\x30\72\141\163\163\145\x72\x74\x69\x6f\156", "\x73\x61\x6d\x6c\x3a\111\163\x73\x75\x65\x72", $this->issuer);
        return $SB;
    }
    function buildStatus()
    {
        $QP = $this->xml->createElementNS("\x75\162\x6e\x3a\157\x61\x73\151\x73\x3a\156\x61\x6d\x65\163\x3a\x74\143\x3a\123\101\x4d\x4c\x3a\x32\x2e\60\72\x70\162\157\x74\x6f\x63\x6f\154", "\163\x61\155\154\x70\x3a\123\x74\x61\164\165\163");
        return $QP;
    }
    function buildStatusCode()
    {
        $Ml = $this->xml->createElementNS("\x75\162\156\x3a\x6f\x61\x73\x69\x73\x3a\x6e\x61\x6d\145\x73\72\164\x63\72\x53\101\115\x4c\x3a\x32\56\60\72\160\x72\157\x74\157\x63\157\x6c", "\x73\141\155\154\x70\x3a\x53\x74\141\164\x75\x73\x43\157\144\x65");
        $Ml->setAttribute("\126\x61\x6c\x75\145", "\x75\162\156\x3a\x6f\x61\x73\151\163\x3a\x6e\x61\x6d\145\x73\72\164\x63\x3a\123\101\115\114\x3a\62\56\x30\72\x73\164\x61\164\165\x73\72\123\x75\x63\143\x65\163\163");
        return $Ml;
    }
    function buildAssertion($S8)
    {
        $NV = $this->xml->createElementNS("\x75\162\x6e\x3a\x6f\x61\x73\x69\163\x3a\156\141\155\x65\163\72\164\x63\72\123\x41\x4d\114\72\x32\56\x30\x3a\141\163\163\145\x72\164\x69\x6f\x6e", "\163\141\x6d\154\72\101\x73\163\145\162\x74\x69\157\x6e");
        $NV->setAttribute("\x49\104", $S8["\101\163\x73\145\162\x74\111\x44"]);
        $NV->setAttribute("\x49\163\163\165\x65\111\156\x73\164\141\x6e\x74", $S8["\x49\x73\163\165\145\x49\x6e\163\x74\141\x6e\164"]);
        $NV->setAttribute("\x56\x65\162\163\x69\157\x6e", "\62\56\x30");
        $SB = $this->buildIssuer($S8);
        $NV->appendChild($SB);
        $R1 = $this->buildSubject($S8);
        $this->subject = $R1;
        $NV->appendChild($R1);
        $tZ = $this->buildCondition($S8);
        $NV->appendChild($tZ);
        $Hn = $this->buildAuthnStatement($S8);
        $NV->appendChild($Hn);
        $m0 = $S8["\101\x74\x74\x72\x69\x62\x75\x74\x65\163"];
        if (empty($m0)) {
            goto JG;
        }
        $O9 = $this->buildAttrStatement($S8);
        $NV->appendChild($O9);
        JG:
        return $NV;
    }
    function buildSubject($S8)
    {
        $R1 = $this->xml->createElement("\163\141\155\154\x3a\123\165\x62\x6a\145\143\x74");
        $iC = $this->buildNameIdentifier();
        $R1->appendChild($iC);
        $L7 = $this->buildSubjectConfirmation($S8);
        $R1->appendChild($L7);
        return $R1;
    }
    function buildNameIdentifier()
    {
        if ($this->name_id_attr === "\x65\155\x61\x69\x6c\x41\144\x64\162\x65\x73\x73") {
            goto S9;
        }
        $iC = $this->xml->createElement("\163\x61\x6d\x6c\x3a\116\141\x6d\x65\x49\104", $this->username);
        goto Cq;
        S9:
        $iC = $this->xml->createElement("\163\141\x6d\x6c\72\116\x61\155\x65\111\x44", $this->email);
        Cq:
        if (empty($this->name_id_attr_format)) {
            goto Ls;
        }
        $iC->setAttribute("\106\x6f\x72\x6d\141\x74", "\x75\162\156\72\x6f\x61\x73\151\163\x3a\156\141\x6d\x65\163\72\164\x63\x3a\x53\x41\x4d\114\72" . $this->name_id_attr_format);
        goto ac;
        Ls:
        $iC->setAttribute("\106\x6f\162\155\141\x74", "\x75\x72\x6e\72\157\x61\x73\151\163\72\x6e\x61\x6d\145\x73\72\164\x63\72\123\101\115\x4c\72\61\x2e\61\72\x6e\141\x6d\x65\x69\144\x2d\146\x6f\x72\x6d\141\164\72\145\x6d\x61\151\154\x41\144\x64\162\145\x73\163");
        ac:
        $iC->setAttribute("\123\120\116\x61\x6d\x65\x51\165\141\154\151\x66\x69\x65\162", $this->audience);
        return $iC;
    }
    function buildSubjectConfirmation($S8)
    {
        $L7 = $this->xml->createElement("\x73\141\155\x6c\x3a\x53\165\x62\152\x65\143\x74\x43\157\x6e\x66\151\162\155\141\164\151\157\156");
        $L7->setAttribute("\115\145\164\150\x6f\144", "\x75\162\156\72\x6f\141\163\x69\x73\72\x6e\x61\x6d\x65\163\x3a\x74\143\72\123\x41\x4d\x4c\72\62\56\x30\72\143\155\72\x62\145\141\162\145\x72");
        $Jo = $this->getSubjectConfirmationData($S8);
        $L7->appendChild($Jo);
        return $L7;
    }
    function getSubjectConfirmationData($S8)
    {
        $Jo = $this->xml->createElement("\163\141\x6d\154\72\123\165\x62\x6a\x65\x63\x74\x43\x6f\x6e\x66\151\162\155\x61\x74\x69\157\x6e\104\x61\x74\x61");
        $Jo->setAttribute("\116\157\164\x4f\156\x4f\x72\x41\x66\x74\145\162", $S8["\x4e\x6f\164\x4f\x6e\x4f\162\101\x66\164\x65\162"]);
        $Jo->setAttribute("\x52\x65\x63\151\x70\151\145\x6e\x74", $this->acsUrl);
        if (!(isset($this->inResponseTo) && !is_null($this->inResponseTo))) {
            goto hV;
        }
        $Jo->setAttribute("\x49\x6e\122\x65\163\160\157\156\x73\145\x54\x6f", $this->inResponseTo);
        hV:
        return $Jo;
    }
    function buildCondition($S8)
    {
        $tZ = $this->xml->createElement("\x73\141\155\154\72\x43\x6f\156\144\x69\x74\151\157\x6e\x73");
        $tZ->setAttribute("\116\157\x74\102\145\x66\157\x72\145", $S8["\x4e\157\x74\x42\x65\146\157\x72\x65"]);
        $tZ->setAttribute("\116\x6f\164\117\x6e\117\162\x41\146\x74\x65\162", $S8["\x4e\x6f\164\x4f\156\117\162\x41\x66\x74\x65\162"]);
        $z3 = $this->buildAudienceRestriction();
        $tZ->appendChild($z3);
        return $tZ;
    }
    function buildAudienceRestriction()
    {
        $z3 = $this->xml->createElement("\x73\141\155\x6c\72\101\x75\x64\x69\x65\x6e\143\x65\122\145\x73\x74\162\x69\x63\x74\151\x6f\156");
        $kw = $this->xml->createElement("\x73\141\155\x6c\72\101\165\144\151\x65\x6e\x63\x65", $this->audience);
        $z3->appendChild($kw);
        return $z3;
    }
    function buildAuthnStatement($S8)
    {
        $Hn = $this->xml->createElement("\x73\141\155\154\x3a\x41\165\x74\x68\156\x53\x74\x61\164\145\155\x65\156\x74");
        $Hn->setAttribute("\101\165\164\150\156\111\x6e\x73\164\x61\156\x74", $S8["\101\165\164\150\x6e\111\x6e\163\x74\x61\156\x74"]);
        $Hn->setAttribute("\x53\145\163\163\151\x6f\x6e\111\156\144\145\170", "\x5f" . $this->generateUniqueID(30));
        $Hn->setAttribute("\123\x65\x73\x73\x69\157\156\116\x6f\164\x4f\x6e\x4f\x72\101\146\164\x65\x72", $S8["\123\x65\163\x73\151\157\x6e\116\157\164\117\x6e\117\162\x41\146\164\145\x72"]);
        $b9 = $this->xml->createElement("\x73\141\155\154\x3a\x41\165\164\150\x6e\x43\x6f\x6e\164\145\x78\x74");
        $rp = $this->xml->createElement("\x73\x61\155\x6c\72\x41\165\164\150\x6e\103\157\156\x74\x65\x78\164\103\154\141\163\163\122\x65\146", "\x75\162\x6e\72\x6f\x61\163\x69\x73\72\156\141\155\145\163\72\x74\143\x3a\123\x41\115\x4c\72\x32\x2e\x30\x3a\141\x63\72\143\x6c\141\x73\x73\x65\x73\72\120\141\x73\x73\x77\157\x72\x64\x50\x72\157\164\145\143\164\145\x64\x54\x72\x61\x6e\x73\160\x6f\162\164");
        $b9->appendChild($rp);
        $Hn->appendChild($b9);
        return $Hn;
    }
    function buildAttrStatement($S8)
    {
        $O9 = $this->xml->createElement("\x73\141\155\x6c\x3a\101\x74\164\x72\x69\142\165\164\x65\123\x74\x61\164\145\x6d\x65\x6e\164");
        $Js = $S8["\101\x74\x74\x72\151\x62\x75\164\145\x73"];
        foreach ($Js as $KC => $aw) {
            $tv = $this->buildAttribute($KC, $aw);
            $O9->appendChild($tv);
            YZ:
        }
        GP:
        return $O9;
    }
    function buildAttribute($jA, $Jh)
    {
        $tv = $this->xml->createElement("\x73\141\x6d\154\x3a\101\164\164\162\x69\142\165\164\145");
        $tv->setAttribute("\x4e\141\x6d\145", $jA);
        $tv->setAttribute("\116\x61\155\145\106\x6f\162\x6d\141\164", "\x75\162\x6e\x3a\x6f\x61\x73\x69\x73\72\156\141\x6d\145\x73\x3a\x74\143\x3a\123\x41\x4d\114\x3a\62\x2e\60\x3a\x61\x74\x74\x72\156\x61\155\145\55\146\157\162\x6d\141\x74\72\x62\x61\163\x69\x63");
        if (is_array($Jh)) {
            goto Uk;
        }
        $Vn = $this->xml->createElement("\163\141\155\154\72\x41\x74\164\162\x69\142\165\164\x65\x56\x61\x6c\165\x65", $Jh);
        $tv->appendChild($Vn);
        goto Vw;
        Uk:
        foreach ($Jh as $Nv => $kQ) {
            $Vn = $this->xml->createElement("\x73\x61\x6d\x6c\72\101\x74\164\x72\x69\142\165\164\x65\126\x61\154\x75\145", $kQ);
            $tv->appendChild($Vn);
            gg:
        }
        f0:
        Vw:
        return $tv;
    }
    function buildEncryptedAssertion($NV)
    {
        $K0 = $this->xml->createElementNS("\165\x72\x6e\72\157\141\x73\x69\163\72\x6e\141\155\145\x73\x3a\x74\x63\72\123\101\x4d\114\x3a\x32\x2e\x30\72\x61\x73\x73\145\x72\164\x69\x6f\x6e", "\163\141\155\154\160\72\x45\x6e\143\162\x79\x70\164\145\144\x41\x73\163\x65\162\x74\151\157\156");
        $dl = $this->buildEncryptedData($NV);
        $K0->appendChild($K0->ownerDocument->importNode($dl, TRUE));
        return $K0;
    }
    function buildEncryptedData($NV)
    {
        $dl = new XMLSecEnc();
        $dl->setNode($NV);
        $dl->type = "\150\x74\164\x70\72\57\x2f\167\x77\167\x2e\x77\63\x2e\157\x72\147\x2f\x32\60\60\61\57\60\64\57\x78\x6d\x6c\145\x6e\143\x23\105\154\145\155\x65\x6e\164";
        $iw = $this->mo_idp_cert_encrypt;
        $R_ = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\x79\x70\x65" => "\160\165\x62\154\x69\143"));
        $R_->loadKey($iw, FALSE, TRUE);
        $this->setEncryptionKey($R_);
        $Lp = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $Lp->generateSessionKey();
        $dl->encryptKey($this->encryptionKey, $Lp);
        $dk = $dl->encryptNode($Lp, FALSE);
        return $dk;
    }
    function signNode($nP, $B9, $R1, $S8)
    {
        $Ab = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\x79\160\x65" => "\160\162\x69\x76\x61\164\x65"));
        $Ab->loadKey($nP, TRUE);
        $So = new XMLSecurityDSig();
        $So->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $So->addReferenceList(array($B9), XMLSecurityDSig::SHA256, array("\x68\164\x74\x70\72\x2f\x2f\x77\x77\x77\56\x77\x33\x2e\157\162\147\x2f\62\x30\x30\x30\57\x30\x39\x2f\x78\155\x6c\x64\x73\151\147\x23\145\156\166\145\x6c\x6f\x70\x65\144\55\x73\151\x67\156\141\164\165\x72\x65", XMLSecurityDSig::EXC_C14N), array("\151\x64\x5f\x6e\141\155\145" => "\x49\104", "\157\166\145\x72\x77\162\151\164\145" => false));
        $So->sign($Ab);
        $So->add509Cert($S8["\x78\x35\x30\x39"]);
        $So->insertSignature($B9, $R1);
    }
    function generateUniqueID($CP)
    {
        $Mn = "\141\x62\143\x64\145\146\60\61\x32\63\x34\x35\66\67\70\71";
        $iA = strlen($Mn);
        $r1 = '';
        $RJ = 0;
        V3:
        if (!($RJ < $CP)) {
            goto y2;
        }
        $r1 .= substr($Mn, rand(0, 15), 1);
        oF:
        $RJ++;
        goto V3;
        y2:
        return "\x61" . $r1;
    }
    function licenseCheck()
    {
        global $base_url;
        $ek = db_select("\155\151\156\151\x6f\162\141\156\147\x65\137\163\141\x6d\154\137\x69\x64\160\137\x75\x73\145\162", "\x55\163\145\x72\111\x6e")->fields("\125\163\x65\162\111\x6e")->condition("\x6d\x61\151\x6c", $this->email, "\x3d")->execute()->fetchAssoc();
        $G3 = $ek["\x55\163\145\162\x49\x6e"];
        $ZO = new MiniorangeSAMLIdpCustomer(NULL, NULL, NULL, NULL);
        $UL = variable_get("\155\151\156\151\x4f\x72\141\x6e\x67\145\137\163\x61\155\154\137\x69\144\160\137\165\163\x65\162\x5f\x63\x6f\x75\156\164");
        $cO = variable_get("\155\151\x6e\151\117\162\x61\156\147\x65\x5f\163\x61\x6d\x6c\x5f\151\x64\x70\137\154\x5f\x65\170\x70");
        $dT = variable_get("\x74\x65\x5f\x63\157\165\x6e\164");
        $PE = variable_get("\165\145\x5f\x63\157\x75\156\164");
        $Dm = variable_get("\144\x63\150\x65\x63\153");
        $i2 = variable_get("\x74\155\160\137\145\x78\160");
        $ek = db_select("\x6d\151\156\151\x6f\x72\141\x6e\147\145\137\x73\x61\155\x6c\137\x69\x64\x70\x5f\x75\163\x65\x72", "\x55\163\x65\x72\111\156")->fields("\125\163\x65\162\111\x6e")->condition("\x55\163\x65\162\x49\156", 1, "\x3d")->execute();
        $sk = $ek->rowCount();
        $LC = date("\131\55\115\55\144\x20\x28\x6c\x29\x20\150\x3a\151\x3a\x73\141", $cO);
        if (!($cO > time())) {
            goto Rc;
        }
        $vP = $cO - time();
        $Gi = (int) ($vP / 60 / 60 / 24);
        Rc:
        if (time() > $cO + 2592000) {
            goto uv;
        }
        if (time() >= $cO - 2592000 && $dT == 0) {
            goto AU;
        }
        if (time() >= $cO - 1296000 && $dT == 1) {
            goto sE;
        }
        if (time() >= $cO - 432000 && $dT == 2) {
            goto md;
        }
        if (time() >= $cO && $dT == 3) {
            goto I2;
        }
        if (!(time() >= $cO + 1296000 && $dT == 4)) {
            goto aP;
        }
        if (Utilities::licensevalidity($cO)) {
            goto rL;
        }
        $dT++;
        variable_set("\x74\145\137\143\x6f\165\x6e\164", $dT);
        Utilities::dexdmid($LC);
        goto sG;
        rL:
        $dT = 0;
        variable_set("\164\x65\137\x63\x6f\165\156\164", $dT);
        sG:
        aP:
        goto YG;
        I2:
        if (Utilities::licensevalidity($cO)) {
            goto bo;
        }
        $dT++;
        variable_set("\164\x65\137\143\157\x75\x6e\164", $dT);
        Utilities::limit($LC);
        goto il;
        bo:
        $dT = 0;
        variable_set("\164\145\137\143\x6f\165\x6e\x74", $dT);
        il:
        YG:
        goto tU;
        md:
        if (Utilities::licensevalidity($cO)) {
            goto p0;
        }
        $dT++;
        variable_set("\x74\x65\137\x63\x6f\165\x6e\x74", $dT);
        Utilities::dayleft($Gi);
        goto ba;
        p0:
        $dT = 0;
        variable_set("\x74\x65\137\143\x6f\x75\x6e\x74", $dT);
        ba:
        tU:
        goto zU;
        sE:
        if (Utilities::licensevalidity($cO)) {
            goto Mb;
        }
        $dT++;
        variable_set("\164\x65\x5f\x63\157\165\x6e\x74", $dT);
        Utilities::dayleft($Gi);
        goto sj;
        Mb:
        $dT = 0;
        variable_set("\x74\145\137\x63\157\165\156\164", $dT);
        sj:
        zU:
        goto G6;
        AU:
        $dT++;
        variable_set("\x74\x65\x5f\143\x6f\165\x6e\x74", $dT);
        Utilities::dayleft($Gi);
        G6:
        goto zI;
        uv:
        if (Utilities::licensevalidity($cO)) {
            goto mo;
        }
        Utilities::dexdend($LC);
        $zt = db_update("\x6d\151\156\x69\x6f\162\x61\x6e\x67\x65\137\x73\141\x6d\x6c\x5f\151\144\160\137\165\x73\145\162")->fields(array("\125\163\145\162\111\156" => 0))->execute();
        Utilities::freeLicenseKey();
        header("\x4c\x6f\x63\x61\164\x69\x6f\x6e\x3a\x20" . $base_url);
        goto EU;
        mo:
        $dT = 0;
        variable_set("\x74\145\x5f\x63\157\165\x6e\164", $dT);
        EU:
        zI:
        if ($G3) {
            goto LC;
        }
        if ($sk >= $UL) {
            goto hH;
        }
        $ek = db_select("\x6d\151\x6e\151\x6f\x72\141\156\147\145\137\163\x61\155\x6c\x5f\x69\144\160\137\x75\x73\145\x72", "\125\x73\x65\162\x49\156")->fields("\x55\x73\145\x72\111\x6e")->condition("\155\x61\x69\154", $this->email, "\x3d")->execute();
        $tS = $ek->rowCount();
        if ($tS > 0) {
            goto LA;
        }
        db_insert("\155\x69\156\151\x6f\x72\141\156\147\x65\137\x73\x61\155\154\x5f\x69\144\x70\137\x75\x73\145\x72")->fields(array("\x6d\141\151\154" => $this->email, "\125\163\x65\x72\111\x6e" => 1))->execute();
        goto yA;
        LA:
        $zt = db_update("\155\x69\x6e\151\x6f\x72\141\x6e\x67\145\137\x73\141\x6d\154\137\x69\x64\x70\137\165\x73\x65\x72")->fields(array("\125\163\145\162\x49\x6e" => 1))->condition("\x6d\x61\x69\x6c", $this->email, "\x3d")->execute();
        yA:
        $sk = $sk + 1;
        $ET = floor($UL * 0.8);
        $aK = floor($UL * 0.9);
        if ($sk == $ET) {
            goto vO;
        }
        if ($sk == $aK) {
            goto qR;
        }
        if ($UL - $sk == 10) {
            goto R7;
        }
        if (!($sk == $UL)) {
            goto pH;
        }
        if (Utilities::checkupdate($UL)) {
            goto nQ;
        }
        $Dm = 0;
        variable_set("\x64\x63\150\x65\x63\x6b", $Dm);
        variable_set("\164\155\x70\137\145\170\160", time() + 2592000);
        Utilities::limitreach($UL, $sk);
        goto Pz;
        nQ:
        return;
        Pz:
        pH:
        goto vd;
        R7:
        if (Utilities::checkupdate($UL)) {
            goto o5;
        }
        Utilities::tenuser($UL, $sk);
        goto sh;
        o5:
        return;
        sh:
        vd:
        goto FN1;
        qR:
        if (Utilities::checkupdate($UL)) {
            goto QJ;
        }
        Utilities::peruser(90, $UL);
        goto fe;
        QJ:
        return;
        fe:
        FN1:
        goto FC;
        vO:
        Utilities::peruser(80, $UL);
        FC:
        goto J8;
        hH:
        $lV = abs($i2 - time()) / 60 / 60 / 24;
        if (!($lV != $Dm)) {
            goto Cp;
        }
        if (!Utilities::checkupdate($UL)) {
            goto hI;
        }
        variable_set("\165\145\137\143\157\165\156\164", 0);
        $ek = db_select("\155\x69\156\x69\157\x72\141\x6e\147\145\137\x73\x61\x6d\x6c\137\x69\x64\x70\137\x75\163\x65\162", "\x55\163\145\x72\x49\x6e")->fields("\x55\163\x65\x72\x49\156")->condition("\x6d\141\151\x6c", $this->email, "\x3d")->execute();
        $tS = $ek->rowCount();
        if ($tS > 0) {
            goto Ra;
        }
        db_insert("\155\151\156\151\157\x72\141\156\147\x65\x5f\x73\x61\155\154\x5f\x69\144\160\137\165\163\145\162")->fields(array("\x6d\141\x69\154" => $this->email, "\x55\x73\145\162\111\x6e" => 1))->execute();
        goto EF;
        Ra:
        $zt = db_update("\x6d\151\x6e\x69\x6f\162\141\x6e\x67\145\137\x73\x61\x6d\154\x5f\151\144\x70\137\x75\163\145\162")->fields(array("\x55\x73\x65\x72\x49\156" => 1))->condition("\155\x61\151\154", $this->email, "\75")->execute();
        EF:
        hI:
        variable_set("\144\143\150\145\x63\x6b", $lV);
        Cp:
        if (time() < $i2) {
            goto tN;
        }
        if (!($PE == 1)) {
            goto LE;
        }
        Utilities::limitend($UL);
        $PE++;
        variable_set("\x75\x65\137\143\157\x75\156\164", $PE);
        LE:
        echo "\x53\123\117\40\x46\141\151\154\x65\144\56\40\115\x61\x78\x69\x6d\165\155\40\x6c\x69\155\151\x74\x20\162\x65\x61\143\150\145\x64\56\40\x50\x6c\x65\141\x73\x65\x20\x63\x6f\x6e\x74\141\x63\164\40\x79\x6f\x75\162\40\101\x64\x6d\x69\x6e\151\x73\x74\x72\141\x74\x6f\162\x20\x66\157\x72\40\155\x6f\162\145\x20\x64\145\x74\141\151\x6c\x73\x2e";
        die;
        goto so;
        tN:
        if (!(time() > $i2 - 1296000 && $PE == 0)) {
            goto I5;
        }
        Utilities::limitmid($UL);
        $PE++;
        variable_set("\x75\145\x5f\x63\x6f\165\x6e\164", $PE);
        I5:
        return;
        so:
        J8:
        goto kq;
        LC:
        return;
        kq:
    }
}
