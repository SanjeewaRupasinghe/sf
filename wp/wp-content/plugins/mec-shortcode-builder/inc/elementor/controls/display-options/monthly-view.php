<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor monthly View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_monthly_display_opts {


	/**
	 * Register Elementor monthly View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Style
		$self->add_control(
			// mec_sk_options_
			'monthly_style',
			array(
				'label'     => __( 'Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'classic',
				'options'   => [
					'classic' => __( 'Classic', 'mec-shortcode-builder' ),
					'clean'   => __( 'Clean', 'mec-shortcode-builder' ),
					'modern'  => __( 'Modern', 'mec-shortcode-builder' ),
					'novel'   => __( 'Novel', 'mec-shortcode-builder' ),
					'simple'  => __( 'Simple', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'monthly_view',
					],
				],
			)
		);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'monthly_start_date_type',
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
						'monthly_view',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			'monthly_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
				'condition'      => [
					'skin'                    => [
						'monthly_view',
					],
					'monthly_start_date_type' => [
						'date',
					],
				],
			]
		);
		// Events per day
		$self->add_control(
			'monthly_limit',
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
						'monthly_view',
					],
				],
			]
		);
		// Next/Previous Buttons
		$self->add_control(
			'monthly_next_previous_button',
			[
				'label'        => __( 'Next/Previous Buttons', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'monthly_view',
					],
				],
			]
		);
		// Localtime
		$self->add_control(
			'monthly_include_local_time',
			[
				'label'        => __( 'Include Local Time', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'monthly_view',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'monthly_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'monthly_view',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'monthly_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'monthly_view',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'monthly_sed_method',
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
						'monthly_view',
					],
				],

			]
		);
	}
}
