<?php

// don't load directly.
if (!defined('ABSPATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}
if (!MEC_Woocommerce_Base::check_plugins()) {
	return;
}

if (!class_exists('MEC_gateway_add_to_woocommerce_cart')) :
	/**
	 * MEC_gateway_add_to_woocommerce_cart.
	 *
	 * @author   Webnus Team
	 * @since    1.0.0
	 */
	class MEC_gateway_add_to_woocommerce_cart extends MEC_gateway
	{

		public $id = 1995;
		public $options;

		public function __construct()
		{
			parent::__construct();

			// Gateway options
			$this->options = $this->options();
		}

		public function label()
		{
			return __('Add to cart', 'mec-woocommerce');
		}

		public function color()
		{
			return '#9b5c8f';
		}

		public function options_form()
		{
?>
			<div class="mec-form-row">
				<label>
					<input type="hidden" name="mec[gateways][<?php echo $this->id(); ?>][status]" value="0" />
					<input onchange="jQuery('#mec_gateways<?php echo $this->id(); ?>_container_toggle').toggle();" value="1" type="checkbox" name="mec[gateways][<?php echo $this->id(); ?>][status]" <?php
																																																		if (isset($this->options['status']) and $this->options['status']) {
																																																			echo 'checked="checked"';
																																																		}
																																																		?> />
					<?php _e('Add to WooCommerce Cart', 'mec-woocommerce'); ?>
				</label>
			</div>
			<div id="mec_gateways<?php echo $this->id(); ?>_container_toggle" class="mec-gateway-options-form
				<?php
				if ((isset($this->options['status']) and !$this->options['status']) or !isset($this->options['status'])) {
					echo 'mec-util-hidden';
				}
				?>
				">
				<div class="mec-form-row">
					<label class="mec-col-7" for="mec_gateways<?php echo $this->id(); ?>_sync_woo_order_status">
						<input type="checkbox" id="mec_gateways<?php echo $this->id(); ?>_sync_woo_order_status" name="mec[gateways][<?php echo $this->id(); ?>][sync_order_status_for_booking]" <?php echo (isset($this->options['sync_order_status_for_booking']) and trim($this->options['sync_order_status_for_booking']) == 'on') ? 'checked="checked"' : ''; ?> />
						<?php _e('Sync MEC  Booking confimation Status with WooCommerce Order', 'mec-woocommerce'); ?>
					</label>
				</div>
				<div class="mec-form-row">
					<label class="mec-col-5" for="mec_gateways<?php echo $this->id(); ?>_use_mec_taxes">
						<input type="checkbox" id="mec_gateways<?php echo $this->id(); ?>_use_mec_taxes" name="mec[gateways][<?php echo $this->id(); ?>][use_mec_taxes]" <?php echo (isset($this->options['use_mec_taxes']) and trim($this->options['use_mec_taxes']) == 'on') ? 'checked="checked"' : ''; ?> />
						<?php _e('Adding MEC Ticket Taxes/Fees to Cart', 'mec-woocommerce'); ?>
						<span class="mec-tooltip">
							<div class="box">
								<h5 class="title"><?php _e('MEC Taxes/Fees', 'mec'); ?></h5>
								<div class="content">
									<p><?php esc_attr_e('Adding MEC taxes/fees to your WooCommerce cart', 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/mec-woocommerce-addon/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p>
								</div>
							</div>
							<i title="" class="dashicons-before dashicons-editor-help"></i>
						</span>
					</label>
				</div>
				<div class="mec-form-row">
					<label class="mec-col-5" for="mec_gateways<?php echo $this->id(); ?>_use_woo_taxes">
						<input type="checkbox" id="mec_gateways<?php echo $this->id(); ?>_use_woo_taxes" name="mec[gateways][<?php echo $this->id(); ?>][use_woo_taxes]" <?php echo (isset($this->options['use_woo_taxes']) and trim($this->options['use_woo_taxes']) == 'on') ? 'checked="checked"' : ''; ?> />
						<?php _e('Adding WooCommerce Standard Taxes in MEC Booking', 'mec-woocommerce'); ?>
						<span class="mec-tooltip">
							<div class="box">
								<h5 class="title"><?php _e('WooCommerce Standard Taxes', 'mec'); ?></h5>
								<div class="content">
									<p><?php esc_attr_e('Adding WooCommerce standard taxes to MEC booking items, not other things anymore', 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/mec-woocommerce-addon/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p>
								</div>
							</div>
							<i title="" class="dashicons-before dashicons-editor-help"></i>
						</span>
					</label>
				</div>
				<div class="mec-form-row">
					<label class="mec-col-3" for="mec_gateways<?php echo $this->id(); ?>_title"><?php _e('Title', 'mec-woocommerce'); ?></label>
					<div class="mec-col-4">
						<input type="text" id="mec_gateways<?php echo $this->id(); ?>_title" name="mec[gateways][<?php echo $this->id(); ?>][title]" value="<?php echo (isset($this->options['title']) and trim($this->options['title'])) ? $this->options['title'] : ''; ?>" placeholder="<?php echo $this->label(); ?>" />
					</div>
				</div>
				<div class="mec-form-row">
					<label class="mec-col-3" for="mec_gateways<?php echo $this->id(); ?>_comment"><?php _e('Comment', 'mec-woocommerce'); ?></label>
					<div class="mec-col-4">
						<textarea id="mec_gateways<?php echo $this->id(); ?>_comment" name="mec[gateways][<?php echo $this->id(); ?>][comment]" placeholder="<?php echo __('Add to Cart Gateway Description','mec-woocommerce'); ?>"><?php echo (isset($this->options['comment']) and trim($this->options['comment'])) ? stripslashes($this->options['comment']) : ''; ?></textarea>
						<span class="mec-tooltip">
							<div class="box">
								<h5 class="title"><?php _e('Comment', 'mec'); ?></h5>
								<div class="content">
									<p><?php esc_attr_e('HTML allowed.', 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/mec-woocommerce-addon/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p>
								</div>
							</div>
							<i title="" class="dashicons-before dashicons-editor-help"></i>
						</span>
					</div>
				</div>
			</div>
		<?php
		}

		public function checkout_form($transaction_id, $params = array())
		{
		?>
			<form id="mec_do_transaction_add_to_woocommerce_cart_form<?php echo $transaction_id; ?>" class="mec-click-pay">
				<input type="hidden" name="action" value="mec_do_transaction_add_to_woocommerce_cart" />
				<input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>" />
				<input type="hidden" name="gateway_id" value="<?php echo $this->id(); ?>" />
				<?php wp_nonce_field('mec_transaction_form_' . $transaction_id); ?>
				<?php MEC_Woocommerce_Controller::get_instance()->render_add_to_cart_button($transaction_id); ?>
				<?php do_action('mec_booking_checkout_form_before_end', $transaction_id); ?>
			</form>
			<div class="mec-gateway-message mec-util-hidden" id="mec_do_transaction_add_to_woocommerce_cart_message<?php echo $transaction_id; ?>"></div>
<?php
		}

		public function do_transaction($transaction_id = null)
		{
			if(!$transaction_id) {
				return;
			}

			$transaction = $this->book->get_transaction($transaction_id);
			$attendees   = isset($transaction['tickets']) ? $transaction['tickets'] : array();
			$attention_date = isset($transaction['date']) ? $transaction['date'] : '';
			$attention_times = explode(':', $attention_date);
			$date = date('Y-m-d H:i:s', trim($attention_times[0]));

			// Is there any attendee?
			if (!count($attendees)) {
				$this->response(
					array(
						'success' => 0,
						'code'    => 'NO_TICKET',
						'message' => __(
							'There is no attendee for booking!',
							'mec'
						),
					)
				);
			}

			$main_attendee = isset($attendees[0]) ? $attendees[0] : array();
			$name          = isset($main_attendee['name']) ? $main_attendee['name'] : '';
			$ticket_ids = '';
            $attendees_info = array();

            foreach ($attendees as $attendee) {
                $ticket_ids .= $attendee['id'] . ',';
                if (!array_key_exists($attendee['email'], $attendees_info)) $attendees_info[$attendee['email']] = array('count' => $attendee['count']);
                else $attendees_info[$attendee['email']]['count'] = ($attendees_info[$attendee['email']]['count'] + $attendee['count']);
            }

			// $ticket_ids = ',' . trim($ticket_ids, ', ') . ',';
			$user_id = $this->register_user($main_attendee);
			// $book_id      = $this->book->add(
			// 	array(
			// 		'post_author' => $user_id,
			// 		'post_type' => $this->PT,
			// 		'post_title' => $book_subject,
			// 		'post_date' => $date,
			// 		'attendees_info' => $attendees_info,
			// 		'mec_attendees' => $attendees
			// 	),
			// 	$transaction_id,
			// 	$ticket_ids
			// );
			$book_id      = $this->book->add(
				array(
					'post_author' => $user_id,
					'post_type' => 'mec-books',
					'post_title' =>  $name,
					'attendees_info' => $attendees_info,
					'post_date' => $date
				),
				$transaction_id,
				',' . $ticket_ids
			);
			if(!$book_id) {
				return;
			}
			update_post_meta($book_id, 'mec_attendees', $attendees);
			update_post_meta($book_id, 'mec_gateway', 'MEC_gateway_add_to_woocommerce_cart');
			update_post_meta($book_id, 'mec_gateway_label', $this->label());

			// Fires after completely creating a new booking
			do_action('mec_booking_completed', $book_id);

			return $book_id;
		}
	}

	add_filter(
		'MEC_register_gateways',
		function ($gateways) {
			$gateways['MEC_gateway_add_to_woocommerce_cart'] = new MEC_gateway_add_to_woocommerce_cart();
			return $gateways;
		}
	);

	add_action(
		'mec_feature_gateways_init',
		function () {
			new MEC_gateway_add_to_woocommerce_cart();
		}
	);

endif;
