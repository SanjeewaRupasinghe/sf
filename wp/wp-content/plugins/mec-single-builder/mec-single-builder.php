<?php
/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webnus.net
 * @since             1.0.0
 * @package           MEC_Single_Builder
 *
 * Plugin Name:       Elementor Single Builder for MEC
 * Plugin URI:        https://webnus.net/
 * Description:       Use this Add-on to build your form in Elementor Editor. It allows you to use many different type of fields and rearrange them by drag and drop and modify their styles.
 * Version:           1.7.2
 * Author:            Webnus
 * Author URI:        https://webnus.net/
 * Text Domain:       mec-single-builder
 * Domain Path:       /languages
 */

namespace MEC_Single_Builder;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define Constants
 */

define( __NAMESPACE__ . '\NS', __NAMESPACE__ . '\\' );

/** MEC Absolute Path **/
define(	NS . 'PLUGIN_ABSPATH', dirname(__FILE__));

define( NS . 'PLUGIN_NAME', 'mec-single-builder' );

define( NS . 'PLUGIN_VERSION', '1.7.2' );

define( NS . 'PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );

define( NS . 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

define( NS . 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( NS . 'PLUGIN_TEXT_DOMAIN', 'mec-single-builder' );

define( NS . 'PLUGIN_ORG_NAME', 'Elementor Single Builder' );

define( NS . 'PLUGIN_OPTIONS', 'mec_singlebuilder_options' );

define( NS . 'PLUGIN_SLUG', 'mec-single-builder' );

define( NS . 'PLUGIN_FILE', __FILE__ );

/**
 * Autoload Classes
 */

require_once( PLUGIN_NAME_DIR . 'inc/libraries/autoloader.php' );
/**
 * Register Activation and Deactivation Hooks
 * This action is documented in inc/core/class-activator.php
 */

register_activation_hook( __FILE__, array( NS . 'Inc\Core\Activator', 'activate' ) );

/**
 * The code that runs during plugin deactivation.
 * This action is documented inc/core/class-deactivator.php
 */

register_deactivation_hook( __FILE__, array( NS . 'Inc\Core\Deactivator', 'deactivate' ) );


/**
 * Plugin Singleton Container
 *
 * Maintains a single copy of the plugin app object
 *
 * @since    1.0.0
 */
class MEC_Single_Builder {

	/**
	 * The instance of the plugin.
	 *
	 * @since    1.0.0
	 * @var      Init $init Instance of the plugin.
	 */
	private static $init;
	/**
	 * Loads the plugin
	 *
	 * @access    public
	 */
	public static function init() {

		if ( null === self::$init ) {
			self::$init = new Inc\Core\Init();
			self::$init->run();
		}

		return self::$init;
	}

}

/**
 * Begins execution of the plugin
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * Also returns copy of the app object so 3rd party developers
 * can interact with the plugin's hooks contained within.
 **/
function wp_plugin_name_init() {
		return MEC_Single_Builder::init();
}

$min_php = '5.6.0';

// Check the minimum required PHP version and run the plugin.
if ( version_compare( PHP_VERSION, $min_php, '>=' ) ) {
		wp_plugin_name_init();
}