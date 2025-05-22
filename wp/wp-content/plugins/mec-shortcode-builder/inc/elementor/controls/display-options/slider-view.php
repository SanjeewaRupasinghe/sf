<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor slider View class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_slider_display_opts
{

    /**
     * Register Elementor slider View options
     * @author Webnus <info@webnus.biz>
     */
    public static function options($self)
    {
        // Style
        $self->add_control(
            // mec_sk_options_
            'slider_style',
            array(
                'label'     => __('Style', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 't1',
                'options'   => [
                    't1'   => __('Type 1', 'mec-shortcode-builder'),
                    't2'   => __('Type 2', 'mec-shortcode-builder'),
                    't3'    => __('Type 3', 'mec-shortcode-builder'),
                    't4'    => __('Type 4', 'mec-shortcode-builder'),
                    't5'    => __('Type 5', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'slider'
                    ],
                ],
            )
        );
        // Start Date
        $self->add_control(
            // mec_sk_options_
            'slider_start_date_type',
            array(
                'label'     => __('Start Date', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'today',
                'options'   => [
                    'today'                 => __('Today', 'mec-shortcode-builder'),
                    'tomorrow'              => __('Tomorrow', 'mec-shortcode-builder'),
                    'start_current_month'   => __('Start of Current Month', 'mec-shortcode-builder'),
                    'start_next_month'      => __('Start of Next Month', 'mec-shortcode-builder'),
                    'date'                  => __('On a certain date', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'slider'
                    ],
                ]
            )
        );

        // Date Formats type1
        $self->add_control(
            // mec_sk_options_
            'slider_type1_date_format1',
            array(
                'label'         => __('Date Format', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => 'd',
                'description'   => __('Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'slider'
                    ],
                ]
            )
        );
        $self->add_control(
            // mec_sk_options_
            'slider_type1_date_format2',
            array(
                'label'         => __('Date Format', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => 'F',
                'description'   => __('Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'slider'
                    ],
                ]
            )
        );
        $self->add_control(
            // mec_sk_options_
            'slider_type1_date_format3',
            array(
                'label'         => __('Date Format', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => 'l',
                'description'   => __('Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'slider'
                    ],
                ]
            )
        );

        // On a certain date
        $self->add_control(
            'slider_start_date',
            [
                'label'     => __('On a certain date', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'dateFormat' => 'M d Y'
                ],
                'default'   => date('M d Y', current_time('timestamp')),
                'condition' => [
                    'skin' => [
                        'slider'
                    ],
                    'slider_start_date_type' => [
                        'date'
                    ],
                ],
            ]
        );
        // Limit
        $self->add_control(
            'slider_limit',
            [
                'label'         => __('Limit', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'placeholder'   => __('eg. 6', 'mec-shortcode-builder'),
                'min'           => 1,
                'max'           => 99999999,
                'step'          => 1,
                'default'       => 6,
                'condition' => [
                    'skin' => [
                        'slider'
                    ],
                ],
            ]
        );
        // Auto Play Time
        $self->add_control(
            'slider_autoplay',
            [
                'label'         => __('Auto Play Time', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'placeholder'   => __('eg. 4000 default is 4 second', 'mec-shortcode-builder'),
                'min'           => 1000,
                'max'           => 99999999,
                'step'          => 1000,
                'default'       => 4000,
                'condition' => [
                    'skin' => [
                        'slider'
                    ],
                ],
            ]
        );
		// Localtime
		$self->add_control(
			'slider_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'slider',
					],
				],
			]
        );
		// Normal Label
		$self->add_control(
			'slider_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'slider',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'slider_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'slider',
					],
				],
			]
		);
    }
}
