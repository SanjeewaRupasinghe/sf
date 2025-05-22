<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor available_spot View class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_available_spot_display_opts
{

	/**
	 * Register Elementor available_spot View options
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self )
	{

		// Date Formats style2
		$self->add_control(
			// mec_sk_options_
			'available_spot_date_format1',
			array(
				'label'		    => __('Date Format 1', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
				'default'	    => 'j',
				'description'   => __('Default value is "j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
				'condition'     => [
					'skin'      => [
						'available_spot'
					],
				]
			)
		);
		// Date Formats style2
		$self->add_control(
			// mec_sk_options_
			'available_spot_date_format2',
			array(
				'label'		    => __('Date Format 2', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
				'default'	    => 'F',
				'description'   => __('Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
				'condition'     => [
					'skin'      => [
						'available_spot'
					],
				]
			)
		);
		// Localtime
		$self->add_control(
			'available_spot_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'available_spot',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'available_spot_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'available_spot',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'available_spot_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'available_spot',
					],
				],
			]
		);
		// Events
		$all_events  = get_posts( 'post_type="mec-events"&numberposts=-1' );
		$events     = array();
		if ( $all_events ) :
			$events['-1'] = __( '-- Next Upcoming Event --', 'inco-plus' );
			foreach ( $all_events as $event ) {
				$events[$event->ID] = $event->post_title;
			}
		else :
			$events['no-event'] = __( 'No event found', 'inco-plus' );
		endif;
		$self->add_control(
			// mec_sk_options_
			'available_spot_event',
			array(
				'label'     => __('Style', 'mec-shortcode-builder'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $events,
				'default'   => '-1',
				'condition' => [
					'skin'  => [
						'available_spot'
					],
				],
			)
		);
	}
}