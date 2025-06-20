<?php
namespace ACFWF\Models\BOGO;

use ACFWF\Abstracts\Abstract_BOGO_Deal;
use ACFWF\Abstracts\Abstract_Main_Plugin_Class;
use ACFWF\Helpers\Helper_Functions;
use ACFWF\Helpers\Plugin_Constants;
use ACFWF\Interfaces\Model_Interface;
use ACFWF\Models\Objects\Advanced_Coupon;
use ACFWF\Models\Objects\BOGO\Advanced;
use ACFWF\Models\Objects\BOGO\Calculation;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly.

/**
 * Model that houses the logic of extending the coupon system of woocommerce.
 * It houses the logic of handling coupon url.
 * Public Model.
 *
 * @since 1.4
 */
class Frontend implements Model_Interface {
    /**
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
     */

    /**
     * Property that houses the model name to be used when calling publicly.
     *
     * @since 2.8
     * @access private
     * @var string
     */
    private $_model_name = 'BOGO_Frontend';

    /**
     * Property that holds the single main instance of URL_Coupon.
     *
     * @since 1.4
     * @access private
     * @var Frontend
     */
    private static $_instance;

    /**
     * Model that houses all the plugin constants.
     *
     * @since 1.4
     * @access private
     * @var Plugin_Constants
     */
    private $_constants;

    /**
     * Property that houses all the helper functions of the plugin.
     *
     * @since 1.4
     * @access private
     * @var Helper_Functions
     */
    private $_helper_functions;

    /**
     * Property that houses the BOGO Calculation instance.
     *
     * @since 1.4
     * @access private
     * @var Calculation
     */
    private $_calculation;

    /**
     * List of products to display on coupon cart total row.
     *
     * @since 1.4
     * @access private
     * @var array
     */
    private $_price_display = array();

    /*
    |--------------------------------------------------------------------------
    | Class Methods
    |--------------------------------------------------------------------------
     */

    /**
     * Class constructor.
     *
     * @since 1.4
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin      Main plugin object.
     * @param Plugin_Constants           $constants        Plugin constants object.
     * @param Helper_Functions           $helper_functions Helper functions object.
     */
    public function __construct( Abstract_Main_Plugin_Class $main_plugin, Plugin_Constants $constants, Helper_Functions $helper_functions ) {
        $this->_constants        = $constants;
        $this->_helper_functions = $helper_functions;

        $main_plugin->add_to_all_plugin_models( $this, $this->_model_name );
        $main_plugin->add_to_public_models( $this, $this->_model_name );
    }

    /**
     * Ensure that only one instance of this class is loaded or can be loaded ( Singleton Pattern ).
     *
     * @since 1.4
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin      Main plugin object.
     * @param Plugin_Constants           $constants        Plugin constants object.
     * @param Helper_Functions           $helper_functions Helper functions object.
     * @return Frontend
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin, Plugin_Constants $constants, Helper_Functions $helper_functions ) {
        if ( ! self::$_instance instanceof self ) {
            self::$_instance = new self( $main_plugin, $constants, $helper_functions );
        }

        return self::$_instance;
    }

    /*
    |--------------------------------------------------------------------------
    | Implementation related functions.
    |--------------------------------------------------------------------------
     */

    /**
     * Restrict cart to only allow one BOGO to be applied.
     *
     * @since 4.1
     * @access public
     *
     * @param bool            $value Filter return value.
     * @param Advanced_Coupon $coupon Advanced coupon object.
     * @return string Notice markup.
     * @throws \Exception When BOGO coupon is already applied to the cart.
     */
    public function restrict_cart_to_only_one_bogo_deal( $value, $coupon ) {
        if ( $coupon->is_type( 'acfw_bogo' ) ) {

            $this->_calculation = Calculation::get_instance();

            if ( $this->_calculation->get_bogo_deal() && $coupon->get_code() !== $this->_calculation->get_bogo_coupon_code() ) {
                // Translators: %s is the coupon code.
                $message = __( 'The coupon "%s" cannot be applied to the cart. A coupon with a "Buy X Get X" deal has already been applied to the cart.', 'advanced-coupons-for-woocommerce-free' );
                throw new \Exception( sprintf( $message, $coupon->get_code() ) );
            }
        }

        return $value;
    }

    /**
     * Implement BOGO Deals for all applied coupon in the cart.
     *
     * @since 1.4
     * @since 4.1 Skip calculation when there is no BOGO Deal present to calculate.
     * @access public
     */
    public function implement_bogo_deals() {
        // create BOGO Calculation instance.
        if ( ! $this->_calculation instanceof Calculation ) {
            $this->_calculation = Calculation::get_instance();
        }

        // skip if there's no BOGO coupon or when calculation is already done.
        if ( ! $this->_calculation->get_bogo_deal() || $this->_calculation->is_calculation_done() ) {
            return;
        }

        // check if calculation is available in session and is still valid.
        if ( ! $this->_calculation->is_calculated_from_session() ) {

            // clear previous session data.
            Calculation::clear_session_data();

            // run BOGO impelementation.
            $this->_run_implementation();

            // add eligible notices for deals with missing items.
            $this->_add_notice_for_eligible_deals();

            // save calculation and notices data to session.
            $this->_calculation->set_session_data();
        }

        // apply discount by adjusting cart item prices.
        if ( ! empty( $this->_calculation->get_all_entries() ) ) {
            $this->_set_matching_cart_item_deals_prices();
        }

        // mark calculation as done.
        $this->_calculation->done_calculation();

        // display eligible for deals notices.
        $this->_display_eligible_deal_notices();
    }

    /**
     * Run BOGO implementation
     *
     * @since 1.4
     * @access private
     */
    private function _run_implementation() {
        $bogo_deal = $this->_calculation->get_bogo_deal();

        // skip if the re are no triggers or deals data.
        if ( 0 >= count( $bogo_deal->triggers ) || 0 >= count( $bogo_deal->deals ) ) {
            return;
        }

        // allow 3rd party implementations for BOGO deals.
        if ( apply_filters( 'acfwf_before_implement_bogo_for_coupon', false ) ) {
            return;
        }

        do {
            $deals_fulfilled = false;

            // reset counters and temporary entries on each loop instance.
            $bogo_deal->reset_counters();

            // verify triggers with cart items eligible only for triggers.
            $this->_calculation->verify_triggers( true );

            /**
             * Verify deal items and then verify triggers again with shared items.
             * If deal items are valid, but triggers are not, then clear the temporarily matched deal items.
             * Then reverify triggers first, and then verify deal items again.
             */
            if ( $this->_calculation->verify_deals() && ! $this->_calculation->verify_triggers() ) {

                // reset counters and temp matched.
                $bogo_deal->reset_counters( 'deal' );
                $this->_calculation->clear_temp_entries( 'deal' );

                // reverify triggers, and reverify deals if triggers are valid.
                if ( $this->_calculation->verify_triggers() ) {
                    $this->_calculation->verify_deals();
                }
            }

            // hook to run after verifying items (auto-add).
            do_action( 'acfw_bogo_after_verify_trigger_deals', $bogo_deal );

            // verify BOGO trigger conditions.
            if ( $bogo_deal->is_trigger_verified() ) {

                // check if all deal items for this instance were all fulfilled.
                $deals_fulfilled = $bogo_deal->is_deal_fulfilled();

                // proccess deals that are missing in the cart (display notice for later).
                if ( ! $deals_fulfilled ) {
                    $this->_calculation->process_allowed_deals_data();
                }

                // if at least 1 deal item fulfilled, then confirm the matched triggers and deals.
                // NOTE: This is to ensure that if a BOGO Deal has no deals fulfilled, then the items verified in trigger
                // can still be used by other coupons.
                if ( $bogo_deal->has_deal_fulfilled() ) {
                    $this->_calculation->confirm_matched_triggers();
                }
            }

            // clear temporary matched entries.
            $this->_calculation->clear_temp_entries();

            // Increment run counter for the BOGO Deal.
            $bogo_deal->increment_run_counter();

        } while (
            $bogo_deal->is_repeat && $deals_fulfilled
        );
    }

    /**
     * Apply discount of matching cart item deals by adjusting the price of cart line items.
     *
     * @since 1.4
     * @access private
     */
    private function _set_matching_cart_item_deals_prices() {
        foreach ( \WC()->cart->get_cart_contents() as $cart_item ) {

            $key = $cart_item['key'];

            // if cart key already present in price display, then skip.
            // this prevents discount be applied multiple times on the cart.
            if ( isset( $this->_price_display[ $key ] ) ) {
                continue;
            }

            $deals = $this->_calculation->get_entries_by_cart_item( $key, 'deal' );

            // don't proceed if there are no deal entries for the current item.
            if ( empty( $deals ) ) {
                continue;
            }

            // Get prices.
            $price            = array();
            $price['regular'] = $this->_helper_functions->get_price( $cart_item['data'] );

            $total_discount     = 0.0;
            $total_discount_qty = 0;
            $discounted_prices  = array(); // list new prices per coupon discount and quantity.

            foreach ( $deals as $deal ) {
                $discount            = \ACFWF()->Helper_Functions->calculate_discount_by_type( $deal['discount_type'], $deal['discount'], $price['regular'] );
                $total_discount     += $discount * $deal['quantity'];
                $total_discount_qty += $deal['quantity'];

                if ( ! isset( $discounted_prices[ $discount ] ) ) {
                    $discounted_prices[ $discount ] = array(
                        'discount' => $discount,
                        'quantity' => 0,
                    );
                }

                $discounted_prices[ $discount ]['quantity'] += $deal['quantity'];
            }

            // calculate new item price based on the total discount and set it.
            // NOTE: this will only be false when $discount value is 0.
            if ( (bool) $total_discount ) {
                // get BOGO Buys price.
                $cart_item['data']->get_price_ignore_always_use_regular_price = true; // ignore always use regular price option, because BOGO Buys should always use the sale price if present.
                $price['buy'] = $this->_helper_functions->get_price( $cart_item['data'] ); // sale price of the item if present.

                // Calculate new_price, to get total price of the item.
                // new_price is the average price of the item after discount.
                $total_bogo_buy_qty = $cart_item['quantity'] - $total_discount_qty;
                $total_bogo_buy     = $price['buy'] * $total_bogo_buy_qty;
                $total_bogo_get     = ( $price['regular'] * $total_discount_qty ) - $total_discount;
                $new_price          = ( $total_bogo_buy + $total_bogo_get ) / $cart_item['quantity'];
                $cart_item['data']->set_price( $new_price );

                // add details to $this->_price_display property price differences on cart table.
                $this->_price_display[ $key ] = array(
                    'name'              => $cart_item['data']->get_name(),
                    'price'             => $price,
                    'new_price'         => $new_price,
                    'total_discount'    => $total_discount,
                    'discounted_prices' => $discounted_prices,
                );
            }
        }
    }

    /**
     * Add notice for all eligible deals.
     *
     * @since 1.4
     * @access private
     */
    private function _add_notice_for_eligible_deals() {
        $bogo_deal = $this->_calculation->get_bogo_deal();

        // if BOGO Deal last iteration has no fulfilled deals, then reverify triggers.
        if ( ! $bogo_deal->has_deal_fulfilled() ) {
            $this->_calculation->set_bogo_deal( $bogo_deal );
            $bogo_deal->reset_counters();

            // skip displaying notice if triggers are not verified.
            // NOTE: This means that the items that were used to verify the last iteration was used by another coupon.
            if ( ! $this->_calculation->verify_triggers( false, false ) ) {
                return;
            }
        }

        $coupon           = $bogo_deal->get_coupon();
        $allowed_entries  = $this->_calculation->get_entries_by_coupon( $coupon->get_code(), 'deal', 'allowed' );
        $allowed_quantity = array_sum( array_column( $allowed_entries, 'quantity' ) );

        if ( ! $allowed_quantity || ! apply_filters( 'acfw_bogo_deals_is_eligible_notice', true, $allowed_quantity, $coupon ) ) {
            return;
        }

        $settings    = $coupon->get_bogo_notice_settings();
        $message     = isset( $settings['message'] ) && $settings['message'] ? $settings['message'] : __( 'Your current cart is eligible to redeem deals.', 'advanced-coupons-for-woocommerce-free' );
        $message     = str_replace( array( '{acfw_bogo_remaining_deals_quantity}', '{acfw_bogo_coupon_code}' ), array( $allowed_quantity, $coupon->get_code() ), $message );
        $notice_type = isset( $settings['notice_type'] ) && $settings['notice_type'] ? $settings['notice_type'] : 'notice';
        $button_url  = isset( $settings['button_url'] ) && $settings['button_url'] ? $settings['button_url'] : get_permalink( wc_get_page_id( 'shop' ) );
        $button_text = isset( $settings['button_text'] ) && $settings['button_text'] ? $settings['button_text'] : __( 'View Deals', 'advanced-coupons-for-woocommerce-free' );
        $notice_text = sprintf( '<span class="acfw-bogo-notice-text">%s <a href="%s" class="button">%s</a></span>', $message, $button_url, $button_text );

        $this->_calculation->add_notice( $notice_text, $notice_type, $coupon->get_code() );
    }

    /**
     * Display eligible for deals notices.
     *
     * @since 1.4
     * @access private
     */
    private function _display_eligible_deal_notices() {
        if ( ! $this->_is_display_notice() ) {
            return;
        }

        foreach ( $this->_calculation->get_notices() as $notice ) {
            wc_add_notice(
                $notice['message'],
                $notice['type'],
                array(
					'acfw-bogo' => true,
					'coupon'    => $notice['coupon_code'],
                )
            );
        }
    }

    /**
     * Remove all eligible for deals notices.
     *
     * @since 1.4
     * @access private
     */
    private function _remove_eligible_for_deals_notices() {
        $all_notices = wc_get_notices();

        if ( empty( $all_notices ) ) {
            return;
        }

        foreach ( $all_notices as $notice_type => $notices ) {
            $all_notices[ $notice_type ] = array_filter(
                $notices,
                function ( $n ) {
                return ! isset( $n['data']['acfw-bogo'] );
                }
            );
        }

        wc_set_notices( $all_notices );
    }

    /**
     * Display discounted price on cart price column.
     *
     * @since 1.0
     * @access public
     *
     * @param string $price_html Item price.
     * @param array  $item       Cart item data.
     * @return string Filtered item price.
     */
    public function display_discounted_price( $price_html, $item ) {
        $key               = $item['key'];
        $data              = isset( $this->_price_display[ $key ] ) ? $this->_price_display[ $key ] : array();
        $discounted_prices = isset( $data['discounted_prices'] ) ? $data['discounted_prices'] : array();

        if ( ! empty( $discounted_prices ) ) {

            // show price for undiscounted quantity.
            $undiscounted_quantity = $item['quantity'] - array_sum( array_column( $discounted_prices, 'quantity' ) );
            $price_html            = $undiscounted_quantity > 0 ? sprintf( '<span class="acfw-undiscounted-price">%s × %s</span><br />', wc_price( $data['price']['buy'] ), $undiscounted_quantity ) : '';

            // create separate line for discount and its relative quantity.
            $per_coupon_price = array_map(
                function ( $dp ) use ( $data ) {
                return sprintf( '<span class="acfw-bogo-discounted-price">%s × %s</span>', wc_price( $data['price']['regular'] - $dp['discount'] ), $dp['quantity'] );
                },
                $discounted_prices
            );

            $price_html .= implode( '<br />', $per_coupon_price );
        }

        return $price_html;
    }

    /**
     * Display BOGO discounts summary on the coupons cart total row.
     *
     * @since 1.0
     * @access public
     *
     * @param string    $coupon_html Coupon row html.
     * @param WC_Coupon $coupon      Coupon object.
     * @param string    $discount_amount_html      Discount amount html.
     * @return string Filtered Coupon row html.
     */
    public function display_bogo_discount_summary( $coupon_html, $coupon, $discount_amount_html ) {
        if ( ! is_array( $this->_price_display ) || empty( $this->_price_display ) ) {
            return $coupon_html;
        }

        // get coupon raw discount amount.
        $amount = \WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );

        // remove coupon discount amount display if value is 0.
        if ( 0 === $amount ) {
            $coupon_html = str_replace( $discount_amount_html, '', $coupon_html );
        }

        $deals    = $this->_calculation->get_entries_by_coupon( $coupon->get_code(), 'deal' );
        $template = '<li><span class="label">%s x %s:</span> <span class="discount">%s</span></li>';
        $summary  = '';

        foreach ( $deals as $deal ) {

            $data              = isset( $this->_price_display[ $deal['key'] ] ) ? $this->_price_display[ $deal['key'] ] : array();
            $discounted_prices = isset( $data['discounted_prices'] ) ? $data['discounted_prices'] : array();

            // calculate total discount value for matched deal item, by looping on all applied discount prices.
            $discount = array_reduce(
                $discounted_prices,
                function( $c, $d ) {
                return $c - ( $d['discount'] * $d['quantity'] );
                },
                0.0
            );

            // if discount is not negative, then skip showing it in the summary.
            // also skip if $data is null.
            if ( empty( $data ) || 0 < $discount || $data['new_price'] >= $data['price'] ) {
                continue;
            }

            $item     = $this->_helper_functions->get_cart_item( $deal['key'] );
            $summary .= sprintf( $template, $item['data']->get_name(), $deal['quantity'], wc_price( $discount ) );
        }

        if ( $summary ) {
            $coupon_html .= sprintf( '<ul class="acfw-bogo-summary %s-bogo-summary" style="margin: 10px;">%s</ul>', $coupon->get_code(), $summary );
        }

        return $coupon_html;
    }

    /**
     * Save bogo discounts to order.
     *
     * @since 1.0
     * @since 4.3.3 Save total calculated BOGO discount to coupon line item meta.
     * @access public
     *
     * @param int       $order_id    Order id.
     * @param array     $posted_data Order posted data.
     * @param \WC_Order $order       Order object.
     */
    public function save_bogo_discounts_to_order( $order_id, $posted_data, $order ) {
        if ( ! is_array( $this->_price_display ) || empty( $this->_price_display ) ) {
            return;
        }

        // save overall BOGO discounts data to the order meta.
        $order->update_meta_data( Plugin_Constants::ORDER_BOGO_DISCOUNTS, array_values( $this->_price_display ) );
        $order->save_meta_data();

        $order_coupons = $order->get_items( 'coupon' );
        $coupon_code   = $this->_calculation->get_bogo_coupon_code();
        $order_coupon  = current(
            array_filter(
                $order_coupons,
                function( $oc ) use ( $coupon_code ) {
                    return $oc->get_code() === $coupon_code;
                }
            )
        );

        // calculate the total discount via BOGO for coupon.
        $bogo_discount = array_reduce(
            $this->_price_display,
            function( $c, $r ) {
            return $c + $r['total_discount'];
            },
            0.0
        );

        // save BOGO total discount to the coupon line item meta.
        $order_coupon->update_meta_data( Plugin_Constants::ORDER_COUPON_BOGO_DISCOUNT, $bogo_discount );
        $order_coupon->save_meta_data();

        // clear session data.
        Calculation::clear_session_data();
    }

    /*
    |--------------------------------------------------------------------------
    | Utility Functions
    |--------------------------------------------------------------------------
     */

    /**
     * Only show notice when a new coupon is being applied or when loading the cart or checkout fragments refresh.
     *
     * @since 1.4
     * @access private
     *
     * @return bool
     */
    private function _is_display_notice() {
        // don't display notice on stripe cart details check.
        if ( isset( $_REQUEST['wc-ajax'] ) && 'wc_stripe_get_cart_details' === $_REQUEST['wc-ajax'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            return false;
        }

        return $this->_helper_functions->is_cart() || $this->_helper_functions->is_checkout_fragments();
    }

    /*
    |--------------------------------------------------------------------------
    | Fulfill implemented interface contracts
    |--------------------------------------------------------------------------
     */

    /**
     * Execute Frontend class.
     *
     * @since 1.4
     * @access public
     * @inherit ACFWF\Interfaces\Model_Interface
     */
    public function run() {
        if ( ! $this->_helper_functions->is_module( Plugin_Constants::BOGO_DEALS_MODULE ) ) {
            return;
        }

        add_filter( 'woocommerce_coupon_is_valid', array( $this, 'restrict_cart_to_only_one_bogo_deal' ), 10, 2 );
        add_action( 'woocommerce_before_calculate_totals', array( $this, 'implement_bogo_deals' ), 11 );
        add_filter( 'woocommerce_cart_item_price', array( $this, 'display_discounted_price' ), 10, 2 );
        add_filter( 'woocommerce_cart_totals_coupon_html', array( $this, 'display_bogo_discount_summary' ), 10, 3 );
        add_action( 'woocommerce_checkout_order_processed', array( $this, 'save_bogo_discounts_to_order' ), 10, 3 );
    }

}
