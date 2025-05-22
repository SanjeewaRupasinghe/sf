<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Organizer extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_organizer';

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

		return __( 'Single Event Organizers', 'mec-single-builder' );

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

		return 'eicon-person';

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
        'mec_organizer_typography',
            array(
                'label' 	=> __( 'Organizer Typography', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_organizer_typography_title',
                'label' 	=> __( 'Title Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-organizer .mec-events-single-section-title',
            ]
        );

        $this->add_control(
            'mec_organizer_typography_title_color',
            [
                'label' 		=> __( 'Title Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer .mec-events-single-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_typography_title_padding', //param_name
            [
                'label' 		=> __( 'Title Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer .mec-events-single-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_typography_title_margin', //param_name
            [
                'label' 		=> __( 'Title Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer .mec-events-single-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_typography_icons_size',
            [
                'label' 		=> __( 'Icons Size', 'mec-single-builder' ),
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
                    'size' => 20,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mec_organizer_typography_icon_color',
            [
                'label' 		=> __( 'Icon Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd i:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_icon_margin', //param_name
            [
                'label' 		=> __( 'Icon Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_organizer_bold_title_typography',
                'label' 	=> __( 'Label Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-organizer dd h6',
            ]
        );

        $this->add_control(
            'mec_organizer_bold_title_typography_color',
            [
                'label' 		=> __( 'Label Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_organizer_link_typography',
                'label' 	=> __( 'Link Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-organizer dd a',
            ]
        );

        $this->add_control(
            'mec_organizer_link_typography_color',
            [
                'label' 		=> __( 'Link Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'mec_organizer_link_typography_color_hover',
            [
                'label' 		=> __( 'Link HoverColor', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_organizer_desc_typography',
                'label' 	=> __( 'Description Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-organizer dd p',
            ]
        );

        $this->add_control(
            'mec_organizer_desc_typography_color',
            [
                'label' 		=> __( 'Description Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer dd p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
        'mec_organizer_image_box',
            array(
                'label' 	=> __( 'Organizer Image Box', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'mec_organizer_image_width',
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
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer' => 'width: {{SIZE}}{{UNIT}}; display: block; height: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_image_height',
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
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer' => 'height: {{SIZE}}{{UNIT}};  width: auto;',
                ],
            ]
        );

        $this->add_control(
            'mec_organizer_image_box_bg_color', //param_name
            [
                'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::COLOR, //type
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_image_box_padding', //param_name
            [
                'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_image_box_margin', //param_name
            [
                'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'mec_organizer_image_box_border',
                'label' 		=> __( 'Border', 'mec-single-builder' ),
                'selector' 		=> '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer',
            ]
        );

        $this->add_control(
            'mec_organizer_image_box_border_radius',
            [
                'label' 		=> __( 'Border Radius', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name' 		=> 'mec_organizer_image_box_shadow',
                    'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
                    'selector' 	=> '{{WRAPPER}} .mec-single-event-organizer  .mec-img-organizer',
                ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
        'mec_organizer_box',
            array(
                'label' 	=> __( 'Organizer Box', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'mec_organizer_box_bg_color', //param_name
            [
                'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::COLOR, //type
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .mec-single-event-organizer' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'mec_organizer_box_padding', //param_name
            [
                'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_organizer_box_margin', //param_name
            [
                'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'mec_organizer_box_border',
                'label' 		=> __( 'Border', 'mec-single-builder' ),
                'selector' 		=> '{{WRAPPER}} .mec-single-event-organizer',
            ]
        );

        $this->add_control(
            'mec_organizer_box_shape_radius', //param_name
            [
                'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-organizer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name' 		=> 'mec_organizer_box_box_shadow',
                    'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
                    'selector' 	=> '{{WRAPPER}} .mec-single-event-organizer',
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
					'{{WRAPPER}} .mec-single-event-organizer dd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
        'mec_other_organizer_typography',
            array(
                'label' 	=> __( 'Other Organizer Typography', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'mec_other_organizer_typography_icons_size',
            [
                'label' 		=> __( 'Icons Size', 'mec-single-builder' ),
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
                    'size' => 20,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mec_other_organizer_typography_icon_color',
            [
                'label' 		=> __( 'Icon Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd i:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_other_organizer_icon_margin', //param_name
            [
                'label' 		=> __( 'Icon Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_other_organizer_bold_title_typography',
                'label' 	=> __( 'Label Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers dd h6',
            ]
        );

        $this->add_control(
            'mec_other_organizer_bold_title_typography_color',
            [
                'label' 		=> __( 'Label Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_other_organizer_link_typography',
                'label' 	=> __( 'Link Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers dd a',
            ]
        );

        $this->add_control(
            'mec_other_organizer_link_typography_color',
            [
                'label' 		=> __( 'Link Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'mec_other_organizer_link_typography_color_hover',
            [
                'label' 		=> __( 'Link HoverColor', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_other_organizer_desc_typography',
                'label' 	=> __( 'Description Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers dd p',
            ]
        );

        $this->add_control(
            'mec_other_organizer_desc_typography_color',
            [
                'label' 		=> __( 'Description Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers dd p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
        'mec_other_organizer_image_box',
            array(
                'label' 	=> __( 'Other Organizer Image Box', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'mec_other_organizer_image_width',
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
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer' => 'width: {{SIZE}}{{UNIT}}; display: block; height: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_other_organizer_image_height',
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
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
                ],
            ]
        );

        $this->add_control(
            'mec_other_organizer_image_box_bg_color', //param_name
            [
                'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::COLOR, //type
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_other_organizer_image_box_padding', //param_name
            [
                'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_other_organizer_image_box_margin', //param_name
            [
                'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'mec_other_organizer_image_box_border',
                'label' 		=> __( 'Border', 'mec-single-builder' ),
                'selector' 		=> '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer',
            ]
        );

        $this->add_control(
            'mec_other_organizer_image_box_border_radius',
            [
                'label' 		=> __( 'Border Radius', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name' 		=> 'mec_other_organizer_image_box_shadow',
                    'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
                    'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers  .mec-img-organizer',
                ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
        'mec_other_organizer_box',
            array(
                'label' 	=> __( 'Other Organizer Box', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'mec_other_organizer_box_bg_color', //param_name
            [
                'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::COLOR, //type
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers .mec-single-event-additional-organizer' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .mec-single-event-additional-organizers' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'mec_other_organizer_box_padding', //param_name
            [
                'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers .mec-single-event-additional-organizer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_other_organizer_box_margin', //param_name
            [
                'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers .mec-single-event-additional-organizer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'mec_other_organizer_box_border',
                'label' 		=> __( 'Border', 'mec-single-builder' ),
                'selector' 		=> '{{WRAPPER}} .mec-single-event-additional-organizers .mec-single-event-additional-organizer',
            ]
        );

        $this->add_control(
            'mec_other_organizer_box_shape_radius', //param_name
            [
                'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers .mec-single-event-additional-organizer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name' 		=> 'mec_other_organizer_box_box_shadow',
                    'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
                    'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers .mec-single-event-additional-organizer',
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
					'{{WRAPPER}} .mec-single-event-additional-organizers dd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
        'mec_additional_organizer_box',
            array(
                'label' 	=> __( 'Additional Organizer Box', 'mec-single-builder' ),
                'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 		=> 'mec_additional_organizer_typography_title',
                'label' 	=> __( 'Title Typography', 'mec-single-builder' ),
                'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers .mec-events-single-section-title',
            ]
        );

        $this->add_control(
            'mec_other_organizer_typography_title_color',
            [
                'label' 		=> __( 'Title Color', 'mec-single-builder' ),
                'type' 			=> \Elementor\Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers .mec-events-single-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_other_organizer_typography_title_padding', //param_name
            [
                'label' 		=> __( 'Title Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers .mec-events-single-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mec_additional_organizer_box_bg_color', //param_name
            [
                'label' 		=> __( 'Additional Background Color', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::COLOR, //type
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_additional_organizer_box_padding', //param_name
            [
                'label' 		=> __( 'Additional Padding', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_additional_organizer_box_margin', //param_name
            [
                'label' 		=> __( 'Additional Margin', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' 			=> 'mec_additional_organizer_box_border',
                'label' 		=> __( 'Additional Border', 'mec-single-builder' ),
                'selector' 		=> '{{WRAPPER}} .mec-single-event-additional-organizers',
            ]
        );

        $this->add_control(
            'mec_additional_organizer_box_shape_radius', //param_name
            [
                'label' 		=> __( 'Additional Border Radius', 'mec-single-builder' ), //heading
                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
                'size_units' 	=> [ 'px', 'em', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-single-event-additional-organizers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
                [
                    'name' 		=> 'mec_additional_organizer_box_box_shadow',
                    'label' 	=> __( 'Additional Box Shadow', 'mec-single-builder' ),
                    'selector' 	=> '{{WRAPPER}} .mec-single-event-additional-organizers',
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

        echo '<style>
            .single-mec_esb.mec-single-event .mec-organizer-tel a {
                display: block;
                padding-left: 41px;
                color: #8d8d8d;
            }
        </style>';
        echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-organizers' );
	}

}