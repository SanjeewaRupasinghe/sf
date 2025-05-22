<?php
$theme            = wp_get_theme( 'ekommart' );
$ekommart_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}
require 'inc/class-tgm-plugin-activation.php';
$ekommart = (object) array(
	'version' => $ekommart_version,
	/**
	 * Initialize all the things.
	 */
	'main'    => require 'inc/class-main.php',
);

require 'inc/functions.php';
require 'inc/template-hooks.php';
require 'inc/template-functions.php';

require_once 'inc/merlin/vendor/autoload.php';
require_once 'inc/merlin/class-merlin.php';
require_once 'inc/merlin-config.php';

$ekommart->options = require 'inc/options/class-options.php';

if ( ekommart_is_woocommerce_activated() ) {
	$ekommart->woocommerce = require 'inc/woocommerce/class-woocommerce.php';

	require 'inc/woocommerce/class-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/woocommerce-functions.php';
	require 'inc/woocommerce/woocommerce-template-functions.php';
	require 'inc/woocommerce/woocommerce-template-hooks.php';
	require 'inc/woocommerce/template-hooks.php';
	require 'inc/woocommerce/class-woocommerce-size-chart.php';
    require 'inc/woocommerce/class-woocommerce-extra.php';
    require 'inc/woocommerce/class-woocommerce-gallery-video.php';

    if (class_exists('WeDevs_Dokan')) {
        require 'inc/dokan/class-dokan.php';
        require 'inc/dokan/dokan-template-functions.php';
        require 'inc/dokan/dokan-template-hooks.php';
    }
}

if ( ekommart_is_elementor_activated() ) {
	require 'inc/elementor/functions-elementor.php';
	$ekommart->elementor = require 'inc/elementor/class-elementor.php';
	$ekommart->megamenu  = require 'inc/megamenu/megamenu.php';

	if ( ekommart_get_theme_option( 'enable-footer-builder', false ) ) {
		require 'inc/builder/class-footer-builder.php';
	}

	require 'inc/elementor/class-elementor-pro.php';
}

if ( ! is_user_logged_in() ) {
	require 'inc/modules/class-login.php';
}

if ( is_admin() ) {
	$ekommart->admin = require 'inc/admin/class-admin.php';
}

add_action('wp_ajax_payment_gateway_request',        'payment_gateway_request');
add_action('wp_ajax_nopriv_payment_gateway_request', 'payment_gateway_request');

add_action('wp_ajax_validate_merchant',        'validate_merchant');
add_action('wp_ajax_nopriv_validate_merchant', 'validate_merchant');

add_action('wp_ajax_add_to_order',        'add_to_order');
add_action('wp_ajax_nopriv_add_to_order', 'add_to_order');

function payment_gateway_request() {

  parse_str(urldecode($_POST['orderData']),  $orderData);

  ## ------------- START ADD ORDER ---------------- ##

  $totalPaid = isset($_POST['amount']) ? $_POST['amount'] : 0;
  $token = isset($_POST['token']) ? $_POST['token'] : 0;

  $address = array(
      'first_name' => $orderData['billing_first_name'],
      'last_name'  => $orderData['billing_last_name'],
      'company'    => 'Safety Med',
      'email'      => $orderData['billing_email'],
      'phone'      => $orderData['billing_phone'],
      'address_1'  => $orderData['shipping_address_1'],
      'address_2'  => '', 
      'city'       => $orderData['billing_city'],
      'state'      => $orderData['billing_city'],
      'postcode'   => $orderData['billing_postcode'],
      'country'    => $orderData['shipping_country']
  );

  $order = wc_create_order();
  
  $price_incl_tax = 0;
  foreach( WC()->cart->get_cart() as $cart_item ){
    $product_id = $cart_item['product_id'];
    $quantity = $cart_item['quantity'];
    $order->add_product( get_product( $product_id ), $quantity );
    $price_incl_tax += wc_get_price_including_tax( $cart_item['data'] );  // price with VAT
  }

  $isShippingInclude = false;
  $priceForShipping = 0;
  if($totalPaid != $price_incl_tax){
      $isShippingInclude = true;
      $priceForShipping = ($totalPaid - $price_incl_tax);
  }

  $order->set_address( $address, 'billing' );
  $order->set_address( $address, 'shipping' );
  // $order->add_coupon('Fresher','10','2'); // accepted param $couponcode, $couponamount,$coupon_tax
  
  ## ------------- ADD SHIPPING FEE PROCESS START ---------------- ##

  // Get the customer country code
  $country_code = $order->get_shipping_country();

  // Set the array for tax calculations
  $calculate_tax_for = array(
      'country' => $country_code, 
      'state' => '', 
      'postcode' => '', 
      'city' => ''
  );

  if($isShippingInclude){
      $imported_total_fee = $priceForShipping;
      // Get a new instance of the WC_Order_Item_Fee Object
      $item_fee = new WC_Order_Item_Fee();

      $shippingTitle = 'Shipping Fee';
      if($price_incl_tax >= 200){
        $imported_total_fee = 0;
        $shippingTitle = 'Free Shipping';
      }

      $item_fee->set_name( $shippingTitle ); // Generic fee name
      $item_fee->set_amount( $imported_total_fee ); // Fee amount
      $item_fee->set_tax_class( '' ); // default for ''
      // $item_fee->set_tax_status( 'taxable' ); // or 'none'
      $item_fee->set_total( $imported_total_fee ); // Fee amount

      // Calculating Fee taxes
      $item_fee->calculate_taxes( $calculate_tax_for );

      // Add Fee item to the order
      $order->add_item( $item_fee );
  }
  ## ------------- ADD SHIPPING FEE PROCESS END ---------------- ##
  
      $order->update_status('pending');
  ## ------------- END ADD ORDER ---------------- ##

      $order->calculate_totals();


  $paymentRequest = new Payfort_Fort_Payment();
  $appleResData = $paymentRequest->setParamsForApplePay($orderData, $token, $totalPaid, $order->id);

  $sdkResponse = json_decode($appleResData, true);

  if (is_array($sdkResponse)) {
        
        // Set Payment method to order
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        $order->set_payment_method( $payment_gateways['payfort_fort_applepay'] );

     if ($sdkResponse['response_code'] == '14000' && $sdkResponse['status'] == '14') {

        // Empty cart
        WC()->cart->empty_cart();

        // Change order Status processing
        $order->update_status('processing');

     }else{

        // Change order Status
        $order->update_status('failed');        
     }
   }
   
  // Add redirect keys
  $jsondata = json_decode($appleResData,true);
  $jsondata['order_id'] = $order->id;
  $jsondata['order_key'] = $order->get_order_key();
  $appleResData = json_encode($jsondata);
  echo $appleResData;
  die();
}

function validate_merchant() {
   $response_body = file_get_contents('php://input'); 
   $data = json_decode($response_body, true);
  
   if(empty($data['url'])){
  		$data['url'] = $_POST['url'];
   }
   
   $paymentRequest = new Payfort_Fort_Payment();
   $paymentRequest->apwMerchantValidation($data['url']);
   die();
}

function add_to_order()
{
  parse_str(urldecode($_POST['orderData']),  $orderData);
  $totalPaid = $_POST['amount'];
  // $gateways = WC()->payment_gateways->payment_gateways();

  // $options = array();

  // foreach ( $gateways as $id => $gateway ) {
  //   $options[$id] = $gateway->get_method_title();
  // }

  // print_r($options);exit();

  $address = array(
      'first_name' => $orderData['billing_first_name'],
      'last_name'  => $orderData['billing_last_name'],
      'company'    => 'Safety Med',
      'email'      => $orderData['billing_email'],
      'phone'      => $orderData['billing_phone'],
      'address_1'  => $orderData['shipping_address_1'],
      'address_2'  => '', 
      'city'       => $orderData['billing_city'],
      'state'      => $orderData['billing_city'],
      'postcode'   => $orderData['billing_postcode'],
      'country'    => $orderData['shipping_country']
  );

  $order = wc_create_order();
  
  $price_incl_tax = 0;
  foreach( WC()->cart->get_cart() as $cart_item ){
    $product_id = $cart_item['product_id'];
    $quantity = $cart_item['quantity'];
    $order->add_product( get_product( $product_id ), $quantity ); //(get_product with id and next is for quantity)
    // $regular_price = $cart_item['data']->get_regular_price();
    // $price_excl_tax = wc_get_price_excluding_tax( $cart_item['data'] ); // price without VAT
    $price_incl_tax += wc_get_price_including_tax( $cart_item['data'] );  // price with VAT
    // $tax_amount     = $price_incl_tax - $price_excl_tax; // VAT amount
  }
// print_r($price_incl_tax);exit();
  $isShippingInclude = false;
  $priceForShipping = 0;
  
  if($totalPaid != $price_incl_tax){
      $isShippingInclude = true;
      $priceForShipping = ($totalPaid - $price_incl_tax);
  }

  $order->set_address( $address, 'billing' );
  $order->set_address( $address, 'shipping' );
  // $order->add_coupon('Fresher','10','2'); // accepted param $couponcode, $couponamount,$coupon_tax
  


  ## ------------- ADD SHIPPING FEE PROCESS START ---------------- ##

  // Get the customer country code
  $country_code = $order->get_shipping_country();

  // Set the array for tax calculations
  $calculate_tax_for = array(
      'country' => $country_code, 
      'state' => '', 
      'postcode' => '', 
      'city' => ''
  );

  if($isShippingInclude){
      $imported_total_fee = $priceForShipping;
      // Get a new instance of the WC_Order_Item_Fee Object
      $item_fee = new WC_Order_Item_Fee();

      $shippingTitle = 'Shipping Fee';
      if($price_incl_tax >= 200){
        $imported_total_fee = 0;
        $shippingTitle = 'Free Shipping';
      }

      $item_fee->set_name( $shippingTitle ); // Generic fee name
      $item_fee->set_amount( $imported_total_fee ); // Fee amount
      $item_fee->set_tax_class( '' ); // default for ''
      // $item_fee->set_tax_status( 'taxable' ); // or 'none'
      $item_fee->set_total( $imported_total_fee ); // Fee amount

      // Calculating Fee taxes
      $item_fee->calculate_taxes( $calculate_tax_for );

      // Add Fee item to the order
      $order->add_item( $item_fee );
  }
  ## ------------- ADD SHIPPING FEE PROCESS END ---------------- ##
  
  // Set payment gateway
  $payment_gateways = WC()->payment_gateways->payment_gateways();
  $order->set_payment_method( $payment_gateways['payfort_fort_applepay'] );

  // $order->update_status('on-hold');
  $order->update_status('pending');
  // $order->update_status( 'Completed', 'Order created by hassan testing - ', TRUE);



  $order->calculate_totals();
  WC()->cart->empty_cart();
echo $order->id;
  print_r($order->get_order_key());exit();
}

add_action( 'rest_api_init', 'register_rest_route_abcd');

function register_rest_route_abcd() {
    register_rest_route(
        'rest/v1', 'get-applepay-response',
        array(
            'methods' => 'POST,GET',
            'callback' => 'my_callback_function',
            'permission_callback' => '__return_true',
        )
    );
}

function my_callback_function($request){
    
    $body_params = $request->get_body_params();
    $log = new WC_Logger();
    $log_entry .= 'Exception Trace: ' . print_r( $body_params, true );

    $log->log( 'new-woocommerce-log-name', $log_entry );
    
    // print_r($request->get_url_params('data'));exit();
    // $body = $request->get_body();
    
    // $request = wp_safe_remote_get( $target_url, array('body' => $data) );
    // print_r(expression)    
    // Prepare response
    $response = array();
    $response['status'] = true;
    $response['message'] = 'done';
    
    return $response;
}