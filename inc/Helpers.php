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
		// $template_response       = wp_remote_get( TEMPLATE_LIST_ENDPOINT );
		$template_response = file_get_contents( TEMPLATE_LIST_ENDPOINT );
		// $templates_response_body = wp_remote_retrieve_body( $template_response );
		// $templates               = json_decode( $templates_response_body, true );
		$templates               = json_decode( $template_response, true );
		try {
			// $template_response = wp_remote_post( TEMPLATE_LIST_ENDPOINT );
			// $template_response = new WP_Error( 'Template Not available' );
			// if ( is_wp_error( $template_response ) ) {
			// 	$error_message = $template_response->get_error_message();
			// 	return array();
			// 	// echo "Something went wrong: $error_message";
			// }
			// $template_response_body = wp_remote_retrieve_body( $template_response );
			// $templates              = json_decode( $template_response_body, true );
			// return $templates['body_response'] ?? array();
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
