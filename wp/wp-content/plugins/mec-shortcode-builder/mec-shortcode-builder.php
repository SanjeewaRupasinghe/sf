<?php
/**
 * Plugin Name: Elementor Shortcode Builder for MEC
 * Plugin URI: http://webnus.net/modern-events-calendar/
 * Description: This plugin makes it possible to visually create MEC shortcodes in Elementor.
 * Author: Webnus
 * Version: 1.6.0
 * Text Domain: mec-shortcode-builder
 * Domain Path: /languages
 * Author URI: http://webnus.net
 **/

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Shortcode_Builder' ) ) {

	class MEC_Shortcode_Builder {

		/**
		 * Version of MEC Shortcode Builder
		 *
		 * @since   1.0.0
		 */
		public static $version;

		/**
		 * Directory
		 *
		 * @since   1.0.0
		 */
		public static $dir;

		/**
		 * Plugin url
		 *
		 * @since   1.0.0
		 */
		public static $url;

		/**
		 * Plugin assets url
		 *
		 * @since   1.0.0
		 */
		public static $assets;

		/**
		 * Instance of MEC_Shortcode_Builder
		 *
		 * @since   1.0.0
		 */
		private static $instance = null;

		/**
		 * The object is created from within the class itself
		 * only if the class has no instance.
		 *
		 * @since   1.0.0
		 * @return   MEC_Shortcode_Builder
		 */
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Construct
		 *
		 * @since     1.0.0
		 */
		public function __construct() {
			/** Plugin Base Name */
			if ( ! defined( 'SHB_BASENAME' ) ) {
				define( 'SHB_BASENAME', plugin_basename( __FILE__ ) );
			}

			/** Plugin Version */
			if ( ! defined( 'SHB_VERSION' ) ) {
				define( 'SHB_VERSION', '1.6.0' );
			}
			if ( ! defined( 'SHB_PLUGIN_ABSPATH' ) ) {
				define( 'SHB_PLUGIN_ABSPATH',dirname(__FILE__) );
			}
			$this->definitions();
			$this->load();
			$this->add_actions();
			$this->add_option();
		}

		/**
		 * Definitions
		 *
		 * @since     1.0.0
		 */
		public function definitions() {
			self::$version = '1.6.0';
			self::$dir     = plugin_dir_path( __FILE__ );
			self::$url     = plugin_dir_url( __FILE__ );
			self::$assets  = self::$url . 'assets/dist/';
		}

		/**
		 * Add Actions
		 *
		 * @since     1.0.0
		 */
		public function add_actions() {
			add_action( 'plugins_loaded', array( $this, 'load_languages' ) );
			add_action(
				'elementor/preview/enqueue_styles',
				function() {
					$MEC_main = new MEC_main();
					$MEC_main->load_owl_assets();
				},
				0
			);
			add_action(
				'elementor/preview/enqueue_scripts',
				function() {
					$MEC_main = new MEC_main();
					wp_enqueue_script( 'mec-shuffle-script', $MEC_main->asset( 'js/shuffle.min.js' ) );
					wp_enqueue_script( 'mec-frontend-script', $MEC_main->asset( 'js/frontend.js' ) );
					// Localize Some Strings
					$settings = $MEC_main->get_settings();
					$grecaptcha_key = isset($settings['google_recaptcha_sitekey']) ? trim($settings['google_recaptcha_sitekey']) : '';

					// Localize Some Strings
					$mecdata = apply_filters('mec_locolize_data', array(
						'day'=>__('day', 'mec-shortcode-builder'),
						'days'=>__('days', 'mec-shortcode-builder'),
						'hour'=>__('hour', 'mec-shortcode-builder'),
						'hours'=>__('hours', 'mec-shortcode-builder'),
						'minute'=>__('minute', 'mec-shortcode-builder'),
						'minutes'=>__('minutes', 'mec-shortcode-builder'),
						'second'=>__('second', 'mec-shortcode-builder'),
						'seconds'=>__('seconds', 'mec-shortcode-builder'),
						'elementor_edit_mode' => \Elementor\Plugin::$instance->editor->is_edit_mode(),
						'recapcha_key'=>$grecaptcha_key,
						'ajax_url' => admin_url('admin-ajax.php'),
						'fes_nonce' => wp_create_nonce('mec_fes_nonce'),
						'current_year' => date('Y', current_time('timestamp', 0)),
						'datepicker_format' => (isset($settings['datepicker_format']) and trim($settings['datepicker_format'])) ? trim($settings['datepicker_format']) : 'yy-mm-dd',
					));
					
					// Localize Some Strings
					wp_localize_script('mec-frontend-script', 'mecdata', $mecdata);
				},
				0
			);

			// Theme Builder Integration
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
				add_filter('template_include', function($original){
					$mainClass = new MEC_main();
					$PT = $mainClass->get_main_post_type();
					$baseClass = new MEC_parser();
					$file = $baseClass->getFile();
					if(is_post_type_archive($PT) && !is_search())
					{
						$template = locate_template('archive-'.$PT.'.php');
						if($template == '')
						{
							$wp_template = get_template();
							$wp_stylesheet = get_stylesheet();
							
							$wp_template_file = SHB_PLUGIN_ABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'archive-mec-events.php';
							$wp_stylesheet_file = SHB_PLUGIN_ABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'childs'.DS.$wp_stylesheet.DS.'archive-mec-events.php';
							
							if($file->exists($wp_stylesheet_file)) $template = $wp_stylesheet_file;
							elseif($file->exists($wp_template_file)) $template = $wp_template_file;
							else $template = SHB_PLUGIN_ABSPATH.DS.'templates'.DS.'archive-mec-events.php';
							return $template;
						}
					}
					elseif(is_tax('mec_category'))
					{
						$template = locate_template('taxonomy-mec-category.php');
						if($template == '')
						{
							$wp_template = get_template();
							$wp_stylesheet = get_stylesheet();
							
							$wp_template_file = SHB_PLUGIN_ABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'taxonomy-mec-category.php';
							$wp_stylesheet_file = SHB_PLUGIN_ABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'childs'.DS.$wp_stylesheet.DS.'taxonomy-mec-category.php';
							
							if($file->exists($wp_stylesheet_file)) $template = $wp_stylesheet_file;
							elseif($file->exists($wp_template_file)) $template = $wp_template_file;
							else $template = SHB_PLUGIN_ABSPATH.DS.'templates'.DS.'taxonomy-mec-category.php';
							return $template;
						}
					}
					return $original;
				}, 99999999999);
			}
		
		}

		/**
		 * Description
		 *
		 * @since     1.0.0
		 */
		public function add_option() {
			$addon_information = array(
				'product_name'  => '',
				'purchase_code' => '',
			);
			$has_option        = get_option( 'mec_shb_options', 'false' );
			if ( $has_option == 'false' ) {
				add_option( 'mec_shb_options', $addon_information );
			}
		}
		
		/**
		 * Load The Plugin
		 *
		 * @since     1.0.0
		 */
		public function load() {
			require_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'base.php';
			require_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'autoloader.php';
			require_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';
		}

		/**
		 * Load Languages
		 *
		 * @since     1.0.0
		 */
		public function load_languages() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'mec-shortcode-builder' );

			// WordPress language directory /wp-content/languages/mec-en_US.mo
			$language_filepath = WP_LANG_DIR . DIRECTORY_SEPARATOR . 'mec-sb-' . $locale . '.mo';

			// If language file exists on WordPress language directory use it
			if ( file_exists( $language_filepath ) ) {
				load_textdomain( 'mec-shortcode-builder', $language_filepath );
			} else {
				load_plugin_textdomain( 'mec-shortcode-builder', false, dirname( plugin_basename( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR );
			}
		}
	}
	\MEC_Shortcode_Builder::get_instance();
}
