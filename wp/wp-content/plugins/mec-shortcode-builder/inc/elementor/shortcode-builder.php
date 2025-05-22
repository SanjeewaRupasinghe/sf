<?php
namespace Elementor;

use Elementor\Core\Schemes\Typography;

/** no direct access */
defined( 'MECEXEC' ) or die();

if ( ! class_exists( 'MEC_addon_elementor_shortcode_builder' ) ) :
	/**
	 * Webnus MEC elementor addon shortcode class
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	class MEC_addon_elementor_shortcode_builder extends \Elementor\Widget_Base {

		/**
		 * Retrieve MEC widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'MEC-SHORTCODE-BUILDER';
		}

		/**
		 * Retrieve MEC widget title.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'MEC Shortcode Builder', 'mec-shortcode-builder' );
		}

		/**
		 * Retrieve MEC widget icon.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-archive-posts';
		}

		/**
		 * Set widget category.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget category.
		 */
		public function get_categories() {
			return array( 'mec' );
		}

		/**
		 * Set Scripts.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Scripts Array.
		 */
		public function get_script_depends() {
			return [
				'mec-isotope-script',
				'mec-owl-carousel-script',
				'googlemap',
				'mec-richmarker-script',
				'mec-frontend-script',
			];
		}

		public function get_style_depends() {
			return [ 'mec-frontend-style', 'mec-owl-carousel-style', 'mec-owl-carousel-theme-style' ];
		}

		/**
		 * Register MEC widget controls.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function _register_controls() {

			// Display Options
			$this->start_controls_section(
				'display_options',
				array(
					'label' => __( 'Display Options', 'mec-shortcode-builder' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				)
			);
			if (defined('MECSHORTCODEDESIGNERNAME'))
			{
				$this->add_control(
					'skin',
					array(
						'label'   => __( 'Skin', 'mec-shortcode-builder' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'list'           	=> __( 'List View', 'mec-shortcode-builder' ),
							'grid'           	=> __( 'Grid View', 'mec-shortcode-builder' ),
							'agenda'         	=> __( 'Agenda View', 'mec-shortcode-builder' ),
							'full_calendar'  	=> __( 'Full Calendar', 'mec-shortcode-builder' ),
							'yearly_view'    	=> __( 'Yearly View', 'mec-shortcode-builder' ),
							'monthly_view'   	=> __( 'Calendar / Monthly View', 'mec-shortcode-builder' ),
							'daily_view'     	=> __( 'Daily View', 'mec-shortcode-builder' ),
							'weekly_view'    	=> __( 'Weekly View', 'mec-shortcode-builder' ),
							'timetable'      	=> __( 'Timetable View', 'mec-shortcode-builder' ),
							'masonry'        	=> __( 'Masonry View', 'mec-shortcode-builder' ),
							'map'            	=> __( 'Map View', 'mec-shortcode-builder' ),
							'cover'          	=> __( 'Cover View', 'mec-shortcode-builder' ),
							'countdown'      	=> __( 'Countdown View', 'mec-shortcode-builder' ),
							'available_spot' 	=> __( 'Available Spot', 'mec-shortcode-builder' ),
							'carousel'       	=> __( 'Carousel View', 'mec-shortcode-builder' ),
							'slider'         	=> __( 'Slider View', 'mec-shortcode-builder' ),
							'timeline'  	 	=> __( 'Timeline View', 'mec-shortcode-builder' ),
							'tile'  	 		=> __( 'Tile View', 'mec-shortcode-builder' ),
							'custom'  	 		=> __( 'Shortcode Designer', 'mec-shortcode-builder' ),
						],
						'default' => 'list',
					)
				);
			} else {
				$this->add_control(
					'skin',
					array(
						'label'   => __( 'Skin', 'mec-shortcode-builder' ),
						'type'    => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'list'           	=> __( 'List View', 'mec-shortcode-builder' ),
							'grid'           	=> __( 'Grid View', 'mec-shortcode-builder' ),
							'agenda'         	=> __( 'Agenda View', 'mec-shortcode-builder' ),
							'full_calendar'  	=> __( 'Full Calendar', 'mec-shortcode-builder' ),
							'yearly_view'    	=> __( 'Yearly View', 'mec-shortcode-builder' ),
							'monthly_view'   	=> __( 'Calendar / Monthly View', 'mec-shortcode-builder' ),
							'daily_view'     	=> __( 'Daily View', 'mec-shortcode-builder' ),
							'weekly_view'    	=> __( 'Weekly View', 'mec-shortcode-builder' ),
							'timetable'      	=> __( 'Timetable View', 'mec-shortcode-builder' ),
							'masonry'        	=> __( 'Masonry View', 'mec-shortcode-builder' ),
							'map'            	=> __( 'Map View', 'mec-shortcode-builder' ),
							'cover'          	=> __( 'Cover View', 'mec-shortcode-builder' ),
							'countdown'      	=> __( 'Countdown View', 'mec-shortcode-builder' ),
							'available_spot' 	=> __( 'Available Spot', 'mec-shortcode-builder' ),
							'carousel'       	=> __( 'Carousel View', 'mec-shortcode-builder' ),
							'slider'         	=> __( 'Slider View', 'mec-shortcode-builder' ),
							'timeline'  	 	=> __( 'Timeline View', 'mec-shortcode-builder' ),
							'tile'  	 		=> __( 'Tile View', 'mec-shortcode-builder' ),
						],
						'default' => 'list',
					)
				);
			}
			MEC_elementor_list_display_opts::options( $this );
			MEC_elementor_grid_display_opts::options( $this );
			MEC_elementor_agenda_display_opts::options( $this );
			MEC_elementor_full_calendar_display_opts::options( $this );
			MEC_elementor_yearly_display_opts::options( $this );
			MEC_elementor_monthly_display_opts::options( $this );
			MEC_elementor_daily_display_opts::options( $this );
			MEC_elementor_weekly_display_opts::options( $this );
			MEC_elementor_timetable_display_opts::options( $this );
			MEC_elementor_masonry_display_opts::options( $this );
			MEC_elementor_map_display_opts::options( $this );
			MEC_elementor_cover_display_opts::options( $this );
			MEC_elementor_countdown_display_opts::options( $this );
			MEC_elementor_available_spot_display_opts::options( $this );
			MEC_elementor_carousel_display_opts::options( $this );
			MEC_elementor_slider_display_opts::options( $this );
			MEC_elementor_timeline_display_opts::options( $this );
			MEC_elementor_tile_display_opts::options( $this );
			if (defined('MECSHORTCODEDESIGNERNAME')) MEC_elementor_custom_display_opts::options( $this );
			$this->end_controls_section();

			// Search Form
			$this->start_controls_section(
				'search_form',
				[
					'label'     => __( 'Search Form', 'mec-shortcode-builder' ),
					'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
					'condition' => [
						'skin!' => [
							'masonry',
							'cover',
							'countdown',
							'available_spot',
							'carousel',
							'slider',
							'timeline',
						],
					],
				]
			);
			MEC_elementor_list_search_form::options( $this );
			MEC_elementor_grid_search_form::options( $this );
			MEC_elementor_agenda_search_form::options( $this );
			MEC_elementor_full_calendar_search_form::options( $this );
			MEC_elementor_yearly_search_form::options( $this );
			MEC_elementor_monthly_search_form::options( $this );
			MEC_elementor_daily_search_form::options( $this );
			MEC_elementor_weekly_search_form::options( $this );
			MEC_elementor_timetable_search_form::options( $this );
			MEC_elementor_map_search_form::options( $this );
			MEC_elementor_tile_search_form::options( $this );
			MEC_elementor_custom_search_form::options( $this );
			$this->end_controls_section();

			// Filter Options
			$this->start_controls_section(
				'filter_options',
				array(
					'label' => __( 'Filter Options', 'mec-shortcode-builder' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
					'condition' => [
						'skin!' => 'countdown'
					]
				)
			);
			MEC_elementor_filter_options::options( $this );
			$this->end_controls_section();
			// Start Style Tab

			// Time Display
			$this->start_controls_section(
				'search_settings',
				[
					'label' => __( 'Search Filter Settings', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin!' =>
						[
							'masonry',
							'cover',
							'countdown',
							'available_spot',
							'carousel',
							'slider',
							'timeline',
						],
					],
				]
			);
			$this->add_control(
				'search_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'search_icon_color',
				[
					'label' 		=> __( 'Icon Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'default' 		=> '#777',
					'selectors' 	=> [
						'body .mec-wrap .mec-totalcal-box i' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->add_control(
				'search_icon_bg_color',
				[
					'label' 		=> __( 'Icon Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap .mec-totalcal-box i' => 'background: {{VALUE}} !important',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'search_pleaceholder_typography',
					'separator' => 'before',
					'label' 	=> __( 'Divider Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span,
					 body .mec-wrap .mec-totalcal-box input,
					 body .mec-wrap .mec-totalcal-box select',
				]
			);
			$this->add_control(
				'search_pleaceholder_color',
				[
					'label' => __( 'Pleaceholder Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#777',
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span
,
						 body .mec-wrap .mec-totalcal-box input,
						 body .mec-wrap .mec-totalcal-box select' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->add_control(
				'search_placeholder_bg_color',
				[
					'label' => __( 'Placeholder Background', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span,
						 body .mec-wrap .mec-totalcal-box input,
						 body .mec-wrap .mec-totalcal-box select' => 'background: {{VALUE}} !important',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'search_pleaceholder_border',
					'label' => __( 'Icon and Placeholder Border', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span
,
					 body .mec-wrap .mec-totalcal-box input,
					 body .mec-wrap .mec-totalcal-box select,
					 body .mec-wrap .mec-totalcal-box i',
				]
			);
			$this->add_responsive_control(
				'search_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_margin',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'search_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-wrap .mec-totalcal-box',
				]
			);
			$this->add_responsive_control(
				'search_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'search_box_bg_color',
				[
					'label' => __( 'Box Background', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box' => 'background: {{VALUE}} !important',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'esearch_box_shadow',
					'label' => __( 'Box Shadow', 'mec-shortcode-builder' ),
					'selector' =>
						'body .mec-wrap .mec-totalcal-box',
				]
			);

			$this->add_control(
				'thisisfullcalendarbreakline',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
					'condition' => [
						'skin' =>
						[
							'full_calendar',
						],
					],
				]
			);

			$this->add_control(
				'register_view_skin_button_display',
				[
					'label' 		=>  esc_html__( 'Buttons Display', 'mec-shortcode-builder' ),
					'description' => '',
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span' => 'display:{{VALUE}};',
					],
					'condition' => [
						'skin' =>
						[
							'full_calendar',
						],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'register_view_skin_button_displaytypography',
					'separator' => 'before',
					'label' 	=> __( 'Buttons Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=> 'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span',
					'condition' => [
						'skin' =>
						[
							'full_calendar',
						],
					],
				]
			);

			// Style Subtitle Tabs
			$this->start_controls_tabs('mec_fullcalendar_view_buttons');

			$this->start_controls_tab(
				'tab_1_normal',
				[
					'label' => __( 'Normal', 'mec-shortcode-builder' ),
					'condition' => [
						'skin' =>
						[
							'full_calendar',
						],
					],
				],
			);

			$this->add_control(
				'register_view_skin_button_detail_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'register_view_skin_button_detail_bg',
				[
					'label' => __( 'Background', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span' => 'background: {{VALUE}} !important;',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'register_view_skin_button_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' => '
						.mec-wrap .mec-totalcal-box .mec-totalcal-view span.mec-totalcalview-selected,
						body .mec-wrap .mec-totalcal-box .mec-totalcal-view span',
				]
			);

			$this->add_responsive_control(
				'register_view_skin_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'register_view_skin_button_detail_padding',
				[
					'label' => __( 'Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_1_hover',
				[
					'label' => __( 'Hover', 'mec-shortcode-builder' ),
					'condition' => [
						'skin' =>
						[
							'full_calendar',
						],
					],
				]
			);

			$this->add_control(
				'register_view_skin_button_detail_hover_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span:hover' => 'color: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'register_view_skin_button_detail_bg_hover',
				[
					'label' => __( 'Background Hover', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span:hover' => 'background: {{VALUE}} !important;',
					],
				]
			);

			$this->add_responsive_control(
				'register_view_skin_button_detail_padding_hover',
				[
					'label' => __( 'Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-totalcal-box .mec-totalcal-view span:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs(); // End Tabs

			$this->end_controls_section();

			// Divider Tab
			$this->start_controls_section(
				'divider_style',
				[
					'label' => __( 'Divider Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'list',
							'full_calendar',
							'monthly_view',
							'agenda',
							'custom',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'divider_typography',
					'separator' => 'before',
					'label' 	=> __( 'Divider Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-month-divider span,
					 body .mec-calendar .mec-calendar-header h2,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4',
				]
			);
			$this->add_control(
				'divider_color',
				[
					'label' 		=> __( 'Divider Title Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-month-divider span,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'divider_title_border_span',
					'label' => __( 'Divider Title Border', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-month-divider span,
					 body .mec-calendar-a-month h4,
					 body .mec-calendar-a-month h2,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month',
				]
			);
			$this->add_control(
				'divider_before_color',
				[
					'label' 		=> __( 'Divider Shape Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-month-divider span:before' => 'border-color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'divider_shape_border',
					'label' => __( 'Divider Shape Border', 'mec-shortcode-builder' ),
					'selector' => 'body .mec-month-divider span:before',
				]
			);
			$this->add_control(
				'divider_bg_color',
				[
					'label' 		=> __( 'Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-month-divider,
						 body .mec-box-calendar.mec-calendar .mec-calendar-header,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'divider_alignment',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-month-divider span' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'divider_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-month-divider,
						 body .mec-box-calendar.mec-calendar .mec-calendar-header,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'divider_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-month-divider,
						 body .mec-box-calendar.mec-calendar .mec-calendar-header,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'divider_border',
					'label' => __( 'Divider Border', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-month-divider span,
					 body .mec-box-calendar.mec-calendar .mec-calendar-header,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month',
				]
			);
			$this->add_responsive_control(
				'divider_border_radius',
				[
					'label' 		=> __( 'Divider Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-month-divider,
						 body .mec-box-calendar.mec-calendar .mec-calendar-header,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'the_arrow_for_date_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-next-month.mec-load-month i,
						 body .mec-previous-month.mec-load-month i,
						 body .mec-next-year.mec-load-year i,
						 body .mec-previous-year.mec-load-year i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->add_responsive_control(
				'divider_arrow_width',
				[
					'label' 		=> __( 'Arrow Width', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-next-month.mec-load-month,
						 body .mec-previous-month.mec-load-month,
						 body .mec-next-year.mec-load-year,
						 body .mec-previous-year.mec-load-year' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->add_responsive_control(
				'divider_arrow_height',
				[
					'label' 		=> __( 'Arrow Height', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-next-month.mec-load-month,
						 body .mec-previous-month.mec-load-month,
						 body .mec-next-year.mec-load-year,
						 body .mec-previous-year.mec-load-year' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->add_responsive_control(
				'next_arrow_margin',
				[
					'label' 		=> __( 'Next Button Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-next-month.mec-load-month,
						 body .mec-next-year.mec-load-year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->add_responsive_control(
				'previous_arrow_margin',
				[
					'label' 		=> __( 'Previous Button Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-next-month.mec-load-month,
						 body .mec-next-year.mec-load-year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->add_responsive_control(
				'divider_padding_arrow_icon',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-next-month.mec-load-month,
						 body .mec-previous-month.mec-load-month,
						 body .mec-previous-year.mec-load-year,
						 body .mec-previous-year.mec-load-year' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->end_controls_section();
			// End Typo style

			// Divider Tab
			$this->start_controls_section(
				'event_item_style',
				[
					'label' => __( 'Event Item Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin!' => [
							'timeline',
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_title_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-calendar-timetable .mec-month-navigator .mec-month-label' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'skin' =>
						[
							'timetable',
						],
					],
				]
			);
			$this->add_responsive_control(
				'timetable_height_size_item',
				[
					'label' 		=> __( 'Timetable Clean Item Height', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 400,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 185,
					],
					'condition' => [
						'timetable_style' =>
						[
							'clean',
						],
					],
					'selectors' => [
						'body .mec-timetable-t2-content' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'event_item_style_bg_color',
				[
					'label' 		=> __( 'Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-event-article,
						 body .mec-agenda-event,
						 body .mec-timetable-event,
						 body .mec-full-calendar-skin-container article .mec-event-footer,
						 body article .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-masonry .mec-masonry-content,
						 body .mec-masonry .mec-masonry-head,
						 body .mec-av-spot-wrap .mec-event-content,
						 body .gm-style .gm-style-iw-c,
						 body .mec-av-spot .mec-av-spot-head,
						 body .mec-av-spot .mec-av-spot-content,
						 body .mec-event-countdown-style3,
						 body .mec-event-countdown-style2,
						 body .mec-event-countdown-style1,
						 body .mec-event-cover-classic' => 'background: {{VALUE}} !important; transition: all .3s ease;',
					],
				]
			);
			$this->add_control(
				'event_item_style_bg_hover_color',
				[
					'label' 		=> __( 'Background Hover Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-event-article:hover,
						 body .mec-agenda-event:hover,
						 body .mec-timetable-event:hover,
						 body .mec-av-spot-wrap:hover .mec-event-content,
						 body article:hover .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-masonry:hover .mec-masonry-content,
						 body .mec-masonry:hover .mec-masonry-head,
						 body .mec-full-calendar-skin-container article:hover .mec-event-footer,
						 body .mec-event-grid-novel .mec-event-article:hover .novel-grad-bg,
						 body .gm-style:hover .gm-style-iw-c,
						 body .mec-av-spot:hover .mec-av-spot-head,
						 body .mec-av-spot:hover .mec-av-spot-content,
						 body .mec-event-countdown-style3:hover,
						 body .mec-event-countdown-style2:hover,
						 body .mec-event-countdown-style1:hover,
						 body .mec-event-cover-classic:hover' => 'background: {{VALUE}} !important',
					],
				]
			);
			$this->add_responsive_control(
				'event_item_style_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-article,
						 body .mec-agenda-event,
						 body .mec-timetable-event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'event_item_style_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-article,
						 body .mec-agenda-event,
						 body .mec-timetable-event' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'event_item_style_border',
					'label' => __( 'Divider Border', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-event-article,
					 body .mec-agenda-event,
					 .mec-event-list-standard .mec-event-article,
					 body .mec-timetable-event',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'event_item_style_border_list_standard',
					'label' => __( 'Divider Border', 'mec-shortcode-builder' ),
					'description' => __( 'Border for after the content', 'mec-shortcode-builder' ),
					'selector' =>
					'.mec-event-list-standard .mec-event-meta-wrap',
					'allowed_dimensions' => ['top', 'bottom', 'right'],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);

			$this->add_responsive_control(
				'event_item_style_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-article,
						 body .mec-agenda-event,
						 body .mec-event-countdown-style3,
						 body .mec-event-countdown-style2,
						 body .mec-event-countdown-style1,
						 body .mec-event-tile-view article.mec-tile-item,
						 body .mec-event-tile-view article.mec-tile-item:before,
						 .mec-event-list-standard .mec-event-article,
						 body .mec-timetable-event' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'event_item_style_box_shadow',
					'label' => __( 'Normal Box Shadow', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-event-article,
					 body .mec-agenda-event,
					 body .mec-timetable-event',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'event_item_style_box_shadow_hover',
					'label' => __( 'Hover Box Shadow', 'mec-shortcode-builder' ),
					'selector' =>
					'body .mec-event-article:hover,
					 body .mec-agenda-event:hover,
					 body .mec-timetable-event:hover',
				]
			);
			$this->add_control(
				'event_item_list_standard_footer_style_bg_color',
				[
					'label' 		=> __( 'Footer Background Color (Standard)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'separator' => 'before',
					'selectors' 	=> [
						'body article .mec-event-footer' => 'background: {{VALUE}}; transition: all .3s ease;',
					],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_control(
				'event_item_list_standard_footer_style_bg_hover_color',
				[
					'label' 		=> __( 'Footer Background Hover Color (Standard)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body article:hover .mec-event-footer' => 'background: {{VALUE}}',
					],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_list_standard_footer_style_padding',
				[
					'label' 		=> __( 'Footer Padding (Standard)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_list_standard_footer_style_margin',
				[
					'label' 		=> __( 'Footer Margin (Standard)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'event_item_list_standard_footer_style_border',
					'label' => __( 'Footer Border (Standard)', 'mec-shortcode-builder' ),
					'selector' => 'body .mec-event-footer',
					 'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_list_standard_footer_style_border_radius',
				[
					'label' 		=> __( 'Footer Border Radius (Standard)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-footer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_control(
				'event_item_grid_footer_style_bg_color',
				[
					'label' 		=> __( 'Footer Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'separator' => 'before',
					'selectors' 	=> [
						'.mec-event-article .mec-event-footer' => 'background: {{VALUE}}; transition: all .3s ease;',
					],
					'condition' => [
						'grid_style' =>
						[
							'classic',
							'clean'
						],
					],
				]
			);

			$this->add_control(
				'event_item_grid_footer_style_bg_hover_color',
				[
					'label' 		=> __( 'Footer Background Hover Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'.mec-event-article:hover .mec-event-footer' => 'background: {{VALUE}}',
					],
					'condition' => [
						'grid_style' =>
						[
							'classic',
							'clean'
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_grid_footer_style_padding',
				[
					'label' 		=> __( 'Footer Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-event-article .mec-event-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'grid_style' =>
						[
							'classic',
							'clean'
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_grid_footer_style_margin',
				[
					'label' 		=> __( 'Footer Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-event-article .mec-event-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'grid_style' =>
						[
							'classic',
							'clean'
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'event_item_grid_footer_style_border',
					'label' => __( 'Footer Border', 'mec-shortcode-builder' ),
					'selector' => '.mec-event-article .mec-event-footer',
					 'condition' => [
						'grid_style' =>
						[
							'classic',
							'clean'
						],
					],
				]
			);
			$this->add_responsive_control(
				'event_item_grid_footer_style_border_radius',
				[
					'label' 		=> __( 'Footer Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-event-article .mec-event-footer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'grid_style' =>
						[
							'classic',
							'clean'
						],
					],
				]
			);
			$this->end_controls_section();
			// End Typo style

			// Title Style
			$this->start_controls_section(
				'title_style',
				[
					'label' => __( 'Title Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'title_display',
				[
					'label' 		=>  esc_html__( 'Title Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-wrap .mec-event-title,
						 body .mec-agenda-event-title,
						 body .mec-timetable-t2-content .mec-event-title,
						 body .mec-agenda-event-title,
						 body .mec-calendar .mec-event-article .mec-event-title,
						 body .mec-single-event-novel,
						 body .mec-monthly-tooltip h4,
						 body .mec-timetable-event .mec-timetable-event-span a,
						 body .mec-wrap .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-title,
						 body .mec-yearly-view-wrap .mec-agenda-event-title,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title,
						 body .mec-calendar .mec-event-article.mec-single-event-novel,
						 body .mec-event-container-simple .mec-monthly-tooltip,
						 body .mec-timetable-t2-content .mec-event-title,
						 body .mec-timetable-event .mec-timetable-event-title,
						 body .mec-event-cover-clean .mec-event-title,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title,
						 body .mec-event-carousel-type2 .mec-event-carousel-title,
						 body .mec-event-carousel-type3 .mec-event-carousel-title,
						 body .mec-calendar-daily .mec-event-title,
						 body .mec-calendar-weekly .mec-event-title,
						 body .mec-timeline-main-content h4 a,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title a,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title'=>'display:{{VALUE}} !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'shortcode_title_typo',
					'separator' => 'before',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-wrap .mec-event-list-classic .mec-event-title a,
						 body .mec-agenda-event-title a,
						 body .mec-event-list-modern .mec-event-title a,
						 body .mec-event-list-standard .mec-event-title,
						 body .mec-event-list-minimal .mec-event-title a,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title,
						 body .mec-event-grid-classic .mec-event-title a,
						 body .mec-event-grid-clean .mec-event-title a,
						 body .mec-event-grid-minimal .mec-event-title a,
						 body .mec-event-grid-modern .mec-event-title a,
						 body .mec-event-grid-simple .mec-event-title a,
						 body .mec-event-grid-modern .mec-event-title a,
						 body .mec-event-grid-novel .mec-event-content h4 a,
						 body .mec-yearly-view-wrap .mec-agenda-event-title a,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title a,
						 body .mec-calendar .mec-event-article.mec-single-event-novel h4,
						 body .mec-event-container-simple .mec-monthly-tooltip h4,
						 body .mec-timetable-t2-content .mec-event-title a,
						 body .mec-timetable-event .mec-timetable-event-title a,
						 body .mec-event-cover-clean .mec-event-title a,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title a,
						 body .mec-event-carousel-type2 .mec-event-carousel-title a,
						 body .mec-event-carousel-type3 .mec-event-carousel-title a,
						 body .mec-calendar-daily .mec-event-title a,
						  body .mec-calendar-weekly .mec-event-title a,
						 body .mec-event-countdown-style2 .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-title,
						 body .mec-event-countdown-style3 .mec-event-title,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title a,
						 body .mec-timeline-main-content h4 a,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title a,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child',
				]
			);
			$this->add_responsive_control(
				'title_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-event-list-classic .mec-event-title,
						 body .mec-agenda-event-title,
						 body .mec-event-list-minimal .mec-event-title,
						 body .mec-event-list-modern .mec-event-title,
						 body .mec-event-list-standard .mec-event-title,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title,
						 body .mec-event-grid-classic .mec-event-title,
						 body .mec-event-grid-clean .mec-event-title,
						 body .mec-event-grid-minimal .mec-event-title,
						 body .mec-event-grid-modern .mec-event-title,
						 body .mec-event-grid-simple .mec-event-title,
						 body .mec-event-grid-modern .mec-event-title,
						 body .mec-event-grid-novel .mec-event-content h4,
						 body .mec-yearly-view-wrap .mec-agenda-event-title,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title,
						 body .mec-calendar .mec-event-article.mec-single-event-novel,
						 body .mec-event-container-simple .mec-monthly-tooltip,
						 body .mec-timetable-t2-content .mec-event-title,
						 body .mec-timetable-event .mec-timetable-event-title,
						 body .mec-event-cover-clean .mec-event-title,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title,
						 body .mec-event-carousel-type2 .mec-event-carousel-title,
						 body .mec-event-carousel-type3 .mec-event-carousel-title,
						 body .mec-calendar-daily .mec-event-title,
						 body .mec-calendar-weekly .mec-event-title,
						 body .mec-timeline-main-content h4,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child' => 'text-align: {{VALUE}};',
					],
				]
			);
			// Style Tabs
			$this->start_controls_tabs( 'tabs_title_style' );
			$this->start_controls_tab(
				'tab_title_normal',
				[
					'label' => __( 'Normal', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'title_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-list-classic .mec-event-title a,
						 body .mec-event-list-standard .mec-event-title a,
						 body .mec-event-list-minimal .mec-event-title a,
						 body .mec-event-list-modern .mec-event-title a,
						 body .mec-event-list-standard .mec-event-title a,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title,
						 body .mec-event-grid-classic .mec-event-title a,
						 body .mec-event-grid-clean .mec-event-title a,
						 body .mec-event-grid-minimal .mec-event-title a,
						 body .mec-event-grid-modern .mec-event-title a,
						 body .mec-event-grid-simple .mec-event-title a,
						 body .mec-event-grid-modern .mec-event-title a,
						 body .mec-event-grid-novel .mec-event-content h4 a,
						 body .mec-agenda-event-title a,
						 body .mec-yearly-view-wrap .mec-agenda-event-title a,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title a,
						 body .mec-wrap .mec-calendar .mec-calendar-table .mec-single-event-novel h4.mec-event-title,
						 body .mec-event-container-simple .mec-monthly-tooltip h4,
						 body .mec-timetable-t2-content .mec-event-title a,
						 body .mec-timetable-event .mec-timetable-event-title a,
						 body .mec-event-cover-clean .mec-event-title a,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title a,
						 body .mec-event-carousel-type2 .mec-event-carousel-title a,
						 body .mec-event-carousel-type3 .mec-event-carousel-title a,
						 body .mec-calendar-daily .mec-event-title a,
						  body .mec-calendar-weekly .mec-event-title a,
						 body .mec-event-countdown-style2 .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-title,
						 body .mec-event-countdown-style3 .mec-event-title,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title a,
						 body .mec-timeline-main-content h4 a,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'title_text_shadow',
					'selector' =>
						'body .mec-event-list-classic .mec-event-title a,
						 body .mec-event-list-minimal .mec-event-title a,
						 body .mec-event-list-modern .mec-event-title a,
						 body .mec-event-list-standard .mec-event-title a,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title,
						 body .mec-event-grid-classic .mec-event-title a,
						 body .mec-event-grid-clean .mec-event-title a,
						 body .mec-event-grid-minimal .mec-event-title a,
						 body .mec-event-grid-modern .mec-event-title a,
						 body .mec-event-grid-simple .mec-event-title a,
						 body .mec-event-grid-modern .mec-event-title a,
						 body .mec-event-grid-novel .mec-event-content h4 a,
						 body .mec-agenda-event-title a,
						 body .mec-yearly-view-wrap .mec-agenda-event-title a,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title a,
						 body .mec-calendar .mec-event-article.mec-single-event-novel h4,
						 body .mec-event-container-simple .mec-monthly-tooltip h4,
						 body .mec-timetable-t2-content .mec-event-title a,
						 body .mec-timetable-event .mec-timetable-event-title a,
						 body .mec-event-cover-clean .mec-event-title a,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title a,
						 body .mec-event-carousel-type2 .mec-event-carousel-title a,
						 body .mec-event-carousel-type3 .mec-event-carousel-title a,
						 body .mec-calendar-daily .mec-event-title a,
						  body .mec-calendar-weekly .mec-event-title a,
						 body .mec-event-countdown-style2 .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-title,
						 body .mec-event-countdown-style3 .mec-event-title,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title a,
						 body .mec-timeline-main-content h4 a,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child'
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_title_hover',
				[
					'label' => __( 'Hover', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'title-hover_color',
				[
					'label' => __( 'Text Hover Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-list-classic .mec-event-title a:hover,
						 body .mec-event-list-standard .mec-event-title a:hover,
						 body .mec-event-list-minimal .mec-event-title a:hover,
						 body .mec-event-list-modern .mec-event-title a:hover,
						 body .mec-event-list-standard .mec-event-title a:hover,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title:hover,
						 body .mec-event-grid-classic .mec-event-title a:hover,
						 body .mec-event-grid-clean .mec-event-title a:hover,
						 body .mec-event-grid-minimal .mec-event-title a:hover,
						 body .mec-event-grid-modern .mec-event-title a:hover,
						 body .mec-event-grid-simple .mec-event-title a:hover,
						 body .mec-event-grid-modern .mec-event-title a:hover,
						 body .mec-event-grid-novel .mec-event-content h4 a:hover,
						 body .mec-agenda-event-title a:hover,
						 body .mec-yearly-view-wrap .mec-agenda-event-title a:hover,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title a:hover,
						 body .mec-wrap .mec-calendar .mec-calendar-table .mec-single-event-novel h4:hover,
						 body .mec-event-container-simple .mec-monthly-tooltip:hover h4,
						 body .mec-timetable-t2-content .mec-event-title a:hover,
						 body .mec-timetable-event .mec-timetable-event-title a:hover,
						 body .mec-event-cover-clean .mec-event-title a:hover,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title:hover,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title:hover,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming:hover,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming:hover,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming:hover,
						 body .mec-event-carousel-type1 .mec-event-carousel-title a:hover,
						 body .mec-event-carousel-type2 .mec-event-carousel-title a:hover,
						 body .mec-event-carousel-type3 .mec-event-carousel-title a:hover,
						 body .mec-calendar-daily .mec-event-title a:hover,
						 body .mec-calendar-weekly .mec-event-title a:hover,
						 body .mec-timeline-main-content h4 a:hover,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title a:hover,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs(); // End Tabs
			$this->add_responsive_control(
				'title_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-title,
						 body .mec-event-list-minimal .mec-event-title,
						 body .mec-event-list-modern .mec-event-title,
						 body .mec-event-list-standard .mec-event-title,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title,
						 body .mec-event-grid-classic .mec-event-title,
						 body .mec-event-grid-clean .mec-event-title,
						 body .mec-event-grid-minimal .mec-event-title,
						 body .mec-event-grid-modern .mec-event-title,
						 body .mec-event-grid-simple .mec-event-title,
						 body .mec-event-grid-modern .mec-event-title,
						 body .mec-event-grid-novel .mec-event-content h4,
						 body .mec-agenda-event-title,
						 body .mec-yearly-view-wrap .mec-agenda-event-title,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title,
						 body .mec-calendar .mec-event-article.mec-single-event-novel,
						 body .mec-event-container-simple .mec-monthly-tooltip,
						 body .mec-timetable-t2-content .mec-event-title,
						 body .mec-timetable-event .mec-timetable-event-title,
						 body .mec-event-cover-clean .mec-event-title,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title,
						 body .mec-event-carousel-type2 .mec-event-carousel-title,
						 body .mec-event-carousel-type3 .mec-event-carousel-title,
						 body .mec-calendar-daily .mec-event-title,
						 body .mec-calendar-weekly .mec-event-title,
						 body .mec-timeline-main-content h4,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-title,
						 body .mec-event-list-minimal .mec-event-title,
						 body .mec-event-list-modern .mec-event-title,
						 body .mec-event-list-standard .mec-event-title,
						 body .mec-events-toggle .mec-toogle-inner-month-divider .mec-toggle-title,
						 body .mec-event-grid-classic .mec-event-title,
						 body .mec-event-grid-clean .mec-event-title,
						 body .mec-event-grid-minimal .mec-event-title,
						 body .mec-event-grid-modern .mec-event-title,
						 body .mec-event-grid-simple .mec-event-title,
						 body .mec-event-grid-modern .mec-event-title,
						 body .mec-event-grid-novel .mec-event-content h4,
						 body .mec-agenda-event-title,
						 body .mec-yearly-view-wrap .mec-agenda-event-title,
						 body .mec-calendar-events-sec .mec-event-article .mec-event-title,
						 body .mec-calendar .mec-event-article.mec-single-event-novel,
						 body .mec-event-container-simple .mec-monthly-tooltip,
						 body .mec-timetable-t2-content .mec-event-title,
						 body .mec-timetable-event .mec-timetable-event-title,
						 body .mec-event-cover-clean .mec-event-title,
						 body .mec-event-cover-modern .mec-event-detail .mec-event-title,
						 body .mec-event-cover-classic .mec-event-content .mec-event-title,
						 body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-upcoming,
						 body .mec-event-carousel-type1 .mec-event-carousel-title,
						 body .mec-event-carousel-type2 .mec-event-carousel-title,
						 body .mec-event-carousel-type3 .mec-event-carousel-title,
						 body .mec-calendar-daily .mec-event-title
						 body .mec-calendar-weekly .mec-event-title,
						 body .mec-timeline-main-content h4,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-title,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-content span:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			// Subtitle
			$this->add_control(
				'count_down_subtitle_display',
				array(
					'label' 		=>  esc_html__( 'Subtitle Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'separator' => 'before',
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> 'block',
					'condition' => [
						'skin' =>[
							'countdown',
						],
					],
					'selector' => [
						'body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title' => 'display:{{VALUE}} !important;',
					],
				)
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'shortcode_subtitle_typo',
					'label' 	=> __( 'Subtitle Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
					'selector' 	=>
					'body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
					 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
					 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title',
				]
			);
			$this->add_responsive_control(
				'sub_title_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			// Style Subtitle Tabs
			$this->start_controls_tabs('tabs_sub_title_style');
			$this->start_controls_tab(
				'tab_sub_title_normal',
				[
					'label' => __( 'Normal', 'mec-shortcode-builder' ),
					'condition' => [
						'skin' => [
							'countdown'
						],
					],
				]
			);
			$this->add_control(
				'sub_title_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'subtitle_text_shadow',
					'selector' =>
					'body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
					 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
					 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title',
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_sub_title_hover',
				[
					'label' => __( 'Hover', 'mec-shortcode-builder' ),
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			$this->add_control(
				'sub_title-hover_color',
				[
					'label' => __( 'Text Hover Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title:hover,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title:hover,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title:hover' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs(); // End Tabs
			$this->add_responsive_control(
				'sub_title_padding',
				[
					'label' 		=> __( 'Subtitle padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			$this->add_responsive_control(
				'sub_title_margin',
				[
					'label' 		=> __( 'Subtitle margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-countdown-style1 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-event-countdown-style2 .mec-event-countdown-part1 .mec-event-title,
						 body .mec-event-countdown-style3 .mec-event-countdown-part1 .mec-event-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' =>[
							'countdown'
						],
					],
				]
			);
			// End sub
			$this->add_control(
				'title_bullet',
				[
					'label' 		=>  esc_html__( 'Title Bullet Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'separator' => 'before',
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'condition' => [
						'skin!' =>
						[
							'countdown',
							'carousel',
							'map',
						],
					],
					'selectors' => [
						'body .mec-wrap .event-color' => 'display:{{Value}}',
					],
				]
			);
			$this->add_responsive_control(
				'bullet_border_radius',
				[
					'label' 		=> __( 'Bullet Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .event-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin!' =>
						[
							'countdown',
							'carousel',
							'map',
						],
						'title_bullet[return_value]!' => 'none',
					],
				]
			);
			$this->add_responsive_control(
			'bullet_width',
				[
					'label' => __( 'Bullet width', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'body .mec-wrap .event-color' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin!' =>
						[
							'countdown',
							'carousel',
							'map',
						],
						'title_bullet[return_value]!' => 'none',
					],
				]
			);
			$this->add_responsive_control(
				'bullet_height',
				[
					'label' => __( 'Bullet height', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'body .mec-wrap .event-color' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin!' =>
						[
							'countdown',
							'carousel',
							'map',
						],
						'title_bullet[return_value]!' => 'none',
					],
				]
			);
			$this->add_control(
				'title_tag',
				[
					'label' 		=>  esc_html__( 'Soldout Tag Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'separator' => 'before',
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body span.mec-event-title-soldout' => 'display:{{Value}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'the_tag_border',
					'label' => __( 'Soldout Border', 'mec-shortcode-builder' ),
					'selector' => 'body span.mec-event-title-soldout'
				]
			);
			$this->add_responsive_control(
				'title_tag_border_radius',
				[
					'label' 		=> __( 'Soldout Tag Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body span.mec-event-title-soldout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'the_tag_typo',
					'label' 	=> __( 'Soldout Tag Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=> 'body span.mec-event-title-soldout',
				]
			);
			$this->add_responsive_control(
				'the_tag__padding',
				[
					'label' 		=> __( 'Soldout Tag Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body span.mec-event-title-soldout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'the_tag_color',
				[
					'label' => __( 'Soldout Tag Color', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [
						'body span.mec-event-title-soldout' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'the_tag_bg_color',
				[
					'label' => __( 'Soldout Tag Background Color', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [
						'body span.mec-event-title-soldout' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'location_typography',
					'label' 	=> __( 'Location Typography', 'mec-shortcode-builder' ),
					'separator' => 'before',
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-location,
						 body .mec-venue-details span,
						 body .mec-event-grid-simple .mec-event-detail,
						 body .mec-daily-view-date-events .mec-event-detail,
						 body .mec-calendar-table .mec-event-detail,
						 body .mec-calendar-side .mec-event-detail,
						 body .mec-event-detail .mec-event-loc-place,
						 body .mec-timetable-event-location span,
						 body .mec-event-loction span,
						 body .mec-weekly-view-dates-events .mec-event-detail
						 ',
				]
			);
			$this->add_control(
				'location_color',
				[
					'label' => __( 'Location Color', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [
						'body .mec-location,
						 body .mec-venue-details span,
						 body .mec-event-grid-simple .mec-event-detail,
						 body .mec-daily-view-date-events .mec-event-detail,
						 body .mec-calendar-table .mec-event-detail,
						 body .mec-calendar-side .mec-event-detail,
						 body .mec-event-detail .mec-event-loc-place,
						 body .mec-timetable-event-location span,
						 body .mec-event-loction span,
						 body .mec-weekly-view-dates-events .mec-event-detail
						 ' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_section();
			// End Typo style

			// Excerpt Style
			$this->start_controls_section(
				'excerpt_standard_style',
				[
					'label' => __( 'Excerpt Style List View (Standard)', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'excerpt_standard_typography',
					'label' 	=> __( 'Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-event-article .mec-event-content .mec-event-description' ,
				]
			);
			$this->add_responsive_control(
				'excerpt_standard_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'excerpt_full_standard_style',
				[
					'label' => __( 'Excerpt Style Full Calendar View (Standard)', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'full_calendar',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'excerpt_full_standard_typography',
					'label' 	=> __( 'Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'.mec-event-article .mec-event-content .mec-event-description' ,
				]
			);
			$this->add_responsive_control(
				'excerpt_full_standard_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'excerpt_slider_style',
				[
					'label' => __( 'Excerpt Style Slider View (Type 5)', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'slider_style' =>
						[
							't5',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'excerpt_slider_typography',
					'label' 	=> __( 'Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-event-grid-modern .mec-event-content p',
				]
			);
			$this->add_responsive_control(
				'excerpt_slider_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-grid-modern .mec-event-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			// End Excerpt style

			// Excerpt Style
			$this->start_controls_section(
				'excerpt_timeline_style',
				[
					'label' => __( 'Excerpt Style Timeline  View', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'timeline',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'excerpt_timeline_typography',
					'label' 	=> __( 'Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-timeline-main-content p',
				]
			);
			$this->add_responsive_control(
				'excerpt_timeline_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-timeline-main-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			// Start Date Style
			$this->start_controls_section(
				'date_style',
				[
					'label' => __( 'Date Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'list_style!' =>
						[
							'modern',
						],
					],
				]
			);
			$this->add_control(
				'date_display',
				[
					'label' 		=>  esc_html__( 'Date Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 		=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-list-classic .mec-event-date,
						 body .mec-event-grid-novel .mec-event-detail,
						 body .mec-event-list-minimal .mec-event-date,
						 body .mec-event-list-standard .mec-date-details,
						 body .mec-toogle-inner-month-divider .mec-toggle-item-col .mec-event-month,
						 body .mec-event-grid-classic .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-yearly-view-wrap .mec-agenda-date-wrap .mec-agenda-date,
						 body .mec-event-grid-clean .event-grid-t2-head,
						 body .mec-event-grid-minimal .mec-event-date,
						 body .mec-event-grid-simple .mec-event-date,
						 body .mec-calendar .mec-calendar-header,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date,
						 body .mec-event-cover-clean .mec-event-date,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-event-tile-view article.mec-tile-item .event-tile-view-head,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-time,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info' => 'display:{{VALUE}} !important;',
					],
					'condition' => [
						'skin!' => [
							'map'
						],
					],
				]
			);
			$this->add_control(
				'date_number_grd_display',
				[
					'label' 		=>  esc_html__( 'Date Number Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 		=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-grid-minimal .mec-event-date span,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-event-cover-clean .mec-event-date .dday,
						 body .mec-event-countdown-style3 .mec-event-date .mec-date1,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-date,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count' => 'display:{{VALUE}} !important;',
					],
					'condition' => [
						'skin' =>
						[
							'daily_view',
							'cover',
							'available_spot',
							'map',
						],
						'grid_style' =>
						[
							'minimal'
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'shortcode_date_number_typo',
					'separator' => 'before',
					'label' 	=> __( 'Date Number Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-event-grid-minimal .mec-event-date span,
					 body .mec-wrap .mec-start-date-label span,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
					 body .mec-event-cover-clean .mec-event-date .dday,
					 body .mec-event-countdown-style3 .mec-event-date .mec-date1,
					 body .mec-event-grid-modern .event-grid-modern-head .mec-event-date,
					 body .event-carousel-type1-head .mec-event-date-carousel,
					 body .mec-skin-timeline-container .mec-timeline-event-date,
					 body .mec-marker-infowindow-wp .mec-marker-infowindow-count,
					.event-carousel-type2-head .mec-event-carousel-content-type2 .mec-event-date-info .mec-start-date-label',
					'condition' => [
						'skin' =>
						[
							'grid',
							'daily_view',
							'cover',
							'available_spot',
							'carousel',
							'map',
						],
					],
				]
			);
			$this->add_control(
				'mec_date_number_color',
				[
					'label' => __( 'Date Number Color', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [
						'body .mec-event-grid-minimal .mec-event-date span,
						body .mec-wrap .mec-start-date-label span,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-event-cover-clean .mec-event-date .dday,
						 body .mec-event-countdown-style3 .mec-event-date .mec-date1,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count,
						 .event-carousel-type2-head .mec-event-carousel-content-type2 .mec-event-date-info .mec-start-date-label' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' =>
						[
							'grid',
							'daily_view',
							'cover',
							'available_spot',
							'carousel',
							'map',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'mec_date_number_bg_color',
					'label' => __( 'Date Number Background', 'mec-shortcode-builder' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' =>
					'body .mec-event-grid-minimal .mec-event-date span,
					 body .mec-wrap .mec-start-date-label span,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
					 body .mec-event-cover-clean .mec-event-date .dday,
					 body .mec-event-grid-modern .event-grid-modern-head .mec-event-date,
					 body .mec-marker-infowindow-wp .mec-marker-infowindow-count,
					 body .mec-skin-timeline-container .mec-timeline-event-date,
					 {{WRAPPER}} .event-carousel-type1-head .mec-event-date-carousel,
					 body .mec-wrap.colorskin-custom .mec-event-list-minimal .mec-event-date.mec-bg-color,
					 body .mec-wrap .mec-event-list-minimal .mec-event-article .mec-event-date,
					 body .mec-event-grid-classic .mec-event-date,
					.event-carousel-type2-head .mec-event-carousel-content-type2 .mec-event-date-info .mec-start-date-label',
					'condition' => [
						'skin' =>
						[
							'grid',
							'daily_view',
							'cover',
							'carousel',
							'available_spot',
							'map',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'shortcode_date_typo',
					'label' 	=> __( 'Date Typography', 'mec-shortcode-builder' ),
					'separator' => 'before',
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-event-list-classic .mec-event-date span,
					 body .mec-event-grid-novel .mec-event-detail,
					 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month span,
					 body .mec-event-list-minimal .mec-event-date,
					 body .mec-event-list-minimal .mec-event-date span,
					 body .mec-event-list-standard .mec-event-meta span.mec-event-d,
					 body .mec-toggle-item-col .mec-event-month,
					 body .mec-event-grid-classic .mec-event-date,
					 body .mec-events-agenda-wrap .mec-agenda-date,
					 body .mec-yearly-view-wrap .mec-agenda-date-wrap .mec-agenda-date,
					 body .mec-event-list-standard .mec-event-meta .mec-event-d span,
					 body .mec-event-grid-clean .event-grid-t2-head .mec-event-month,
					 body .mec-event-grid-minimal .mec-event-date,
					 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
					 body .mec-event-grid-simple .mec-event-date,
					 body .mec-event-grid-novel .mec-event-month span,
					 body .mec-calendar .mec-calendar-header h2,
					 body .mec-skin-timeline-container .mec-timeline-event-date,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
					 body .mec-event-cover-classic .mec-event-date span,
					 body .mec-event-cover-clean .mec-event-date .dmonth,
					 body .mec-event-cover-clean .mec-event-date .dyear,
					 body .mec-event-cover-modern .mec-event-date,
					 body .mec-event-countdown-style3 .mec-event-date,
					 body .mec-event-countdown-style2 .mec-event-date,
					 body .mec-event-countdown-style1 .mec-event-date,
					 body .event-carousel-type1-head .mec-event-date-info,
					 body .event-carousel-type1-head .mec-event-date-info-year,
					 body .event-carousel-type2-head .mec-event-date-info,
					 body .mec-event-footer-carousel-type3 .mec-event-date-info span,
					 body .mec-event-tile-view article.mec-tile-item .event-tile-view-head,
					 body .mec-event-tile-view article.mec-tile-item .mec-event-time,
					 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
					 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
					 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
					 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
					 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month,
					 .event-carousel-type2-head .mec-event-carousel-content-type2 .mec-event-date-info .mec-start-date-label',
					'conditions' => [
						'terms' => [
							[
								'name' => 'skin',
								'operator' => '!in',
								'value' => [
									'map',
								],
							],
						],
					],
				]
			);
			$this->add_control(
				'mec_date_color',
				[
					'label' => __( 'Date Color', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-list-classic .mec-start-date-label,
						body .mec-event-list-classic .mec-end-date-label,
						 body .mec-event-grid-novel .mec-event-detail,
						 body .mec-event-list-minimal .mec-event-date,
						 body .mec-toggle-item-col .mec-event-month,
						 body .mec-event-grid-classic .mec-event-date,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month span,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-yearly-view-wrap .mec-agenda-date-wrap .mec-agenda-date,
						 body .mec-event-list-standard .mec-event-meta .mec-event-d,
						 body .mec-event-grid-clean .event-grid-t2-head .mec-event-month,
						 body .mec-event-grid-minimal .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-event-tile-view article.mec-tile-item .mec-event-time,
						 body .mec-event-grid-simple .mec-event-date span,
						 body .mec-event-grid-novel .mec-event-month span,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date span,
						 body .mec-event-cover-clean .mec-event-date .dmonth,
						 body .mec-event-cover-clean .mec-event-date .dyear,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-info,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .event-carousel-type1-head .mec-event-date-info-year,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info span,
						 body .mec-event-tile-view article.mec-tile-item .event-tile-view-head,
						 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month' => 'color: {{VALUE}}',
					],
					'conditions' => [
						'terms' => [
							[
								'name' => 'skin',
								'operator' => '!in',
								'value' => [
									'map',
								],
							],
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'mec_date_bg_color',
					'label' => __( 'Date Background', 'mec-shortcode-builder' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' =>
					'body .mec-event-list-classic .mec-start-date-label,
					 body .mec-event-list-classic .mec-end-date-label,
					 body .mec-event-grid-classic .mec-event-article .mec-event-content .mec-event-date.mec-bg-color,
					 body .mec-date-details,
					 body .mec-wrap .mec-event-date-carousel,
					 body .mec-masonry-item-wrap .mec-event-grid-modern .event-grid-modern-head,
					 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month,
					 body .mec-event-grid-novel .mec-event-month,
					 body .mec-events-agenda-wrap .mec-agenda-date,
					 body .mec-yearly-calendar .mec-agenda-date
					 body .mec-event-list-accordion .mec-toggle-item-col .mec-event-month,
					 body .event-grid-t2-head,
					 body .mec-toogle-inner-month-divider .mec-toggle-item-col .mec-event-month,
					 body .mec-event-grid-minimal .mec-event-date,
					 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month,
					 body .mec-event-grid-simple .mec-event-date,
					 body .mec-calendar .mec-calendar-header h2,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
					 body .mec-event-cover-classic .mec-event-date span,
					 body .mec-event-cover-clean .mec-event-date,
					 body .mec-event-cover-modern .mec-event-date,
					 body .mec-event-countdown-style3 .mec-event-date,
					 body .mec-event-countdown-style2 .mec-event-date,
					 body .mec-event-countdown-style1 .mec-event-date,
					 body .mec-skin-timeline-container .mec-timeline-event-date,
					 body .event-carousel-type2-head .mec-event-date-info,
					 {{WRAPPER}} .mec-event-list-minimal .mec-event-date.mec-bg-color,
					 body .mec-wrap .mec-event-list-minimal .mec-event-article .mec-event-date,
					 body .mec-wrap.colorskin-custom .mec-event-list-minimal .mec-event-date.mec-bg-color,
					 body .mec-event-footer-carousel-type3 .mec-event-date-info,
					 .event-carousel-type2-head .mec-event-carousel-content-type2 .mec-event-date-info .mec-start-date-label',
					'condition' => [
						'skin!' =>
						[
							'countdown',
							'carousel',
							'map',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'date_ing3_background_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel' => 'background-color: {{VALUE}};','body .mec-event-countdown-style3 .mec-event-date:after, body .event-carousel-type1-head .mec-event-date-carousel:after' => 'border-bottom-color: {{VALUE}};'
					],
					'condition' => [
						'ing' =>
							'style3',
							'carousel_style' => 'type1',
					],
				]
			);
			$this->add_responsive_control(
				'date_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'left',
					'toggle' => true,
					'selectors' => [
						'body .mec-wrap .mec-event-date,
						 body .mec-agenda-date,
						 body .mec-wrap .mec-event-date,
						 body .mec-toogle-inner-month-divider .mec-toggle-item-col,
						 body .mec-agenda-date-wrap,
						 body .mec-date-details,
						 body .mec-calendar-weekly .mec-event-list-weekly-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .mec-wrap .mec-start-date-label,
						 body .mec-masonry-item-wrap .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-event-grid-classic .mec-event-date,
						 body .mec-event-grid-novel .mec-event-month,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-event-grid-clean .event-grid-t2-head,
						 body .mec-event-grid-minimal .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
						 body .mec-event-grid-simple .mec-event-date,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date,
						 body .mec-event-cover-clean .mec-event-date,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info,
						 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month,
						 body  .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count' => 'text-align: {{VALUE}};'
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'date_bg_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>
						'body .mec-event-list-classic .mec-event-date span,
						 body .mec-event-grid-clean .event-grid-t2-head,
						 body .mec-date-details,
						 body .mec-calendar-weekly .mec-event-list-weekly-date,
						 body .mec-event-date-carousel,
						 body .mec-masonry-item-wrap .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-event-list-minimal .mec-event-date,
						 body .mec-event-grid-classic .mec-event-date,
						 body .mec-event-grid-novel .mec-event-month,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-event-grid-minimal .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
						 body .mec-event-grid-simple .mec-event-date,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date span,
						 body .mec-event-cover-clean .mec-event-date,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info,
						 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count'
				]
			);
			$this->add_responsive_control(
				'date_bg_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-date span,
						 body .mec-event-grid-clean .event-grid-t2-head,
						 body .mec-date-details,
						 body .mec-calendar-weekly .mec-event-list-weekly-date,
						 body .mec-event-date-carousel,
						 body .mec-wrap .mec-event-date,
						 body .mec-masonry-item-wrap .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-event-grid-classic .mec-event-date,
						 body .mec-event-grid-novel .mec-event-month,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-event-grid-minimal .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
						 body .mec-event-grid-simple .mec-event-date,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date span,
						 body .mec-event-cover-clean .mec-event-date,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info,
						 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->add_responsive_control(
				'date_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-agenda-date,
						 body .mec-event-month,
						 body .mec-date-details,
						 body .mec-calendar-weekly .mec-event-list-weekly-date,
						 body .mec-event-date-carousel,
						 body .mec-masonry-item-wrap .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-wrap .mec-event-date,
						 body .mec-event-grid-classic .mec-event-date span,
						 body .mec-event-grid-novel .mec-event-month,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
						 body .mec-event-grid-simple .mec-event-date span,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date span,
						 body .mec-event-cover-clean .mec-event-date,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info,
						 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'date_margin',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-agenda-date,
						 body .mec-event-month,
						 body .mec-date-details,
						 body .mec-calendar-weekly .mec-event-list-weekly-date,
						 body .mec-event-date-carousel,
						 body .mec-wrap .mec-start-date-label,
						 body .mec-masonry-item-wrap .mec-event-grid-modern .event-grid-modern-head,
						 body .mec-wrap .mec-event-date,
						 body .mec-event-grid-classic .mec-event-date,
						 body .mec-event-grid-novel .mec-event-month,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-month,
						 body .mec-events-agenda-wrap .mec-agenda-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-month span,
						 body .mec-event-grid-simple .mec-event-date span,
						 body .mec-calendar .mec-calendar-header h2,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month h4,
						 body .mec-event-cover-classic .mec-event-date span,
						 body .mec-event-cover-clean .mec-event-date,
						 body .mec-event-cover-modern .mec-event-date,
						 body .mec-event-countdown-style3 .mec-event-date,
						 body .mec-event-countdown-style2 .mec-event-date,
						 body .mec-event-countdown-style1 .mec-event-date,
						 body .event-carousel-type1-head .mec-event-date-carousel,
						 body .event-carousel-type2-head .mec-event-date-info,
						 body .mec-event-footer-carousel-type3 .mec-event-date-info,
						 body .mec-slider-t5 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t4 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t3 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t2 .mec-event-grid-modern .mec-event-month,
						 body .mec-slider-t1 .mec-event-grid-modern .mec-event-month,
						 body .mec-skin-timeline-container .mec-timeline-event-date,
						 body .mec-marker-infowindow-wp .mec-marker-infowindow-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'date_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-event-date i.mec-sl-calendar,
						 body .mec-event-grid-novel .mec-event-month::before,
						 body .mec-wrap .mec-sl-calendar,
						 body .mec-sl-calendar,
						 body .mec-event-list-standard .mec-date-details:before,
						 body .mec-event-grid-novel .mec-event-month::before,
						 body .mec-skin-list-container .mec-wrap .mec-event-meta-wrap .mec-date-details:before,
						 body .mec-event-cover-classic .mec-event-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
						'list',
						'cover',
						'grid',
						],
					],
				]
			);
			$this->add_control(
				'date_icon_color',
				[
					'label' 		=> __( 'Icon color (leave blank for default color)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-event-date i.mec-sl-calendar,
						 body .mec-event-grid-novel .mec-event-month::before,
						 body .mec-wrap .mec-sl-calendar,
						 body .mec-sl-calendar,
						 body .mec-event-list-standard .mec-date-details:before,
						 body .mec-event-grid-novel .mec-event-month::before,
						 body .mec-skin-list-container .mec-wrap .mec-event-meta-wrap .mec-date-details:before,
						 body .mec-event-cover-classic .mec-event-icon' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' => [
						'list',
						'cover',
						'grid',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'mec_date_icon_bg_color',
					'label' => __( 'Icon Background', 'mec-shortcode-builder' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' =>
						'body .mec-event-cover-classic .mec-event-icon,
						 body .mec-event-list-standard .mec-date-details:before,
						 body .mec-event-list-classic .mec-event-date i.mec-sl-calendar',
					'condition' => [
						'skin' => [
						'list',
						'cover',
						'grid',
						],
					],
				]
			);
			$this->add_responsive_control(
				'date_icon_padding',
				[
					'label' 		=> __( 'Icon padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-sl-calendar:before,
						 body .mec-event-list-standard .mec-date-details:before,
						 body .mec-event-grid-novel .mec-event-month::before,
						 body .mec-event-cover-classic .mec-event-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
						'list',
						'cover',
						'grid',
						],
					],
				]
			);
			$this->add_responsive_control(
				'date_icon_margin',
				[
					'label' 		=> __( 'Icon margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-sl-calendar:before,
						 body .mec-event-list-standard .mec-date-details:before,
						 body .mec-event-grid-novel .mec-event-month::before,
						 body .mec-event-cover-classic .mec-event-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
						'list',
						'cover',
						'grid',
						],
					],
				]
			);
			$this->end_controls_section();
			// End Date Style

			// Start Spot
			$this->start_controls_section(
				'spot_style',
				[
					'label' => __( 'Spot Style For Available Spot', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'available_spot',
						],
					],
				]
			);
			$this->add_control(
				'spot_display',
				[
					'label' 		=>  esc_html__( 'Spots Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box' => 'display:{{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'spot_title_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'spot_typo',
					'label' 	=> __( 'Spot Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box span',
				]
			);
			$this->add_control(
				'spot_title_color',
				[
					'label' 		=> __( 'Title color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'spot_color',
				[
					'label' 		=> __( 'Spot Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box span' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'spot_bg_color',
				[
					'label' 		=> __( 'Spot Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'spot_box_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'spot_box_margin',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'spot_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>  'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box',
				]
			);
			$this->add_responsive_control(
				'spot_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-av-spot .mec-av-spot-head .mec-av-spot-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->end_controls_section();
			// End Spot

			// Start Countdown
			$this->start_controls_section(
				'countdown_style_for_available_spot',
				[
					'label' => __( 'Countdown Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'available_spot',
						],
					],
				]
			);
			$this->add_control(
				'countdown_display',
				[
					'label' 		=>  esc_html__( 'Spots Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown' => 'display:{{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'countdown_number_typo',
					'label' 	=> __( 'Number Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown li span',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'countdown_label_typo',
					'label' 	=> __( 'Label Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown p',
				]
			);
			$this->add_control(
				'countdown_title_color',
				[
					'label' 		=> __( 'Number color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown li span' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'countdown_color',
				[
					'label' 		=> __( 'Label Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown p' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'countdown_bg_color',
				[
					'label' 		=> __( 'Countdown Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'countdown_box_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'countdown_box_margin',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'countdown_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>  'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown',
				]
			);
			$this->add_responsive_control(
				'countdown_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap  .mec-av-spot .mec-av-spot-head .mec-event-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->end_controls_section();
			// End Countdown

			// Start Date Modern Style
			$this->start_controls_section(
				'list_modern_date_style',
				[
					'label' => __( 'List Modern Date Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'list_style' =>
						[
							'modern',
						],
					],
				]
			);
			$this->add_control(
				'list_modern_date_displaing',
				[
					'label' 		=>  esc_html__( 'Date Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-wrap .mec-event-date .event-d,
						 body .mec-wrap .mec-event-date .event-f' => 'display:{{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'list_modern_date_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-wrap .mec-event-date .event-f',
				]
			);
			$this->add_control(
				'list_modern_date_color',
				[
					'label' 		=> __( 'Date color (leave blank for default color)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap .mec-event-date .event-f' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'list_modern_date_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-event-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'list_modern_date_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-event-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'list_modern_date_num_size',
				[
					'label' 		=> __( 'Date Number Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-event-list-modern .mec-event-date .event-d' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'list_modern_date_num_color',
				[
					'label' 		=> __( 'Date Number color (leave blank for default color)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-event-list-modern .mec-event-date .event-d' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'list_modern_date_num_indent',
				[
					'label' => __( 'Date Number Spacing', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'body .mec-event-list-modern .mec-event-date .event-d' => 'padding-left: {{SIZE}}{{UNIT}};',
						'body .mec-event-list-modern .mec-event-date .event-d' => 'padding-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			// End Date Modern Style

			// Start Date Modern Style
			$this->start_controls_section(
				'monthly_modern_date_style',
				[
					'label' => __( 'Monthly Modern Date Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'monthly_style' =>
						[
							'modern',
						],
					],
				]
			);
			$this->add_control(
				'monthly_modern_date_display',
				[
					'label' 		=>  esc_html__( 'Date Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-title' => 'display:{{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'monthly_modern_date_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
					 body .mec-calendar-events-sec .mec-table-side-title',
				]
			);
			$this->add_control(
				'monthly_modern_date_color',
				[
					'label' 		=> __( 'Date color (leave blank for default color)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'monthly_modern_date_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-title' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'monthly_modern_date_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'monthly_modern_date_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'monthly_modern_date_num_size',
				[
					'label' 		=> __( 'Date Number Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-day' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'monthly_modern_date_num_color',
				[
					'label' 		=> __( 'Date Number color (leave blank for default color)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-day' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'monthly_modern_date_num_indent',
				[
					'label' => __( 'Date Number Spacing', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h2,
						 body .mec-calendar-events-sec .mec-table-side-day' => 'padding-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'monthly_modern_date_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>  'body .mec-box-calendar.mec-calendar .mec-calendar-events-side .mec-table-side-day',
				]
			);
			$this->add_responsive_control(
				'monthly_modern_date_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-box-calendar.mec-calendar .mec-calendar-events-side .mec-table-side-day' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->end_controls_section();
			// End Date Modern Style

			// Weekday Style for All Skin (unless list and grid)
			$this->start_controls_section(
				'mec_list_weekdays_styles',
				[
					'label' => __( 'Weekdays Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'list_style' =>
						[
							'modern',
							'minimal',
						],
					],
				]
			);
			$this->add_control(
				'mec_list_week_day_display',
				[
					'label' 		=>  esc_html__( 'Weekday Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > Minimal and Modern - Yearly Style > Modern - TimeTable Style > Modern and Clean - Grid Style > Clean and Colorful', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-date .event-da' => 'display:{{VALUE}} !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'mec_list_shortcode_weekday_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-list-modern .mec-event-date .event-da',
				]
			);
			$this->add_responsive_control(
				'mec_list_weekday_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-date .event-da' => 'text-align: {{VALUE}};',
					],
				]
			);
			//fullcalendar Weekly View
			$this->add_control(
				'mec_list_weekday_background_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-list-modern .mec-event-date .event-da' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'mec_list_weekday_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-date .event-da' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'mec_list_weekday_shadow',
					'selector' =>
					'body .mec-event-list-minimal .mec-event-detail,
					 body .mec-event-date .event-da'
				]
			);
			$this->add_responsive_control(
				'mec_list_weekday_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-date .event-da' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'mec_list_weekday_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-detail,
						 body .mec-event-date .event-da' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			// Weekday Style for All Skins
			$this->start_controls_section(
				'mec_all_skin_weekdays_styles',
				[
					'label' => __( 'Weekdays Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'agenda',
							'full_calendar',
							'yearly_view',
							'monthly_view',
							'daily_view',
							'weekly_view',
							'timetable',
							'cover',
							'slider',
						],
					],
				]
			);
			$this->add_control(
				'mec_all_skin_week_day_display',
				[
					'label' 		=>  esc_html__( 'Weekday Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > Minimal and Modern - Yearly Style > Modern - TimeTable Style > Modern and Clean - Grid Style > Clean and Colorful', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-day,
						 body .mec-agenda-day,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body mec-calendar-table-head,
						 body .mec-calendar-day,
						 body .mec-calendar.mec-calendar-weekly .mec-calendar-d-table dl dt,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date' => 'display:{{VALUE}} !important;',
					],
					'condition' => [
						'skin!' =>
						[
							'yearly_view',
							'monthly_view',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'mec_all_skin_shortcode_weekday_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-event-day,
						 body .mec-agenda-day,
						 body .mec-weekly-view-weekday,
						 body .mec-weekly-view-monthday,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body .mec-calendar-table-head dt,
						 body .mec-calendar-day,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date',
				]
			);
			$this->add_responsive_control(
				'mec_all_skin_weekday_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-event-date .event-da,
						 body .mec-event-day,
						 body .mec-agenda-day,
						 body .mec-weekly-disabled,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body .mec-calendar-table-head dt,
						 body .mec-calendar-day,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-day' => 'text-align: {{VALUE}};',
					],
				]
			);
			//fullcalendar Weekly View
			$this->add_control(
				'mec_all_skin_weekday_background_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-weekly-disabled,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body .mec-calendar-table-head dt,
						 body .mec-calendar-day,
						 body .mec-calendar.mec-calendar-weekly .mec-calendar-d-table dl dt,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-day,
						 body .mec-event-list-modern .mec-event-date .event-da' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'mec_all_skin_weekday_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-date .event-da,
						 body .mec-event-day,
						 body .mec-agenda-day,
						 body .mec-weekly-disabled,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body .mec-calendar-table-head dt,
						 body .mec-calendar-day,
						 body .mec-calendar.mec-calendar-weekly .mec-calendar-d-table dl dt,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'mec_all_skin_weekday_shadow',
					'selector' =>
					'body .mec-event-date .event-da,
					 body .mec-event-day,
					 body .mec-agenda-day,
					 body .mec-weekly-disabled,
					 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
					 body .mec-calendar-table-head dt,
					 body .mec-calendar-day,
					 body .mec-calendar.mec-calendar-weekly .mec-calendar-d-table dl dt,
					 body .mec-ttt2-title, body .mec-event-cover-classic .mec-event-date,
					 body .mec-event-grid-modern .event-grid-modern-head .mec-event-day'
				]
			);
			$this->add_responsive_control(
				'mec_all_skin_weekday_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-date .event-da,
						 body .mec-event-day,
						 body .mec-agenda-day,
						 body .mec-weekly-disabled,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body .mec-calendar-table-head dt,
						 body .mec-calendar-day,
						 body .mec-calendar.mec-calendar-weekly .mec-calendar-d-table dl dt,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'mec_all_skin_weekday_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-date .event-da,
						 body .mec-event-day,
						 body .mec-agenda-day,
						 body .mec-weekly-disabled,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-d-top h3,
						 body .mec-calendar-table-head dt,
						 body .mec-calendar-day,
						 body .mec-calendar.mec-calendar-weekly .mec-calendar-d-table dl dt,
						 body .mec-ttt2-title,
						 body .mec-event-cover-classic .mec-event-date,
						 body .mec-event-grid-modern .event-grid-modern-head .mec-event-day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			// Weekday Style for Grid view
			$this->start_controls_section(
				'mec_grid_style_weekdays_styles',
				[
					'label' => __( 'Weekdays Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'grid_style' =>
						[
							'modern',
							'colorful',
						],
					],
				]
			);
			$this->add_control(
				'mec_grid_style_week_day_display',
				[
					'label' 		=>  esc_html__( 'Weekday Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > Minimal and Modern - Yearly Style > Modern - TimeTable Style > Modern and Clean - Grid Style > Clean and Colorful', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-day' => 'display:{{VALUE}} !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'mec_grid_style_shortcode_weekday_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-event-day',
				]
			);
			$this->add_responsive_control(
				'mec_grid_style_weekday_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-event-day' => 'text-align: {{VALUE}};',
					],
				]
			);
			//fullcalendar Weekly View
			$this->add_control(
				'mec_grid_style_weekday_background_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-day' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'mec_grid_style_weekday_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-day' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'mec_grid_style_weekday_shadow',
					'selector' =>
						'body .mec-event-day'
				]
			);
			$this->add_responsive_control(
				'mec_grid_style_weekday_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'mec_grid_style_weekday_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			// Time Display
			$this->start_controls_section(
				'time_style',
				[
					'label' => __( 'Time Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'list',
							'daily_view',
							'agenda',
							'full_calendar',
							'yearly_view',
							'timetable',
							'countdown',
							'monthly_view'
						],
					],
				]
			);
			$this->add_control(
				'time_display',
				[
					'label' 		=>  esc_html__( 'Time Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > Standard and Accordion - Agenda Style > Clean - TimeTable Style > Modern and Clean - Grid Style > Novel - Countdown', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time .mec-start-time,
						 body .mec-agenda-time .mec-end-time,
						 body .mec-time-details,
						 body .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,
						 body .mec-toggle-item-col .mec-event-detail,
						 body .mec-event-time,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time,
						 .mec-event-countdown .clockdiv
						 ' => 'display:{{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'time_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail::before,
						 body .mec-agenda-event i,
						 body .mec-event-list-standard .mec-color-before .mec-time-details:before,
						 body .mec-sl-clock-o:before,
						 body .mec-timetable-events-list .mec-timetable-event i,
						 body .mec-timetable-t2-content i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' =>
						[
							'list',
							'grid',
							'daily_view',
							'agenda',
							'monthly_view',
							'timetable',
						],
					],
				]
			);
			$this->add_control(
				'time_icon_color',
				[
					'label' 		=> __( 'Icon color (leave blank for default color)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-event-grid-novel .mec-event-detail::before,
						 body .mec-agenda-event i,
						 body .mec-event-list-standard .mec-color-before .mec-time-details:before,
						 body .mec-sl-clock-o:before,
						 body .mec-timetable-events-list .mec-timetable-event i,
						 body .mec-timetable-t2-content i' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' =>
						[
							'list',
							'grid',
							'daily_view',
							'agenda',
							'monthly_view',
							'timetable',
						],
					],
				]
			);
			$this->add_control(
				'time_icon_indent',
				[
					'label' => __( 'Icon Spacing', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail::before,
						 body .mec-agenda-event i,
						 body .mec-event-list-standard .mec-color-before .mec-time-details:before,
						 body .mec-sl-clock-o:before,
						 body .mec-timetable-events-list .mec-timetable-event i' => 'margin-left: {{SIZE}}{{UNIT}};',
						'body .mec-event-grid-novel .mec-event-detail::before,
						 body .mec-agenda-event i,
						 body .mec-time-details:before,
						 body .mec-timetable-events-list .mec-timetable-event i,
						 body .mec-timetable-t2-content i' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' =>
						[
							'list',
							'grid',
							'daily_view',
							'agenda',
							'monthly_view',
							'timetable',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'shortcode_time_number_typo',
					'label' 	=> __( 'Number Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-event-countdown li span,
					 body .mec-toggle-item-col .mec-event-detail,
					 body .mec-event-article .mec-time-details,
					 body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown li span,
					 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown li span,
					 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown li span',
					'condition' => [
						'skin' => [
							'countdown',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'shortcode_time_typo',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time .mec-start-time,
						 body .mec-agenda-time .mec-end-time,
						 body .mec-event-list-standard .mec-time-details,
						 body .mec-event-article .mec-time-details,
						 body .mec-event-article .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,.mec-event-countdown li .label-w,
						 body .mec-event-time span,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time span,
						 body .mec-wrap .mec-event-countdown-style1 .mec-event-countdown li .lable-w,
						 body .mec-wrap .mec-event-countdown-style2 .mec-event-countdown li .lable-w,
						 body .mec-wrap .mec-event-countdown-style3 .mec-event-countdown li .lable-w,
						 body .mec-wrap .mec-event-countdown li p',
				]
			);
			$this->add_responsive_control(
				'time_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time,
						 body .mec-event-list-standard .mec-time-details,
						 body .mec-event-article .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,
						 body .mec-event-countdown li,
						 body .mec-toggle-item-col .mec-event-detail,
						 body .mec-event-time,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'time_number_color',
				[
					'label' => __( 'Number Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap  .mec-event-countdown li span,
						.mec-wrap .mec-event-countdown-style1 .mec-event-countdown li span,
						.mec-wrap .mec-event-countdown-style2 .mec-event-countdown li span,
						.mec-wrap .mec-event-countdown-style3 .mec-event-countdown li span' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' => [
							'countdown',
						],
					],
				]
			);
			$this->add_control(
				'time_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time,
						 body .mec-event-list-standard .mec-time-details,
						 body .mec-event-article .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,
						 body .mec-event-countdown li .label-w,
						 body .mec-toggle-item-col .mec-event-detail,
						 body .mec-event-time span,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time span' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'time_shadow',
					'selector' =>
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time,
						 body .mec-event-list-standard .mec-time-details,
						 body .mec-event-article .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,
						 body .mec-event-countdown li .label-w,
						 body .mec-toggle-item-col .mec-event-detail,
						 body .mec-event-time span,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time span'
				]
			);
			$this->add_responsive_control(
				'time_padding',
				[
					'label' 		=> __( 'padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time,
						 body .mec-event-list-standard .mec-time-details,
						 body .mec-event-article .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,
						 body .mec-event-countdown li,
						 body .mec-toggle-item-col .mec-event-detail,
						 body .mec-event-time span,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'time_margin',
				[
					'label' 		=> __( 'margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-grid-novel .mec-event-detail,
						 body .mec-agenda-time,
						 body .mec-event-list-standard .mec-time-details,
						 body .mec-event-article .mec-event-time,
						 body .mec-wrap .mec-tooltip-event-time,
						 body .mec-timetable-event-span .mec-timetable-event-time,
						 body .event-grid-modern-head .mec-event-detail,
						 body .mec-event-countdown li,
						 body .mec-toggle-item-col .mec-event-detail,
						 body .mec-event-time span,
						 body .mec-timetable-events-list .mec-timetable-event-span.mec-timetable-event-time span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			//Location Style
			$this->start_controls_section(
				'location_style',
				[
					'label' => __( 'Location Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'location_icon_details_display',
				[
					'label' 		=>  esc_html__( 'Time Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > Standard and Accordion - Agenda Style > Clean - TimeTable Style > Modern and Clean - Grid Style > Novel - Countdown', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'.mec-event-list-standard .mec-venue-details:nth-child(3)' => 'display:{{VALUE}} !important;',
					],
					'condition' => [
						'list_style' =>
						[
							'standard',
						],
					],
				]
			);
			$this->add_control(
				'location_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-av-spot-content .mec-location,
						body .mec-av-spot-content .mec-address,
						body .mec-event-countdown-part2 .mec-event-place,
						body .mec-event-detail .mec-event-place,
						body .mec-event-detail .mec-event-loc-place,
						body .mec-event-content .mec-event-address,
						body .mec-grid-event-location,
						body .mec-event-meta-wrap .mec-venue-details span,
						body .mec-event-meta-wrap .mec-venue-details address,
						body .mec-timeline-event-location span,
						body .mec-timetable-event-location span,
						body .mec-event-location-det h6,
						body .mec-event-location-det .mec-events-address,
						body .mec-carousel-event-location' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->add_control(
				'location_icon_color',
				[
					'label' => __( 'Icon Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-av-spot-content .mec-event-location i,
						body .mec-masonry-col6 .mec-event-location i,
						body .mec-slider-t5-col6 .mec-event-location i,
						body .mec-event-detail .mec-event-loc-place i,
						body .mec-timeline-event-location i,
						body .mec-timetable-event-location i,
						body .mec-event-meta-wrap .mec-venue-details:before,
						body .mec-skin-list-container .mec-wrap .mec-event-meta-wrap .mec-venue-details:before,
						body .mec-event-content .mec-event-address:before' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_section();

			// Register Button
			$this->start_controls_section(
				'register_button_detail_style',
				[
					'label' => __( 'Skin Button Style', 'mec-shortcode-builder' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin!' =>
						[
							'map',
							'daily_view',
							'weekly_view',
							'timetable',
							'monthly_view',
							'agenda',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'register_button_display',
				[
					'label' 		=>  esc_html__( 'Button Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > minimal and Standard and modern - Agenda Style > Clean - TimeTable Style > Clean - Grid Style > Classic and Clean and Modern and Novel and Colorful - Countdown > Style1', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .btn-wrapper .mec-detail-button,
						 body  .mec-booking-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button,
						 body .mec-event-carousel-type3 .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 body .mec-event-article .mec-event-footer .mec-event-button,
						 body  .mec-event-countdown-part3 .mec-event-button,
						 .mec-event-countdown-style1 .mec-event-countdown-part3 .mec-event-button,
						 .mec-event-countdown-style2 .mec-event-countdown-part3 .mec-event-button
						 ' => 'display:{{VALUE}} !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'register_button_detail_typography',
					'scheme' => Typography::TYPOGRAPHY_4,
					'selector' =>
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-event-grid-clean .mec-booking-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button,
						 body .mec-event-carousel-type3 .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 .mec-event-countdown-style1 .mec-event-countdown-part3 .mec-event-button,
						 .mec-event-countdown-style2 .mec-event-countdown-part3 .mec-event-button',
				]
			);
			$this->start_controls_tabs( 'tabs_register_button_detail_style' );
			$this->start_controls_tab(
				'tab_register_button_detail_normal',
				[
					'label' => __( 'Normal', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'register_button_detail_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-event-grid-clean .mec-booking-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag.mec-color,
						 body .mec-event-carousel-type2 .mec-booking-button.mec-bg-color-hover,
						 body .mec-event-carousel-type3 .mec-booking-button.mec-bg-color-hover,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body  .mec-event-countdown-part3 .mec-event-button,
						 .mec-event-countdown-style1 .mec-event-countdown-part3 .mec-event-button,
						 .mec-event-countdown-style2 .mec-event-countdown-part3 .mec-event-button' => 'fill: {{VALUE}} !important; color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'booking_background_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-event-grid-clean .mec-booking-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button.mec-bg-color-hover,
						 body .mec-event-carousel-type3 .mec-booking-button.mec-bg-color-hover,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button ' => 'background:  {{VALUE}} !important; background-color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'booking_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-event-grid-clean .mec-booking-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button',
				]
			);
			$this->add_responsive_control(
				'booking_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-event-grid-clean .mec-booking-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 body .mec-event-carousel-type2 .mec-booking-button.mec-bg-color-hover,
						 body .mec-event-carousel-type3 .mec-booking-button.mec-bg-color-hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_register_button_detail_hover',
				[
					'label' => __( 'Hover', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'register_button_detail_hover_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:hover,
						 body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:focus,
						 body .mec-event-grid-clean .mec-booking-button:hover,
						 body .mec-booking-button:hover,
						 body .mec-event-countdown-part3 .mec-event-button:hover,
						 body .mec-event-countdown-part-details .mec-event-link:hover,
						 body .mec-event-cover-classic .mec-event-button:hover,
						 body .mec-event-cover-modern .mec-event-tag:hover,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore:hover,
						 body .mec-event-carousel-type2 .mec-booking-button.mec-bg-color-hover:hover,
						 body .mec-event-carousel-type3 .mec-booking-button.mec-bg-color-hover:hover,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button:hover,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button:hover' => 'color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'booking_background_hover_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:hover,
						 body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:focus,
						 body .mec-event-grid-clean .mec-booking-button:hover,
						 body .mec-event-grid-clean .mec-booking-button:focus,
						 body .mec-booking-button:hover,
						 body .mec-booking-button:focus,
						 body .mec-event-countdown-part3 .mec-event-button:hover,
						 body .mec-event-countdown-part3 .mec-event-button:focus,
						 body .mec-event-countdown-part-details .mec-event-link:hover,
						 body .mec-event-cover-classic .mec-event-button:hover,
						 body .mec-event-cover-modern .mec-event-tag:hover,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore:hover,
						 body .mec-event-carousel-type2 .mec-booking-button.mec-bg-color-hover:hover,
						 body .mec-event-carousel-type3 .mec-booking-button.mec-bg-color-hover:hover,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button:hover,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button:hover' => 'background-color: {{VALUE}}  !important;',
					],
				]
			);
			$this->add_control(
				'booking_hover_border_color',
				[
					'label' => __( 'Border Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'separator' => 'after',
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:hover,
						 body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button:focus,
						 body .mec-booking-button:hover,
						 body .mec-event-countdown-part3 .mec-event-button:hover,
						 body .mec-event-countdown-part-details .mec-event-link:hover,
						 body .mec-event-cover-classic .mec-event-button:hover,
						 body .mec-event-cover-modern .mec-event-tag:hover,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore:hover,
						 body .mec-event-carousel-type2 .mec-booking-button.mec-bg-color-hover:hover,
						 body .mec-event-carousel-type3 .mec-booking-button.mec-bg-color-hover:hover,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button:hover,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button:hover' => 'border-color: {{VALUE}} !important;',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs(); // End Tabs
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'register_button_detail_shadow',
					'selector' =>
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-event-grid-clean .mec-booking-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button,
						 body .mec-event-carousel-type3 .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'register_button_detail_box_shadow',
					'selector' =>
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button,
						 body .mec-event-carousel-type3 .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button,
						 body .mec-wrap .mec-totalcal-box .mec-totalcal-view span
',
				]
			);
			$this->add_responsive_control(
				'register_button_detail_margin',
				[
					'label' => __( 'Margin', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button,
						 body .mec-event-carousel-type3 .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
					],
				]
			);
			$this->add_responsive_control(
				'register_button_detail_padding',
				[
					'label' => __( 'Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-minimal .mec-event-article.mec-clear .btn-wrapper .mec-detail-button,
						 body .mec-booking-button,
						 body .mec-event-countdown-part3 .mec-event-button,
						 body .mec-event-countdown-part-details .mec-event-link,
						 body .mec-event-cover-classic .mec-event-button,
						 body .mec-event-cover-modern .mec-event-tag,
						 body .mec-event-carousel-type2 .mec-booking-button,
						 body .mec-event-carousel-type3 .mec-booking-button,
						 body .mec-wrap .mec-timeline-event-content a.mec-timeline-readmore,
						 .mec-wrap .mec-skin-list-events-container .mec-event-article .mec-event-footer .mec-booking-button,
						 body .mec-av-spot-content.mec-event-grid-modern .mec-event-footer .mec-booking-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
					],
				]
			);
			$this->add_control(
				'register_button_detail_line_display',
				[
					'label' 		=>  esc_html__( 'Line Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .btn-wrapper .mec-detail-button:before,
						 body  .mec-event-countdown-part-details .mec-event-link:before' => 'display:{{VALUE}}',
					],
					'separator' => 'before',
					'condition' => [
						'skin' => [
						'list',
						],
						'list_style' => [
						'minimal'
						],
					],
				]
			);
			$this->end_controls_section();
			// End Register Button Style

			// Start Social Button
			$this->start_controls_section(
				'social_button_style',
				[
					'label' => __( 'Social Button Style', 'mec-shortcode-builder' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' => [
							'list',
							'grid',
							'carousel',
						],
					],
				]
			);
			$this->add_control(
				'mec_social_button_display',
				[
					'label' 		=>  esc_html__( 'Social Button Display', 'mec-shortcode-builder' ),
					'description' => __( 'List style > Standard and modern - Agenda Style > Clean - TimeTable Style > Clean - Grid Style > Classic and Clean and Modern and Novel and Colorful', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-wrap .mec-event-sharing-wrap,
						 body .mec-event-list-modern .mec-event-sharing,
						 body .mec-event-list-standard .mec-event-sharing-wrap,
						 body .mec-event-grid-clean .mec-event-sharing-wrap li,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap,
						 body .mec-event-grid-novel .mec-event-content .mec-event-sharing-wrap,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap>li:first-of-type' => 'display:{{VALUE}} !important',
					],
				]
			);
			$this->add_responsive_control(
				'social_button_width',
				[
					'label' => __( 'Button width', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-list-standard .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-grid-clean .mec-event-sharing-wrap li i,
						 body .mec-event-sharing-wrap .mec-event-sharing li i,
						 body .mec-event-sharing-wrap .mec-event-sharing li,
						 body .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-grid-novel .mec-event-content .mec-event-sharing-wrap > li:first-of-type' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'social_button_height',
				[
					'label' => __( 'Button height', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-grid-clean .mec-event-sharing-wrap li i,
						 body .mec-event-list-standard .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-sharing-wrap .mec-event-sharing li i,
						 body .mec-event-sharing-wrap .mec-event-sharing li,
						 body .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-grid-novel .mec-event-content .mec-event-sharing-wrap > li:first-of-type' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'social_icon_size',
				[
					'label' 		=> __( 'Icon Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'separator' => 'before',
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-event-sharing-wrap li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap li a,
						 body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-list-standard .mec-event-sharing-wrap li a,
						 body .mec-event-sharing-wrap .mec-event-sharing li i,
						 body .mec-event-sharing-wrap > li:first-of-type' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'tabs_social_button_style' );
			$this->start_controls_tab(
				'tab_social_button_normal',
				[
					'label' => __( 'Normal', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'social_button_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap li a,
						 body .mec-event-list-standard .mec-event-sharing-wrap li a,
						 body .mec-event-sharing-wrap .mec-event-sharing li a,
						 body .mec-event-sharing-wrap > li:first-of-type a' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'social_background_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-list-standard .mec-event-sharing-wrap li a,
						 body .mec-event-list-standard .mec-event-sharing-wrap li,
						 body .mec-event-sharing-wrap .mec-event-sharing li,
						 body .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-sharing-wrap li .mec-sl-share:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'social_button_hover',
				[
					'label' => __( 'Hover', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'social_hover_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-event-sharing-wrap li a:hover,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li a:hover,
						 body .mec-event-grid-clean .mec-event-sharing-wrap:hover li a,
						 body .mec-event-list-standard .mec-event-sharing-wrap:hover li a,
						 body .mec-wrap .mec-event-sharing-wrap li a:focus,
						 body .mec-wrap .mec-event-share:hover a,
						 body .mec-event-list-modern .mec-event-sharing>li i:hover,
						 body .mec-event-sharing-wrap .mec-event-sharing li:hover a,
						 body .mec-event-sharing-wrap > li:first-of-type a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'social_button_background_hover_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'default' => '',
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-event-share:hover,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li:hover,
						 body .mec-event-list-standard .mec-event-sharing-wrap li:hover,
						 body .mec-event-grid-clean .mec-event-sharing-wrap > li:hover,
						 body .mec-wrap .mec-event-share:focus,
						 body .mec-event-list-modern .mec-event-sharing>li i:hover,
						 body .mec-event-sharing-wrap .mec-event-sharing li:hover a,
						 body .mec-event-sharing-wrap > li:first-of-type a:hover,
						 body .event-carousel-type3-head .mec-event-sharing-wrap li:first-of-type i:hover,
						 body .mec-event-grid-colorful .event-grid-modern-head .mec-event-sharing-wrap li:hover i' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs(); //end tabs
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'mec_social_button_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'separator' => 'before',
					'default' => '',
					'selector' =>
						'body .mec-event-grid-colorful .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-grid-clean .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-novel .mec-event-content .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-list-standard .mec-event-sharing-wrap>li:first-of-type',
				]
			);
			$this->add_control(
				'mec_social_buttons_border_radius',
				[
					'label' 		=> __( 'Social Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-list-standard .mec-event-sharing-wrap>li:first-of-type,
						 body .mec-event-grid-novel .mec-event-content .mec-event-sharing-wrap > li:first-of-type' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'mec_social_button_box_shadow',
					'selector' =>
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap > li:first-of-type,
						 body .mec-event-list-standard .mec-event-sharing-wrap>li:first-of-type,
						 body .mec-event-sharing-wrap li:first-of-type,
						 body .mec-event-grid-novel .mec-event-content .mec-event-sharing-wrap > li:first-of-type',
				]
			);
			$this->add_responsive_control(
				'social_text_padding',
				[
					'label' => __( 'Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'separator' => 'before',
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap > li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap > li i,
						 body .mec-event-list-standard .mec-event-sharing-wrap>li i,
						 body .mec-event-sharing-wrap > li i,
						 body .mec-event-sharing-wrap > li:first-of-type i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'social_text_margin',
				[
					'label' => __( 'Margin', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-modern .mec-event-sharing>li i,
						 body .mec-event-grid-colorful .mec-event-sharing-wrap>li i,
						 body .mec-event-grid-clean .mec-event-sharing-wrap>li i,
						 body .mec-event-list-standard .mec-event-sharing-wrap>li i,
						 body .mec-event-sharing-wrap>li i,
						 body .mec-event-sharing-wrap>li:first-of-type i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			// End Social Button

			// Start Countdown
			$this->start_controls_section(
				'countdown_style_for_countdown',
				[
					'label' => __( 'Countdown Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'countdown',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'countdown_number_typo_for_countdown',
					'label' 	=> __( 'Number Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li span,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li span,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li span',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'countdown_label_typo_for_countdown',
					'label' 	=> __( 'Label Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li p,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li p,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li p',
				]
			);
			$this->add_control(
				'countdown_title_color_for_countdown',
				[
					'label' 		=> __( 'Number color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li span,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li span,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li span' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->add_control(
				'countdown_color_for_countdown',
				[
					'label' 		=> __( 'Label Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li p,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li p,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li p' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->add_control(
				'countdown_bg_color_for_countdown',
				[
					'label' 		=> __( 'Countdown Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li' => 'background: {{VALUE}} !important',
					],
				]
			);
			$this->add_responsive_control(
				'countdown_box_padding_for_countdown',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};  !important',
					],
				]
			);
			$this->add_responsive_control(
				'countdown_box_margin_for_countdown',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'countdown_border_for_countdown',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li',
				]
			);
			$this->add_responsive_control(
				'countdown_border_radius_for_countdown',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-wrap .mec-event-countdown-style1 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style2 .mec-event-countdown #countdown li,
						 .mec-wrap .mec-event-countdown-style3 .mec-event-countdown #countdown li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;'
					],
				]
			);
			$this->end_controls_section();
			// End Countdown

			// Start Feature Image Style
			$this->start_controls_section(
				'feature_image_style',
				[
					'label' => __( 'Feature Image Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin!' => [
							'timetable',
							'map',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'feature_image_display',
				[
					'label' 		=>  esc_html__( 'Feature Image Display', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=>  esc_html__( 'Hide', 'mec-shortcode-builder' ),
					'label_off' 	=>  esc_html__( 'Show', 'mec-shortcode-builder' ),
					'return_value' 	=> 'none',
					'default' 		=> '',
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image,
						 body .mec-topsec .mec-event-image,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image,
						 body .mec-event-grid-classic .mec-event-image,
						 body .mec-event-grid-clean .mec-event-image,
						 body .mec-event-grid-novel .mec-event-image,
						 body .mec-calendar-events-sec .mec-event-image,
						 body .mec-event-countdown-style3 .mec-event-image,
						 body .mec-owl-carousel .owl-item .mec-event-image,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image,
						 body .mec-calendar-daily .mec-event-image,
						 body .mec-timeline-event-image,
						 body .mec-masonry .mec-masonry-img' => 'display:{{VALUE}} !important;',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'skin',
							'operator' => '!in',
							'value' => [
								'cover',
								'slider',
							],
						],
					],
				],
				]
			);
			$this->add_responsive_control(
				'feature_image_width',
				[
					'label' => __( 'Image width', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1024,
						],
					],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body  .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img' => 'width: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
				$this->add_responsive_control(
				'feature_image_height',
				[
					'label' => __( 'Image height', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1024,
						],
					],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img' => 'height: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'feature_image_align',
				[
					'label' => __( 'Alignment', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mec-shortcode-builder' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image,
						body .mec-topsec .mec-event-image,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image,
						 body .mec-event-grid-classic .mec-event-image,
						 body .mec-event-grid-clean .mec-event-image,
						 body .mec-event-grid-novel .mec-event-image,
						 body .mec-calendar-events-sec .mec-event-image,
						 body .mec-event-cover-clean .mec-event-image,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image,
						 body .mec-owl-carousel .owl-item .mec-event-image,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image,
						 body .mec-calendar-daily .mec-event-image,
						 body .mec-timeline-event-image
						 body .mec-masonry .mec-masonry-img' => 'text-align: {{VALUE}} !important;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'feature_image_box_bg',
					'label' => __( 'Background image', 'mec-shortcode-builder' ),
					'types' => [ 'classic' , 'gradient' ],
					'selector' =>
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img'
				]
			);
			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'image_css_filter',
					'selector' =>
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img'
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'image_box_shadow',
					'selector' =>
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img'
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'feature_image_border',
					'label' => __( 'Image Border', 'mec-shortcode-builder' ),
					'separator' => 'before',
					'selector' =>
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img'
				]
			);
			$this->add_responsive_control(
				'feature_image_border_radius',
				[
					'label' 		=> __( 'Image Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-event-countdown-style3 .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->add_responsive_control(
				'feature_image_padding',
				[
					'label' 		=> __( 'Image padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'feature_image_margin',
				[
					'label' 		=> __( 'Image margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-event-list-classic .mec-event-image img,
						 body .mec-topsec .mec-event-image img,
						 body .mec-toogle-inner-month-divider .mec-toggle-month-inner-image img,
						 body .mec-event-grid-classic .mec-event-image img,
						 body .mec-event-grid-clean .mec-event-image img,
						 body .mec-event-grid-novel .mec-event-image img,
						 body .mec-calendar-events-sec .mec-event-image img,
						 body .mec-event-cover-clean .mec-event-image img,
						 body .mec-event-cover-modern,
						 body .mec-owl-carousel .owl-item .mec-event-image img,
						 body .mec-slider-t1 .mec-slider-t1-img,
						 body .mec-slider-t2 .mec-slider-t2-img,
						 body .mec-slider-t3 .mec-slider-t3-img,
						 body .mec-slider-t4 .mec-slider-t4-img,
						 body .mec-slider-t5 .mec-slider-t5-img,
						 body .mec-av-spot .mec-av-spot-img,
						 body .mec-calendar-weekly .mec-event-image img,
						 body .mec-calendar-daily .mec-event-image img,
						 body .mec-timeline-event-image img,
						 body .mec-masonry .mec-masonry-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

            // Start Local Time Style
			$this->start_controls_section(
				'localtime_button_style',
				[
					'label' => __( 'Local Time Style', 'mec-shortcode-builder' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' => [
							'list',
							'grid',
							'yearly_view',
							'monthly_view',
							'daily_view',
							'weekly_view',
							'masonry',
							'timetable',
							'agenda',
							'cover',
							'countdown',
							'available_spot',
							'carousel',
							'slider',
							'timeline',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'localtime_typography',
					'scheme' => Typography::TYPOGRAPHY_4,
					'selector' => 'body .mec-wrap .mec-localtime-details div, body .mec-wrap .mec-local-time-details div',
				]
			);
			$this->add_control(
				'mec_localtime_button_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-localtime-details div, body .mec-wrap .mec-local-time-details div' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'mec_localtime_background_button_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-localtime-details, body .mec-wrap .mec-local-time-details' => 'background-color: {{VALUE}};'
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'localtime_button_border',
					'selector' => 'body .mec-wrap .mec-localtime-details, body .mec-wrap .mec-local-time-details',
					'separator' => 'before',
					'default' 		=> 'solid 0px',
				]
			);
			$this->add_responsive_control(
				'mec_localtime_button_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-localtime-details, body .mec-wrap .mec-local-time-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'localtime_box_shadow',
					'selector' => 'body .mec-wrap .mec-localtime-details, body .mec-wrap .mec-local-time-details',
				]
			);
			$this->add_responsive_control(
				'localtime_text_margin',
				[
					'label' => __( 'Margin', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selector' => [
						'body .mec-localtime-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'localtime_text_padding',
				[
					'label' => __( 'Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selector' => [
						'body .mec-localtime-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->end_controls_section();
			// End Local Time Style

			// Start Button Style
			$this->start_controls_section(
				'load_more_button_style',
				[
					'label' => __( 'Load More Button', 'mec-shortcode-builder' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'list_load_more_button[return_value]' => '1',
						'skin' => [
							'list',
							'grid',
							'agenda',
							'custom',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'load_more_typography',
					'scheme' => Typography::TYPOGRAPHY_4,
					'selector' => 'body .mec-wrap .mec-load-more-button',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'load_more_text_shadow',
					'selector' => 'body .mec-wrap .mec-load-more-button',
				]
			);
			$this->start_controls_tabs( 'tabs_load_more_button_style' );
			$this->start_controls_tab(
				'tab_load_more_button_normal',
				[
					'label' => __( 'Normal', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'mec_load_more_button_text_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-load-more-wrap .mec-load-more-button' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'mec_load_more_background_button_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'body .mec-wrap .mec-load-more-wrap .mec-load-more-button' => 'background-color: {{VALUE}};'
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_load_more_button_hover',
				[
					'label' => __( 'Hover', 'mec-shortcode-builder' ),
				]
			);
			$this->add_control(
				'load_more_button_hover_color',
				[
					'label' => __( 'Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-load-more-button:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'load_more_button_background_hover_color',
				[
					'label' => __( 'Background Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-load-more-button:hover,
						 body .mec-wrap .mec-load-more-button:focus' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'load_more_button_hover_border_color',
				[
					'label' => __( 'Border Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selector' => [
						'body .mec-wrap .mec-load-more-button:hover' => 'border-color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'load_more_hover_animation',
				[
					'label' => __( 'Hover Animation', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::HOVER_ANIMATION,
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'load_more_button_border',
					'selector' => 'body .mec-wrap .mec-load-more-button',
					'separator' => 'before',
					'default' 		=> 'solid 2px',
				]
			);
			$this->add_responsive_control(
				'mec_load_more_button_border_radius',
				[
					'label' 		=> __( 'Button Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-wrap .mec-load-more-wrap .mec-load-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'button_box_shadow',
					'selector' => 'body .mec-wrap .mec-load-more-button',
				]
			);
			$this->add_responsive_control(
				'load_more_text_button_margin',
				[
					'label' => __( 'Margin', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selector' => [
						'body .mec-wrap .mec-load-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'load_more_text_button_padding',
				[
					'label' => __( 'Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selector' => [
						'body .mec-wrap .mec-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			// End Button Style

			// Label Styles
			$this->start_controls_section(
				'label_style',
				[
					'label' => __( 'Label Style', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin!' => [
							'map',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'normal_labels_typography_inherit',
					'label' 	=> __( 'Label Typography (inherit)', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=> '{{WRAPPER}} .mec-wrap .mec-labels-normal .mec-label-normal',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'normal_labels_box_border_inherit',
					'label' => __( 'Label Border (inherit)', 'mec-shortcode-builder' ),
					'selector' =>  '{{WRAPPER}} .mec-wrap .mec-labels-normal .mec-label-normal',
				]
			);
			$this->add_responsive_control(
				'normal_labels_box_border_radius_inherit',
				[
					'label' 		=> __( 'Label Border Radius (inherit)', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .mec-wrap .mec-labels-normal .mec-label-normal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'normal_labels_margin_inherit',
				[
					'label' => __( 'Label Margin (inherit)', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .mec-wrap .mec-labels-normal .mec-label-normal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'normal_labels_padding_inherit',
				[
					'label' => __( 'Label Padding (inherit)', 'mec-shortcode-builder' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'separator' => 'after',
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .mec-wrap .mec-labels-normal .mec-label-normal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->add_control(
				'all_labels_line_seprator',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
			$this->add_control(
				'all_ongoing_labels_bg_color',
				[
					'label' => __( 'Background Color For Ongoing Label', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-labels-normal .mec-ongoing-normal-label' => 'background-color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'all_ongoing_labels_txt_color',
				[
					'label' => __( 'Ongoing Label Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-labels-normal .mec-ongoing-normal-label' => 'color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'all_expired_labels_bg_color',
				[
					'label' => __( 'Background Color For Expired Label', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-labels-normal .mec-expired-normal-label' => 'background-color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'all_expired_labels_txt_color',
				[
					'label' => __( 'Expired Label Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-labels-normal .mec-expired-normal-label' => 'color: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'all_cancellation_labels_bg_color',
				[
					'label' => __( 'Background Color For Cancellation Label', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-cancellation-reason span' => 'background: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'all_cancellation_labels_txt_color',
				[
					'label' => __( 'Cancellation Label Text Color', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'body .mec-wrap .mec-cancellation-reason span' => 'color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'all_end_labels_line_seprator',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);

			// Reason for Cancellation
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'reason_label_typography',
					'label' 	=> __( 'Reason for Cancellation Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'separator' => 'before',
					'selector' 	=> '.mec-wrap .mec-cancellation-reason span ',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'reason_label_box_border',
					'label' => __( 'Reason for Cancellation Border', 'mec-shortcode-builder' ),
					'selector' =>  '.mec-wrap .mec-cancellation-reason span ',
				]
			);
			$this->add_responsive_control(
				'reason_label_box_border_radius',
				[
					'label' 		=> __( 'Reason for Cancellation Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'.mec-wrap .mec-cancellation-reason span ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'reason_label_margin',
				[
					'label' => __( 'Reason for Cancellation Margin', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selector' => [
						'.mec-wrap .mec-cancellation-reason span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'reason_label_padding',
				[
					'label' => __( 'Reason for Cancellation Padding', 'mec-shortcode-builder' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selector' => [
						'.mec-wrap .mec-cancellation-reason span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);

			$this->end_controls_section();

			// Next and Previous Tab
			$this->start_controls_section(
				'organizer_style',
				[
					'label' => __( 'Organizer Styles', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'timetable',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'organizer_typography',
					'separator' => 'before',
					'label' 	=> __( 'Organizer Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-timetable-wrap .mec-event-organizer span',
				]
			);
			$this->add_control(
				'organizer_color',
				[
					'label' 		=> __( 'Organaizer Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-timetable-wrap .mec-event-organizer span' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'organizer_color_hover',
				[
					'label' 		=> __( 'Hover Organaizer Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-timetable-wrap .mec-event-organizer span:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'organizer_bg_color',
				[
					'label' 		=> __( 'Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-timetable-wrap .mec-event-organizer' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'organizer_bg_color_hover',
				[
					'label' 		=> __( 'Hover Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-timetable-wrap .mec-event-organizer:hover' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'organizer_padding',
				[
					'label' 		=> __( 'Organaizer Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-timetable-wrap .mec-event-organizer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'organizer_margin',
				[
					'label' 		=> __( 'Organaizer Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-timetable-wrap .mec-event-organizer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'organizer_border',
					'label' => __( 'Organaizer Border', 'mec-shortcode-builder' ),
					'selector' =>
						'body .mec-timetable-wrap .mec-event-organizer',
				]
			);
			$this->add_responsive_control(
				'organizer_border_radius',
				[
					'label' 		=> __( 'Organaizer Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-timetable-wrap .mec-event-organizer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'organizer_icon_size',
				[
					'label' 		=> __( 'Organaizer Icon Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-timetable-wrap .mec-event-organizer i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'organizer_i_color',
				[
					'label' 		=> __( 'Organaizer Icon Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-timetable-wrap .mec-event-organizer i' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'organizer_i_color_hover',
				[
					'label' 		=> __( 'Hover Organaizer Icon Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-timetable-wrap .mec-event-organizer:hover i' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->end_controls_section();
			// End Typo style

			// Next and Previous Tab
			$this->start_controls_section(
				'nxt_pre_style',
				[
					'label' => __( 'Next and Previous Styles', 'mec-shortcode-builder' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'skin' =>
						[
							'monthly_view',
							'full_calendar',
							'daily_view',
							'weekly_view',
							'timetable',
							'yearly_view',
							'tile',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'nxt_pre_typography',
					'separator' => 'before',
					'label' 	=> __( 'Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-calendar .mec-calendar-a-month h4',
				]
			);
			$this->add_control(
				'nxt_pre_color',
				[
					'label' 		=> __( 'Title Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-calendar-a-month .mec-previous-month,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-calendar-a-month .mec-next-month' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'nxt_pre_color_hover',
				[
					'label' 		=> __( 'Hover Title Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month:hover,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month:hover,
						 body .mec-yearly-title-sec .mec-next-year:hover,
						 body .mec-yearly-title-sec .mec-previous-year:hover,
						 body .mec-calendar-a-month .mec-previous-month:hover,
						 body .mec-skin-tile-month-navigator-container .mec-next-month:hover,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month:hover,
						 body .mec-calendar-a-month .mec-next-month:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'nxt_pre_bg_color',
				[
					'label' 		=> __( 'Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar-a-month .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-previous-month' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'nxt_pre_bg_color_hover',
				[
					'label' 		=> __( 'Hover Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month:hover,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month:hover,
						 body .mec-calendar .mec-calendar-side .mec-next-month:hover,
						 body .mec-calendar .mec-calendar-side .mec-previous-month:hover,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-next-month:hover,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-previous-month:hover,
						 body .mec-calendar .mec-calendar-side .mec-next-month:hover,
						 body .mec-calendar .mec-calendar-side .mec-previous-month:hover,
						 body .mec-yearly-title-sec .mec-next-year:hover,
						 body .mec-yearly-title-sec .mec-previous-year:hover,
						 body .mec-skin-tile-month-navigator-container .mec-next-month:hover,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month:hover,
						 body .mec-calendar-a-month .mec-previous-month:hover,
						 body .mec-calendar-a-month .mec-next-month:hover,
						 body .mec-calendar.mec-calendar-daily .mec-next-month:hover,
						 body .mec-calendar.mec-calendar-daily .mec-previous-month:hover' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'second_typo_style_daily_and_weekly',
					'separator' => 'before',
					'label' 	=> __( 'Second Title Typography', 'mec-shortcode-builder' ),
					'scheme' 	=> Typography::TYPOGRAPHY_2,
					'selector' 	=>
					'body .mec-calendar-d-top h3,
					 body .mec-skin-tile-month-navigator-container h2,
					 body .mec-today-container .mec-today-count',
					'condition' => [
						'skin' =>
						[
							'daily_view',
							'weekly_view',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'second_nxt_pre_color_mec',
				[
					'label' 		=> __( 'Second Title Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selector' 	=> [
						'body .mec-calendar-d-top h3,
						 body .mec-skin-tile-month-navigator-container h2,
						 body .mec-today-container .mec-today-count' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' =>
						[
							'daily_view',
							'weekly_view',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'scond_nxt_pre_color_hover',
				[
					'label' 		=> __( 'Second Hover Title Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selector' 	=> [
						'body .mec-calendar-d-top h3:hover,
						 body .mec-skin-tile-month-navigator-container h2:hover,
						 body .mec-today-container .mec-today-count:hover' => 'color: {{VALUE}}',
					],
					'condition' => [
						'skin' =>
						[
							'daily_view',
							'weekly_view',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'scond_nxt_pre_bg_color',
				[
					'label' 		=> __( 'Second Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selector' 	=> [
						'body .mec-calendar-d-top h3,
						body .mec-skin-tile-month-navigator-container h2,
						 body .mec-today-container .mec-today-count' => 'background: {{VALUE}}',
					],
					'condition' => [
						'skin' =>
						[
							'daily_view',
							'weekly_view',
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'scond_nxt_pre_bg_color_hover',
				[
					'label' 		=> __( 'Second Hover Background Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selector' 	=> [
						'body .mec-calendar-d-top h3:hover,
						body .mec-skin-tile-month-navigator-container h2:hover,
						 body .mec-today-container .mec-today-count:hover' => 'background: {{VALUE}}',
					],
					'condition' => [
						'skin' =>
						[
							'daily_view',
							'weekly_view',
							'tile',
						],
					],
				]
			);
			$this->add_responsive_control(
				'nxt_pre_padding',
				[
					'label' 		=> __( 'Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar-a-month .mec-next-month' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'second_nxt_pre_padding',
				[
					'label' 		=> __( 'Second Title Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-skin-tile-month-navigator-container h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->add_responsive_control(
				'nxt_pre_margin',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar-a-month .mec-next-month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'nxt_pre_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar-a-month .mec-next-month',
				]
			);
			$this->add_responsive_control(
				'nxt_pre_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-box-calendar.mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-next-month,
						 body .mec-calendar.mec-calendar-daily .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar .mec-calendar-side .mec-next-month,
						 body .mec-calendar .mec-calendar-side .mec-previous-month,
						 body .mec-skin-tile-month-navigator-container .mec-next-month,
						 body .mec-skin-tile-month-navigator-container .mec-previous-month,
						 body .mec-yearly-title-sec .mec-next-year,
						 body .mec-yearly-title-sec .mec-previous-year,
						 body .mec-calendar-a-month .mec-previous-month,
						 body .mec-calendar-a-month .mec-next-month' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'the_arrow_size',
				[
					'label' 		=> __( 'Arrow Size', 'mec-shortcode-builder' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' 		=> [
							'min' 		=> 0,
							'max' 		=> 200,
							'step' 		=> 1,
						],
						'%' 		=> [
							'min' 		=> 0,
							'max' 		=> 100,
						],
					],
					'selectors' => [
						'body .mec-wrap.colorskin-custom .mec-calendar .mec-calendar-side .mec-previous-month i,
						 body .mec-calendar .mec-calendar-side .mec-next-month i,
						 body .mec-yearly-title-sec .mec-next-year i,
						 body .mec-yearly-title-sec .mec-previous-year i,
						 body .mec-tile .mec-next-month i,
						 body .mec-tile .mec-previous-month i,
						 body .mec-calendar.mec-calendar-daily .mec-next-month i,
						 body .mec-calendar.mec-calendar-daily .mec-previous-month i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'full_calendar',
						],
					],
				]
			);
			$this->add_control(
				'nxt_pre_i_color',
				[
					'label' 		=> __( 'Icon Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap.colorskin-custom .mec-calendar .mec-calendar-side .mec-previous-month i,
						 body .mec-calendar .mec-calendar-side .mec-next-month i,
						 body .mec-yearly-title-sec .mec-next-year i,
						 body .mec-yearly-title-sec .mec-previous-year i,
						 body .mec-tile .mec-next-month i,
						 body .mec-tile .mec-previous-month i,
						 body .mec-calendar.mec-calendar-daily .mec-next-month i,
						 body .mec-calendar.mec-calendar-daily .mec-previous-month i' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'nxt_pre_i_color_hover',
				[
					'label' 		=> __( 'Hover Icon Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-wrap .mec-previous-month:hover i,
						 body .mec-wrap .mec-next-month:hover i,
						 body .mec-yearly-title-sec .mec-next-year:hover i,
						 body .mec-yearly-title-sec .mec-previous-year:hover i,
						 body .mec-tile .mec-next-month:hover i,
						 body .mec-tile .mec-previous-month:hover i,
						 body .mec-calendar.mec-calendar-daily .mec-next-month:hover i,
						 body .mec-calendar.mec-calendar-daily .mec-previous-month:hover i' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->add_responsive_control(
				'tile_box_padding',
				[
					'label' 		=> __( 'Box Padding', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-skin-tile-month-navigator-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->add_responsive_control(
				'tile_box_margin',
				[
					'label' 		=> __( 'Margin', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-skin-tile-month-navigator-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'tile_box_border',
					'label' => __( 'Border', 'mec-shortcode-builder' ),
					'selector' =>
						'body .mec-skin-tile-month-navigator-container',
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->add_responsive_control(
				'tile_box_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'body .mec-skin-tile-month-navigator-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'tile_box_color',
				[
					'label' 		=> __( 'Box Background', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-skin-tile-month-navigator-container' => 'background: {{VALUE}} !important',
					],
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->add_control(
				'tile_box_arrow_color',
				[
					'label' 		=> __( 'Box Arrow Color', 'mec-shortcode-builder' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'selectors' 	=> [
						'body .mec-skin-tile-month-navigator-container:before,
						 body .mec-skin-tile-month-navigator-container:after' => 'border-color: {{VALUE}} transparent transparent transparent !important',
					],
					'condition' => [
						'skin' => [
							'tile',
						],
					],
				]
			);
			$this->end_controls_section();
			// End Typo style
		}
		/**
		 * Render MEC widget output on the frontend.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function render() {
			$settings       = $this->get_settings_for_display();
			$skin           = $settings['skin'];
			$display_option = $search_form = $filter_options = array();
			if ( isset( $settings['skin'] ) ) {
				$display_option['skin'] = $settings['skin'];
				$settings['skin']       = str_replace( '_view', '', $settings['skin'] );
				$skin                   = $settings['skin'];
			}
			if ( isset( $settings[ $skin . '_style' ] ) ) {
				$display_option['style'] = $settings[ $skin . '_style' ];
			}
			if ( isset( $settings[ $skin . '_start_date_type' ] ) ) {
				$display_option['start_date_type'] = $settings[ $skin . '_start_date_type' ];
			}
			if ( isset( $settings[ $skin . '_start_date' ] ) ) {
				$display_option['start_date'] = $settings[ $skin . '_start_date' ];
			}
			if ( isset( $settings[ $skin . '_classic_date_format1' ] ) ) {
				$display_option['classic_date_format1'] = $settings[ $skin . '_classic_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_classic_date_format1' ] ) ) {
				$display_option['date_format_classic1'] = $settings[ $skin . '_classic_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_classic_date_format2' ] ) ) {
				$display_option['date_format_classic2'] = $settings[ $skin . '_classic_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_minimal_date_format1' ] ) ) {
				$display_option['minimal_date_format1'] = $settings[ $skin . '_minimal_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_minimal_date_format2' ] ) ) {
				$display_option['minimal_date_format2'] = $settings[ $skin . '_minimal_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_minimal_date_format3' ] ) ) {
				$display_option['minimal_date_format3'] = $settings[ $skin . '_minimal_date_format3' ];
			}
			if ( isset( $settings[ $skin . '_modern_date_format1' ] ) ) {
				$display_option['modern_date_format1'] = $settings[ $skin . '_modern_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_date_format_modern1' ] ) ) {
				$display_option['date_format_modern1'] = $settings[ $skin . '_date_format_modern1' ];
			}
			if ( isset( $settings[ $skin . '_date_format_list' ] ) ) {
				$display_option['date_format_list'] = $settings[ $skin . '_date_format_list' ];
			}
			if ( isset( $settings[ $skin . '_date_format_yearly_1' ] ) ) {
				$display_option['date_format_yearly_1'] = $settings[ $skin . '_date_format_yearly_1' ];
			}
			if ( isset( $settings[ $skin . '_date_format_yearly_2' ] ) ) {
				$display_option['date_format_yearly_2'] = $settings[ $skin . '_date_format_yearly_2' ];
			}
			if ( isset( $settings[ $skin . '_modern_date_format2' ] ) ) {
				$display_option['modern_date_format2'] = $settings[ $skin . '_modern_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_modern_date_format3' ] ) ) {
				$display_option['modern_date_format3'] = $settings[ $skin . '_modern_date_format3' ];
			}
			if ( isset( $settings[ $skin . '_simple_date_format1' ] ) ) {
				$display_option['simple_date_format1'] = $settings[ $skin . '_simple_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_novel_date_format1' ] ) ) {
				$display_option['novel_date_format1'] = $settings[ $skin . '_novel_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_clean_date_format1' ] ) ) {
				$display_option['clean_date_format1'] = $settings[ $skin . '_clean_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_clean_date_format2' ] ) ) {
				$display_option['clean_date_format2'] = $settings[ $skin . '_clean_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_clean_date_format3' ] ) ) {
				$display_option['clean_date_format3'] = $settings[ $skin . '_clean_date_format3' ];
			}
			if ( isset( $settings[ $skin . '_standard_date_format1' ] ) ) {
				$display_option['standard_date_format1'] = $settings[ $skin . '_standard_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_accordion_date_format1' ] ) ) {
				$display_option['accordion_date_format1'] = $settings[ $skin . '_accordion_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_accordion_date_format2' ] ) ) {
				$display_option['accordion_date_format2'] = $settings[ $skin . '_accordion_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_style1_date_format1' ] ) ) {
				$display_option['date_format_style11'] = $settings[ $skin . '_style1_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_style2_date_format1' ] ) ) {
				$display_option['date_format_style21'] = $settings[ $skin . '_style2_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_style3_date_format1' ] ) ) {
				$display_option['date_format_style31'] = $settings[ $skin . '_style3_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_style3_date_format2' ] ) ) {
				$display_option['date_format_style32'] = $settings[ $skin . '_style3_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_style3_date_format3' ] ) ) {
				$display_option['date_format_style33'] = $settings[ $skin . '_style3_date_format3' ];
			}
			if ( isset( $settings[ $skin . '_date_format1' ] ) ) {
				$display_option['date_format1'] = $settings[ $skin . '_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_date_format2' ] ) ) {
				$display_option['date_format2'] = $settings[ $skin . '_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_type1_date_format1' ] ) ) {
				$display_option['type1_date_format1'] = $settings[ $skin . '_type1_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_type1_date_format2' ] ) ) {
				$display_option['type1_date_format2'] = $settings[ $skin . '_type1_date_format2' ];
			}
			if ( isset( $settings[ $skin . '_type1_date_format3' ] ) ) {
				$display_option['type1_date_format3'] = $settings[ $skin . '_type1_date_format3' ];
			}
			if ( isset( $settings[ $skin . '_type2_date_format1' ] ) ) {
				$display_option['type2_date_format1'] = $settings[ $skin . '_type2_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_type3_date_format1' ] ) ) {
				$display_option['type3_date_format1'] = $settings[ $skin . '_type3_date_format1' ];
			}
			if ( isset( $settings[ $skin . '_autoplay' ] ) ) {
				$display_option['autoplay'] = $settings[ $skin . '_autoplay' ];
			}
			if ( isset( $settings[ $skin . '_sed_method' ] ) ) {
				$display_option['sed_method'] = $settings[ $skin . '_sed_method' ];
			}
			if ( isset( $settings[ $skin . '_count' ] ) ) {
				$display_option['count'] = $settings[ $skin . '_count' ];
			}
			if ( isset( $settings[ $skin . '_number_of_days' ] ) ) {
				$display_option['number_of_days'] = $settings[ $skin . '_number_of_days' ];
			}
			if ( isset( $settings[ $skin . '_week_start' ] ) ) {
				$display_option['week_start'] = $settings[ $skin . '_week_start' ];
			}
			if ( isset( $settings[ $skin . '_event' ] ) ) {
				$display_option['event_id'] = $settings[ $skin . '_event' ];
			}
			if ( isset( $settings[ $skin . '_default_view' ] ) ) {
				$display_option['default_view'] = $settings[ $skin . '_default_view' ];
			}
			if ( isset( $settings[ $skin . '_style' ] ) ) {
				$display_option['monthly_style'] = $settings[ $skin . '_style' ];
			}
			if ( isset( $settings[ $skin . '_limit' ] ) ) {
				$display_option['limit'] = $settings[ $skin . '_limit' ];
			}
			if ( isset( $settings[ $skin . '_filter_by' ] ) ) {
				$display_option['filter_by'] = $settings[ $skin . '_filter_by' ];
			}
			if ( isset( $settings[ $skin . '_list' ] ) && $settings[ $skin . '_list' ] == '1' ) {
				$display_option['list'] = $settings[ $skin . '_list' ] = '1';
			} else {
				$display_option['list'] = $settings[ $skin . '_list' ] = '0';
			}
			if ( isset( $settings[ $skin . '_grid' ] ) && $settings[ $skin . '_grid' ] == '1' ) {
				$display_option['grid'] = $settings[ $skin . '_grid' ] = '1';
			} else {
				$display_option['grid'] = $settings[ $skin . '_grid' ] = '0';
			}
			if ( isset( $settings[ $skin . '_tile' ] ) && $settings[ $skin . '_tile' ] == '1' ) {
				$display_option['tile'] = $settings[ $skin . '_tile' ] = '1';
			} else {
				$display_option['tile'] = $settings[ $skin . '_tile' ] = '0';
			}
			if ( isset( $settings[ $skin . '_yearly' ] ) && $settings[ $skin . '_yearly' ] == '1' ) {
				$display_option['yearly'] = $settings[ $skin . '_yearly' ] = '1';
			} else {
				$display_option['yearly'] = $settings[ $skin . '_yearly' ] = '0';
			}
			if ( isset( $settings[ $skin . '_monthly' ] ) && $settings[ $skin . '_monthly' ] == '1' ) {
				$display_option['monthly'] = $settings[ $skin . '_monthly' ] = '1';
			} else {
				$display_option['monthly'] = $settings[ $skin . '_monthly' ] = '0';
			}
			if ( isset( $settings[ $skin . '_weekly' ] ) && $settings[ $skin . '_weekly' ] == '1' ) {
				$display_option['weekly'] = $settings[ $skin . '_weekly' ] = '1';
			} else {
				$display_option['weekly'] = $settings[ $skin . '_weekly' ] = '0';
			}
			if ( isset( $settings[ $skin . '_daily' ] ) && $settings[ $skin . '_daily' ] == '1' ) {
				$display_option['daily'] = $settings[ $skin . '_daily' ] = '1';
			} else {
				$display_option['daily'] = $settings[ $skin . '_daily' ] = '0';
			}
			if ( isset( $settings[ $skin . '_display_price' ] ) && $settings[ $skin . '_display_price' ] == '1' ) {
				$display_option['display_price'] = $settings[ $skin . '_display_price' ] = '1';
			} else {
				$display_option['display_price'] = $settings[ $skin . '_display_price' ] = '0';
			}
			if ( isset( $settings[ $skin . '_next_previous_button' ] ) && $settings[ $skin . '_next_previous_button' ] == '1' ) {
				$display_option['next_previous_button'] = $settings[ $skin . '_next_previous_button' ] = '1';
			} else {
				$display_option['next_previous_button'] = $settings[ $skin . '_next_previous_button' ] = '0';
			}
			if ( isset( $settings[ $skin . '_like_grid' ] ) && $settings[ $skin . '_like_grid' ] == '1' ) {
				$display_option[ $skin . '_like_grid' ] = $settings[ $skin . '_like_grid' ] = '1';
			} else {
				$display_option[ $skin . '_like_grid' ] = $settings[ $skin . '_like_grid' ] = '0';
			}
			if ( isset( $settings[ $skin . '_geolocation' ] ) && $settings[ $skin . '_geolocation' ] == '1' ) {
				$display_option['geolocation'] = $settings[ $skin . '_geolocation' ] = '1';
			}
			if ( isset( $settings[ $skin . '_load_more_button' ] ) && $settings[ $skin . '_load_more_button' ] == '1' ) {
				$display_option['load_more_button'] = $settings[ $skin . '_load_more_button' ] = '1';
			} else {
				$display_option['load_more_button'] = $settings[ $skin . '_load_more_button' ] = '0';
			}
			if ( isset( $settings[ $skin . '_include_local_time' ] ) && $settings[ $skin . '_include_local_time' ] == '1' ) {
				$display_option['include_local_time'] = $settings[ $skin . '_include_local_time' ] = '1';
			} else {
				$display_option['include_local_time'] = $settings[ $skin . '_include_local_time' ] = '0';
			}
			if ( isset( $settings[ $skin . '_display_label' ] ) && $settings[ $skin . '_display_label' ] == '1' ) {
				$display_option['display_label'] = $settings[ $skin . '_display_label' ] = '1';
			} else {
				$display_option['display_label'] = $settings[ $skin . '_display_label' ] = '0';
			}
			if ( isset( $settings[ $skin . '_reason_for_cancellation' ] ) && $settings[ $skin . '_reason_for_cancellation' ] == '1' ) {
				$display_option['reason_for_cancellation'] = $settings[ $skin . '_reason_for_cancellation' ] = '1';
			} else {
				$display_option['reason_for_cancellation'] = $settings[ $skin . '_reason_for_cancellation' ] = '0';
			}
			if ( isset( $settings[ $skin . '_include_events_times' ] ) && $settings[ $skin . '_include_events_times' ] == '1' ) {
				$display_option['include_events_times'] = $settings[ $skin . '_include_events_times' ] = '1';
			} else {
				$display_option['include_events_times'] = $settings[ $skin . '_include_events_times' ] = '0';
			}
			if ( isset( $settings[ $skin . '_map_on_top' ] ) && $settings[ $skin . '_map_on_top' ] == '1' ) {
				$display_option['map_on_top'] = $settings[ $skin . '_map_on_top' ] = '1';
			} else {
				$display_option['map_on_top'] = $settings[ $skin . '_map_on_top' ] = '0';
			}
			if ( isset( $settings[ $skin . '_set_geolocation' ] ) && $settings[ $skin . '_set_geolocation' ] == '1' ) {
				$display_option['set_geolocation'] = $settings[ $skin . '_set_geolocation' ] = '1';
			} else {
				$display_option['set_geolocation'] = $settings[ $skin . '_set_geolocation' ] = '0';
			}
			if ( isset( $settings[ $skin . '_month_divider' ] ) && $settings[ $skin . '_month_divider' ] == '1' ) {
				$display_option['month_divider'] = $settings[ $skin . '_month_divider' ] = '1';
			} else {
				$display_option['month_divider'] = $settings[ $skin . '_month_divider' ] = '0';
			}
			if ( isset( $settings[ $skin . '_toggle_month_divider' ] ) && $settings[ $skin . '_toggle_month_divider' ] == '1' ) {
				$display_option['toggle_month_divider'] = $settings[ $skin . '_toggle_month_divider' ] = '1';
			} else {
				$display_option['toggle_month_divider'] = $settings[ $skin . '_toggle_month_divider' ] = '0';
			}
			if ( isset( $settings[ 'view_mode' ] ) ) {
				$display_option[ 'view_mode' ] = $settings[ 'view_mode' ];
			}
			if ( isset( $settings[ 'map_zoom' ] ) ) {
				$display_option[ 'map_zoom' ] = $settings[ 'map_zoom' ];
			}
			if ( isset( $settings[ 'map_center_lat' ] ) ) {
				$display_option[ 'map_center_lat' ] = $settings[ 'map_center_lat' ];
			}
			if ( isset( $settings[ 'map_center_long' ] ) ) {
				$display_option[ 'map_center_long' ] = $settings[ 'map_center_long' ];
			}
			// search form options
			if ( isset( $settings[ $skin . '_sf_status' ] ) && $settings[ $skin . '_sf_status' ] == '1' ) {
				$search_form[ $skin . '_sf_status' ] = '1';
			}
			if ( isset( $settings[ $skin . '_sf_display_label' ] ) && $settings[ $skin . '_sf_display_label' ] == '1' ) {
				$search_form[ $skin . '_sf_display_label' ] = '1';
			}
			if ( isset( $settings[ $skin . '_category_type' ] ) ) {
				$search_form[ $skin . '_category_type' ] = $settings[ $skin . '_category_type' ];
			}
			if ( isset( $settings[ $skin . '_location_type' ] ) ) {
				$search_form[ $skin . '_location_type' ] = $settings[ $skin . '_location_type' ];
			}
			if ( isset( $settings[ $skin . '_organizer_type' ] ) ) {
				$search_form[ $skin . '_organizer_type' ] = $settings[ $skin . '_organizer_type' ];
			}
			if ( isset( $settings[ $skin . '_speaker_type' ] ) ) {
				$search_form[ $skin . '_speaker_type' ] = $settings[ $skin . '_speaker_type' ];
			}
			if ( isset( $settings[ $skin . '_tag_type' ] ) ) {
				$search_form[ $skin . '_tag_type' ] = $settings[ $skin . '_tag_type' ];
			}
			if ( isset( $settings[ $skin . '_label_type' ] ) ) {
				$search_form[ $skin . '_label_type' ] = $settings[ $skin . '_label_type' ];
			}
			if ( isset( $settings[ $skin . '_address_search_type' ] ) ) {
				$search_form[ $skin . '_address_search_type' ] = $settings[ $skin . '_address_search_type' ];
			}
			if ( isset( $settings[ $skin . '_address_search_placeholder' ] ) ) {
				$search_form[ $skin . '_address_search_placeholder' ] = $settings[ $skin . '_address_search_placeholder' ];
			}
			if ( isset( $settings[ $skin . '_event_cost_type' ] ) ) {
				$search_form[ $skin . '_event_cost_type' ] = $settings[ $skin . '_event_cost_type' ];
			}
			if ( isset( $settings[ $skin . '_month_filter_type' ] ) ) {
				$search_form[ $skin . '_month_filter_type' ] = $settings[ $skin . '_month_filter_type' ];
			}
			if ( isset( $settings[ $skin . '_time_filter_type' ] ) ) {
				$search_form[ $skin . '_time_filter_type' ] = $settings[ $skin . '_time_filter_type' ];
			}
			if ( isset( $settings[ $skin . '_text_search_type' ] ) ) {
				$search_form[ $skin . '_text_search_type' ] = $settings[ $skin . '_text_search_type' ];
				if ( $search_form[ $skin . '_text_search_type' ] == 'dropdown' ) {
					$search_form[ $skin . '_text_search_type' ] = 'text_input';
				}
				if ( isset( $settings[ $skin . '_text_search_placeholder' ] ) ) {
					$search_form[ $skin . '_text_search_placeholder' ] = $settings[ $skin . '_text_search_placeholder' ];
				}
			}

			if ( ! empty( $settings['skin'] ) ) {
				isset( $settings['filter_options_categories'] ) && ! is_array( $settings['filter_options_categories'] ) ? $settings['filter_options_categories'] 	= [ $settings['filter_options_categories'] ] : '';
				isset( $settings['filter_options_locations'] ) && ! is_array( $settings['filter_options_locations'] ) ? $settings['filter_options_locations']    	= [ $settings['filter_options_locations'] ] : '';
				isset( $settings['filter_options_organizers'] ) && ! is_array( $settings['filter_options_organizers'] ) ? $settings['filter_options_organizers'] 	= [ $settings['filter_options_organizers'] ] : '';
				isset( $settings['filter_options_labels'] ) && ! is_array( $settings['filter_options_labels'] ) ? $settings['filter_options_labels']             	= [ $settings['filter_options_labels'] ] : '';
				isset( $settings['filter_options_tags'] ) && ! is_array( $settings['filter_options_tags'] ) ? $settings['filter_options_tags']                   	= [ $settings['filter_options_tags'] ] : '';
				isset( $settings['filter_options_authors'] ) && ! is_array( $settings['filter_options_authors'] ) ? $settings['filter_options_authors']          	= [ $settings['filter_options_authors'] ] : '';
				isset( $settings['filter_options_dates'] ) && ! is_array( $settings['filter_options_dates'] ) ? $settings['filter_options_dates']                	= [ $settings['filter_options_dates'] ] : '';
				isset( $settings['filter_options_occurrence'] ) && ! is_array( $settings['filter_options_occurrence'] ) ? $settings['filter_options_occurrence']	= [ $settings['filter_options_occurrence'] ] : '';
				$args = [
					'display_options' 	=> [
						$display_option,
					],
					'search_form'     	=> [
						$search_form,
					],
					'filter_options' 	=> [
							'categories' 	=> isset( $settings['filter_options_categories'] ) ? implode( ',', $settings['filter_options_categories'] ) : '',
							'locations' 	=> isset( $settings['filter_options_locations'] ) ? implode( ',', $settings['filter_options_locations'] ) : '',
							'organizers' 	=> isset( $settings['filter_options_organizers'] ) ? implode( ',', $settings['filter_options_organizers'] ) : '',
							'label'      	=> isset( $settings['filter_options_labels'] ) ? implode( ',', $settings['filter_options_labels'] ) : '',
							'tags'       	=> isset( $settings['filter_options_tags'] ) ? implode( ',', $settings['filter_options_tags'] ) : '',
							'authors'    	=> isset( $settings['filter_options_authors'] ) ? implode( ',', $settings['filter_options_authors'] ) : '',
							'dates'			=> isset( $settings['filter_options_dates'] ) ? implode( ',', $settings['filter_options_dates'] ) : '',
							'occurrence' 	=> isset( $settings['filter_options_occurrence'] ) ? implode( ',', $settings['filter_options_occurrence'] ) : '',
					],
				];
				$sf_options = array(
					'category'    		=> array( 'type' => 'dropdown' ),
					'text_search' 		=> array( 'type' => 'text_input' ),
				);
				// Create Default Calendars
				$e_skin                                       							= $args['display_options'][0]['skin'];
				$e_args                                       							= [];
				$e_args['skin']                               							= $e_skin;
				$e_args['sk-options'][ $e_skin ]              							= $display_option;
				$e_args['sf-options'][ $e_skin ]['category']  							= isset( $search_form[ $skin . '_category_type' ] ) ? [ 'type' => $search_form[ $skin . '_category_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['location']  							= isset( $search_form[ $skin . '_location_type' ] ) ? [ 'type' => $search_form[ $skin . '_location_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['organizer'] 							= isset( $search_form[ $skin . '_organizer_type' ] ) ? [ 'type' => $search_form[ $skin . '_organizer_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['speaker']								= isset( $search_form[ $skin . '_speaker_type' ] ) ? [ 'type' => $search_form[ $skin . '_speaker_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['tag'] 								= isset( $search_form[ $skin . '_tag_type' ] ) ? [ 'type' => $search_form[ $skin . '_tag_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['label']     							= isset( $search_form[ $skin . '_label_type' ] ) ? [ 'type' => $search_form[ $skin . '_label_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['address_search']['type']				= isset( $search_form[ $skin . '_address_search_type' ] ) ? $search_form[ $skin . '_address_search_type' ] : '0';
				$e_args['sf-options'][ $e_skin ]['address_search']['placeholder']		= isset( $search_form[ $skin . '_address_search_placeholder' ] ) ? $search_form[ $skin . '_address_search_placeholder' ] : '';
				$e_args['sf-options'][ $e_skin ]['event_cost'] 							= isset( $search_form[ $skin . '_event_cost_type' ] ) ? [ 'type' => $search_form[ $skin . '_event_cost_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['month_filter'] 						= isset( $search_form[ $skin . '_month_filter_type' ] ) ? [ 'type' => $search_form[ $skin . '_month_filter_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['time_filter'] 						= isset( $search_form[ $skin . '_time_filter_type' ] ) ? [ 'type' => $search_form[ $skin . '_time_filter_type' ] ] : [ 'type' => 0 ];
				$e_args['sf-options'][ $e_skin ]['text_search']['type']					= isset( $search_form[ $skin . '_text_search_type' ] ) ? $search_form[ $skin . '_text_search_type' ] : '0';
				$e_args['sf-options'][ $e_skin ]['text_search']['placeholder']			= isset( $search_form[ $skin . '_text_search_placeholder' ] ) ? $search_form[ $skin . '_text_search_placeholder' ] : '';

				if ( $args['filter_options']['dates'] == 'include-expired-events' ) {
					$e_args['show_past_events']         = 1;
					$e_args['show_only_past_events']    = 0;
					$e_args['show_only_ongoing_events'] = 0;
					$e_args['show_ongoing_events']		= 0;
				} elseif ( $args['filter_options']['dates'] == 'show-only-ongoing-events' ) {
					$e_args['show_only_ongoing_events'] = 1;
					$e_args['show_past_events']         = 0;
					$e_args['show_only_past_events']    = 0;
					$e_args['show_ongoing_events']		= 1;
				} elseif ( $args['filter_options']['dates'] == 'show-only-expired-events' ) {
					$e_args['show_only_past_events']    = 1;
					$e_args['show_past_events']         = 1;
					$e_args['show_only_ongoing_events'] = 0;
					$e_args['show_ongoing_events']		= 0;
				} elseif ( $args['filter_options']['dates'] == 'show-ongoing-events' ) {
					$e_args['show_only_past_events']    = 0;
					$e_args['show_past_events']         = 1;
					$e_args['show_only_ongoing_events'] = 0;
					$e_args['show_ongoing_events']		= 1;
				} else {
					$e_args['show_past_events']         = 0;
					$e_args['show_only_past_events']    = 0;
					$e_args['show_only_ongoing_events'] = 0;
					$e_args['show_ongoing_events']		= 0;
				}

				$e_args['show_only_one_occurrence'] = $settings['filter_options_occurrence']['0'];

				$e_args['sf_status']             	= isset( $search_form[ $skin . '_sf_status' ] ) ? $search_form[ $skin . '_sf_status' ] : '0';
				$e_args['sf_display_label']			= isset( $search_form[ $skin . '_sf_display_label' ] ) ? $search_form[ $skin . '_sf_display_label' ] : '0';
				$e_args['category']              	= isset( $args['filter_options']['categories'] ) ? $args['filter_options']['categories'] : '';
				$e_args['location']              	= isset( $args['filter_options']['locations'] ) ? $args['filter_options']['locations'] : '';
				$e_args['organizer']             	= isset( $args['filter_options']['organizers'] ) ? $args['filter_options']['organizers'] : '';
				$e_args['label']                 	= isset( $args['filter_options']['label'] ) ? $args['filter_options']['label'] : '';
				$e_args['tag']                   	= isset( $args['filter_options']['tags'] ) ? $args['filter_options']['tags'] : '';
				$e_args['author']                	= isset( $args['filter_options']['authors'] ) ? $args['filter_options']['authors'] : '';
				$e_args['occurrence']				= isset( $args['filter_options']['occurrence'] ) ? $args['filter_options']['occurrence'] : '';
				$e_args['sk-options'][ $e_skin ] 	= $display_option;
				$new            = new \MEC_render();
				$new->post_atts = $e_args;
				echo $new->shortcode( [ 'id' => md5( microtime() ) ] );
				$bootstrap_class = new \MEC_Shortcode_Builder_Bootstrap();
				$bootstrap_class->load_footer();
			}

			if ( Plugin::$instance->editor->is_edit_mode() ) {
				echo '<script>
				jQuery(document).ready(function () {
					jQuery(".mec-search-form.mec-totalcal-box").find(".mec-minmax-event-cost").parent().find(".mec-text-address-search").addClass("with-mec-cost");
					jQuery(".mec-search-form.mec-totalcal-box").find(".mec-text-address-search").parent().find(".mec-minmax-event-cost").addClass("with-mec-address");
					jQuery(".mec-full-calendar-search-ends").find(".mec-text-input-search").parent().find(".mec-tab-loader").removeClass("col-md-12").addClass("col-md-6");
					jQuery(".mec-search-form.mec-totalcal-box").find(".mec-text-input-search").parent().find(".mec-date-search").parent().find(".mec-text-input-search").addClass("col-md-6");
					jQuery(".mec-search-form.mec-totalcal-box").find(".mec-text-input-search").parent().find(".mec-time-picker-search").parent().find(".mec-text-input-search").addClass("col-md-6");
					jQuery(".mec-full-calendar-search-ends").find(".mec-text-input-search").addClass("col-md-12").parent().find(".mec-time-picker-search").addClass("col-md-6");
					jQuery(".mec-search-form.mec-totalcal-box").find(".mec-date-search").parent().find(".mec-time-picker-search").addClass("with-mec-date-search");
					jQuery(".mec-search-form.mec-totalcal-box").find(".mec-time-picker-search").parent().find(".mec-date-search").addClass("with-mec-time-picker");
				});
				</script>';
			}

		}
	}

endif;