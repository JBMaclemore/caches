<?php
/**
 * Plugin Name: (BuddyDev) BP Deactivate Account
 * Plugin URI: https://buddydev.com/plugins/bp-deactivate-account/
 * Version: 1.2.2
 * Author: BuddyDev
 * Author URI: https://buddydev.com
 *
 * Description: Allow users to deactivate/reactivate their account on BuddyPress
 **/

// exit if file access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class BP_Account_Deactivator
 */
class BP_Account_Deactivator {
	/**
	 * Singleton instance of the class.
	 *
	 * @var BP_Account_Deactivator
	 */
	private static $instance = null;

	/**
	 * Plugin basename.
	 *
	 * @var string
	 */
	private $basename;

	/**
	 * BP_Account_Deactivator constructor.
	 */
	private function __construct() {
		$this->setup();
	}

	/**
	 * Get teh singleton instance
	 *
	 * @return BP_Account_Deactivator
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Setup various hooks
	 */
	public function setup() {
		$this->basename = plugin_basename( __FILE__ );

		register_activation_hook( __FILE__, array( $this, 'on_plugin_activation' ) );
		add_action( 'bp_loaded', array( $this, 'load' ) );
		add_action( 'plugins_loaded', array( $this, 'load_admin' ), 9996 ); // pt-settings 1.0.4.
		add_action( 'bp_init', array( $this, 'load_textdomain' ), 2 );
	}

	/**
	 * Load required files.
	 */
	public function load() {

		$path = plugin_dir_path( __FILE__ );

		$files = array(
			// 'core/functions.php',
			'core/class-members-hooks.php',
			'core/class-actions-helper.php',
			'core/class-messages-hooks.php',
			'core/class-activity-hooks.php',
			'core/class-settings-helper.php',
		);

		foreach ( $files as $file ) {
			require_once $path . $file;
		}
	}

	/**
	 * Load admin.
	 */
	public function load_admin() {
		if ( ! function_exists( 'buddypress' ) ) {
			return;
		}

		$path  = plugin_dir_path( __FILE__ );
		$files = array();

		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			$files = array(
				'admin/pt-settings/pt-settings-loader.php',
				'admin/class-admin-helper.php',
				'admin/class-user-admin-helper.php',
				'admin/class-user-list-helper.php',
			);
		}

		foreach ( $files as $file ) {
			require_once $path . $file;
		}
	}
	/**
	 * Load translation
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'bp-deactivate-account', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}


	/**
	 * Store default settings.
	 */
	public function on_plugin_activation() {

		if ( ! get_option( 'bp-deactivate-account-settings' ) ) {
			$settings = $this->get_default_options();
			update_option( 'bp-deactivate-account-settings', $settings );

			if ( is_multisite() ) {
				update_site_option( 'bp-deactivate-account-settings', $settings );
			}
		}
	}
	/**
	 * Check if the given user is active?
	 *
	 * @param int $user_id numeric user id.
	 *
	 * @return bool
	 */
	public function is_active( $user_id ) {
		return ! $this->is_inactive( $user_id );
	}

	/**
	 * Check if the given user is inactiv?
	 *
	 * @param int $user_id the user whose status is being checked.
	 *
	 * @return bool
	 */
	public function is_inactive( $user_id ) {
		return (boolean) get_user_meta( $user_id, '_is_account_inactive', true );
	}

	/**
	 * Set account inactive
	 *
	 * @param int $user_id the user whose status is being checked.
	 */
	public function set_inactive( $user_id ) {

		delete_site_transient( 'bp-deactivated-users-count' );

		if ( update_user_meta( $user_id, '_is_account_inactive', 1 ) ) {
			do_action( 'bp-account-deactivated', $user_id );
		};
	}

	/**
	 * Set account active
	 *
	 * @param int $user_id the user whose status is being checked.
	 */
	public function set_active( $user_id ) {
		delete_site_transient( 'bp-deactivated-users-count' );

		if ( delete_user_meta( $user_id, '_is_account_inactive' ) ) {
			do_action( 'bp-account-activated', $user_id );
		};
	}

	/**
	 * Destroy all session for the given user.
	 *
	 * @param int $user_id user id.
	 *
	 * @return bool
	 */
	public function destroy_sessions( $user_id ) {
		$user = get_userdata( $user_id );
		if ( ! $user ) {
			return false;
		}

		$sessions = WP_Session_Tokens::get_instance( $user->ID );
		$sessions->destroy_all();

		return true;
	}

	/**
	 * Not implemented!
	 *
	 * @todo in future
	 */
	public function get_all_inactive_users() {}

	/**
	 * Check if logged in user is inactive.
	 *
	 * @return bool
	 */
	public function is_logged_user_inactive() {

		static $is_inactive;

		if ( isset( $is_inactive ) ) {
			return $is_inactive;
		}

		if ( ! is_user_logged_in() ) {
			$is_inactive = false;

			return $is_inactive;
		}

		$is_inactive = $this->is_inactive( get_current_user_id() );

		return $is_inactive;
	}

	/**
	 * Check if displayed user is inactive
	 *
	 * @return bool
	 */
	public function is_displayed_user_inactive() {

		static $is_inactive;

		if ( isset( $is_inactive ) ) {
			return $is_inactive;
		}

		if ( ! bp_is_user() ) {
			$is_inactive = false;

			return $is_inactive;
		}

		$is_inactive = $this->is_inactive( bp_displayed_user_id() );

		return $is_inactive;
	}

	/**
	 * Check if the plugin is network active.
	 *
	 * @return bool
	 */
	public function is_network_active() {

		if ( ! is_multisite() ) {
			return false;
		}

		// Check the sitewide plugins array.
		$base    = $this->basename;
		$plugins = get_site_option( 'active_sitewide_plugins' );

		if ( ! is_array( $plugins ) || ! isset( $plugins[ $base ] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Can current user change account status?
	 *
	 * @return bool
	 */
	public function current_user_can_change_account_status() {

		return apply_filters( 'bp_account_deactivator_user_can_change_account_status', is_super_admin() );
	}

	/**
	 * Get the current setting value for the given option.
	 *
	 * @param string $option_name option name.
	 *
	 * @return mixed|null
	 */
	public function get_option( $option_name ) {
		if ( is_multisite() && $this->is_network_active() ) {
			$options = get_site_option( 'bp-deactivate-account-settings', $this->get_default_options() );
		} else {
			$options = get_option( 'bp-deactivate-account-settings', $this->get_default_options() );
		}

		if ( isset( $options[ $option_name ] ) ) {
			return $options[ $option_name ];
		}

		return null;
	}

	/**
	 * Get all default options.
	 *
	 * @return array
	 */
	public function get_default_options() {
		$options = array(
			'allow_user_update'               => 1,
			'reactivate-on-login'             => 0,
			'logout-on-deactivation'          => 0,
			'redirect-url-on-deactivation'    => '',
			'block_login'                     => 0,
			'block_message'                   => __( 'Your account is inactive. Please contact site administrator to activate it.' ),
			'user-activation-email-subject'   => _x( 'Your account has been activated', 'email subject for activation', 'bp-deactivate-account' ),
			'user-deactivation-email-subject' => _x( 'Your account has been deactivated', 'admin settings', 'bp-deactivate-account' ),
			'user-activation-email-body'      => '',
			'user-deactivation-email-body'    => '',

			'notify-admin-email-addresses' => '',
			'notify-admin-on-activation'   => 1,
			'notify-admin-on-deactivation' => 1,

			'admin-activation-email-subject'   => _x( 'An account has been activated', 'email subject for activation', 'bp-deactivate-account' ),
			'admin-activation-email-body'      => '',
			'admin-deactivation-email-subject' => _x( 'An account has been deactivated', 'email subject for deactivation', 'bp-deactivate-account' ),
			'admin-deactivation-email-body'    => '',
			'notify-user-on-activation'        => 1,
			'notify-user-on-deactivation'      => 1,


		);

		$admin_email = ( $this->is_network_active() ) ? get_site_option( 'admin_email' ) : get_option( 'admin_email' );

		$options['notify-admin-email-addresses'] = $admin_email;

		$options['admin-activation-email-body'] = <<<'EOT'
Hello [admin_name],

[user_name] has activated his account.

EOT;

		$options['admin-deactivation-email-body'] = <<<'EOT'
Hello [admin_name],

[user_name] has deactivated his account.

EOT;

		$options['user-activation-email-body'] = <<<'EOT'
Hello [user_name],

Your account has been activated.

EOT;

		$options['user-deactivation-email-body'] = <<<'EOT'
Hello [user_name],

Your account has been deactivated.

EOT;

		return $options;
	}

}

/**
 * Simple access method for the singleton instance of AB_Account_deactivator
 *
 * @return BP_Account_Deactivator
 */
function bp_account_deactivator() {
	return BP_Account_Deactivator::get_instance();
}

// No need to initialize it but let us do it anyway.
bp_account_deactivator();
