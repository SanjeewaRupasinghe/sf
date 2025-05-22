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
class MecShortCodeDesignerlabel extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-label';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Label', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-banner';
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
				'name'     => 'label_typography',
				'label'    => __( 'Typography', 'mec-shortcode-designer' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mec-event-label',
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
					'{{WRAPPER}} .mec-event-label' => 'text-align: {{VALUE}}',
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
					'{{WRAPPER}} .mec-event-label' => 'display: {{VALUE}}',
				],
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
			'label_color',
			[
				'label'     => __( 'Color', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-event-label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'label_color_hover',
			[
				'label'     => __( 'Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-event-label:hover' => 'color: {{VALUE}}',
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
				'default'   => 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-event-label' => 'background: {{VALUE}}',
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
				'default'   => 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-event-label:hover' => 'background: {{VALUE}}',
				],
			]
		);
		// $this->add_control(
		// 	'label_background_canceled',
		// 	[
		// 		'label'     => __( 'Canceled Background', 'mec-shortcode-designer' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'scheme'    => [
		// 			'type'  => Color::get_type(),
		// 			'value' => Color::COLOR_1,
		// 		],
		// 		'default'   => '#de0404',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .mec-event-label.mec-label-canceled' => 'background: {{VALUE}}',
		// 		],
		// 	]
		// );
		// $this->add_control(
		// 	'label_background_canceled_hover',
		// 	[
		// 		'label'     => __( 'Canceled Background Hover', 'mec-shortcode-designer' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'scheme'    => [
		// 			'type'  => Color::get_type(),
		// 			'value' => Color::COLOR_1,
		// 		],
		// 		'default'   => '#000',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .mec-event-label.mec-label-canceled:hover' => 'background: {{VALUE}}',
		// 		],
		// 	]
		// );
		// $this->add_control(
		// 	'label_background_featured',
		// 	[
		// 		'label'     => __( 'Featured Background', 'mec-shortcode-designer' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'scheme'    => [
		// 			'type'  => Color::get_type(),
		// 			'value' => Color::COLOR_1,
		// 		],
		// 		'default'   => '#04de78',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .mec-event-label.mec-label-featured' => 'background: {{VALUE}}',
		// 		],
		// 	]
		// );
		// $this->add_control(
		// 	'label_background_featured_hover',
		// 	[
		// 		'label'     => __( 'Featured Background Hover', 'mec-shortcode-designer' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'scheme'    => [
		// 			'type'  => Color::get_type(),
		// 			'value' => Color::COLOR_1,
		// 		],
		// 		'default'   => '#000',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .mec-event-label.mec-label-featured:hover' => 'background: {{VALUE}}',
		// 		],
		// 	]
		// );

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
					'{{WRAPPER}} .mec-event-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'label_padding',
			[
				'label'      => __( 'Padding', 'mec-shortcode-designer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '2',
					'right'    => '40',
					'bottom'   => '2',
					'left'     => '40',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .mec-event-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-event-label',
			]
		);
		$this->add_control(
			'label_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-event-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-event-label',
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
			$label_id = get_the_terms( $event_id, 'mec_label' );
			if ( !empty($label_id) ){
				$label_id = get_the_terms( $event_id, 'mec_label' )[0]->term_id;
				$label_class = isset( get_the_terms( $event_id, 'mec_label' )[0]->name ) ? get_the_terms( $event_id, 'mec_label' )[0]->name : '';
				if ( $label_class ) {
					?>
					<div class="mec-shortcode-designer">
						<div class="mec-event-label">
							<?php echo $label_class; ?>
						</div>
					</div>
					<?php
				}
			}else{
			?>
				<div class="mec-shortcode-designer">
					<div class="mec-event-label <?php echo esc_attr( $label_class ); ?>">
						<span style="display: inline-block;"><?php echo esc_html__( 'Featured (for example)', 'mec-shortcode-designer' ) ?></span>
					</div>
				</div>
			<?php
			}
		} else {
			if ( get_the_terms( get_the_ID(), 'mec_label' ) ) {
				$label_id = get_the_terms( get_the_ID(), 'mec_label' )[0]->term_id ? get_the_terms( get_the_ID(), 'mec_label' )[0]->term_id : '';
				if ( $label_id ) {
					$label_class = isset(get_the_terms( get_the_ID(), 'mec_label' )[0]->name) ? get_the_terms( get_the_ID(), 'mec_label' )[0]->name : '';
					if ( $label_class ) {
						?>
						<div class="mec-shortcode-designer">
							<div class="mec-event-label">
								<?php echo $label_class; ?>
							</div>
						</div>
						<?php
					}
				}
			}
		}
	}
}
