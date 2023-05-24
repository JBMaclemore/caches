<?php


namespace MoWeb3\controller;

require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . "\x2e\56" . DIRECTORY_SEPARATOR . "\x6c\151\x62" . DIRECTORY_SEPARATOR . "\113\145\143\143\141\x6b" . DIRECTORY_SEPARATOR . "\x4b\145\x63\143\x61\x6b\56\160\x68\x70");
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . "\56\x2e" . DIRECTORY_SEPARATOR . "\x6c\x69\142" . DIRECTORY_SEPARATOR . "\105\154\x6c\151\160\164\151\143" . DIRECTORY_SEPARATOR . "\x45\103\x2e\160\x68\x70");
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . "\56\x2e" . DIRECTORY_SEPARATOR . "\154\151\x62" . DIRECTORY_SEPARATOR . "\105\x6c\154\x69\x70\x74\x69\x63" . DIRECTORY_SEPARATOR . "\x43\x75\162\166\145\x73\x2e\x70\150\x70");
use Elliptic\EC;
use kornrunner\Keccak;
use MoWeb3\MoWeb3Utils;
use MoWeb3\view\ButtonView\MoWeb3View;
class MoWeb3FlowHandler
{
    private $data;
    private $request;
    private $utils;
    private $is_new_user;
    public $is_testing_wallet_address = false;
    public function __construct()
    {
        $this->utils = new \MoWeb3\MoWeb3Utils();
        add_action("\167\160\137\x61\x6a\x61\170\137\156\x6f\160\162\x69\x76\x5f\164\171\x70\x65\137\157\146\x5f\162\x65\161\165\145\163\x74", array($this, "\x74\x79\x70\x65\x5f\157\x66\x5f\x72\145\x71\165\145\163\164"));
        add_action("\x77\160\x5f\141\x6a\x61\x78\137\164\171\160\x65\137\x6f\146\137\162\145\161\165\x65\x73\164", array($this, "\164\171\160\x65\x5f\157\x66\137\162\x65\x71\165\145\x73\164"));
        add_action("\x69\x6e\151\164", array($this, "\150\x69\x64\144\x65\x6e\x5f\x66\x6f\162\x6d\x5f\x64\x61\x74\x61"));
        add_action("\x61\144\155\x69\156\x5f\x69\x6e\151\x74", array($this, "\x74\157\147\x67\154\x65\x5f\x64\x69\163\x70\154\x61\x79\137\142\165\164\x74\157\156"));
        add_action("\x61\144\x6d\x69\x6e\137\x69\156\151\x74", array($this, "\143\x68\141\x6e\147\x65\137\x64\151\163\160\x6c\x61\171\x5f\x62\165\164\x74\x6f\156\x5f\164\145\170\164"));
        add_action("\141\x64\155\151\x6e\137\x69\156\151\x74", array($this, "\x6e\146\x74\x5f\163\141\x76\145\x5f\163\x65\x74\x74\x69\156\x67"));
        add_action("\141\x64\x6d\x69\x6e\x5f\x69\x6e\x69\164", array($this, "\x63\x75\163\x74\157\155\x5f\154\157\x67\x69\x6e\x5f\142\165\164\164\x6f\x6e\137\163\141\x76\145\137\163\x65\x74\164\151\x6e\147"));
        add_action("\141\x64\155\x69\156\137\151\156\151\164", array($this, "\x74\157\x67\147\x6c\x65\137\162\x6f\154\145\x5f\155\x61\160\x70\x69\x6e\x67"));
        add_action("\141\x64\x6d\x69\156\137\x69\x6e\151\164", array($this, "\x73\x61\166\x65\137\x72\157\x6c\145\137\x6d\x61\160\160\151\156\x67"));
        add_action("\141\x64\155\x69\x6e\137\151\x6e\151\x74", array($this, "\x73\141\x76\145\x5f\143\x75\x73\x74\x6f\x6d\137\151\156\154\151\x6e\145\137\146\x6f\x72\x6d\137\163\145\164\164\x69\156\x67\163"));
        add_action("\167\x70", array($this, "\x69\156\151\x74\151\141\x6c\151\172\x65\137\160\141\x67\145\137\162\x65\163\x74\x72\x69\x63\x74"));
    }
    public function save_custom_inline_form_settings()
    {
        if (!(isset($_POST["\155\x6f\137\167\x65\x62\63\137\x69\156\x6c\x69\x6e\145\x5f\x66\157\x72\x6d\137\x63\157\x6e\146\x69\147\137\x6e\157\x6e\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\167\x65\x62\63\137\x69\156\x6c\151\156\x65\137\x66\157\162\x6d\137\x63\x6f\156\x66\151\147\137\x6e\157\x6e\x63\x65"])), "\x6d\157\137\x77\145\142\63\137\x69\156\154\151\x6e\145\137\146\157\x72\x6d\x5f\143\x6f\x6e\146\x69\x67"))) {
            goto yS;
        }
        global $LN;
        $x4 = isset($_POST["\154\x61\x62\145\154"]) ? sizeof($_POST["\154\141\x62\145\x6c"]) : 0;
        $El = array();
        $ej = 0;
        $m8 = 0;
        d2:
        if (!($m8 < $x4)) {
            goto NB;
        }
        $ew = false;
        if (!("\x6f\x6e" === sanitize_text_field($_POST["\162\145\x71\x75\151\162\x65\144"][$m8 + $ej + 1]))) {
            goto ef;
        }
        $ej++;
        $ew = true;
        ef:
        $El[$m8] = array("\x6c\x61\x62\x65\154" => sanitize_text_field($_POST["\154\x61\142\x65\x6c"][$m8]), "\164\x79\x70\x65" => sanitize_text_field($_POST["\x74\171\x70\145"][$m8]), "\x6d\x65\x74\x61\137\x6b\145\171" => sanitize_text_field($_POST["\155\x65\164\141\137\x6b\145\x79"][$m8]), "\x72\x65\161\x75\x69\x72\x65\x64" => $ew);
        um:
        $m8++;
        goto d2;
        NB:
        $LN->mo_web3_update_option("\x6d\157\x5f\x77\x65\x62\x33\137\151\156\154\151\x6e\x65\x5f\x66\x6f\x72\x6d\137\163\x65\164\164\151\x6e\147\163", json_encode($El), true);
        yS:
    }
    public function is_curr_page_is_resricted_page($C9, $du)
    {
        $oO = strlen($du);
        $VL = strpos($C9, $du);
        if (!($VL === false)) {
            goto sf;
        }
        return 0;
        sf:
        return 1;
    }
    public function change_display_button_text()
    {
        if (!(isset($_POST["\155\157\x5f\x77\145\x62\x33\137\142\x75\164\164\157\156\x5f\143\x75\x73\x74\x6f\x6d\137\164\145\x78\164\x5f\156\x6f\156\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\x5f\167\145\142\x33\137\142\x75\164\x74\157\x6e\137\x63\x75\x73\164\x6f\x6d\x5f\x74\145\x78\x74\137\x6e\x6f\156\143\x65"])), "\x6d\157\x5f\x77\x65\142\63\137\142\165\164\x74\x6f\156\x5f\x63\x75\x73\x74\x6f\155\x5f\x74\145\170\x74"))) {
            goto se;
        }
        $qA = $_POST["\155\157\137\167\x65\142\63\x5f\142\x75\164\x74\157\x6e\x5f\x63\165\163\x74\157\155\137\x74\x65\x78\x74"];
        $this->utils->mo_web3_update_option("\x6d\x6f\x5f\x77\145\142\x33\137\x62\165\x74\x74\157\156\x5f\143\165\x73\164\x6f\155\137\164\145\x78\x74", $qA);
        global $LN;
        $LN->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\114\157\x67\x69\x6e\x20\102\165\164\164\157\x6e\40\124\145\170\x74\40\103\150\x61\x6e\x67\145\144\x21");
        $LN->mo_web3_show_success_message();
        se:
    }
    public function custom_login_button_save_setting()
    {
        global $LN;
        if (!(isset($_POST["\x6d\x6f\137\x77\x65\x62\x33\x5f\143\x75\x73\164\x6f\155\137\154\157\147\151\156\137\142\165\164\164\x6f\156\137\156\157\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\x5f\167\145\x62\x33\137\143\165\x73\164\157\155\137\x6c\x6f\147\151\156\x5f\142\x75\x74\164\157\156\x5f\156\x6f\156\143\x65"])), "\155\x6f\137\167\145\x62\x33\x5f\143\165\163\164\157\x6d\x5f\154\x6f\x67\151\x6e\x5f\x62\x75\x74\x74\x6f\156"))) {
            goto Ee;
        }
        $lf = isset($_POST["\x6d\x6f\167\x65\x62\x33\103\165\x73\164\x6f\x6d\103\x73\x73"]) ? $_POST["\x6d\x6f\167\145\142\63\x43\x75\163\x74\157\155\x43\x73\163"] : '';
        $qA = $_POST["\x6d\x6f\137\167\x65\x62\x33\137\x62\165\x74\x74\x6f\x6e\137\x63\x75\163\x74\x6f\155\137\164\145\170\164"];
        $lf = trim($lf ?? '');
        $LN->mo_web3_update_option("\x6d\157\x5f\167\145\142\x33\137\142\165\164\x74\157\156\x5f\x63\165\x73\x74\x6f\155\137\x74\145\170\x74", $qA);
        $LN->mo_web3_show_success_message();
        $LN->mo_web3_update_option("\x6d\x6f\x5f\167\x65\142\x33\137\154\x6f\x67\151\156\x5f\142\x75\164\164\x6f\x6e\137\x63\x75\x73\164\157\x6d\x5f\143\x73\163", $lf);
        $LN->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x4c\x6f\147\x69\156\x20\102\165\x74\164\x6f\x6e\40\123\x65\x74\164\151\x6e\147\40\123\x61\x76\x65\144\x21");
        Ee:
        if (!(isset($_POST["\155\x6f\137\167\x65\x62\63\137\x63\165\163\x74\x6f\x6d\137\x70\x72\157\146\151\x6c\145\x5f\x63\157\x6d\x70\x6c\145\164\151\x6f\x6e\x5f\x72\145\144\151\x72\145\x63\164\137\165\162\x6c\x5f\156\157\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\167\x65\x62\63\x5f\143\x75\x73\164\157\x6d\x5f\x70\x72\157\x66\x69\154\145\x5f\x63\157\x6d\160\154\145\x74\151\157\156\137\x72\x65\144\151\162\145\x63\164\x5f\165\162\x6c\137\x6e\x6f\156\x63\145"])), "\155\157\137\167\145\142\63\137\143\x75\x73\x74\x6f\155\137\x70\162\157\146\151\x6c\x65\137\x63\157\155\160\x6c\145\x74\151\x6f\x6e\137\162\145\144\x69\162\x65\x63\x74\x5f\165\162\x6c"))) {
            goto Bv;
        }
        $gS = sanitize_url($_POST["\155\x6f\137\167\145\142\63\137\x63\165\163\x74\157\155\x5f\x70\x72\x6f\x66\x69\x6c\145\137\143\x6f\x6d\x70\154\x65\x74\151\157\x6e\137\x72\145\144\x69\162\x65\143\x74\137\165\x72\x6c"], $q1 = null);
        $gG = false;
        if (!isset($_POST["\155\157\137\167\x65\142\63\137\x75\163\x65\162\156\x61\x6d\x65\137\x73\x70\x65\143\151\146\x69\143\x61\x74\x69\x6f\156\137\x63\150\x65\143\153"])) {
            goto CP;
        }
        $gG = sanitize_text_field($_POST["\x6d\x6f\137\x77\x65\x62\x33\x5f\165\x73\x65\162\156\x61\155\x65\x5f\163\x70\145\x63\151\x66\151\143\x61\164\x69\157\x6e\x5f\143\x68\145\x63\x6b"]);
        CP:
        $LN->mo_web3_update_option("\x6d\157\x5f\167\x65\x62\63\137\x75\x73\145\x72\x6e\141\x6d\145\137\163\160\x65\143\x69\x66\x69\x63\141\164\x69\x6f\156", $gG);
        $LN->mo_web3_update_option("\x6d\157\x5f\167\145\142\x33\x5f\x63\x75\x73\164\x6f\x6d\x5f\x70\x72\157\146\x69\x6c\145\x5f\x63\x6f\x6d\160\x6c\145\x74\151\157\156\x5f\162\145\x64\151\x72\145\x63\164\137\x75\162\x6c", $gS);
        Bv:
    }
    public function get_curr_page_ID()
    {
        $post = get_post();
        return !empty($post) ? $post->ID : null;
    }
    public function get_curr_page_url()
    {
        $xp = $this->get_curr_page_ID();
        if ($xp) {
            goto Br;
        }
        return null;
        Br:
        $C9 = get_permalink($xp);
        return $C9;
    }
    public function error_page_html()
    {
        $sh .= '';
        $sh .= "\x3c\x64\151\166\40\40\163\x74\171\x6c\x65\75\42\x74\145\x78\164\55\x61\154\151\x67\156\x3a\40\143\145\156\164\145\x72\73\42\x3e";
        $sh .= "\x3c\144\x69\166\x3e";
        $sh .= "\x3c\150\x31\x20\163\164\171\x6c\145\75\42\x66\x6f\x6e\164\55\x73\x69\x7a\x65\x3a\40\x31\60\x30\x30\45\x3b\x20\x6d\x61\162\147\151\156\72\x30\x70\170\x3b\x22\x3e\64\60\x33\74\x2f\x68\x31\76";
        $sh .= "\x3c\x68\61\x20\40\163\x74\x79\154\145\x3d\x22\x66\x6f\156\164\55\x73\x69\172\145\72\40\x32\x30\60\x25\73\x6d\x61\x72\x67\151\156\55\x74\157\x70\72\x30\160\170\x3b\42\x3e\x46\157\162\142\151\x64\x64\145\156\x3c\x2f\150\x31\x3e";
        $sh .= "\74\x70\76\101\x63\143\x65\163\x73\x20\164\x6f\40\x74\x68\151\163\40\x70\141\x67\145\40\157\156\40\x73\145\x72\x76\x65\x72\40\x73\151\144\145\x20\x69\163\40\144\145\156\151\145\x64\x3c\x2f\160\x3e";
        $sh .= "\x3c\x2f\144\x69\166\x3e";
        $sh .= "\x3c\57\x64\x69\166\x3e";
        return $sh;
    }
    public function is_site_admin()
    {
        return in_array("\141\144\x6d\151\x6e\x69\x73\x74\162\141\164\x6f\162", wp_get_current_user()->roles);
    }
    public function initialize_page_restrict()
    {
        $KG = $this->utils->mo_web3_get_option("\155\157\x5f\x77\145\142\63\x5f\156\146\164\137\163\145\164\x74\151\156\x67\x73");
        $C9 = $this->utils->get_current_page_url();
        if (!($KG && $C9)) {
            goto TX;
        }
        foreach ($KG as $ai => $K_) {
            $Fj = $ai;
            $Ix = $this->is_curr_page_is_resricted_page($C9, $Fj);
            $I6 = get_current_user_id();
            $bY = get_user_meta($I6, "\167\x61\x6c\x6c\145\x74\137\x61\x64\144\x72\x65\163\x73", true);
            $ai = $I6 . "\137\157\167\156\145\144\x5f\156\146\164";
            $tZ = get_user_meta($I6, $ai, true);
            $tZ = json_decode($tZ, TRUE);
            if (!$Ix) {
                goto zT;
            }
            if (is_user_logged_in()) {
                goto wL;
            }
            $z9 = $K_["\145\x72\162\157\x72\125\x72\154"];
            if (!wp_redirect($z9)) {
                goto qw;
            }
            exit;
            qw:
            goto hs;
            wL:
            if ($this->is_site_admin()) {
                goto iL;
            }
            $I6 = get_current_user_id();
            $bY = get_user_meta($I6, "\x77\x61\154\x6c\x65\x74\x5f\x61\144\144\x72\x65\x73\x73", true);
            $ai = $I6 . "\x5f\157\167\156\145\x64\x5f\x6e\146\x74";
            $tZ = get_user_meta($I6, $ai, true);
            $tZ = json_decode($tZ, TRUE);
            if (!is_null($tZ)) {
                goto yT;
            }
            $z9 = $K_["\x65\162\x72\157\x72\x55\x72\154"];
            if (!wp_redirect($z9)) {
                goto HO;
            }
            exit;
            HO:
            yT:
            $m8 = 0;
            he:
            if (!($m8 < sizeof($tZ))) {
                goto C9;
            }
            if (!isset($tZ[$m8][$Fj])) {
                goto L4;
            }
            $DR = $tZ[$m8][$Fj]["\142\x61\x6c\141\156\143\x65"];
            $z9 = $tZ[$m8][$Fj]["\x65\x72\x72\x6f\x72\125\x72\x6c"];
            if (!($DR <= 0)) {
                goto lI;
            }
            if (!wp_redirect($z9)) {
                goto oj;
            }
            exit;
            oj:
            lI:
            goto C9;
            L4:
            oq:
            $m8++;
            goto he;
            C9:
            iL:
            hs:
            zT:
            Ko:
        }
        O1:
        TX:
    }
    public function toggle_display_button()
    {
        if (!(isset($_POST["\155\157\137\167\x65\x62\x33\x5f\142\165\x74\x74\x6f\156\x5f\144\151\x73\160\154\141\x79\137\x6e\157\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\157\137\167\145\x62\63\137\x62\x75\x74\x74\x6f\156\137\x64\151\x73\x70\x6c\x61\171\137\x6e\x6f\156\143\x65"])), "\155\157\137\167\145\142\63\137\x62\165\164\164\157\156\x5f\x64\x69\163\160\x6c\141\x79"))) {
            goto Ls;
        }
        $PJ = isset($_POST["\155\157\137\167\145\x62\63\x5f\142\x75\x74\x74\157\x6e\137\143\150\x65\x63\x6b"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\137\167\x65\142\63\x5f\142\165\x74\164\157\156\x5f\x63\x68\145\x63\153"])) : '';
        if ($PJ == "\143\x68\145\143\153\145\144") {
            goto tR;
        }
        $this->utils->mo_web3_update_option("\x6d\x6f\x5f\167\145\142\63\137\x64\x69\163\160\x6c\x61\171\137\154\x6f\x67\x69\x6e\x5f\142\x75\x74\164\157\x6e", "\165\156\x63\150\x65\x63\x6b\145\144");
        goto qS;
        tR:
        $this->utils->mo_web3_update_option("\x6d\x6f\137\167\x65\142\63\137\144\151\163\x70\x6c\x61\x79\137\x6c\157\x67\x69\156\137\142\x75\164\164\157\156", "\x63\150\x65\x63\153\145\144");
        qS:
        Ls:
    }
    public function toggle_role_mapping()
    {
        global $LN;
        if (!(isset($_POST["\x6d\x6f\137\x77\x65\x62\x33\x5f\x65\156\x61\142\154\145\x5f\x72\157\154\145\137\155\x61\160\160\151\x6e\147\x5f\x6e\157\x6e\x63\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\x5f\x77\x65\142\x33\137\x65\156\x61\142\x6c\145\x5f\x72\x6f\154\145\137\x6d\141\x70\160\x69\156\147\137\x6e\x6f\156\143\x65"])), "\x6d\157\x5f\167\x65\142\63\137\x65\156\x61\142\154\145\137\162\157\x6c\145\137\x6d\141\160\160\x69\x6e\x67"))) {
            goto VL;
        }
        $PJ = isset($_POST["\145\156\141\x62\154\145\137\x72\157\x6c\145\x5f\155\141\160\x70\x69\x6e\147"]) ? sanitize_text_field(wp_unslash($_POST["\x65\x6e\141\x62\x6c\145\x5f\x72\x6f\154\145\x5f\155\141\160\x70\x69\x6e\147"])) : false;
        $jo = $LN->mo_web3_get_option("\155\x6f\137\x77\x65\142\x33\x5f\162\x6f\x6c\145\x5f\155\141\160\x70\x69\156\147");
        $jo["\x65\156\141\x62\x6c\145\x5f\x72\x6f\x6c\145\x5f\x6d\x61\x70\x70\x69\156\147"] = $PJ;
        $LN->mo_web3_update_option("\x6d\157\137\x77\x65\x62\63\137\x72\x6f\154\145\x5f\x6d\x61\160\160\x69\156\x67", $jo);
        VL:
    }
    public function save_role_mapping()
    {
        global $LN;
        if (!(isset($_POST["\x6d\x6f\x5f\x77\x65\142\x33\137\x73\141\166\145\137\162\157\x6c\x65\x5f\155\141\160\x70\x69\x6e\x67\137\x6e\157\156\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\167\145\x62\63\137\163\141\x76\x65\x5f\x72\157\154\145\x5f\155\x61\160\160\151\x6e\x67\x5f\x6e\157\x6e\143\145"])), "\155\157\x5f\167\x65\x62\x33\x5f\163\141\x76\145\137\x72\157\x6c\x65\137\x6d\x61\x70\160\151\x6e\147"))) {
            goto Gf;
        }
        $jo = $LN->mo_web3_get_option("\x6d\157\x5f\167\x65\x62\63\137\162\x6f\154\145\137\155\141\x70\x70\x69\x6e\x67");
        $jo["\162\x65\163\x74\x72\151\143\164\137\154\157\147\151\156\x5f\x66\x6f\162\x5f\155\x61\160\x70\x65\x64\137\x72\x6f\x6c\145\163"] = isset($_POST["\x72\x65\163\164\162\x69\x63\x74\137\x6c\157\x67\x69\x6e\137\146\x6f\162\x5f\x6d\141\x70\160\145\144\x5f\162\x6f\154\145\x73"]) ? sanitize_text_field(wp_unslash($_POST["\162\x65\x73\164\162\x69\143\x74\137\154\157\147\151\x6e\x5f\x66\157\162\x5f\x6d\x61\x70\160\145\x64\137\x72\x6f\x6c\145\163"])) : false;
        $jo["\153\x65\x65\x70\x5f\x65\170\151\x73\x74\x69\x6e\147\137\165\163\145\162\137\162\157\x6c\145\x73"] = isset($_POST["\x6b\145\x65\x70\137\x65\x78\x69\163\x74\151\x6e\x67\x5f\165\x73\145\162\x5f\162\x6f\x6c\x65\163"]) ? sanitize_text_field(wp_unslash($_POST["\x6b\145\x65\160\x5f\145\x78\151\163\164\x69\x6e\147\137\165\x73\145\162\x5f\x72\157\154\145\163"])) : false;
        $jo["\144\157\156\x74\x5f\144\x69\163\164\165\x72\142\137\x65\170\151\x73\164\x69\x6e\x67\x5f\x75\x73\x65\162\137\x72\157\154\145\163"] = isset($_POST["\144\157\156\164\137\x64\x69\x73\x74\165\x72\142\x5f\x65\x78\x69\x73\x74\x69\x6e\x67\x5f\165\163\x65\162\137\x72\x6f\x6c\x65\163"]) ? sanitize_text_field(wp_unslash($_POST["\x64\157\156\x74\137\144\151\x73\164\165\162\x62\x5f\x65\170\151\163\x74\x69\x6e\x67\x5f\x75\163\x65\x72\x5f\162\157\154\145\163"])) : false;
        $jo["\137\155\141\160\160\151\156\147\x5f\166\x61\154\165\145\x5f\144\145\146\141\x75\154\x74"] = isset($_POST["\x5f\155\x61\x70\160\x69\x6e\147\x5f\166\x61\154\165\x65\x5f\x64\x65\146\141\x75\154\164"]) ? sanitize_text_field(wp_unslash($_POST["\137\x6d\141\160\x70\x69\156\x67\137\x76\x61\154\x75\145\x5f\144\145\146\141\x75\154\x74"])) : "\163\165\142\163\x63\x72\151\x62\x65\162";
        $mq = 100;
        $Oz = 0;
        $ky = [];
        if (!isset($_POST["\155\141\x70\x70\151\156\147\137\x6b\145\x79\137"])) {
            goto MQ;
        }
        $ky = array_map("\163\141\x6e\x69\164\151\x7a\145\137\164\x65\170\x74\137\x66\x69\x65\154\x64", wp_unslash($_POST["\x6d\141\x70\160\x69\156\147\137\153\145\x79\137"]));
        MQ:
        $aP = count($ky);
        $Pp = 1;
        $c3 = 1;
        p2:
        if (!($c3 <= $aP)) {
            goto A4;
        }
        if (isset($_POST["\155\x61\160\x70\151\x6e\147\x5f\153\145\171\x5f"][$Pp])) {
            goto so;
        }
        ic:
        if (!($Pp < 100)) {
            goto QY;
        }
        if (!isset($_POST["\x6d\141\x70\x70\151\x6e\147\137\153\145\171\x5f"][$Pp])) {
            goto VD;
        }
        if (!('' === $_POST["\x6d\141\160\160\x69\156\147\x5f\x6b\145\171\x5f"][$Pp]["\x76\x61\x6c\x75\145"])) {
            goto h4;
        }
        $Pp++;
        goto ic;
        h4:
        $jo["\137\155\141\160\x70\151\156\x67\x5f\153\145\x79\x5f" . $c3] = sanitize_text_field(wp_unslash(isset($_POST["\155\x61\160\x70\151\156\147\137\x6b\145\171\137"][$Pp]) ? $_POST["\155\x61\160\160\151\x6e\147\137\153\x65\x79\137"][$Pp]["\x76\x61\x6c\165\x65"] : ''));
        $jo["\137\x6d\141\x70\160\151\x6e\x67\137\166\141\154\165\x65\137" . $c3] = sanitize_text_field(wp_unslash(isset($_POST["\x6d\x61\x70\160\151\156\x67\x5f\x6b\x65\171\x5f"][$Pp]) ? $_POST["\155\x61\160\160\151\156\x67\x5f\153\145\171\137"][$Pp]["\x72\157\154\x65"] : ''));
        $Oz++;
        $Pp++;
        goto QY;
        VD:
        $Pp++;
        goto ic;
        QY:
        goto Ta;
        so:
        if (!('' === $_POST["\x6d\141\160\x70\x69\x6e\x67\x5f\x6b\x65\171\x5f"][$Pp]["\x76\141\x6c\x75\145"])) {
            goto PA;
        }
        $Pp++;
        goto Pp;
        PA:
        $jo["\137\x6d\x61\160\160\151\x6e\147\137\153\x65\171\x5f" . $c3] = sanitize_text_field(wp_unslash(isset($_POST["\155\x61\x70\160\151\156\x67\137\x6b\x65\171\x5f"][$Pp]) ? $_POST["\155\x61\160\x70\x69\x6e\x67\x5f\153\x65\x79\x5f"][$Pp]["\166\x61\x6c\165\145"] : ''));
        $jo["\x5f\155\141\160\x70\151\x6e\x67\137\x76\x61\154\165\145\137" . $c3] = sanitize_text_field(wp_unslash(isset($_POST["\x6d\x61\160\x70\x69\x6e\x67\x5f\153\x65\171\x5f"][$Pp]) ? $_POST["\x6d\x61\160\x70\x69\156\x67\x5f\153\145\x79\137"][$Pp]["\x72\157\154\145"] : ''));
        $Pp++;
        $Oz++;
        Ta:
        Pp:
        $c3++;
        goto p2;
        A4:
        $jo["\162\157\154\145\x5f\x6d\x61\x70\160\151\x6e\x67\137\143\x6f\x75\x6e\x74"] = $Oz;
        $Rk = $LN->mo_web3_update_option("\155\x6f\x5f\x77\x65\142\63\x5f\162\x6f\x6c\x65\x5f\x6d\141\160\160\151\156\147", $jo);
        Gf:
    }
    public function nft_save_setting()
    {
        if (!(isset($_POST["\155\x6f\x5f\167\145\x62\63\137\x63\x6f\x6e\164\x65\x6e\x74\x5f\162\145\163\164\162\151\x63\164\x69\x6f\x6e\x5f\156\157\156\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\167\145\142\x33\137\143\x6f\156\x74\x65\x6e\164\x5f\x72\145\163\164\162\x69\143\164\x69\157\156\x5f\156\157\x6e\x63\x65"])), "\x6d\x6f\x5f\167\x65\142\63\x5f\x63\x6f\x6e\x74\x65\x6e\164\137\x72\x65\163\164\x72\x69\x63\x74\x69\x6f\x6e"))) {
            goto KL;
        }
        $Nb = isset($_POST["\x70\141\147\145\125\x72\154\x52\x65\x67\x65\x78"]) ? $_POST["\160\x61\147\x65\125\x72\x6c\x52\x65\147\x65\170"] : [];
        $Rp = isset($_POST["\x63\157\x6e\x74\162\141\x63\x74\101\144\144\162\145\x73\163"]) ? $_POST["\143\157\x6e\x74\x72\x61\x63\164\x41\144\144\162\x65\163\x73"] : [];
        $ZB = isset($_POST["\x62\x6c\x6f\x63\153\143\150\141\x69\x6e"]) ? $_POST["\x62\154\x6f\x63\153\143\x68\x61\151\x6e"] : [];
        $z9 = isset($_POST["\145\162\x72\157\162\x55\x72\154"]) ? $_POST["\145\162\162\x6f\x72\x55\162\x6c"] : [];
        $iz = array();
        $Nb = array_values($Nb);
        $Rp = array_values($Rp);
        $ZB = array_values($ZB);
        $z9 = array_values($z9);
        foreach ($Nb as $X8 => $ai) {
            $ai = sanitize_text_field($ai);
            $iz[$ai] = array("\x63\157\156\164\x72\141\143\x74\x41\x64\x64\x72\145\163\x73" => explode("\x3b", sanitize_text_field(wp_unslash($Rp[$X8]))), "\x62\x6c\x6f\143\153\x63\150\x61\151\156" => sanitize_text_field(wp_unslash($ZB[$X8])), "\x65\162\162\157\x72\125\x72\x6c" => sanitize_text_field($z9[$X8]));
            zB:
        }
        dK:
        $this->utils->mo_web3_update_option("\x6d\157\x5f\x77\145\x62\x33\137\x6e\x66\164\x5f\163\x65\x74\x74\151\x6e\x67\163", $iz);
        global $LN;
        $LN->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x4e\106\124\x20\x73\145\x74\164\151\156\x67\40\x73\x61\x76\145\144");
        $LN->mo_web3_show_success_message();
        KL:
    }
    public function hidden_form_data()
    {
        if (!(isset($_POST["\155\x6f\x5f\167\145\142\63\x5f\x68\151\x64\x64\145\156\146\157\x72\x6d\x5f\156\x6f\156\143\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\157\137\167\x65\x62\x33\x5f\x68\x69\x64\144\145\x6e\146\157\162\155\x5f\156\x6f\156\143\x65"])), "\x6d\x6f\137\x77\145\142\63\x5f\167\x70\137\x6e\x6f\156\x63\145"))) {
            goto G9;
        }
        $m5 = isset($_POST["\x61\144\x64\x72\145\x73\x73"]) ? sanitize_text_field(wp_unslash($_POST["\x61\144\x64\x72\145\x73\163"])) : '';
        $Jr = isset($_POST["\x6e\157\156\x63\x65"]) ? sanitize_text_field(wp_unslash($_POST["\156\x6f\156\x63\x65"])) : '';
        $u6 = isset($_POST["\x63\x68\x65\x63\153\x4e\x66\x74"]) ? sanitize_text_field(wp_unslash($_POST["\143\150\145\x63\x6b\116\x66\x74"])) : '';
        $Pv = isset($_POST["\x63\157\156\x74\x72\x61\x63\164\x73"]) ? json_decode(stripslashes($_POST["\143\x6f\156\164\x72\x61\143\164\163"]), true) : '';
        $Z2 = isset($_POST["\162\x65\144\x69\162\x65\x63\164\x69\x6f\x6e\125\162\x6c"]) ? sanitize_text_field(wp_unslash($_POST["\162\145\144\x69\162\x65\143\x74\151\x6f\x6e\x55\162\154"])) : site_url();
        $IQ = $this->utils->mo_web3_get_transient($m5);
        if (!($Jr == $IQ)) {
            goto A3;
        }
        $user = $this->utils->mo_web3_get_user($m5);
        $bY = $m5;
        if (!$this->is_testing_wallet_address) {
            goto CU;
        }
        $bY = $this->is_testing_wallet_address;
        CU:
        clean_user_cache($user->ID);
        wp_clear_auth_cookie();
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, true);
        update_user_caches($user);
        do_action("\167\x70\x5f\154\157\147\151\x6e", $user->data->user_login, $user);
        $ai = $user->ID . "\137\157\167\156\145\144\x5f\x6e\146\164";
        update_user_meta($user->ID, $ai, $u6);
        update_user_meta($user->ID, "\x77\x61\x6c\154\145\164\137\141\144\x64\x72\x65\163\163", $bY);
        $this->apply_role_mapping($user, $Pv);
        $D0 = array("\111\x44" => $user->ID);
        $El = json_decode($this->utils->mo_web3_get_option("\155\x6f\x5f\x77\x65\x62\x33\x5f\x69\156\154\x69\x6e\145\137\x66\x6f\162\155\137\x73\145\x74\164\151\x6e\x67\x73"), true);
        if (!is_array($El)) {
            goto pR;
        }
        foreach ($El as $ai => $K_) {
            if (!isset($_POST[$K_["\155\x65\164\141\137\x6b\x65\x79"]])) {
                goto To;
            }
            if (in_array($K_["\155\x65\x74\141\x5f\x6b\145\x79"], $this->utils->get_wp_user_profile_attributes())) {
                goto SO;
            }
            update_user_meta($user->ID, $K_["\x6d\145\164\141\137\x6b\x65\171"], sanitize_text_field($_POST[$K_["\155\x65\164\x61\137\x6b\145\171"]]));
            goto ut;
            SO:
            $D0[$K_["\155\x65\164\141\x5f\153\x65\171"]] = sanitize_text_field($_POST[$K_["\155\145\164\141\137\153\145\171"]]);
            ut:
            To:
            iT:
        }
        jX:
        $D0 = wp_update_user($D0);
        if (is_wp_error($D0)) {
            goto Kg;
        }
        goto Gs;
        Kg:
        die;
        Gs:
        pR:
        $Jr = uniqid();
        $Uu = 24 * 60 * 60;
        $this->utils->mo_web3_set_transient($m5, $Jr, $Uu);
        $xp = $this->get_curr_page_ID();
        if ($Z2) {
            goto rb;
        }
        wp_send_json("\x4e\x4f\x54\x20\x41\x42\x4c\105\x20\124\117\x20\x52\105\104\x49\x52\105\x43\124");
        goto JD;
        rb:
        wp_safe_redirect($Z2);
        die;
        JD:
        exit;
        A3:
        G9:
    }
    public function apply_role_mapping($RE, $Pv)
    {
        global $LN;
        $jo = $LN->mo_web3_get_option("\x6d\157\137\167\x65\142\63\x5f\x72\x6f\154\x65\x5f\x6d\141\x70\x70\151\156\147");
        if (!(!$this->is_new_user && isset($jo["\153\145\145\x70\137\x65\170\x69\x73\x74\151\x6e\x67\x5f\165\163\x65\x72\x5f\x72\157\154\145\163"]) && true === boolval($jo["\153\x65\x65\160\137\x65\x78\151\x73\x74\x69\x6e\x67\137\165\x73\145\162\137\x72\x6f\154\145\163"]))) {
            goto IK;
        }
        return;
        IK:
        $RE = new \WP_User($RE->ID);
        if (!(isset($jo["\x65\x6e\141\142\154\145\137\x72\x6f\154\145\137\x6d\141\x70\x70\151\156\147"]) && !boolval($jo["\145\x6e\x61\x62\154\x65\x5f\162\157\154\145\137\155\141\x70\160\x69\156\x67"]))) {
            goto zV;
        }
        $RE->set_role('');
        return;
        zV:
        $wv = 0;
        $xW = isset($jo["\x72\x6f\x6c\145\137\x6d\141\160\x70\151\x6e\147\x5f\143\x6f\x75\156\x74"]) ? intval($jo["\162\x6f\154\145\137\155\x61\160\x70\x69\156\x67\x5f\x63\x6f\x75\x6e\x74"]) : 0;
        $SJ = [];
        $m8 = 1;
        P1:
        if (!($m8 <= $xW)) {
            goto l0;
        }
        $Ba = isset($jo["\137\x6d\141\x70\x70\151\156\147\137\x6b\145\171\137" . $m8]) ? $jo["\137\x6d\141\x70\160\x69\156\x67\x5f\x6b\x65\171\x5f" . $m8] : '';
        array_push($SJ, $Ba);
        foreach ($Pv as $y4) {
            $vt = explode("\x2c", $Ba);
            $kC = isset($jo["\137\x6d\141\160\x70\x69\156\x67\x5f\x76\141\x6c\165\145\137" . $m8]) ? $jo["\137\x6d\141\x70\x70\151\x6e\147\x5f\166\141\154\x75\145\137" . $m8] : '';
            if (!in_array($y4, $vt)) {
                goto MB;
            }
            if (!$Ba) {
                goto kc;
            }
            if (!(0 === $wv)) {
                goto uU;
            }
            if (!($this->is_new_user || isset($jo["\144\x6f\156\164\137\144\x69\x73\164\x75\162\142\137\145\x78\151\163\x74\x69\156\x67\x5f\165\x73\x65\162\137\162\x6f\x6c\x65\163"]) && !boolval($jo["\144\157\156\x74\x5f\144\x69\163\x74\165\x72\x62\x5f\145\x78\x69\x73\x74\151\156\147\x5f\x75\x73\145\162\137\x72\157\x6c\145\163"]))) {
                goto kK;
            }
            $RE->set_role('');
            kK:
            uU:
            $RE->add_role($kC);
            $wv++;
            kc:
            MB:
            xh:
        }
        RM:
        mD:
        $m8++;
        goto P1;
        l0:
        if (!(0 === $wv && isset($jo["\x5f\x6d\x61\160\160\x69\x6e\147\x5f\x76\x61\154\165\x65\x5f\x64\x65\x66\141\x75\x6c\164"]) && '' !== $jo["\137\155\141\160\160\151\156\x67\137\x76\x61\x6c\x75\145\137\144\145\146\141\165\x6c\x74"])) {
            goto zl;
        }
        $RE->set_role($jo["\137\155\141\160\x70\x69\x6e\147\x5f\166\141\x6c\x75\145\137\144\145\146\x61\x75\x6c\164"]);
        zl:
        $Hz = 0;
        if (!(isset($jo["\162\x65\x73\164\162\151\143\x74\x5f\154\157\x67\151\x6e\137\146\x6f\162\x5f\155\x61\160\x70\x65\x64\x5f\162\157\154\x65\x73"]) && boolval($jo["\x72\145\163\x74\x72\151\143\164\x5f\154\157\147\x69\x6e\137\x66\x6f\162\137\155\141\x70\160\x65\x64\x5f\162\157\154\x65\x73"]))) {
            goto fa;
        }
        foreach ($Pv as $y4) {
            if (!in_array($y4, $SJ, true)) {
                goto jG;
            }
            $Hz = 1;
            jG:
            sA:
        }
        oC:
        if (!($Hz !== 1)) {
            goto OG;
        }
        require_once ABSPATH . "\167\x70\55\x61\x64\155\151\156\57\x69\156\x63\x6c\165\144\145\x73\57\165\x73\145\162\x2e\160\150\x70";
        \wp_delete_user($RE->ID);
        $Lj = "\131\157\165\40\x64\x6f\40\x6e\x6f\164\x20\x68\141\166\x65\40\x70\x65\x72\x6d\151\x73\163\x69\x6f\x6e\163\x20\164\157\x20\154\x6f\x67\151\156\40\x77\151\164\150\x20\171\157\165\162\40\x63\165\x72\162\x65\156\164\x20\x72\x6f\x6c\x65\x73\x2e\x20\x50\154\145\x61\x73\x65\x20\x63\157\x6e\164\141\143\164\40\164\150\x65\x20\x41\144\155\x69\x6e\151\x73\x74\x72\x61\164\157\x72\56";
        wp_die($Lj);
        OG:
        fa:
    }
    public function type_of_request()
    {
        if (!(wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST["\155\157\137\x77\x65\x62\63\x5f\166\145\162\x69\x66\x79\x5f\x6e\157\156\x63\x65"])), "\x6d\x6f\x5f\167\x65\x62\x33\x5f\x77\160\137\156\x6f\156\x63\x65") && isset($_REQUEST["\x72\x65\161\165\145\x73\x74"]))) {
            goto FX;
        }
        $FY = sanitize_text_field(wp_unslash($_REQUEST["\x72\x65\x71\165\145\x73\x74"]));
        if ($FY == "\154\x6f\147\151\x6e") {
            goto CV;
        }
        if ($FY == "\x61\165\x74\x68") {
            goto iC;
        }
        if ($FY == "\x65\x6d\x61\x69\x6c\x43\x68\145\143\153") {
            goto v0;
        }
        if ($FY == "\147\145\x74\x41\144\x6d\151\x6e\103\x6f\156\x66\151\x67\x75\x72\x65\144\116\x66\164\x44\141\164\x61") {
            goto g4;
        }
        if ($FY == "\147\145\164\125\x73\145\162\110\157\x6c\144\116\x46\x54\x44\141\x74\141") {
            goto iN;
        }
        if ($FY == "\x73\x68\x6f\x77\116\x66\164\x44\x61\x74\x61") {
            goto gR;
        }
        goto pm;
        CV:
        $this->handle_login_request();
        goto pm;
        iC:
        $this->handle_auth_request();
        goto pm;
        v0:
        $this->check_email_existence();
        goto pm;
        g4:
        $this->get_admin_configured_nft_data();
        goto pm;
        iN:
        $YR = $_REQUEST["\x63\x6f\x6e\x74\x72\x61\143\164\101\x64\144\162\145\163\x73\145\x73"];
        $Ms = $_REQUEST["\x62\x6c\157\143\x6b\x63\150\x61\151\156"];
        $I6 = get_current_user_id();
        $bY = get_user_meta($I6, "\167\x61\x6c\x6c\x65\x74\x5f\141\x64\144\x72\x65\163\163", true);
        $this->get_user_nft_using_api($YR, $bY, $Ms);
        goto pm;
        gR:
        $TO = $_REQUEST["\156\146\x74\104\141\164\141\125\x72\x69"];
        $this->display_nft_data($TO);
        pm:
        FX:
    }
    public function display_nft_data($TO)
    {
        $Xl = wp_remote_get($TO);
        $Xl = wp_remote_retrieve_body($Xl);
        wp_send_json($Xl);
    }
    public function get_admin_configured_nft_data()
    {
        $KG = $this->utils->mo_web3_get_option("\x6d\x6f\x5f\167\x65\x62\x33\x5f\156\146\x74\x5f\163\145\164\x74\x69\x6e\x67\x73");
        wp_send_json($KG);
    }
    public function get_user_nft_using_api($YR, $bY, $Ms)
    {
        $Xu = array("\x68\145\141\144\145\162\163" => array("\x43\157\x6e\x74\x65\156\164\x2d\124\x79\160\x65" => "\x61\160\x70\154\x69\x63\x61\x74\x69\x6f\x6e\x2f\152\x73\x6f\156", "\x41\x75\x74\x68\x6f\162\151\172\x61\164\151\x6f\x6e" => "\65\x30\60\x36\x35\x66\x34\x35\x2d\x65\x63\63\x39\55\x34\64\x39\x66\55\x61\146\70\60\x2d\60\x31\70\x61\x66\x30\x31\x61\x38\60\x63\62"));
        $Ms = strtolower($Ms);
        $kF = "\150\x74\164\160\x73\72\57\x2f\x61\160\151\x2e\156\146\164\x70\157\x72\x74\56\x78\171\172\x2f\166\x30\57\141\143\x63\157\165\156\x74\x73\x2f" . $bY . "\77\x63\x68\x61\151\x6e\x3d" . $Ms . "\x26\143\157\156\164\162\141\x63\164\x5f\x61\x64\x64\162\x65\163\x73\x3d" . $YR;
        $bF = wp_remote_get($kF, $Xu);
        $bF = wp_remote_retrieve_body($bF);
        wp_send_json($bF);
    }
    public function check_email_existence()
    {
        $Lh = isset($_REQUEST["\x65\155\x61\x69\154"]) ? sanitize_text_field(wp_unslash($_REQUEST["\145\x6d\x61\151\x6c"])) : '';
        $iz = email_exists($Lh);
        if (!$iz) {
            goto Hz;
        }
        wp_send_json("\145\162\162\x6f\162");
        goto y6;
        Hz:
        wp_send_json("\163\165\143\x63\145\x73\163");
        y6:
    }
    public function handle_login_request()
    {
        $m5 = isset($_REQUEST["\x61\144\x64\162\x65\163\163"]) ? sanitize_text_field(wp_unslash($_REQUEST["\141\144\144\x72\x65\163\x73"])) : '';
        $Jr = $this->utils->mo_web3_get_transient($m5);
        if ($Jr) {
            goto yW;
        }
        $Jr = uniqid();
        $Uu = 24 * 60 * 60;
        $this->utils->mo_web3_set_transient($m5, $Jr, $Uu);
        wp_send_json("\123\151\147\x6e\40\164\150\x69\x73\x20\155\145\x73\163\141\x67\x65\x20\164\157\40\166\x61\x6c\151\144\x61\164\145\40\x74\x68\141\x74\40\x79\x6f\x75\x20\x61\162\145\40\164\x68\x65\x20\157\x77\x6e\145\162\40\x6f\146\x20\164\150\145\x20\x61\x63\x63\157\x75\156\164\56\40\x52\x61\x6e\144\157\x6d\x20\x73\164\162\151\156\147\72\x20" . $Jr);
        goto An;
        yW:
        wp_send_json("\x53\151\x67\x6e\x20\x74\150\151\163\x20\x6d\x65\x73\x73\141\x67\145\40\x74\x6f\x20\x76\x61\154\x69\144\x61\164\x65\x20\164\150\141\x74\40\x79\157\x75\40\x61\x72\145\40\164\150\x65\x20\x6f\x77\156\145\x72\40\157\146\x20\x74\x68\x65\40\141\x63\143\x6f\165\156\164\x2e\40\122\x61\156\144\157\x6d\40\x73\164\162\151\x6e\147\x3a\40" . $Jr);
        An:
    }
    public function pub_key_to_address($ps)
    {
        return "\60\170" . substr(Keccak::hash(substr(hex2bin($ps->encode("\x68\145\x78")), 1), 256), 24);
    }
    public function verify_signature($Nr, $t0, $m5)
    {
        $zj = strlen($Nr);
        $xL = Keccak::hash("\31\105\x74\150\145\x72\x65\x75\155\x20\x53\x69\147\x6e\x65\144\x20\115\x65\163\x73\x61\147\x65\x3a\xa{$zj}{$Nr}", 256);
        $YW = ["\x72" => substr($t0, 2, 64), "\163" => substr($t0, 66, 64)];
        $lO = ord(hex2bin(substr($t0, 130, 2))) - 27;
        if (!($lO != ($lO & 1))) {
            goto vh;
        }
        if (preg_match("\57\x30\60\44\x2f", $t0)) {
            goto Qw;
        }
        if (preg_match("\57\60\x31\44\57", $t0)) {
            goto gj;
        }
        return 0;
        goto Uk;
        gj:
        $lO = 1;
        Uk:
        goto vr;
        Qw:
        $lO = 0;
        vr:
        vh:
        $BI = new EC("\x73\145\143\160\62\65\x36\x6b\61");
        $ps = $BI->recoverPubKey($xL, $YW, $lO);
        return $m5 == $this->pub_key_to_address($ps);
    }
    public function handle_auth_request()
    {
        $m5 = isset($_REQUEST["\x61\144\144\162\x65\163\x73"]) ? sanitize_text_field(wp_unslash($_REQUEST["\x61\144\144\162\145\x73\x73"])) : '';
        $t0 = isset($_REQUEST["\x73\x69\147\x6e\141\x74\x75\x72\145"]) ? sanitize_text_field(wp_unslash($_REQUEST["\163\x69\147\156\x61\164\165\x72\145"])) : '';
        $Jr = $this->utils->mo_web3_get_transient($m5);
        $Nr = "\x53\x69\147\x6e\40\x74\150\x69\x73\x20\x6d\x65\163\163\x61\147\145\x20\x74\157\x20\166\141\x6c\x69\144\x61\164\145\x20\x74\x68\141\164\40\171\157\165\x20\141\162\x65\x20\164\150\x65\x20\x6f\x77\156\145\x72\x20\157\146\40\164\x68\x65\40\141\x63\x63\157\x75\156\164\x2e\40\x52\x61\156\x64\x6f\155\40\x73\x74\162\151\x6e\147\72\x20" . $Jr;
        if ($this->verify_signature($Nr, $t0, $m5)) {
            goto up;
        }
        $bF = array("\151\x73\x53\x69\147\156\x61\x74\x75\x72\145\x56\x65\162\x69\146\151\145\144" => 0, "\156\x6f\156\x63\145" => null);
        wp_send_json($bF);
        goto ZO;
        up:
        $Jr = uniqid();
        $Uu = 24 * 60 * 60;
        $this->utils->mo_web3_set_transient($m5, $Jr, $Uu);
        $KG = $this->utils->mo_web3_get_option("\155\x6f\137\x77\x65\x62\63\x5f\x6e\x66\x74\x5f\x73\145\x74\164\151\x6e\x67\163");
        $zv = $this->utils->mo_web3_get_option("\x6d\x6f\x5f\167\145\142\63\x5f\162\157\x6c\x65\x5f\x6d\x61\x70\160\x69\x6e\147");
        $cX = $this->utils->mo_web3_get_option("\x6d\157\x5f\x77\145\142\63\137\151\x6e\x6c\151\x6e\145\x5f\146\x6f\x72\155\x5f\163\145\164\x74\x69\156\x67\x73");
        $bF = array("\151\163\123\151\147\x6e\141\164\165\162\145\x56\145\x72\x69\146\151\x65\144" => 1, "\x6e\157\x6e\x63\x65" => $Jr);
        if (!($KG && !is_null($KG))) {
            goto rm;
        }
        $bF["\141\x64\155\x69\156\116\x66\164\123\x65\164\x74\151\x6e\x67"] = $KG;
        rm:
        $So = md5($m5);
        $He = username_exists($m5) ? false : (username_exists($So) ? false : true);
        $Lx = $this->utils->mo_web3_get_option("\155\157\x5f\167\145\x62\x33\x5f\143\165\163\x74\157\155\137\x70\162\157\x66\x69\154\x65\137\143\x6f\x6d\160\x6c\x65\164\151\157\156\137\162\x65\144\151\162\x65\x63\x74\137\x75\x72\x6c");
        if (filter_var($Lx, FILTER_VALIDATE_URL)) {
            goto yn;
        }
        $bF["\143\165\163\164\x6f\x6d\137\160\x72\x6f\146\151\x6c\x65\137\143\157\x6d\160\154\145\x74\x69\157\x6e\x5f\x72\x65\144\x69\x72\x65\143\x74\137\x75\x72\154"] = null;
        goto lq;
        yn:
        $bF["\143\x75\163\164\x6f\x6d\x5f\x70\162\157\146\x69\154\x65\x5f\x63\157\155\x70\x6c\x65\x74\x69\157\x6e\x5f\162\x65\x64\x69\x72\145\143\164\137\165\162\x6c"] = $Lx;
        lq:
        $bF["\156\145\x77\x55\163\145\162\122\x65\x67\151\163\x74\x65\x72\141\x74\151\x6f\156"] = $He;
        $bF["\x72\x6f\x6c\x65\115\141\160\160\151\x6e\x67\x53\x65\164\x74\x69\156\x67"] = $zv;
        $bF["\151\x6e\x6c\x69\156\145\x46\157\162\x6d\x53\145\x74\x74\151\156\147"] = json_decode($cX);
        wp_send_json($bF);
        ZO:
    }
}
