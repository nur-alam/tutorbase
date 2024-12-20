<?php
/**
 * Handles all the classes initialization
 *
 * @package Tutorowl
 */

namespace Tutorowl;

defined( 'ABSPATH' ) || exit;

/**
 * Init class
 *
 * @package Tutorowl
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
		new Helpers();
		new Ajax();
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		define( 'TEMPLATE_LIST', Helpers::get_template_list() );
	}

	/**
	 * Register main menu.
	 *
	 * @return void
	 */
	public function add_menu() {
		add_menu_page(
			'tutorowl',
			esc_html__( 'Tutor Owl', 'tutorowl' ),
			'manage_options',
			'tutorowl',
			array( $this, 'view' ),
			'',
			10
		);
	}


	/**
	 * Page view
	 *
	 * @return void
	 */
	public function view() {
		$path = TUTOROWL_PATH . '/views/dashboard.php';
		include $path;
	}
}
