<?php
$started_plugin_setting = started_plugin_settings();
$started_plugin_setting->register_tab( 'tab_01', esc_html__( 'Tab 01', 'started_plugin' ) );
$started_plugin_setting->register_tab( 'tab_02', esc_html__( 'Tab 02', 'started_plugin' ) );
$started_plugin_setting->register_tab( 'tab_03', esc_html__( 'Tab 03', 'started_plugin' ) );

$started_plugin_setting->register_sub_tab( 'tab_01_01', 'tab_01', esc_html__( 'Tab 01 - 01', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'tab_01_02', 'tab_01', esc_html__( 'Tab 01 - 02', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'tab_01_03', 'tab_01', esc_html__( 'Tab 01 - 03', 'started_plugin' ) );

$started_plugin_setting->register_sub_tab( 'tab_02_01', 'tab_02', esc_html__( 'Tab 02 - 01', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'tab_02_02', 'tab_02', esc_html__( 'Tab 02 - 02', 'started_plugin' ) );
$started_plugin_setting->register_sub_tab( 'tab_02_03', 'tab_02', esc_html__( 'Tab 02 - 03', 'started_plugin' ) );

