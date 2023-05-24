<?php
/**
 * Shortcode helper functions
 *
 * @package    BuddyBlog_Pro
 * @subpackage Core
 * @copyright  Copyright (c) 2021, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Returns the page id associated with the post type create screen.
 *
 * @param $post_type
 *
 * @return mixed
 */
function bblpro_get_create_page_id( $post_type ) {
	return bblpro_get_option( $post_type . '_create_page_id', 0 );
}

/**
 * Check if a dedicated create page enabled for this post type.
 *
 * @param string $post_type post type.
 *
 * @return bool
 */
function bblpro_has_create_page_enabled( $post_type ) {
	return (bool) bblpro_get_create_page_id( $post_type );
}

/**
 * Checks if the given page is associated with one of the create pags.
 *
 * @param int $page_id page id to be tested for associated creation page.
 *
 * @return bool
 */
function bblpro_is_shortcode_associated_create_page( $page_id ) {

	if ( ! $page_id ) {
		return false;
	}

	return in_array( (int) $page_id, bblpro_get_shortcode_associated_create_pages(), true );
}

/**
 * Retrieves a list of associated pages with create form shortcode.
 *
 * @return array
 */
function bblpro_get_shortcode_associated_create_pages() {

	$page_ids           = array();
	$enabled_post_types = bblpro_get_enabled_post_types();
	foreach ( $enabled_post_types as $post_type ) {

		if ( ! bblpro_is_post_type_enabled( $post_type ) ) {
			continue;
		}

		$page_id = bblpro_get_option( "{$post_type}_create_page_id", 0 );

		if ( $page_id ) {
			$page_ids[] = (int) $page_id;
		}
	}

	return $page_ids;
}
