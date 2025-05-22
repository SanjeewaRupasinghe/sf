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
class MecShortCodeDesignerCost extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-cost';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Cost', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-usd';
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
				'name'     => 'address_typography',
				'label'    => __( 'Typography', 'mec-shortcode-designer' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mec-cost',
			]
		);
		$this->add_control(
			'address_align',
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
					'{{WRAPPER}} .mec-cost' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'display',
			[
				'label'     => __( 'Display', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'block',
				'options'   => [
					'inherit'      => __( 'inherit', 'mec-shortcode-designer' ),
					'inline'       => __( 'inline', 'mec-shortcode-designer' ),
					'inline-block' => __( 'inline-block', 'mec-shortcode-designer' ),
					'block'        => __( 'block', 'mec-shortcode-designer' ),
					'none'         => __( 'none', 'mec-shortcode-designer' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-cost' => 'display: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// color
		$this->start_controls_section(
			'address_color_style',
			[
				'label' => __( 'Colors', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'address_color',
			[
				'label'     => __( 'Color', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-cost' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'address_color_hover',
			[
				'label'     => __( 'Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#40d9f1',
				'selectors' => [
					'{{WRAPPER}} .mec-cost:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// background
		$this->start_controls_section(
			'address_background_style',
			[
				'label' => __( 'Background', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'address_background',
			[
				'label'     => __( 'Background', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-cost' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'address_background_hover',
			[
				'label'     => __( 'Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-cost:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// Spacing
		$this->start_controls_section(
			'address_spacing_style',
			[
				'label' => __( 'Spacing', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'address_margin',
			[
				'label'      => __( 'Margin', 'mec-shortcode-designer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .mec-cost' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'address_padding',
			[
				'label'      => __( 'Padding', 'mec-shortcode-designer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .mec-cost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-cost',
			]
		);
		$this->add_control(
			'border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-cost' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-cost',
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
        $single         = new \MEC_skin_single();

		if ( get_post_type() == 'mec_designer' ) {
			$latest_post = get_posts('post_type=mec-events&numberposts=1');
			$eventt = $single->get_event_mec($latest_post[0]->ID);
			$eventt = $eventt[0];

            if (isset($eventt->data->meta['mec_cost']) and $eventt->data->meta['mec_cost'] != '') {
                ?>
                <div class="mec-cost"><?php echo (is_numeric($eventt->data->meta['mec_cost']) ? $eventt->data->meta['mec_cost'] : $eventt->data->meta['mec_cost']); ?></div>
                <?php
            } else {
				?>
				<div class="mec-cost"><?php echo esc_html( '59.00 (this is example)' ); ?></div>
				<?php
			}

		} else {


            if ( isset($_GET['preview_id']) and !empty($_GET['preview_id'])) {
                $latest_post = get_posts('post_type=mec-events&numberposts=1');
                $e_id = $latest_post[0]->ID;
            } else {
                $e_id = get_the_ID();
            }
            $eventt = $single->get_event_mec($e_id);
            $eventt = $eventt[0];
            // Event Cost
            if (isset($eventt->data->meta['mec_cost']) and $eventt->data->meta['mec_cost'] != '') {
                ?>
                <div class="mec-cost"><?php echo (is_numeric($eventt->data->meta['mec_cost']) ? $eventt->data->meta['mec_cost'] : $eventt->data->meta['mec_cost']); ?></div>
                <?php
            }


		}
	}
}
