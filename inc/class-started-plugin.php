<?php
class Started_Plugin {
	/**
	 * The single instance of the class.
	 *
	 * @var Started_Instance
	 * @since 0.1.0
	 */
	protected static $_instance = null;
	/**
	 * Admin var.
	 *
	 * @var Started_Admin
	 * @since 0.1.0
	 */
	protected static $admin = null;
	/**
	 * Instance
	 *
	 * @return Started_Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
	 * Started_Plugin Constructor.
	 */
	public function __construct() {
		$this->setup();
		if ( is_admin() ) {
			$this->setup_admin();
		}
	}

	/**
	 * Method setup.
	 */
	public function setup() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		do_action( 'started_plugin_loaded' );
	}

	/**
	 * Method enqueue_scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'started-plugin-scripts', STARTED_PLUGIN_URL . 'assets/js/frontend.js', array(), STARTED_PLUGIN_VERSION, true );
		wp_enqueue_style( 'started-plugin-styles', STARTED_PLUGIN_URL . 'assets/css/frontend.css', array(), STARTED_PLUGIN_VERSION );
	}

	/**
	 * Method setup_admin.
	 */
	public function setup_admin() {
		require_once STARTED_PLUGIN_DIR . 'inc/admin/class-admin.php';
		$this->admin = new Started_Plugin_Admin();
	}

	/**
	 * Registers the default textdomain.
	 *
	 * @uses apply_filters()
	 * @uses get_locale()
	 * @uses load_textdomain()
	 * @uses load_plugin_textdomain()
	 * @uses plugin_basename()
	 *
	 * @return void
	 */
	public function i18n() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'started-plugin' );
		load_textdomain( 'started-plugin', WP_LANG_DIR . '/started-plugin/started-plugin-' . $locale . '.mo' );
		load_plugin_textdomain( 'started-plugin', false, STARTED_PLUGIN_DIR . 'languages/' );
	}
}

