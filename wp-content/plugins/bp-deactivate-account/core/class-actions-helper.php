<?php
/**
 * Handler action based on admin settings.
 */

// Exit if files access directly over web.
if ( ! defineD( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class BP_Account_Deactivator_Option_Hooks
 */
class BP_Account_Deactivator_Action_Hooks {

	/**
	 * Singleton.
	 *
	 * @var BP_Account_Deactivator_Action_Hooks
	 */
	private static $instance = null;

	/**
	 * BP_Account_Deactivator_Option_Hooks constructor.
	 */
	private function __construct() {
		$this->setup();
	}

	/**
	 * Get singleton instance.
	 *
	 * @return BP_Account_Deactivator_Action_Hooks
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Setup hooks callbacks
	 */
	public function setup() {

		add_action( 'wp_login', array( $this, 'check_login' ), 10, 2 );
		add_filter( 'login_message', array( $this, 'block_message' ) );

		add_action( 'bp_member_header_actions', array( $this, 'single_member_button' ), 1001 );
		add_action( 'bp_template_redirect', array( $this, 'handle_activation_deactivation' ) );

		add_action( 'wp_login', array( $this, 'on_login' ), 10, 2 );
		add_action( 'bp-account-activated', array( $this, 'on_activation' ) );
		add_action( 'bp-account-deactivated', array( $this, 'on_deactivation' ) );

		// filter body.
		add_filter( 'body_class', array( $this, 'add_body_class' ) );
	}

	/**
	 * Show button on user's profile.
	 */
	public function single_member_button() {
		if ( bp_account_deactivator()->current_user_can_change_account_status() ) {
			echo $this->get_button( bp_displayed_user_id() );
		}
	}

	/**
	 * Get the deactivate/reactivate buton for given user.
	 *
	 * @param int $user_id user id.
	 *
	 * @return string
	 */
	public function get_button( $user_id ) {


		$url = bp_core_get_user_domain( $user_id );

		if ( bp_account_deactivator()->is_active( $user_id ) ) {
			$label  = __( 'Deactivate', 'bp-deactivate-account' );
			$action = 'deactivate';
		} else {
			$label  = __( 'Activate', 'bp-deactivate-account' );
			$action = 'activate';
		}

		$url = add_query_arg(
			array(
				'bpad_action' => $action,
				'uid'         => $user_id,
			),
			$url
		);

		//return sprintf( '<a href="%1$s">%2$s</a>',, $label );
		return bp_get_button( array(
			'id'             => 'bpad-' . $action,
			'link_id'        => "bpad-{$user_id}-{$action}",
			'component'      => 'members',
			'block_self'     => false,
			'link_href'      => wp_nonce_url( $url, $action ),
			'link_text'      => $label,
			'link_class'     => 'bpad-link-' . $action,
			'parent_element' => 'div',
			'parent_attr'    => array(
				'class' => 'generic-button bpad-generic-button bpad-' . $action . '-button',
			),

		) );

	}

	/**
	 * Handle action.
	 */
	public function handle_activation_deactivation() {

		if ( empty( $_GET['bpad_action'] ) ) {
			return;
		}

		$action = $_GET['bpad_action'];

		if ( ! wp_verify_nonce( $_GET['_wpnonce'], $action ) ) {
			return;// should we show some message?
		}

		$user_id = isset( $_GET['uid'] ) ? absint( $_GET['uid'] ) : 0;

		if ( ! $user_id ) {
			return;
		}

		$user = get_user_by( 'id', $user_id );

		if ( ! $user_id ) {
			return;
		}

		if ( $user_id != bp_loggedin_user_id() && ! bp_account_deactivator()->current_user_can_change_account_status() ) {
			return;
		}

		if ( $action == 'activate' ) {
			bp_core_add_message( __( 'Account restored.', 'bp-deactivate-account' ), 'success' );
			bp_account_deactivator()->set_active( $user->ID );
		} elseif ( $action == 'deactivate' ) {
			bp_core_add_message( __( 'Account deactivated.', 'bp-deactivate-account' ), 'error' );
			bp_account_deactivator()->set_inactive( $user->ID );
		}
	}
	/**
	 * On user login
	 *
	 * @param string $user_login user_name.
	 * @param object $user WP_User class.
	 */
	public function check_login( $user_login, $user ) {

		// Do not do anything if login is not blocked.
		if ( ! bp_account_deactivator()->get_option( 'block_login' ) ) {
			return;
		}

		if ( ! $user ) {
			$user = get_user_by( 'login', $user_login );
		}

		if ( ! $user ) {
			return;
		}

		$deactivator = bp_account_deactivator();

		if ( $deactivator->is_inactive( $user->ID ) ) {
			// Clear auth cookie.
			wp_clear_auth_cookie();

			$login_url = add_query_arg( 'bpad_blocked', 1, wp_login_url() );
			wp_redirect( $login_url );
			exit;
		}
	}


	/**
	 * Show notice to the blocked user.
	 *
	 * @param string $message message to be shown.
	 *
	 * @return string
	 */
	public function block_message( $message ) {
		// Show the error message if it seems to be a disabled user.
		if ( ! empty( $_GET['bpad_blocked'] ) ) {
			$message = '<div id="login_error">' . bp_account_deactivator()->get_option( 'block_message' ) . '</div>';
		}

		return $message;
	}

	/**
	 * On user login
	 *
	 * @param string $user_login user_name.
	 * @param object $user WP_User class.
	 */
	public function on_login( $user_login, $user ) {

		$deactivator = bp_account_deactivator();

		if ( $deactivator->get_option( 'reactivate-on-login' ) && $deactivator->is_inactive( $user->ID ) ) {
			$deactivator->set_active( $user->ID );
		}
	}

	/**
	 * Notify user via email on account activation
	 *
	 * @param int $user_id activated account user id.
	 */
	public function on_activation( $user_id ) {

		// even though super admins are not allowed to deactivate their account, let us keep a check.
		if ( is_super_admin( $user_id ) ) {
			return;
		}

		$deactivator = bp_account_deactivator();

		// Account activated, send email to user.
		if ( $deactivator->get_option( 'notify-user-on-activation' ) && apply_filters( 'bp_account_deactivator_notify_user_on_activation', true ) ) {
			$this->notify_user( $user_id, 'account_activation' );
		}

		// Account activated by user, send email to admin.
		if ( ! is_super_admin() && $deactivator->get_option( 'notify-admin-on-activation' ) && apply_filters( 'bp_account_deactivator_notify_admin_on_activation', true ) ) {
			$this->notify_admin( $user_id, 'account_activation' );
		}

		//if ( ! is_super_admin() ) {
			$this->maybe_redirect( bp_core_get_user_domain( $user_id ) );
		//}
	}

	/**
	 * Notify user via email on account deactivation
	 *
	 * @param int $user_id deactivated account user id.
	 */
	public function on_deactivation( $user_id ) {

		// even though super admins are not allowed to deactivate their account, let us keep a check.
		if ( is_super_admin( $user_id ) ) {
			return;
		}

		$is_super_admin = is_super_admin();

		$deactivator = bp_account_deactivator();

		// Account deactivated, sed email if allowed.
		if ( $deactivator->get_option( 'notify-user-on-deactivation' ) && apply_filters( 'bp_account_deactivator_notify_user_on_deactivation', true ) ) {
			$this->notify_user( $user_id, 'account_deactivation' );
		}

		// Account deactivated by user.
		if ( ! $is_super_admin && $deactivator->get_option( 'notify-admin-on-deactivation' ) && apply_filters( 'bp_account_deactivator_notify_admin_on_deactivation', true ) ) {
			$this->notify_admin( $user_id, 'account_deactivation' );
		}

		$is_manager = bp_account_deactivator()->current_user_can_change_account_status();
		$logged_out = false;
		if ( ! is_super_admin() && $deactivator->get_option( 'logout-on-deactivation' ) ) {
			$logged_out = true;
		}

		if ( $logged_out ) {
			wp_logout();
			// destroy all sessions for the deactivated user.
			bp_account_deactivator()->destroy_sessions( $user_id );

			$redirect_url = $deactivator->get_option( 'redirect-url-on-deactivation' );
			if ( ! $redirect_url ) {
				$redirect_url = wp_login_url();
			}
			$this->maybe_redirect( $redirect_url );
		} else {
			$this->maybe_redirect( bp_core_get_user_domain( $user_id ) );
		}
	}

	/**
	 * Notify user via email on activation or on deactivation
	 *
	 * @param int    $user_id id of user account status has changed.
	 * @param string $context context of email.
	 */
	public function notify_user( $user_id, $context ) {

		$deactivator = bp_account_deactivator();

		switch ( $context ) {
			case 'account_activation':
				$user    = get_userdata( $user_id );
				$subject = $deactivator->get_option( 'user-activation-email-subject' );
				$message = str_replace( '[user_name]', $user->user_login, $deactivator->get_option( 'user-activation-email-body' ) );

				wp_mail( $user->user_email, $subject, $message );
				break;
			case 'account_deactivation':
				$user    = get_userdata( $user_id );
				$subject = $deactivator->get_option( 'user-deactivation-email-subject' );
				$message = str_replace( '[user_name]', $user->user_login, $deactivator->get_option( 'user-deactivation-email-body' ) );

				wp_mail( $user->user_email, $subject, $message );
				break;
		}
	}

	/**
	 * Notify admin on activation or deactivation of account
	 *
	 * @param int    $user_id id of user account status has changed.
	 * @param string $context account_activation or account_deactivate.
	 */
	public function notify_admin( $user_id, $context ) {

		$deactivator = bp_account_deactivator();

		switch ( $context ) {
			case 'account_activation':
				$user = get_userdata( $user_id );

				$administrators = $this->get_admin_users();

				$subject    = $deactivator->get_option( 'admin-activation-email-subject' );
				$email_body = $deactivator->get_option( 'admin-activation-email-body' );

				foreach ( $administrators as $administrator ) {
					$message = str_replace( array( '[admin_name]', '[user_name]' ), array(
						$administrator->user_login,
						$user->user_login,
					), $email_body );

					wp_mail( $administrator->user_email, $subject, $message );
				}
				break;
			case 'account_deactivation':
				$user = get_userdata( $user_id );

				$administrators = $this->get_admin_users();

				$subject    = $deactivator->get_option( 'admin-deactivation-email-subject' );
				$email_body = $deactivator->get_option( 'admin-deactivation-email-body' );

				foreach ( $administrators as $administrator ) {
					$message = str_replace( array( '[admin_name]', '[user_name]' ), array(
						$administrator->user_login,
						$user->user_login,
					), $email_body );

					wp_mail( $administrator->user_email, $subject, $message );
				}
				break;
		}
	}

	/**
	 * Get Admin users
	 */
	private function get_admin_users() {
		$emails = bp_account_deactivator()->get_option( 'notify-admin-email-addresses' );
		$users  = array();

		if ( ! empty( $emails ) ) {
			$values = explode( "\n", str_replace( '\r', '', $emails ) );
			// Stores multidimensional array of emails ids.
			$raw_email_ids = array();
			foreach ( $values as $value ) {

				if ( empty( $value ) ) {
					continue;
				}

				array_push( $raw_email_ids, array_map( 'trim', explode( ',', $value ) ) );
			}

			$users_email_id = array();
			foreach ( $raw_email_ids as $emails ) {
				if ( is_array( $emails ) ) {
					foreach ( $emails as $email ) {
						$users_email_id[] = $email;
					}
				} else {
					$users_email_id[] = $emails;
				}
			}

			foreach ( $users_email_id as $email_id ) {
				$user = get_user_by( 'email', $email_id );
				if ( $user ) {
					$users[] = $user;
				} else {
					$user = new stdClass();

					$user->user_login = '';
					$user->user_email = $email_id;

					$users[] = $user;
				}
			}
		} else {
			$users = get_users(
				array(
					'role' => 'administrator',
				)
			);
		}

		return $users;
	}

	/**
	 * Add appropriate class to body.
	 *
	 * @param array $classes css classes.
	 *
	 * @return array
	 */
	public function add_body_class( $classes ) {

		if ( ! is_user_logged_in() || ! function_exists( 'buddypress' ) ) {
			return $classes;
		}

		if ( bp_is_user() ) {
			$classes[] = bp_account_deactivator()->is_active( bp_displayed_user_id() ) ? 'bp-deactivator-displayed-active' : 'bp-deactivator-displayed-inactive';
		}

		$classes[] = bp_account_deactivator()->is_active( bp_loggedin_user_id() ) ? 'bp-deactivator-logged-active' : 'bp-deactivator-logged-inactive';

		return $classes;
	}

	/**
	 * May be redirect.
	 *
	 * @param string $url url where to.
	 */
	private function maybe_redirect( $url ) {
		if ( apply_filters( 'bp_deactivate_account_disable_redirect', 0 ) ) {
			return;
		}

		if ( is_super_admin() && is_admin() ) {
			return;
		}

		bp_core_redirect( $url );
	}
}

BP_Account_Deactivator_Action_Hooks::get_instance();

