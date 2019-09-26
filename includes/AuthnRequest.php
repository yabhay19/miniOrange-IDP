<?php


class AuthnRequest
{
    private $nameIdPolicy;
    private $forceAuthn;
    private $isPassive;
    private $RequesterID = array();
    private $assertionConsumerServiceURL;
    private $protocolBinding;
    private $requestedAuthnContext;
    private $namespaceURI;
    private $destination;
    private $issuer;
    private $version;
    private $issueInstant;
    private $requestID;
    public function __construct(DOMElement $Kz = null)
    {
        $this->nameIdPolicy = array();
        $this->forceAuthn = false;
        $this->isPassive = false;
        if (!($Kz === null)) {
            goto ki;
        }
        return;
        ki:
        $this->forceAuthn = Utilities::parseBoolean($Kz, "\x46\157\x72\x63\x65\101\x75\x74\x68\x6e", false);
        $this->isPassive = Utilities::parseBoolean($Kz, "\111\x73\x50\141\x73\163\x69\x76\x65", false);
        if (!$Kz->hasAttribute("\x41\x73\163\x65\162\x74\151\157\x6e\x43\157\156\x73\165\155\x65\x72\x53\145\x72\x76\x69\143\145\x55\122\x4c")) {
            goto ep;
        }
        $this->assertionConsumerServiceURL = $Kz->getAttribute("\101\163\x73\x65\162\x74\x69\157\156\103\157\156\163\x75\155\145\x72\x53\145\162\166\151\143\x65\125\122\114");
        ep:
        if (!$Kz->hasAttribute("\x50\x72\x6f\164\x6f\143\x6f\154\102\x69\x6e\x64\151\x6e\147")) {
            goto fw;
        }
        $this->protocolBinding = $Kz->getAttribute("\x50\x72\157\x74\x6f\x63\157\154\x42\x69\156\144\151\156\x67");
        fw:
        if (!$Kz->hasAttribute("\x41\164\x74\x72\x69\x62\165\164\x65\103\x6f\156\163\165\x6d\x69\156\x67\123\145\x72\x76\151\143\x65\x49\156\x64\145\170")) {
            goto vL;
        }
        $this->attributeConsumingServiceIndex = (int) $Kz->getAttribute("\101\x74\164\162\151\142\x75\164\x65\103\157\x6e\163\x75\155\x69\x6e\x67\x53\x65\162\166\151\143\x65\x49\156\144\145\170");
        vL:
        if (!$Kz->hasAttribute("\x41\163\x73\x65\x72\164\x69\x6f\x6e\x43\x6f\x6e\x73\x75\x6d\145\162\x53\x65\x72\x76\x69\143\x65\x49\156\x64\x65\170")) {
            goto cL;
        }
        $this->assertionConsumerServiceIndex = (int) $Kz->getAttribute("\101\163\x73\145\x72\164\151\x6f\156\x43\157\156\x73\x75\155\x65\x72\123\x65\x72\x76\x69\x63\145\111\x6e\x64\145\170");
        cL:
        if (!$Kz->hasAttribute("\x44\x65\163\164\151\156\141\x74\151\x6f\156")) {
            goto F3;
        }
        $this->destination = $Kz->getAttribute("\104\x65\163\164\x69\156\x61\x74\151\157\x6e");
        F3:
        if (!isset($Kz->namespaceURI)) {
            goto ii;
        }
        $this->namespaceURI = $Kz->namespaceURI;
        ii:
        if (!$Kz->hasAttribute("\x56\x65\162\x73\x69\157\156")) {
            goto QC;
        }
        $this->version = $Kz->getAttribute("\126\145\162\x73\x69\x6f\x6e");
        QC:
        if (!$Kz->hasAttribute("\x49\163\163\165\145\111\x6e\163\164\141\x6e\164")) {
            goto vH;
        }
        $this->issueInstant = $Kz->getAttribute("\111\163\x73\x75\145\x49\156\x73\164\141\156\x74");
        vH:
        if (!$Kz->hasAttribute("\111\104")) {
            goto Te;
        }
        $this->requestID = $Kz->getAttribute("\x49\104");
        Te:
        $this->parseNameIdPolicy($Kz);
        $this->parseIssuer($Kz);
        $this->parseRequestedAuthnContext($Kz);
        $this->parseScoping($Kz);
    }
    public function getNameIdPolicy()
    {
        return $this->nameIdPolicy;
    }
    public function getForceAuthn()
    {
        return $this->forceAuthn;
    }
    public function getVersion()
    {
        return $this->version;
    }
    public function getRequestID()
    {
        return $this->requestID;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function getIsPassive()
    {
        return $this->isPassive;
    }
    public function getIDPList()
    {
        return $this->IDPList;
    }
    public function getProxyCount()
    {
        return $this->ProxyCount;
    }
    public function getRequesterID()
    {
        return $this->RequesterID;
    }
    public function getNamespaceURI()
    {
        return $this->namespaceURI;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function getAssertionConsumerServiceURL()
    {
        return $this->assertionConsumerServiceURL;
    }
    public function getProtocolBinding()
    {
        return $this->protocolBinding;
    }
    public function getAttributeConsumingServiceIndex()
    {
        return $this->attributeConsumingServiceIndex;
    }
    public function getAssertionConsumerServiceIndex()
    {
        return $this->assertionConsumerServiceIndex;
    }
    public function getRequestedAuthnContext()
    {
        return $this->requestedAuthnContext;
    }
    protected function parseIssuer(DOMElement $Kz)
    {
        $Qn = Utilities::xpQuery($Kz, "\56\57\163\x61\155\x6c\137\x61\163\x73\x65\x72\x74\151\x6f\156\72\x49\x73\x73\165\x65\x72");
        if (!empty($Qn)) {
            goto m7;
        }
        throw new Exception("\x4d\x69\x73\x73\151\156\147\x20\x3c\163\x61\155\x6c\x3a\111\163\163\165\x65\x72\x3e\40\151\x6e\40\x61\163\163\x65\162\164\x69\x6f\156\x2e");
        m7:
        $this->issuer = trim($Qn[0]->textContent);
    }
    protected function parseNameIdPolicy(DOMElement $Kz)
    {
        $FH = Utilities::xpQuery($Kz, "\x2e\57\163\x61\155\x6c\137\x70\162\157\164\x6f\x63\x6f\x6c\x3a\x4e\141\155\x65\x49\x44\x50\x6f\x6c\151\143\x79");
        if (!empty($FH)) {
            goto IQ;
        }
        return;
        IQ:
        $FH = $FH[0];
        if (!$FH->hasAttribute("\106\x6f\x72\155\141\x74")) {
            goto Ca;
        }
        $this->nameIdPolicy["\x46\x6f\x72\x6d\141\x74"] = $FH->getAttribute("\106\157\x72\x6d\141\164");
        Ca:
        if (!$FH->hasAttribute("\x53\x50\116\141\155\x65\121\165\141\x6c\151\x66\151\145\x72")) {
            goto nw;
        }
        $this->nameIdPolicy["\123\x50\116\141\155\x65\121\165\x61\x6c\x69\x66\x69\x65\162"] = $FH->getAttribute("\x53\x50\116\x61\155\145\x51\x75\x61\154\x69\x66\151\145\x72");
        nw:
        if (!$FH->hasAttribute("\101\154\x6c\x6f\167\x43\162\x65\x61\x74\145")) {
            goto qm;
        }
        $this->nameIdPolicy["\101\x6c\x6c\x6f\x77\103\162\x65\x61\x74\x65"] = Utilities::parseBoolean($FH, "\101\154\154\x6f\x77\103\x72\x65\x61\x74\x65", false);
        qm:
    }
    protected function parseRequestedAuthnContext(DOMElement $Kz)
    {
        $lf = Utilities::xpQuery($Kz, "\x2e\x2f\163\141\155\154\x5f\160\162\x6f\164\x6f\143\x6f\154\72\x52\x65\161\x75\x65\163\164\145\144\x41\165\x74\150\x6e\103\157\x6e\164\145\170\164");
        if (!empty($lf)) {
            goto uC;
        }
        return;
        uC:
        $lf = $lf[0];
        $Rl = array("\x41\165\x74\150\156\x43\157\x6e\164\x65\x78\x74\x43\x6c\x61\163\x73\122\145\146" => array(), "\103\x6f\x6d\x70\x61\162\151\x73\x6f\x6e" => "\145\x78\141\x63\164");
        $l_ = Utilities::xpQuery($lf, "\56\57\x73\x61\155\154\137\x61\x73\163\x65\162\x74\x69\157\x6e\x3a\x41\x75\x74\150\156\103\157\156\x74\x65\x78\x74\103\154\141\163\x73\x52\145\146");
        foreach ($l_ as $no) {
            $Rl["\x41\165\x74\x68\x6e\103\157\156\x74\x65\170\164\x43\154\x61\x73\x73\x52\x65\146"][] = trim($no->textContent);
            TQ:
        }
        Q1:
        if (!$lf->hasAttribute("\103\x6f\x6d\x70\141\162\x69\x73\x6f\156")) {
            goto Xa;
        }
        $Rl["\103\x6f\155\160\141\x72\x69\163\157\156"] = $lf->getAttribute("\x43\x6f\155\160\x61\162\x69\163\157\156");
        Xa:
        $this->requestedAuthnContext = $Rl;
    }
    protected function parseScoping(DOMElement $Kz)
    {
        $qF = Utilities::xpQuery($Kz, "\56\57\163\x61\155\x6c\x5f\x70\162\x6f\164\x6f\143\157\154\x3a\x53\143\x6f\160\x69\x6e\x67");
        if (!empty($qF)) {
            goto Qy;
        }
        return;
        Qy:
        $qF = $qF[0];
        if (!$qF->hasAttribute("\120\x72\157\x78\x79\x43\x6f\165\156\164")) {
            goto lM;
        }
        $this->ProxyCount = (int) $qF->getAttribute("\x50\x72\157\170\x79\x43\x6f\x75\156\164");
        lM:
        $hO = Utilities::xpQuery($qF, "\x2e\57\x73\141\x6d\x6c\137\x70\x72\x6f\164\157\143\x6f\154\72\x49\x44\x50\x4c\x69\x73\164\x2f\x73\141\x6d\x6c\x5f\160\x72\x6f\164\157\143\157\x6c\72\111\104\120\105\156\x74\x72\171");
        foreach ($hO as $pD) {
            if ($pD->hasAttribute("\x50\162\157\166\x69\144\145\162\111\104")) {
                goto Ch;
            }
            throw new Exception("\103\x6f\165\x6c\144\x20\156\x6f\164\x20\x67\x65\x74\40\x50\x72\157\x76\x69\x64\x65\162\111\x44\40\146\162\x6f\155\x20\123\x63\157\x70\x69\156\x67\x2f\111\x44\120\105\x6e\x74\162\171\40\x65\x6c\x65\x6d\145\x6e\x74\x20\151\x6e\40\x41\x75\164\x68\156\122\145\x71\165\x65\163\x74\x20\x6f\x62\x6a\145\143\164");
            Ch:
            $this->IDPList[] = $pD->getAttribute("\120\162\x6f\166\151\x64\x65\162\111\104");
            Cj:
        }
        RC:
        $lu = Utilities::xpQuery($qF, "\x2e\57\x73\141\155\x6c\137\x70\x72\x6f\x74\x6f\143\x6f\154\72\x52\145\x71\165\x65\163\164\145\x72\111\x44");
        foreach ($lu as $jE) {
            $this->RequesterID[] = trim($jE->textContent);
            G4:
        }
        kn:
    }
}
