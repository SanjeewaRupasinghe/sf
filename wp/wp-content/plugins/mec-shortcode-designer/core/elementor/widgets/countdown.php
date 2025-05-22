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
class MecShortCodeDesignerCountdown extends Widget_Base {

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mec-countdown';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MEC Countdown', 'mec-shortcode-designer' );
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-countdown';
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
				'name'		=> 'number_typography',
				'label'		=> __( 'ٔNumber Typography', 'mec-shortcode-designer' ),
				'scheme'	=> Typography::TYPOGRAPHY_1,
				'selector'	=> '{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown .block-w span',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'label_typography',
				'label'		=> __( 'Label Typography', 'mec-shortcode-designer' ),
				'scheme'	=> Typography::TYPOGRAPHY_1,
				'selector'	=> '{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown .block-w p',
			]
		);
		$this->add_control(
			'countdown_align',
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
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown' => 'text-align: {{VALUE}}',
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
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown' => 'display: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// color
		$this->start_controls_section(
			'countdown_color_style',
			[
				'label' => __( 'Colors', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'number_color',
			[
				'label'		=> __( 'ٔNumber Color', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown .block-w span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label'		=> __( 'Label Color', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown .block-w p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		// background
		$this->start_controls_section(
			'countdown_background_style',
			[
				'label' => __( 'Background', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'countdown_background',
			[
				'label'		=> __( 'Background', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'countdown_hover_background',
			[
				'label'		=> __( 'Background Hover', 'mec-shortcode-designer' ),
				'type'		=> Controls_Manager::COLOR,
				'scheme'	=> [
					'type'	=> Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'default'	=> 'rgba(255,255,255,0)',
				'selectors' => [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown:hover' => 'background: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
		// Spacing
		$this->start_controls_section(
			'countdown_spacing_style',
			[
				'label' => __( 'Block Spacing', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'block_margin',
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
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown .block-w' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'block_padding',
			[
				'label'			=> __( 'Padding', 'mec-shortcode-designer' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'em' ],
				'selectors'		=> [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown .block-w' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// Box Settings
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Settings', 'mec-shortcode-designer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_margin',
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
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'			=> __( 'Padding', 'mec-shortcode-designer' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', '%', 'em' ],
				'selectors'		=> [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'box_border',
				'label'		=> __( 'Border', 'mec-shortcode-designer' ),
				'selector'	=> '{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown',
			]
		);
		$this->add_control(
			'countdown_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'mec-shortcode-designer' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'mec-shortcode-designer' ),
				'selector' => '{{WRAPPER}} .mec-shortcode-designer .mec-event-countdown',
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
		$main = new MEC_main();
		$mec_settings = $main->get_settings();
		static $i = 0;
		if ( get_post_type() == 'mec_designer' ) {
			$event_id = get_posts( 'post_type=mec-events&numberposts=1' )[0]->ID;

			$start_date = get_post_meta($event_id, 'mec_start_date', true);
			$end_date = get_post_meta($event_id, 'mec_end_date', true);

		} else {
			$event_id = get_the_ID();

			global $MEC_Shortcode_id;
			$datetimes = EventsDateTimes::instance()->get_datetimes($event_id,'countdown'.$MEC_Shortcode_id);

			$start_date =  isset($datetimes['start']['date']) && !empty($datetimes['start']['date']) ? $datetimes['start']['date'] : '';
			$end_date = isset($datetimes['end']['date']) && !empty($datetimes['end']['date']) ? $datetimes['end']['date'] : '';
		}

		$ongoing = (isset($mec_settings['hide_time_method']) and trim($mec_settings['hide_time_method']) == 'end') ? true : false;

		$s_h = get_post_meta( $event_id, 'mec_start_time_hour', true);
		$s_h = !empty($s_h) ? $s_h : 8;
		$s_m = get_post_meta( $event_id, 'mec_start_time_minutes', true);
		$s_m = !empty($s_m) ? $s_m : 0;
		$s_am_pm = get_post_meta( $event_id, 'mec_start_time_ampm', true);
		$s_am_pm = !empty($s_am_pm) ? $s_am_pm : 'AM';

		$e_h = get_post_meta( $event_id, 'mec_end_time_hour', true);
		$e_h = !empty($e_h) ? $e_h : 8;
		$e_m = get_post_meta( $event_id, 'mec_end_time_minutes', true);
		$e_m = !empty($e_m) ? $e_m : 0;
		$e_am_pm = get_post_meta( $event_id, 'mec_end_time_ampm', true);
		$e_am_pm = !empty($e_am_pm) ? $e_am_pm : 'PM';

		$start_event_datetime =  "$start_date $s_h:$s_m:00 $s_am_pm";
		$end_event_datetime = "$end_date $e_h:$e_m:00 $e_am_pm";

		$start_event_time = strtotime($start_event_datetime);
		$current_event_time = current_time('timestamp');
		$end_event_time = strtotime($end_event_datetime);

		$countdown_method = get_post_meta($event_id, 'mec_countdown_method', true);
		if(trim($countdown_method) == '') {
			$countdown_method = 'global';
		}

		if($countdown_method == 'global'){
			$ongoing = (isset($mec_settings['hide_time_method']) and trim($mec_settings['hide_time_method']) == 'end') ? true : false;
		}else{
			$ongoing = ($countdown_method == 'end') ? true : false;
		}

		if($end_event_time < $current_event_time)
		{
			echo '<div class="mec-end-counts"><h3>'.__('The event is finished.', 'mec').'</h3></div>';
			return;
		}elseif($start_event_time < $current_event_time and !$ongoing)
		{
			echo '<div class="mec-end-counts"><h3>'.__('The event is ongoing.', 'mec').'</h3></div>';
			return;
		}


		$gmt_offset = $main->get_gmt_offset();
		if(isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') === false) $gmt_offset = ' : '.$gmt_offset;
		if(isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') == true) $gmt_offset = substr(trim($gmt_offset), 0 , 3);
		if(isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == true) $gmt_offset = substr(trim($gmt_offset), 2 , 3);

		$event_time = $ongoing ? $end_event_time : $start_event_time;
		$data_date_custom = date('D M j Y G:i:s',$event_time) . $gmt_offset;
		$id = $i.$event_id.time();
		if($i == 0){

			$javascript = '
			<script type="text/javascript">
				jQuery(document).ready(function($){
					$(".mec-event-sd-countdown").each(function (event) {
						var dc= $(this).attr("data-date-custom");
						$(this).mecCountDown(
						{
							date: dc,
							format: "off"
						},
						function () {
						});
					});
				});
			</script>';
			echo $javascript;
		}

		?>
			<div class="mec-shortcode-designer">
				<div class="mec-event-countdown mec-event-sd-countdown" data-date-custom="<?php echo isset($data_date_custom) ? $data_date_custom : ''; ?>" id="mec_skin_custom_countdown<?php echo isset($id) ? $id : ''; ?>">
					<ul class="clockdiv" id="countdown">
						<div class="days-w block-w">
							<li>
								<span class="mec-days">00</span>
								<p class="mec-timeRefDays label-w"><?php _e('days', 'mec'); ?></p>
							</li>
						</div>
						<div class="hours-w block-w">
							<li>
								<span class="mec-hours">00</span>
								<p class="mec-timeRefHours label-w"><?php _e('hours', 'mec'); ?></p>
							</li>
						</div>
						<div class="minutes-w block-w">
							<li>
								<span class="mec-minutes">00</span>
								<p class="mec-timeRefMinutes label-w"><?php _e('minutes', 'mec'); ?></p>
							</li>
						</div>
						<div class="seconds-w block-w">
							<li>
								<span class="mec-seconds">00</span>
								<p class="mec-timeRefSeconds label-w"><?php _e('seconds', 'mec'); ?></p>
							</li>
						</div>
					</ul>
				</div>
			</div>
			<?php
		$i++;
	}
}
