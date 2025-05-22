<?php
namespace Elementor;

namespace MEC_Single_Builder\Inc\Admin\Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;



class ESB_RSVP extends \Elementor\Widget_Base {

	public $mec_base_selector;
	public $mec_base_modification_selector;

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name(){

		return 'event_rsvp';
	}

	/**
	 * Retrieve Alert widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title(){

		return __('Single Event RSVP Module', 'mec-single-builder');
	}

	/**
	 * Retrieve Alert widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon(){

		return 'eicon-kit-details';
	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories(){

		return ['single_builder'];
	}

	/**
	 * Register Alert widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls(){

		$this->mec_base_selector = "{{WRAPPER}} .mec-rsvp-form-box";
		$this->mec_base_modification_selector = "{{WRAPPER}} .mec-rsvp-modification";

		$this->register_title_controls();
		$this->register_box_controls();
		$this->register_form_controls();
		$this->register_button_controls();
		$this->register_messages_controls();
		$this->register_answers_controls();
		$this->register_attendees_controls();

	}

	public function register_title_controls(){

		$title_selector = $this->mec_base_selector." form > h4,"
			. $this->mec_base_modification_selector." > h4";
		$title_before_selector = $this->mec_base_selector." form > h4:before,"
			. $this->mec_base_modification_selector." > h4:before";

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
					$title_selector => 'display: {{VALUE}} !important;',
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
					$title_selector => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_widget_title_typography',
				'label' 	=> __('Title Typography', 'mec-single-builder'),
				'selector' 	=> $title_selector,
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
					$title_selector => 'color: {{VALUE}}',
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
				'selector' 		=> $title_selector,
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
					$title_before_selector => 'border-color: {{VALUE}} !important',
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
					$title_before_selector => 'left: {{VALUE}}; margin: 0;',
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
					$title_before_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					$title_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
			'mec_rsvp_widget_title_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$title_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'mec_widget_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					$title_selector => 'background: {{VALUE}} !important;',
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

	}

	public function register_box_controls(){

		$box_selector = $this->mec_base_selector;

		$this->start_controls_section(
			'mec_rsvp_box',
			array(
				'label' 	=> __('RSVP Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_rsvp_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					$box_selector => 'background: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_rsvp_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$box_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'mec_rsvp_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$box_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_rsvp_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> $box_selector,
			]
		);

		$this->add_control(
			'mec_rsvp_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$box_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_rsvp_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> $box_selector,
			]
		);

		$this->end_controls_section();
	}

	public function register_form_controls(){

		$inputs_selector = '.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp input[type=date],
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp input[type=email],
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp input[type=number],
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp input[type=password],
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp input[type=tel],
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp input[type=text],
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp select,
			.mec-single-event ' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp textarea,'
			.
			'.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp input[type=date],
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp input[type=email],
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp input[type=number],
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp input[type=password],
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp input[type=tel],
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp input[type=text],
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp select,
			.mec-single-event ' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp textarea';

		$label_selector = $this->mec_base_selector . ' .mec-rsvp-first label,
			' . $this->mec_base_selector . ' .mec-event-ticket-description,
			' . $this->mec_base_selector . ' .mec-rsvp-ticket-variation span,
			' . $this->mec_base_selector . ' .mec-events-meta-group-rsvp label,'
			.
			$this->mec_base_modification_selector . ' .mec-rsvp-first label,
			' . $this->mec_base_modification_selector . ' .mec-event-ticket-description,
			' . $this->mec_base_modification_selector . ' .mec-rsvp-ticket-variation span,
			' . $this->mec_base_modification_selector . ' .mec-events-meta-group-rsvp label';

		$maximum_attendees_selector = $this->mec_base_selector .' .mec-max-attendees-count,'.
			$this->mec_base_modification_selector .' .mec-max-attendees-count';

		$messages_selector = $this->mec_base_selector .' .mec-rsvp-message-box > div,'
			. $this->mec_base_modification_selector .' .mec-rsvp-message-box > div';

		/** label Begin */
		$this->start_controls_section(
			'mac_rsvp_label_typography',
			array(
				'label' 	=> __('Form Typography', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'mac_rsvp_fields_width',
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
					$inputs_selector => 'width: {{SIZE}}{{UNIT}} !important;',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_rsvp_label_typography_title',
				'label' 	=> __('Label Typography', 'mec-single-builder'),
				'selector' 	=> $label_selector,
			]
		);

		$this->add_control(
			'mac_rsvp_label_typography_color',
			[
				'label' 		=> __('Label Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$label_selector => 'color: {{VALUE}} !important;',
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
				'name' 		=> 'mac_rsvp_maximum_attendees_typography_title',
				'label' 	=> __('Maximum Attendees Typography', 'mec-single-builder'),
				'selector' 	=> $maximum_attendees_selector,
			]
		);

		$this->add_control(
			'mac_rsvp_available_maximum_attendees_typography_color',
			[
				'label' 		=> __('Available Tickets Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$maximum_attendees_selector => 'color: {{VALUE}} !important;',
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
				'name' 		=> 'mac_rsvp_message_typography_title',
				'label' 	=> __('Message Typography', 'mec-single-builder'),
				'selector' 	=> $messages_selector,
			]
		);

		$this->add_control(
			'mac_rsvp_message_typography_color',
			[
				'label' 		=> __('Message Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$messages_selector => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mac_rsvp_message_typography_bg',
			[
				'label' 		=> __('Message Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$messages_selector => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mac_rsvp_fields_space',
			array(
				'label' 	=> __('Fields Spacing', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);


		$this->add_responsive_control(
			'mac_rsvp_fields_space_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$inputs_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mac_rsvp_fields_space_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$inputs_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mac_rsvp_fields_space_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> $inputs_selector,
			]
		);

		$this->add_control(
			'mac_rsvp_fields_space_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$inputs_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mac_rsvp_fields_space_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> $inputs_selector,
			]
		);

		$this->end_controls_section();
	}

	public function register_button_controls(){

		$button_selector = $this->mec_base_selector . ' button,'
			. $this->mec_base_modification_selector . ' button';
		$button_hover_selector = $this->mec_base_selector . ' button:hover,'
			. $this->mec_base_modification_selector . ' button:hover';

		$button_back_selector = $this->mec_base_selector . ' button.mec-move-to-step-1,'
			. $this->mec_base_modification_selector . ' button.mec-move-to-step-1';
		$button_back_hover_selector = $this->mec_base_selector . ' button.mec-move-to-step-1:hover,'
			. $this->mec_base_modification_selector . ' button.mec-move-to-step-1:hover';

		$this->start_controls_section(
			'mec_rsvp_btn_typography',
			array(
				'label' 	=> __('RSVP Button', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_rsvp_btn_typography_title',
				'label' 	=> __('Button Typography', 'mec-single-builder'),
				'selector' 	=> $button_selector,
			]
		);

		$this->add_control(
			'mec_rsvp_btn_typography_color',
			[
				'label' 		=> __('Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_selector => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_rsvp_btn_typography_color_hover',
			[
				'label' 		=> __('Text Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_hover_selector => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_rsvp_btn_typography_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$button_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_rsvp_btn_typography_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$button_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_rsvp_btn_box_width',
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
					$button_selector => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'mec_rsvp_btn_typography_bgcolor',
			[
				'label' 		=> __('Button Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mec_rsvp_btn_typography_bgcolor_hover',
			[
				'label' 		=> __('Button Hover Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_hover_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_rsvp_btn_typo_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> $button_selector,
			]
		);

		$this->add_control(
			'mec_rsvp_btn_typo_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$button_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_rsvp_btn_typo_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> $button_selector,
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'mec_back_rsvp_btn_typography',
			array(
				'label' 	=> __('Back Button', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_back_rsvp_btn_typography_title',
				'label' 	=> __('Button Typography', 'mec-single-builder'),
				'selector' 	=> $button_back_selector,
			]
		);

		$this->add_control(
			'mec_back_rsvp_btn_typography_color',
			[
				'label' 		=> __('Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_back_selector => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'mec_back_rsvp_btn_typography_color_hover',
			[
				'label' 		=> __('Text Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_back_hover_selector => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_back_rsvp_btn_typography_padding', //param_name
			[
				'label' 		=> __('Button Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$button_back_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_back_rsvp_btn_typography_margin', //param_name
			[
				'label' 		=> __('Button Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$button_back_selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_back_rsvp_btn_box_width',
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
					$button_back_selector => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mec_back_rsvp_btn_typography_bgcolor',
			[
				'label' 		=> __('Button Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_back_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mec_back_rsvp_btn_typography_bgcolor_hover',
			[
				'label' 		=> __('Button Hover Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$button_back_hover_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_back_rsvp_btn_typo_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> $button_back_selector,
			]
		);

		$this->add_control(
			'mec_back_rsvp_btn_typo_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$button_back_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_back_rsvp_btn_typo_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> $button_back_selector,
			]
		);

		$this->end_controls_section();
	}

	public function register_messages_controls(){

		$error_selector = $this->mec_base_selector .' .mec-error';
		$success_selector = $this->mec_base_selector .' .mec-success';
		$info_selector = $this->mec_base_selector .' .info-msg';

		$this->start_controls_section(
			'mac_rsvp_messages',
			array(
				'label' 	=> __('Messages Styling', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mac_rsvp_messages_typography',
				'label' 	=> __('Typography', 'mec-single-builder'),
				'selector' 	=> "$error_selector,$success_selector,$info_selector",
			]
		);

		$this->add_control(
			'mac_rsvp_messages_error_color',
			[
				'label' 		=> __('Error Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$error_selector => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_rsvp_messages_error_bgcolor',
			[
				'label' 		=> __('Error Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$error_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_rsvp_messages_success_color',
			[
				'label' 		=> __('Success Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$success_selector => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_rsvp_messages_success_bgcolor',
			[
				'label' 		=> __('Success Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$success_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_rsvp_messages_info_color',
			[
				'label' 		=> __('Info Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$info_selector => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'mac_rsvp_messages_info_bgcolor',
			[
				'label' 		=> __('Info Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$info_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mac_rsvp_messages_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> "$error_selector,$success_selector,$info_selector",
			]
		);

		$this->add_control(
			'mac_rsvp_messages_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					"$error_selector,$success_selector,$info_selector" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mac_rsvp_messages_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> "$error_selector,$success_selector,$info_selector",
			]
		);

		$this->add_responsive_control(
			'mac_rsvp_messages_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					"$error_selector,$success_selector,$info_selector" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mac_rsvp_messages_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					"$error_selector,$success_selector,$info_selector" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_answers_controls(){

		$group_id = 'mac_rsvp_answers';
		$selector = $this->mec_base_selector . ' .mec-rsvp-answer .mec-rsvp-answers-details-links > div';
		$hover_selector = $this->mec_base_selector . ' .mec-rsvp-answer .mec-rsvp-answers-details-links  > div:hover';

		$active_selector = $this->mec_base_selector . ' .mec-rsvp-answer .mec-rsvp-answers-details-links > div.active';
		$active_hover_selector = $this->mec_base_selector . ' .mec-rsvp-answer .mec-rsvp-answers-details-links  > div.active:hover';

		$this->start_controls_section(
			$group_id,
			array(
				'label' 	=> __('Answers Styling', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			$group_id . 'active_color',
			[
				'label' 		=> __('Active - Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$active_selector => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			$group_id . 'active_bgcolor',
			[
				'label' 		=> __('Active - Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$active_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> $group_id . '_active_border',
				'label' 		=> __('Active - Border', 'mec-single-builder'),
				'selector' 		=> $active_selector,
			]
		);

		$this->add_control(
			$group_id . 'active_icon_color',
			[
				'label' 		=> __('Active - Icon Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$active_selector.' label::before' => 'border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			$group_id . 'active_icon_color_hover',
			[
				'label' 		=> __('Active - Icon Color Hover', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$active_hover_selector .' label::before' => 'border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			$group_id . 'active_bgcolor_hover',
			[
				'label' 		=> __('Active - Background Color Hover', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$active_hover_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> $group_id . '_active_border_hover',
				'label' 		=> __('Border hover', 'mec-single-builder'),
				'selector' 		=> $active_hover_selector,
			]
		);

		////////

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $group_id.'_typography',
				'label' 	=> __('Typography', 'mec-single-builder'),
				'selector' 	=> $selector,
			]
		);

		$this->add_control(
			$group_id . '_color',
			[
				'label' 		=> __('Text Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$selector => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			$group_id . '_bgcolor',
			[
				'label' 		=> __('Background Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> $group_id . '_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> $selector,
			]
		);

		$this->add_control(
			$group_id . '_icon_color',
			[
				'label' 		=> __('Icon Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$selector.' label::before' => 'border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			$group_id . '_icon_color_hover',
			[
				'label' 		=> __('Icon Color Hover', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$hover_selector .' label::before' => 'border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			$group_id . '_bgcolor_hover',
			[
				'label' 		=> __('Background Color Hover', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$hover_selector => 'background: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> $group_id . '_border_hover',
				'label' 		=> __('Border hover', 'mec-single-builder'),
				'selector' 		=> $hover_selector,
			]
		);

		$this->add_control(
			$group_id . '_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> $group_id . '_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> $selector,
			]
		);

		$this->add_responsive_control(
			$group_id . '_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$group_id . '_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public function register_attendees_controls(){

		$group_id = '';
		$selector = $this->mec_base_selector." .mec-attendees .mec-attendee";
		$hover_selector = $this->mec_base_selector." .mec-attendees .mec-attendee:hover";

		$this->start_controls_section(
			$group_id . '_typography',
			array(
				'label' 	=> __('Attendees', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $group_id . '_typography',
				'label' 	=> __('Attendees Typography', 'mec-single-builder'),
				'selector' 	=> $selector,
			]
		);

		$this->add_control(
			$group_id . '_color',
			[
				'label' 		=> __('Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$selector => 'color: {{VALUE}}',
				],

			]
		);

		$this->add_control(
			$group_id . '_hover_color',
			[
				'label' 		=> __('Hover Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					$hover_selector => 'color: {{VALUE}}',
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
	protected function render(){

		if( Plugin::$instance->editor->is_edit_mode() ){

			echo '<script>
				(function($){
					mec_rsvp_module_init($);
				})(jQuery);
			</script>';
		}

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'rsvp-form' );
	}
}
