<?php


class MiniorangeSAMLIdpSupport
{
    public $email;
    public $phone;
    public $query;
    public function __construct($uN, $n8, $N3)
    {
        $this->email = $uN;
        $this->phone = $n8;
        $this->query = $N3;
    }
    public function sendSupportQuery()
    {
        $this->query = "\133\104\x72\165\x70\x61\x6c\55\x37\40\123\x41\115\114\x20\x49\104\120\40\120\x72\x65\155\x69\165\155\x20\x4d\157\x64\x75\x6c\x65\x5d\40" . $this->query;
        $hA = array("\143\x6f\x6d\x70\141\x6e\x79" => $_SERVER["\x53\x45\x52\126\x45\122\x5f\116\101\x4d\105"], "\145\155\x61\x69\154" => $this->email, "\143\x63\x45\x6d\x61\x69\154" => "\x64\162\x75\160\x61\154\163\x75\160\x70\x6f\162\x74\100\x78\x65\x63\165\162\x69\146\x79\56\x63\x6f\x6d", "\160\150\157\x6e\145" => $this->phone, "\161\165\x65\x72\x79" => $this->query, "\163\x75\142\152\145\143\164" => "\x44\162\x75\x70\141\154\x2d\x37\x20\x53\x41\115\114\40\111\104\120\x20\120\162\x65\x6d\151\x75\155\40\121\165\145\162\171");
        $X1 = json_encode($hA);
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\155\157\x61\163\57\x72\x65\x73\164\57\x63\x75\163\x74\157\155\x65\162\x2f\x63\157\x6e\x74\141\x63\x74\x2d\x75\x73";
        $BM = curl_init($U8);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($BM, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\x6e\164\55\x54\x79\x70\145\72\x20\x61\160\160\154\x69\x63\141\x74\151\x6f\x6e\57\152\163\x6f\x6e", "\x63\150\141\x72\x73\x65\x74\72\40\125\124\106\55\70", "\101\165\164\150\157\x72\x69\172\141\164\151\x6f\x6e\x3a\40\x42\141\x73\151\x63"));
        curl_setopt($BM, CURLOPT_POST, TRUE);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto Zv;
        }
        $Q2 = array("\45\155\145\164\150\157\x64" => "\x73\x65\x6e\x64\123\165\x70\x70\x6f\x72\x74\x51\x75\x65\162\x79", "\45\x66\151\x6c\x65" => "\x6d\151\x6e\151\157\162\x61\x6e\x67\145\x5f\163\141\155\154\x5f\x69\x64\x70\x5f\x73\165\160\x70\157\162\x74\x2e\160\150\x70", "\45\145\x72\162\157\162" => curl_error($BM));
        watchdog("\155\x69\x6e\151\157\162\141\156\147\145\x5f\x73\141\x6d\x6c\137\151\x64\160", "\143\125\122\114\x20\105\x72\x72\157\162\40\141\x74\x20\x25\x6d\145\164\x68\x6f\144\x20\x6f\x66\40\45\x66\151\154\145\72\x20\x25\x65\x72\x72\x6f\x72", $Q2);
        return FALSE;
        Zv:
        curl_close($BM);
        return TRUE;
    }
}
