<?php

class WP_Ulike_Pro_Reset_Password {

	/**
	 * Validate reset password requests
	 *
	 * @return void
	 */
	public static function validate(){
		$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : 'lostpassword';

		// Prepare site for reset password
		if ( $action == 'changepassword' ) {

			$url = parse_url( $_SERVER["REQUEST_URI"], PHP_URL_PATH );
			$rp_cookie = 'wp-resetpass-' . COOKIEHASH;

			//Store Reset link data to cookie
			if ( isset( $_GET['key'] ) ) {
				$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
				self::setcookie( $rp_cookie, $value );
				wp_safe_redirect( remove_query_arg( array( 'key', 'login' ) ) );
				exit;
			}

			// Check if site has Cookie for password reset
			if ( isset( $_COOKIE[$rp_cookie] ) && 0 < strpos( $_COOKIE[$rp_cookie], ':' ) ) {
				list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[$rp_cookie] ), 2 );
				$user = check_password_reset_key( $rp_key, $rp_login );
			} else {
				$user = false;
			}

			if ( ! $user || is_wp_error( $user ) ) {
				// Delete cookie if password was reset
				self::setcookie( $rp_cookie, false );

				if ( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect( add_query_arg( array( 'action' => 'lostpassword', 'error' => 'expiredkey' ), $url )  );
					exit;
				} else {
					wp_redirect( add_query_arg( array( 'action' => 'lostpassword', 'error' => 'invalidkey' ), $url )  );
					exit;
				}
			}

		}
	}

	/**
	 * Disable page caching and set or clear cookie
	 *
	 * @param string $name
	 * @param string $value
	 */
	public static function setcookie( $rp_cookie, $value = '' ) {
		if ( ! empty( $value ) ) {
			setcookie( $rp_cookie, $value, 0, '/', COOKIE_DOMAIN, is_ssl(), true );
		} else {
			setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, '/', COOKIE_DOMAIN, is_ssl(), true );
		}
	}

	/**
	 * Get Reset URL
	 *
	 * @return bool|string
	 */
	public static function reset_url( $user_id ) {
		//new reset password key via WP native field
		$user_data = get_userdata( $user_id );
		$key = get_password_reset_key( $user_data );
		$url = WP_Ulike_Pro_Options::getResetPasswordPageUrl();
		$url = add_query_arg( array( 'action' => 'changepassword', 'key' => $key, 'login' => $user_data->user_login ), $url );

		return $url;
	}

}