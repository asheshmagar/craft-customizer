<?php
/**
 *
 */

namespace Customind;

use WP_Customize_Manager;
use Customind\Types\Panel;
use Customind\Types\Control;

class Core {

	/**
	 * Singleton instance.
	 * @var null
	 */
	private static $instance = null;

	/**
	 * Control dependencies.
	 *
	 * Conditions for the control to be displayed.
	 *
	 * @var array
	 */
	public $dependencies = array();

	/**
	 * Control group configs
	 * @var array
	 */
	public $group_configs = array();

	/**
	 * Get instance of this class.
	 *
	 * @return Core|null
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @return void
	 */
	private function __wakeup() {}

	/**
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Constructor.
	 */
	private function __construct() {
		add_action( 'customize_register', array( $this, 'init' ), PHP_INT_MAX - 1 );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue Scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		$controls_asset_file   = __DIR__ . '/assets/build/controls.asset.php';
		$customizer_asset_file = __DIR__ . '/assets/build/customizer.asset.php';
		$controls_asset        = array(
			'dependencies' => array(),
			'version'      => time(),
		);
		$customizer_asset      = array(
			'dependencies' => array(),
			'version'      => time(),
		);

		if ( file_exists( $controls_asset_file ) ) {
			$controls_asset = require $controls_asset_file;
		}

		if ( file_exists( $customizer_asset_file ) ) {
			$customizer_asset = require $customizer_asset_file;
		}

		wp_enqueue_script( 'customind-customizer', $this->get_assets_url() . '/assets/build/customizer.js', $customizer_asset['dependencies'], $customizer_asset['version'], true );

		wp_enqueue_editor();
		wp_enqueue_media();
		wp_enqueue_script( 'customind-controls', $this->get_assets_url() . '/assets/build/controls.js', $controls_asset['dependencies'], $controls_asset['version'], true );
		wp_enqueue_style( 'customind-controls', $this->get_assets_url() . '/assets/build/controls.css', array( 'wp-components' ), $controls_asset['version'] );
		//      wp_localize_script(
		//          'customind-controls',
		//          '_CUSTOMIND_',
		//          array(
		//              'contexts' => $this->get_contexts(),
		//          )
		//      );
	}

	/**
	 * Get assets URL.
	 *
	 * @return string
	 */
	public function get_assets_url() {
		$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
		$content_dir = wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) );
		$url         = str_replace( $content_dir, $content_url, wp_normalize_path( __DIR__ ) );
		return set_url_scheme( $url );
	}

	/**
	 * Init.
	 *
	 * Register panel, section, control and setting.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function init( $wp_customize ) {
		$this->register( $wp_customize );
		$this->override_defaults( $wp_customize );
		$this->add_controls();
		$this->get_customizer_configs( $wp_customize );
		$this->register_customize_settings( $wp_customize );
	}

	/**
	 * Register custom panel and section.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	private function register( $wp_customize ) {
		$wp_customize->register_panel_type( 'Customind\Types\Panel' );
		$wp_customize->register_section_type( 'Customind\Types\Section' );
		$wp_customize->register_section_type( 'Customind\Types\SeparatorSection' );
		$wp_customize->register_section_type( 'Customind\Types\UpsellSection' );
	}

	/**
	 * Override default settings.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	private function override_defaults( $wp_customize ) {
		if ( current_theme_supports( 'custom-background' ) ) {
			remove_filter( 'customize_sanitize_background_color', $wp_customize->get_setting( 'background_color' )->sanitize_callback );
			$wp_customize->get_setting( 'background_color' )->sanitize_callback = array( 'Customind\Sanitize', 'sanitize_alpha_color' );
			add_filter( 'customize_sanitize_background_color', array( 'Customind\Sanitize', 'sanitize_alpha_color' ), 10, 2 );
		}

		if ( current_theme_supports( 'custom-header' ) ) {
			remove_filter( 'customize_sanitize_header_textcolor', $wp_customize->get_setting( 'background_color' )->sanitize_callback );
			$wp_customize->get_setting( 'header_textcolor' )->sanitize_callback = array( 'Customind\Sanitize', 'sanitize_alpha_color' );
			add_filter( 'customize_sanitize_header_textcolor', array( 'Customind\Sanitize', 'sanitize_alpha_color' ), 10, 2 );
		}
	}

	/**
	 * Add custom controls.
	 *
	 * @return void
	 */
	private function add_controls() {
		$controls = array(
			'checkbox'                      => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_checkbox' ),
			),
			'radio'                         => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_radio_select' ),
			),
			'select'                        => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_radio_select' ),
			),
			'text'                          => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_nohtml' ),
			),
			'number'                        => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_number' ),
			),
			'email'                         => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_email' ),
			),
			'url'                           => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_url' ),
			),
			'textarea'                      => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_html' ),
			),
			'dropdown-pages'                => array(
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_dropdown_pages' ),
			),
			'color'                         => array(
				'callback'          => 'WP_Customize_Color_Control',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_hex_color' ),
			),
			'image'                         => array(
				'callback'          => 'WP_Customize_Image_Control',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_image_upload' ),
			),
			'customind-radio-image'         => array(
				'callback'          => 'Customind\Controls\RadioImageControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_radio_select' ),
			),
			'customind-heading'             => array(
				'callback'          => 'Customind\Controls\HeadingControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_false_values' ),
			),
			'customind-navigate'            => array(
				'callback'          => 'Customind\Controls\NavigateControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_false_values' ),
			),
			'customind-editor'              => array(
				'callback'          => 'Customind\Controls\EditorControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_html' ),
			),
			'customind-color'               => array(
				'callback'          => 'Customind\Controls\ColorControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_alpha_color' ),
			),
			'customind-buttonset'           => array(
				'callback'          => 'Customind\Controls\ButtonsetControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_radio_select' ),
			),
			'customind-toggle'              => array(
				'callback'          => 'Customind\Controls\ToggleControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_checkbox' ),
			),
			'customind-slider'              => array(
				'callback'          => 'Customind\Controls\SliderControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_number' ),
			),
			'customind-divider'             => array(
				'callback'          => 'Customind\Controls\DividerControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_false_values' ),
			),
			'customind-dropdown-categories' => array(
				'callback'          => 'Customind\Controls\DropdownCategoriesControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_dropdown_categories' ),
			),
			'customind-custom'              => array(
				'callback'          => 'Customind\Controls\CustomControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_false_values' ),
			),
			'customind-background'          => array(
				'callback'          => 'Customind\Controls\BackgroundControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_background' ),
			),
			'customind-typography'          => array(
				'callback'          => 'Customind\Controls\TypographyControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_typography' ),
			),
			'customind-hidden'              => array(
				'callback' => 'Customind\Controls\HiddenControl',
			),
			'customind-sortable'            => array(
				'callback'          => 'Customind\Controls\SortableControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_sortable' ),
			),
			'customind-group'               => array(
				'callback' => 'Customind\Controls\GroupControl',
			),
			'customind-title'               => array(
				'callback' => 'Customind\Controls\TitleControl',
			),
			'customind-dimensions'          => array(
				'callback' => 'Customind\Controls\DimensionsControl',
			),
			'customind-upgrade'             => array(
				'callback' => 'Customind\Controls\UpgradeControl',
			),
			'customind-builder'             => array(
				'callback' => 'Customind\Controls\BuilderControl',
			),
			'customind-gradient'            => array(
				'callback' => 'Customind\Controls\GradientControl',
			),
			'customind-tab'                 => array(
				'callback'          => 'Customind\Controls\TabControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_text_field' ),
			),
			'customind-icon'                => array(
				'callback'          => 'Customind\Controls\IconControl',
				'sanitize_callback' => array( 'Customind\Sanitize', 'sanitize_nohtml' ),
			),
		);
		foreach ( $controls as $key => $value ) {
			Control::add_control( $key, $value );
		}
	}

	/**
	 * Get customizer configs.
	 *
	 * @param object $wp_customize The Customizer object.
	 */
	private function get_customizer_configs( $wp_customize ) {
		return apply_filters( 'customind_customizer_options', array(), $wp_customize );
	}

	/**
	 * Get default configs.
	 *
	 * @return mixed|void
	 */
	private function get_default_configs() {
		$default_configuration = array(
			'priority'             => null,
			'title'                => null,
			'label'                => null,
			'name'                 => null,
			'type'                 => null,
			'description'          => null,
			'capability'           => 'edit_theme_options',
			'datastore_type'       => 'theme_mod',
			'settings'             => null,
			'active_callback'      => null,
			'sanitize_callback'    => null,
			'sanitize_js_callback' => null,
			'theme_supports'       => null,
			'transport'            => null,
			'default'              => null,
			'selector'             => null,
			'fields'               => array(),
		);

		return apply_filters( 'customind_customizer_default_configuration', $default_configuration );
	}

	/**
	 * Register panel, section and control.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	private function register_customize_settings( $wp_customize ) {
		$configurations = $this->get_customizer_configs( $wp_customize );
		foreach ( $configurations as $config ) {
			$config = wp_parse_args(
				$config,
				$this->get_default_configs()
			);

			switch ( $config['type'] ) {
				case 'panel':
				case 'customind-builder-panel':
					if ( 'panel' === $config['type'] ) {
						unset( $config['type'] ); // Remove `panel` type from configuration for registering it in different way.
					}
					$this->register_panel( $config, $wp_customize );
					break;
				case 'section':
				case 'customind-builder-section':
					if ( 'section' === $config['type'] ) {
						unset( $config['type'] ); // Remove `section` type from configuration for registering it in different way.
					}
					$this->register_section( $config, $wp_customize );
					break;
				case 'sub-control':
					// Remove `sub-control` type from configuration for registering it in different way.
					unset( $config['type'] );
					$this->register_sub_control_setting( $config, $wp_customize );
					break;
				case 'control':
					// Remove `control` type from configuration for registering it in different way.
					unset( $config['type'] );
					$this->register_setting_control( $config, $wp_customize );
					break;
			}
		}
	}

	/**
	 * Register panel.
	 *
	 * @param array $config
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function register_panel( $config, $wp_customize ) {
		$wp_customize->add_panel(
			new Panel(
				$wp_customize,
				$config['name'],
				$config
			)
		);
	}

	/**
	 * Register section.
	 *
	 * @param array $config
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function register_section( $config, $wp_customize ) {
		$section_callback = isset( $config['section_callback'] ) ? $config['section_callback'] : 'Customind\Types\Section';
		$wp_customize->add_section(
			new $section_callback(
				$wp_customize,
				$config['name'],
				$config
			)
		);
	}

	/**
	 * Register sub-control.
	 *
	 * @param array $config
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function register_sub_control_setting( $config, $wp_customize ) {
		$sub_control_name = $config['name'];

		if ( isset( $wp_customize->get_control( $sub_control_name )->id ) ) {
			return;
		}

		$parent = isset( $config['input_attrs']['parent'] ) ? $config['input_attrs']['parent'] : '';
		$tab    = isset( $config['input_attrs']['tab'] ) ? $config['input_attrs']['tab'] : '';

		if ( empty( $this->group_configs[ $parent ] ) ) {
			$this->group_configs[ $parent ] = array();
		}

		if ( array_key_exists( 'tab', $config['input_attrs'] ) ) {
			$this->group_configs[ $parent ]['tabs'][ $tab ][] = $config;
		} else {
			$this->group_configs[ $parent ][] = $config;
		}

		// For adding settings.
		$sanitize_callback = isset( $config['sanitize_callback'] ) ? $config['sanitize_callback'] : Control::get_sanitize_callback( $config['control'] );
		$transport         = isset( $config['transport'] ) ? $config['transport'] : 'refresh';
		$customize_config  = wp_parse_args(
			array(
				'name'              => $sub_control_name,
				'datastore_type'    => apply_filters( 'customind_customize_datastore_type', 'theme_mod' ),
				'control'           => 'customind-hidden',
				'section'           => $config['section'],
				'default'           => $config['default'],
				'transport'         => $transport,
				'sanitize_callback' => $sanitize_callback,
			),
			$config
		);

		$wp_customize->add_setting(
			$customize_config['name'],
			$customize_config
		);

		$control_type = Control::get_control_instance( $customize_config['control'] );

		if ( false !== $control_type ) {
			$wp_customize->add_control(
				new $control_type(
					$wp_customize,
					$customize_config['name'],
					$customize_config
				)
			);
		} else {
			$wp_customize->add_control(
				$customize_config['name'],
				$customize_config
			);
		}
	}

	/**
	 * Register control.
	 *
	 * @param array $config
	 * @param WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function register_setting_control( $config, $wp_customize ) {
		$sanitize_callback = isset( $config['sanitize_callback'] ) ? $config['sanitize_callback'] : Control::get_sanitize_callback( $config['control'] );
		$transport         = isset( $config['transport'] ) ? $config['transport'] : 'refresh';
		if ( 'customind-group' === $config['control'] ) {
			$sanitize_callback = false;
		}
		$wp_customize->add_setting(
			$config['name'],
			array(
				'default'           => $config['default'],
				'type'              => $config['datastore_type'],
				'transport'         => $transport,
				'sanitize_callback' => $sanitize_callback,
			)
		);
		$control_type   = Control::get_control_instance( $config['control'] );
		$config['type'] = $config['control'];

		if ( false !== $control_type ) {
			$wp_customize->add_control(
				new $control_type(
					$wp_customize,
					$config['name'],
					$config
				)
			);
		} else {
			$wp_customize->add_control(
				$config['name'],
				$config
			);
		}

		$selective_refresh = isset( $config['partial'] );
		$render_callback   = isset( $config['partial']['render_callback'] ) ? $config['partial']['render_callback'] : '';
		if ( $selective_refresh ) {
			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					$config['name'],
					array(
						'selector'        => $config['partial']['selector'],
						'render_callback' => $render_callback,
					)
				);
			}
		}
		if ( isset( $config['dependency'] ) ) {
			$this->update_dependency( $config['name'], $config['dependency'] );
		}
	}

	private function update_dependency( $key, $dependency ) {
		$this->dependencies[ $key ] = $dependency;
	}

	/**
	 * Get dependency array.
	 *
	 * @return array
	 */
	private function get_dependency() {
		return $this->dependencies;
	}
}
