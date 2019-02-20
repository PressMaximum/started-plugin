<?php
class Started_Plugin {
	/**
	 * The single instance of the class
	 *
	 * @var Started_Instance
	 * @since 0.1.0
	 */
	protected static $_instance = null;
	/**
	 * The plugin dir
	 *
	 * @var Started_Plugin_Dir
	 * @since 0.1.0
	 */
	protected $plugin_dir;
	/**
	 * The plugin url
	 *
	 * @var Started_Plugin_Url
	 * @since 0.1.0
	 */
	protected $plugin_url;
	/**
	 * The plugin version
	 *
	 * @var Started_Plugin_Version
	 * @since 0.1.0
	 */
	protected $plugin_version;
	/**
	 * Admin var
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
		$this->plugin_dir = STARTED_PLUGIN_DIR;
		$this->plugin_url = STARTED_PLUGIN_URL;
		$this->plugin_version = STARTED_PLUGIN_VERSION;
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		do_action( 'started_plugin_loaded' );
	}

	/**
	 * Method enqueue_scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'started-plugin', $this->plugin_url . 'assets/js/frontend.js', array(), $this->plugin_version, true );
		wp_enqueue_style( 'started-plugin', $this->plugin_url . 'assets/css/frontend.css', array(), $this->plugin_version );
	}

	/**
	 * Method setup_admin.
	 */
	public function setup_admin() {
		require_once $this->plugin_dir . 'inc/admin/class-admin.php';
		$this->admin = new Started_Plugin_Admin();
	}

}

