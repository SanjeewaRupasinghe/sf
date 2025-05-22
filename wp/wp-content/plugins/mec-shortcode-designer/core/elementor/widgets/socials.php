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
class MecShortCodeDesignerSocial extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-social';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Social', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
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
		$this->add_control(
			'icon_size',
			[
				'label'			=> __( 'Icon Size', 'mec-shortcode-designer' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range'			=> [
					'px' => [
						'min' => 0,
						'max' => 1920,
						'step' => 1,
					],
					'%'	=> [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mec-event-share i, {{WRAPPER}} .mec-event-sharing i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'label_align',
			[
				'label'     => __( 'Alignment', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'mec-shortcode-designer' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mec-shortcode-designer' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'mec-shortcode-designer' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .mec-shortcode-designer' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'display',
			[
				'label'     => __( 'Display', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'inline-block',
				'options'   => [
					'inherit'      => __( 'inherit', 'mec-shortcode-designer' ),
					'inline'       => __( 'inline', 'mec-shortcode-designer' ),
					'inline-block' => __( 'inline-block', 'mec-shortcode-designer' ),
					'block'        => __( 'block', 'mec-shortcode-designer' ),
					'none'         => __( 'none', 'mec-shortcode-designer' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-event-sharing-wrap' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'toggle_icon',
			[
				'label'			=> __( 'Toggle Icon', 'mec-shortcode-designer' ),
				'type'			=> Controls_Manager::SWITCHER,
				'label_on'		=> __( 'True', 'mec-shortcode-designer' ),
				'label_off'		=> __( 'False', 'mec-shortcode-designer' ),
				'return_value'	=> 'yes',
				'default'		=> 'yes',
			]
		);
		$this->end_controls_section();
		// color
		$this->start_controls_section(
			'label_color_style',
			[
				'label' => __( 'Colors', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icons_color',
			[
				'label'     => __( 'Icon Color', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-event-share i, {{WRAPPER}} .mec-event-sharing i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icons_hover_color',
			[
				'label'     => __( 'Icon Hover Color', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#40d9f1',
				'selectors' => [
					'{{WRAPPER}} .mec-event-share:hover i, {{WRAPPER}} .mec-event-sharing li:hover i' => 'color: {{VALUE}}',
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
			'social_box',
			[
				'label'     => __( 'Social Box', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mec-event-sharing-wrap>li.mec-event-share' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'social_box_hover',
			[
				'label'     => __( 'Social Box Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#40d9f1',
				'selectors' => [
					'{{WRAPPER}} .mec-event-sharing-wrap:hover>li.mec-event-share' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// Spacing
		$this->start_controls_section(
			'label_spacing_style',
			[
				'label' => __( 'Spacing', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_margin',
			[
				'label'      => __( 'Margin', 'mec-shortcode-designer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .mec-event-sharing-wrap>li.mec-event-share' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'label_padding',
			[
				'label'      => __( 'Padding', 'mec-shortcode-designer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .mec-event-sharing-wrap>li.mec-event-share' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-event-sharing-wrap>li:first-child',
				'default'  => [
					'border_border' => 'solid',
					'top'           => '1',
					'right'         => '1',
					'bottom'        => '1',
					'left'          => '1',
					'isLinked'      => true,
				],
			]
		);
		$this->add_control(
			'border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-event-sharing-wrap>li:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-event-sharing-wrap>li:first-child',
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
		$settings = $this->get_settings();
		if ( get_post_type() == 'mec_designer' ) {
			$event_id = get_posts( 'post_type=mec-events&numberposts=1' )[0]->ID;
			$mec_main   = new \MEC_main();
			$mec_render = new \MEC_render();
			$mec_settings = $mec_main->get_settings();
			$event = new stdClass();
			$event->ID	= $event_id;
			$event->data	= $mec_render->data( $event_id );
			if( $mec_settings['social_network_status'] != '0' ) {
			?>
				<div class="mec-shortcode-designer">
					<?php if ($settings['toggle_icon'] == 'yes') : ?>
					<ul class="mec-event-sharing-wrap">
						<li class="mec-event-share">
							<a href="#" class="mec-event-share-icon">
								<i class="mec-sl-share"></i>
							</a>
						</li>
						<li>
							<ul class="mec-event-sharing">
								<?php echo $mec_main->module('links.list', array('event'=>$event)); ?>
							</ul>
						</li>
					</ul>
					<?php else : ?>
						<ul class="mec-event-sharing"><?php echo $mec_main->module('links.list', array('event'=>$event)); ?></ul>
					<?php endif; ?>
				</div>
			<?php
			}
		} else {
			$mec_main   = new \MEC_main();
			$mec_render = new \MEC_render();
			$mec_settings = $mec_main->get_settings();
			$event = new stdClass();
			$event->ID	= get_the_ID();
			$event->data	= $mec_render->data( get_the_ID() );
			if( $mec_settings['social_network_status'] != '0' ) {
			?>
				<div class="mec-shortcode-designer">
					<?php if ($settings['toggle_icon'] == 'yes') : ?>
					<ul class="mec-event-sharing-wrap">
						<li class="mec-event-share">
							<a href="#" class="mec-event-share-icon">
								<i class="mec-sl-share"></i>
							</a>
						</li>
						<li>
							<ul class="mec-event-sharing">
								<?php echo $mec_main->module('links.list', array('event'=>$event)); ?>
							</ul>
						</li>
					</ul>
					<?php else : ?>
						<ul class="mec-event-sharing"><?php echo $mec_main->module('links.list', array('event'=>$event)); ?></ul>
					<?php endif; ?>
				</div>
			<?php
			}
		}
	}
}
