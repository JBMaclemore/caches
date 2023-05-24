<?php
/**
 * Cache helper
 *
 * 
 * @package    wp-ulike-pro
 * @author     TechnoWich 2023
 * @link       https://wpulike.com
*/

// no direct access allowed
if ( ! defined('ABSPATH') ) {
    die();
}

/**
 * WP_Ulike_Pro_Cache_Helper.
 */
class WP_Ulike_Pro_Prevent_Caching {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'wp', array( __CLASS__, 'prevent_caching' ) );
	}

	/**
	 * Prevent caching on certain pages
	 */
	public static function prevent_caching() {
		if ( ! is_blog_installed() ) {
			return;
		}
		$page_ids = apply_filters( 'wp_ulike_prevent_caching_pages', wp_ulike_pro_get_core_pages_list() );

		if ( is_page( $page_ids ) ) {
			self::set_nocache_constants();
			nocache_headers();
			// set security headers
			header('X-Frame-Options: DENY');
			header('X-XSS-Protection: 1; mode=block');
			header('X-Content-Type-Options: nosniff');
		}
	}

	/**
	 * Set constants to prevent caching by some plugins.
	 *
	 * @param  mixed $return Value to return. Previously hooked into a filter.
	 * @return mixed
	 */
	public static function set_nocache_constants( $return = true ) {
		wp_ulike_maybe_define_constant( 'DONOTCACHEPAGE', true );
		wp_ulike_maybe_define_constant( 'DONOTCACHEOBJECT', true );
		wp_ulike_maybe_define_constant( 'DONOTCACHEDB', true );
		return $return;
	}

}