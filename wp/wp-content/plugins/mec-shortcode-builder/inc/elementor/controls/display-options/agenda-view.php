<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor agenda View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_agenda_display_opts {


	/**
	 * Register Elementor agenda View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Style
		$self->add_control(
			// mec_sk_options_
			'agenda_style',
			array(
				'label'     => __( 'Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'clean',
				'options'   => [
					'clean' => __( 'Clean', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'agenda',
					],
				],
			)
		);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'agenda_start_date_type',
			array(
				'label'     => __( 'Start Date', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'today',
				'options'   => [
					'today'               => __( 'Today', 'mec-shortcode-builder' ),
					'tomorrow'            => __( 'Tomorrow', 'mec-shortcode-builder' ),
					'start_current_month' => __( 'Start of Current Month', 'mec-shortcode-builder' ),
					'start_next_month'    => __( 'Start of Next Month', 'mec-shortcode-builder' ),
					'date'                => __( 'On a certain date', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'agenda',
					],
				],
			)
		);

		// Date Formats clean
		$self->add_control(
			// mec_sk_options_
			'agenda_clean_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'         => [
						'agenda',
					],
					'agenda_style' => [
						'clean',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'agenda_clean_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F j',
				'description' => __( 'Default value is "F j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'         => [
						'agenda',
					],
					'agenda_style' => [
						'clean',
					],
				],
			)
		);

		// On a certain date
		$self->add_control(
			'agenda_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'condition'      => [
					'skin'                   => [
						'agenda',
					],
					'agenda_start_date_type' => [
						'date',
					],
				],
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
			]
		);
		// Limit
		$self->add_control(
			'agenda_limit',
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
						'agenda',
					],
				],
			]
		);
		// Load More Button
		$self->add_control(
			'agenda_load_more_button',
			[
				'label'        => __( 'Load More Button', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'agenda',
					],
				],
			]
		);
		// Localtime
		$self->add_control(
			'agenda_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'agenda',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'agenda_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'agenda',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'agenda_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'agenda',
					],
				],
			]
		);
		// Show Month Divider
		$self->add_control(
			'agenda_month_divider',
			[
				'label'        => __( 'Show Month Divider', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'agenda',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'agenda_sed_method',
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
					'skin'          => [
						'agenda',
					],
					'agenda_style!' => [
						'accordion',
					],
				],

			]
		);
	}
}
