<?php
/**
 * BuddyBlog Pro Form Type Meta box helper
 *
 * @package    BuddyBlog_Pro
 * @subpackage Admin/Metaboxes
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Admin\Metaboxes;

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Custom fields meta box helper.
 */
class Form_Type_Meta_Box extends BBL_Meta_Box {

	public function save( $post ) {

		$type = $this->input( 'form-type', 'members' );

		if ( ! $type || ! array_key_exists( $type, bblpro_get_registered_form_types() ) ) {
			$type = 'members';
		}

		// @todo add validation for allowed values.
		update_post_meta( $post->ID, '_buddyblog_form_type', $type );
	}

	public function render( $post = null ) {
		$selected = bblpro_get_form_type( $post->ID );

		$options = bblpro_get_registered_form_types();

		?>
		<div id="bbl-admin-form-type-wrapper" class="bbl-form-fields bbl-admin-form-type-wrapper">
            <div class="bbl-row bbl-row-form-types">
                <label class="bbl-label bbl-label-form-type bbl-col-left">
					<?php _e( 'Form Type:', 'buddyblog-pro' ); ?>
                    <span class="bbl-required">*</span>
                </label>
                <div class="bbl-col-right">
	                <?php $this->selectbox( array(
		                'name' => 'bbl-input-form-type',
		                'selected' => $selected,
		                'options' =>$options,
	                ));?>
                </div>
            </div><!-- end of row -->
		</div>
		<?php
	}
}