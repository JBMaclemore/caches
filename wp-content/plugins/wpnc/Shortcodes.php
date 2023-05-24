<?php

namespace WPNC\CreateNFT;

if (!defined('ABSPATH')) {
    exit;
}

require "Vite.php";

/**
 * Initialise shortcodes.
 */
class Shortcodes
{
    public function __construct()
    {
        add_shortcode("wpnc_form", [$this, "render_form_create_digital_asset"]);
    }

    /**
     * Provides a base for mounting the vue app.
     * @param $vite Vite configuration for the instance defaults to Frontend
     * @return string
     */
    public static function instance($vite = null)
    {

        if (is_null($vite)) {
            $vite = new Vite();
            $vite->outDir("assets/frontend");
            $vite->port(3002);
        }

        $appid = esc_attr(mt_rand());
        $nonce = is_user_logged_in() ? wp_create_nonce('wp_rest') : 'null';
        return '
            <div id="wpnc-' . $appid . '"
                data-site-url="' . esc_attr(get_site_url() . "/") . '"
                data-api-url="' . esc_attr(get_rest_url()) . '"
                data-plugin-path="' . esc_attr(plugin_dir_url(__FILE__)) . '"
                data-nonce="' . $nonce . '"
                data-is-nft-core-installed="' . esc_attr(defined('NFT_MARKETPLACE_CORE_VERSION') ? "true" : "false") . '"
                data-current-user="' . esc_attr(is_user_logged_in() ? wp_get_current_user()->display_name : get_site_url()) . '"
                data-is-metamask-authenticator-installed="' . esc_attr(is_plugin_active("mt-metamask-auth/mt-metamask-auth.php") ? "true" : "false") . '"
                data-is-walletconnect-authenticator-installed="' . esc_attr(is_plugin_active("mt-walletconnect-auth/mt-walletconnect-auth.php") ? "true" : "false") . '"
                data-marketplace-contracts="' . esc_attr(json_encode(apply_filters("wpnc_marketplace_contracts", []))) . '"
                data-marketplace-currencies="' . esc_attr(json_encode(apply_filters("wpnc_marketplace_currencies", []))) . '"
            >
                <noscript>' . esc_html__('You need javascript enabled to see this content', 'wpnc') . '.</noscript>
                ' . esc_html__('Form is loading...', 'wpnc') . '
            </div>
            ' . $vite;
    }

    /**
     * Render the form for creating a digital asset.
     * @return string
     */
    public function render_form_create_digital_asset()
    {
        if (is_plugin_active("mt-metamask-auth/mt-metamask-auth.php") && is_plugin_active("mt-walletconnect-auth/mt-walletconnect-auth.php")) {
            if (is_user_logged_in()) {
                if (get_option("wpnc")["metamaskOnly"] == true) {
                    if (mtm_metamask_current_user_has_metamask()) {
                        return self::instance();
                    }
                }
                if (get_option("wpnc")["walletConnectOnly"] == true) {
                    if (mtwc_walletconnect_current_user_has_walletconnect()) {
                        return self::instance();
                    }
                }
                if (get_option("wpnc")["metamaskOnly"] == false && get_option("wpnc")["walletConnectOnly"] == false) {
                    return self::instance();
                }
            }
            if (!is_user_logged_in()) {
                return do_shortcode("[mtm_auth type='login']") . do_shortcode("[mtwc_auth type='login']");
            }

            if (get_option("wpnc")["metamaskOnly"] == true && get_option("wpnc")["walletConnectOnly"] == true) {
                return do_shortcode("[mtm_auth type='link']") . do_shortcode("[mtwc_auth type='link']");
            } else if (get_option("wpnc")["metamaskOnly"] == true && get_option("wpnc")["walletConnectOnly"] == false) {
                return do_shortcode("[mtm_auth type='link']");
            } else if (get_option("wpnc")["metamaskOnly"] == false && get_option("wpnc")["walletConnectOnly"] == true) {
                return do_shortcode("[mtwc_auth type='link']");
            }
        }

        if (is_plugin_active("mt-metamask-auth/mt-metamask-auth.php") && !is_plugin_active("mt-walletconnect-auth/mt-walletconnect-auth.php")) {
            if (is_user_logged_in()) {
                if (get_option("wpnc")["metamaskOnly"] == true) {
                    if (mtm_metamask_current_user_has_metamask()) {
                        return self::instance();
                    }
                } else if (get_option("wpnc")["metamaskOnly"] == false) {
                    return self::instance();
                }
            }
            if (!is_user_logged_in()) {
                return do_shortcode("[mtm_auth type='login']");
            }

            return do_shortcode("[mtm_auth type='link']");
        }

        if (!is_plugin_active("mt-metamask-auth/mt-metamask-auth.php") && is_plugin_active("mt-walletconnect-auth/mt-walletconnect-auth.php")) {
            if (is_user_logged_in()) {
                if (get_option("wpnc")["walletConnectOnly"] == true) {
                    if (mtwc_walletconnect_current_user_has_walletconnect()) {
                        return self::instance();
                    }
                } else if (get_option("wpnc")["walletConnectOnly"] == false) {
                    return self::instance();
                }
            }
            if (!is_user_logged_in()) {
                return do_shortcode("[mtwc_auth type='login']");
            }

            return do_shortcode("[mtwc_auth type='link']");
        }

        return self::instance();
    }
}
