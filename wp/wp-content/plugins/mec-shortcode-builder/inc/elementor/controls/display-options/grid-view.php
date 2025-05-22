<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor grid View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_grid_display_opts {


	/**
	 * Register Elementor grid View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {

		// Style
			$self->add_control(
			// mec_sk_options_
			'grid_style',
			array(
				'label'     => __( 'Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'classic',
				'options'   => [
					'classic'  => __( 'Classic', 'mec-shortcode-builder' ),
					'clean'    => __( 'Clean', 'mec-shortcode-builder' ),
					'minimal'  => __( 'Minimal', 'mec-shortcode-builder' ),
					'modern'   => __( 'Modern', 'mec-shortcode-builder' ),
					'simple'   => __( 'Simple', 'mec-shortcode-builder' ),
					'colorful' => __( 'Colorful', 'mec-shortcode-builder' ),
					'novel'    => __( 'Novel', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'grid',
					],
				],
			)
		);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'grid_start_date_type',
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
						'grid',
					],
				],
			)
		);

		// Date Formats classic
		$self->add_control(
			// mec_sk_options_
			'grid_classic_date_format1',
			array(
				'label'       => __( 'Date Format', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M d Y',
				'description' => __( 'Default value is "M d Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'classic',
					],
				],
			)
		);
		// Date Formats clean
		$self->add_control(
			// mec_sk_options_
			'grid_clean_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'clean',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'grid_clean_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F',
				'description' => __( 'Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'clean',
					],
				],
			)
		);
		// Date Formats minimal
		$self->add_control(
			// mec_sk_options_
			'grid_minimal_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'minimal',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'grid_minimal_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M',
				'description' => __( 'Default value is "M". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'minimal',
					],
				],
			)
		);
		// Date Formats Modern
		$self->add_control(
			// mec_sk_options_
			'grid_modern_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'modern',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'grid_modern_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F',
				'description' => __( 'Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'modern',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'grid_modern_date_format3',
			array(
				'label'       => __( 'Date Format 3', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'modern',
					],
				],
			)
		);
		// Date Formats simple
		$self->add_control(
			// mec_sk_options_
			'grid_simple_date_format1',
			array(
				'label'       => __( 'Date Format', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M d Y',
				'description' => __( 'Default value is "M d Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'simple',
					],
				],
			)
		);
		// Date Formats Colorful
		$self->add_control(
			// mec_sk_options_
			'grid_colorful_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd',
				'description' => __( 'Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'colorful',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'grid_colorful_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F',
				'description' => __( 'Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'colorful',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'grid_colorful_date_format3',
			array(
				'label'       => __( 'Date Format 3', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'colorful',
					],
				],
			)
		);
		// Date Formats Novel
		$self->add_control(
			// mec_sk_options_
			'grid_novel_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd F Y',
				'description' => __( 'Default value is "d F Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'grid',
					],
					'grid_style' => [
						'novel',
					],
				],
			)
		);
		$self->add_control(
			'grid_start_date',
			[
				'label'     => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::DATE_TIME,
				'condition' => [
					'skin'                 => [
						'grid',
					],
					'grid_start_date_type' => [
						'date',
					],
				],
			]
		);
		// Count in row
		$self->add_control(
			// mec_sk_options_
			'grid_count',
			array(
				'label'     => __( 'Count in row', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1'  => __( '1', 'mec-shortcode-builder' ),
					'2'  => __( '2', 'mec-shortcode-builder' ),
					'3'  => __( '3', 'mec-shortcode-builder' ),
					'4'  => __( '4', 'mec-shortcode-builder' ),
					'6'  => __( '6', 'mec-shortcode-builder' ),
					'12' => __( '12', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'grid',
					],
				],
			)
		);
		// Limit
		$self->add_control(
			'grid_limit',
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
						'grid',
					],
				],
			]
		);
		// Load More Button
		$self->add_control(
			'grid_load_more_button',
			[
				'label'        => __( 'Load More Button', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'grid',
					],
				],
			]
		);
		// Localtime
		$self->add_control(
			'grid_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'grid',
					],
				],
			]
		);
		// Load Time
		$self->add_control(
			'grid_include_events_times',
			[
				'label'        => __( 'Include Events Times', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'grid',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'grid_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'grid',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'grid_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'grid',
					],
				],
			]
		);
		// Load More Button
		$self->add_control(
			'grid_map_on_top',
			[
				'label'        => __( 'Show Map on top', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'grid',
					],
				],
			]
		);
		$self->add_control(
			'grid_set_geolocation',
			[
				'label'        => __( 'Geolocation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'mec-shortcode-builder' ),
				'label_off'    => __( 'OFF', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin'       => [
						'grid',
					],
					'grid_map_on_top' => [
						'1',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'grid_sed_method',
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
						'grid',
					],
					'grid_style!' => [
						'accordion',
					],
				],

			]
		);
	}

}

