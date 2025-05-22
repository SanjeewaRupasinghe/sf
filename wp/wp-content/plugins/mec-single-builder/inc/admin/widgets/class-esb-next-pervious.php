<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_NextPervious extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_next_pervious';

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

		return __( 'Single Next Event Module', 'mec-single-builder' );

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

		return 'eicon-post';

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
		'mec_widget_nextevents_title_typography',
			array(
				'label' 	=> __( 'Widget Title Settings', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_widget_nextevents_display', //param_name
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
				'name' 		=> 'mec_widget_nextevents_title_typography',
				'label' 	=> __( 'Title Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-frontbox-title',
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_nextevents_color',
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
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
				'name' 			=> 'mec_widget_nextevents_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-frontbox-title',
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_nextevents_before_color',
			[
				'label' 		=> __( 'Title Shape Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title:before' => 'border-color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
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
					'mec_widget_nextevents_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_responsive_control(
			'mec_widget_nextevents_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_nextevents_shape_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_nextevents_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-frontbox-title' => 'background: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_nextevents_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'mec_nextevents_box',
			array(
				'label' 	=> __('Next Events Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_nextevents_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_nextevents_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_nextevents_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_nextevents_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-next-event-details',
			]
		);

		$this->add_control(
			'mec_nextevents_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_nextevents_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-next-event-details',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_nextevents_typography',
			array(
				'label' 	=> __( 'Next Event Typography', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_nextevents_btn_typography_title',
				'label' 	=> __( 'Next Event Button Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-next-event-details a',
			]
		);

		$this->add_control(
			'mec_nextevents_btn_typography_color',
			[
				'label' 		=> __( 'Next Event Button Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_nextevents_btn_typography_bg',
			[
				'label' 		=> __( 'Next Event Button Background', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details a' => 'background: {{VALUE}}',
				],
			]
		);


		$this->add_responsive_control(
			'mec_nextevents_btn_typography_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_nextevents_btn_typography_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_nextevents_btn_typography_color_hover',
			[
				'label' 		=> __( 'Next Event Hover Button Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_nextevents_btn_typography_bg_hover',
			[
				'label' 		=> __( 'Next Event Hover Button Background', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-event-details a:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_nextevents_btn_typography_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-next-event-details a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_date_typography',
			array(
				'label' 	=> __( 'Date & Time', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_date_typography_title',
				'label' 	=> __( 'Date & Time box', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-next-occurrence h6',

			]
		);
		$this->add_responsive_control(
			'mec_date_time_box_padding', //param_name
			[
				'label' 		=> __( 'Date & Time Box Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_date_time_box_margin', //param_name
			[
				'label' 		=> __( 'Date & Time Box Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_date_typography_title2',
				'label' 	=> __( 'Date Title Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-next-occurrence h6',
			]
		);

		$this->add_control(
			'mec_date_typography_color',
			[
				'label' 		=> __( 'Date & Time Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence h6' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_date_typography_padding', //param_name
			[
				'label' 		=> __( 'Date & Time Title Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_date_typography_icon',
			[
				'label' 		=> __( 'Date & Time Icon Size', 'mec-single-builder' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
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
					'size' => 14,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_date_typography_icon_color',
			[
				'label' 		=> __( 'Date & Time Icon Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence i:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_date_label_typography_title',
				'label' 	=> __( 'Date & Time Label Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-next-occurrence dd abbr',
			]
		);

		$this->add_control(
			'mec_date_label_typography_color',
			[
				'label' 		=> __( 'Date & Time Label Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence dd abbr' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_date_label_typography_padding', //param_name
			[
				'label' 		=> __( 'Date & Time Label Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-next-occurrence dd abbr' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-next-occurrences' );
	}

}