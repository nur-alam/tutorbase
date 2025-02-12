<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tutorowl
 */

if ( ! is_active_sidebar( 'tutorowl-sidebar-1' ) ) {
	return;
}
?>

<aside id="tutorowl-sidebar" class="tutorowl-widget-area">
	<?php dynamic_sidebar( 'tutorowl-sidebar-1' ); ?>
</aside><!-- #secondary -->
