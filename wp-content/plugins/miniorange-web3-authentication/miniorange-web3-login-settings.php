<?php
/**
 * Plugin Name: WEB3 authentication
 * Plugin URI: http://miniorange.com
 * Description: WordPress WEB3 authentication allows the functionality to auto login, auto register into WordPress using the WEB3 Crypto wallet like metamask.
 * Version: 11.2.0
 * Author: miniOrange
 * License: MIT/Expat
 * License URI: https://docs.miniorange.com/mit-license
 */


require "\137\x61\x75\x74\x6f\x6c\157\x61\x64\56\160\x68\x70";
use MoWeb3\Base\MoWeb3BaseStructure;
use MoWeb3\Base\MoWeb3InstanceHelper;
use MoWeb3\controller\MoWeb3FlowHandler;
use MoWeb3\view\ButtonView\MoWeb3View;
use MoWeb3\view\SettingsView\MoWeb3SettingsView;
global $LN;
$xT = new MoWeb3InstanceHelper();
$RR = new MoWeb3BaseStructure();
$zl = new MoWeb3FlowHandler();
$rP = new MoWeb3View();
$hg = new MoWeb3SettingsView();
$LN = $xT->get_utils_instance();
$vh = $xT->get_settings_instance();
$OT = $xT->get_all_method_instances();
mo_web3_load_all_methods($OT);
add_shortcode("\155\x6f\137\x77\x65\142\x33\137\x70\x6f\163\x74\x5f\162\145\x73\164\162\151\143\164\151\x6f\156\137\x73\150\157\x72\164\x63\x6f\144\x65", "\x6d\157\x5f\x77\145\142\x33\137\160\x6f\x73\164\x5f\162\x65\163\x74\162\x69\x63\x74\151\157\156\x5f\x73\150\x6f\162\164\x63\x6f\x64\x65");
add_shortcode("\x6d\157\137\167\x65\142\63\x5f\154\157\x67\x69\156\137\x62\x75\164\x74\157\156\137\163\x68\x6f\x72\x74\143\x6f\x64\145", "\x6d\x6f\x5f\x77\145\x62\63\x5f\154\x6f\x67\151\x6e\137\142\165\x74\164\157\156\x5f\x73\150\x6f\162\164\x63\157\x64\145");
add_shortcode("\155\157\137\167\145\142\x33\137\163\x68\x6f\167\137\x6e\x66\x74\137\163\x68\157\162\164\143\x6f\144\145", "\155\x6f\x5f\167\145\x62\63\137\x73\x68\157\x77\x5f\x6e\146\164\137\x6f\167\x6e\137\142\x79\137\x75\163\x65\162");
function mo_web3_show_nft_own_by_user($tV, $ta = null)
{
    $ta = '';
    $rP = new MoWeb3View();
    $ta .= "{$rP->mo_web3_wp_enqueue()}";
    $ta .= "\x3c\142\x6f\144\x79\40\x6f\156\x6c\x6f\x61\x64\75\163\150\x6f\x77\x4e\146\164\117\167\156\102\x79\x55\163\x65\x72\x55\163\151\x6e\x67\101\160\x69\x28\51\76";
    $ta .= "\74\x64\151\166\40\x69\144\x3d\x27\x6e\146\x74\163\47\x20\x3e\x3c\160\x20\x69\x64\75\47\156\x66\x74\114\157\x61\144\x4d\163\147\x27\x3e\120\154\145\x61\163\145\x20\x77\x61\151\164\x20\167\x68\x69\x6c\145\x20\167\x65\40\141\x72\145\40\x6c\x6f\x61\x64\x69\156\x67\40\x79\157\x75\x72\40\116\x46\124\47\x73\x3c\x2f\160\x3e\x3c\57\x64\151\x76\76";
    $ta .= "\74\57\142\x6f\144\x79\76";
    return $ta;
}
function mo_web3_post_restriction_shortcode($tV, $ta = null)
{
    global $LN;
    $C9 = $LN->get_current_page_url();
    if (is_user_logged_in() && !is_null($ta)) {
        goto ij;
    }
    $ta = '';
    $gQ = "\x62\164\156\40\x62\x74\x6e\55\x6f\165\x74\x6c\x69\156\x65\x2d\x70\162\x69\155\x61\x72\171\40\155\x62\55\63";
    $VV = $LN->mo_web3_get_option("\x6d\157\137\x77\145\142\63\x5f\154\157\147\151\x6e\x5f\142\165\164\164\x6f\x6e\137\x63\x75\x73\x74\157\155\137\x63\163\x73");
    $rP = new MoWeb3View();
    if (!($VV && strlen(trim($VV ?? '')) > 5)) {
        goto dP;
    }
    $ta = "\74\163\x74\x79\154\x65\x3e\40" . $VV . "\x20\x3c\57\x73\x74\171\154\x65\x3e";
    $gQ = "\x6d\157\137\x77\x65\142\63\x5f\x6c\157\x67\151\156";
    dP:
    $ta .= "{$rP->mo_web3_wp_enqueue()}";
    $ta .= "\x3c\x64\x69\x76\76\46\x6e\x62\x73\160\73\x26\156\x62\x73\x70\x3b\x3c\x62\x75\164\164\x6f\156\40\x20\x63\154\141\163\x73\75\x27{$gQ}\x27\x20\157\156\143\x6c\x69\143\x6b\75\x75\x73\x65\162\114\157\147\x69\156\117\165\164\x28\x30\54\47{$C9}\47\x29\x20\164\x79\x70\145\x3d\x27\x62\x75\164\164\157\156\x27\40\x69\x64\75\x27\142\165\164\x74\x6f\156\x54\145\x78\x74\x27\x20\40\76";
    $ta .= "{$rP->get_button_custom_text()}\x3c\x2f\x62\165\164\164\157\156\x3e\x3c\x2f\x64\x69\166\76";
    return $ta;
    goto ek;
    ij:
    return $ta;
    ek:
}
function mo_web3_login_button_shortcode($t7, $ta = null)
{
    global $LN;
    $Xu = shortcode_atts(array("\162\145\x64\151\x72\145\x63\164\x69\157\156\137\x75\162\x6c" => site_url(), "\x74\145\x78\164\x5f\x63\x6f\x6c\157\x72" => "\x62\154\141\143\153"), $t7);
    $CT = $Xu["\162\145\x64\151\x72\145\143\x74\151\x6f\156\x5f\165\162\154"];
    $ZW = $Xu["\164\145\170\164\x5f\143\157\x6c\x6f\162"];
    if (!is_user_logged_in()) {
        goto p9;
    }
    $I6 = get_current_user_id();
    $bY = get_user_meta($I6, "\167\141\154\x6c\x65\x74\137\x61\144\144\x72\145\163\x73", true);
    if (!(strlen($bY) > 0)) {
        goto cf;
    }
    $bY = $LN->trim_the_wallet_address($bY);
    return "\x3c\x64\x69\166\x20\40\x73\x74\171\x6c\x65\75\47\143\157\154\157\x72\72{$ZW}\47\76\46\x6e\x62\163\x70\73\x26\156\x62\x73\160\x3b" . $bY . "\74\x2f\144\151\166\x3e";
    cf:
    p9:
    $ta = '';
    $gQ = "\142\164\156\x20\142\164\x6e\55\157\x75\x74\154\x69\156\145\x2d\x70\162\x69\155\x61\162\x79\40\x6d\x62\55\x33";
    $VV = $LN->mo_web3_get_option("\155\x6f\137\167\x65\x62\x33\137\154\x6f\x67\x69\x6e\x5f\142\165\164\164\x6f\x6e\137\x63\x75\163\x74\x6f\155\x5f\143\x73\x73");
    $rP = new MoWeb3View();
    if (!($VV && strlen(trim($VV ?? '')) > 5)) {
        goto NK;
    }
    $ta = "\x3c\x73\x74\171\154\x65\76\40" . $VV . "\x20\x3c\x2f\163\x74\x79\154\145\x3e";
    $gQ = "\155\157\137\167\x65\142\x33\x5f\154\157\x67\151\156";
    NK:
    $ta .= "\x3c\144\x69\x76\40\151\144\75\x27\154\157\147\x69\156\x27\x3e\x3c\x2f\144\151\166\76";
    $ta .= "{$rP->mo_web3_wp_enqueue()}";
    $ta .= "\x3c\144\151\166\x3e\46\156\x62\163\160\73\x26\x6e\x62\163\160\x3b\74\x62\165\x74\x74\157\156\x20\40\x63\x6c\x61\x73\163\75\47{$gQ}\47\x20\157\x6e\x63\x6c\x69\x63\x6b\75\x75\163\145\162\114\x6f\x67\x69\x6e\117\x75\164\50\60\x2c\47{$CT}\x27\51\x20\164\171\160\x65\75\47\x62\165\164\x74\x6f\156\47\40\151\x64\75\47\142\x75\164\164\x6f\156\x54\145\170\x74\x27\x20\x20\x3e";
    $ta .= "{$rP->get_button_custom_text()}\x3c\57\142\x75\164\x74\157\156\x3e\74\x2f\x64\151\166\x3e";
    return $ta;
}
function mo_web3_deactivate()
{
    global $LN;
    do_action("\x6d\x6f\x5f\x77\x65\142\x33\137\x63\154\x65\141\x72\x5f\160\x6c\x75\x67\137\x63\x61\x63\x68\x65");
    $LN->deactivate_plugin();
}
function moweb3_activation_redirect($gL)
{
    if (!($gL == plugin_basename(__FILE__))) {
        goto gZ;
    }
    exit(wp_redirect(admin_url("\141\x64\155\x69\156\56\x70\150\x70\x3f\160\141\147\x65\75\155\157\x5f\x77\145\142\x33\137\x73\145\x74\164\151\x6e\x67\163")));
    gZ:
}
add_action("\141\x63\164\x69\166\x61\x74\x65\144\137\x70\x6c\x75\x67\151\x6e", "\155\157\x77\x65\x62\63\x5f\141\143\x74\x69\x76\141\164\151\x6f\x6e\x5f\162\145\144\x69\162\x65\143\x74");
register_deactivation_hook(__FILE__, "\155\x6f\137\167\x65\142\x33\137\x64\145\141\x63\x74\151\166\141\164\145");
