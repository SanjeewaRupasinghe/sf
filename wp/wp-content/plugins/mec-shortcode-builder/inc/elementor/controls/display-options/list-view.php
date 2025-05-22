<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor List View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_list_display_opts {


	/**
	 * Register Elementor List View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		
		// Style
		$self->add_control(
			// mec_sk_options_
			'list_style',
			array(
				'label'     => __( 'Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'classic',
				'options'   => [
					'classic'   => __( 'Classic', 'mec-shortcode-builder' ),
					'minimal'   => __( 'Minimal', 'mec-shortcode-builder' ),
					'modern'    => __( 'Modern', 'mec-shortcode-builder' ),
					'standard'  => __( 'Standard', 'mec-shortcode-builder' ),
					'accordion' => __( 'Accordion', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'list',
					],
				],
			)
		);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'list_start_date_type',
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
						'list',
					],
				],
			)
		);

		// On a certain date
		$self->add_control(
			'list_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'condition'      => [
					'skin'                 => [
						'list',
					],
					'list_start_date_type' => [
						'date',
					],
				],
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
			]
		);

		// Date Formats classic
		$self->add_control(
			// mec_sk_options_
			'list_classic_date_format1',
			array(
				'label'       => __( 'Date Format', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M d Y',
				'description' => __( 'Default value is "M d Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'classic',
					],
				],
			)
		);

		// Date Formats minimal
		$self->add_control(
			// mec_sk_options_
			'list_minimal_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'minimal',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'list_minimal_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M',
				'description' => __( 'Default value is "M". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'minimal',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'list_minimal_date_format3',
			array(
				'label'       => __( 'Date Format 3', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'minimal',
					],
				],
			)
		);
		// Date Formats Modern
		$self->add_control(
			// mec_sk_options_
			'list_modern_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'modern',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'list_modern_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F',
				'description' => __( 'Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'modern',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'list_modern_date_format3',
			array(
				'label'       => __( 'Date Format 3', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'modern',
					],
				],
			)
		);
		// Date Formats classic
		$self->add_control(
			// mec_sk_options_
			'list_standard_date_format1',
			array(
				'label'       => __( 'Date Format', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd M',
				'description' => __( 'Default value is "d M". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'standard',
					],
				],
			)
		);
		// Date Formats Modern
		$self->add_control(
			// mec_sk_options_
			'list_accordion_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'accordion',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'list_accordion_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F',
				'description' => __( 'Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'accordion',
					],
				],
			)
		);

		// Limit
		$self->add_control(
			'list_limit',
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
						'list',
					],
				],
			]
		);
		// Load More Button
		$self->add_control(
			'list_load_more_button',
			[
				'label'        => __( 'Load More Button', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Localtime
		$self->add_control(
			'list_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Load Time
		$self->add_control(
			'list_include_events_times',
			[
				'label'        => __( 'Include Events Times', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'list_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'list_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Load More Button
		$self->add_control(
			'list_map_on_top',
			[
				'label'        => __( 'Show Map on top', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);

		$self->add_control(
			'list_set_geolocation',
			[
				'label'        => __( 'Geolocation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'mec-shortcode-builder' ),
				'label_off'    => __( 'OFF', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin'       => [
						'list',
					],
					'list_map_on_top' => [
						'1',
					],
				],
			]
		);

		// Show Month Divider
		$self->add_control(
			'list_month_divider',
			[
				'label'        => __( 'Show Month Divider', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Toggle for Month Divider
		$self->add_control(
			'list_toggle_month_divider',
			[
				'label'        => __( 'Toggle for Month Divider', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin'       => [
						'list',
					],
					'list_style' => [
						'accordion',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'list_sed_method',
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
					'skin'        => [
						'list',
					],
					'list_style!' => [
						'accordion',
					],
				],

			]
		);
	}
}
