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
    public function __construct($uN, $n8, $k_, $Ef)
    {
        $this->email = $uN;
        $this->phone = $n8;
        $this->password = $k_;
        $this->otpToken = $Ef;
        $this->defaultCustomerId = "\x31\x36\65\x35\x35";
        $this->defaultCustomerApiKey = "\146\x46\x64\62\x58\143\166\124\x47\x44\145\155\132\x76\x62\x77\x31\142\143\125\x65\163\x4e\112\x57\x45\x71\x4b\x62\x62\x55\161";
    }
    public function checkCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto yF;
        }
        return json_encode(array("\x73\164\141\164\x75\x73" => "\x43\x55\122\114\137\105\x52\x52\x4f\x52", "\x73\164\x61\x74\x75\x73\x4d\145\x73\163\141\x67\x65" => "\x3c\141\x20\150\x72\x65\x66\75\x22\x68\164\164\x70\72\57\57\x70\150\160\x2e\x6e\145\164\x2f\x6d\x61\156\x75\141\x6c\57\145\x6e\x2f\143\x75\x72\154\56\151\x6e\x73\x74\141\154\x6c\141\x74\x69\x6f\156\x2e\160\x68\160\42\76\120\x48\x50\x20\x63\x55\122\x4c\40\145\x78\164\x65\156\x73\151\157\156\74\x2f\x61\76\x20\x69\x73\40\156\157\164\x20\151\x6e\163\164\x61\154\154\145\144\40\157\x72\x20\x64\x69\163\x61\142\x6c\x65\x64\56"));
        yF:
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\157\x61\x73\x2f\162\145\x73\164\x2f\x63\165\163\x74\157\155\x65\162\57\143\x68\145\x63\153\x2d\151\146\x2d\x65\170\x69\163\164\163";
        $BM = curl_init($U8);
        $uN = $this->email;
        $hA = array("\x65\x6d\x61\151\154" => $uN);
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($BM, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\103\x6f\x6e\164\145\x6e\x74\55\x54\171\160\x65\72\x20\141\160\x70\x6c\x69\143\x61\164\151\157\156\57\x6a\x73\157\x6e", "\143\x68\x61\162\x73\x65\x74\x3a\40\x55\x54\x46\40\x2d\40\70", "\x41\165\164\x68\x6f\x72\151\172\141\164\151\x6f\x6e\x3a\40\102\141\x73\151\143"));
        curl_setopt($BM, CURLOPT_POST, TRUE);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto vl;
        }
        $Q2 = array("\45\155\145\164\x68\157\144" => "\x63\150\145\143\x6b\103\165\x73\x74\157\155\145\162", "\x25\x66\x69\154\x65" => "\143\x75\x73\164\157\x6d\x65\x72\x5f\163\145\x74\165\x70\x2e\x70\x68\160", "\x25\x65\162\162\x6f\162" => curl_error($BM));
        watchdog("\x6d\151\x6e\151\157\162\141\x6e\147\x65\x5f\x73\141\155\x6c\137\151\144\x70", "\x45\162\162\x6f\x72\40\141\x74\x20\45\x6d\145\x74\150\x6f\144\x20\157\146\x20\x25\146\151\154\x65\x3a\x20\45\145\162\x72\157\162", $Q2);
        vl:
        curl_close($BM);
        return $Y4;
    }
    public function createCustomer()
    {
        if (Utilities::isCurlInstalled()) {
            goto Rd;
        }
        return json_encode(array("\163\164\141\x74\x75\x73\x43\157\x64\145" => "\x45\x52\x52\117\122", "\163\x74\141\164\165\x73\x4d\x65\x73\x73\141\x67\145" => "\56\x20\120\x6c\145\x61\163\x65\x20\143\x68\x65\x63\x6b\x20\171\x6f\165\x72\x20\143\x6f\156\x66\x69\x67\165\162\x61\x74\151\157\156\56"));
        Rd:
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\155\x6f\x61\x73\57\162\145\163\164\57\143\165\x73\x74\157\155\x65\x72\57\141\x64\144";
        $BM = curl_init($U8);
        $hA = array("\143\157\x6d\x70\x61\x6e\171\x4e\141\155\145" => $_SERVER["\123\105\122\x56\105\122\137\116\101\x4d\105"], "\x61\162\x65\x61\117\x66\111\156\x74\145\x72\x65\163\164" => "\104\122\125\x50\101\x4c\x20\111\104\x50\x20\115\x6f\x64\165\x6c\145", "\x65\155\x61\151\154" => $this->email, "\x70\x68\x6f\x6e\x65" => $this->phone, "\x70\141\163\163\x77\157\162\x64" => $this->password);
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($BM, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\x65\156\x74\x2d\x54\x79\160\145\72\40\x61\160\x70\154\151\143\x61\x74\x69\x6f\156\57\x6a\x73\x6f\x6e", "\143\150\x61\162\163\145\164\72\40\x55\124\106\x20\55\x20\70", "\101\165\164\150\x6f\162\151\172\141\x74\x69\x6f\x6e\x3a\40\x42\141\163\151\x63"));
        curl_setopt($BM, CURLOPT_POST, TRUE);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto mq;
        }
        $Q2 = array("\45\155\x65\x74\x68\157\144" => "\x63\162\145\141\x74\145\103\165\163\164\157\x6d\x65\162", "\45\146\x69\x6c\x65" => "\x63\x75\163\164\157\155\145\x72\x5f\x73\x65\164\165\x70\56\160\150\x70", "\x25\145\x72\162\x6f\x72" => curl_error($BM));
        watchdog("\x6d\151\x6e\x69\157\162\x61\x6e\x67\145\137\163\x61\x6d\x6c\137\151\144\160", "\105\x72\162\x6f\x72\x20\141\x74\x20\45\155\x65\164\x68\x6f\x64\x20\x6f\x66\40\45\146\x69\x6c\x65\x3a\x20\45\145\x72\x72\x6f\162", $Q2);
        mq:
        curl_close($BM);
        return $Y4;
    }
    public function getCustomerKeys()
    {
        if (Utilities::isCurlInstalled()) {
            goto mf;
        }
        return json_encode(array("\141\x70\x69\x4b\x65\x79" => "\103\125\122\x4c\137\x45\x52\122\117\x52", "\x74\x6f\153\145\156" => "\74\141\40\x68\162\x65\146\75\x22\x68\164\x74\160\x3a\57\57\160\x68\160\56\156\x65\x74\x2f\155\141\156\x75\x61\x6c\x2f\x65\x6e\57\143\x75\162\x6c\x2e\x69\156\163\x74\x61\154\x6c\x61\164\x69\x6f\x6e\x2e\x70\x68\160\42\76\120\110\x50\x20\143\x55\122\x4c\x20\x65\x78\x74\145\x6e\163\x69\x6f\156\74\57\141\76\x20\x69\163\x20\156\157\164\x20\151\x6e\x73\x74\141\154\x6c\x65\144\40\157\162\x20\144\x69\163\x61\142\x6c\x65\144\x2e"));
        mf:
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\155\157\141\163\57\x72\145\163\164\57\x63\165\x73\164\157\155\x65\x72\x2f\153\145\171";
        $BM = curl_init($U8);
        $uN = $this->email;
        $k_ = $this->password;
        $hA = array("\145\155\141\151\154" => $uN, "\x70\141\163\x73\167\157\x72\x64" => $k_);
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($BM, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\103\157\x6e\x74\x65\x6e\164\55\124\x79\160\145\x3a\x20\x61\x70\160\x6c\x69\143\141\164\x69\x6f\x6e\x2f\152\x73\157\156", "\x63\x68\141\x72\x73\x65\x74\x3a\x20\x55\124\x46\x20\55\x20\x38", "\101\x75\164\x68\x6f\x72\151\x7a\141\x74\x69\157\156\72\x20\x42\x61\163\x69\143"));
        curl_setopt($BM, CURLOPT_POST, TRUE);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto dq;
        }
        $Q2 = array("\45\x6d\145\x74\x68\157\x64" => "\147\145\x74\103\165\x73\164\x6f\x6d\145\162\x4b\145\x79\x73", "\45\146\151\154\x65" => "\143\x75\x73\x74\157\x6d\145\x72\137\163\x65\164\x75\160\x2e\160\150\x70", "\45\x65\x72\162\x6f\162" => curl_error($BM));
        watchdog("\x6d\x69\x6e\151\x6f\x72\x61\156\x67\x65\x5f\x73\141\155\x6c\137\x69\x64\x70", "\x45\162\x72\x6f\x72\40\x61\x74\x20\45\155\145\164\150\x6f\144\40\x6f\x66\40\x25\146\151\154\145\x3a\40\45\145\162\x72\x6f\162", $Q2);
        dq:
        curl_close($BM);
        return $Y4;
    }
    public function sendOtp()
    {
        if (Utilities::isCurlInstalled()) {
            goto Ix;
        }
        return json_encode(array("\163\164\141\x74\x75\x73" => "\103\x55\x52\114\137\x45\122\122\x4f\122", "\163\x74\141\164\x75\163\115\x65\163\x73\x61\147\x65" => "\74\141\40\150\x72\x65\x66\x3d\42\x68\x74\x74\160\72\x2f\x2f\x70\x68\160\56\x6e\145\x74\x2f\155\x61\156\x75\x61\x6c\57\145\x6e\x2f\143\165\x72\x6c\56\151\x6e\x73\164\x61\x6c\x6c\x61\164\151\157\x6e\x2e\160\x68\x70\x22\x3e\120\110\x50\40\x63\125\x52\x4c\40\145\x78\x74\145\156\x73\151\x6f\156\x3c\x2f\x61\x3e\40\151\163\x20\x6e\157\164\40\x69\156\163\x74\141\x6c\154\145\x64\40\157\x72\40\144\x69\163\x61\142\x6c\145\144\56"));
        Ix:
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\x6f\141\163\x2f\x61\x70\x69\57\x61\165\x74\x68\57\143\x68\141\x6c\x6c\x65\x6e\147\145";
        $BM = curl_init($U8);
        $SA = $this->defaultCustomerId;
        $H2 = $this->defaultCustomerApiKey;
        $Xe = variable_get("\155\x69\x6e\x69\x6f\162\141\x6e\x67\145\x5f\x73\141\155\154\137\151\x64\x70\x5f\x63\x75\x73\x74\x6f\x6d\145\x72\x5f\141\144\155\151\156\137\145\155\141\151\154", NULL);
        $Pa = Utilities::get_timestamp();
        $bY = $SA . $Pa . $H2;
        $WC = hash("\x73\150\x61\x35\x31\x32", $bY);
        $Jk = "\103\165\163\164\x6f\155\145\x72\55\113\145\171\72\x20" . $SA;
        $TU = "\124\151\155\145\x73\164\141\155\x70\x3a\x20" . $Pa;
        $A9 = "\x41\165\164\x68\157\162\151\172\x61\164\x69\157\156\72\x20" . $WC;
        $hA = array("\143\x75\163\x74\157\x6d\145\162\x4b\145\x79" => $SA, "\145\155\141\151\154" => $Xe, "\141\165\164\150\124\x79\x70\x65" => "\105\115\101\x49\x4c");
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($BM, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\103\157\x6e\164\x65\156\x74\55\x54\x79\160\145\72\x20\141\x70\160\x6c\x69\x63\x61\164\151\x6f\x6e\57\152\x73\157\x6e", $Jk, $TU, $A9));
        curl_setopt($BM, CURLOPT_POST, TRUE);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto Ed;
        }
        $Q2 = array("\x25\x6d\145\164\150\157\x64" => "\x73\x65\x6e\144\117\x74\160", "\x25\146\151\x6c\145" => "\x63\x75\x73\164\157\155\145\162\137\163\145\x74\165\x70\x2e\160\150\160", "\x25\145\162\162\x6f\162" => curl_error($BM));
        watchdog("\155\x69\x6e\x69\157\162\141\x6e\147\145\137\163\141\x6d\154\x5f\x69\144\160", "\105\162\162\x6f\x72\40\x61\164\40\45\x6d\145\164\x68\x6f\144\40\157\x66\40\x25\x66\x69\x6c\x65\x3a\x20\x25\x65\x72\x72\x6f\x72", $Q2);
        Ed:
        curl_close($BM);
        return $Y4;
    }
    public function validateOtp($YP)
    {
        if (Utilities::isCurlInstalled()) {
            goto aQ;
        }
        return json_encode(array("\163\164\141\164\x75\x73" => "\x43\125\122\114\x5f\105\x52\122\x4f\122", "\163\x74\141\164\165\x73\x4d\145\x73\163\x61\x67\145" => "\x3c\x61\40\x68\162\x65\146\x3d\x22\150\x74\x74\160\x3a\x2f\x2f\160\x68\160\x2e\156\145\164\x2f\155\x61\156\165\141\x6c\57\145\x6e\x2f\143\165\162\154\x2e\x69\x6e\163\x74\141\154\154\141\164\x69\x6f\156\56\x70\150\x70\x22\x3e\120\110\120\40\143\125\x52\114\x20\x65\170\164\x65\156\x73\151\x6f\x6e\74\57\141\76\40\x69\163\x20\156\x6f\164\x20\151\156\163\164\x61\x6c\x6c\145\x64\40\157\162\x20\x64\151\163\x61\x62\x6c\145\x64\x2e"));
        aQ:
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\x6f\x61\163\57\141\x70\151\57\x61\165\x74\150\57\166\x61\x6c\x69\144\x61\164\145";
        $BM = curl_init($U8);
        $SA = $this->defaultCustomerId;
        $H2 = $this->defaultCustomerApiKey;
        $Pa = Utilities::get_timestamp();
        $bY = $SA . $Pa . $H2;
        $WC = hash("\163\x68\141\x35\x31\x32", $bY);
        $Jk = "\x43\x75\x73\x74\157\155\x65\162\x2d\x4b\x65\171\x3a\40" . $SA;
        $TU = "\124\x69\x6d\145\x73\x74\141\x6d\x70\x3a\x20" . $Pa;
        $A9 = "\x41\165\x74\x68\157\162\x69\172\x61\x74\151\157\x6e\x3a\x20" . $WC;
        $hA = array("\x74\170\111\x64" => $YP, "\x74\x6f\153\145\156" => $this->otpToken);
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($BM, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\103\157\156\x74\145\x6e\164\55\124\x79\160\x65\x3a\x20\x61\160\x70\154\151\x63\141\x74\x69\157\156\x2f\152\163\x6f\x6e", $Jk, $TU, $A9));
        curl_setopt($BM, CURLOPT_POST, TRUE);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto oa;
        }
        $Q2 = array("\x25\155\145\164\150\x6f\x64" => "\166\141\x6c\151\x64\141\164\145\x4f\x74\160", "\45\x66\x69\154\x65" => "\x63\165\x73\x74\x6f\155\x65\162\x5f\163\145\164\x75\160\x2e\160\x68\160", "\x25\145\x72\162\157\162" => curl_error($BM));
        watchdog("\x6d\151\156\151\x6f\162\x61\x6e\x67\145\x5f\163\x61\x6d\x6c\137\x69\144\160", "\105\162\162\157\162\40\x61\x74\x20\45\155\145\x74\x68\x6f\144\40\x6f\x66\x20\x25\x66\x69\154\x65\72\40\45\145\x72\162\157\x72", $Q2);
        oa:
        curl_close($BM);
        return $Y4;
    }
    function check_status($Z7)
    {
        global $base_url;
        if (Utilities::isCurlInstalled()) {
            goto xk;
        }
        return json_encode(array("\x73\x74\x61\x74\x75\163" => "\103\125\122\x4c\x5f\105\122\x52\x4f\x52", "\x73\x74\141\x74\165\x73\x4d\x65\163\163\x61\147\145" => "\x3c\x61\x20\150\x72\x65\146\75\x22\150\x74\x74\x70\72\x2f\57\160\x68\x70\56\x6e\x65\164\x2f\x6d\141\x6e\165\x61\x6c\57\145\156\57\x63\165\162\154\56\x69\x6e\x73\x74\x61\154\154\141\x74\151\x6f\156\x2e\x70\x68\160\42\76\120\110\x50\x20\x63\x55\122\114\x20\145\x78\164\145\x6e\163\151\157\x6e\74\57\x61\x3e\40\151\x73\x20\x6e\x6f\x74\40\151\x6e\x73\164\x61\154\154\145\144\40\x6f\162\40\144\151\163\141\x62\154\145\144\x2e"));
        xk:
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\x2f\x6d\157\x61\x73\57\x61\x70\x69\57\142\x61\x63\153\165\x70\x63\x6f\x64\x65\x2f\166\x65\162\x69\146\171";
        $BM = curl_init($U8);
        $SP = variable_get("\x6d\151\156\x69\x6f\162\x61\x6e\x67\145\x5f\x73\141\155\x6c\137\151\x64\160\137\143\x75\163\164\157\x6d\x65\162\x5f\x69\144", '');
        $r8 = variable_get("\x6d\x69\156\x69\157\x72\x61\x6e\x67\x65\x5f\x73\x61\x6d\x6c\137\x69\144\160\137\x63\165\x73\x74\157\155\145\x72\x5f\141\160\151\137\x6b\x65\171", '');
        $mo = Utilities::get_timestamp();
        $wV = $SP . $mo . $r8;
        $sO = hash("\x73\x68\x61\65\x31\62", $wV);
        $rt = "\103\165\163\x74\157\x6d\x65\162\x2d\113\x65\171\x3a\x20" . $SP;
        $EU = "\124\x69\x6d\145\163\164\141\x6d\160\72\x20" . $mo;
        $hE = "\x41\165\164\150\x6f\162\x69\172\x61\x74\x69\157\156\72\x20" . $sO;
        $hA = '';
        $hA = array("\x63\x6f\144\x65" => $Z7, "\x63\x75\163\x74\157\x6d\x65\x72\113\145\x79" => $SP, "\x61\144\144\151\x74\x69\x6f\x6e\141\154\x46\x69\x65\154\x64\163" => array("\146\x69\145\154\x64\61" => $base_url));
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($BM, CURLOPT_AUTOREFERER, true);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\x43\157\x6e\x74\145\x6e\164\55\x54\171\160\x65\x3a\x20\141\160\x70\x6c\x69\x63\141\164\151\157\156\57\152\x73\157\156", $rt, $EU, $hE));
        curl_setopt($BM, CURLOPT_POST, true);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        curl_setopt($BM, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($BM, CURLOPT_TIMEOUT, 20);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto rk;
        }
        echo "\x52\x65\x71\165\145\x73\164\x20\x45\x72\162\157\x72\72" . curl_error($BM);
        die;
        rk:
        curl_close($BM);
        $Y4 = json_decode($Y4, true);
        return $Y4;
    }
    function ccl()
    {
        global $base_url;
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\57\x6d\x6f\141\163\x2f\x72\x65\163\164\x2f\x63\165\x73\164\157\x6d\145\162\x2f\154\151\x63\145\156\x73\145";
        $BM = curl_init($U8);
        $SP = variable_get("\x6d\x69\x6e\x69\157\162\x61\x6e\x67\x65\137\x73\141\155\154\x5f\151\x64\x70\137\x63\x75\x73\x74\x6f\155\x65\x72\137\x69\x64", '');
        $r8 = variable_get("\x6d\151\156\151\157\162\141\156\147\x65\137\x73\141\x6d\x6c\137\151\144\160\x5f\143\165\x73\164\x6f\x6d\145\162\137\141\160\151\x5f\x6b\x65\x79", '');
        $mo = Utilities::get_timestamp();
        $wV = $SP . $mo . $r8;
        $sO = hash("\163\x68\x61\65\x31\62", $wV);
        $rt = "\103\x75\x73\x74\157\155\x65\162\55\x4b\145\171\72\x20" . $SP;
        $EU = "\124\x69\x6d\x65\163\x74\x61\155\x70\x3a\40" . $mo;
        $hE = "\101\x75\x74\x68\x6f\x72\151\x7a\141\164\151\157\x6e\72\x20" . $sO;
        $hA = '';
        $hA = array("\143\165\163\164\x6f\x6d\145\162\111\x64" => $SP, "\x61\160\160\154\151\x63\141\164\151\157\x6e\x4e\x61\x6d\x65" => "\144\x72\x75\160\141\x6c\x5f\163\x61\155\154\137\x69\x64\x70");
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($BM, CURLOPT_AUTOREFERER, true);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\103\x6f\156\164\145\156\164\55\x54\x79\x70\x65\72\40\x61\160\x70\154\x69\143\x61\164\151\x6f\156\57\152\163\x6f\156", $rt, $EU, $hE));
        curl_setopt($BM, CURLOPT_POST, true);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        curl_setopt($BM, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($BM, CURLOPT_TIMEOUT, 20);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto J3;
        }
        return null;
        J3:
        curl_close($BM);
        return $Y4;
    }
    function update_status()
    {
        $U8 = MiniorangeSAMLIdpConstants::BASE_URL . "\57\155\157\141\163\x2f\141\160\151\57\142\141\143\153\x75\160\x63\x6f\144\145\x2f\165\x70\144\141\x74\145\163\x74\x61\x74\x75\163";
        $BM = curl_init($U8);
        $SP = variable_get("\x6d\x69\x6e\151\157\162\141\x6e\147\x65\x5f\163\141\x6d\154\x5f\x69\144\160\x5f\143\165\163\x74\157\x6d\145\162\137\x69\144", '');
        $r8 = variable_get("\x6d\x69\x6e\151\x6f\162\x61\156\x67\x65\137\163\x61\155\154\137\x69\144\x70\x5f\x63\165\x73\x74\157\155\x65\x72\137\x61\160\151\137\153\x65\171", '');
        $FA = variable_get("\x6d\x69\x6e\x69\x6f\x72\x61\156\x67\145\x5f\x73\x61\x6d\x6c\137\x69\144\x70\137\163\155\x6c\137\x6c\x6b", '');
        $mo = Utilities::get_timestamp();
        $wV = $SP . $mo . $r8;
        $sO = hash("\x73\150\141\65\x31\x32", $wV);
        $rt = "\x43\165\x73\x74\x6f\x6d\x65\162\55\x4b\145\x79\x3a\40" . $SP;
        $EU = "\124\x69\x6d\145\163\164\x61\x6d\160\72\40" . $mo;
        $hE = "\101\x75\x74\x68\x6f\x72\151\x7a\x61\164\151\157\x6e\72\40" . $sO;
        $p1 = variable_get("\x6d\151\x6e\151\157\x72\x61\x6e\x67\x65\x5f\163\x61\155\154\137\151\144\x70\x5f\143\x75\x73\164\157\x6d\x65\162\137\x61\144\155\151\x6e\x5f\x74\157\153\145\x6e", '');
        $Z7 = Utilities::decrypt($FA, $p1);
        $hA = array("\143\x6f\x64\145" => $Z7, "\x63\165\x73\164\157\155\145\162\x4b\x65\171" => $SP);
        $X1 = json_encode($hA);
        curl_setopt($BM, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($BM, CURLOPT_ENCODING, '');
        curl_setopt($BM, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($BM, CURLOPT_AUTOREFERER, true);
        curl_setopt($BM, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($BM, CURLOPT_MAXREDIRS, 10);
        curl_setopt($BM, CURLOPT_HTTPHEADER, array("\x43\157\x6e\164\x65\x6e\164\55\124\x79\160\x65\x3a\x20\x61\x70\160\154\x69\x63\x61\164\151\x6f\156\57\x6a\x73\x6f\x6e", $rt, $EU, $hE));
        curl_setopt($BM, CURLOPT_POST, true);
        curl_setopt($BM, CURLOPT_POSTFIELDS, $X1);
        curl_setopt($BM, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($BM, CURLOPT_TIMEOUT, 20);
        $Y4 = curl_exec($BM);
        if (!curl_errno($BM)) {
            goto wl;
        }
        echo "\x52\145\161\x75\x65\x73\x74\x20\105\162\x72\x6f\162\x3a" . curl_error($BM);
        die;
        wl:
        curl_close($BM);
        return $Y4;
    }
}
