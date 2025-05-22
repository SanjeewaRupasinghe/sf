<?php
namespace Elementor;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor custom View class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_custom_display_opts {

	/**
	 * Register Elementor custom View options
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public static function options( $self ) {
		$args = [
			'post_type'   => 'mec_designer',
			'post_status' => 'publish',
			'order'       => 'DESC',
		];
		$styles = new \WP_Query( $args );
		$post_id_key = array();
		$post_name_value = array();
		foreach ( $styles->get_posts() as $post ) :
			$post_id_key[] = $post->ID;
			$post_name_value[] = $post->post_title;
		endforeach;
		$post_designer = array_combine($post_id_key,$post_name_value);
		// Start Date
		$self->add_control(
			// mec_sk_options_
			'custom_style',
			array(
				'label'     => __( 'Start Date', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'start_current_month',
				'options'   => $post_designer,
				'condition' => [
					'skin' => [
						'custom',
					],
				],
			)
		);
		// On a certain date
		$self->add_control(
			// mec_sk_options_
			'custom_start_date_type',
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
						'custom',
					],
				],
			)
		);
		// Count in row
		$self->add_control(
			// mec_sk_options_
			'custom_count',
			array(
				'label'     => __( 'Count in row', 'mec-shortcode-builder' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1'  => __( '1', 'mec-shortcode-builder' ),
					'2'  => __( '2', 'mec-shortcode-builder' ),
					'3'  => __( '3', 'mec-shortcode-builder' ),
					'4'  => __( '4', 'mec-shortcode-builder' ),
					'6'  => __( '6', 'mec-shortcode-builder' ),
					'12' => __( '12', 'mec-shortcode-builder' ),
				],
				'condition' => [
					'skin' => [
						'custom',
					],
				],
			)
		);
		// Limit
		$self->add_control(
			'custom_limit',
			[
				'label'       => __( 'Limit', 'mec-shortcode-builder' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => __( 'eg. 6', 'mec-shortcode-builder' ),
				'min'         => 1,
				'max'         => 99999999,
				'step'        => 1,
				'default'     => 6,
				'condition'   => [
					'skin' => [
						'custom',
					],
				],
			]
		);
		// Load More Button
		$self->add_control(
			'custom_load_more_button',
			[
				'label'        => __( 'Load More Button', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'custom',
					],
				],
			]
		);

		// Load More Button
		$self->add_control(
			'custom_map_on_top',
			[
				'label'        => __( 'Show Map on top', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'skin' => [
						'custom',
					],
				],
			]
		);

		$self->add_control(
			'custom_set_geolocation',
			[
				'label'        => __( 'Geolocation', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'mec-shortcode-builder' ),
				'label_off'    => __( 'OFF', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '0',
				'condition'    => [
					'custom_map_on_top' => [
						'1',
					],
				],
			]
		);

		// Show Month Divider
		$self->add_control(
			'custom_month_divider',
			[
				'label'        => __( 'Show Month Divider', 'mec-shortcode-builder' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'mec-shortcode-builder' ),
				'label_off'    => __( 'Hide', 'mec-shortcode-builder' ),
				'return_value' => '1',
				'default'      => '1',
				'condition'    => [
					'skin' => [
						'custom',
					],
				],
			]
		);
		// Single Event Display Method
		$self->add_control(
			'custom_sed_method',
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
					'skin'        => [
						'custom',
					],
				],

			]
		);
	}
}
