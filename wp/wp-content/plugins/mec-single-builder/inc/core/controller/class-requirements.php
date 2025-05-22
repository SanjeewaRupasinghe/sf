<?php
namespace MEC_Single_Builder\Inc\Core\Controller;
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
class Requirements {

	public static $message = '';

	public static $mec_run = 'false';

	public function __construct() {

		add_action( 'admin_init', [ $this , 'check_plugins' ]  , 10);
		add_action( 'admin_init', [ $this , 'run_codes' ]  , 99);

	}

	/**
	 * Check requirement plugins
	 *
	 * @since     1.0.0
	 */
	public function check_plugins()
	{

		if ( !function_exists('get_current_screen') ) require_once ABSPATH . 'wp-admin/includes/screen.php';
		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		self::check_mec();
		self::check_elementor();
		if ( empty(self::$message)) self::$mec_run = 'true';
		echo self::$message;

	}


	/**
	 * Run codes
	 *
	 * @since     1.0.0
	 */
	public function run_codes()
	{
		$options = get_option(NS\PLUGIN_OPTIONS);
		if ( defined('MEC_API_URL') )
		{
            new ESBAddonUpdateActivation();
		}

	}
	

	/**
	 * Is elementor installed
	 *
	 * @since     1.0.0
	 */
	public static function is_elementor_installed()
	{

		$file_path         = 'elementor/elementor.php';
		$installed_plugins = get_plugins();
		return isset( $installed_plugins[ $file_path ] );
		
	}

	/**
	 * Is MEC installed
	 *
	 * @since     1.0.0
	 */
	public static function is_mec_installed()
	{

		$file_path         = 'modern-events-calendar/mec.php';
		$file_path_lite    = 'modern-events-calendar-lite/modern-events-calendar-lite.php';
		$installed_plugins = get_plugins();
		if ( isset( $installed_plugins[ $file_path ] ) ) {
			return 'pro';
		} elseif ( isset( $installed_plugins[ $file_path_lite ] ) )  {
			return 'lite';
		}

	}

	/**
	 * Check MEC version
	 *
	 * @since     1.0.0
	 */
	public static function check_mec_version()
	{

		$plugin = 'modern-events-calendar/mec.php';
		$plugin_lite = 'modern-events-calendar-lite/modern-events-calendar-lite.php';

		if ( self::is_mec_installed() == 'pro' ) {
			$plugin_data = get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar/mec.php' ) );
			$version     = str_replace( '.', '', $plugin_data['Version'] );
			if ( $version <= 431 ) {
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar' ), 'install-plugin_' . $plugin );
				self::$message  .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to install latest version of Modern Events Calendar plugin', 'mec-single-builder' ) . '</p>';
				self::$message  .= esc_html__( 'Minimum version required' ) . ': <b> 4.3.1 </b>';
				self::$message  .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Update Modern Events Calendar Now', 'mec-single-builder' ) ) . '</p></div>';
			}
		} elseif ( self::is_mec_installed() == 'lite' ) { 
			$plugin_data = get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar-lite/modern-events-calendar-lite.php' ) );
			$version     = str_replace( '.', '', $plugin_data['Version'] );
			if ( $version <= 431 ) {
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar' ), 'install-plugin_' . $plugin_lite );
				self::$message  .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to install latest version of Modern Events Calendar Lite plugin', 'mec-single-builder' ) . '</p>';
				self::$message  .= esc_html__( 'Minimum version required' ) . ': <b> 4.3.1 </b>';
				self::$message  .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Update Modern Events Calendar Lite Now', 'mec-single-builder' ) ) . '</p></div>';
			} 
		}

	} 

	/**
	 * MEC Notice
	 *
	 * @since     1.0.0
	 *
	 */
	public static function check_mec()
	{
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin = 'modern-events-calendar/mec.php';
		$plugin_lite = 'modern-events-calendar-lite/modern-events-calendar-lite.php';
		if ( self::is_mec_installed() != 'lite' && self::is_mec_installed() != 'pro' ) {
			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar-lite' ), 'install-plugin_modern-events-calendar-lite' );
			self::$message .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to install the Modern Events Calendar Lite plugin', 'mec-single-builder' ) . '</p>';
			self::$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Modern Events Calendar Lite Now', 'mec-single-builder' ) ) . '</p></div>';
		} elseif ( self::is_mec_installed() != 'lite' && self::is_mec_installed() == 'pro' && !is_plugin_active( $plugin ) && is_plugin_active( $plugin_lite ) )	{
			self::check_mec_version();
		} elseif ( self::is_mec_installed() != 'lite' && self::is_mec_installed() == 'pro' && !is_plugin_active( $plugin ) && !is_plugin_active( $plugin_lite )  )	{
			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
			self::$message  .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to activate the Modern Events Calendar plugin.', 'mec-single-builder' ) . '</p>';
			self::$message  .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Modern Events Calendar Now', 'mec-single-builder' ) ) . '</p></div>';
			self::check_mec_version();
		} elseif ( self::is_mec_installed() == 'lite' && self::is_mec_installed() != 'pro' &&  !is_plugin_active( $plugin_lite ) ) {
			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin_lite . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin_lite );
			self::$message  .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to activate the Modern Events Calendar Lite plugin.', 'mec-single-builder' ) . '</p>';
			self::$message  .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Modern Events Calendar Lite Now', 'mec-single-builder' ) ) . '</p></div>';
			self::check_mec_version();
		}
		

		if ( is_plugin_active( $plugin ) ||  is_plugin_active( $plugin_lite ) ) {
			self::check_mec_version();
		}

	}

	/**
	 * Elementor Notice
	 *
	 * @since     1.0.0
	 *
	 */
	public static function check_elementor()
	{

		$plugin = 'elementor/elementor.php';
		if ( ! is_plugin_active( $plugin ) ) {
			if ( self::is_elementor_installed() ) {
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				self::$message .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to activate the Elementor plugin.', 'mec-single-builder' ) . '</p>';
				self::$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'mec-single-builder' ) ) . '</p></div>';
			} else {
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				self::$message .= '<div class="notice notice-error is-dismissible"><p>' . __( NS\PLUGIN_ORG_NAME . ' is not working because you need to install the Elemenor plugin', 'mec-single-builder' ) . '</p>';
				self::$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'mec-single-builder' ) ) . '</p></div>';
			}
		}

	}

}