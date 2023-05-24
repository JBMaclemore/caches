<?php
// exit if file access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Strategy.
 * 1. stop posting activity update
 * 2. stop posting comment
 * 3. stop posting post comment
 * 4. hide all button
 */

/**
 * Class BP_Account_Deactivator_Members_Hooks
 */
class BP_Account_Deactivator_Members_Hooks {

	/**
	 * Singleton.
	 *
	 * @var BP_Account_Deactivator_Members_Hooks
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 */
	private function __construct() {

		// hide buttons.
		add_filter( 'bp_get_button', array( $this, 'hide_buttons_for_inactive' ), 10, 3 );

		// hide from members list everywhere.
		add_action( 'pre_user_query', array( $this, 'exclude_in_members_listing' ), 200 );

		// filter total member count.
		add_filter( 'bp_core_get_active_member_count', array( $this, 'fix_active_members_count' ) );

		// should we intercept email too?
		// I will keep adding features as suggested by the users.
		add_action( 'bp_ready', array( $this, 'hide_inactive_profile' ) );
		add_action( 'bp_init', array( $this, 'notice' ) );
	}

	/**
	 * Get singleton instance.
	 *
	 * @return BP_Account_Deactivator_Members_Hooks
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Exclude users.
	 *
	 * @param WP_User_Query $query user query.
	 */
	public function exclude_in_members_listing( $query ) {
		// do not hide users inside the admin.
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}

		$qv = $query->query_vars;

		// since multiple NOT IN on ID is allowed though it is bad astheticaly
		// so we don't have to worry much here.
		global $wpdb;

		$sql = $this->get_users_sql( '_is_account_inactive', 1 );

		if ( ! empty( $sql ) ) {
			//$list = join(',', $users );
			$query->query_where .= " AND {$wpdb->users}.ID NOT IN ({$sql}) ";

		}
	}

	/**
	 * Get sql for excluding users?
	 *
	 * @param string $key meta key.
	 * @param string $val value.
	 *
	 * @return string
	 */
	private function get_users_sql( $key, $val ) {
		global $wpdb;
		// I am using a real bad table alias here to avoid any future conflict.
		$users = $wpdb->prepare( "SELECT bpad.user_id FROM {$wpdb->usermeta} as bpad WHERE bpad.meta_key=%s AND bpad.meta_value=%d", $key, $val );

		return $users;

	}

	/**
	 * Get total no. of deactivated accounts
	 *
	 * @return int
	 */
	public function get_deactivated_users_count() {
		global $wpdb;

		$count = get_transient( 'bp-deactivated-users-count' );

		if ( $count === false ) {
			$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( user_id ) FROM {$wpdb->usermeta} WHERE meta_key=%s AND meta_value=%d", '_is_account_inactive', 1 ) );
			set_site_transient( 'bp-deactivated-users-count', $count, 24 * HOUR_IN_SECONDS );
		}

		return absint( $count );
	}

	/**
	 * Filter total active members count and subtract the deactivated users count
	 *
	 * @param int $count count.
	 *
	 * @return int
	 */
	public function fix_active_members_count( $count ) {
		return absint( $count - $this->get_deactivated_users_count() );
	}

	/**
	 * Hide Buttons for inactive users
	 *
	 * @param string $button button.
	 *
	 * @return string
	 */
	public function hide_buttons_for_inactive( $button, $args, $btn_object ) {

		if ( is_array( $args ) && isset( $args['id'] ) && in_array( $args['id'], array(
				'bpad-activate',
				'bpad-deactivate',
			) ) ) {
			return $button;
		}

		// if the logged in user is inactive, hide button.
		if ( bp_account_deactivator()->is_inactive( get_current_user_id() ) ) {
			return '';
		}

		// if we are in the member loop and current member is inactive, hide.
		if ( bp_get_member_user_id() && bp_account_deactivator()->is_inactive( bp_get_member_user_id() ) ) {
			return '';
		}

		// finaly check if it is a user.
		if ( bp_is_user() && bp_account_deactivator()->is_inactive( bp_displayed_user_id() ) && ! bp_account_deactivator()->current_user_can_change_account_status() ) {
			return '';
		}

		return $button;

	}

	/**
	 * Filter on various hooks to allow if account is active.
	 *
	 * @param bool $can allow.
	 *
	 * @return bool
	 */
	public function is_active( $can ) {

		if ( bp_account_deactivator()->is_logged_user_inactive() ) {
			return false;
		}

		return $can;
	}

	/**
	 * Hide inactive profile.
	 */
	public function hide_inactive_profile() {

		if ( bp_is_my_profile() || bp_account_deactivator()->current_user_can_change_account_status() ) {
			return;
		}

		if ( bp_is_user() && bp_account_deactivator()->is_displayed_user_inactive() ) {

			$redirect = site_url( '/' );// home.

			if ( is_user_logged_in() ) {
				$redirect = bp_loggedin_user_domain();
			}

			bp_core_add_message( __( 'Sorry, that profile is not accessible.', 'bp-deactivate-account' ), 'error' );

			bp_core_redirect( $redirect );
		}
	}

	/**
	 * Show notice.
	 */
	public function notice() {

		if ( ! apply_filters( 'bp_account_deactivator_notify_user_via_notice', true ) ) {
			return;
		}

		if ( bp_account_deactivator()->is_logged_user_inactive() ) {
			bp_core_add_message( __( 'Your account is inactive. Please activate it to use all site functionality.', 'bp-deactivate-account' ), 'error' );
		} elseif ( bp_account_deactivator()->current_user_can_change_account_status() && bp_account_deactivator()->is_displayed_user_inactive() ) {
			bp_core_add_message( __( 'This account is inactive.', 'bp-deactivate-account' ), 'error' );
		}
	}


}
/**
//stop sending/replying to messages
//should we add some whitelisted actions?
*/

// can not stop $_POST as it will have other reprecussions.
// init.
BP_Account_Deactivator_Members_Hooks::get_instance();
