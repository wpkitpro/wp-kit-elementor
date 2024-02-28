<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
<main id="content" <?php post_class( 'site-main' ); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="page-content">
		<?php the_content(); ?>

		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tagged', 'wp-kit-elementor' ), null, '</span>' ); ?>
		</div>
		<?php wp_link_pages() ?>
	</div>

	<?php comments_template(); ?>
</main>

<?php get_footer(); ?>
