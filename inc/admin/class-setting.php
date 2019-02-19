<?php
class Started_Plugin_Setting {
	/**
	 * The option key in database.
	 *
	 * @var Started_Plugin_Setting_Option_Key
	 * @since 0.1.0
	 */
	protected $option_key = 'started_plugin_settings';

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
	 * @var Started_Plugin_Tabs
	 * @since 0.1.0
	 */
	protected $tabs = array();

	/**
	 * The current tab.
	 *
	 * @var Started_Plugin_Current_Tab
	 * @since 0.1.0
	 */
	protected $current_tab = array();

	/**
	 * The current section.
	 *
	 * @var Started_Plugin_Current_Section
	 * @since 0.1.0
	 */
	protected $current_section = array();

	/**
	 * The current page slug.
	 *
	 * @var Started_Plugin_Current_Page_Slug
	 * @since 0.1.0
	 */
	protected $current_page_slug = array();

	/**
	 * The menu pages.
	 *
	 * @var Started_Plugin_Menu_Pages
	 * @since 0.1.0
	 */
	protected $menu_pages = array();

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
		add_action( 'cmb2_admin_init', array( $this, 'register_db_settings' ), 10 );
		add_action( 'admin_init', array( $this, 'admin_init' ), 1 );
	}
	/**
	 * Hook to cmb2_admin_init
	 */
	public function register_db_settings() {
		register_setting( $this->option_key, $this->option_key );
	}

	/**
	 * Admin init
	 *
	 * @return void
	 */
	public function admin_init() {
		if ( isset( $_GET['tab'] ) && sanitize_text_field( $_GET['tab'] ) !== '' ) {
			$this->current_tab = $this->option_configs[ sanitize_text_field( $_GET['tab'] ) ];
		} else {
			$this->current_tab = $this->option_configs[ key( $this->tabs ) ];
		}
		$current_tab = $this->current_tab;
		if ( isset( $current_tab['sub_tabs'] ) && ! empty( $current_tab['sub_tabs'] ) ) {
			if ( isset( $_GET['section'] ) && sanitize_text_field( $_GET['section'] ) !== '' ) {
				$this->current_section = $current_tab['sub_tabs'][ sanitize_text_field( $_GET['section'] ) ];
			} else {
				$this->current_section = $current_tab['sub_tabs'][ key( $current_tab['sub_tabs'] ) ];
			}
		}

		$current_admin_slug = '';
		if ( isset( $_GET['page'] ) && in_array( sanitize_text_field( $_GET['page'] ), $this->get_available_menu_slugs() ) ) {
			$current_admin_slug = sanitize_text_field( $_GET['page'] );
		}
		$this->current_page_slug = $current_admin_slug;
	}
	/**
	 * Get all registered menu slugs
	 *
	 * @return array
	 */
	public function get_available_menu_slugs() {
		$menu_slug = array();
		foreach ( $this->menu_pages as $menu ) {
			if ( isset( $menu['menu_slug'] ) && '' !== $menu['menu_slug'] ) {
				$menu_slug[] = $menu['menu_slug'];
			}
		}
		return $menu_slug;
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
		foreach ( $this->menu_pages as $menu_page ) {
			$default = array(
				'page_title' => '',
				'menu_title' => '',
				'capability' => 'manage_options',
				'menu_slug'  => '',
				'parent_slug' => '',
				'icon_url'   => '',
				'position'   => null,
			);
			$args = wp_parse_args( $menu_page, $default );
			if ( is_null( $args['parent_slug'] ) || '' == $args['parent_slug'] ) {
				add_menu_page( $args['page_title'], $args['menu_title'], $args['capability'], $args['menu_slug'], array( $this, 'page_content' ), $args['icon_url'], $args['position'] );
			} else {
				add_submenu_page( $args['parent_slug'], $args['page_title'], $args['menu_title'], $args['capability'], $args['menu_slug'], array( $this, 'page_content' ) );
			}
		}
	}

	public function add_settings_page( $args ) {
		$this->menu_pages[] = $args;
	}

	public function render_tabs() {
		$current_tab = $this->current_tab;
		if ( is_array( $this->tabs ) && ! empty( $this->tabs ) ) {
			?>
			<nav class="nav-tab-wrapper">
				<?php
				foreach ( $this->tabs as $tab_config ) {
					$tab_url = add_query_arg( array( 'tab' => $tab_config['tab_id'] ), menu_page_url( $this->current_page_slug, false ) );
					$extra_class = '';
					if ( $current_tab['id'] == $tab_config['tab_id'] ) {
						$extra_class = ' nav-tab-active';
					}
					?>
					<a href="<?php echo esc_url( $tab_url ); ?>" id="<?php echo esc_attr( $tab_config['tab_id'] ); ?>" class="nav-tab<?php echo esc_attr( $extra_class ); ?>"><?php echo esc_html( $tab_config['tab_title'] ); ?></a>
					<?php
				}
				?>
			</nav>
			<?php
		}
	}

	public function render_sub_tab() {
		$all_tabs = $this->tabs;
		$current_tab = $this->current_tab;
		$current_section = $this->current_section;
		if ( isset( $all_tabs[ $current_tab['id'] ]['sub_tabs'] ) && ! empty( $all_tabs[ $current_tab['id'] ]['sub_tabs'] ) ) {
			$current_sub_tabs = $all_tabs[ $current_tab['id'] ]['sub_tabs'];
			?>
			<ul class="nav-sub-tabs list-sub-tabs">
				<?php
				$count_sub = 1;
				foreach ( $current_sub_tabs as $sub_tab ) {
					$sub_tab_url = add_query_arg(
						array(
							'tab' => $current_tab['id'],
							'section' => $sub_tab['tab_id'],
						),
						menu_page_url( $this->current_page_slug, false )
					);
					$section_active_class = '';
					if ( $current_section['id'] == $sub_tab['tab_id'] ) {
						$section_active_class = ' current-section';
					}
					?>
					<li>
						<a class="nav-sub-tab<?php echo esc_attr( $section_active_class ); ?>" href="<?php echo esc_url( $sub_tab_url ); ?>"><?php echo esc_html( $sub_tab['tab_title'] ); ?></a>
						<?php if ( $count_sub < count( $current_sub_tabs ) ) { ?>
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
	}

	public function render_form_content() {
		?>
		<div class="form-content">
			<?php
			cmb2_metabox_form( $this->option_metabox(), $this->option_key );
			?>
		</div>
		<?php
	}

	/**
	 * Render setting page content
	 */
	public function page_content() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<?php $this->render_tabs(); ?>
			<?php $this->render_sub_tab(); ?>
			<?php $this->render_form_content(); ?>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Set option config for cmb2 form
	 *
	 * @return array
	 */
	public function option_metabox() {
		$current_tab = $this->current_tab;
		$current_section = $this->current_section;
		$current_section_id = $current_section['id'];
		$fields = array();
		if ( isset( $current_section_id ) && '' !== $current_section_id && in_array( $current_section_id, array_keys( $current_tab['sub_tabs'] ) ) ) {
			$fields = $current_section['fields'];
		} else if ( isset( $current_tab['fields'] ) && ! empty( $current_tab['fields'] ) ) {
			$fields = $current_tab['fields'];
		}
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
	 * @param [string] $menu_slug
	 * @return void
	 */
	public function register_tab( $tab_id, $tab_title, $menu_slug = '' ) {
		$this->tabs[ $tab_id ] = array(
			'tab_id'    => sanitize_text_field( $tab_id ),
			'tab_title' => $tab_title,
			'menu_slug' => $menu_slug,
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
