<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package WP Kit Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( have_comments() ): ?>
	<h2 class="comment-title">
		<?php comments_number( esc_html__( '0 Comments', 'wpkit-elementor' ),
			esc_html__( 'One Comment', 'wpkit-elementor' ),
			esc_html__( '% Comments', 'wpkit-elementor' ) );
		?>
	</h2>

	<ul class="commentslist">
		<?php wp_list_comments(); ?>
	</ul>

	<?php if ( get_comment_pages_count() > 1
			   && get_option( 'page_comments' )
	): ?>
		<div class="comments-nav-section">
			<p class="fl"></p>
			<p class="fr"></p>

			<div>
				<div class="default-previous">
					<?php previous_comments_link(
						'&#8592;&nbsp;' .
						esc_html__( 'One Comment', 'wpkit-elementor' )
					); ?>
				</div>

				<div class="default-next">
					<?php next_comments_link(
						esc_html__( 'Newer Comments', 'wpkit-elementor' ) .
						'&#8592;&nbsp;'
					); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; // Endif have_comments() ?>
<?php comment_form( [
	'title_reply'   => esc_html__( 'Leave a Reply', 'wpkit-elementor' ),
	'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'wpkit-elementor' ) . '</label><textarea name="comment" id="comment" cols="45" rows="8" maxlength="65525" required="required" spellcheck="false"></textarea></p>',
] ); ?>
