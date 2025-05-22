<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Post_CSS_File;
use Elementor\Core\Files\CSS\Post;

class ESB_Content extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_content';

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

		return __( 'Single Event Content', 'mec-single-builder' );

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

		return 'mec-fa-align-justify';

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
			'mec_content_typo',
				array(
					'label' 	=> __( 'Content Typography', 'mec-single-builder' ),
					'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'label' 	=> __( 'Typography', 'mec-single-builder' ),
					'selector' 	=> '{{WRAPPER}} .mec-events-content, {{WRAPPER}} .mec-events-content p',
				]
			);

			$this->add_control(
				'mec_content',
				[
					'label' 		=> __( 'Title Color', 'mec-single-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-content, {{WRAPPER}} .mec-events-content p' => 'color: {{VALUE}} !important;',
					],
				]
			);

			$this->add_responsive_control(
				'mec_content_padding', //param_name
				[
					'label' 		=> __( 'Padding', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->add_responsive_control(
				'mec_content_margin', //param_name
				[
					'label' 		=> __( 'Margin', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'mec_content_border',
					'label' 		=> __( 'Border', 'mec-single-builder' ),
					'selector' 		=> '{{WRAPPER}} .mec-events-content',
				]
			);

			$this->add_control(
				'mec_title_shape_radius', //param_name
				[
					'label' 		=> __( 'Border Radius', 'mec-single-builder' ), //heading
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .mec-events-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'mec_title_box_shadow',
					'label' 	=> __('Box Shadow', 'mec-single-builder'),
					'selector' 	=> '{{WRAPPER}} .mec-events-content',
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

		$event_id = \MEC\SingleBuilder\SingleBuilder::getInstance()->get_event_id();

		if (class_exists('\Elementor\Core\Files\CSS\Post')) {
			$css_file = new Post($event_id);
		} elseif (class_exists('\Elementor\Post_CSS_File')) {
			$css_file = new Post_CSS_File($event_id);
		}
		$css_file->enqueue();

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'content' );
    }

}