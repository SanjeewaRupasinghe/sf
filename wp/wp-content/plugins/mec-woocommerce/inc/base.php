<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Woocommerce_Base' ) ) {

	class MEC_Woocommerce_Base {

		/**
		* Is MEC activated?
		*
		* @since 1.0.0
		*/
		public static $is_mec_active = false;

		/**
		* Version of WooCommerce Integration
		*
		* @since 1.0.0
		*/
		public static $version;

		/**
		* Directory
		*
		* @since 1.0.0
		*/
		public static $dir;

		/**
		* Plugin url
		*
		* @since 1.0.0
		*/
		public static $url;

		/**
		* Plugin assets url
		*
		* @since 1.0.0
		*/
		public static $assets;

		/**
		* Instance of MEC_Woocommerce_Base
		*
		* @since 1.0.0
		*/
		private static $instance = null;

		/**
		* The object is created from within the class itself
		* only if the class has no instance.
		*
		* @since  1.0.0
		* @return MEC_Woocommerce_Base
		*/
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		* Construct
		*
		* @since 1.0.0
		*/
		public function __construct() {
			$this->definitions();
		}

		/**
		* Definitions
		*
		* @since 1.0.0
		*/
		public function definitions() {
			self::$version = '1.0.1';
			self::$dir     = MEC_Woocommerce::$dir;
			self::$url     = MEC_Woocommerce::$url;
			self::$assets  = MEC_Woocommerce::$assets;
		}

		/**
		* Is MEC installed ?
		*
		* @since     1.0.0
		*/
		public function is_mec_installed() {
			if(class_exists('\MEC')) {
				return true;
			}
			$file_path         = 'modern-events-calendar/mec.php';
			$installed_plugins = get_plugins();
			return isset( $installed_plugins[ $file_path ] );
		}

        /**
		* Is WooCommerce installed ?
		*
		* @since     1.0.0
		*/
		public function is_woocommerce_installed() {
			$file_path         = 'woocommerce/woocommerce.php';
			$installed_plugins = get_plugins();
			return isset( $installed_plugins[ $file_path ] );
		}

		/**
		* Required status checks
		*
		* @since 1.0.0
		*/
		public static function check_plugins() {

			$MEC_Woocommerce = self::get_instance();

			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			if (is_plugin_active('modern-events-calendar-lite/modern-events-calendar-lite.php') && !class_exists('\MEC')) {
				self::$is_mec_active = false;
				add_action('admin_notices', [$MEC_Woocommerce, 'send_mec_lite_notice']);
				return false;
			} else if ( ! is_plugin_active( 'modern-events-calendar/mec.php' ) && !class_exists('\MEC') ) {
				self::$is_mec_active = false;
				add_action( 'admin_notices', [ $MEC_Woocommerce, 'send_mec_notice' ] );

				if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
					add_action( 'admin_notices', [ $MEC_Woocommerce, 'send_woo_notice' ] );
					self::$is_mec_active = false;
					return false;
				}

				return false;

			} else {
				if(!defined('MEC_VERSION')) {
					$plugin_data = get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar/mec.php' ) );
					$version     = str_replace( '.', '', $plugin_data['Version'] );
				} else {
					$version = str_replace('.', '', MEC_VERSION);
				}

				if ( $version <= 422 ) {
					self::$is_mec_active = false;
					add_action( 'admin_notices', [ $MEC_Woocommerce, 'send_mec_version_notice' ], 'version' );

					if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
						add_action( 'admin_notices', [ $MEC_Woocommerce, 'send_woo_notice' ] );
						self::$is_mec_active = false;
						return false;
					}
					return false;
				}
			}

			if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				add_action( 'admin_notices', [ $MEC_Woocommerce, 'send_woo_notice' ] );
				self::$is_mec_active = false;
				return false;
			}
			return true;
        }

        /**
		* Send Admin Notice (MEC)
		*
		* @since 1.0.0
		*/
		public function send_mec_notice( $type = false ) {
			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}
			if(class_exists('\MEC')) {
				return;
			}

			$plugin = 'modern-events-calendar/mec.php';
			if ( $this->is_mec_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message        = '<p>' . __( 'WooCommerce Integration is not working because you need to activate the Modern Events Calendar plugin.', 'mec-woocommerce' ) . '</p>';
				$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Modern Events Calendar Now', 'mec-woocommerce' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = 'https://webnus.net/modern-events-calendar/';
				$message     = '<p>' . __( 'WooCommerce Integration is not working because you need to install the Modern Events Calendar plugin', 'mec-woocommerce' ) . '</p>';
				$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Modern Events Calendar Now', 'mec-woocommerce' ) ) . '</p>';
			}
			?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo $message; ?></p>
				</div>
			<?php
		}

		/**
		* Send Admin Notice (MEC Pro)
		*
		* @since 1.0.0
		*/
		public function send_mec_pro_notice( $type = false ) {
			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin = 'modern-events-calendar/mec.php';
			if ( $this->is_mec_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message        = '<p>' . __( 'In order to use the plugin, please Active Modern Events Calendar Pro.', 'mec-woocommerce' ) . '</p>';
				$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Modern Events Calendar Now', 'mec-woocommerce' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = 'https://webnus.net/pricing/#plugins';
				$message     = '<p>' . __( 'In order to use the plugin, please purchase Modern Events Calendar Pro.', 'mec-woocommerce' ) . '</p>';
				$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Purchase Modern Events Calendar Now', 'mec-woocommerce' ) ) . '</p>';
			}
			?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo $message; ?></p>
				</div>
			<?php
		}

		/**
		* Send Admin Notice (MEC Version)
		*
		* @since 1.0.0
		*/
		public function send_mec_version_notice( $type = false ) {
			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin = 'modern-events-calendar/mec.php';

			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar' ), 'install-plugin_' . $plugin );
			$message     = '<p>' . __( 'WooCommerce Integration is not working because you need to install latest version of Modern Events Calendar plugin', 'mec-woocommerce' ) . '</p>';
			$message    .= esc_html__( 'Minimum version required' ) . ': <b> 4.2.3 </b>';
			$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Update Modern Events Calendar Now', 'mec-woocommerce' ) ) . '</p>';

			?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo $message; ?></p>
				</div>
			<?php
		}

		/**
		* Send Admin Notice ( Woocommerce )
		*
		* @since 1.0.0
		*/
		public function send_woo_notice() {

			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}
			$plugin = 'woocommerce/woocommerce.php';
			if ( $this->is_woocommerce_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message        = '<p>' . __( 'WooCommerce Integration is not working because you need to activate the WooCommerce plugin.', 'mec-woocommerce' ) . '</p>';
				$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate WooCommerce Now', 'mec-woocommerce' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=WooCommerce' ), 'install-plugin_WooCommerce' );
				$message     = '<p>' . __( 'WooCommerce Integration is not working because you need to install the WooCommerce plugin', 'mec-woocommerce' ) . '</p>';
				$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install WooCommerce Now', 'mec-woocommerce' ) ) . '</p>';
			}
			?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo $message; ?></p>
				</div>
			<?php
		}

		/**
		* Send Admin Notice ( Woocommerce )
		*
		* @since 1.0.0
		*/
		public static function send_mec_lite_notice() {
			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin = 'modern-events-calendar/mec.php';

			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = 'https://webnus.net/modern-events-calendar/';
			$message     = '<p>' . __( 'WooCommerce Integration is not working because you need to install latest version of Modern Events Calendar plugin (PRO)', 'mec-woocommerce' ) . '</p>';
			$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Upgrade to Modern Events Calendar Pro', 'mec-woocommerce' ) ) . '</p>';

			?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo $message; ?></p>
				</div>
			<?php
        }
    }
}
