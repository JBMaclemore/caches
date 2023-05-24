<?php


namespace MoWeb3\Base;

class MoWeb3InstanceHelper
{
    private $current_version = "\106\122\x45\105";
    private $utils;
    public function __construct()
    {
        $this->utils = new \MoWeb3\MoWeb3Utils();
        $this->current_version = $this->utils->get_versi_str();
    }
    public function get_accounts_instance()
    {
        return new \MoWeb3\MoWeb3Accounts();
    }
    public function get_all_method_instances()
    {
        $uJ = get_declared_classes();
        $oU = array_filter($uJ, function ($xn) {
            return stripos($xn, "\115\157\127\145\x62\63\134\x4d\x65\164\x68\x6f\x64\x73") !== false;
        });
        unset($oU[array_search("\x4d\x6f\x57\x65\x62\x33\x5c\x4d\145\x74\150\x6f\x64\163", $oU, true)]);
        return $oU;
    }
    public function get_settings_instance()
    {
        if (class_exists("\x4d\157\x57\x65\x62\63\134\x4d\x6f\x57\145\142\63\106\x65\x65\144\x62\141\x63\x6b\x53\x65\x74\164\x69\156\x67\163")) {
            goto JA;
        }
        wp_die("\120\x6c\x65\x61\163\145\40\103\x68\141\x6e\x67\x65\x20\x54\150\145\x20\x76\145\x72\x73\x69\157\156\x20\x62\141\x63\153\40\x74\x6f\x20\x77\150\x61\x74\40\x69\164\40\162\x65\x61\x6c\x6c\x79\x20\167\141\x73");
        exit;
        goto pE;
        JA:
        return new \MoWeb3\MoWeb3FeedbackSettings();
        pE:
    }
    public function get_config_instance()
    {
        if (!class_exists("\115\157\x57\145\142\63\134\115\x6f\x57\145\142\63\x4d\145\164\150\x6f\x64\126\151\145\167\x48\x61\156\x64\x6c\x65\x72")) {
            goto YY;
        }
        return new \MoWeb3\MoWeb3MethodViewHandler();
        YY:
    }
    public function get_utils_instance()
    {
        return $this->utils;
    }
}
