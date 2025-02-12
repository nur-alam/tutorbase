<?php
/**
 * Handles enqueueing all scripts and styles
 *
 * @package Tutorowl
 */

namespace Tutorowl;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue class
 */
class Enqueue {

	/**
	 * Register default hooks and actions for WordPress
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqueue general scripts.
	 *
	 * @param String $slug plugin wp assigned slug.
	 */
	public function admin_enqueue_scripts( $slug ) {
		if ( 'toplevel_page_tutorowl' === $slug ) {
			// css.
			wp_enqueue_style( 'tutorowl-main', get_template_directory_uri() . '/assets/dist/css/style.min.css', array(), filemtime( TUTOROWL_ASSETS_PATH . '/dist/css/style.min.css' ), 'all' );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// JS.
			wp_enqueue_script( 'tutorowl-main', get_template_directory_uri() . '/assets/dist/js/app.min.js', array( 'jquery' ), filemtime( TUTOROWL_ASSETS_PATH . '/dist/js/app.min.js' ), true );

			wp_add_inline_script( 'tutorowl-main', 'const tutorowl = ' . wp_json_encode( self::scripts_data() ), 'before' );
		}
	}


	/**
	 * Add inline data in scripts
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function scripts_data() {
		$data = array(
			'ajax_url'    => admin_url( 'admin-ajax.php' ),
			'nonce_value' => wp_create_nonce( 'tutorowl_nonce' ),
		);
		return apply_filters( 'tutorowl_inline_script_data', $data );
	}
}
