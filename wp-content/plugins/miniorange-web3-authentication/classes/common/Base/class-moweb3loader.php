<?php


namespace MoWeb3\Base;

use MoWeb3\Base\MoWeb3InstanceHelper;
use MoWeb3\MoWeb3Utils;
use MoWeb3\view\SetupGuideView\MoWeb3GuideView;
use MoWeb3\view\ContentRestrictionView\MoWeb3ContentRestriction;
use MoWeb3\view\ShortcodeInfoView\MoWeb3ShortcodeInfo;
use MoWeb3\view\RoleMappingView\MoWeb3RoleMapping;
use MoWeb3\view\InlineFormConfigView\MoWeb3InlineFormConfig;
class MoWeb3Loader
{
    private $instance_helper;
    private $moweb3_util;
    private $moweb3_guide;
    private $moweb3_content_restriction;
    private $moweb3_shortcode_info;
    public function __construct()
    {
        add_action("\x61\x64\155\x69\156\137\x65\156\x71\x75\x65\165\145\137\x73\143\x72\151\x70\x74\163", array($this, "\160\x6c\165\x67\151\x6e\137\x73\x65\164\164\151\x6e\147\163\137\163\x74\x79\154\x65"));
        add_action("\141\144\x6d\151\156\x5f\145\x6e\161\x75\x65\165\x65\137\163\143\x72\151\160\164\163", array($this, "\x70\154\x75\x67\x69\156\x5f\x73\x65\164\164\x69\156\147\x73\137\x73\x63\162\151\160\164"));
        $this->moweb3_util = new MoWeb3Utils();
        $this->instance_helper = new MoWeb3InstanceHelper();
    }
    public function plugin_settings_style()
    {
        wp_enqueue_style("\155\157\137\167\145\142\x33\137\x61\x64\x6d\151\x6e\137\163\145\x74\164\x69\156\x67\x73\137\163\x74\x79\154\145", MOWEB3_URL . "\162\145\163\x6f\x75\x72\143\x65\x73\x2f\x63\163\163\x2f\163\x74\171\154\x65\137\163\145\x74\164\x69\x6e\x67\163\56\143\x73\163", array(), $tn = "\61\56\x30\x2e\61", $vj = false);
        wp_enqueue_style("\155\157\137\167\145\142\x33\x5f\x61\144\155\x69\x6e\137\163\x65\164\x74\151\156\x67\x73\137\x70\150\157\156\145\137\x73\x74\x79\x6c\x65", MOWEB3_URL . "\162\145\x73\157\x75\x72\143\145\x73\57\143\163\163\57\x70\x68\157\x6e\145\56\143\x73\163", array(), $tn = "\x31\x2e\60\x2e\x31", $vj = false);
    }
    public function plugin_settings_script()
    {
        wp_enqueue_script("\x6d\x6f\137\x77\145\142\x33\x5f\x61\144\x6d\151\x6e\x5f\163\145\x74\x74\151\x6e\147\163\137\x73\143\x72\151\x70\164", MOWEB3_URL . "\x72\x65\163\x6f\165\x72\x63\x65\163\57\x6a\163\x2f\163\145\x74\164\151\156\147\163\x2e\152\163", array(), $tn = "\x31\x2e\60\x2e\x31", $vj = false);
        wp_enqueue_script("\x6d\x6f\137\x77\x65\142\63\137\x61\x64\x6d\x69\156\x5f\163\145\164\x74\151\x6e\x67\163\x5f\x70\x68\x6f\x6e\145\x5f\x73\x63\162\151\160\164", MOWEB3_URL . "\162\145\x73\157\x75\162\143\x65\163\x2f\152\x73\x2f\160\150\157\x6e\145\56\x6a\x73", array(), $tn = "\x31\x2e\x30\x2e\61", $vj = false);
    }
    public function load_current_tab($bR)
    {
        global $LN;
        $Sq = $this->instance_helper->get_accounts_instance();
        $MC = $LN->mo_web3_is_clv();
        if ("\141\143\143\x6f\165\x6e\x74" === $bR || !$MC) {
            goto Fc;
        }
        if ("\143\x6f\156\146\x69\x67" === $bR || '' === $bR) {
            goto R0;
        }
        if ("\163\x65\x74\x75\x70\137\x67\165\x69\x64\145" === $bR) {
            goto Hx;
        }
        if ("\143\x6f\x6e\164\x65\x6e\164\x5f\x72\145\x73\164\162\151\x63\x74\x69\157\x6e" === $bR) {
            goto o8;
        }
        if ("\163\150\157\162\164\x63\157\x64\x65\x5f\151\156\x66\157" === $bR) {
            goto zY;
        }
        if ("\x72\x6f\x6c\145\137\155\x61\160\x70\x69\x6e\x67" === $bR) {
            goto Dh;
        }
        if ("\151\x6e\x6c\151\x6e\145\137\x66\157\x72\155\137\x63\x6f\156\x66\x69\x67" === $bR) {
            goto Ed;
        }
        goto Rx;
        Fc:
        if ($LN->mo_web3_get_option("\155\x6f\x5f\167\145\x62\x33\137\x76\x65\x72\151\x66\171\137\x63\x75\x73\164\157\155\145\x72") === "\164\162\165\x65") {
            goto h2;
        }
        if (trim($LN->mo_web3_get_option("\x6d\x6f\137\167\x65\x62\63\137\x61\144\155\x69\x6e\x5f\x65\155\x61\151\154") ?? '') !== '' && trim($LN->mo_web3_get_option("\155\x6f\x5f\x77\x65\142\63\137\x61\x64\x6d\x69\156\x5f\141\160\x69\x5f\x6b\145\171") ?? '') === '' && $LN->mo_web3_get_option("\x6d\x6f\x5f\x77\145\142\x33\137\156\145\167\137\162\145\x67\x69\x73\x74\x72\x61\x74\151\x6f\156") !== "\x74\x72\x75\x65") {
            goto Ah;
        }
        if (!$LN->mo_web3_is_clv() && $LN->mo_web3_is_customer_registered()) {
            goto Eo;
        }
        $Sq->register();
        goto KV;
        h2:
        $Sq->verify_password_ui();
        goto KV;
        Ah:
        $Sq->verify_password_ui();
        goto KV;
        Eo:
        $Sq->mo_web3_lp();
        KV:
        goto Rx;
        R0:
        $this->instance_helper->get_config_instance()->render_ui();
        goto Rx;
        Hx:
        $this->moweb3_guide = new MoWeb3GuideView();
        $this->moweb3_guide->view();
        goto Rx;
        o8:
        $this->moweb3_content_restriction = new MoWeb3ContentRestriction();
        $this->moweb3_content_restriction->view();
        goto Rx;
        zY:
        $this->moweb3_shortcode_info = new MoWeb3ShortcodeInfo();
        $this->moweb3_shortcode_info->view();
        goto Rx;
        Dh:
        $this->moweb3_role_mapping = new MoWeb3RoleMapping();
        $this->moweb3_role_mapping->view();
        goto Rx;
        Ed:
        $this->moweb3_inline_form_config = new MoWeb3InlineFormConfig();
        $this->moweb3_inline_form_config->view();
        Rx:
    }
}
