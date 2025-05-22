<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor yearly View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_yearly_display_opts {


	/**
	 * Register Elementor yearly View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Style
		$self->add_control(
			// mec_sk_options_
			'yearly_style',
			array(
				'label'     => __( 'Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'modern',
				'options'   => [
					'modern' => __( 'Modern', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'yearly_view',
					],
				],
			)
		);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'yearly_start_date_type',
			array(
				'label'     => __( 'Start Date', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'start_current_month',
				'options'   => [
					'start_current_year' => __( 'Start of Current Year', 'mec-shortcode-builder' ),
					'start_next_year'    => __( 'Start of Next Year', 'mec-shortcode-builder' ),
					'date'               => __( 'On a certain date', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'yearly_view',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			'yearly_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
				'condition'      => [
					'skin'                   => [
						'yearly_view',
					],
					'yearly_start_date_type' => [
						'date',
					],
				],
			]
		);
		// Date Formats modern
		$self->add_control(
			// mec_sk_options_
			'yearly_modern_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin' => [
						'yearly_view',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'yearly_modern_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F j',
				'description' => __( 'Default value is "F j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin' => [
						'yearly_view',
					],
				],
			)
		);
		// Events per day
		$self->add_control(
			'yearly_limit',
			[
				'label'       => __( 'Events per day', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => __( 'eg. 6', 'mec-shortcode-builder' ),
				'min'         => 1,
				'max'         => 99999999,
				'step'        => 1,
				'default'     => 6,
				'condition'   => [
					'skin' => [
						'yearly_view',
					],
				],
			]
		);
		// Next/Previous Buttons
		$self->add_control(
			'yearly_next_previous_button',
			[
				'label'        => __( 'Next/Previous Buttons', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'yearly_view',
					],
				],
			]
		);
		// Localtime
		$self->add_control(
			'yearly_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'yearly_view',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'yearly_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'yearly_view',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'yearly_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'yearly_view',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'yearly_sed_method',
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
						'yearly_view',
					],
				],

			]
		);
	}
}
