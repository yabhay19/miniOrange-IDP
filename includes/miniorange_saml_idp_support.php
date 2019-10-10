<?php


class MiniorangeSAMLIdpSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($kY, $J9, $zk)
    {
        $this->email = $kY;
        $this->phone = $J9;
        $this->query = $zk;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\104\162\x75\x70\x61\x6c\x2d\67\x20\123\x41\115\x4c\x20\x49\104\120\40\x50\x72\145\155\151\x75\x6d\x20\115\x6f\144\x75\x6c\145\x5d\40" . $this->query;
        $hx = array("\x63\157\x6d\x70\x61\x6e\x79" => $_SERVER["\123\105\x52\126\x45\122\137\116\x41\115\x45"], "\145\155\x61\151\x6c" => $this->email, "\143\x63\105\x6d\x61\151\154" => "\144\162\x75\160\x61\154\163\165\x70\x70\157\162\164\x40\x78\x65\x63\165\x72\151\146\171\x2e\143\x6f\155", "\x70\x68\157\156\145" => $this->phone, "\161\165\x65\162\x79" => $this->query, "\163\165\142\152\145\x63\x74" => "\104\x72\165\160\x61\154\x2d\67\x20\123\x41\115\114\40\x49\x44\120\x20\120\162\145\155\151\x75\155\40\x51\x75\x65\162\x79");
        $mW = json_encode($hx);
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\x6f\x61\x73\57\x72\145\163\164\57\143\x75\163\x74\157\155\x65\162\x2f\143\157\156\164\141\143\164\x2d\x75\x73";
        $kH = curl_init($bl);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($kH, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\145\156\164\x2d\124\x79\160\x65\72\40\141\160\x70\x6c\151\143\x61\x74\151\x6f\156\57\152\163\157\x6e", "\x63\x68\x61\162\163\x65\164\72\x20\125\x54\x46\55\x38", "\101\x75\x74\150\157\x72\x69\172\x61\x74\x69\x6f\x6e\x3a\x20\102\x61\163\x69\143"));
        curl_setopt($kH, CURLOPT_POST, TRUE);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto p9;
        }
        $Do = array("\x25\x6d\x65\164\x68\157\x64" => "\x73\x65\156\144\123\x75\x70\160\x6f\162\164\121\165\x65\x72\x79", "\45\x66\x69\154\145" => "\155\x69\x6e\151\x6f\x72\x61\156\147\145\x5f\163\141\x6d\x6c\x5f\x69\x64\160\137\x73\x75\x70\160\x6f\162\164\56\x70\150\x70", "\45\x65\x72\x72\x6f\162" => curl_error($kH));
        watchdog("\x6d\151\x6e\x69\x6f\162\141\x6e\x67\145\x5f\x73\141\x6d\154\x5f\x69\x64\x70", "\x63\125\122\114\x20\x45\162\x72\157\162\x20\x61\164\x20\45\155\x65\x74\x68\157\144\x20\157\146\40\x25\146\151\x6c\x65\72\x20\x25\x65\x72\162\157\162", $Do);
        return FALSE;
        p9:
        curl_close($kH);
        return TRUE;
    }
}
