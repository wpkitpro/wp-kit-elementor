<?php
/**
 * The site's entry point.
 *
 * @package WpKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$elementor_theme_exist = function_exists( 'elementor_theme_do_location' );
?>

<main id="content" class="site-main">
	<?php if ( have_posts() ): ?>
		<?php
		// Loop Start
		while ( have_posts() ): the_post();
			?>
			<article id="page-<?php echo esc_attr( the_ID() ) ?>" <?php post_class( 'kit-theme-post' ); ?>>
				<div class="post-media">
					<a href="<?php echo esc_url( get_permalink() ) ?>"></a>
					<?php the_post_thumbnail(); ?>
				</div>

				<header class="post-header">
					<h2 class="post-title">
						<a href="<?php echo esc_url( get_the_permalink() ) ?>">
							<?php the_title() ?>
						</a>
					</h2>

					<?php echo '<div class="post-categories">' . get_the_category_list( ',&nbsp;&nbsp;' ) . '</div>'; ?>
				</header>

				<div class="post-content">
					<?php the_content(); ?>
				</div>

				<footer class="post-footer">
					<div class="post-meta">
						<span class="post-data"><?php the_time( get_option( 'date_format' ) ); ?></span>
						<span class="meta-sep">/</span>
						<?php comments_popup_link( esc_html__( '0 Comments', 'wp-kit-elementor' ), esc_html__( '1 Comment', 'wp-kit-elementor' ), '% ' . esc_html__( 'Comments', 'wp-kit-elementor' ) ); ?>
					</div>

					<div class="read-more">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php esc_html_e( 'read more', 'wp-kit-elementor' ); ?>
						</a>
					</div>
				</footer>
			</article><!-- #page-<?php echo esc_attr( the_ID() ) ?>-->
		<?php
		endwhile; // Loop End
		?>
	<?php else: ?>
		<div class="no-result-found">
			<h3><?php esc_html_e( 'Nothing Found!', 'wp-kit-elementor' ); ?></h3>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp-kit-elementor' ); ?></p>
			<div class="ashe-widget widget_search">
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php

	endif; // Endif have_posts()

	// Pagination
	the_posts_pagination();
	?>
</main><!-- #main -->

<?php get_footer(); ?>
