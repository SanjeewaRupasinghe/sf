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

if (!class_exists('MEC_Woocommerce_Controller')) :
	/**
	 * MEC_Woocommerce_Controller.
	 *
	 * @author   author
	 * @package  package
	 * @since    1.0.0
	 */
	class MEC_Woocommerce_Controller extends MEC_Woocommerce_Base
	{

		/**
		 * Instance of this class.
		 *
		 * @since     1.0.0
		 * @access     private
		 * @var     MEC_Woocommerce_Controller
		 */
		private   static $instance;

		/**
		 * Global Variables
		 *
		 * @since     1.0.0
		 * @access     private
		 * @var     MEC_Woocommerce_Controller
		 */
		protected static $id = 0;
		protected static $pending_order = 0;
		protected static $checkout = [];
		protected static $mec_settings;
		protected static $do_action = true;
		protected static $term_id;

		/**
		 * The object is created from within the class itself
		 * only if the class has no instance.
		 *
		 * @since   1.0.0
		 * @return  MEC_Woocommerce_Autoloader
		 */
		public static function get_instance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Define the core functionality of the MEC_Woocommerce_Controller.
		 *
		 * Load the dependencies.
		 *
		 * @since     1.0.0
		 */
		function __construct()
		{
			$main = MEC::getInstance('app.libraries.main');
			static::$mec_settings = $main->get_settings();
			if (!isset(static::$mec_settings['datepicker_format'])) {
				static::$mec_settings['datepicker_format'] = 'yy-mm-dd&Y-m-d';
			}
			if (!defined('WP_POST_REVISIONS')) {
				define('WP_POST_REVISIONS', false);
			}
			$this->actions();
		}

		/**
		 * Add actions.
		 *
		 * @since   1.0.0
		 */
		public function actions()
		{
			add_action('wp_loaded', [$this, 'woocommerce_maybe_add_multiple_products_to_cart'], 15, 1);
			add_action('wp_loaded', [$this, 'process_add_to_cart']);
			add_action('wp_loaded', [$this, 'clean_database']);
			add_action('admin_enqueue_scripts', [$this, 'enqueue_scrips']);
			add_filter('woocommerce_is_purchasable', [$this, 'valid_mec_ticket_products_purchasable'], 20, 2);
			add_action( 'admin_notices', [$this, 'print_admin_notices'] );

			if (static::$do_action) {
				add_filter('the_title', [$this, 'woocommerce_title_correction'], -1, 1);
				add_filter('woocommerce_product_get_name', [$this, 'woocommerce_title_correction'], -1, 2);
				add_filter('woocommerce_product_title', [$this, 'woocommerce_title_correction'], -1, 2);
			}
			add_filter('wc_add_to_cart_message_html', [$this, 'woocommerce_message_correction'], -1, 1);
			add_action('woocommerce_product_query', [$this, 'hide_mec_booking_products'], 10, 1);
			add_action('woocommerce_after_single_product_summary', [$this, 'product_invisible']);
			if (static::$do_action) {
				add_action('woocommerce_remove_cart_item', [$this, 'update_transaction'], 10, 2);
				add_action('woocommerce_cart_item_restored', [$this, 'restore_ticket_into_booking'], 10, 2);
			}
			add_action('woocommerce_check_cart_items', [$this, 'update_transaction_data'], 10);
			add_action('init', [$this, 'mec_post_status']);
			add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
			add_action('admin_init', [$this, 'meta_box_init']);
			$main			  = \MEC::getInstance('app.libraries.main');
			$gateways_options = $main->get_gateways_options();
			if (!isset($gateways_options[1995])) {
				return;
			}

			$gateway_options = $gateways_options[1995];

			if (isset($gateway_options['sync_order_status_for_booking']) && $gateway_options['sync_order_status_for_booking'] && !static::$pending_order) {
				# Update MEC Bookings Status
				add_action('woocommerce_order_status_cancelled', [$this, 'cancel_order'], 10, 1);
				add_action('woocommerce_order_status_refunded', [$this, 'cancel_order'], 10, 1);

				add_action('woocommerce_order_status_pending', [$this, 'payment_complete'], 10, 1);
				add_action('woocommerce_order_status_completed', [$this, 'payment_complete'], 10, 1);
				add_action('woocommerce_order_status_completed_notification', [$this, 'payment_complete'], 1, 1);

				add_action('woocommerce_order_status_failed', [$this, 'pending_order'], 10, 1);
				add_action('woocommerce_order_status_on-hold', [$this, 'pending_order'], 10, 1);
				add_action('woocommerce_order_status_processing', [$this, 'pending_order'], 10, 1);

				# Update WOO Orders Status
				add_action('mec_booking_confirmed', [$this, 'mec_booking_confirmed'], 10, 1);
				add_action('mec_booking_pended', [$this, 'mec_booking_pended'], 10, 1);
				add_action('mec_booking_rejected', [$this, 'mec_booking_rejected'], 10, 1);
			}

			add_action('woocommerce_email_after_order_table', [$this, 'customize_order_table'], 10, 4);
			add_action('woocommerce_checkout_order_processed', [$this, 'capture_payment'], 10, 1);
			add_action('pre_get_terms', [$this, 'hide_mec_woo_cat'], 10, 1);
			// add_action('woocommerce_order_status_processing', [$this, 'capture_payment'], 10, 1);
			add_filter('woocommerce_quantity_input_args', [$this, 'quantityArgs'], 10, 2);
			add_filter('manage_edit-shop_order_columns', [$this, 'shop_orders_column_type'], 99, 1);
			add_action('manage_shop_order_posts_custom_column', [$this, 'woocommerce_column_type_in_shop_orders'], 99, 2);
			add_filter('manage_edit-shop_order_sortable_columns', [$this, 'shop_orders_column_type'], 99);
			add_action('woocommerce_order_details_after_order_table', [$this, 'order_details_after_order_table'], 10, 1);
			add_filter('woocommerce_product_categories_widget_args', [$this, 'hide_mec_category']);
			add_filter('mec_csv_export_columns', [$this, 'mec_booking_export_columns'], 10, 1);
			add_filter('mec_csv_export_booking', [$this, 'mec_booking_export_add_order_id'], 10, 2);
			add_filter('mec_excel_export_columns', [$this, 'mec_booking_export_columns'], 10, 1);
			add_filter('mec_excel_export_booking', [$this, 'mec_booking_export_add_order_id'], 10, 2);
			add_action('wp_trash_post', [$this, 'trash_sync']);
			add_action('wp_delete_post', [$this, 'delete_sync']);
			add_action('wp_enqueue_scripts', [$this, 'render_the_script'], 10000);
			add_action('mec_top_single_event', function () {
				woocommerce_output_all_notices();
			});

			add_action('woocommerce_before_order_itemmeta', function () {
				$rnd = md5(microtime() . random_int(0, 100));
				echo '<div id="randomID' . $rnd . '"></div>';
				echo '<script>
					jQuery("#randomID' . $rnd . '").parents("td").first().find(".wc-order-item-name").replaceWith(function () {
						return jQuery("<strong />").append(jQuery(this).contents());
					});
				</script>';
			});
		}

		/**
		 * Enqueue Scripts
		 *
		 * @since 1.0.0
		 */
		public function enqueue_scrips()
		{
			$order_id = get_post_meta(get_the_id(), 'mec_order_id', true);
			if (!$order_id) {
				return;
			}
			wp_enqueue_style('woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css', array(), WC_VERSION);
		}

		/**
		 * Print Admin Notices
		 *
		 * @since 1.0.0
		 */
		public function print_admin_notices()
		{
			if($message = get_option('mec_woo_print_admin_notices')) {
				delete_option('mec_woo_print_admin_notices');
				$class = 'notice notice-info';
				$message = html_entity_decode($message);
				printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
			}
		}

		/**
		 * Hide The mec_woo_cat
		 *
		 * @since 1.0.0
		 */
		public function hide_mec_woo_cat($terms_query)
		{
			$args = &$terms_query->query_vars;
			$args['exclude'] = [static::$term_id];
			$terms_query->meta_query->parse_query_vars( $args );
		}

		/**
		 * Restore Ticket Into Booking
		 *
		 * @since     1.0.0
		 */
		public function restore_ticket_into_booking($cart_item_key, $cart)
		{
			$product_id     = $cart->cart_contents[$cart_item_key]['product_id'];
			$transaction_id = get_post_meta($product_id, 'transaction_id', true);
			if (!$transaction_id) {
				return;
			}

			$transaction      = get_option($transaction_id, false);
			$mec_woo_get_meta = get_post_meta($product_id, 'MEC_Variation_Data', false);

			foreach ($mec_woo_get_meta as $key => $mec_woo_single_meta) {
				$mec_meta_array[] = json_decode($mec_woo_single_meta);
			}

			if (get_post_meta($product_id, 'mec_removed_fee', true)) {
				static::$do_action = false;
				$cart->restore_cart_item(get_post_meta($product_id, 'mec_removed_fee', true));
				static::$do_action = true;
			}

			foreach ($mec_meta_array as $mec_woo_meta) {
				$add = true;
				foreach ($transaction['price_details']['details'] as $key => $value) {
					if (strpos($value['description'], $mec_woo_meta->mec_woo_meta) !== false) {
						$add = false;
						break;
					}
				}
				if ($add) {
					$transaction['price_details']['details'][$key]['amount'] = ($mec_woo_meta->MEC_WOO_V_price * $mec_woo_meta->MEC_WOO_V_count);
				}
			}
			update_option($transaction_id, $transaction);
		}

		/**
		 * Clean The DataBase
		 *
		 * @since     1.0.0
		 */
		public function clean_database()
		{
			$args = array(
				'post_type'        => 'product',
				'post_status'      => 'mec_tickets',
				'order' => 'DESC',
				'date_query' => array(
					array(
						'before' => '6 days ago',
					),
				)
			);
			$products = get_posts($args);
			foreach ($products as $product) {
				if ($product->post_status  !== 'mec_tickets') {
					continue;
				}

				$paymentComplete = get_post_meta($product->ID, 'mec_payment_complete', true);
				if (!$paymentComplete) {
					wp_delete_post($product->ID, true);
				}
			}
		}

		/**
		 * Booking Confirmed
		 *
		 * @since     1.0.0
		 * @return void
		 */
		public function mec_booking_confirmed($book_id)
		{
			if (static::$pending_order) return;

			$main            	= \MEC::getInstance('app.libraries.main');
			$gateways_options = $main->get_gateways_options();
			$gateway_options = $gateways_options[1995];
			if (isset($gateway_options['sync_order_status_for_booking']) && $gateway_options['sync_order_status_for_booking']) {
				$order_id = get_post_meta($book_id, 'mec_order_id', true);
				if ($order_id) {
					$order        = new WC_Order($order_id);
					static::$pending_order = 1;
					$order->update_status('wc-completed');
					static::$pending_order = 0;
					update_option('mec_woo_print_admin_notices', __('The order status has been changed. Please manage order from this', 'mec-woocommerce') . ' <a href="' . get_edit_post_link( $order_id ) . '">' . __('link', 'mec-woocommerce') . '</a>' ) ;
				}
			}
			return;
		}

		/**
		 * Booking Processing
		 *
		 * @since     1.0.0
		 * @return void
		 */
		public function mec_booking_processing($book_id)
		{
			if (static::$pending_order) {
				return;
			}
			$main            	= \MEC::getInstance('app.libraries.main');
			$gateways_options = $main->get_gateways_options();
			$gateway_options = $gateways_options[1995];
			if (isset($gateway_options['sync_order_status_for_booking']) && $gateway_options['sync_order_status_for_booking']) {
				$order_id = get_post_meta($book_id, 'mec_order_id', true);
				if ($order_id) {
					$order        = new WC_Order($order_id);
					static::$pending_order = 1;
					if (isset($_POST['order_status']) && isset($_POST['post_ID']) && $_POST['post_ID'] == $order_id) {
						$order->update_status(esc_attr($_POST['order_status']));
					} else {
						$order->update_status('wc-processing');
					}
					static::$pending_order = 0;
					update_option('mec_woo_print_admin_notices', __('The order status has been changed. Please manage order from this', 'mec-woocommerce') . ' <a href="' . get_edit_post_link( $order_id ) . '">' . __('link', 'mec-woocommerce') . '</a>' ) ;
				}
			}
			return;
		}

		/**
		 * Booking Pended
		 *
		 * @since     1.0.0
		 */
		public function mec_booking_pended($book_id)
		{
			if (static::$pending_order) return;
			$main            	= \MEC::getInstance('app.libraries.main');
			$gateways_options = $main->get_gateways_options();
			$gateway_options = $gateways_options[1995];
			if (isset($gateway_options['sync_order_status_for_booking']) && $gateway_options['sync_order_status_for_booking']) {
				$order_id = get_post_meta($book_id, 'mec_order_id', true);
				if ($order_id) {
					$order        = new WC_Order($order_id);
					static::$pending_order = 1;
					$order->update_status('wc-on-hold');
					static::$pending_order = 0;
					update_option('mec_woo_print_admin_notices', __('The order status has been changed. Please manage order from this', 'mec-woocommerce') . ' <a href="' . get_edit_post_link( $order_id ) . '">' . __('link', 'mec-woocommerce') . '</a>' ) ;
				}
			}
		}

		/**
		 * Booking Rejected
		 *
		 * @since     1.0.0
		 */
		public function mec_booking_rejected($book_id)
		{
			if (static::$pending_order) return;
			$main            	= \MEC::getInstance('app.libraries.main');
			$gateways_options = $main->get_gateways_options();
			$gateway_options = $gateways_options[1995];
			if (isset($gateway_options['sync_order_status_for_booking']) && $gateway_options['sync_order_status_for_booking']) {
				$order_id = get_post_meta($book_id, 'mec_order_id', true);
				if ($order_id) {
					$order        = new WC_Order($order_id);
					static::$pending_order = 1;
					$order->update_status('wc-cancelled');
					static::$pending_order = 0;
					update_option('mec_woo_print_admin_notices', __('The order status has been changed. Please manage order from this', 'mec-woocommerce') . ' <a href="' . get_edit_post_link( $order_id ) . '">' . __('link', 'mec-woocommerce') . '</a>' ) ;
				}
			}
		}

		/**
		 * Trash Sync
		 *
		 * @since     1.0.0
		 */
		public function trash_sync($post_id)
		{
			$order_id = get_post_meta($post_id, 'mec_order_id', true);
			if ($order_id) {
				$this->move_to_trash($order_id);
			} else {
				$meta = get_posts(array(
					'post_type' => 'mec-books',
					'meta_key'   => 'mec_order_id',
					'meta_value' => $post_id,
				));
				if ($meta) {
					$book_id = $meta[0]->ID;
					$this->move_to_trash($book_id);
				}
			}
		}

		/**
		 * Trash Sync
		 *
		 * @since     1.0.0
		 */
		public function delete_sync($post_id)
		{
			$order_id = get_post_meta($post_id, 'mec_order_id', true);
			if ($order_id) {
				$this->delete_post($order_id);
			} else {
				$meta = get_posts(array(
					'post_type' => 'mec-books',
					'meta_key'   => 'mec_order_id',
					'meta_value' => $post_id,
				));
				if ($meta) {
					$book_id = $meta[0]->ID;
					$this->delete_post($book_id);
				}
			}
		}

		/**
		 * Move TO Trash
		 *
		 * @since     1.0.0
		 */
		private function move_to_trash($post_id)
		{
			$post = get_post($post_id);

			if (!$post) {
				return $post;
			}

			if ('trash' === $post->post_status) {
				return false;
			}

			$check = apply_filters('pre_trash_post', null, $post);
			if (null !== $check) {
				return $check;
			}

			add_post_meta($post_id, '_wp_trash_meta_status', $post->post_status);
			add_post_meta($post_id, '_wp_trash_meta_time', time());

			wp_update_post(
				array(
					'ID'          => $post_id,
					'post_status' => 'trash',
				)
			);
			wp_trash_post_comments($post_id);
		}

		/**
		 * Delete Post
		 *
		 * @since     1.0.0
		 */
		private function delete_post($postid, $force_delete = false)
		{
			global $wpdb;
			$post = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE ID = %d", $postid));
			if (!$post) {
				return $post;
			}
			$post = get_post($post);
			if (!$force_delete && ('post' === $post->post_type || 'page' === $post->post_type) && 'trash' !== get_post_status($postid) && EMPTY_TRASH_DAYS) {
				return wp_trash_post($postid);
			}
			if ('attachment' === $post->post_type) {
				return wp_delete_attachment($postid, $force_delete);
			}

			$check = apply_filters('pre_delete_post', null, $post, $force_delete);
			if (null !== $check) {
				return $check;
			}

			delete_post_meta($postid, '_wp_trash_meta_status');
			delete_post_meta($postid, '_wp_trash_meta_time');
			wp_delete_object_term_relationships($postid, get_object_taxonomies($post->post_type));
			$parent_data  = array('post_parent' => $post->post_parent);
			$parent_where = array('post_parent' => $postid);
			if (is_post_type_hierarchical($post->post_type)) {
				$children_query = $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = %d AND post_type = %s", $postid, $post->post_type);
				$children       = $wpdb->get_results($children_query);
				if ($children) {
					$wpdb->update($wpdb->posts, $parent_data, $parent_where + array('post_type' => $post->post_type));
				}
			}
			$revision_ids = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'revision'", $postid));
			foreach ($revision_ids as $revision_id) {
				wp_delete_post_revision($revision_id);
			}
			$wpdb->update($wpdb->posts, $parent_data, $parent_where + array('post_type' => 'attachment'));
			wp_defer_comment_counting(true);
			$comment_ids = $wpdb->get_col($wpdb->prepare("SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = %d", $postid));
			foreach ($comment_ids as $comment_id) {
				wp_delete_comment($comment_id, true);
			}
			wp_defer_comment_counting(false);
			$post_meta_ids = $wpdb->get_col($wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d ", $postid));
			foreach ($post_meta_ids as $mid) {
				delete_metadata_by_mid('post', $mid);
			}
			$result = $wpdb->delete($wpdb->posts, array('ID' => $postid));
			if (!$result) {
				return false;
			}
			clean_post_cache($post);
			if (is_post_type_hierarchical($post->post_type) && $children) {
				foreach ($children as $child) {
					clean_post_cache($child);
				}
			}
			wp_clear_scheduled_hook('publish_future_post', array($postid));
		}

		/**
		 * Customize Order Table
		 *
		 * @since     1.0.0
		 */
		public function customize_order_table($order, $sent_to_admin, $plain_text, $email)
		{
			// $this->capture_payment($order->get_id());
			$this->order_details_after_order_table_email_version($order);
		}

		/**
		 * MEC CSV Export Columns
		 *
		 * @since     1.0.0
		 */
		public function mec_booking_export_columns($columns)
		{
			$columns[] = esc_attr__('Woocommerce Order ID', 'mec-woocommerce');
			return $columns;
		}

		/**
		 * MEC CSV Export Columns
		 *
		 * @since     1.0.0
		 */
		public function mec_booking_export_add_order_id($booking, $post_id)
		{
			$order_id = get_post_meta($post_id, 'mec_order_id', true);
			if ($order_id) {
				$booking[] = $order_id;
			} else {
				$booking[] = '';
			}
			return $booking;
		}

		/**
		 * Enqueue Scripts
		 *
		 * @since     1.0.0
		 */
		public function enqueue_scripts()
		{
			$custom_css = 'span.mec-woo-cart-product-person-name {text-transform: capitalize;}span.mec-woo-cart-product-person-email {color: #8d8d8d;padding-left: 3px;font-size: 11px;}';
			wp_add_inline_style('mec-frontend-style', $custom_css);
		}

		/**
		 * Hide Mec Category
		 *
		 * @since     1.0.0
		 */
		public function hide_mec_category($args)
		{
			$term_id         = @get_term_by('name', 'MEC-Woo-Cat', 'product_cat')->term_id;
			$args['exclude'] = $term_id;
			return $args;
		}

		/**
		 * MEC Products Purchasable
		 *
		 * @since     1.0.0
		 */
		public static function valid_mec_ticket_products_purchasable($purchasable, $product)
		{
			if ($product->exists() && ('mec_tickets' === $product->get_status())) {
				$purchasable = true;
			}

			return $purchasable;
		}

		/**
		 * Meta Box Init
		 *
		 * @since     1.0.0
		 */
		public function meta_box_init()
		{
			if (isset($_GET['post']) && get_post_type($_GET['post']) == 'shop_order') {
				$order_type = get_post_meta($_GET['post'], 'mec_order_type', true);
				if (!empty($order_type) && $order_type == 'mec_ticket') {
					add_meta_box('mec_ticket_information', 'MEC Tickets', [$this, 'mec_ticket_meta_box'], 'shop_order', 'side');
				}
			}
		}

		/**
		 * MEC Ticket Meta Box
		 *
		 * @since     1.0.0
		 */
		public function mec_ticket_meta_box()
		{
			$order_id     = get_the_ID();
			$order        = new WC_Order($order_id);
			$transactions = [];
			foreach ($order->get_items() as $item_id => $order_item) {
				$product = $this->get_product($order_item['product_id'], true);
				if ($product) {
					$transaction_id                  = get_post_meta($product->ID, 'transaction_id', true);
					$transactions[$transaction_id] = $transaction_id;
				}
			}

		?>
			<div class="mec-attendees-meta-box">
				<?php
				$tt      = 0;
				$factory = \MEC::getInstance('app.libraries.factory');
				foreach ($transactions as $transaction_id) {
					$tt++;
					$transaction = get_option($transaction_id, false);
					$tickets     = get_post_meta($transaction['event_id'], 'mec_tickets', true);
				?>
					<div class="mec-transaction">
						<?php if ($tt > 1) : ?>
							<hr>
						<?php endif; ?>
						<a href="<?php echo get_edit_post_link(get_option($transaction_id . '_MEC_payment_complete')); ?>" class="mec-edit-booking"><?php echo esc_html__('Edit Booking', 'mec-woocommerce'); ?></a>
						<br>
						<span class="mec-attendee-name"><?php echo esc_html__('Event Name: ', 'mec-woocommerce'); ?><a href="<?php echo get_permalink($transaction['event_id']); ?>"><?php echo get_the_title($transaction['event_id']); ?></a></span>
						<br>
						<span class="mec-attendee-date"><?php echo esc_html__('Event Time: ', 'mec-woocommerce'); ?><?php
																														echo $this->get_date_label($transaction['date'], $transaction['event_id']);
																														?></span>
						<?php
						$location_id = get_post_meta($transaction['event_id'], 'mec_location_id', true);
						$location = get_term($location_id, 'mec_location');
						if (isset($location->name)) {
						?>
							<span class="mec-attendee-location"><?php echo esc_html__('Location: ', 'mec-woocommerce'); ?>: <?php echo $location->name; ?></span>
							<br>
						<?php
						}
						?>

					<?php
					$this->get_ticket_data($transaction_id, $order_id, $order_item['product_id'], $transaction['event_id']);

					echo '</div>';
				}
					?>
					</div>
					<?php

				}

				/**
				 * Display Order Details After Order Table
				 *
				 * @since     1.0.0
				 */
				public function get_ticket_data($transaction_id, $order_id, $product_id, $event_id)
				{
					$book_id = get_option($transaction_id . '_MEC_payment_complete');
					$main	= MEC::getInstance('app.libraries.main');
					$meta	= $main->get_post_meta($book_id);
					// The booking is not saved so we will skip this and show booking form instead.
					if (!$event_id) return false;

					$tickets = get_post_meta($event_id, 'mec_tickets', true);
					$attendees = isset($meta['mec_attendees']) ? $meta['mec_attendees'] : (isset($meta['mec_attendee']) ? array($meta['mec_attendee']) : array());
					$reg_fields = $main->get_reg_fields($event_id);

					# Attachments
					if (isset($attendees['attachments']) && !empty($attendees['attachments'])) {
						echo '<hr />';
						echo '<h3>' . _e('Attachments', 'mec-woocommerce') . '</h3>';
						foreach ($attendees['attachments'] as $attachment) {
							echo '<div class="mec-attendee">';
							if (!isset($attachment['error']) && $attachment['response'] === 'SUCCESS') {
								$a = getimagesize($attachment['url']);
								$image_type = $a[2];
								if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
									echo '<a href="' . $attachment['url'] . '" target="_blank">
								<img src="' . $attachment['url'] . '" alt="' . $attachment['filename'] . '" title="' . $attachment['filename'] . '" style="max-width:250px;float: left;margin: 5px;">
							</a>';
								} else {
									echo '<a href="' . $attachment['url'] . '" target="_blank">' . $attachment['filename'] . '</a>';
								}
							}

							echo '</div>';
						}
						echo '<div class="clear"></div>';
					}

					foreach ($attendees as $key => $attendee) {
						$reg_form = isset($attendee['reg']) ? $attendee['reg'] : array();
						if ($key === 'attachments') continue;
						if (isset($attendee[0]['MEC_TYPE_OF_DATA'])) continue;

						echo '<hr>';
						echo '<div class="mec-attendee">';
					?>
						<div class="mec-row">
							<strong><?php _e('Email', 'mec'); ?>: </strong>
							<span class="mec-attendee-email"><?php echo ((isset($attendee['email']) and trim($attendee['email'])) ? $attendee['email'] : '---'); ?></span>
						</div>
						<div class="mec-row">
							<strong><?php _e('Name', 'mec'); ?>: </strong>
							<span class="mec-attendee-name"><?php echo ((isset($attendee['name']) and trim($attendee['name'])) ? $attendee['name'] : '---'); ?></span>
						</div>
						<div class="mec-row">
							<strong><?php echo $main->m('ticket', __('Ticket', 'mec')); ?>: </strong>
							<span><?php echo ((isset($attendee['id']) and isset($tickets[$attendee['id']]['name'])) ? $tickets[$attendee['id']]['name'] : __('Unknown', 'mec')); ?></span>
						</div>
						<?php
						// Ticket Variations
						if (isset($attendee['variations']) and is_array($attendee['variations']) and count($attendee['variations'])) {
							$ticket_variations = $main->ticket_variations($event_id);
							foreach ($attendee['variations'] as $variation_id => $variation_count) {
								if (!$variation_count or ($variation_count and $variation_count < 0)) continue;

								$variation_title = (isset($ticket_variations[$variation_id]) and isset($ticket_variations[$variation_id]['title'])) ? $ticket_variations[$variation_id]['title'] : '';
								if (!trim($variation_title)) continue;

								echo '<div class="mec-row">
                            <span>+ ' . $variation_title . '</span>
                            <span>(' . $variation_count . ')</span>
                        </div>';
							}
						}
						?>
						<?php if (isset($reg_form) && !empty($reg_form)) : foreach ($reg_form as $field_id => $value) : $label = isset($reg_fields[$field_id]) ? $reg_fields[$field_id]['label'] : '';
								$type = isset($reg_fields[$field_id]) ? $reg_fields[$field_id]['type'] : ''; ?>
								<?php if ($type == 'agreement') : ?>
									<div class="mec-row">
										<strong><?php echo sprintf(__($label, 'mec'), '<a href="' . get_the_permalink($reg_fields[$field_id]['page']) . '">' . get_the_title($reg_fields[$field_id]['page']) . '</a>'); ?>: </strong>
										<span><?php echo ($value == '1' ? __('Yes', 'mec') : __('No', 'mec')); ?></span>
									</div>
								<?php else : ?>
									<div class="mec-row">
										<strong><?php _e($label, 'mec'); ?>: </strong>
										<span><?php echo (is_string($value) ? $value : (is_array($value) ? implode(', ', $value) : '---')); ?></span>
									</div>
								<?php endif; ?>
					<?php endforeach;
						endif;
						echo '</div>';
					}
				}

				/**
				 * Display Order Details After Order Table
				 *
				 * @since     1.0.0
				 */
				public function order_details_after_order_table($order)
				{
					$order_id   = $order->get_id();
					$order_type = get_post_meta($order_id, 'mec_order_type', true);
					if (empty($order_type) || $order_type != 'mec_ticket') {
						return;
					}
					$transactions = [];
					foreach ($order->get_items() as $item_id => $order_item) {
						$product = $this->get_product($order_item['product_id'], true);
						if ($product) {
							$transaction_id                  = get_post_meta($product->ID, 'transaction_id', true);
							$transactions[$transaction_id] = $transaction_id;
						}
					}

					?>
					<div>
						<h2><?php echo esc_html__('Attendees List', 'mec-woocommerce'); ?></h2>

						<table class="woocommerce-table shop_table order_details">
							<thead>
								<th><?php echo esc_html__('Attendees', 'mec-woocommerce'); ?></th>
								<th><?php echo esc_html__('Information', 'mec-woocommerce'); ?></th>
							</thead>

							<tbody>
								<?php
								foreach ($transactions as $transaction_id) {
									$transaction = get_option($transaction_id, false);

									foreach ($transaction['tickets'] as $ticket) {
										if (!isset($ticket['email'])) {
											continue;
										}

										if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '1') {
								?>
											<tr>
												<td>
													<span class="mec-attendee-name"><?php echo esc_html__('Name: ', 'mec-woocommerce'); ?><?php echo $ticket['name']; ?></span>
													<br>
													<span class="mec-attendee-email"><?php echo $ticket['email']; ?></span>
													<span class="mec-attendee-tickets-count"><?php echo '<strong> × ' . count($transaction['tickets']) . '</strong>'; ?></span>

												</td>
												<td>
													<span class="mec-attendee-name"><a href="<?php echo get_permalink($transaction['event_id']); ?>"><?php echo get_the_title($transaction['event_id']); ?></a></span>
													<br>
													<span class="mec-attendee-date"><?php echo $this->get_date_label($transaction['date'], $transaction['event_id']); ?></span>
												</td>
											</tr>
										<?php
											break;
										} else {
										?>
											<tr>
												<td>
													<span class="mec-attendee-name"><?php echo esc_html__('Name: ', 'mec-woocommerce'); ?><?php echo $ticket['name']; ?></span>
													<br>
													<span class="mec-attendee-email"><?php echo $ticket['email']; ?></span>
												</td>
												<td>
													<span class="mec-attendee-name"><a href="<?php echo get_permalink($transaction['event_id']); ?>"><?php echo get_the_title($transaction['event_id']); ?></a></span>
													<br>
													<span class="mec-attendee-date"><?php echo $this->get_date_label($transaction['date'], $transaction['event_id']); ?></span>
												</td>
											</tr>
								<?php
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
				<?php

				}

				/**
				 * Display Order Details After Order Table Email Version
				 *
				 * @since     1.0.0
				 */
				public function order_details_after_order_table_email_version($order)
				{
					$order_id   = $order->get_id();
					$order_type = get_post_meta($order_id, 'mec_order_type', true);
					$factory = \MEC::getInstance('app.libraries.factory');
					if (empty($order_type) || $order_type != 'mec_ticket') {
						return;
					}
					$transactions = [];
					foreach ($order->get_items() as $item_id => $order_item) {
						$product = $this->get_product($order_item['product_id'], true);
						if ($product) {
							$transaction_id                  = get_post_meta($product->ID, 'transaction_id', true);
							$transactions[$transaction_id] = $transaction_id;
						}
					}
				?>
					<div>
						<h2><?php echo esc_html__('Attendees List', 'mec-woocommerce'); ?></h2>

						<table class="woocommerce-table shop_table order_details" style="border:none;width:100%;">
							<thead style="border:soild 1px #ddd;">
								<th style="border:solid 1px #ddd;"><?php echo esc_html__('Attendees', 'mec-woocommerce'); ?></th>
								<th style="border:solid 1px #ddd;"><?php echo esc_html__('Information', 'mec-woocommerce'); ?></th>
							</thead>

							<tbody>
								<?php
								foreach ($transactions as $transaction_id) {
									$transaction = get_option($transaction_id, false);
									$event_id = $transaction['event_id'];
									$reg_fields = $factory->main->get_reg_fields($event_id);
									$transaction['tickets'] = isset($transaction['tickets']) ? $transaction['tickets'] : [];
									foreach ($transaction['tickets'] as $ticket) {
										if (!isset($ticket['email'])) {
											continue;
										}
										// $transaction['date'] = str_replace(':', ' - ', $transaction['date']);
										if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '1') { ?>
											<tr>
												<td style="border:solid 1px #ddd;padding:5px;">
													<span class="mec-attendee-name"><?php echo esc_html__('Name: ', 'mec-woocommerce'); ?><?php echo $ticket['name']; ?></span>
													<br>
													<span class="mec-attendee-email"><?php echo $ticket['email']; ?></span>
													<span class="mec-attendee-tickets-count"><?php echo '<strong> × ' . count($transaction['tickets']) . '</strong>'; ?></span>

												</td>
												<td style="border:solid 1px #ddd;padding:5px;">
													<span class="mec-attendee-name"><a href="<?php echo get_permalink($transaction['event_id']); ?>"><?php echo get_the_title($transaction['event_id']); ?></a></span>
													<br>
													<?php
													$main            	= \MEC::getInstance('app.libraries.main');
													?>
													<span class="mec-attendee-date"><?php echo $this->get_date_label($transaction['date'], $transaction['event_id']); ?></span>
													<?php
													$location_id = get_post_meta($event_id, 'mec_location_id', true);
													$location = get_term($location_id, 'mec_location');
													if (isset($location->name)) {
														echo '<div style="display:block;padding:1px;width:100%;">
									<strong>' . __('Location', 'mec-woocommerce') . ':</strong>
									<span>' . $location->name . '</span>
								</div>';
													}
													if (!isset($ticket['reg']) || !is_array($ticket['reg'])) {
														$ticket['reg'] = [];
													}
													?>
													<?php foreach ($ticket['reg'] as $k => $t) : ?>
														<div style="display:block;padding:1px;width:100%;">
															<?php if ($reg_fields[$k]['type'] == 'agreement') : ?>
																<strong><?php echo sprintf(__($reg_fields[$k]['label'], 'mec'), '<a href="' . get_the_permalink($reg_fields[$k]['page']) . '">' . get_the_title($reg_fields[$k]['page']) . '</a>'); ?>: </strong>
																<span><?php echo ($t == '1' ? __('Yes', 'mec') : __('No', 'mec')); ?></span>
															<?php else : ?>
																<strong><?php echo $reg_fields[$k]['label']; ?>:</strong>
																<span><?php echo (is_string($t) ? $t : (is_array($t) ? implode(', ', $t) : '---')); ?></span>
															<?php endif; ?>
														</div>
													<?php endforeach; ?>
												</td>
											</tr>
										<?php
											break;
										} else {
										?>
											<tr>
												<td style="border:solid 1px #ddd;padding:5px;">
													<span class="mec-attendee-name"><?php echo esc_html__('Name: ', 'mec-woocommerce'); ?><?php echo $ticket['name']; ?></span>
													<br>
													<span class="mec-attendee-email"><?php echo $ticket['email']; ?></span>
													<?php if (!isset($ticket['reg'])) $ticket['reg'] = []; ?>
													<?php foreach ($ticket['reg'] as $k => $t) : ?>
														<?php if (isset($reg_fields[$k])) : ?>
															<div style="display:block;padding:1px;width:100%;">
																<strong><?php echo $reg_fields[$k]['label']; ?>:</strong>
																<span><?php echo $t; ?></span>
															</div>
														<?php endif; ?>
													<?php endforeach; ?>
												</td>
												<td style="border:solid 1px #ddd;padding:5px;">
													<span class="mec-attendee-name"><a href="<?php echo get_permalink($transaction['event_id']); ?>"><?php echo get_the_title($transaction['event_id']); ?></a></span>
													<br>
													<span class="mec-attendee-date"><?php echo $this->get_date_label($transaction['date'], $transaction['event_id']); ?></span>
												</td>
											</tr>
								<?php
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<br />
		<?php

				}

				/**
				 * Column Order Type
				 *
				 * @since     1.0.0
				 */
				public function shop_orders_column_type($columns)
				{
					$columns['order_type'] = esc_html__('Type', 'mec-woocommerce');
					return $columns;
				}

				/**
				 * Woocommerce Column Type In Shop Orders
				 *
				 * @since     1.0.0
				 */
				public function woocommerce_column_type_in_shop_orders($column_name, $post_id)
				{
					if ($column_name == 'order_type') {
						if ($order_type = get_post_meta($post_id, 'mec_order_type', true)) {
							if ($order_type == 'mec_ticket') {
								echo esc_html__('MEC Ticket', 'mec-woocommerce');
								return;
							}
						}
						echo esc_html__('Shop Order', 'mec-woocommerce');
					}
					return;
				}

				/**
				 * Customize Product Quantity Arguments
				 *
				 * @since     1.0.0
				 */
				public static function quantityArgs($args, $product)
				{
					$transaction_id = get_post_meta($product->get_id(), 'transaction_id', true);
					$cantChangeQuantity = get_post_meta($product->get_id(), 'cantChangeQuantity', true);
					if ($transaction_id) {
						$transaction = get_option($transaction_id, false);
						if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '0' || $cantChangeQuantity) {
							$input_value       = $args['input_value'];
							$args['min_value'] = $args['max_value'] = 1;
						} else if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '1') {

							$input_value       = $args['input_value'];
							$args['min_value'] = $input_value;
							$args['max_value'] = strval($input_value);
							$args['step'] = 0;
						}
						$tickets = get_post_meta($transaction['event_id'], 'mec_tickets', true);
						$ticket_name = get_post_meta($product->get_id(), 'ticket_name', true);
						$book   = MEC::getInstance('app.libraries.book');
						$render   = MEC::getInstance('app.libraries.render');
						$dates = $render->dates($transaction['event_id'], NULL, 10);
						$occurrence_time = isset($dates[0]['start']['timestamp']) ? $dates[0]['start']['timestamp'] : strtotime($dates[0]['start']['date']);
						$availability = $book->get_tickets_availability($transaction['event_id'], $occurrence_time);
						foreach ($transaction['tickets'] as $ticket) {
							if ($ticket_name == $tickets[$ticket['id']]['name']) {
								$ticket_limit = isset($availability[$ticket['id']]) ? $availability[$ticket['id']] : -1;
								if ($ticket_limit !== -1) {
									$args['max_value'] = $ticket_limit;
								}
								break;
							}
						}
					}

					return $args;
				}

				/**
				 * update_transaction_data
				 *
				 * @since     1.0.0
				 */
				public function update_transaction_data()
				{
					$factory = \MEC::getInstance('app.libraries.factory');
					foreach (wc()->cart->get_cart() as $key => $item) {
						$product_id     = $item['product_id'];
						$transaction_id = get_post_meta($product_id, 'transaction_id', true);
						$event_id       = get_post_meta($product_id, 'event_id', true);

						$tickets     = get_post_meta($event_id, 'mec_tickets', true);
						$ticket_data = [];
						$_removed    = $removed = $_added = $added = 0;
						$__added     = $__removed = [];

						if ($transaction_id) {
							$transaction = get_option($transaction_id, false);
							if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '1' || $item['quantity'] == '0') {
								foreach ($transaction['tickets'] as $ticket) {
									if (isset($ticket['id'])) {
										if (isset($ticket_data[$tickets[$ticket['id']]['name']])) {
											$ticket_data[$tickets[$ticket['id']]['name']]++;
										} else {
											$ticket_data[$tickets[$ticket['id']]['name']] = 1;
										}
									}
								}

								if ($t_name = get_post_meta($product_id, 'ticket_name', true)) {
									$t_count = isset($ticket_data[$t_name]) ? $ticket_data[$t_name] : 1;
									if ($t_count != $item['quantity']) {
										if ($t_count > $item['quantity']) {
											$_removed = $removed = $t_count - $item['quantity'];
										} else {
											$_added = $added = $item['quantity'] - $t_count;
										}
										$ticket_variations = $factory->main->ticket_variations($transaction['event_id']);
										foreach ($transaction['tickets'] as $t_key => $ticket) {
											if ($tickets[$ticket['id']]['name'] == $t_name) {

												if ($removed) {
													unset($transaction['tickets'][$t_key]);
													$removed     = $removed - 1;
													$__removed[] = $tickets[$ticket['id']]['price'];
													foreach ($ticket['variations'] as $tk => $v) {
														$__removed[] = $ticket_variations[$tk]['price'] * $v;
													}
												}

												if ($added) {
													$transaction['tickets'][] = $ticket;
													$added                    = $added - 1;
													$__added[]                = $tickets[$ticket['id']]['price'];
													foreach ($ticket['variations'] as $tk => $v) {
														$__added[] = $ticket_variations[$tk]['price'] * $v;
													}
												}
											}
										}
									}
								}

								if ($_added || $_removed) {

									foreach ($__added as $price) {
										$transaction['total'] = $transaction['total'] + $price;
										$transaction['price'] = $transaction['price'] + $price;
										$transaction['price_details']['total'] = $transaction['price_details']['total'] + $price;
									}

									foreach ($__removed as $price) {
										$transaction['total'] = $transaction['total'] - $price;
										$transaction['price'] = $transaction['price'] - $price;
										$transaction['price_details']['total'] = $transaction['price_details']['total'] - $price;
									}
									update_option($transaction_id, $transaction);
								}
							}
						}
					}
				}

				/**
				 * update_transaction
				 *
				 * @since     1.0.0
				 */
				public function update_transaction($cart_item_key, $cart)
				{
					$product_id     = $cart->cart_contents[$cart_item_key]['product_id'];
					$transaction_id = get_post_meta($product_id, 'transaction_id', true);
					$cantChangeQuantity = get_post_meta($product_id, 'cantChangeQuantity', true);
					if (isset($_REQUEST['remove_item'])) {
						$requested_product_id     = $cart->cart_contents[$_REQUEST['remove_item']]['product_id'];
						$amount_per_booking = get_post_meta($requested_product_id, 'm_product_type', true) == 'amount_per_booking';
						if ($amount_per_booking) {
							die();
						}
					}
					$die = false;
					if ($cantChangeQuantity) {
						foreach ($cart->cart_contents as $_cart) {
							$cantChangeQuantity = get_post_meta($_cart['data']->get_ID(), 'cantChangeQuantity', true);
							if ($_cart['data']->get_ID() != $product_id && $_cart['data']->get_status() == 'mec_tickets' && !$cantChangeQuantity) {
								$die = true;
								break;
							}
						}
						$x = 0;
						foreach ($cart->cart_contents as $_cart) {
							$cantChangeQuantity = get_post_meta($_cart['data']->get_ID(), 'cantChangeQuantity', true);
							if (get_post_meta($_cart['data']->get_ID(), 'm_product_type', true) != 'amount_per_booking' && $transaction_id == get_post_meta($_cart['data']->get_ID(), 'transaction_id', true)) {
								$x++;
							}
						}
						if ($x < 2) {
							foreach ($cart->cart_contents as $_cart) {
								$cantChangeQuantity = get_post_meta($_cart['data']->get_ID(), 'cantChangeQuantity', true);
								if (get_post_meta($_cart['data']->get_ID(), 'm_product_type', true) == 'amount_per_booking' && $product_id != $_cart['data']->get_ID() && $transaction_id == get_post_meta($_cart['data']->get_ID(), 'transaction_id', true)) {
									static::$do_action = false;
									update_post_meta($product_id, 'mec_removed_fee', $_cart['key']);
									$cart->remove_cart_item($_cart['key']);
									static::$do_action = true;
								}
							}
						} else if ($die) {
							die();
						}
					} else {
						$x = 0;
						foreach ($cart->cart_contents as $_cart) {
							$cantChangeQuantity = get_post_meta($_cart['data']->get_ID(), 'cantChangeQuantity', true);
							if (get_post_meta($_cart['data']->get_ID(), 'm_product_type', true) != 'amount_per_booking' && $transaction_id == get_post_meta($_cart['data']->get_ID(), 'transaction_id', true)) {
								$x++;
							}
						}
						if ($x < 2) {
							foreach ($cart->cart_contents as $_cart) {
								$cantChangeQuantity = get_post_meta($_cart['data']->get_ID(), 'cantChangeQuantity', true);
								if (get_post_meta($_cart['data']->get_ID(), 'm_product_type', true) == 'amount_per_booking' && $product_id != $_cart['data']->get_ID() && $transaction_id == get_post_meta($_cart['data']->get_ID(), 'transaction_id', true)) {
									static::$do_action = false;
									update_post_meta($product_id, 'mec_removed_fee', $_cart['key']);
									$cart->remove_cart_item($_cart['key']);
									static::$do_action = true;
								}
							}
						}
					}

					$transaction_id = get_post_meta($product_id, 'transaction_id', true);
					if ($transaction_id) {
						$transaction      = get_option($transaction_id, false);
						$mec_woo_get_meta = get_post_meta($product_id, 'MEC_Variation_Data', false);
						$mec_meta_array = [];
						foreach ($mec_woo_get_meta as $key => $mec_woo_single_meta) {
							$mec_meta_array[] = json_decode($mec_woo_single_meta);
						}
						foreach ($mec_meta_array as $mec_woo_meta) {
							foreach ($transaction['price_details']['details'] as $key => $value) {
								if (strpos($value['description'], $mec_woo_meta->mec_woo_meta) !== false) {
									$value['amount'] = $value['amount'] - ($mec_woo_meta->MEC_WOO_V_price * $mec_woo_meta->MEC_WOO_V_count);
									$transaction['price_details']['details'][$key]['amount'] = $value['amount'];
									update_option($transaction_id, $transaction);
								}
							}
						}
						$mec_ticket = get_post_meta($product_id, 'mec_ticket', true);
						foreach ($transaction['tickets'] as $key => $ticket) {
							if ($ticket['id'] == $mec_ticket['id']) {
								$transaction['total'] = $transaction['total'] - ($mec_ticket['price'] * $mec_ticket['count']);
								$transaction['price_details']['total'] = $transaction['price_details']['total'] - ($mec_ticket['price'] * $mec_ticket['count']);
								$transaction['price_details']['details'][0]['amount'] = $transaction['price_details']['details'][0]['amount'] - ($mec_ticket['price'] * $mec_ticket['count']);
								$transaction['price'] = $transaction['price'] - ($mec_ticket['price'] * $mec_ticket['count']);
								unset($transaction['tickets'][$key]);
							}
						}
						update_option($transaction_id, $transaction);
					}
				}

				/**
				 * Woocommerce Capture Payment
				 *
				 * @since     1.0.0
				 */
				public function capture_payment($order_id)
				{
					// Don't Capture Processed Order
					if (get_post_meta($order_id, 'mw_capture_completed', true)) {
						return;
					}

					// Set Variables
					$order  = new WC_Order($order_id);
					// $discount = $order->get_total_discount(); # Order Discount
					$tax = $order->get_tax_totals(); # Order Tax
					$main = \MEC::getInstance('app.libraries.main'); # Instance of MEC Main Class
					$gateways_options = $main->get_gateways_options(); # Get Gateways Options
					$gateway_options = $gateways_options[1995]; # Get Add to Cart Payment Options

					// Process Order Items
					foreach ($order->get_items() as $item_id => $order_item) {

						$product = $this->get_product($order_item['product_id'], true); # Get Product
						// Check The Product is Processed
						if ($product && !get_post_meta($product->ID, 'mec_payment_complete', true)) {
							$transaction_id = get_post_meta($product->ID, 'transaction_id', true);
							// Don't Process Shop Products
							if(!$transaction_id) {
								continue;
							}

							// Don't Process Processed Transaction
							if (get_option($transaction_id . '_MEC_payment_complete', false)) {
								continue;
							}

							// If Tax Used in Order
							if ($tax) {
								// Get Transaction from Options by Using transaction_id
								$transaction = get_option($transaction_id);
								// If The WooCommerce Tax was not Applied in Transaction and the "use woocommerce taxes" is Enable in Gateway Options
								if (!isset($transaction['WCTax']) && isset($gateway_options['use_woo_taxes']) && $gateway_options['use_woo_taxes']) {
									$gateway_options['use_mec_taxes'] = isset($gateway_options['use_mec_taxes']) ? $gateway_options['use_mec_taxes'] : false;
									$transaction['WCTax'] = true;
									$removed_taxes = 0;
									if( !$gateway_options['use_mec_taxes'] ) {
										// Remove Standard Fees from Transaction
									   foreach ($transaction['price_details']['details'] as $key => $dt) {
										   if ($dt['type'] == 'fee') {
											   $removed_taxes += $transaction['price_details']['details'][$key]['amount'];
											   unset($transaction['price_details']['details'][$key]);
										   }
									   }
									}

									// Process WooCommerce Taxes
									$transaction['price_details']['total'] = $transaction['price_details']['total'] - $removed_taxes;
									$booking_price = $transaction['price_details']['total'];
									foreach ($order->get_tax_totals() as $key => $tax) {
										$tax_value = \WC_Tax::get_rate_percent_value($tax->rate_id);
										$amount = ($booking_price * $tax_value) / 100;
										$transaction['price_details']['total'] += $amount;
										$transaction['price_details']['details'][] = [
											'amount' => $amount,
											'description' => 'WooCommerce ' . $tax->label,
											'type' => 'fee'
										];
									}

									// Update Transaction Prices
									$transaction['total'] = $transaction['price'] = $transaction['price_details']['total'];
									update_option($transaction_id, $transaction);
								}
							} else {
								if (!isset($gateway_options['use_mec_taxes'])) {
									$transaction = get_option($transaction_id);
									$removed_taxes = 0;
									// Remove Standard Fees from Transaction
									foreach ($transaction['price_details']['details'] as $key => $dt) {
										if ($dt['type'] == 'fee' && isset($dt['fee_type']) && $dt['fee_type'] != 'amount_per_booking' ) {
											$removed_taxes += $transaction['price_details']['details'][$key]['amount'];
											unset($transaction['price_details']['details'][$key]);
										}
									}
									// Update Transaction Prices
									$transaction['price_details']['total'] = $transaction['price_details']['total'] - $removed_taxes;
									$transaction['total'] = $transaction['price'] = $transaction['price_details']['total'];
									update_option($transaction_id, $transaction);
								}
							}

							$gateway = new MEC_gateway_add_to_woocommerce_cart();
							if (!get_post_meta($product->ID, 'mec_payment_complete', true) && !get_post_meta($product->ID, 'transaction_created', true)) {
								$book_id = $gateway->do_transaction($transaction_id);
								update_post_meta($product->ID, 'transaction_created', '1');
							}

							$transaction = get_option($transaction_id);
							$user_id = get_post_field('post_author', $book_id);
							$attendees = isset($transaction['tickets']) ? $transaction['tickets'] : array();
							$main_attendee = current($attendees);
							$name = isset($main_attendee['name']) ? $main_attendee['name'] : get_userdata($user_id)->display_name;
							$book_subject = $name . ' - ' . get_userdata($user_id)->user_email;
							wp_update_post([
								'ID' => $book_id,
								'post_title' => $book_subject,
							]);

							update_post_meta($book_id, 'mec_order_id', $order_id);
							update_post_meta($product->ID, 'mec_payment_complete', $book_id);
							update_post_meta($order_id, 'mec_order_type', 'mec_ticket');
							update_option($transaction_id . '_MEC_payment_complete', $book_id);
						}
					}
					// Capture Order as Completed
					update_post_meta($order_id, 'mw_capture_completed', true);
				}

				/**
				 * Woocommerce Payment complete
				 *
				 * @since     1.0.0
				 */
				public function payment_complete($order_id)
				{
					if (static::$pending_order) {
						return;
					}
					$order  = new WC_Order($order_id);
					$book   = MEC::getInstance('app.libraries.book');

					foreach ($order->get_items() as $item_id => $order_item) {
						$product = $this->get_product($order_item['product_id'], true);
						if ($product) {
							$book_id        = get_post_meta($product->ID, 'mec_payment_complete', true);
							static::$pending_order = 1;
							$book->confirm($book_id);
							static::$pending_order = 0;
						}
					}
				}

				/**
				 * Cancel Order
				 *
				 * @since     1.0.0
				 */
				public function cancel_order($order_id)
				{
					if (static::$pending_order) {
						return;
					}
					$order  = new WC_Order($order_id);
					$book   = MEC::getInstance('app.libraries.book');

					foreach ($order->get_items() as $item_id => $order_item) {
						$product = $this->get_product($order_item['product_id'], true);
						if ($product) {
							$book_id        = get_post_meta($product->ID, 'mec_payment_complete', true);
							static::$pending_order = 1;
							$book->reject($book_id);
							static::$pending_order = 0;
						}
					}
				}

				/**
				 * Woocommerce Title Correction
				 *
				 * @since     1.0.0
				 */
				public function woocommerce_title_correction($title, $product = false)
				{
					if (!static::$do_action) {
						return $title;
					}

					$nohtml = false;
					if (!empty($product)) {
						$id = $product->get_id();
					} else {
						$id = $this->get_product($title);
						$product  = new WC_Product($id);
						$nohtml = true;
					}

					if ($product->get_status() != 'mec_tickets') {
						return $title;
					}

					if (!empty($product) && $id = $product->get_id()) {
						$title      = preg_replace('/Modern Event Calendar Ticket [(](.*?)[)](.*)/i', '$1', $title);

						static::$do_action = false;
						$title .=   '<br />' . '<span class="mec-woo-cart-product-name"><a href="' . get_permalink(get_post_meta($id, 'event_id', true)) . '">' . get_the_title(get_post_meta($id, 'event_id', true)) . '</a><span>';
						static::$do_action = true;
						$pInfo = get_post_meta($id, 'mec_ticket', true);
						if ($pInfo && isset($pInfo['_name'])) {
							$title   .=   '<br />' . '<span class="mec-woo-cart-product-person-name">' . $pInfo['_name'] . '</span><span class="mec-woo-cart-product-person-email">(' . $pInfo['email'] . ')</span>';
						}

						$variations = get_post_meta($id, 'MEC_Variation_Data');
						if ($variations) {
							$v = [];
							foreach ($variations as $variation) {
								if (!is_array($variation) && !is_object($variation)) {
									$variation = json_decode($variation, true);
								}
								if ($variation['MEC_WOO_V_count']) {
									$v[] = $variation['MEC_WOO_V_title'] . '(' . $variation['MEC_WOO_V_count'] . ')';
								}
							}

							if ($v) {
								$v      = implode(' - ', $v);
								$title .= '<br />' . $v;
							}
						}

						if ($date = get_post_meta($id, 'mec_date', true)) {
							$event_id = get_post_meta($product->get_id(), 'event_id', true);
							static::$do_action = false;
							$event_date = $this->get_date_label($date, $event_id);
							static::$do_action = true;
							$title .= '<br />' . '<span class="mec-woo-cart-booking-date">' . $event_date . '<span>';
						}
					}
					if ($nohtml) {
						$title = str_replace('<br />', "\n", $title);
						$title  = strip_tags($title);
					}
					return $title;
				}

				/**
				 * Get Event Date Label
				 *
				 * @since     1.0.0
				 */
				public function get_date_label($date, $event_id)
				{
					$date_format = 'Y-m-d';
					$time_format = get_option('time_format');
					$event_date = isset($date) ? explode(':', $date) : array();
					$event_start_time = $event_end_time = $new_event_start_time = $new_event_end_time = '';
					if (is_numeric($event_date[0]) and is_numeric($event_date[1])) {
						$start_datetime = date($date_format . ' ' . $time_format, $event_date[0]);
						$end_datetime = date($date_format . ' ' . $time_format, $event_date[1]);
					} else {
						$start_datetime = $event_date[0];
						$end_datetime = $event_date[1];
					}
					if (isset($start_datetime) and !empty($start_datetime)) {
						$new_event_start_time = explode(' ', $start_datetime);
					}
					if (isset($end_datetime) and !empty($end_datetime)) {
						$new_event_end_time = explode(' ', $end_datetime);
					}

					if (isset($new_event_start_time[1]) and !empty($new_event_start_time[1]) and isset($new_event_start_time[2]) and !empty($new_event_start_time[2]))  $event_start_time = $new_event_start_time[1] . ' ' . $new_event_start_time[2];


					if (isset($new_event_end_time[1]) and !empty($new_event_end_time[1]) and isset($new_event_end_time[2]) and !empty($new_event_end_time[2])) $event_end_time = $new_event_end_time[1] . ' ' . $new_event_end_time[2];

					if (isset($new_event_start_time[0]) and !empty($new_event_start_time[0]))  $event_start_date = $new_event_start_time[0];
					if (isset($new_event_end_time[0]) and !empty($new_event_end_time[0]))  $event_end_date = $new_event_end_time[0];
					$event = get_post($event_id);
					$render = \MEC::getInstance('app.libraries.render');
					$event->data = $render->data($event_id);
					$allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
					if ($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])) :
						$new_event_date = ($event_end_date == $event_start_date) ? $event_start_date : $event_start_date . ' ' . $event_start_time . ' - ' . $event_end_date . ' ' . $event_end_time;
					else :
						$new_event_date = ($event_end_date == $event_start_date) ? $event_start_date : $event_start_date . ' - ' . $event_end_date;
					endif;

					return $new_event_date;
				}

				/**
				 * Register MEC Tickets post status
				 *
				 * @since     1.0.0
				 */
				public function mec_post_status()
				{
					register_post_status(
						'MEC_Tickets',
						array(
							'label'                     => _x('MEC Tickets', 'mec-woocommerce'),
							'public'                    => true,
							'exclude_from_search'       => true,
							'show_in_admin_all_list'    => false,
							'show_in_admin_status_list' => false,
							'label_count'               => _n_noop('MEC Tickets <span class="count">(%s)</span>', 'MEC Tickets <span class="count">(%s)</span>'),
						)
					);
				}

				/**
				 * Pending Order
				 *
				 * @since     1.0.0
				 */
				public function pending_order($order_id)
				{
					$order  = new WC_Order($order_id);
					$book   = MEC::getInstance('app.libraries.book');
					foreach ($order->get_items() as $item_id => $order_item) {
						$product = $this->get_product($order_item['product_id'], true);
						if ($product) {
							$book_id        = get_post_meta($product->ID, 'mec_payment_complete', true);
							static::$pending_order = 1;
							$book->pending($book_id);
							static::$pending_order = 0;
						}
					}
				}

				/**
				 * Mec Product Invisible
				 *
				 * @since     1.0.0
				 */
				public function product_invisible()
				{
					remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
				}

				/**
				 * Hide MEC booking products
				 *
				 * @since     1.0.0
				 */
				public function hide_mec_booking_products($q)
				{
					if (is_single() || is_shop() || is_page('shop')) { // set conditions here
						$tax_query = (array) $q->get('tax_query');

						$tax_query[] = array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => array('MEC-Woo-Cat'), // set product categories here
							'operator' => 'NOT IN',
						);

						$q->set('tax_query', $tax_query);
					}
				}

				/**
				 * Woocommerce Message Correction
				 *
				 * @since     1.0.0
				 */
				public function woocommerce_message_correction($message)
				{
					if (preg_match('/&ldquo;Modern Event Calendar Ticket [(](.*?)[)](.*)&rdquo;/i', $message)) {
						$message = preg_replace('/&ldquo;Modern Event Calendar Ticket [(](.*?)[)](.*)&rdquo;/i', '&ldquo;$1&rdquo;', $message);
					}

					if (preg_match('/&ldquo;Modern Event Calendar Ticket Variation [(](.*?)[)](.*)&rdquo;/i', $message)) {
						$message = preg_replace('/&ldquo;Modern Event Calendar Ticket Variation [(](.*?)[)](.*)&rdquo;/i', '&ldquo;$1&rdquo;', $message);
					}

					return $message;
				}

				/**
				 * Render Add To Cart Button
				 *
				 * @since     1.0.0
				 */
				public function render_add_to_cart_button($transaction_id)
				{
					$redirect = WC_Admin_Settings::get_option('woocommerce_cart_redirect_after_add', false);
					$nonce = wp_create_nonce('mec-woocommerce-process-add-to-cart');
					$add_to_cart_url = get_site_url() . '?transaction-id=' . $transaction_id . '&action=mec-woocommerce-process-add-to-cart&nonce=' . $nonce;
					$RedirectURL = apply_filters('mec_woocommerce_after_add_to_cart_url', wc_get_cart_url());
					if ($redirect != 'yes') {
						echo '<a href="' . $add_to_cart_url . '" id="mec_woo_add_to_cart_btn_r" data-cart-url="' . $RedirectURL . '" class="button mec-add-to-cart-btn-r" aria-label="Please Wait" rel="nofollow">' . esc_html__('Add to cart', 'mec-woocommerce') . '</a>';
					} else {
						echo '<a href="' . $add_to_cart_url . '" id="mec_woo_add_to_cart_btn" data-cart-url="' . $RedirectURL . '" class="button mec-add-to-cart-btn" aria-label="Please Wait" rel="nofollow">' . esc_html__('Add to cart', 'mec-woocommerce') . '</a>';
					}
				}

				/**
				 * Process Add to Cart
				 *
				 * @since     1.0.0
				 */
				public function process_add_to_cart()
				{

					if (isset($_REQUEST['action']) && $_REQUEST['action'] != 'mec-woocommerce-process-add-to-cart') {
						return false;
					} else if (!isset($_REQUEST['action'])) {
						return false;
					}
					if (!wp_verify_nonce($_REQUEST['nonce'], 'mec-woocommerce-process-add-to-cart')) {
						return false;
					}

					if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
						$transaction_id 	= isset($_REQUEST['transaction-id']) ? $_REQUEST['transaction-id'] : '';
						if (!$transaction_id) {
							return false;
						}
					} else {
						return false;
					}
					$transaction    	= get_option($transaction_id, false);
					$tickets        	= get_post_meta($transaction['event_id'], 'mec_tickets', true);
					$product_ids    	= [];
					$factory            = \MEC::getInstance('app.libraries.factory');
					$main            	= \MEC::getInstance('app.libraries.main');
					$settings 			= static::$mec_settings;
					$gateways_options = $main->get_gateways_options();
					$gateway_options = $gateways_options[1995];


					if (isset($gateway_options['use_mec_taxes']) && $gateway_options['use_mec_taxes']) {
						if (get_post_meta($transaction['event_id'], 'mec_fees_global_inheritance', true)) {
							$fees = isset($settings['fees']) && isset($settings['taxes_fees_status']) && $settings['taxes_fees_status'] ? $settings['fees'] : array();
						} else {
							$fees = get_post_meta($transaction['event_id'], 'mec_fees', true);
						}
					} else {
						$fees = [];
					}

					$ticket_variations  = $factory->main->ticket_variations($transaction['event_id']);
					$event_data         = [
						'event_id'   => $transaction['event_id'],
						'event_name' => get_the_title($transaction['event_id']),
					];
					if (isset($transaction['coupon']) && $transaction['coupon']) {
						$term = get_term_by('name', $transaction['coupon'], 'mec_coupon');
						$coupon_id = isset($term->term_id) ? $term->term_id : 0;
						// Coupon is not exists
						if ($coupon_id) {
							$discount_type = get_term_meta($coupon_id, 'discount_type', true);
							$discount = get_term_meta($coupon_id, 'discount', true);
						}
					}

					$last_ticket_name   = '';
					$last_product_id    = '';
					$count              = 0;
					$tickets_count      = 0;
					$current_ticket_id  = 0;
					$variation_added    = [];
					$product_ids_object = [];
					$ticket_ids = [];
					foreach ($transaction['tickets'] as $_ticket) {
						if (isset($_ticket['id'])) {
							$tickets_count++;
						}
					}

					foreach ($transaction['tickets'] as $_ticket) {
						$current_ticket_id++;
						if (isset($_ticket['id'])) {
							$t = $tickets[$_ticket['id']];
							if (isset($t['dates']) && !empty($t['dates'])) {
								$today = strtotime(date('Y-m-d', time()));
								foreach ($t['dates'] as $date) {
									if ($today >= strtotime($date['start']) && $today <= strtotime($date['end'])) {
										$t['price'] = $date['price'];
									}
								}
							}

							$_ticket['_name'] = $_ticket['name'];
							if ($t) {
								$_ticket['name']  = $t['name'];
								$_ticket['price'] = $t['price'];
							}

							if (!$_ticket['price']) {
								$_ticket['price'] = 0;
							}

							if (isset($transaction['date'])) {
								$event_data['date'] = $transaction['date'];
							}

							// $title = 'Modern Event Calendar Ticket (' . $_ticket['name'] . ') - ' . $transaction_id . '.' . time();
							if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '1') {
								if (!$last_product_id) {
									$product_id       = $last_product_id = $this->create_product($_ticket, $transaction_id, $event_data);
									$ticket_ids[] = $product_id;
									$last_ticket_name = $_ticket['id'];
								}

								if ($last_ticket_name == $_ticket['id']) {
									$count++;
									if (!isset($product_ids_object[$last_product_id])) {
										$product_ids_object[$last_product_id] = 0;
									}
									$product_ids_object[$last_product_id]++;
								} else {
									$product_id       = $last_product_id = $this->create_product($_ticket, $transaction_id, $event_data);
									$ticket_ids[] = $product_id;
									$last_ticket_name = $_ticket['id'];

									if (!isset($product_ids_object[$last_product_id])) {
										$product_ids_object[$last_product_id] = 0;
									}
									$product_ids_object[$last_product_id]++;
								}

								foreach ($_ticket['variations'] as $id => $v) {
									if (!$v) {
										continue;
									}
									$a = $ticket_variations[$id];

									if (!isset($variation_added[$product_id][$a['title']][$a['price']])) {
										$variation_added[$product_id][$a['title']][$a['price']] = 1;
										$variation_data = [
											'MEC_WOO_V_max'   => @$a['max'],
											'MEC_WOO_V_title' => $a['title'],
											'MEC_WOO_V_price' => isset($a['sale_price']) ? $a['sale_price'] : $a['price'],
											'MEC_WOO_V_count' => $v,
										];
										static::create_product_variation([$product_id], $variation_data);
									}
									$count            = 1;
									$last_ticket_name = $_ticket['id'];
									$last_product_id  = $product_id;
								}
							} else {
								$product_id    = $this->create_product($_ticket, $transaction_id, $event_data);
								$ticket_ids[] = $product_id;
								$product_ids[] = $product_id;
								if (isset($_ticket['variations'])) {
									foreach ($_ticket['variations'] as $id => $v) {
										if (!$v) {
											continue;
										}
										$a              = $ticket_variations[$id];

										$variation_data = [
											'MEC_WOO_V_max'   => @$a['max'],
											'MEC_WOO_V_title' => $a['title'],
											'MEC_WOO_V_price' => isset($a['sale_price']) ? $a['sale_price'] : $a['price'],
											'MEC_WOO_V_count' => $v,
										];
										static::create_product_variation([$product_id], $variation_data);
									}
								}
							}
						}
					}

					if (isset($transaction['coupon']) && $transaction['coupon']) {
						// Coupon is not exists
						if ($coupon_id) {
							$totalPrices = 0;
							foreach ($ticket_ids as $pid) {
								$ecd_product	=	new \WC_Product($pid);
								if ($ecd_product->exists()) {
									$totalPrices += $ecd_product->price;
								}
							}

							foreach ($ticket_ids as $pid) {
								$ecd_product	=	new \WC_Product($pid);
								if ($ecd_product->exists()) {
									if ($discount_type == 'percent') {
										$discount_amount = ($ecd_product->price * $discount) / 100;
									} else if (isset($transaction['first_for_all']) && $transaction['first_for_all'] == '1') {
										$percent = ($ecd_product->price * 100) / $totalPrices;
										$discount_amount = ($discount * $percent) / 100;
										$discount_amount = $discount_amount / $product_ids_object[$pid];
									} else {
										$percent = ($ecd_product->price * 100) / $totalPrices;
										$discount_amount = ($discount * $percent) / 100;
									}

									$final_price = $ecd_product->price - $discount_amount;
									update_post_meta($ecd_product->id, '_sale_price', $final_price);
									update_post_meta($ecd_product->id, '_price', $final_price);
								}
							}
						}
					}

					if ($fees) {
						foreach ($ticket_ids as  $pid) {
							$ecd_product	=	new \WC_Product($pid);
							if ($ecd_product->exists()) {
								$final_price = $ecd_product->price;

								foreach ($fees as $fee) {
									if ($fee['amount']) {
										switch ($fee['type']) {
											case 'percent':
												$final_price = $final_price + (($final_price * $fee['amount']) / 100);
												break;
										}
									}
								}

								foreach ($fees as $fee) {
									if ($fee['amount']) {
										switch ($fee['type']) {
											case 'amount':
												$final_price = $final_price + $fee['amount'];
												break;
										}
									}
								}

								update_post_meta($ecd_product->id, '_sale_price', $final_price);
								update_post_meta($ecd_product->id, '_price', $final_price);
							}
						}
					}
					foreach ($fees as $fee) {
						if ($fee['amount']) {
							switch ($fee['type']) {
								case 'amount_per_booking':
									$product_id = $this->create_product(
										[
											"name" =>  $fee['title'],
											"count" =>  "1",
											"variations" => [],
											"price" => $fee['amount'],
											'cantChangeQuantity' => true,
											'm_product_type' => 'amount_per_booking'
										],
										$transaction_id,
										$event_data
									);
									if ($product_ids_object) {
										$product_ids_object[$product_id] = 1;
									} else {
										$product_ids[] = $product_id;
									}
									break;
							}
						}
					}
					if (!$product_ids && $product_ids_object) {
						foreach ($product_ids_object as $pid => $count) {
							if ($count > 1) {
								$product_ids[] = $pid . ':' . $count;
							} else if ($count) {
								$product_ids[] = $pid;
							}
						}
					}
					do_action('mec-woocommerce-product-created', $product_ids, $transaction_id);

					$product_ids     = implode(',', $product_ids);
					$add_to_cart_url = esc_url_raw(add_query_arg('add-to-cart', $product_ids, wc_get_cart_url()));
					ob_start();
					ob_get_clean();
					header('Content-Type: application/json');
					echo json_encode([
						'url' => $add_to_cart_url
					]);
					die();
				}

				/**
				 * Render Inline Script
				 *
				 * @since     1.0.0
				 */
				public function render_the_script()
				{
					$redirect = WC_Admin_Settings::get_option('woocommerce_cart_redirect_after_add', false);
					if ($redirect == 'yes') {
						$script = <<<Script
				// MEC Woocommerce Add to Cart BTN
				jQuery(document).on('ready', function() {
					jQuery(document).on('DOMNodeInserted', function (e) {
						if (jQuery(e.target).find('#mec_woo_add_to_cart_btn').length) {
							jQuery(e.target).find('#mec_woo_add_to_cart_btn').on('click', function () {
								var href = jQuery(this).attr('href');
								var cart_url = jQuery(this).data('cart-url');
								jQuery(this).addClass('loading');
								jQuery.ajax({
									type: "get",
									url: href,
									success: function (response) {
										var SUrl = response.url;
										jQuery.ajax({
											type: "get",
											url: SUrl,
											success: function (response) {
												jQuery(this).removeClass('loading');
												setTimeout(function() {
													window.location.href = cart_url;
												}, 500);
											}
										});
									}
								});
								return false;
							});
						}
					})
				});
Script;
					} else {
						$script = <<<script
			jQuery(document).on('ready', function() {
				jQuery(document).on('click', '#mec_woo_add_to_cart_btn_r', function(e) {
					e.preventDefault();
					jQuery(this).addClass('loading');
					var Url = jQuery(this).attr('href');
					jQuery.ajax({
						type: "get",
						url: Url,
						dataType: "json",
						success: function (response) {
							var SUrl = response.url;
							jQuery.ajax({
								type: "get",
								url: SUrl,
								success: function (response) {
									jQuery(this).removeClass('loading');
									setTimeout(function() {
										window.location.href = window.location.href;
									}, 500);
								}
							});
						}
					});
					return false;
				})
			})
script;
					}
					wp_add_inline_script('jquery', $script);
				}

				/**
				 * Add Attribute in Woocommerce
				 *
				 * @since     1.0.0
				 */
				public function woo_add_attribute($attribute)
				{
					global $wpdb;
					// check_admin_referer( 'woocommerce-add-new_attribute' );
					if (empty($attribute['attribute_type'])) {
						$attribute['attribute_type'] = 'text';
					}
					if (empty($attribute['attribute_orderby'])) {
						$attribute['attribute_orderby'] = 'menu_order';
					}
					if (empty($attribute['attribute_public'])) {
						$attribute['attribute_public'] = 0;
					}

					if (empty($attribute['attribute_name']) || empty($attribute['attribute_label'])) {
						return new WP_Error('error', __('Please, provide an attribute name and slug.', 'woocommerce'));
					} elseif (($valid_attribute_name = valid_attribute_name($attribute['attribute_name'])) && is_wp_error($valid_attribute_name)) {
						return $valid_attribute_name;
					} elseif (taxonomy_exists(wc_attribute_taxonomy_name($attribute['attribute_name']))) {
						return new WP_Error('error', sprintf(__('Slug "%s" is already in use. Change it, please.', 'woocommerce'), sanitize_title($attribute['attribute_name'])));
					}

					$wpdb->insert($wpdb->prefix . 'woocommerce_attribute_taxonomies', $attribute);
					do_action('woocommerce_attribute_added', $wpdb->insert_id, $attribute);
					flush_rewrite_rules();
					delete_transient('wc_attribute_taxonomies');

					return true;
				}


				/**
				 * Create Woocommerce Product
				 *
				 * @since     1.0.0
				 */
				public function create_product($ticket, $transaction_id, $event_data)
				{
					$post = array(
						'post_content' => '',
						'post_status'  => 'MEC_Tickets',
						'post_title'   => 'Modern Event Calendar Ticket (' . $ticket['name'] . ') - ' . $transaction_id,
						'post_parent'  => '',
						'post_type'    => 'product',
					);

					// Create post
					$post_id = wp_insert_post($post);
					update_post_meta($post_id, 'transaction_id', $transaction_id);

					if (has_post_thumbnail($event_data['event_id'])) {
						$image                = wp_get_attachment_image_src(get_post_thumbnail_id($event_data['event_id']), 'full');
						$event_featured_image = str_replace(get_site_url(), $_SERVER['DOCUMENT_ROOT'], $image[0]);

						if ($event_featured_image) {
							set_post_thumbnail($post_id, attachment_url_to_postid($image[0]));
						}
					}
					if (!$ticket['price']) {
						$ticket['price'] = 0;
					}

					if (isset($ticket['m_product_type'])) {
						update_post_meta($post_id, 'm_product_type', $ticket['m_product_type']);
					}
					wp_set_object_terms($post_id, 'MEC-Woo-Cat', 'product_cat');
					wp_set_object_terms($post_id, 'simple', 'product_type');
					update_post_meta($post_id, '_visibility', false);
					update_post_meta($post_id, '_stock_status', 'instock');
					update_post_meta($post_id, 'total_sales', '0');
					update_post_meta($post_id, '_downloadable', 'no');
					update_post_meta($post_id, '_virtual', 'yes');
					update_post_meta($post_id, '_regular_price', $ticket['price']);
					update_post_meta($post_id, '_sale_price', isset($ticket['sale_price']) ? $ticket['sale_price'] : $ticket['price']);
					update_post_meta($post_id, '_purchase_note', '');
					update_post_meta($post_id, '_featured', 'no');
					update_post_meta($post_id, '_weight', '');
					update_post_meta($post_id, '_length', '');
					update_post_meta($post_id, '_width', '');
					update_post_meta($post_id, '_height', '');
					update_post_meta($post_id, '_sku', '');
					update_post_meta($post_id, '_product_attributes', array());
					update_post_meta($post_id, '_sale_price_dates_from', '');
					update_post_meta($post_id, '_sale_price_dates_to', '');
					update_post_meta($post_id, '_price', isset($ticket['sale_price']) ? $ticket['sale_price'] : $ticket['price']);
					update_post_meta($post_id, 'mec_ticket', $ticket);
					update_post_meta($post_id, '_sold_individually', '');
					update_post_meta($post_id, '_manage_stock', 'no');
					update_post_meta($post_id, '_backorders', 'no');
					update_post_meta($post_id, '_stock', '');

					// event Data
					update_post_meta($post_id, 'event_id', $event_data['event_id']);
					update_post_meta($post_id, 'event_name', $event_data['event_name']);
					if (isset($event_data['date'])) {
						update_post_meta($post_id, 'mec_date', $event_data['date']);
					}
					if (isset($ticket['cantChangeQuantity'])) {
						update_post_meta($post_id, 'cantChangeQuantity', true);
					}
					update_post_meta($post_id, 'ticket_name', $ticket['name']);

					$terms = array('exclude-from-search', 'exclude-from-catalog');
					wp_set_post_terms($post_id, $terms, 'product_visibility', false);
					update_post_meta($post_id, '_product_image_gallery', '');

					return $post_id;
				}

				/**
				 * Get Product by Name or ID
				 *
				 * @since     1.0.0
				 */
				public function get_product($product_title, $isID = false)
				{
					global $wpdb;
					if ($isID) {
						$post = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE ID = %s AND post_type='product' AND post_status = %s", $product_title, 'MEC_Tickets'));
					} else {
						$post = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='product' AND post_status = %s", $product_title, 'MEC_Tickets'));
					}
					if ($post) {
						return $post;
					}

					return null;
				}

				public static function create_product_variation($product_ids, $variation_data)
				{
					foreach ($product_ids as $pid) {
						$_regular_price = get_post_meta($pid, '_regular_price', true);
						$_price         = get_post_meta($pid, '_price', true);
						update_post_meta($pid, '_regular_price', ($_regular_price + ($variation_data['MEC_WOO_V_price'] * $variation_data['MEC_WOO_V_count'])));
						update_post_meta($pid, '_price', ($_price + ($variation_data['MEC_WOO_V_price'] * $variation_data['MEC_WOO_V_count'])));
						add_post_meta($pid, 'MEC_Variation_Data', json_encode($variation_data));
					}
				}

				public function woocommerce_maybe_add_multiple_products_to_cart($url = false)
				{
					static::$term_id = get_term_by('slug', 'mec-woo-cat', 'product_cat')->term_id;
					if (!class_exists('WC_Form_Handler') || empty($_REQUEST['add-to-cart'])) {
						return;
					}

					$product_ids = explode(',', $_REQUEST['add-to-cart']);
					foreach ($product_ids as $pid) {
						if ($product = wc_get_product($pid)) {
							if (strtolower($product->get_status()) != 'mec_tickets') {
								return;
							}
						}
					}

					remove_action('wp_loaded', array('WC_Form_Handler', 'add_to_cart_action'), 20);
					$count  = count($product_ids);
					foreach ($product_ids as $id_and_quantity) {
						$id_and_quantity         = explode(':', $id_and_quantity);
						$product_id              = $id_and_quantity[0];
						$_REQUEST['quantity']    = !empty($id_and_quantity[1]) ? absint($id_and_quantity[1]) : 1;
						$_REQUEST['add-to-cart'] = $product_id;

						@\WC()->cart->add_to_cart($product_id, $_REQUEST['quantity']);
						$product_id        = apply_filters('woocommerce_add_to_cart_product_id', absint($product_id));
						$adding_to_cart    = wc_get_product($product_id);

						if (!$adding_to_cart) {
							continue;
						}
					}

					$redirect = WC_Admin_Settings::get_option('woocommerce_cart_redirect_after_add', false);
					if ($redirect != 'yes') {
						if ($count > 1) {
							wc_add_notice(__('The Tickets are added to your cart.', 'mec-woocommerce') . ' <a href="' . wc_get_cart_url() . '" target="_blank">' . __('Cart Page', 'mec-woocommerce') . '</a>', apply_filters('woocommerce_add_to_cart_notice_type', 'success'));
						} else {
							wc_add_notice(__('The Ticket is added to your cart.', 'mec-woocommerce') . ' <a href="' . wc_get_cart_url() . '" target="_blank">' . __('Cart Page', 'mec-woocommerce') . '</a>', apply_filters('woocommerce_add_to_cart_notice_type', 'success'));
						}
					}

					echo '<script>window.location.href = "' . wc_get_cart_url() . '";</script>';
					die();
				}

				/**
				 ** Set Product Attributes
				 **
				 ** @since     1.0.0
				 **/
				public function set_product_attributes($post_id, $attributes)
				{
					$i = 0;
					// Loop through the attributes array k
					foreach ($attributes as $name => $value) {
						$product_attributes[$i] = array(
							'name'         => htmlspecialchars(stripslashes($name)), // set attribute name
							'value'        => $value, // set attribute value
							'position'     => 1,
							'is_visible'   => 1,
							'is_variation' => 1,
							'is_taxonomy'  => 0,
						);

						$i++;
					}
					update_post_meta($post_id, '_product_attributes', $product_attributes);
				}


				/**
				 ** Invoke class private method
				 **
				 ** @since   0.1.0
				 **
				 ** @param   string $class_name
				 ** @param   string $methodName
				 **
				 ** @return  mixed
				 **/

				public function woo_hack_invoke_private_method($class_name, $methodName)
				{
					if (version_compare(phpversion(), '5.3', '<')) {
						throw new Exception('PHP version does not support ReflectionClass::setAccessible()', __LINE__);
					}

					$args = func_get_args();
					unset($args[0], $args[1]);

					$reflection = new ReflectionClass($class_name);
					$method     = $reflection->getMethod($methodName);

					$method->setAccessible(true);

					$args = array_merge(array($class_name), $args);
					if (!$method) {
						return false;
					}
					return call_user_func_array(array($method, 'invoke'), $args);
				}
			} //MEC_Woocommerce_Controller

			MEC_Woocommerce_Controller::get_instance();
		endif;
