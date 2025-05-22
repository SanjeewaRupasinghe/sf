<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor timetable View class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_timetable_display_opts
{

    /**
     * Register Elementor timetable View options
     * @author Webnus <info@webnus.biz>
     */
    public static function options($self)
    {
        // Style
        $self->add_control(
            // mec_sk_options_
            'timetable_style',
            array(
                'label'     => __('Style', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'modern',
                'options'   => [
                    'modern'    => __('Modern', 'mec-shortcode-builder'),
                    'clean'     => __('Clean', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'timetable'
                    ],
                ]
            )
        );
        // Start Date
        $self->add_control(
            // mec_sk_options_
            'timetable_start_date_type',
            array(
                'label'     => __('Start Date', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'start_current_week',
                'options'   => [
                    'start_current_week'    => __('Current Week', 'mec-shortcode-builder'),
                    'start_next_week'       => __('Next Week', 'mec-shortcode-builder'),
                    'start_current_month'   => __('Start of Current Month', 'mec-shortcode-builder'),
                    'start_next_month'      => __('Start of Next Month', 'mec-shortcode-builder'),
                    'date'                  => __('On a certain date', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'timetable'
                    ],
                ]
            )
        );
        // On a certain date
        $self->add_control(
            'timetable_start_date',
            [
                'label'     => __('On a certain date', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'dateFormat' => 'M d Y'
                ],
                'default'   => date('M d Y', current_time('timestamp')),
                'condition' => [
                    'skin' => [
                        'timetable'
                    ],
                    'timetable_start_date_type' => [
                        'date'
                    ],
                ],
            ]
        );
        // Events per day
        $self->add_control(
            'timetable_limit',
            [
                'label'         => __('Events per day', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'placeholder'   => __('eg. 6', 'mec-shortcode-builder'),
                'min'           => 1,
                'max'           => 99999999,
                'step'          => 1,
                'default'       => 6,
                'condition' => [
                    'skin' => [
                        'timetable'
                    ],
                ],
            ]
        );
        // Number of Days
        $self->add_control(
            // mec_sk_options_
            'timetable_number_of_days',
            array(
                'label'     => __('Number of Days', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '5',
                'options'   => [
                    '5'         => __('5', 'mec-shortcode-builder'),
                    '6'         => __('6', 'mec-shortcode-builder'),
                    '7'         => __('7', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'timetable_style'  => [
                        'clean'
                    ],
                ]
            )
        );
        // Week Start
        $self->add_control(
            // mec_sk_options_
            'timetable_week_start',
            array(
                'label'     => __('Week Start', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => [
                    '-1'        => __('Inherite from WordPress options', 'mec-shortcode-builder'),
                    '0'         => __('Sunday', 'mec-shortcode-builder'),
                    '1'         => __('Monday', 'mec-shortcode-builder'),
                    '2'         => __('Tuesday', 'mec-shortcode-builder'),
                    '3'         => __('Wednesday', 'mec-shortcode-builder'),
                    '4'         => __('Thursday', 'mec-shortcode-builder'),
                    '5'         => __('Friday', 'mec-shortcode-builder'),
                    '6'         => __('Saturday', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'timetable_style'  => [
                        'clean'
                    ],
                ]
            )
        );


        // Next/Previous Buttons
        $self->add_control(
            'timetable_next_previous_button',
            [
                'label'         => __('Next/Previous Buttons', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __('Show', 'mec-shortcode-builder'),
                'label_off'     => __('Hide', 'mec-shortcode-builder'),
                'return_value'  => '1',
                'default'       => '1',
                'condition' => [
                    'skin' => [
                        'timetable'
                    ],
                ],
            ]
        );
		// Localtime
		$self->add_control(
			'timetable_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'timetable',
					],
				],
			]
        );
		// Normal Label
		$self->add_control(
			'timetable_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'timetable',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'timetable_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'timetable',
					],
				],
			]
		);
        // Single Event Display Method
        $self->add_control(
            'timetable_sed_method',
            [
                'label'     => __('Single Event Display Method', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '0',
                'label_block' => true,
                'options'   => [
					'0'  => __( 'Current Window', 'mec-shortcode-builder' ),
					'new' => __( 'New Window', 'mec-shortcode-builder' ),
					'm1' => __( 'Modal Popup', 'mec-shortcode-builder' ),
					'no' => __( 'Disable Link', 'mec-shortcode-builder' ),
                ],
                'condition' => [
                    'skin' => [
                        'timetable'
                    ],
                ],

            ]
        );
    }
}
