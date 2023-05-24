<?php


namespace MoWeb3;

class MoWeb3Utils
{
    public function __construct()
    {
        remove_action("\x61\144\155\x69\156\x5f\x6e\157\164\151\143\x65\x73", array($this, "\155\x6f\x5f\x77\145\142\x33\x5f\163\x75\143\x63\x65\163\163\x5f\x6d\145\163\163\x61\x67\145"));
        remove_action("\141\x64\x6d\151\156\137\156\x6f\x74\151\x63\145\x73", array($this, "\155\x6f\x5f\167\145\142\63\137\x65\x72\x72\157\x72\137\x6d\145\163\x73\x61\x67\x65"));
        add_action("\155\x6f\x5f\167\x65\142\x33\137\x63\154\x65\x61\162\137\160\x6c\x75\x67\x5f\143\x61\x63\x68\x65", array($this, "\155\141\156\x61\x67\x65\x5f\x64\145\141\143\x74\x69\x76\x61\x74\x65\x5f\x63\141\143\x68\x65"));
    }
    public function trim_the_wallet_address($bY)
    {
        $oO = strlen($bY);
        $zH = substr($bY, 0, 5);
        $zH .= "\56\56\x2e";
        $zH .= substr($bY, $oO - 4, 4);
        return $zH;
    }
    public function get_current_page_url()
    {
        $uG = "\x68\164\x74\160\72\57\57";
        $UN = '';
        if (isset($_SERVER["\123\105\122\x56\x45\x52\137\x4e\101\x4d\105"])) {
            goto bd;
        }
        global $xc;
        $UN = $xc;
        goto uW;
        bd:
        if (!isset($_SERVER["\110\124\x54\120\123"])) {
            goto Zb;
        }
        $uG = "\x68\x74\x74\x70\163\x3a\57\57";
        Zb:
        $UN = sanitize_text_field($_SERVER["\123\x45\x52\126\105\x52\x5f\x4e\101\115\105"]);
        uW:
        $RZ = isset($_SERVER["\x52\105\x51\125\105\123\x54\x5f\x55\x52\x49"]) ? sanitize_text_field($_SERVER["\122\x45\121\125\105\123\x54\137\125\122\x49"]) : '';
        $uG .= $UN . $RZ;
        return $uG;
    }
    public function mo_web3_get_user($m5)
    {
        $VM = $this->mo_web3_get_option("\x6d\x6f\x5f\x77\145\142\x33\x5f\x75\x73\x65\162\x6e\141\155\145\137\163\x70\145\143\151\x66\x69\143\x61\x74\x69\x6f\156");
        $So = md5($m5);
        if ($VM) {
            goto EE;
        }
        $KY = $m5;
        goto Jq;
        EE:
        $KY = $So;
        Jq:
        $CM = '';
        $xG = username_exists($m5) ? true : false;
        if (!$xG) {
            goto b0;
        }
        $user = get_user_by("\x6c\x6f\x67\151\156", $m5);
        return $user;
        goto FQ;
        b0:
        $Ez = username_exists($So) ? get_user_by("\x6c\157\147\151\x6e", $So) : false;
        if (!$Ez) {
            goto tG;
        }
        $bo = __("\125\x73\x65\162\x20\x61\x6c\162\145\x61\144\171\40\145\170\151\163\164\x73\x2e\40\x20\120\x61\x73\163\167\157\162\144\40\x69\x6e\x68\145\162\x69\164\145\144\56", "\x74\145\x78\164\x64\157\x6d\x61\151\x6e");
        return $Ez;
        goto I4;
        tG:
        $bo = wp_generate_password($fX = 12, $sz = false);
        $nk = wp_create_user($KY, $bo, $CM);
        $user = get_user_by("\154\x6f\147\x69\156", $KY);
        return $user;
        I4:
        FQ:
    }
    public function mo_web3_is_clv()
    {
        $u7 = $this->mo_web3_get_option("\x6d\x6f\137\x77\145\x62\63\x5f\x6c\x6b");
        $No = $this->mo_web3_get_option("\x6d\157\x5f\x77\145\142\x33\137\154\x76");
        if (!$No) {
            goto no;
        }
        $No = $this->mo_web3_decrypt($No);
        no:
        if (!(!empty($u7) && $No == "\164\x72\x75\145")) {
            goto Yg;
        }
        return 1;
        Yg:
        return 0;
    }
    public function mo_web3_set_transient($ai, $K_, $xB)
    {
        return set_transient($ai, $K_, $xB);
    }
    public function mo_web3_get_transient($ai)
    {
        return get_transient($ai);
    }
    public function mo_web3_delete_transient($ai)
    {
        return delete_transient($ai);
    }
    public function manage_deactivate_cache()
    {
        $o4 = new \MoWeb3\MoWeb3Customer();
        $o4->manage_deactivate_cache();
    }
    public function mo_web3_success_message()
    {
        $uW = "\x75\160\x64\x61\164\x65\x64";
        $Nr = $this->mo_web3_get_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION);
        echo "\74\144\151\166\40\143\x6c\141\163\x73\x3d\x27" . esc_html($uW) . "\47\76\x20\x3c\x70\x3e" . esc_html($Nr) . "\x3c\x2f\x70\76\74\57\144\x69\x76\x3e";
    }
    public function mo_web3_error_message()
    {
        $uW = "\145\x72\162\157\x72";
        $Nr = $this->mo_web3_get_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION);
        echo "\x3c\x64\151\x76\40\x63\x6c\x61\x73\163\75\47" . esc_html($uW) . "\x27\x3e\x3c\x70\76" . esc_html($Nr) . "\x3c\x2f\x70\76\74\x2f\x64\151\x76\76";
    }
    public function mo_web3_show_success_message()
    {
        remove_action("\x61\144\x6d\151\156\137\156\x6f\164\x69\x63\x65\x73", array($this, "\x6d\x6f\x5f\167\145\x62\63\137\145\x72\x72\x6f\162\137\155\x65\x73\163\141\x67\x65"));
        add_action("\141\144\155\x69\x6e\137\156\x6f\164\x69\143\x65\163", array($this, "\155\157\x5f\x77\145\x62\x33\x5f\163\x75\x63\x63\x65\x73\163\137\155\145\163\163\141\x67\145"));
    }
    public function send_json_response($bF)
    {
        $Cc = isset($bF["\143\x6f\x64\x65"]) ? $bF["\x63\157\144\145"] : 302;
        wp_send_json($bF, $Cc);
    }
    public function mo_web3_show_error_message()
    {
        remove_action("\x61\144\155\151\x6e\137\x6e\157\x74\151\x63\x65\x73", array($this, "\155\157\x5f\167\x65\x62\x33\x5f\x73\x75\143\x63\145\163\163\x5f\155\x65\163\163\141\147\145"));
        add_action("\x61\144\x6d\151\x6e\137\156\157\164\151\143\145\x73", array($this, "\x6d\x6f\x5f\x77\x65\142\63\137\x65\x72\x72\157\162\137\155\145\163\163\x61\x67\x65"));
    }
    public function mo_web3_is_customer_registered()
    {
        $Lh = $this->mo_web3_get_option("\x6d\157\137\x77\x65\x62\63\x5f\141\144\155\x69\156\137\x65\x6d\141\151\154");
        $nr = $this->mo_web3_get_option("\155\x6f\x5f\x77\145\142\x33\x5f\x61\144\x6d\x69\x6e\137\143\x75\x73\164\157\x6d\145\x72\137\153\145\x79");
        if (!$Lh || !$nr || !is_numeric(trim($nr ?? ''))) {
            goto Rq;
        }
        return 1;
        goto wU;
        Rq:
        return 0;
        wU:
    }
    public function get_versi_str()
    {
        return "\x46\122\x45\x45";
    }
    public function get_plugin_config()
    {
        $Uk = $this->mo_web3_get_option("\x6d\x6f\x5f\x77\145\x62\63\137\x63\x6f\x6e\x66\151\147\x5f\163\145\x74\x74\151\156\147\x73");
        return !$Uk || empty($Uk) ? array() : $Uk;
    }
    public function update_plugin_config($Uk)
    {
        $this->mo_web3_update_option("\155\x6f\137\167\x65\x62\63\137\x63\157\156\x66\151\x67\x5f\x73\145\x74\x74\x69\156\x67\163", $Uk);
    }
    public function mo_web3_decrypt($Il)
    {
        $Il = base64_decode($Il);
        $Rh = $this->mo_web3_get_option("\x6d\x6f\137\x77\145\142\63\x5f\x63\165\163\x74\x6f\x6d\x65\x72\x5f\x74\157\153\145\x6e");
        if ($Rh) {
            goto dF;
        }
        return "\x66\x61\x6c\x73\145";
        dF:
        $Rh = str_split(str_pad('', strlen($Il), $Rh, STR_PAD_RIGHT));
        $HH = str_split($Il);
        foreach ($HH as $OZ => $qK) {
            $Sp = ord($qK) - ord($Rh[$OZ]);
            $HH[$OZ] = chr($Sp < 0 ? $Sp + 256 : $Sp);
            B_:
        }
        u4:
        return join('', $HH);
    }
    public function mo_web3_encrypt($Il)
    {
        $Rh = $this->mo_web3_get_option("\155\157\x5f\x77\x65\142\x33\x5f\143\165\163\x74\157\x6d\145\x72\137\x74\157\x6b\x65\156");
        $Rh = str_split(str_pad('', strlen($Il), $Rh, STR_PAD_RIGHT));
        $HH = str_split($Il);
        foreach ($HH as $OZ => $qK) {
            $Sp = ord($qK) + ord($Rh[$OZ]);
            $HH[$OZ] = chr($Sp > 255 ? $Sp - 256 : $Sp);
            XU:
        }
        PD:
        return base64_encode(join('', $HH));
    }
    public function send_error_response_on_url($K_)
    {
        $CD = $this->get_current_url();
        $GG = "\155\x6f\137\167\x65\x62\63\x5f\164\x6f\153\x65\156\x3d" . sanitize_text_field($_GET["\x6d\x6f\x5f\167\145\142\x33\137\x74\157\x6b\x65\x6e"]);
        if (!(strpos($CD, $GG) != false)) {
            goto OQ;
        }
        if (!($CD[strpos($CD, $GG) - 1] == "\x26")) {
            goto St;
        }
        $GG = "\x26" . $GG;
        St:
        $CD = str_replace($GG, '', $CD);
        OQ:
        $CD = strpos($CD, "\x3f") ? $CD . "\x26\x6d\157\x5f\167\145\142\x33\x5f\x65\162\162\157\x72\x3d" . $K_ : $CD . "\x3f\155\157\x5f\x77\x65\x62\63\x5f\x65\162\162\157\162\75" . $K_;
        wp_safe_redirect($CD);
        exit;
    }
    public function mo_web3_check_empty_or_null($K_)
    {
        if (!(!isset($K_) || empty($K_))) {
            goto uR;
        }
        return true;
        uR:
        return false;
    }
    public function mo_web3_is_curl_installed()
    {
        if (in_array("\x63\165\162\x6c", get_loaded_extensions())) {
            goto U1;
        }
        return 0;
        goto MR;
        U1:
        return 1;
        MR:
    }
    public function mo_web3_show_curl_error()
    {
        if (!($this->mo_web3_is_curl_installed() === 0)) {
            goto Q7;
        }
        $this->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x3c\x61\40\150\x72\145\x66\75\x22\150\x74\x74\x70\x3a\57\57\x70\150\160\x2e\156\x65\164\57\155\141\x6e\165\141\154\57\145\156\x2f\x63\x75\x72\154\56\x69\x6e\163\164\141\154\154\141\164\x69\157\156\x2e\x70\x68\160\x22\x20\x74\141\162\147\145\164\75\42\137\142\x6c\x61\x6e\x6b\42\x3e\x50\110\120\x20\103\x55\122\114\40\145\x78\x74\145\156\163\151\x6f\x6e\x3c\x2f\141\76\40\x69\163\x20\x6e\x6f\164\x20\x69\156\x73\164\x61\x6c\154\x65\x64\40\157\x72\40\144\x69\163\x61\x62\x6c\145\x64\x2e\40\120\x6c\x65\141\163\145\40\x65\x6e\x61\142\x6c\x65\x20\151\164\x20\164\157\40\143\x6f\156\x74\151\x6e\x75\x65\56");
        $this->mo_web3_show_error_message();
        return;
        Q7:
    }
    public function mo_web3_get_option($ai, $hF = false)
    {
        $K_ = is_multisite() ? get_site_option($ai, $hF) : get_option($ai, $hF);
        if (!(!$K_ || $hF === $K_)) {
            goto LG;
        }
        return $hF;
        LG:
        return $K_;
    }
    public function mo_web3_update_option($ai, $K_)
    {
        return is_multisite() ? update_site_option($ai, $K_) : update_option($ai, $K_);
    }
    public function mo_web3_delete_option($ai)
    {
        return is_multisite() ? delete_site_option($ai) : delete_option($ai);
    }
    public function gen_rand_str($fX = 10)
    {
        $KD = "\x61\x62\143\x64\145\146\147\150\151\152\x6b\x6c\x6d\156\157\x70\x71\x72\163\164\165\x76\x77\170\x79\172\x41\x42\x43\104\105\106\x47\110\x49\x4a\113\114\x4d\116\117\120\121\x52\x53\124\125\126\x57\x58\x59\132";
        $aN = strlen($KD);
        $rh = '';
        $m8 = 0;
        rW:
        if (!($m8 < $fX)) {
            goto pW;
        }
        $rh .= $KD[random_int(0, $aN - 1)];
        dJ:
        $m8++;
        goto rW;
        pW:
        return $rh;
    }
    public function parse_url($kF)
    {
        $Km = array();
        $Xx = explode("\x3f", $kF);
        $Km["\x68\157\x73\x74"] = $Xx[0];
        $Km["\x71\165\145\162\x79"] = isset($Xx[1]) && '' !== $Xx[1] ? $Xx[1] : '';
        if (!(empty($Km["\x71\x75\x65\162\171"]) || '' === $Km["\161\x75\145\x72\x79"])) {
            goto RE;
        }
        return $Km;
        RE:
        $uE = [];
        foreach (explode("\46", $Km["\161\165\x65\x72\171"]) as $A1) {
            $Xx = explode("\75", $A1);
            if (!(is_array($Xx) && count($Xx) === 2)) {
                goto f5;
            }
            $uE[str_replace("\141\x6d\160\73", '', $Xx[0])] = $Xx[1];
            f5:
            if (!(is_array($Xx) && "\x73\x74\x61\164\x65" === $Xx[0])) {
                goto md;
            }
            $Xx = explode("\x73\164\141\164\145\75", $A1);
            $uE["\163\x74\x61\x74\x65"] = $Xx[1];
            md:
            yC:
        }
        t3:
        $Km["\161\x75\x65\162\171"] = is_array($uE) && !empty($uE) ? $uE : [];
        return $Km;
    }
    public function generate_url($CG)
    {
        if (!(!is_array($CG) || empty($CG))) {
            goto Yu;
        }
        return '';
        Yu:
        if (isset($CG["\150\x6f\x73\164"])) {
            goto De;
        }
        return '';
        De:
        $kF = $CG["\x68\157\163\164"];
        $A4 = '';
        $m8 = 0;
        foreach ($CG["\x71\x75\145\x72\171"] as $iq => $K_) {
            if (!(0 !== $m8)) {
                goto WR;
            }
            $A4 .= "\x26";
            WR:
            $A4 .= "{$iq}\x3d{$K_}";
            ++$m8;
            Pl:
        }
        Xc:
        return $kF . "\x3f" . $A4;
    }
    public function get_current_url()
    {
        return (isset($_SERVER["\x48\x54\x54\120\123"]) ? "\x68\164\164\x70\x73" : "\x68\x74\x74\160") . "\72\x2f\x2f" . sanitize_text_field(wp_unslash($_SERVER["\110\x54\124\120\x5f\110\x4f\x53\124"])) . sanitize_text_field(wp_unslash($_SERVER["\x52\x45\x51\x55\105\x53\x54\137\125\x52\x49"]));
    }
    public function deactivate_plugin()
    {
        $this->mo_web3_delete_option("\x6d\157\137\167\145\x62\x33\x5f\150\157\163\164\x5f\x6e\141\x6d\x65");
        $this->mo_web3_delete_option("\155\157\x5f\167\x65\142\63\x5f\x6e\145\x77\x5f\x72\145\147\x69\x73\x74\x72\x61\x74\151\x6f\x6e");
        $this->mo_web3_delete_option("\155\x6f\137\x77\x65\x62\x33\137\141\x64\155\151\156\x5f\145\155\x61\151\x6c");
        $this->mo_web3_delete_option("\155\157\137\x77\x65\x62\63\137\x61\144\155\x69\x6e\137\160\x68\157\156\x65");
        $this->mo_web3_delete_option("\x6d\157\137\x77\145\142\x33\137\141\144\x6d\151\156\x5f\146\156\141\x6d\145");
        $this->mo_web3_delete_option("\x6d\x6f\137\167\x65\x62\63\137\141\x64\x6d\151\156\x5f\154\156\x61\x6d\x65");
        $this->mo_web3_delete_option("\155\x6f\137\x77\145\142\63\x5f\x61\x64\x6d\x69\x6e\x5f\x63\157\155\160\x61\156\171");
        $this->mo_web3_delete_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION);
        $this->mo_web3_delete_option("\155\x6f\137\167\145\x62\x33\137\141\144\x6d\151\156\x5f\x63\x75\163\x74\157\x6d\x65\162\x5f\x6b\145\171");
        $this->mo_web3_delete_option("\x6d\x6f\137\167\145\x62\x33\137\x61\144\x6d\151\x6e\x5f\141\160\x69\137\x6b\x65\x79");
        $this->mo_web3_delete_option("\155\157\137\x77\x65\142\x33\137\x6e\145\167\x5f\143\165\163\x74\x6f\155\x65\162");
        $this->mo_web3_delete_option("\x6d\157\x5f\167\145\142\x33\137\x72\x65\x67\151\x73\164\162\141\x74\151\157\x6e\137\163\164\141\164\x75\x73");
        $this->mo_web3_delete_option("\x6d\x6f\x5f\x77\x65\142\63\x5f\x63\x75\163\164\x6f\155\145\162\x5f\x74\157\x6b\145\x6e");
        $this->mo_web3_delete_option("\x6d\x6f\137\167\x65\142\63\137\x6c\153");
        $this->mo_web3_delete_option("\155\x6f\137\167\145\x62\63\137\x6c\x76");
        $this->mo_web3_delete_option("\x6d\157\x5f\167\145\142\63\137\x6e\x66\x74\x5f\x73\145\164\x74\x69\156\x67\163");
        $this->mo_web3_delete_option("\155\x6f\x5f\167\145\142\x33\137\154\157\x67\151\x6e\x5f\x62\165\164\x74\157\156\137\x63\x75\163\164\157\x6d\x5f\143\x73\x73");
        $this->mo_web3_delete_option("\155\x6f\x5f\167\x65\x62\x33\137\x62\x75\164\x74\x6f\x6e\137\x63\x75\163\164\157\x6d\x5f\x74\145\x78\x74");
        $this->mo_web3_delete_option("\x6d\x6f\x5f\167\145\142\x33\137\x64\151\x73\160\154\141\x79\137\154\157\147\151\156\x5f\142\165\164\x74\x6f\156");
    }
    public function base64url_encode($Td)
    {
        return rtrim(strtr(base64_encode($Td), "\53\57", "\x2d\x5f"), "\x3d");
    }
    public function base64url_decode($Td)
    {
        return base64_decode(str_pad(strtr($Td, "\55\x5f", "\x2b\x2f"), strlen($Td) % 4, "\x3d", STR_PAD_RIGHT));
    }
    public function get_wp_user_profile_attributes()
    {
        return array("\x6e\x69\143\x6b\156\141\x6d\145", "\146\151\162\x73\164\137\x6e\x61\x6d\x65", "\154\x61\x73\x74\x5f\x6e\141\x6d\145", "\x64\145\163\143\162\x69\160\x74\x69\157\156", "\x72\151\143\x68\137\x65\x64\151\164\151\156\x67", "\165\163\x65\x72\137\x6e\x69\143\x65\156\x61\155\145", "\x75\163\145\162\x5f\145\x6d\141\151\x6c", "\x64\151\x73\160\154\141\171\137\156\x61\155\145", "\x74\145\x6c\x65\x70\x68\x6f\156\x65", "\x61\144\144\162\x65\163\x73");
    }
}
