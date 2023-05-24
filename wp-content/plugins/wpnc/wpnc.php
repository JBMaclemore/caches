<?php
/**
 * Plugin Name: WordPress NFT Creator
 * Plugin URI: http://modeltheme.com/
 * Description: Expand your shop's capabilities by creating and  publishing NFTs to blockchain (ETH/Polygon).
 * Version: 2.1.3
 * Author: ModelTheme
 * Author URI: http://modeltheme.com/
 * Text Domain: wpnc
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define("WPNC_PLUGIN_FILE_ROOT", __FILE__);

require_once ABSPATH . 'wp-admin/includes/plugin.php';

// Allow uploading JSON Files
add_filter(
    'upload_mimes',
    function( $types ) {
        return array_merge( $types, array(
            'json' => 'application/json',
            'aac' => 'audio/aac',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'oga' => 'audio/ogg',
            'ogv' => 'video/ogg',
            'ogx' => 'application/ogg',
            'wav' => 'audio/wav',
            'mp3' => 'audio/mpeg',
            'glb|gltf' => 'application/octet-stream',
            'gltf|glb' => 'model/gltf-binary',
            'pdf' => 'application/pdf'
            )
        );
    },50
);

/**
 * Support for 'text/plain' as the secondary mime type of .json files,
 * in addition to the default  'application/json' support.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpnc_secondary_mime', 99, 4 );

function wpnc_secondary_mime( $check, $file, $filename, $mimes ) {
    if ( empty( $check['ext'] ) && empty( $check['type'] ) ) {
        // Adjust to your needs!
        $secondary_mime = [ 'json' => 'text/plain' ];

        // Run another check, but only for our secondary mime and not on core mime types.
        remove_filter( 'wp_check_filetype_and_ext', 'wpnc_secondary_mime', 99, 4 );
        $check = wp_check_filetype_and_ext( $file, $filename, $secondary_mime );
        add_filter( 'wp_check_filetype_and_ext', 'wpnc_secondary_mime', 99, 4 );
    }
    return $check;
}

// LOAD PLUGIN TEXTDOMAIN
function wpnc_load_textdomain() {
    load_plugin_textdomain( 'wpnc', false, plugin_basename(__DIR__) . '/languages' );
}

add_filter('upload_dir', 'set_destination_folder', 999);

function set_destination_folder ( $uploads  ) {
    if(isset($_POST["folderLocation"])) {
        $mydir = $_POST["folderLocation"];
        $subdir = $uploads['subdir'];

        $uploads['subdir'] = '';
        $uploads['path']   = str_replace( $subdir, '', $uploads['path'] )."/wpnc/".$mydir;
        $uploads['url']    = str_replace( $subdir, '', $uploads['url'] )."/wpnc/".$mydir;
        return $uploads;
    }
    return $uploads;
}

add_action( 'plugins_loaded', 'wpnc_load_textdomain' );

require "Init.php";
$init = new \WPNC\CreateNFT\Init();

// \WPNC\CreateNFT\Init::get_content_folder();
register_activation_hook(WPNC_PLUGIN_FILE_ROOT, [$init, "insert_new_page"]);
register_activation_hook(WPNC_PLUGIN_FILE_ROOT, [$init, "get_content_folder"]);

add_filter('upgrader_post_install', [$init,'get_content_folder'], 10, 3);


if ( is_admin() ) {
    require "AdminPage.php";
    new \WPNC\CreateNFT\AdminPage();
}