<?php


namespace MoWeb3;

use MoWeb3\MoWeb3Utils;
class MoWeb3Settings
{
    public $config;
    public $util;
    public function __construct()
    {
        global $LN;
        $this->util = $LN;
        add_action("\141\x64\x6d\151\156\137\x69\156\151\x74", array($this, "\155\151\156\151\157\x72\x61\x6e\147\x65\x5f\167\x65\142\63\137\163\x61\x76\x65\x5f\163\145\x74\x74\x69\156\147\163"));
        $this->config = $this->util->get_plugin_config();
    }
    public function miniorange_web3_save_settings()
    {
        if (!(sanitize_text_field($_SERVER["\122\x45\x51\125\105\123\x54\x5f\115\x45\124\x48\117\104"]) === "\120\117\x53\x54" && current_user_can("\x61\x64\155\151\x6e\151\x73\x74\162\141\164\157\162"))) {
            goto J0;
        }
        if (!(isset($_POST["\x6f\160\164\x69\157\x6e"]) and $_POST["\157\160\x74\151\x6f\156"] == "\x6d\x6f\137\x77\x65\142\63\137\166\145\162\x69\x66\x79\137\154\x69\143\x65\x6e\163\145")) {
            goto JR;
        }
        global $LN;
        if (!(!isset($_POST["\x6d\x6f\137\x77\x65\x62\x33\x5f\x6c\x69\x63\145\156\163\145\x5f\153\145\171"]) || empty($_POST["\155\157\137\x77\145\x62\x33\x5f\x6c\151\143\145\156\x73\x65\137\x6b\x65\x79"]))) {
            goto nm;
        }
        update_option("\x6d\157\137\x77\x65\142\63\137\155\145\x73\163\x61\147\x65", "\120\x6c\145\x61\x73\145\40\x65\156\x74\x65\162\x20\166\x61\x6c\x69\x64\x20\x6c\x69\x63\145\x6e\x73\145\40\153\145\171\56");
        $LN->mo_web3_show_error_message();
        return;
        nm:
        $Cc = trim($_POST["\155\x6f\x5f\167\145\x62\63\137\154\x69\x63\145\156\163\x65\137\x6b\x65\171"]);
        $o4 = new \MoWeb3\MoWeb3Customer();
        $ta = json_decode($o4->mo_web3_check_customer_ln(), true);
        if (strcasecmp($ta["\163\x74\x61\x74\165\163"], "\x53\125\103\x43\x45\123\x53") == 0) {
            goto wK;
        }
        update_option("\x6d\157\137\167\145\x62\63\x5f\x6d\145\163\163\x61\147\x65", "\111\x6e\x76\141\154\x69\x64\40\x6c\151\143\145\156\x73\145\x2e\x20\x50\x6c\145\141\x73\145\40\x74\162\171\40\141\x67\x61\151\x6e\56");
        $LN->mo_web3_show_error_message();
        goto BZ;
        wK:
        $ta = json_decode($o4->mo_web3_XfsZkodsfhHJ($Cc), true);
        if (strcasecmp($ta["\163\x74\x61\164\165\x73"], "\123\125\x43\x43\x45\x53\123") == 0) {
            goto a4;
        }
        if (strcasecmp($ta["\x73\164\141\164\x75\163"], "\x46\x41\x49\x4c\x45\x44") == 0) {
            goto iY;
        }
        update_option("\x6d\157\x5f\x77\145\142\x33\x5f\x6d\x65\163\163\141\x67\x65", "\101\156\40\145\162\162\157\162\x20\157\x63\x63\x75\x72\145\x64\x20\x77\150\x69\x6c\145\40\160\162\x6f\143\145\163\x73\151\156\x67\x20\171\x6f\165\x72\40\162\x65\161\x75\145\x73\x74\x2e\x20\120\x6c\x65\141\163\x65\40\124\x72\171\x20\141\147\141\x69\156\56");
        $LN->mo_web3_show_error_message();
        goto C_;
        iY:
        update_option("\x6d\157\x5f\167\x65\x62\x33\x5f\155\x65\163\x73\x61\147\x65", "\x59\157\x75\x20\x68\141\166\145\40\145\x6e\164\145\162\x65\x64\40\x61\156\x20\151\156\166\141\x6c\x69\x64\x20\x6c\151\143\x65\x6e\x73\x65\40\153\145\171\x2e\40\x50\154\x65\x61\163\145\40\x65\x6e\x74\145\162\x20\x61\x20\x76\141\x6c\151\144\40\x6c\x69\x63\145\156\x73\x65\40\153\145\171\x2e");
        $LN->mo_web3_show_error_message();
        C_:
        goto er;
        a4:
        $LN->mo_web3_update_option("\x6d\157\x5f\x77\145\142\63\137\154\153", $LN->mo_web3_encrypt($Cc));
        $LN->mo_web3_update_option("\x6d\157\137\x77\x65\x62\x33\x5f\x6c\x76", $LN->mo_web3_encrypt("\x74\162\x75\145"));
        $LN->mo_web3_update_option("\155\x6f\x5f\167\145\x62\x33\137\x6d\145\x73\x73\x61\x67\x65", "\x59\157\165\x72\40\154\151\x63\x65\156\163\145\x20\x69\x73\x20\166\x65\x72\x69\x66\x69\x65\144\56\x20\131\157\165\40\x63\x61\156\x20\x6e\x6f\167\x20\163\145\164\x75\x70\x20\164\150\x65\40\160\x6c\165\147\151\x6e\x2e");
        $LN->mo_web3_show_success_message();
        er:
        BZ:
        JR:
        if (!(isset($_POST["\x6d\157\137\167\145\x62\x33\x5f\x63\150\x61\156\147\145\137\x6d\151\x6e\151\x6f\x72\x61\x6e\x67\x65\137\156\x6f\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x77\x65\142\63\x5f\143\150\141\x6e\147\x65\x5f\155\151\x6e\x69\157\x72\x61\x6e\147\145\x5f\x6e\157\156\143\145"])), "\x6d\x6f\x5f\167\x65\142\63\x5f\143\150\x61\156\x67\145\137\x6d\151\156\x69\157\x72\x61\156\x67\145") && isset($_POST[\MoWeb3Constants::OPTION]) && "\155\x6f\137\167\145\142\63\x5f\x63\150\141\156\147\x65\x5f\155\x69\x6e\151\157\x72\x61\156\x67\x65" === sanitize_text_field($_POST[\MoWeb3Constants::OPTION]))) {
            goto gm;
        }
        mo_web3_deactivate();
        return;
        gm:
        if (!(isset($_POST["\155\x6f\x5f\x77\145\142\63\x5f\x76\145\162\151\x66\171\137\x63\165\163\x74\157\155\145\162\137\156\157\156\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\x5f\167\145\142\x33\137\166\x65\x72\x69\146\171\137\x63\165\x73\x74\157\x6d\x65\x72\x5f\x6e\x6f\x6e\143\x65"])), "\155\157\x5f\x77\x65\142\63\x5f\x76\145\x72\x69\146\171\x5f\x63\x75\163\164\157\x6d\145\162") && isset($_POST[\MoWeb3Constants::OPTION]) && "\x6d\x6f\137\167\x65\x62\x33\x5f\166\145\162\151\x66\x79\137\143\x75\163\164\x6f\155\x65\x72" === sanitize_text_field($_POST[\MoWeb3Constants::OPTION]))) {
            goto mE;
        }
        if (!($this->util->mo_web3_is_curl_installed() === 0)) {
            goto Fy;
        }
        return $this->util->mo_web3_show_curl_error();
        Fy:
        $Lh = isset($_POST["\x65\x6d\141\x69\x6c"]) ? sanitize_email(wp_unslash($_POST["\145\x6d\141\x69\x6c"])) : '';
        $i4 = isset($_POST["\x70\141\x73\x73\167\x6f\x72\144"]) ? sanitize_text_field($_POST["\160\x61\x73\163\167\x6f\162\x64"]) : '';
        if (!($this->util->mo_web3_check_empty_or_null($Lh) || $this->util->mo_web3_check_empty_or_null($i4))) {
            goto nQ;
        }
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x41\x6c\x6c\x20\164\x68\x65\x20\x66\151\x65\x6c\144\163\x20\141\x72\x65\40\162\145\161\165\151\x72\145\144\x2e\40\120\154\x65\x61\x73\x65\40\x65\x6e\x74\x65\x72\40\166\141\154\x69\144\40\145\156\164\162\151\145\x73\56");
        $this->util->mo_web3_show_error_message();
        return;
        nQ:
        $this->util->mo_web3_update_option("\x6d\157\x5f\167\x65\142\63\137\x61\144\155\151\156\137\145\155\x61\x69\x6c", $Lh);
        $this->util->mo_web3_update_option("\155\x6f\137\x77\x65\142\x33\137\160\141\x73\x73\x77\x6f\162\144", $i4);
        $o4 = new MoWeb3Customer();
        $ta = $o4->get_customer_key();
        $nr = json_decode($ta, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            goto fL;
        }
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\111\x6e\x76\x61\154\151\144\x20\x75\x73\x65\162\x6e\x61\155\145\x20\157\162\40\x70\x61\x73\x73\167\157\x72\144\x2e\x20\x50\154\x65\141\x73\145\x20\x74\x72\x79\40\141\147\141\151\156\56");
        $this->util->mo_web3_show_error_message();
        goto L3;
        fL:
        $this->util->mo_web3_update_option("\155\x6f\x5f\x77\145\142\x33\137\x61\144\x6d\x69\x6e\x5f\143\165\163\x74\157\x6d\x65\x72\x5f\x6b\x65\x79", $nr["\x69\x64"]);
        $this->util->mo_web3_update_option("\x6d\x6f\x5f\167\145\x62\63\x5f\x61\144\x6d\151\156\137\x61\160\151\137\153\x65\171", $nr["\141\160\151\x4b\145\x79"]);
        $this->util->mo_web3_update_option("\x6d\157\x5f\167\x65\x62\63\x5f\x63\165\x73\x74\157\155\x65\x72\x5f\164\157\x6b\x65\156", $nr["\164\x6f\153\x65\156"]);
        if (!isset($g_["\x70\150\157\x6e\145"])) {
            goto m7;
        }
        $this->util->mo_web3_update_option("\155\x6f\137\167\145\142\63\137\x61\144\155\151\156\x5f\x70\x68\157\156\145", $nr["\x70\150\x6f\156\145"]);
        m7:
        $this->util->mo_web3_delete_option("\155\x6f\x5f\167\145\x62\x33\x5f\x70\141\x73\x73\x77\x6f\162\x64");
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x43\x75\x73\164\157\155\x65\162\x20\x72\145\x74\x72\x69\x65\166\x65\144\40\163\165\143\143\x65\x73\163\146\x75\154\154\x79");
        $this->util->mo_web3_delete_option("\x6d\157\x5f\167\x65\142\63\137\x76\145\162\x69\x66\x79\x5f\143\165\x73\x74\157\x6d\x65\x72");
        $this->util->mo_web3_show_success_message();
        L3:
        mE:
        if (!(isset($_POST["\x6d\157\137\167\x65\x62\x33\137\143\x6f\x6e\x74\x61\143\164\x5f\165\163\137\161\x75\145\162\171\x5f\x6f\160\x74\151\x6f\156\137\156\157\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\x77\x65\x62\63\137\143\x6f\x6e\x74\141\x63\164\137\x75\163\x5f\161\x75\145\162\171\137\157\x70\x74\151\157\156\137\156\157\x6e\x63\x65"])), "\155\x6f\137\x77\145\142\63\x5f\x63\x6f\156\x74\141\143\164\x5f\x75\163\x5f\x71\x75\x65\x72\171\137\x6f\160\x74\151\157\x6e") && isset($_POST[\MoWeb3Constants::OPTION]) && "\155\157\x5f\x77\x65\142\x33\137\x63\157\156\164\x61\x63\x74\x5f\165\163\x5f\161\165\145\162\171\137\x6f\x70\164\x69\x6f\156" === sanitize_text_field($_POST[\MoWeb3Constants::OPTION]))) {
            goto p1;
        }
        if (!($this->util->mo_web3_is_curl_installed() === 0)) {
            goto uP;
        }
        return $this->util->mo_web3_show_curl_error();
        uP:
        $Lh = isset($_POST["\x6d\x6f\x5f\x77\145\x62\x33\x5f\143\x6f\x6e\164\x61\143\164\137\165\163\x5f\145\x6d\141\151\154"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x77\x65\x62\63\137\x63\157\156\x74\141\x63\x74\137\165\x73\137\145\155\141\151\x6c"])) : '';
        $lI = isset($_POST["\155\x6f\137\167\x65\x62\63\x5f\143\157\156\x74\x61\x63\164\137\165\x73\137\160\x68\157\156\145"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\x6f\x5f\167\145\142\63\137\143\x6f\156\164\141\143\x74\x5f\165\x73\137\x70\150\x6f\156\145"])) : '';
        $uO = isset($_POST["\155\157\137\x77\145\142\x33\x5f\143\157\156\x74\x61\143\x74\x5f\165\x73\x5f\161\x75\145\162\x79"]) ? sanitize_text_field(wp_unslash($_POST["\155\157\x5f\167\145\x62\x33\137\x63\157\156\x74\x61\143\x74\x5f\x75\x73\x5f\x71\x75\145\162\x79"])) : '';
        $o4 = new MoWeb3Customer();
        if ($this->util->mo_web3_check_empty_or_null($Lh) || $this->util->mo_web3_check_empty_or_null($uO)) {
            goto Dz;
        }
        $TS = false;
        $v6 = $o4->submit_contact_us($Lh, $lI, $uO, $TS);
        if (false === $v6) {
            goto kV;
        }
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x54\x68\141\156\x6b\163\40\x66\157\162\x20\147\x65\x74\164\151\156\147\x20\x69\156\40\x74\157\x75\x63\150\x21\x20\x57\x65\40\x73\150\x61\154\x6c\x20\147\145\x74\x20\142\141\143\153\40\164\157\x20\x79\157\165\40\163\x68\157\162\164\154\x79\56");
        $this->util->mo_web3_show_success_message();
        goto yI;
        kV:
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\131\x6f\x75\x72\40\x71\165\x65\x72\x79\40\x63\x6f\165\154\144\x20\x6e\157\x74\x20\x62\145\x20\x73\165\x62\x6d\151\164\164\145\144\x2e\40\x50\154\145\141\x73\145\40\164\x72\171\x20\x61\x67\x61\151\156\56");
        $this->util->mo_web3_show_error_message();
        yI:
        goto Yh;
        Dz:
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\120\154\145\141\x73\x65\40\x66\151\154\154\x20\165\x70\40\x45\x6d\x61\151\154\40\141\156\x64\40\x51\165\x65\x72\x79\x20\146\151\145\154\144\x73\40\x74\157\40\x73\165\142\x6d\151\x74\x20\171\157\165\x72\x20\x71\165\x65\162\x79\x2e");
        $this->util->mo_web3_show_error_message();
        Yh:
        p1:
        if (!(isset($_POST["\x6d\x6f\x5f\x77\145\x62\x33\137\x72\145\147\151\163\164\145\x72\137\143\165\x73\164\x6f\x6d\145\162\x5f\x6e\157\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\167\x65\142\63\x5f\x72\x65\147\151\x73\164\x65\162\x5f\x63\165\x73\164\x6f\x6d\x65\162\137\x6e\157\156\x63\x65"])), "\155\157\x5f\x77\x65\142\63\137\x72\x65\147\x69\x73\x74\x65\x72\137\143\165\163\164\x6f\155\145\162") && isset($_POST[\MoWeb3Constants::OPTION]) && "\155\157\x5f\x77\x65\142\63\137\x72\x65\x67\x69\x73\x74\145\x72\137\143\165\163\164\157\x6d\x65\162" === sanitize_text_field($_POST[\MoWeb3Constants::OPTION]))) {
            goto f7;
        }
        $Lh = '';
        $lI = '';
        $i4 = '';
        $j7 = '';
        $ku = '';
        $tq = '';
        $C1 = '';
        if (!($this->util->mo_web3_check_empty_or_null(sanitize_text_field(wp_unslash($_POST["\x65\155\141\151\154"]))) || $this->util->mo_web3_check_empty_or_null(sanitize_text_field(wp_unslash($_POST["\x70\141\x73\163\x77\x6f\162\144"]))) || $this->util->mo_web3_check_empty_or_null(sanitize_text_field(wp_unslash($_POST["\x63\157\x6e\146\151\162\x6d\x50\141\163\163\x77\x6f\162\x64"]))))) {
            goto ea;
        }
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x41\x6c\x6c\x20\164\x68\145\40\x66\151\145\x6c\144\x73\x20\141\x72\x65\40\162\x65\161\x75\x69\x72\x65\144\x2e\x20\120\154\145\141\x73\x65\40\x65\x6e\x74\x65\162\x20\166\x61\154\151\144\x20\145\x6e\164\x72\151\x65\163\x2e");
        $this->util->mo_web3_show_error_message();
        return;
        ea:
        if (strlen(sanitize_text_field(wp_unslash($_POST["\x70\x61\163\x73\167\x6f\162\144"]))) < 8 || strlen(sanitize_text_field(wp_unslash($_POST["\x63\x6f\x6e\x66\x69\162\155\120\141\163\x73\x77\157\162\144"]))) < 8) {
            goto XC;
        }
        $Lh = sanitize_email($_POST["\x65\x6d\x61\x69\154"]);
        $lI = sanitize_text_field(stripslashes($_POST["\160\x68\x6f\156\x65"]));
        $i4 = sanitize_text_field(stripslashes($_POST["\x70\141\163\163\167\x6f\162\144"]));
        $j7 = sanitize_text_field(stripslashes($_POST["\x66\x6e\141\155\x65"]));
        $ku = sanitize_text_field(stripslashes($_POST["\154\x6e\x61\155\145"]));
        $tq = sanitize_text_field(stripslashes($_POST["\x63\x6f\x6d\160\x61\x6e\171"]));
        $C1 = sanitize_text_field(stripslashes($_POST["\x63\x6f\x6e\146\x69\x72\155\120\141\163\163\167\157\162\144"]));
        goto BU;
        XC:
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x43\x68\x6f\157\x73\145\x20\x61\x20\x70\x61\163\x73\167\157\162\x64\40\167\151\x74\x68\40\x6d\x69\156\151\x6d\x75\155\40\154\x65\156\147\x74\150\40\x38\x2e");
        $this->util->mo_web3_show_error_message();
        return;
        BU:
        $this->util->mo_web3_update_option("\x6d\x6f\137\167\145\x62\x33\x5f\x61\x64\x6d\151\x6e\137\145\155\141\x69\x6c", $Lh);
        $this->util->mo_web3_update_option("\155\x6f\x5f\x77\x65\142\63\137\x61\144\155\151\156\137\x70\150\157\x6e\145", $lI);
        $this->util->mo_web3_update_option("\x6d\157\137\x77\x65\x62\63\x5f\141\x64\155\151\x6e\137\146\156\x61\155\x65", $j7);
        $this->util->mo_web3_update_option("\x6d\157\x5f\167\x65\142\63\x5f\x61\x64\155\151\156\x5f\154\x6e\x61\155\145", $ku);
        $this->util->mo_web3_update_option("\x6d\157\137\167\145\x62\x33\137\141\x64\155\x69\x6e\137\143\157\155\160\x61\156\x79", $tq);
        if (!($this->util->mo_web3_is_curl_installed() === 0)) {
            goto xa;
        }
        return $this->util->mo_web3_show_curl_error();
        xa:
        if (strcmp($i4, $C1) === 0) {
            goto Jf;
        }
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x50\141\163\x73\x77\157\162\x64\163\x20\x64\x6f\40\x6e\x6f\x74\x20\x6d\141\x74\143\150\56");
        $this->util->mo_web3_update_option("\x6d\x6f\137\x77\x65\x62\x33\137\x76\145\162\151\x66\171\137\143\165\x73\164\157\155\x65\x72", false);
        $this->util->mo_web3_show_error_message();
        goto go;
        Jf:
        $this->util->mo_web3_update_option("\155\157\x5f\x77\x65\142\x33\x5f\x70\x61\163\x73\x77\157\162\x64", $i4);
        $o4 = new MoWeb3Customer();
        $Lh = $this->util->mo_web3_get_option("\x6d\157\x5f\x77\x65\142\x33\x5f\x61\144\x6d\x69\156\137\145\x6d\x61\151\154");
        $ta = json_decode($o4->check_customer(), true);
        if (strcasecmp($ta["\x73\164\x61\164\x75\163"], "\x43\x55\123\x54\x4f\115\x45\x52\x5f\116\117\x54\137\x46\x4f\x55\x4e\x44") === 0) {
            goto vy;
        }
        $this->mo_web3_get_current_customer();
        goto le;
        vy:
        $this->create_customer();
        le:
        go:
        f7:
        J0:
    }
    public function mo_web3_get_current_customer()
    {
        $o4 = new MoWeb3Customer();
        $ta = $o4->get_customer_key();
        $nr = json_decode($ta, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            goto o5;
        }
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\131\x6f\x75\40\x61\x6c\x72\x65\x61\x64\x79\40\150\141\166\x65\40\x61\x6e\40\141\143\x63\157\165\156\x74\x20\167\x69\x74\150\40\x6d\151\x6e\151\117\162\141\156\x67\145\x2e\x20\x50\154\145\141\x73\145\40\145\156\164\145\162\x20\141\x20\166\x61\154\151\x64\40\160\x61\x73\x73\x77\157\x72\x64\56");
        $this->util->mo_web3_update_option("\155\x6f\137\167\x65\x62\x33\137\x76\x65\x72\x69\x66\171\x5f\x63\x75\x73\164\x6f\x6d\145\162", "\164\x72\165\x65");
        $this->util->mo_web3_show_error_message();
        goto Vy;
        o5:
        $this->util->mo_web3_update_option("\155\x6f\x5f\x77\145\142\x33\x5f\x61\x64\155\x69\156\137\x63\165\163\164\x6f\155\145\162\x5f\x6b\x65\x79", $nr["\x69\144"]);
        $this->util->mo_web3_update_option("\x6d\x6f\137\167\145\x62\x33\x5f\x61\144\155\x69\x6e\x5f\x61\160\151\137\x6b\x65\171", $nr["\141\160\151\113\145\x79"]);
        $this->util->mo_web3_update_option("\x6d\x6f\137\x77\145\x62\x33\x5f\x63\x75\x73\x74\157\155\x65\162\137\164\157\153\145\x6e", $nr["\x74\x6f\153\145\156"]);
        $this->util->mo_web3_update_option("\x6d\157\x5f\x77\x65\142\63\x5f\x70\x61\163\x73\x77\x6f\162\x64", '');
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\103\x75\163\x74\157\155\145\162\x20\162\145\164\x72\151\x65\x76\145\144\x20\163\x75\x63\x63\145\163\163\x66\x75\x6c\x6c\x79");
        $this->util->mo_web3_delete_option("\155\x6f\x5f\167\x65\142\x33\x5f\x76\145\x72\151\x66\171\137\143\x75\163\164\157\x6d\145\162");
        $this->util->mo_web3_delete_option("\155\157\137\x77\145\x62\63\x5f\156\x65\x77\137\x72\x65\x67\151\163\164\x72\x61\x74\x69\x6f\x6e");
        $this->util->mo_web3_show_success_message();
        Vy:
    }
    public function create_customer()
    {
        global $LN;
        $o4 = new MoWeb3Customer();
        $nr = json_decode($o4->create_customer(), true);
        if (strcasecmp($nr["\163\x74\x61\x74\x75\163"], "\x43\125\x53\124\x4f\x4d\x45\122\x5f\x55\x53\x45\x52\x4e\x41\115\x45\x5f\101\114\x52\x45\101\104\131\137\105\130\111\123\x54\x53") === 0) {
            goto Ty;
        }
        if (strcasecmp($nr["\163\x74\141\164\x75\x73"], "\x53\x55\103\103\105\x53\123") === 0) {
            goto V1;
        }
        goto VV;
        Ty:
        $this->mo_web3_get_current_customer();
        $this->util->mo_web3_delete_option("\x6d\x6f\x5f\167\x65\x62\x33\137\156\x65\167\137\x63\x75\163\x74\x6f\155\145\x72");
        goto VV;
        V1:
        $this->util->mo_web3_update_option("\155\x6f\x5f\167\x65\x62\x33\137\x61\144\155\x69\x6e\x5f\143\x75\x73\164\157\x6d\145\x72\137\153\145\171", $nr["\151\144"]);
        $this->util->mo_web3_update_option("\x6d\x6f\x5f\x77\x65\x62\63\137\141\x64\x6d\x69\x6e\137\141\160\151\x5f\x6b\x65\171", $nr["\141\x70\x69\x4b\x65\x79"]);
        $this->util->mo_web3_update_option("\x6d\157\x5f\x77\x65\142\63\x5f\x63\165\163\164\x6f\x6d\145\162\x5f\x74\157\153\145\x6e", $nr["\x74\x6f\x6b\x65\x6e"]);
        $this->util->mo_web3_update_option("\x6d\157\x5f\167\x65\142\63\x5f\160\141\163\x73\167\x6f\162\x64", '');
        $this->util->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\122\145\x67\151\x73\164\145\x72\145\144\40\x73\165\x63\143\x65\x73\163\x66\x75\154\x6c\171\x2e");
        $this->util->mo_web3_update_option("\155\157\x5f\167\x65\x62\x33\137\x72\x65\x67\x69\x73\x74\162\x61\164\151\x6f\156\x5f\163\x74\141\x74\x75\x73", "\x6d\x6f\x5f\x77\145\x62\63\x5f\122\x45\x47\x49\123\x54\122\101\x54\111\117\116\137\103\x4f\x4d\x50\114\x45\x54\x45");
        $this->util->mo_web3_update_option("\x6d\157\x5f\x77\145\x62\x33\x5f\x6e\x65\x77\x5f\143\x75\x73\x74\x6f\155\x65\x72", 1);
        $this->util->mo_web3_delete_option("\x6d\x6f\x5f\x77\145\142\63\x5f\x76\145\x72\151\146\x79\x5f\x63\x75\163\x74\157\x6d\145\162");
        $this->util->mo_web3_delete_option("\155\157\137\167\145\x62\63\x5f\156\x65\167\137\x72\145\147\x69\x73\164\162\141\x74\x69\157\156");
        $this->util->mo_web3_show_success_message();
        VV:
    }
}
