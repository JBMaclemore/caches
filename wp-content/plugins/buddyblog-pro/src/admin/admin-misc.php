<?php
/**
 * Miscellaneous
 *
 * @package    BuddyBlog_Pro
 * @subpackage Admin
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Fires 'bblpro_form_admin_enqueue_scripts' action on BuddyBlog form edit/create pages.
 *
 * Allows modules to reliably load scripts/styles on the form add/edit screen
 *
 * @param string $hook_suffix hook suffix.
 */
function bblogpro_admin_scripts( $hook_suffix ) {

	if ( 'post.php' !== $hook_suffix && 'post-new.php' !== $hook_suffix ) {
		return;
	}

	if ( ! bblpro_is_form_admin() ) {
		return;
	}

	do_action( 'bblpro_form_admin_enqueue_scripts' );
}
add_action( 'admin_enqueue_scripts', 'bblogpro_admin_scripts' );

/**
 * Adds View docs & Forms on plugin row on plugins screen
 *
 * @param array $actions links to be shown in the plugin list context.
 *
 * @return array
 */
function bblogpro_plugin_action_links( $actions ) {

	if ( post_type_exists( bblpro_get_form_post_type() ) ) {
		$actions['view-bblogpro-forms'] = sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', admin_url( 'edit.php?post_type=' . bblpro_get_form_post_type() ), __( 'View Forms', 'buddyblog-pro' ), __( 'View Forms', 'buddyblog-pro' ) );
	}

	$actions['view-bblogpro-docs'] = sprintf( '<a href="%1$s" title="%2$s" target="_blank">%2$s</a>', 'https://buddydev.com/docs/buddyblog-pro/', _x( 'Documentation', 'plugin row link label', 'buddyblog-pro' ) );

	return $actions;
}

add_filter( 'plugin_action_links_' . plugin_basename( buddyblog_pro()->get_file() ), 'bblogpro_plugin_action_links' );


/**
 * Upgrade database for form type.
 */
function bblpro_upgrade_database() {

	$current_version = 132;
	$old_version     = absint( get_option( 'bblpro_db_version', 0 ) );

	if ( $old_version >= $current_version ) {
		return;
	}

	bblpro_upgrade_132();

	update_option( 'bblpro_db_version', $current_version, true );
}

add_action( 'admin_init', 'bblpro_upgrade_database' );

/**
 * Upgrade for form type support.
 */
function bblpro_upgrade_132() {

	// if the BuddyBlog Group handled the upgrade, return(It was removed in beta).
	if ( get_option( 'bblgroups_installed_version' ) ) {
		return true;
	}

	global $wpdb;

	$form_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s", bblpro_get_form_post_type() ) );
	// mark all existing forms as members form
	foreach ( $form_ids as $form_id ) {
		update_post_meta( $form_id, '_buddyblog_form_type', 'members' );
	}

	// mark all posts as user posts by adding the post meta
	// _is_bbl_user_post to 1

	$update_settings_query = "INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value) 
				SELECT  post_id, %s as meta_key, %s as meta_value FROM {$wpdb->postmeta} where meta_key = %s";

	$prepared_query = $wpdb->prepare( $update_settings_query, '_is_bbl_user_post', 1, '_is_buddyblog_post' );

	$wpdb->query( $prepared_query );
}
