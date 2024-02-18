<?php
/**
 * The template for displaying dynamic header.
 *
 * @package WpKitElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_preview       = isset( $_GET['elementor-preview'] );
$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description', 'display' );
$primary_nav_menu = wp_nav_menu( [
	'theme_location' => 'primary',
	'fallback_cb'    => false,
	'echo'           => false
] );
?>
<header id="masthead" class="site-header site-header-dynamic <?php echo esc_attr( wp_kit_elementor_get_header_layout_classes() ) ?>" role="banner">
	<div class="header-inside">
		<div class="site-branding show-<?php echo wp_kit_elementor_get_settings( 'wpkit_elementor_header_logo' ) ?>">
			<?php print_r( wp_kit_elementor_get_settings( 'wpkit_elementor_header_logo_display' ) ) ?>
		</div>
	</div>
</header>
