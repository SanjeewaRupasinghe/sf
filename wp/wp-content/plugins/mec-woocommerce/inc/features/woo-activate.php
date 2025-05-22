<?php
/** no direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Woo_Activation' ) ) :

	/**
	* MEC_Woo_Activation.
	*
	* @author     author
	* @package     package
	* @since     1.0.0
	*/
	class MEC_Woo_Activation {


		/**
		* Instance of this class.
		*
		* @since     1.0.0
		* @access     private
		* @var     MEC_Woo_Activation
		*/
		private static $instance;

		/**
		* the object created its own class
		* Provided that the class has no other occurences
		*
		* @since  1.0.0
		* @return MEC_Form_Builder
		*/
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		* Define the core functionality of the MEC_Woo_Activation.
		* Load the dependencies.
		*
		* @since     1.0.0
		*/
		public function __construct() {
			 $this->actions();
		}

		 /**
		  * Actions
		  *
		  * @since     1.0.0
		  */
		public function actions() {
			add_action( 'addons_activation', [ $this, 'add_woo_activate_section' ] );
			add_action(	'wp_ajax_activate_Woo_Integration', array($this, 'activate_Woo_Integration'));
			add_action(	'wp_ajax_nopriv_activate_Woo_Integration', array($this, 'activate_Woo_Integration'));
			new MEC_Woo_License();
		}


		/**
		* Description
		*
		* @since     1.0.0
		*/
		public function add_woo_activate_section() {
			$addon_info = get_option('mec_woo_options');
			$verify = NULL;
			$envato = new MEC_Woo_License();

			$v = $envato->get_MEC_info('version');
			$version = isset($v->version) ? $v->version : NULL;
			$verify = $envato->get_MEC_info('dl');

			$license_status = '';
			if(!empty($addon_info['purchase_code']) && !is_null($verify))
			{
				$license_status = 'PurchaseSuccess';
			}
			elseif ( !empty($addon_info['purchase_code']) && is_null($verify) )
			{
				$license_status = 'PurchaseError';
			}
			echo '
				<style>.box-addon-activation-toggle-head {display: inline-block;}</style>
				<form id="MECWooActivation" class="addon-activation-form" action="#" method="post">
					<h3>'.__('WooCommerce Integration' , 'mec-shortcode-builder').'</h3>
					<div class="LicenseField">
						<input type="password" placeholder="Put your purchase code here" name="MECPurchaseCode" value="'. esc_html($addon_info['purchase_code']) .'">
						<input type="submit">
						<div class="MECPurchaseStatus '.esc_html($license_status).'"></div>
					</div>
					<div class="MECLicenseMessage"></div>
				</form>
				<script>
				if (jQuery("#MECWooActivation").length > 0)
				{
					jQuery("#MECWooActivation input[type=submit]").on("click", function(e){
						e.preventDefault();
						jQuery(".wna-spinner-wrap").remove();
						jQuery("#MECWooActivation").find(".MECLicenseMessage").text(" ");
						jQuery("#MECWooActivation").find(".MECPurchaseStatus").removeClass("PurchaseError");
						jQuery("#MECWooActivation").find(".MECPurchaseStatus").removeClass("PurchaseSuccess");
						var PurchaseCode = jQuery("#MECWooActivation input[type=password][name=MECPurchaseCode]").val();
						var information = { PurchaseCodeJson: PurchaseCode };
						jQuery.ajax({
							url: mec_admin_localize.ajax_url,
							type: "POST",
							data: {
								action: "activate_Woo_Integration",
								nonce: mec_admin_localize.ajax_nonce,
								content: information,
							},
							beforeSend: function () {
								jQuery("#MECWooActivation .LicenseField").append("<div class=\"wna-spinner-wrap\"><div class=\"wna-spinner\"><div class=\"double-bounce1\"></div><div class=\"double-bounce2\"></div></div></div>");
							},
							success: function (response) {
								if (response == "success")
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#MECWooActivation").find(".MECPurchaseStatus").addClass("PurchaseSuccess");
								}
								else
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#MECWooActivation").find(".MECPurchaseStatus").addClass("PurchaseError");
									jQuery("#MECWooActivation").find(".MECLicenseMessage").append(response);
								}
							},
						});
					});
				}
				</script>
			';
		}

		/**
		* Description
		*
		* @since     1.0.0
		*/
		public function activate_Woo_Integration()
		{
			if(!wp_verify_nonce($_REQUEST['nonce'], 'mec_settings_nonce'))
			{
				exit();
			}

			$options = get_option('mec_woo_options');
			$options['purchase_code'] = $_REQUEST['content']['PurchaseCodeJson'];
			$options['product_name'] = 'Woocommerce Integration';
			update_option( 'mec_woo_options' , $options);

			$verify = NULL;

			$envato = new MEC_Woo_License();
			$verify = $envato->get_MEC_info('dl');

			if(!is_null($verify))
			{
				$LicenseStatus = 'success';
			}
			else
			{
				$LicenseStatus = __('Activation faild. Please check your purchase code or license type.<br><b>Note: Your purchase code should match your licesne type.</b>' , 'mec') . '<a style="text-decoration: underline; padding-left: 7px;" href="https://webnus.ticksy.com/article/14445/" target="_blank">'  . __('Troubleshooting' , 'mec') . '</a>';
			}

			echo $LicenseStatus;
			wp_die();
		}
	} //Class
	MEC_Woo_Activation::get_instance();
endif;
