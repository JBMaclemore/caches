<?php
/**
 * Gallery Field Type Helper
 *
 * @package    BuddyBlog_Pro
 * @subpackage Core\Fields
 * @copyright  Copyright (c) 2021, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Core\Fields;

// Do not allow direct access over web.
use WP_Post;

defined( 'ABSPATH' ) || exit;

/**
 * Single line text field type.
 */
class BBL_Field_Type_Gallery extends BBL_Field_Type {

	/**
	 * Constructor.
	 *
	 * @param array $args args.
	 */
	public function __construct( $args = array() ) {

		$args = wp_parse_args(
			$args,
			array(
				'type'        => 'gallery',
				'label'       => _x( 'Gallery', 'Field type label', 'buddyblog-pro' ),
				'description' => _x( 'Gallery field', 'Field type label', 'buddyblog-pro' ),
				'supports'    => array( 'settings' => false ),
			)
		);

		parent::__construct( $args );
	}

	/**
	 * Enqueue script.
	 */
	private function enqueue() {
		wp_enqueue_media();

		$buddyblog = buddyblog_pro();

		wp_register_style(
			'bbl-field-type-gallery',
			buddyblog_pro()->url . 'src/core/fields/gallery-field-helper.css',
			array(),
			$buddyblog->version
		);

		wp_register_script(
			'bbl-field-type-gallery',
			buddyblog_pro()->url . 'src/core/fields/gallery-field-helper.js',
			array( 'jquery', 'jquery-ui-selectable', 'underscore', 'bblogpro' ),
			$buddyblog->version,
			true
		);

		wp_enqueue_style( 'bbl-field-type-gallery' );
		wp_enqueue_script( 'bbl-field-type-gallery' );
	}

	/**
	 * Sanitizes value.
	 *
	 * @param mixed $meta_value meta value.
	 * @param array $field_settings meta key.
	 * @param int   $form_id form id.
	 * @param int   $post_id post id.
	 *
	 * @return mixed
	 */
	public function sanitize_value( $meta_value, $field_settings, $form_id, $post_id = 0 ) {

		if ( empty( $meta_value ) ) {
			$sanitized = array();
		} else {
			$sanitized = array_filter( (array) $meta_value );
		}

		return array_unique( $sanitized );
	}

	/**
	 * Format for display
	 *
	 * @param string $value Value.
	 * @param string $key Key.
	 * @param int    $post_id Post id.
	 *
	 * @return string
	 */
	public function format_for_display( $value, $key, $post_id ) {

		if ( empty( $value ) ) {
			return '';
		}

		$attachment_ids = array_filter( maybe_unserialize( $value ) );
		$attachment_ids = join( ',', $attachment_ids );
		return do_shortcode( "[gallery ids={$attachment_ids}]" );
	}

	/**
	 * Validates value.
	 *
	 * @param mixed $meta_value meta value.
	 * @param array $field_settings meta key.
	 * @param int   $form_id form id.
	 * @param int   $post_id post id.
	 *
	 * @return bool|\WP_Error
	 */
	public function validate_value( $meta_value, $field_settings, $form_id, $post_id = 0 ) {

		if ( empty( $meta_value ) || is_array( $meta_value ) ) {
			return true;
		} else {
			// in case of text, we accept everything(or should we check is_scalar).
			return new \WP_Error( 'invalid_value', __( 'The gallery field is invalid.', 'buddyblog-pro' ) );
		}
	}

	/**
	 * Edit field markup for front end forms.
	 *
	 * @param array $args args.
	 */
	public function edit_field_markup( $args ) {

		$atts = array(
			'type'  => 'hidden',
			'name'  => $args['name'] . '[]',
			'id'    => $args['id'],
			'value' => $args['value'],
		);

		$attachment_ids = empty( $atts['value'] ) ? array() : array_filter( maybe_unserialize( $atts['value'] ) );
        // phpcs:disable
		?>

		<label for='<?php echo $atts["id"]; ?>' class='bbl-field-label bbl-field-label-type-<?php echo esc_attr( $atts["type"] ); ?> bbl-field-label-field-<?php echo esc_attr( $atts["id"] ); ?>'>
			<?php echo $args['label']; ?>
			<?php echo $args['required']; ?>
		</label>

        <div class="bbl-field-type-<?php echo esc_attr( $this->type ); ?>-wrap">
            <p class="bblpro-add-gallery-images-btn-wrap hide-if-no-js">
                <a href="#" data-choose="<?php esc_attr_e( 'Add images to gallery', 'buddyblog-pro' ); ?>"
                   data-update="<?php esc_attr_e( 'Add to gallery', 'buddyblog-pro' ); ?>"
                   data-delete="<?php esc_attr_e( 'Delete', 'buddyblog-pro' ); ?>">
					<?php esc_html_e( 'Add gallery images', 'buddyblog-pro' ); ?></a>
            </p>
            <ul class="bblpro-field-type-gallery-images-list" data-gallery-field-name="<?php echo esc_attr(  $atts['name'] ); ?>">
				<?php if ( ! empty( $attachment_ids ) ) : ?>
					<?php foreach ( $attachment_ids as $attachment_id ) : ?>
                        <li class="bbl-gallery-media-item" data-attachment-id="<?php echo esc_attr( $attachment_id ); ?>">
							<?php echo wp_get_attachment_image( $attachment_id, 'thumbnail' ); ?>
                            <a href="#" class="delete tips">x</a>
                            <input type="hidden" class="bblpro-gallery-hidden-media-id" name="<?php echo esc_attr(  $atts['name'] ); ?>" value="<?php echo esc_attr( $attachment_id ); ?>">
                        </li>
					<?php endforeach; ?>
				<?php endif; ?>
            </ul>
        </div>

		<?php $this->enqueue(); ?>
		<?php
		// phpcs:enable
	}

	/**
	 * Field settings Args.
	 *
	 * @param array $args args.
	 */
	public function admin_field_settings_markup( $args = array() ) {
	}

	/**
	 * Prepare Field settings for saving in the form management page.
	 *
	 * @param int    $form_id form id.
	 * @param string $key field key.
	 * @param array  $settings field settings.
	 *
	 * @return \WP_Error|array
	 */
	public function prepare_settings( $form_id, $key, $settings ) {
		return $this->prepare_common_field_settings( $form_id, $key, $settings );
	}

	/**
	 * Save field value
	 *
	 * @param int    $post_id Post id.
	 * @param string $meta_key Meta key.
	 * @param string $meta_value Meta value.
	 * @param array  $field_settings Field settings.
	 *
	 * @return string|void
	 */
	public function save_value( $post_id, $meta_key, $meta_value, $field_settings ) {
		parent::save_value( $post_id, $meta_key, $meta_value, $field_settings );

		if ( empty( $meta_value ) ) {
			return '';
		}

		$attachment_ids = array_filter( maybe_unserialize( $meta_value ) );
		$post = get_post( $post_id );

		foreach ( $attachment_ids as $attachment_id ) {
			$this->update_attachment( $attachment_id, $post );
		}
	}

	/**
	 * Update attachment
	 *
	 * @param int $attachment_id Post id.
	 * @param WP_Post $post Post object.
	 */
	private function update_attachment( $attachment_id, $post ) {
		global $wpdb;


		$attachment = get_post( $attachment_id );
		// if attachment parent is set and is set to auto-draft, update the parent ids.
		if ( $post->post_author == $attachment->post_author && $attachment->post_parent && get_post_status( $attachment->post_parent ) === 'auto-draft' ) {
			$query = $wpdb->prepare( "UPDATE {$wpdb->posts} SET post_parent=%d WHERE ID = %d", $post->ID, $attachment_id );
			$wpdb->query( $query );
			clean_post_cache( $attachment );
		}
	}
}
