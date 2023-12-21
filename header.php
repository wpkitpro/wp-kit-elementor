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

$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description', 'display' );
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

	<header id="masthead" class="site-header" role="banner">
		<div class="site-logo">
			<?php if ( has_custom_logo() ): ?>
				<?php the_custom_logo(); ?>
			<?php elseif ( $blog_name ): ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					   title="<?php echo esc_attr__( 'Home', 'wp-kit-elementor' ); ?>"
					   rel="home"
					>
						<?php echo $blog_name; ?>
					</a>
				</h1>
				<?php if ( $blog_description ): ?>
					<p class="site-description">
						<?php echo esc_html( $blog_description ); ?>
					</p>
				<?php endif; // Endif $blog_description ?>

			<?php endif; // Endif has_custom_logo() ?>
		</div>
		<nav id="site-navigation"
			 class="primary-navigation"
			 aria-label="<?php esc_attr_e( 'Primary menu', 'wp-kit-elementor' ); ?>"
		>
			<?php if ( has_nav_menu( 'primary' ) ) { ?>
				<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
			<?php } // Endif has_nav_menu('primary') ?>
		</nav>
	</header>

	<div id="content" class="site-content">


