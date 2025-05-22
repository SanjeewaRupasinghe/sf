<?php

namespace MEC_Virtual_Events\Core;
// don't load directly.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}
/**
 * Loader.
 *
 * @author      author
 * @package     package
 * @since       1.0.0
 */
class Loader
{

    /**
     * Instance of this class.
     *
     * @since   1.0.0
     * @access  public
     * @var     MEC_Invoice
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
     */
    public static function settingUp()
    {
        self::$dir     = MECVIRTUALDIR . 'core';
    }

    /**
     * Hooks
     *
     * @since     1.0.0
     */
    public static function setHooks()
    { 
        add_action('admin_init', function () {
            \MEC_Virtual_Events\Autoloader::load('MEC_Virtual_Events\Core\checkLicense\AddonSetOptions');
            \MEC_Virtual_Events\Autoloader::load('MEC_Virtual_Events\Core\checkLicense\AddonCheckActivation');
        });
    }

    /**
     * preLoad
     *
     * @since     1.0.0
     */
    public static function preLoad()
    {
        include_once self::$dir . DS . 'autoloader' . DS . 'autoloader.php';
    }

    /**
     * Register Autoload Files
     *
     * @since     1.0.0
     */
    public static function registerAutoloadFiles()
    {
        if (!class_exists('\MEC_Virtual_Events\Autoloader')) {
            return;
        }

        \MEC_Virtual_Events\Autoloader::addClasses(
            [
                'MEC_Virtual_Events\\Core\\addEventOptions\\MecAddEventOptions' => self::$dir . '/addEventOptions/add-event-options.php',
                'MEC_Virtual_Events\\Core\\checkLicense\\AddonSetOptions' => self::$dir . '/checkLicense/set-options.php',
                'MEC_Virtual_Events\\Core\\checkLicense\\AddonCheckActivation' => self::$dir . '/checkLicense/check-activation.php',
                'MEC_Virtual_Events\\Core\\checkLicense\\AddonLicense' => self::$dir . '/checkLicense/get-license.php',
            ]
        );
    }

    /**
     * Load Init
     *
     * @since     1.0.0
     */
    public static function loadInits()
    {
        \MEC_Virtual_Events\Autoloader::load('MEC_Virtual_Events\Core\addEventOptions\MecAddEventOptions');
    }
} //Loader

Loader::instance();
