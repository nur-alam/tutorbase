<?php
/**
 * All helper functions.
 *
 * @package Tutorowl
 */

namespace Tutorowl;

use WP_Error;

/**
 * Helper class
 */
class Helpers {
	/**
	 * Register default hooks and actions for WordPress
	 */
	public function __construct() {
	}

	/**
	 * Get template list
	 *
	 * @return array
	 */
	public static function get_template_list() {
		$template_response = file_get_contents( TEMPLATE_LIST_ENDPOINT );
		$templates         = json_decode( $template_response, true );
		try {
			return $templates;
		} catch ( \Throwable $th ) {
			return array();
		}
	}

	/**
	 * Sanitize post request
	 *
	 * @param sting  $key key.
	 * @param string $default_value default value.
	 * @param string $callback sanitization callback.
	 *
	 * @return mixed
	 */
	public static function tutorowl_sanitize_post( $key, $default_value = '', $callback = 'sanitize_text_field' ) {
		//phpcs:ignore
		if ( isset( $_POST[ $key ] ) ) {
			//phpcs:ignore
			return call_user_func( $callback, wp_unslash( $_POST[ $key ] ) );
		}
		return $default_value;
	}
}
