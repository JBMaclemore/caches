<?php
/**
 * Single Post template page used if the post is shown on profile
 *
 * @package    BuddyBlog_Pro
 * @subpackage Templates/default/default
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

$attachment_id = bp_action_variable( 2 );
if ( ! $attachment_id || ! is_numeric( $attachment_id ) || ! get_post( $attachment_id ) ) {
	return;
}
$query_args = array(
	'author'        => bp_displayed_user_id(),
	'post_type'     => 'attachment',
	'post_parent'   => bblpro_get_queried_post_id(),
	'attachment_id' => $attachment_id,
);
$query      = new WP_Query( $query_args );
global $post;
if ( $query->have_posts() ) :
	while ( $query->have_posts() ) :
		$query->the_post();
		// Important: Do not remove it. It is used to unhook BuddyPress Theme compatibility comment closing function.
		do_action( 'bblpro_before_blog_post' );
		?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
				<?php
				the_content( __( 'Continue reading', 'buddyblog-pro' ) );

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'buddyblog-pro' ),
						'after'  => '</div>',
					)
				);
				?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <div class="entry-meta-box">
                    <span><?php printf( _x( 'by %s', 'Post written by...', 'buddyblog-pro' ), bp_core_get_userlink( $post->post_author ) ); ?></span>
					<?php _e( 'on', 'buddyblog-pro' ); ?>
                    <span class="date"><?php printf( __( '%1$s <span>in %2$s</span>', 'buddyblog-pro' ), get_the_date(), get_the_category_list( ', ' ) ); ?></span>
					<?php the_tags( '<span class="tags">' . __( 'Tags: ', 'buddyblog-pro' ), ', ', '</span>' ); ?> |
                    <span class="comments"><?php comments_popup_link( __( 'No Comments &#187;', 'buddyblog-pro' ), __( '1 Comment &#187;', 'buddyblog-pro' ), __( '% Comments &#187;', 'buddyblog-pro' ) ); ?></span>

                </div>


                <div class="post-actions">
					<?php // echo bblpro_get_post_edit_link( get_the_ID() ); ?>
					<?php //echo bblpro_get_post_delete_link( get_the_ID() ); ?>
                </div>

            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->
		<?php //comments_template( '/comments.php' ); ?>

		<?php
		// used to hook back BuddyPress Theme compatibility comment closing function.
		do_action( 'bblpro_after_blog_post' );
		?>

	<?php endwhile; ?>
	<?php
	wp_reset_postdata();
	wp_reset_query();
	?>
<?php else : ?>
    <p> <?php _e( 'No Posts found!', 'buddyblog-pro' ); ?></p>
<?php endif; ?>
