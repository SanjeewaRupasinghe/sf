<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

class ESB_GoogleMap extends \Elementor\Widget_Base
{

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_google_map';
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

		return __('Single Event Map', 'mec-single-builder');
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
	protected function _register_controls()
	{

		$this->start_controls_section(
		'mec_map_box',
			array(
				'label' 	=> __( 'Google Map Box', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_map_box_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_map_box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_map_box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_map_box_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-events-meta-group',
			]
		);

		$this->add_control(
			'mec_map_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_map_box_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-events-meta-group',
				]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} iframe,{{WRAPPER}} .gm-style',
			]
		);

		$this->add_control(
			'transition',
			[
				'label'     => __('Transition', 'mec-single-builder'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 10,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gm-style' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} iframe:hover,{{WRAPPER}} .gm-style:hover',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_direction_btn_typography',
			array(
				'label' 	=> __( 'Direction Button', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_direction_btn_typography_title',
				'label' 	=> __( 'Button Typography', 'mec-single-builder' ),
				'selector' 	=> '{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]',
			]
		);

		$this->add_control(
			'mec_direction_btn_typography_color',
			[
				'label' 		=> __( 'Text Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_direction_btn_typography_color_hover',
			[
				'label' 		=> __( 'Text Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_direction_btn_typography_padding', //param_name
			[
				'label' 		=> __( 'Button Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_direction_btn_typography_margin', //param_name
			[
				'label' 		=> __( 'Button Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'mec_direction_btn_box_width',
            [
                'label' 		=> __( 'Button Width', 'mec-single-builder' ),
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
                    '{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mec_direction_btn_box_height',
            [
                'label' 		=> __( 'Button Height', 'mec-single-builder' ),
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
                    '{{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'mec_direction_btn_typography_bgcolor',
			[
				'label' 		=> __( 'Button Background Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mec_direction_btn_typography_bgcolor_hover',
			[
				'label' 		=> __( 'Button Hover Background Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]:hover' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_direction_btn_typo_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]',
			]
		);

		$this->add_control(
			'mec_direction_btn_typo_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_direction_btn_typo_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-map-get-direction-btn-cnt input[type="submit"]',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-googlemap' );
	}
}
