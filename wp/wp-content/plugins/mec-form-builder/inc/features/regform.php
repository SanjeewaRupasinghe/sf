<?php

use Elementor\Post_CSS_File;
use Elementor\Core\Files\CSS\Post;

/** no direct access */
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('MEC_Features_RegForm')) :

	/**
	 * MEC_Features_RegForm.
	 *
	 * @author     author
	 * @package     package
	 * @since     1.0.0
	 */
	class MEC_Features_RegForm
	{


		/**
		 * Instance of this class.
		 *
		 * @since     1.0.0
		 * @access     private
		 * @var     MEC_Features_RegForm
		 */
		private static $instance;

		/**
		 * the object created its own class
		 * Provided that the class has no other occurences
		 *
		 * @since  1.0.0
		 * @return MEC_Form_Builder
		 */
		public static function get_instance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function style_detector()
		{
			if(!class_exists('\Elementor\Core\Files\CSS\Post')) {
				return;
			}

			if (is_single() && 'mec-events' == get_post_type()) {
				$p_id = get_the_ID();
				$f_id = get_post_meta($p_id, 'mec_reg_form_id', true);
				if(!$f_id) {
					return;
				}

				$css_file = \Elementor\Core\Files\CSS\Post::create( $f_id );
				$css_file->enqueue();
			}
		}

		/**
		 * Define the core functionality of the MEC_Features_RegForm.
		 * Load the dependencies.
		 *
		 * @since     1.0.0
		 */
		public function __construct()
		{
			$this->actions();
		}
		/**
		 * Actions
		 *
		 * @since     1.0.0
		 */
		public function actions()
		{
			add_action('mec_reg_fields_form_start', [$this, 'render_select_forms_in_reg_form']);
			add_action('admin_footer', [$this, 'render_the_scripts_in_reg_form']);

			add_action('wp_enqueue_scripts', [$this, 'style_detector']);
			add_action('mec_meta_box_reg_fields_form', [$this, 'render_select_forms_in_events'], 1, 1);
			add_action('mec_events_meta_box_regform_end', [$this, 'render_the_scripts_in_events'], 1, 1);

			add_action('mec_save_options', [$this, 'save_options'], 1, 1);
			add_action('mec_save_reg_fields', [$this, 'mec_save_reg_fields'], 1, 2);
			add_filter('mec_get_reg_fields', [$this, 'mec_get_reg_fields'], 1, 2);
			add_filter('mec-attendees-title', [$this, 'mec_attendees_title'], 1, 1);

			add_action('addons_activation', [$this, 'add_activate_section']);
			add_action('wp_ajax_activate_FormBuilder', array($this, 'activate_FormBuilder'));
			add_action('wp_ajax_nopriv_activate_FormBuilder', array($this, 'activate_FormBuilder'));
			new MEC_Form_License();
		}

		/**
		 * Change MEC Attendees Title
		 *
		 * @since     1.0.0
		 */
		public function mec_attendees_title ($title) {
			$_title = get_option('mec-attendees-title', false);
			if($_title !== false) {
				return $_title;
			}
			return $title;
		}

		/**
		 * Add Activate Section
		 *
		 * @since     1.0.0
		 */
		public function add_activate_section()
		{
			$addon_info = get_option('mec_formbuilder_options');
			$verify     = null;
			$envato     = new MEC_Form_License();

			$v       = $envato->get_MEC_info('version');
			$version = isset($v->version) ? $v->version : null;
			$verify  = $envato->get_MEC_info('dl');

			$license_status = '';
			if (!empty($addon_info['purchase_code']) && !is_null($verify)) {
				$license_status = 'PurchaseSuccess';
			} elseif (!empty($addon_info['purchase_code']) && is_null($verify)) {
				$license_status = 'PurchaseError';
			}
			echo '
				<style>.box-addon-activation-toggle-head {display: inline-block;}</style>
				<form id="MECFormBuilderActivation" class="addon-activation-form" action="#" method="post">
					<h3>' . __('Elementor Form Builder', 'mec-shortcode-builder') . '</h3>
					<div class="LicenseField">
						<input type="password" placeholder="Put your purchase code here" name="MECPurchaseCode" value="' . esc_html($addon_info['purchase_code']) . '">
						<input type="submit">
						<div class="MECPurchaseStatus ' . esc_html($license_status) . '"></div>
					</div>
					<div class="MECLicenseMessage"></div>
				</form>
				<script>
				if (jQuery("#MECFormBuilderActivation").length > 0)
				{
					jQuery("#MECFormBuilderActivation input[type=submit]").on("click", function(e){
						e.preventDefault();
						jQuery(".wna-spinner-wrap").remove();
						jQuery("#MECFormBuilderActivation").find(".MECLicenseMessage").text(" ");
						jQuery("#MECFormBuilderActivation").find(".MECPurchaseStatus").removeClass("PurchaseError");
						jQuery("#MECFormBuilderActivation").find(".MECPurchaseStatus").removeClass("PurchaseSuccess");
						var PurchaseCode = jQuery("#MECFormBuilderActivation input[type=password][name=MECPurchaseCode]").val();
						var information = { PurchaseCodeJson: PurchaseCode };
						jQuery.ajax({
							url: mec_admin_localize.ajax_url,
							type: "POST",
							data: {
								action: "activate_FormBuilder",
								nonce: mec_admin_localize.ajax_nonce,
								content: information,
							},
							beforeSend: function () {
								jQuery("#MECFormBuilderActivation .LicenseField").append("<div class=\"wna-spinner-wrap\"><div class=\"wna-spinner\"><div class=\"double-bounce1\"></div><div class=\"double-bounce2\"></div></div></div>");
							},
							success: function (response) {
								if (response == "success")
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#MECFormBuilderActivation").find(".MECPurchaseStatus").addClass("PurchaseSuccess");
								}
								else
								{
									jQuery(".wna-spinner-wrap").remove();
									jQuery("#MECFormBuilderActivation").find(".MECPurchaseStatus").addClass("PurchaseError");
									jQuery("#MECFormBuilderActivation").find(".MECLicenseMessage").append(response);
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
		public function activate_FormBuilder()
		{
			if (!wp_verify_nonce($_REQUEST['nonce'], 'mec_settings_nonce')) {
				exit();
			}

			$options                  = get_option('mec_formbuilder_options');
			$options['purchase_code'] = $_REQUEST['content']['PurchaseCodeJson'];
			$options['product_name']  = 'Elementor Form Builder';
			update_option('mec_formbuilder_options', $options);

			$verify = null;

			$envato = new MEC_Form_License();
			$verify = $envato->get_MEC_info('dl');

			if (!is_null($verify)) {
				$LicenseStatus = 'success';
			} else {
				$LicenseStatus = __('Activation faild. Please check your purchase code or license type.<br><b>Note: Your purchase code should match your licesne type.</b>', 'mec-form-builder') . '<a style="text-decoration: underline; padding-left: 7px;" href="https://webnus.ticksy.com/article/14445/" target="_blank">' . __('Troubleshooting', 'mec-form-builder') . '</a>';
			}

			echo $LicenseStatus;
			wp_die();
		}

		/**
		 * MEC Get Reg Fields
		 *
		 * @since     1.0.0
		 */
		public function mec_get_reg_fields($fields, $e_id)
		{
			if (is_admin() && isset($_GET['page']) && isset($_GET['tab']) && $_GET['page'] == 'MEC-settings' && $_GET['tab'] == 'MEC-reg-form') {
				return $fields;
			}
			$global_inheritance = get_post_meta($e_id, 'mec_reg_fields_global_inheritance', 1);
			if (trim($global_inheritance) == '') {
				$global_inheritance = 1;
			}
			if ((int) $global_inheritance === 1) {
				$mec_default_form_id = get_option('mec_default_form_id', false);
				$reg_fields          = get_post_meta($mec_default_form_id, 'mec_reg_fields', true);
				if (!is_array($reg_fields) || empty($reg_fields) || !$mec_default_form_id) {
					return $fields;
				} else {
					return $reg_fields;
				}
			} else {
				$mec_reg_form_id = get_post_meta($e_id, 'mec_reg_form_id', true);
				$reg_fields      = get_post_meta($mec_reg_form_id, 'mec_reg_fields', true);
				if (!is_array($reg_fields)) {
					return $fields;
				}

				foreach ($reg_fields as $key => $field) {
					if (isset($field['type']) && $field['type'] == 'h') {
						unset($reg_fields[$key]);
					}
					if (isset($field['type']) && $field['type'] == 'p') {
						$reg_fields[$key]['paragraph'] = isset($reg_fields[$key]['paragraph']) ? $reg_fields[$key]['paragraph'] : '';
						$reg_fields[$key]['content'] = $reg_fields[$key]['paragraph'];
						unset($reg_fields[$key]['paragraph']);
					}
				}

				if (!is_array($reg_fields) || empty($reg_fields)) {
					return $fields;
				}
			}
			return $reg_fields;
		}


		/**
		 * Description
		 *
		 * @since     1.0.0
		 */
		public function mec_save_reg_fields($post_id, $fields)
		{
			$reg_fields_global_inheritance = isset($_REQUEST['reg_fields_global_inheritance']) ? $_REQUEST['reg_fields_global_inheritance'] : 0;
			if ('1' != $reg_fields_global_inheritance) {
				$default_form_id = isset($_REQUEST['mec']['default_form']['form_id']) ? $_REQUEST['mec']['default_form']['form_id'] : '';
				update_post_meta($post_id, 'mec_reg_form_id', $default_form_id);
			} else {
				update_post_meta($post_id, 'mec_reg_form_id', '');
			}
		}

		public function render_select_forms_in_events($post_id)
		{
			$global_inheritance = get_post_meta($post_id, 'mec_reg_fields_global_inheritance', true);
			if (trim($global_inheritance) == '') {
				$global_inheritance = 1;
			}

			$mec_reg_form_id = get_post_meta($post_id, 'mec_reg_form_id', '');
			$mec_reg_form_id = is_array($mec_reg_form_id) && isset($mec_reg_form_id[0]) ? $mec_reg_form_id[0] : $mec_reg_form_id;
			$class           = ($global_inheritance) ? 'mec-util-hidden' : '';
			$html            = '<div class="mec-select-default-form-in-events ' . $class . '">';
			$args            = array(
				'posts_per_page' => 500,
				'category_name'  => '',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_type'      => 'mec_form',
				'post_status'    => 'publish',
			);

			$posts_array = get_posts($args);
			$html       .= '<label><input type="radio" data-name="custom" value="0" name="mec[default_form][form_id]">' . esc_html__('Classic Form Builder', 'mec-form-builder') . ' </label>';
			$html       .= '<label><input type="radio" data-name="formBuilder" name="mec[default_form][form_id]" value="'. ($mec_reg_form_id ? $mec_reg_form_id : 'formBuilderForms') .'">' . esc_html__('Elementor Form Builder', 'mec-form-builder') . ' </label>';
			$html       .= '<br /><select id="mec_fb_form_id" class="mec-util-hidden" style="width:100%;height: 38px;box-sizing: border-box;margin-bottom: 8px;padding: 0 6px;box-shadow: none;border-radius: 2px;box-shadow: inset 0 1px 5px rgba(0,0,0,.05);min-width: 200px;margin-top: 30px" value="'.$mec_reg_form_id.'">';
			$html       .= '<option value="0">' . esc_html__('Select Form', 'mec-form-builder') . '</option>';
			foreach ($posts_array as $f) :
				$html .= '<option value="' . $f->ID . '"';
				if ($f->ID == $mec_reg_form_id) {
					echo '<script>var mec_default_form_id = "' . $f->ID . '";</script>';
					$html .= ' selected="selected"';
				}
				$html .= '>' . $f->post_title . '</option>';
			endforeach;

			$html .= '</select>';
			$html .= '</div>';
			$html .= '<br />';

			echo $html;
		}

		/**
		 * Render the scripts in events
		 *
		 * @since     1.0.0
		 */
		public function render_the_scripts_in_events($post_id)
		{
			$feature_mec = new MEC_feature_mec();
			$settings    = $feature_mec->main->get_default_form();

			$global_inheritance = get_post_meta($post_id, 'mec_reg_fields_global_inheritance', true);
			if (trim($global_inheritance) == '') {
				$global_inheritance = 1;
			}

			$mec_reg_form_id = get_post_meta($post_id, 'mec_reg_form_id', '');
			$mec_reg_form_id = is_array($mec_reg_form_id) && isset($mec_reg_form_id[0]) ? $mec_reg_form_id[0] : $mec_reg_form_id;

			$script = '
                <script type="text/javascript">
                    jQuery(document).ready(function() {
						jQuery(' . "'" . 'input[name="mec[default_form][form_id]"]' . "'" . ').on("change", function() {
							if (jQuery(this).data("name") == "custom") {
								jQuery("div#mec_regform_container_toggle").removeClass("mec-util-hidden");
								jQuery("#mec_fb_form_id").addClass("mec-util-hidden");
							} else {
								jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden");
								jQuery("#mec_fb_form_id").removeClass("mec-util-hidden");
								jQuery(this).val( jQuery("#mec_fb_form_id").val() );
							}
						});

						  jQuery(' . "'" . 'input[name="mec[reg_fields_global_inheritance]"]' . "'" . ').attr("onchange", "").on("change", function(event) {
								if(jQuery(this).is(":checked")) {
									if ( jQuery(\'input[name="mec[default_form][form_id]"][data-name="formBuilder"]\').is(":checked") ) {
										jQuery("div#mec_regform_container_toggle").removeClass("mec-util-hidden ");
									} else {
										jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden ");
                                    }
                                    jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden ");
                                    jQuery(".mec-select-default-form-in-events").addClass("mec-util-hidden");
                                } else {
									jQuery(".mec-select-default-form-in-events").removeClass("mec-util-hidden");
									if (jQuery(\'input[name="mec[default_form][form_id]"][data-name="formBuilder"]\').is(":checked")) {
										jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden ");
									} else {
										jQuery("div#mec_regform_container_toggle").removeClass("mec-util-hidden ");
									}
                                }
                        });

						jQuery("#mec_fb_form_id").on("change", function() {
							jQuery("input[data-name=formBuilder]").val( jQuery(this).val() );
						})

						if ( typeof(mec_default_form_id) != "undefined" ) {
							jQuery("input[data-name=formBuilder]").prop("checked", true);
							jQuery("#mec_fb_form_id").removeClass("mec-util-hidden");
							jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden");
						} else {
							jQuery("input[data-name=custom]").prop("checked", true);
							if(jQuery(' . "'" . 'input[name="mec[reg_fields_global_inheritance]"]' . "'" . ').is(":checked")) {
								jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden ");
							} else {
								jQuery("div#mec_regform_container_toggle").removeClass("mec-util-hidden ");
							}
						}

                    });
                </script>
            ';

			if (isset($settings['form_id']) && $settings['form_id']) {
				$script .= '
					<script type="text/javascript">
						jQuery(document).ready(function() {
							if ( typeof(mec_default_form_id) != "undefined" ) {
								return false;
							}
							jQuery("input[data-name=formBuilder]").prop("checked", true);
							jQuery("#mec_fb_form_id").val("' . $settings['form_id'] . '");
							jQuery("#mec_fb_form_id").removeClass("mec-util-hidden");
							jQuery("div#mec_regform_container_toggle").addClass("mec-util-hidden");
						});
				</script>';
			}
			echo $script;
		}

		public function render_select_forms_in_reg_form()
		{
			$feature_mec = new MEC_feature_mec();
			$settings    = $feature_mec->main->get_default_form();
			$html        = '';

			$args        = array(
				'posts_per_page' => 500,
				'category_name'  => '',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'post_type'      => 'mec_form',
				'post_status'    => 'publish',
			);
			$posts_array = get_posts($args);
			$html       .= '<label><input type="radio" data-name="custom" value="0" name="mec[default_form][form_id]">' . esc_html__('Classic Form Builder', 'mec-form-builder') . ' </label>';
			$html       .= '<label><input type="radio" data-name="formBuilder" name="mec[default_form][form_id]" value="formBuilderForms">' . esc_html__('Elementor Form Builder', 'mec-form-builder') . ' </label>';
			$html       .= '<br><select id="form_id" class="mec-util-hidden" style="height: 38px;box-sizing: border-box;margin-bottom: 8px;padding: 0 6px;box-shadow: none;border-radius: 2px;box-shadow: inset 0 1px 5px rgba(0,0,0,.05);min-width: 200px;margin-top: 30px;">';
			$html       .= '<option value="0">' . esc_html__('Select Default Form', 'mec-form-builder') . '</option>';
			// $html       .= '<option value="0">' . esc_html__( 'Classic Form Builder', 'mec-form-builder' ) . '</option>';
			foreach ($posts_array as $f) :
				$html .= '<option value="' . $f->ID . '"';
				if (isset($settings['form_id']) && $f->ID == $settings['form_id']) {
					echo '<script>var mec_default_form_id = "' . $f->ID . '";</script>';
					$html .= ' selected="selected"';
				}
				$html .= '>' . $f->post_title . '</option>';
			endforeach;
			$html .= '</select>';
			$html .= '';
			$html .= '<br />';

			echo $html;
		}

		/**
		 * Render the scripts in reg form
		 *
		 * @since     1.0.0
		 */
		public function render_the_scripts_in_reg_form()
		{
			if (isset($_GET['page']) && $_GET['page'] == 'MEC-settings') {
				$feature_mec = new MEC_feature_mec();
				$settings    = $feature_mec->main->get_default_form();
			} else {
				return;
			}

			$script = '
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
						jQuery(\'[name="mec[default_form][form_id]"]\').on("change", function() {
							console.log($(this));
							if (jQuery(this).data("name") == "custom") {
								jQuery("div#mec_reg_form_container").removeClass("mec-util-hidden");
								jQuery("#form_id").addClass("mec-util-hidden");
							} else {
								jQuery("div#mec_reg_form_container").addClass("mec-util-hidden");
								jQuery("#form_id").removeClass("mec-util-hidden");
								jQuery(this).val( jQuery("#form_id").val() );
							}
						});
						jQuery("#form_id").on("change", function() {
							jQuery("input[data-name=formBuilder]").val( jQuery(this).val() );
						})

						if ( typeof(mec_default_form_id) != "undefined" ) {
							jQuery("input[data-name=formBuilder]").prop("checked", true);
							jQuery("#form_id").removeClass("mec-util-hidden");
							jQuery("div#mec_reg_form_container").addClass("mec-util-hidden");
						} else {
							jQuery("input[data-name=custom]").prop("checked", true);
						}
                    });
                </script>
            ';

			if (isset($settings['form_id'])) {
				if (!empty($settings['form_id']) && $settings['form_id']) {
					$script .= '
                        <script type="text/javascript">
                            jQuery(document).ready(function() {
                                jQuery("div#mec_reg_form_container").addClass("mec-util-hidden");
                            });
                        </script>
                    ';
				}
			}
			echo $script;
		}

		/**
		 * save options
		 *
		 * @since     1.0.0
		 */
		public function save_options($data)
		{
			if (isset($_REQUEST['mec']['default_form']['form_id'])) {
				if ('0' != $_REQUEST['mec']['default_form']['form_id']) {
					$id = esc_attr($_REQUEST['mec']['default_form']['form_id']);
					update_option('mec_default_form_id', $id);
				} else {
					delete_option('mec_default_form_id');
				}
			}
		}
	} //Class
	MEC_Features_RegForm::get_instance();
endif;
