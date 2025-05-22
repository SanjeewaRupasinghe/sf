<?php

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Shortcode_Builder_Base' ) ) {

	class MEC_Shortcode_Builder_Base {

		/**
		 * Is MEC activated?
		 *
		 * @since   1.0.0
		 */
		public static $is_mec_active = false;

		/**
		 * Is MEC activated?
		 *
		 * @since   1.0.0
		 */
		public static $is_elementor_active = false;

		/**
		 * Version of MEC Shortcode Builder
		 *
		 * @since   1.0.0
		 */
		public static $version;

		/**
		 * Directory
		 *
		 * @since   1.0.0
		 */
		public static $dir;

		/**
		 * Plugin url
		 *
		 * @since   1.0.0
		 */
		public static $url;

		/**
		 * Plugin assets url
		 *
		 * @since   1.0.0
		 */
		public static $assets;

		/**
		 * Instance of MEC_Shortcode_Builder_Base
		 *
		 * @since   1.0.0
		 */
		private static $instance = null;

		/**
		 * The object is created from within the class itself
		 * only if the class has no instance.
		 *
		 * @since   1.0.0
		 * @return   MEC_Shortcode_Builder_Base
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
		 * @since     1.0.0
		 */
		public function __construct() {
			$this->definitions();
			$this->actions();
		}

		/**
		 * Actions
		 *
		 * @since     1.0.0
		 */
		public function actions()
		{
			add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
		}

		/**
		 * Enqueue Styles
		 *
		 * @since     1.0.0
		 */
		public function enqueue_styles()
		{
			if(is_post_type_archive('mec-events') && !is_search()) {
				$render	= MEC::getInstance('app.libraries.render');
				if($render->settings['default_skin_archive'] != 'custom') {
					return;
				}
				$shortcode_id = $render->settings['custom_archive'];
				$shortcode_id = preg_replace('/.*id=\"(.*?)\".*/', '$1', $shortcode_id);

				if(!$shortcode_id) {
					return;
				}
				if (class_exists('\Elementor\Core\Files\CSS\Post')) {
					$css_file = new \Elementor\Core\Files\CSS\Post($shortcode_id);
				} elseif (class_exists('\Elementor\Post_CSS_File')) {
					$css_file = new \Elementor\Post_CSS_File($shortcode_id);
				}
				$css_file->enqueue();

			}
		}


		/**
		 * Definitions
		 *
		 * @since     1.0.0
		 */
		public function definitions() {
			self::$version = MEC_Shortcode_Builder::$version;
			self::$dir     = MEC_Shortcode_Builder::$dir;
			self::$url     = MEC_Shortcode_Builder::$url;
			self::$assets  = MEC_Shortcode_Builder::$assets;
		}

		/**
		 * Check MEC is active
		 *
		 * @since 1.0.0
		 */
		public static function check_plugins() {
			$MEC_shortcode_builder_Base = self::get_instance();
			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			if ( self::is_mec_installed() == 'pro' && ! is_plugin_active( 'modern-events-calendar/mec.php' ) ) {
				self::$is_mec_active = false;
				add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_mec_notice' ] );

				if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
					add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_elementor_notice' ] );
					self::$is_mec_active = false;
				}

				return false;
			} elseif ( self::is_mec_installed() == 'lite' &&  ! is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ) {
				self::$is_mec_active = false;
				add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_mec_lite_notice' ] );

				if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
					add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_elementor_notice' ] );
					self::$is_mec_active = false;
				}

				return false;
			}

			if ( self::is_mec_installed() == 'lite' && is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) ){
				$plugin_data_lite 	= get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar-lite/modern-events-calendar-lite.php' ) );
				$version_lite   = str_replace( '.', '', $plugin_data_lite['Version'] );

				if ( $version_lite < 423 ) {
					self::$is_mec_active = false;
					add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_mec_version_notice' ], 'version' );

					if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
						add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_elementor_notice' ] );
						self::$is_mec_active = false;
						return false;
					}
					return false;
				}
			}

			if ( self::is_mec_installed() == 'pro' && is_plugin_active( 'modern-events-calendar/mec.php' ) ){
				$plugin_data 	= get_plugin_data( realpath( WP_PLUGIN_DIR . '/modern-events-calendar/mec.php' ) );
				$version   = str_replace( '.', '', $plugin_data['Version'] );

				if ( $version < 423 ) {
					self::$is_mec_active = false;
					add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_mec_version_notice' ], 'version' );

					if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
						add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_elementor_notice' ] );
						self::$is_mec_active = false;
						return false;
					}
					return false;
				}
			}

			if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
				add_action( 'admin_notices', [ $MEC_shortcode_builder_Base, 'send_elementor_notice' ] );
				self::$is_mec_active = false;
				return false;
			}
			self::$is_mec_active = true;
			return true;
		}

		/**
		 * Is MEC installed ?
		 *
		 * @since     1.0.0
		 */
		public static function is_mec_installed() {
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
		 * Send Admin Notice (MEC)
		 *
		 * @since 1.0.0
		 */
		public function send_mec_notice( $type = false ) {
			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin_pro = 'modern-events-calendar/mec.php';
			if ( $this->is_mec_installed() == 'pro' ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin_pro . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin_pro );
				$message        = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to activate the Modern Events Calendar plugin.', 'mec-shortcode-builder' ) . '</p>';
				$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Modern Events Calendar Now', 'mec-shortcode-builder' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = 'https://webnus.net/modern-events-calendar/';
				$message     = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to install the Modern Events Calendar plugin', 'mec-shortcode-builder' ) . '</p>';
				$message    .= '<p>' . sprintf( '<a href="%s" target="_blank" class="button-primary">%s</a>', $install_url, __( 'Install Modern Events Calendar Now', 'mec-shortcode-builder' ) ) . '</p>';
			}

			?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo $message; ?></p>
			</div>
			<?php
		}


		public function send_mec_lite_notice( $type = false ) {
			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin_lite = 'modern-events-calendar-lite/modern-events-calendar-lite.php';
			if (  $this->is_mec_installed() == 'lite' ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin_lite . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin_lite );
				$message        = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to activate the Modern Events Calendar Lite plugin.', 'mec-shortcode-builder' ) . '</p>';
				$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Modern Events Calendar Lite Now', 'mec-shortcode-builder' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar-lite' ), 'install-plugin_modern-events-calendar-lite' );
				$message     = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to install the Modern Events Calendar Lite plugin', 'mec-shortcode-builder' ) . '</p>';
				$message    .= '<p>' . sprintf( '<a href="%s" target="_blank" class="button-primary">%s</a>', $install_url, __( 'Install Modern Events Calendar Lite Now', 'mec-shortcode-builder' ) ) . '</p>';
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
			$plugin_lite = 'modern-events-calendar-lite/modern-events-calendar-lite.php';

			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			if ( $this->is_mec_installed() == 'pro' ) {
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar' ), 'install-plugin_' . $plugin );
				$message     = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to install latest version of Modern Events Calendar plugin', 'mec-shortcode-builder' ) . '</p>';
				$message    .= esc_html__( 'Minimum version required' ) . ': <b> 4.2.3 </b>';
				$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Update Modern Events Calendar Now', 'mec-shortcode-builder' ) ) . '</p>';
			}
			if ( $this->is_mec_installed() == 'lite' ) {
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=modern-events-calendar' ), 'install-plugin_' . $plugin_lite );
				$message     = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to install latest version of Modern Events Calendar plugin', 'mec-shortcode-builder' ) . '</p>';
				$message    .= esc_html__( 'Minimum version required' ) . ': <b> 4.2.3 </b>';
				$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Update Modern Events Calendar Now', 'mec-shortcode-builder' ) ) . '</p>';
			}
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo $message; ?></p>
			</div>
			<?php
		}

		/**
		 * Is elementor installed ?
		 *
		 * @since     1.0.0
		 */
		public function is_elementor_installed() {
			$file_path         = 'elementor/elementor.php';
			$installed_plugins = get_plugins();
			return isset( $installed_plugins[ $file_path ] );
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
			if ( $this->is_elementor_installed() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message        = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to activate the Elementor plugin.', 'mec-shortcode-builder' ) . '</p>';
				$message       .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'mec-shortcode-builder' ) ) . '</p>';
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$message     = '<p>' . __( 'Elementor Shortcode Builder is not working because you need to install the Elemenor plugin', 'mec-shortcode-builder' ) . '</p>';
				$message    .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'mec-shortcode-builder' ) ) . '</p>';
			}
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo $message; ?></p>
			</div>
			<?php
		}
	}
	\MEC_Shortcode_Builder_Base::get_instance();
}
