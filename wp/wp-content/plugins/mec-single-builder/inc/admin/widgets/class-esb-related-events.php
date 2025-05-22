<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Related_Events extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'related_events';

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

		return __( 'Single Event Related', 'mec-single-builder' );

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

		return 'eicon-post-info';

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
				'label' 	=> __('Widget Title Settings', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_widget_display', //param_name
			[
				'label' 	=> __('Display Widget Title', 'mec-single-builder'), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'block',
				'options' 	=> [ //value
					'block' 		=> __('block', 'mec-single-builder'),
					'none'  		=> __('none', 'mec-single-builder'),
					'inline'  		=> __( 'inline', 'mec-single-builder' ),
					'inline-block'  => __( 'inline-block', 'mec-single-builder' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title' => 'display: {{VALUE}};',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_title_typography',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title',
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
				'label' 		=> __('Title Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title' => 'color: {{VALUE}}',
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
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title',
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
				'label' 		=> __('Title Shape Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title:before' => 'background: {{VALUE}}',
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
					'calc(50% - 23px)' => [
						'title' => __( 'Center', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-window-minimize',
					],
					'calc(100% - 46px)' => [
						'title' => __( 'Right', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-long-arrow-alt-right',
					],
				],
				'default' => '0',
				'selectors' => [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title:before' => 'left: {{VALUE}}; margin: 0;',
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
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-rec-events-title' => 'background: {{VALUE}}',
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
			'mec_item_related_box',
				array(
					'label' 	=> __( 'Related Items Settings', 'mec-single-builder' ),
					'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				)
		);

		$this->add_control(
			'mec_each_item_related_box_bg_color', //param_name
			[
				'label' 		=> __( 'Item Background', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap article' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_main_items_related_img_shape_radius', //param_name
			[
				'label' 		=> __( 'Item Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_item_related_box_padding', //param_name
			[
				'label' 		=> __( 'Wrapper Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_item_related_box_bg_color', //param_name
			[
				'label' 		=> __( 'Content Background', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_date_content_typography',
				'label' 	=> __('Date Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content span',
			]
		);

		$this->add_control(
			'mec_widget_date_content_color', //param_name
			[
				'label' 		=> __( 'Date Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_title_content_typography',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content h5 a',
			]
		);

		$this->add_control(
			'mec_widget_link_content_color', //param_name
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content h5 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_widget_link_content_color_hover', //param_name
			[
				'label' 		=> __( 'Title Hover Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content h5:hover a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_item_related_box_border',
				'label' 		=> __( 'Content Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content',
			]
		);

		$this->add_control(
			'mec_item_related_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Content Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_item_related_content_padding', //param_name
			[
				'label' 		=> __( 'Content Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_item_related_content_margin', //param_name
			[
				'label' 		=> __( 'Content Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_item_related_content_box_shadow',
					'label' 	=> __( 'Content Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post .mec-related-event-content',
				]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_item_related_img_box_border',
				'label' 		=> __( 'Content Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post img',
			]
		);

		$this->add_control(
			'mec_item_related_img_shape_radius', //param_name
			[
				'label' 		=> __( 'Image Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_item_related_img_box_shadow',
					'label' 	=> __( 'Image Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-related-events-wrap .mec-related-event-post img',
				]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_related_box',
				array(
					'label' 	=> __( 'Related Box', 'mec-single-builder' ),
					'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				)
			);

		$this->add_control(
			'mec_related_box_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_related_box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_related_box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_related_box_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-related-events-wrap',
			]
		);

		$this->add_control(
			'mec_related_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-related-events-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_related_box_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-related-events-wrap',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-related' );
	}

}