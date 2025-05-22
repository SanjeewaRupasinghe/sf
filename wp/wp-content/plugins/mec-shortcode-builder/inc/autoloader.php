<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MEC_Shortcode_Builder_Autoloader' ) ) :
	/**
	* MEC_Shortcode_Builder_Autoloader.
	*
	* @author	  Webnus Team
	* @since	  1.0.0
	*/
	class MEC_Shortcode_Builder_Autoloader extends MEC_Shortcode_Builder_Base {

		private static $files;
		/**
		* Instance of MEC_Shortcode_Builder_Autoloader
		* @since   1.0.0
		*/
		private static $instance = null;

		/**
		* The object is created from within the class itself
		* only if the class has no instance.
		* @since   1.0.0
		* @return	MEC_Shortcode_Builder_Autoloader
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
			switch ($slug) {
				case 'all': case '':
					$files = self::$files;
					break;
				default:
					$files = [$slug => self::$files[$slug]];
					break;
			}

			if ( !is_array($files) )
				return;
				
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
	MEC_Shortcode_Builder_Autoloader::get_instance();
endif;

?>