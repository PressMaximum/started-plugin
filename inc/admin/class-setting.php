<?php
class Started_Plugin_Setting {
	/**
	 * The option page slug.
	 *
	 * @var Started_Plugin_Setting_Menu_Slug
	 * @since 0.1.0
	 */
	protected $menu_slugs = '';
	/**
	 * The option key in database.
	 *
	 * @var Started_Plugin_Setting_Option_Key
	 * @since 0.1.0
	 */
	protected $option_key = 'started_plugin';

	/**
	 * The option configs.
	 *
	 * @var Started_Plugin_Setting_Option_Configs
	 * @since 0.1.0
	 */
	protected $option_configs = array();

	/**
	 * The setting tabs.
	 *
	 * @var Started_Plugin_tabs
	 * @since 0.1.0
	 */
	protected $tabs = array();

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
		add_action( 'admin_menu', array( $this, 'add_menu_pages' ), 90 );
		add_action( 'cmb2_admin_init', array( $this, 'admin_init' ) );
	}
	/**
	 * Hook to cmb2_admin_init
	 */
	public function admin_init() {
		register_setting( $this->option_key, $this->option_key );
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

	/**
	 * Add menu setting page
	 */
	public function add_menu_pages() {
		add_menu_page( esc_html__( 'Started Plugin', 'started-plugin' ), esc_html__( 'Started Plugin', 'started-plugin' ), 'manage_options', 'started-plugin', array( $this, 'page_content' ) );
		// add_submenu_page( 'started-plugin', esc_html__( 'Settings', 'started-plugin' ), esc_html__( 'Settings', 'started-plugin' ), 'manage_options', 'started-plugin', array( $this, 'page_content' ) ); .
	}

	/**
	 * Render setting page content
	 */
	public function page_content() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php if ( is_array( $this->tabs ) && ! empty( $this->tabs ) ) { ?>
				<?php
				if ( isset( $_GET['tab'] ) && sanitize_text_field( $_GET['tab'] ) !== '' ) {
					$current_tab_id = sanitize_text_field( $_GET['tab'] );
				} else {
					$current_tab_id = $this->tabs[ key( $this->tabs ) ]['tab_id'];
				}
				?>
					<nav class="nav-tab-wrapper">
						<?php
						foreach ( $this->tabs as $tab_config ) {
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
					if ( isset( $this->tabs[ $current_tab_id ]['sub_tabs'] ) && ! empty( $this->tabs[ $current_tab_id ]['sub_tabs'] ) ) {
						?>
						<ul class="nav-sub-tabs list-sub-tabs">
							<?php
							if ( isset( $_GET['section'] ) && sanitize_text_field( $_GET['section'] ) !== '' ) {
								$current_section_id = sanitize_text_field( $_GET['section'] );
							} else {
								$current_section_id = $this->tabs[ $current_tab_id ]['sub_tabs'][ key( $this->tabs[ $current_tab_id ]['sub_tabs'] ) ]['tab_id'];
							}
							$count_sub = 1;
							foreach ( $this->tabs[ $current_tab_id ]['sub_tabs'] as $sub_tab ) {
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
									<?php if ( $count_sub < count( $this->tabs[ $current_tab_id ]['sub_tabs'] ) ) { ?>
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

					if ( isset( $this->option_configs[ $current_tab_id ] ) ) {
						$current_form_fields = $this->get_current_form_fields( $current_tab_id, $current_section_id );
						if ( ! empty( $current_form_fields ) ) {
							?>
							<div class="form-content">
								<?php
								cmb2_metabox_form( $this->option_metabox( $current_form_fields ), $this->option_key );
								?>
							</div>
							<?php
						}
					}

					?>
			<?php } ?>
		</div>
		<div class="clear"></div>
		<?php
	}
	/**
	 * Get form field config of current tab
	 *
	 * @param [string] $current_tab_id
	 * @param [string] $current_section_id
	 * @return array
	 */
	public function get_current_form_fields( $current_tab_id, $current_section_id ) {
		$current_configs = $this->option_configs[ $current_tab_id ];
		$current_form_fields = array();
		if ( isset( $current_configs['sub_tabs'] ) && ! empty( $current_configs['sub_tabs'] ) ) {
			if ( isset( $current_configs['sub_tabs'][ $current_section_id ] ) && ! empty( $current_configs['sub_tabs'][ $current_section_id ] ) ) {
				$current_section_config = $current_configs['sub_tabs'][ $current_section_id ];
				if ( isset( $current_section_config['fields'] ) && ! empty( $current_section_config['fields'] ) ) {
					$current_form_fields = $current_section_config['fields'];
				}
			}
		} elseif ( isset( $current_configs['fields'] ) && ! empty( $current_configs['fields'] ) ) {
			$current_form_fields = $current_configs['fields'];
		}
		return $current_form_fields;
	}

	/**
	 * Set option config for cmb2 form
	 *
	 * @param [array] $fields
	 * @return array
	 */
	public function option_metabox( $fields ) {
		return array(
			'id'         => 'form_settings',
			'show_on'    => array(
				'key' => 'options-page',
				'value' => array( $this->option_key ),
			),
			'show_names' => true,
			'fields'     => $fields,
		);
	}

	/**
	 * Register tab
	 *
	 * @param [string] $tab_id
	 * @param [string] $tab_title
	 * @return void
	 */
	public function register_tab( $tab_id, $tab_title ) {
		$this->tabs[ $tab_id ] = array(
			'tab_id' => sanitize_text_field( $tab_id ),
			'tab_title' => $tab_title,
		);
	}
	/**
	 * Register sub tab
	 *
	 * @param [string] $tab_id
	 * @param [string] $parent_tab_id
	 * @param [string] $tab_title
	 * @return void
	 */
	public function register_sub_tab( $tab_id, $parent_tab_id, $tab_title ) {
		if ( isset( $this->tabs[ $parent_tab_id ] ) ) {
			$this->tabs[ $parent_tab_id ]['sub_tabs'][ $tab_id ] = array(
				'tab_id' => sanitize_text_field( $tab_id ),
				'tab_title' => $tab_title,
			);
		}
	}

	/**
	 * Set tab fields configs
	 *
	 * @param [string] $tab_id
	 * @param [array]  $fields
	 * @return void
	 */
	public function set_tab_fields( $tab_id, $fields ) {
		if ( '' !== $tab_id && is_array( $fields ) && ! empty( $fields ) ) {
			$fields = apply_filters( 'started_plugin_set_tab_fields', $fields, $tab_id );
			if ( isset( $this->option_configs[ $tab_id ] ) && isset( $this->option_configs[ $tab_id ]['fields'] ) ) {
				$this->option_configs[ $tab_id ]['fields'] = array_merge( $this->option_configs[ $tab_id ]['fields'], $fields );
			} else {
				$this->option_configs[ $tab_id ] = array(
					'id' => $tab_id,
					'fields' => $fields,
				);
			}
		}
	}
	/**
	 * Set tab fields configs via file
	 *
	 * @param [string] $tab_id
	 * @param [string] $file_configs
	 * @return void
	 */
	public function set_tab_file_configs( $tab_id, $file_configs ) {
		$file_configs = apply_filters( 'started_plugin_set_tab_file_configs', $file_configs, $tab_id );
		if ( file_exists( $file_configs ) || file_exists( STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/' . $file_configs ) ) {
			$file_config_dir = $file_configs;
			if ( ! file_exists( $file_config_dir ) ) {
				$file_config_dir = STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/' . $file_configs;

			}
			$configs = include $file_config_dir;
			if ( '' !== $tab_id && is_array( $configs ) && ! empty( $configs ) ) {
				$this->set_tab_fields( $tab_id, $configs );
			}
		}
	}
	/**
	 * Set sub tab fields
	 *
	 * @param [string] $sub_tab_id
	 * @param [string] $parent_tab_id
	 * @param [array]  $fields
	 * @return void
	 */
	public function set_sub_tab_fields( $sub_tab_id, $parent_tab_id, $fields ) {
		if ( '' !== $sub_tab_id && '' !== $parent_tab_id && is_array( $fields ) && ! empty( $fields ) ) {
			$fields = apply_filters( 'started_plugin_set_sub_tab_fields', $fields, $sub_tab_id, $parent_tab_id );
			if ( isset( $this->option_configs[ $parent_tab_id ] ) ) {
				if ( isset( $this->option_configs[ $parent_tab_id ]['sub_tabs'][ $sub_tab_id ] ) && isset( $this->option_configs[ $parent_tab_id ]['sub_tabs'][ $sub_tab_id ]['fields'] ) ) {
					$this->option_configs[ $parent_tab_id ]['sub_tabs'][ $sub_tab_id ]['fields'] = array_merge( $this->option_configs[ $parent_tab_id ]['sub_tabs'][ $sub_tab_id ]['fields'], $fields );
				} else {
					$this->option_configs[ $parent_tab_id ]['sub_tabs'][ $sub_tab_id ] = array(
						'id' => $sub_tab_id,
						'fields' => $fields,
					);
				}
			} else {
				$this->option_configs[ $parent_tab_id ] = array(
					'id' => $parent_tab_id,
					'fields' => array(),
					'sub_tabs' => array(
						$sub_tab_id => array(
							'id' => $sub_tab_id,
							'fields' => $fields,
						),
					),
				);
			}
		}
	}
	/**
	 * Set sub tab fields via file
	 *
	 * @param [string] $sub_tab_id
	 * @param [string] $parent_tab_id
	 * @param [string] $file_configs
	 * @return void
	 */
	public function set_sub_tab_file_configs( $sub_tab_id, $parent_tab_id, $file_configs ) {
		$file_configs = apply_filters( 'started_plugin_set_sub_tab_file_configs', $file_configs, $sub_tab_id, $parent_tab_id );
		if ( file_exists( $file_configs ) || file_exists( STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/' . $file_configs ) ) {
			$file_config_dir = $file_configs;
			if ( ! file_exists( $file_config_dir ) ) {
				$file_config_dir = STARTED_PLUGIN_DIR . 'inc/admin/setting-configs/' . $file_configs;
			}
			$configs = include $file_config_dir;
			if ( '' !== $sub_tab_id && '' !== $parent_tab_id && is_array( $configs ) && ! empty( $configs ) ) {
				$this->set_sub_tab_fields( $sub_tab_id, $parent_tab_id, $configs );
			}
		}
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 *
	 * @since  0.1.0
	 * @param  string $field Field to retrieve.
	 * @return mixed Field value or null.
	 */
	public function __get( $field ) {
		if ( in_array( $field, array( 'menu_slugs', 'option_key', 'option_configs', 'tabs' ), true ) ) {
			return $this->{$field};
		}
		return null;
	}

	/**
	 * Get setting
	 *
	 * @param string $setting_key
	 * @param string $default_value
	 * @return mixed Field value or default value
	 */
	public function get_setting( $setting_key = '', $default_value = '' ) {
		if ( function_exists( 'cmb2_get_option' ) ) {
			return cmb2_get_option( $this->option_key, $setting_key, $default_value );
		} else {
			$options = get_option( $this->option_key );
			return isset( $options[ $setting_key ] ) ? $options[ $setting_key ] : $default_value;
		}
	}

}

function started_plugin_settings() {
	return Started_Plugin_Setting::instance();
}

if ( file_exists( STARTED_PLUGIN_DIR . 'inc/admin/setting-configs.php' ) ) {
	require_once STARTED_PLUGIN_DIR . 'inc/admin/setting-configs.php';
}
