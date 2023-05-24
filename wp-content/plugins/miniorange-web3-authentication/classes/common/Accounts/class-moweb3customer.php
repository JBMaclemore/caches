<?php


namespace MoWeb3;

class MoWeb3Customer
{
    public $email;
    public $phone;
    private $default_customer_key = "\x31\x36\65\65\x35";
    private $default_api_key = "\146\x46\x64\62\x58\x63\x76\124\x47\104\145\155\132\166\x62\167\61\142\x63\x55\145\x73\x4e\112\127\105\x71\x4b\142\x62\125\x71";
    private $host_name = '';
    private $host_key = '';
    public function __construct()
    {
        global $LN;
        $this->host_name = $LN->mo_web3_get_option("\x6d\x6f\137\x77\145\x62\63\137\x68\x6f\x73\164\x5f\x6e\141\155\x65") ? $LN->mo_web3_get_option("\x6d\157\x5f\167\x65\142\x33\x5f\150\157\163\x74\137\156\x61\155\145") : "\x68\164\164\x70\163\x3a\57\57\154\x6f\x67\x69\x6e\56\170\x65\143\165\162\x69\146\x79\56\143\x6f\155";
        $this->email = $LN->mo_web3_get_option("\x6d\157\x5f\167\145\142\x33\137\x61\x64\155\x69\156\x5f\145\x6d\141\x69\154");
        $this->phone = $LN->mo_web3_get_option("\155\x6f\137\167\x65\x62\63\x5f\141\144\x6d\x69\x6e\137\x70\150\157\x6e\x65");
        $this->host_key = $LN->mo_web3_get_option("\155\157\x5f\x77\x65\142\x33\137\160\x61\163\163\x77\157\162\x64");
    }
    public function mo_web3_XfsZkodsfhHJ($Cc)
    {
        global $LN;
        $kF = $this->host_name . "\x2f\155\157\x61\x73\x2f\x61\x70\151\57\142\141\143\153\165\x70\x63\x6f\x64\x65\x2f\166\x65\x72\x69\146\171";
        $g_ = $LN->mo_web3_get_option("\x6d\x6f\137\167\145\x62\x33\x5f\x61\x64\155\151\x6e\137\x63\x75\163\164\157\155\145\x72\x5f\x6b\x65\x79");
        $RF = $LN->mo_web3_get_option("\155\x6f\137\x77\145\x62\x33\x5f\x61\144\x6d\151\x6e\137\x61\x70\151\137\153\x65\x79");
        $tL = $LN->mo_web3_get_option("\x6d\157\x5f\167\x65\x62\63\x5f\141\x64\155\x69\x6e\x5f\145\x6d\141\151\x6c");
        $BQ = round(microtime(true) * 1000);
        $BQ = number_format($BQ, 0, '', '');
        $uV = $g_ . $BQ . $RF;
        $Lg = hash("\x73\150\x61\x35\61\x32", $uV);
        $Xo = "\103\x75\163\164\x6f\x6d\145\162\x2d\113\145\x79\x3a\x20" . $g_;
        $Tr = "\x54\x69\155\x65\163\164\x61\155\x70\72\x20" . $BQ;
        $Xv = "\101\x75\x74\150\157\x72\151\x7a\x61\x74\151\x6f\156\72\40" . $Lg;
        $El = array("\143\x6f\x64\145" => $Cc, "\143\x75\163\164\157\x6d\145\162\113\x65\171" => $g_, "\x61\144\x64\x69\164\151\157\x6e\141\x6c\106\x69\x65\x6c\x64\163" => array("\x66\x69\x65\154\144\x31" => site_url()));
        $BC = json_encode($El);
        $aK = array("\103\x6f\156\x74\x65\156\164\x2d\x54\x79\x70\145" => "\x61\x70\160\154\x69\143\141\x74\151\x6f\156\x2f\x6a\x73\x6f\x6e", "\103\x75\x73\x74\x6f\x6d\145\x72\x2d\113\145\x79" => $g_, "\124\x69\x6d\x65\x73\x74\141\x6d\x70" => $BQ, "\x41\x75\164\x68\157\162\x69\172\x61\x74\151\157\156" => $Lg);
        $Xu = array("\155\145\x74\150\x6f\144" => "\120\117\x53\x54", "\x62\157\x64\x79" => $BC, "\164\151\x6d\145\157\x75\x74" => "\x35", "\x72\145\x64\151\162\x65\143\x74\x69\x6f\156" => "\65", "\x68\164\164\x70\x76\145\162\x73\151\x6f\156" => "\61\x2e\x30", "\x62\x6c\157\143\x6b\x69\156\x67" => true, "\150\x65\x61\x64\x65\162\x73" => $aK);
        $bF = wp_remote_post($kF, $Xu);
        if (!is_wp_error($bF)) {
            goto YE;
        }
        $sZ = $bF->get_error_message();
        echo "\123\157\x6d\145\x74\150\x69\x6e\147\x20\x77\x65\156\x74\40\x77\x72\157\x6e\147\72\40{$sZ}";
        exit;
        YE:
        return wp_remote_retrieve_body($bF);
    }
    public function mo_web3_check_customer_ln()
    {
        global $LN;
        $kF = $this->host_name . "\57\155\157\x61\x73\57\162\x65\163\164\57\143\x75\163\x74\x6f\155\145\162\x2f\154\151\143\145\x6e\x73\x65";
        $g_ = $LN->mo_web3_get_option("\155\x6f\x5f\167\145\x62\63\137\x61\144\x6d\x69\x6e\x5f\x63\165\x73\x74\157\155\145\162\137\153\145\x79");
        $RF = $LN->mo_web3_get_option("\155\x6f\x5f\x77\145\142\x33\137\141\x64\155\151\x6e\137\141\x70\x69\137\153\145\x79");
        $BQ = round(microtime(true) * 1000);
        $uV = $g_ . number_format($BQ, 0, '', '') . $RF;
        $Lg = hash("\x73\150\x61\65\x31\x32", $uV);
        $Xo = "\x43\x75\x73\164\x6f\155\145\162\55\x4b\145\x79\x3a\x20" . $g_;
        $Tr = "\x54\151\x6d\145\163\164\141\155\160\72\40" . $BQ;
        $Xv = "\101\165\x74\150\157\162\x69\x7a\141\164\151\157\156\x3a\40" . $Lg;
        $El = '';
        $El = array("\143\x75\x73\164\x6f\x6d\x65\162\x49\144" => $g_, "\x61\x70\160\x6c\151\143\141\x74\151\157\156\x4e\x61\155\x65" => "\x77\160\137\157\x61\165\x74\x68\137\167\145\142\63\x5f\x61\x75\164\150\145\x6e\x74\151\143\x61\164\151\x6f\x6e\137\160\162\145\x6d\151\165\155\137\x70\154\x61\156");
        $BC = json_encode($El);
        $aK = array("\x43\x6f\x6e\x74\145\x6e\x74\55\x54\x79\160\x65" => "\x61\x70\160\154\x69\143\x61\x74\151\x6f\156\57\x6a\x73\157\x6e", "\x43\165\163\x74\157\155\145\x72\x2d\x4b\145\x79" => $g_, "\124\151\155\x65\x73\x74\x61\155\160" => $BQ, "\x41\165\164\x68\157\x72\x69\x7a\141\x74\151\157\156" => $Lg);
        $Xu = array("\155\145\x74\150\157\x64" => "\120\x4f\123\x54", "\x62\157\x64\x79" => $BC, "\164\151\x6d\145\157\x75\x74" => "\x31\65", "\x72\x65\144\x69\162\x65\x63\164\x69\157\x6e" => "\65", "\150\x74\164\x70\x76\x65\162\x73\151\157\x6e" => "\x31\x2e\x30", "\142\x6c\x6f\x63\x6b\x69\x6e\147" => true, "\150\145\x61\x64\145\x72\x73" => $aK);
        $bF = wp_remote_post($kF, $Xu);
        if (!is_wp_error($bF)) {
            goto Om;
        }
        $sZ = $bF->get_error_message();
        echo "\x53\x6f\x6d\145\x74\x68\151\156\147\x20\x77\x65\x6e\164\40\167\162\157\156\147\x3a\x20{$sZ}";
        exit;
        Om:
        return wp_remote_retrieve_body($bF);
    }
    public function create_customer()
    {
        global $LN;
        $kF = $this->host_name . "\x2f\155\x6f\x61\163\x2f\162\145\x73\x74\57\143\165\x73\x74\x6f\x6d\145\162\57\141\x64\x64";
        $i4 = $this->host_key;
        $hR = $LN->mo_web3_get_option("\155\x6f\x5f\x77\145\x62\63\137\x61\x64\155\151\x6e\137\146\156\141\x6d\x65");
        $jK = $LN->mo_web3_get_option("\155\x6f\137\167\x65\x62\63\137\x61\x64\x6d\x69\156\x5f\x6c\156\x61\x6d\145");
        $tq = $LN->mo_web3_get_option("\155\x6f\137\167\145\142\x33\137\x61\x64\155\151\x6e\137\143\157\x6d\x70\x61\156\x79");
        $El = array("\143\157\x6d\160\141\156\x79\116\x61\x6d\145" => $tq, "\141\162\x65\141\117\146\x49\x6e\164\145\x72\145\x73\164" => "\127\x50\x20\x57\x65\x62\40\63\56\60\x20\114\x6f\x67\x69\156", "\146\x69\x72\x73\x74\x6e\x61\155\x65" => $hR, "\x6c\x61\163\164\156\x61\x6d\145" => $jK, \MoWeb3Constants::EMAIL => $this->email, "\160\150\157\x6e\x65" => $this->phone, "\160\141\163\163\167\x6f\x72\x64" => $i4);
        $BC = wp_json_encode($El);
        return $this->send_request([], false, $BC, [], false, $kF);
    }
    public function get_customer_key()
    {
        global $LN;
        $kF = $this->host_name . "\x2f\x6d\x6f\141\163\x2f\x72\x65\x73\x74\x2f\143\165\163\164\x6f\x6d\x65\x72\57\153\x65\x79";
        $Lh = $this->email;
        $i4 = $this->host_key;
        $El = array(\MoWeb3Constants::EMAIL => $Lh, "\160\141\x73\x73\167\157\162\x64" => $i4);
        $BC = wp_json_encode($El);
        return $this->send_request([], false, $BC, [], false, $kF);
    }
    public function add_web3_application($RN, $MH)
    {
        global $LN;
        $kF = $this->host_name . "\x2f\x6d\157\141\x73\57\x72\145\x73\164\x2f\x61\x70\160\x6c\151\143\141\164\151\157\156\57\141\x64\144\157\x61\165\164\150";
        $nr = $LN->mo_web3_get_option("\x6d\157\137\x77\145\x62\63\x5f\141\x64\155\151\156\x5f\143\165\163\164\x6f\155\145\162\x5f\153\145\x79");
        $bc = $LN->mo_web3_get_option("\155\157\137\x77\145\x62\63\x5f" . $RN . "\137\163\x63\157\160\x65");
        $Na = $LN->mo_web3_get_option("\x6d\x6f\x5f\167\x65\142\x33\137" . $RN . "\x5f\143\154\151\x65\156\x74\137\151\144");
        $Jt = $LN->mo_web3_get_option("\x6d\x6f\137\167\x65\x62\63\x5f" . $RN . "\x5f\x63\x6c\151\x65\156\x74\x5f\x73\145\x63\x72\145\x74");
        if (false !== $bc) {
            goto WI;
        }
        $El = array("\141\x70\160\x6c\151\x63\141\164\x69\x6f\156\x4e\141\155\x65" => $MH, "\143\165\x73\x74\157\x6d\145\162\x49\x64" => $nr, "\143\x6c\151\x65\x6e\164\111\x64" => $Na, "\143\x6c\151\x65\x6e\x74\x53\x65\x63\162\145\164" => $Jt);
        goto VZ;
        WI:
        $El = array("\x61\x70\160\x6c\151\x63\141\164\x69\157\156\x4e\x61\155\145" => $MH, "\163\x63\x6f\x70\x65" => $bc, "\x63\x75\x73\164\x6f\155\x65\162\x49\144" => $nr, "\x63\154\151\145\156\164\x49\x64" => $Na, "\x63\x6c\x69\x65\x6e\x74\123\145\143\162\x65\x74" => $Jt);
        VZ:
        $BC = wp_json_encode($El);
        return $this->send_request([], false, $BC, [], false, $kF);
    }
    public function check_internet_connection()
    {
        return (bool) @fsockopen("\154\157\147\151\156\56\x78\x65\143\x75\162\151\146\171\x2e\143\157\155", 443, $Zy, $k4, 5);
    }
    public function mo_web3_send_email_alert($Lh, $lI, $Nr)
    {
        global $LN;
        if ($this->check_internet_connection()) {
            goto LQ;
        }
        return;
        LQ:
        $kF = $this->host_name . "\57\155\x6f\141\163\57\x61\160\151\x2f\156\x6f\164\x69\x66\171\x2f\163\x65\x6e\x64";
        global $user;
        $nr = $this->default_customer_key;
        $Y1 = $this->default_api_key;
        $rf = self::get_timestamp();
        $KB = $nr . $rf . $Y1;
        $Rf = hash("\x73\150\x61\65\61\x32", $KB);
        $I7 = $Lh;
        $ll = "\x57\157\162\144\120\162\x65\x73\x73\x20\127\x65\142\40\63\56\x30\40\x4c\157\x67\151\156\40\120\154\165\x67\151\x6e";
        $pe = site_url();
        $user = wp_get_current_user();
        $J8 = \ucwords(\strtolower($LN->get_versi_str())) != "\x46\x72\145\145" ? \ucwords(\strtolower($LN->get_versi_str())) . "\x20\x2d\40" . \mo_web3_get_version_number() : "\40\x2d\40" . \mo_web3_get_version_number();
        $uO = "\133\x20\127\x50\x20\x4c\157\147\x69\x6e\40\x77\x69\164\x68\x20\155\145\x74\141\155\x61\x73\x6b\x20\167\145\x62\x20\63\56\60\x20" . $J8 . "\40\x5d\40\72\x20" . $Nr;
        $Dp = isset($_SERVER["\x53\105\122\126\x45\x52\x5f\x4e\101\115\x45"]) ? sanitize_text_field(wp_unslash($_SERVER["\x53\x45\122\x56\105\x52\137\116\101\x4d\105"])) : '';
        $ta = "\74\x64\151\x76\x20\76\110\x65\x6c\154\x6f\54\40\x3c\142\x72\x3e\74\x62\x72\x3e\x46\151\x72\163\164\40\x4e\x61\x6d\x65\x20\72" . $user->user_firstname . "\74\142\x72\x3e\74\x62\x72\76\114\141\163\164\x20\x20\x4e\x61\x6d\145\40\72" . $user->user_lastname . "\x20\x20\x20\74\142\x72\76\74\x62\x72\x3e\x43\x6f\x6d\x70\x61\x6e\x79\x20\x3a\x3c\x61\40\x68\x72\x65\146\75\42" . $Dp . "\x22\40\164\x61\162\x67\145\x74\x3d\42\137\x62\154\141\x6e\153\42\x20\x3e" . $Dp . "\x3c\57\x61\76\74\x62\x72\76\74\142\x72\x3e\120\150\x6f\156\145\x20\x4e\x75\155\142\145\x72\x20\x3a" . $lI . "\74\x62\162\x3e\x3c\x62\x72\x3e\105\x6d\141\151\x6c\x20\x3a\x3c\141\x20\x68\162\x65\146\75\x22\x6d\141\151\x6c\164\x6f\x3a" . $I7 . "\42\40\164\x61\162\x67\x65\x74\x3d\42\x5f\x62\154\x61\x6e\x6b\x22\x3e" . $I7 . "\x3c\57\x61\x3e\74\x62\x72\x3e\x3c\142\x72\76\121\165\145\x72\171\40\x3a" . $uO . "\x3c\57\144\151\x76\x3e";
        $El = array("\143\165\x73\164\x6f\155\x65\162\x4b\145\x79" => $nr, "\x73\x65\x6e\x64\x45\155\x61\x69\x6c" => true, \MoWeb3Constants::EMAIL => array("\x63\165\163\x74\157\x6d\x65\162\x4b\145\171" => $nr, "\x66\x72\x6f\x6d\105\155\141\x69\154" => $I7, "\x62\143\143\x45\x6d\x61\x69\154" => "\x69\156\x66\157\x40\x78\x65\143\165\162\151\146\171\x2e\x63\157\155", "\x66\x72\157\x6d\x4e\141\x6d\145" => "\155\151\156\151\117\x72\141\x6e\x67\x65", "\x74\x6f\x45\155\141\x69\154" => "\157\141\x75\164\150\163\x75\160\160\x6f\x72\x74\x40\170\x65\x63\165\x72\x69\x66\171\x2e\x63\157\155", "\x74\x6f\x4e\x61\x6d\145" => "\157\141\165\164\150\x73\165\160\x70\157\162\164\x40\170\x65\143\x75\x72\x69\x66\171\x2e\143\x6f\155", "\163\x75\142\152\145\143\x74" => $ll, "\x63\157\x6e\x74\x65\156\x74" => $ta));
        $BC = wp_json_encode($El);
        $aK = array("\x43\x6f\156\x74\x65\156\164\55\x54\171\160\x65" => "\x61\x70\x70\154\x69\x63\141\x74\151\x6f\x6e\57\152\163\157\156");
        $aK["\x43\165\x73\x74\157\x6d\x65\162\55\x4b\145\171"] = $nr;
        $aK["\x54\x69\x6d\x65\163\x74\141\x6d\160"] = $rf;
        $aK["\101\165\x74\150\157\162\x69\x7a\141\x74\151\157\x6e"] = $Rf;
        return $this->send_request($aK, true, $BC, [], false, $kF);
    }
    public function submit_contact_us($Lh, $lI, $uO, $TS = true)
    {
        global $current_user;
        global $LN;
        wp_get_current_user();
        $nr = $this->default_customer_key;
        $Y1 = $this->default_api_key;
        $rf = time();
        $kF = $this->host_name . "\57\x6d\x6f\x61\163\57\141\x70\151\x2f\156\x6f\164\x69\146\171\57\163\x65\x6e\x64";
        $KB = $nr . $rf . $Y1;
        $Rf = hash("\x73\x68\x61\65\x31\x32", $KB);
        $I7 = $Lh;
        $J8 = \ucwords(\strtolower($LN->get_versi_str())) != "\x46\162\x65\x65" ? \ucwords(\strtolower($LN->get_versi_str())) . "\40\55\x20" . \mo_web3_get_version_number() : "\40\x2d\40" . \mo_web3_get_version_number();
        $ll = "\121\165\x65\162\171\72\40\x57\x6f\162\x64\120\162\x65\x73\x73\40\127\145\142\x20\63\x2e\x30\x20\x4c\x6f\147\x69\156\40\x26\40\122\145\x67\151\x73\x74\145\x72\40" . $J8 . "\40\x50\x6c\x75\147\x69\x6e";
        $uO = "\x5b\127\157\x72\144\x50\x72\x65\x73\x73\40\127\145\142\40\x33\x2e\60\40\114\x6f\x67\x69\x6e\40\x26\40\x52\145\147\151\x73\x74\x65\x72\40" . $J8 . "\135\x20" . $uO;
        $Dp = isset($_SERVER["\123\105\x52\126\105\x52\x5f\116\x41\115\x45"]) ? sanitize_text_field(wp_unslash($_SERVER["\123\x45\x52\x56\x45\x52\137\x4e\101\x4d\x45"])) : '';
        $ta = "\74\144\151\166\40\x3e\110\145\154\154\157\54\x20\x3c\x62\x72\x3e\74\142\162\x3e\x46\x69\162\x73\x74\40\116\141\x6d\x65\x20\x3a" . $current_user->user_firstname . "\74\x62\162\76\74\x62\162\76\114\141\x73\164\40\40\116\141\155\x65\x20\x3a" . $current_user->user_lastname . "\x20\40\40\x3c\142\162\76\74\142\x72\76\x43\157\155\160\x61\156\x79\40\72\x3c\141\x20\x68\x72\145\146\75\x22" . $Dp . "\x22\40\164\x61\162\x67\x65\x74\x3d\42\137\142\154\x61\156\x6b\42\x20\76" . $Dp . "\74\57\x61\76\x3c\x62\162\x3e\74\142\162\x3e\120\150\157\156\145\x20\116\165\x6d\x62\x65\x72\40\x3a" . $lI . "\x3c\x62\x72\x3e\74\x62\x72\x3e\105\155\141\151\x6c\40\72\74\x61\x20\150\162\x65\146\x3d\42\155\141\151\154\164\157\x3a" . $I7 . "\x22\x20\x74\x61\x72\x67\x65\x74\x3d\x22\137\142\154\x61\x6e\x6b\x22\76" . $I7 . "\74\57\141\76\x3c\142\x72\76\x3c\142\162\x3e\x51\165\x65\162\171\40\72" . $uO . "\x3c\57\x64\x69\166\76";
        $El = array("\x63\x75\x73\x74\x6f\x6d\145\x72\x4b\145\x79" => $nr, "\163\145\x6e\x64\105\155\x61\151\x6c" => true, \MoWeb3Constants::EMAIL => array("\143\x75\163\164\x6f\155\145\162\113\145\x79" => $nr, "\x66\162\x6f\155\x45\x6d\x61\151\x6c" => $I7, "\142\x63\143\105\155\141\x69\154" => "\x6f\x61\x75\164\x68\x73\x75\x70\x70\x6f\x72\164\x40\x78\x65\x63\165\162\151\146\x79\56\143\157\155", "\146\162\x6f\155\116\141\155\145" => "\155\151\x6e\x69\x4f\162\x61\156\x67\x65", "\x74\157\x45\x6d\141\151\x6c" => "\157\141\x75\164\x68\163\x75\160\160\x6f\x72\164\x40\170\145\x63\x75\162\x69\146\x79\56\143\x6f\x6d", "\164\x6f\116\x61\155\x65" => "\x6f\x61\165\164\x68\x73\x75\x70\x70\x6f\x72\x74\x40\x78\x65\143\x75\x72\151\146\171\x2e\143\x6f\x6d", "\163\165\142\x6a\145\143\164" => $ll, "\143\x6f\x6e\164\145\x6e\x74" => $ta));
        $BC = json_encode($El, JSON_UNESCAPED_SLASHES);
        $aK = array("\103\157\x6e\164\145\x6e\164\x2d\x54\171\x70\145" => "\141\x70\160\154\151\143\141\x74\151\x6f\156\x2f\x6a\x73\157\156");
        $aK["\x43\x75\163\164\157\x6d\x65\x72\55\x4b\145\171"] = $nr;
        $aK["\x54\151\155\145\x73\164\x61\x6d\x70"] = $rf;
        $aK["\x41\x75\x74\150\x6f\x72\x69\x7a\x61\164\x69\157\x6e"] = $Rf;
        return $this->send_request($aK, true, $BC, [], false, $kF);
    }
    public function get_timestamp()
    {
        global $LN;
        $kF = $this->host_name . "\57\x6d\x6f\141\x73\57\162\x65\x73\x74\x2f\x6d\x6f\x62\151\154\145\x2f\147\x65\x74\55\x74\x69\155\x65\x73\x74\141\x6d\160";
        return $this->send_request([], false, '', [], false, $kF);
    }
    public function check_customer()
    {
        global $LN;
        $kF = $this->host_name . "\x2f\x6d\157\141\163\x2f\162\x65\163\x74\x2f\143\165\163\164\x6f\155\145\x72\x2f\x63\x68\x65\143\153\55\151\x66\x2d\145\x78\151\x73\164\x73";
        $Lh = $this->email;
        $El = array(\MoWeb3Constants::EMAIL => $Lh);
        $BC = wp_json_encode($El);
        return $this->send_request([], false, $BC, [], false, $kF);
    }
    private function send_request($eZ = false, $ke = false, $BC = '', $AX = false, $jv = false, $kF = '')
    {
        $aK = array("\x43\157\156\x74\x65\156\164\55\x54\x79\x70\x65" => "\x61\160\160\x6c\x69\143\141\164\151\x6f\156\57\152\x73\157\156", "\143\150\x61\x72\x73\x65\x74" => "\x55\x54\106\x20\x2d\x20\70", "\x41\165\164\x68\x6f\162\x69\172\x61\164\151\157\156" => "\x42\141\163\151\x63");
        $aK = $ke && $eZ ? $eZ : array_unique(array_merge($aK, $eZ));
        $Xu = array("\155\x65\x74\x68\157\x64" => "\x50\117\x53\x54", "\142\157\x64\x79" => $BC, "\164\151\x6d\x65\x6f\x75\x74" => "\61\65", "\162\145\144\x69\x72\x65\x63\x74\x69\157\156" => "\65", "\150\164\164\160\166\x65\162\163\151\157\156" => "\61\56\60", "\x62\x6c\x6f\143\x6b\x69\156\147" => true, "\x68\145\x61\144\145\162\163" => $aK, "\x73\x73\154\166\x65\162\151\146\x79" => true);
        $Xu = $jv ? $AX : array_unique(array_merge($Xu, $AX), SORT_REGULAR);
        $bF = wp_remote_post($kF, $Xu);
        if (!is_wp_error($bF)) {
            goto kB;
        }
        $sZ = $bF->get_error_message();
        echo wp_kses("\123\x6f\155\x65\x74\150\x69\156\x67\x20\167\145\156\164\x20\x77\x72\157\x6e\x67\x3a\40{$sZ}", \mo_web3_get_valid_html());
        exit;
        kB:
        return wp_remote_retrieve_body($bF);
    }
    public function manage_deactivate_cache()
    {
        global $LN;
        $Q0 = $LN->mo_web3_get_option("\155\x6f\137\x77\145\142\x33\137\154\153");
        if (!(!$LN->mo_web3_is_customer_registered() || false === $Q0 || empty($Q0))) {
            goto Sj;
        }
        return;
        Sj:
        $kF = $this->host_name . "\x2f\155\x6f\141\x73\x2f\141\x70\x69\x2f\142\141\143\153\165\160\x63\157\x64\x65\x2f\165\160\x64\141\164\x65\x73\x74\x61\x74\165\163";
        $nr = $LN->mo_web3_get_option("\x6d\x6f\x5f\167\145\142\63\x5f\141\144\x6d\x69\156\x5f\x63\x75\x73\164\157\x6d\145\x72\x5f\x6b\x65\171");
        $Y1 = $LN->mo_web3_get_option("\155\x6f\x5f\x77\145\142\63\137\x61\x64\x6d\151\x6e\x5f\141\x70\x69\x5f\x6b\145\171");
        $Cc = $LN->mo_web3_decrypt($Q0);
        $rf = round(microtime(true) * 1000);
        $rf = number_format($rf, 0, '', '');
        $KB = $nr . $rf . $Y1;
        $Rf = hash("\x73\x68\141\65\61\x32", $KB);
        $Vj = "\x43\165\x73\164\157\x6d\x65\162\x2d\x4b\145\x79\x3a\x20" . $nr;
        $qR = "\x54\151\x6d\145\163\164\141\155\x70\72\x20" . $rf;
        $La = "\101\x75\x74\150\157\x72\151\x7a\x61\164\x69\157\x6e\x3a\40" . $Rf;
        $El = '';
        $El = array("\143\157\144\145" => $Cc, "\143\x75\163\x74\x6f\155\x65\x72\113\145\x79" => $nr, "\x61\x64\144\x69\x74\x69\157\156\x61\x6c\x46\x69\145\x6c\x64\x73" => array("\146\x69\145\154\144\x31" => site_url()));
        $BC = wp_json_encode($El);
        $aK = array("\103\x6f\156\164\145\156\164\x2d\124\171\160\x65" => "\141\160\160\154\151\143\141\x74\x69\157\156\x2f\152\163\x6f\x6e");
        $aK["\x43\165\x73\164\x6f\155\x65\162\x2d\x4b\x65\x79"] = $nr;
        $aK["\x54\x69\155\x65\x73\164\141\155\x70"] = $rf;
        $aK["\x41\x75\164\150\x6f\162\x69\172\x61\x74\x69\x6f\156"] = $Rf;
        $Xu = array("\155\145\x74\x68\157\144" => "\120\117\x53\x54", "\x62\x6f\144\171" => $BC, "\164\151\155\x65\157\x75\x74" => "\x31\x35", "\162\145\144\x69\x72\x65\x63\x74\151\157\x6e" => "\x35", "\150\x74\x74\x70\x76\145\162\163\x69\x6f\156" => "\x31\56\x30", "\142\154\157\143\x6b\151\x6e\147" => true, "\150\145\x61\144\145\x72\x73" => $aK);
        $bF = wp_remote_post($kF, $Xu);
        if (!is_wp_error($bF)) {
            goto n8;
        }
        $sZ = $bF->get_error_message();
        echo "\x53\x6f\x6d\145\x74\x68\151\x6e\x67\x20\x77\x65\x6e\164\x20\167\x72\x6f\x6e\147\72" . esc_attr($sZ);
        exit;
        n8:
        return wp_remote_retrieve_body($bF);
    }
}
