<?php
$started_plugin_setting = started_plugin_settings();
$started_plugin_setting->register_tab( 'general_settings', esc_html__( 'General', 'started_plugin' ) );
$started_plugin_setting->register_tab( 'products_settings', esc_html__( 'Products', 'started_plugin' ) );
$started_plugin_setting->register_tab( 'shipping_settings', esc_html__( 'Shipping', 'started_plugin' ) );

$started_plugin_setting->register_sub_tab( 'products_settings_general', 'products_settings', esc_html__( 'General', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'products_settings_inventory', 'products_settings', esc_html__( 'Inventory', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'products_settings_downloadable', 'products_settings', esc_html__( 'Downloadable products', 'started_plugin' ) );

$started_plugin_setting->register_sub_tab( 'shipping_settings_zones', 'shipping_settings', esc_html__( 'Shipping zones', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'shipping_settings_options', 'shipping_settings', esc_html__( 'Shipping options', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'shipping_settings_classes', 'shipping_settings', esc_html__( 'Shipping classes', 'started_plugin' ) );

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

