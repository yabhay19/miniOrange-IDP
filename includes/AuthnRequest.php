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
    public function __construct(DOMElement $vM = null)
    {
        $this->nameIdPolicy = array();
        $this->forceAuthn = false;
        $this->isPassive = false;
        if (!($vM === null)) {
            goto fn1;
        }
        return;
        fn1:
        $this->forceAuthn = Utilities::parseBoolean($vM, "\x46\x6f\x72\143\145\101\x75\x74\x68\x6e", false);
        $this->isPassive = Utilities::parseBoolean($vM, "\111\x73\120\141\x73\x73\151\166\145", false);
        if (!$vM->hasAttribute("\101\x73\x73\x65\162\x74\x69\x6f\x6e\x43\157\x6e\163\x75\155\x65\162\123\145\162\x76\151\143\145\125\x52\114")) {
            goto wW;
        }
        $this->assertionConsumerServiceURL = $vM->getAttribute("\x41\163\x73\145\x72\x74\x69\x6f\x6e\x43\x6f\156\163\x75\155\145\x72\x53\145\x72\166\151\x63\145\x55\x52\x4c");
        wW:
        if (!$vM->hasAttribute("\x50\162\157\x74\157\x63\157\x6c\102\151\x6e\144\x69\156\x67")) {
            goto hp;
        }
        $this->protocolBinding = $vM->getAttribute("\x50\x72\x6f\x74\157\143\157\x6c\x42\x69\156\x64\x69\156\x67");
        hp:
        if (!$vM->hasAttribute("\x41\x74\164\162\x69\142\165\x74\145\x43\x6f\156\x73\x75\x6d\151\156\147\123\145\x72\166\x69\143\x65\111\156\x64\x65\170")) {
            goto i0;
        }
        $this->attributeConsumingServiceIndex = (int) $vM->getAttribute("\x41\164\164\162\x69\142\x75\x74\x65\103\x6f\x6e\163\x75\x6d\x69\x6e\x67\x53\x65\162\166\x69\x63\145\x49\156\144\x65\x78");
        i0:
        if (!$vM->hasAttribute("\x41\163\163\x65\162\164\151\157\x6e\103\x6f\x6e\163\x75\x6d\145\x72\123\x65\x72\x76\151\x63\x65\111\x6e\144\x65\x78")) {
            goto eT;
        }
        $this->assertionConsumerServiceIndex = (int) $vM->getAttribute("\x41\163\x73\145\162\x74\x69\157\156\103\157\156\x73\165\155\145\x72\x53\x65\x72\166\x69\143\x65\x49\x6e\x64\x65\170");
        eT:
        if (!$vM->hasAttribute("\104\145\163\164\x69\x6e\x61\x74\x69\157\156")) {
            goto hD;
        }
        $this->destination = $vM->getAttribute("\104\145\163\x74\x69\156\141\x74\x69\157\156");
        hD:
        if (!isset($vM->namespaceURI)) {
            goto f6;
        }
        $this->namespaceURI = $vM->namespaceURI;
        f6:
        if (!$vM->hasAttribute("\x56\x65\162\x73\151\157\156")) {
            goto Ld;
        }
        $this->version = $vM->getAttribute("\126\145\162\163\151\157\156");
        Ld:
        if (!$vM->hasAttribute("\111\x73\x73\165\145\x49\156\163\164\x61\156\164")) {
            goto Yj;
        }
        $this->issueInstant = $vM->getAttribute("\x49\163\163\x75\x65\111\x6e\163\164\x61\156\x74");
        Yj:
        if (!$vM->hasAttribute("\111\104")) {
            goto vq;
        }
        $this->requestID = $vM->getAttribute("\x49\104");
        vq:
        $this->parseNameIdPolicy($vM);
        $this->parseIssuer($vM);
        $this->parseRequestedAuthnContext($vM);
        $this->parseScoping($vM);
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
    protected function parseIssuer(DOMElement $vM)
    {
        $SB = Utilities::xpQuery($vM, "\56\57\x73\x61\x6d\154\x5f\141\x73\163\145\x72\164\x69\157\x6e\x3a\x49\163\x73\x75\145\162");
        if (!empty($SB)) {
            goto aL;
        }
        throw new Exception("\x4d\151\x73\x73\x69\x6e\147\x20\x3c\163\141\x6d\x6c\72\x49\x73\x73\165\x65\162\x3e\x20\151\x6e\40\141\163\x73\x65\162\x74\151\157\156\56");
        aL:
        $this->issuer = trim($SB[0]->textContent);
    }
    protected function parseNameIdPolicy(DOMElement $vM)
    {
        $Ae = Utilities::xpQuery($vM, "\x2e\57\163\141\155\154\137\x70\x72\157\x74\157\x63\x6f\154\72\x4e\141\x6d\x65\111\x44\120\157\x6c\151\x63\x79");
        if (!empty($Ae)) {
            goto z9;
        }
        return;
        z9:
        $Ae = $Ae[0];
        if (!$Ae->hasAttribute("\x46\x6f\x72\x6d\x61\164")) {
            goto vz;
        }
        $this->nameIdPolicy["\106\157\162\x6d\141\x74"] = $Ae->getAttribute("\106\x6f\162\x6d\x61\164");
        vz:
        if (!$Ae->hasAttribute("\123\x50\116\141\155\x65\121\165\141\154\151\x66\151\x65\162")) {
            goto od;
        }
        $this->nameIdPolicy["\x53\x50\116\141\x6d\145\121\165\141\x6c\x69\146\151\145\162"] = $Ae->getAttribute("\123\120\116\141\x6d\145\121\x75\141\x6c\151\146\x69\145\162");
        od:
        if (!$Ae->hasAttribute("\x41\154\x6c\x6f\x77\103\x72\145\141\164\x65")) {
            goto yg;
        }
        $this->nameIdPolicy["\101\x6c\154\x6f\x77\x43\x72\145\141\164\145"] = Utilities::parseBoolean($Ae, "\101\x6c\154\x6f\167\x43\162\145\x61\164\145", false);
        yg:
    }
    protected function parseRequestedAuthnContext(DOMElement $vM)
    {
        $Bw = Utilities::xpQuery($vM, "\56\x2f\x73\141\x6d\x6c\137\x70\x72\157\x74\x6f\143\x6f\x6c\72\x52\x65\x71\165\145\x73\x74\145\x64\x41\x75\164\150\x6e\103\x6f\156\164\145\170\x74");
        if (!empty($Bw)) {
            goto wO;
        }
        return;
        wO:
        $Bw = $Bw[0];
        $p3 = array("\x41\x75\164\x68\156\103\157\x6e\x74\145\170\x74\x43\x6c\141\163\163\x52\145\x66" => array(), "\x43\157\155\160\x61\162\151\x73\157\156" => "\145\170\x61\x63\164");
        $pS = Utilities::xpQuery($Bw, "\56\x2f\163\141\155\154\137\141\x73\x73\145\x72\164\151\157\x6e\x3a\101\x75\x74\150\156\103\157\156\164\145\x78\x74\x43\154\141\163\x73\122\145\146");
        foreach ($pS as $RJ) {
            $p3["\x41\x75\164\x68\156\103\157\x6e\x74\x65\x78\164\103\x6c\x61\163\163\x52\x65\x66"][] = trim($RJ->textContent);
            gP:
        }
        Oy:
        if (!$Bw->hasAttribute("\x43\157\x6d\x70\x61\x72\151\163\157\156")) {
            goto GG;
        }
        $p3["\103\x6f\155\160\141\162\x69\x73\x6f\156"] = $Bw->getAttribute("\103\x6f\x6d\x70\x61\162\151\163\157\156");
        GG:
        $this->requestedAuthnContext = $p3;
    }
    protected function parseScoping(DOMElement $vM)
    {
        $Gc = Utilities::xpQuery($vM, "\56\57\163\141\155\154\x5f\x70\162\x6f\x74\x6f\x63\x6f\154\x3a\x53\x63\157\160\x69\156\x67");
        if (!empty($Gc)) {
            goto ZJ;
        }
        return;
        ZJ:
        $Gc = $Gc[0];
        if (!$Gc->hasAttribute("\x50\x72\157\x78\171\x43\x6f\x75\156\x74")) {
            goto ah;
        }
        $this->ProxyCount = (int) $Gc->getAttribute("\x50\x72\157\x78\171\x43\x6f\x75\x6e\x74");
        ah:
        $It = Utilities::xpQuery($Gc, "\56\x2f\x73\141\x6d\x6c\137\x70\162\157\x74\x6f\x63\157\154\72\111\x44\x50\114\x69\x73\164\57\163\141\x6d\x6c\x5f\160\162\157\x74\x6f\143\157\x6c\x3a\x49\x44\x50\x45\x6e\x74\x72\x79");
        foreach ($It as $yq) {
            if ($yq->hasAttribute("\x50\x72\157\166\151\144\145\x72\x49\x44")) {
                goto g5;
            }
            throw new Exception("\103\x6f\x75\154\x64\40\156\x6f\x74\x20\147\145\164\x20\120\162\x6f\166\151\x64\145\162\111\x44\x20\x66\x72\157\155\x20\123\x63\x6f\x70\151\156\x67\x2f\111\x44\120\x45\x6e\164\162\171\x20\145\x6c\145\x6d\145\x6e\x74\x20\x69\x6e\40\101\x75\x74\150\156\122\x65\x71\x75\x65\x73\164\40\157\x62\x6a\x65\x63\x74");
            g5:
            $this->IDPList[] = $yq->getAttribute("\120\x72\x6f\166\x69\x64\x65\x72\x49\x44");
            TU:
        }
        DN:
        $tI = Utilities::xpQuery($Gc, "\56\57\x73\x61\155\154\137\x70\162\x6f\164\157\x63\x6f\154\x3a\x52\145\161\165\x65\163\164\145\162\x49\104");
        foreach ($tI as $lx) {
            $this->RequesterID[] = trim($lx->textContent);
            be:
        }
        nX:
    }
}
