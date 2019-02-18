<?php
class Started_Plugin_Options {
	/**
	 * The option page slug.
	 *
	 * @var Started_Page_Slug
	 * @since 0.1.0
	 */
	public $page_option_slug = '';
	/**
	 * The option key in database.
	 *
	 * @var Started_Option_Key
	 * @since 0.1.0
	 */
	public $option_key = 'started_plugin';

	/**
	 * The option configs.
	 *
	 * @var Started_Option_Configs
	 * @since 0.1.0
	 */
	public $option_configs = array();

	/**
	 * The single instance of the class.
	 *
	 * @var Started_Instance
	 * @since 0.1.0
	 */
	protected static $_instance = null;
	/**
	 * Method __construct
	 */
	public function __construct() {
		if ( file_exists( STARTED_PLUGIN_DIR . 'inc/admin/options-configs.php' ) ) {
			$this->option_configs = include STARTED_PLUGIN_DIR . 'inc/admin/option-configs.php';
		} else {
			$this->option_configs = array();
		}

		add_action( 'admin_menu', array( $this, 'add_menu_pages' ), 90 );
		add_action( 'cmb2_admin_init', array( $this, 'register_metabox' ) );
	}

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

	public function add_menu_pages() {
		add_menu_page( esc_html__( 'Started Plugin', 'started-plugin' ), esc_html__( 'Started Plugin', 'started-plugin' ), 'manage_options', 'started-plugin', array( $this, 'page_content' ) );
		// add_submenu_page( 'started-plugin', esc_html__( 'Settings', 'started-plugin' ), esc_html__( 'Settings', 'started-plugin' ), 'manage_options', 'started-plugin', array( $this, 'page_content' ) ); .
		
		echo "<pre>";
		print_r( $this->option_configs );
		echo "</pre>";
	}

	public function page_content() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Settings', 'started-plugin' ); ?></h1>
			<form method="post" action="options.php">
				
				<?php cmb2_get_metabox( 'pm-metabox-id-', 'started-plugin', 'options-page' )->show_form(); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<div class="clear"></div>
		<?php
	}

	function register_metabox() {
		echo "<pre>";
		print_r( $this->option_configs );
		echo "</pre>";

		$cmb = new_cmb2_box(
			array(
				'id'           => 'pm-metabox-id-',
				'hookup'       => false,
				'object_types' => array( 'options-page' ),
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Test Text', 'myprefix' ),
				'desc' => __( 'field description (optional)', 'myprefix' ),
				'id'   => 'test_text',
				'type' => 'text',
			// 'default' => 'Default Text',
			)
		);

		$cmb->add_field(
			array(
				'name'    => __( 'Test Color Picker', 'myprefix' ),
				'desc'    => __( 'field description (optional)', 'myprefix' ),
				'id'      => 'test_colorpicker',
				'type'    => 'colorpicker',
				'default' => '#bada55',
			)
		);
	}
}

$plugin_options = new Started_Plugin_Options();
