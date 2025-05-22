<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor Full Calendar View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_full_calendar_display_opts {


	/**
	 * Register Elementor Full Calendar View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'full_calendar_start_date_type',
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
						'full_calendar',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			'full_calendar_start_date',
			[
				'label'          => __( 'On a certain date', 'mec-shortcode-builder' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'condition'      => [
					'skin'                          => [
						'full_calendar',
					],
					'full_calendar_start_date_type' => [
						'date',
					],
				],
				'picker_options' => [
					'dateFormat' => 'M d Y',
				],
				'default'        => date( 'M d Y', current_time( 'timestamp' ) ),
			]
		);
		// Default View
		$self->add_control(
			// mec_sk_options_
			'full_calendar_default_view',
			array(
				'label'     => __( 'Default View', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'list',
				'options'   => [
					'list'    => __( 'List View', 'mec-shortcode-builder' ),
					'grid'    => __( 'Grid View', 'mec-shortcode-builder' ),
					'tile'    => __( 'Tile View', 'mec-shortcode-builder' ),
					'yearly'  => __( 'Yearly View', 'mec-shortcode-builder' ),
					'monthly' => __( 'Monthly/Calendar View', 'mec-shortcode-builder' ),
					'weekly'  => __( 'Weekly View', 'mec-shortcode-builder' ),
					'daily'   => __( 'Daily View', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'full_calendar',
					],
				],
			)
		);
		// Monthly Style
		$self->add_control(
			// mec_sk_options_
			'full_calendar_monthly_style',
			array(
				'label'     => __( 'Monthly Style', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'clean',
				'options'   => [
					'clean'  => __( 'Clean', 'mec-shortcode-builder' ),
					'novel'  => __( 'Novel', 'mec-shortcode-builder' ),
					'simple' => __( 'Simple', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'full_calendar',
					],
				],
			)
		);
		// List View
		$self->add_control(
			'full_calendar_list',
			[
				'label'        => __( 'List View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Date Formats classic
		$self->add_control(
			// mec_sk_options_
			'full_calendar_date_format_list',
			array(
				'label'       => __( 'List View Date Formats', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'd M',
				'description' => __( 'Default value is "d M". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'full_calendar',
					],
					'full_calendar_list' => [
						'1',
					],
				],
			)
		);
		$self->add_control(
			'full_calendar_grid',
			[
				'label'        => __( 'Grid View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		$self->add_control(
			'full_calendar_tile',
			[
				'label'        => __( 'Tile View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Yearly View
		$self->add_control(
			'full_calendar_yearly',
			[
				'label'        => __( 'Yearly View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Date Formats modern
		$self->add_control(
			// mec_sk_options_
			'full_calendar_date_format_yearly_1',
			array(
				'label'       => __( 'Date Format 1', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'l',
				'description' => __( 'Default value is "l". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'full_calendar',
					],
					'full_calendar_yearly' => [
						'1',
					],
				],
			)
		);
		$self->add_control(
			// mec_sk_options_
			'full_calendar_date_format_yearly_2',
			array(
				'label'       => __( 'Date Format 2', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'F j',
				'description' => __( 'Default value is "F j". <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Date format list</a>', 'mec-shortcode-builder' ),
				'condition'   => [
					'skin'       => [
						'full_calendar',
					],
					'full_calendar_yearly' => [
						'1',
					],
				],
			)
		);
		// Monthly/Calendar View
		$self->add_control(
			'full_calendar_monthly',
			[
				'label'        => __( 'Monthly/Calendar View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Weekly View
		$self->add_control(
			'full_calendar_weekly',
			[
				'label'        => __( 'Weekly View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Daily View
		$self->add_control(
			'full_calendar_daily',
			[
				'label'        => __( 'Daily View', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Display Event Price
		$self->add_control(
			'full_calendar_display_price',
			[
				'label'        => __( 'Display Event Price', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin'                       => [
						'full_calendar',
					],
					'full_calendar_default_view' => [
						'list',
					],
				],
			]
		);
		// Normal Label
		$self->add_control(
			'full_calendar_display_label',
			[
				'label'        => __( 'Display Normal Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Reason for Cancellation
		$self->add_control(
			'full_calendar_reason_for_cancellation',
			[
				'label'        => __( 'Display Reason for Cancellation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'full_calendar',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'full_calendar_sed_method',
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
						'full_calendar',
					],
				],

			]
		);
	}
}
