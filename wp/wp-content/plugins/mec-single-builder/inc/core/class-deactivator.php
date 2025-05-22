<?php
namespace MEC_Single_Builder\Inc\Core;

/**
 * Fired during plugin deactivation
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link       https://webnus.net
 * @since      1.0.0
 *
 * @author     Webnus
 **/
class Deactivator {

	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$options = get_option('mec_options');
		if (!$options) {
			return;
		}

		$options['settings']['single_single_style'] = 'default';
		update_option('mec_options', $options);
	}

}