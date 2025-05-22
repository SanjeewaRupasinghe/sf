<?php

/**
 * Plugin Name: Elementor Form Builder for MEC
 * Plugin URI: http://webnus.net/modern-events-calendar/
 * Description: This plugin makes it possible to visually create MEC forms in Elementor.
 * Author: Webnus
 * Version: 1.0.8
 * Text Domain: mec-form-builder
 * Domain Path: /languages
 * Author URI: http://webnus.net
 **/

// Don't load directly.
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('MEC_Form_Builder')) {

	class MEC_Form_Builder
	{

		/**
		 * Version of Elementor Form Builder
		 *
		 * @since 1.0.0
		 */
		public static $version;

		/**
		 * Directory
		 *
		 * @since 1.0.0
		 */
		public static $dir;

		/**
		 * Plugin url
		 *
		 * @since 1.0.0
		 */
		public static $url;

		/**
		 * Plugin assets url
		 *
		 * @since 1.0.0
		 */
		public static $assets;

		/**
		 * Instance of MEC_Form_Builder
		 *
		 * @since 1.0.0
		 */
		private static $instance = null;

		/**
		 * The object is created from within the class itself
		 * only if the class has no instance.
		 *
		 * @since  1.0.0
		 * @return MEC_Form_Builder
		 */
		public static function get_instance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Construct
		 *
		 * @since 1.0.0
		 */
		public function __construct()
		{

			/** Plugin Base Name */
			if (!defined('EFB_BASENAME')) {
				define('EFB_BASENAME', plugin_basename(__FILE__));
			}

			/** Plugin Version */
			if (!defined('EFB_VERSION')) {
				define('EFB_VERSION', '1.0.8');
			}
			$this->add_actions();
			$this->definitions();
			$this->load();
			$this->add_option();
		}

		/**
		 * Definitions
		 *
		 * @since 1.0.0
		 */
		public function definitions()
		{
			self::$version = '1.0.8';
			self::$dir     = plugin_dir_path(__FILE__);
			self::$url     = plugin_dir_url(__FILE__);
			self::$assets  = self::$url . 'assets/';
		}

		/**
		 * Add Actions
		 *
		 * @since 1.0.0
		 */
		public function add_actions()
		{
			add_action('plugins_loaded', [$this, 'load_languages']);
		}

		/**
		 * Add Option
		 *
		 * @since     1.0.0
		 */
		public function add_option()
		{
			$addon_information = array(
				'product_name'  => '',
				'purchase_code' => '',
			);
			$has_option        = get_option('mec_formbuilder_options', 'false');
			if ($has_option == 'false') {
				add_option('mec_formbuilder_options', $addon_information);
			}
		}

		/**
		 * Load The Plugin
		 *
		 * @since 1.0.0
		 */
		public function load()
		{
			include_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'base.php';
			include_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'autoloader.php';
			include_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';
		}

		/**
		 * Load Languages
		 *
		 * @since 1.0.0
		 */
		public function load_languages()
		{
			$locale = apply_filters('plugin_locale', get_locale(), 'mec-form-builder');

			// WordPress language directory /wp-content/languages/mec-en_US.mo
			$language_filepath = self::$dir . 'languages' . DIRECTORY_SEPARATOR . 'mec-form-builder-' . $locale . '.mo';
			// If language file exists on WordPress language directory use it
			if (file_exists($language_filepath)) {
				load_textdomain('mec-form-builder', $language_filepath);
			} else {
				load_plugin_textdomain('mec-form-builder', false, dirname(plugin_basename(__FILE__)) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR);
			}
		}
	}
	MEC_Form_Builder::get_instance();
}
