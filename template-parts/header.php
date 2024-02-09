<?php
/**
 * The template for displaying header.
 *
 * @package WpKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description', 'display' );
$primary_nav_menu = wp_nav_menu( [
	'theme_location' => 'primary',
	'fallback_cb'    => false,
	'echo'           => false
] );
?>
<header id="masthead" class="site-header" role="banner">
	<div class="site-logo site-site-branding<?php // todo: The site-logo CSS class is deprecated. The class will be deleted. ?>">
		<?php if ( has_custom_logo() && function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		} else { ?>
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
			<?php endif; } ?>
	</div>

	<?php if ( $primary_nav_menu ): ?>
		<nav class="site-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'wp-kit-elementor' ); ?>">
			<?php
			echo $primary_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</nav>
	<?php endif; ?>
</header>
