<?php
/**
 * Plugin Name: Elementor Shortcode Designer
 * Plugin URI: http://webnus.net/modern-events-calendar/
 * Description: This plugin makes it possible to visually build MEC shortcodes in Elementor.
 * Author: Webnus
 * Version: 1.2.2
 * Text Domain: mec-shortcode-designer
 * Domain Path: /languages
 * Author URI: http://webnus.net
 **/

namespace MEC_ShortcodeDesigner;

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
		self::settingUp();
		self::preLoad();
		self::setHooks( $this );

		do_action( 'MEC_ShortcodeDesigner_init' );
	}

	/**
	 * Global Variables.
	 *
	 * @since   1.0.0
	 **/
	public static function settingUp() {
		self::install();
		define( 'MECSHORTCODEDESIGNERVERSION', '1.2.2' );
		define( 'MECSHORTCODEDESIGNERDIR', plugin_dir_path( __FILE__ ) );
		define( 'MECSHORTCODEDESIGNERURL', plugin_dir_url( __FILE__ ) );
		define( 'MECSHORTCODEDESIGNERDASSETS', MECSHORTCODEDESIGNERURL . 'assets/' );
		define( 'MECSHORTCODEDESIGNERNAME' , 'Elementor Shortcode Designer');
		define( 'MECSHORTCODEDESIGNERSLUG' , 'mec-shortcode-designer');
		define( 'MECSHORTCODEDESIGNEROPTIONS' , 'mec_shortcode_designer_options');
		define( 'MECSHORTCODEDESIGNERTEXTDOMAIN' , 'mec-shortcode-designer');
		define( 'MECSHORTCODEDESIGNERABSPATH',dirname(__FILE__) );

		if ( ! defined( 'DS' ) ) {
			define( 'DS', DIRECTORY_SEPARATOR );
		}
	}

	/**
	 * Set Hooks
	 *
	 * @since     1.0.0
	 **/
	public static function setHooks( $This ) {
		add_action( 'admin_notices', [ $This, 'installation_notice' ] );
		add_action( 'admin_notices', [ $This, 'send_elementor_notice' ] );
		add_action( 'admin_notices', [ $This, 'send_mec_notice' ] );
		add_action( 'admin_enqueue_scripts', [ $This, 'admin_scripts' ], 99 );
		add_action( 'plugins_loaded', [ $This, 'load_textdomain' ] );
		add_action('elementor/editor/after_enqueue_styles', [$This, 'editor_styles']);

		// Theme Builder Integration
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
			add_filter('template_include', function($original){
				$mainClass = new \MEC_main();
				$PT = $mainClass->get_main_post_type();
				$baseClass = new \MEC_parser();
				$file = $baseClass->getFile();
				if(is_post_type_archive($PT) && !is_search())
				{
					$template = locate_template('archive-'.$PT.'.php');
					if($template == '')
					{
						$wp_template = get_template();
						$wp_stylesheet = get_stylesheet();
						
						$wp_template_file = MECSHORTCODEDESIGNERABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'archive-mec-events.php';
						$wp_stylesheet_file = MECSHORTCODEDESIGNERABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'childs'.DS.$wp_stylesheet.DS.'archive-mec-events.php';
						
						if($file->exists($wp_stylesheet_file)) $template = $wp_stylesheet_file;
						elseif($file->exists($wp_template_file)) $template = $wp_template_file;
						else $template = MECSHORTCODEDESIGNERABSPATH.DS.'templates'.DS.'archive-mec-events.php';
						return $template;
					}
				}
				elseif(is_tax('mec_category'))
				{
					$template = locate_template('taxonomy-mec-category.php');
					if($template == '')
					{
						$wp_template = get_template();
						$wp_stylesheet = get_stylesheet();
						
						$wp_template_file = MECSHORTCODEDESIGNERABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'taxonomy-mec-category.php';
						$wp_stylesheet_file = MECSHORTCODEDESIGNERABSPATH.DS.'templates'.DS.'themes'.DS.$wp_template.DS.'childs'.DS.$wp_stylesheet.DS.'taxonomy-mec-category.php';
						
						if($file->exists($wp_stylesheet_file)) $template = $wp_stylesheet_file;
						elseif($file->exists($wp_template_file)) $template = $wp_template_file;
						else $template = MECSHORTCODEDESIGNERABSPATH.DS.'templates'.DS.'taxonomy-mec-category.php';
						return $template;
					}
				}
				return $original;
			}, 99999999999);
		}
	}

	/**
	 * preLoad
	 *
	 * @since     1.0.0
	 **/
	public static function preLoad() {
		include_once MECSHORTCODEDESIGNERDIR . DS . 'core' . DS . 'autoloader.php';
		include_once __DIR__ . '/includes/functions.php';
	}

	/**
	* Load Textdomain
	*
	* @since     1.0.0
	**/
	public function load_textdomain() {
		load_plugin_textdomain( 'mec-shortcode-designer', false, MECSHORTCODEDESIGNERDIR . '/languages' );
	}

	/**
	 * Admin scripts.
	 *
	 * @since   1.0.0
	 **/
	public function admin_scripts() {
		wp_enqueue_style( 'mec-shortcode-designer-admin', MECSHORTCODEDESIGNERDASSETS . 'css/backend/admin.css', null, MECSHORTCODEDESIGNERVERSION, 'all' );
	}

	/**
     * Elementor widgets style
     *
     * @since     1.0.0
     */
    public function editor_styles()
	{
		if ( get_post_type(get_the_ID()) == 'mec_designer' ) {
			wp_enqueue_style('editor-form-builder', MECSHORTCODEDESIGNERDASSETS . 'css/backend/editor-elementor.css', [], '');
		} 
	}

	/**
	 * install.
	 *
	 * @since   1.0.0
	 **/
	public static function install() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
			return;
		}
	}

	/**
	 * Is MEC installed
	 *
	 * @since     1.0.0
	 */
	public static function is_mec_installed() {
		$mec_pro			= 'modern-events-calendar/mec.php';
		$mec_lite			= 'modern-events-calendar-lite/modern-events-calendar-lite.php';
		$installed_plugins 	= get_plugins();
		if ( isset( $installed_plugins[ $mec_pro ] ) ) {
			return 'pro';
		} elseif ( isset( $installed_plugins[ $mec_lite ] ) )  {
			return 'lite';
		} else {
			return 'no-installed';
		}
	}


	/**
	 * Check MEC version
	 *
	 * @since     1.0.0
	 */
	public static function send_mec_notice() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$mec_pro			= 'modern-events-calendar/mec.php';
		$mec_lite			= 'modern-events-calendar-lite/modern-events-calendar-lite.php';
		$installed_plugins 	= get_plugins();
		if ( isset( $installed_plugins[ $mec_pro ] ) ) {
			$pro_data = get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar/mec.php' ) );
		} elseif ( isset( $installed_plugins[ $mec_lite ] ) )  {
			$lite_data = get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar-lite/modern-events-calendar-lite.php' ) );
		}

		if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
			if ( self::is_mec_installed() == 'pro' ) {
				$pro_version     = str_replace( '.', '', $pro_data['Version'] );
				if ( $pro_version < 500 ) {
					$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar' ), 'install-plugin_' . $mec_pro );
					$message  = '<div><p>' . __( 'Elementor Shortcode Designer is not working because you need to install latest version of Modern Events Calendar Pro plugin - Minimum version required', 'mec-shortcode-designer' ) . ': <b> 5.0.0 </b> </p>';
					$message  .= '<p class="mec-shortcode-designer-notice is-dismissible">' . sprintf( '<a href="%s">%s</a>', $install_url, __( 'Update Modern Events Calendar Pro Now', 'mec-shortcode-designer' ) ) . '</p></div>';
				} else {
					$message = null;
				}
			}
			if ( self::is_mec_installed() == 'lite' ) {
				$lite_version     = str_replace( '.', '', $lite_data['Version'] );
				if ( $lite_version < 500 ) {
					$install_url = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=modern-events-calendar-lite%2Fmodern-events-calendar-lite.php' ), 'install-plugin_' . $mec_lite );
					$message  = '<div><p>' . __( 'Elementor Shortcode Designer is not working because you need to install latest version of Modern Events Calendar Lite plugin - Minimum version required', 'mec-shortcode-designer' ) . ': <b> 5.0.0 </b> </p>';
					$message  .= '<p class="mec-shortcode-designer-notice is-dismissible">' . sprintf( '<a href="%s">%s</a>', $install_url, __( 'Update Modern Events Calendar Lite Now', 'mec-shortcode-designer' ) ) . '</p></div>';
				} else {
					$message = null;
				}
			}
			if ( self::is_mec_installed() == 'pro'  && $pro_version < 500 || self::is_mec_installed() == 'lite' && $lite_version < 500) {
				$pro_version     = str_replace( '.', '', $pro_data['Version'] );
				$lite_version     = str_replace( '.', '', $lite_data['Version'] );
				?>
					<div class="notice notice-error is-dismissible">
					<p><?php echo $message; ?></p>
					</div>
				<?php
			} else {
				echo null;
			}
		} else {
			echo null;
		}
	}

	/**
	 * installation notice.
	 *
	 * @since   1.0.0
	 **/
	public static function installation_notice() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( is_plugin_active( 'modern-events-calendar/mec.php' ) || is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
			return;
		}
		$mec_lite = wp_nonce_url(
			add_query_arg(
				[
					'action' => 'install-plugin',
					'plugin' => 'modern-events-calendar-lite',
				],
				admin_url( 'update.php' )
			),
			'install-plugin_modern-events-calendar-lite'
		);
		$out      = '
		<div id="message" class="mec-shortcode-designer-notice error notice is-dismissible">
			<p> ' . esc_html_x( 'Before install the "Shortcode Designer". Please first install the "Modern Events Calendar".', 'Installation notice', 'mec-shortcode-designer' ) . ' </p>
			<p>
			<a href="' . esc_url( $mec_lite ) . '">' . esc_html__( 'Free version', 'mec-shortcode-designer' ) . '</a>
			<a href="' . esc_url( 'https://webnus.net/modern-events-calendar' ) . '" target="_blank">' . esc_html__( 'Pro version', 'mec-shortcode-designer' ) . '</a>
			</p>
			<button type="button" class="notice-dismiss"> <span class="screen-reader-text">Dismiss this notice.</span> </button>
		</div>';
		echo $out;
	}

	/**
	 * Is elementor installed ?
	 *
	 * @since     1.0.0
	 */
	public function is_elementor_installed() {
		$elementro_path         = 'elementor/elementor.php';
		$installed_plugins 		= get_plugins();
		return isset( $installed_plugins[ $elementro_path ] );
	}

	/**
	 * Send Admin Notice ( Elementor )
	 *
	 * @since 1.0.0
	 */
	public function send_elementor_notice() {
		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}
		$plugin = 'elementor/elementor.php';
		if ( ! is_plugin_active( $plugin ) ) {
			if ( $this->is_elementor_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message        = '<p class="mec-shortcode-designer-notice is-dismissible">' . __( 'Elementor Shortcode Designer is not working because you need to activate the Elementor plugin.', 'mec-shortcode-designer' ) . ' ' . sprintf( '<a href="%s">%s</a>', $activation_url, __( 'Activate Elementor Now', 'mec-shortcode-designer' ) ) . '</p>';
				$message       .= '';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$message     = '<p class="mec-shortcode-designer-notice is-dismissible">' . __( 'Elementor Shortcode Designer is not working because you need to install the Elemenor plugin', 'mec-shortcode-designer' ) . ' ' . sprintf( '<a href="%s">%s</a>', $install_url, __( 'Install Elementor Now', 'mec-shortcode-designer' ) ) . '</p>';
				$message    .= '';
			}
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo $message; ?></p>
			</div>
			<?php
		}
	}

} //Base

Base::instance();
