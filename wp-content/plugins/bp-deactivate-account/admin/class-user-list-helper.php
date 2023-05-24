<?php

/**
 * Class BP_Account_Deactivator_User_Admin_Helper
 */
class BP_Account_Deactivator_User_List_Helper {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// add new view for deactivated.
		add_filter( 'views_users', array( $this, 'add_deactivated_view_links' ), 201 );
		add_filter( 'views_users-network', array( $this, 'add_deactivated_view_links' ), 201 );
		// filter query to list deactivated users.
		add_filter( 'users_list_table_query_args', array( $this, 'filter_user_list_query_args' ) );
		// add new column.
		add_filter( 'manage_users_columns', array( $this, 'add_column_header' ), 101 );
		// show column.
		add_filter( 'manage_users_custom_column', array( $this, 'add_column' ), 10, 3 );

		// add bulk actions
		// handle bulk actions

	}

	/**
	 * Add the deactivated view to users list.
	 *
	 * @param array $views user views.
	 *
	 * @return array
	 */
	public function add_deactivated_view_links( $views ) {

		if ( ! bp_account_deactivator()->current_user_can_change_account_status() ) {
			return $views;
		}

		$total = $this->get_deactivated_accounts_count();

		$label = sprintf( __( '%1$s <span class="count">(%2$s)</span>' ), __( 'Deactivated', 'bp-deactivate-account' ), number_format_i18n( $total ) );

		$url                  = is_network_admin() ? network_admin_url('users.php') : admin_url( 'users.php' );
		$class                = $this->is_deactivated_view() ? ' class="current"' : '';
		$views['deactivated'] = "<a href='" . esc_url( add_query_arg( 'bp_account_deactivated', 1, $url ) ) . "'$class>$label</a>";

		return $views;
	}

	/**
	 * Filter User list with Query.
	 *
	 * @param array $args args.
	 *
	 * @return mixed
	 */
	public function filter_user_list_query_args( $args ) {

		if ( $this->is_deactivated_view() && bp_account_deactivator()->current_user_can_change_account_status() ) {

			$args['meta_key'] = '_is_account_inactive';
			$args['meta_value'] = 1;
		}

		return $args;
	}


	/**
	 * Add our column header.
	 *
	 * @param array $columns column headers.
	 *
	 * @return mixed
	 */
	public function add_column_header( $columns ) {
		$columns['deactivation-status'] = __( 'Status', 'bp-deactivate-account' );
		return $columns;
	}

	/**
	 * Filter column value.
	 *
	 * @param mixed  $val value.
	 * @param string $col_name column name.
	 * @param int    $user_id user id.
	 *
	 * @return mixed
	 */
	public function add_column( $val, $col_name, $user_id ) {
		if ( 'deactivation-status' !== $col_name ) {
			return $val;
		}

		return bp_account_deactivator()->is_active( $user_id ) ? __( 'Active', 'bp-deactivate-account' ) : __( 'Inactive', 'bp-deactivate-account' );
	}
	/**
	 * Is it the deactivated view?
	 *
	 * @return bool
	 */
	private function is_deactivated_view() {

		return isset( $_GET['bp_account_deactivated'] );
	}


	/**
	 * Get total no. of deactivated accounts.
	 *
	 * @return int
	 */
	public function get_deactivated_accounts_count() {

		global $wpdb;

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(user_id) FROM {$wpdb->usermeta} WHERE meta_key = %s AND meta_value = %s", '_is_account_inactive', '1' ) );

		return absint( $count );

	}

}

// Init.
new BP_Account_Deactivator_User_List_Helper();
