<?php
/**
 * Elementor Functions
 *
 * @package WpKitElementor
 */

use Elementor\Plugin;
use Elementor\Core\Kits\Documents\Kit;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Initializes the settings for WPKitElementor.
 *
 * This method registers the header settings tab in the Elementor kit registration
 * if the wp_kit_elementor_display_header() function returns true.
 *
 * @return void
 * @since 1.0.0
 */
function wp_kit_elementor_settings_init() {
	require 'settings/class-settings-header.php';
	require 'settings/class-settings-footer.php';

	add_action( 'elementor/kit/register_tabs', function ( Kit $kit ) {
		if ( ! wp_kit_elementor_display_header() ) {
			return;
		}

		$kit->register_tab( 'wpkit-elementor-header-settings', WpKitElementor\Includes\Settings\Header_Settings::class );
		$kit->register_tab( 'wpkit-elementor-footer-settings', WpKitElementor\Includes\Settings\Footer_Settings::class );
	}, 1, 40 );
}

add_action( 'elementor/init', 'wp_kit_elementor_settings_init' );

if ( ! function_exists( 'wp_kit_elementor_display_header' ) ) {
	/**
	 * Sets the value of the wpkit_elementor_header variable to true and returns it after applying the 'wp_kit_elementor_header' filter.
	 *
	 * @return bool Returns the value of the wpkit_elementor_header variable after applying the 'wp_kit_elementor_header' filter.
	 */
	function wp_kit_elementor_display_header() {
		$wpkit_elementor_header = true;

		return apply_filters( 'wp_kit_elementor_header', $wpkit_elementor_header );
	}
}

if ( ! function_exists( 'wp_kit_elementor_get_settings' ) ) {
	/**
	 * Retrieves the value of a specific setting from the global $wp_kit_elementor_settings variable after applying a filter.
	 *
	 * @param   string  $setting_id  The ID of the setting to retrieve.
	 *
	 * @return mixed Returns the value of the specified setting after applying the 'wp_kit_elementor_{setting_id}' filter.
	 * @since 1.0.0
	 */
	function wp_kit_elementor_get_settings( $setting_id ) {
		global $wp_kit_elementor_settings;

		$setting = '';

		if ( ! $wp_kit_elementor_settings['kit_settings'] ) {
			$the_kit = Plugin::$instance->kits_manager->get_active_kit();

			$wp_kit_elementor_settings['kit_settings'] = $the_kit->get_settings();
		}

		if ( isset( $wp_kit_elementor_settings['kit_settings'][ $setting_id ] ) ) {
			$setting = $wp_kit_elementor_settings['kit_settings'][ $setting_id ];
		}

		return apply_filters( 'wp_kit_elementor_' . $setting_id, $setting );
	}
}

/**
 * Dynamic Header Classes
 */
if ( ! function_exists( 'wp_kit_elementor_get_header_layout_classes' ) ) {
	/**
	 * Returns a string of layout classes based on the value of the wpki_elementor_header_layout and wpki_elementor_header_width settings.
	 *
	 * @return string Returns a string of layout classes based on the value of the wpki_elementor_header_layout and wpki_elementor_header_width settings.
	 * @since 1.0.0
	 */
	function wp_kit_elementor_get_header_layout_classes() {
		$layout_classes = [];

		$header_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_layout' );
		if ( $header_layout === 'inverted' ) {
			$layout_classes[] = 'header-inverted';
		} elseif ( $header_layout === 'centered' ) {
			$layout_classes[] = 'header-centered';
		}

		$header_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_position' );
		if ( $header_layout === 'sticky' ) {
			$layout_classes[] = 'header-sticky';
		}

		$header_layout = wp_kit_elementor_get_settings( 'wpkit_elementor_header_width' );
		if ( $header_layout === 'full-width' ) {
			$layout_classes[] = 'header-full-width';
		}

		return implode( ' ', $layout_classes );
	}
}
