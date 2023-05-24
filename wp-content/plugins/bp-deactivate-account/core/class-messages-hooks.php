<?php
// exit if file access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Message restrictions for deactivated accounts.
 */
class BP_Account_Deactivator_Message_Hooks {

	/**
	 * Users list.
	 *
	 * @var array
	 */
	private $unset_users = array();

	/**
	 * Singleton.
	 *
	 * @var BP_Account_Deactivator_Message_Hooks
	 */
	private static $instance = null;

	/**
	 * BP_Account_Deactivator_Message_Hooks constructor.
	 */
	private function __construct() {

		$this->setup_message_hooks();

		add_action( 'bp_actions', array( $this, 'intercept_message_actions' ), 0 );
	}

	/**
	 * Get singleton instance.
	 *
	 * @return BP_Account_Deactivator_Message_Hooks|null
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Setup message hooks.
	 */
	private function setup_message_hooks() {

		add_action( 'messages_message_before_save', array( $this, 'check_if_allowed' ) );// user nav.
		// show notice if message could not be sent.
		add_action( 'messages_screen_compose', array( $this, 'show_notice' ) );// user nav.

		add_action( 'bp_before_message_thread_reply', array( $this, 'before_message_reply_form' ) );
		add_action( 'bp_after_message_thread_reply', array( $this, 'after_message_reply_form' ) );

		// filter message delete button
		// sorry but buddypress does not allow filtering on the delete button.
	}

	/**
	 * Start buffer.
	 */
	public function before_message_reply_form() {
		// check for both the users.
		if ( ! bp_account_deactivator()->is_logged_user_inactive() ) {
			return;
		}

		ob_start();// start output buffering.
	}

	/**
	 * End buffer.
	 */
	public function after_message_reply_form() {
		if ( ! bp_account_deactivator()->is_logged_user_inactive() ) {
			return;
		}

		ob_end_clean();// discard buffer.

		echo '';// do not echo anything.
	}

	/**
	 * Intercept the message component action before BuddyPress can do it
	 */
	public function intercept_message_actions() {
		if ( ! bp_account_deactivator()->is_logged_user_inactive() ) {
			return;
		}

		if ( ! bp_is_active( 'messages' ) ) {
			return;
		}

		if ( ! bp_is_messages_component() ) {
			return;
		}
		// do not allow to see the compose screen.
		if ( bp_is_messages_compose_screen() ) {

			bp_core_redirect( bp_loggedin_user_domain() . bp_get_messages_slug() );
		}
		$action_variable = bp_action_variable( 0 );

		if ( $action_variable && ! is_numeric( $action_variable ) ) {
			// so sort of action like delete/read/unread.
			// dont let bp take the action.
			bp_core_redirect( wp_get_referer() );
		}
	}

	/**
	 * Checks for the allowed users and modifies the message object
	 *
	 * @param BP_Messages_Message $message message object.
	 *
	 * @return mixed
	 */
	public function check_if_allowed( $message ) {

		if ( is_super_admin() ) {
			return $message;// no restriction fo super admin.
		}

		// Nouveau compatibility add.
		if ( function_exists( 'bp_nouveau' ) && bp_account_deactivator()->is_logged_user_inactive() ) {
			wp_send_json_error( array(
				'feedback' => __( 'You are not allowed to send message', 'bp-deactivate-account' ),
				'type'     => 'error',
			) );
		}

		$recipients = $message->recipients;// array of recipients object( $recipient->user_id).

		// for each of the recipient,
		// check his privacy settings and whether he has allowed this user to send message or not.
		foreach ( (array) $recipients as $key => $recepient ) {

			if ( bp_account_deactivator()->is_inactive( $recepient->user_id ) ) {
				unset( $message->recipients[ $key ] );
				// keep track of who was removed from list, we will show it to the sender later.
				$this->unset_users[] = $recepient->user_id;
			}
		}

		return $message;
	}

	/**
	 * Show notice if we blocked the sender to send message to any of the recipient specified
	 */
	public function show_notice() {

		if ( empty( $this->unset_users ) ) {
			return;
		}

		// ok, Let us map the users array to their names/display names.
		$blocked_users = array_map( 'bp_core_get_user_displayname', $this->unset_users );

		// now we know who have blocked us from sending message,
		// what about doing the same to them.
		$blocked_users = join( ',', $blocked_users );
		bp_core_add_message( sprintf( __( 'The message could not be sent to following user(s): %s.', 'bp-deactivate-account' ), $blocked_users ), 'error' );

	}

	/**
	 * Get recipient ids.
	 */
	private function get_recipients_ids() {
		global $thread_template;

		$ids = array();

		foreach ( (array) $thread_template->thread->recipients as $recipient ) {
			if ( (int) $recipient->user_id !== bp_loggedin_user_id() ) {
				$ids[] = $recipient->user_id;

			}
		}
	}
}

// stop sending/replying to messages.
// should we add some whitelisted actions?

//can not stop $_POST as it will have other repercussions.
BP_Account_Deactivator_Message_Hooks::get_instance();
