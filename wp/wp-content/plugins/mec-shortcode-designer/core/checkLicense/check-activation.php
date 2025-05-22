<?php

namespace MEC_ShortcodeDesigner\Core\checkLicense;

// don't load directly.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * MECSHORTCODEDESIGNER.
 *
 * @author      author
 * @package     package
 * @since       1.0.0
 */
class AddonCheckActivation
{

    /**
     * Instance of this class.
     *
     * @since   1.0.0
     * @access  public
     * @var     MEC_ShortcodeDesigner
     */
    public static $instance;

    /**
     * The directory of the file.
     *
     * @access  public
     * @var     string
     */
    public static $dir;

    /**
     * The Args
     *
     * @access  public
     * @var     array
     */
    public static $args;

    /**
     * Provides access to a single instance of a module using the singleton pattern.
     *
     * @since   1.0.0
     * @return  object
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function __construct()
    {
        self::setHooks($this);
        self::init();
    }

    /**
     * Set Hooks.
     *
     * @since   1.0.0
     */
    public static function setHooks($This)
    {
        add_action( 'addons_activation', [ $This, 'add_addon_section' ] );
        add_action(	'wp_ajax_activate_Addons_Integration_shortcode_designer', array($This, 'activate_Addons_Integration_shortcode_designer'));
        add_action(	'wp_ajax_nopriv_activate_Addons_Integration_shortcode_designer', array($This, 'activate_Addons_Integration_shortcode_designer'));
        $options = get_option(MECSHORTCODEDESIGNEROPTIONS);
        if ( isset($options['purchase_code']) && !empty( $options['purchase_code'] )) new AddonLicense();
    }

    /**
     * Booking metabox menu item (login)
     *
     * @since     1.0.0
     */
    public function add_license_options()
    {
        $addon_information = array(
			'product_name' => '',
			'purchase_code' => '',
		);

		$has_option = get_option( MECSHORTCODEDESIGNEROPTIONS , 'false');

		if ( $has_option == 'false' )
		{
			add_option( MECSHORTCODEDESIGNEROPTIONS, $addon_information);
		}
    }

    			/**
		 * Description
		 *
		 * @since     1.0.0
		 */
		public function add_addon_section() {
			$addon_info = get_option( MECSHORTCODEDESIGNEROPTIONS );
			$verify = NULL;
			$envato = new AddonLicense();
			// $verify = $envato->get_MEC_info('dl');
            $mec_license_status = get_option( 'esdesigner_addon_license_status');

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
				<form id="'.MECSHORTCODEDESIGNERTEXTDOMAIN.'" class="addon-activation-form" action="#" method="post">
					<h3>'.esc_html__(MECSHORTCODEDESIGNERNAME).'</h3>
					<div class="LicenseField">
						<input type="password" placeholder="Put your purchase code here" name="MECPurchaseCode" value="'. esc_html($addon_info['purchase_code']) .'">
						<input type="submit">
						<div class="MECPurchaseStatus '.esc_html($license_status).'"></div>
					</div>
					<div class="MECLicenseMessage"></div>
				</form>
				<script>
				if (jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").length > 0)
				{
					jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.' input[type=submit]").on("click", function(e){
						e.preventDefault();
						jQuery(".wna-spinner-wrap").remove();
						jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").find(".MECLicenseMessage").text(" ");
						jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").find(".MECPurchaseStatus").removeClass("PurchaseError");
						jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").find(".MECPurchaseStatus").removeClass("PurchaseSuccess");
						var PurchaseCode = jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.' input[type=password][name=MECPurchaseCode]").val();
						var information = { PurchaseCodeJson: PurchaseCode };
						jQuery.ajax({
							url: mec_admin_localize.ajax_url,
							type: "POST",
							data: {
								action: "activate_Addons_Integration_shortcode_designer",
								nonce: mec_admin_localize.ajax_nonce,
								content: information,
							},
							beforeSend: function () {
								jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.' .LicenseField").append("<div class=\"wna-spinner-wrap\"><div class=\"wna-spinner\"><div class=\"double-bounce1\"></div><div class=\"double-bounce2\"></div></div></div>");
							},
							success: function (response) {
								if (response == "success")
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").find(".MECPurchaseStatus").addClass("PurchaseSuccess");
								}
								else
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").find(".MECPurchaseStatus").addClass("PurchaseError");
									jQuery("#'.MECSHORTCODEDESIGNERTEXTDOMAIN.'").find(".MECLicenseMessage").append(response);
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
		public function activate_Addons_Integration_shortcode_designer() {
			if(!wp_verify_nonce($_REQUEST['nonce'], 'mec_settings_nonce'))
			{
				exit();
			}

			$options = get_option( MECSHORTCODEDESIGNEROPTIONS );
			$options['purchase_code'] = $_REQUEST['content']['PurchaseCodeJson'];
			$options['product_name'] = MECSHORTCODEDESIGNERNAME;
			update_option( MECSHORTCODEDESIGNEROPTIONS , $options);

			$verify = NULL;
			
			$envato = new AddonLicense();
			$verify = $envato->get_MEC_info('dl');

			if(!is_null($verify))
			{
				$LicenseStatus = 'success';
				update_option( 'esdesigner_addon_license_status', 'active');
			}
			else 
			{
				$LicenseStatus = __('Activation faild. Please check your purchase code or license type.<br><b>Note: Your purchase code should match your licesne type.</b>' , 'mec-single-builder') . '<a style="text-decoration: underline; padding-left: 7px;" href="https://webnus.net/dox/modern-events-calendar/auto-update-issue-in-modern-event-calendar/" target="_blank">'  . __('Troubleshooting' , 'mec-single-builder') . '</a>';
				update_option( 'esdesigner_addon_license_status', 'faild');
			}

			echo $LicenseStatus;
			wp_die();
		}


    /**
     * Register Autoload Files
     *
     * @since     1.0.0
     */
    public function init()
    {
        if (!class_exists('\MEC_ShortcodeDesigner\Autoloader')) {
            return;
        }
    }
} //MECSHORTCODEDESIGNER
