<?php
class Started_Plugin_Admin {
	/**
	 * Method __construct
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Method enqueue_scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'started-plugin-admin-scripts', STARTED_PLUGIN_URL . 'assets/js/admin.js', array(), STARTED_PLUGIN_VERSION, true );
		wp_enqueue_style( 'started-plugin-admin-styles', STARTED_PLUGIN_URL . 'assets/css/admin.css', array(), STARTED_PLUGIN_VERSION );
	}
}
