<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check Required statues
if ( !MEC_Form_Builder_Base::check_plugins() ) {
	return;
}

if ( ! class_exists( 'MEC_Form_Builder_Bootstrap' ) ) :
	/**
	 * MEC_Form_Builder_Bootstrap.
	 *
	 * @author     Webnus Team
	 * @since      1.0.0
	 */
	class MEC_Form_Builder_Bootstrap extends MEC_Form_Builder_Base {


		private static $files;
		/**
		 * Instance of MEC_Form_Builder
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
		 * @return   MEC_Form_Builder_Bootstrap
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
			add_action( 'elementor/init', [ $this, 'add_autoload_files' ], 5 );
			add_action( 'elementor/init', [ $this, 'run' ], 10 );
			add_action( 'plugins_loaded', [ $this, 'actions' ] );
		}

		/**
		 * Description
		 *
		 * @since     1.0.0
		 */
		public function actions() {
			if ( parent::check_plugins() ) {
				add_action(
					'mec_form_builder_autoloader_run',
					function () {
						$e = new MEC_feature_forms();
						$e->init();
					}
				);
			}

			if ( parent::check_plugins() && class_exists( '\Elementor\Plugin' ) ) {
				add_action(
					'elementor/widgets/widgets_registered',
					function () {
						if ( get_post_type() == 'mec_form' ) {
							\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\MEC_addon_elementor_form_builder() );
						}
					},
					1,
					0
				);

				add_action( 'elementor/elements/categories_registered', [ $this, 'mec_categories' ] );
				add_action('wp_enqueue_scripts', [ $this, 'preview_styles' ], 0 );
				add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_styles' ] );
			}
			return true;
		}

		public function editor_styles() {
			wp_enqueue_style( 'editor-form-builder', self::$assets . 'css/backend/editor-elementor.css', [], '' );
			wp_enqueue_script( 'editor-form-builder-js', self::$assets . 'js/backend/editor-elementor.js', [], '' );
			wp_localize_script('editor-form-builder-js', 'CurrentPageURL', get_the_permalink( get_the_ID( ) ) );
		}

		public function preview_styles() {
			wp_enqueue_style( 'form-builder', self::$assets . 'css/preview/form-builder.css', [], '' );
		}

		 /**
		  * Description
		  *
		  * @since     1.0.0
		  */
		public static function run() {
			\MEC_Form_Builder_Autoloader::run();
			do_action( 'mec_form_builder_autoloader_run' );
		}

		public function mec_categories( $elements_manager ) {
			$elements_manager->add_category(
				'mec',
				[
					'title' => __( 'Modern Events Calendar', 'mec-form-builder' ),
					'icon'  => 'fa fa-plug',
				]
			);
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
			MEC_Form_Builder_Autoloader::multi_register(
				[
					[
						'path'     => self::$dir . 'forms' . DIRECTORY_SEPARATOR,
						'slug'     => 'post.type.forms',
						'filename' => 'forms',
						'type'     => 'require',
					],
					[
						'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR,
						'slug'     => 'elementor.form.builder',
						'filename' => 'form-builder',
						'type'     => 'require',
					],
					[
						'path'     => self::$dir . 'features' . DIRECTORY_SEPARATOR,
						'slug'     => 'fb.license',
						'filename' => 'fb-license',
						'type'     => 'require_once',
					],
					[
						'path'     => self::$dir . 'features' . DIRECTORY_SEPARATOR,
						'slug'     => 'mec.reg.form',
						'filename' => 'regform',
						'type'     => 'require_once',
					],
				]
			);
		}
	}
	MEC_Form_Builder_Bootstrap::get_instance();
endif;
