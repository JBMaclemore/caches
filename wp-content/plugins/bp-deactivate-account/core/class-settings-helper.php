<?php
// exit if file access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class BP_Account_Deactivator_Settings_Helper
 */
class BP_Account_Deactivator_Settings_Helper {

	/**
	 * Singleton.
	 *
	 * @var BP_Account_Deactivator_Settings_Helper
	 */
	private static $instance;

	/**
	 * Constructor.
	 */
	private function __construct() {

		// setup navigation menu under settings tab of profile.
		add_action( 'bp_setup_nav', array( $this, 'setup_nav' ), 11 );

		// add filter for saving option.
		add_action( 'bp_init', array( $this, 'save_settings' ), 5 );

		// add Account deactivator to the user settings menu in wp adminbar.
		// setup admin bar.
		add_action( 'bp_setup_admin_bar', array( $this, 'setup_admin_bar' ), 102 );
	}

	/**
	 * Get singleton instance.
	 *
	 * @return BP_Account_Deactivator_Settings_Helper
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Setup nav.
	 */
	public function setup_nav() {

		if ( ! bp_is_active( 'settings' ) ) {
			return;
		}

		if ( bp_is_user() ) {
			$url = bp_displayed_user_domain();
		} else {
			$url = bp_loggedin_user_domain();
		}

		$settings_link = trailingslashit( $url . bp_get_settings_slug() );

		bp_core_new_subnav_item( array(
			'name'            => __( 'Account Status', 'bp-deactivate-account' ),
			'slug'            => 'account-deactivator',
			'parent_url'      => $settings_link,
			'parent_slug'     => bp_get_settings_slug(),
			'screen_function' => array( $this, 'handle_user_settings' ),
			'position'        => 52,
			'user_has_access' => $this->user_can_update_status(),
		) );

	}

	/**
	 * Update settings.
	 */
	public function save_settings() {

		// if the form was not submitted, no need to proceed further.
		if ( empty( $_POST['bp_account_deactivator_update_settings'] ) ) {

			return;
		}

		// only user and super admins can update it, make sure it is happening on profile settings page.
		if ( ! bp_is_settings_component() || ! $this->user_can_update_status() ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'bp-account-deactivator' ) ) {

			bp_core_add_message( __( 'Nothing updated. Please try again', 'bp-deactivate-account' ) );

			return;
		}

		//$pre_update = bp_account_deactivator()->is_inactive( $user_id );

		// using displayed user instead of logged in,
		// we may allow admins to deactivate/activate account in future.
		$user_id = bp_displayed_user_id();

		if ( ! empty( $_POST['_bp_account_deactivator_status'] ) ) {
			bp_account_deactivator()->set_active( $user_id );
		} else {
			bp_account_deactivator()->set_inactive( $user_id );
		}

		// clear transient
		// update
		// get status.
		if ( bp_account_deactivator()->is_inactive( $user_id ) ) {
			// delete last activity time.
			bp_delete_user_meta( $user_id, 'last_activity' );

		} else {
			// make visible immediately.
			bp_core_record_activity();
		}


		bp_core_add_message( __( 'Settings Updated!', 'bp-deactivate-account' ) );
	}

	/**
	 * Show settings screen.
	 */
	public function handle_user_settings() {

		// hook the content.
		add_action( 'bp_template_title', array( $this, 'user_settings_page_title' ) );
		add_action( 'bp_template_content', array( $this, 'user_settings_page_content' ) );

		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	/**
	 * Check if current user can update status.
	 *
	 * @return bool
	 */
	public function user_can_update_status() {
		return is_user_logged_in() && ( bp_account_deactivator()->current_user_can_change_account_status() || ( bp_is_my_profile() && bp_account_deactivator()->get_option( 'allow_user_update' ) ) );
	}

	/**
	 * Settings page title
	 */
	public function user_settings_page_title() {

		echo __( 'Account Status', 'bp-deactivate-account' );
	}

	/**
	 * Settings page screen
	 */
	public function user_settings_page_content() {

		$user_id = bp_displayed_user_id();

		// not used is_displayed_user_inactive to avoid conflict.
		$is_inactive = bp_account_deactivator()->is_inactive( $user_id ) ? 1 : 0;

		if ( $is_inactive ) {

			$message = __( 'Activate your account', 'bp-deactivate-account' );
			$status  = __( 'Deactivated', 'bp-deactivate-account' );

		} else {

			$message = __( 'Deactivate your account', 'bp-deactivate-account' );
			$status  = __( 'Active', 'bp-deactivate-account' );
		}

		?>
        <form name="bp-account-deactivator-settings" method="post" class="standard-form">
            <div class="bppv-visibility-settings-block">

                <h5> <?php _e( 'Your current account status: ', 'bp-deactivate-account' ); ?>
                    <span><?php echo $status; ?></span>
                </h5>

                <h5><?php _e( 'Update status', 'bp-deactivate-account' ); ?></h5>
                <div class="radio">
                    <label>
                        <input type="radio" value="1" name="_bp_account_deactivator_status" <?php echo checked( 0, $is_inactive ); ?> /><?php _e( 'Activate', 'bp-deactivate-account' ); ?>
                    </label>
                    <label>
                        <input type="radio" value="0" name="_bp_account_deactivator_status" <?php echo checked( 1, $is_inactive ); ?> /><?php _e( 'Deactivate', 'bp-deactivate-account' ); ?>
                    </label>
                </div>

                <p class="bp-account-deactivator-help-block">
					<?php _e( "If you select deactivate, You will be hidden from the users.", 'bp-deactivate-account' ); ?>
                </p>
            </div>


			<?php wp_nonce_field( 'bp-account-deactivator' ); ?>

            <p class="submit">
                <input type="submit" id="bp_account_deactivator_update_settings" name="bp_account_deactivator_update_settings" class="button" value="<?php _e( 'Save', 'bp-deactivate-account' ); ?>"/>
            </p>
        </form>
		<?php
	}


	/**
	 * Setup adminbar menu
	 */
	public function setup_admin_bar() {

		// Bail if this is an ajax request.
		if ( defined( 'DOING_AJAX' ) || ! bp_use_wp_admin_bar() || ! bp_is_active( 'settings' ) ) {
			return;
		}

		global $wp_admin_bar;

		// Menus for logged in user.
		if ( is_user_logged_in() && bp_account_deactivator()->get_option( 'allow_user_update' ) ) {

			// Setup the logged in user variables.
			$user_domain   = bp_loggedin_user_domain();
			$settings_link = trailingslashit( $user_domain . bp_get_settings_slug() );

			// General Account.
			$wp_admin_bar->add_menu( array(
				'parent' => 'my-account-settings',
				'id'     => 'my-account-account-deactivator',
				'title'  => __( 'Account Status', 'bp-deactivate-account' ),
				'href'   => trailingslashit( $settings_link . 'account-deactivator' ),
			) );
		}
	}

}

// initialize.
BP_Account_Deactivator_Settings_Helper::get_instance();
