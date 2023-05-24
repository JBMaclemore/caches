<?php
/**
 * Iframe field
 *
 * @package    BuddyBlog_Pro
 * @subpackage Bootstrap
 * @copyright  Copyright (c) 2022, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh, Ravi Sharma
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Core\Fields;

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;


/**
 * Iframe Field implementation
 */
class BBL_Field_Type_Iframe extends BBL_Field_Type {

	/**
	 * Constructor.
	 *
	 * @param array $args args.
	 */
	public function __construct( $args = array() ) {

		$args = wp_parse_args(
			$args,
			array(
				'type'        => 'iframe',
				'label'       => _x( 'Iframe/Embed', 'Field type label', 'buddyblog-pro' ),
				'description' => _x( 'Iframe embed field.', 'Field type label', 'buddyblog-pro' ),
				'supports'    => array( 'settings' => false ),
			)
		);
		parent::__construct( $args );
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

		if ( is_null( $meta_value ) ) {
			$sanitized = $this->get_default_field_value( $field_settings );
		} else {
			$allowed_html = array(
				'iframe' => array(
					'src'             => true,
					'width'           => true,
					'height'          => true,
					'frameborder'     => true,
					'marginwidth'     => true,
					'marginheight'    => true,
					'scrolling'       => true,
					'title'           => true,
					'allow'           => true,
					'allowfullscreen' => true,
				),
			);

			$sanitized = wp_kses( $meta_value, $allowed_html );
		}

		return $sanitized;
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
	    return true; // always say valid or should we compare filtered value?
	}

	/**
	 * Edit field markup for front end forms.
	 *
	 * @param array $args args.
	 */
	public function edit_field_markup( $args ) {

		$atts = array(
			'type'        => $this->type,
			'name'        => $args['name'],
			'id'          => $args['id'],
			'value'       => $args['value'],
			'placeholder' => $args['placeholder'],
		);
		?>

		<label for='<?php echo $atts["id"]; ?>' class='bbl-field-label bbl-field-label-type-<?php echo esc_attr( $atts["type"] ); ?> bbl-field-label-field-<?php echo esc_attr( $atts["id"] ); ?>'>
			<?php echo $args['label']; ?>
			<?php echo $args['required']; ?>
		</label>
        <textarea  <?php echo $this->get_html_attributes( $atts ); ?> ><?php echo esc_textarea( $args['value'] ); ?></textarea>
		<?php
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
}
