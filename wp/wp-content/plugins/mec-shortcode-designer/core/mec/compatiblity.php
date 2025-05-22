<?php

namespace MEC_Shortcodedesigner\Core\MEC_options;

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
 * MEC_options.
 *
 * @author     author
 * @package     package
 * @since     1.0.0
 */
class MEC_options {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     MEC_ShortcodeDesigner
	 **/
	public static $instance;

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
		self::setHooks( $this );
    }

	/**
	 * Set Hooks
	 *
	 * @since     1.0.0
	 **/
	public static function setHooks( $This ) {
		add_filter( 'mec_calendar_skins', [$This, 'set_skin'] );
		add_filter( 'mec_skin_options', [$This, 'set_skin_options'] );
        add_filter( 'mec_sf_options', [$This, 'set_search_options'] );
	}

	/**
	 * set skin.
	 *
	 * @since   1.0.0
	 **/
	public function set_skin( $skins ) {
		$skins['custom'] = __( 'Shortcode Designer', 'mec-shortcode-designer' );
		return $skins;
	}

	/**
	 * set skin options.
	 *
	 * @since   1.0.0
	 **/
	public function set_skin_options( $sk_options ) { 
        include_once('skin_options.php');
	}

	/**
	 * set search options.
	 *
	 * @since   1.0.0
	 **/
	public function set_search_options( $sf_options ) { 
		include_once('search_options.php');
	}

} //MEC_options

MEC_options::instance();
