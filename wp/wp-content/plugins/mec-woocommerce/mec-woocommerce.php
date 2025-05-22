<?php
/**
 *	Plugin Name: WooCommerce Integration for MEC
 *	Plugin URI: http://webnus.net/modern-events-calendar/
 *	Description: You can purchase ticket and WooCommerce products at the same time.
 *	Author: Webnus
 *	Version: 1.2.6
 *	Text Domain: mec-woocommerce
 *	Domain Path: /languages
 *	Author URI: http://webnus.net
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Woocommerce' ) ) {

	class MEC_Woocommerce {

		/**
		* Version of WooCommerce Integration
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
		* Instance of MEC_Woocommerce
		*
		* @since 1.0.0
		*/
		private static $instance = null;

		/**
		* The object is created from within the class itself
		* only if the class has no instance.
		*
		* @since  1.0.0
		* @return MEC_Woocommerce
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
		* @since 1.0.0
		*/
		public function __construct() {

			/** Plugin Base Name */
			if ( ! defined( 'WOO_BASENAME' ) ) {
				define( 'WOO_BASENAME', plugin_basename( __FILE__ ) );
			}

			/** Plugin Version */
			if ( ! defined( 'WOO_VERSION' ) ) {
				define( 'WOO_VERSION', '1.2.6' );
			}

			$this->add_actions();
			$this->definitions();
			$this->load();
			register_deactivation_hook( __FILE__, [ 'MEC_Woocommerce', 'uninstall' ] );
			$this->add_option();
		}
		/**
		* Definitions
		*
		* @since 1.0.0
		*/
		public function definitions() {
			self::$version = '1.2.6';
			self::$dir     = plugin_dir_path( __FILE__ );
			self::$url     = plugin_dir_url( __FILE__ );
			self::$assets  = self::$url . 'assets/';
		}

		/**
		* Add Actions
		*
		* @since 1.0.0
		*/
		public function add_actions() {
			add_action( 'wp_loaded', [ $this, 'load_languages' ] );
			add_action( 'wp_loaded', [ $this, 'install' ] );
		}

		/**
		* Add Option
		*
		* @since     1.0.0
		*/
		public function add_option() {
			$addon_information = array(
				'product_name'  => '',
				'purchase_code' => '',
			);
			$has_option        = get_option( 'mec_woo_options', 'false' );
			if ( $has_option == 'false' ) {
				add_option( 'mec_woo_options', $addon_information );
			}
		}

		/**
		* Load The Plugin
		*
		* @since 1.0.0
		*/
		public function load() {
			include_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'base.php';
			include_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'autoloader.php';
			include_once self::$dir . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';
		}

		/**
		* Load Languages
		*
		* @since 1.0.0
		*/
		public function load_languages() {
			$locale = apply_filters('plugin_locale', get_locale(), 'mec-woocommerce');

			// WordPress language directory /wp-content/languages/mec-en_US.mo
			$language_filepath = self::$dir . 'languages' . DIRECTORY_SEPARATOR . 'mec-woocommerce-' . $locale . '.mo';
			// If language file exists on WordPress language directory use it
			if (file_exists($language_filepath)) {
				load_textdomain('mec-woocommerce', $language_filepath);
			} else {
				load_plugin_textdomain('mec-woocommerce', false, dirname(plugin_basename(__FILE__)) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR);
			}
		}

		/**
		* Uninstall
		*
		* @since     1.0.0
		*/
		public static function uninstall() {
			$allProducts = get_posts(
				array(
					'post_type'   => 'product',
					'numberposts' => -1,
					'post_status' => 'mec_tickets',
				)
			);
			foreach ( $allProducts as $product ) {
				if ( $product->post_status == 'mec_tickets' ) {
					wp_update_post(
						[
							'ID'        => $product->ID,
							'post_type' => 'mec-product',
						]
					);
				}
			}
			// die();
		}

		/**
		* Install
		*
		* @since     1.0.0
		*/
		public function install() {
			$allProducts = get_posts(
				array(
					'post_type'   => 'mec-product',
					'numberposts' => -1,
					'post_status' => 'mec_tickets',
				)
			);

			foreach ( $allProducts as $product ) {
				if ( $product->post_status == 'mec_tickets' ) {
					wp_update_post(
						[
							'ID'        => $product->ID,
							'post_type' => 'product',
						]
					);
				}
			}
		}
	}

	add_action(
		'plugin_loaded',
		function() {
			MEC_Woocommerce::get_instance();
		}
	);
}
