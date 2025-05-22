<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Weather extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_weather';

	}

	/**
	 * Retrieve Alert widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Single Event Weather Module', 'mec-single-builder' );

	}

	/**
	 * Retrieve Alert widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-cloud-check';

	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {

		return [ 'single_builder' ];

	}

	/**
	 * Register Alert widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
		'mec_widget_weather_title_typography',
			array(
				'label' 	=> __( 'Widget Title Settings', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_widget_weather_display', //param_name
			[
				'label' 	=> __( 'Display Widget Title', 'mec-single-builder' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'block',
				'options' 	=> [ //value
					'block' 		=> __( 'block', 'mec-single-builder' ),
					'none'  		=> __( 'none', 'mec-single-builder' ),
					'inline'  		=> __( 'inline', 'mec-single-builder' ),
					'inline-block'  => __( 'inline-block', 'mec-single-builder' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-frontbox-title' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'mec_widget_align',
			[
				'label'		=> __( 'Alignment', 'mec-single-builder' ),
				'type'		=> \Elementor\Controls_Manager::CHOOSE,
				'options'	=> [
					'left' => [
						'title' => __( 'Left', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .mec-frontbox-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_weather_title_typography',
				'label' 	=> __( 'Title Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-frontbox-title',
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_weather_color',
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_widget_weather_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-frontbox-title',
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_weather_before_color',
			[
				'label' 		=> __( 'Title Shape Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title:before' => 'border-color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_border_position',
			[
				'label'		=> __( 'Alignment', 'mec-single-builder' ),
				'type'		=> \Elementor\Controls_Manager::CHOOSE,
				'options'	=> [
					'0' => [
						'title' => __( 'Left', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-long-arrow-alt-left',
					],
					'calc(50% - 35px)' => [
						'title' => __( 'Center', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-window-minimize',
					],
					'calc(100% - 70px)' => [
						'title' => __( 'Right', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-long-arrow-alt-right',
					],
				],
				'default' => 'calc(50% - 35px)',
				'selectors' => [
					'{{WRAPPER}} .mec-frontbox-title:before' => 'left: {{VALUE}}; margin: 0;',
				],
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_responsive_control(
			'mec_widget_weather_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_weather_shape_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_weather_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'background: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_weather_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_attendees_box',
			array(
				'label' 	=> __( 'Weather Box', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_attendees_box_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-details' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_attendees_box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_attendees_box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_attendees_box_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-weather-details',
			]
		);

		$this->add_control(
			'mec_attendees_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_attendees_box_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-weather-details',
				]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_weather',
			array(
				'label' 	=> __( 'Weather Module Styles', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_weather_bg',
			[
				'label' 		=> __( 'Weather Background Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-head' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_weather_condition_color',
			[
				'label' 		=> __( 'Condition Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-summary-report' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_weather_condition_typography',
				'label' 	=> __( 'Condition typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-weather-summary-report',
			]
		);

		$this->add_control(
			'mec_weather_temp_color',
			[
				'label' 		=> __( 'Temp Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-summary-temp' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_weather_temp_typography',
				'label' 	=> __( 'Temp typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-weather-summary-temp',
			]
		);

		$this->add_control(
			'mec_weather_more_details_color',
			[
				'label' 		=> __( 'More Details Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-extras' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_weather_more_details_typography',
				'label' 	=> __( 'More Details typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-weather-extras',
			]
		);

		$this->add_control(
			'mec_weather_more_details_span_color',
			[
				'label' 		=> __( 'More Details Span Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-extras span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_weather_more_details_span_typography',
				'label' 	=> __( 'More Details Span typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-weather-extras span',
			]
		);

		$this->add_responsive_control(
			'mec_weather_padding', //param_name
			[
				'label' 		=> __( 'Box Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_weather_margin', //param_name
			[
				'label' 		=> __( 'Box Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_weather_box_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-weather-head',
			]
		);

		$this->add_control(
			'mec_weather_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-weather-head' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_weather_box_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-weather-head',
				]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Alert widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-weather' );
	}

}