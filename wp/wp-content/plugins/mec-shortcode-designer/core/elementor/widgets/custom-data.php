<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use MEC_ShortcodeDesigner\Core\EventsDateTimes;
use MEC\Events\EventsQuery;
use MEC\Events\Event;
use MEC\Settings\Settings;

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor addon shortcode class
 *
 * @author Webnus <info@webnus.net>
 */
class MecShortCodeDesignerCustomData extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-custom-data';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Custom Fields', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-excerpt';
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

		$base_selector = '{{WRAPPER}} .mec-shortcode-designer .mec-event-custom-fields';
		$tooltip_box_selector = $base_selector . ' .mec-data-fields-tooltip';
		$content_base_selector = $tooltip_box_selector . ' .mec-data-fields-tooltip-box .mec-event-data-field-items';
		$parts = [
			'.mec-event-data-field-name' => [
				'title' => __('label','mec-shortcode-designer'),
				'key' => 'label',

			],
			'.mec-event-data-field-value' => [
				'title' => __('value','mec-shortcode-designer'),
				'key' => 'value',

			]
		];
		// typography
		$this->start_controls_section(
			'styling_section',
			[
				'label' => __( 'Typography', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					$base_selector => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_align_data',
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
					$content_base_selector => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'title_typography',
				'label'		=> __( 'Typography', 'mec-shortcode-designer' ),
				'scheme'	=> Typography::TYPOGRAPHY_1,
				'selector'	=> $base_selector,
			]
		);

		foreach($parts as $p_selector => $p_args){

			$title = $p_args['title'];
			$key = $p_args['key'];
			$p_selector = $content_base_selector . ' li '. $p_selector;

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'title_typography_'.$key,
					'label'		=> __( 'Typography', 'mec-shortcode-designer' ). ' ' . $title ,
					'scheme'	=> Typography::TYPOGRAPHY_1,
					'selector'	=> $p_selector,
				]
			);
		}

		$this->end_controls_section();


		// color
		$this->start_controls_section(
			'title_color_style',
			[
				'label' => __( 'Colors', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		foreach($parts as $p_selector => $p_args){

			$title = $p_args['title'];
			$key = $p_args['key'];
			$p_selector = $content_base_selector . ' '. $p_selector;

			$this->add_control(
				'title_color_'.$key,
				[
					'label'		=> __( 'Color', 'mec-shortcode-designer' ) . ' ' . $title,
					'type'		=> Controls_Manager::COLOR,
					'scheme'	=> [
						'type'	=> Color::get_type(),
						'value' => Color::COLOR_1,
					],
					'default'	=> '#000',
					'selectors' => [
						$p_selector => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_color_'.$key.'_hover',
				[
					'label'		=> __( 'Hover', 'mec-shortcode-designer' ) . ' ' . $title,
					'type'		=> Controls_Manager::COLOR,
					'scheme'	=> [
						'type'	=> Color::get_type(),
						'value' => Color::COLOR_1,
					],
					'default'	=> '#000',
					'selectors' => [
						$p_selector.':hover' => 'color: {{VALUE}}',
					],
				]
			);
		}


		$this->end_controls_section();


		// background
		$this->start_controls_section(
			'title_background_style',
			[
				'label' => __( 'Background', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_background',
			[
				'label'		=> __( 'Background', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#FFFFFF',
				'selectors' => [
					$tooltip_box_selector.'::before , '.$tooltip_box_selector => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_background_hover',
			[
				'label'		=> __( 'Hover', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#FFFFFF',
				'selectors' => [
					$tooltip_box_selector.':hover ,'.$tooltip_box_selector.':hover::before'  => 'background: {{VALUE}}',
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
					$tooltip_box_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					$tooltip_box_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'border',
				'label'		=> __( 'Border', 'mec-shortcode-designer' ),
				'selector'	=> $tooltip_box_selector,
			]
		);
		$this->add_control(
			'date_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					$tooltip_box_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => $tooltip_box_selector,
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
		$settings   = $this->get_settings();

		$status = 	(bool)Settings::getInstance()->get_settings( 'display_event_fields_backend' )
					&&
					(bool)Settings::getInstance()->get_settings( 'display_event_fields' );

		if(!$status){

			return;
		}

		if ( get_post_type() == 'mec_designer' ) {

			$event_detail = EventsQuery::getInstance()->get_last_event('event');
		} else {

			$event_id = get_the_ID();
			$event = new Event($event_id);
			$event_detail = $event->get_detail();
		}

		$data = (isset($event_detail->data) and isset($event_detail->data->meta) and isset($event_detail->data->meta['mec_fields']) and is_array($event_detail->data->meta['mec_fields'])) ? $event_detail->data->meta['mec_fields'] : get_post_meta($event_detail->ID, 'mec_fields', true);
		$data = array_filter($data,function($v){
			return !empty($v);
		});

		?>
			<div class="mec-shortcode-designer">
				<div class="mec-event-custom-fields">
					<?php
					if( !empty($data) && is_object($event_detail)){

						$single = new MEC_skin_single();
						$single->display_data_fields($event_detail, false, true);
					}else{

						echo $this->get_html_test();
					}
					?>
				</div>
			</div>
		<?php

	}

	public function get_html_test(){

		?>
		<div class="mec-event-custom-fields">
			<div class="mec-event-data-fields mec-frontbox  mec-data-fields-shortcode mec-util-hidden">
				<div class="mec-data-fields-tooltip">
					<div class="mec-data-fields-tooltip-box">
						<ul class="mec-event-data-field-items">
							<li class="mec-event-data-field-item mec-field-item-text">
								<span class="mec-event-data-field-name"><?php esc_html_e( 'Title:', 'mec-shortcode-designer' ); ?></span>
								<span class="mec-event-data-field-value"><?php esc_html_e( 'Value', 'mec-shortcode-designer' ); ?></span>
							</li>
							<li class="mec-event-data-field-item mec-field-item-text">
								<span class="mec-event-data-field-name"><?php esc_html_e( 'Title:', 'mec-shortcode-designer' ); ?></span>
								<span class="mec-event-data-field-value"><?php esc_html_e( 'Value', 'mec-shortcode-designer' ); ?></span>
							</li>
							<li class="mec-event-data-field-item mec-field-item-text">
								<span class="mec-event-data-field-name"><?php esc_html_e( 'Title:', 'mec-shortcode-designer' ); ?></span>
								<span class="mec-event-data-field-value"><?php esc_html_e( 'Value', 'mec-shortcode-designer' ); ?></span>
							</li>
							<li class="mec-event-data-field-item mec-field-item-text">
								<span class="mec-event-data-field-name"><?php esc_html_e( 'Title:', 'mec-shortcode-designer' ); ?></span>
								<span class="mec-event-data-field-value"><?php esc_html_e( 'Value', 'mec-shortcode-designer' ); ?></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
        </div>
		<?php
	}
}