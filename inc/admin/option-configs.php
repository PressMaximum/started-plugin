<?php
$option_box = array();

$option_box[] = array(
	'page_slug' => '',
	'parent_page_slug' => '',
	'box_title' => '',
	'save_button_text' => '',

	'tabs' => array(
		array(
			'tab_title' => '',
			'settings'  => array(
				array(
					'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
					'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
					'id'      => 'bg_color',
					'type'    => 'colorpicker',
					'default' => '#ffffff',
				),
				array(
					'name'    => esc_html__( 'Test Radio', 'cmb2' ),
					'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
					'id'      => 'radio',
					'type'    => 'radio',
					'options' => array(
						'option1' => esc_html__( 'Option One', 'cmb2' ),
						'option2' => esc_html__( 'Option Two', 'cmb2' ),
						'option3' => esc_html__( 'Option Three', 'cmb2' ),
					),
				),
				array(
					'name' => esc_html__( 'Test Text Area for Code', 'cmb2' ),
					'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
					'id'   => 'textarea_code',
					'type' => 'textarea_code',
				),
			),
		),
	),
	'settings' => array(
		array(
			'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'bg_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => esc_html__( 'Test Radio', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'radio',
			'type'    => 'radio',
			'options' => array(
				'option1' => esc_html__( 'Option One', 'cmb2' ),
				'option2' => esc_html__( 'Option Two', 'cmb2' ),
				'option3' => esc_html__( 'Option Three', 'cmb2' ),
			),
		),
		array(
			'name' => esc_html__( 'Test Text Area for Code', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'textarea_code',
			'type' => 'textarea_code',
		),
	),
);

return $option_box;
