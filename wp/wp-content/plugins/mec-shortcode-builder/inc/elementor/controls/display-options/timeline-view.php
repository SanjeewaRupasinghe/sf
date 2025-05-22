<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor timeline View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_timeline_display_opts {


	/**
	 * Register Elementor timeline View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {      

		// Start Date
		$self->add_control(
			// mec_sk_options_
			'timeline_start_date_type',
			array(
				'label'     => __( 'Start Date', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'start_current_month',
				'options'   => [
					'today'               => __( 'Today', 'mec-shortcode-builder' ),
					'tomorrow'            => __( 'Tomorrow', 'mec-shortcode-builder' ),
					'start_current_month' => __( 'Start of Current Month', 'mec-shortcode-builder' ),
					'start_next_month'    => __( 'Start of Next Month', 'mec-shortcode-builder' ),
					'date'                => __( 'On a certain date', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'timeline',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			'timeline_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
				'condition'      => [
					'skin'                   => [
						'timeline',
					],
					'timeline_start_date_type' => [
						'date',
					],
				],
			]
		);
		// Date Formats modern
		$self->add_control(
			// mec_sk_options_
			'timeline_date_format1',
			array(
				'label'       => __( 'Date Format', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd F Y',
				'description' => __( 'Default value is "d F Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin' => [
						'timeline',
					],
				],
			)
		);
		// Events per day
		$self->add_control(
			'timeline_limit',
			[
				'label'       => __( 'Limit', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => __( 'eg. 6', 'mec-shortcode-builder' ),
				'min'         => 1,
				'max'         => 99999999,
				'step'        => 1,
				'default'     => 6,
				'condition'   => [
					'skin' => [
						'timeline',
					],
				],
			]
        );
        // Load more button
		$self->add_control(
			'timeline_load_more_button',
			[
				'label'        => __( 'Load More Button', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'timeline',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'timeline_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'timeline',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'timeline_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'timeline',
					],
				],
			]
		);
		// Localtime
		$self->add_control(
			'timeline_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'timeline',
					],
				],
			]
		);
		// Show Month Divider
		$self->add_control(
			'timeline_month_divider',
			[
				'label'        => __( 'Show Month Divider', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'timeline',
					],
				],
			]
		);

		// Single Event Display Method
		$self->add_control(
			'timeline_sed_method',
			[
				'label'       => __( 'Single Event Display Method', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => '0',
				'label_block' => true,
				'options'     => [
					'0'  => __( 'Current Window', 'mec-shortcode-builder' ),
					'new' => __( 'New Window', 'mec-shortcode-builder' ),
					'm1' => __( 'Modal Popup', 'mec-shortcode-builder' ),
					'no' => __( 'Disable Link', 'mec-shortcode-builder' ),
				],
				'condition'   => [
					'skin' => [
						'timeline',
					],
				],

			]
		);
	}
}
