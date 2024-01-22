<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WpKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
</div><!-- #content -->

<?php get_template_part( 'template-parts/footer' ); ?>

</div><!-- #page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
