<?php
/**
 * Class Settings.
 * This class is responsible for handling settings related operations.
 * https://wpturbo.dev/generators/settings-page/
 *
 * @package WpKitElementor
 */

namespace WpKitElementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class WPKit_Settings
 */
if ( ! class_exists( 'WPKit_Settings' ) ) {
	class WPKit_Settings {
		/**
		 * @var WPKit_Settings $instance Description of $instance variable.
		 */
		private static $instance;

		/**
		 * Represents the capability required to manage options within the system.
		 *
		 * @var string $capability The capability required to manage options.
		 */
		protected string $capability = 'manage_options';


		/**
		 * Represents an array of fields.
		 *
		 * @var array $fields An array of fields.
		 */
		private $fields = array(
			array(
				'id'          => 'disable-desc-meta',
				'label'       => 'Disable description meta tag',
				'description' => 'Disable the description meta tag in singular content pages that contain an excerpt.',
				'type'        => 'checkbox',
			),
			array(
				'id'          => 'disable-skip-link',
				'label'       => 'Disable skip link',
				'description' => 'Disable the "Skip to content" link used by screen-readers and users navigating with a keyboard.',
				'type'        => 'checkbox',
			),
			array(
				'id'          => 'disable-header-footer',
				'label'       => 'Disable header & footer',
				'description' => 'Disable the header & footer sections from all pages, and their CSS/JS files.',
				'type'        => 'checkbox',
			),
			array(
				'id'          => 'disable-page-title',
				'label'       => 'Disable page title',
				'description' => 'Disable the section above the content that contains the main heading of the page.',
				'type'        => 'checkbox',
			),
			array(
				'id'          => 'disable-style-css',
				'label'       => 'Unregister style.css',
				'description' => 'Disable WpKit Elementor template style.css file which contains CSS reset rules for unified cross-browser view.',
				'type'        => 'checkbox',
			),
			array(
				'id'          => 'disable-theme-css',
				'label'       => 'Unregister theme.css',
				'description' => 'Disable WpKit Elementor template theme.css file which contains CSS rules that style WordPress elements.',
				'type'        => 'checkbox',
			)
		);

		/**
		 * Retrieves the instance of the class if it exists, otherwise instantiates a new instance.
		 *
		 * @return WPKit_Settings The instance of the class.
		 *
		 * @static 1.0.1
		 */
		static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor method for the class.
		 *
		 * This method initializes the object and registers the wpkit_elementor_settings_init
		 * and wpkit_elementor_options_page methods as actions for the admin_init and admin_menu hooks respectively.
		 *
		 * @return void
		 * @static 1.0.0
		 */
		public function __construct() {
			/**
			 * Current object instance.
			 *
			 * @var self
			 */
			add_action( 'admin_init', [ $this, 'wpkit_elementor_settings_init' ] );
			add_action( 'admin_menu', [ $this, 'wpkit_elementor_options_page' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'wpkit_elementor_admin_scripts' ] );
		}

		/**
		 * Initializes the wpkit_elementor_settings_init method.
		 *
		 * This method is responsible for registering a new setting for the wpkit-settings page,
		 * adding a new section and registering all the fields for that section.
		 *
		 * @return void
		 * @static 1.0.0
		 */
		public function wpkit_elementor_settings_init() {
			// Register a new setting this page.
			register_setting( 'wpkit-settings', 'wpkit_options' );

			// Register a new section.
			add_settings_section(
				'wpkit-settings-section',
				esc_html__( '', 'wp-kit-elementor' ),
				[ $this, 'wpkit_render_section' ],
				'wpkit-settings'
			);

			/* Register All The Fields. */
			foreach ( $this->fields as $field ) {
				add_settings_field(
					$field['id'],
					esc_html__( $field['label'], 'wp-kit-elementor' ),
					[ $this, 'wpkit_render_field' ],
					'wpkit-settings',
					'wpkit-settings-section',
					[
						'label_for' => $field['id'],
						'class'     => 'wpkit_row',
						'field'     => $field
					]
				);
			}
		}

		/**
		 * Creates the theme options page in the WordPress admin panel.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function wpkit_elementor_options_page() {
			add_theme_page(
				esc_html__( 'Theme Settings', 'wp-kit-elementor' ),
				esc_html__( 'Theme Settings', 'wp-kit-elementor' ),
				$this->capability,
				'wpkit-settings',
				[ $this, 'wpkit_render_options_page' ],
			);
		}

		/**
		 * Render the options page.
		 *
		 * This method checks if the current user has the required capability to access the options page.
		 * If the user does not have the capability, the method returns.
		 *
		 * If the 'settings-updated' parameter is set in the URL, a success message is added to the settings errors.
		 *
		 * The method then outputs the HTML markup for the options page.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function wpkit_render_options_page() {
			if ( ! current_user_can( $this->capability ) ) {
				return;
			}

			if ( isset( $_GET['settings-updated'] ) ) {
				add_settings_error( 'wpkit_messages', 'wpkit_messages', esc_html__( 'Settings Saved', 'wp-kit-elementor' ) );
			}

			settings_errors( 'wpkit_messages' );
			?>
			<div id="wpkit-elementor-settings">
				<div class="wpkit-header">
					<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				</div>
				<div class="wrap">
					<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
					<div class="description"></div>
					<form action="options.php" method="post">
						<?php
						settings_fields( 'wpkit-settings' );
						do_settings_sections( 'wpkit-settings' );
						submit_button( esc_html__( 'Save Settings', 'wp-kit-elementor' ) );
						?>
					</form>
				</div>
			</div>
			<?php
		}

		/**
		 * Renders a form field based on the specified arguments.
		 *
		 * @param   array  $args  An associative array containing the field information.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function wpkit_render_field( array $args ) {
			$field = $args['field'];

			// Get the value of the setting we've registered with register_setting()
			$options = get_option( 'wpkit_options' );

			switch ( $field['type'] ) {
				case "text":
					{
						?>
						<input
							type="text"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "textarea":
					{
						?>
						<textarea
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
						><?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?></textarea>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "checkbox":
					{
						?>
						<input
							type="checkbox"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="1"
							<?php echo isset( $options[ $field['id'] ] ) ? checked( $options[ $field['id'] ], 1, false ) : ( '' ) ?>
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "select":
					{
						?>
						<select
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
						>
							<?php foreach ( $field['options'] as $val => $option ) {
								?>
								<option
									value="<?php echo $val ?>"
									<?php echo isset( $options[ $field['id'] ] ) ? selected( $options[ $field['id'] ], $val, false ) : ( '' ) ?>
								>
									<?php echo $option ?>
								</option>
								<?php
							} ?>
						</select>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "password":
					{
						?>
						<input
							type="password"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "wysiwyg":
					{
						wp_editor(
							$options[ $field['id'] ] ?? '',
							$field['id'],
							array(
								'textarea_name' => 'wpkit_options[' . $field['id'] . ']',
								'textarea_rows' => 5
							)
						);
						?>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php

					}
					break;
				case "email":
					{
						?>
						<input
							type="email"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "url":
					{
						?>
						<input
							type="url"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "color":
					{
						?>
						<input
							type="color"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "data":
					{
						?>
						<input
							type="date"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
				case "datetime-local":
					{
						?>
						<input
							type="datetime-local"
							id="<?php echo esc_attr( $field['id'] ) ?>"
							name="wpkit_options[<?php echo esc_attr( $field['id'] ) ?>]"
							value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : '' ?>"
						>
						<p class="description">
							<?php esc_html_e( $field['description'], 'wp-kit-elementor' ); ?>
						</p>
						<?php
					}
					break;
			}
		}

		/**
		 * Renders a section with the specified arguments.
		 *
		 * This method takes in an array of arguments and uses them to render a section on the page. The section contains a paragraph
		 * element with the ID specified in the arguments array, and displays the localized string 'Theme Settings'.
		 *
		 * @param   array  $args  An array of arguments for rendering the section.
		 *                        - id (string) The ID of the paragraph element.
		 *
		 * @return void
		 */
		public function wpkit_render_section( array $args ) {
			?>
			<p id="<?php echo esc_attr( $args['id'] ) ?>">
				<?php esc_attr_e( 'Theme Settings', 'wp-kit-elementor' ); ?>
			</p>
			<?php
		}

		/**
		 * Enqueues the admin styles for the WPKit Elementor plugin.
		 *
		 * This method is hooked to the admin_enqueue_scripts action and adds the custom-admin-styles
		 * stylesheet to the list of stylesheets to be enqueued for the admin area. The stylesheet is
		 * located in the current theme's directory and has a version number of 1.0.0.
		 *
		 * @return void
		 * @static 1.0.0
		 */
		public function wpkit_elementor_admin_scripts() {
			wp_enqueue_style( 'wpkit-admin-styles', get_stylesheet_directory_uri() . '/admin.min.css', '', '1.0.0' );
			// wp_enqueue_script( 'wpkit-admin-script', get_stylesheet_directory_uri() . '/assets/js/kit-admin.js', array(), '1.0.0' );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
WPKit_Settings::get_instance();
