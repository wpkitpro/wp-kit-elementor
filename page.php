<?php
/**
 * The template for displaying all single posts
 *
 * @package WPKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/header/page-header' );
			get_template_part( 'template-parts/content/content-page' );
		}
		?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); ?>
