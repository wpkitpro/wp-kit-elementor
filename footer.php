<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$theme_name   = wp_get_theme()->get( 'Name' );
$theme_author = wp_get_theme()->get( 'Author' );
$theme_url    = 'https://wpkit.pro/';
?>
</main><!-- #main -->

<footer id="colophon" class="site-footer">

	<div class="footer-copyright">

		<div class="credit">
			<?php
			/* translators: %1$s: theme name, %2$s link, %3$s theme author */
			echo sprintf( __( '%1$s Theme by <a href="%2$s">%3$s.</a>',
				'wpkit-elementor' ), esc_html( $theme_name ),
				esc_url( $theme_url ),
				$theme_author
			);
			?>
		</div>

	</div>

</footer><!-- #colophon -->
</div><!-- #page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
