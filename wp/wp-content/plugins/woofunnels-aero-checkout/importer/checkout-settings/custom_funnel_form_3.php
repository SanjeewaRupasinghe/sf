<?php
$product_field  = WFACP_Common::get_product_field();
$advanced_field = WFACP_Common::get_advanced_fields();


$customizer_data = [
	'wfacp_form'                  => [
		'wfacp_form_section_embed_forms_2_disable_steps_bar'                          => true,
		'wfacp_form_section_embed_forms_2_select_type'                                => "tab",
		'wfacp_form_section_embed_forms_2_name_0'                                     => __( 'INFORMATION', 'woofunnels-aero-checkout' ),
		'wfacp_form_section_embed_forms_2_name_1'                                     => __( 'REVIEW', 'woofunnels-aero-checkout' ),
		'wfacp_form_section_embed_forms_2_name_2'                                     => __( 'PAYMENT', 'woofunnels-aero-checkout' ),
		'wfacp_form_section_text_below_placeorder_btn'                                => __( "* 100% Secure &amp; Safe Payments *", 'woofunnels-aero-checkout' ),
		'wfacp_form_section_breadcrumb_0_step_text'                                   => __( 'Information', 'woofunnels-aero-checkout' ),
		'wfacp_form_section_breadcrumb_1_step_text'                                   => __( 'REVIEW', 'woofunnels-aero-checkout' ),
		'wfacp_form_section_breadcrumb_2_step_text'                                   => __( 'Payment', 'woofunnels-aero-checkout' ),
		'wfacp_form_section_embed_forms_2_step_form_max_width'                        => '664',
		'wfacp_form_section_embed_forms_2_form_border_type'                           => 'none',
		'wfacp_form_form_fields_1_embed_forms_2_billing_address_1'                    => 'wfacp-col-left-half',
		'wfacp_form_form_fields_1_embed_forms_2_billing_city'                         => 'wfacp-col-left-half',
		'wfacp_form_form_fields_1_embed_forms_2_billing_postcode'                     => 'wfacp-col-left-third',
		'wfacp_form_form_fields_1_embed_forms_2_billing_country'                      => 'wfacp-col-left-third',
		'wfacp_form_form_fields_1_embed_forms_2_billing_state'                        => 'wfacp-col-left-third',
		'wfacp_form_form_fields_1_embed_forms_2_shipping_address_1'                   => 'wfacp-col-left-half',
		'wfacp_form_form_fields_1_embed_forms_2_shipping_city'                        => 'wfacp-col-left-half',
		'wfacp_form_form_fields_1_embed_forms_2_shipping_postcode'                    => 'wfacp-col-left-third',
		'wfacp_form_form_fields_1_embed_forms_2_shipping_country'                     => 'wfacp-col-left-third',
		'wfacp_form_form_fields_1_embed_forms_2_shipping_state'                       => 'wfacp-col-left-third',
		'wfacp_form_form_fields_1_embed_forms_2_billing_first_name'                   => 'wfacp-col-left-half',
		'wfacp_form_form_fields_1_embed_forms_2_billing_last_name'                    => 'wfacp-col-left-half',
		'wfacp_order_summary_section_embed_forms_2_order_summary_hide_img'            => true,
		'wfacp_form_section_embed_forms_2_sec_heading_color'                          => '#333',
		'wfacp_form_product_switcher_section_embed_forms_2_product_switcher_bg_color' => '#f7f7f7',
		'wfacp_form_section_embed_forms_2_heading_fs'                                 => [
			'desktop'      => '20',
			'tablet'       => '20',
			'mobile'       => '14',
			'desktop-unit' => 'px',
			'tablet-unit'  => 'px',
			'mobile-unit'  => 'px',
		]
	],
	'wfacp_form_product_switcher' => [
		'wfacp_form_product_switcher_section_embed_forms_2_product_switcher_bg_color'   => '#f7f7f7',
		'wfacp_form_product_switcher_section_embed_forms_2_product_switcher_text_color' => '#4d4c4f',
	]

];

$settings = [
	'show_on_next_step' => [
		'single_step' => [
			'billing_email'       => 'false',
			'billing_first_name'  => 'false',
			'billing_last_name'   => 'false',
			'address'             => 'false',
			'shipping-address'    => 'false',
			'billing_phone'       => 'false',
			'shipping_calculator' => 'false',
		],
		'two_step'    => [
			'shipping_calculator' => 'false'
		]
	],
];


$pageLayout = [
	'steps'                       => WFACP_Common::get_default_steps_fields( true ),
	'fieldsets'                   => [
		'single_step' => [
			[
				'name'        => 'Customer Information',
				'class'       => '',
				'sub_heading' => '',
				'fields'      => [
					[
						'label'        => __( 'Email', 'woocommerce' ),
						'required'     => 'true',
						'type'         => 'email',
						'class'        => [ 0 => 'form-row-wide', ],
						'validate'     => [ 0 => 'email', ],
						'autocomplete' => 'email username',
						'priority'     => '110',
						'id'           => 'billing_email',
						'field_type'   => 'billing',
						'placeholder'  => '',
					],
					[
						'label'        => __( 'First name', 'woocommerce' ),
						'required'     => 'true',
						'class'        => [ 0 => 'form-row-first', ],
						'autocomplete' => 'given-name',
						'priority'     => '10',
						'type'         => 'text',
						'id'           => 'billing_first_name',
						'field_type'   => 'billing',
						'placeholder'  => '',
					],
					[
						'label'        => __( 'Last name', 'woocommerce' ),
						'required'     => 'true',
						'class'        => [ 0 => 'form-row-last', ],
						'autocomplete' => 'family-name',
						'priority'     => '20',
						'type'         => 'text',
						'id'           => 'billing_last_name',
						'field_type'   => 'billing',
						'placeholder'  => '',
					],
					[
						'label'        => __( 'Phone', 'woocommerce' ),
						'type'         => 'tel',
						'class'        => [ 'form-row-wide' ],
						'id'           => 'billing_phone',
						'field_type'   => 'billing',
						'validate'     => [ 'phone' ],
						'placeholder'  => '',
						'autocomplete' => 'tel',
						'priority'     => 100,
					],
				],
			],
			[
				'name'        => __( 'Billing Details', 'woofunnels-aero-checkout' ),
				'class'       => '',
				'sub_heading' => '',
				'fields'      => [
					WFACP_Common::get_single_address_fields(),
					WFACP_Common::get_single_address_fields( 'shipping' ),
				],
			],
			[
				'name'        => __( 'Your Product', 'woofunnels-aero-checkout' ),
				'class'       => 'wfacp_product_switcher',
				'sub_heading' => '',
				'html_fields' => [
					'product_switching' => 'true',
				],
				'fields'      => [
					$product_field['product_switching'],

				],
			],

		],
		'two_step'    => [
			[
				'name'        => __( 'Shipping Method', 'woofunnels-aero-checkout' ),
				'class'       => '',
				'sub_heading' => '',
				'html_fields' => [ 'shipping_calculator' => true ],
				'fields'      => [
					isset( $advanced_field['shipping_calculator'] ) ? $advanced_field['shipping_calculator'] : []
				],
			],
			[
				'name'        => __( 'Order Summary', 'woofunnels-aero-checkout' ),
				'class'       => 'wfacp_order_summary_box',
				'sub_heading' => '',
				'html_fields' => [
					'order_coupon'  => 'true',
					'order_summary' => 'true',
				],
				'fields'      => [
					$advanced_field['order_coupon'],
					$advanced_field['order_summary'],
				],
			],
		],

	],
	'product_settings'            => [
		'coupons'                             => '',
		'enable_coupon'                       => 'false',
		'disable_coupon'                      => 'false',
		'hide_quantity_switcher'              => 'false',
		'enable_delete_item'                  => 'false',
		'hide_product_image'                  => 'false',
		'is_hide_additional_information'      => 'true',
		'additional_information_title'        => WFACP_Common::get_default_additional_information_title(),
		'hide_quick_view'                     => 'true',
		'hide_you_save'                       => 'true',
		'hide_best_value'                     => 'false',
		'best_value_product'                  => '',
		'best_value_text'                     => 'Best Value',
		'best_value_position'                 => 'above',
		'enable_custom_name_in_order_summary' => 'false',
		'autocomplete_enable'                 => 'false',
		'autocomplete_google_key'             => '',
		'preferred_countries_enable'          => 'false',
		'preferred_countries'                 => '',
		'product_switcher_template'           => 'default',
	],
	'have_coupon_field'           => 'true',
	'have_billing_address'        => 'true',
	'have_shipping_address'       => 'true',
	'have_billing_address_index'  => '5',
	'have_shipping_address_index' => '6',
	'enabled_product_switching'   => 'yes',
	'have_shipping_method'        => 'true',
	'current_step'                => 'third_step',
];

$product_settings                     = [];
$product_settings['settings']         = $pageLayout['product_settings'];
$product_settings['products']         = [];
$product_settings['default_products'] = [];

return [
	'default_customizer_value'       => $customizer_data,
	'page_layout'                    => $pageLayout,
	'page_settings'                  => $settings,
	'wfacp_product_switcher_setting' => $product_settings
];