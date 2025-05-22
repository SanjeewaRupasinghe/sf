<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor map View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_map_display_opts {


	/**
	 * Register Elementor map View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'map_start_date_type',
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
						'map',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			'map_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
				'condition'      => [
					'skin'                => [
						'map',
					],
					'map_start_date_type' => [
						'date',
					],
				],
			]
		);
		// Limit
		$self->add_control(
			'map_limit',
			[
				'label'       => __( 'Maximum events', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => __( 'eg. 200', 'mec-shortcode-builder' ),
				'min'         => 1,
				'max'         => 99999999,
				'step'        => 1,
				'default'     => 200,
				'condition'   => [
					'skin' => [
						'map',
					],
				],
			]
		);
		// Geolocation
		$self->add_control(
			'map_geolocation',
			[
				'label'        => __( 'Geolocation', 'mec-shortcode-builder' ),
				'description'  => __( 'The geolocation feature works only in secure (https) websites.', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'map',
					],
				],
			]
		);
		$self->add_control(
			// mec_sk_options_
			'map_zoom',
			array(
				'label'     => __( 'Zoom', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '8',
				'options'   => [
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
				],
				'condition' => [
					'skin' => [
						'map',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'view_mode',
			array(
				'label'     => __( 'View Mode', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'normal',
				'options'   => [
					'normal'      => __( 'Normal', 'mec-shortcode-builder' ),
					'side'        => __( 'Side', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'map',
					],
				],
			)
		);
		$self->add_control(
			'map_center_lat',
			[
				'label'       => __( 'Center Lat', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Center Lat', 'mec-shortcode-builder' ),
				'default'     => '',
				'condition'   => [
					'skin' => [
						'map',
					],
				],
			]
		);
		$self->add_control(
			'map_center_long',
			[
				'label'       => __( 'Center Long', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Center Long', 'mec-shortcode-builder' ),
				'default'     => '',
				'condition'   => [
					'skin' => [
						'map',
					],
				],
			]
		);
	}
}
