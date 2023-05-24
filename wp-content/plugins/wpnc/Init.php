<?php

namespace WPNC\CreateNFT;
use WPNC\CreateNFT\API\API;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require "Shortcodes.php";
require "API/API.php";

/**
 * Plugin initialisation class.
 * (Shortcodes/Run First Register Hooks/Init API etc.)
 */
class Init
{
    public function __construct()
    {
        // Init shortcodes
        new Shortcodes();
        // Add new page for creating digital assets

        // Init Api
        new API();
    }

    /**
     * Adds new page and hooks up the frontend of the plugin.
     * @return void
     */
    public function insert_new_page()
    {
        $check_page_exist = get_page_by_title('Create Digital Asset', 'OBJECT');
        // Check if the page already exists
        if(empty($check_page_exist)) {
            wp_insert_post(
                array(
                    'comment_status' => 'close',
                    'ping_status'    => 'close',
                    'post_author'    => 1,
                    'post_title'     => ucwords('Create Digital Asset'),
                    'post_name'      => sanitize_title('Create Digital Asset'),
                    'post_status'    => 'publish',
                    'post_content'   => '<!-- wp:shortcode -->
                                        [wpnc_form]
                                        <!-- /wp:shortcode -->',
                    'post_type'      => 'page',
                    'post_parent'    => 'wpnc_form'
                )
            );
        }
    }

    public function get_content_folder() {
        $paths = [
            "assets/frontend/assets",
            "assets/backend/assets",
        ];

        foreach ($paths as $path) {
            $cssFiles = glob(plugin_dir_path(WPNC_PLUGIN_FILE_ROOT).$path.'/*.css');
            foreach ($cssFiles as $file) {
                $file_contents = file_get_contents($file);
                $file_contents = str_replace(['replace-me-front-end/assets/', 'replace-me-back-end/assets/', 'replace-me-front-end/', 'replace-me-back-end/'], preg_replace('#^https?:#i', '', plugin_dir_url(__FILE__)).$path."/", $file_contents);

                file_put_contents($file, $file_contents);
            }
        }
    }
}