<?php
namespace Elementor;

namespace MEC_Single_Builder\Inc\Admin\Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;



class ESB_Booking extends \Elementor\Widget_Base
{

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{

		return 'event_booking';
	}

	/**
	 * Retrieve Alert widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{

		return __('Single Event Booking Module', 'mec-single-builder');
	}

	/**
	 * Retrieve Alert widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{

		return 'eicon-product-price';
	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories()
	{

		return ['single_builder'];
	}

	/**
	 * Register Alert widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'mec_widget_title_typography',
			array(
				'label' 	=> __('Widget Title Settings', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_widget_display', //param_name
			[
				'label' 	=> __('Display Widget Title', 'mec-single-builder'), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'block',
				'options' 	=> [ //value
					'block' 		=> __('block', 'mec-single-builder'),
					'none'  		=> __('none', 'mec-single-builder'),
					'inline'  		=> __( 'inline', 'mec-single-builder' ),
					'inline-block'  => __( 'inline-block', 'mec-single-builder' ),
				],
				'selectors' => [
					'.mec-events-meta-group-booking .mec-booking h4,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'mec_widget_align',
			[
				'label'		=> __( 'Alignment', 'mec-single-builder' ),
				'type'		=> \Elementor\Controls_Manager::CHOOSE,
				'options'	=> [
					'left' => [
						'title' => __( 'Left', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'.mec-events-meta-group-booking .mec-booking h4,
					{{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_title_typography',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-events-meta-group-booking .mec-booking h4,
								{{WRAPPER}} .mec-events-meta-group-booking form>h4',
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_color',
			[
				'label' 		=> __('Title Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-events-meta-group-booking .mec-booking h4,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_widget_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.mec-events-meta-group-booking .mec-booking h4,
									{{WRAPPER}} .mec-events-meta-group-booking form>h4',
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_before_color',
			[
				'label' 		=> __('Title Shape Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-events-meta-group-booking .mec-booking h4:before,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4:before' => 'border-color: {{VALUE}} !important',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_border_position',
			[
				'label'		=> __( 'Alignment', 'mec-single-builder' ),
				'type'		=> \Elementor\Controls_Manager::CHOOSE,
				'options'	=> [
					'0' => [
						'title' => __( 'Left', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-long-arrow-alt-left',
					],
					'calc(50% - 35px)' => [
						'title' => __( 'Center', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-window-minimize',
					],
					'calc(100% - 70px)' => [
						'title' => __( 'Right', 'mec-single-builder' ),
						'icon'	=> 'mec-fa-long-arrow-alt-right',
					],
				],
				'default' => 'calc(50% - 35px)',
				'selectors' => [
					'.mec-events-meta-group-booking .mec-booking h4:before,
					{{WRAPPER}} .mec-events-meta-group-booking form>h4:before' => 'left: {{VALUE}}; margin: 0;',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_responsive_control(
			'mec_widget_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-events-meta-group-booking .mec-booking h4,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_control(
			'mec_widget_shape_border_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-events-meta-group-booking .mec-booking h4,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->add_responsive_control(
			'mec_booking_widget_title_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.mec-events-meta-group-booking .mec-booking h4,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'mec_widget_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'.mec-events-meta-group-booking .mec-booking h4,
					 {{WRAPPER}} .mec-events-meta-group-booking form>h4' => 'background: {{VALUE}} !important;',
				],
				'condition' 	=> [ //dependency
					'mec_widget_display' 	=> [
						'block',
						'inline',
						'inline-block',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_booking_box',
			array(
				'label' 	=> __('Booking Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_booking_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking,
					 {{WRAPPER}} .mec-events-meta-group-booking' => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_booking_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking,
					 {{WRAPPER}} .mec-events-meta-group-booking' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_booking_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking,
					 {{WRAPPER}} .mec-events-meta-group-booking' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_booking_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.lity-content .mec-events-meta-group-booking,
				 					{{WRAPPER}} .mec-events-meta-group-booking',
			]
		);

		$this->add_control(
			'mec_booking_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking,
					 {{WRAPPER}} .mec-events-meta-group-booking' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_booking_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-events-meta-group-booking,
								{{WRAPPER}} .mec-events-meta-group-booking',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mac_booking_label_typography',
			array(
				'label' 	=> __('Form Typography', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'mac_booking_fields_width',
			[
				'label' 		=> __( 'Width', 'mec-single-builder' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'.mec-single-event .lity-content .mec-events-meta-group-booking input[type=date],
					 .mec-single-event .lity-content .mec-events-meta-group-booking input[type=email],
					 .mec-single-event .lity-content .mec-events-meta-group-booking input[type=number],
					 .mec-single-event .lity-content .mec-events-meta-group-booking input[type=password],
					 .mec-single-event .lity-content .mec-events-meta-group-booking input[type=tel],
					 .mec-single-event .lity-content .mec-events-meta-group-booking input[type=text],
					 .mec-single-event .lity-content .mec-events-meta-group-booking select,
					 .mec-single-event .lity-content .mec-events-meta-group-booking textarea,
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking input[type=date],
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking input[type=email],
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking input[type=number],
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking input[type=password],
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking input[type=tel],
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking input[type=text],
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking select,
					 .mec-single-event {{WRAPPER}} .mec-events-meta-group-booking textarea' => 'width: {{SIZE}}{{UNIT}} !important;',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_label_typography_title',
				'label' 	=> __('Label Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-book-first label,
								.lity-content .mec-event-ticket-description,
								.lity-content .mec-book-ticket-variation span,
								.lity-content .mec-events-meta-group-booking label,
								{{WRAPPER}} .mec-book-first label,
								{{WRAPPER}} .mec-event-ticket-description,
								{{WRAPPER}} .mec-book-ticket-variation span,
								{{WRAPPER}} .mec-events-meta-group-booking label',
			]
		);

		$this->add_control(
			'mac_booking_label_typography_color',
			[
				'label' 		=> __('Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-book-first label,
					 .lity-content .mec-event-ticket-description,
					 .lity-content .mec-book-ticket-variation span,
					 .lity-content .mec-events-meta-group-booking label,
					 {{WRAPPER}} .mec-book-first label,
					 {{WRAPPER}}  .mec-event-ticket-description,
					 {{WRAPPER}} .mec-book-ticket-variation span,
					 {{WRAPPER}} .mec-events-meta-group-booking label' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_ticket_typography_title',
				'label' 	=> __('Ticket Name Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-event-ticket-name,
								{{WRAPPER}} .mec-event-ticket-name',
			]
		);

		$this->add_control(
			'mac_booking_ticket_typography_color',
			[
				'label' 		=> __('Tickat Name Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-event-ticket-name,
					 {{WRAPPER}} .mec-event-ticket-name' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_price_typography_title',
				'label' 	=> __('Price Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-event-ticket-price,
								{{WRAPPER}} .mec-event-ticket-price',
			]
		);

		$this->add_control(
			'mac_booking_price_typography_color',
			[
				'label' 		=> __('Price Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-event-ticket-price,
					 {{WRAPPER}} .mec-event-ticket-price' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_available_tickets_typography_title',
				'label' 	=> __('Available Tickets Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-event-ticket-available,
								{{WRAPPER}} .mec-event-ticket-available',
			]
		);

		$this->add_control(
			'mac_booking_available_tickets_typography_color',
			[
				'label' 		=> __('Available Tickets Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-event-ticket-available,
					 {{WRAPPER}} .mec-event-ticket-available' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_available_tickets_number_typography_title',
				'label' 	=> __('Available Tickets Number Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-event-ticket-available span,
								{{WRAPPER}} .mec-event-ticket-available span',
			]
		);

		$this->add_control(
			'mac_booking_available_tickets_number_typography_color',
			[
				'label' 		=> __('Available Tickets Number Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-event-ticket-available span,
					{{WRAPPER}} .mec-event-ticket-available span' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_control(
			'hr3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_message_typography_title',
				'label' 	=> __('Message Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-conent .info-msg,
				 				{{WRAPPER}} .info-msg',
			]
		);

		$this->add_control(
			'mac_booking_message_typography_color',
			[
				'label' 		=> __('Message Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-conent .info-msg,
					 {{WRAPPER}} .info-msg' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mac_booking_message_typography_bg',
			[
				'label' 		=> __('Message Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-conent .info-msg, {{WRAPPER}} .info-msg' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mac_booking_fields_space',
			array(
				'label' 	=> __('Fields Spacing', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);


		$this->add_responsive_control(
			'mac_booking_fields_space_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content input[type="text"],
					.lity-content input[type="date"],
					.lity-content input[type="number"],
					.lity-content input[type="email"],
					.lity-content input[type="password"],
					.lity-content input[type="tel"],
					.lity-content textarea,
					.lity-content select,
					{{WRAPPER}} .mec-events-meta-group-booking input[type="text"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="date"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="number"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="email"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="password"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="tel"],
					{{WRAPPER}} .mec-events-meta-group-booking textarea,
					{{WRAPPER}} .mec-events-meta-group-booking select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mac_booking_fields_space_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content input[type="text"],
					.lity-content input[type="date"],
					.lity-content input[type="number"],
					.lity-content input[type="email"],
					.lity-content input[type="password"],
					.lity-content input[type="tel"],
					.lity-content textarea,
					.lity-content select,
					{{WRAPPER}} .mec-events-meta-group-booking input[type="text"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="date"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="number"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="email"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="password"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="tel"],
					{{WRAPPER}} .mec-events-meta-group-booking textarea,
					{{WRAPPER}} .mec-events-meta-group-booking select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mac_booking_fields_space_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=>
					'.lity-content input[type="text"],
					.lity-content input[type="date"],
					.lity-content input[type="number"],
					.lity-content input[type="email"],
					.lity-content input[type="password"],
					.lity-content input[type="tel"],
					.lity-content textarea,
					.lity-content select,
					{{WRAPPER}} .mec-events-meta-group-booking input[type="text"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="date"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="number"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="email"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="password"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="tel"],
					{{WRAPPER}} .mec-events-meta-group-booking textarea,
					{{WRAPPER}} .mec-events-meta-group-booking select',
			]
		);

		$this->add_control(
			'mac_booking_fields_space_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content input[type="text"],
					.lity-content input[type="date"],
					.lity-content input[type="number"],
					.lity-content input[type="email"],
					.lity-content input[type="password"],
					.lity-content input[type="tel"],
					.lity-content textarea,
					.lity-content select,
					{{WRAPPER}} .mec-events-meta-group-booking input[type="text"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="date"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="number"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="email"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="password"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="tel"],
					{{WRAPPER}} .mec-events-meta-group-booking textarea,
					{{WRAPPER}} .mec-events-meta-group-booking select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mac_booking_fields_space_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=>
					'.lity-content input[type="text"],
					.lity-content input[type="date"],
					.lity-content input[type="number"],
					.lity-content input[type="email"],
					.lity-content input[type="password"],
					.lity-content input[type="tel"],
					.lity-content textarea,
					.lity-content select,
					{{WRAPPER}} .mec-events-meta-group-booking input[type="text"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="date"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="number"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="email"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="password"],
					{{WRAPPER}} .mec-events-meta-group-booking input[type="tel"],
					{{WRAPPER}} .mec-events-meta-group-booking textarea,
					{{WRAPPER}} .mec-events-meta-group-booking select',
			]
		);






		$this->end_controls_section();

		$this->start_controls_section(
			'mec_booking_btn_typography',
			array(
				'label' 	=> __('Booking Button', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_booking_btn_typography_title',
				'label' 	=> __('Button Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button',
			]
		);

		$this->add_control(
			'mec_booking_btn_typography_color',
			[
				'label' 		=> __('Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_booking_btn_typography_color_hover',
			[
				'label' 		=> __('Text Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button:hover, {{WRAPPER}} .mec-events-meta-group-booking button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_booking_btn_typography_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button:hover, {{WRAPPER}} .mec-events-meta-group-booking button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_booking_btn_typography_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_booking_btn_box_width',
			[
				'label' 		=> __('Button Width', 'mec-single-builder'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_booking_btn_typography_bgcolor',
			[
				'label' 		=> __('Button Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mec_booking_btn_typography_bgcolor_hover',
			[
				'label' 		=> __('Button Hover Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button:hover, {{WRAPPER}} .mec-events-meta-group-booking button:hover' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_booking_btn_typo_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button',
			]
		);

		$this->add_control(
			'mec_booking_btn_typo_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_booking_btn_typo_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-events-meta-group-booking button, {{WRAPPER}} .mec-events-meta-group-booking button',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'mec_back_booking_btn_typography',
			array(
				'label' 	=> __('Back Button', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_back_booking_btn_typography_title',
				'label' 	=> __('Button Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button',
			]
		);

		$this->add_control(
			'mec_back_booking_btn_typography_color',
			[
				'label' 		=> __('Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_back_booking_btn_typography_color_hover',
			[
				'label' 		=> __('Text Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button:hover, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_back_booking_btn_typography_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button:hover, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_back_booking_btn_typography_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_back_booking_btn_box_width',
			[
				'label' 		=> __('Button Width', 'mec-single-builder'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_back_booking_btn_typography_bgcolor',
			[
				'label' 		=> __('Button Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mec_back_booking_btn_typography_bgcolor_hover',
			[
				'label' 		=> __('Button Hover Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button:hover, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button:hover' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_back_booking_btn_typo_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button',
			]
		);

		$this->add_control(
			'mec_back_booking_btn_typo_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_back_booking_btn_typo_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-book-form-back-button, {{WRAPPER}} .mec-events-meta-group-booking .mec-book-form-back-button',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mac_booking_checkout',
			array(
				'label' 	=> __('Checkout Styling', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_checkout_typography_description',
				'label' 	=> __('Price Description Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-events-meta-group-booking ul.mec-book-price-details .mec-book-price-detail-description',
			]
		);

		$this->add_control(
			'mac_booking_checkout_color_description',
			[
				'label' 		=> __('Price Description Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-events-meta-group-booking ul.mec-book-price-details .mec-book-price-detail-description' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_checkout_typography_amount',
				'label' 	=> __('Amount Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-events-meta-group-booking ul.mec-book-price-details li span.mec-book-price-detail-amount',
			]
		);

		$this->add_control(
			'mac_booking_checkout_color_amount',
			[
				'label' 		=> __('Amount Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-events-meta-group-booking ul.mec-book-price-details li span.mec-book-price-detail-amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_checkout_typography_total_price',
				'label' 	=> __('Total Price Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-single-event .mec-events-meta-group-booking .mec-book-price-total',
			]
		);

		$this->add_control(
			'mac_booking_checkout_color_total_price',
			[
				'label' 		=> __('Total Price Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-single-event .mec-events-meta-group-booking .mec-book-price-total' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_checkout_typography_gateway_label',
				'label' 	=> __('Gateway Label Typography', 'mec-single-builder'),
				'selector' 	=> '.mec-wrap .mec-wrap-checkout .mec-book-form-gateways .mec-book-form-gateway-label label',
			]
		);

		$this->add_control(
			'mac_booking_checkout_color_gateway_label',
			[
				'label' 		=> __('Gateway Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.mec-wrap .mec-wrap-checkout .mec-book-form-gateways .mec-book-form-gateway-label label' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mac_booking_messages',
			array(
				'label' 	=> __('Messages Styling', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_booking_messages_typography',
				'label' 	=> __('Typography', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error,
								.lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success,
								.lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg',
			]
		);

		$this->add_control(
			'mac_booking_messages_error_color',
			[
				'label' 		=> __('Error Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_booking_messages_error_bgcolor',
			[
				'label' 		=> __('Error Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_booking_messages_success_color',
			[
				'label' 		=> __('Success Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_booking_messages_success_bgcolor',
			[
				'label' 		=> __('Success Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_booking_messages_info_color',
			[
				'label' 		=> __('Info Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_booking_messages_info_bgcolor',
			[
				'label' 		=> __('Info Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg' => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mac_booking_messages_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=>
					'.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error,
					 .lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success,
					 .lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg',
			]
		);

		$this->add_control(
			'mac_booking_messages_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error,
					 .lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success,
					 .lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mac_booking_messages_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error,
								.lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success,
								.lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg',
			]
		);

		$this->add_responsive_control(
			'mac_booking_messages_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error,
					 .lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success,
					 .lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mac_booking_messages_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'.lity-content .mec-events-meta-group .mec-error, {{WRAPPER}} .mec-events-meta-group .mec-error,
					 .lity-content .mec-events-meta-group .mec-success, {{WRAPPER}} .mec-events-meta-group .mec-success,
					 .lity-content .mec-events-meta-group .info-msg, {{WRAPPER}} .mec-events-meta-group .info-msg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Alert widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'booking-form' );
	}
}
