<?php


class MiniorangeSAMLIdpCustomer
{
    public $email;
    public $phone;
    public $customerKey;
    public $transactionId;
    public $password;
    public $otpToken;
    private $defaultCustomerId;
    private $defaultCustomerApiKey;
    public function __construct($kY, $J9, $TD, $ox)
    {
        $this->email = $kY;
        $this->phone = $J9;
        $this->password = $TD;
        $this->otpToken = $ox;
        $this->defaultCustomerId = "\61\x36\65\x35\x35";
        $this->defaultCustomerApiKey = "\x66\106\144\x32\130\x63\x76\124\107\x44\145\x6d\x5a\166\x62\167\x31\142\x63\x55\x65\x73\x4e\x4a\x57\x45\x71\x4b\142\x62\x55\x71";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto OQ;
        }
        return json_encode(array("\163\164\141\164\165\163" => "\x43\125\122\x4c\137\105\x52\x52\117\122", "\163\x74\141\164\x75\x73\115\145\163\x73\141\x67\145" => "\74\x61\x20\x68\162\x65\146\x3d\42\x68\164\164\x70\72\57\57\x70\150\x70\56\x6e\145\164\57\155\141\x6e\165\141\154\x2f\x65\156\57\x63\x75\162\154\56\x69\156\x73\x74\x61\154\154\x61\164\x69\x6f\x6e\x2e\x70\x68\160\42\x3e\x50\x48\120\40\143\x55\122\114\x20\145\170\x74\x65\156\163\151\x6f\x6e\74\57\141\x3e\x20\151\163\x20\156\x6f\x74\x20\x69\x6e\x73\x74\x61\154\154\x65\x64\40\x6f\x72\40\144\151\x73\x61\x62\154\x65\144\x2e"));
        OQ:
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\155\157\x61\x73\x2f\x72\x65\x73\164\x2f\x63\165\x73\164\x6f\155\x65\162\57\143\150\145\x63\x6b\x2d\151\x66\55\x65\x78\151\x73\164\x73";
        $kH = curl_init($bl);
        $kY = $this->email;
        $hx = array("\145\x6d\141\x69\x6c" => $kY);
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($kH, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\x43\157\156\x74\x65\x6e\164\x2d\x54\171\160\x65\72\40\141\x70\x70\x6c\x69\x63\141\x74\151\157\156\x2f\152\x73\x6f\x6e", "\x63\150\x61\162\163\x65\x74\72\40\125\124\x46\40\x2d\40\x38", "\101\165\164\150\x6f\x72\x69\x7a\141\164\151\x6f\156\x3a\x20\x42\x61\x73\151\143"));
        curl_setopt($kH, CURLOPT_POST, TRUE);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto Fm;
        }
        $Do = array("\45\x6d\145\x74\x68\x6f\144" => "\143\x68\x65\x63\153\x43\165\x73\164\157\x6d\145\162", "\x25\x66\151\154\x65" => "\143\165\163\164\x6f\x6d\145\162\x5f\x73\145\164\x75\x70\56\x70\x68\x70", "\x25\145\x72\x72\157\x72" => curl_error($kH));
        watchdog("\155\151\x6e\x69\157\162\x61\156\x67\x65\137\x73\x61\155\154\x5f\151\144\x70", "\105\x72\162\157\x72\x20\141\x74\40\x25\155\x65\164\x68\x6f\144\x20\x6f\x66\x20\x25\146\151\x6c\x65\72\x20\x25\x65\x72\162\157\x72", $Do);
        Fm:
        curl_close($kH);
        return $AH;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto rI;
        }
        return json_encode(array("\x73\164\x61\x74\x75\163\x43\157\144\145" => "\105\x52\x52\x4f\x52", "\x73\164\141\x74\165\x73\115\x65\x73\163\x61\147\145" => "\56\40\x50\x6c\145\141\163\x65\40\143\x68\x65\143\153\x20\171\157\165\162\x20\143\x6f\156\146\x69\147\165\x72\141\x74\x69\157\156\x2e"));
        rI:
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\57\x6d\157\141\163\57\x72\145\163\x74\x2f\x63\x75\163\164\157\155\145\162\x2f\141\144\144";
        $kH = curl_init($bl);
        $hx = array("\x63\x6f\155\x70\x61\156\171\x4e\141\x6d\145" => $_SERVER["\123\x45\122\x56\105\x52\137\116\101\x4d\105"], "\141\162\145\x61\x4f\146\111\x6e\164\145\162\x65\163\164" => "\104\x52\x55\x50\x41\114\x20\111\104\x50\x20\115\157\144\x75\154\x65", "\145\155\141\x69\154" => $this->email, "\x70\150\x6f\156\x65" => $this->phone, "\x70\x61\x73\163\x77\157\x72\x64" => $this->password);
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($kH, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\x43\157\156\164\x65\156\164\x2d\124\x79\x70\145\72\x20\x61\x70\x70\154\151\x63\141\164\151\157\x6e\x2f\x6a\163\x6f\156", "\143\x68\141\x72\163\x65\164\72\x20\125\124\x46\40\55\40\x38", "\101\x75\x74\x68\x6f\x72\x69\x7a\141\164\x69\x6f\x6e\72\x20\102\x61\x73\151\143"));
        curl_setopt($kH, CURLOPT_POST, TRUE);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto rk;
        }
        $Do = array("\x25\155\x65\164\150\157\x64" => "\143\162\145\x61\x74\145\103\165\163\x74\x6f\x6d\145\162", "\x25\146\x69\154\x65" => "\143\x75\x73\x74\157\155\145\x72\137\x73\145\x74\x75\x70\56\x70\150\x70", "\x25\x65\x72\x72\x6f\162" => curl_error($kH));
        watchdog("\155\x69\156\x69\157\162\x61\x6e\147\x65\x5f\x73\x61\155\154\x5f\151\x64\x70", "\105\162\x72\x6f\x72\40\141\164\x20\45\x6d\145\164\x68\157\144\x20\157\146\40\x25\146\151\154\145\x3a\x20\x25\x65\x72\162\157\x72", $Do);
        rk:
        curl_close($kH);
        return $AH;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto e3;
        }
        return json_encode(array("\x61\x70\151\x4b\145\171" => "\103\125\122\x4c\137\x45\x52\122\x4f\122", "\164\157\x6b\x65\156" => "\74\141\x20\150\x72\145\146\x3d\42\x68\164\164\x70\x3a\x2f\x2f\x70\x68\160\x2e\x6e\x65\164\57\155\141\x6e\165\141\x6c\x2f\145\156\x2f\143\165\x72\154\x2e\x69\156\x73\164\x61\x6c\x6c\x61\164\151\x6f\x6e\56\160\150\x70\42\x3e\120\x48\120\x20\143\x55\x52\x4c\x20\145\170\164\145\156\163\x69\157\x6e\x3c\x2f\141\76\x20\x69\163\40\156\x6f\x74\x20\x69\x6e\x73\164\x61\x6c\154\x65\x64\x20\x6f\162\x20\x64\151\x73\x61\x62\x6c\x65\144\56"));
        e3:
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\x6f\x61\x73\x2f\162\x65\163\164\x2f\143\x75\x73\164\157\155\x65\x72\57\x6b\145\x79";
        $kH = curl_init($bl);
        $kY = $this->email;
        $TD = $this->password;
        $hx = array("\x65\x6d\141\x69\x6c" => $kY, "\x70\x61\x73\x73\x77\x6f\x72\x64" => $TD);
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($kH, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\103\x6f\156\x74\145\156\x74\x2d\x54\171\160\145\x3a\x20\x61\x70\160\x6c\x69\x63\141\164\x69\157\x6e\x2f\x6a\x73\157\x6e", "\x63\x68\141\x72\x73\x65\x74\x3a\x20\x55\124\x46\40\x2d\x20\x38", "\101\x75\x74\x68\x6f\162\x69\x7a\x61\x74\x69\157\156\72\40\102\x61\x73\151\143"));
        curl_setopt($kH, CURLOPT_POST, TRUE);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto nO;
        }
        $Do = array("\x25\x6d\x65\164\150\157\144" => "\x67\x65\164\x43\x75\163\x74\157\x6d\x65\x72\x4b\145\171\163", "\x25\146\151\154\x65" => "\143\165\x73\x74\x6f\155\145\162\x5f\163\x65\x74\165\x70\56\x70\x68\160", "\x25\145\x72\162\x6f\162" => curl_error($kH));
        watchdog("\x6d\151\x6e\x69\157\162\141\x6e\x67\145\x5f\163\x61\x6d\x6c\x5f\151\144\160", "\x45\x72\162\x6f\x72\x20\141\x74\40\x25\x6d\x65\x74\150\157\144\x20\157\x66\x20\45\146\151\x6c\x65\x3a\x20\45\x65\x72\x72\157\x72", $Do);
        nO:
        curl_close($kH);
        return $AH;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto t0;
        }
        return json_encode(array("\x73\164\141\x74\165\x73" => "\103\x55\122\114\x5f\x45\x52\x52\x4f\122", "\x73\164\141\164\165\x73\115\145\x73\163\x61\147\145" => "\x3c\x61\40\x68\x72\145\x66\75\42\150\164\x74\160\72\57\57\160\150\x70\x2e\x6e\145\x74\x2f\155\141\x6e\165\x61\154\57\x65\156\x2f\143\165\x72\x6c\56\x69\156\x73\x74\x61\154\x6c\141\164\x69\x6f\156\56\x70\150\160\42\76\x50\110\x50\40\x63\x55\122\x4c\x20\145\x78\x74\145\x6e\163\151\157\156\x3c\x2f\x61\x3e\x20\x69\163\40\156\157\x74\x20\151\156\x73\164\141\154\x6c\145\x64\x20\157\162\x20\144\x69\x73\141\142\154\145\144\x2e"));
        t0:
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\155\157\141\x73\x2f\141\160\x69\x2f\x61\x75\164\150\57\143\150\141\154\154\x65\x6e\147\145";
        $kH = curl_init($bl);
        $fV = $this->defaultCustomerId;
        $OT = $this->defaultCustomerApiKey;
        $HZ = variable_get("\155\151\156\x69\x6f\x72\x61\156\x67\x65\137\x73\141\155\x6c\137\x69\x64\160\x5f\x63\x75\x73\x74\157\x6d\x65\162\137\x61\144\x6d\151\x6e\x5f\x65\155\x61\151\x6c", NULL);
        $aL = Utilities::get_timestamp();
        $EQ = $fV . $aL . $OT;
        $bw = hash("\163\150\x61\x35\x31\x32", $EQ);
        $fy = "\103\165\x73\x74\x6f\x6d\145\x72\55\113\x65\x79\72\40" . $fV;
        $xy = "\124\x69\155\145\163\x74\141\x6d\x70\72\x20" . $aL;
        $HF = "\101\x75\x74\x68\157\162\151\x7a\x61\164\x69\x6f\x6e\x3a\40" . $bw;
        $hx = array("\x63\x75\x73\x74\x6f\x6d\145\x72\x4b\x65\171" => $fV, "\145\155\x61\151\x6c" => $HZ, "\x61\x75\164\x68\124\171\x70\x65" => "\x45\115\101\x49\x4c");
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($kH, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\x74\145\x6e\x74\x2d\124\x79\160\x65\x3a\40\x61\x70\x70\154\151\x63\141\x74\x69\x6f\x6e\57\152\163\x6f\156", $fy, $xy, $HF));
        curl_setopt($kH, CURLOPT_POST, TRUE);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto OF;
        }
        $Do = array("\x25\x6d\x65\164\x68\x6f\x64" => "\163\x65\x6e\144\117\x74\x70", "\x25\146\151\154\145" => "\143\165\163\x74\x6f\x6d\x65\x72\137\163\x65\x74\x75\160\56\160\150\x70", "\45\145\x72\x72\157\162" => curl_error($kH));
        watchdog("\x6d\151\156\151\157\x72\141\x6e\x67\145\137\x73\x61\155\x6c\x5f\151\144\x70", "\x45\162\162\x6f\162\x20\141\164\x20\45\x6d\x65\164\x68\157\144\40\157\146\40\x25\x66\151\154\145\x3a\40\x25\145\x72\x72\157\x72", $Do);
        OF:
        curl_close($kH);
        return $AH;
    }
    public function validateOtp($iV)
    {
        if (Utilities::isCurlInstalled()) {
            goto Pt;
        }
        return json_encode(array("\163\x74\x61\164\x75\163" => "\103\125\122\114\137\105\x52\122\117\122", "\163\x74\141\164\x75\163\115\x65\163\163\x61\147\145" => "\x3c\x61\40\150\162\x65\x66\75\42\x68\164\164\160\x3a\57\57\160\x68\x70\x2e\x6e\145\164\57\155\141\x6e\x75\141\154\x2f\145\x6e\x2f\x63\165\x72\154\56\x69\x6e\163\164\141\154\x6c\141\x74\151\x6f\156\56\160\x68\x70\42\x3e\120\110\x50\x20\x63\x55\122\x4c\40\145\x78\x74\145\x6e\x73\x69\157\156\74\57\x61\76\x20\x69\x73\40\x6e\x6f\164\40\x69\156\x73\164\141\154\154\x65\144\x20\157\x72\x20\x64\x69\163\141\142\154\x65\144\x2e"));
        Pt:
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\x6f\141\163\x2f\x61\160\x69\57\141\x75\x74\x68\57\x76\141\x6c\151\x64\x61\x74\x65";
        $kH = curl_init($bl);
        $fV = $this->defaultCustomerId;
        $OT = $this->defaultCustomerApiKey;
        $aL = Utilities::get_timestamp();
        $EQ = $fV . $aL . $OT;
        $bw = hash("\163\x68\x61\x35\x31\62", $EQ);
        $fy = "\x43\165\x73\164\157\x6d\145\162\x2d\x4b\145\171\72\x20" . $fV;
        $xy = "\124\151\155\x65\x73\x74\141\x6d\160\x3a\x20" . $aL;
        $HF = "\x41\165\x74\150\157\x72\x69\172\x61\x74\151\x6f\156\x3a\x20" . $bw;
        $hx = array("\164\170\111\x64" => $iV, "\x74\x6f\153\145\156" => $this->otpToken);
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($kH, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\145\156\164\55\124\171\x70\145\x3a\40\x61\160\160\x6c\x69\143\x61\164\151\157\156\x2f\x6a\163\157\156", $fy, $xy, $HF));
        curl_setopt($kH, CURLOPT_POST, TRUE);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto xQ;
        }
        $Do = array("\x25\x6d\x65\x74\150\157\144" => "\x76\x61\x6c\151\x64\141\x74\x65\x4f\x74\160", "\x25\146\x69\154\x65" => "\x63\x75\x73\164\x6f\155\x65\162\137\x73\145\164\x75\x70\56\160\150\160", "\45\145\162\162\x6f\162" => curl_error($kH));
        watchdog("\x6d\x69\x6e\x69\157\x72\x61\156\x67\x65\x5f\163\x61\x6d\x6c\137\x69\x64\160", "\x45\x72\x72\157\162\40\x61\x74\x20\45\155\x65\x74\x68\x6f\144\x20\157\x66\40\x25\146\151\x6c\x65\72\40\45\x65\162\162\x6f\x72", $Do);
        xQ:
        curl_close($kH);
        return $AH;
    }
    function check_status($wX)
    {
        global $base_url;
        if (Utilities::isCurlInstalled()) {
            goto Ae;
        }
        return json_encode(array("\x73\x74\x61\164\165\163" => "\x43\125\122\114\x5f\x45\122\122\117\122", "\x73\164\141\164\x75\x73\115\x65\x73\163\x61\147\x65" => "\74\141\40\150\x72\145\x66\x3d\x22\150\164\x74\x70\x3a\57\x2f\x70\x68\160\x2e\156\x65\164\x2f\x6d\x61\156\165\x61\x6c\x2f\145\156\x2f\x63\x75\x72\x6c\56\x69\156\163\164\141\x6c\x6c\x61\x74\151\157\x6e\56\x70\x68\160\x22\76\x50\x48\120\x20\x63\125\122\x4c\x20\145\x78\x74\x65\156\x73\151\157\156\74\x2f\x61\76\x20\x69\x73\40\x6e\157\164\x20\151\156\x73\164\x61\154\x6c\145\144\40\157\x72\x20\x64\151\x73\141\142\x6c\145\144\x2e"));
        Ae:
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\155\157\141\163\57\x61\x70\x69\x2f\x62\x61\143\153\x75\x70\x63\157\144\145\57\166\145\162\151\146\x79";
        $kH = curl_init($bl);
        $Kh = variable_get("\x6d\x69\156\x69\x6f\162\141\x6e\x67\x65\x5f\x73\x61\x6d\x6c\x5f\151\144\160\x5f\x63\x75\x73\164\157\x6d\x65\162\137\x69\x64", '');
        $YW = variable_get("\x6d\151\x6e\151\x6f\162\x61\x6e\x67\145\137\163\x61\x6d\154\x5f\151\144\x70\137\143\165\163\x74\x6f\x6d\145\162\x5f\x61\160\x69\x5f\x6b\145\171", '');
        $by = Utilities::get_timestamp();
        $Kr = $Kh . $by . $YW;
        $uX = hash("\163\x68\141\65\61\x32", $Kr);
        $vr = "\103\165\x73\164\157\155\145\162\55\113\145\171\x3a\x20" . $Kh;
        $Jp = "\x54\151\155\145\163\164\x61\155\x70\72\x20" . $by;
        $Pt = "\x41\x75\x74\150\157\x72\x69\x7a\x61\164\x69\157\x6e\72\x20" . $uX;
        $hx = '';
        $hx = array("\x63\x6f\x64\x65" => $wX, "\143\165\x73\x74\157\155\x65\162\x4b\x65\171" => $Kh, "\141\x64\144\x69\164\x69\x6f\x6e\x61\x6c\x46\x69\145\x6c\x64\x73" => array("\x66\x69\x65\x6c\144\x31" => $base_url));
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($kH, CURLOPT_AUTOREFERER, true);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\156\164\x2d\x54\x79\160\145\72\x20\141\x70\160\154\151\x63\141\x74\x69\x6f\x6e\57\152\163\157\156", $vr, $Jp, $Pt));
        curl_setopt($kH, CURLOPT_POST, true);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        curl_setopt($kH, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($kH, CURLOPT_TIMEOUT, 20);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto ev;
        }
        echo "\122\x65\161\165\x65\163\164\x20\105\x72\x72\157\162\72" . curl_error($kH);
        die;
        ev:
        curl_close($kH);
        $AH = json_decode($AH, true);
        return $AH;
    }
    function ccl()
    {
        global $base_url;
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\157\141\x73\x2f\x72\x65\x73\x74\x2f\x63\x75\x73\x74\x6f\155\145\162\x2f\154\x69\143\x65\x6e\163\145";
        $kH = curl_init($bl);
        $Kh = variable_get("\155\151\156\151\157\162\x61\156\147\x65\137\163\x61\x6d\x6c\x5f\151\144\x70\137\x63\x75\x73\x74\x6f\155\x65\x72\137\x69\x64", '');
        $YW = variable_get("\x6d\x69\x6e\x69\x6f\x72\x61\x6e\147\145\x5f\x73\x61\155\x6c\137\x69\x64\x70\x5f\143\165\x73\164\x6f\x6d\145\162\x5f\141\x70\151\137\x6b\x65\171", '');
        $by = Utilities::get_timestamp();
        $Kr = $Kh . $by . $YW;
        $uX = hash("\163\x68\141\65\61\x32", $Kr);
        $vr = "\x43\165\x73\164\157\155\145\162\x2d\x4b\x65\171\72\x20" . $Kh;
        $Jp = "\124\x69\x6d\x65\x73\164\x61\155\x70\72\x20" . $by;
        $Pt = "\101\x75\164\150\x6f\x72\x69\x7a\x61\164\x69\x6f\156\72\x20" . $uX;
        $hx = '';
        $hx = array("\143\x75\163\164\x6f\155\145\162\x49\x64" => $Kh, "\x61\160\x70\x6c\151\143\x61\164\x69\x6f\156\x4e\141\x6d\145" => "\x64\x72\165\x70\x61\154\137\163\141\x6d\x6c\x5f\151\144\160");
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($kH, CURLOPT_AUTOREFERER, true);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\164\x65\x6e\164\x2d\124\x79\x70\x65\72\x20\141\160\160\154\151\x63\x61\x74\x69\157\x6e\x2f\x6a\163\157\156", $vr, $Jp, $Pt));
        curl_setopt($kH, CURLOPT_POST, true);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        curl_setopt($kH, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($kH, CURLOPT_TIMEOUT, 20);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto Nt;
        }
        return null;
        Nt:
        curl_close($kH);
        return $AH;
    }
    function update_status()
    {
        $bl = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\x6f\141\x73\57\x61\160\x69\x2f\142\x61\x63\153\x75\x70\x63\x6f\x64\x65\x2f\x75\x70\144\141\164\145\163\164\x61\x74\165\163";
        $kH = curl_init($bl);
        $Kh = variable_get("\x6d\151\156\x69\x6f\x72\141\156\147\145\x5f\x73\141\155\154\137\x69\144\x70\x5f\143\165\163\164\x6f\155\145\162\137\151\x64", '');
        $YW = variable_get("\155\x69\x6e\x69\x6f\x72\141\x6e\147\145\137\x73\141\155\x6c\137\151\144\x70\x5f\143\x75\163\164\157\155\x65\162\x5f\141\160\x69\137\x6b\x65\171", '');
        $Po = variable_get("\155\x69\x6e\x69\157\x72\141\156\147\x65\137\163\x61\x6d\154\x5f\151\144\x70\137\x73\155\x6c\137\x6c\x6b", '');
        $by = Utilities::get_timestamp();
        $Kr = $Kh . $by . $YW;
        $uX = hash("\163\150\141\65\61\62", $Kr);
        $vr = "\x43\165\x73\x74\x6f\155\x65\162\x2d\113\145\171\72\40" . $Kh;
        $Jp = "\124\151\x6d\145\x73\x74\x61\x6d\160\72\40" . $by;
        $Pt = "\101\x75\x74\150\x6f\x72\x69\x7a\141\164\151\x6f\156\72\40" . $uX;
        $Nv = variable_get("\x6d\x69\156\151\157\162\x61\156\147\x65\x5f\163\x61\155\154\137\x69\x64\160\137\143\165\x73\x74\157\x6d\x65\162\137\141\144\x6d\x69\156\137\x74\157\153\145\x6e", '');
        $wX = Utilities::decrypt($Po, $Nv);
        $hx = array("\x63\x6f\144\145" => $wX, "\x63\x75\x73\x74\x6f\155\x65\162\113\145\x79" => $Kh);
        $mW = json_encode($hx);
        curl_setopt($kH, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($kH, CURLOPT_ENCODING, '');
        curl_setopt($kH, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($kH, CURLOPT_AUTOREFERER, true);
        curl_setopt($kH, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($kH, CURLOPT_MAXREDIRS, 10);
        curl_setopt($kH, CURLOPT_HTTPHEADER, array("\x43\x6f\x6e\164\145\156\x74\x2d\124\171\160\x65\72\40\141\160\x70\154\x69\x63\141\x74\x69\x6f\156\x2f\x6a\163\157\156", $vr, $Jp, $Pt));
        curl_setopt($kH, CURLOPT_POST, true);
        curl_setopt($kH, CURLOPT_POSTFIELDS, $mW);
        curl_setopt($kH, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($kH, CURLOPT_TIMEOUT, 20);
        $AH = curl_exec($kH);
        if (!curl_errno($kH)) {
            goto Xv;
        }
        echo "\x52\x65\x71\165\145\x73\x74\x20\x45\162\162\157\x72\72" . curl_error($kH);
        die;
        Xv:
        curl_close($kH);
        return $AH;
    }
}
