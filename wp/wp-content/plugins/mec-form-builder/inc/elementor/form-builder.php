<?php

namespace Elementor;

/** No direct access */
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor addon shortcode class
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_addon_elementor_form_builder extends \Elementor\Widget_Base
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
		return 'MEC-form';
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
		return __('MEC Form Builder', 'mec-form-builder');
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
		return 'eicon-form-horizontal';
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
		return array('mec');
	}

	/**
	 * Set widget style.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget style.
	 */
	public function get_style_depends()
	{
		return ['form-builder'];
	}

	/**
	 * Register MEC widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{
		// Display Options
		$this->start_controls_section(
			'display_options',
			array(
				'label' => __('Display Options', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);
		$MEC_main           = new \MEC_main();
		$id                 = get_the_ID();
		$reg_fields			= get_post_meta($id, 'mec_reg_fields', true);
		if (empty($reg_fields)) {
			$reg_fields = [];
		}
		$mec_email 			= false;
		$mec_name  			= false;

		foreach ($reg_fields as $field) {
			if (isset($field['type'])) {
				if ($field['type'] == 'mec_email') {
					$mec_email = true;
				}
				if ($field['type'] == 'name') {
					$mec_name = true;
				}
			} else {
				break;
			}
		}

		if (!$mec_name) {
			$reg_fields[] = [
				'mandatory' => '0',
				'type'      => 'name',
				'label'     => 'Name',
			];
		}
		if (!$mec_email) {
			$reg_fields[] = [
				'mandatory' => '0',
				'type'      => 'mec_email',
				'label'     => 'Email',
			];
		}
		$this->add_control(
			'form_title',
			[
				'label'       => __('Form Title', 'mec-form-builder'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __('Attendees Form', 'mec-form-builder'),
				'label_block' => true,
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'type',
			[
				'label'       => __('Field Type', 'mec-form-builder'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'date'      => __('Date', 'mec-form-builder'),
					'name'      => __('MEC Name', 'mec-form-builder'),
					'mec_email' => __('MEC Email', 'mec-form-builder'),
					'text'      => __('Text', 'mec-form-builder'),
					'file'      => __('File', 'mec-form-builder'),
					'email'     => __('Email', 'mec-form-builder'),
					'tel'       => __('Tel', 'mec-form-builder'),
					'textarea'  => __('Textarea', 'mec-form-builder'),
					'checkbox'  => __('CheckBox', 'mec-form-builder'),
					'radio'     => __('Radio Buttons', 'mec-form-builder'),
					'select'    => __('DropDown', 'mec-form-builder'),
					'agreement' => __('Agreement', 'mec-form-builder'),
					'p'         => __('Paragraph', 'mec-form-builder'),
				],
				'default'     => __('text', 'mec-form-builder'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'mandatory',
			[
				'label'        => __('Required Field', 'mec-form-builder'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'mec-form-builder'),
				'label_off'    => __('Hide', 'mec-form-builder'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'type!' => [
						'name',
						'mec_email',
					],
				],
			]
		);
		$repeater->add_control(
			'label',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Insert a label for this field', 'mec-form-builder'),
				'default' => __('Label', 'mec-form-builder'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'paragraph',
			[
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __('Insert a label for this field', 'mec-form-builder'),
				'default' => __('Descriptions...', 'mec-form-builder'),
				'label_block' => true,
				'condition'   => [
					'type' => [
						'p',
					],
				],
			]
		);
		$repeater->add_control(
			'placeholder',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Insert a placeholder for this field', 'mec-form-builder'),
				'label_block' => true,
				'condition'   => [
					'type' => [
						'name',
						'mec_email',
						'text',
						'email',
						'tel',
						'textarea',
					],
				],
			]
		);
		$repeater->add_control(
			'agreement_desc',
			[
				'type'        => \Elementor\Controls_Manager::RAW_HTML,
				'raw'         => __('Instead of %s, the page title with a link will be show.', 'mec-form-builder'),
				'label_block' => true,
				'condition'   => [
					'type' => [
						'agreement',
					],
				],
			]
		);
		$repeater->add_control(
			'options',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'title'       => __('Options', 'mec-form-builder'),
				'placeholder' => __('first item,second item, third item', 'mec-form-builder'),
				'description' => __('Please separate with "," for example:<br> first item,second item,third item', 'mec-form-builder'),
				'label_block' => true,
				'default'	=> 'Option1, Option2',
				'condition'   => [
					'type' => [
						'checkbox',
						'radio',
						'select',
					],
				],
			]
		);
		$pages          = get_posts('post_type="page"&numberposts=-1');
		$argument_pages = array();

		foreach ($pages as $page) {
			$argument_pages[$page->ID] = $page->post_title;
		}

		$repeater->add_control(
			'page',
			[
				'label'       => __('Agreement Page', 'mec-form-builder'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => $argument_pages,
				'label_block' => true,
				'condition'   => [
					'type' => [
						'agreement',
					],
				],
			]
		);
		$repeater->add_control(
			'status',
			[
				'label'       => __('Status', 'mec-form-builder'),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'checked',
				'options'     => [
					'checked'   => __('Checked by default', 'mec-form-builder'),
					'unchecked' => __('Unchecked by default', 'mec-form-builder'),
				],
				'label_block' => true,
				'condition'   => [
					'type' => [
						'agreement',
					],
				],
			]
		);

		$repeater->add_control(
			'inline',
			[
				'label'        => __('Half-Width', 'mec-form-builder'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Enable', 'mec-form-builder'),
				'label_off'    => __('Disable', 'mec-form-builder'),
				'return_value' => 'enable',
				'default'      => 'disable',
				'description'  => __('This option enables your form to have 2 columns and the fields will be placed in pairs next to one another.', 'mec-form-builder'),
			]
		);

		unset($reg_fields['form_style_url']);
		$this->add_control(
			'reg_fields',
			[
				'label'         => __('Elements List', 'mec-form-builder'),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'description'   => __('MEC Name and MEC Email are necessary and your form must contain both of them.', 'mec-form-builder'),
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ type }}}: {{{ label }}}',
				'default'       => $reg_fields,
				'prevent_empty' => true,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'field_options',
			array(
				'label' => __('Form', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'inline',
			[
				'label'        => __('Half-Width', 'mec-form-builder'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Enable', 'mec-form-builder'),
				'label_off'    => __('Disable', 'mec-form-builder'),
				'return_value' => 'enable',
				'default'      => 'disable',
				'description'  => __('This option enables your form to have 2 columns and the fields will be placed in pairs next to one another.', 'mec-form-builder'),
			]
		);

		$this->end_controls_section();

		// Wrap
		$this->start_controls_section(
			'wrap_options_form',
			array(
				'label' => __('Container', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'wrap_typography',
				'label'    => __('Typography', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking',
			]
		);
		$this->add_control(
			'wrap_color',
			[
				'label'     => __('Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking,.mec-single-event .mec-event-ticket-name,.mec-single-event .mec-event-ticket-description,.mec-single-event .mec-event-ticket-available,.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container label' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'wrap_bg',
			[
				'label'     => __('Background Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking' => 'background: {{VALUE}} !important',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_padding',
			[
				'label'      => __('Padding', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_margin',
			[
				'label'      => __('Margin', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'wrap_border',
				'label'    => __('Border', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking',
			]
		);
		$this->add_responsive_control(
			'wrap_width',
			[
				'label'      => __('Width', 'mec-form-builder'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_border_radius',
			[
				'label'      => __('Border Radius', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'wrap_box_shadow',
				'label'    => __('Box Shadow', 'mec-form-builder'),
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}} !important;'
				]
			]
		);

		$this->end_controls_section();

		// H4 - Title
		$this->start_controls_section(
			'h4_options_form',
			array(
				'label' => __('Title', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'h4_typography',
				'label'    => __('Typography', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking form > h4',
			]
		);
		$this->add_control(
			'h4_color',
			[
				'label'     => __('Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'h4_underline_color',
			[
				'label'     => __('Underline Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form > h4:before' => 'border-color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'h4_bg',
			[
				'label'     => __('Background Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'background: {{VALUE}} !important',
				],
			]
		);
		$this->add_responsive_control(
			'h4_padding',
			[
				'label'      => __('Padding', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_responsive_control(
			'h4_margin',
			[
				'label'      => __('Margin', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'h4_border',
				'label'    => __('Border', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking form > h4',
			]
		);
		$this->add_responsive_control(
			'h4_width',
			[
				'label'      => __('Width', 'mec-form-builder'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'width: {{SIZE}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_responsive_control(
			'h4_border_radius',
			[
				'label'      => __('Border Radius', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'h4_box_shadow',
				'label'    => __('Box Shadow', 'mec-form-builder'),
				'selector' => '.mec-events-meta-group-booking form > h4',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form > h4' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} !important;'
				]
			]
		);

		$this->end_controls_section();

		// H4 - Ticket Title
		$this->start_controls_section(
			'ticket_h4_options_form',
			array(
				'label' => __('Ticket Name', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ticket_h4_typography',
				'label'    => __('Typography', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name',
			]
		);
		$this->add_control(
			'ticket_h4_color',
			[
				'label'     => __('Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'ticket_h4_bg',
			[
				'label'     => __('Background Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'background: {{VALUE}} !important',
				],
			]
		);
		$this->add_responsive_control(
			'ticket_h4_padding',
			[
				'label'      => __('Padding', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_responsive_control(
			'ticket_h4_margin',
			[
				'label'      => __('Margin', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ticket_h4_border',
				'label'    => __('Border', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name',
			]
		);
		$this->add_responsive_control(
			'ticket_h4_width',
			[
				'label'      => __('Width', 'mec-form-builder'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'width: {{SIZE}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_responsive_control(
			'ticket_h4_border_radius',
			[
				'label'      => __('Border Radius', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ticket_h4_box_shadow',
				'label'    => __('Box Shadow', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking form h4 .mec-ticket-name' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}} !important;'
				]
			]
		);

		$this->end_controls_section();

		// Styling Options
		$this->start_controls_section(
			'label_options',
			array(
				'label' => __('Labels', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'label'    => __('Typography', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container label,.mec-single-event .mec-booking label,.mec-single-event .mec-events-meta-group-booking .mec-ticket-variation-name',
			]
		);
		$this->add_control(
			'label_color',
			[
				'label'     => __('Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container label,.mec-single-event .mec-booking label,.mec-single-event .mec-events-meta-group-booking .mec-ticket-variation-name' => 'display: table; color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'label_bg',
			[
				'label'     => __('Background Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container label,.mec-single-event .mec-booking label,.mec-single-event .mec-events-meta-group-booking .mec-ticket-variation-name' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => __('Padding', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container label,.mec-single-event .mec-booking label,.mec-single-event .mec-events-meta-group-booking .mec-ticket-variation-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'label_margin',
			[
				'label'      => __('Margin', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container label,.mec-single-event .mec-booking label,.mec-single-event .mec-events-meta-group-booking .mec-ticket-variation-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'checkbox_radiobutton_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'checkbox_radiobutton_typography',
				'label'    => __('Checkbox & Radio Button Typography', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-checkbox label:not(:first-child), .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-radio label:not(:first-child)',
			]
		);
		$this->add_control(
			'checkbox_radiobutton_color',
			[
				'label'     => __('Checkbox & Radio Button Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-checkbox label:not(:first-child), .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-radio label:not(:first-child)' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'agreement_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'agreement_typography',
				'label'    => __('Agreement', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-agreement label',
			]
		);
		$this->add_control(
			'paragraph_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'paragraph_typography',
				'label'    => __('Paragraph', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-p p',
			]
		);
		$this->add_control(
			'paragraph_color',
			[
				'label'     => __('Paragraph Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li .mec-book-reg-field-p p' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'field_options_form',
			array(
				'label' => __('Fields', 'mec-form-builder'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'field_typography',
				'label'    => __('Typography', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select',
			]
		);
		$this->add_control(
			'field_color',
			[
				'label'     => __('Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#424242',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'field_bg',
			[
				'label'     => __('Background Color', 'mec-form-builder'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'field_padding',
			[
				'label'      => __('Padding', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'field_margin',
			[
				'label'      => __('Margin', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'field_border',
				'label'    => __('Border', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select',
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label'      => __('Width', 'mec-form-builder'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_max_height',
			[
				'label'      => __('Maximum height for input', 'mec-form-builder'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 80,
						'step' => 4,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 46,
				],
				'selectors'  => [
					'.mec-single-event li.mec-book-ticket-container input, .mec-single-event li.mec-book-ticket-container select' => 'max-height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'field_border_radius',
			[
				'label'      => __('Border Radius', 'mec-form-builder'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea, .mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'field_box_shadow',
				'label'    => __('Box Shadow', 'mec-form-builder'),
				'selector' => '.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="date"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="text"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="file"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="email"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="tel"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="text"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea',
				'selectors' => [
					'.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="date"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="text"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="file"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="email"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="tel"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container input[type="text"],
				.mec-single-event .mec-events-meta-group-booking ul.mec-book-tickets-container li.mec-book-ticket-container textarea' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}} !important;'
				]
			]
		);

		$this->end_controls_section();
	}

	public static function search_in_array($key, $array,$l=40)
	{
		foreach ($array as $k => $val) {
			if ($key === $k) {
				return $val;
			} else if( is_array($val)) {
				$d = static::search_in_array($key, $val, $l - 1);
				if($d) {
					return $d;
				}
			}
		}
		if($l === 0) {
			return false;
		}
	}


	/**
	 * Render MEC widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		// Requirements
		$settings        = $this->get_settings_for_display();
		$fields          = get_post_meta(get_the_ID(), 'mec_reg_fields', true);
		$args            = $opts = array();
		$i               = $j = 1;
		$mec_email_count = $mec_name_count  = 0;
		$me              = $mn = false;
		if (!$fields) {
			$fields = [];
		}

		// Update options
		if ($_POST) {
			$actions = stripslashes($_POST['actions']);
			if(strpos($actions, '"action":"render_widget"')) {
				// update_option( 'mec_options', $mec_options, true );
				update_option('mec-attendees-title', @$settings['form_title']);
				$actions = str_replace('\"', '"', $_POST['actions']);
				$actions = json_decode($actions, true);
				$actions = current($actions);
				$reg_fields = static::search_in_array('reg_fields',$actions);
				if ($reg_fields) {
					$args = [];
					foreach ($reg_fields as $field) {
						// args
						if(isset($settings['inline']) && $settings['inline'] == 'enable') {
							$inline = 'enable';
						} else {
							$inline = isset($field['inline']) ? $field['inline'] : '';
						}


						$paragraph = isset($field['paragraph']) ? $field['paragraph'] : '';
						$label = isset($field['label']) ? $field['label'] : '';
						$args[$i] = array(
							'mandatory' => $field['mandatory'] == 'yes' ? '1' : '0',
							'type'      => isset($field['type']) ? $field['type'] : '',
							'label'     => $label,
							'paragraph'     => $paragraph,
							'inline'    => $inline,
							'placeholder'    => isset($field['placeholder']) ? $field['placeholder'] : '',
						);

						// checkbox
						if (isset($field['options']) && $field['options']) {
							$options = explode(',', $field['options']);
							foreach ($options as $option) {
								$opts[$j]['label'] = $option;
								$j++;
							}
							$args[$i]['options'] = $opts;
							unset($opts);
						}

						// argument page
						if (isset($field['page']) && $field['page']) {
							$args[$i]['page'] = $field['page'];
						}

						// argument status
						if (isset($field['status']) && $field['status']) {
							$args[$i]['status'] = $field['status'];
						}
						$i++;
					}
					$reg_fields = $args;
				}

				if ($args) {
					$mec_options            = get_option('mec_options');
					$args['form_style_url'] = site_url('wp-content/uploads/elementor/css/post-' . get_the_ID() . '.css');
					$mec_options['reg_fields'] = $args;
					update_post_meta(get_the_ID(), 'mec_reg_fields', $args);
					update_post_meta(get_the_ID(), 'mec_options', $mec_options);
				}
			}
		}

		foreach ($fields as $field) {

			if (empty($field) || !isset($field['type'])) {
				continue;
			}

			if ($me) {
				if ($field['type'] == 'mec_email') {
					$mec_email_count++;
					continue;
				}
			}

			if ($mn) {
				if ($field['type'] == 'name') {
					$mec_name_count++;
					continue;
				}
			}

			if ($field['type'] == 'mec_email') {
				$me = true;
				$mec_email_count++;
			}

			if ($field['type'] == 'name') {
				$mn = true;
				$mec_name_count++;
			}

			// args
			$args[$i] = array(
				'mandatory' => $field['mandatory'] == 'yes' ? '1' : '0',
				'type'      => $field['type'],
				'label'     => $field['label'],
				'paragraph'     => isset($field['paragraph']) ? $field['paragraph'] : '',
				'placeholder'     => $field['placeholder'],
				'inline'    => $field['inline'],
			);
			if(isset($field['paragraph'])) {
				$args[$i]['label'] = $field['paragraph'];
			}

			// checkbox
			if (isset($field['options']) && $field['options']) {
				$options = '';
				if (isset($field['options']) && !is_array($field['options'])) {
					$options = explode(',', $field['options']);
				}

				if (!$options || !is_array($field['options'])) {
					$options = [
						'Option1',
						'Option2'
					];
				}
				foreach ($options as $option) {
					$opts[$j]['label'] = $option;
					$j++;
				}
				$args[$i]['options'] = $opts;
				unset($opts);
			}

			// argument page
			if (isset($field['page']) && $field['page']) {
				$args[$i]['page'] = $field['page'];
			}

			// argument page
			if ($field['status']) {
				$args[$i]['status'] = $field['status'];
			}

			$i++;
		}

		$reg_fields = $args;
		$MEC_main = new \MEC_main();
		$event    = $MEC_main->get_events()[0];
		$id       = get_the_ID();
		$global_inheritance = get_post_meta($id, 'mec_reg_fields_global_inheritance', true);
		if (trim($global_inheritance) == '') {
			$global_inheritance = 1;
		}

		$reg_fields = get_post_meta($id, 'mec_reg_fields', true);
		// $main	= MEC::getInstance('app.libraries.main');
		// $reg_fields = $main->get_reg_fields($event->ID);
		if (!is_array($reg_fields)) {
			$reg_fields = array();
		}

		$uniqueid = (isset($uniqueid) ? $uniqueid : $event->ID); ?>

		<div class="mec-single-event">
			<div class="mec-events-meta-group-booking">
				<form id="mec_book_form<?php echo $uniqueid; ?>" class="mec-booking-form-container" novalidate="novalidate">
					<h4><?php echo esc_html($settings['form_title'], 'mec-form-builder'); ?></h4>
					<ul class="mec-book-tickets-container">

						<li class="mec-book-ticket-container">
							<h4><span class="mec-ticket-name"><?php echo esc_html('Ticket Name', 'mec-form-builder'); ?></span><span class="mec-ticket-price"></span></h4>
							<!-- Custom fields -->
							<?php
									echo '<div class="mec-wrap"><div class="row">';
									if ($settings['inline'] == 'enable') { }
									?>
							<?php
									if (count($reg_fields)) :
										$mec_email = false;
										$mec_name  = false;

										foreach ($reg_fields as $reg_field_id => $reg_field) :
											if (isset($reg_field['type'])) {
												if ($reg_field['type'] == 'mec_email') {
													$mec_email = true;
												}
												if ($reg_field['type'] == 'name') {
													$mec_name = true;
												}
											}
										endforeach;

										if (!$mec_email) {
											echo '<h4 style="color:red">' . esc_html__('Please add MEC Email field in your form.', 'mec-form-builder') . '</h3>';
										}

										if (!$mec_name) {
											echo '<h4 style="color:red">' . esc_html__('Please add MEC Name field in your form.', 'mec-form-builder') . '</h3>';
										}

										if ($mec_email_count > 1) {
											echo '<h4 style="color:red">' . esc_html__('Duplicate Error! Please add just one MEC Email field in your form.', 'mec-form-builder') . '</h3>';
										}

										if ($mec_name_count > 1) {
											echo '<h4 style="color:red">' . esc_html__('Duplicate Error! Please add just one MEC Name field in your form.', 'mec-form-builder') . '</h3>';
										}

										foreach ($reg_fields as $reg_field_id => $reg_field) :
											if (!is_numeric($reg_field_id) or !isset($reg_field['type'])) {
												continue;
											}

											?>
									<div class="<?php if (isset($reg_field['inline']) && $reg_field['inline'] == 'enable' || $settings['inline'] == 'enable') { echo 'col-md-6'; } else { echo 'col-md-12'; } ?> mec-form-fields mec-book-reg-field-<?php echo $reg_field['type']; ?> <?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? 'mec-reg-mandatory' : ''); ?>" data-ticket-id="<?php echo $j; ?>" data-field-id="<?php echo $reg_field_id; ?>">
										<?php if (isset($reg_field['label']) and $reg_field['type'] != 'agreement' and $reg_field['type'] != 'mec_email' and $reg_field['type'] != 'name') : ?>
											<label for="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>"><?php _e($reg_field['label'], 'mec-form-builder'); ?><?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? '<span class="wbmec-mandatory">*</span>' : ''); ?></label>
										<?php elseif ($reg_field['type'] == 'mec_email') : ?>
												<label for="mec_book_reg_field_email<?php echo $j . '_' . $reg_field_id; ?>"><?php _e($reg_field['label'], 'mec-form-builder'); ?><?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? '<span class="wbmec-mandatory">*</span>' : ''); ?></label>
										<?php elseif ($reg_field['type'] == 'name') : ?>
												<label for="mec_book_reg_field_name<?php echo $j . '_' . $reg_field_id; ?>"><?php _e($reg_field['label'], 'mec-form-builder'); ?><?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? '<span class="wbmec-mandatory">*</span>' : ''); ?></label>
										<?php endif; ?>

										<?php /** Text **/ if ($reg_field['type'] == 'text') :
											?>
											<input id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" type="text" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?> />
										<?php /** Date **/ elseif ($reg_field['type'] == 'date') : ?>
											<input id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" type="date" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?> />
										<?php /** File **/ elseif ($reg_field['type'] == 'file') : ?>
											<input id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" type="file" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?> />
										<?php /** MEC Email **/ elseif ($reg_field['type'] == 'mec_email') : ?>
											<?php $reg_field['label'] = ($reg_field['label']) ? $reg_field['label'] : ''; ?>

											<input id="mec_book_reg_field_email<?php echo $j . '_' . $reg_field_id; ?>" type="email" name="book[tickets][<?php echo $j; ?>][email]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" required />
										<?php /** MEC Name **/ elseif ($reg_field['type'] == 'name') : ?>
											<?php $reg_field['label'] = ($reg_field['label']) ? $reg_field['label'] : ''; ?>

											<input id="mec_book_reg_field_name<?php echo $j . '_' . $reg_field_id; ?>" type="text" name="book[tickets][<?php echo $j; ?>][name]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" required />
										<?php /** Email **/ elseif ($reg_field['type'] == 'email') : ?>
											<input id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" type="email" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?> />
										<?php /** Tel **/ elseif ($reg_field['type'] == 'tel') : ?>
											<input id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" type="tel" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?> />
										<?php /** Textarea **/ elseif ($reg_field['type'] == 'textarea') : ?>
											<textarea id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?>></textarea>
										<?php /** Dropdown **/ elseif ($reg_field['type'] == 'select') : ?>
											<select id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" placeholder="<?php _e( $reg_field['placeholder'], 'mec-form-builder' ); ?>" <?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
											?>>
											<?php foreach ($reg_field['options'] as $reg_field_option) : ?>
												<option value="<?php esc_attr_e($reg_field_option['label'], 'mec-form-builder'); ?>"><?php _e($reg_field_option['label'], 'mec-form-builder'); ?></option>
											<?php endforeach; ?>
											</select>
										<?php /** Radio **/ elseif ($reg_field['type'] == 'radio') : ?>
											<?php foreach ($reg_field['options'] as $reg_field_option) : ?>
												<label for="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id . '_' . strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>">
													<input type="radio" id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id . '_' . strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="<?php _e($reg_field_option['label'], 'mec-form-builder'); ?>" />
													<?php _e($reg_field_option['label'], 'mec-form-builder'); ?>
												</label>
											<?php endforeach; ?>
										<?php /** Checkbox **/ elseif ($reg_field['type'] == 'checkbox') :
											if (!isset($reg_field['options']) || empty($reg_field['options'])) {
												$reg_field['options'] = [];
											}
										?>
										<?php foreach ($reg_field['options'] as $reg_field_option) : ?>
											<label for="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id . '_' . strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>">
												<input type="checkbox" id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id . '_' . strtolower(str_replace(' ', '_', $reg_field_option['label'])); ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>][]" value="<?php _e($reg_field_option['label'], 'mec-form-builder'); ?>" />
												<?php _e($reg_field_option['label'], 'mec-form-builder'); ?>
											</label>
										<?php endforeach; ?>
										<?php /** Agreement **/ elseif ($reg_field['type'] == 'agreement') : ?>
											<label for="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>">
											<?php echo ((isset($reg_field['mandatory']) and $reg_field['mandatory']) ? '<span class="wbmec-mandatory">*</span>' : ''); ?>
												<input type="checkbox" id="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>" name="book[tickets][<?php echo $j; ?>][reg][<?php echo $reg_field_id; ?>]" value="1" <?php echo (!isset($reg_field['status']) or (isset($reg_field['status']) and $reg_field['status'] == 'checked')) ? 'checked="checked"' : ''; ?>
												<?php
												if (isset($reg_field['mandatory']) and $reg_field['mandatory']) {
													echo 'required';
												}
												?>/>
												<?php echo sprintf(__($reg_field['label'], 'mec-form-builder'), '<a href="' . get_the_permalink($reg_field['page']) . '" target="_blank">' . get_the_title($reg_field['page']) . '</a>'); ?>

											</label>
										<?php /** paragraph **/ elseif ($reg_field['type'] == 'p') : ?>
											<p for="mec_book_reg_field_reg<?php echo $j . '_' . $reg_field_id; ?>">
											<?php echo @$reg_field['paragraph']; ?>
											</p>
										<?php endif; ?>
									</div>
						<?php endforeach;
						endif; ?>
						<?php echo '</div></div>';
							if ($settings['inline'] == 'enable') { } ?>
						</li>
					</ul>
				</form>
			</div>
		</div>
<?php
	}
}
