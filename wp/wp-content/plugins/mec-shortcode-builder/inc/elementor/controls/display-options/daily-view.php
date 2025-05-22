<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor daily View class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_daily_display_opts
{

    /**
     * Register Elementor daily View options
     * @author Webnus <info@webnus.biz>
     */
    public static function options($self)
    {
        // Start Date
        $self->add_control(
            // mec_sk_options_
            'daily_start_date_type',
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
                        'daily_view'
                    ],
                ]
            )
        );
        // On a certain date
        $self->add_control(
            'daily_start_date',
            [
                'label'     => __('On a certain date', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::DATE_TIME,
                'condition' => [
                    'skin' => [
                        'daily_view'
                    ],
                    'daily_start_date_type' => [
                        'date'
                    ],
                ],
                'picker_options' => [
                    'dateFormat' => 'M d Y'
                ],
                'default'   => date('M d Y', current_time('timestamp'))
            ]
        );
        // Events per day
        $self->add_control(
            'daily_limit',
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
                        'daily_view'
                    ],
                ],
            ]
        );
        // Next/Previous Buttons
        $self->add_control(
            'daily_next_previous_button',
            [
                'label'         => __('Next/Previous Buttons', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __('Show', 'mec-shortcode-builder'),
                'label_off'     => __('Hide', 'mec-shortcode-builder'),
                'return_value'  => '1',
                'default'       => '1',
                'condition' => [
                    'skin' => [
                        'daily_view'
                    ],
                ],
            ]
        );
		// Localtime
		$self->add_control(
			'daily_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'daily_view',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'daily_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'daily_view',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'daily_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'daily_view',
					],
				],
			]
		);
        // Single Event Display Method
        $self->add_control(
            'daily_sed_method',
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
                        'daily_view'
                    ],
                ],
                
            ]
        );
    }
}
