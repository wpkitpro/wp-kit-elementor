<?php
/**
 * Class Footer Settings
 *
 * This class footer the settings for the WpKitElementor plugin.
 */

namespace WpKitElementor\Includes\Settings;

use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Footer_Settings extends Tab_Base {
	public function get_id() {
		return 'wpkit-elementor-footer-settings';
	}

	public function get_title() {
		return esc_html__( 'Site Footer', 'wp-kit-elementor' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {

	}

	public function on_save( $data ) {

	}

	public function get_additional_tab_content() {

	}
}
