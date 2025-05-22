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
class MecShortCodeDesignerNormalLabel extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-normallabel';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Normal Label(s)', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-tags';
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
				'selector'	=> '{{WRAPPER}} .mec-label-normal',
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
					'{{WRAPPER}} .mec-labels-normal' => 'text-align: {{VALUE}}; display: block;',
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
					'{{WRAPPER}} .mec-label-normal' => 'display: {{VALUE}}',
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
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-label-normal' => 'color: {{VALUE}}',
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
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-label-normal:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .mec-label-normal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .mec-label-normal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'border',
				'label'		=> __( 'Border', 'mec-shortcode-designer' ),
				'selector'	=> '{{WRAPPER}} .mec-label-normal',
			]
		);
		$this->add_control(
			'border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-label-normal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-label-normal',
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

		if ( get_post_type() == 'mec_designer' ) {
            $base           = new MEC_main();
			$event_id       = get_posts( 'post_type=mec-events&numberposts=1' );
		} else {

            $event_id = get_the_ID();
		}

		$event_base     = $single_event->get_event_mec($event_id);
		$event_base     = $event_base[0];
		$labels = isset($event_base->data->labels) && is_array($event_base->data->labels) ? $event_base->data->labels : [];
		$mec_items      = count($labels);
		$mec_i          = 0;

		echo '<span class="mec-labels-normal">';
			foreach ($labels as $labels => $label) :
				$seperator = (++$mec_i === $mec_items) ? '' : '';
				if ( $label["style"] == '' ) {
						echo '<span data-style="Normal" class="mec-label-normal" style="background:' . $label['color'] . '">' . $label["name"] . $seperator . '</span>';
				}
			endforeach;
		echo '</span>';
	}
}
