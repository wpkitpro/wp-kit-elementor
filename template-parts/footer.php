<?php
/**
 * The template for displaying footer.
 *
 * @package WpKitElementor
 */

$theme_name   = wp_get_theme()->get( 'Name' );
$theme_author = wp_get_theme()->get( 'Author' );
$theme_url    = wp_get_theme()->get( 'AuthorURI' );

$footer_nav_menu = wp_nav_menu( array(
	'theme_location' => 'footer',
	'fallback_cb'    => false,
	'echo'           => false,
) );
?>
<footer id="colophon" class="site-footer">
	<div class="footer-inside">
		<?php if ( $footer_nav_menu ): ?>
			<nav class="site-navigation">
				<?php
				// PHPCS - escaped by WordPress with "wp_nav_menu"
				echo $footer_nav_menu;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</nav>
		<?php endif; ?>

		<div class="footer-copyright">

			<div class="credit">
				<?php
				/* translators: %1$s: theme name, %2$s link, %3$s theme author */
				echo sprintf( __( '%1$s Theme by <a href="%2$s">%3$s.</a>',
					'wp-kit-elementor' ), esc_html( $theme_name ),
					esc_url( $theme_url ),
					$theme_author
				);
				?>
			</div>

		</div>
	</div>

</footer><!-- #colophon -->
