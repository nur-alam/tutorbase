<?php
/**
 * The header for the theme
 *
 * This is the template that displays all of the <head> section and everything up until <body>
 *
 * @package Tutorowl
 */

defined( 'ABSPATH' ) || exit;

$site_icon = get_site_icon_url();

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo esc_url( $site_icon ); ?>" rel="icon" type="image/vnd.microsoft.icon">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>