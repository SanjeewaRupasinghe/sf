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
class MecShortCodeDesignerTitle extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-title';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Title', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-title';
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
				'selector'	=> '{{WRAPPER}} .mec-event-title a',
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
					'{{WRAPPER}} .mec-event-title' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'display',
			[
				'label'		=> __( 'Display', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::SELECT,
				'default' 	=> 'block',
				'options' 	=> [
					'inherit'		=> __( 'inherit', 'mec-shortcode-designer' ),
					'inline'		=> __( 'inline', 'mec-shortcode-designer' ),
					'inline-block'	=> __( 'inline-block', 'mec-shortcode-designer' ),
					'block'			=> __( 'block', 'mec-shortcode-designer' ),
					'none'			=> __( 'none', 'mec-shortcode-designer' ),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-event-title' => 'display: {{VALUE}}',
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
				'label'		=> __( 'Color', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-event-title a' => 'color: {{VALUE}}',
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
				'default'	=> '#40d9f1',
				'selectors' => [
					'{{WRAPPER}} .mec-event-title:hover a' => 'color: {{VALUE}}',
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
				'label'		=> __( 'Background', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-event-title' => 'background: {{VALUE}}',
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
				'default'	=> 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-event-title:hover' => 'background: {{VALUE}}',
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
					'{{WRAPPER}} .mec-event-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .mec-event-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'title_border',
				'label'		=> __( 'Border', 'mec-shortcode-designer' ),
				'selector'	=> '{{WRAPPER}} .mec-event-title',
			]
		);
		$this->add_control(
			'title_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-event-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-event-title',
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
		$settings   	= $this->get_settings();
		$single_event   = new MEC_skin_single();
		$main 			= new MEC_main();
		$mec_settings   = $main->get_settings();
		$link_target	= isset($settings['link_target']) ? $settings['link_target'] : '';

		$event_id = get_the_ID();
		global $MEC_Shortcode_id;
		$datetimes = EventsDateTimes::instance()->get_datetimes($event_id,'title'.$MEC_Shortcode_id);

		$start_date =  isset($datetimes['start']['date']) && !empty($datetimes['start']['date']) ? $datetimes['start']['date'] : get_option( 'mec_sd_time_option' );
		$end_date = isset($datetimes['end']['date']) && !empty($datetimes['end']['date']) ? $datetimes['end']['date'] : get_option( 'mec_esd_time_option' );
		$start_time = isset($datetimes['start']['time']) && !empty($datetimes['start']['time']) ? $datetimes['start']['time'] : '';
		$end_time = isset($datetimes['end']['time']) && !empty($datetimes['end']['time']) ? $datetimes['end']['time'] : '';

		if ( get_post_type() == 'mec_designer' ) {
			$event_id = get_posts( 'post_type=mec-events&numberposts=1' )[0]->ID;

			$url = $main->get_event_date_permalink(
				get_post_meta($event_id, 'mec_start_date', true),
				$start_date
			);
		} else {
			$event_base     = $single_event->get_event_mec(get_the_ID());
			$event_base     = $event_base[0];

			$start_time = $start_time ? $start_time : '';
			$end_time = $end_time ? $end_time : '';
			if(is_object($event_base))
        	{
				if((!isset($mec_settings['single_date_method']) or (isset($mec_settings['single_date_method']) and $mec_settings['single_date_method'] == 'next'))) {
					$url = $event_base->data->permalink;
				} else {
					$url = $event_base->data->permalink;
					$url = $main->add_qs_var('occurrence', $start_date, $url);
					$repeat_type = (isset($event_base->data->meta['mec_repeat_type']) ? $event_base->data->meta['mec_repeat_type'] : '');
					if($repeat_type == 'custom_days' and isset($event_base->data->time) and isset($event_base->data->time['start_raw']))
					{
						$timestamp = strtotime($start_date.' '.($start_time));
						// Add Time
						$url = $main->add_qs_var('time', $timestamp, $url);
					}
				}
			}
			else{
				$url = $event_base;
				// Single Page Date method is set to next date
				if((!isset($mec_settings['single_date_method']) or (isset($mec_settings['single_date_method']) and $mec_settings['single_date_method'] == 'next'))) {
					 $url = $event_base->data->permalink;
				} else {
					$url =  $main->add_qs_var('occurrence', $start_date, $url);
				}

			}

			if(empty($link_target)){

				global $MEC_Shortcode_id;
				$link_target = mec_shortcode_get_sed_method('title',$MEC_Shortcode_id);
			}
		}
		?>
		<div class="mec-shortcode-designer">
			<div class="mec-event-content">
				<h4 class="mec-event-title">
					<?php if('no' === $link_target): ?>
						<?php echo get_the_title(); ?>
					<?php else: ?>
						<a class="mec-color-hover" target="<?php echo $link_target; ?>" data-event-id="<?php echo $event_id; ?>" href="<?php echo isset($url) ? $url : ''; ?>"><?php echo get_the_title( $event_id ); ?></a>
					<?php endif; ?>
				</h4>
			</div>
		</div>
		<?php
	}
}
