<?php
/**
 * All wp-ulike-pro functionalities starting from here...
 *
 * 
 * @package    wp-ulike-pro
 * @author     TechnoWich 2023
 * @link       https://wpulike.com
 *
 * Plugin Name:       WP ULike Pro
 * Plugin URI:        https://wpulike.com/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Description:       WP ULike Pro plugin is our ultimate solution to cast voting to any type of content you may have in your website. With outstanding and eye-catching widgets, you can have Like and Dislike Button on all of your contents would it be a Post, Comment, Activities, Forum Topics, WooCommerce products, you name it. Now you can really feel your users Love for each part of your work.
 * Version:           1.8.1
 * Author:            TechnoWich
 * Author URI:        https://technowich.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 * Text Domain:       wp-ulike-pro
 * Domain Path:       /languages/
 * Tested up to: 	  6.1.1
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define path and text domain
define( 'WP_ULIKE_PRO_VERSION'      , '1.8.1'   );
define( 'WP_ULIKE_PRO_DB_VERSION'   , '1.0.0' 	);
define( 'WP_ULIKE_PRO__FILE__'      , __FILE__  );

define( 'WP_ULIKE_PRO_DOMAIN'       , 'wp-ulike-pro' );

define( 'WP_ULIKE_PRO_BASENAME'     , plugin_basename( WP_ULIKE_PRO__FILE__ ) );
define( 'WP_ULIKE_PRO_DIR'          , plugin_dir_path( WP_ULIKE_PRO__FILE__ ) );
define( 'WP_ULIKE_PRO_URL'          , plugin_dir_url(  WP_ULIKE_PRO__FILE__ ) );

define( 'WP_ULIKE_PRO_NAME'         , esc_html__( 'WP ULike Pro', WP_ULIKE_PRO_DOMAIN ) );

define( 'WP_ULIKE_PRO_ADMIN_DIR'    , WP_ULIKE_PRO_DIR . '/admin' 		);
define( 'WP_ULIKE_PRO_ADMIN_URL'    , WP_ULIKE_PRO_URL . 'admin' 		);

define( 'WP_ULIKE_PRO_INC_DIR'      , WP_ULIKE_PRO_DIR . '/includes' 	);
define( 'WP_ULIKE_PRO_INC_URL'      , WP_ULIKE_PRO_URL . 'includes' 	);

define( 'WP_ULIKE_PRO_PUBLIC_DIR'   , WP_ULIKE_PRO_DIR . '/public' 		);
define( 'WP_ULIKE_PRO_PUBLIC_URL'   , WP_ULIKE_PRO_URL . 'public' 		);


require WP_ULIKE_PRO_DIR . 'public/class-register-hook.php';
// Register hooks that are fired when the plugin is activated or deactivated.
register_activation_hook  ( __FILE__, array( 'WP_Ulike_Pro_Register_Hook', 'activate'   ) );
register_deactivation_hook( __FILE__, array( 'WP_Ulike_Pro_Register_Hook', 'deactivate' ) );

/**
 * Load gettext translate for our text domain.
 *
 * @return void
 */
function wp_ulike_pro_load_plugin() {

	if ( ! did_action( 'wp_ulike_loaded' ) ) {
		add_action( 'admin_notices', 'wp_ulike_pro_fail_load' );

		return;
	}

	$version_required = '4.6.6';
	if ( ! version_compare( WP_ULIKE_VERSION, $version_required, '>=' ) ) {
		add_action( 'admin_notices', 'wp_ulike_pro_fail_load_out_of_date' );

		return;
	}

	$version_recommendation = '4.6.6';
	if ( ! version_compare( WP_ULIKE_VERSION, $version_recommendation, '>=' ) ) {
		add_action( 'admin_notices', 'wp_ulike_pro_admin_notice_upgrade_recommendation' );
	}


    require WP_ULIKE_PRO_DIR . 'public/class-init.php';
}

add_action( 'plugins_loaded', 'wp_ulike_pro_load_plugin' );

/**
 * Show in WP Dashboard notice about the plugin is not activated.
 *
 * @return void
 */
function wp_ulike_pro_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	$plugin = 'wp-ulike/wp-ulike.php';

	if ( _is_wp_ulike_installed() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

		$message = '<p>' . esc_html__( 'WP ULike Pro is not working because you need to activate the WP ULike free plugin.', WP_ULIKE_PRO_DOMAIN ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate WP ULike Now', WP_ULIKE_PRO_DOMAIN ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=wp-ulike' ), 'install-plugin_wp-ulike' );

		$message = '<p>' . esc_html__( 'WP ULike Pro is not working because you need to install the WP ULike plugin.', WP_ULIKE_PRO_DOMAIN ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install WP ULike Now', WP_ULIKE_PRO_DOMAIN ) ) . '</p>';
	}

	echo '<div class="error"><p>' . $message . '</p></div>';
}

function wp_ulike_pro_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'wp-ulike/wp-ulike.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . esc_html__( 'WP ULike Pro is not working because you are using an old version of WP ULike.', WP_ULIKE_PRO_DOMAIN ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__( 'Update WP ULike Now', WP_ULIKE_PRO_DOMAIN ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

function wp_ulike_pro_admin_notice_upgrade_recommendation() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'wp-ulike/wp-ulike.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . esc_html__( 'A new version of WP ULike is available. For better performance and compatibility of WP ULike Pro, we recommend updating to the latest version.', WP_ULIKE_PRO_DOMAIN ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__( 'Update WP ULike Now', WP_ULIKE_PRO_DOMAIN ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

if ( ! function_exists( '_is_wp_ulike_installed' ) ) {

	function _is_wp_ulike_installed() {
		$file_path = 'wp-ulike/wp-ulike.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}