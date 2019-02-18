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
	}

	public function page_content() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Settings', 'started-plugin' ); ?></h1>
			<form method="post" action="options.php">
				<?php
				foreach ( $this->option_configs as $tab_config ) {
					$tab_url = add_query_arg( array( 'tab' => $tab_config['id'] ), menu_page_url( 'started-plugin', false ) );
					$current_tab = $this->option_configs[0]['id'];
					if ( isset( $_GET['tab'] ) && $tab_config['id'] == $_GET['tab'] ) {
						$current_tab = sanitize_text_field( $_GET['tab'] );
					}
					?>
					<a href="<?php echo esc_url( $tab_url ); ?>" id="<?php echo esc_attr( $tab_config['id'] ); ?>" class="tab-nav <?php if ( $current_tab == $tab_config['id'] ) {
						echo 'active'; } ?>"><?php echo esc_html( $tab_config['title'] ); ?></a>
					<?php
					if ( $current_tab == $tab_config['id'] ) {
						cmb2_get_metabox( $tab_config['id'], 'started-plugin', 'options-page' )->show_form();
					}
				}
				?>
				<?php submit_button(); ?>
			</form>
		</div>
		<div class="clear"></div>
		<?php
	}

	function register_metabox() {
		if ( is_array( $this->option_configs ) && ! empty( $this->option_configs ) ) {
			foreach ( $this->option_configs as $tab_config ) {
				$cmb = new_cmb2_box(
					array(
						'id'           => $tab_config['id'],
						'hookup'       => false,
						'object_types' => array( 'options-page' ),
					)
				);

				if ( is_array( $tab_config['fields'] ) && ! empty( $tab_config['fields'] ) ) {
					foreach ( $tab_config['fields'] as $field ) {
						$field['id'] = $this->option_key . '[' . $field['id'] . ']';
						$cmb->add_field( $field );
					}
				}
			}
		}
	}

	public static function set_tab( $args ) {
		self::$_instance->option_configs[] = $args;
	}
}

function started_plugin_options() {
	return Started_Plugin_Options::instance();
}

started_plugin_options();

started_plugin_options()->set_tab(
	array(
		'title' => 'Tab 01',
		'id'    => 'tab_1_id',
		'fields' => array(
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
	)
);
