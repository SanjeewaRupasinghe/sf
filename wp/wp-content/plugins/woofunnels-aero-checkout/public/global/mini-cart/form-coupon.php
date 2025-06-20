<?php

if ( ! defined( 'WFACP_TEMPLATE_DIR' ) ) {
	return '';
}
/**
 * @var $widget_id
 */
if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}
$instance = wfacp_template();
$settings = WFACP_Common::get_session( $widget_id );
$instance->set_mini_cart_data( $settings );
$enable_coupon_collapsible = $instance->mini_cart_collapse_enable_coupon_collapsible();
$coupon_cls                = 'wfacp-col-full';
$wfacp_sidebar_coupon_text = apply_filters( 'wfacp_sidebar_coupon_text', __( 'Coupon code', 'woocommerce' ) );

$apply_coupon_button_text = apply_filters( 'wfacp_sidebar_apply_coupon_button_text', __( 'Apply', 'woocommerce' ) )

?>
<div class="wfacp_woocommerce_form_coupon wfacp_template_9_coupon">
    <div class="wfacp-coupon-section wfacp_custom_row_wrap clearfix">
        <div class="wfacp-coupon-page">
			<?php
			if ( true === $enable_coupon_collapsible ) {
				wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', '<span class="wfacp_main_showcoupon">' . __( 'Have a coupon?', 'woocommerce' ) . ' ' . __( 'Click here to enter your code', 'woocommerce' ) . '</span>' ), 'notice' );
			}
			$classBlock = 'wfacp_display_none';
			if ( ( false === $enable_coupon_collapsible && count( WC()->cart->applied_coupons ) >= 0 ) ) {
				$classBlock = 'wfacp_display_block';
			}


			?>
            <form class="wfacp_layout_shopcheckout checkout_coupon woocommerce-form-coupon <?php echo $classBlock; ?>"
                  method="post" style="<?php echo true == $enable_coupon_collapsible ? 'display:none' : '' ?>">
                <div class="wfacp-row wfacp_coupon_row">
                    <p class="form-row form-row-first wfacp-form-control-wrapper wfacp-col-left-half wfacp-input-form">

                        <label for="coupon_code"
                               class="wfacp-form-control-label"><?php echo $wfacp_sidebar_coupon_text; ?></label>
                        <input type="text" name="coupon_code" class="input-text wfacp-form-control wfacp_coupon_input" placeholder="<?php echo $wfacp_sidebar_coupon_text; ?>"
                               id="coupon_code" value=""/>
                    </p>
                    <p class="form-row form-row-last <?php echo $coupon_cls; ?>">
                        <button type="submit" class="button wfacp-coupon-btn wfacp_coupon_button" name="apply_coupon" disabled="disabled" value="<?php echo $apply_coupon_button_text; ?>">
							<?php echo $apply_coupon_button_text; ?>
                        </button>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="wfacp-row wfacp_ele_sec">
                    <div class="wfacp_coupon_msg "></div>
                </div>
            </form>
        </div>
    </div>
</div>
