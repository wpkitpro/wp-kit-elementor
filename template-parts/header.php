<?php
/**
 * Displays the site header.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description', 'display' );
?>
<header id="masthead" class="site-header" role="banner">
	<div class="site-logo">
		<?php if ( has_custom_logo() ): ?>
			<?php the_custom_logo(); ?>
		<?php elseif ( $blog_name ): ?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				   title="<?php esc_html_e( 'Home', 'wpkit-elementor' ); ?>"
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
		 aria-label="<?php esc_attr_e( 'Primary menu', 'wpkit-elementor' ); ?>"
	>
		<?php if ( has_nav_menu( 'primary' ) ) { ?>
			<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
		<?php } // Endif has_nav_menu('primary') ?>
	</nav>
</header>
