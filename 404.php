<?php
/**
 * The main template file
 *
 * @package Tutorowl
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<p><?php esc_html_e( '404 page', 'tutorowl' ); ?></p>

<?php get_footer(); ?>