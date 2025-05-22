<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor addon shortcode class
 *
 * @author Webnus <info@webnus.net>
 */
class MecShortCodeDesignerCancellationReason extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-cancellation-reason';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Cancellation Reason', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-close-circle';
	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget category.
	 */
	public function get_categories() {
		return [ 'mec_shortcode_designer' ];
	}

	/**
	 * Register MEC widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// typography
		$this->start_controls_section(
			'styling_section',
			[
				'label' => __( 'Typography', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'title_typography',
				'label'		=> __( 'Typography', 'mec-shortcode-designer' ),
				'scheme'	=> Typography::TYPOGRAPHY_1,
				'selector'	=> '{{WRAPPER}} .mec-cancellation-reason span',
			]
		);
		$this->add_control(
			'title_align',
			[
				'label'		=> __( 'Alignment', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::CHOOSE,
				'options'	=> [
					'left' => [
						'title' => __( 'Left', 'mec-shortcode-designer' ),
						'icon'	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mec-shortcode-designer' ),
						'icon'	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mec-shortcode-designer' ),
						'icon'	=> 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason' => 'text-align: {{VALUE}}; display: block;',
				],
			]
		);
		$this->add_control(
			'display',
			[
				'label'		=> __( 'Display', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::SELECT,
				'default' 	=> 'inline',
				'options' 	=> [
					'inherit'		=> __( 'inherit', 'mec-shortcode-designer' ),
					'inline'		=> __( 'inline', 'mec-shortcode-designer' ),
					'inline-block'	=> __( 'inline-block', 'mec-shortcode-designer' ),
					'block'			=> __( 'block', 'mec-shortcode-designer' ),
					'none'			=> __( 'none', 'mec-shortcode-designer' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason span' => 'display: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// color
		$this->start_controls_section(
			'title_color_style',
			[
				'label' => __( 'Colors', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'		=> __( 'Color', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'		=> __( 'Hover', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#fff',
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason span:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
		// background
		$this->start_controls_section(
			'label_background_style',
			[
				'label' => __( 'Background', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_background',
			[
				'label'     => __( 'Background', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#eb3450',
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason span' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'label_background_hover',
			[
				'label'     => __( 'Background Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#eb3450',
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason span:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// Spacing
		$this->start_controls_section(
			'title_spacing_style',
			[
				'label' => __( 'Spacing', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label'			=> __( 'Margin', 'mec-shortcode-designer' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'em' ],
				'default'		=> [
					'top'		=> '0',
					'right'		=> '0',
					'bottom'	=> '0',
					'left'		=> '0',
					'isLinked' => true,
				],
				'selectors'		=> [
					'{{WRAPPER}} .mec-cancellation-reason span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label'			=> __( 'Padding', 'mec-shortcode-designer' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'em' ],
				'selectors'		=> [
					'{{WRAPPER}} .mec-cancellation-reason span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'border',
				'label'		=> __( 'Border', 'mec-shortcode-designer' ),
				'selector'	=> '{{WRAPPER}} .mec-cancellation-reason span',
			]
		);
		$this->add_control(
			'border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-cancellation-reason span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-cancellation-reason span',
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render MEC widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        global $event_base;
        $settings           = $this->get_settings();
		$single_event       = new \MEC_skin_single();
        $base           = new MEC_main();

		if ( get_post_type() == 'mec_designer' ) {
			$event_id       = get_posts( 'post_type=mec-events&numberposts=1' );
			$event_base     = $single_event->get_event_mec($event_id[0]->ID);
            $event_base     = $event_base[0];
            $show_reason    = $base->display_cancellation_reason($event_base, true);

            if (isset($show_reason ) && $show_reason != '') {
                echo $show_reason;
            } else {
                echo '<span>' . __( 'Reason for Cancellation (for example)', 'mec-shortcode-designer' ) . '</span>';
            }

		} else {
            $event_base     = $single_event->get_event_mec(get_the_ID());
            $event_base     = $event_base[0];
            $show_reason    = $base->display_cancellation_reason($event_base, true);

            if (isset($show_reason ) && $show_reason != '') {
                echo $show_reason;
            }
		}

	}
}