<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor tile View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_tile_display_opts {

	/**
	 * Register Elementor tile View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'tile_start_date_type',
			array(
				'label'     => __( 'Start Date', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'start_current_month',
				'options'   => [
					'start_current_month' => __( 'Start of Current Month', 'mec-shortcode-builder' ),
					'start_next_month'    => __( 'Start of Next Month', 'mec-shortcode-builder' ),
					'date'                => __( 'On a certain date', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'tile',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			'tile_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
				'condition'      => [
					'skin'				   => [
						'tile',
					],
					'tile_start_date_type' => [
						'date',
					],
				],
			]
		);
		// Date Formats modern
		$self->add_control(
			// mec_sk_options_
			'tile_clean_date_format1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'j',
				'description' => __( 'Default value is "j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin' => [
						'tile',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'tile_clean_date_format2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'M',
				'description' => __( 'Default value is "M". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin' => [
						'tile',
					],
				],
			)
		);
        // Count in row
        $self->add_control(
            // mec_sk_options_
            'tile_count',
            array(
                'label'     => __('Count in row', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '2',
                'options'   => [
					'4' => __('4', 'mec-shortcode-builder'),
                    '3' => __('3', 'mec-shortcode-builder'),
                    '2' => __('2', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'tile'
                    ],
                ]
            )
        );
		// Next/Previous Buttons
		$self->add_control(
			'tile_next_previous_button',
			[
				'label'        => __( 'Next/Previous Buttons', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'tile',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'tile_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'tile',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'tile_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'tile',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'tile_sed_method',
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
						'tile',
					],
				],
			]
		);
	}
}
