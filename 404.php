<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WpKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div class="container">
	<header class="page-header alignwide">
		<h1 class="page-title">
			<?php esc_html_e( 'Nothing here', 'wp-kit-elementor' ); ?>
		</h1>
	</header>

	<div class="error-404 not-found default-max-width">
		<div class="page-content">
			<p>
				<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?',
					'wp-kit-elementor' ); ?>
			</p>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
