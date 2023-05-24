<?php
/**
 * Ajax Term Creation Handler
 *
 * @package    BuddyBlog_Pro
 * @subpackage Handlers
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Handlers;

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Handles creation of the terms from front end.
 */
class Ajax_Term_Creation_Handler {

	/**
	 * Boots itself
	 */
	public static function boot() {
		$self = new self();
		$self->setup();
	}

	/**
	 * Setup
	 */
	private function setup() {
		add_action( 'wp_ajax_bblpro_create_term', array( $this, 'handle' ) );
	}

	/**
	 * Handles the term creation.
	 */
	public function handle() {

		$nonce = empty( $_POST['_wpnonce'] ) ? '' : $_POST['_wpnonce'];

		if ( empty( $nonce ) ) {
			exit( 0 );
		}

		$form_id  = isset( $_POST['form_id'] ) ? absint( wp_unslash( $_POST['form_id'] ) ) : 0;
		$taxonomy = isset( $_POST['taxonomy'] ) ? wp_unslash( trim( $_POST['taxonomy'] ) ) : '';
		$term     = isset( $_POST['term'] ) ? wp_unslash( trim( $_POST['term'] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, "bblpro-term-add-{$taxonomy}-{$form_id}" ) ) {
			exit( 0 );
		}

		if ( empty( $form_id ) || empty( $taxonomy ) || empty( $term ) ) {
			exit( 0 );
		}

		$user_id = get_current_user_id();

		if ( ! bblpro_user_can_create_taxonomy_term( $user_id, $taxonomy, $form_id, $term ) ) {
			wp_send_json_error( array(
				'message' => __( "You don't have permission to create.", 'buddyblog-pro' )
			) );
		}
		// check if the term exists.

		if ( term_exists( $term, $taxonomy ) ) {
			wp_send_json_error( array(
				'message' => sprintf( __( "The term %s already exists.", 'buddyblog-pro' ), $term )
			) );
		}

		$result = wp_insert_term( $term, $taxonomy );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( array(
				'message' => __( "There was a problem. Please try again later.", 'buddyblog-pro' )
			) );
		}

		$term_id = $result['term_id'];
		// add creator user in term meta.
		update_term_meta( $term_id, '_bbl_creator_id', $user_id );

		wp_send_json_success( array(
			'id' => $result['term_id'],
			'message' => sprintf( __( '"%s" created successfully!', 'buddyblog-pro'), $term )
		) );
	}
}