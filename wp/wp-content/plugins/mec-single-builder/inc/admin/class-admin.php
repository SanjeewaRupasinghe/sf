<?php

namespace MEC_Single_Builder\Inc\Admin;

use MEC_Single_Builder as NS;
use Elementor\Plugin;
use Elementor\Post_CSS_File;
use Elementor\Core\Files\CSS\Post;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://webnus.net
 * @since      1.0.0
 *
 * @author    Webnus
 */
class Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The text domain of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_text_domain    The text domain of this plugin.
	 */
	private $plugin_text_domain;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since       1.0.0
	 * @param       string $plugin_name        The name of this plugin.
	 * @param       string $version            The version of this plugin.
	 * @param       string $plugin_text_domain The text domain of this plugin.
	 */
	public function __construct($plugin_name, $version, $plugin_text_domain)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_text_domain = $plugin_text_domain;

		add_filter('post_row_actions', array($this, 'action_links'), 10, 2);
	}

	public function action_links($actions, $post) {

        if( 'mec_esb' != $post->post_type ) {

			return $actions;
		}

        unset( $actions['view'] );

        return $actions;
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mec-single-builder-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mec-single-builder-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Add Single Builder Settings into Single Event Page Settings Section
	 *
	 * @since     1.0.0
	 */
	public function add_settings($mec)
	{
		$settings = $mec->settings;
		$builders = get_posts([
			'post_type' => 'mec_esb',
			'posts_per_page' => -1
		]);
?>
		<div class="mec-form-row" id="mec_settings_single_event_single_default_builder_wrap" style="display:none;">
			<?php
			if (!$builders) {
				echo __('Please Create New Design for Single Event Page', 'mec-single-builder');
				echo ' <a href="' . admin_url('post-new.php?post_type=mec_esb') . '" class="taxonomy-add-new">' . __('Create new', 'mec-single-builder') . '</a>';
			}
			?>
			<label class="mec-col-3" for="mec_settings_single_event_single_default_builder"><?php _e('Default Builder for Single Event', 'mec-single-builder'); ?></label>
			<div class="mec-col-9">
				<select id="mec_settings_single_event_single_default_builder" name="mec[settings][single_single_default_builder]">
					<?php foreach ($builders as $builder) : ?>
						<option value="<?php echo $builder->ID ?>" <?php echo (isset($settings['single_single_default_builder']) and $settings['single_single_default_builder'] == $builder->ID) ? 'selected="selected"' : ''; ?>><?php echo esc_html($builder->post_title) ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="mec-form-row" id="mec_settings_single_event_single_modal_default_builder_wrap" style="display:none;">
			<?php
			if (!$builders) {
				echo __('Please Create New Design for Single Event Page', 'mec-single-builder');
				echo ' <a href="' . admin_url('post-new.php?post_type=mec_esb') . '" class="taxonomy-add-new">' . __('Create new', 'mec-single-builder') . '</a>';
			}
			?>
			<label class="mec-col-3" for="mec_settings_single_event_single_modal_default_builder"><?php _e('Default Builder for Modal View', 'mec-single-builder'); ?></label>
			<div class="mec-col-9">
				<select id="mec_settings_single_event_single_modal_default_builder" name="mec[settings][single_modal_default_builder]">
					<?php foreach ($builders as $builder) : ?>
						<option value="<?php echo $builder->ID ?>" <?php echo (isset($settings['single_modal_default_builder']) and $settings['single_modal_default_builder'] == $builder->ID) ? 'selected="selected"' : ''; ?>><?php echo $builder->post_title ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="mec-form-row" id="mec_settings_custom_event_for_set_settings_wrap">
			<label class="mec-col-3" for="mec_settings_custom_event_for_set_settings"><?php _e('Custom Event For Set Settings', 'mec-single-builder'); ?></label>
			<div class="mec-col-9">
				<select id="mec_settings_custom_event_for_set_settings" name="mec[settings][custom_event_for_set_settings]">
					<?php
						$events = \MEC\Events\EventsQuery::getInstance()->get_events([
							'posts_per_page' => -1,
						]);
					   	$v_selected = (int)\MEC\Settings\Settings::getInstance()->get_settings('custom_event_for_set_settings');
						foreach($events as $event){

							$event_id = $event->ID;
							$event_title = $event->post_title;
							$selected = $event_id == $v_selected ? 'selected="selected"' : '';
							echo '<option value="'.$event_id.'" '.$selected.'>'.$event_title.'</option>';
						}
					?>
				</select>
				<span class="mec-tooltip">
					<div class="box left">
						<h5 class="title"><?php _e('Custom Event For Set Settings', 'mec'); ?></h5>
						<div class="content"><p><?php esc_attr_e("Choose your event for single builder addon.", 'mec-single-builder'); ?><a href="#" target="_blank"><?php _e('Read More', 'mec-single-builder'); ?></a></p></div>
					</div>
					<i title="" class="dashicons-before dashicons-editor-help"></i>
				</span>
			</div>
		</div>

		<script>
			jQuery(document).ready(function() {
				if (jQuery('#mec_settings_single_event_single_style').val() == 'builder') {
					jQuery('#mec_settings_single_event_single_default_builder_wrap').css('display', 'block');
					jQuery('#mec_settings_single_event_single_modal_default_builder_wrap').css('display', 'block');
					jQuery('#mec_settings_custom_event_for_set_settings_wrap').css('display', 'block');

				}

				jQuery('#mec_settings_single_event_single_style').on('change', function() {
					if (jQuery(this).val() == 'builder') {
						jQuery('#mec_settings_single_event_single_default_builder_wrap').css('display', 'block');
						jQuery('#mec_settings_single_event_single_modal_default_builder_wrap').css('display', 'block');
						jQuery('#mec_settings_custom_event_for_set_settings_wrap').css('display', 'block');
					} else {
						jQuery('#mec_settings_single_event_single_default_builder_wrap').css('display', 'none');
						jQuery('#mec_settings_single_event_single_modal_default_builder_wrap').css('display', 'none');
						jQuery('#mec_settings_custom_event_for_set_settings_wrap').css('display', 'none');
					}
				})
			})
		</script>

	<?php
	}

	/**
	 * Add Single Builder Settings into Single Event Page Settings Section
	 *
	 * @since     1.0.0
	 */
	public function show_setup_popup()
	{
		$mainClass      = new \MEC_main();
		$set            = $mainClass->get_settings();

		if(!get_option('esb_show_setup_popup')) {
			return;
		}
		update_option('esb_show_setup_popup', false);

		if (isset($set['single_single_style']) && $set['single_single_style'] == 'builder') {
			return;
		}

	?>
		<!-- jQuery Modal -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
		<!-- Modal HTML embedded directly into document -->
		<style>
			.blocker {
				z-index: 9999;
			}

			div#esb_setup_modal {
				border-radius: 3px;
				padding-bottom: 50px;
			}

			div#esb_setup_modal p {
				font-size: 19px;
				font-weight: bold;
			}

			div#esb_setup_modal .success {
				font-size: 54px;
				color: #3adecf;
				display: block;
				text-align: center;
				padding-top: 30px;
				font-weight: 200;
				line-height: 4;
			}

			div#esb_setup_modal select {
				display: block;
				width: 280px;
				border-radius: 3px;
				font-size: 14px;
				line-height: 2;
				color: #32373c;
				border-color: #7e8993;
				box-shadow: none;
				border-radius: 3px;
				padding: 0 24px 0 8px;
				min-height: 30px;
				max-width: 25rem;
				-webkit-appearance: none;
				background: #fff url(data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%206l5%205%205-5%202%201-7%207-7-7%202-1z%22%20fill%3D%22%23555%22%2F%3E%3C%2Fsvg%3E) no-repeat right 5px top 55%;
				background-size: 16px 16px;
				cursor: pointer;
				vertical-align: middle;
				border-color: #999;
				box-shadow: none;
				border: solid 1px #ddd;
				border-radius: 2px;
				height: 40px;
				line-height: 38px;
				padding-left: 10px;
				box-shadow: 0 3px 10px -2px rgba(0, 0, 0, .05), inset 0 1px 2px rgba(0, 0, 0, .02);
			}

			div#esb_setup_modal #esb_setup_modal_apply {
				color: #fff;
				font-weight: 500;
				border-radius: 60px;
				box-shadow: 0 0 0 4px rgb(56 213 237 / 1%);
				text-shadow: none;
				background: #38d5ed;
				border: none;
				transition: .24s;
				line-height: 1.4;
				padding: 9px 36px 12px;
				display: inline-block;
				margin-top: 15px;
			}

			div#esb_setup_modal #esb_setup_modal_apply:hover {
				background: #26bbd2;
				box-shadow: 0 0 0 4px rgb(56 213 237 / 15%);
				cursor: pointer;
				color: #fff;
			}
		</style>
		<div id="esb_setup_modal" class="modal">
			<div class="modal-content">
				<p><?php echo __('Select Single Event Style', 'mec-single-builder'); ?></p>
				<select>
					<option><?php echo __('Builder', 'mec-single-builder'); ?></option>
				</select>
				<a href="#" id="esb_setup_modal_apply"><?php echo __('Apply', 'mec-single-builder'); ?></a>
			</div>
		</div>

		<!-- Link to open the modal -->
		<a href="#esb_setup_modal" style="display: none;" id="esb_setup_modal_btn" rel="modal:open"></a>
		<a href="#esb_setup_modal_close" style="display: none;" id="esb_setup_modal_btn" rel="modal:close"></a>
		<script>
			jQuery('#esb_setup_modal_btn').trigger('click.modal');
			jQuery('#esb_setup_modal_apply').on('click', function() {
				let post = window.wp.ajax.post('esb_single_style_apply', {});
				post.done(function(v) {
					jQuery('#esb_setup_modal .modal-content').html('<span class="success"><?php echo __('Success', 'mec-single-builder'); ?></span>');
					setTimeout(() => {
						$.modal.close();
					}, 2000);
				});
			})
		</script>

	<?php
	}

	/**
	 * Apply Single Style
	 *
	 * @since    1.0.0
	 */
	public function apply_single_style()
	{
		$options = get_option('mec_options');
		if (!$options) {
			return;
		}

		$options['settings']['single_single_style'] = 'builder';
		update_option('mec_options', $options);
		wp_send_json_success();
	}

	/**
	 * Register mec_esb post type
	 *
	 * @since    1.0.0
	 */
	public function mec_esb_post_type()
	{
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x('Events Single Builder', 'Post Type General Name', 'mec-single-builder'),
			'singular_name'       => _x('Events Single Page', 'Post Type Singular Name', 'mec-single-builder'),
			'menu_name'           => __('Events Single Builder', 'mec-single-builder'),
			'parent_item_colon'   => __('Parent Single Builder', 'mec-single-builder'),
			'all_items'           => __('Events Single Builder', 'mec-single-builder'),
			'view_item'           => __('View Single Builder', 'mec-single-builder'),
			'add_new_item'        => __('Design new event single page', 'mec-single-builder'),
			'add_new'             => __('Add New', 'mec-single-builder'),
			'edit_item'           => __('Edit Single Builder', 'mec-single-builder'),
			'update_item'         => __('Update Single Builder', 'mec-single-builder'),
			'search_items'        => __('Search Single Builder', 'mec-single-builder'),
			'not_found'           => __('Not Found', 'mec-single-builder'),
			'not_found_in_trash'  => __('Not found in Trash', 'mec-single-builder'),
		);

		$args = array(
			'label'               => __('Events Single Page Builder', 'mec-single-builder'),
			'description'         => __('Single Builder news and reviews', 'mec-single-builder'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 49,
			'rewrite'            => ['slug' => 'mec_esb'],
			'supports'           => ['title', 'editor', 'elementor'],
			'labels'              => $labels,
			'exclude_from_search' => true
		);

		register_post_type('mec_esb', $args);
	}

	/**
	 * Save event data
	 *
	 * @author Webnus <info@webnus.biz>
	 * @param int $post_id
	 * @return void
	 */
	public static function save_event($post_id)
	{

		// Check if our nonce is set.
		if (!isset($_POST['mec_event_nonce'])) {
			return;
		}

		// Verify that the nonce is valid.
		if (!wp_verify_nonce($_POST['mec_event_nonce'], 'mec_event_data')) {
			return;
		}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if (defined('DOING_AUTOSAVE') and DOING_AUTOSAVE) {
			return;
		}

		$_mec = isset($_POST['mec']) ? $_POST['mec'] : array();
		if (!$_mec) {
			return;
		}


		if (isset($_mec['single_design_page'])) {
			update_post_meta($post_id, 'single_design_page', $_mec['single_design_page']);
		}
		if (isset($_mec['single_modal_design_page'])) {
			update_post_meta($post_id, 'single_modal_design_page', $_mec['single_modal_design_page']);
		}
	}

	public function esb_single($single)
	{

		global $post;

		if ($post->post_type == 'mec_esb') {
			if (file_exists(NS\PLUGIN_NAME_DIR . 'inc/frontend/views/single-mec_esb.php')) {
				return NS\PLUGIN_NAME_DIR . 'inc/frontend/views/single-mec_esb.php';
			}
		}

		return $single;
	}

	public function load_the_builder($event)
	{
		$mainClass      = new \MEC_main();
		$set            = $mainClass->get_settings();
		$set['single_single_style'] = isset($set['single_single_style']) ? $set['single_single_style'] : "";
		if ($set['single_single_style'] != 'builder') {
			return;
		}
		global $eventt;
		$eventt = $event;

		$post_title = 'Single Builder';
		if (!class_exists('\Elementor\Plugin')) return;

		if (isset($_REQUEST['elementor-preview']) && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			if (get_the_title() != $post_title) return;
		}
		$post_id = get_post_meta($event->ID, 'single_design_page', true);
		if (!$post_id || $post_id <= 0) {
			$post_id = (isset($set['single_single_default_builder']) && $set['single_single_default_builder']) ? $set['single_single_default_builder'] : false;
		}

		if (!$post_id || !get_post($post_id)) {
			$post_id = false;
			global $wpdb;
			$query = $wpdb->prepare(
				'SELECT ID FROM ' . $wpdb->posts . '
			WHERE post_title = %s
			AND post_type = \'mec_esb\'',
				$post_title
			);
			$wpdb->query($query);

			if ($wpdb->num_rows) {
				$post_id = $wpdb->get_var($query);
			}
			if (!$post_id || !get_post($post_id)) {
				echo __('Please select default builder from MEC single page settings.', 'mec-single-builder');
				return;
			}
		}

		echo '<div class="mec-wrap mec-single-builder-wrap"><div class="row mec-single-event"><div class="wn-single">' . Plugin::instance()->frontend->get_builder_content_for_display($post_id, true) . '</div></div></div>';
		if (class_exists('\Elementor\Core\Files\CSS\Post')) {
			$css_file = new Post($post_id);
		} elseif (class_exists('\Elementor\Post_CSS_File')) {
			$css_file = new Post_CSS_File($post_id);
		}
		$css_file->enqueue();
		echo '<style>.mec-wrap .elementor-text-editor p {
			margin: inherit;
			color: inherit;
			font-size: inherit;
			line-height: inherit;
		}</style>';
	}

	public function load_the_builder_modal($event_id)
	{
		$mainClass      = new \MEC_main();
		$set            = $mainClass->get_settings();
		$post_title = 'Single Builder';
		if (!class_exists('\Elementor\Plugin')) return;

		if (isset($_REQUEST['elementor-preview']) && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			if (get_the_title() != $post_title) return;
		}

		if(!isset($set['single_single_style']) || 'builder' !== $set['single_single_style'] ){

			return;
		}

		$post_id = get_post_meta($event_id, 'single_modal_design_page', true);

		if (!$post_id || $post_id <= 0) {
			$post_id = (isset($set['single_modal_default_builder']) && $set['single_modal_default_builder']) ? $set['single_modal_default_builder'] : false;
		}

		if (!$post_id || !get_post($post_id)) {
			$post_id = false;
			global $wpdb;
			$query = $wpdb->prepare(
				'SELECT ID FROM ' . $wpdb->posts . '
			WHERE post_title = %s
			AND post_type = \'mec_esb\'',
				$post_title
			);
			$wpdb->query($query);

			if ($wpdb->num_rows) {
				$post_id = $wpdb->get_var($query);
			}
			if (!$post_id || !get_post($post_id)) {
				echo __('Please select default builder for modal from MEC single page settings.', 'mec-single-builder');
				return;
			}
		}

		global $post;
		$posts = get_posts([
			'post__in' => [$_REQUEST['id']],
			'post_type' => 'mec-events'
		]);

		foreach ($posts as $post) {
			setup_postdata($post);
			echo '<div class="mec-wrap mec-single-builder-wrap clearfix"><div class="row mec-single-event"><div class="wn-single">' . Plugin::instance()->frontend->get_builder_content_for_display($post_id, true) . '</div></div></div>';
		}

		if (class_exists('\Elementor\Core\Files\CSS\Post')) {
			$css_file = new Post($post_id);
		} elseif (class_exists('\Elementor\Post_CSS_File')) {
			$css_file = new Post_CSS_File($post_id);
		}
		$css_file->enqueue();
		die();
	}

	public function esb_submenu()
	{
		add_submenu_page(
			'mec-intro',
			__('Single Builder', 'mec-single-builder'),
			__('Single Builder', 'mec-single-builder'),
			'edit_posts',
			'edit.php?post_type=mec_esb'
		);
	}

	public function disable_mec_esb_page()
	{
		if (isset($_GET['post_type']) && $_GET['post_type'] == 'mec_esb') {
			header("Location: " . admin_url());
			exit();
		}
	}

	/**
	 * Render Event Description MetaBox
	 * @param object $post
	 */
	public function sb_metabox($post)
	{
		$mainClass      = new \MEC_main();
		$set            = $mainClass->get_settings();
		if ( isset($set['single_single_style']) and $set['single_single_style'] != 'builder') {
			return;
		}
		add_meta_box(
			'mec_sb_choose_single_page',
			'Choose Single Template',
			[$this, 'renderEventDescriptionMetaBox'],
			'mec-events',
			'side',
			'default'
		);
	}
	/**
	 * Render Event Description MetaBox
	 * @param object $post
	 */
	public function renderEventDescriptionMetaBox($post)
	{
		$mainClass      = new \MEC_main();
		$set            = $mainClass->get_settings();
		$builders = get_posts([
			'post_type' => 'mec_esb',
			'posts_per_page' => -1
		]);
	?>
		<?php if (isset($set['single_single_style']) and $set['single_single_style'] != 'builder') : ?>
			<label class="other-type-of-builder-title"><?php _e($set['single_single_style'] . ' Style', 'mec-single-builder'); ?></label>
		<?php else : ?>
			<label class="post-attributes-label"><?php _e('Event single view.', 'mec-single-builder'); ?></label>
			<div class="mec-form-row" id="mec_organizer_gateways_form_container">
				<select name="mec[single_design_page]" id="single_design_page">
					<option value="-1"><?php echo __('Select'); ?></option>
					<?php
					$selected_view = get_post_meta($post->ID, 'single_design_page', true);
					foreach ($builders as $builder) {
						$selected = $builder->ID == $selected_view ? ' selected="selected"' : '';
						echo '<option value="' . $builder->ID . '"' . $selected . '>' . $builder->post_title . '</option>';
					}
					?>
				</select>
			</div>
			<label class="post-attributes-label"><?php _e('Event modal view.', 'mec-single-builder'); ?></label>
			<div class="mec-form-row" id="mec_organizer_gateways_form_container">
				<select name="mec[single_modal_design_page]" id="single_modal_design_page">
					<option value="-1"><?php echo __('Select'); ?></option>
					<?php
					$selected_view = get_post_meta($post->ID, 'single_modal_design_page', true);
					foreach ($builders as $builder) {
						$selected = $builder->ID == $selected_view ? ' selected="selected"' : '';
						echo '<option value="' . $builder->ID . '"' . $selected . '>' . $builder->post_title . '</option>';
					}
					?>
				</select>
			</div>
		<?php endif; ?>
		<div class="mec-esb-metabox-footer">
			<a href="<?php echo admin_url('admin.php?page=MEC-settings&tab=MEC-single#mec_settings_single_event_single_style'); ?>" target="_blank" class="mec-settings-btn"><?php echo __('Settings', 'mec-single-builder'); ?></a>
			<?php if (isset($set['single_single_style']) and $set['single_single_style'] == 'builder') : ?>
				<a href="<?php echo admin_url('post-new.php?post_type=mec_esb'); ?>" class="taxonomy-add-new">+ <?php echo __('Build new Single Design', 'mec-single-builder'); ?></a>
			<?php endif; ?>
		</div>
<?php
	}
}
