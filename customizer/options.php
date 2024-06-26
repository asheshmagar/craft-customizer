<?php

use Customind\BaseOption;

add_action(
	'customize_register',
	function() {
		new CustomindPanels();
		new CustomindOptions();
	}
);

class CustomindOptions extends BaseOption {
	public function register_options( $options, $customize ) {
		$configs = array(
			array(
				'name'        => 'customind_tab',
				'type'        => 'control',
				'control'     => 'customind-tab',
				'section'     => 'customind_section',
				'priority'    => 0,
				'choices'     => array(
					'general' => array(
						'label'  => 'General',
						'target' => 'customind_general',
					),
					'design'  => array(
						'label'  => 'Design',
						'target' => 'customind_design',
					),
				),
				'input_attrs' => array(
					'active' => 'general',
				),
			),
			array(
				'name'     => 'customind_title',
				'type'     => 'control',
				'control'  => 'customind-title',
				'label'    => esc_html__( 'Title', 'customind' ),
				'section'  => 'customind_section',
				'priority' => 10,
			),
			array(
				'name'        => 'customind_editor',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'customind-editor',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Editor', 'customind' ),
				'description' => 'Editor description',
				'priority'    => 30,
			),
			array(
				'name'        => 'customind_toggle',
				'default'     => true,
				'type'        => 'control',
				'control'     => 'customind-toggle',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Toggle', 'customind' ),
				'description' => 'Editor description',
				'priority'    => 30,
			),
			array(
				'name'        => 'customind_slider',
				'default'     => 10,
				'type'        => 'control',
				'control'     => 'customind-slider',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Slider', 'customind' ),
				'description' => 'Slider description',
				'priority'    => 30,
			),
			array(
				'name'        => 'customind_buttonset',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'customind-buttonset',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Button Set', 'customind' ),
				'description' => 'Buttonset description',
				'priority'    => 30,
				'choices'     => array(
					'one'   => 'One',
					'two'   => 'Two',
					'three' => 'Three',
					'four'  => 'Four',
				),
			),
			array(
				'name'        => 'customind_sortable',
				'default'     => array(
					'one',
					'two',
					'three',
				),
				'type'        => 'control',
				'control'     => 'customind-sortable',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Sortable', 'customind' ),
				'description' => 'Sortable description',
				'priority'    => 30,
				'choices'     => array(
					'one'   => 'One',
					'two'   => 'Two',
					'three' => 'Three',
					'four'  => 'Four',
				),
			),
			array(
				'name'        => 'customind_unsortable',
				'default'     => array(
					'two',
					'four',
				),
				'type'        => 'control',
				'control'     => 'customind-sortable',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Unsortable', 'customind' ),
				'description' => 'Unsortable description',
				'priority'    => 30,
				'choices'     => array(
					'one'   => 'One',
					'two'   => 'Two',
					'three' => 'Three',
					'four'  => 'Four',
				),
				'input_attrs' => array(
					'unsortable' => array(
						'one',
						'two',
						'three',
						'four',
					),
				),
			),
			array(
				'name'        => 'customind_unsortable_sortable',
				'default'     => array(
					'one',
					'two',
					'three',
				),
				'type'        => 'control',
				'control'     => 'customind-sortable',
				'section'     => 'customind_section',
				'label'       => esc_html__( 'Unsortable Sortable', 'customind' ),
				'description' => 'Unsortable Sortable description',
				'priority'    => 30,
				'choices'     => array(
					'one'   => 'One',
					'two'   => 'Two',
					'three' => 'Three',
					'four'  => 'Four',
				),
				'input_attrs' => array(
					'unsortable' => array(
						'one',
						'four',
					),
				),
			),
			array(
				'name'        => 'customind_radio_image',
				'default'     => 'right_sidebar',
				'type'        => 'control',
				'control'     => 'customind-radio-image',
				'label'       => 'Radio Image',
				'section'     => 'customind_section',
				'choices'     => array(
					'right_sidebar'                => array(
						'label' => 'Right sidebar',
						'url'   => get_template_directory_uri() . '/customizer/left-sidebar.png',
					),
					'left_sidebar'                 => array(
						'label' => 'Left sidebar',
						'url'   => get_template_directory_uri() . '/customizer/left-sidebar.png',
					),
					'no_sidebar_full_width'        => array(
						'label' => 'No sidebar full width',
						'url'   => get_template_directory_uri() . '/customizer/left-sidebar.png',
					),
					'no_sidebar_content_centered'  => array(
						'label' => 'No sidebar content centered',
						'url'   => get_template_directory_uri() . '/customizer/left-sidebar.png',
					),
					'no_sidebar_content_stretched' => array(
						'label' => 'No sidebar content stretched',
						'url'   => get_template_directory_uri() . '/customizer/left-sidebar.png',
					),
				),
				'input_attrs' => array(
					'image_col' => 3,
				),
				'priority'    => 30,
			),
			array(
				'name'        => 'customind_custom',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'customind-custom',
				'label'       => 'Custom',
				'section'     => 'customind_section',
				'priority'    => 30,
				'input_attrs' => array(
					'info'  => '<h2> This is custom info </h2>',
					'links' => array(
						array(
							'url'  => 'https://themegrill.com/themes',
							'text' => esc_html__( 'Visit ThemeGrill', 'customind' ),
						),
						array(
							'url'  => 'https://themegrill.com/themes',
							'text' => esc_html__( 'Visit ThemeGrill', 'customind' ),
						),
					),
				),
			),
			array(
				'name'     => 'customind_color',
				'default'  => '#289dcc',
				'type'     => 'control',
				'control'  => 'customind-color',
				'label'    => esc_html__( 'Customind color', 'customind' ),
				'section'  => 'customind_section',
				'priority' => 30,
			),
			array(
				'name'     => 'customind_color_2',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'customind-color',
				'label'    => esc_html__( 'Customind color 2', 'customind' ),
				'section'  => 'customind_section',
				'priority' => 30,
			),
			array(
				'name'        => 'customind_background',
				'default'     => array(
					'background-color'      => '#ffffff',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'        => 'control',
				'control'     => 'customind-background',
				'section'     => 'customind_section',
				'label'       => 'Background',
				'description' => 'Background description',
				'priority'    => 30,
			),
			array(
				'name'        => 'customind_typography',
				'default'     => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => array(
							'value' => 15,
							'unit'  => 'px',
						),
						'tablet'  => array(),
						'mobile'  => array(),
					),
					'line-height'    => array(
						'desktop' => array(
							'value' => 1.6,
							'unit'  => '',
						),
						'tablet'  => array(),
						'mobile'  => array(),
					),
					'letter-spacing' => array(
						'desktop' => array(),
						'tablet'  => array(),
						'mobile'  => array(),
					),
				),
				'input_attrs' => array(
					'units'   => array(
						'font-size'       => array( 'px', 'em', 'rem' ),
						'line-height'     => array( 'px', 'em', 'rem' ),
						'letter-spacing ' => array( '-', 'px', 'em', 'rem' ),
					),
					'desktop' => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 36,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
						'letter-spacing' => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 4,
						),
					),
					'tablet'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 36,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
						'letter-spacing' => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 4,
						),
					),
					'mobile'  => array(
						'font-size'      => array(
							'step' => 1,
							'min'  => 10,
							'max'  => 36,
						),
						'line-height'    => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 3,
						),
						'letter-spacing' => array(
							'step' => 0.1,
							'min'  => 0,
							'max'  => 4,
						),
					),
				),
				'type'        => 'control',
				'control'     => 'customind-typography',
				'section'     => 'customind_section',
				'priority'    => 30,
				'label'       => esc_html__( 'Typography', 'customind' ),
				'description' => 'Typography description',
			),
			array(
				'name'        => 'customind_responsive_dimensions',
				'type'        => 'control',
				'default'     => array(
					'desktop' => array(
						'top'    => '5',
						'right'  => '10',
						'bottom' => '20',
						'left'   => '25',
						'unit'   => 'px',
					),
				),
				'control'     => 'customind-dimensions',
				'label'       => esc_html__( 'Dimensions', 'customind' ),
				'section'     => 'customind_section',
				'priority'    => 30,
				'input_attrs' => array(
					'units'      => array( 'px', 'rem', '' ),
					'responsive' => true,
				),
			),
			array(
				'name'     => 'customind_dimensions',
				'type'     => 'control',
				'default'  => array(
					'top'    => '5',
					'right'  => '10',
					'bottom' => '20',
					'left'   => '25',
					'unit'   => 'px',
				),
				'control'  => 'customind-dimensions',
				'label'    => esc_html__( 'Dimensions', 'customind' ),
				'section'  => 'customind_header_builder_section_hidden',
				'priority' => 30,
				'units'    => array( 'px', 'rem', '' ),
			),

			array(
				'name'        => 'customind_navigate',
				'type'        => 'control',
				'control'     => 'customind-navigate',
				'label'       => esc_html__( 'Navigate', 'customind' ),
				'section'     => 'customind_header_builder_section',
				'input_attrs' => array(
					'target_id'    => 'customind_header_builder_section_hidden',
					'target_label' => esc_html__( 'Dimensions', 'customind' ),
				),
				'priority'    => 30,
			),
			array(
				'name'     => 'customind_dropdown_categories',
				'type'     => 'control',
				'control'  => 'customind-dropdown-categories',
				'label'    => esc_html__( 'Dropdown categories', 'customind' ),
				'section'  => 'customind_header_builder_section',
				'priority' => 30,
				'context'  => array(
					array(
						'setting' => '__current_tab',
						'value'   => 'general',
					),
				),
			),
			array(
				'name'     => 'customind_group_2',
				'label'    => 'Group 2',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'customind-group',
				'section'  => 'customind_section',
				'priority' => 30,
			),
			array(
				'name'        => 'customind_color_sub_control_2',
				'label'       => esc_html__( 'Color', 'customind' ),
				'default'     => '#289dcc',
				'type'        => 'sub-control',
				'control'     => 'customind-color',
				'section'     => 'customind_section',
				'priority'    => 30,
				'input_attrs' => array(
					'parent' => 'customind_group_2',
				),
			),
			array(
				'name'        => 'customind_responsive_dimensions_sub',
				'type'        => 'sub-control',
				'default'     => array(
					'desktop' => array(
						'top'    => '5',
						'right'  => '10',
						'bottom' => '20',
						'left'   => '25',
						'unit'   => 'px',
					),
				),
				'control'     => 'customind-dimensions',
				'label'       => esc_html__( 'Dimensions', 'customind' ),
				'section'     => 'customind_section',
				'priority'    => 30,
				'units'       => array( 'px', 'rem', '' ),
				'parent'      => 'customind_group_2',
				'responsive'  => true,
				'input_attrs' => array(
					'parent' => 'customind_group_2',
				),
			),
			array(
				'name'        => 'customind_builder_control_2',
				'type'        => 'control',
				'default'     => array(
					'top'    => array(
						'top_left'   => array( 'logo' ),
						'top_center' => array(),
						'top_right'  => array(),
					),
					'main'   => array(
						'main_left'   => array(),
						'main_center' => array(),
						'main_right'  => array(),
					),
					'bottom' => array(
						'bottom_left'   => array(),
						'bottom_center' => array(),
						'bottom_right'  => array(),
					),
				),
				'control'     => 'customind-builder',
				'label'       => esc_html__( 'Builder', 'customind' ),
				'section'     => 'customind_header_builder_2',
				'priority'    => 30,
				'choices'     => array(
					'logo'         => array(
						'name'    => esc_html__( 'Logo', 'customind' ),
						'section' => 'title_tagline',
						'icon'    => 'admin-users',
					),
					'navigation'   => array(
						'name'    => esc_html__( 'Primary Navigation', 'customind' ),
						'section' => 'customind_primary_navigation',
						'icon'    => 'menu',
					),
					'navigation-2' => array(
						'name'    => esc_html__( 'Secondary Navigation', 'customind' ),
						'section' => 'customind_secondary_navigation',
						'icon'    => 'menu',
					),
					'search'       => array(
						'name'    => esc_html__( 'Search', 'customind' ),
						'section' => 'customind_header_search',
						'icon'    => 'search',
					),
					'button'       => array(
						'name'    => esc_html__( 'Button', 'customind' ),
						'section' => 'customind_header_button',
						'icon'    => 'admin-links',
					),
					'social'       => array(
						'name'    => esc_html__( 'Social', 'customind' ),
						'section' => 'customind_header_social',
						'icon'    => 'share',
					),
					'html'         => array(
						'name'    => esc_html__( 'HTML', 'customind' ),
						'section' => 'customind_header_html',
						'icon'    => 'html',
					),
				),
				'input_attrs' => array(
					'areas' => array(
						'top'    => array(
							'top_left'   => 'Top Left',
							'top_center' => 'Top Center',
							'top_right'  => 'Top Right',
						),
						'main'   => array(
							'main_left'   => 'Main Left',
							'main_center' => 'Main center',
							'main_right'  => 'Main Right',
						),
						'bottom' => array(
							'bottom_left'   => 'Bottom Left',
							'bottom_center' => 'Bottom Center',
							'bottom_right'  => 'Bottom Right',
						),
					),
				),
			),
			array(
				'name'        => 'customind_builder_control',
				'type'        => 'control',
				'default'     => array(
					'top'    => array(
						'top_left'   => array( 'logo' ),
						'top_center' => array(),
						'top_right'  => array(),
					),
					'main'   => array(
						'main_left'   => array(),
						'main_center' => array(),
						'main_right'  => array(),
					),
					'bottom' => array(
						'bottom_left'   => array(),
						'bottom_center' => array(),
						'bottom_right'  => array(),
					),
				),
				'control'     => 'customind-builder',
				'label'       => esc_html__( 'Builder', 'customind' ),
				'section'     => 'customind_header_builder',
				'priority'    => 30,
				'choices'     => array(
					'logo'         => array(
						'name'    => esc_html__( 'Logo', 'customind' ),
						'section' => 'title_tagline',
					),
					'navigation'   => array(
						'name'    => esc_html__( 'Primary Navigation', 'customind' ),
						'section' => 'customind_primary_navigation',
					),
					'navigation-2' => array(
						'name'    => esc_html__( 'Secondary Navigation', 'customind' ),
						'section' => 'customind_secondary_navigation',
					),
					'search'       => array(
						'name'    => esc_html__( 'Search', 'customind' ),
						'section' => 'customind_header_search',
					),
					'button'       => array(
						'name'    => esc_html__( 'Button', 'customind' ),
						'section' => 'customind_header_button',
					),
					'social'       => array(
						'name'    => esc_html__( 'Social', 'customind' ),
						'section' => 'customind_header_social',
					),
					'html'         => array(
						'name'    => esc_html__( 'HTML', 'customind' ),
						'section' => 'customind_header_html',
					),
				),
				'input_attrs' => array(
					'areas' => array(
						'top'    => array(
							'top_left'   => 'Top Left',
							'top_center' => 'Top Center',
							'top_right'  => 'Top Right',
						),
						'main'   => array(
							'main_left'   => 'Main Left',
							'main_center' => 'Main center',
							'main_right'  => 'Main Right',
						),
						'bottom' => array(
							'bottom_left'   => 'Bottom Left',
							'bottom_center' => 'Bottom Center',
							'bottom_right'  => 'Bottom Right',
						),
					),
				),
			),
			array(
				'name'     => 'customind_group',
				'label'    => 'Group',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'customind-group',
				'section'  => 'customind_section',
				'priority' => 30,
			),

			array(
				'name'        => 'customind_color_sub_control',
				'label'       => 'Color',
				'default'     => '#b1b6b6',
				'type'        => 'sub-control',
				'control'     => 'customind-color',
				'section'     => 'customind_section',
				'priority'    => 30,
				'input_attrs' => array(
					'tab'    => 'Normal',
					'parent' => 'customind_group',
				),
			),

			array(
				'name'        => 'customind_footer_small_menu_text_hover_color',
				'label'       => esc_html__( 'Color', 'customind' ),
				'default'     => '#289dcc',
				'type'        => 'sub-control',
				'control'     => 'customind-color',
				'section'     => 'customind_section',
				'priority'    => 30,
				'input_attrs' => array(
					'tab'    => 'Hover',
					'parent' => 'customind_group',
				),
			),
			array(
				'name'     => 'customind_gradient',
				'label'    => esc_html__( 'Gradient', 'customind' ),
				'default'  => 'linear-gradient(90deg, rgb(6, 147, 227) 0%, rgb(155, 81, 224) 100%)',
				'type'     => 'control',
				'control'  => 'customind-gradient',
				'section'  => 'customind_section',
				'priority' => 30,
			),
		);
		return array_merge( $options, $configs );
	}
}

class CustomindPanels extends BaseOption {
	public function register_options( $options, $customize ) {
		$configs = array(
			array(
				'name'     => 'customind_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Panel', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_builder_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Builder', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_header',
				'type'     => 'customind-builder-panel',
				'title'    => esc_html__( 'Builder', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_footer',
				'type'     => 'customind-builder-panel',
				'title'    => esc_html__( 'Builder 2', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_header_builder',
				'type'     => 'customind-builder-section',
				'panel'    => 'customind_header',
				'title'    => esc_html__( 'Builder', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_header_builder_2',
				'type'     => 'customind-builder-section',
				'panel'    => 'customind_footer',
				'title'    => esc_html__( 'Builder 2', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_header_builder_section',
				'type'     => 'customind-builder-section',
				'panel'    => 'customind_header',
				'title'    => esc_html__( 'Inner', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_header_builder_section_hidden',
				'type'     => 'section',
				'panel'    => 'customind_header',
				'title'    => esc_html__( 'Inner', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_builder_section_inner_2',
				'type'     => 'section',
				'section'  => 'customind_builder_section_inner_1',
				'title'    => esc_html__( 'Inner', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_inner_section',
				'type'     => 'section',
				'panel'    => 'customind_panel',
				'title'    => esc_html__( 'Builder', 'customind' ),
				'priority' => 10,
			),
			array(
				'name'     => 'customind_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Section', 'customind' ),
				'panel'    => 'customind_panel',
				'priority' => 10,
			),
			array(
				'name'     => 'customind_section_2',
				'type'     => 'section',
				'title'    => esc_html__( 'Section 2', 'customind' ),
				'panel'    => 'customind_panel',
				'priority' => 10,
			),
		);
		return array_merge( $options, $configs );
	}
}
