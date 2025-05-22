<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Tags extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_tags';

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

		return __( 'Single Event Tags', 'mec-single-builder' );

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

		return 'eicon-meta-data';

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
		'mec_tags_box',
			array(
				'label' 	=> __( 'Tags Box', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_tags_box_bg_color', //param_name
			[
				'label' 		=> __( 'Background Color', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-tags' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_tags_box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-tags' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_tags_box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-tags' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_tags_box_border',
				'label' 		=> __( 'Border', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-events-meta-group-tags',
			]
		);

		$this->add_control(
			'mec_tags_box_shape_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-events-meta-group-tags' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_tags_box_box_shadow',
					'label' 	=> __( 'Box Shadow', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-events-meta-group-tags',
				]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_tags_typo',
				array(
					'label' 	=> __( 'Tags Typography', 'mec-single-builder' ),
					'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control(
				'mec_tags_title',
				[
					'label' 		=> __( 'Title Color', 'mec-single-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'mec_title_typography',
					'label' 		=> __( 'Title Typography', 'mec-single-builder' ),
					'selector' 		=> '{{WRAPPER}} .mec-events-meta-group-tags',
				]
			);

			$this->add_control(
				'mec_tags_link',
				[
					'label' 		=> __( 'Link Color', 'mec-single-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'mec_tags_link_hover',
				[
					'label' 		=> __( 'Hover Link Color', 'mec-single-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'mec_tags_typography',
					'label' 		=> __( 'Tags Typography', 'mec-single-builder' ),
					'selector' 		=> '{{WRAPPER}} .mec-events-meta-group-tags a',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'mec_tags_link_border',
					'label' 		=> __( 'Tags Border', 'mec-single-builder' ),
					'selector' 		=> '{{WRAPPER}} .mec-events-meta-group-tags a',
				]
			);

			$this->add_control(
				'mec_tags_link_shape_radius', //param_name
				[
					'label' 		=> __( 'Tags Border Radius', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'mec_tags_link_bg_color', //param_name
				[
					'label' 		=> __( 'Tags Background Color ', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::COLOR, //type
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'mec_tags_link_bg_color_hover', //param_name
				[
					'label' 		=> __( 'Tags Hover Background Color ', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::COLOR, //type
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a:hover' => 'background: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'mec_tags_link_padding', //param_name
				[
					'label' 		=> __( 'Tags Padding', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'mec_tags_link_margin', //param_name
				[
					'label' 		=> __( 'Tags Margin', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-meta-group-tags a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-tags' );
    }

}