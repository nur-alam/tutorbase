<?php
/**
 * Handles all the classes initialization
 *
 * @package tutorbase
 */

namespace TUTORBASE;

defined( 'ABSPATH' ) || exit;

/**
 * Init class
 *
 * @package tutorbase
 */
final class Init {
	/**
	 * Store all the classes inside an array.
	 *
	 * @return void
	 */
	public function __construct() {
		new Setup();
		new Enqueue();
		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'tutorbase_check_for_update' ) );
	}

	/**
	 * Tutorbase_check_for_update description
	 *
	 * @param   @mixed $transient $transient description.
	 *
	 * @return  @mixed return description
	 */
	public function tutorbase_check_for_update( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		$theme_slug      = 'tutorbase';
		$current_version = wp_get_theme( $theme_slug )->get( 'Version' );

		$args = array(
			'headers' => array(
				'secret-key'   => 't344d5d71sae7dcb546b8cf55e594808',
				'Content-Type' => 'application/json',
			),
			'body'    => json_encode( array( 'product_slug' => 'tutor-base' ) ),
			'method'  => 'POST',
		);

		$product_request = wp_remote_post( 'http://localhost:10019/wp-json/themeum-products/v1/check-update', $args );

		if ( ! is_wp_error( $product_request ) ) {
			$product_request_body = json_decode( wp_remote_retrieve_body( $product_request ) );
			$tutor_base           = $product_request_body->body_response;

			if (
			version_compare( $current_version, $tutor_base->version, '<' ) &&
			isset( $tutor_base->download_url )
			) {
				$transient->response[ $theme_slug ] = array(
					'theme'       => $theme_slug,
					'new_version' => $tutor_base->version,
					'url'         => $tutor_base->url ?? '',
					'package'     => $tutor_base->download_url,
				);
			}
		}

		return $transient;
	}
}
