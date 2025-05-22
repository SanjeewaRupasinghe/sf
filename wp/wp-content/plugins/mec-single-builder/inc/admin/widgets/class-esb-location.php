<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Location extends \Elementor\Widget_Base
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

		return 'event_location';
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

		return __('Single Event Locations', 'mec-single-builder');
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

		return 'eicon-google-maps';
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
			'mec_location_typography',
			array(
				'label' 	=> __('Location', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_location_typography_title',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-location .mec-location',
			]
		);

		$this->add_control(
			'mec_location_typography_color',
			[
				'label' 		=> __('Title Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location .mec-location' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_typography_padding', //param_name
			[
				'label' 		=> __('Title Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location .mec-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_typography_icon',
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
					'{{WRAPPER}} .mec-single-event-location i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_location_typography_icon_color',
			[
				'label' 		=> __('Icon Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location i:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_location_label_typography_title',
				'label' 	=> __('Label Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-location dd, {{WRAPPER}} .mec-single-event-location dd h6',
			]
		);

		$this->add_control(
			'mec_location_label_typography_color',
			[
				'label' 		=> __('Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location dd,
					{{WRAPPER}} .mec-single-event-location dd h6' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_label_typography_padding', //param_name
			[
				'label' 		=> __('Label Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location dd, {{WRAPPER}} .mec-single-event-location dd h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_location_address_typography_title',
				'label' 	=> __('Label Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-location dd .mec-events-address',
			]
		);

		$this->add_control(
			'mec_location_address_typography_color',
			[
				'label' 		=> __('Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location dd .mec-events-address' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_address_typography_padding', //param_name
			[
				'label' 		=> __('Label Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location dd .mec-events-address' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_image_width',
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
					'{{WRAPPER}} .mec-single-event-location  .mec-img-location' => 'width: {{SIZE}}{{UNIT}}; display: block; height: auto;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_image_height',
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
					'{{WRAPPER}} .mec-single-event-location  .mec-img-location' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
				],
			]
		);

		$this->add_control(
			'mec_location_image_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location  .mec-img-location' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_image_box_padding', //param_name
			[
				'label' 		=> __('Image Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location  .mec-img-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_image_box_margin', //param_name
			[
				'label' 		=> __('Image Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location  .mec-img-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_location_image_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-event-location  .mec-img-location',
			]
		);

		$this->add_control(
			'mec_location_image_box_border_radius',
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location  .mec-img-location' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_location_image_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-location  .mec-img-location',
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_location_link_typography',
                'label' 	=> __( 'Link Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-location dd a',
            ]
        );

        $this->add_control(
            'mec_location_link_typography_color',
            [
                'label' 		=> __( 'Link Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-location dd a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'mec_location_link_typography_color_hover',
            [
                'label' 		=> __( 'Link HoverColor', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-location dd a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_location_desc_typography',
                'label' 	=> __( 'Description Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-location .mec-location-description p',
            ]
        );

        $this->add_control(
            'mec_location_desc_typography_color',
            [
                'label' 		=> __( 'Description Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-location .mec-location-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_location_box',
			array(
				'label' 	=> __('Location Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_location_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .mec-single-event-location' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_location_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_location_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-event-location',
			]
		);

		$this->add_control(
			'mec_location_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_location_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-location',
			]
		);

		$this->add_responsive_control(
			'mec_widget_box_label_typography_padding', //param_name
			[
				'label' 		=> __('Labels Wrapper Spacing', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'separator' 	=> 'before',
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-location dd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_other_location_typography',
			array(
				'label' 	=> __('Other Location', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_other_location_typography_title',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location .mec-location',
			]
		);

		$this->add_control(
			'mec_other_location_typography_color',
			[
				'label' 		=> __('Title Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location .mec-location' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_typography_padding', //param_name
			[
				'label' 		=> __('Title Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location .mec-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_typography_icon',
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
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_other_location_typography_icon_color',
			[
				'label' 		=> __('Icon Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location i:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_other_location_label_typography_title',
				'label' 	=> __('Label Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location dd',
			]
		);

		$this->add_control(
			'mec_other_location_label_typography_color',
			[
				'label' 		=> __('Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location dd' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_label_typography_padding', //param_name
			[
				'label' 		=> __('Label Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location dd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_other_location_address_typography_title',
				'label' 	=> __('Label Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location dd .mec-events-address',
			]
		);

		$this->add_control(
			'mec_other_location_address_typography_color',
			[
				'label' 		=> __('Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location dd .mec-events-address' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_address_typography_padding', //param_name
			[
				'label' 		=> __('Label Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location dd .mec-events-address' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_image_width',
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
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location' => 'width: {{SIZE}}{{UNIT}}; display: block; height: auto;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_image_height',
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
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
				],
			]
		);

		$this->add_control(
			'mec_other_location_image_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_image_box_padding', //param_name
			[
				'label' 		=> __('Image Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_image_box_margin', //param_name
			[
				'label' 		=> __('Image Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_other_location_image_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location',
			]
		);

		$this->add_control(
			'mec_other_location_image_box_border_radius',
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_other_location_image_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location  .mec-img-location',
			]
		);


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_other_location_link_typography',
                'label' 	=> __( 'Link Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-location-description a',
            ]
        );

        $this->add_control(
            'mec_other_location_link_typography_color',
            [
                'label' 		=> __( 'Link Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-locations .mec-location-description a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'mec_other_location_link_typography_color_hover',
            [
                'label' 		=> __( 'Link HoverColor', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-locations .mec-location-description a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_other_location_desc_typography',
                'label' 	=> __( 'Description Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-location-description p',
            ]
        );

        $this->add_control(
            'mec_other_location_desc_typography_color',
            [
                'label' 		=> __( 'Description Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-locations .mec-location-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_other_location_box',
			array(
				'label' 	=> __('Other Location Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_other_location_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_widget_other_box_align',
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
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_other_location_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_other_location_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location',
			]
		);

		$this->add_control(
			'mec_other_location_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_other_location_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations .mec-single-event-location',
			]
		);

		$this->add_responsive_control(
			'mec_widget_other_box_label_typography_padding', //param_name
			[
				'label' 		=> __('Labels Wrapper Spacing', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'separator' 	=> 'before',
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations dd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_additional_location_box',
			array(
				'label' 	=> __('Additional Location Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_additional_location_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_additional_location_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_additional_location_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_additional_location_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-event-additional-locations',
			]
		);

		$this->add_control(
			'mec_additional_location_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-event-additional-locations' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_additional_location_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-locations',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-locations' );
	}
}
