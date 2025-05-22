<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Countdown  extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_countdown';
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

		return __('Single Event Countdown', 'mec-single-builder');
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

		return 'eicon-number-field';
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

		return ['single_builder'];
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
			'mec_countdown_box',
			array(
				'label' 	=> __('Countdown Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_countdown_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-countdown' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_countdown_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_countdown_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-countdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_countdown_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-events-meta-group-countdown',
			]
		);

		$this->add_control(
			'mec_countdown_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_countdown_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-events-meta-group-countdown',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_countdown_typography',
			array(
				'label' 	=> __('Countdown Typography', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_countdown_typography_counter',
				'label' 	=> __('Counter Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-events-meta-group-countdown .countdown-w span, {{WRAPPER}} .countdown-w .block-w, {{WRAPPER}} .flip-clock-wrapper ul li a div.up div.inn, {{WRAPPER}} .flip-clock-wrapper ul li a div.down div.inn',
			]
		);

		$this->add_control(
			'mec_countdown_color_counter',
			[
				'label' 		=> __( 'Counter Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .countdown-w .block-w, {{WRAPPER}} .flip-clock-wrapper ul li a div.up div.inn, {{WRAPPER}} .flip-clock-wrapper ul li a div.down div.inn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_counter_bg_color_counter',
			[
				'label' 		=> __( 'Counter Background', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .countdown-w .block-w, {{WRAPPER}} .flip-clock-wrapper ul li a div.up div.inn, {{WRAPPER}} .flip-clock-wrapper ul li a div.down div.inn' => 'background-color: {{VALUE}}',
				],
				'description' 	=> __( 'If you use the "Flip Style" countdown style you can set background color for flipper', 'mec-single-builder'),
			]
		);

		$this->add_responsive_control(
			'mec_countdown_padding_counter', //param_name
			[
				'label' 		=> __( 'Counter Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .countdown-w .block-w' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_countdown_typography_label',
				'label' 	=> __('Counter label Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .countdown-w .clockdiv li p, {{WRAPPER}} .flip-clock-divider .flip-clock-label',
			]
		);

		$this->add_control(
			'mec_countdown_color_label',
			[
				'label' 		=> __( 'Counter label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .countdown-w .clockdiv li p, {{WRAPPER}} .flip-clock-divider .flip-clock-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_countdown_margin_label', //param_name
			[
				'label' 		=> __( 'Counter label Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .countdown-w .clockdiv li p, {{WRAPPER}} .flip-clock-divider .flip-clock-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; ',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-countdown' );
	}
}
