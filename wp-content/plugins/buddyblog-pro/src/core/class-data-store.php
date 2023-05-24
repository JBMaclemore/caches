<?php
/**
 * In memory Data store
 *
 * @package    BuddyBlog_Pro
 * @subpackage Core
 * @copyright  Copyright (c) 2020, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Core;

// Do not allow direct access over web.
defined( 'ABSPATH' ) || exit;

/**
 * Data store.
 */
class Data_Store {

	/**
	 * Stores arbitrary data which are accessed as dynamic property.
	 *
	 * @var array
	 */
	private $data = array();

	/**
	 * Checks if a property is set.
	 *
	 * @param string $name property name.
	 *
	 * @return bool
	 */
	public function has( $name ) {
		return isset( $this->data[ $name ] );
	}

	/**
	 * Retrieves all stored data.
	 *
	 * @return array
	 */
	public function all() {
		return $this->data;
	}

	/**
	 * Retrieves a dynamic property.
	 *
	 * @param string $name property name.
	 *
	 * @return mixed|null
	 */
	public function get( $name ) {
		return isset( $this->data[ $name ] ) ? $this->data[ $name ] : null;
	}

	/**
	 * Sets value for a dynamic property.
	 *
	 * If you prefer to use method instead of the dynamic property, use it.
	 *
	 * @param string $name property name.
	 * @param mixed  $value value.
	 */
	public function set( $name, $value ) {
		$this->data[ $name ] = $value;
	}

	/**
	 * Checks if a property is set.
	 *
	 * @param string $name property name.
	 *
	 * @return bool
	 */
	public function __isset( $name ) {
		return $this->has( $name );
	}

	/**
	 * Sets value for a dynamic property.
	 *
	 * @param string $name property name.
	 * @param mixed  $value value.
	 */
	public function __set( $name, $value ) {
		$this->set( $name, $value );
	}

	/**
	 * Retrieves a dynamic property.
	 *
	 * @param string $name property name.
	 *
	 * @return mixed|null
	 */
	public function __get( $name ) {
		return $this->get( $name );
	}

	/**
	 * Unsets a property.
	 *
	 * @param string $name dynamic property name.
	 */
	public function __unset( $name ) {
		unset( $this->data[ $name ] );
	}
}
