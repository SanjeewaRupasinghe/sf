<?php
namespace Elementor;

namespace MEC_Single_Builder\Inc\Admin\Widgets;

use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_MoreInfo extends \Elementor\Widget_Base
{

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{

		return 'event_more_info';
	}

	/**
	 * Retrieve Alert widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{

		return __('Single Event More Info', 'mec-single-builder');
	}

	/**
	 * Retrieve Alert widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{

		return 'mec-fa-info';
	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories()
	{

		return ['single_builder'];
	}

	/**
	 * Register Alert widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'mec_more_info_box',
			array(
				'label' 	=> __('More Info Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_more_info_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_widget_box_align',
			[
				'label'		=> __( 'Widget Alignment', 'mec-single-builder' ),
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .mec-event-more-info' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_more_info_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_more_info_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_more_info_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-event-more-info',
			]
		);

		$this->add_control(
			'mec_more_info_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_more_info_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-more-info',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_more_info_typography',
			array(
				'label' 	=> __('More Info Typography', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_more_info_typography_title',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-more-info .mec-cost',
			]
		);

		$this->add_control(
			'mec_more_info_typography_title_color',
			[
				'label' 		=> __('Title Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info .mec-cost' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_more_info_typography_title_padding', //param_name
			[
				'label' 		=> __('Title Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info .mec-cost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_more_info_typography_icon_size',
			[
				'label' 		=> __('Icon Size', 'mec-single-builder'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' 		=> [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_more_info_typography_icon_color',
			[
				'label' 		=> __('Icon Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info i:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_more_info_link_typography',
				'label' 	=> __('Link Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-more-info .mec-more-info-button',
			]
		);

		$this->add_control(
			'mec_more_info_link_typography_color',
			[
				'label' 		=> __('Link Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info .mec-more-info-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_more_info_link_typography_color_hover',
			[
				'label' 		=> __('Link Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info .mec-more-info-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_more_info_link_typography_padding', //param_name
			[
				'label' 		=> __('Label Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info .mec-more-info-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_widget_box_label_typography_padding', //param_name
			[
				'label' 		=> __('Label Wrapper Spacing', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'separator' 	=> 'before',
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-more-info dd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	protected function render()
	{

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-more-info' );
	}
}
