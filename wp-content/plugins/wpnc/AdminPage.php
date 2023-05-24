<?php
namespace WPNC\CreateNFT;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once "Vite.php";

/**
 * Handles everything that is needed for the admin.
 */
class AdminPage
{
    public function __construct()
    {
        add_action( 'admin_menu', [$this,'add_settings_page'] );
        add_action( 'admin_menu', [$this,'add_submenu_pages'] );
    }

    // add parent category to site menu
    public function add_settings_page() {
        if ( !empty ( $GLOBALS['admin_page_hooks']['mt_plugins'] ) ) {
            return;
        }

        add_menu_page(
            esc_html__("MT Plugins", "wpnc"), esc_html__("MT Plugins", "wpnc"), "NULL", "mt_plugins", "sc_menu_page", "", 3611
        );
    }


    // add child category to parent to site menu
    public function add_submenu_pages() {
        add_submenu_page(
            "mt_plugins",
            esc_html__("NFT Creator", "wpnc"),
            esc_html__("NFT Creator", "wpnc"),
            "manage_options",
            "wpnc",
            [$this,"wpnc_render_plugin_settings_page"]
        );
    }

    /**
     * Renders the frontend for admins.
     * Differs from the shortcode render_form_create_digital_asset from Shortcodes.php
     *      - Different port for vite
     *      - Different output dir
     * @return void
     */
    public function wpnc_render_plugin_settings_page() {
        $vite = new Vite();
        $vite->outDir("assets/backend");
        $vite->port(3001);

        echo Shortcodes::instance($vite);
    }
}
