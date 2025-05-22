<?php

namespace MEC_Shortcodedesigner\Core\PostTypes;

// don't load directly.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * MecShortcodeDesigner.
 *
 * @author      author
 * @package     package
 * @since       1.0.0
 */
class MecShortcodeDesigner
{

    /**
     * Instance of this class.
     *
     * @since   1.0.0
     * @access  public
     * @var     MEC_Shortcodedesigner
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
        self::settingUp();
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
        add_action('init', [$This, 'postTypeInit'], 99);
        add_filter('single_template', [$This,'sd_addon_template']);
    }

    /**
     * Global Variables.
     *
     * @since   1.0.0
     */
    public static function settingUp()
    {
        self::$dir = MECSHORTCODEDESIGNERDIR . 'core' . DS . 'postTypes';
        self::$args = [
            'public'        => true,
            'rewrite'       => ['slug' => 'mec_designer'],
            'supports'      => ['title', 'editor'],
            'show_in_rest'  => true,
            'show_in_menu'  => true,
            'menu_icon'     => 'dashicons-art',
            'labels'        => [
                'name'                  => esc_html__( 'MEC Designer', 'mec-invoice' ),
                'all_items'             => esc_html__( 'All Designs', 'mec-invoice' ),
                'singular_name'         => esc_html__( 'Design', 'mec-invoice' ),
                'add_new'               => esc_html__( 'Add New', 'mec-invoice' ),
                'add_new_item'          => esc_html__( 'Add New Design', 'mec-invoice' ),
                'edit_item'             => esc_html__( 'Edit Design', 'mec-invoice' ),
                'new_item'              => esc_html__( 'New Design', 'mec-invoice' ),
                'view_item'             => esc_html__( 'View Design', 'mec-invoice' ),
                'search_items'          => esc_html__( 'Search Design', 'mec-invoice' ),
                'not_found'             => esc_html__( 'No Design found', 'mec-invoice' ),
                'not_found_in_trash'    => esc_html__( 'No Design found in Trash', 'mec-invoice' ),
                'show_in_rest'          => true,
            ],
        ];
    }

    /**
     * Post Type Init
     *
     * @since     1.0.0
     */
    public function postTypeInit () {
        register_post_type('mec_designer', self::$args);
    }

    /**
     * Single Template
     *
     * @since     1.0.0
     */
    public function sd_addon_template($single_template) {
        global $post;

        if ($post->post_type == 'mec_designer' ) {
            $single_template = dirname( __FILE__ ) . '/single-mec_designer.php';
        }
        return $single_template;
    
    }

    

    /**
     * Register Autoload Files
     *
     * @since     1.0.0
     */
    public function init()
    {
        if (!class_exists('\MEC_Shortcodedesigner\Autoloader')) {
            return;
        }
    }
} //MecShortcodeDesigner
