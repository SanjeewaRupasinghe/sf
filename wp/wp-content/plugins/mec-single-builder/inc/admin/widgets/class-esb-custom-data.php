<?php
namespace Elementor;

namespace MEC_Single_Builder\Inc\Admin\Widgets;

use Elementor\Plugin;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class ESB_Custom_Data extends \Elementor\Widget_Base
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

		return 'event_custom_data';
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

		return __('Single Event Data', 'mec-single-builder');
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

		return 'mec-fa-file-o';
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
			'mec_data_box',
			array(
				'label' 	=> __('Event Data Box', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mec_data_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields.mec-frontbox' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields.mec-frontbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields.mec-frontbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_data_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-event-data-fields.mec-frontbox',
			]
		);

		$this->add_control(
			'mec_data_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields.mec-frontbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_data_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-data-fields.mec-frontbox',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mec_data_typography',
			array(
				'label' 	=> __('Event Data Typography', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_data_typography_title',
				'label' 	=> __('Name Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-name',
			]
		);

		$this->add_control(
			'mec_data_typography_color',
			[
				'label' 		=> __('Name Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_typography_padding', //param_name
			[
				'label' 		=> __('Name Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_typography_margin', //param_name
			[
				'label' 		=> __('Name Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'mec_data_label_typography_title',
				'label' 	=> __('Value Typography', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value',
			]
		);

		$this->add_control(
			'mec_data_label_typography_color',
			[
				'label' 		=> __('Value Color', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_label_typography_padding', //param_name
			[
				'label' 		=> __('Value Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_label_typography_margin', //param_name
			[
				'label' 		=> __('Value Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' 		=> 'mec_data_link_label_typography_title',
				'label' 	=> __('Link Typography (value)', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value a',
			]
		);

		$this->add_control(
			'mec_data_link_label_typography_color',
			[
				'label' 		=> __('Link Color (value)', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value a' => 'color: {{VALUE}}',
				],
			]
        );

		$this->add_control(
			'mec_data_hover_link_label_typography_color',
			[
				'label' 		=> __('Hover Link Color (value)', 'mec-single-builder'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item .mec-event-data-field-value a:hover' => 'color: {{VALUE}}',
				],
			]
		);


        $this->end_controls_section();


		$this->start_controls_section(
			'mec_data_items_box',
			array(
				'label' 	=> __('Event Data Items', 'mec-single-builder'),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

        $this->add_responsive_control(
            'mec_data_items_box_width',
            [
                'label' 		=> __( 'Item Width', 'mec-single-builder' ),
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
                'default' 		=> [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item' => 'width: {{SIZE}}{{UNIT}}; display: block; height: auto;',
                ],
            ]
        );


		$this->add_control(
			'mec_data_items_box_bg_color', //param_name
			[
				'label' 		=> __('Background Color', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_items_box_padding', //param_name
			[
				'label' 		=> __('Padding', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mec_data_items_box_margin', //param_name
			[
				'label' 		=> __('Margin', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'allowed_dimensions' => ['top', 'bottom'],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'mec_data_items_box_border',
				'label' 		=> __('Border', 'mec-single-builder'),
				'selector' 		=> '{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item',
			]
		);

		$this->add_control(
			'mec_data_items_box_shape_radius', //param_name
			[
				'label' 		=> __('Border Radius', 'mec-single-builder'), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' 	=> ['px', 'em', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'mec_data_items_box_box_shadow',
				'label' 	=> __('Box Shadow', 'mec-single-builder'),
				'selector' 	=> '{{WRAPPER}} .mec-event-data-fields .mec-event-data-field-item',
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

		echo \MEC\SingleBuilder\SingleBuilder::getInstance()->output( 'event-data' );
    }
}
