<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_feature_cart $this */

$cart_id = $this->cart->get_cart_id();
$cart = $this->cart->get_cart($cart_id);

$empty = (count($cart) ? false : true);
$free = $this->cart->is_free($cart);

$gateways = $this->main->get_gateways();
$gateway_settings = $this->main->get_gateways_options();

$active_gateways = array();
foreach($gateways as $gateway)
{
    if(!$gateway->enabled()) continue;
    if(in_array($gateway->id, array(6, 7))) continue; // Stripe Connect & Pay By WooCommerce

    $active_gateways[] = $gateway;
}

// Javascript Code
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery(".mec-checkout").mecCheckout(
    {
        ajax_url: "'.admin_url('admin-ajax.php', NULL).'",
    });
});
</script>';

// Include javascript code into the footer
$this->factory->params('footer', $javascript);
?>
<div id="mec_checkout_message"></div>
<div class="mec-wrap mec-checkout">
    <div class="mec-checkout-gateways">

        <?php if($empty): ?>
        <p><?php esc_html_e('Cart is empty!', 'mec'); ?></p>
        <?php else: ?>
            <div class="mec-checkout-price-details-wrapper">
                <ul class="mec-checkout-list">
                    <?php foreach($cart as $transaction_id): $TO = $this->book->get_TO($transaction_id); $price_details = $TO->get_price_details(); ?>
                        <li class="mec-list-items">
                            <h3><?php echo MEC_kses::element($TO->get_event_link()); ?> (<?php echo MEC_kses::element($this->main->render_price($price_details['total'], $TO->get_event_id())); ?>)</h3>
                            <div class="mec-checkout-tickets-wrapper"><?php echo MEC_kses::element($TO->get_tickets_html()); ?></div>
                            <ul class="mec-checkout-price-details">
                                <?php foreach($price_details['details'] as $detail): ?>
                                    <li class="mec-checkout-price-detail mec-checkout-price-detail-type<?php echo sanitize_html_class($detail['type']); ?>">
                                        <span class="mec-checkout-price-detail-description"><?php echo esc_html($detail['description']); ?></span>
                                        <span class="mec-checkout-price-detail-amount"><?php echo MEC_kses::element($this->main->render_price($detail['amount'], $TO->get_event_id())); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php if(!$free): ?>
            <div class="mec-checkout-footer">

                <p id="mec_cart_total_payable"><?php echo MEC_kses::element($this->main->render_price($this->cart->get_payable($cart))); ?></p>
                
                <div class="mec-events-meta-group-booking mec-checkout-gateways-wrapper mec-book-form-gateways">
                    <?php foreach($active_gateways as $gateway): ?>
                    <div class="mec-checkout-form-gateway-label">
                        <label>
                            <?php if(count($active_gateways) > 1): ?>
                            <input type="radio" name="book[gateway]" class="mec-checkout-gateways-radio" value="<?php echo esc_attr($gateway->id()); ?>" />
                            <?php endif; ?>
                            <?php echo esc_html($gateway->title()); ?>
                        </label>
                    </div>
                    <?php endforeach; ?>

                    <?php foreach($active_gateways as $gateway): ?>
                    <div class="mec-checkout-form-gateway-checkout <?php echo (count($active_gateways) == 1 ? '' : 'mec-util-hidden'); ?>" id="mec_checkout_form_gateway_checkout<?php echo esc_attr($gateway->id()); ?>">
                        <?php echo MEC_kses::element($gateway->comment()); ?>
                        <?php $gateway->cart_checkout_form($cart_id); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: // Free ?>
                <div class="mec-events-meta-group-booking mec-checkout-gateways-wrapper mec-book-form-gateways">
                    <form id="mec_checkout_form_free_booking">
                        <div class="mec-form-row">
                            <input type="hidden" name="action" value="mec_do_cart_free" />
                            <input type="hidden" name="cart_id" value="<?php echo esc_attr($cart_id); ?>" />
                            <input type="hidden" name="gateway_id" value="4" />
                            <?php wp_nonce_field('mec_cart_form_'.$cart_id); ?>
                            <button class="mec-book-form-next-button" type="submit"><?php echo sprintf(esc_html__('Free %s', 'mec'), $this->main->m('booking', esc_html__('Booking', 'mec'))); ?></button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="mec-checkout-actions">
                <?php if(isset($this->settings['cart_page']) and $this->settings['cart_page']): ?>
                <div class="mec-checkout-cart-button">
                    <a class="mec-checkout-cart-link button" href="<?php echo esc_url(get_permalink($this->settings['cart_page'])); ?>"><?php esc_html_e('Back to Cart', 'mec'); ?></a>
                </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>