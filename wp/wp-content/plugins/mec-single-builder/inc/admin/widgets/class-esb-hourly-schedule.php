<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Hourly_Schedule extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_hourly_schedule';

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

		return __( 'Single Event Hourly Schedule', 'mec-single-builder' );

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

		return 'mec-fa-clock-o';

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
		'mec_widget_title_typography',
			array(
				'label' 	=> __( 'Widget Title Settings', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_widget_display', //param_name
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
					'{{WRAPPER}} .mec-frontbox-title' => 'display: {{VALUE}};',
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
				'name' 		=> 'mec_widget_title_typography',
				'label' 	=> __( 'Title Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-frontbox-title',
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_color',
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
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
				'name' 			=> 'mec_widget_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-frontbox-title',
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_before_color',
			[
				'label' 		=> __( 'Title Shape Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title:before' => 'border-color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
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
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_responsive_control(
			'mec_widget_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_shape_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'background: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_hourly_schedule_box',
			array(
				'label' 	=> __('Hourly Schedule Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_hourly_schedule_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_hourly_schedule_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_hourly_schedule_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_hourly_schedule_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-frontbox',
			]
		);

		$this->add_control(
			'mec_hourly_schedule_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_hourly_schedule_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-frontbox',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_hourly_schedule_day_typo',
			array(
				'label' 	=> __( 'Day Title Typography', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_hourly_schedule_day_typography',
				'label' 	=> __( 'Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-schedule-part',
			]
		);

		$this->add_control(
			'mec_hourly_schedule_day',
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-part' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_hourly_schedule_day_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
		'mec_hourly_schedule_time_typo',
			array(
				'label' 	=> __( 'Start & End Time Typography', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_hourly_schedule_time_typography',
				'label' 	=> __( 'Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-schedule-start-time, {{WRAPPER}} .mec-schedule-end-time',
			]
		);

		$this->add_control(
			'mec_hourly_schedule_time',
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-start-time, {{WRAPPER}} .mec-schedule-end-time' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_hourly_schedule_time_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-start-time, {{WRAPPER}} .mec-schedule-end-time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_hourly_schedule_detail_typo',
			array(
				'label' 	=> __( 'Content Typography', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_hourly_schedule_detail_typography',
				'label' 	=> __( 'Details Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-schedule-title',
			]
		);

		$this->add_control(
			'mec_hourly_schedule_detail',
			[
				'label' 		=> __( 'Details Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_hourly_schedule_detail_padding', //param_name
			[
				'label' 		=> __( 'Details Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_hourly_schedule_description_typography',
				'label' 	=> __( 'Description Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-schedule-description',
			]
		);

		$this->add_control(
			'mec_hourly_schedule_description',
			[
				'label' 		=> __( 'Description Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_hourly_schedule_description_padding', //param_name
			[
				'label' 		=> __( 'Description Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-schedule-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_hourly_schedule_map_color',
			[
				'label' 		=> __( 'Detail & Description Map Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-schedule-content, {{WRAPPER}} .mec-event-schedule-content dl:before' => 'border-color: {{VALUE}}',
				],
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-hourly-schedule' );
	}

}