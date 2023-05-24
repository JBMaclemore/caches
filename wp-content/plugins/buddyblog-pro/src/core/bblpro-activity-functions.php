<?php
/**
 * Activity helper functions.
 *
 * @package    BuddyBlog_Pro
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.3.1
 */

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Checks if activity recording is enabled for the post type.
 *
 * @param string $post_type post type name.
 *
 * @return bool
 */
function bblpro_is_post_type_activity_recording_enabled( $post_type ) {
	return (bool) bblpro_get_option( $post_type . '_enable_activity', false );
}

/**
 * Formats 'new_blog_post' activity actions for BuddyBlog's post types.
 *
 * @param string $action Static activity action.
 * @param object $activity Activity data object.
 *
 * @return string Constructed activity action.
 */
function bblpro_format_activity_action_new_blog_post( $action, $activity ) {
	// Give opportunity to customize it.
	$action_string = apply_filters( 'bblpro_pre_format_activity_action_new_blog_post', null, $action, $activity );
	if ( ! is_null( $action_string ) ) {
		$action = $action_string;
	} elseif ( function_exists( 'bp_blogs_format_activity_action_new_blog_post' ) ) {
		// fallback on BuddyPress.
		$action = bp_blogs_format_activity_action_new_blog_post( $action, $activity );
	}

	return $action;
}
