<?php
namespace ACFWF\Models\Store_Credits;

use ACFWF\Abstracts\Abstract_Main_Plugin_Class;
use ACFWF\Helpers\Helper_Functions;
use ACFWF\Helpers\Plugin_Constants;
use ACFWF\Interfaces\Activatable_Interface;
use ACFWF\Interfaces\Initializable_Interface;
use ACFWF\Interfaces\Model_Interface;
use ACFWF\Models\Objects\Store_Credit_Entry;
use ACFWF\Models\Store_Credits\Queries;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Model that houses the logic of the Store Credits Admin module.
 *
 * @since 4.0
 */
class Admin implements Model_Interface, Activatable_Interface, Initializable_Interface {
    /*
    |--------------------------------------------------------------------------
    | Class Properties
    |--------------------------------------------------------------------------
     */

    /**
     * Property that houses the model name to be used when calling publicly.
     *
     * @since 4.0
     * @access private
     * @var string
     */
    private $_model_name = 'Store_Credits_Admin';

    /**
     * Property that holds the single main instance of Store_Credits_Admin.
     *
     * @since 4.0
     * @access private
     * @var Admin
     */
    private static $_instance;

    /**
     * Model that houses all the plugin constants.
     *
     * @since 4.0
     * @access private
     * @var Plugin_Constants
     */
    private $_constants;

    /**
     * Property that houses all the helper functions of the plugin.
     *
     * @since 4.0
     * @access private
     * @var Helper_Functions
     */
    private $_helper_functions;

    /**
     * Model that houses all the store credit query methods.
     *
     * @since 4.5.5
     * @access private
     * @var Queries
     */
    private $_queries;

    /*
    |--------------------------------------------------------------------------
    | Class Methods
    |--------------------------------------------------------------------------
     */

    /**
     * Class constructor.
     *
     * @since 4.0
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin      Main plugin object.
     * @param Plugin_Constants           $constants        Plugin constants object.
     * @param Helper_Functions           $helper_functions Helper functions object.
     */
    public function __construct( Abstract_Main_Plugin_Class $main_plugin, Plugin_Constants $constants, Helper_Functions $helper_functions ) {
        $this->_constants        = $constants;
        $this->_helper_functions = $helper_functions;
        $this->_queries          = Queries::get_instance( $constants, $helper_functions );

        $main_plugin->add_to_all_plugin_models( $this, $this->_model_name );
        $main_plugin->add_to_public_models( $this, $this->_model_name );
    }

    /**
     * Ensure that only one instance of this class is loaded or can be loaded ( Singleton Pattern ).
     *
     * @since 4.0
     * @access public
     *
     * @param Abstract_Main_Plugin_Class $main_plugin      Main plugin object.
     * @param Plugin_Constants           $constants        Plugin constants object.
     * @param Helper_Functions           $helper_functions Helper functions object.
     * @return Admin
     */
    public static function get_instance( Abstract_Main_Plugin_Class $main_plugin, Plugin_Constants $constants, Helper_Functions $helper_functions ) {
        if ( ! self::$_instance instanceof self ) {
            self::$_instance = new self( $main_plugin, $constants, $helper_functions );
        }

        return self::$_instance;
    }

    /*
    |--------------------------------------------------------------------------
    | DB Creation.
    |--------------------------------------------------------------------------
     */

    /**
     * Create database table for store credits.
     *
     * @since 4.0
     * @access private
     */
    private function _create_db_table() {
        global $wpdb;

        if ( get_option( Plugin_Constants::STORE_CREDITS_DB_CREATED ) === 'yes' ) {
            return;
        }

        $store_credits_db = $wpdb->prefix . Plugin_Constants::STORE_CREDITS_DB_NAME;
        $charset_collate  = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $store_credits_db (
            entry_id bigint(20) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NOT NULL,
            entry_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            entry_type varchar(20) NOT NULL,
            entry_action varchar(20) NOT NULL,
            entry_amount varchar(255) NOT NULL,
            object_id bigint(20) NOT NULL,
            entry_note TEXT NULL,
            PRIMARY KEY (entry_id)
        ) $charset_collate;\n";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

        update_option( Plugin_Constants::STORE_CREDITS_DB_CREATED, 'yes' );
    }

    /**
     * Initialize settings during plugin activation/update.
     *
     * @since 4.5.2
     * @access private
     */
    private function _init_settings() {

        $apply_type        = get_option( Plugin_Constants::STORE_CREDIT_APPLY_TYPE );
        $installed_version = get_site_option( Plugin_Constants::INSTALLED_VERSION );

        // Set store credit apply type as "after_tax" when plugin is updated and not freshly installed.
        if ( $installed_version && version_compare( '4.5.2', $installed_version, '>' ) && ! $apply_type ) {
            update_option( Plugin_Constants::STORE_CREDIT_APPLY_TYPE, 'after_tax' );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | User Balance
    |--------------------------------------------------------------------------
     */

    /**
     * Set zero balance for newly registered users.
     * This is to ensure users will show up on customer table.
     *
     * @since 4.0
     * @access public
     *
     * @param int $user_id User ID.
     */
    public function set_zero_balance_for_new_registered_user( $user_id ) {
        // skip if meta already exists.
        if ( get_user_meta( $user_id, Plugin_Constants::STORE_CREDIT_USER_BALANCE, true ) ) {
            return;
        }

        update_user_meta( $user_id, Plugin_Constants::STORE_CREDIT_USER_BALANCE, '0' );
    }

    /*
    |--------------------------------------------------------------------------
    | Admin display methods
    |--------------------------------------------------------------------------
     */

    /**
     * Display store credits discount on edit order admin pages.
     *
     * @since 4.0
     * @since 4.2.1 We're moving the Store Credit order implementation from being applied as a "discount" to applying it
     *              as a payment instead. We will still be keeping this function for backwards compatibility for old orders
     *              that has store credits discounts in them.
     * @access public
     *
     * @param int $order_id Order ID.
     */
    public function display_store_credits_discount_on_edit_order( $order_id ) {
        $order       = wc_get_order( $order_id );
        $sc_discount = $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_META, true );

        if ( ! $sc_discount ) {
            return;
        }

        include $this->_constants->VIEWS_ROOT_PATH() . 'store-credits' . DIRECTORY_SEPARATOR . 'view-edit-order-store-credit-discounts-row.php';
    }

    /**
     * Display the amount paid via Store Credits in its own row in the admin order totals table.
     *
     * @since 4.2.1
     * @since 4.5.1.1 Moved store credits payment summary to a separate function.
     * @access public
     *
     * @param int $order_id Order ID.
     */
    public function display_paid_in_store_credits_row( $order_id ) {
        $order   = wc_get_order( $order_id );
        $sc_data = $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_PAID, true );

        if ( ! $sc_data ) {
            return;
        }

        include $this->_constants->VIEWS_ROOT_PATH() . 'store-credits' . DIRECTORY_SEPARATOR . 'view-edit-order-store-credit-paid-row.php';
    }

    /**
     * Display the store credits payment summary for the order.
     *
     * @since 4.5.1.1
     * @access public
     *
     * @param int $order_id Order ID.
     */
    public function display_store_credits_payment_summary( $order_id ) {
        $order   = wc_get_order( $order_id );
        $sc_data = $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_PAID, true );

        if ( ! $sc_data ) {
            return;
        }

        $non_sc_amount = wc_remove_number_precision( wc_add_number_precision( $sc_data['cart_total'] ) - wc_add_number_precision( $sc_data['amount'] ) ); // amount after deducting store credits from the order total.
        $is_order_paid = in_array( $order->get_status(), array( 'processing', 'completed', 'refunded' ), true ) && ! empty( $order->get_date_paid() );

        if ( $is_order_paid ) {
            $non_sc_label = sprintf(
                /* Translators: %1$s: Payment date, %2$s: Payment gateway */
                _x( 'Paid on %1$s via %2$s', 'Paid on {date} via {payment gateway}', 'advanced-coupons-for-woocommerce-free' ),
                $order->get_date_paid()->date_i18n( get_option( 'date_format' ) ),
                $order->get_payment_method_title()
            );
        } else {
            $non_sc_label = __( 'Pending amount to be paid', 'advanced-coupons-for-woocommerce-free' );
        }

        include $this->_constants->VIEWS_ROOT_PATH() . 'store-credits' . DIRECTORY_SEPARATOR . 'view-edit-order-store-credit-payment-summary.php';
    }

    /**
     * Create refund store credit entry after manual refund has been completed.
     *
     * @since 4.0
     * @since 4.2   Add hook to trigger actions based on user's new balance after an order was refunded.
     * @since 4.5.1 Save store credit entry ID to the refund order post meta.
     * @access public
     *
     * @param int $order_id  Order ID.
     * @param int $refund_id Refund ID.
     */
    public function manual_refund_via_store_credits( $order_id, $refund_id ) {
        if ( ! isset( $_POST['acfw_store_credits'] ) || ! $_POST['acfw_store_credits'] ) { // phpcs:ignore
            return;
        }

        $refund             = new \WC_Order_Refund( $refund_id );
        $order              = wc_get_order( $order_id );
        $store_credit_entry = new Store_Credit_Entry();

        // filter for currency conversion, converting from order currency to site currency.
        $refund_amount = apply_filters(
            'acfw_filter_amount',
            (float) $refund->get_amount(),
            true,
            array(
                'user_currency' => $order->get_currency(),
                'site_currency' => get_option( 'woocommerce_currency' ),
            )
        );

        $store_credit_entry->set_prop( 'amount', $refund_amount );
        $store_credit_entry->set_prop( 'type', 'increase' );
        $store_credit_entry->set_prop( 'user_id', $order->get_customer_id() );
        $store_credit_entry->set_prop( 'action', 'refund' );
        $store_credit_entry->set_prop( 'object_id', $order->get_id() );

        $store_credit_entry->save();

        // Save the store credit entry ID as meta data in the refund order object.
        $refund->update_meta_data( Plugin_Constants::REFUND_ORDER_STORE_CREDIT_ENTRY, $store_credit_entry->get_id() );
        $refund->save_meta_data();

        // update users cached balance value.
        $new_balance = \ACFWF()->Store_Credits_Calculate->get_customer_balance( $order->get_customer_id(), true );

        do_action( 'acfw_after_order_refunded_via_store_credits', $refund_amount, $new_balance, $order, $store_credit_entry );
    }

    /**
     * Add text in refund order item line to indicate if the order was refunded as store credits.
     *
     * @since 4.5.1
     * @access public
     *
     * @param \WC_Order_Refund $refund Refund order object.
     */
    public function append_store_credits_to_refund_item_name( $refund ) {
        if ( ! $refund->get_meta( Plugin_Constants::REFUND_ORDER_STORE_CREDIT_ENTRY ) ) {
            return;
        }

        echo wp_kses_post( sprintf( ' <div class="acfw-store-credits-refund-item-name"><em>%s</em></div>', __( 'Refunded to Store Credits', 'advanced-coupons-for-woocommerce-free' ) ) );
    }

    /**
     * Make sure that store credits discount value is included when order totals is recalculated.
     *
     * @since 4.0.3
     * @since 4.2.1 Store credits will now be applied as "payment" instead of "discount" so this function will now just
     *              move the store credits data from the discount meta to the new paid meta, and delete the discount meta.
     * @access public
     *
     * @param bool     $and_taxes Flag to calc taxes in WC.
     * @param WC_Order $order     Order object.
     */
    public function order_recalculate_store_credit_discounts( $and_taxes, $order ) {
        $sc_discount = $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_META, true );

        // skip if order has no store credits discount.
        if ( ! is_array( $sc_discount ) || empty( $sc_discount ) ) {
            return;
        }

        // move discount meta to paid meta.
        $order->update_meta_data( Plugin_Constants::STORE_CREDITS_ORDER_PAID, $sc_discount );

        // delete old discount meta.
        $order->delete_meta_data( Plugin_Constants::STORE_CREDITS_ORDER_META );

        // save meta data in order.
        $order->save_meta_data();
    }

    /**
     * Force display the the recalculate button for orders with old store credits discount data
     * so store owners can manually recalculate this orders in order to correct the values.
     *
     * @since 4.2.1
     * @since 4.5.1.1 Update condition to check store credits version meta instead.
     * @access public
     *
     * @param WC_Order $order      Order object.
     * @return bool Filter return value.
     */
    public function display_recalculate_button_for_old_orders_store_credits_discount( $order ) {
        // skip when order is already editable.
        if ( $order->is_editable() ) {
            return;
        }

        $sc_version = $order->get_meta( Plugin_Constants::STORE_CREDITS_VERSION, true );

        // skip when order has no store credits discount data.
        if ( $sc_version && version_compare( $sc_version, '4.5.1.1', '>=' ) ) {
            return;
        }

        echo sprintf(
            '<button type="button" class="button button-primary calculate-action">%s</button>',
            esc_html__( 'Recalculate', 'advanced-coupons-for-woocommerce-free' )
        );
    }

    /**
     * Deduct the store credit amount from the total discounts (Coupon(s): row) displayed in the edit order page.
     *
     * @since 4.5.1.1
     * @access public
     *
     * @param float     $total_discount Order total discount.
     * @param \WC_Order $order          Order object.
     * @return float Filtered order total discount.
     */
    public function deduct_store_credit_amount_from_total_discounts_on_edit_order_page( $total_discount, $order ) {

        if ( ! is_admin() || ! did_action( 'woocommerce_admin_order_items_after_line_items' ) ) {
            return $total_discount;
        }

        $sc_data    = $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_PAID, true );
        $sc_version = $order->get_meta( Plugin_Constants::STORE_CREDITS_VERSION, true );

        // Only deduct for orders with store credits data and the calculation is of the latest version of store credits.
        if ( $sc_version && is_array( $sc_data ) && ! empty( $sc_data ) ) {
            $total_discount = wc_remove_number_precision( wc_add_number_precision( $total_discount ) - wc_add_number_precision( $sc_data['amount'] ) );
        }

        return $total_discount;
    }

    /**
     * Add store credit summary in order preview popup.
     *
     * @since 4.5.2
     * @access public
     *
     * @param \WC_Order $order Order object.
     */
    public function display_store_credits_summary_in_order_preview_popup( $order ) {

        $sc_data = $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_PAID, true );

        if ( is_array( $sc_data ) && isset( $sc_data['amount'] ) ) {
            include $this->_constants->VIEWS_ROOT_PATH() . 'orders' . DIRECTORY_SEPARATOR . 'order-preview-popup-store-credit-summary.php';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Apply Store Credits in pending order
    |--------------------------------------------------------------------------
     */

    /**
     * Display the apply store credits discount in the edit order page.
     *
     * @since 4.5.4
     * @access public
     *
     * @param \WC_Order $order Order object.
     */
    public function display_apply_store_credits_discount_in_edit_order_page( $order ) {

        $allowed_statuses = array( 'pending', 'on-hold', 'checkout-draft' );

        if ( ! in_array( $order->get_status(), $allowed_statuses, true ) || // Skip if order status is not allowed.
            ! $order->get_customer_id() ) { // Skip if order has no customer.
            return;
        }

        $btn_text = __( 'Apply Store Credits', 'advanced-coupons-for-woocommerce-free' );

        if ( $order->get_meta( Plugin_Constants::STORE_CREDITS_ORDER_PAID, true ) ||
            $this->_helper_functions->get_order_applied_coupon_item_by_code( \ACFWF()->Store_Credits_Checkout->get_store_credit_coupon_code(), $order ) ) {
            $btn_text = __( 'Update Store Credits', 'advanced-coupons-for-woocommerce-free' );
        }

        echo wp_kses_post(
            sprintf(
                '<button type="button" class="button acfw-apply-store-credits">%s</button>',
                $btn_text
            )
        );
    }

    /**
     * Apply store credits to order.
     *
     * @since 4.5.4
     * @access public
     *
     * @param \WC_Order $order Order object.
     * @param float     $amount Store credits amount.
     * @throws \Exception When store credits amount is invalid.
     */
    public function apply_store_credits_to_order( $order, $amount ) {

        $balance = \ACFWF()->Store_Credits_Calculate->get_customer_balance( $order->get_customer_id(), true );

        // skip when either of the following is true: amount is zero, order total is zero or when customer has insufficient store credits balance.
        if ( 0 >= $amount || 0 >= $order->get_total() || $amount > $balance ) {
            throw new \Exception( __( 'Store credits amount is invalid.', 'advanced-coupons-for-woocommerce-free' ) );
        }

        $amount  = min( $amount, $order->get_total( 'edit' ) );
        $sc_data = array(
            'amount'     => $amount, // user currency based amount.
            'raw_amount' => apply_filters( 'acfw_filter_amount', $amount, true, array( 'user_currency' => $order->get_currency() ) ), // site currency based amount.
            'cart_total' => $order->get_total( 'edit' ),
            'currency'   => $order->get_currency(),
        );

        if ( 'coupon' === get_option( Plugin_Constants::STORE_CREDIT_APPLY_TYPE, 'coupon' ) ) { // Apply store credit discount as coupon.

            // set the store credit discount data to our override function.
            \ACFWF()->Store_Credits_Checkout->set_coupon_override_data( $sc_data );

            $coupon_code = \ACFWF()->Store_Credits_Checkout->get_store_credit_coupon_code();

            /**
             * The coupon object instance created here will be overrided so its data will now have the amount set
             * in the window prompt. This is done via the `woocommerce_get_shop_coupon_data` filter.
             *
             * For more info, see the function `\ACFWF\Models\Store_Credits\Checkout::override_store_credit_coupon_data`.
             */
            $coupon = new \WC_Coupon( $coupon_code );

            // apply the store credit coupon to the order.
            $order->apply_coupon( $coupon );

        } else { // Apply store credit discount after tax.

            // save store credit metadata to order.
            $order->update_meta_data( Plugin_Constants::STORE_CREDITS_ORDER_PAID, $sc_data );
            $order->save_meta_data();
        }

        $order->save();

        // recalculate order totals so the store credit payment is deducted from the order total.
        $order->calculate_totals( true );

        // Create the store credit entry.
        $store_credit_entry = \ACFWF()->Store_Credits_Checkout->create_discount_store_credit_entry( $amount, $order );

        // update users cached balance value.
        $new_balance = \ACFWF()->Store_Credits_Calculate->get_customer_balance( $order->get_customer_id(), true );

        do_action( 'acfw_after_apply_store_credits_to_order', $amount, $new_balance, $order, $store_credit_entry );
    }

    /**
     * Update the store credits amount applied in the order.
     *
     * @since 4.5.5
     * @access public
     *
     * @param \WC_Order $order       Order object.
     * @param float     $amount      Store credits amount.
     * @param float     $sc_discount Store credits discount applied in the order.
     * @throws \Exception When store credits amount is invalid.
     */
    public function update_store_credits_in_order( $order, $amount, $sc_discount ) {

        $balance = \ACFWF()->Store_Credits_Calculate->get_customer_balance( $order->get_customer_id(), true );

        // skip when either of the following is true: amount is zero, order total is zero or when customer has insufficient store credits balance.
        if ( 0 >= ( $order->get_total( 'edit' ) + $sc_discount ) || $amount > ( $balance + $sc_discount ) ) {
            throw new \Exception( __( 'Store credits amount is invalid.', 'advanced-coupons-for-woocommerce-free' ) );
        }

        $store_credit_entry = $this->_queries->query_single_store_credit_entry(
            array(
                'type'      => 'decrease',
                'action'    => 'discount',
                'object_id' => $order->get_id(),
            )
        );

        if ( ! $store_credit_entry instanceof Store_Credit_Entry ) {
            throw new \Exception( __( "The order doesn't have a valid store credit discount applied.", 'advanced-coupons-for-woocommerce-free' ) );
        }

        if ( 0 >= $amount ) {
            $this->_delete_store_credits_from_order( $order, $store_credit_entry );
            return;
        }

        $amount  = min( $amount, $order->get_total( 'edit' ) + $sc_discount );
        $sc_data = array(
            'amount'     => $amount, // user currency based amount.
            'raw_amount' => apply_filters( 'acfw_filter_amount', $amount, true, array( 'user_currency' => $order->get_currency() ) ), // site currency based amount.
            'cart_total' => $order->get_total( 'edit' ),
            'currency'   => $order->get_currency(),
        );

        // check if order has coupon applied called 'store credits'.
        $store_credit_coupon = $this->_helper_functions->get_order_applied_coupon_item_by_code( \ACFWF()->Store_Credits_Checkout->get_store_credit_coupon_code(), $order );

        // update store credit coupon amount (before tax type).
        if ( $store_credit_coupon instanceof \WC_Order_Item_Coupon ) {

            // update store credit coupon data.
            $coupon_data           = $store_credit_coupon->get_meta( 'coupon_data', true );
            $coupon_data['amount'] = $amount;

            // update coupon item amount.
            $store_credit_coupon->update_meta_data( 'coupon_data', $coupon_data );
            $store_credit_coupon->set_discount( $amount );
            $store_credit_coupon->save();

            $order->add_item( $store_credit_coupon );
            $order->save();

            // recalculate discounts for the order.
            $order->recalculate_coupons();

        } else { // update store credits payment amount (after tax type).

            // save store credit metadata to order.
            $order->update_meta_data( Plugin_Constants::STORE_CREDITS_ORDER_PAID, $sc_data );
            $order->save_meta_data();

            // recalculate order totals so the store credit payment is deducted from the order total.
            $order->calculate_totals( true );
        }

        // Update store credit entry amount.
        $store_credit_entry->set_prop( 'amount', $amount );
        $store_credit_entry->save();

        // update users cached balance value.
        $new_balance = \ACFWF()->Store_Credits_Calculate->get_customer_balance( $order->get_customer_id(), true );

        do_action( 'acfw_after_update_store_credits_to_order', $amount, $new_balance, $order, $store_credit_entry );
    }

    /**
     * Delete the store credits amount applied in the order.
     *
     * @since 4.5.5
     * @access private
     *
     * @param \WC_Order          $order              Order object.
     * @param Store_Credit_Entry $store_credit_entry Store credit entry object.
     */
    private function _delete_store_credits_from_order( $order, $store_credit_entry ) {

        // check if order has coupon applied called 'store credits'.
        $store_credit_coupon = $this->_helper_functions->get_order_applied_coupon_item_by_code( \ACFWF()->Store_Credits_Checkout->get_store_credit_coupon_code(), $order );

        // delete store credit discount data from order.
        if ( $store_credit_coupon instanceof \WC_Order_Item_Coupon ) {
            $order->remove_item( $store_credit_coupon->get_id() );
            $order->recalculate_coupons();
            $store_credit_coupon->delete();
        } else {
            $order->delete_meta_data( Plugin_Constants::STORE_CREDITS_ORDER_PAID );
        }

        $order->calculate_totals( true );

        // delete store credit entry.
        $store_credit_entry->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX Functions
    |--------------------------------------------------------------------------
     */

    /**
     * AJAX Apply store credits to order.
     *
     * @since 4.5.4
     * @access public
     *
     * @throws \Exception When invalid request.
     */
    public function ajax_apply_store_credits_to_order() {
        check_ajax_referer( 'order-item', 'security' );

        if ( ! current_user_can( 'edit_shop_orders' ) ) {
            wp_die( -1 );
        }

        $response = array();

        try {

            if ( ! isset( $_POST['order_id'] ) || ! isset( $_POST['amount'] ) ) {
                throw new \Exception( __( 'Invalid request.', 'advanced-coupons-for-woocommerce-free' ) );
            }

            $order_id    = absint( $_POST['order_id'] );
            $amount      = (float) wc_format_decimal( wp_unslash( $_POST['amount'] ) );
            $order       = \wc_get_order( $order_id );
            $sc_discount = \ACFWF()->Store_Credits_Calculate->get_total_store_credits_discount_for_order( $order->get_id() );

            if ( 0 < $sc_discount ) {
                $this->update_store_credits_in_order( $order, $amount, $sc_discount );
            } else {
                $this->apply_store_credits_to_order( $order, $amount );
            }

            ob_start();
            include WC_ABSPATH . 'includes/admin/meta-boxes/views/html-order-items.php';
            $response['html'] = ob_get_clean();

        } catch ( \Exception $e ) {
            wp_send_json_error( array( 'error' => $e->getMessage() ) );
        }

        wp_send_json_success( $response );
    }

    /*
    |--------------------------------------------------------------------------
    | Fulfill implemented interface contracts
    |--------------------------------------------------------------------------
     */

    /**
     * Execute codes that needs to run plugin activation.
     *
     * @since 4.0
     * @access public
     * @implements ACFWF\Interfaces\Activatable_Interface
     */
    public function activate() {
        $this->_create_db_table();
        $this->_init_settings();
    }

    /**
     * Execute codes that needs to run plugin activation.
     *
     * @since 4.5.4
     * @access public
     * @implements ACFWF\Interfaces\Initializable_Interface
     */
    public function initialize() {
        if ( ! $this->_helper_functions->is_module( Plugin_Constants::STORE_CREDITS_MODULE ) ) {
            return;
        }

        add_action( 'wp_ajax_acfwf_apply_store_credits_to_order', array( $this, 'ajax_apply_store_credits_to_order' ) );
    }

    /**
     * Execute Store_Credits class.
     *
     * @since 4.0
     * @access public
     * @inherit ACFWF\Interfaces\Model_Interface
     */
    public function run() {
        if ( ! $this->_helper_functions->is_module( Plugin_Constants::STORE_CREDITS_MODULE ) ) {
            return;
        }

        add_action( 'user_register', array( $this, 'set_zero_balance_for_new_registered_user' ) );
        add_action( 'woocommerce_admin_order_totals_after_tax', array( $this, 'display_store_credits_discount_on_edit_order' ) );
        add_action( 'woocommerce_order_refunded', array( $this, 'manual_refund_via_store_credits' ), 10, 2 );
        add_action( 'woocommerce_after_order_refund_item_name', array( $this, 'append_store_credits_to_refund_item_name' ) );
        add_action( 'woocommerce_order_after_calculate_totals', array( $this, 'order_recalculate_store_credit_discounts' ), 90, 2 ); // run late so it's calculated last.
        add_action( 'woocommerce_admin_order_totals_after_tax', array( $this, 'display_paid_in_store_credits_row' ) );
        add_action( 'woocommerce_admin_order_totals_after_total', array( $this, 'display_store_credits_payment_summary' ) );
        add_filter( 'woocommerce_order_item_add_action_buttons', array( $this, 'display_recalculate_button_for_old_orders_store_credits_discount' ) );
        add_filter( 'woocommerce_order_get_total_discount', array( $this, 'deduct_store_credit_amount_from_total_discounts_on_edit_order_page' ), 10, 2 );
        add_filter( 'acfw_after_order_preview_popup_summary', array( $this, 'display_store_credits_summary_in_order_preview_popup' ), 10, 2 );
        add_action( 'woocommerce_order_item_add_action_buttons', array( $this, 'display_apply_store_credits_discount_in_edit_order_page' ) );
    }

}
