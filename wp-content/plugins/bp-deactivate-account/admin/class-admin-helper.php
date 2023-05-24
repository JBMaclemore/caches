<?php
/**
 * Class deals with backend
 */

use \Press_Themes\PT_Settings\Page;

/**
 * Class BP_Account_Deactivator_Admin_Helper
 */
class BP_Account_Deactivator_Admin_Helper {

	/**
	 * Slug for register menu
	 *
	 * @var string
	 */
	private $page_slug = 'bp-deactivate-account-settings';

	/**
	 * Used to keep a reference of the Page, It will be used in rendering the view.
	 *
	 * @var \Press_Themes\PT_Settings\Page
	 */
	private $page;

	/**
	 * Option name.
	 *
	 * @var string
	 */
	private $option_name = 'bp-deactivate-account-settings';

	/**
	 * BP_Account_Deactivator_Admin_Helper constructor.
	 */
	public function __construct() {
		// Add settings section of plugin.
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'init' ) );

		// WP setting api does not save in site meta, we will sync.
		if ( is_multisite() && bp_account_deactivator()->is_network_active() ) {
			add_action( 'network_admin_menu', array( $this, 'add_network_menu' ) );
			add_action( 'pre_update_option_' . $this->option_name, array( $this, 'sync_options' ), 10, 2 );
		}
	}

	/**
	 * Add Option page
	 */
	public function add_menu() {
		add_options_page(
			_x( 'BP Deactivate Account Settings', 'Admin settings page title', 'bp-deactivate-account' ),
			_x( 'BP Deactivate Account', 'Admin settings menu label', 'bp-deactivate-account' ),
			'delete_users',
			$this->page_slug,
			array( $this, 'render' )
		);
	}

	/**
	 * Add Option page
	 */
	public function add_network_menu() {
		add_submenu_page(
			'settings.php',
			_x( 'BP Deactivate Account Settings', 'Admin settings page title', 'bp-deactivate-account' ),
			_x( 'BP Deactivate Account', 'Admin settings menu label', 'bp-deactivate-account' ),
			'delete_users',
			$this->page_slug,
			array( $this, 'render' )
		);
	}

	/**
	 * Render settings page content
	 */
	public function render() {
		$this->page->render();
	}

	/**
	 * Initialize the admin settings panel and fields
	 */
	public function init() {
		if ( $this->is_network_admin() || $this->is_options_page() || $this->is_setting_page() ) {
			$this->register_settings();
		}
	}

	/**
	 * Register settings page on network settings page
	 */
	public function register_settings() {

		$page = new Page( $this->option_name );

		if ( is_multisite() && bp_account_deactivator()->is_network_active() ) {
			$page->set_network_mode();
		}

		$this->page = $page;

		$this->add_settings( $page );

		do_action( 'bp_deactivate_account_admin_settings', $this->page );

		$page->init();
	}

	/**
	 * Sync option to the site meta.
	 *
	 * @param mixed $value value of the meta.
	 * @param mixed $old_value old value.
	 *
	 * @return mixed
	 */
	public function sync_options( $value, $old_value ) {
		update_site_option( $this->option_name, $value );

		return $value;
	}

	/**
	 * Add a panel and section containing different fields of settings.
	 *
	 * @param object $page Page class.
	 */
	public function add_settings( $page ) {

		// Add a panel to to the admin.
		// A panel is a Tab and what comes under that tab.
		$panel = $page->add_panel( 'settings', _x( 'Settings', 'Admin settings', 'bp-deactivate-account' ) );

		$section = $panel->add_section( 'general-settings', _x( 'General Settings', 'Admin settings', 'bp-deactivate-account' ) );

		$defaults = bp_account_deactivator()->get_default_options();


		$section->add_field( array(
			'name'    => 'allow_user_update',
			'label'   => __( 'Allow user to update account status?', 'bp-deactivate-account' ),
			'type'    => 'radio',
			'default' => $defaults['allow_user_update'],
			'options' => array(
				1 => __( 'Yes', 'bp-deactivate-account' ),
				0 => __( 'No', 'bp-deactivate-account' ),
			),
			'desc'  => __( "If disabled, Only admins can update user's account status.", 'bp-deactivate-account' ),
		) )->add_field( array(
			'name'    => 'block_login',
			'label'   => __( 'Disable login for deactivated users?', 'bp-deactivate-account' ),
			'type'    => 'radio',
			'default' => $defaults['block_login'],
			'options' => array(
				1 => __( 'Yes', 'bp-deactivate-account' ),
				0 => __( 'No', 'bp-deactivate-account' ),
			),
			'desc'  => __( "Users won't be able to login when their account is deactivated", 'bp-deactivate-account' ),
		) )->add_field( array(
			'name'    => 'block_message',
			'label'   => __( 'Disabled login message', 'bp-deactivate-account' ),
			'type'    => 'textarea',
			'default' => $defaults['block_message'],
			'desc'  => __( "Message to be shown when the deactivated user attempts to login(Shown only if blocking is enabled).", 'bp-deactivate-account' ),
		) )->add_field( array(
			'name'    => 'reactivate-on-login',
			'label'   => __( 'Set account status to active on login?', 'bp-deactivate-account' ),
			'type'    => 'radio',
			'default' => $defaults['reactivate-on-login'],
			'options' => array(
				1 => __( 'Yes', 'bp-deactivate-account' ),
				0 => __( 'No', 'bp-deactivate-account' ),
			),

		) )->add_field( array(
			'name'    => 'logout-on-deactivation',
			'label'   => __( 'Logout user on deactivation', 'bp-deactivate-account' ),
			'type'    => 'radio',
			'default' => $defaults['logout-on-deactivation'],
			'options' => array(
				1 => __( 'Yes', 'bp-deactivate-account' ),
				0 => __( 'No', 'bp-deactivate-account' ),
			),

		) )->add_field( array(
			'name'    => 'redirect-url-on-deactivation',
			'label'   => __( 'Redirect url on deactivation', 'bp-deactivate-account' ),
			'type'    => 'text',
			'default' => $defaults['redirect-url-on-deactivation'],
		) );

		$this->add_admin_email_settings( $panel );
		$this->add_user_email_settings( $panel );
	}

	/**
	 * Add admin email setting fields
	 *
	 * @param object $panel Page class.
	 */
	public function add_admin_email_settings( $panel ) {

		$defaults = bp_account_deactivator()->get_default_options();

		$section = $panel->add_section( 'admin-email-settings', _x( 'Admin Email Settings', 'Admin settings', 'bp-deactivate-account' ) );

		$section->add_field(
			array(
				'name'    => 'notify-admin-email-addresses',
				'label'   => __( 'Notify admin email addresses', 'bp-deactivate-account' ),
				'type'    => 'rawtext',
				'default' => $defaults['notify-admin-email-addresses'],
				'desc'    => __( 'use comma(,) to separate email ids', 'bp-deactivate-account' ),
			)
		);

		$section->add_field( array(
			'name'    => 'notify-admin-on-activation',
			'label'   => __( 'Notify admin on activation?', 'bp-deactivate-account' ),
			'type'    => 'checkbox',
			'default' => $defaults['notify-admin-on-activation'],
		) )->add_field( array(
			'name'    => 'admin-activation-email-subject',
			'label'   => _x( 'Activation email subject', 'Admin settings', 'bp-deactivate-account' ),
			'type'    => 'text',
			'default' => $defaults['admin-activation-email-subject'],
		) )->add_field( array(
			'name'    => 'admin-activation-email-body',
			'label'   => _x( 'Activation email content', 'Admin settings', 'bp-deactivate-account' ),
			'type'    => 'rawtext',
			'default' => $defaults['admin-activation-email-body'],
		) );


		$section->add_field( array(
			'name'    => 'notify-admin-on-deactivation',
			'label'   => __( 'Notify admin on deactivation?', 'bp-deactivate-account' ),
			'type'    => 'checkbox',
			'default' => $defaults['notify-admin-on-deactivation'],
		) )->add_field( array(
			'name'    => 'admin-deactivation-email-subject',
			'label'   => _x( 'Deactivation email subject', 'Admin settings', 'bp-deactivate-account' ),
			'type'    => 'text',
			'default' => $defaults['admin-deactivation-email-subject'],
		) )->add_field( array(
			'name'    => 'admin-deactivation-email-body',
			'label'   => _x( 'Deactivation email content', 'Admin settings', 'bp-deactivate-account' ),
			'type'    => 'rawtext',
			'default' => $defaults['admin-deactivation-email-body'],
		) );
	}

	/**
	 * Add User email fields
	 *
	 * @param object $panel Page.
	 */
	public function add_user_email_settings( $panel ) {

		// A panel can contain one or more sections.
		$section = $panel->add_section( 'user-email-settings', _x( 'User Email Settings', 'Admin settings', 'bp-deactivate-account' ) );

		$defaults = bp_account_deactivator()->get_default_options();

		$section->add_field( array(
			'name'    => 'notify-user-on-activation',
			'label'   => __( 'Notify on activation?', 'bp-deactivate-account' ),
			'type'    => 'checkbox',
			'default' => $defaults['notify-user-on-activation'],
		) );


		$section->add_field( array(
			'name'    => 'user-activation-email-subject',
			'label'   => _x( 'Activation email subject', 'admin settings', 'bp-deactivate-account' ),
			'type'    => 'text',
			'default' => $defaults['user-activation-email-subject'],
		) )->add_field( array(
			'name'    => 'user-activation-email-body',
			'label'   => _x( 'Activation email content', 'admin settings', 'bp-deactivate-account' ),
			'type'    => 'rawtext',
			'default' => $defaults['user-activation-email-subject'],
		) );


		$section->add_field( array(
			'name'    => 'notify-user-on-deactivation',
			'label'   => __( 'Notify on deactivation?', 'bp-deactivate-account' ),
			'type'    => 'checkbox',
			'default' => $defaults['notify-user-on-deactivation'],
		) );

		$section->add_field( array(
			'name'    => 'user-deactivation-email-subject',
			'label'   => _x( 'Activation email subject', 'admin settings', 'bp-deactivate-account' ),
			'type'    => 'text',
			'default' => $defaults['user-deactivation-email-subject'],
		) )->add_field( array(
			'name'    => 'user-deactivation-email-body',
			'label'   => _x( 'Deactivation email content', 'admin settings', 'bp-deactivate-account' ),
			'type'    => 'rawtext',
			'default' => $defaults['user-deactivation-email-subject'],
		) );
	}


	/**
	 * Is it the options.php page that saves settings?
	 *
	 * @return bool
	 */
	private function is_options_page() {
		global $pagenow;

		// We need to load on options.php otherwise settings won't be reistered.
		if ( 'options.php' === $pagenow ) {
			return true;
		}

		return false;

	}


	/**
	 * Is it non multisite settings page?
	 *
	 * @return bool
	 */
	public function is_setting_page() {
		return isset( $_GET['page'] ) && ( $this->page_slug === $_GET['page'] );
	}

	/**
	 * Is it multisite settings page?.
	 *
	 * @return bool
	 */
	public function is_network_admin() {
		return is_network_admin() && isset( $_GET['page'] ) && ( $this->page_slug === $_GET['page'] ) && bp_account_deactivator()->is_network_active();
	}

}

// initialize.
new BP_Account_Deactivator_Admin_Helper();
