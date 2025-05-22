<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Speaker extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_speaker';

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

		return __( 'Single Event Speakers', 'mec-single-builder' );

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

		return 'eicon-call-to-action';

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
		'mec_widget_speaker_title',
			array(
				'label' 	=> __( 'Widget Title Settings', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_widget_speaker_title_display', //param_name
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
					'{{WRAPPER}} .mec-speakers' => 'display: {{VALUE}} !important;',
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
					'{{WRAPPER}} .mec-speakers' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_speaker_title_typography',
				'label' 	=> __( 'Title Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-speakers',
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_speaker_title_typography_color',
			[
				'label' 		=> __( 'Title Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
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
				'name' 			=> 'mec_widget_speaker_title_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-speakers',
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_speaker_title_before_color',
			[
				'label' 		=> __( 'Title Shape Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers:before' => 'border-color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
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
					'{{WRAPPER}} .mec-speakers:before' => 'left: {{VALUE}}; margin: 0;',
				],
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_responsive_control(
			'mec_widget_speaker_title_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_speaker_title_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_speaker_title_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers' => 'background: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_speaker_title_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_speaker_box',
			array(
				'label' 	=> __('Speaker Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_speaker_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_speaker_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-speakers-details',
			]
		);

		$this->add_control(
			'mec_speaker_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_speaker_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-speakers-details',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_single_speakers_box',
			array(
				'label' 	=> __( 'Speakers Item Box', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_single_speakers_box_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_single_speakers_box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_single_speakers_box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_single_speakers_box_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-speakers-details ul li',
			]
		);

		$this->add_control(
			'mec_single_speakers_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_single_speakers_box_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-speakers-details ul li',
				]
		);

		$this->add_control(
			'hr_a',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_speaker_name_link_typography',
				'label' 	=> __( 'Name Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-name',
			]
		);

		$this->add_control(
			'mec_speaker_name_link_typography_color',
			[
				'label' 		=> __( 'Name Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_speaker_name_link_typography_color_hover',
			[
				'label' 		=> __( 'Name Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-name:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_name_link_typography_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_name_link_typography_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_speaker_job_link_typography',
				'label' 	=> __( 'Name Hover Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-job-title',
			]
		);

		$this->add_control(
			'mec_speaker_job_link_typography_color',
			[
				'label' 		=> __( 'Name Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-job-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_speaker_job_link_typography_color_hover',
			[
				'label' 		=> __( 'Name Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-job-title:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_job_link_typography_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-job-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_job_link_typography_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_image_width',
			[
				'label' 		=> __( 'Image Width', 'mec-single-builder' ),
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
					'size' => 68,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_image_height',
			[
				'label' 		=> __( 'Image Height', 'mec-single-builder' ),
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
					'size' => 68,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_speaker_image_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_image_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_speaker_image_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_speaker_image_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img',
			]
		);

		$this->add_control(
			'mec_speaker_image_shape_radius',
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_speaker_image_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img',
				]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_speaker_image_hover_border',
				'label' 		=> __( 'Border Hover', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a:hover img',
			]
		);

		$this->add_control(
			'mec_speaker_image_hover_shape_radius',
			[
				'label' 		=> __( 'Border Radius Hover', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_speaker_image_hover_shadow',
					'label' 	=> __( 'Box Shadow Hover', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-speakers-details ul li .mec-speaker-avatar a img:hover',
				]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_popup_speaker',
			array(
				'label' 	=> __('Speaker Popup', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_popup_speaker_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-info' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_popup_speaker_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.mec-hourly-schedule-speaker-info',
			]
		);

		$this->add_control(
			'mec_popup_speaker_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_popup_speaker_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '.mec-hourly-schedule-speaker-info',
			]
		);

		$this->add_control(
			'hr_b',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_popup_speaker_name_typography_title',
				'label' 	=> __('Name Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-hourly-schedule-speaker-name',
			]
		);

		$this->add_control(
			'mec_popup_speaker_name_typography_color',
			[
				'label' 		=> __('Name Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_name_typography_padding', //param_name
			[
				'label' 		=> __('Name Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_name_typography_margin', //param_name
			[
				'label' 		=> __('Name Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_popup_speaker_job_typography_title',
				'label' 	=> __('Job Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-hourly-schedule-speaker-job-title',
			]
		);

		$this->add_control(
			'mec_popup_speaker_job_typography_color',
			[
				'label' 		=> __('Job Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-job-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_job_typography_padding', //param_name
			[
				'label' 		=> __('Job Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-job-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_job_typography_margin', //param_name
			[
				'label' 		=> __('Job Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_popup_speaker_paragraph_typography',
				'label' 	=> __('Description Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-hourly-schedule-speaker-description',
			]
		);

		$this->add_control(
			'mec_popup_speaker_paragraph_color',
			[
				'label' 		=> __('Description Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_paragraph_padding', //param_name
			[
				'label' 		=> __( 'Description Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_paragraph_margin', //param_name
			[
				'label' 		=> __( 'Description Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr_c',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_icon',
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
					'.mec-hourly-schedule-speaker-contact-information a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_popup_speaker_icon_color',
			[
				'label' 		=> __('Icon Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-contact-information a i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_popup_speaker_icon_color_hover',
			[
				'label' 		=> __('Icon Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-contact-information a i:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_popup_speaker_icon_bg_color',
			[
				'label' 		=> __('Icon Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-contact-information a i' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_popup_speaker_icon_bg_color_hover',
			[
				'label' 		=> __('Icon Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-contact-information a i:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_popup_speaker_bg_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.mec-hourly-schedule-speaker-contact-information a i',
			]
		);

		$this->add_control(
			'mec_popup_speaker_bg_border_radius',
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-contact-information a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr_d',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_image_width',
			[
				'label' 		=> __('Image Width', 'mec-single-builder'),
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
					'.mec-hourly-schedule-speaker-thumbnail img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_image_height',
			[
				'label' 		=> __('Image Height', 'mec-single-builder'),
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
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-thumbnail img' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
				],
			]
		);

		$this->add_control(
			'mec_popup_speaker_image_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-thumbnail' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_image_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_popup_speaker_image_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_popup_speaker_image_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.mec-hourly-schedule-speaker-thumbnail',
			]
		);

		$this->add_control(
			'mec_popup_speaker_image_box_border_radius',
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-hourly-schedule-speaker-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_popup_speaker_image_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '.mec-hourly-schedule-speaker-thumbnail',
			]
		);

		$this->add_control(
			'mec_popup_speaker_overlay', //param_name
			[
				'label' 		=> __( 'Overlay  Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'.mec-single-event .lity' => 'background: {{VALUE}}',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-speakers' );
	}

}