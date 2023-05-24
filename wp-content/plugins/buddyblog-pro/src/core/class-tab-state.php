<?php
/**
 * Tab state helper.
 *
 * @package    BuddyBlog_Pro
 * @subpackage Core
 * @copyright  Copyright (c) 2021, Brajesh Singh
 * @license    https://www.gnu.org/licenses/gpl.html GNU Public License
 * @author     Brajesh Singh
 * @since      1.0.0
 */

namespace BuddyBlog_Pro\Core;

/**
 * Tab State
 *
 * @property-read int $post_id current post id or 0.
 * @property-read string $action current action.
 * @property-read string $post_type current post state.
 * @property-read string $user_id user id for user tab else 0.
 * @property-read string $group_id group id for group tab else 0.
 */
class Tab_State {

	/**
	 * Tab state as args.
	 *
	 * @var array
	 */
	private $args = array();

	public function __construct( $args = array() ) {
		$this->args = wp_parse_args( $args, array(
			'post_id'   => 0,
			'action'    => null,
			'post_type' => null,
			'user_id'   => 0,
			'group_id'  => 0,
		) );
	}

	public function __isset( $name ) {
		return isset( $this->args[ $name ] );
	}

	public function __get( $name ) {
		return isset( $this->args[ $name ] ) ? $this->args[ $name ] : null;
	}

	/**
	 * Rebuilds state from the other tab state.
	 *
	 * @param Tab_State $tab_state tab state.
	 */
	public function from( Tab_State $tab_state ) {
		if ( $tab_state ) {
			$this->args = $tab_state->args;
		}
	}

	/**
	 * Rebuilds state to the given variables.
	 *
	 * @param array $args args.
	 */
	public function rebuild( $args = array() ) {
		$this->args = (array) $args;
	}

	/**
	 * Updates/merges state variable.
	 *
	 * @param array $args an array of state variable.
	 */
	public function set_state( $args = array() ) {
		$this->args = array_merge( $this->args, (array) $args );
	}

}
