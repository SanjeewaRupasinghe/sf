<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor cover View class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_cover_display_opts
{

    /**
     * Register Elementor cover View options 
     * @author Webnus <info@webnus.biz>
     */
    public static function options( $self )
    {
		// Style
		$self->add_control(
            // mec_sk_options_
			'cover_style',
			array(
				'label'		=> __('Style', 'mec-shortcode-builder'),
				'type'		=> \Elementor\Controls_Manager::SELECT,
                'default'   => 'classic',
				'options'	=> [
					'classic'   => __('Classic', 'mec-shortcode-builder'),
					'clean'     => __('Clean', 'mec-shortcode-builder'),
					'modern'    => __('Modern', 'mec-shortcode-builder'),
                ],
                'condition'     => [
                    'skin'  => [
                        'cover'
                    ],
                ],
            )
		);
		// Localtime
		$self->add_control(
			'cover_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'cover',
					],
				],
			]
        );
		// Normal Label
		$self->add_control(
			'cover_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'cover',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'cover_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'cover',
					],
				],
			]
		);
		// Date Formats classic
		$self->add_control(
            // mec_sk_options_
			'cover_classic_date_format1',
			array(
				'label'		    => __('Date Format 1', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
                'default'	    => 'F d',
                'description'   => __('Default value is "F d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'cover'
                    ],
                    'cover_style'   => [
                        'classic'
                    ],
                ]
            )
        );
		$self->add_control(
            // mec_sk_options_
			'cover_classic_date_format2',
			array(
				'label'		    => __('Date Format 2', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
                'default'	    => 'l',
                'description'   => __('Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'cover'
                    ],
                    'cover_style'   => [
                        'classic'
                    ],
                ]
            )
        );

        // Date Formats clean
		$self->add_control(
            // mec_sk_options_
			'cover_clean_date_format1',
			array(
				'label'		    => __('Date Format 1', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
                'default'	    => 'd',
                'description'   => __('Default value is "d". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin' => [
                        'cover'
                    ],
                    'cover_style' => [
                        'clean'
                    ],
                ]
            )
        );
		$self->add_control(
            // mec_sk_options_
			'cover_clean_date_format2',
			array(
				'label'		    => __('Date Format 2', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
                'default'	    => 'M',
                'description'   => __('Default value is "M". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'cover'
                    ],
                    'cover_style'   => [
                        'clean'
                    ],
                ]
            )
        );
		$self->add_control(
            // mec_sk_options_
			'cover_clean_date_format3',
			array(
				'label'		    => __('Date Format 3', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
                'default'	    => 'Y',
                'description'   => __('Default value is "Y". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin'              => [
                        'cover'
                    ],
                    'cover_style'   => [
                        'clean'
                    ],
                ]
            )
        );

        // Date Formats modern
		$self->add_control(
            // mec_sk_options_
			'cover_date_format_modern1',
			array(
				'label'		    => __('Date Format', 'mec-shortcode-builder'),
				'type'		    => \Elementor\Controls_Manager::TEXT,
                'default'	    => 'l, F d Y',
                'description'   => __('Default value is "l, F d Y"', 'mec-shortcode-builder'),
                'condition'     => [
                    'skin' => [
                        'cover'
                    ],
                    'cover_style' => [
                        'modern'
                    ],
                ]
            )
        );

        // Events
        $all_events  = get_posts( 'post_type="mec-events"&numberposts=-1' );
        $events     = array();
        if ( $all_events ) :
            $events['select-event'] = __( 'Choose Event', 'inco-plus' );
            foreach ( $all_events as $event ) {
                $events[$event->ID] = $event->post_title;
            }
        else :
            $events['no-event'] = __( 'No event found', 'inco-plus' );
        endif;
		$self->add_control(
            // mec_sk_options_
			'cover_event',
			array(
				'label'     => __('Style', 'mec-shortcode-builder'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $events,
				'default'   => 'select-event',
                'condition' => [
                    'skin'  => [
                        'cover'
                    ],
                ],
            )
		);
    }
}