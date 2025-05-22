<?php
namespace Elementor;
namespace MEC_Single_Builder\Inc\Admin\Widgets;
use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_ZoomEvent extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'event_zoom_event';

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

		return __( 'Single Zoom Event Details', 'mec-single-builder' );

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

		return 'mec-fa-file-video-o';

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
			'mec_zoom_event_type',
			array(
				'label' 	=> __('Zoom Event Type', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'zoom_event_type', //param_name
			[
				'label' 	=> __( 'Select Widget Style', 'mec-single-builder' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'default',
				'options' 	=> [ //value
					'default' 		=> __( 'Default Style', 'mec-single-builder' ),
					'content'  		=> __( 'Under The Content Style', 'mec-single-builder' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_zoom_event_box',
			array(
				'label' 	=> __('Zoom Event Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_zoom_event_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields, {{WRAPPER}} .mec-single-zoom-badge' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields, {{WRAPPER}} .mec-single-zoom-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields, {{WRAPPER}} .mec-single-zoom-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_zoom_event_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-event-data-fields, {{WRAPPER}} .mec-single-zoom-badge',
			]
		);

		$this->add_control(
			'mec_zoom_event_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields, {{WRAPPER}} .mec-single-zoom-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_zoom_event_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-data-fields, {{WRAPPER}} .mec-single-zoom-badge',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_zoom_event_typo',
			array(
				'label' 	=> __( 'Default Style Settings', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' 	=> [ //dependency
					'zoom_event_type' 	=> [
						'default',
					],
				],
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'label' 		=> __( 'Typography', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-single-zoom-badge h3',
			]
		);

		$this->add_control(
			'mec_zoom_event_link',
			[
				'label' 		=> __( 'Link Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_title_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_title_padding', //param_name
			[
				'label' 		=> __('padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_zoom_event_title_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-zoom-badge h3',
			]
		);

		$this->add_control(
			'mec_zoom_event_title_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'mec_zoom_event_icon',
			[
				'label' 		=> __( 'Icon Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge i:before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_icon_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_icon_padding', //param_name
			[
				'label' 		=> __('padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_zoom_event_icon_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-single-zoom-badge i',
			]
		);

		$this->add_control(
			'mec_zoom_event_icon_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-single-zoom-badge i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_icon_size',
			[
				'label' 		=> __( 'Icon Size', 'mec-single-builder' ),
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
					'{{WRAPPER}} .mec-single-zoom-badge i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		'mec_zoom_event_content',
			array(
				'label' 	=> __( 'Under The Content Style Settings', 'mec-single-builder' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' 	=> [ //dependency
					'zoom_event_type' 	=> [
						'content',
					],
				],
			)
		);

		$this->add_responsive_control(
			'mec_zoom_event_content_margin', //param_name
			[
				'label' 		=> __('Items Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-zoom-embed, {{WRAPPER}} .mec-event-zoom-link, {{WRAPPER}} .mec-zoom-password' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_zoom_event_content_padding', //param_name
			[
				'label' 		=> __('Items Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-zoom-embed, {{WRAPPER}} .mec-event-zoom-link, {{WRAPPER}} .mec-zoom-password' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_zoom_event_content_border',
				'label' 		=> __('Items Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-event-zoom-embed, {{WRAPPER}} .mec-event-zoom-link, {{WRAPPER}} .mec-zoom-password',
			]
		);

		$this->add_control(
			'mec_zoom_event_content_shape_radius', //param_name
			[
				'label' 		=> __('Items Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-zoom-embed, {{WRAPPER}} .mec-event-zoom-link, {{WRAPPER}} .mec-zoom-password' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_zoom_event_last_child_border',
				'label' 		=> __('Last Item Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-event-zoom-embed:last-child, {{WRAPPER}} .mec-event-zoom-link:last-child, {{WRAPPER}} .mec-zoom-password:last-child',
			]
		);

		$this->add_control(
			'hr3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'zoom_link_typography',
				'label' 		=> __( 'Link Typography', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-event-zoom-link',
			]
		);

		$this->add_control(
			'zoom_link_color',
			[
				'label' 		=> __( 'Link Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-zoom-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'zoom_link_color_hover',
			[
				'label' 		=> __( 'Link Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-zoom-link:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr4',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'zoom_password_label_typography',
				'label' 		=> __( 'Password Label Typography', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-zoom-password strong',
			]
		);

		$this->add_control(
			'zoom_password_label_color',
			[
				'label' 		=> __( 'Link Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-zoom-password strong' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'zoom_password_value_typography',
				'label' 		=> __( 'Password Value Typography', 'mec-single-builder' ),
				'selector' 		=> '{{WRAPPER}} .mec-zoom-password span',
			]
		);

		$this->add_control(
			'zoom_password_value_color',
			[
				'label' 		=> __( 'Link Hover Color', 'mec-single-builder' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-zoom-password span' => 'color: {{VALUE}}',
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
		global $eventt;
		$settings 		= $this->get_settings_for_display();
		$mainClass      = new \MEC_main();
		$single         = new \MEC_skin_single();

		$event_id = \MEC\SingleBuilder\SingleBuilder::getInstance()->get_event_id();
		$eventt = $single->get_event_mec($event_id);
		$eventt = isset( $eventt[0] ) ? $eventt[0] : false;
        if( !$eventt ){

            return;
        }

		if ( Plugin::$instance->editor->is_edit_mode() ) {

			if ( $eventt->data->meta['mec_zoom_event'] == 'none' ) {
				echo '<div class="mec-content-notification">';
				echo '<p>';
				echo '<span>';
				echo __('Please make sure the last event has appropriate content for this widget.', 'mec-single-builder');
				echo '</span>';
				echo '<a href="https://webnus.net/dox/modern-events-calendar/zoom-integration-addon/" target="_blank">' . __('How to set up Zoom event', 'mec-single-builder') . ' </a>';
				echo '</p>';
				echo '</div>';
			} else {
				if ( $settings['zoom_event_type'] == 'default' ) {
					do_action('mec_single_zoom_badge', $eventt->data );
				} else {
					do_action('mec_single_after_content', $eventt );
				}
			}
		} else {

			if ( $settings['zoom_event_type'] == 'default' ) {
				do_action('mec_single_zoom_badge', $eventt->data );
			} else {
				do_action('mec_single_after_content', $eventt );
			}
		}

	}

}