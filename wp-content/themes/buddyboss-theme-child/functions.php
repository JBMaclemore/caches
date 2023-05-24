<?php
/**
 * @package BuddyBoss Child
 * The parent theme functions are located at /buddyboss-theme/inc/theme/functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/

/**
 * Sets up theme for translation
 *
 * @since BuddyBoss Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'buddyboss-theme', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'buddyboss-theme' instances in all child theme files to 'buddyboss-theme-child'.
  // load_theme_textdomain( 'buddyboss-theme-child', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'buddyboss_theme_child_languages' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function buddyboss_theme_child_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  // Styles
  wp_enqueue_style( 'buddyboss-child-css', get_stylesheet_directory_uri().'/assets/css/custom.css' );

  // Javascript
  wp_enqueue_script( 'buddyboss-child-js', get_stylesheet_directory_uri().'/assets/js/custom.js' );
}
add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here

// show logged in username shortcode
function show_loggedin_function( $atts ) {

	global $current_user, $user_login;
      	get_currentuserinfo();
	add_filter('widget_text', 'do_shortcode');
	if ($user_login) 
		return $current_user->display_name;
	else
		return '<a href="' . wp_login_url() . ' ">Login</a>';
}
add_shortcode( 'show_loggedin_as', 'show_loggedin_function' );

// This will suppress empty email errors when submitting the user form
add_action('user_profile_update_errors', 'my_user_profile_update_errors', 10, 3 );
function my_user_profile_update_errors($errors, $update, $user) {
$errors->remove('empty_email');
}

add_filter('admin_title', 'custom_login_title', 99);
add_filter('login_title', 'custom_login_title', 99);
function custom_login_title($origtitle) {
    return get_bloginfo('name');
}
function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/login-styles.css' );
}

// add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );
if( is_user_logged_in() ) {
$page = get_page_by_path( 'homepage'); 
update_option( 'page_on_front', $page->ID );
update_option( 'show_on_front', 'page' );
}
else {
$page = get_page_by_path( 'not-logged-in-homepage' );
update_option( 'page_on_front', $page->ID );
update_option( 'show_on_front', 'page' );
}

function my_login_page($login_url) {
return ( 'https://caches.xyz/register-account/' );
}

add_filter( 'login_url', 'my_login_page', 10 );
add_filter( 'logout_url', 'my_logout_url' );
function my_logout_url( $url ) {
    $redirect = home_url();
    return $url.'&redirect_to='.$redirect;
}

function wpse_add_to_user_table($column) {
    $column['nickname'] = 'Nickname';
    return $column;
}
add_filter('manage_users_columns', 'wpse_add_to_user_table');

function wpse_disply_in_user_table_row($value, $column_name, $user_id) {
    switch ($column_name) {
        case 'nickname' :
            return get_user_meta($user_id, 'nickname', true);
        default:
    }
    return $value;
}
add_filter('manage_users_custom_column', 'wpse_disply_in_user_table_row', 10, 3);
?>
