<?php
/** no direct access **/
defined( 'MECEXEC' ) or die();

/**
 * Webnus MEC forms class.
 *
 * @author Webnus <info@webnus.biz>
 */
class MEC_feature_forms extends MEC_base {

	public $factory;
	public $main;
	public $db;
	public $book;
	public $PT;
	public $settings;

	/**
	 * Constructor method
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public function __construct() {
		 // Import MEC Factory
		$this->factory = $this->getFactory();

		// Import MEC Main
		$this->main = $this->getMain();

		// Import MEC DB
		$this->db = $this->getDB();

		// Import MEC Book
		$this->book = $this->getBook();

		// MEC Book Post Type Name
		$this->PT = $this->main->get_book_post_type();

		// MEC Settings
		$this->settings = $this->main->get_settings();
	}

	/**
	 * Initialize books feature
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public function init() {
		// PRO Version is required
		if ( ! $this->getPRO() ) {
			return false;
		}

		$this->factory->action( 'after_mec_submenu_action', array( $this, 'form_builder_menu' ) );
		$this->factory->action( 'mec_register_post_type', array( $this, 'register_post_type' ) );
		$this->factory->filter( 'manage_mec_form_posts_columns', array( $this, 'customize_cols' ) , 10 , 1 );
		$this->factory->action( 'manage_mec_form_posts_custom_column', array( $this, 'manage_cols' ) , 10 , 2);
		// $this->factory->action( 'init', array( $this, 'single_preview' ) );
		$this->factory->filter( 'single_template', array( $this, 'single_preview' ), 99, 1 );
		return true;
	}

	/**
	** Manage Columns
	**
	** @since     1.0.0
	*/
	public static function manage_cols ($column, $post_id) {
		if($column == 'custom_title') {
			echo '<a class="row-title" href="'.get_edit_post_link($post_id).'" aria-label="“'.get_the_title($post_id).'” (Edit)">'. get_the_title($post_id).'</a>';
		}
	}

	/**
	** Customize Columns
	**
	** @since     1.0.0
	*/
	public static function customize_cols ($columns) {
		$columns = ['cb' => '<input type="checkbox">', 'custom_title' => __('Form Name', 'mec-form-builder')] + $columns;
		unset($columns['title']);
		return $columns;
	}


	/**
	 * Single Template
	 *
	 * @since   1.0.0
	 */
	public function single_preview( $template ) {
		global $post;

		if ( $post->post_type == 'mec_form' && $template !== locate_template( array( 'single-mec_form.php' ) ) ) {
			return plugin_dir_path( __FILE__ ) . 'single-mec_form.php';
		}
		return $template;
	}

	/**
	 * Registers Forms post type and assign it to some taxonomies
	 *
	 * @author Webnus <info@webnus.biz>
	 */
	public function register_post_type() {
		register_post_type(
			'mec_form',
			array(
				'labels'             => array(
					'name'               => _x( 'Form Builder', 'post type general name', 'mec-form-builder' ),
					'singular_name'      => _x( 'Form', 'post type singular name', 'mec-form-builder' ),
					'menu_name'          => _x( 'Form Builder', 'admin menu', 'mec-form-builder' ),
					'name_admin_bar'     => _x( 'Form', 'add new on admin bar', 'mec-form-builder' ),
					'add_new'            => _x( 'Add New With Elementor', 'Form', 'mec-form-builder' ),
					'add_new_item'       => __( 'Add New Form', 'mec-form-builder' ),
					'new_item'           => __( 'New Form', 'mec-form-builder' ),
					'edit_item'          => __( 'Edit Form', 'mec-form-builder' ),
					'view_item'          => __( 'View Form', 'mec-form-builder' ),
					'all_items'          => __( 'Form Builder', 'mec-form-builder' ),
					'search_items'       => __( 'Search MEC Forms', 'mec-form-builder' ),
					'parent_item_colon'  => __( 'Parent MEC Forms:', 'mec-form-builder' ),
					'not_found'          => __( 'No MEC Forms found.', 'mec-form-builder' ),
					'not_found_in_trash' => __( 'No MEC Forms found in Trash.', 'mec-form-builder' ),
				),
				// 'description'        => __( 'Description.', 'mec-form-builder' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => 'mec-intro',
				'query_var'          => true,
				'menu_icon'          => 'dashicons-editor-table',
				'rewrite'            => array( 'slug' => 'mec-form' ),
				'capability_type'    => 'post',
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => 29,
				'supports'           => [ 'title', 'elementor' ],
			)
		);
	}

	public function form_builder_menu() {
		global $submenu;
		unset( $submenu['mec-intro'][3] );
		add_submenu_page( 'mec-intro', __( 'Form Builder', 'mec-form-builder' ), __( 'Form Builder', 'mec-form-builder' ), 'edit_posts', 'edit.php?post_type=mec_form' );
	}
}
new MEC_feature_forms();
