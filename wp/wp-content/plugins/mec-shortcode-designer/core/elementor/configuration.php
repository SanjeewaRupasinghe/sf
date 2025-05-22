<?php
namespace MEC_Shortcodedesigner\Core\Elementor;

use MEC_ShortcodeDesigner\Autoloader;
use Elementor\Plugin;

/**
 * Shortcode Designer ElementorCon figuration.
 *
 * @author      author
 * @package     package
 * @since       1.0.0
 **/
class Shortcode_Designer_Elementor {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     MEC_Shortcodedesigner
	 **/
	public static $instance;

	/**
	 * The directory of the file.
	 *
	 * @access  public
	 * @var     string
	 **/
	public static $dir;

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.0.0
	 * @return  object
	 **/
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}


	public function __construct() {
		self::settingUp();
		self::setHooks( $this );
		self::init();
	}

	/**
	 * Set Hooks.
	 *
	 * @since   1.0.0
	 */
	public static function setHooks( $This ) {
		//add_action( 'elementor/init', [ $This, 'categories' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $This, 'widgets_registered' ] );
		//add_action( 'elementor/widgets/widgets_registered', [ $This, 'remove_default_widgets' ], 15 );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $This, 'frontend_styles' ], 0 );
		add_action( 'elementor/preview/enqueue_styles', [ $This, 'frontend_styles' ], 0 );
		add_action( 'elementor/elements/categories_registered', [ $This, 'categories' ] , 9999 );
	}

	/**
	 * Global Variables.
	 *
	 * @since   1.0.0
	 **/
	public static function settingUp() {
		self::$dir = MECSHORTCODEDESIGNERDIR . 'core' . DS . 'elementor';
		self::elementor_is_active();
		add_post_type_support( 'mec_designer', 'elementor' );
	}

	/**
	 * Register Autoload Files
	 *
	 * @since     1.0.0
	 **/
	public function init() {
		if ( ! class_exists( '\MEC_Shortcodedesigner\Autoloader' ) ) {
			return;
		}
	}

	/**
	 * Elementor activation
	 *
	 * @since     1.0.0
	 **/
	public static function elementor_is_active() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}
	}

	/**
	 * Elementor editor.
	 *
	 * @since   1.0.0
	 **/
	public function is_elementor_editor() {
		return Plugin::$instance->editor->is_edit_mode();
	}

	/**
	 * Categories.
	 *
	 * @since   1.0.0
	 **/
	public function categories() {
		//if (get_post_type() == 'mec_designer') {
			\Elementor\Plugin::instance()->elements_manager->add_category(
				'mec_shortcode_designer',
				[
					'title' => esc_html__( 'Shortcode Designer', 'mec-shortcode-designer' ),
					'icon'  => 'eicon-font',
				],
				10
			);
		//}

	}

	/**
	 * Unregister elementor default widgets.
	 *
	 * @since   1.0.0
	 **/
	public function remove_default_widgets( $widgets_manager ) {
		if ( get_post_type( get_the_ID() ) == 'mec_designer' ) {
			global $elementor_widget_blacklist;
			$elementor_widget_blacklist = [ 'MEC', 'heading', 'image', 'text-editor', 'video', 'button', 'divider', 'spacer', 'image-box', 'google_maps', 'icon', 'icon-box', 'star-rating', 'image-gallery', 'image-carousel', 'icon-list', 'counter', 'progress', 'testimonial', 'tabs', 'accordion', 'toggle', 'social-icons', 'alert', 'audio', 'shortcode', 'html', 'menu-anchor', 'sidebar', 'read-more', 'wp-widget-pages', 'wp-widget-calendar', 'wp-widget-archives', 'wp-widget-media_audio', 'wp-widget-media_image', 'wp-widget-media_gallery', 'wp-widget-media_video', 'wp-widget-meta', 'wp-widget-search', 'wp-widget-text', 'wp-widget-categories', 'wp-widget-recent-posts', 'wp-widget-recent-comments', 'wp-widget-rss', 'wp-widget-tag_cloud', 'wp-widget-nav_menu', 'wp-widget-custom_html', 'wp-widget-mec_mec_widget', 'wp-widget-mec_single_widget' ];
			foreach ( $elementor_widget_blacklist as $widget_name ) {
				$widgets_manager->unregister_widget_type( $widget_name );
			}
		}
	}

	/**
	 * frontend styles.
	 *
	 * @since   1.0.0
	 **/
	public function frontend_styles() {
		wp_enqueue_style( 'mec-shortcode-designer', MECSHORTCODEDESIGNERDASSETS . 'css/frontend/frontend.css', null, MECSHORTCODEDESIGNERVERSION, 'all' );
	}

	/**
	 * Register widgets.
	 *
	 * @since   1.0.0
	 **/
	public function widgets_registered() {
		$widgets = glob( MECSHORTCODEDESIGNERDIR . 'core/elementor/widgets/*.php' );
		foreach ( $widgets as $widget ) :
			if ( __FILE__ != basename( $widget ) ) {
				require_once $widget;
			}
		endforeach;

		// builder functions
		Autoloader::load( 'MEC_ShortcodeDesigner\Core\elementor\Shortcode_Designer_Elementor_Functions' );

		// load widgets
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerTitle() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerThumbnail() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerAddress() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerLocationName() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerOrganizer() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerReadMore() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerlabel() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerSocial() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerDate() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerCustomData() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerTime() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerCountdown() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerWeekday() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerExcerpt() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerAvSpot() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerColor() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerNormalLabel() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerCancellationReason() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerLocalTime() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerSpeaker() );
		Plugin::instance()->widgets_manager->register_widget_type( new \MecShortCodeDesignerCost() );
	}

} //Shortcode_Designer_Elementor
