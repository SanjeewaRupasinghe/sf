<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Form_Builder_Autoloader' ) ) :
	/**
	* MEC_Form_Builder_Autoloader.
	*
	* @author	  Webnus Team
	* @since	  1.0.0
	*/
	class MEC_Form_Builder_Autoloader extends MEC_Form_Builder {

		private static $files;
		/**
		* Instance of MEC_Form_Builder_Autoloader
		* @since   1.0.0
		*/
		private static $instance = null;
		private static $p = true;

		/**
		* The object is created from within the class itself
		* only if the class has no instance.
		* @since   1.0.0
		* @return	MEC_Form_Builder_Autoloader
		*/
		public static function get_instance()
		{
			if ( self::$instance === null )
			{
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		* Register a file to include
		*
		* @since     1.0.0
		*/
		public function register( $slug, $path, $filename, $type = 'require' )
		{
			self::$files[$slug][] = [
				'type'	=> $type,
				'path' => $path,
				'filename'	=> $filename,
			];

			return self::$files;
		}

		/**
		* Register multi file to include
		*
		* @since     1.0.0
		*/
		public static function multi_register( $files )
		{
			foreach ($files as $file) {
				self::$files[$file['slug']][] = [
					'type'	=> $file['type'],
					'path' => $file['path'],
					'filename'	=> $file['filename'],
				];
			}
			return self::$files;
		}

		 /**
		 * Description
		 *
		 * @since     1.0.0
		 */
		public static function run ($slug = 'all')
		{
			if (static::$p == false) {
				return;
			}

			$factory = MEC::getInstance('app.libraries.factory');
			if (!$factory->getPRO()) {
				add_action('admin_notices', function() {
					$MEC_Form_Builder = MEC_Form_Builder::get_instance();
					$MEC_Form_Builder->send_mec_pro_notice();
				});
				static::$p = false;
				return false;
			}

			switch ($slug) {
				case 'all': case '':
					$files = self::$files;
					break;
				default:					
					$files = [$slug => self::$files[$slug]];
					break;
			}

			if ( ! $files ) return;
			foreach ($files as $s_files) {
				foreach ($s_files as $file) {
					switch ( $file['type'] ) {
						case 'include':
							include ( realpath($file['path'] . DIRECTORY_SEPARATOR . $file['filename'] . '.php') );
							break;
						case 'include_once':
							include_once ( realpath($file['path'] . DIRECTORY_SEPARATOR . $file['filename'] . '.php') );
							break;
						case 'require':
							require ( realpath($file['path'] . DIRECTORY_SEPARATOR . $file['filename'] . '.php') );
							break;
						case 'require_once':
							require_once ( realpath($file['path'] . DIRECTORY_SEPARATOR . $file['filename'] . '.php') );
							break;
						default:
							require ( realpath($file['path'] . DIRECTORY_SEPARATOR . $file['filename'] . '.php') );
							break;
					}
				}
			}			
		}
	}
	MEC_Form_Builder_Autoloader::get_instance();
endif;