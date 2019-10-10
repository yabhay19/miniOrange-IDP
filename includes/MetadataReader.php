<?php


class MetadataReader
{
    private $serviceProviders;
    public function __construct(\DOMNode $vM = NULL)
    {
        $this->serviceProviders = array();
        $pr = Utilities::xpQuery($vM, "\56\57\x73\x61\155\154\x5f\155\145\164\x61\144\x61\x74\141\72\105\x6e\x74\151\x74\171\x44\145\163\x63\162\151\x70\164\x6f\x72");
        foreach ($pr as $M0) {
            $ws = Utilities::xpQuery($M0, "\56\x2f\x73\141\x6d\154\137\x6d\x65\164\141\144\141\164\141\x3a\123\x50\123\x53\117\x44\x65\163\x63\x72\x69\160\x74\157\x72");
            if (!(isset($ws) && !empty($ws))) {
                goto fh;
            }
            array_push($this->serviceProviders, new ServiceProviders($M0));
            fh:
            rC:
        }
        dw:
    }
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }
}
class ServiceProviders
{
    private $entityID;
    private $acsURL;
    private $logoutDetails;
    private $assertionsSigned;
    private $signingCertificate;
    public function __construct(\DOMElement $vM = NULL)
    {
        $this->signingCertificate = array();
        $this->logoutDetails = array();
        if (!$vM->hasAttribute("\x65\156\x74\x69\164\x79\x49\104")) {
            goto RW;
        }
        $this->entityID = $vM->getAttribute("\145\x6e\164\151\164\x79\x49\x44");
        RW:
        $ws = Utilities::xpQuery($vM, "\56\x2f\163\141\155\x6c\137\155\145\164\x61\x64\141\164\141\x3a\x53\120\123\123\117\x44\x65\163\143\162\151\160\x74\157\x72");
        if (count($ws) > 1) {
            goto YD;
        }
        if (empty($ws)) {
            goto lR;
        }
        goto z6;
        YD:
        throw new Exception("\x4d\x6f\x72\x65\40\164\x68\141\156\x20\x6f\x6e\145\x20\x3c\x53\x50\123\123\x4f\x44\145\163\143\162\151\160\x74\x6f\x72\x3e\40\151\x6e\x20\74\x45\x6e\164\x69\164\x79\x44\x65\163\x63\x72\151\x70\x74\x6f\162\x3e\56");
        goto z6;
        lR:
        throw new Exception("\x4d\x69\x73\x73\x69\x6e\147\x20\162\145\x71\x75\x69\162\x65\x64\x20\74\x53\x50\x53\123\x4f\104\145\x73\x63\x72\x69\160\x74\157\x72\x3e\x20\x69\x6e\40\x3c\x45\x6e\164\x69\x74\171\x44\145\x73\143\162\x69\x70\164\157\x72\76\x2e");
        z6:
        $this->parseAcsURL($ws);
        $this->parseLogoutURL($ws);
        $this->assertionsSigned($ws);
        $this->parsex509Certificate($ws);
    }
    private function parsex509Certificate($vM)
    {
        $C3 = Utilities::xpQuery($vM[0], "\56\57\x73\141\155\154\x5f\155\x65\164\141\x64\x61\164\x61\x3a\x4b\145\171\104\x65\x73\143\162\x69\x70\x74\x6f\x72");
        foreach ($C3 as $Jk) {
            if ($Jk->hasAttribute("\165\x73\145")) {
                goto cx;
            }
            $this->parseSigningCertificate($Jk);
            goto AJ;
            cx:
            if (!($Jk->getAttribute("\165\x73\145") == "\x73\151\x67\x6e\x69\x6e\147")) {
                goto aa;
            }
            $this->parseSigningCertificate($Jk);
            aa:
            AJ:
            UO:
        }
        eN:
    }
    private function parseSigningCertificate($vM)
    {
        $k_ = Utilities::xpQuery($vM, "\56\57\144\163\x3a\113\145\171\111\156\146\x6f\57\144\163\x3a\x58\65\x30\x39\x44\x61\x74\x61\57\144\x73\72\130\65\x30\x39\x43\x65\x72\x74\x69\146\151\x63\x61\x74\145");
        $ZF = trim($k_[0]->textContent);
        $ZF = str_replace(array("\15", "\12", "\x9", "\x20"), '', $ZF);
        if (empty($k_)) {
            goto Hy;
        }
        $this->signingCertificate = Utilities::sanitize_certificate($ZF);
        Hy:
    }
    private function parseAcsURL($ws)
    {
        $gj = Utilities::xpQuery($ws[0], "\56\57\x73\x61\155\x6c\137\155\145\164\x61\144\141\164\141\x3a\x41\x73\x73\145\162\164\x69\x6f\156\103\157\x6e\x73\165\155\145\162\x53\145\162\166\x69\x63\x65");
        foreach ($gj as $wT) {
            if (!$wT->hasAttribute("\114\157\143\x61\164\x69\157\x6e")) {
                goto Wv;
            }
            $this->acsURL = $wT->getAttribute("\114\x6f\143\x61\x74\151\157\156");
            Wv:
            XF:
        }
        ax:
    }
    private function assertionsSigned($ws)
    {
        foreach ($ws as $wT) {
            if (!$wT->hasAttribute("\127\x61\x6e\164\x41\163\x73\145\x72\164\151\157\156\x73\x53\x69\147\156\145\144")) {
                goto CJ;
            }
            $this->assertionsSigned = $wT->getAttribute("\127\x61\156\x74\x41\x73\x73\145\x72\x74\x69\157\x6e\x73\x53\x69\147\x6e\x65\x64");
            CJ:
            u6:
        }
        O2:
    }
    private function parseLogoutURL($vM)
    {
        $tg = Utilities::xpQuery($vM[0], "\56\x2f\x73\141\x6d\154\137\155\x65\164\141\x64\141\164\141\x3a\123\151\156\x67\154\x65\x4c\157\x67\157\x75\164\123\x65\162\x76\151\143\145");
        foreach ($tg as $hT) {
            $C9 = str_replace("\165\162\156\72\157\141\163\x69\163\72\156\x61\155\145\163\x3a\164\143\x3a\123\x41\x4d\x4c\72\x32\x2e\60\x3a\142\x69\x6e\x64\x69\156\147\x73\72", '', $hT->getAttribute("\x42\151\156\x64\x69\156\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($C9 => $hT->getAttribute("\x4c\157\x63\141\164\x69\157\x6e")));
            yT:
        }
        yK:
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getAcsURL()
    {
        return $this->acsURL;
    }
    public function getAssertionsSigned()
    {
        return $this->assertionsSigned;
    }
    public function getSigningCertificate()
    {
        return $this->signingCertificate;
    }
    public function getLogoutURL($C9)
    {
        return isset($this->logoutDetails[$C9]) ? $this->logoutDetails[$C9] : '';
    }
}
