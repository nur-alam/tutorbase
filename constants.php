<?php
/**
 * Constant variables.
 *
 * @package Tutorowl
 */

define( 'TUTOROWL_PATH', __DIR__ );
define( 'TUTOROWL_ASSETS_PATH', __DIR__ . '/assets' );
define( 'TUTOROWL_VERSION', '1.0.0' );
define( 'TUTOROWL_TEMPLATE_LIST_ENDPOINT', TUTOROWL_PATH . '/assets/droip-layouts.json' );


define(
	'TUTOROWL_REQUIRED_PLUGINS',
	array(
		'tutor' => array(
			'base'  => 'tutor',
			'slug'  => 'tutor',
			'path'  => 'tutor/tutor.php',
			'title' => esc_html__( 'Tutor LMS', 'tutorowl' ),
			'src'   => 'https://downloads.wordpress.org/plugin/tutor.3.0.2.zip',
			'state' => '',
		),
		'droip' => array(
			'base'  => 'droip',
			'slug'  => 'droip',
			'path'  => 'droip/droip.php',
			'title' => esc_html__( 'Droip', 'tutorowl' ),
			// 'src'   => 'https://droip.s3.amazonaws.com/dist/droip-builds/droip-1.1.1.zip',
			'src'   => 'https://github.com/nur-alam/Graph-Theory/raw/refs/heads/main/droip.zip',
			'state' => '',
		),
	)
);
