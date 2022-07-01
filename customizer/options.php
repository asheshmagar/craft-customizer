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
				'unsortable'  => array(
					'one',
					'two',
					'three',
					'four',
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
				'unsortable'  => array(
					'one',
					'four',
				),
			),
			array(
				'name'      => 'customind_radio_image',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'customind-radio-image',
				'label'     => 'Radio Image',
				'section'   => 'customind_section',
				'choices'   => array(
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
				'priority'  => 30,
				'image_col' => 3,
			),
			array(
				'name'     => 'customind_custom',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'customind-custom',
				'label'    => 'Custom',
				'section'  => 'customind_section',
				'priority' => 30,
				'info'     => '<h2> This is custom info </h2>',
				'links'    => array(
					array(
						'url'  => 'https://themegrill.com/themes',
						'text' => esc_html__( 'Visit ThemeGrill', 'colormag' ),
					),
					array(
						'url'  => 'https://themegrill.com/themes',
						'text' => esc_html__( 'Visit ThemeGrill', 'colormag' ),
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
				'name'     => 'customind_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Section', 'customind' ),
				'panel'    => 'customind_panel',
				'priority' => 10,
			),
		);
		return array_merge( $options, $configs );
	}
}
