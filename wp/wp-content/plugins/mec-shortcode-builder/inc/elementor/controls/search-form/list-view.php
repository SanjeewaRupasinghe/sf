<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor search form list view class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_list_search_form {

	/**
	 * Register Elementor search form list options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		// Show Search Form
		$self->add_control(
			// mec_sk_options_
			'list_sf_status',
			[
				'label'        => __( 'Search Box', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'list',
					],
				],
			]
		);
		// Show Search Form
		$self->add_control(
			// mec_sk_options_
			'list_sf_display_label',
			[
				'label'        => __( 'Show Labels', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			]
		);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'list_category_type',
			array(
				'label'     => __( 'Category', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        		=> __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' 		=> __( 'Dropdown', 'mec-shortcode-builder' ),
					'checkboxes' 	=> __( 'Checkboxes', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Location
		$self->add_control(
			// mec_sk_options_
			'list_location_type',
			array(
				'label'     => __( 'Location', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' => __( 'Dropdown', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Organizer
		$self->add_control(
			// mec_sk_options_
			'list_organizer_type',
			array(
				'label'     => __( 'Organizer', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' => __( 'Dropdown', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Speaker
		$self->add_control(
			// mec_sk_options_
			'list_speaker_type',
			array(
				'label'     => __( 'Speaker', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' => __( 'Dropdown', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Tag
		$self->add_control(
			// mec_sk_options_
			'list_tag_type',
			array(
				'label'     => __( 'Tag', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' => __( 'Dropdown', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Label
		$self->add_control(
			// mec_sk_options_
			'list_label_type',
			array(
				'label'     => __( 'Label', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' => __( 'Dropdown', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Address
		$self->add_control(
			// mec_sk_options_
			'list_address_search_type',
			array(
				'label'     => __( 'Address', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => __( 'Disabled', 'mec-shortcode-builder' ),
					'address_input' => __( 'Address Input', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'             => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Address Placeholder
		$self->add_control(
			// mec_sk_options_
			'list_address_search_placeholder',
			array(
				'label'       => __( 'Address Placeholder', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
					'list_address_search_type' => [
						'address_input',
					],
				],
			)
		);
		// Event Cost
		$self->add_control(
			// mec_sk_options_
			'list_event_cost_type',
			array(
				'label'     => __( 'Event Cost Filter', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'			=> __( 'Disabled', 'mec-shortcode-builder' ),
					'minmax'	=> __( 'Min / Max Inputs', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Date Filter
		$self->add_control(
			// mec_sk_options_
			'list_month_filter_type',
			array(
				'label'     => __( 'Date Filter', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        			=> __( 'Disabled', 'mec-shortcode-builder' ),
					'dropdown' 			=> __( 'Dropdown', 'mec-shortcode-builder' ),
					'date-range-picker' => __( 'Date Picker', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Time Filter
		$self->add_control(
			// mec_sk_options_
			'list_time_filter_type',
			array(
				'label'     => __( 'Time Filter', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        			=> __( 'Disabled', 'mec-shortcode-builder' ),
					'local-time-picker'	=> __( 'Local Time Picker', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Text Search
		$self->add_control(
			// mec_sk_options_
			'list_text_search_type',
			array(
				'label'     => __( 'Text Search', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'text_input',
				'options'   => [
					'0'          => __( 'Disabled', 'mec-shortcode-builder' ),
					'text_input' => __( 'Text Input', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin'           => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
				],
			)
		);
		// Text Search Placeholder
		$self->add_control(
			// mec_sk_options_
			'list_text_search_placeholder',
			array(
				'label'       => __( 'Text Search Placeholder', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'skin'       => [
						'list',
					],
					'list_sf_status' => [
						'1',
					],
					'list_text_search_type' => [
						'text_input',
					],
				],
			)
		);
	}
}
