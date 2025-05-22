<?php
namespace MEC_Single_Builder\Inc\Core;
use MEC_Single_Builder as NS;

/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       https://webnus.net
 * @since      1.0.0
 *
 * @author     Webnus
 **/
class Activator {

	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$addon_information = array(
			'product_name' => '',
			'purchase_code' => '',
		);

		$has_option = get_option( NS\PLUGIN_OPTIONS , 'false');

		if ( $has_option == 'false' )
		{
			add_option( NS\PLUGIN_OPTIONS, $addon_information);
		}

		update_option('esb_show_setup_popup', true);

	}

}