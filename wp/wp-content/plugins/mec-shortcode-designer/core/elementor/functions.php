<?php
use Elementor\Plugin;

/**
 * Shortcode Designer ElementorCon figuration.
 *
 * @author      author
 * @package     package
 * @since       1.0.0
 **/
class Shortcode_Designer_Elementor_Functions {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Shortcode_Designer_Elementor_Functions
	 **/
	public static $instance;

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
		self::setHooks( $this );
	}

	/**
	 * Set Hooks.
	 *
	 * @since   1.0.0
	 */
	public static function setHooks( $This ) {
		add_action( 'mec_custom_skin_loop', [ $This, 'title' ] );
		add_action( 'mec_custom_skin_loop', [ $This, 'thumbnail' ] );
	}

	/**
	 * Elementor editor.
	 *
	 * @since   1.0.0
	 **/
	public static function is_elementor_editor() {
		return Plugin::$instance->editor->is_edit_mode();
	}

	/**
	 * Get title.
	 *
	 * @since   1.0.0
	 **/
	public static function title( $shortcode_data = null ) {
		if( ! class_exists('\MEC_main') && $shortcode_data ) {
		return;
		}
		$events      = \MEC_main::get_shortcode_events( $shortcode_data['shortcode_id'] );
		$mec_main    = new \MEC_MAIN;
		$event      = $shortcode_data['event'];
		$event_color  = isset($event->data->meta['mec_color']) ? '<span class="event-color" style="background: #'.$event->data->meta['mec_color'].'"></span>' : '';

		if(empty($link_target)){
			
			global $MEC_Shortcode_id;
			$link_target = mec_shortcode_get_sed_method('title',$MEC_Shortcode_id);
		}
		?> 
		<h4 class="mec-event-title">///////////
		<a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" target="<?php echo $link_target; ?>" href="<?php echo $mec_main->get_event_date_permalink( $event->data->permalink, $event->date['start']['date'] ); ?>">
			<?php echo $event->data->title; ?>
		</a>
		<?php echo $event_color; ?>
		</h4>
		<?php
	}

	/**
	 * Get thumbnail.
	 *
	 * @since   1.0.0
	 **/
	public static function thumbnail( $shortcode_data = null ) {
		if( ! class_exists('\MEC_main') && $shortcode_data ) {
			return;
		}
		$events      = \MEC_main::get_shortcode_events( $shortcode_data['shortcode_id'] );
		$mec_main    = new \MEC_MAIN;
		$event      = $shortcode_data['event'];
		$link_status = isset($shortcode_data['link_status']) ? $shortcode_data['link_status'] : '';
		$event_color  = isset($event->data->meta['mec_color']) ? '<span class="event-color" style="background: #'.$event->data->meta['mec_color'].'"></span>' : ''; ?>
		<div class="mec-event-image">
			<a data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $mec_main->get_event_date_permalink( $event->data->permalink, $event->date['start']['date'] ); ?>">
				<?php echo $event->data->thumbnails['medium']; ?>
			</a>
		</div>
		<?php
	}

}
Shortcode_Designer_Elementor_Functions::instance();
