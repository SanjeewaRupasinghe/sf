<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor countdown View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_countdown_display_opts {


	/**
	 * Register Elementor countdown View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Style
		$self->add_control(
			// mec_sk_options_
			'countdown_style',
			array(
				'label'     => __( 'Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'style1',
				'options'   => [
					'style1' => __( 'Style 1', 'mec-shortcode-builder' ),
					'style2' => __( 'Style 2', 'mec-shortcode-builder' ),
					'style3' => __( 'Style 3', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'countdown',
					],
				],
			)
		);
		// Localtime
		$self->add_control(
			'countdown_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'countdown',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'countdown_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'countdown',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'countdown_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'countdown',
					],
				],
			]
		);
		// Date Formats style1
		$self->add_control(
			// mec_sk_options_
			'countdown_style1_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'j F Y',
				'description' => __( 'Default value is "j F Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'            => [
						'countdown',
					],
					'countdown_style' => [
						'style1',
					],
				],
			)
		);
		// Date Formats style2
		$self->add_control(
			// mec_sk_options_
			'countdown_style2_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'j F Y',
				'description' => __( 'Default value is "j F Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'            => [
						'countdown',
					],
					'countdown_style' => [
						'style2',
					],
				],
			)
		);
		// Date Formats style3
		$self->add_control(
			// mec_sk_options_
			'countdown_style3_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'j',
				'description' => __( 'Default value is "j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'            => [
						'countdown',
					],
					'countdown_style' => [
						'style3',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'countdown_style3_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F',
				'description' => __( 'Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'            => [
						'countdown',
					],
					'countdown_style' => [
						'style3',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'countdown_style3_date_format3',
			array(
				'label'       => __( 'Date Format 3', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'Y',
				'description' => __( 'Default value is "Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'            => [
						'countdown',
					],
					'countdown_style' => [
						'style3',
					],
				],
			)
		);

		// Events
		$all_events = get_posts( 'post_type="mec-events"&numberposts=-1' );
		$events     = array();
		if ( $all_events ) :
			$events['-1'] = __( '-- Next Upcoming Event --', 'inco-plus' );
			foreach ( $all_events as $event ) {
				$events[ $event->ID ] = $event->post_title;
			}
		else :
			$events['no-event'] = __( 'No event found', 'inco-plus' );
		endif;
		$self->add_control(
			// mec_sk_options_
			'countdown_event',
			array(
				'label'     => __( 'Event', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $events,
				'default'   => '-1',
				'condition' => [
					'skin' => [
						'countdown',
					],
				],
			)
		);
	}
}
