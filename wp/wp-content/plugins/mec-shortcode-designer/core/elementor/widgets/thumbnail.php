<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/** no direct access */
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor addon shortcode class
 *
 * @author Webnus <info@webnus.net>
 */
class MecShortCodeDesignerThumbnail extends Widget_Base
{

	/**
	 * Retrieve MEC widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'mec-thumbnail';
	}

	/**
	 * Retrieve MEC widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('MEC Thumbnail', 'mec-shortcode-designer');
	}

	/**
	 * Retrieve MEC widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-image';
	}


	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget category.
	 */
	public function get_categories()
	{
		return ['mec_shortcode_designer'];
	}

	/**
	 * Register MEC widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{
		$this->start_controls_section(
			'styling_section',
			[
				'label' => __('Styling', 'mec-shortcode-designer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thumbnail_size',
			[
				'label'		=> __('Thumbnail size', 'mec-shortcode-designer'),
				'type'		=> Controls_Manager::SELECT,
				'default' 	=> 'gridsquare',
				'options' 	=> [
					'full'				=> __('full', 'mec-shortcode-designer'),
					'meccarouselthumb'	=> __('474 x 324', 'mec-shortcode-designer'),
					'gridsquare'		=> __('391 x 260', 'mec-shortcode-designer'),
					'thumblist'			=> __('300 x 300', 'mec-shortcode-designer'),
					'medium'			=> __('300 x 200', 'mec-shortcode-designer'),
					'thumbnail'			=> __('150 x 150', 'mec-shortcode-designer'),
				],
			]
		);
		$this->add_control(
			'display',
			[
				'label'		=> __('Display', 'mec-shortcode-designer'),
				'type'		=> Controls_Manager::SELECT,
				'default' 	=> 'block',
				'options' 	=> [
					'inherit'		=> __('inherit', 'mec-shortcode-designer'),
					'inline'		=> __('inline', 'mec-shortcode-designer'),
					'inline-block'	=> __('inline-block', 'mec-shortcode-designer'),
					'block'			=> __('block', 'mec-shortcode-designer'),
					'none'			=> __('none', 'mec-shortcode-designer'),
				],
				'selectors' => [
					'{{WRAPPER}} .mec-event-image' => 'display: {{VALUE}}',
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
		$this->add_control(
			'link_status',
			[
				'label'		=> __('Thumb Link', 'mec-shortcode-designer'),
				'type'		=> Controls_Manager::SWITCHER,
				'label_on' => __('Use', 'your-plugin'),
				'label_off' => __('Don`t', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => __('Enable: Custom link or Event Link.', 'mec-shortcode-designer')
			]
		);
		$this->add_control(
			'link_url',
			[
				'label'		=> __('Image Link Url', 'mec-shortcode-designer'),
				'type'		=> Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
				'description' => __('Empty: Event URL', 'mec-shortcode-designer'),
				'condition' => [
					'link_status' => 'yes'
				]
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label'			=> __('Image Width Size', 'mec-shortcode-designer'),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> ['px', '%'],
				'range'			=> [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%'	=> [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mec-event-image img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);
		$this->add_control(
			'thumbnail_margin',
			[
				'label'			=> __('Margin', 'mec-shortcode-designer'),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> ['px', '%', 'em'],
				'default'		=> [
					'top'		=> '0',
					'right'		=> '0',
					'bottom'	=> '0',
					'left'		=> '0',
					'isLinked' => true,
				],
				'selectors'		=> [
					'{{WRAPPER}} .mec-event-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'thumbnail_padding',
			[
				'label'			=> __('Padding', 'mec-shortcode-designer'),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> ['px', '%', 'em'],
				'selectors'		=> [
					'{{WRAPPER}} .mec-event-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'border',
				'label'		=> __('Border', 'mec-shortcode-designer'),
				'selector'	=> '{{WRAPPER}} .mec-event-image img',
			]
		);
		$this->add_control(
			'border_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-shortcode-designer'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mec-event-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Box Shadow', 'mec-shortcode-designer'),
				'selector' => '{{WRAPPER}} .mec-event-image img',
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
	protected function render()
	{
		$settings 		= $this->get_settings();
		$link_status 	= isset($settings['link_status']) ? $settings['link_status'] : '';
		$link_url 		= isset($settings['link_url']) ? $settings['link_url'] : '';
		$link_target	= isset($settings['link_target']) ? $settings['link_target'] : '';
		if(empty($link_target)){

			global $MEC_Shortcode_id;
			$link_target = mec_shortcode_get_sed_method('title',$MEC_Shortcode_id);
		}

		if (get_post_type() == 'mec_designer') {
			$post_id = get_posts('post_type=mec-events&numberposts=1')[0]->ID;
			$link = get_the_permalink($post_id);
			$nofollow = '';
			if ($link_status == 'yes' && isset($link_url['url']) && $link_url['url']) {
				$link = $link_url['url'];
				$nofollow = $link_url['nofollow'] ? ' rel="nofollow"' : '';
			}
?>
			<div class="mec-shortcode-designer">
				<div class="mec-event-image">
					<?php if ($link_status == 'yes') : ?>
						<a data-event-id="<?php echo esc_attr($post_id); ?>" href="<?php echo $link ?>" <?php echo $nofollow; ?>>
						<?php endif; ?>
						<?php echo get_the_post_thumbnail($post_id, $settings['thumbnail_size']); ?>
						<?php if ($link_status == 'yes') : ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php
		} else {
			$link = get_the_permalink(get_the_ID());
			$nofollow = '';
			if ($link_status == 'yes' && isset($link_url['url']) && $link_url['url']) {
				$link = $link_url['url'];
				$nofollow = $link_url['nofollow'] ? ' rel="nofollow"' : '';
			}
		?>
			<div class="mec-shortcode-designer">
				<div class="mec-event-image">
					<?php if ($link_status == 'yes') : ?>
						<a data-event-id="<?php echo esc_attr(get_the_ID()); ?>" target="<?php echo $link_target; ?>" href="<?php echo $link ?>" <?php echo $nofollow; ?>>
						<?php endif; ?>
						<?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
						<?php if ($link_status == 'yes') : ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
<?php
		}
	}
}
