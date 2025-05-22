<?php

namespace MEC_ShortcodeDesigner\Core;

use MEC_ShortcodeDesigner\Autoloader;

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
 * Loader.
 *
 * @author      Webnus
 * @package     Mec Shortcode Builder
 * @since       1.0.0
 */
class Loader {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     MEC_ShortcodeDesigner
	 **/
	public static $instance;

	/**
	 * The directory of the file.
	 *
	 * @access  public
	 * @var     string
	 **/
	public static $dir;

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.0.0
	 * @return  object
	 **/
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	public function __construct() {
		self::settingUp();
		self::preLoad();
		self::setHooks();
		self::registerAutoloadFiles();
		self::loadInits();
	}

	/**
	 * Global Variables.
	 *
	 * @since   1.0.0
	 **/
	public static function settingUp() {
		self::$dir = MECSHORTCODEDESIGNERDIR . 'core';
	}

	/**
	 * Hooks
	 *
	 * @since     1.0.0
	 **/
	public static function setHooks(){
		add_action('admin_init', function () {
            \MEC_ShortcodeDesigner\Autoloader::load('MEC_ShortcodeDesigner\Core\checkLicense\AddonSetOptions');
            \MEC_ShortcodeDesigner\Autoloader::load('MEC_ShortcodeDesigner\Core\checkLicense\AddonCheckActivation');
        });
	}

	/**
	 * preLoad
	 *
	 * @since     1.0.0
	 **/
	public static function preLoad() {
		include_once self::$dir . DS . 'autoloader' . DS . 'autoloader.php';
	}

	/**
	 * Register Autoload Files
	 *
	 * @since     1.0.0
	 **/
	public static function registerAutoloadFiles() {
		if ( ! class_exists( '\MEC_ShortcodeDesigner\Autoloader' ) ) {
			return;
		}
		Autoloader::addClasses(
			[
				'MEC_ShortcodeDesigner\\Core\\PostTypes\\MecShortcodeDesigner'                      => self::$dir . '/postTypes/mec-shortcode-designer.php',
				'MEC_ShortcodeDesigner\\Core\\elementor\\Shortcode_Designer_Elementor'              => self::$dir . '/elementor/configuration.php',
				'MEC_ShortcodeDesigner\\Core\\elementor\\Shortcode_Designer_Elementor_Functions'    => self::$dir . '/elementor/functions.php',
				'MEC_ShortcodeDesigner\\Core\\Mec\\MEC_options'                                     => self::$dir . '/mec/compatiblity.php',
				'MEC_ShortcodeDesigner\\Core\\checkLicense\\AddonSetOptions' 						=> self::$dir . '/checkLicense/set-options.php',
                'MEC_ShortcodeDesigner\\Core\\checkLicense\\AddonCheckActivation' 					=> self::$dir . '/checkLicense/check-activation.php',
                'MEC_ShortcodeDesigner\\Core\\checkLicense\\AddonLicense' 							=> self::$dir . '/checkLicense/get-license.php',
				'MEC_ShortcodeDesigner\\Core\\EventsDateTimes' 										=> self::$dir . '/EventsDateTimes.php',
			]
		);
	}

	/**
	 * Load Init
	 *
	 * @since     1.0.0
	 */
	public static function loadInits() {
		Autoloader::load( 'MEC_ShortcodeDesigner\Core\PostTypes\MecShortcodeDesigner' );
		Autoloader::load( 'MEC_ShortcodeDesigner\Core\elementor\Shortcode_Designer_Elementor' );
		Autoloader::load( 'MEC_ShortcodeDesigner\Core\mec\MEC_options' );
	}

} //Loader

Loader::instance();
