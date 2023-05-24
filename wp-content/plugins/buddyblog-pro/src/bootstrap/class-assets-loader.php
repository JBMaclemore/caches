<?php
/**
 * Assets Loader
 *
 * @package    BuddyBlog_Pro
 * @subpackage Bootstrap
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh, Ravi Sharma
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Bootstrap;

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Assets Loader.
 */
class Assets_Loader {

	/**
	 * Data to be send as localized js.
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 * Boot itself
	 */
	public static function boot() {
		$self = new self();
		$self->setup();
	}

	/**
	 * Setup
	 */
	public function setup() {
		add_action( 'bp_enqueue_scripts', array( $this, 'load_assets' ) );
		add_action( 'bblpro_form_admin_enqueue_scripts', array( $this, 'load_form_admin_assets' ) );

		add_filter( 'media_view_settings', array( $this, 'add_media_enqueue_compat' ), 10, 2 );
	}

	/**
	 * Load plugin assets
	 */
	public function load_assets() {
		$this->register();
		$this->enqueue();
	}

	/**
	 * Load admin assets.
	 */
	public function load_form_admin_assets() {
		$this->register();
		$this->register_admin();
		$this->enqueue_form_admin();
	}

	/**
	 * Register assets.
	 */
	public function register() {
		$this->register_vendors();
		$this->register_core();
	}

	/**
	 * Register admin form assets.
	 */
	private function register_admin() {
		$bbpro   = buddyblog_pro();
		$url     = $bbpro->url;
		$version = $bbpro->version;

		wp_register_style( 'bblogpro-admin-forms', $url . 'src/admin/assets/css/bblog-pro-forms.css', false, $version );
		wp_register_script( 'clipboard-js', $url . 'src/admin/assets/js/clipboard.min.js', array(  'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable' ), $version, false );
		wp_register_script( 'bblogpro-admin-forms', $url . 'src/admin/assets/js/bblog-pro-forms.js', array(  'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'clipboard-js' ), $version, false );

		$this->data = array();
	}

	/**
	 * Load front end assets.
	 */
	public function enqueue() {

		if ( bblpro_get_queried_post() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( ! is_user_logged_in() ) {
			return;
		}

		wp_enqueue_style( 'bblogpro' );
		wp_enqueue_script( 'bblogpro' );

		wp_localize_script(
			'bblogpro',
			'BuddyBlog_Pro',
			array(
				'post_type'           => bblpro_get_current_post_type(),
				'currentMediaFieldID' => '',
				'confirm_message'     => _x( 'Are you sure about it?', 'default confirmation message', 'buddyblog-pro' ),
			)
		);
	}

	/**
	 * Adds compatibility for wp_media_enqueue called early.
	 *
	 * @param array         $settings media view settings.
	 * @param \WP_Post|null $post post object.
	 *
	 * @return array
	 */
	public function add_media_enqueue_compat( $settings, $post ) {

		if ( $post ) {
			return $settings;
		}

		// if the post is not specified, most probably some other plugin has called it early
		// let us enforce the support for featured image.
		if ( is_user_logged_in() && bblpro_is_create_page() ) {
			$settings['post']['featuredImageId'] = - 1;
		}

		return $settings;
	}

	/**
	 * Load assets on form admin screen.
	 */
	private function enqueue_form_admin() {
		wp_enqueue_style( 'bblogpro-admin-forms' );
		wp_enqueue_script( 'bblogpro-admin-forms' );
		wp_localize_script(
			'bblogpro-admin-forms',
			'BuddyBlog_Pro_Admin',
			array(
				'nonce' => wp_create_nonce( 'bblogpro_add_form' ),
			)
		);
	}

	/**
	 * Register vendor scripts.
	 */
	private function register_vendors() {}

	/**
	 * Register core assets.
	 */
	private function register_core() {
		$bbpro   = buddyblog_pro();
		$url     = $bbpro->url;
		$version = $bbpro->version;

		wp_register_style( 'bblogpro', $url . 'assets/css/bblogpro.css', false, $version );
		wp_register_script( 'bblogpro', $url . 'assets/js/bblogpro.js', array( 'jquery', 'underscore' ), $version, false );

		$this->data = array();
	}
}
