<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page-wrapper" class="site-page">

	<a class="skip-link screen-reader-text" href="#content">
		<?php esc_html_e( 'Skip to content', 'wp-kit-elementor' ); ?>
	</a>

	<?php get_template_part( 'template-parts/header' ); ?>

	<div id="content" class="site-content">


