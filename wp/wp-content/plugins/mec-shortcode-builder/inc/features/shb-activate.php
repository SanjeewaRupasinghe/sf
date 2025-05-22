<?php
/** no direct access */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Shb_Activation' ) ) :

	/**
	 * MEC_Shb_Activation.
	 *
	 * @author     author
	 * @package     package
	 * @since     1.0.0
	 */
	class MEC_Shb_Activation {


		/**
		 * Instance of this class.
		 *
		 * @since     1.0.0
		 * @access     private
		 * @var     MEC_Shb_Activation
		 */
		private static $instance;

		/**
		 * the object created its own class
		 * Provided that the class has no other occurences
		 *
		 * @since  1.0.0
		 * @return MEC_Shb_Activation
		 */
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Define the core functionality of the MEC_Shb_Activation.
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
			add_action( 'addons_activation', [ $this, 'add_shb_activate_section' ] );
			add_action(	'wp_ajax_activate_Shb_Integration', array($this, 'activate_Shb_Integration'));
			add_action(	'wp_ajax_nopriv_activate_Shb_Integration', array($this, 'activate_Shb_Integration'));
			new MEC_Shb_License();
		}


		/**
		 * Description
		 *
		 * @since     1.0.0
		 */
		public function add_shb_activate_section() {
			$addon_info = get_option('mec_shb_options');
			$verify = NULL;
			$envato = new MEC_Shb_License();

			$v = $envato->get_MEC_info('version');
			$version = isset($v->version) ? $v->version : NULL;
			// $verify = $envato->get_MEC_info('dl');
			$mec_license_status = get_option( 'esb_addon_license_status');

			$license_status = '';
			if(!empty($addon_info['purchase_code']) && $mec_license_status == 'active')
			{
				$license_status = 'PurchaseSuccess';
			} 
			elseif ( !empty($addon_info['purchase_code']) && $mec_license_status == 'faild' )
			{
				$license_status = 'PurchaseError';
			}
			echo '
				<style>.box-addon-activation-toggle-head {display: inline-block;}</style>
				<form id="MECSHBActivation" class="addon-activation-form" action="#" method="post">
					<h3>'.__('Elementor Shortcode Builder' , 'mec-shortcode-builder').'</h3>
					<div class="LicenseField">
						<input type="password" placeholder="Put your purchase code here" name="MECPurchaseCode" value="'. esc_html($addon_info['purchase_code']) .'">
						<input type="submit">
						<div class="MECPurchaseStatus '.esc_html($license_status).'"></div>
					</div>
					<div class="MECLicenseMessage"></div>
				</form>
				<script>
				if (jQuery("#MECSHBActivation").length > 0)
				{
					jQuery("#MECSHBActivation input[type=submit]").on("click", function(e){
						e.preventDefault();
						jQuery(".wna-spinner-wrap").remove();
						jQuery("#MECSHBActivation").find(".MECLicenseMessage").text(" ");
						jQuery("#MECSHBActivation").find(".MECPurchaseStatus").removeClass("PurchaseError");
						jQuery("#MECSHBActivation").find(".MECPurchaseStatus").removeClass("PurchaseSuccess");
						var PurchaseCode = jQuery("#MECSHBActivation input[type=password][name=MECPurchaseCode]").val();
						var information = { PurchaseCodeJson: PurchaseCode };
						jQuery.ajax({
							url: mec_admin_localize.ajax_url,
							type: "POST",
							data: {
								action: "activate_Shb_Integration",
								nonce: mec_admin_localize.ajax_nonce,
								content: information,
							},
							beforeSend: function () {
								jQuery("#MECSHBActivation .LicenseField").append("<div class=\"wna-spinner-wrap\"><div class=\"wna-spinner\"><div class=\"double-bounce1\"></div><div class=\"double-bounce2\"></div></div></div>");
							},
							success: function (response) {
								if (response == "success")
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#MECSHBActivation").find(".MECPurchaseStatus").addClass("PurchaseSuccess");
								}
								else
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#MECSHBActivation").find(".MECPurchaseStatus").addClass("PurchaseError");
									jQuery("#MECSHBActivation").find(".MECLicenseMessage").append(response);
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
		public function activate_Shb_Integration()
		{
			if(!wp_verify_nonce($_REQUEST['nonce'], 'mec_settings_nonce'))
			{
				exit();
			}

			$options = get_option('mec_shb_options');
			$options['purchase_code'] = $_REQUEST['content']['PurchaseCodeJson'];
			$options['product_name'] = 'Elementor Shortcode Builder';
			update_option( 'mec_shb_options' , $options);

			$verify = NULL;
			
			$envato = new MEC_Shb_License();
			$verify = $envato->get_MEC_info('dl');

			if(!is_null($verify))
			{
				$LicenseStatus = 'success';
				update_option( 'esb_addon_license_status', 'active');
			}
			else 
			{
				$LicenseStatus = __('Activation faild. Please check your purchase code or license type.<br><b>Note: Your purchase code should match your licesne type.</b>' , 'mec-shortcode-builder') . '<a style="text-decoration: underline; padding-left: 7px;" href="https://webnus.net/dox/modern-events-calendar/auto-update-issue/" target="_blank">'  . __('Troubleshooting' , 'mec-shortcode-builder') . '</a>';
				update_option( 'esb_addon_license_status', 'faild');
			}

			echo $LicenseStatus;
			wp_die();
		}
	} //Class
	MEC_Shb_Activation::get_instance();
endif;
