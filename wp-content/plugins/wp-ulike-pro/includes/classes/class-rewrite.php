<?php
/**
 * Rewrite rules
 *
 * 
 * @package    wp-ulike-pro
 * @author     TechnoWich 2023
 * @link       https://wpulike.com
*/

// no direct access allowed
if ( ! defined('ABSPATH') ) {
    die();
}

class WP_Ulike_Pro_Rewrite {

	protected $core_pages, $current_user, $options, $pages_info = array();

	function __construct() {
		if ( ! defined( 'DOING_AJAX' ) ) {
			add_filter( 'wp_loaded', array( $this, 'maybe_flush_rewrite_rules' ) );
		}

		$this->options = array(
			'profiles_access' => WP_Ulike_Pro_Options::checkProfilesAccess(),
			'custom_redirect' => WP_Ulike_Pro_Options::getCustomRedirect(),
			'restrict_owner'  => WP_Ulike_Pro_Options::restrictProfileOwner(),
			'exclusive_roles' => WP_Ulike_Pro_Options::getExclusiveRoles(),
			'author_redirect' => WP_Ulike_Pro_Options::authorRedirect()
		);

		if( WP_Ulike_Pro_Options::isProfileVisible() ){
			// User profile
			$this->core_pages['profile'] = WP_Ulike_Pro_Options::getProfilePage();
			$this->pages_info['profile'] = $this->core_pages['profile'] ? get_post( $this->core_pages['profile'] ) : null;

			// Register rewrite rules
			$this->register_rewrite_rules();

			// Add query vars
			add_filter( 'query_vars', array( &$this, 'query_vars' ) );

			add_action( 'template_redirect', array( &$this, 'locate_user_profile'  ), 1000 );
		}


		// Template redirects
		add_action( 'template_redirect', array( &$this, 'redirect_author_page' ), 1000 );
		add_action( 'template_redirect', array( &$this, 'account_redirect'     ), 1000 );
		add_action( 'template_redirect', array( &$this, 'logout_redirect'      ), 1000 );
	}

	/**
	 * Reset Rewrite rules if need it.
	 *
	 * @return void
	 */
	public function maybe_flush_rewrite_rules() {
		if ( get_option( 'wp_ulike_pro_flush_rewrite_rules' ) ) {
			flush_rewrite_rules( false );
			delete_option( 'wp_ulike_pro_flush_rewrite_rules' );
		}
	}

	public function register_rewrite_rules(){
		$rules = array();

		// Profiles
		if( !empty( $this->pages_info['profile'] ) ){
			// Simple rule
			$rules[ $this->pages_info['profile']->post_name . '/([^/]+)/?$' ] = 'index.php?page_id='. $this->pages_info['profile']->ID .'&wp_ulike_user=$matches[1]';
			// Pagination rule
			$rules[ $this->pages_info['profile']->post_name . '/([^/]+)/page/([0-9]{1,})/?$' ] = 'index.php?page_id='. $this->pages_info['profile']->ID .'&wp_ulike_user=$matches[1]&paged=$matches[2]';

			// Tabs rule
			$rules[ $this->pages_info['profile']->post_name . '/([^/]+)/([^/]+)/?$' ] = 'index.php?page_id='. $this->pages_info['profile']->ID .'&wp_ulike_user=$matches[1]&wp_ulike_profile_tab=$matches[2]';
			// Tabs with paginatio rule
			$rules[ $this->pages_info['profile']->post_name . '/([^/]+)/([^/]+)/page/([0-9]{1,})/?$' ] = 'index.php?page_id='. $this->pages_info['profile']->ID .'&wp_ulike_user=$matches[1]&wp_ulike_profile_tab=$matches[2]&paged=$matches[3]';
		}

		$rules = apply_filters( 'wp_ulike_pro_rewrite_rules', $rules, $this->pages_info );

		foreach ( $rules as $regex => $query ) {
			add_rewrite_rule( $regex, $query, 'top' );
		}
	}

	/**
	 * Add custom query variables
	 *
	 * @param array $query_vars
	 * @return array $query_vars
	 */
	public function query_vars( $query_vars ){
		$query_vars[] = 'wp_ulike_user';
		$query_vars[] = 'wp_ulike_profile_tab';

		return apply_filters( 'wp_ulike_pro_rewrite_query_vars', $query_vars);
	}

	/**
	 * Author page to user profile redirect
	 */
	function redirect_author_page() {
		if ( $this->options['author_redirect'] && is_author() ) {
			$id = get_query_var( 'author' );
			exit( wp_redirect( wp_ulike_pro_get_user_profile_permalink( $id ) ) );
		}
	}

	/**
	 * Redirect account to login page
	 *
	 * @return void
	 */
	function account_redirect(){
		$account_page_id  = wp_ulike_get_option( 'edit_account_core_page', null );
		if( $account_page_id && is_page( $account_page_id ) && ! is_user_logged_in() ){
			exit( wp_redirect( WP_Ulike_Pro_Permalinks::get_login_url() ) );
		}
	}

	/**
	 * Logout user when requested
	 *
	 * @return void
	 */
	function logout_redirect(){
		$queried_action = isset( $_GET['action'] ) && $_GET['action'] === 'logout';
		if( is_user_logged_in() && $queried_action  ){
			// Check logout parameter
			$logout = new WP_Ulike_Pro_Logout();
			$logout->maybeLogout();
		}
	}

	/**
	 * Set current user variable
	 *
	 * @return void
	 */
	public function set_current_user(){
		global $wp_ulike_pro_logged_in_user_id;
		$user_id = ! $wp_ulike_pro_logged_in_user_id ? get_current_user_id() : $wp_ulike_pro_logged_in_user_id;
		$this->current_user = get_user_by( 'id', $user_id );
	}

	/**
	 * Get current user profile url
	 *
	 * @param integer $core_page_id
	 * @return string
	 */
	public function get_current_user_profile_url( $core_page_id, $user ){
		$permalink_instance = new WP_Ulike_Pro_Permalinks();
		$query = $permalink_instance->get_query_array();
		$url   = wp_ulike_pro_get_user_profile_permalink( $user );

		if ( !empty( $query ) ) {
			foreach ( $query as $key => $val ) {
				$url = add_query_arg( $key, $val, $url );
			}
		}

		return $url;
	}

	/**
	 * Add template redirect based on api type query
	 *
	 * @return void
	 */
	public function locate_user_profile() {

		$queried_user   = get_query_var( 'wp_ulike_user' );
		$selected_tab   = get_query_var( 'wp_ulike_profile_tab' );
		$core_page_id   = ! empty( $this->core_pages['profile'] ) ? $this->core_pages['profile'] : null;
		$permalink_base = WP_Ulike_Pro_Options::getProfilePermalinkBase();

		if( ! empty( $core_page_id ) && is_page( $core_page_id ) ){

			// Set current user data if logged in.
			if( is_user_logged_in() ){
				$this->set_current_user();
			}

			// Check custom redirect url
			if( empty( $this->options['custom_redirect'] ) || ! filter_var( $this->options['custom_redirect'], FILTER_VALIDATE_URL ) ){
				$this->options['custom_redirect'] = home_url();
			}

			// Check profile access for anonymous users
			if( $this->options['profiles_access'] === 'logged_in_users' && empty( $this->current_user ) ){
				exit( wp_redirect( $this->options['custom_redirect'] ) );
			}

			// If query user name exist
			if( $queried_user ){

				if( $permalink_base == 'user_login' ){
					// Check user name
					$user_id = username_exists( $queried_user );

					//Try
					if ( ! $user_id ) {

						// Search by Profile Slug
						$args = array(
							"fields" => 'ids',
							'meta_query' => array(
								array(
									'key'       =>  'ulp_user_profile_url_slug_' . $permalink_base,
									'value'     => strtolower( $queried_user ),
									'compare'   => '='
								)
							),
							'number'    => 1
						);

						$ids = new \WP_User_Query( $args );
						if ( $ids->total_users > 0 ) {
							$user_id = current( $ids->get_results() );
						}
					}

					// Try nice name
					if ( ! $user_id ) {
						$email_slug = WP_Ulike_Pro_Validation::extract_username_from_email( $queried_user );
						$the_user   = get_user_by( 'slug', $email_slug );
						if ( isset( $the_user->ID ) ){
							$user_id = $the_user->ID;
						}
						if ( ! $user_id ) {
							$user_id = WP_Ulike_Pro_User::user_exists_by_email_as_username( $email_slug );
						}
					}
				}

				if ( $permalink_base == 'user_id' ) {
					$user_id = WP_Ulike_Pro_User::user_exists_by_id( $queried_user );
				}

				if ( in_array( $permalink_base, array( 'name', 'name_dash', 'name_dot', 'name_plus' ) ) ) {
					$user_id = WP_Ulike_Pro_User::user_exists_by_name( $queried_user );
				}

				if ( ! empty( $user_id ) ) {
					// Check restrict owner conditions
					if( $this->options['profiles_access'] === 'logged_in_users' && $this->options['restrict_owner'] ){
						if( isset( $this->current_user->ID ) && $this->current_user->ID != $user_id ){
							// Check user roles that can access the profile.
							$access_roles = array();
							if( ! empty( $this->options['exclusive_roles'] ) ){
								$access_roles = array_intersect( $this->current_user->roles,  $this->options['exclusive_roles'] );
							}

							// If access role not exist, then redirect.
							if( empty( $access_roles ) ){
								exit( wp_redirect( $this->get_current_user_profile_url( $core_page_id, $this->current_user->ID  ) ) );
							}
						}
					}

					// Validate selected tab
					if( ! empty( $selected_tab ) ){
						$display_tabs = wp_ulike_get_option( 'user_profiles_appearance|tabs', array() );
						if( ! empty( $display_tabs ) ){
							$tab_exist = false;
							foreach ($display_tabs as $tab_key => $tab_args) {
								if( $selected_tab == esc_attr( strtolower( preg_replace( '/\s+/', '-', $tab_args['title'] ) ) ) ){
									$tab_exist = true;
								}
							}
							// If tab not exist, redirect to main profile page
							if( ! $tab_exist ){
								exit( wp_redirect( $this->get_current_user_profile_url( $core_page_id, $user_id ) ) );
							}
						}
					}

					// Changes the current user by ID
					wp_ulike_pro_set_current_user( $user_id );
					// Process profile hook
					do_action( 'wp_ulike_pro_access_profile', $user_id );
				} else {
					//restrict page by 404
					global $wp_query;
					$wp_query->set_404();
					status_header( 404 );
					nocache_headers();
					return;
				}

			} else {
				if ( ! empty( $this->current_user ) ) { // just redirect to their profile
					exit( wp_redirect( $this->get_current_user_profile_url( $core_page_id, $this->current_user->ID ) ) );
				} else {
					$redirect_to = apply_filters( 'wp_ulike_pro_locate_user_profile_not_logged_in_redirect', $this->options['custom_redirect'] );
					if ( ! empty( $redirect_to ) ) {
						exit( wp_redirect( $redirect_to ) );
					}
				}
			}

		}

	}

}