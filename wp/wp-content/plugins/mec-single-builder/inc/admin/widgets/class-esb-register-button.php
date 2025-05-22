<?php
namespace Elementor;

namespace MEC_Single_Builder\Inc\Admin\Widgets;

use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_RegisterButton extends \Elementor\Widget_Base
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

		return 'event_register_button';
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

		return __('Single Event Register Button', 'mec-single-builder');
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

		return 'eicon-button';
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
			'mec_regbtn_box',
			array(
				'label' 	=> __('Register Button Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_regbtn_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_regbtn_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_regbtn_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_regbtn_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-reg-btn.mec-frontbox',
			]
		);

		$this->add_control(
			'mec_regbtn_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_regbtn_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-reg-btn.mec-frontbox',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_regbtn_typography',
			array(
				'label' 	=> __('Register Button', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_regbtn_typography_title',
				'label' 	=> __('Button Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button',
			]
		);

		$this->add_control(
			'mec_regbtn_typography_color',
			[
				'label' 		=> __('Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_regbtn_typography_color_hover',
			[
				'label' 		=> __('Text Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_regbtn_typography_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_regbtn_typography_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_regbtn_box_width',
			[
				'label' 		=> __('Button Width', 'mec-single-builder'),
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
					'unit' => '%',
					'size' => 100,
				],
				'selectors' 	=> [
					'.mec-single-event {{WRAPPER}} .mec-booking-button' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_regbtn_btn_height',
			[
				'label' 		=> __('Button Height', 'mec-single-builder'),
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
					'default' 		=> [
						'unit' => '%',
						'size' => 100,
					],
				],
				'selectors' 	=> [
					'.mec-single-event {{WRAPPER}} .mec-booking-button' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'mec_regbtn_typography_bgcolor',
			[
				'label' 		=> __('Button Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mec_regbtn_typography_bgcolor_hover',
			[
				'label' 		=> __('Button Hover Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button:hover' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_regbtn_typo_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button',
			]
		);

		$this->add_control(
			'mec_regbtn_typo_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_regbtn_typo_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-reg-btn.mec-frontbox .mec-booking-button',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-register-button' );
	}
}
