<?php
class Started_Plugin_Setting {
	/**
	 * The option page slug.
	 *
	 * @var Started_Plugin_Setting_Menu_Slug
	 * @since 0.1.0
	 */
	public $menu_slugs = '';
	/**
	 * The option key in database.
	 *
	 * @var Started_Plugin_Setting_Option_Key
	 * @since 0.1.0
	 */
	public $option_key = 'started_plugin';

	/**
	 * The option configs.
	 *
	 * @var Started_Plugin_Setting_Option_Configs
	 * @since 0.1.0
	 */
	public $option_configs = array();

	/**
	 * The setting tabs.
	 *
	 * @var Started_Plugin_Setting_Setting_Tabs
	 * @since 0.1.0
	 */
	public $setting_tabs = array();

	/**
	 * The single instance of the class.
	 *
	 * @var Started_Plugin_Setting_Instance
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
	 * @return Started_Plugin_Setting
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
		$current_tab = array();
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Settings', 'started-plugin' ); ?></h1>
			<?php if ( is_array( $this->setting_tabs ) && ! empty( $this->setting_tabs ) ) { ?>
				<?php
				if ( isset( $_GET['tab'] ) && sanitize_text_field( $_GET['tab'] ) !== '' ) {
					$current_tab_id = sanitize_text_field( $_GET['tab'] );
				} else {
					$current_tab_id = $this->setting_tabs[ key( $this->setting_tabs ) ]['tab_id'];
				}

				?>
				<form method="post" action="options.php">
					<nav class="nav-tab-wrapper">
						<?php
						foreach ( $this->setting_tabs as $tab_config ) {
							$tab_url = add_query_arg( array( 'tab' => $tab_config['tab_id'] ), menu_page_url( 'started-plugin', false ) );
							$extra_class = '';
							if ( $current_tab_id == $tab_config['tab_id'] ) {
								$extra_class = ' nav-tab-active';
							}
							?>
							<a href="<?php echo esc_url( $tab_url ); ?>" id="<?php echo esc_attr( $tab_config['tab_id'] ); ?>" class="nav-tab<?php echo esc_attr( $extra_class ); ?>"><?php echo esc_html( $tab_config['tab_title'] ); ?></a>
							<?php
						}
						?>
					</nav>
					<?php
					if ( isset( $this->setting_tabs[ $current_tab_id ]['sub_tabs'] ) && ! empty( $this->setting_tabs[ $current_tab_id ]['sub_tabs'] ) ) {
						?>
						<ul class="nav-sub-tabs list-sub-tabs">
							<?php
							if ( isset( $_GET['section'] ) && sanitize_text_field( $_GET['section'] ) !== '' ) {
								$current_section_id = sanitize_text_field( $_GET['section'] );
							} else {
								$current_section_id = $this->setting_tabs[ $current_tab_id ]['sub_tabs'][ key( $this->setting_tabs[ $current_tab_id ]['sub_tabs'] ) ]['tab_id'];
							}
							$count_sub = 1;
							foreach ( $this->setting_tabs[ $current_tab_id ]['sub_tabs'] as $sub_tab ) {
								$sub_tab_url = add_query_arg(
									array(
										'tab' => $current_tab_id,
										'section' => $sub_tab['tab_id'],
									),
									menu_page_url( 'started-plugin', false )
								);
								$section_active_class = '';
								if ( $current_section_id == $sub_tab['tab_id'] ) {
									$section_active_class = ' current-section';
								}

								?>
								<li>
									<a class="nav-sub-tab<?php echo esc_attr( $section_active_class ); ?>" href="<?php echo esc_url( $sub_tab_url ); ?>"><?php echo esc_html( $sub_tab['tab_title'] ); ?></a>
									<?php if ( $count_sub < count( $this->setting_tabs[ $current_tab_id ]['sub_tabs'] ) ) { ?>
										<span class="subtab-separator"><?php echo esc_html__( ' | ', 'started-plugin' ); ?></span>
									<?php } ?>
								</li>
								<?php
								$count_sub++;
							}
							?>
						</ul>
						<?php
					}
					?>

					<?php if ( ! empty( $current_tab ) ) { ?>
						<div class="form-content">
							<?php
								cmb2_get_metabox( $current_tab['id'], 'started-plugin', 'options-page' )->show_form();
							?>
						</div>
					<?php } ?>
					<?php submit_button(); ?>
				</form>
			<?php } ?>
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

	public function register_tab( $tab_id, $tab_title ) {
		$this->setting_tabs[ $tab_id ] = array(
			'tab_id' => sanitize_text_field( $tab_id ),
			'tab_title' => $tab_title,
		);
	}

	public function register_sub_tab( $tab_id, $parent_tab_id, $tab_title ) {
		if ( isset( $this->setting_tabs[ $parent_tab_id ] ) ) {
			$this->setting_tabs[ $parent_tab_id ]['sub_tabs'][ $tab_id ] = array(
				'tab_id' => sanitize_text_field( $tab_id ),
				'tab_title' => $tab_title,
			);
		}
	}

	public function set_tab_fields( $tab_id, $fields ) {
		self::$_instance->option_configs[] = $fields;
	}

	public function set_tab_file_configs( $tab_id, $file_configs ) {
		self::$_instance->option_configs[] = $fields;
	}

	public function set_sub_tab_fields( $tab_id, $parent_tab_id, $fields ) {

	}

	public function set_sub_tab_file_configs( $tab_id, $file_configs ) {

	}
}

function started_plugin_settings() {
	return Started_Plugin_Setting::instance();
}

if ( file_exists( STARTED_PLUGIN_DIR . 'inc/admin/setting-configs.php' ) ) {
	require_once STARTED_PLUGIN_DIR . 'inc/admin/setting-configs.php';
}
