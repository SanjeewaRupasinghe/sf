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

/** no direct access */
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC elementor addon shortcode class
 *
 * @author Webnus <info@webnus.net>
 */
class MecShortCodeDesignerReadMore extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-read-more';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Read More', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
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
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'mec-shortcode-designer' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mec-booking-button',
			]
		);
		$this->add_control(
			'title_align',
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
					'{{WRAPPER}} .mec-event-readmore' => 'text-align: {{VALUE}}',
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
					'{{WRAPPER}} .mec-booking-button' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'link_target',
			[
				'label'		=> __( 'Link Target', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::SELECT,
				'default' 	=> '',
				'options' 	=> [
					'_blank'		=> __( 'New Window', 'mec-shortcode-designer' ),
					'_self'			=> __( 'Same Window', 'mec-shortcode-designer' ),
					''				=> __( 'Default Action', 'mec-shortcode-designer' ),
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
				'label'     => __( 'Color', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mec-booking-button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'     => __( 'Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .mec-booking-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
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
				'label'     => __( 'Background', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#40d9f1',
				'selectors' => [
					'{{WRAPPER}} .mec-booking-button' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_background_hover',
			[
				'label'     => __( 'Hover', 'mec-shortcode-designer' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-booking-button:hover' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .mec-booking-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label'      => __( 'Padding', 'mec-shortcode-designer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .mec-booking-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'      => '8',
					'right'    => '20',
					'bottom'   => '8',
					'left'     => '20',
					'isLinked' => true,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-booking-button',
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
					'{{WRAPPER}} .mec-booking-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-booking-button',
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

		$link_target	= isset($settings['link_target']) ? $settings['link_target'] : '';
		if(empty($link_target)){

			global $MEC_Shortcode_id;
			$link_target = mec_shortcode_get_sed_method('readmore',$MEC_Shortcode_id);
		}

		if ( get_post_type() == 'mec_designer' ) {
			$event_id   = get_posts( 'post_type=mec-events&numberposts=1' )[0]->ID;
			$mec_render = new \MEC_render();
			$mec_main   = new \MEC_main();
			$data       = $mec_render->data( $event_id );
			?>
			<div class="mec-shortcode-designer">
				<div class="mec-event-readmore">
					<a class="mec-booking-button" data-event-id="<?php echo $event_id; ?>" href="<?php echo get_the_permalink( $event_id ); ?>" target="<?php echo $link_target; ?>">
						<?php echo ( is_array( $data->tickets ) and count( $data->tickets ) ) ? $mec_main->m( 'register_button', __( 'REGISTER', 'mec' ) ) : $mec_main->m( 'view_detail', __( 'View Detail', 'mec' ) ); ?>
					</a>
				</div>
			</div>
			<?php
		} else {
			$mec_render = new \MEC_render();
			$mec_main   = new \MEC_main();
			$data       = $mec_render->data( get_the_ID() );

			$single_event   = new MEC_skin_single();
			$mec_settings   = $mec_main->get_settings();
			$event_base     = $single_event->get_event_mec(get_the_ID());
			$event_base     = $event_base[0];

			$event_id = get_the_ID();
			global $MEC_Shortcode_id;
			$datetimes = EventsDateTimes::instance()->get_datetimes($event_id,'readmore'.$MEC_Shortcode_id);

			$start_date =  isset($datetimes['start']['date']) && !empty($datetimes['start']['date']) ? $datetimes['start']['date'] : '';
			$end_date =  isset($datetimes['end']['date']) && !empty($datetimes['end']['date']) ? $datetimes['end']['date'] : '';
			$start_time =  isset($datetimes['start']['time']) && !empty($datetimes['start']['time']) ? $datetimes['start']['time'] : '';
			$end_time =  isset($datetimes['end']['time']) && !empty($datetimes['end']['time']) ? $datetimes['end']['time'] : '';
			if(is_object($event_base))
        	{
				if((!isset($mec_settings['single_date_method']) or (isset($mec_settings['single_date_method']) and $mec_settings['single_date_method'] == 'next'))) {
					$url = $event_base->data->permalink;
				} else {
					$url = $event_base->data->permalink;
					$url = $mec_main->add_qs_var('occurrence', $start_date, $url);
					$repeat_type = (isset($event_base->data->meta['mec_repeat_type']) ? $event_base->data->meta['mec_repeat_type'] : '');
					if($repeat_type == 'custom_days' and isset($event_base->data->time) and isset($event_base->data->time['start_raw']))
					{
						$timestamp = strtotime($start_date.' '.($start_time));
						// Add Time
						$url = $mec_main->add_qs_var('time', $timestamp, $url);
					}
				}
			}
			else
			{
				$url = $event_base;
				// Single Page Date method is set to next date
				if((!isset($mec_settings['single_date_method']) or (isset($mec_settings['single_date_method']) and $mec_settings['single_date_method'] == 'next'))) {
					 $url = $event_base->data->permalink;
				} else {
					$url =  $mec_main->add_qs_var('occurrence', $start_date, $url);
				}

			}

			?>

			<div class="mec-shortcode-designer">
				<div class="mec-event-readmore">
					<a class="mec-booking-button" data-event-id="<?php echo get_the_ID(); ?>" href="<?php echo $url ?>" target="<?php echo $link_target; ?>">
						<?php echo ( is_array( $data->tickets ) and count( $data->tickets ) ) ? $mec_main->m( 'register_button', __( 'REGISTER', 'mec' ) ) : $mec_main->m( 'view_detail', __( 'View Detail', 'mec' ) ); ?>
					</a>
				</div>
			</div>
			<?php
		}
	}
}
