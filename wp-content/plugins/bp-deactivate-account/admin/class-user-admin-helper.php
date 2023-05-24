<?php

/**
 * Class BP_Account_Deactivator_User_Admin_Helper
 */
class BP_Account_Deactivator_User_Admin_Helper {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Setup navigation menu under settings tab of profile.
		add_action( 'bp_members_admin_load', array( $this, 'update_status' ), 100 );
		add_action( 'bp_members_admin_user_metaboxes', array( $this, 'add_metabox' ), 10, 2 );
	}

	/**
	 * Update User Status
	 */
	public function update_status() {

		if ( ! isset( $_POST['_bp-account-deactivator-nonce'] ) || ! wp_verify_nonce( $_POST['_bp-account-deactivator-nonce'], 'bp-account-deactivator' ) ) {
			return;
		}

		$user_id        = $this->get_user_id();
		$logged_user_id = get_current_user_id();

		if ( ( $logged_user_id != $user_id ) && ! bp_account_deactivator()->current_user_can_change_account_status() ) {
			// it is not my edit profile & logged user is not super admin
			return; // should we wp die? nah, I am too young! My story can't end here.
		}

		// and here we are.
		if ( ! empty( $_POST['_bp_account_deactivator_status'] ) ) {
			bp_account_deactivator()->set_active( $user_id );
		} else {
			bp_account_deactivator()->set_inactive( $user_id );
		}
		// that's all we need to do.
	}


	/**
	 * Add metabox in the Edit User sidebar.
	 */
	public function add_metabox() {
		add_meta_box(
			'bp_account_deactivator_status',
			_x( 'Account Deactivation', 'members user-admin edit screen', 'bp-deactivate-account' ),
			array( $this, 'show_metabox' ),
			get_current_screen()->id,
			'side',
			'core'
		);
	}

	/**
	 * Show the edit user metabox.
	 *
	 * @param WP_User $user user object.
	 */
	public function show_metabox( $user = null ) {

		// Bail if no user ID.
		if ( empty( $user ) || empty( $user->ID ) ) {
			return;
		}

		$user_id = $user->ID;

		$is_inactive = bp_account_deactivator()->is_inactive( $user_id ) ? 1 : 0;

		if ( $is_inactive ) {
			$status = __( 'Deactivated', 'bp-deactivate-account' );

		} else {
			$status = __( 'Active', 'bp-deactivate-account' );
		}
		?>
		<div class="bp-account-deactivator-settings-block">

			<p> <?php _e( 'Current account status: ', 'bp-deactivate-account' ); ?>
				<strong><?php echo $status; ?></strong></p>

			<div class="radio">
				<label>
					<input type="radio" value="1" name="_bp_account_deactivator_status" <?php echo checked( 0, $is_inactive ); ?> /><?php _e( 'Active', 'bp-deactivate-account' ); ?>
				</label>
				<label>
					<input type="radio" value="0" name="_bp_account_deactivator_status" <?php echo checked( 1, $is_inactive ); ?> /><?php _e( 'Deactivate', 'bp-deactivate-account' ); ?>
				</label>
			</div>

			<p class="bp-account-deactivator-help-block">
				<?php _e( 'If you select deactivate, You will be hidden from the users.', 'bp-deactivate-account' ); ?>
			</p>

		</div>

		<?php wp_nonce_field( 'bp-account-deactivator', '_bp-account-deactivator-nonce' ); ?>

		<p class="submit">
			<input type="submit" id="bp_account_deactivator_update_settings" name="bp_account_deactivator_update_settings" class="button" value="<?php _e( 'Update', 'bp-deactivate-account' ); ?>"/>
		</p>
		<?php
	}


	/**
	 * Get the currently editing user id.
	 *
	 * @return int
	 */
	private function get_user_id() {

		$user_id = get_current_user_id();

		// We'll need a user ID when not on the user admin.
		if ( ! empty( $_GET['user_id'] ) ) {
			$user_id = $_GET['user_id'];
		}

		$user_id = absint( $user_id );

		return $user_id;
	}

}

// Init.
new BP_Account_Deactivator_User_Admin_Helper();
