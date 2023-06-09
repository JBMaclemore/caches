<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_extension_image' ) ) {


	/**
	 * Main ReduxFramework custom_field extension class.
	 *
	 * @since 2.0.0
	 */
	#[\AllowDynamicProperties]
	class ReduxFramework_extension_image {

		// Set the version number of your extension here.
		public static $version = '1.0.0';

		// Set the name of your extension here.
		public $ext_name = 'Image';

		// Protected vars.
		protected $parent;
		public $extension_url;
		public $extension_dir;
		public static $theInstance;

		/**
		 * Class Constructor. Defines the args for the extension class.
		 *
		 * @since  2.0.0
		 * @access public
		 *
		 * @param array $parent Parent settings.
		 */
		public function __construct( $parent ) {

			$this->parent = $parent;

			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}

			$this->field_name = 'image';

			self::$theInstance = $this;

			add_filter( 'redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array( &$this, 'overload_field_path' ) ); // Adds the local field

		}

		/**
		 * Get instance of the class.
		 *
		 * @since 2.0.0
		 *
		 * @return object
		 */
		public function getInstance() {
			return self::$theInstance;
		}

		/**
		 * Forces the use of the embeded field path vs what the core typically would use.
		 *
		 * @since 2.0.0
		 *
		 * @param string $field Field.
		 *
		 * @return string It will return override path.
		 */
		public function overload_field_path( $field ) {
			return dirname( __FILE__ ) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
		}
	} // class
} // if
