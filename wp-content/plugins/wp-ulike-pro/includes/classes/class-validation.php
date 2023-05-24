<?php

class WP_Ulike_Pro_Validation {


	/**
	 * Safe name usage ( for url purposes )
	 *
	 * @param $name
	 *
	 * @return mixed|string
	 */
	public static function safe_name_in_url( $name ) {
		$name = strtolower( $name );
		$name = preg_replace("/'/","", $name );
		$name = stripslashes( $name );
		$name = self::normalize($name);
		$name = rawurldecode( $name );
		return $name;
	}

	/**
	 * Normalize a string
	 *
	 * @param $string
	 *
	 * @return mixed
	 */
	public static function normalize( $string ) {
		$string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
		return $string;
	}

	/**
	 * Extract username from email
	 *
	 * @param $email
	 *
	 * @return string
	 */
	public static function extract_username_from_email( $email ) {
		$username = str_replace( '@', '', $email );
		if ( ( $pos = strrpos( $username, '.' ) ) !== false ) {
			$search_length = strlen( '.' );
			$username = substr_replace( $username, '-', $pos, $search_length );
		}
		return $username;
	}

}