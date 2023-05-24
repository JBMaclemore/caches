<?php

/**
 * Fired during plugin activation
 *
 */

class WP_Ulike_Pro_Activator {

	protected static $tables;

	public static function activate() {
		// self::$tables = array(
		// 	'feedbacks' => 'ulike_feedbacks'
		// );

		// self::install_tables();
	}

	public static function install_tables(){
		global $wpdb;

		if( ! function_exists( 'maybe_create_table' ) ){
			// Add one library admin function for next function
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}
	}
}