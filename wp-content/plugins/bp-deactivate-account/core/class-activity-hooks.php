<?php
// exit if file access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle activity display/commenting for inactive users
 */
class BP_Account_Deactivator_Activity_Hooks {

	/**
	 * Singleton instance.
	 *
	 * @var BP_Account_Deactivator_Activity_Hooks
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 */
	private function __construct() {

		add_filter( 'bp_activity_can_comment', array( $this, 'is_active' ) );
		add_filter( 'bp_activity_can_comment_reply', array( $this, 'is_active' ) );
		add_filter( 'bp_activity_user_can_delete', array( $this, 'is_active' ) );

		add_filter( 'bp_activity_can_favorite', array( $this, 'is_active' ) );

		// Check for compose action, redirect to inbox instead with message.
		$this->setup_update_hooks();


		// Hide from activity feed.
		add_filter( 'bp_activity_get_where_conditions', array( $this, 'exclude_activity' ) );

	}

	/**
	 * Get singleton instance.
	 *
	 * @return BP_Account_Deactivator_Activity_Hooks
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Get sql for users.
	 *
	 * @param string $key meta key.
	 * @param string $val meta value.
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
	 * Exclude all user activity.
	 *
	 * @param array $where_clauses where sql clauses.
	 *
	 * @return array
	 */
	public function exclude_activity( $where_clauses = array() ) {

		$sql = $this->get_users_sql( '_is_account_inactive', 1 );

		$where_clauses[] = " a.user_id NOT IN ({$sql}) ";

		return $where_clauses;

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
	 * Buddypress does not have permission system, so let us do it the other way.
	 */
	private function setup_update_hooks() {

		add_action( 'bp_before_activity_post_form', array( $this, 'before_post_form' ) );
		add_action( 'bp_after_activity_post_form', array( $this, 'after_post_form' ) );

	}

	/**
	 * Buffer before post form.
	 */
	public function before_post_form() {

		if ( ! bp_account_deactivator()->is_logged_user_inactive() ) {
			return;
		}

		ob_start();// start output buffering.
	}

	/**
	 * Clean buffer after post form.
	 */
	public function after_post_form() {

		if ( ! bp_account_deactivator()->is_logged_user_inactive() ) {
			return;
		}
		ob_end_clean();// discard buffer.

		echo '';// do not echo anything.
	}


}

// Initialize.
BP_Account_Deactivator_Activity_Hooks::get_instance();
