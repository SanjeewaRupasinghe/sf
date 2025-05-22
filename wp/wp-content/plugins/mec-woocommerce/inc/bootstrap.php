<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! MEC_Woocommerce_Base::check_plugins() ) {
	return;
}

if ( ! class_exists( 'MEC_Woocommerce_Bootstrap' ) ) :
	/**
	* MEC_Woocommerce_Bootstrap.
	*
	* @author     Webnus Team
	* @since      1.0.0
	*/
	class MEC_Woocommerce_Bootstrap extends MEC_Woocommerce_Base {


		private static $files;
		/**
		* Instance of MEC_Woocommerce
		*
		* @since   1.0.0
		*/
		private static $instance = null;

		public static $dir;

		/**
		* The object is created from within the class itself
		* only if the class has no instance.
		*
		* @since   1.0.0
		* @return   MEC_Woocommerce_Bootstrap
		*/
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		* Register a file to include
		*
		* @since     1.0.0
		*/
		public function __construct() {
			$this->definitions();
			$this->add_autoload_files();

			add_action(
				'after_MEC_gateway',
				function() {
					$this->run( 'MEC.gateway' );
				},
				10
			);

			add_action(
				'init',
				function() {
					$this->run( 'woocommerce.controller' );
				},
				10
			);

			add_action(
				'init',
				function() {
					$this->run( 'features.woo.license' );
				},
				10
			);

			add_action(
				'init',
				function() {
					$this->run( 'features.woo.activate' );
				},
				10
			);

			add_action( 'plugins_loaded', [ $this, 'actions' ] );

			add_action(
				'admin_init',
				function() {
					if ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'product' ) {
						add_action(
							'admin_head',
							function () {
								ob_start(
									function ( $buffer ) {
										$my_query = new WP_Query(
											[
												'post_type' => 'product',
												'post_status__not_in' => 'MEC_Tickets',
											]
										);
										$count    = $my_query->post_count;
										$buffer   = preg_replace( "/<li class='all'>(.*?)<span class=\"count\">(.*?)<\/span>(.*?)<\/li>/", "<li class='all'>$1<span class=\"count\">(" . $count . ')</span>$3</li>', $buffer );
										return $buffer;
									}
								);
							}
						);
						add_action(
							'admin_footer',
							function () {
								ob_end_flush();
							}
						);
					}
				}
			);
		}


		/**
		* Actions
		*
		* @since     1.0.0
		*/
		public function actions() {
			return true;
		}

		 /**
		  * Description
		  *
		  * @since     1.0.0
		  */
		public static function run( $slug = 'all' ) {
			\MEC_Woocommerce_Autoloader::run( $slug );
			do_action( 'mec_woocommerce_autoloader_run' );
		}

		/**
		* Definitions
		*
		* @since     1.0.0
		*/
		public function definitions() {
			 self::$dir = parent::$dir . 'inc/';
		}

		/**
		* Description
		*
		* @since     1.0.0
		*/
		public function add_autoload_files() {
			MEC_Woocommerce_Autoloader::multi_register(
				[
					[
						'path'     => self::$dir . 'woocommerce' . DIRECTORY_SEPARATOR,
						'slug'     => 'woocommerce.controller',
						'filename' => 'woocommerce',
						'type'     => 'require',
					],
					[
						'path'     => self::$dir . 'MEC' . DIRECTORY_SEPARATOR,
						'slug'     => 'MEC.gateway',
						'filename' => 'gateway',
						'type'     => 'require',
					],
					[
						'path'     => self::$dir . 'features' . DIRECTORY_SEPARATOR,
						'slug'     => 'features.woo.activate',
						'filename' => 'woo-activate',
						'type'     => 'require',
					],
					[
						'path'     => self::$dir . 'features' . DIRECTORY_SEPARATOR,
						'slug'     => 'features.woo.license',
						'filename' => 'woo-license',
						'type'     => 'require',
					],
				]
			);
		}
	}
	MEC_Woocommerce_Bootstrap::get_instance();
endif;
