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
	}
}
