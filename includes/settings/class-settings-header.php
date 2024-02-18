<?php
/**
 * Class Header Settings
 *
 * This class handles the settings for the WpKitElementor plugin.
 */

namespace WpKitElementor\Includes\Settings;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Header_Settings extends Tab_Base {
	public function get_id() {
		return 'wpkit-elementor-header-settings';
	}

	public function get_title() {
		return esc_html__( 'Site Header', 'wp-kit-elementor' );
	}

	public function get_icon() {
		return 'eicon-header';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {
		$this->start_controls_section(
			'wpkit_elementor_header_section',
			[
				'tab'   => 'wpkit-elementor-header-settings',
				'label' => esc_html__( 'Header', 'wp-kit-elementor' ),
			]
		);

		$this->add_control(
			'wpkit_elementor_header_logo_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Site Logo', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_tagline_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Tagline', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_menu_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Menu', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_search_display',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Search', 'wp-kit-elementor' ),
				'label_on'  => esc_html__( 'Show', 'wp-kit-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wp-kit-elementor' ),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_display_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
				/* translators: %s: Link that opens the theme settings page. */
					__( 'Note: Hiding all the elements, only hides them visually. To disable them completely go to <a href="%s">Theme Settings</a>.', 'wp-kit-elementor' ),
					admin_url( 'themes.php?page=wpkit-elementor-settings' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => [
					'wpkit_elementor_header_logo_display'    => '',
					'wpkit_elementor_header_tagline_display' => '',
					'wpkit_elementor_header_menu_display'    => '',
					'wpkit_elementor_header_search_display'  => ''
				]
			]
		);

		$this->add_control(
			'wpkit_elementor_header_layout',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Layout', 'wp-kit-elementor' ),
				'options'   => [
					'default'  => esc_html__( 'Default', 'wp-kit-elementor' ),
					'inverted' => esc_html__( 'Inverted', 'wp-kit-elementor' ),
					'centered' => esc_html__( 'Centered', 'wp-kit-elementor' ),
				],
				'selector'  => '.site-header',
				'default'   => 'default',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_position',
			[
				'type'     => Controls_Manager::SELECT,
				'label'    => esc_html__( 'Position', 'wp-kit-elementor' ),
				'options'  => [
					'default' => esc_html__( 'Default', 'wp-kit-elementor' ),
					'sticky'  => esc_html__( 'Sticky', 'wp-kit-elementor' ),
				],
				'selector' => '.site-header',
				'default'  => 'default',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_width',
			[
				'type'     => Controls_Manager::SELECT,
				'label'    => esc_html__( 'Width', 'wp-kit-elementor' ),
				'options'  => [
					'boxed'      => esc_html__( 'Boxed', 'wp-kit-elementor' ),
					'full-width' => esc_html__( 'Full Width', 'wp-kit-elementor' ),
				],
				'selector' => '.site-header',
				'default'  => 'boxed',
			]
		);

		$this->add_control(
			'wpkit_elementor_header_custom_width',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Width', 'wp-kit-elementor' ),
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px'  => [
						'max' => 2000,
					],
					'em'  => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
				],
				'condition'  => [
					'wpkit_elementor_header_width' => 'boxed',
				],
				'selectors'  => [
					'.site-header .header-inside' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;'
				],
			]
		);

		$this->add_control(
			'wpkit_elementor_header_gap',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Gap', 'wp-kit-elementor' ),
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px'  => [
						'max' => 100,
					],
					'em'  => [
						'max' => 5,
					],
					'rem' => [
						'max' => 5,
					],
				],
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'wpkit_elementor_header_layout',
							'operator' => '!=',
							'value'    => 'centered'
						]
					],
				],
				'selectors'  => [
					'.site-header' => 'padding-inline-end: {{SIZE}}{{UNIT}}; padding-inline-start: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'wpkit_elementor_header_background',
				'label'    => esc_html__( 'Background', 'wp-kit-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '.site-header',
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {

	}

	public function get_additional_tab_content() {

	}
}
