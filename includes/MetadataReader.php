<?php


class MetadataReader
{
    private $serviceProviders;
    public function __construct(\DOMNode $Kz = NULL)
    {
        $this->serviceProviders = array();
        $Rr = Utilities::xpQuery($Kz, "\56\x2f\163\141\x6d\x6c\x5f\x6d\x65\164\x61\144\x61\164\141\72\x45\156\x74\151\x74\171\x44\145\x73\143\x72\151\160\164\x6f\x72");
        foreach ($Rr as $o8) {
            $rL = Utilities::xpQuery($o8, "\x2e\x2f\x73\x61\x6d\154\137\x6d\x65\x74\141\144\141\164\141\72\123\120\x53\x53\x4f\x44\145\163\143\x72\x69\160\x74\157\162");
            if (!(isset($rL) && !empty($rL))) {
                goto hT;
            }
            array_push($this->serviceProviders, new ServiceProviders($o8));
            hT:
            LR:
        }
        br:
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
    public function __construct(\DOMElement $Kz = NULL)
    {
        $this->signingCertificate = array();
        $this->logoutDetails = array();
        if (!$Kz->hasAttribute("\x65\x6e\x74\151\x74\x79\x49\104")) {
            goto W8;
        }
        $this->entityID = $Kz->getAttribute("\x65\x6e\164\151\x74\x79\x49\104");
        W8:
        $rL = Utilities::xpQuery($Kz, "\56\x2f\x73\x61\155\x6c\137\x6d\x65\x74\141\x64\141\164\141\72\123\120\123\x53\x4f\x44\145\x73\x63\x72\x69\x70\x74\x6f\162");
        if (count($rL) > 1) {
            goto Nz;
        }
        if (empty($rL)) {
            goto vb;
        }
        goto GZ;
        Nz:
        throw new Exception("\115\157\x72\145\x20\x74\150\141\x6e\x20\157\156\x65\x20\74\123\x50\123\x53\117\x44\145\x73\143\162\151\x70\x74\157\x72\x3e\x20\x69\x6e\40\x3c\x45\x6e\x74\x69\x74\x79\x44\x65\x73\x63\162\x69\x70\164\157\162\x3e\x2e");
        goto GZ;
        vb:
        throw new Exception("\x4d\151\x73\x73\151\156\x67\x20\x72\x65\161\x75\151\x72\x65\x64\40\74\123\120\x53\123\117\x44\145\x73\x63\x72\x69\x70\x74\x6f\x72\x3e\x20\x69\156\x20\74\x45\x6e\x74\x69\x74\x79\x44\145\163\x63\162\151\160\164\x6f\x72\x3e\x2e");
        GZ:
        $this->parseAcsURL($rL);
        $this->parseLogoutURL($rL);
        $this->assertionsSigned($rL);
        $this->parsex509Certificate($rL);
    }
    private function parsex509Certificate($Kz)
    {
        $Oa = Utilities::xpQuery($Kz[0], "\56\57\x73\x61\x6d\x6c\x5f\155\145\164\x61\144\141\164\141\x3a\x4b\x65\171\x44\x65\163\x63\x72\151\160\x74\157\162");
        foreach ($Oa as $TZ) {
            if ($TZ->hasAttribute("\x75\x73\145")) {
                goto h2;
            }
            $this->parseSigningCertificate($TZ);
            goto YO;
            h2:
            if (!($TZ->getAttribute("\x75\163\x65") == "\163\x69\147\x6e\x69\156\147")) {
                goto ZJ;
            }
            $this->parseSigningCertificate($TZ);
            ZJ:
            YO:
            U8:
        }
        qL:
    }
    private function parseSigningCertificate($Kz)
    {
        $ge = Utilities::xpQuery($Kz, "\x2e\x2f\x64\x73\72\113\145\171\x49\156\x66\157\57\144\163\72\x58\x35\60\71\x44\141\164\141\x2f\x64\163\72\130\x35\60\x39\x43\x65\162\x74\151\146\x69\x63\x61\x74\x65");
        $Eb = trim($ge[0]->textContent);
        $Eb = str_replace(array("\xd", "\xa", "\x9", "\40"), '', $Eb);
        if (empty($ge)) {
            goto c1;
        }
        $this->signingCertificate = Utilities::sanitize_certificate($Eb);
        c1:
    }
    private function parseAcsURL($rL)
    {
        $qn = Utilities::xpQuery($rL[0], "\x2e\x2f\163\141\155\x6c\137\155\x65\x74\x61\x64\141\x74\141\72\x41\x73\163\145\x72\164\151\157\x6e\x43\157\x6e\x73\165\155\x65\x72\123\x65\x72\x76\x69\143\145");
        foreach ($qn as $zo) {
            if (!$zo->hasAttribute("\114\x6f\143\141\x74\151\x6f\x6e")) {
                goto TJ;
            }
            $this->acsURL = $zo->getAttribute("\x4c\157\x63\x61\x74\151\157\x6e");
            TJ:
            ED:
        }
        tV:
    }
    private function assertionsSigned($rL)
    {
        foreach ($rL as $zo) {
            if (!$zo->hasAttribute("\x57\x61\156\164\x41\163\163\145\162\164\151\x6f\x6e\x73\123\151\147\x6e\x65\x64")) {
                goto OC;
            }
            $this->assertionsSigned = $zo->getAttribute("\x57\x61\156\x74\101\x73\163\x65\162\164\151\157\x6e\x73\x53\x69\147\156\145\144");
            OC:
            Ju:
        }
        Q4:
    }
    private function parseLogoutURL($Kz)
    {
        $Zn = Utilities::xpQuery($Kz[0], "\56\x2f\x73\141\x6d\154\x5f\x6d\x65\x74\141\144\141\164\141\x3a\x53\151\x6e\147\154\145\x4c\x6f\x67\157\x75\164\x53\145\x72\166\x69\143\145");
        foreach ($Zn as $K2) {
            $vH = str_replace("\165\162\x6e\72\157\141\x73\x69\163\72\156\141\x6d\x65\x73\72\x74\143\72\123\101\115\x4c\72\x32\56\x30\72\142\151\156\x64\x69\156\147\163\x3a", '', $K2->getAttribute("\x42\x69\156\144\x69\156\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($vH => $K2->getAttribute("\x4c\157\143\x61\x74\x69\x6f\x6e")));
            UN:
        }
        qq:
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
    public function getLogoutURL($vH)
    {
        return isset($this->logoutDetails[$vH]) ? $this->logoutDetails[$vH] : '';
    }
}
