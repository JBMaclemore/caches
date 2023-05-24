<?php


namespace MoWeb3;

use MoWeb3\MoWeb3Settings;
use MoWeb3\MoWeb3Customer;
class MoWeb3FeedbackSettings
{
    private $common_settings;
    public function __construct()
    {
        $this->common_settings = new MoWeb3Settings();
        add_action("\x61\144\155\151\x6e\x5f\x69\156\x69\x74", array($this, "\155\x6f\137\167\x65\142\x33\137\146\162\x65\x65\x5f\x73\x65\164\164\151\156\147\x73"));
        add_action("\x61\x64\x6d\151\156\x5f\146\x6f\157\x74\145\x72", array($this, "\x6d\157\x5f\167\145\142\x33\137\146\145\x65\144\x62\141\x63\153\137\162\145\161\165\x65\x73\164"));
    }
    public function mo_web3_free_settings()
    {
        global $LN;
        if (!(sanitize_text_field($_SERVER["\x52\105\121\x55\x45\123\x54\137\115\105\x54\x48\117\104"]) === "\120\117\x53\x54" && current_user_can("\141\144\155\151\156\151\x73\x74\162\x61\164\x6f\162"))) {
            goto zh;
        }
        if (!(isset($_POST["\x6d\x6f\x5f\167\x65\x62\x33\137\x66\x65\145\144\x62\141\x63\153\x5f\156\x6f\x6e\143\x65"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\x6d\x6f\137\x77\145\x62\x33\x5f\x66\x65\x65\x64\142\x61\x63\153\137\156\x6f\156\143\x65"])), "\155\x6f\x5f\x77\145\x62\x33\x5f\x66\145\145\144\142\x61\x63\153") && isset($_POST[\MoWeb3Constants::OPTION]) && "\155\157\137\x77\145\142\x33\x5f\146\x65\145\144\x62\x61\x63\153" === sanitize_text_field($_POST[\MoWeb3Constants::OPTION]))) {
            goto aB;
        }
        $user = wp_get_current_user();
        $Nr = "\120\154\x75\147\151\x6e\40\104\x65\141\x63\x74\x69\x76\141\x74\x65\144\x3a";
        $Fu = isset($_POST["\x6d\x6f\137\167\x65\142\x33\137\x64\145\141\x63\164\x69\x76\141\164\x65\x5f\x72\x65\x61\163\x6f\156\137\x72\x61\144\x69\157"]) ? sanitize_text_field(wp_unslash($_POST["\155\x6f\x5f\x77\145\142\x33\137\x64\x65\x61\x63\164\151\x76\141\x74\x65\137\x72\x65\x61\163\157\156\137\162\x61\144\151\157"])) : false;
        $Y8 = isset($_POST["\x6d\157\x5f\x77\x65\x62\x33\x5f\161\165\x65\162\171\137\146\145\145\x64\x62\141\143\153"]) ? sanitize_text_field(wp_unslash($_POST["\x6d\x6f\x5f\x77\x65\x62\63\x5f\161\165\145\162\x79\x5f\x66\145\x65\144\142\141\x63\153"])) : false;
        if ($Fu) {
            goto pO;
        }
        $LN->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x50\154\145\x61\x73\x65\x20\x53\145\x6c\145\x63\x74\x20\157\156\x65\x20\x6f\x66\x20\x74\x68\145\40\x72\145\141\163\x6f\156\x73\x20\54\x69\146\40\171\157\165\162\x20\162\x65\141\163\157\x6e\40\151\x73\40\156\157\x74\x20\x6d\x65\x6e\x74\151\x6f\x6e\145\144\x20\160\x6c\x65\141\x73\145\x20\163\145\154\145\143\x74\40\x4f\x74\150\x65\162\x20\x52\145\x61\x73\157\156\163");
        $LN->mo_web3_show_error_message();
        pO:
        $Nr .= $Fu;
        if (!isset($Y8)) {
            goto bQ;
        }
        $Nr .= "\72" . $Y8;
        bQ:
        $Lh = $LN->mo_web3_get_option("\x6d\157\x5f\167\x65\x62\63\x5f\141\x64\155\x69\156\137\x65\x6d\141\151\154");
        if (!($Lh == '')) {
            goto Th;
        }
        $Lh = $user->user_email;
        Th:
        $lI = $LN->mo_web3_get_option("\155\x6f\137\167\145\x62\63\x5f\141\144\x6d\x69\x6e\x5f\x70\150\157\x6e\145");
        $VY = new MoWeb3Customer();
        $v6 = json_decode($VY->mo_web3_send_email_alert($Lh, $lI, $Nr), true);
        deactivate_plugins(MOWEB3_DIR . DIRECTORY_SEPARATOR . "\155\151\156\x69\157\x72\x61\x6e\x67\x65\x2d\x77\145\142\x33\x2d\154\157\x67\x69\x6e\55\x73\145\x74\164\x69\x6e\x67\163\x2e\160\150\x70");
        $LN->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x54\150\x61\x6e\x6b\x20\x79\x6f\x75\x20\146\x6f\x72\x20\x74\150\x65\x20\x66\145\145\144\x62\x61\143\153\56");
        $LN->mo_web3_show_success_message();
        aB:
        if (!(isset($_POST["\x6d\157\137\167\145\142\63\x5f\x73\153\x69\x70\x5f\146\145\145\x64\x62\x61\143\x6b\x5f\x6e\x6f\x6e\x63\145"]) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST["\155\x6f\137\167\145\142\x33\137\163\153\x69\160\x5f\146\145\x65\x64\142\x61\143\153\137\156\x6f\x6e\x63\145"])), "\x6d\157\137\167\145\142\63\x5f\x73\x6b\151\x70\x5f\146\x65\x65\144\x62\x61\x63\x6b") && isset($_POST["\157\x70\x74\151\157\x6e"]) && "\x6d\157\x5f\x77\145\x62\x33\x5f\x73\x6b\x69\x70\x5f\x66\x65\x65\x64\x62\141\x63\153" === sanitize_text_field($_POST["\x6f\x70\164\x69\157\x6e"]))) {
            goto LX;
        }
        deactivate_plugins(MOWEB3_DIR . DIRECTORY_SEPARATOR . "\x6d\x69\156\151\157\x72\141\156\x67\145\55\167\x65\142\x33\x2d\x6c\157\147\x69\156\x2d\x73\x65\x74\164\x69\x6e\x67\x73\56\x70\150\x70");
        $LN->mo_web3_update_option(\MoWeb3Constants::PANEL_MESSAGE_OPTION, "\x50\154\x75\x67\151\x6e\40\x44\x65\x61\x63\164\x69\166\141\164\145\x64\40\123\165\x63\143\x65\x73\x73\x66\165\x6c\171\56\40\x57\x65\40\x77\x69\x6c\x6c\40\x67\145\x74\x20\x62\x61\143\153\x20\164\157\40\x79\157\x75\40\x73\150\157\x72\164\154\x79\x2e");
        $LN->mo_web3_show_success_message();
        LX:
        zh:
    }
    public function mo_web3_feedback_request()
    {
        $pT = new \MoWeb3\MoWeb3Feedback();
        $pT->show_form();
    }
}
