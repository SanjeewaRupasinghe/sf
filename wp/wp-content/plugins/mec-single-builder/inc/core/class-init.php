<?php

namespace MEC_Single_Builder\Inc\Core;

use MEC\Settings\Settings;
use MEC_Single_Builder as NS;
use MEC_Single_Builder\Inc\Admin as Admin;
use MEC_Single_Builder\Inc\Frontend as Frontend;
/**
 * The core plugin class.
 * Defines internationalization, admin-specific hooks, and public-facing site hooks.
 *
 * @link       https://webnus.net
 * @since      1.0.0
 *
 * @author     Webnus
 */
class Init {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_base_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_basename;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The text domain of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $plugin_text_domain;

	/**
	 * Initialize and define the core functionality of the plugin.
	 */
	public function __construct() {

		$this->plugin_name = NS\PLUGIN_NAME;
		$this->version = NS\PLUGIN_VERSION;
		$this->plugin_basename = NS\PLUGIN_BASENAME;
		$this->plugin_text_domain = NS\PLUGIN_TEXT_DOMAIN;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Loads the following required dependencies for this plugin.
	 *
	 * - Loader - Orchestrates the hooks of the plugin.
	 * - Internationalization_I18n - Defines internationalization functionality.
	 * - Admin - Defines all hooks for the admin area.
	 * - Frontend - Defines all hooks for the public side of the site.
	 *
	 * @access    private
	 */
	private function load_dependencies() {
		$this->loader = new Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Internationalization_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @access    private
	 */
	private function set_locale() {

		$plugin_i18n = new Internationalization_I18n( $this->plugin_text_domain );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @access    private
	 */
	private function define_admin_hooks() {

		$plugin_requirements = new Controller\Requirements();
        
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) ) {
			return;
		}

		$plugin_admin = new Admin\Admin( $this->get_plugin_name(), $this->get_version(), $this->get_plugin_text_domain() );

		$widgets = new Admin\Elementor_ESB();

		// Register post type
		$this->loader->add_action( 'init', $plugin_admin, 'mec_esb_post_type' );
		$this->loader->add_action( 'after_mec_submenu_action', $plugin_admin, 'esb_submenu' );
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'sb_metabox', 10);

		$this->loader->add_action('save_post_mec-events', $plugin_admin, 'save_event', 10, 1);
		// $this->loader->add_action( 'admin_menu', $plugin_admin, 'disable_mec_esb_page' ); // Disable /edit.php?post_type=mec_esb

		// Load Single file
		$this->loader->add_filter( 'single_template',  $plugin_admin, 'esb_single' );

		// Load content in single
		$this->loader->add_action( 'mec_esb_content', $plugin_admin, 'load_the_builder', 10 , 1 );
		$this->loader->add_action('mec-ajax-load-single-page-before', $plugin_admin, 'load_the_builder_modal', 10 , 1 );


		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action('mec_single_style_setting_after', $plugin_admin, 'add_settings' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'show_setup_popup' );
		}

		$this->loader->add_action('wp_ajax_esb_single_style_apply', $plugin_admin, 'apply_single_style' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @access    private
	 */
	private function define_public_hooks() {

		$plugin_public = new Frontend\Frontend( $this->get_plugin_name(), $this->get_version(), $this->get_plugin_text_domain() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 12 );

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
			add_filter('template_include', function($original){
				$mainClass = new \MEC_main();
				$PT = $mainClass->get_main_post_type();
				$baseClass = new \MEC_parser();
				$file = $baseClass->getFile();

				$single_template_style = Settings::getInstance()->get_settings('single_single_style');
				if(is_single() and get_post_type() == $PT && 'builder' === $single_template_style)
				{
					$template = locate_template('single-'.$PT.'.php');
					if($template == '')
					{
						$wp_template = get_template();
						$wp_stylesheet = get_stylesheet();

						$wp_template_file = NS\PLUGIN_ABSPATH .DS .'templates'.DS.'themes'.DS.$wp_template.DS.'single-mec-events.php';
						$wp_stylesheet_file = NS\PLUGIN_ABSPATH .DS .'templates'.DS.'themes'.DS.$wp_template.DS.'childs'.DS.$wp_stylesheet.DS.'single-mec-events.php';

						if($file->exists($wp_stylesheet_file)) $template = $wp_stylesheet_file;
						elseif($file->exists($wp_template_file)) $template = $wp_template_file;
						else $template = NS\PLUGIN_ABSPATH .DS .'templates'.DS.'single-mec-events.php';
						return $template;
					}
				}
				return $original;
			}, 99999999999);
		}

		add_filter('mec_single_builder_editor_mode', [ __CLASS__, 'filter_is_editor_mode' ] );
		add_filter('mec_get_event_id_for_widget', [ __CLASS__, 'filter_get_event_id_for_widget' ], 10, 2 );

	}

	public static function filter_is_editor_mode( $is_editor_mode ){

		return
			( isset($_GET['preview_id']) && !empty($_GET['preview_id']) )
			||
			\Elementor\Plugin::$instance->editor->is_edit_mode();
	}

	public static function filter_get_event_id_for_widget( $event_id, $is_editor_mode ){

		if( !$is_editor_mode ){

			if( !$event_id && wp_doing_ajax() ){

				return get_the_ID();
			}

			return $event_id;
		}

		$custom_event_id = (int)\MEC\Settings\Settings::getInstance()->get_settings('custom_event_for_set_settings');
		if($custom_event_id){

			return $custom_event_id;
		}

		return $event_id;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the text domain of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The text domain of the plugin.
	 */
	public function get_plugin_text_domain() {
		return $this->plugin_text_domain;
	}

}