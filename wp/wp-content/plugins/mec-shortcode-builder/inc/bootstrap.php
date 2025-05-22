<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check Required statues
if ( ! MEC_Shortcode_Builder_Base::check_plugins() ) {
	return;
}

if ( ! class_exists( 'MEC_Shortcode_Builder_Bootstrap' ) ) :
	/**
	 * MEC_Shortcode_Builder_Bootstrap.
	 *
	 * @author     Webnus Team
	 * @since      1.0.0
	 */
	class MEC_Shortcode_Builder_Bootstrap extends MEC_Shortcode_Builder_Base {

		private static $files;
		/**
		 * Instance of MEC_Shortcode_Builder
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
		 * @return   MEC_Shortcode_Builder_Bootstrap
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
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'add_autoload_files' ], 0 );
			add_action( 'init', [ $this, 'add_autoload_files' ], 0 );
			add_action( 'plugins_loaded', [ $this, 'actions' ] );
		}

		 /**
		  * Description
		  *
		  * @since     1.0.0
		  */
		public function actions() {
			if ( parent::$is_mec_active ) {
				add_action( 'elementor/widgets/widgets_registered', [ $this, 'run' ], 1, 0 );
				add_action( 'elementor/elements/categories_registered', array( $this, 'mec_categories' ) );
			}
			add_action( 'init', [ $this, 'run' ], 1, 0 );
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_styles_and_scripts' ], 0 );
			add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_styles_and_scripts' ], 0 );
			return true;
		}

		/**
		 * Load the footer
		 *
		 * @since    1.0.0
		 */
		public function load_footer() {
			if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
				$factory = \MEC::getInstance( 'app.libraries.factory' );
				$factory->load_footer();
			}
		}

		/**
		 * Enqueue Styles And Scripts
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles_and_scripts() {
			$factory = \MEC::getInstance( 'app.libraries.factory' );
			$factory->main->load_owl_assets();
			$factory->main->load_isotope_assets();
			$factory->main->load_sed_assets();
			$factory->load_frontend_assets();
		}

		 /**
		  * Description
		  *
		  * @since     1.0.0
		  */
		public static function run() {
			\MEC_Shortcode_Builder_Autoloader::run();

			if ( current_action() == 'elementor/widgets/widgets_registered' ) {
				$data = array();
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\MEC_addon_elementor_shortcode_builder($data) );
			}
		}

		public function mec_categories( $elements_manager ) {
			$elements_manager->add_category(
				'mec',
				[
					'title' => __( 'Modern Events Calendar', 'mec-shortcode-builder' ),
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

			if ( current_action() == 'elementor/widgets/widgets_registered' ) {
				MEC_Shortcode_Builder_Autoloader::multi_register(
					[
						[
							'slug'     => 'filter-options',
							'filename' => 'filter-options',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'list-view',
							'filename' => 'list-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'grid-view',
							'filename' => 'grid-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'agenda-view',
							'filename' => 'agenda-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'full-calendar-view',
							'filename' => 'full-calendar-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'yearly-view',
							'filename' => 'yearly-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'monthly-view',
							'filename' => 'monthly-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'daily-view',
							'filename' => 'daily-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'weekly-view',
							'filename' => 'weekly-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'timetable-view',
							'filename' => 'timetable-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'masonry-view',
							'filename' => 'masonry-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'map-view',
							'filename' => 'map-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'cover-view',
							'filename' => 'cover-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'countdown-view',
							'filename' => 'countdown-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'availablespot-view',
							'filename' => 'availablespot-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'carousel-view',
							'filename' => 'carousel-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'slider-view',
							'filename' => 'slider-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'timeline-view',
							'filename' => 'timeline-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'tile-view',
							'filename' => 'tile-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'custom-view',
							'filename' => 'custom-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'display-options' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'list-view',
							'filename' => 'list-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'grid-view',
							'filename' => 'grid-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'agenda-view',
							'filename' => 'agenda-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'full-calendar-view',
							'filename' => 'full-calendar-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'yearly-view',
							'filename' => 'yearly-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'monthly-view',
							'filename' => 'monthly-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'daily-view',
							'filename' => 'daily-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'weekly-view',
							'filename' => 'weekly-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'timetable-view',
							'filename' => 'timetable-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'map-view',
							'filename' => 'map-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'tile-view',
							'filename' => 'tile-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'slug'     => 'custom-view',
							'filename' => 'custom-view',
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR . 'controls' . DIRECTORY_SEPARATOR . 'search-form' . DIRECTORY_SEPARATOR,
							'type'     => 'require_once',
						],
						[
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR,
							'slug'     => 'elementor.shortcode.builder',
							'filename' => 'shortcode-builder',
							'type'     => 'require',
						],
					]
				);
			} else {
				MEC_Shortcode_Builder_Autoloader::multi_register(
					[
						[
							'path'     => self::$dir . 'elementor' . DIRECTORY_SEPARATOR,
							'slug'     => 'elementor.shortcode.builder.config',
							'filename' => 'shortcode-builder-config',
							'type'     => 'include',
						],
						[
							'path'     => self::$dir . 'features' . DIRECTORY_SEPARATOR,
							'slug'     => 'features.shb.license',
							'filename' => 'shb-license',
							'type'     => 'require_once',
						],
						[
							'path'     => self::$dir . 'features' . DIRECTORY_SEPARATOR,
							'slug'     => 'features.shb.activate',
							'filename' => 'shb-activate',
							'type'     => 'require_once',
						],
					]
				);
			}

		}
	}
	\MEC_Shortcode_Builder_Bootstrap::get_instance();
endif;
