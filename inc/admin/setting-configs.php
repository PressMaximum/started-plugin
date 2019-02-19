<?php
$started_plugin_setting = started_plugin_settings();
$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-page',
		'parent_slug' => null,
		'page_title' => esc_html__( 'Page Settings', 'started-plugin' ),
		'menu_title' => esc_html__( 'Started Page', 'started-plugin' ),
	)
);

$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-01',
		'parent_slug' => 'started-plugin-page',
		'page_title' => esc_html__( 'Page 01', 'started-plugin' ),
		'menu_title' => esc_html__( 'Started Page 01', 'started-plugin' ),
	)
);

$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-02',
		'parent_slug' => 'started-plugin-page',
		'page_title' => esc_html__( 'Page 02', 'started-plugin' ),
		'menu_title' => esc_html__( 'Started Page 02', 'started-plugin' ),
	)
);

$started_plugin_setting->register_tab( 'general_settings', esc_html__( 'General', 'started-plugin' ), 'started-plugin-page' );
$started_plugin_setting->register_tab( 'products_settings', esc_html__( 'Products', 'started-plugin' ), 'started-plugin-page' );
$started_plugin_setting->register_tab( 'shipping_settings', esc_html__( 'Shipping', 'started-plugin' ), 'started-plugin-page' );

$started_plugin_setting->register_sub_tab( 'products_settings_general', 'products_settings', esc_html__( 'General', 'started-plugin' ) );
$started_plugin_setting->register_sub_tab( 'products_settings_inventory', 'products_settings', esc_html__( 'Inventory', 'started-plugin' ) );
$started_plugin_setting->register_sub_tab( 'products_settings_downloadable', 'products_settings', esc_html__( 'Downloadable products', 'started-plugin' ) );

$started_plugin_setting->register_sub_tab( 'shipping_settings_zones', 'shipping_settings', esc_html__( 'Shipping zones', 'started-plugin' ) );
$started_plugin_setting->register_sub_tab( 'shipping_settings_options', 'shipping_settings', esc_html__( 'Shipping options', 'started-plugin' ) );
$started_plugin_setting->register_sub_tab( 'shipping_settings_classes', 'shipping_settings', esc_html__( 'Shipping classes', 'started-plugin' ) );

$started_plugin_setting->set_tab_fields(
	'general_settings',
	array(
		array(
			'name'    => esc_html__( 'Site Background Color 03', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'bg_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'Test Radio 03',
			'desc'    => 'field description (optional)',
			'id'      => 'radio',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);

$started_plugin_setting->set_tab_file_configs( 'general_settings', STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/general.php' );

$started_plugin_setting->set_sub_tab_fields(
	'products_settings_general',
	'products_settings',
	array(
		array(
			'name'    => esc_html__( 'Product Site Background Color', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'bg_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'Product Test Radio',
			'desc'    => 'field description (optional)',
			'id'      => 'radio',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);

$started_plugin_setting->set_sub_tab_fields(
	'products_settings_inventory',
	'products_settings',
	array(
		array(
			'name'    => esc_html__( 'Product Site Background Color 2', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'bg_color2222',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'Product Test Radio 2',
			'desc'    => 'field description (optional)',
			'id'      => 'radio222',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);

$started_plugin_setting->set_sub_tab_file_configs(
	'products_settings_inventory',
	'products_settings',
	STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/products-settings-inventory.php'
);

$started_plugin_setting->set_sub_tab_fields(
	'shipping_settings_zones',
	'shipping_settings',
	array(
		array(
			'name'    => esc_html__( 'Product Site Background Color', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'bg_color444',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'Product Test Radio',
			'desc'    => 'field description (optional)',
			'id'      => 'radio444',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);

$started_plugin_setting->set_sub_tab_fields(
	'shipping_settings_options',
	'shipping_settings',
	array(
		array(
			'name'    => esc_html__( 'Product Site Background Color 2', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'bg_color555',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'Product Test Radio 2',
			'desc'    => 'field description (optional)',
			'id'      => 'radio555',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);