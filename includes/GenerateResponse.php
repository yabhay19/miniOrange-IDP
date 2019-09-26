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
    function __construct($uN, $Xe, $lH, $Qn, $O9, $Mi = null, $KK = null, $Sy = null, $N6 = null, $WQ = null, $Fc = array(), $Xs = '', $w8 = null)
    {
        $this->xml = new DOMDocument("\x31\56\60", "\165\x74\146\55\70");
        $this->acsUrl = $lH;
        $this->issuer = $Qn;
        $this->audience = $O9;
        $this->email = $uN;
        $this->username = $Xe;
        $this->name_id_attr = $Mi;
        $this->name_id_attr_format = $Xs;
        $this->mo_idp_response_signed = $KK;
        $this->mo_idp_assertion_signed = $Sy;
        $this->mo_idp_encrypted_assertion = $N6;
        $this->mo_idp_cert_encrypt = $WQ;
        $this->attributes = $Fc;
        $this->inResponseTo = $w8;
    }
    function createSamlResponse()
    {
        $this->licenseCheck();
        $Y1 = $this->getResponseParams();
        $Jx = $this->createResponseElement($Y1);
        $this->xml->appendChild($Jx);
        $Qn = $this->buildIssuer();
        $Jx->appendChild($Qn);
        $YW = $this->buildStatus();
        $Jx->appendChild($YW);
        $vU = $this->buildStatusCode();
        $YW->appendChild($vU);
        $KE = $this->buildAssertion($Y1);
        $Jx->appendChild($KE);
        $NM = '';
        $NM = variable_get("\155\x69\x6e\x69\x6f\x72\141\x6e\147\145\x5f\163\x61\x6d\154\137\x69\144\x70\x5f\x70\x72\151\x76\141\x74\145\x5f\x63\x65\162\164\x69\146\x69\x63\141\x74\145");
        if (!$this->mo_idp_assertion_signed) {
            goto Ja;
        }
        if (!empty($NM)) {
            goto s7;
        }
        $BW = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\165\x72\143\145\x73" . DIRECTORY_SEPARATOR . "\x69\x64\160\55\163\x69\147\156\151\x6e\x67\x2e\x6b\x65\171";
        goto TD;
        s7:
        $BW = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\163\157\165\162\143\145\163" . DIRECTORY_SEPARATOR . "\x43\x75\x73\x74\x6f\155\137\x50\x72\x69\166\x61\x74\145\137\103\145\162\164\x69\x66\151\x63\x61\164\145\56\x6b\x65\x79";
        TD:
        $this->signNode($BW, $KE, $this->subject, $Y1);
        Ja:
        if (!$this->mo_idp_encrypted_assertion) {
            goto dk;
        }
        $B8 = $this->buildEncryptedAssertion($KE);
        $Jx->removeChild($KE);
        $Jx->appendChild($B8);
        dk:
        if (!$this->mo_idp_response_signed) {
            goto Ag;
        }
        if (!empty($NM)) {
            goto nO;
        }
        $BW = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\x65\x73\157\x75\x72\x63\x65\163" . DIRECTORY_SEPARATOR . "\x69\x64\160\x2d\163\x69\x67\x6e\x69\x6e\147\56\x6b\145\171";
        goto zA;
        nO:
        $BW = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\163\x6f\x75\x72\143\x65\x73" . DIRECTORY_SEPARATOR . "\x43\x75\x73\164\157\x6d\137\x50\162\151\x76\x61\164\145\137\x43\145\162\164\151\146\x69\x63\x61\164\145\x2e\x6b\x65\x79";
        zA:
        $this->signNode($BW, $Jx, $YW, $Y1);
        Ag:
        $SO = $this->xml->saveXML();
        return $SO;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $z8 = NULL)
    {
        $this->encryptionKey = $z8;
    }
    function getResponseParams()
    {
        $Y1 = array();
        $aZ = time();
        $Y1["\111\163\163\x75\x65\x49\x6e\x73\x74\141\156\x74"] = str_replace("\53\60\60\72\x30\x30", "\x5a", gmdate("\x63", $aZ));
        $Y1["\x4e\157\x74\x4f\x6e\x4f\x72\x41\146\x74\145\162"] = str_replace("\x2b\x30\x30\x3a\x30\x30", "\x5a", gmdate("\x63", $aZ + 300));
        $Y1["\116\157\164\102\145\146\157\x72\145"] = str_replace("\53\60\x30\72\60\60", "\x5a", gmdate("\x63", $aZ - 30));
        $Y1["\101\x75\164\150\156\111\156\163\164\141\x6e\x74"] = str_replace("\x2b\x30\60\x3a\x30\60", "\x5a", gmdate("\x63", $aZ - 120));
        $Y1["\123\145\163\163\x69\157\156\116\x6f\164\117\156\117\x72\x41\146\164\145\162"] = str_replace("\53\60\60\x3a\x30\x30", "\x5a", gmdate("\x63", $aZ + 3600 * 8));
        $Y1["\x49\x44"] = $this->generateUniqueID(40);
        $Y1["\x41\x73\x73\x65\162\x74\111\104"] = $this->generateUniqueID(40);
        $Y1["\x49\x73\163\x75\145\162"] = $this->issuer;
        $Wl = '';
        $Wl = variable_get("\x6d\151\156\151\x6f\162\x61\x6e\x67\145\137\163\x61\x6d\x6c\137\151\144\160\x5f\x70\x75\x62\154\137\143\145\x72\x74\x69\x66\x69\x63\x61\x74\x65");
        if ($Wl != '') {
            goto xm;
        }
        $qJ = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\x75\x72\143\x65\163" . DIRECTORY_SEPARATOR . "\x69\x64\160\55\x73\x69\x67\156\x69\x6e\x67\56\x63\162\x74";
        goto YQ;
        xm:
        $qJ = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "\x72\145\x73\x6f\165\162\143\145\163" . DIRECTORY_SEPARATOR . "\103\165\163\x74\157\155\x5f\x50\x75\x62\x6c\151\143\137\x43\145\x72\164\151\x66\151\143\x61\x74\145\x2e\x63\162\164";
        YQ:
        $GY = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\x74\171\160\145" => "\x70\x75\142\154\x69\143"));
        $GY->loadKey($qJ, TRUE, TRUE);
        $Y1["\170\x35\60\71"] = $GY->getX509Certificate();
        $Y1["\101\x74\x74\162\x69\x62\x75\x74\x65\x73"] = $this->attributes;
        return $Y1;
    }
    function createResponseElement($Y1)
    {
        $Jx = $this->xml->createElementNS("\165\162\156\x3a\x6f\141\163\x69\163\x3a\156\x61\x6d\145\163\72\x74\143\x3a\123\101\x4d\114\72\x32\56\60\x3a\x70\x72\157\x74\157\143\157\154", "\x73\141\155\x6c\160\72\x52\x65\x73\160\157\156\x73\x65");
        $Jx->setAttribute("\x49\104", $Y1["\x49\104"]);
        $Jx->setAttribute("\x56\x65\x72\163\151\x6f\x6e", "\62\x2e\x30");
        $Jx->setAttribute("\x49\163\163\x75\x65\111\x6e\163\164\x61\156\164", $Y1["\x49\x73\x73\165\145\x49\156\x73\x74\141\x6e\164"]);
        $Jx->setAttribute("\104\x65\x73\x74\151\x6e\141\164\151\157\156", $this->acsUrl);
        if (!(isset($this->inResponseTo) && !is_null($this->inResponseTo))) {
            goto YZ;
        }
        $Jx->setAttribute("\x49\156\122\145\163\x70\x6f\x6e\x73\145\124\x6f", $this->inResponseTo);
        YZ:
        return $Jx;
    }
    function buildIssuer()
    {
        $Qn = $this->xml->createElementNS("\165\x72\x6e\72\157\141\163\x69\163\72\156\x61\155\145\163\x3a\x74\143\x3a\x53\101\115\x4c\72\x32\x2e\x30\x3a\141\163\x73\x65\x72\164\151\157\156", "\163\x61\x6d\154\x3a\x49\x73\163\x75\x65\x72", $this->issuer);
        return $Qn;
    }
    function buildStatus()
    {
        $YW = $this->xml->createElementNS("\165\x72\x6e\72\157\x61\163\x69\x73\72\156\141\x6d\145\x73\72\164\143\72\123\101\115\x4c\x3a\x32\56\x30\72\160\x72\x6f\164\x6f\x63\x6f\x6c", "\x73\141\155\154\160\72\x53\164\x61\x74\x75\x73");
        return $YW;
    }
    function buildStatusCode()
    {
        $vU = $this->xml->createElementNS("\x75\x72\x6e\72\157\x61\x73\151\163\x3a\x6e\x61\155\145\x73\72\164\x63\x3a\123\101\115\114\x3a\x32\56\x30\72\x70\162\157\164\x6f\x63\157\154", "\163\x61\x6d\x6c\x70\x3a\x53\164\141\164\x75\163\103\157\144\145");
        $vU->setAttribute("\x56\141\x6c\165\x65", "\165\x72\x6e\x3a\x6f\x61\163\x69\x73\72\x6e\141\155\145\163\72\x74\143\72\123\101\x4d\114\x3a\x32\x2e\x30\72\163\164\x61\x74\x75\163\x3a\123\x75\x63\x63\x65\x73\x73");
        return $vU;
    }
    function buildAssertion($Y1)
    {
        $KE = $this->xml->createElementNS("\165\x72\x6e\x3a\x6f\141\163\151\x73\x3a\156\x61\155\x65\x73\72\164\x63\72\123\x41\x4d\x4c\x3a\62\x2e\x30\72\141\163\163\145\x72\x74\151\x6f\x6e", "\163\x61\155\x6c\72\101\163\163\145\x72\x74\151\x6f\156");
        $KE->setAttribute("\111\104", $Y1["\101\x73\163\145\162\164\x49\104"]);
        $KE->setAttribute("\111\163\163\x75\x65\111\156\163\x74\141\156\x74", $Y1["\111\x73\x73\x75\145\x49\156\163\164\x61\156\x74"]);
        $KE->setAttribute("\x56\145\x72\163\151\157\x6e", "\x32\x2e\x30");
        $Qn = $this->buildIssuer($Y1);
        $KE->appendChild($Qn);
        $dg = $this->buildSubject($Y1);
        $this->subject = $dg;
        $KE->appendChild($dg);
        $k0 = $this->buildCondition($Y1);
        $KE->appendChild($k0);
        $vl = $this->buildAuthnStatement($Y1);
        $KE->appendChild($vl);
        $Fc = $Y1["\101\x74\x74\x72\151\x62\x75\164\x65\163"];
        if (empty($Fc)) {
            goto v7;
        }
        $b0 = $this->buildAttrStatement($Y1);
        $KE->appendChild($b0);
        v7:
        return $KE;
    }
    function buildSubject($Y1)
    {
        $dg = $this->xml->createElement("\x73\x61\155\154\x3a\123\x75\142\152\x65\143\x74");
        $bJ = $this->buildNameIdentifier();
        $dg->appendChild($bJ);
        $u4 = $this->buildSubjectConfirmation($Y1);
        $dg->appendChild($u4);
        return $dg;
    }
    function buildNameIdentifier()
    {
        if ($this->name_id_attr === "\x65\x6d\x61\x69\x6c\x41\x64\x64\x72\145\163\x73") {
            goto df;
        }
        $bJ = $this->xml->createElement("\163\x61\x6d\154\72\x4e\141\155\x65\x49\x44", $this->username);
        goto Bo;
        df:
        $bJ = $this->xml->createElement("\163\141\155\x6c\72\116\x61\x6d\145\111\104", $this->email);
        Bo:
        if (empty($this->name_id_attr_format)) {
            goto wy;
        }
        $bJ->setAttribute("\x46\157\x72\155\141\x74", "\165\x72\156\x3a\157\x61\x73\151\x73\72\156\141\155\145\163\72\164\143\72\123\x41\x4d\114\x3a" . $this->name_id_attr_format);
        goto wf;
        wy:
        $bJ->setAttribute("\106\157\x72\155\141\x74", "\165\x72\x6e\x3a\x6f\x61\163\x69\163\72\x6e\141\x6d\145\x73\72\x74\x63\x3a\x53\101\x4d\114\72\61\56\61\x3a\x6e\141\155\x65\x69\x64\55\146\x6f\x72\x6d\141\164\x3a\x65\155\x61\151\154\x41\144\x64\162\145\163\163");
        wf:
        $bJ->setAttribute("\123\120\x4e\x61\x6d\145\121\x75\x61\154\151\146\x69\x65\162", $this->audience);
        return $bJ;
    }
    function buildSubjectConfirmation($Y1)
    {
        $u4 = $this->xml->createElement("\163\x61\x6d\154\72\x53\165\142\x6a\145\143\164\x43\x6f\156\x66\x69\162\x6d\x61\164\151\157\x6e");
        $u4->setAttribute("\115\145\x74\150\157\144", "\165\162\156\x3a\x6f\141\163\x69\163\x3a\156\x61\155\145\163\x3a\164\x63\x3a\x53\101\115\114\72\x32\56\60\72\x63\155\x3a\x62\x65\141\162\145\x72");
        $NN = $this->getSubjectConfirmationData($Y1);
        $u4->appendChild($NN);
        return $u4;
    }
    function getSubjectConfirmationData($Y1)
    {
        $NN = $this->xml->createElement("\163\141\155\154\x3a\x53\165\142\152\x65\x63\164\103\x6f\x6e\x66\x69\162\155\x61\164\x69\157\156\x44\x61\164\141");
        $NN->setAttribute("\x4e\x6f\164\x4f\x6e\117\x72\x41\146\x74\145\162", $Y1["\116\157\x74\x4f\x6e\117\x72\101\x66\x74\145\x72"]);
        $NN->setAttribute("\x52\145\x63\x69\160\151\145\156\164", $this->acsUrl);
        if (!(isset($this->inResponseTo) && !is_null($this->inResponseTo))) {
            goto TR;
        }
        $NN->setAttribute("\111\156\122\x65\x73\160\157\x6e\163\145\124\x6f", $this->inResponseTo);
        TR:
        return $NN;
    }
    function buildCondition($Y1)
    {
        $k0 = $this->xml->createElement("\163\x61\155\154\x3a\103\x6f\x6e\x64\151\164\151\157\x6e\163");
        $k0->setAttribute("\x4e\x6f\164\102\x65\146\157\x72\145", $Y1["\116\x6f\x74\102\x65\146\157\x72\x65"]);
        $k0->setAttribute("\116\157\164\x4f\x6e\x4f\x72\x41\x66\164\x65\x72", $Y1["\116\x6f\164\x4f\x6e\x4f\162\101\x66\164\x65\162"]);
        $PE = $this->buildAudienceRestriction();
        $k0->appendChild($PE);
        return $k0;
    }
    function buildAudienceRestriction()
    {
        $PE = $this->xml->createElement("\163\141\155\154\72\x41\165\x64\151\x65\156\143\x65\x52\145\x73\x74\x72\x69\x63\x74\151\x6f\x6e");
        $O9 = $this->xml->createElement("\163\x61\x6d\154\x3a\x41\165\x64\151\145\x6e\143\x65", $this->audience);
        $PE->appendChild($O9);
        return $PE;
    }
    function buildAuthnStatement($Y1)
    {
        $vl = $this->xml->createElement("\163\x61\x6d\154\x3a\x41\x75\x74\150\156\123\164\x61\164\x65\155\145\156\x74");
        $vl->setAttribute("\x41\x75\x74\x68\156\111\156\163\164\141\156\x74", $Y1["\x41\x75\164\150\x6e\x49\156\x73\164\x61\156\x74"]);
        $vl->setAttribute("\x53\x65\163\163\x69\157\x6e\111\156\x64\x65\170", "\x5f" . $this->generateUniqueID(30));
        $vl->setAttribute("\123\x65\163\163\x69\x6f\156\x4e\x6f\x74\x4f\x6e\x4f\162\101\x66\164\145\162", $Y1["\x53\x65\x73\163\x69\157\x6e\x4e\x6f\164\x4f\156\117\162\101\x66\x74\x65\162"]);
        $OU = $this->xml->createElement("\x73\x61\x6d\154\x3a\x41\165\164\150\156\103\157\156\x74\145\170\164");
        $IK = $this->xml->createElement("\163\141\x6d\x6c\72\101\x75\164\x68\156\103\157\x6e\164\x65\170\164\x43\154\141\x73\x73\122\x65\x66", "\x75\162\x6e\72\157\x61\163\x69\163\72\x6e\141\155\x65\163\x3a\164\143\x3a\123\101\x4d\114\72\62\56\x30\x3a\141\x63\72\x63\154\x61\x73\163\x65\x73\x3a\x50\x61\x73\163\167\x6f\162\x64\120\x72\x6f\164\145\143\x74\x65\x64\x54\x72\x61\156\x73\160\157\162\x74");
        $OU->appendChild($IK);
        $vl->appendChild($OU);
        return $vl;
    }
    function buildAttrStatement($Y1)
    {
        $b0 = $this->xml->createElement("\x73\141\155\x6c\72\101\x74\x74\x72\x69\142\165\164\145\x53\164\141\x74\x65\x6d\145\x6e\x74");
        $gb = $Y1["\101\164\164\162\x69\x62\x75\164\145\163"];
        foreach ($gb as $Y7 => $OK) {
            $ya = $this->buildAttribute($Y7, $OK);
            $b0->appendChild($ya);
            HJ:
        }
        UC:
        return $b0;
    }
    function buildAttribute($Jp, $lY)
    {
        $ya = $this->xml->createElement("\x73\x61\155\154\x3a\101\164\x74\x72\x69\x62\x75\x74\x65");
        $ya->setAttribute("\116\x61\x6d\x65", $Jp);
        $ya->setAttribute("\x4e\141\155\145\x46\157\162\x6d\x61\164", "\165\162\x6e\72\157\141\x73\x69\x73\72\x6e\141\x6d\145\x73\72\x74\143\72\123\101\115\x4c\72\62\x2e\x30\72\x61\164\164\162\156\141\x6d\145\55\x66\157\162\x6d\x61\x74\72\x62\x61\163\151\143");
        if (is_array($lY)) {
            goto GC;
        }
        $Gb = $this->xml->createElement("\x73\141\155\x6c\x3a\x41\x74\164\162\x69\142\x75\164\x65\x56\141\154\165\145", $lY);
        $ya->appendChild($Gb);
        goto e1;
        GC:
        foreach ($lY as $p1 => $Vo) {
            $Gb = $this->xml->createElement("\163\141\155\154\72\101\x74\x74\x72\x69\x62\165\x74\x65\x56\x61\x6c\165\145", $Vo);
            $ya->appendChild($Gb);
            sK:
        }
        w7:
        e1:
        return $ya;
    }
    function buildEncryptedAssertion($KE)
    {
        $B8 = $this->xml->createElementNS("\x75\x72\x6e\x3a\157\141\x73\x69\163\72\x6e\x61\x6d\145\163\72\164\143\72\x53\101\x4d\x4c\x3a\x32\x2e\x30\72\141\163\163\x65\x72\164\151\x6f\x6e", "\163\141\x6d\x6c\x70\x3a\x45\156\x63\162\x79\x70\164\x65\144\x41\x73\x73\x65\x72\x74\151\x6f\x6e");
        $BZ = $this->buildEncryptedData($KE);
        $B8->appendChild($B8->ownerDocument->importNode($BZ, TRUE));
        return $B8;
    }
    function buildEncryptedData($KE)
    {
        $BZ = new XMLSecEnc();
        $BZ->setNode($KE);
        $BZ->type = "\150\164\164\x70\72\x2f\57\x77\167\x77\56\x77\63\56\157\x72\147\x2f\x32\60\x30\x31\x2f\x30\64\x2f\x78\x6d\154\x65\x6e\143\43\x45\154\145\155\x65\x6e\x74";
        $Py = $this->mo_idp_cert_encrypt;
        $Bc = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\x79\x70\x65" => "\160\x75\x62\x6c\151\143"));
        $Bc->loadKey($Py, FALSE, TRUE);
        $this->setEncryptionKey($Bc);
        $RX = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
        $RX->generateSessionKey();
        $BZ->encryptKey($this->encryptionKey, $RX);
        $r4 = $BZ->encryptNode($RX, FALSE);
        return $r4;
    }
    function signNode($BW, $Dw, $dg, $Y1)
    {
        $GY = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array("\164\x79\x70\145" => "\160\162\x69\166\x61\x74\x65"));
        $GY->loadKey($BW, TRUE);
        $e2 = new XMLSecurityDSig();
        $e2->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $e2->addReferenceList(array($Dw), XMLSecurityDSig::SHA256, array("\x68\164\x74\x70\72\x2f\x2f\167\x77\167\x2e\x77\x33\x2e\157\x72\147\57\62\60\60\x30\x2f\x30\71\x2f\x78\x6d\154\144\163\x69\147\43\145\x6e\x76\145\154\x6f\x70\x65\144\x2d\x73\x69\x67\156\141\x74\165\x72\145", XMLSecurityDSig::EXC_C14N), array("\x69\144\x5f\156\141\x6d\145" => "\x49\104", "\157\x76\145\162\x77\162\x69\164\x65" => false));
        $e2->sign($GY);
        $e2->add509Cert($Y1["\170\x35\60\x39"]);
        $e2->insertSignature($Dw, $dg);
    }
    function generateUniqueID($I7)
    {
        $Iu = "\x61\x62\x63\x64\145\146\x30\61\x32\x33\64\x35\x36\67\x38\71";
        $RG = strlen($Iu);
        $yd = '';
        $no = 0;
        tp:
        if (!($no < $I7)) {
            goto DF;
        }
        $yd .= substr($Iu, rand(0, 15), 1);
        ra:
        $no++;
        goto tp;
        DF:
        return "\141" . $yd;
    }
    function licenseCheck()
    {
        global $base_url;
        $QL = db_select("\155\x69\156\x69\x6f\x72\x61\156\x67\x65\137\x73\x61\x6d\154\x5f\151\144\x70\x5f\x75\163\145\162", "\x55\163\x65\162\111\x6e")->fields("\125\163\145\x72\111\x6e")->condition("\155\x61\x69\x6c", $this->email, "\75")->execute()->fetchAssoc();
        $pH = $QL["\x55\163\145\162\111\156"];
        $E2 = new MiniorangeSAMLIdpCustomer(NULL, NULL, NULL, NULL);
        $Sr = variable_get("\x6d\x69\x6e\151\117\162\141\156\147\145\x5f\163\x61\155\x6c\137\x69\144\x70\137\x75\163\x65\162\137\143\x6f\165\x6e\x74");
        $Ob = variable_get("\155\x69\x6e\151\117\162\x61\156\x67\x65\x5f\x73\141\155\154\x5f\x69\x64\160\x5f\154\137\145\170\160");
        $aX = variable_get("\164\145\x5f\x63\x6f\x75\156\164");
        $yo = variable_get("\165\x65\137\143\x6f\165\156\164");
        $UP = variable_get("\144\x63\150\145\x63\x6b");
        $Xi = variable_get("\164\x6d\160\x5f\145\170\x70");
        $QL = db_select("\x6d\151\156\x69\157\162\141\x6e\147\145\137\163\141\x6d\x6c\x5f\x69\x64\x70\137\x75\163\145\x72", "\125\x73\x65\x72\111\x6e")->fields("\125\163\x65\162\x49\x6e")->condition("\x55\x73\145\162\111\156", 1, "\75")->execute();
        $wT = $QL->rowCount();
        $a9 = date("\x59\x2d\x4d\x2d\144\40\x28\154\x29\x20\150\x3a\x69\72\163\141", $Ob);
        if (!($Ob > time())) {
            goto FR;
        }
        $eO = $Ob - time();
        $TD = (int) ($eO / 60 / 60 / 24);
        FR:
        if (time() > $Ob + 2592000) {
            goto OT;
        }
        if (time() >= $Ob - 2592000 && $aX == 0) {
            goto n3;
        }
        if (time() >= $Ob - 1296000 && $aX == 1) {
            goto JD;
        }
        if (time() >= $Ob - 432000 && $aX == 2) {
            goto WJ;
        }
        if (time() >= $Ob && $aX == 3) {
            goto Go;
        }
        if (!(time() >= $Ob + 1296000 && $aX == 4)) {
            goto VE;
        }
        if (Utilities::licensevalidity($Ob)) {
            goto mT;
        }
        $aX++;
        variable_set("\x74\145\x5f\x63\x6f\165\156\164", $aX);
        Utilities::dexdmid($a9);
        goto vZ;
        mT:
        $aX = 0;
        variable_set("\x74\x65\137\x63\x6f\x75\x6e\164", $aX);
        vZ:
        VE:
        goto r5;
        Go:
        if (Utilities::licensevalidity($Ob)) {
            goto ax;
        }
        $aX++;
        variable_set("\164\x65\137\x63\x6f\165\x6e\x74", $aX);
        Utilities::limit($a9);
        goto dX;
        ax:
        $aX = 0;
        variable_set("\x74\145\x5f\143\x6f\165\x6e\164", $aX);
        dX:
        r5:
        goto Ct;
        WJ:
        if (Utilities::licensevalidity($Ob)) {
            goto J7;
        }
        $aX++;
        variable_set("\164\x65\137\143\x6f\165\x6e\x74", $aX);
        Utilities::dayleft($TD);
        goto dI;
        J7:
        $aX = 0;
        variable_set("\x74\145\137\x63\x6f\165\156\x74", $aX);
        dI:
        Ct:
        goto SZ;
        JD:
        if (Utilities::licensevalidity($Ob)) {
            goto gU;
        }
        $aX++;
        variable_set("\x74\145\137\x63\x6f\x75\x6e\164", $aX);
        Utilities::dayleft($TD);
        goto Ip;
        gU:
        $aX = 0;
        variable_set("\164\x65\x5f\x63\x6f\x75\156\x74", $aX);
        Ip:
        SZ:
        goto WC;
        n3:
        $aX++;
        variable_set("\x74\x65\137\143\157\165\156\164", $aX);
        Utilities::dayleft($TD);
        WC:
        goto ko;
        OT:
        if (Utilities::licensevalidity($Ob)) {
            goto an;
        }
        Utilities::dexdend($a9);
        $AH = db_update("\x6d\x69\156\x69\157\162\x61\x6e\147\x65\x5f\163\x61\155\154\x5f\x69\144\x70\x5f\165\x73\145\162")->fields(array("\x55\x73\145\162\x49\x6e" => 0))->execute();
        Utilities::freeLicenseKey();
        header("\114\157\143\x61\164\x69\157\156\72\40" . $base_url);
        goto DK;
        an:
        $aX = 0;
        variable_set("\164\145\x5f\x63\157\165\156\x74", $aX);
        DK:
        ko:
        if ($pH) {
            goto VS;
        }
        if ($wT >= $Sr) {
            goto Ur;
        }
        $QL = db_select("\x6d\x69\156\x69\157\162\141\x6e\147\145\137\163\141\155\x6c\137\x69\x64\160\137\x75\163\145\x72", "\x55\163\x65\162\111\x6e")->fields("\125\x73\x65\162\x49\156")->condition("\x6d\x61\x69\154", $this->email, "\75")->execute();
        $uG = $QL->rowCount();
        if ($uG > 0) {
            goto Yl;
        }
        db_insert("\155\151\156\x69\157\x72\141\156\x67\145\x5f\163\x61\155\x6c\x5f\x69\144\x70\137\165\163\x65\x72")->fields(array("\x6d\141\x69\x6c" => $this->email, "\125\x73\145\x72\111\156" => 1))->execute();
        goto gQ;
        Yl:
        $AH = db_update("\x6d\x69\x6e\151\x6f\162\x61\156\x67\145\137\163\x61\x6d\x6c\x5f\151\x64\160\137\165\x73\145\162")->fields(array("\x55\x73\x65\x72\111\156" => 1))->condition("\155\x61\151\154", $this->email, "\x3d")->execute();
        gQ:
        $wT = $wT + 1;
        $CL = floor($Sr * 0.8);
        $pB = floor($Sr * 0.9);
        if ($wT == $CL) {
            goto ad;
        }
        if ($wT == $pB) {
            goto G6;
        }
        if ($Sr - $wT == 10) {
            goto Xj;
        }
        if (!($wT == $Sr)) {
            goto kM;
        }
        if (Utilities::checkupdate($Sr)) {
            goto N2;
        }
        $UP = 0;
        variable_set("\144\x63\x68\x65\143\x6b", $UP);
        variable_set("\x74\x6d\x70\x5f\x65\170\160", time() + 2592000);
        Utilities::limitreach($Sr, $wT);
        goto sx;
        N2:
        return;
        sx:
        kM:
        goto FD;
        Xj:
        if (Utilities::checkupdate($Sr)) {
            goto Zg;
        }
        Utilities::tenuser($Sr, $wT);
        goto Wp;
        Zg:
        return;
        Wp:
        FD:
        goto gz;
        G6:
        if (Utilities::checkupdate($Sr)) {
            goto eo;
        }
        Utilities::peruser(90, $Sr);
        goto u0;
        eo:
        return;
        u0:
        gz:
        goto OK;
        ad:
        Utilities::peruser(80, $Sr);
        OK:
        goto ef;
        Ur:
        $xO = abs($Xi - time()) / 60 / 60 / 24;
        if (!($xO != $UP)) {
            goto Ng;
        }
        if (!Utilities::checkupdate($Sr)) {
            goto nM;
        }
        variable_set("\x75\x65\x5f\143\157\x75\156\x74", 0);
        $QL = db_select("\155\151\x6e\x69\157\x72\141\156\x67\x65\137\163\141\155\154\x5f\x69\x64\160\137\165\163\x65\x72", "\x55\163\145\x72\111\x6e")->fields("\125\x73\x65\x72\111\156")->condition("\155\x61\151\x6c", $this->email, "\x3d")->execute();
        $uG = $QL->rowCount();
        if ($uG > 0) {
            goto BI;
        }
        db_insert("\x6d\151\x6e\151\157\162\x61\x6e\147\145\x5f\x73\141\x6d\x6c\x5f\x69\x64\x70\137\x75\x73\145\162")->fields(array("\155\x61\151\x6c" => $this->email, "\x55\x73\x65\x72\x49\x6e" => 1))->execute();
        goto Ic;
        BI:
        $AH = db_update("\x6d\151\x6e\x69\x6f\162\x61\x6e\147\145\x5f\163\141\155\x6c\137\x69\144\160\x5f\x75\163\x65\x72")->fields(array("\x55\163\145\162\x49\x6e" => 1))->condition("\155\x61\151\x6c", $this->email, "\75")->execute();
        Ic:
        nM:
        variable_set("\144\143\150\x65\x63\153", $xO);
        Ng:
        if (time() < $Xi) {
            goto Xe;
        }
        if (!($yo == 1)) {
            goto AN;
        }
        Utilities::limitend($Sr);
        $yo++;
        variable_set("\x75\145\137\143\x6f\x75\156\x74", $yo);
        AN:
        echo "\x53\x53\x4f\x20\x46\x61\x69\x6c\145\144\56\40\115\141\170\x69\x6d\x75\155\40\154\x69\155\x69\164\x20\162\x65\x61\143\150\x65\x64\56\40\x50\154\x65\141\x73\145\x20\x63\157\x6e\x74\141\143\x74\x20\x79\157\165\162\40\101\x64\x6d\151\156\x69\x73\x74\162\x61\x74\157\162\x20\x66\157\162\x20\155\x6f\162\x65\40\144\x65\164\x61\151\154\x73\x2e";
        die;
        goto hg;
        Xe:
        if (!(time() > $Xi - 1296000 && $yo == 0)) {
            goto Ht;
        }
        Utilities::limitmid($Sr);
        $yo++;
        variable_set("\x75\x65\x5f\x63\x6f\165\x6e\164", $yo);
        Ht:
        return;
        hg:
        ef:
        goto nT;
        VS:
        return;
        nT:
    }
}
