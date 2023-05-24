<?php
// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'bbl_bb_set_row_post_class' ) ) {

	function bbl_bb_set_row_post_class( $classes, $class, $post_id ) {

		// Condition for archive posts for elementor.
		if ( in_array( 'elementor-post elementor-grid-item', $classes ) ) {
			return $classes;
		}

		// Only apply on user pages.
		if ( ! function_exists( 'bp_is_user' ) || ! bp_is_user() ) {
			return $classes;
		}

		// Condition for archive posts for beaver themer.
		if ( in_array( 'fl-post-grid-post', $classes ) ) {
			return $classes;
		}

		global $wp_query;
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$blog_type = 'masonry'; // standard, grid, masonry.

		$blog_type = apply_filters( 'bb_blog_type', $blog_type );

		if ( is_search() ) {
			$classes[] = 'hentry search-hentry';

			return $classes;
		}

		if ( get_post_type() === 'post' || ! in_array( get_post_type(), bblpro_get_enabled_post_types() ) ) {
			return $classes;
		}

		if ( 'masonry' === $blog_type ) {
			$classes[] = ( 0 === $wp_query->current_post && 1 == $paged ) ? 'bb-grid-2-3 first' : ''; // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		} elseif ( ( 'grid' === $blog_type ) && ( ( is_archive() ) || ( is_search() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_tag() ) ) ) {
			$classes[] = ( 0 === $wp_query->current_post && 1 == $paged ) ? 'lg-grid-2-3 md-grid-1-1 sm-grid-1-1 bb-grid-cell first' : 'lg-grid-1-3 md-grid-1-2 bb-grid-cell sm-grid-1-1'; // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		} elseif ( ( is_related_posts() ) ) {
			$classes[] = 'lg-grid-1-3 md-grid-1-2 bb-grid-cell sm-grid-1-1';
		}

		// Return the array.
		return $classes;
	}

	add_filter( 'post_class', 'bbl_bb_set_row_post_class', 10, 3 );
}