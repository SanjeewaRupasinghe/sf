<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor masonry View class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_masonry_display_opts
{

    /**
     * Register Elementor masonry View options
     * @author Webnus <info@webnus.biz>
     */
    public static function options($self)
    {
        // Start Date
        $self->add_control(
            // mec_sk_options_
            'masonry_start_date_type',
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
                        'masonry'
                    ],
                ]
            )
        );
        // On a certain date
        $self->add_control(
            'masonry_start_date',
            [
                'label'     => __('On a certain date', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'dateFormat' => 'M d Y'
                ],
                'default'   => date('M d Y', current_time('timestamp')),
                'condition' => [
                    'skin' => [
                        'masonry'
                    ],
                    'masonry_start_date_type' => [
                        'date'
                    ],
                ],
            ]
        );
        // Date Formats modern
        $self->add_control(
            // mec_sk_options_
            'masonry_modern_date_format1',
            array(
                'label'         => __('Date Format 1', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => 'j',
                'description'   => __('Default value is "j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin' => [
                        'masonry'
                    ],
                ],
            )
        );
        $self->add_control(
            // mec_sk_options_
            'masonry_modern_date_format2',
            array(
                'label'         => __('Date Format 2', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => 'F',
                'description'   => __('Default value is "F". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin' => [
                        'masonry'
                    ],
                ]
            )
        );
        // Limit
        $self->add_control(
            'masonry_limit',
            [
                'label'         => __('Limit', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'placeholder'   => __('eg. 24', 'mec-shortcode-builder'),
                'min'           => 1,
                'max'           => 99999999,
                'step'          => 1,
                'default'       => 24,
                'condition' => [
                    'skin' => [
                        'masonry'
                    ],
                ],
            ]
        );
        // Filter By
        $self->add_control(
            // mec_sk_options_
            'masonry_filter_by',
            array(
                'label'     => __('Filter By', 'mec-shortcode-builder'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''   => __('----', 'mec-shortcode-builder'),
                    'category'  => __('Category', 'mec-shortcode-builder'),
                    'label'     => __('Label', 'mec-shortcode-builder'),
                    'location'  => __('Location', 'mec-shortcode-builder'),
                    'organizer' => __('Organizer', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'masonry'
                    ],
                ]
            )
        );
        // Convert Masonry to Grid
        $self->add_control(
            'masonry_like_grid',
            [
                'label'         => __('Convert Masonry to Grid', 'mec-shortcode-builder'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __('Show', 'mec-shortcode-builder'),
                'label_off'     => __('Hide', 'mec-shortcode-builder'),
                'return_value'  => '1',
                'default'       => '0',
                'condition' => [
                    'skin' => [
                        'masonry'
                    ],
                ],
            ]
        );
		// Localtime
		$self->add_control(
			'masonry_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'masonry',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'masonry_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'masonry',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'masonry_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'masonry',
					],
				],
			]
		);
        // Single Event Display Method
        $self->add_control(
            'masonry_sed_method',
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
                        'masonry'
                    ],
                ],
                
            ]
        );
    }
}
