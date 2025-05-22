<?php
/**
*	Plugin Name: MEC Virtual Events
*	Plugin URI: http://webnus.net/modern-events-calendar/
*	Description: This addon allows you to turn your events into virtual ones and provide an embeded link or directed link and password of your online event to your attendees.
*	Author: Webnus
*	Version: 1.0.0
*	Text Domain: mec-virtual
*	Domain Path: /languages
*	Author URI: http://webnus.net
**/
namespace MEC_Virtual_Events;

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
 * Base.
 *
 * @author     author
 * @package     package
 * @since     1.0.0
 */
class Base {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     MEC_Virtual_Events
	 */
	public static $instance;

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.0.0
	 * @return  object
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	public function __construct() {
		self::settingUp();
		self::preLoad();
		self::setHooks($this);

		do_action( 'MEC_Virtual_Events_init' );
	}

	/**
	 * Global Variables.
	 *
	 * @since   1.0.0
	 */
	public static function settingUp() {
		define('MECVIRTUALVERSION' , '1.0.0');
		define('MECVIRTUALDIR' , plugin_dir_path(__FILE__));
		define('MECVIRTUALURL' , plugin_dir_url(__FILE__));
		define('MECVIRTUALDASSETS' , MECVIRTUALURL . '/assets/' );
		define('MECVIRTUALNAME' , 'Virtual Events');
		define('MECVIRTUALSLUG' , 'mec-virtual-events');
		define('MECVIRTUALOPTIONS' , 'mec_virtual_events_options');
		define('MECVIRTUALTEXTDOMAIN' , 'mec-virtual');

		if ( ! defined( 'DS' ) ) {
			define( 'DS', DIRECTORY_SEPARATOR );
		}
	}

	/**
	 * Set Hooks
	 *
	 * @since     1.0.0
	 */
	public static function setHooks($This) {
	}

	/**
	 * preLoad
	 *
	 * @since     1.0.0
	 */
	public static function preLoad() {
		include_once MECVIRTUALDIR . DS . 'core' . DS . 'autoloader.php';
	}

} //Base

Base::instance();
