<?php
if ( ! defined( 'WFACP_TEMPLATE_DIR' ) ) {
	return '';
}
$initial_packages = WC()->shipping->get_packages();

$show_package_details = count( WC()->cart->recurring_carts ) > 1;
$show_package_name    = true;

// Create new subscriptions for each subscription product in the cart (that is not a renewal)
foreach ( WC()->cart->recurring_carts as $recurring_cart_key => $recurring_cart ) {

	// Create shipping packages for each subscription item
	if ( WC_Subscriptions_Cart::cart_contains_subscriptions_needing_shipping( $recurring_cart ) && 0 !== $recurring_cart->next_payment_date ) {

		// This will get a package with the 'recurring_cart_key' set to 'none' (because WC_Subscriptions_Cart::display_recurring_totals() set WC_Subscriptions_Cart::$calculation_type to 'recurring_total', but WC_Subscriptions_Cart::$recurring_cart_key has not been set), which ensures that it's a unique package, which we need in order to get all the available packages, not just the package for the recurring cart calculation we completed previously where WC_Subscriptions_Cart::filter_package_rates() removed all unchosen rates and which WC then cached
		$packages = $recurring_cart->get_shipping_packages();


		foreach ( $packages as $i => $base_package ) {
			if ( version_compare( WFACP_Common_Helper::get_subscription_version(), '3.1.0', '>' ) ) {
				$i = isset( $recurring_cart_package['package_index'] ) ? $recurring_cart_package['package_index'] : 0;
			}
			$product_names                      = array();
			$base_package['recurring_cart_key'] = $recurring_cart_key;

			$package = WC()->shipping->calculate_shipping_for_package( $base_package );
			$index   = sprintf( '%1$s_%2$d', $recurring_cart_key, $i );

			if ( $show_package_details ) {
				foreach ( $package['contents'] as $item_id => $values ) {
					$product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];
				}
				$package_details = implode( ', ', $product_names );
			} else {
				$package_details = '';
			}

			$chosen_initial_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';

			if ( count( $package['rates'] ) > 1 ) {

				$package['rates'] = WFACP_Common::sort_shipping( $package['rates'] );
			}
			if ( isset( WC()->session->chosen_shipping_methods[ $recurring_cart_key . '_' . $i ] ) ) {
				$chosen_recurring_method = WC()->session->chosen_shipping_methods[ $recurring_cart_key . '_' . $i ];
			} elseif ( in_array( $chosen_initial_method, $package['rates'] ) ) {
				$chosen_recurring_method = $chosen_initial_method;
			} else {
				$chosen_recurring_method = empty( $package['rates'] ) ? '' : current( $package['rates'] )->id;
			}
			$shipping_selection_displayed = false;
			if ( ( 1 === count( $package['rates'] ) ) || ( isset( $package['rates'][ $chosen_initial_method ] ) && isset( $initial_packages[ $i ] ) && ($package['rates'] === $initial_packages[ $i ]['rates']) && apply_filters( 'wcs_cart_totals_shipping_html_price_only', true, $package, $recurring_cart ) ) ) {
				$shipping_method          = ( 1 === count( $package['rates'] ) ) ? current( $package['rates'] ) : $package['rates'][ $chosen_initial_method ];
				$recurring_shipping_count = '';
				if ( 1 === count( $package['rates'] ) ) {
					$recurring_shipping_count = 'wfacp_recuring_shiping_count_one';
				}
				?>
                <tr class="shipping recurring-total <?php echo esc_attr( $recurring_cart_key ) . ' ' . $recurring_shipping_count; ?>">
                    <td colspan="">
						<?php
						if ( ! empty( $show_package_details ) ) :
							echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>';
						endif;
						?>
                        <ul id="shipping_method_<?php echo md5( $show_package_details ); ?>" class="woocommerce-shipping-methods">
                            <li class="wfacp_single_shipping_method">
                                <div class="wfacp_single_shipping">
                                    <div class="wfacp_shipping_radio">
										<?php
										wcs_cart_print_shipping_input( $index, $shipping_method, $shipping_method->id, 'radio' );
										printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', esc_attr( $index ), esc_attr( sanitize_title( $shipping_method->id ) ), WFACP_Common::shipping_method_label( $shipping_method ) );
										?>
                                    </div>
                                    <div class="wfacp_shipping_price">
										<?php
										echo wp_kses_post( wcs_cart_totals_shipping_method_price_label( $shipping_method, $recurring_cart ) );
										?>
                                    </div>
                                </div>
                                <div class="wfacp_single_shipping">
									<?php
									do_action( 'woocommerce_after_shipping_rate', $shipping_method, $index );
									?>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
				<?php
			} else {


				$shipping_selection_displayed = true;

				if ( $show_package_name ) {
					$package_name = apply_filters( 'woocommerce_shipping_package_name', sprintf( _n( 'Shipping', 'Shipping %d', ( $i + 1 ), 'woocommerce-subscriptions' ), ( $i + 1 ) ), $i, $package );
				} else {
					$package_name = '';
				}

				wc_get_template( 'wfacp/checkout/cart-recurring-shipping-calculate.php', array(
					'package'              => $package,
					'available_methods'    => $package['rates'],
					'show_package_details' => $show_package_details,
					'package_details'      => $package_details,
					'package_name'         => $package_name,
					'index'                => $index,
					'chosen_method'        => $chosen_recurring_method,
					'recurring_cart_key'   => $recurring_cart_key,
					'recurring_cart'       => $recurring_cart,
				));
				$show_package_name = false;
			}
			do_action( 'woocommerce_subscriptions_after_recurring_shipping_rates', $index, $base_package, $recurring_cart, $chosen_recurring_method, $shipping_selection_displayed );
		}
	}
}
