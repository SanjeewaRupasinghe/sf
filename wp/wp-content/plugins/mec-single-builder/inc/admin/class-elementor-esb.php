<?php
namespace MEC_Single_Builder\Inc\Core\Controller;
namespace MEC_Single_Builder\Inc\Admin;
use MEC_Single_Builder as NS;
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://webnus.net
 * @since      1.0.0
 *
 * @author    Webnus
 */

final class Elementor_ESB
{

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct()
	{
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
		add_filter('mec_event_supports', [ $this, 'apply_elementor_support_for_mec_events' ], 10, 1 );
		add_action( 'elementor/preview/enqueue_styles', function() {
			$settings = get_option('mec_options');
			wp_enqueue_script('google-map', '//maps.googleapis.com/maps/api/js?libraries=places'.((isset($settings['settings']['google_maps_api_key']) and trim($settings['settings']['google_maps_api_key']) != '') ? '&key='.$settings['settings']['google_maps_api_key'] : ''));
			wp_enqueue_script('single-builder-richmarker-script', plugin_dir_url( __FILE__ ) . 'js/mec-single-builder-richmarker.min.js');
			wp_enqueue_script('single-builder-flipcount-script', plugin_dir_url( __FILE__ ) . 'js/mec-single-builder-flipcount.js');

			if ( \Elementor\Plugin::$instance->preview->is_preview_mode() && get_post_type(get_the_ID()) == 'mec_esb' ) {
				add_filter( 'body_class', [$this,'filter_function_name'] );
			}
		} );
		add_action('elementor/editor/after_enqueue_styles', [$this, 'editor_styles']);

		/* add_action('elementor/editor/before_enqueue_scripts', function() {
			wp_enqueue_script('mec-googlemap', plugins_url('../../assets/js/mec-googlemap.js', __FILE__), array(), false, true );
		}); */

	}

	public function filter_function_name($classes)
	{
		$classes[] = 'mec-single-event mec-wrap';
        return $classes;
	}

	public function apply_elementor_support_for_mec_events($supports)
	{
		$supports[] = 'elementor';
        return $supports;
	}

	public function editor_styles()
	{
		if ( get_post_type(get_the_ID()) == 'mec_esb' ) {

			wp_enqueue_style('editor-form-builder', plugins_url('../../assets/css/backend/editor-elementor.css', __FILE__), [], '');
			wp_enqueue_style('mec-font-icon', \MEC\Base::get_main()->asset('css/iconfonts.css'));
			wp_enqueue_style('mec-font-icon', \MEC\Base::get_main()->asset('css/iconfonts.css'));
		}
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets()
	{
		//require_once NS\PLUGIN_NAME_DIR . 'inc/core/Controller/class-mec-check.php';
		$factory = \MEC::getInstance('app.libraries.factory');
		// Include Widget files
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-title.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-content.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-tags.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-featured-image.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-countdown.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-category.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-local-time.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-export.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-date.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-time.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-cost.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-more-info.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-label.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-organizer.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-location.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-speaker.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-attendees.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-next-pervious.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-social.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-qr.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-hourly-schedule.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-register-button.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-breadcrumbs.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-related-events.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-cancellation.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-custom-data.php';
		require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-nxt-prv.php';

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Content() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Tags() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_FeaturedImage() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Countdown() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Category() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_LocalTime() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_ExportModule() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_DateModule() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_TimeModule() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Cost() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_MoreInfo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Label() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Organizer() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Location() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Speaker() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Attendees() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_NextPervious() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Social() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_QR() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Hourly_Schedule() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_RegisterButton() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Breadcrumbs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Related_Events() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Cancellation() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Custom_Data() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_NXT_PRV() );

		if ( $factory->getPRO() ):
			require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-weather.php';
			require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-googlemap.php';
			require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-booking.php';
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Weather() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_GoogleMap() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_Booking() );
		endif;

		if(!function_exists('is_plugin_active')) {

			include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}

        if( is_plugin_active('mec-rsvp/mec-rsvp.php') ) {

			require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-booking.php';
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_RSVP() );
		}

		// Virtual Event Addon
		if(is_plugin_active('mec-virtual-events/mec-virtual-events.php')) {
			require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-virtual-event.php';
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_VirtualEvent() );
		}

		// Zoom Integration Addon
		if(is_plugin_active('mec-zoom-integration/mec-zoom-integration.php')) {
			require_once NS\PLUGIN_NAME_DIR . 'inc/admin/widgets/class-esb-zoom-event.php';
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ESB_ZoomEvent() );
		}

	}

	public function add_elementor_widget_categories( $elements_manager )
	{

		$elements_manager->add_category(
			'single_builder',
			[
				'title' => __( 'MEC Single Builder', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

}