<?php
$started_plugin_setting = started_plugin_settings();
$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-page',
		'parent_slug' => null,
		'page_title' => esc_html__( 'Page Settings With Tab', 'started-plugin' ),
		'menu_title' => esc_html__( 'Settings', 'started-plugin' ),
	)
);

$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-01',
		'parent_slug' => 'started-plugin-page',
		'page_title' => esc_html__( 'Page Settings With Tab 02', 'started-plugin' ),
		'menu_title' => esc_html__( 'Settings 02', 'started-plugin' ),
	)
);

$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-02',
		'parent_slug' => 'started-plugin-page',
		'page_title' => esc_html__( 'Setting With No Tab', 'started-plugin' ),
		'menu_title' => esc_html__( 'No Tab', 'started-plugin' ),
	)
);

$started_plugin_setting->add_settings_page(
	array(
		'menu_slug' => 'started-plugin-03',
		'parent_slug' => 'started-plugin-page',
		'page_title' => esc_html__( 'Setting With No Tab 02', 'started-plugin' ),
		'menu_title' => esc_html__( 'No Tab 02', 'started-plugin' ),
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
			'after_label'  => '<span class="tip"><i class="fa fa-info-circle"></i>This is info about this setting or field</span>',
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
		array(
			'name'       => esc_html__( 'Test Text', 'cmb2' ),
			'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'         => 'text',
			'type'       => 'text',
		),
		array(
			'name' => esc_html__( 'Test Text Small', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'textsmall',
			'type' => 'text_small',
		),
		array(
			'name' => esc_html__( 'Test Text Medium', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'textmedium',
			'type' => 'text_medium',
		),
		array(
			'name'       => esc_html__( 'Read-only Disabled Field', 'cmb2' ),
			'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'         => 'readonly',
			'type'       => 'text_medium',
			'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'cmb2' ),
			'save_field' => false, // Disables the saving of this field.
			'attributes' => array(
				'disabled' => 'disabled',
				'readonly' => 'readonly',
			),
		),
		array(
			'name' => esc_html__( 'Custom Rendered Field', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'render_row_cb',
			'type' => 'text',
			// 'render_row_cb' => 'yourprefix_render_row_cb',
		),
	)
);

$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Website URL', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'url',
		'type' => 'text_url',
	// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
	// 'repeatable' => true,
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Text Email', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'email',
		'type' => 'text_email',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Text Email - Repeatable', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'email_repeatable',
		'type' => 'text_email',
		'repeatable' => true,
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Time', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'time',
		'type' => 'text_time',
	// 'time_format' => 'H:i', // Set to 24hr format
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Time zone', 'cmb2' ),
		'desc' => esc_html__( 'Time zone', 'cmb2' ),
		'id'   => 'timezone',
		'type' => 'select_timezone',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Date Picker', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textdate',
		'type' => 'text_date',
	// 'date_format' => 'Y-m-d',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Date Picker (UNIX timestamp)', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textdate_timestamp',
		'type' => 'text_date_timestamp',
	// 'timezone_meta_key' =>  'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Date/Time Picker Combo (UNIX timestamp)', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'datetime_timestamp',
		'type' => 'text_datetime_timestamp',
	)
);

$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Money', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textmoney',
		'type' => 'text_money',
	// 'before_field' => '£', // override '$' symbol if needed
	// 'repeatable' => true,
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'    => esc_html__( 'Test Color Picker', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => 'colorpicker',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	// 'options' => array(
	// 'alpha' => true, // Make this a rgba color picker.
	// ),
	// 'attributes' => array(
	// 'data-colorpicker' => json_encode( array(
	// 'palettes' => array( '#3dd0cc', '#ff834c', '#4fa2c0', '#0bc991', ),
	// ) ),
	// ),
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Text Area', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textarea',
		'type' => 'textarea',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Text Area Small', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textareasmall',
		'type' => 'textarea_small',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Text Area for Code', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textarea_code',
		'type' => 'textarea_code',
	// 'attributes' => array(
	// Optionally override the code editor defaults.
	// 'data-codeeditor' => json_encode( array(
	// 'codemirror' => array(
	// 'lineNumbers' => false,
	// 'mode' => 'css',
	// ),
	// ) ),
	// ),
	// To keep the previous formatting, you can disable codemirror.
	// 'options' => array( 'disable_codemirror' => true ),
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Title Weeeee', 'cmb2' ),
		'desc' => esc_html__( 'This is a title description', 'cmb2' ),
		'id'   => 'title',
		'type' => 'title',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'             => esc_html__( 'Test Select', 'cmb2' ),
		'desc'             => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'               => 'select',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'standard' => esc_html__( 'Option One', 'cmb2' ),
			'custom'   => esc_html__( 'Option Two', 'cmb2' ),
			'none'     => esc_html__( 'Option Three', 'cmb2' ),
		),
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'             => esc_html__( 'Test Radio inline', 'cmb2' ),
		'desc'             => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'               => 'radio_inline',
		'type'             => 'radio_inline',
		'show_option_none' => 'No Selection',
		'options'          => array(
			'standard' => esc_html__( 'Option One', 'cmb2' ),
			'custom'   => esc_html__( 'Option Two', 'cmb2' ),
			'none'     => esc_html__( 'Option Three', 'cmb2' ),
		),
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
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
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'     => esc_html__( 'Test Taxonomy Radio', 'cmb2' ),
		'desc'     => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'       => 'text_taxonomy_radio',
		'type'     => 'taxonomy_radio', // Or `taxonomy_radio_inline`/`taxonomy_radio_hierarchical`
		'taxonomy' => 'category', // Taxonomy Slug
	// 'inline'  => true, // Toggles display to inline
	// Optionally override the args sent to the WordPress get_terms function.
		'query_args' => array(
		// 'orderby' => 'slug',
		// 'hide_empty' => true,
		),
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'     => esc_html__( 'Test Taxonomy Select', 'cmb2' ),
		'desc'     => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'       => 'taxonomy_select',
		'type'     => 'taxonomy_select',
		'taxonomy' => 'category', // Taxonomy Slug
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'     => esc_html__( 'Test Taxonomy Multi Checkbox', 'cmb2' ),
		'desc'     => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'       => 'multitaxonomy',
		'type'     => 'taxonomy_multicheck', // Or `taxonomy_multicheck_inline`/`taxonomy_multicheck_hierarchical`
		'taxonomy' => 'post_tag', // Taxonomy Slug
	// 'inline'  => true, // Toggles display to inline
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Checkbox', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'checkbox',
		'type' => 'checkbox',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'    => esc_html__( 'Test Multi Checkbox', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => 'multicheckbox',
		'type'    => 'multicheck',
		// 'multiple' => true, // Store values in individual rows
		'options' => array(
			'check1' => esc_html__( 'Check One', 'cmb2' ),
			'check2' => esc_html__( 'Check Two', 'cmb2' ),
			'check3' => esc_html__( 'Check Three', 'cmb2' ),
		),
		// 'inline'  => true, // Toggles display to inline
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'    => esc_html__( 'Test wysiwyg', 'cmb2' ),
		'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'      => 'wysiwyg',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
		),
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'Test Image', 'cmb2' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'         => esc_html__( 'Multiple Files', 'cmb2' ),
		'desc'         => esc_html__( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'           => 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name' => esc_html__( 'oEmbed', 'cmb2' ),
		'desc' => sprintf(
			/* translators: %s: link to codex.wordpress.org/Embeds */
			esc_html__( 'Enter a youtube, twitter, or instagram URL. Supports services listed at %s.', 'cmb2' ),
			'<a href="https://codex.wordpress.org/Embeds">codex.wordpress.org/Embeds</a>'
		),
		'id'   => 'embed',
		'type' => 'oembed',
	)
);
$started_plugin_setting->set_tab_field(
	'general_settings',
	array(
		'name'         => 'Testing Field Parameters',
		'id'           => 'parameters',
		'type'         => 'text',
		'before_row'   => 'yourprefix_before_row_if_2', // callback.
		'before'       => '<p>Testing <b>"before"</b> parameter</p>',
		'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
		'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
		'after'        => '<p>Testing <b>"after"</b> parameter</p>',
		'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
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

$started_plugin_setting->register_tab( 'general_settings2', esc_html__( 'General 2', 'started-plugin' ), 'started-plugin-01' );
$started_plugin_setting->register_tab( 'products_settings2', esc_html__( 'Products 2', 'started-plugin' ), 'started-plugin-01' );

$started_plugin_setting->set_tab_fields(
	'general_settings2',
	array(
		array(
			'name'    => esc_html__( 'General 2 BG Color', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'general_2_bg_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'General 2  Test Radio',
			'desc'    => 'field description (optional)',
			'id'      => 'general_2_radio',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);
$started_plugin_setting->set_tab_fields(
	'products_settings2',
	array(
		array(
			'name'    => esc_html__( 'Product 2 BG Color', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => 'product_2_bg_color',
			'type'    => 'colorpicker',
			'default' => '#ffffff',
		),
		array(
			'name'    => 'Product 2  Test Radio',
			'desc'    => 'field description (optional)',
			'id'      => 'product_2_radio',
			'type'    => 'radio',
			'options' => array(
				'option1' => 'Option One',
				'option2' => 'Option Two',
				'option3' => 'Option Three',
			),
		),
	)
);

$metabox_args = array(
	'id'            => 'metabox',
	'title'         => esc_html__( 'Metabox', 'started-plugin' ),
	'object_types'  => array( 'page' ),
);
$metabox_fields = array(
	array(
		'name'       => esc_html__( 'Test Text', 'cmb2' ),
		'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'         => 'text',
		'type'       => 'text',
	),
	array(
		'name' => esc_html__( 'Test Text Medium', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'textmedium',
		'type' => 'text_medium',
	),
	array(
		'id'          => 'group_fields',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add Another Entry', 'cmb2' ),
			'remove_button'  => esc_html__( 'Remove Entry', 'cmb2' ),
			'sortable'       => true,
			// 'closed'      => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
		'fields' => array(
			array(
				'name'       => esc_html__( 'Entry Title', 'cmb2' ),
				'id'         => 'title',
				'type'       => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			),
			array(
				'name'        => esc_html__( 'Description', 'cmb2' ),
				'description' => esc_html__( 'Write a short description for this entry', 'cmb2' ),
				'id'          => 'description',
				'type'        => 'textarea_small',
			),
			array(
				'name' => esc_html__( 'Entry Image', 'cmb2' ),
				'id'   => 'image',
				'type' => 'file',
			),
			array(
				'name' => esc_html__( 'Image Caption', 'cmb2' ),
				'id'   => 'image_caption',
				'type' => 'text',
			),
		),
	),
);
$started_plugin_setting->add_meta_box( $metabox_args, $metabox_fields );

$metabox_args2 = array(
	'id'            => 'metabox2',
	'title'         => esc_html__( 'Metabo 02', 'started-plugin' ),
	'object_types'  => array( 'page' ),
);
$started_plugin_setting->add_meta_box_file( $metabox_args2, STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/metabox.php' );

$started_plugin_setting->set_setting_fields(
	'started-plugin-02',
	array(
		array(
			'name'       => esc_html__( 'Test Text', 'cmb2' ),
			'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'         => 'notab_text',
			'type'       => 'text',
		),
		array(
			'name' => esc_html__( 'Test Text Medium', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'notab_textmedium',
			'type' => 'text_medium',
		),
	)
);

$started_plugin_setting->set_setting_fields(
	'started-plugin-02',
	array(
		array(
			'name'       => esc_html__( 'Test Text 2', 'cmb2' ),
			'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'         => 'notab_text2',
			'type'       => 'text',
		),
		array(
			'name' => esc_html__( 'Test Text Medium 2', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'notab_textmedium2',
			'type' => 'text_medium',
		),
	)
);
$started_plugin_setting->set_setting_field(
	'started-plugin-02',
	array(
		'name'       => esc_html__( 'Test Text 3', 'cmb2' ),
		'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'         => 'notab_text3',
		'type'       => 'text',
	)
);
$started_plugin_setting->set_setting_field(
	'started-plugin-02',
	array(
		'name' => esc_html__( 'Test Text Medium 3', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => 'notab_textmedium3',
		'type' => 'text_medium',
	)
);

$started_plugin_setting->set_setting_file_configs(
	'started-plugin-02',
	STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/setting-no-tab.php'
);


$started_plugin_setting->set_setting_fields(
	'started-plugin-03',
	array(
		array(
			'name'       => esc_html__( 'Test Text', 'cmb2' ),
			'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'         => 'notab_2_text',
			'type'       => 'text',
		),
		array(
			'name' => esc_html__( 'Test Text Medium', 'cmb2' ),
			'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'   => 'notab_2_textmedium',
			'type' => 'text_medium',
		),
		array(
			'id'          => 'group_fields',
			'type'        => 'group',
			'description' => esc_html__( 'Generates reusable form entries', 'cmb2' ),
			'options'     => array(
				'group_title'    => esc_html__( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
				'add_button'     => esc_html__( 'Add Another Entry', 'cmb2' ),
				'remove_button'  => esc_html__( 'Remove Entry', 'cmb2' ),
				'sortable'       => true,
				// 'closed'      => true, // true to have the groups closed by default
				// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
			),
			'fields' => array(
				array(
					'name'       => esc_html__( 'Entry Title', 'cmb2' ),
					'id'         => 'title',
					'type'       => 'text',
					// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
				),
				array(
					'name'        => esc_html__( 'Description', 'cmb2' ),
					'description' => esc_html__( 'Write a short description for this entry', 'cmb2' ),
					'id'          => 'description',
					'type'        => 'textarea_small',
				),
				array(
					'name' => esc_html__( 'Entry Image', 'cmb2' ),
					'id'   => 'image',
					'type' => 'file',
				),
				array(
					'name' => esc_html__( 'Image Caption', 'cmb2' ),
					'id'   => 'image_caption',
					'type' => 'text',
				),
			),
		),
	)
);
