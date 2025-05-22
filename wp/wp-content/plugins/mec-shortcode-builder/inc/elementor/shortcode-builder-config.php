<?php
if ( ! class_exists( 'MEC_addon_elementor_shortcode_builder_config' ) ) :
	class MEC_addon_elementor_shortcode_builder_config {
		/**
		 * init.
		 *
		 * @since    1.0.0
		 * @access   public
		 */
		public function init() {
			$this->actions();
			$this->config();
		}

		/**
		 * Actions.
		 *
		 * @since     1.0.0
		 */
		public function actions() {
			add_filter( 'single_template', [ $this, 'single_template' ] );
			add_action( 'save_post', [ $this, 'save_post' ], 10, 3 );
			add_action('elementor/editor/after_enqueue_styles', [$this, 'editor_styles']);
		}

		public function editor_styles()
		{
			if ( get_post_type(get_the_ID()) ) {
				wp_enqueue_style('editor-shortcode-builder', plugins_url('../../assets/css/backend/editor-elementor.css', __FILE__), [], '');
			}
		}

		/**
		 * Single template.
		 *
		 * @since     1.0.0
		 */
		function single_template( $single ) {
			global $post;

			if ( $post->post_type == 'mec_calendars' ) {
				if ( file_exists( MEC_Shortcode_Builder::$dir . 'inc/elementor/templates/single.php' ) ) {
					return MEC_Shortcode_Builder::$dir . 'inc/elementor/templates/single.php';
				}
			}

			return $single;
		}

		public function config() {
			add_post_type_support( 'mec_calendars', 'elementor' );

			if ( ! get_option( 'mec_shortcode_builder_flag', false ) ) {
				update_option( 'mec_shortcode_builder_flag', true );
			} else {
				return;
			}

			$recent_mec_shortcodes = wp_get_recent_posts(
				[
					'numberposts' => -1,
					'post_type'   => 'mec_calendars',
				]
			);

			foreach ( $recent_mec_shortcodes as $recent ) {
				$post_meta                       = get_post_meta( $recent['ID'] );
				// $data                            = [];
				$data['mec']                     = [];
				$data['mec']['label']            	= current( $post_meta['label'] );
				$data['mec']['category']         	= current( $post_meta['category'] );
				$data['mec']['location']         	= current( $post_meta['location'] );
				$data['mec']['organizer']        	= current( $post_meta['organizer'] );
				$data['mec']['tag']              	= current( $post_meta['tag'] );
				$data['mec']['time_filter']			= current( $post_meta['time_filter'] );
				$data['mec']['event_cost']			= current( $post_meta['event_cost'] );
				$data['mec']['author']           	= current( $post_meta['author'] );
				$data['mec']['skin']             	= current( $post_meta['skin'] );
				$data['mec']['show_past_events'] 	= current( $post_meta['show_past_events'] );
				$data['mec']['sk-options']       	= unserialize( current( $post_meta['sk-options'] ) );
				$data['mec']['sf-options']       	= unserialize( current( $post_meta['sf-options'] ) );
				$data['mec']['sf_display_label']	= current( $post_meta['sf_display_label'] );
				$data['mec']['sf_status']        	= current( $post_meta['sf_status'] );
				$this->save_post( $recent['ID'], $data, true );
			}
			wp_reset_query();
		}

		/**
		 * Save post metadata when a post is saved.
		 *
		 * @param int $post_id The post ID.
		 */
		public function save_post( $post_id, $post, $update ) {

			$data      = ! is_object( $post ) ? $post : $_POST;
			$post_type = get_post_type( $post_id );

			// If this isn't a 'mec_calendars' post, don't update it.
			if ( $post_type != 'mec_calendars' ) {
				return;
			}

			if ( ! isset( $data['action'] ) || $data['action'] != 'elementor_ajax' ) {
				
				$mec_data       = $data['mec'];

				$elementor_data = [];
				if ( isset( $mec_data['show_past_events'] ) && $mec_data['show_past_events'] == 1 && isset( $mec_data['show_only_past_events'] ) && $mec_data['show_only_past_events'] == 0 && isset( $mec_data['show_only_ongoing_events'] ) && $mec_data['show_only_ongoing_events'] == 0 && isset( $mec_data['show_ongoing_events'] ) && $mec_data['show_ongoing_events'] == 0 ) {
					$elementor_data['filter_options']['dates'] = 'include-expired-events';
				} elseif ( isset( $mec_data['show_past_events'] ) && $mec_data['show_past_events'] == 0 && isset( $mec_data['show_only_past_events'] ) && $mec_data['show_only_past_events'] == 0 && isset( $mec_data['show_only_ongoing_events'] ) && $mec_data['show_only_ongoing_events'] == 1 && isset( $mec_data['show_ongoing_events'] ) && $mec_data['show_ongoing_events'] == 0 ) {
					$elementor_data['filter_options']['dates'] = 'show-only-ongoing-events';
				} elseif ( isset( $mec_data['show_past_events'] ) && $mec_data['show_past_events'] == 0 && isset( $mec_data['show_only_past_events'] ) && $mec_data['show_only_past_events'] == 1 && isset( $mec_data['show_only_ongoing_events'] ) && $mec_data['show_only_ongoing_events'] == 0 && isset( $mec_data['show_ongoing_events'] ) && $mec_data['show_ongoing_events'] == 0 ) {
					$elementor_data['filter_options']['dates'] = 'show-only-expired-events';
				} elseif ( isset( $mec_data['show_past_events'] ) && $mec_data['show_past_events'] == 0 && isset( $mec_data['show_only_past_events'] ) && $mec_data['show_only_past_events'] == 0 && isset( $mec_data['show_only_ongoing_events'] ) && $mec_data['show_only_ongoing_events'] == 0 && isset( $mec_data['show_ongoing_events'] ) && $mec_data['show_ongoing_events'] == 1 ) {
					$elementor_data['filter_options']['dates'] = 'show-ongoing-events';
				}

				// Skin name
				$elementor_data['skin'] = isset( $mec_data['skin'] ) ? $mec_data['skin'] : 'list';
				// Search form status
				switch ( $elementor_data['skin'] ) {
					case 'list':
						$elementor_data['list_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['list_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'grid':
						$elementor_data['grid_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['grid_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'agenda':
						$elementor_data['agenda_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['agenda_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'full_calendar':
						$elementor_data['full_calendar_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['full_calendar_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'monthly_view':
						$elementor_data['monthly_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['monthly_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'yearly_view':
						$elementor_data['yearly_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['yearly_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'tile':
						$elementor_data['tile_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['tile_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'map':
						$elementor_data['map_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['map_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'daily_view':
						$elementor_data['daily_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['daily_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'weekly_view':
						$elementor_data['weekly_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['weekly_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'timetable':
						$elementor_data['timetable_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['timetable_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
					case 'custom':
						$elementor_data['custom_sf_status'] = isset( $mec_data['sf_status'] ) ? '0' : '1';
						$elementor_data['custom_sf_display_label'] = isset( $mec_data['sf_display_label'] ) ? '0' : '1';
						break;
				}

				// Search form
				$mec_search_form = $mec_data['sf-options'];
				// Search form status
				$elementor_data['search_form'] = $elementor_data['list_sf_status'] = $elementor_data['grid_sf_status'] = $elementor_data['agenda_sf_status'] = $elementor_data['full_calendar_sf_status'] = $elementor_data['monthly_sf_status'] = $elementor_data['yearly_sf_status'] = $elementor_data['map_sf_status'] = $elementor_data['daily_sf_status'] = $elementor_data['weekly_sf_status'] = $elementor_data['timetable_sf_status'] = $mec_data['sf_status'];
				// List Form
				$elementor_data['list_category_type']     						= isset( $mec_search_form['list']['category']['type'] ) ? $mec_search_form['list']['category']['type'] : '0';
				$elementor_data['list_location_type']     						= isset( $mec_search_form['list']['location']['type'] ) ? $mec_search_form['list']['location']['type'] : '0';
				$elementor_data['list_organizer_type']    						= isset( $mec_search_form['list']['organizer']['type'] ) ? $mec_search_form['list']['organizer']['type'] : '0';
				$elementor_data['list_label_type']        						= isset( $mec_search_form['list']['label']['type'] ) ? $mec_search_form['list']['label']['type'] : '0';
				$elementor_data['list_address_search_type']						= isset( $mec_search_form['list']['address_search']['type'] ) ? $mec_search_form['list']['address_search']['type'] : '0';
				$elementor_data['list_address_search_placeholder']				= isset( $mec_search_form['list']['address_search']['placeholder'] ) ? $mec_search_form['list']['address_search']['placeholder'] : '';
				$elementor_data['list_month_filter_type'] 						= isset( $mec_search_form['list']['month_filter']['type'] ) ? $mec_search_form['list']['month_filter']['type'] : '0';
				$elementor_data['list_text_search_type']  						= isset( $mec_search_form['list']['text_search']['type'] ) ? $mec_search_form['list']['text_search']['type'] : '0';
				$elementor_data['list_text_search_placeholder']					= isset( $mec_search_form['list']['text_search']['placeholder'] ) ? $mec_search_form['list']['text_search']['placeholder'] : '';
				$elementor_data['list_time_filter_type']  						= isset( $mec_search_form['list']['time_filter']['type'] ) ? $mec_search_form['list']['time_filter']['type'] : '0';
				$elementor_data['list_event_cost_type']  						= isset( $mec_search_form['list']['event_cost']['type'] ) ? $mec_search_form['list']['event_cost']['type'] : '0';
				// Grid Form
				$elementor_data['grid_category_type']     						= isset( $mec_search_form['grid']['category']['type'] ) ? $mec_search_form['grid']['category']['type'] : '0';
				$elementor_data['grid_location_type']     						= isset( $mec_search_form['grid']['location']['type'] ) ? $mec_search_form['grid']['location']['type'] : '0';
				$elementor_data['grid_organizer_type']    						= isset( $mec_search_form['grid']['organizer']['type'] ) ? $mec_search_form['grid']['organizer']['type'] : '0';
				$elementor_data['grid_label_type']        						= isset( $mec_search_form['grid']['label']['type'] ) ? $mec_search_form['grid']['label']['type'] : '0';
				$elementor_data['grid_address_search_type']						= isset( $mec_search_form['grid']['address_search']['type'] ) ? $mec_search_form['grid']['address_search']['type'] : '0';
				$elementor_data['grid_address_search_placeholder']				= isset( $mec_search_form['grid']['address_search']['placeholder'] ) ? $mec_search_form['grid']['address_search']['placeholder'] : '';
				$elementor_data['grid_month_filter_type'] 						= isset( $mec_search_form['grid']['month_filter']['type'] ) ? $mec_search_form['grid']['month_filter']['type'] : '0';
				$elementor_data['grid_text_search_type']  						= isset( $mec_search_form['grid']['text_search']['type'] ) ? $mec_search_form['grid']['text_search']['type'] : '0';
				$elementor_data['grid_text_search_placeholder']					= isset( $mec_search_form['grid']['text_search']['placeholder'] ) ? $mec_search_form['grid']['text_search']['placeholder'] : '';
				$elementor_data['grid_time_filter_type']  						= isset( $mec_search_form['grid']['time_filter']['type'] ) ? $mec_search_form['grid']['time_filter']['type'] : '0';
				$elementor_data['grid_event_cost_type']  						= isset( $mec_search_form['grid']['event_cost']['type'] ) ? $mec_search_form['grid']['event_cost']['type'] : '0';
				// Agenda Form
				$elementor_data['agenda_category_type']     					= isset( $mec_search_form['agenda']['category']['type'] ) ? $mec_search_form['agenda']['category']['type'] : '0';
				$elementor_data['agenda_location_type']     					= isset( $mec_search_form['agenda']['location']['type'] ) ? $mec_search_form['agenda']['location']['type'] : '0';
				$elementor_data['agenda_organizer_type']    					= isset( $mec_search_form['agenda']['organizer']['type'] ) ? $mec_search_form['agenda']['organizer']['type'] : '0';
				$elementor_data['agenda_label_type']        					= isset( $mec_search_form['agenda']['label']['type'] ) ? $mec_search_form['agenda']['label']['type'] : '0';
				$elementor_data['agenda_address_search_type']					= isset( $mec_search_form['agenda']['address_search']['type'] ) ? $mec_search_form['agenda']['address_search']['type'] : '0';
				$elementor_data['agenda_address_search_placeholder']			= isset( $mec_search_form['agenda']['address_search']['placeholder'] ) ? $mec_search_form['agenda']['address_search']['placeholder'] : '';
				$elementor_data['agenda_month_filter_type'] 					= isset( $mec_search_form['agenda']['month_filter']['type'] ) ? $mec_search_form['agenda']['month_filter']['type'] : '0';
				$elementor_data['agenda_text_search_type']  					= isset( $mec_search_form['agenda']['text_search']['type'] ) ? $mec_search_form['agenda']['text_search']['type'] : '0';
				$elementor_data['agenda_text_search_placeholder']				= isset( $mec_search_form['agenda']['text_search']['placeholder'] ) ? $mec_search_form['agenda']['text_search']['placeholder'] : '';
				$elementor_data['agenda_time_filter_type']						= isset( $mec_search_form['agenda']['time_filter']['type'] ) ? $mec_search_form['agenda']['time_filter']['type'] : '0';
				$elementor_data['agenda_event_cost_type']						= isset( $mec_search_form['agenda']['event_cost']['type'] ) ? $mec_search_form['agenda']['event_cost']['type'] : '0';
				// Full Calendar Form
				$elementor_data['full_calendar_category_type']     				= isset( $mec_search_form['full_calendar']['category']['type'] ) ? $mec_search_form['full_calendar']['category']['type'] : '0';
				$elementor_data['full_calendar_location_type']     				= isset( $mec_search_form['full_calendar']['location']['type'] ) ? $mec_search_form['full_calendar']['location']['type'] : '0';
				$elementor_data['full_calendar_organizer_type']    				= isset( $mec_search_form['full_calendar']['organizer']['type'] ) ? $mec_search_form['full_calendar']['organizer']['type'] : '0';
				$elementor_data['full_calendar_speaker_type']      				= isset( $mec_search_form['full_calendar']['speaker']['type'] ) ? $mec_search_form['full_calendar']['speaker']['type'] : '0';
				$elementor_data['full_calendar_tag_type']          				= isset( $mec_search_form['full_calendar']['tag']['type'] ) ? $mec_search_form['full_calendar']['tag']['type'] : '0';
				$elementor_data['full_calendar_label_type']        				= isset( $mec_search_form['full_calendar']['label']['type'] ) ? $mec_search_form['full_calendar']['label']['type'] : '0';
				$elementor_data['full_calendar_address_search_type']			= isset( $mec_search_form['full_calendar']['address_search']['type'] ) ? $mec_search_form['full_calendar']['address_search']['type'] : '0';
				$elementor_data['full_calendar_address_search_placeholder']		= isset( $mec_search_form['full_calendar']['address_search']['placeholder'] ) ? $mec_search_form['full_calendar']['address_search']['placeholder'] : '';
				$elementor_data['full_calendar_month_filter_type'] 				= isset( $mec_search_form['full_calendar']['month_filter']['type'] ) ? $mec_search_form['full_calendar']['month_filter']['type'] : '0';
				$elementor_data['full_calendar_text_search_type']  				= isset( $mec_search_form['full_calendar']['text_search']['type'] ) ? $mec_search_form['full_calendar']['text_search']['type'] : '0';
				$elementor_data['full_calendar_text_search_placeholder']  		= isset( $mec_search_form['full_calendar']['text_search']['placeholder'] ) ? $mec_search_form['full_calendar']['text_search']['placeholder'] : '';
				$elementor_data['full_calendar_time_filter_type']				= isset( $mec_search_form['full_calendar']['time_filter']['type'] ) ? $mec_search_form['full_calendar']['time_filter']['type'] : '0';
				$elementor_data['full_calendar_event_cost_type']				= isset( $mec_search_form['full_calendar']['event_cost']['type'] ) ? $mec_search_form['full_calendar']['event_cost']['type'] : '0';
				// Monthly Form
				$elementor_data['monthly_category_type']     					= isset( $mec_search_form['monthly_view']['category']['type'] ) ? $mec_search_form['monthly_view']['category']['type'] : '0';
				$elementor_data['monthly_location_type']     					= isset( $mec_search_form['monthly_view']['location']['type'] ) ? $mec_search_form['monthly_view']['location']['type'] : '0';
				$elementor_data['monthly_organizer_type']    					= isset( $mec_search_form['monthly_view']['organizer']['type'] ) ? $mec_search_form['monthly_view']['organizer']['type'] : '0';
				$elementor_data['monthly_label_type']        					= isset( $mec_search_form['monthly_view']['label']['type'] ) ? $mec_search_form['monthly_view']['label']['type'] : '0';
				$elementor_data['monthly_address_search_type']					= isset( $mec_search_form['monthly_view']['address_search']['type'] ) ? $mec_search_form['monthly_view']['address_search']['type'] : '0';
				$elementor_data['monthly_address_search_placeholder']			= isset( $mec_search_form['monthly_view']['address_search']['placeholder'] ) ? $mec_search_form['monthly_view']['address_search']['placeholder'] : '';
				$elementor_data['monthly_month_filter_type'] 					= isset( $mec_search_form['monthly_view']['month_filter']['type'] ) ? $mec_search_form['monthly_view']['month_filter']['type'] : '0';
				$elementor_data['monthly_text_search_type']  					= isset( $mec_search_form['monthly_view']['text_search']['type'] ) ? $mec_search_form['monthly_view']['text_search']['type'] : '0';
				$elementor_data['monthly_text_search_placeholder']  			= isset( $mec_search_form['monthly_view']['text_search']['placeholder'] ) ? $mec_search_form['monthly_view']['text_search']['placeholder'] : '';
				$elementor_data['monthly_view_time_filter_type']				= isset( $mec_search_form['monthly_view']['time_filter']['type'] ) ? $mec_search_form['monthly_view']['time_filter']['type'] : '0';
				$elementor_data['monthly_view_event_cost_type']					= isset( $mec_search_form['monthly_view']['event_cost']['type'] ) ? $mec_search_form['monthly_view']['event_cost']['type'] : '0';
				// Yearly Form
				$elementor_data['yearly_category_type']     					= isset( $mec_search_form['yearly_view']['category']['type'] ) ? $mec_search_form['yearly_view']['category']['type'] : '0';
				$elementor_data['yearly_location_type']     					= isset( $mec_search_form['yearly_view']['location']['type'] ) ? $mec_search_form['yearly_view']['location']['type'] : '0';
				$elementor_data['yearly_organizer_type']    					= isset( $mec_search_form['yearly_view']['organizer']['type'] ) ? $mec_search_form['yearly_view']['organizer']['type'] : '0';
				$elementor_data['yearly_label_type']        					= isset( $mec_search_form['yearly_view']['label']['type'] ) ? $mec_search_form['yearly_view']['label']['type'] : '0';
				$elementor_data['yearly_address_search_type']					= isset( $mec_search_form['yearly_view']['address_search']['type'] ) ? $mec_search_form['yearly_view']['address_search']['type'] : '0';
				$elementor_data['yearly_address_search_placeholder']			= isset( $mec_search_form['yearly_view']['address_search']['placeholder'] ) ? $mec_search_form['yearly_view']['address_search']['placeholder'] : '';
				$elementor_data['yearly_month_filter_type'] 					= isset( $mec_search_form['yearly_view']['month_filter']['type'] ) ? $mec_search_form['yearly_view']['month_filter']['type'] : '0';
				$elementor_data['yearly_text_search_type']  					= isset( $mec_search_form['yearly_view']['text_search']['type'] ) ? $mec_search_form['yearly_view']['text_search']['type'] : '0';
				$elementor_data['yearly_text_search_placeholder']  				= isset( $mec_search_form['yearly_view']['text_search']['placeholder'] ) ? $mec_search_form['yearly_view']['text_search']['placeholder'] : '';
				$elementor_data['yearly_time_filter_type']						= isset( $mec_search_form['yearly_view']['time_filter']['type'] ) ? $mec_search_form['yearly_view']['time_filter']['type'] : '0';
				$elementor_data['yearly_event_cost_type']						= isset( $mec_search_form['yearly_view']['event_cost']['type'] ) ? $mec_search_form['yearly_view']['event_cost']['type'] : '0';
				// Tile Form
				$elementor_data['tile_category_type']     						= isset( $mec_search_form['tile']['category']['type'] ) ? $mec_search_form['tile']['category']['type'] : '0';
				$elementor_data['tile_location_type']     						= isset( $mec_search_form['tile']['location']['type'] ) ? $mec_search_form['tile']['location']['type'] : '0';
				$elementor_data['tile_organizer_type']    						= isset( $mec_search_form['tile']['organizer']['type'] ) ? $mec_search_form['tile']['organizer']['type'] : '0';
				$elementor_data['tile_label_type']        						= isset( $mec_search_form['tile']['label']['type'] ) ? $mec_search_form['tile']['label']['type'] : '0';
				$elementor_data['tile_address_search_type']						= isset( $mec_search_form['tile']['address_search']['type'] ) ? $mec_search_form['tile']['address_search']['type'] : '0';
				$elementor_data['tile_address_search_placeholder']				= isset( $mec_search_form['tile']['address_search']['placeholder'] ) ? $mec_search_form['tile']['address_search']['placeholder'] : '';
				$elementor_data['tile_month_filter_type'] 						= isset( $mec_search_form['tile']['month_filter']['type'] ) ? $mec_search_form['tile']['month_filter']['type'] : '0';
				$elementor_data['tile_text_search_type']  						= isset( $mec_search_form['tile']['text_search']['type'] ) ? $mec_search_form['tile']['text_search']['type'] : '0';
				$elementor_data['tile_text_search_placeholder']  				= isset( $mec_search_form['tile']['text_search']['placeholder'] ) ? $mec_search_form['tile']['text_search']['placeholder'] : '';
				$elementor_data['tile_time_filter_type']						= isset( $mec_search_form['tile']['time_filter']['type'] ) ? $mec_search_form['tile']['time_filter']['type'] : '0';
				$elementor_data['tile_event_cost_type']							= isset( $mec_search_form['tile']['event_cost']['type'] ) ? $mec_search_form['tile']['event_cost']['type'] : '0';
				// Map Form
				$elementor_data['map_category_type']    						= isset( $mec_search_form['map']['category']['type'] ) ? $mec_search_form['map']['category']['type'] : '0';
				$elementor_data['map_location_type']    						= isset( $mec_search_form['map']['location']['type'] ) ? $mec_search_form['map']['location']['type'] : '0';
				$elementor_data['map_organizer_type']   						= isset( $mec_search_form['map']['organizer']['type'] ) ? $mec_search_form['map']['organizer']['type'] : '0';
				$elementor_data['map_label_type']       						= isset( $mec_search_form['map']['label']['type'] ) ? $mec_search_form['map']['label']['type'] : '0';
				$elementor_data['map_address_search_type']						= isset( $mec_search_form['map']['address_search']['type'] ) ? $mec_search_form['map']['address_search']['type'] : '0';
				$elementor_data['map_address_search_placeholder']				= isset( $mec_search_form['map']['address_search']['placeholder'] ) ? $mec_search_form['map']['address_search']['placeholder'] : '';
				$elementor_data['map_text_search_type'] 						= isset( $mec_search_form['map']['text_search']['type'] ) ? $mec_search_form['map']['text_search']['type'] : '0';
				$elementor_data['map_text_search_placeholder'] 					= isset( $mec_search_form['map']['text_search']['placeholder'] ) ? $mec_search_form['map']['text_search']['placeholder'] : '';
				$elementor_data['map_time_filter_type']							= isset( $mec_search_form['map']['time_filter']['type'] ) ? $mec_search_form['map']['time_filter']['type'] : '0';
				$elementor_data['map_event_cost_type']							= isset( $mec_search_form['map']['event_cost']['type'] ) ? $mec_search_form['map']['event_cost']['type'] : '0';
				// Daily Form
				$elementor_data['daily_category_type']     						= isset( $mec_search_form['daily_view']['category']['type'] ) ? $mec_search_form['daily_view']['category']['type'] : '0';
				$elementor_data['daily_location_type']     						= isset( $mec_search_form['daily_view']['location']['type'] ) ? $mec_search_form['daily_view']['location']['type'] : '0';
				$elementor_data['daily_organizer_type']    						= isset( $mec_search_form['daily_view']['organizer']['type'] ) ? $mec_search_form['daily_view']['organizer']['type'] : '0';
				$elementor_data['daily_label_type']        						= isset( $mec_search_form['daily_view']['label']['type'] ) ? $mec_search_form['daily_view']['label']['type'] : '0';
				$elementor_data['daily_address_search_type']					= isset( $mec_search_form['daily_view']['address_search']['type'] ) ? $mec_search_form['daily_view']['address_search']['type'] : '0';
				$elementor_data['daily_address_search_placeholder']				= isset( $mec_search_form['daily_view']['address_search']['placeholder'] ) ? $mec_search_form['daily_view']['address_search']['placeholder'] : '';
				$elementor_data['daily_month_filter_type'] 						= isset( $mec_search_form['daily_view']['month_filter']['type'] ) ? $mec_search_form['daily_view']['month_filter']['type'] : '0';
				$elementor_data['daily_text_search_type']  						= isset( $mec_search_form['daily_view']['text_search']['type'] ) ? $mec_search_form['daily_view']['text_search']['type'] : '0';
				$elementor_data['daily_text_search_placeholder']  				= isset( $mec_search_form['daily_view']['text_search']['placeholder'] ) ? $mec_search_form['daily_view']['text_search']['placeholder'] : '';
				$elementor_data['daily_time_filter_type']						= isset( $mec_search_form['daily_view']['time_filter']['type'] ) ? $mec_search_form['daily_view']['time_filter']['type'] : '0';
				$elementor_data['daily_event_cost_type']						= isset( $mec_search_form['daily_view']['event_cost']['type'] ) ? $mec_search_form['daily_view']['event_cost']['type'] : '0';
				// Weekly Form
				$elementor_data['weekly_category_type']     					= isset( $mec_search_form['weekly_view']['category']['type'] ) ? $mec_search_form['weekly_view']['category']['type'] : '0';
				$elementor_data['weekly_location_type']     					= isset( $mec_search_form['weekly_view']['location']['type'] ) ? $mec_search_form['weekly_view']['location']['type'] : '0';
				$elementor_data['weekly_organizer_type']    					= isset( $mec_search_form['weekly_view']['organizer']['type'] ) ? $mec_search_form['weekly_view']['organizer']['type'] : '0';
				$elementor_data['weekly_label_type']        					= isset( $mec_search_form['weekly_view']['label']['type'] ) ? $mec_search_form['weekly_view']['label']['type'] : '0';
				$elementor_data['weekly_address_search_type']					= isset( $mec_search_form['weekly_view']['address_search']['type'] ) ? $mec_search_form['weekly_view']['address_search']['type'] : '0';
				$elementor_data['weekly_address_search_placeholder']			= isset( $mec_search_form['weekly_view']['address_search']['placeholder'] ) ? $mec_search_form['weekly_view']['address_search']['placeholder'] : '';
				$elementor_data['weekly_month_filter_type'] 					= isset( $mec_search_form['weekly_view']['month_filter']['type'] ) ? $mec_search_form['weekly_view']['month_filter']['type'] : '0';
				$elementor_data['weekly_text_search_type']  					= isset( $mec_search_form['weekly_view']['text_search']['type'] ) ? $mec_search_form['weekly_view']['text_search']['type'] : '0';
				$elementor_data['weekly_text_search_placeholder']  				= isset( $mec_search_form['weekly_view']['text_search']['placeholder'] ) ? $mec_search_form['weekly_view']['text_search']['placeholder'] : '';
				$elementor_data['weekly_time_filter_type']						= isset( $mec_search_form['weekly_view']['time_filter']['type'] ) ? $mec_search_form['weekly_view']['time_filter']['type'] : '0';
				$elementor_data['weekly_event_cost_type']						= isset( $mec_search_form['weekly_view']['event_cost']['type'] ) ? $mec_search_form['weekly_view']['event_cost']['type'] : '0';
				// Timetable Form
				$elementor_data['timetable_category_type']     					= isset( $mec_search_form['timetable']['category']['type'] ) ? $mec_search_form['timetable']['category']['type'] : '0';
				$elementor_data['timetable_location_type']     					= isset( $mec_search_form['timetable']['location']['type'] ) ? $mec_search_form['timetable']['location']['type'] : '0';
				$elementor_data['timetable_organizer_type']    					= isset( $mec_search_form['timetable']['organizer']['type'] ) ? $mec_search_form['timetable']['organizer']['type'] : '0';
				$elementor_data['timetable_label_type']        					= isset( $mec_search_form['timetable']['label']['type'] ) ? $mec_search_form['timetable']['label']['type'] : '0';
				$elementor_data['timetable_address_search_type']				= isset( $mec_search_form['timetable']['address_search']['type'] ) ? $mec_search_form['timetable']['address_search']['type'] : '0';
				$elementor_data['timetable_address_search_placeholder']			= isset( $mec_search_form['timetable']['address_search']['placeholder'] ) ? $mec_search_form['timetable']['address_search']['placeholder'] : '';
				$elementor_data['timetable_month_filter_type'] 					= isset( $mec_search_form['timetable']['month_filter']['type'] ) ? $mec_search_form['timetable']['month_filter']['type'] : '0';
				$elementor_data['timetable_text_search_type']  					= isset( $mec_search_form['timetable']['text_search']['type'] ) ? $mec_search_form['timetable']['text_search']['type'] : '0';
				$elementor_data['timetable_text_search_placeholder']  			= isset( $mec_search_form['timetable']['text_search']['placeholder'] ) ? $mec_search_form['timetable']['text_search']['placeholder'] : '';
				$elementor_data['timetable_time_filter_type']					= isset( $mec_search_form['timetable']['time_filter']['type'] ) ? $mec_search_form['timetable']['time_filter']['type'] : '0';
				$elementor_data['timetable_event_cost_type']					= isset( $mec_search_form['timetable']['event_cost']['type'] ) ? $mec_search_form['timetable']['event_cost']['type'] : '0';
				// Custom Shortcode Form
				$elementor_data['custom_category_type']     					= isset( $mec_search_form['custom']['category']['type'] ) ? $mec_search_form['custom']['category']['type'] : '0';
				$elementor_data['custom_location_type']     					= isset( $mec_search_form['custom']['location']['type'] ) ? $mec_search_form['custom']['location']['type'] : '0';
				$elementor_data['custom_organizer_type']    					= isset( $mec_search_form['custom']['organizer']['type'] ) ? $mec_search_form['custom']['organizer']['type'] : '0';
				$elementor_data['custom_label_type']        					= isset( $mec_search_form['custom']['label']['type'] ) ? $mec_search_form['custom']['label']['type'] : '0';
				$elementor_data['custom_address_search_type']					= isset( $mec_search_form['custom']['address_search']['type'] ) ? $mec_search_form['custom']['address_search']['type'] : '0';
				$elementor_data['custom_address_search_placeholder']			= isset( $mec_search_form['custom']['address_search']['placeholder'] ) ? $mec_search_form['custom']['address_search']['placeholder'] : '';
				$elementor_data['custom_month_filter_type'] 					= isset( $mec_search_form['custom']['month_filter']['type'] ) ? $mec_search_form['custom']['month_filter']['type'] : '0';
				$elementor_data['custom_text_search_type']  					= isset( $mec_search_form['custom']['text_search']['type'] ) ? $mec_search_form['custom']['text_search']['type'] : '0';
				$elementor_data['custom_text_search_placeholder']  				= isset( $mec_search_form['custom']['text_search']['placeholder'] ) ? $mec_search_form['custom']['text_search']['placeholder'] : '';
				$elementor_data['custom_time_filter_type']						= isset( $mec_search_form['custom']['time_filter']['type'] ) ? $mec_search_form['custom']['time_filter']['type'] : '0';
				$elementor_data['custom_event_cost_type']						= isset( $mec_search_form['custom']['event_cost']['type'] ) ? $mec_search_form['custom']['event_cost']['type'] : '0';
				// Skin
				$mec_skin = $mec_data['sk-options'];

				// Custom skin
				$elementor_data['custom_style']                  				= isset( $mec_skin['custom']['style'] ) ? $mec_skin['custom']['style'] : '';
				$elementor_data['custom_start_date_type']        				= isset( $mec_skin['custom']['start_date_type'] ) ? $mec_skin['custom']['start_date_type'] : 'today';
				$elementor_data['custom_count']                 				= isset( $mec_skin['custom']['count'] ) ? $mec_skin['custom']['count'] : '1';
				$elementor_data['custom_limit']                  				= isset( $mec_skin['custom']['limit'] ) ? $mec_skin['custom']['limit'] : '';
				$elementor_data['custom_load_more_button']       				= isset( $mec_skin['custom']['load_more_button'] ) ? $mec_skin['custom']['load_more_button'] : '1';
				$elementor_data['custom_map_on_top']       						= isset( $mec_skin['custom']['map_on_top'] ) ? $mec_skin['custom']['map_on_top'] : '0';
				$elementor_data['custom_set_geolocation']       				= isset( $mec_skin['custom']['set_geolocation'] ) ? $mec_skin['custom']['set_geolocation'] : '0';
				$elementor_data['custom_month_divider']          				= isset( $mec_skin['custom']['month_divider'] ) ? $mec_skin['custom']['month_divider'] : '0';
				$elementor_data['custom_sed_method']             				= isset( $mec_skin['custom']['sed_method'] ) ? $mec_skin['custom']['sed_method'] : '0';
				// List skin
				$elementor_data['list_style']                  					= isset( $mec_skin['list']['style'] ) ? $mec_skin['list']['style'] : 'classic';
				$elementor_data['list_start_date_type']        					= isset( $mec_skin['list']['start_date_type'] ) ? $mec_skin['list']['start_date_type'] : 'today';
				$elementor_data['list_classic_date_format1']   					= isset( $mec_skin['list']['classic_date_format1'] ) ? $mec_skin['list']['classic_date_format1'] : 'M d Y';
				$elementor_data['list_minimal_date_format1']   					= isset( $mec_skin['list']['minimal_date_format1'] ) ? $mec_skin['list']['minimal_date_format1'] : 'd';
				$elementor_data['list_minimal_date_format2']   					= isset( $mec_skin['list']['minimal_date_format2'] ) ? $mec_skin['list']['minimal_date_format2'] : 'M';
				$elementor_data['list_minimal_date_format3']   					= isset( $mec_skin['list']['minimal_date_format3'] ) ? $mec_skin['list']['minimal_date_format3'] : 'l';
				$elementor_data['list_modern_date_format1']    					= isset( $mec_skin['list']['modern_date_format1'] ) ? $mec_skin['list']['modern_date_format1'] : 'd';
				$elementor_data['list_modern_date_format2']    					= isset( $mec_skin['list']['modern_date_format2'] ) ? $mec_skin['list']['modern_date_format2'] : 'F';
				$elementor_data['list_modern_date_format3']    					= isset( $mec_skin['list']['modern_date_format3'] ) ? $mec_skin['list']['modern_date_format3'] : 'l';
				$elementor_data['list_standard_date_format1']  					= isset( $mec_skin['list']['standard_date_format1'] ) ? $mec_skin['list']['standard_date_format1'] : 'd M';
				$elementor_data['list_accordion_date_format1'] 					= isset( $mec_skin['list']['accordion_date_format1'] ) ? $mec_skin['list']['accordion_date_format1'] : 'd';
				$elementor_data['list_accordion_date_format2'] 					= isset( $mec_skin['list']['accordion_date_format2'] ) ? $mec_skin['list']['accordion_date_format2'] : 'F';
				$elementor_data['list_start_date']             					= isset( $mec_skin['list']['start_date'] ) ? $mec_skin['list']['start_date'] : '';
				$elementor_data['list_limit']                  					= isset( $mec_skin['list']['limit'] ) ? $mec_skin['list']['limit'] : '';
				$elementor_data['list_load_more_button']       					= isset( $mec_skin['list']['load_more_button'] ) ? $mec_skin['list']['load_more_button'] : '1';
				$elementor_data['list_include_local_time']						= isset( $mec_skin['list']['include_local_time'] ) ? $mec_skin['list']['include_local_time'] : '1';
				$elementor_data['list_display_label']							= isset( $mec_skin['list']['display_label'] ) ? $mec_skin['list']['display_label'] : '1';
				$elementor_data['list_reason_for_cancellation']					= isset( $mec_skin['list']['reason_for_cancellation'] ) ? $mec_skin['list']['reason_for_cancellation'] : '1';
				$elementor_data['list_include_events_times']					= isset( $mec_skin['list']['include_events_times'] ) ? $mec_skin['list']['include_events_times'] : '1';
				$elementor_data['list_map_on_top']       						= isset( $mec_skin['list']['map_on_top'] ) ? $mec_skin['list']['map_on_top'] : '1';
				$elementor_data['list_set_geolocation']							= isset( $mec_skin['list']['set_geolocation'] ) ? $mec_skin['list']['set_geolocation'] : '1';
				$elementor_data['list_month_divider']          					= isset( $mec_skin['list']['month_divider'] ) ? $mec_skin['list']['month_divider'] : '1';
				$elementor_data['list_toggle_month_divider']   					= isset( $mec_skin['list']['toggle_month_divider'] ) ? $mec_skin['list']['toggle_month_divider'] : '0';
				$elementor_data['list_sed_method']             					= isset( $mec_skin['list']['sed_method'] ) ? $mec_skin['list']['sed_method'] : '0';
				// Grid skin
				$elementor_data['grid_style']                 					= isset( $mec_skin['grid']['style'] ) ? $mec_skin['grid']['style'] : 'classic';
				$elementor_data['grid_start_date_type']       					= isset( $mec_skin['grid']['start_date_type'] ) ? $mec_skin['grid']['start_date_type'] : 'today';
				$elementor_data['grid_classic_date_format1']  					= isset( $mec_skin['grid']['classic_date_format1'] ) ? $mec_skin['grid']['classic_date_format1'] : 'd F Y';
				$elementor_data['grid_clean_date_format1']    					= isset( $mec_skin['grid']['clean_date_format1'] ) ? $mec_skin['grid']['clean_date_format1'] : 'd';
				$elementor_data['grid_clean_date_format2']    					= isset( $mec_skin['grid']['clean_date_format2'] ) ? $mec_skin['grid']['clean_date_format2'] : 'F';
				$elementor_data['grid_minimal_date_format1']  					= isset( $mec_skin['grid']['minimal_date_format1'] ) ? $mec_skin['grid']['minimal_date_format1'] : 'd';
				$elementor_data['grid_minimal_date_format2']  					= isset( $mec_skin['grid']['minimal_date_format2'] ) ? $mec_skin['grid']['minimal_date_format2'] : 'M';
				$elementor_data['grid_modern_date_format1']   					= isset( $mec_skin['grid']['modern_date_format1'] ) ? $mec_skin['grid']['modern_date_format1'] : 'd';
				$elementor_data['grid_modern_date_format2']   					= isset( $mec_skin['grid']['modern_date_format2'] ) ? $mec_skin['grid']['modern_date_format2'] : 'F';
				$elementor_data['grid_modern_date_format3']   					= isset( $mec_skin['grid']['modern_date_format3'] ) ? $mec_skin['grid']['modern_date_format3'] : 'l';
				$elementor_data['grid_simple_date_format1']   					= isset( $mec_skin['grid']['simple_date_format1'] ) ? $mec_skin['grid']['simple_date_format1'] : 'M d Y';
				$elementor_data['grid_colorful_date_format1'] 					= isset( $mec_skin['grid']['colorful_date_format1'] ) ? $mec_skin['grid']['colorful_date_format1'] : 'd';
				$elementor_data['grid_colorful_date_format2'] 					= isset( $mec_skin['grid']['colorful_date_format2'] ) ? $mec_skin['grid']['colorful_date_format2'] : 'F';
				$elementor_data['grid_colorful_date_format3'] 					= isset( $mec_skin['grid']['colorful_date_format3'] ) ? $mec_skin['grid']['colorful_date_format3'] : 'l';
				$elementor_data['grid_novel_date_format1']    					= isset( $mec_skin['grid']['novel_date_format1'] ) ? $mec_skin['grid']['novel_date_format1'] : 'd F Y';
				$elementor_data['grid_start_date']            					= isset( $mec_skin['grid']['start_date'] ) ? $mec_skin['grid']['start_date'] : '';
				$elementor_data['grid_count']                 					= isset( $mec_skin['grid']['count'] ) ? $mec_skin['grid']['count'] : '1';
				$elementor_data['grid_limit']                 					= isset( $mec_skin['grid']['limit'] ) ? $mec_skin['grid']['limit'] : '';
				$elementor_data['grid_include_local_time']						= isset( $mec_skin['grid']['include_local_time'] ) ? $mec_skin['grid']['include_local_time'] : '1';
				$elementor_data['grid_display_label']							= isset( $mec_skin['grid']['display_label'] ) ? $mec_skin['grid']['display_label'] : '1';
				$elementor_data['grid_reason_for_cancellation']					= isset( $mec_skin['grid']['reason_for_cancellation'] ) ? $mec_skin['grid']['reason_for_cancellation'] : '1';
				$elementor_data['grid_include_events_times']					= isset( $mec_skin['grid']['include_events_times'] ) ? $mec_skin['grid']['include_events_times'] : '1';
				$elementor_data['grid_load_more_button']      					= isset( $mec_skin['grid']['load_more_button'] ) ? $mec_skin['grid']['load_more_button'] : '1';
				$elementor_data['grid_set_geolocation']      					= isset( $mec_skin['grid']['set_geolocation'] ) ? $mec_skin['grid']['set_geolocation'] : '1';
				$elementor_data['grid_sed_method']            					= isset( $mec_skin['grid']['sed_method'] ) ? $mec_skin['grid']['sed_method'] : '0';
				// Agenda skin
				$elementor_data['agenda_style']              					= isset( $mec_skin['agenda']['style'] ) ? $mec_skin['agenda']['style'] : 'clean';
				$elementor_data['agenda_start_date_type']    					= isset( $mec_skin['agenda']['start_date_type'] ) ? $mec_skin['agenda']['start_date_type'] : 'today';
				$elementor_data['agenda_clean_date_format1'] 					= isset( $mec_skin['agenda']['clean_date_format1'] ) ? $mec_skin['agenda']['clean_date_format1'] : 'l';
				$elementor_data['agenda_clean_date_format2'] 					= isset( $mec_skin['agenda']['clean_date_format2'] ) ? $mec_skin['agenda']['clean_date_format2'] : 'F j';
				$elementor_data['agenda_start_date']         					= isset( $mec_skin['agenda']['start_date'] ) ? $mec_skin['agenda']['start_date'] : '';
				$elementor_data['agenda_limit']              					= isset( $mec_skin['agenda']['limit'] ) ? $mec_skin['agenda']['limit'] : '';
				$elementor_data['agenda_include_local_time']					= isset( $mec_skin['agenda']['include_local_time'] ) ? $mec_skin['agenda']['include_local_time'] : '1';
				$elementor_data['agenda_display_label']					        = isset( $mec_skin['agenda']['display_label'] ) ? $mec_skin['agenda']['display_label'] : '1';
				$elementor_data['agenda_reason_for_cancellation']				= isset( $mec_skin['agenda']['reason_for_cancellation'] ) ? $mec_skin['agenda']['reason_for_cancellation'] : '1';
				$elementor_data['agenda_load_more_button']   					= isset( $mec_skin['agenda']['load_more_button'] ) ? $mec_skin['agenda']['load_more_button'] : '1';
				$elementor_data['agenda_month_divider']      					= isset( $mec_skin['agenda']['month_divider'] ) ? $mec_skin['agenda']['month_divider'] : '0';
				$elementor_data['agenda_sed_method']         					= isset( $mec_skin['agenda']['sed_method'] ) ? $mec_skin['agenda']['sed_method'] : '0';
				// Full Calendar skin
				$elementor_data['full_calendar_start_date_type'] 				= isset( $mec_skin['full_calendar']['start_date_type'] ) ? $mec_skin['full_calendar']['start_date_type'] : 'start_current_month';
				$elementor_data['full_calendar_start_date']      				= isset( $mec_skin['full_calendar']['start_date'] ) ? $mec_skin['full_calendar']['start_date'] : '';
				$elementor_data['full_calendar_default_view']    				= isset( $mec_skin['full_calendar']['default_view'] ) ? $mec_skin['full_calendar']['default_view'] : 'list';
				$elementor_data['full_calendar_monthly_style']   				= isset( $mec_skin['full_calendar']['monthly_style'] ) ? $mec_skin['full_calendar']['monthly_style'] : 'clean';
				$elementor_data['full_calendar_list']            				= isset( $mec_skin['full_calendar']['list'] ) ? $mec_skin['full_calendar']['list'] : '1';
				$elementor_data['full_calendar_date_format_list']				= isset( $mec_skin['full_calendar']['date_format_list'] ) ? $mec_skin['full_calendar']['date_format_list'] : 'd M';
				$elementor_data['full_calendar_grid']            				= isset( $mec_skin['full_calendar']['grid'] ) ? $mec_skin['full_calendar']['grid'] : '1';
				$elementor_data['full_calendar_tile']            				= isset( $mec_skin['full_calendar']['tile'] ) ? $mec_skin['full_calendar']['list'] : '1';
				$elementor_data['full_calendar_yearly']          				= isset( $mec_skin['full_calendar']['yearly'] ) ? $mec_skin['full_calendar']['yearly'] : '1';
				$elementor_data['full_calendar_date_format_yearly_1']			= isset( $mec_skin['full_calendar']['date_format_yearly_1'] ) ? $mec_skin['full_calendar']['date_format_yearly_1'] : 'l';
				$elementor_data['full_calendar_date_format_yearly_2']			= isset( $mec_skin['full_calendar']['date_format_yearly_2'] ) ? $mec_skin['full_calendar']['date_format_yearly_2'] : 'F j';
				$elementor_data['full_calendar_monthly']         				= isset( $mec_skin['full_calendar']['monthly'] ) ? $mec_skin['full_calendar']['monthly'] : '1';
				$elementor_data['full_calendar_weekly']          				= isset( $mec_skin['full_calendar']['weekly'] ) ? $mec_skin['full_calendar']['weekly'] : '1';
				$elementor_data['full_calendar_daily']           				= isset( $mec_skin['full_calendar']['daily'] ) ? $mec_skin['full_calendar']['daily'] : '1';
				$elementor_data['full_calendar_display_price']   				= isset( $mec_skin['full_calendar']['display_price'] ) ? $mec_skin['full_calendar']['display_price'] : '';
				$elementor_data['full_calendar_sed_method']      				= isset( $mec_skin['full_calendar']['sed_method'] ) ? $mec_skin['full_calendar']['sed_method'] : '';
				$elementor_data['full_calendar_display_label']					= isset( $mec_skin['full_calendar']['display_label'] ) ? $mec_skin['full_calendar']['display_label'] : '1';
				$elementor_data['full_calendar_reason_for_cancellation']		= isset( $mec_skin['full_calendar']['reason_for_cancellation'] ) ? $mec_skin['full_calendar']['reason_for_cancellation'] : '1';
				// Yearly skin
				$elementor_data['yearly_style']                					= isset( $mec_skin['yearly_view']['style'] ) ? $mec_skin['yearly_view']['style'] : 'modern';
				$elementor_data['yearly_start_date_type']      					= isset( $mec_skin['yearly_view']['start_date_type'] ) ? $mec_skin['yearly_view']['start_date_type'] : 'start_current_year';
				$elementor_data['yearly_start_date']           					= isset( $mec_skin['yearly_view']['start_date'] ) ? $mec_skin['yearly_view']['start_date'] : '';
				$elementor_data['yearly_modern_date_format1']  					= isset( $mec_skin['yearly_view']['modern_date_format1'] ) ? $mec_skin['yearly_view']['modern_date_format1'] : 'l';
				$elementor_data['yearly_modern_date_format2']  					= isset( $mec_skin['yearly_view']['modern_date_format2'] ) ? $mec_skin['yearly_view']['modern_date_format2'] : 'F j';
				$elementor_data['yearly_limit']                					= isset( $mec_skin['yearly_view']['limit'] ) ? $mec_skin['yearly_view']['limit'] : '';
				$elementor_data['yearly_include_local_time']					= isset( $mec_skin['yearly_view']['include_local_time'] ) ? $mec_skin['yearly_view']['include_local_time'] : '1';
				$elementor_data['yearly_display_label']							= isset( $mec_skin['yearly']['display_label'] ) ? $mec_skin['yearly']['display_label'] : '1';
				$elementor_data['yearly_reason_for_cancellation']				= isset( $mec_skin['yearly']['reason_for_cancellation'] ) ? $mec_skin['yearly']['reason_for_cancellation'] : '1';
				$elementor_data['yearly_next_previous_button'] 					= isset( $mec_skin['yearly_view']['next_previous_button'] ) ? $mec_skin['yearly_view']['next_previous_button'] : '1';
				$elementor_data['yearly_sed_method']           					= isset( $mec_skin['yearly_view']['sed_method'] ) ? $mec_skin['yearly_view']['sed_method'] : '0';
				// Tile skin
				$elementor_data['tile_start_date_type']      					= isset( $mec_skin['tile']['start_date_type'] ) ? $mec_skin['tile']['start_date_type'] : 'start_current_month';
				$elementor_data['tile_start_date']           					= isset( $mec_skin['tile']['start_date'] ) ? $mec_skin['tile']['start_date'] : '';
				$elementor_data['tile_clean_date_format1']						= isset( $mec_skin['tile']['_clean_date_format1'] ) ? $mec_skin['tile']['clean_date_format1'] : 'j'; 
				$elementor_data['tile_clean_date_format2']						= isset( $mec_skin['tile']['_clean_date_format2'] ) ? $mec_skin['tile']['clean_date_format2'] : 'M';
				$elementor_data['tile_count']                					= isset( $mec_skin['tile']['count'] ) ? $mec_skin['tile']['count'] : '2';
				$elementor_data['tile_next_previous_button'] 					= isset( $mec_skin['tile']['next_previous_button'] ) ? $mec_skin['tile']['next_previous_button'] : '1';
				$elementor_data['tile_sed_method']           					= isset( $mec_skin['tile']['sed_method'] ) ? $mec_skin['tile']['sed_method'] : '0';
				$elementor_data['tile_display_label']							= isset( $mec_skin['tile']['display_label'] ) ? $mec_skin['tile']['display_label'] : '1';
				$elementor_data['tile_reason_for_cancellation']					= isset( $mec_skin['tile']['reason_for_cancellation'] ) ? $mec_skin['tile']['reason_for_cancellation'] : '1';
				// Monthly skin
				$elementor_data['monthly_style']                				= isset( $mec_skin['monthly_view']['style'] ) ? $mec_skin['monthly_view']['style'] : 'classic';
				$elementor_data['monthly_start_date_type']      				= isset( $mec_skin['monthly_view']['start_date_type'] ) ? $mec_skin['monthly_view']['start_date_type'] : 'start_current_month';
				$elementor_data['monthly_start_date']           				= isset( $mec_skin['monthly_view']['start_date'] ) ? $mec_skin['monthly_view']['start_date'] : '';
				$elementor_data['monthly_limit']                				= isset( $mec_skin['monthly_view']['limit'] ) ? $mec_skin['monthly_view']['limit'] : '';
				$elementor_data['monthly_include_local_time']					= isset( $mec_skin['monthly_view']['include_local_time'] ) ? $mec_skin['monthly_view']['include_local_time'] : '1';
				$elementor_data['monthly_display_label']						= isset( $mec_skin['monthly']['display_label'] ) ? $mec_skin['monthly']['display_label'] : '1';
				$elementor_data['monthly_reason_for_cancellation']				= isset( $mec_skin['monthly']['reason_for_cancellation'] ) ? $mec_skin['monthly']['reason_for_cancellation'] : '1';
				$elementor_data['monthly_next_previous_button'] 				= isset( $mec_skin['monthly_view']['next_previous_button'] ) ? $mec_skin['monthly_view']['next_previous_button'] : '1';
				$elementor_data['monthly_sed_method']           				= isset( $mec_skin['monthly_view']['sed_method'] ) ? $mec_skin['monthly_view']['sed_method'] : '0';
				// Map skin
				$elementor_data['map_start_date_type'] 							= isset( $mec_skin['map']['start_date_type'] ) ? $mec_skin['map']['start_date_type'] : 'today';
				$elementor_data['map_start_date']      							= isset( $mec_skin['map']['start_date'] ) ? $mec_skin['map']['start_date'] : '';
				$elementor_data['map_limit']           							= isset( $mec_skin['map']['limit'] ) ? $mec_skin['map']['limit'] : '200';
				$elementor_data['map_sed_method']      							= isset( $mec_skin['map']['sed_method'] ) ? $mec_skin['map']['sed_method'] : '0';

				$elementor_data['map_zoom']      								= isset( $data['mec_location_map_zoom'] ) ? $data['mec_location_map_zoom'] : '8';
				$elementor_data['view_mode']      								= isset( $data['mec_location_view_mode'] ) ? $data['mec_location_view_mode'] : 'normal';
				$elementor_data['map_center_lat']      							= isset( $data['mec_location_map_center_lat'] ) ? $data['mec_location_map_center_lat'] : '0';
				$elementor_data['map_center_long']      						= isset( $data['mec_location_map_center_long'] ) ? $data['mec_location_map_center_long'] : '0';
				// Daily skin
				$elementor_data['daily_start_date_type']      					= isset( $mec_skin['daily_view']['start_date_type'] ) ? $mec_skin['daily_view']['start_date_type'] : 'today';
				$elementor_data['daily_start_date']           					= isset( $mec_skin['daily_view']['start_date'] ) ? $mec_skin['daily_view']['start_date'] : '';
				$elementor_data['daily_limit']                					= isset( $mec_skin['daily_view']['limit'] ) ? $mec_skin['daily_view']['limit'] : '';
				$elementor_data['daily_include_local_time']						= isset( $mec_skin['daily_view']['include_local_time'] ) ? $mec_skin['daily_view']['include_local_time'] : '1';
				$elementor_data['daily_display_label']							= isset( $mec_skin['daily']['display_label'] ) ? $mec_skin['daily']['display_label'] : '1';
				$elementor_data['daily_reason_for_cancellation']				= isset( $mec_skin['daily']['reason_for_cancellation'] ) ? $mec_skin['daily']['reason_for_cancellation'] : '1';
				$elementor_data['daily_next_previous_button'] 					= isset( $mec_skin['daily_view']['next_previous_button'] ) ? $mec_skin['daily_view']['next_previous_button'] : '1';
				$elementor_data['daily_sed_method']           					= isset( $mec_skin['daily_view']['sed_method'] ) ? $mec_skin['daily_view']['sed_method'] : '0';
				// Weekly skin
				$elementor_data['weekly_start_date_type']      					= isset( $mec_skin['weekly_view']['start_date_type'] ) ? $mec_skin['weekly_view']['start_date_type'] : 'start_current_week';
				$elementor_data['weekly_start_date']           					= isset( $mec_skin['weekly_view']['start_date'] ) ? $mec_skin['weekly_view']['start_date'] : '';
				$elementor_data['weekly_limit']                					= isset( $mec_skin['weekly_view']['limit'] ) ? $mec_skin['weekly_view']['limit'] : '';
				$elementor_data['weekly_include_local_time']					= isset( $mec_skin['weekly_view']['include_local_time'] ) ? $mec_skin['weekly_view']['include_local_time'] : '1';
				$elementor_data['weekly_display_label']							= isset( $mec_skin['weekly']['display_label'] ) ? $mec_skin['weekly']['display_label'] : '1';
				$elementor_data['weekly_reason_for_cancellation']				= isset( $mec_skin['weekly']['reason_for_cancellation'] ) ? $mec_skin['weekly']['reason_for_cancellation'] : '1';
				$elementor_data['weekly_next_previous_button'] 					= isset( $mec_skin['weekly_view']['next_previous_button'] ) ? $mec_skin['weekly_view']['next_previous_button'] : '1';
				$elementor_data['weekly_sed_method']           					= isset( $mec_skin['weekly_view']['sed_method'] ) ? $mec_skin['weekly_view']['sed_method'] : '0';
				// Timetable skin
				$elementor_data['timetable_style']                				= isset( $mec_skin['timetable']['style'] ) ? $mec_skin['timetable']['style'] : 'modern';
				$elementor_data['timetable_start_date_type']      				= isset( $mec_skin['timetable']['start_date_type'] ) ? $mec_skin['timetable']['start_date_type'] : 'start_current_week';
				$elementor_data['timetable_start_date']           				= isset( $mec_skin['timetable']['start_date'] ) ? $mec_skin['timetable']['start_date'] : '';
				$elementor_data['timetable_limit']                				= isset( $mec_skin['timetable']['limit'] ) ? $mec_skin['timetable']['limit'] : '';
				$elementor_data['timetable_include_local_time']					= isset( $mec_skin['timetable']['include_local_time'] ) ? $mec_skin['timetable']['include_local_time'] : '1';
				$elementor_data['timetable_number_of_days']						= isset( $mec_skin['timetable']['number_of_days'] ) ? $mec_skin['timetable']['number_of_days'] : '5';
				$elementor_data['timetable_week_start']							= isset( $mec_skin['timetable']['week_start'] ) ? $mec_skin['timetable']['week_start'] : '1';
				$elementor_data['timetable_display_label']						= isset( $mec_skin['timetable']['display_label'] ) ? $mec_skin['timetable']['display_label'] : '1';
				$elementor_data['timetable_reason_for_cancellation']			= isset( $mec_skin['timetable']['reason_for_cancellation'] ) ? $mec_skin['timetable']['reason_for_cancellation'] : '1';
				$elementor_data['timetable_next_previous_button'] 				= isset( $mec_skin['timetable']['next_previous_button'] ) ? $mec_skin['timetable']['next_previous_button'] : '1';
				$elementor_data['timetable_sed_method']           				= isset( $mec_skin['timetable']['sed_method'] ) ? $mec_skin['timetable']['sed_method'] : '0';
				// Masonry skin
				$elementor_data['masonry_start_date_type']   					= isset( $mec_skin['masonry']['start_date_type'] ) ? $mec_skin['masonry']['start_date_type'] : 'today';
				$elementor_data['masonry_start_date']        					= isset( $mec_skin['masonry']['start_date'] ) ? $mec_skin['masonry']['start_date'] : '';
				$elementor_data['masonry_date_format1']      					= isset( $mec_skin['masonry']['date_format1'] ) ? $mec_skin['masonry']['date_format1'] : 'j';
				$elementor_data['masonry_date_format2']      					= isset( $mec_skin['masonry']['date_format2'] ) ? $mec_skin['masonry']['date_format2'] : 'F';
				$elementor_data['masonry_limit']             					= isset( $mec_skin['masonry']['limit'] ) ? $mec_skin['masonry']['limit'] : '';
				$elementor_data['masonry_include_local_time']					= isset( $mec_skin['masonry']['include_local_time'] ) ? $mec_skin['masonry']['include_local_time'] : '1';
				$elementor_data['masonry_display_label']						= isset( $mec_skin['masonry']['display_label'] ) ? $mec_skin['masonry']['display_label'] : '1';
				$elementor_data['masonry_reason_for_cancellation']				= isset( $mec_skin['masonry']['reason_for_cancellation'] ) ? $mec_skin['masonry']['reason_for_cancellation'] : '1';
				$elementor_data['masonry_filter_by']         					= isset( $mec_skin['masonry']['filter_by'] ) ? $mec_skin['masonry']['filter_by'] : '';
				$elementor_data['masonry_masonry_like_grid'] 					= isset( $mec_skin['masonry']['masonry_like_grid'] ) ? $mec_skin['masonry']['masonry_like_grid'] : '0';
				$elementor_data['masonry_sed_method']        					= isset( $mec_skin['masonry']['sed_method'] ) ? $mec_skin['masonry']['sed_method'] : '0';
				// Cover skin
				$elementor_data['cover_style']                					= isset( $mec_skin['cover']['style'] ) ? $mec_skin['cover']['style'] : 'classic';
				$elementor_data['cover_date_format_clean1']   					= isset( $mec_skin['cover']['date_format_clean1'] ) ? $mec_skin['cover']['date_format_clean1'] : 'd';
				$elementor_data['cover_date_format_clean2']   					= isset( $mec_skin['cover']['date_format_clean2'] ) ? $mec_skin['cover']['date_format_clean2'] : 'M';
				$elementor_data['cover_date_format_clean3']   					= isset( $mec_skin['cover']['date_format_clean3'] ) ? $mec_skin['cover']['date_format_clean3'] : 'Y';
				$elementor_data['cover_date_format_classic1'] 					= isset( $mec_skin['cover']['date_format_classic1'] ) ? $mec_skin['cover']['date_format_classic1'] : 'F d';
				$elementor_data['cover_date_format_classic2'] 					= isset( $mec_skin['cover']['date_format_classic2'] ) ? $mec_skin['cover']['date_format_classic2'] : 'l';
				$elementor_data['cover_date_format_modern1']  					= isset( $mec_skin['cover']['date_format_modern1'] ) ? $mec_skin['cover']['date_format_modern1'] : 'l, F d Y';
				$elementor_data['cover_include_local_time']						= isset( $mec_skin['cover']['include_local_time'] ) ? $mec_skin['cover']['include_local_time'] : '1';
				$elementor_data['cover_display_label']							= isset( $mec_skin['cover']['display_label'] ) ? $mec_skin['cover']['display_label'] : '1';
				$elementor_data['cover_reason_for_cancellation']				= isset( $mec_skin['cover']['reason_for_cancellation'] ) ? $mec_skin['cover']['reason_for_cancellation'] : '1';
				$elementor_data['cover_event']                					= isset( $mec_skin['cover']['event_id'] ) ? $mec_skin['cover']['event_id'] : '10';
				// Countdown skin
				$elementor_data['countdown_style']               				= isset( $mec_skin['countdown']['style'] ) ? $mec_skin['countdown']['style'] : 'style1';
				$elementor_data['countdown_date_format_style11'] 				= isset( $mec_skin['countdown']['date_format_style11'] ) ? $mec_skin['countdown']['date_format_style11'] : 'j F Y';
				$elementor_data['countdown_date_format_style21'] 				= isset( $mec_skin['countdown']['date_format_style21'] ) ? $mec_skin['countdown']['date_format_style21'] : 'j F Y';
				$elementor_data['countdown_date_format_style31'] 				= isset( $mec_skin['countdown']['date_format_style31'] ) ? $mec_skin['countdown']['date_format_style31'] : 'j';
				$elementor_data['countdown_date_format_style32'] 				= isset( $mec_skin['countdown']['date_format_style32'] ) ? $mec_skin['countdown']['date_format_style32'] : 'F';
				$elementor_data['countdown_date_format_style33'] 				= isset( $mec_skin['countdown']['date_format_style33'] ) ? $mec_skin['countdown']['date_format_style33'] : 'Y';
				$elementor_data['countdown_event']               				= isset( $mec_skin['countdown']['event_id'] ) ? $mec_skin['countdown']['event_id'] : '-1';
				$elementor_data['countdown_include_local_time']					= isset( $mec_skin['countdown']['include_local_time'] ) ? $mec_skin['countdown']['include_local_time'] : '1';
				$elementor_data['countdown_display_label']						= isset( $mec_skin['countdown']['display_label'] ) ? $mec_skin['countdown']['display_label'] : '1';
				$elementor_data['countdown_reason_for_cancellation']			= isset( $mec_skin['countdown']['reason_for_cancellation'] ) ? $mec_skin['countdown']['reason_for_cancellation'] : '1';
				$elementor_data['countdown_bg_color']            				= isset( $mec_skin['countdown']['bg_color'] ) ? $mec_skin['countdown']['bg_color'] : '#437df9';
				// Available Spot skin
				$elementor_data['available_spot_date_format1'] 					= isset( $mec_skin['available_spot']['date_format1'] ) ? $mec_skin['available_spot']['date_format1'] : 'j';
				$elementor_data['available_spot_date_format2'] 					= isset( $mec_skin['available_spot']['date_format2'] ) ? $mec_skin['available_spot']['date_format2'] : 'F';
				$elementor_data['available_spot_event']        					= isset( $mec_skin['available_spot']['event_id'] ) ? $mec_skin['available_spot']['event_id'] : '-1';
				$elementor_data['available_spot_include_local_time']			= isset( $mec_skin['available_spot']['include_local_time'] ) ? $mec_skin['available_spot']['include_local_time'] : '1';
				$elementor_data['available_display_label']						= isset( $mec_skin['available']['display_label'] ) ? $mec_skin['available']['display_label'] : '1';
				$elementor_data['available_reason_for_cancellation']			= isset( $mec_skin['available']['reason_for_cancellation'] ) ? $mec_skin['available']['reason_for_cancellation'] : '1';
				// Timeline skin
				$elementor_data['timeline_start_date_type']    					= isset( $mec_skin['timeline']['start_date_type'] ) ? $mec_skin['timeline']['start_date_type'] 			: 'start_current_timeline';
				$elementor_data['timeline_start_date'] 							= isset( $mec_skin['timeline']['start_date'] ) ? $mec_skin['timeline']['start_date'] 				: '';
				$elementor_data['timeline_date_format1']	   					= isset( $mec_skin['timeline']['timeline_date_format1'] ) ? $mec_skin['timeline']['date_format1'] 	: 'd F Y';
				$elementor_data['timeline_limit'] 								= isset( $mec_skin['timeline']['limit'] ) ? $mec_skin['timeline']['limit'] 					: '';
				$elementor_data['timeline_load_more_button'] 					= isset( $mec_skin['timeline']['load_more_button'] ) ? $mec_skin['timeline']['load_more_button'] 		: '1';
				$elementor_data['timeline_include_local_time']					= isset( $mec_skin['timeline']['include_local_time'] ) ? $mec_skin['timeline']['include_local_time'] : '1';
				$elementor_data['timeline_display_label']						= isset( $mec_skin['timeline']['display_label'] ) ? $mec_skin['timeline']['display_label'] : '1';
				$elementor_data['timeline_reason_for_cancellation']				= isset( $mec_skin['timeline']['reason_for_cancellation'] ) ? $mec_skin['timeline']['reason_for_cancellation'] : '1';
				$elementor_data['timeline_month_divider'] 						= isset( $mec_skin['timeline']['month_divider'] ) ? $mec_skin['timeline']['month_divider'] 			: '0';
				$elementor_data['timeline_sed_method'] 							= isset( $mec_skin['timeline']['sed_method'] ) ? $mec_skin['timeline']['sed_method'] 				: '0';
				// Carousel skin
				$elementor_data['carousel_style']              					= isset( $mec_skin['carousel']['style'] ) ? $mec_skin['carousel']['style'] : 'type1';
				$elementor_data['carousel_start_date_type']    					= isset( $mec_skin['carousel']['start_date_type'] ) ? $mec_skin['carousel']['start_date_type'] : 'today';
				$elementor_data['carousel_start_date']         					= isset( $mec_skin['carousel']['start_date'] ) ? $mec_skin['carousel']['start_date'] : '';
				$elementor_data['carousel_type1_date_format1'] 					= isset( $mec_skin['carousel']['type1_date_format1'] ) ? $mec_skin['carousel']['type1_date_format1'] : 'd';
				$elementor_data['carousel_type1_date_format2'] 					= isset( $mec_skin['carousel']['type1_date_format2'] ) ? $mec_skin['carousel']['type1_date_format2'] : 'F';
				$elementor_data['carousel_type1_date_format3'] 					= isset( $mec_skin['carousel']['type1_date_format3'] ) ? $mec_skin['carousel']['type1_date_format3'] : 'Y';
				$elementor_data['carousel_type2_date_format1'] 					= isset( $mec_skin['carousel']['type2_date_format1'] ) ? $mec_skin['carousel']['type2_date_format1'] : 'M d, Y';
				$elementor_data['carousel_type3_date_format1'] 					= isset( $mec_skin['carousel']['type3_date_format1'] ) ? $mec_skin['carousel']['type3_date_format1'] : 'M d, Y';
				$elementor_data['carousel_count']              					= isset( $mec_skin['carousel']['count'] ) ? $mec_skin['carousel']['count'] : '2';
				$elementor_data['carousel_limit']              					= isset( $mec_skin['carousel']['limit'] ) ? $mec_skin['carousel']['limit'] : '';
				$elementor_data['carousel_include_local_time']					= isset( $mec_skin['carousel']['include_local_time'] ) ? $mec_skin['carousel']['include_local_time'] : '1';
				$elementor_data['carousel_display_label']						= isset( $mec_skin['carousel']['display_label'] ) ? $mec_skin['carousel']['display_label'] : '1';
				$elementor_data['carousel_reason_for_cancellation']				= isset( $mec_skin['carousel']['reason_for_cancellation'] ) ? $mec_skin['carousel']['reason_for_cancellation'] : '1';
				$elementor_data['carousel_autoplay']           					= isset( $mec_skin['carousel']['autoplay'] ) ? $mec_skin['carousel']['autoplay'] : '';
				$elementor_data['carousel_archive_link']       					= isset( $mec_skin['carousel']['archive_link'] ) ? $mec_skin['carousel']['archive_link'] : '';
				$elementor_data['carousel_head_text']          					= isset( $mec_skin['carousel']['head_text'] ) ? $mec_skin['carousel']['head_text'] : '';
				// Slider skin
				$elementor_data['slider_style']              					= isset( $mec_skin['slider']['style'] ) ? $mec_skin['slider']['style'] : 't1';
				$elementor_data['slider_start_date_type']    					= isset( $mec_skin['slider']['start_date_type'] ) ? $mec_skin['slider']['start_date_type'] : 'today';
				$elementor_data['slider_start_date']         					= isset( $mec_skin['slider']['start_date'] ) ? $mec_skin['slider']['start_date'] : '';
				$elementor_data['slider_type1_date_format1'] 					= isset( $mec_skin['slider']['type1_date_format1'] ) ? $mec_skin['slider']['type1_date_format1'] : 'd';
				$elementor_data['slider_type1_date_format2'] 					= isset( $mec_skin['slider']['type1_date_format2'] ) ? $mec_skin['slider']['type1_date_format2'] : 'F';
				$elementor_data['slider_type1_date_format3'] 					= isset( $mec_skin['slider']['type1_date_format3'] ) ? $mec_skin['slider']['type1_date_format3'] : 'l';
				$elementor_data['slider_type2_date_format1'] 					= isset( $mec_skin['slider']['type2_date_format1'] ) ? $mec_skin['slider']['type2_date_format1'] : 'd';
				$elementor_data['slider_type2_date_format2'] 					= isset( $mec_skin['slider']['type2_date_format2'] ) ? $mec_skin['slider']['type2_date_format2'] : 'F';
				$elementor_data['slider_type2_date_format3'] 					= isset( $mec_skin['slider']['type2_date_format3'] ) ? $mec_skin['slider']['type2_date_format3'] : 'l';
				$elementor_data['slider_type3_date_format1'] 					= isset( $mec_skin['slider']['type3_date_format1'] ) ? $mec_skin['slider']['type3_date_format1'] : 'd';
				$elementor_data['slider_type3_date_format2'] 					= isset( $mec_skin['slider']['type3_date_format2'] ) ? $mec_skin['slider']['type3_date_format2'] : 'F';
				$elementor_data['slider_type3_date_format3'] 					= isset( $mec_skin['slider']['type3_date_format3'] ) ? $mec_skin['slider']['type3_date_format3'] : 'l';
				$elementor_data['slider_type4_date_format1'] 					= isset( $mec_skin['slider']['type4_date_format1'] ) ? $mec_skin['slider']['type4_date_format1'] : 'd';
				$elementor_data['slider_type4_date_format2'] 					= isset( $mec_skin['slider']['type4_date_format2'] ) ? $mec_skin['slider']['type4_date_format2'] : 'F';
				$elementor_data['slider_type4_date_format3'] 					= isset( $mec_skin['slider']['type4_date_format3'] ) ? $mec_skin['slider']['type4_date_format3'] : 'l';
				$elementor_data['slider_type5_date_format1'] 					= isset( $mec_skin['slider']['type5_date_format1'] ) ? $mec_skin['slider']['type5_date_format1'] : 'd';
				$elementor_data['slider_type5_date_format2'] 					= isset( $mec_skin['slider']['type5_date_format2'] ) ? $mec_skin['slider']['type5_date_format2'] : 'F';
				$elementor_data['slider_type5_date_format3'] 					= isset( $mec_skin['slider']['type5_date_format3'] ) ? $mec_skin['slider']['type5_date_format3'] : 'l';
				$elementor_data['slider_limit']              					= isset( $mec_skin['slider']['limit'] ) ? $mec_skin['slider']['limit'] : '';
				$elementor_data['slider_include_local_time']					= isset( $mec_skin['slider']['include_local_time'] ) ? $mec_skin['slider']['include_local_time'] : '1';
				$elementor_data['slider_display_label']							= isset( $mec_skin['slider']['display_label'] ) ? $mec_skin['slider']['display_label'] : '1';
				$elementor_data['slider_reason_for_cancellation']				= isset( $mec_skin['slider']['reason_for_cancellation'] ) ? $mec_skin['slider']['reason_for_cancellation'] : '1';
				$elementor_data['slider_autoplay']           					= isset( $mec_skin['slider']['autoplay'] ) ? $mec_skin['slider']['autoplay'] : '';

				if ( ! isset( get_post_meta( $post_id )['_elementor_data'] ) || get_post_meta( $post_id )['_elementor_data'] == null ) {
					if ( $update ) {
						update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
					}
					update_post_meta( $post_id, '_elementor_template_type', 'post' );
					update_post_meta( $post_id, '_wp_page_template', 'default' );
					update_post_meta( $post_id, '_edit_lock', time() . ':1' );
					update_post_meta( $post_id, '_elementor_version', '0.4' );
					update_post_meta(
						$post_id,
						'_elementor_data',
						'[{
						"id": "' . uniqid() . '",
						"settings": [],
						"elements": [{
							"id": "' . uniqid() . '",
							"settings": {
								"_column_size": 100
							},
							"elements": [{
								"id": "' . uniqid() . '",
								"settings": ' . json_encode( $elementor_data ) . ',
								"elements": [],
								"isInner": false,
								"widgetType": "MEC-SHORTCODE-BUILDER",
								"elType": "widget"
							}],
							"isInner": false,
							"elType": "column"
						}],
						"isInner": false,
						"elType": "section"
					}]'
					);
				} else {
					update_post_meta(
						$post_id,
						'_elementor_data',
						'[{
						"id": "' . uniqid() . '",
						"settings": [],
						"elements": [{
							"id": "' . uniqid() . '",
							"settings": {
								"_column_size": 100
							},
							"elements": [{
								"id": "' . uniqid() . '",
								"settings": ' . json_encode( $elementor_data ) . ',
								"elements": [],
								"isInner": false,
								"widgetType": "MEC-SHORTCODE-BUILDER",
								"elType": "widget"
							}],
							"isInner": false,
							"elType": "column"
						}],
						"isInner": false,
						"elType": "section"
					}]'
					);
				}
			} else {
				if ( ! is_array( $data['actions'] ) && ! is_object( $data['actions'] ) ) {
					$data['actions'] = str_replace( '\"', '"', $data['actions'] );
					$data['actions'] = json_decode( $data['actions'], true );
				}

				$elementor_data = $data['actions']['save_builder']['data']['elements'][0]['elements'][0]['elements'][0]['settings'];
				$mec_data       = [];

				$elementor_data['filter_options']['dates'] = isset( $elementor_data['filter_options']['dates'] ) ? $elementor_data['filter_options']['dates'] : 'include-expired-events';
				if ( $elementor_data['filter_options']['dates'] == 'include-expired-events' ) {
					$mec_data['show_past_events']         = 1;
					$mec_data['show_only_past_events']    = 0;
					$mec_data['show_only_ongoing_events'] = 0;
					$mec_data['show_ongoing_events'] 	  = 0;
				} elseif ( $elementor_data['filter_options']['dates'] == 'show-only-ongoing-events' ) {
					$mec_data['show_past_events']         = 0;
					$mec_data['show_only_past_events']    = 0;
					$mec_data['show_only_ongoing_events'] = 1;
					$mec_data['show_ongoing_events'] 	  = 1;
				} elseif ( $elementor_data['filter_options']['dates'] == 'show-only-expired-events' ) {
					$mec_data['show_past_events']         = 1;
					$mec_data['show_only_past_events']    = 1;
					$mec_data['show_only_ongoing_events'] = 0;
					$mec_data['show_ongoing_events'] 	  = 0;
				} elseif ( $elementor_data['filter_options']['dates'] == 'show-only-expired-events' ) {
					$mec_data['show_past_events']         = 1;
					$mec_data['show_only_past_events']    = 0;
					$mec_data['show_only_ongoing_events'] = 0;
					$mec_data['show_ongoing_events'] 	  = 1;
				}

				// Skin name
				$mec_data['skin'] = isset( $elementor_data['skin'] ) ? $elementor_data['skin'] : 'list';

				// Search form status
				switch ( $mec_data['skin'] ) {
					case 'list':
						$mec_data['sf_status'] = isset( $elementor_data['list_sf_status'] ) && $elementor_data['list_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['list_sf_display_label'] ) && $elementor_data['list_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'grid':
						$mec_data['sf_status'] = isset( $elementor_data['grid_sf_status'] ) && $elementor_data['grid_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['grid_sf_display_label'] ) && $elementor_data['grid_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'agenda':
						$mec_data['sf_status'] = isset( $elementor_data['agenda_sf_status'] ) && $elementor_data['agenda_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['agenda_sf_display_label'] ) && $elementor_data['agenda_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'full_calendar':
						$mec_data['sf_status'] = isset( $elementor_data['full_calendar_sf_status'] ) && $elementor_data['full_calendar_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['full_calendar_sf_display_label'] ) && $elementor_data['full_calendar_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'monthly_view':
						$mec_data['sf_status'] = isset( $elementor_data['monthly_sf_status'] ) && $elementor_data['monthly_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['monthly_sf_display_label'] ) && $elementor_data['monthly_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'yearly_view':
						$mec_data['sf_status'] = isset( $elementor_data['yearly_sf_status'] ) && $elementor_data['yearly_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['yearly_sf_display_label'] ) && $elementor_data['yearly_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'map':
						$mec_data['sf_status'] = isset( $elementor_data['map_sf_status'] ) && $elementor_data['map_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['map_sf_display_label'] ) && $elementor_data['map_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'daily_view':
						$mec_data['sf_status'] = isset( $elementor_data['daily_sf_status'] ) && $elementor_data['daily_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['daily_sf_display_label'] ) && $elementor_data['daily_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'weekly_view':
						$mec_data['sf_status'] = isset( $elementor_data['weekly_sf_status'] ) && $elementor_data['weekly_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['weekly_sf_display_label'] ) && $elementor_data['weekly_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'timetable':
						$mec_data['sf_status'] = isset( $elementor_data['timetable_sf_status'] ) && $elementor_data['timetable_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['timetable_sf_display_label'] ) && $elementor_data['timetable_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'tile':
						$mec_data['sf_status'] = isset( $elementor_data['tile_sf_status'] ) && $elementor_data['tile_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['tile_sf_display_label'] ) && $elementor_data['tile_sf_display_label'] == '0' ? '0' : '1';
						break;
					case 'custom':
						$mec_data['sf_status'] = isset( $elementor_data['custom_sf_status'] ) && $elementor_data['custom_sf_status'] == '0' ? '0' : '1';
						$mec_data['sf_display_label'] = isset( $elementor_data['custom_sf_display_label'] ) && $elementor_data['custom_sf_display_label'] == '0' ? '0' : '1';
						break;
				}

				// List Form
				$mec_data['sf-options']['list']['category']     						= isset( $elementor_data['list_category_type'] ) ? [ 'type' => $elementor_data['list_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['location']     						= isset( $elementor_data['list_location_type'] ) ? [ 'type' => $elementor_data['list_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['organizer']    						= isset( $elementor_data['list_organizer_type'] ) ? [ 'type' => $elementor_data['list_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['label']        						= isset( $elementor_data['list_label_type'] ) ? [ 'type' => $elementor_data['list_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['address_search']['type']				= isset( $elementor_data['list_address_search_type'] ) ?  $elementor_data['list_address_search_type'] :  '0';
				$mec_data['sf-options']['list']['address_search']['placeholder']		= isset( $elementor_data['list_address_search_placeholder'] ) ? $elementor_data['list_address_search_placeholder']: '';
				$mec_data['sf-options']['list']['month_filter'] 						= isset( $elementor_data['list_month_filter_type'] ) ? [ 'type' => $elementor_data['list_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['time_filter']  						= isset( $elementor_data['list_time_filter_type'] ) ? [ 'type' => $elementor_data['list_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['event_cost']  							= isset( $elementor_data['list_event_cost_type'] ) ? [ 'type' => $elementor_data['list_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['list']['text_search']['type']					= isset( $elementor_data['list_text_search_type'] ) ? $elementor_data['list_text_search_type']:'0';
				$mec_data['sf-options']['list']['text_search']['placeholder']			= isset( $elementor_data['list_text_search_placeholder'] ) ? $elementor_data['list_text_search_placeholder']: '';
				// Grid Form
				$mec_data['sf-options']['grid']['category']     						= isset( $elementor_data['grid_category_type'] ) ? [ 'type' => $elementor_data['grid_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['location']     						= isset( $elementor_data['grid_location_type'] ) ? [ 'type' => $elementor_data['grid_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['organizer']    						= isset( $elementor_data['grid_organizer_type'] ) ? [ 'type' => $elementor_data['grid_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['label']        						= isset( $elementor_data['grid_label_type'] ) ? [ 'type' => $elementor_data['grid_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['address_search']['type']				= isset( $elementor_data['grid_address_search_type'] ) ? $elementor_data['grid_address_search_type'] : '0';
				$mec_data['sf-options']['grid']['address_search']['placeholder']		= isset( $elementor_data['grid_address_search_placeholder'] ) ? $elementor_data['grid_address_search_placeholder'] : '';
				$mec_data['sf-options']['grid']['month_filter'] 						= isset( $elementor_data['grid_month_filter_type'] ) ? [ 'type' => $elementor_data['grid_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['time_filter'] 							= isset( $elementor_data['grid_time_filter_type'] ) ? [ 'type' => $elementor_data['grid_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['event_cost'] 							= isset( $elementor_data['grid_event_cost_type'] ) ? [ 'type' => $elementor_data['grid_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['grid']['text_search']['type']					= isset( $elementor_data['grid_text_search_type'] ) ? $elementor_data['grid_text_search_type'] : '0';
				$mec_data['sf-options']['grid']['text_search']['placeholder']			= isset( $elementor_data['grid_text_search_placeholder'] ) ? $elementor_data['grid_text_search_placeholder'] : '';
				// Agenda Form
				$mec_data['sf-options']['agenda']['category']     						= isset( $elementor_data['agenda_category_type'] ) ? [ 'type' => $elementor_data['agenda_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['location']     						= isset( $elementor_data['agenda_location_type'] ) ? [ 'type' => $elementor_data['agenda_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['organizer']    						= isset( $elementor_data['agenda_organizer_type'] ) ? [ 'type' => $elementor_data['agenda_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['label']        						= isset( $elementor_data['agenda_label_type'] ) ? [ 'type' => $elementor_data['agenda_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['address_search']['type']				= isset( $elementor_data['agenda_address_search_type'] ) ? $elementor_data['agenda_address_search_type'] : '0';
				$mec_data['sf-options']['agenda']['address_search']['placeholder']		= isset( $elementor_data['agenda_address_search_placeholder'] ) ? $elementor_data['agenda_address_search_placeholder'] : '';
				$mec_data['sf-options']['agenda']['month_filter'] 						= isset( $elementor_data['agenda_month_filter_type'] ) ? [ 'type' => $elementor_data['agenda_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['time_filter'] 						= isset( $elementor_data['agenda_time_filter_type'] ) ? [ 'type' => $elementor_data['agenda_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['event_cost'] 						= isset( $elementor_data['agenda_event_cost_type'] ) ? [ 'type' => $elementor_data['agenda_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['text_search']['type']				= isset( $elementor_data['agenda_text_search_type'] ) ? $elementor_data['agenda_text_search_type'] : [ 'type' => '0' ];
				$mec_data['sf-options']['agenda']['text_search']['placeholder']			= isset( $elementor_data['agenda_text_search_placeholder'] ) ? $elementor_data['agenda_text_search_placeholder'] : '';
				// Full Calendar Form
				$mec_data['sf-options']['full_calendar']['category']     				= isset( $elementor_data['full_calendar_category_type'] ) ? [ 'type' => $elementor_data['full_calendar_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['location']     				= isset( $elementor_data['full_calendar_location_type'] ) ? [ 'type' => $elementor_data['full_calendar_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['organizer']    				= isset( $elementor_data['full_calendar_organizer_type'] ) ? [ 'type' => $elementor_data['full_calendar_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['speaker']      				= isset( $elementor_data['full_calendar_speaker_type'] ) ? [ 'type' => $elementor_data['full_calendar_speaker_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['tag']     	 				= isset( $elementor_data['full_calendar_tag_type'] ) ? [ 'type' => $elementor_data['full_calendar_tag_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['label']     	 				= isset( $elementor_data['full_calendar_label_type'] ) ? [ 'type' => $elementor_data['full_calendar_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['address_search']['type']			= isset( $elementor_data['full_calendar_address_search_type'] ) ? $elementor_data['full_calendar_address_search_type'] : '0';
				$mec_data['sf-options']['full_calendar']['address_search']['placeholder']	= isset( $elementor_data['full_calendar_address_search_placeholder'] ) ? $elementor_data['full_calendar_address_search_placeholder'] : '';
				$mec_data['sf-options']['full_calendar']['month_filter'] 				= isset( $elementor_data['full_calendar_month_filter_type'] ) ? [ 'type' => $elementor_data['full_calendar_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['time_filter'] 				= isset( $elementor_data['full_calendar_time_filter_type'] ) ? [ 'type' => $elementor_data['full_calendar_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['event_cost'] 					= isset( $elementor_data['full_calendar_event_cost_type'] ) ? [ 'type' => $elementor_data['full_calendar_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['full_calendar']['text_search']['type']			= isset( $elementor_data['full_calendar_text_search_type'] ) ? $elementor_data['full_calendar_text_search_type'] : '0';
				$mec_data['sf-options']['full_calendar']['text_search']['placeholder']	= isset( $elementor_data['full_calendar_text_search_placeholder'] ) ? $elementor_data['full_calendar_text_search_placeholder'] : '';
				// Monthly Form
				$mec_data['sf-options']['monthly_view']['category']     				= isset( $elementor_data['monthly_category_type'] ) ? [ 'type' => $elementor_data['monthly_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['location']     				= isset( $elementor_data['monthly_location_type'] ) ? [ 'type' => $elementor_data['monthly_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['organizer']    				= isset( $elementor_data['monthly_organizer_type'] ) ? [ 'type' => $elementor_data['monthly_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['label']        				= isset( $elementor_data['monthly_label_type'] ) ? [ 'type' => $elementor_data['monthly_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['address_search']['type']			= isset( $elementor_data['monthly_address_search_type'] ) ? $elementor_data['monthly_address_search_type'] : '0';
				$mec_data['sf-options']['monthly_view']['address_search']['placeholder']	= isset( $elementor_data['monthly_address_search_placeholder'] ) ? $elementor_data['monthly_address_search_placeholder'] : '';
				$mec_data['sf-options']['monthly_view']['month_filter'] 				= isset( $elementor_data['monthly_month_filter_type'] ) ? [ 'type' => $elementor_data['monthly_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['time_filter'] 					= isset( $elementor_data['monthly_time_filter_type'] ) ? [ 'type' => $elementor_data['monthly_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['event_cost'] 					= isset( $elementor_data['monthly_event_cost_type'] ) ? [ 'type' => $elementor_data['monthly_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['monthly_view']['text_search']['type']			= isset( $elementor_data['monthly_text_search_type'] ) ? $elementor_data['monthly_text_search_type'] : '0';
				$mec_data['sf-options']['monthly_view']['text_search']['placeholder']	= isset( $elementor_data['monthly_text_search_placeholder'] ) ? $elementor_data['monthly_text_search_placeholder'] : '';
				// Yearly Form
				$mec_data['sf-options']['yearly_view']['category']     					= isset( $elementor_data['yearly_category_type'] ) ? [ 'type' => $elementor_data['yearly_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['location']     					= isset( $elementor_data['yearly_location_type'] ) ? [ 'type' => $elementor_data['yearly_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['organizer']    					= isset( $elementor_data['yearly_organizer_type'] ) ? [ 'type' => $elementor_data['yearly_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['label']        					= isset( $elementor_data['yearly_label_type'] ) ? [ 'type' => $elementor_data['yearly_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['address_search']['type']		= isset( $elementor_data['yearly_address_search_type'] ) ? $elementor_data['yearly_address_search_type'] : '0';
				$mec_data['sf-options']['yearly_view']['address_search']['placeholder']	= isset( $elementor_data['yearly_address_search_placeholder'] ) ? $elementor_data['yearly_address_search_placeholder'] : '';
				$mec_data['sf-options']['yearly_view']['month_filter'] 					= isset( $elementor_data['yearly_month_filter_type'] ) ? [ 'type' => $elementor_data['yearly_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['time_filter'] 					= isset( $elementor_data['yearly_time_filter_type'] ) ? [ 'type' => $elementor_data['yearly_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['event_cost'] 					= isset( $elementor_data['yearly_event_cost_type'] ) ? [ 'type' => $elementor_data['yearly_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['yearly_view']['text_search']['type']			= isset( $elementor_data['yearly_text_search_type'] ) ? $elementor_data['yearly_text_search_type'] : '0';
				$mec_data['sf-options']['yearly_view']['text_search']['placeholder']	= isset( $elementor_data['yearly_text_search_placeholder'] ) ? $elementor_data['yearly_text_search_placeholder'] : '';
				// Map Form
				$mec_data['sf-options']['map']['category']    							= isset( $elementor_data['map_category_type'] ) ? [ 'type' => $elementor_data['map_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['map']['location']    							= isset( $elementor_data['map_location_type'] ) ? [ 'type' => $elementor_data['map_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['map']['organizer']   							= isset( $elementor_data['map_organizer_type'] ) ? [ 'type' => $elementor_data['map_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['map']['label']       							= isset( $elementor_data['map_label_type'] ) ? [ 'type' => $elementor_data['map_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['map']['address_search']['type']				= isset( $elementor_data['map_address_search_type'] ) ? $elementor_data['map_address_search_type'] : '0';
				$mec_data['sf-options']['map']['address_search']['placeholder']			= isset( $elementor_data['map_address_search_placeholder'] ) ? $elementor_data['map_address_search_placeholder'] : '';
				$mec_data['sf-options']['map']['time_filter']							= isset( $elementor_data['map_time_filter_type'] ) ? [ 'type' => $elementor_data['map_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['map']['event_cost']							= isset( $elementor_data['map_event_cost_type'] ) ? [ 'type' => $elementor_data['map_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['map']['text_search']['type']					= isset( $elementor_data['map_text_search_type'] ) ? $elementor_data['map_text_search_type'] : '0';
				$mec_data['sf-options']['map']['text_search']['placeholder']			= isset( $elementor_data['map_text_search_placeholder'] ) ? $elementor_data['map_text_search_placeholder'] : '';
				// Daily Form
				$mec_data['sf-options']['daily_view']['category']     					= isset( $elementor_data['daily_category_type'] ) ? [ 'type' => $elementor_data['daily_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['location']     					= isset( $elementor_data['daily_location_type'] ) ? [ 'type' => $elementor_data['daily_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['organizer']    					= isset( $elementor_data['daily_organizer_type'] ) ? [ 'type' => $elementor_data['daily_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['label']        					= isset( $elementor_data['daily_label_type'] ) ? [ 'type' => $elementor_data['daily_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['address_search']['type']			= isset( $elementor_data['daily_address_search_type'] ) ? $elementor_data['daily_address_search_type'] : '0';
				$mec_data['sf-options']['daily_view']['address_search']['placeholder']	= isset( $elementor_data['daily_address_search_placeholder'] ) ? $elementor_data['daily_address_search_placeholder'] : '';
				$mec_data['sf-options']['daily_view']['month_filter'] 					= isset( $elementor_data['daily_month_filter_type'] ) ? [ 'type' => $elementor_data['daily_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['time_filter'] 					= isset( $elementor_data['daily_time_filter_type'] ) ? [ 'type' => $elementor_data['daily_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['event_cost'] 					= isset( $elementor_data['daily_event_cost_type'] ) ? [ 'type' => $elementor_data['daily_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['daily_view']['text_search']['type']			= isset( $elementor_data['daily_text_search_type'] ) ? $elementor_data['daily_text_search_type'] : '0';
				$mec_data['sf-options']['daily_view']['text_search']['placeholder']		= isset( $elementor_data['daily_text_search_placeholder'] ) ? $elementor_data['daily_text_search_placeholder'] : '';
				// Weekly Form
				$mec_data['sf-options']['weekly_view']['category']     					= isset( $elementor_data['weekly_category_type'] ) ? [ 'type' => $elementor_data['weekly_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['location']     					= isset( $elementor_data['weekly_location_type'] ) ? [ 'type' => $elementor_data['weekly_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['organizer']    					= isset( $elementor_data['weekly_organizer_type'] ) ? [ 'type' => $elementor_data['weekly_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['label']        					= isset( $elementor_data['weekly_label_type'] ) ? [ 'type' => $elementor_data['weekly_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['address_search']['type']		= isset( $elementor_data['weekly_address_search_type'] ) ? $elementor_data['weekly_address_search_type'] : '0';
				$mec_data['sf-options']['weekly_view']['address_search']['placeholder']	= isset( $elementor_data['weekly_address_search_placeholder'] ) ? $elementor_data['weekly_address_search_placeholder'] : '';
				$mec_data['sf-options']['weekly_view']['month_filter'] 					= isset( $elementor_data['weekly_month_filter_type'] ) ? [ 'type' => $elementor_data['weekly_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['event_cost'] 					= isset( $elementor_data['weekly_event_cost_type'] ) ? [ 'type' => $elementor_data['weekly_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['time_filter'] 					= isset( $elementor_data['weekly_time_filter_type'] ) ? [ 'type' => $elementor_data['weekly_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['weekly_view']['text_search']['type']			= isset( $elementor_data['weekly_text_search_type'] ) ? $elementor_data['weekly_text_search_type'] : '0';
				$mec_data['sf-options']['weekly_view']['text_search']['placeholder']	= isset( $elementor_data['weekly_text_search_placeholder'] ) ? $elementor_data['weekly_text_search_placeholder'] : '';
				// Timetable Form
				$mec_data['sf-options']['timetable']['category']     					= isset( $elementor_data['timetable_category_type'] ) ? [ 'type' => $elementor_data['timetable_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['location']     					= isset( $elementor_data['timetable_location_type'] ) ? [ 'type' => $elementor_data['timetable_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['organizer']    					= isset( $elementor_data['timetable_organizer_type'] ) ? [ 'type' => $elementor_data['timetable_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['label']        					= isset( $elementor_data['timetable_label_type'] ) ? [ 'type' => $elementor_data['timetable_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['address_search']['type']			= isset( $elementor_data['timetable_address_search_type'] ) ? $elementor_data['timetable_address_search_type'] : '0';
				$mec_data['sf-options']['timetable']['address_search']['placeholder']	= isset( $elementor_data['timetable_address_search_placeholder'] ) ? $elementor_data['timetable_address_search_placeholder'] : '';
				$mec_data['sf-options']['timetable']['month_filter'] 					= isset( $elementor_data['timetable_month_filter_type'] ) ? [ 'type' => $elementor_data['timetable_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['event_cost'] 						= isset( $elementor_data['timetable_event_cost_type'] ) ? [ 'type' => $elementor_data['timetable_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['time_filter'] 					= isset( $elementor_data['timetable_time_filter_type'] ) ? [ 'type' => $elementor_data['timetable_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['timetable']['text_search']['type']				= isset( $elementor_data['timetable_text_search_type'] ) ? $elementor_data['timetable_text_search_type'] : '0';
				$mec_data['sf-options']['timetable']['text_search']['placeholder']		= isset( $elementor_data['timetable_text_search_placeholder'] ) ? $elementor_data['timetable_text_search_placeholder'] : '';
				// Custom Shortcode Form
				$mec_data['sf-options']['custom']['category']     						= isset( $elementor_data['custom_category_type'] ) ? [ 'type' => $elementor_data['custom_category_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['location']     						= isset( $elementor_data['custom_location_type'] ) ? [ 'type' => $elementor_data['custom_location_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['organizer']    						= isset( $elementor_data['custom_organizer_type'] ) ? [ 'type' => $elementor_data['custom_organizer_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['label']        						= isset( $elementor_data['custom_label_type'] ) ? [ 'type' => $elementor_data['custom_label_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['address_search']['type']				= isset( $elementor_data['custom_address_search_type'] ) ? $elementor_data['custom_address_search_type'] : '0';
				$mec_data['sf-options']['custom']['address_search']['placeholder']		= isset( $elementor_data['custom_address_search_placeholder'] ) ? $elementor_data['custom_address_search_placeholder'] : '';
				$mec_data['sf-options']['custom']['month_filter'] 						= isset( $elementor_data['custom_month_filter_type'] ) ? [ 'type' => $elementor_data['custom_month_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['event_cost'] 						= isset( $elementor_data['custom_event_cost_type'] ) ? [ 'type' => $elementor_data['custom_event_cost_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['time_filter'] 						= isset( $elementor_data['custom_time_filter_type'] ) ? [ 'type' => $elementor_data['custom_time_filter_type'] ] : [ 'type' => '0' ];
				$mec_data['sf-options']['custom']['text_search']['type']				= isset( $elementor_data['custom_text_search_type'] ) ? $elementor_data['custom_text_search_type'] : '0';
				$mec_data['sf-options']['custom']['text_search']['placeholder']			= isset( $elementor_data['custom_text_search_placeholder'] ) ? $elementor_data['custom_text_search_placeholder'] : '';

				// Custom skin
				$mec_data['sk-options']['custom']['style']                  			= isset( $elementor_data['custom_style'] ) ? $elementor_data['custom_style'] : 'classic';
				$mec_data['sk-options']['custom']['start_date_type']        			= isset( $elementor_data['custom_start_date_type'] ) ? $elementor_data['custom_start_date_type'] : 'today';
				$mec_data['sk-options']['custom']['count']                 				= isset( $elementor_data['custom_count'] ) ? $elementor_data['custom_count'] : '1';
				$mec_data['sk-options']['custom']['limit']                  			= isset( $elementor_data['custom_limit'] ) ? $elementor_data['custom_limit'] : '';
				$mec_data['sk-options']['custom']['load_more_button']       			= isset( $elementor_data['custom_load_more_button'] ) ? $elementor_data['custom_load_more_button'] : '1';
				$mec_data['sk-options']['custom']['month_divider']          			= isset( $elementor_data['custom_month_divider'] ) ? $elementor_data['custom_month_divider'] : '1';
				$mec_data['sk-options']['custom']['sed_method']             			= isset( $elementor_data['custom_sed_method'] ) ? $elementor_data['custom_sed_method'] : '0';

				// List skin
				$mec_data['sk-options']['list']['style']                  				= isset( $elementor_data['list_style'] ) ? $elementor_data['list_style'] : 'classic';
				$mec_data['sk-options']['list']['start_date_type']        				= isset( $elementor_data['list_start_date_type'] ) ? $elementor_data['list_start_date_type'] : 'today';
				$mec_data['sk-options']['list']['classic_date_format1']   				= isset( $elementor_data['list_classic_date_format1'] ) ? $elementor_data['list_classic_date_format1'] : 'M d Y';
				$mec_data['sk-options']['list']['minimal_date_format1']   				= isset( $elementor_data['list_minimal_date_format1'] ) ? $elementor_data['list_minimal_date_format1'] : 'd';
				$mec_data['sk-options']['list']['minimal_date_format2']   				= isset( $elementor_data['list_minimal_date_format2'] ) ? $elementor_data['list_minimal_date_format2'] : 'M';
				$mec_data['sk-options']['list']['minimal_date_format3']   				= isset( $elementor_data['list_minimal_date_format3'] ) ? $elementor_data['list_minimal_date_format3'] : 'l';
				$mec_data['sk-options']['list']['modern_date_format1']    				= isset( $elementor_data['list_modern_date_format1'] ) ? $elementor_data['list_modern_date_format1'] : 'd';
				$mec_data['sk-options']['list']['modern_date_format2']    				= isset( $elementor_data['list_modern_date_format2'] ) ? $elementor_data['list_modern_date_format2'] : 'F';
				$mec_data['sk-options']['list']['modern_date_format3']    				= isset( $elementor_data['list_modern_date_format3'] ) ? $elementor_data['list_modern_date_format3'] : 'l';
				$mec_data['sk-options']['list']['standard_date_format1']  				= isset( $elementor_data['list_standard_date_format1'] ) ? $elementor_data['list_standard_date_format1'] : 'd M';
				$mec_data['sk-options']['list']['accordion_date_format1'] 				= isset( $elementor_data['list_accordion_date_format1'] ) ? $elementor_data['list_accordion_date_format1'] : 'd';
				$mec_data['sk-options']['list']['accordion_date_format2'] 				= isset( $elementor_data['list_accordion_date_format2'] ) ? $elementor_data['list_accordion_date_format2'] : 'F';
				$mec_data['sk-options']['list']['start_date']             				= isset( $elementor_data['list_start_date'] ) ? $elementor_data['list_start_date'] : '';
				$mec_data['sk-options']['list']['limit']                  				= isset( $elementor_data['list_limit'] ) ? $elementor_data['list_limit'] : '';
				$mec_data['sk-options']['list']['load_more_button']       				= isset( $elementor_data['list_load_more_button'] ) ? $elementor_data['list_load_more_button'] : '1';
				$mec_data['sk-options']['list']['include_local_time']					= isset( $elementor_data['list_include_local_time'] ) ? $elementor_data['list_include_local_time'] : '1';
				$mec_data['sk-options']['list']['display_label']						= isset( $elementor_data['list_display_label'] ) ? $elementor_data['list_display_label'] : '1';
				$mec_data['sk-options']['list']['reason_for_cancellation']				= isset( $elementor_data['list_reason_for_cancellation'] ) ? $elementor_data['list_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['list']['include_events_times']					= isset( $elementor_data['list_include_events_times'] ) ? $elementor_data['list_include_events_times'] : '1';
				$mec_data['sk-options']['list']['event_color']       					= isset( $elementor_data['list_event_color'] ) ? $elementor_data['list_event_color'] : '1';
				$mec_data['sk-options']['list']['month_divider']          				= isset( $elementor_data['list_month_divider'] ) ? $elementor_data['list_month_divider'] : '1';
				$mec_data['sk-options']['list']['toggle_month_divider']   				= isset( $elementor_data['list_toggle_month_divider'] ) ? $elementor_data['list_toggle_month_divider'] : '0';
				$mec_data['sk-options']['list']['sed_method']             				= isset( $elementor_data['list_sed_method'] ) ? $elementor_data['list_sed_method'] : '0';
				// Grid skin
				$mec_data['sk-options']['grid']['style']                 				= isset( $elementor_data['grid_style'] ) ? $elementor_data['grid_style'] : 'classic';
				$mec_data['sk-options']['grid']['start_date_type']       				= isset( $elementor_data['grid_start_date_type'] ) ? $elementor_data['grid_start_date_type'] : 'today';
				$mec_data['sk-options']['grid']['classic_date_format1']  				= isset( $elementor_data['grid_classic_date_format1'] ) ? $elementor_data['grid_classic_date_format1'] : 'd F Y';
				$mec_data['sk-options']['grid']['clean_date_format1']    				= isset( $elementor_data['grid_clean_date_format1'] ) ? $elementor_data['grid_clean_date_format1'] : 'd';
				$mec_data['sk-options']['grid']['clean_date_format2']    				= isset( $elementor_data['grid_clean_date_format2'] ) ? $elementor_data['grid_clean_date_format2'] : 'F';
				$mec_data['sk-options']['grid']['minimal_date_format1']  				= isset( $elementor_data['grid_minimal_date_format1'] ) ? $elementor_data['grid_minimal_date_format1'] : 'd';
				$mec_data['sk-options']['grid']['minimal_date_format2']  				= isset( $elementor_data['grid_minimal_date_format2'] ) ? $elementor_data['grid_minimal_date_format2'] : 'M';
				$mec_data['sk-options']['grid']['modern_date_format1']   				= isset( $elementor_data['grid_modern_date_format1'] ) ? $elementor_data['grid_modern_date_format1'] : 'd';
				$mec_data['sk-options']['grid']['modern_date_format2']   				= isset( $elementor_data['grid_modern_date_format2'] ) ? $elementor_data['grid_modern_date_format2'] : 'F';
				$mec_data['sk-options']['grid']['modern_date_format3']   				= isset( $elementor_data['grid_modern_date_format3'] ) ? $elementor_data['grid_modern_date_format3'] : 'l';
				$mec_data['sk-options']['grid']['simple_date_format1']   				= isset( $elementor_data['grid_simple_date_format1'] ) ? $elementor_data['grid_simple_date_format1'] : 'M d Y';
				$mec_data['sk-options']['grid']['colorful_date_format1'] 				= isset( $elementor_data['grid_colorful_date_format1'] ) ? $elementor_data['grid_colorful_date_format1'] : 'd';
				$mec_data['sk-options']['grid']['colorful_date_format2'] 				= isset( $elementor_data['grid_colorful_date_format2'] ) ? $elementor_data['grid_colorful_date_format2'] : 'F';
				$mec_data['sk-options']['grid']['colorful_date_format3'] 				= isset( $elementor_data['grid_colorful_date_format3'] ) ? $elementor_data['grid_colorful_date_format3'] : 'l';
				$mec_data['sk-options']['grid']['novel_date_format1']    				= isset( $elementor_data['grid_novel_date_format1'] ) ? $elementor_data['grid_novel_date_format1'] : 'd F Y';
				$mec_data['sk-options']['grid']['start_date']            				= isset( $elementor_data['grid_start_date'] ) ? $elementor_data['grid_start_date'] : '';
				$mec_data['sk-options']['grid']['count']                 				= isset( $elementor_data['grid_count'] ) ? $elementor_data['grid_count'] : '1';
				$mec_data['sk-options']['grid']['limit']                 				= isset( $elementor_data['grid_limit'] ) ? $elementor_data['grid_limit'] : '';
				$mec_data['sk-options']['grid']['load_more_button']      				= isset( $elementor_data['grid_load_more_button'] ) ? $elementor_data['grid_load_more_button'] : '1';
				$mec_data['sk-options']['grid']['include_local_time']					= isset( $elementor_data['grid_include_local_time'] ) ? $elementor_data['grid_include_local_time'] : '1';
				$mec_data['sk-options']['grid']['display_label']						= isset( $elementor_data['grid_display_label'] ) ? $elementor_data['grid_display_label'] : '1';
				$mec_data['sk-options']['grid']['include_events_times']					= isset( $elementor_data['grid_include_events_times'] ) ? $elementor_data['grid_include_events_times'] : '1';
				$mec_data['sk-options']['grid']['reason_for_cancellation']				= isset( $elementor_data['grid_reason_for_cancellation'] ) ? $elementor_data['grid_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['grid']['sed_method']            				= isset( $elementor_data['grid_sed_method'] ) ? $elementor_data['grid_sed_method'] : '0';
				// Agenda skin
				$mec_data['sk-options']['agenda']['style']              				= isset( $elementor_data['agenda_style'] ) ? $elementor_data['agenda_style'] : 'clean';
				$mec_data['sk-options']['agenda']['start_date_type']    				= isset( $elementor_data['agenda_start_date_type'] ) ? $elementor_data['agenda_start_date_type'] : 'today';
				$mec_data['sk-options']['agenda']['clean_date_format1'] 				= isset( $elementor_data['agenda_clean_date_format1'] ) ? $elementor_data['agenda_clean_date_format1'] : 'l';
				$mec_data['sk-options']['agenda']['clean_date_format2'] 				= isset( $elementor_data['agenda_clean_date_format2'] ) ? $elementor_data['agenda_clean_date_format2'] : 'F j';
				$mec_data['sk-options']['agenda']['start_date']         				= isset( $elementor_data['agenda_start_date'] ) ? $elementor_data['agenda_start_date'] : '';
				$mec_data['sk-options']['agenda']['limit']              				= isset( $elementor_data['agenda_limit'] ) ? $elementor_data['agenda_limit'] : '';
				$mec_data['sk-options']['agenda']['load_more_button']   				= isset( $elementor_data['agenda_load_more_button'] ) ? $elementor_data['agenda_load_more_button'] : '1';
				$mec_data['sk-options']['agenda']['include_local_time']					= isset( $elementor_data['agenda_include_local_time'] ) ? $elementor_data['agenda_include_local_time'] : '1';
				$mec_data['sk-options']['agenda']['display_label']						= isset( $elementor_data['agenda_display_label'] ) ? $elementor_data['agenda_display_label'] : '1';
				$mec_data['sk-options']['agenda']['reason_for_cancellation']			= isset( $elementor_data['agenda_reason_for_cancellation'] ) ? $elementor_data['agenda_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['agenda']['month_divider']      				= isset( $elementor_data['agenda_month_divider'] ) ? $elementor_data['agenda_month_divider'] : '0';
				$mec_data['sk-options']['agenda']['sed_method']         				= isset( $elementor_data['agenda_sed_method'] ) ? $elementor_data['agenda_sed_method'] : '0';
				// Full Calendar skin
				$mec_data['sk-options']['full_calendar']['start_date_type'] 			= isset( $elementor_data['full_calendar_start_date_type'] ) ? $elementor_data['full_calendar_start_date_type'] : 'start_current_month';
				$mec_data['sk-options']['full_calendar']['start_date']      			= isset( $elementor_data['full_calendar_start_date'] ) ? $elementor_data['full_calendar_start_date'] : '';
				$mec_data['sk-options']['full_calendar']['default_view']    			= isset( $elementor_data['full_calendar_default_view'] ) ? $elementor_data['full_calendar_default_view'] : 'list';
				$mec_data['sk-options']['full_calendar']['monthly_style']   			= isset( $elementor_data['full_calendar_monthly_style'] ) ? $elementor_data['full_calendar_monthly_style'] : 'clean';
				$mec_data['sk-options']['full_calendar']['list']            			= isset( $elementor_data['full_calendar_list'] ) ? $elementor_data['full_calendar_list'] : '1';
				$mec_data['sk-options']['full_calendar']['date_format_list']			= isset( $elementor_data['full_calendar_date_format_list'] ) ? $elementor_data['full_calendar_date_format_list'] : 'F j';
				$mec_data['sk-options']['full_calendar']['grid']            			= isset( $elementor_data['full_calendar_grid'] ) ? $elementor_data['full_calendar_grid'] : '1';
				$mec_data['sk-options']['full_calendar']['tile']            			= isset( $elementor_data['full_calendar_tile'] ) ? $elementor_data['full_calendar_tile'] : '1';
				$mec_data['sk-options']['full_calendar']['yearly']          			= isset( $elementor_data['full_calendar_yearly'] ) ? $elementor_data['full_calendar_yearly'] : '1';
				$mec_data['sk-options']['full_calendar']['date_format_yearly_1']		= isset( $elementor_data['full_calendar_date_format_yearly_1'] ) ? $elementor_data['full_calendar_date_format_yearly_1'] : 'l';
				$mec_data['sk-options']['full_calendar']['date_format_yearly_2']		= isset( $elementor_data['full_calendar_date_format_yearly_2'] ) ? $elementor_data['full_calendar_date_format_yearly_2'] : 'F j';
				$mec_data['sk-options']['full_calendar']['monthly']         			= isset( $elementor_data['full_calendar_monthly'] ) ? $elementor_data['full_calendar_monthly'] : '1';
				$mec_data['sk-options']['full_calendar']['weekly']          			= isset( $elementor_data['full_calendar_weekly'] ) ? $elementor_data['full_calendar_weekly'] : '1';
				$mec_data['sk-options']['full_calendar']['daily']           			= isset( $elementor_data['full_calendar_daily'] ) ? $elementor_data['full_calendar_daily'] : '1';
				$mec_data['sk-options']['full_calendar']['display_price']   			= isset( $elementor_data['full_calendar_display_price'] ) ? $elementor_data['full_calendar_display_price'] : '0';
				$mec_data['sk-options']['full_calendar']['sed_method']      			= isset( $elementor_data['full_calendar_sed_method'] ) ? $elementor_data['full_calendar_sed_method'] : '0';
				$mec_data['sk-options']['full_calendar']['display_label']				= isset( $elementor_data['full_calendar_display_label'] ) ? $elementor_data['full_calendar_display_label'] : '1';
				$mec_data['sk-options']['full_calendar']['reason_for_cancellation']		= isset( $elementor_data['full_calendar_reason_for_cancellation'] ) ? $elementor_data['full_calendar_reason_for_cancellation'] : '1';
				// Yearly skin
				$mec_data['sk-options']['yearly_view']['style']                			= isset( $elementor_data['yearly_style'] ) ? $elementor_data['yearly_style'] : 'modern';
				$mec_data['sk-options']['yearly_view']['start_date_type']      			= isset( $elementor_data['yearly_start_date_type'] ) ? $elementor_data['yearly_start_date_type'] : 'start_current_year';
				$mec_data['sk-options']['yearly_view']['start_date']           			= isset( $elementor_data['yearly_start_date'] ) ? $elementor_data['yearly_start_date'] : '';
				$mec_data['sk-options']['yearly_view']['modern_date_format1']  			= isset( $elementor_data['yearly_modern_date_format1'] ) ? $elementor_data['yearly_modern_date_format1'] : 'l';
				$mec_data['sk-options']['yearly_view']['modern_date_format2']  			= isset( $elementor_data['yearly_modern_date_format2'] ) ? $elementor_data['yearly_modern_date_format2'] : 'F j';
				$mec_data['sk-options']['yearly_view']['limit']                			= isset( $elementor_data['yearly_limit'] ) ? $elementor_data['yearly_limit'] : '';
				$mec_data['sk-options']['yearly_view']['include_local_time']			= isset( $elementor_data['yearly_include_local_time'] ) ? $elementor_data['yearly_include_local_time'] : '1';
				$mec_data['sk-options']['yearly_view']['display_label']					= isset( $elementor_data['yearly_view_display_label'] ) ? $elementor_data['yearly_view_display_label'] : '1';
				$mec_data['sk-options']['yearly_view']['reason_for_cancellation']		= isset( $elementor_data['yearly_view_reason_for_cancellation'] ) ? $elementor_data['yearly_view_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['yearly_view']['next_previous_button'] 			= isset( $elementor_data['yearly_next_previous_button'] ) ? $elementor_data['yearly_next_previous_button'] : '1';
				$mec_data['sk-options']['yearly_view']['sed_method']           			= isset( $elementor_data['yearly_sed_method'] ) ? $elementor_data['yearly_sed_method'] : '0';
				// Tile skin
				$mec_data['sk-options']['tile']['start_date_type']      				= isset( $elementor_data['tile_start_date_type'] ) ? $elementor_data['tile_start_date_type'] : 'start_current_month';
				$mec_data['sk-options']['tile']['start_date']           				= isset( $elementor_data['tile_start_date'] ) ? $elementor_data['tile_start_date'] : '';
				$mec_data['sk-options']['tile']['clean_date_format1']					= isset( $elementor_data['tile_clean_date_format1'] ) ? $elementor_data['tile_clean_date_format1'] : 'j';
				$mec_data['sk-options']['tile']['clean_date_format2']					= isset( $elementor_data['tile_clean_date_format2'] ) ? $elementor_data['tile_clean_date_format2'] : 'M';
				$mec_data['sk-options']['tile']['count']                				= isset( $elementor_data['tile_count'] ) ? $elementor_data['tile_count'] : '2';
				$mec_data['sk-options']['tile']['next_previous_button'] 				= isset( $elementor_data['tile_next_previous_button'] ) ? $elementor_data['tile_next_previous_button'] : '1';
				$mec_data['sk-options']['tile']['sed_method']           				= isset( $elementor_data['tile_sed_method'] ) ? $elementor_data['tile_sed_method'] : '0';
				$mec_data['sk-options']['tile']['display_label']						= isset( $elementor_data['tile_display_label'] ) ? $elementor_data['tile_display_label'] : '1';
				$mec_data['sk-options']['tile']['reason_for_cancellation']				= isset( $elementor_data['tile_reason_for_cancellation'] ) ? $elementor_data['tile_reason_for_cancellation'] : '1';
				// Monthly skin
				$mec_data['sk-options']['monthly_view']['style']                		= isset( $elementor_data['monthly_style'] ) ? $elementor_data['monthly_style'] : 'classic';
				$mec_data['sk-options']['monthly_view']['start_date_type']      		= isset( $elementor_data['monthly_start_date_type'] ) ? $elementor_data['monthly_start_date_type'] : 'start_current_month';
				$mec_data['sk-options']['monthly_view']['start_date']           		= isset( $elementor_data['monthly_start_date'] ) ? $elementor_data['monthly_start_date'] : '';
				$mec_data['sk-options']['monthly_view']['limit']                		= isset( $elementor_data['monthly_limit'] ) ? $elementor_data['monthly_limit'] : '';
				$mec_data['sk-options']['monthly_view']['include_local_time']			= isset( $elementor_data['monthly_include_local_time'] ) ? $elementor_data['monthly_include_local_time'] : '1';
				$mec_data['sk-options']['monthly_view']['display_label']				= isset( $elementor_data['monthly_view_display_label'] ) ? $elementor_data['monthly_view_display_label'] : '1';
				$mec_data['sk-options']['monthly_view']['reason_for_cancellation']		= isset( $elementor_data['monthly_view_reason_for_cancellation'] ) ? $elementor_data['monthly_view_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['monthly_view']['next_previous_button'] 		= isset( $elementor_data['monthly_next_previous_button'] ) ? $elementor_data['monthly_next_previous_button'] : '1';
				$mec_data['sk-options']['monthly_view']['sed_method']           		= isset( $elementor_data['monthly_sed_method'] ) ? $elementor_data['monthly_sed_method'] : '0';
				// Map skin
				$mec_data['sk-options']['map']['start_date_type'] 						= isset( $elementor_data['map_start_date_type'] ) ? $elementor_data['map_start_date_type'] : 'today';
				$mec_data['sk-options']['map']['start_date']      						= isset( $elementor_data['map_start_date'] ) ? $elementor_data['map_start_date'] : '';
				$mec_data['sk-options']['map']['limit']           						= isset( $elementor_data['map_limit'] ) ? $elementor_data['map_limit'] : '200';
				$mec_data['sk-options']['map']['sed_method']      						= isset( $elementor_data['map_geolocation'] ) ? $elementor_data['map_geolocation'] : '0';
				$data['mec_location_map_zoom']           								= isset( $elementor_data['map_zoom'] ) ? $elementor_data['map_zoom'] : '8';
				$data['mec_location_view_mode']           								= isset( $elementor_data['view_mode'] ) ? $elementor_data['view_mode'] : 'normal';
				$data['mec_location_map_center_lat']           							= isset( $elementor_data['map_center_lat'] ) ? $elementor_data['map_center_lat'] : '0';
				$data['mec_location_map_center_long']           						= isset( $elementor_data['map_map_center_long'] ) ? $elementor_data['map_map_center_long'] : '0';
				// Daily skin
				$mec_data['sk-options']['daily_view']['start_date_type']      			= isset( $elementor_data['daily_start_date_type'] ) ? $elementor_data['daily_start_date_type'] : 'today';
				$mec_data['sk-options']['daily_view']['start_date']           			= isset( $elementor_data['daily_start_date'] ) ? $elementor_data['daily_start_date'] : '';
				$mec_data['sk-options']['daily_view']['limit']                			= isset( $elementor_data['daily_limit'] ) ? $elementor_data['daily_limit'] : '';
				$mec_data['sk-options']['daily_view']['include_local_time']				= isset( $elementor_data['daily_include_local_time'] ) ? $elementor_data['daily_include_local_time'] : '1';
				$mec_data['sk-options']['daily_view']['display_label']					= isset( $elementor_data['daily_view_display_label'] ) ? $elementor_data['daily_view_display_label'] : '1';
				$mec_data['sk-options']['daily_view']['reason_for_cancellation']		= isset( $elementor_data['daily_view_reason_for_cancellation'] ) ? $elementor_data['daily_view_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['daily_view']['next_previous_button'] 			= isset( $elementor_data['daily_next_previous_button'] ) ? $elementor_data['daily_next_previous_button'] : '1';
				$mec_data['sk-options']['daily_view']['sed_method']           			= isset( $elementor_data['daily_sed_method'] ) ? $elementor_data['daily_sed_method'] : '0';
				// Weekly skin
				$mec_data['sk-options']['weekly_view']['start_date_type']      			= isset( $elementor_data['weekly_start_date_type'] ) ? $elementor_data['weekly_start_date_type'] : 'start_current_week';
				$mec_data['sk-options']['weekly_view']['start_date']           			= isset( $elementor_data['weekly_start_date'] ) ? $elementor_data['weekly_start_date'] : '';
				$mec_data['sk-options']['weekly_view']['limit']                			= isset( $elementor_data['weekly_limit'] ) ? $elementor_data['weekly_limit'] : '';
				$mec_data['sk-options']['weekly_view']['include_local_time']			= isset( $elementor_data['weekly_include_local_time'] ) ? $elementor_data['weekly_include_local_time'] : '1';
				$mec_data['sk-options']['weekly_view']['display_label']					= isset( $elementor_data['weekly_view_display_label'] ) ? $elementor_data['weekly_view_display_label'] : '1';
				$mec_data['sk-options']['weekly_view']['reason_for_cancellation']		= isset( $elementor_data['weekly_view_reason_for_cancellation'] ) ? $elementor_data['weekly_view_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['weekly_view']['next_previous_button'] 			= isset( $elementor_data['weekly_next_previous_button'] ) ? $elementor_data['weekly_next_previous_button'] : '1';
				$mec_data['sk-options']['weekly_view']['sed_method']					= isset( $elementor_data['weekly_sed_method'] ) ? $elementor_data['weekly_sed_method'] : '0';
				// Timetable skin
				$mec_data['sk-options']['timetable']['style']                			= isset( $elementor_data['timetable_style'] ) ? $elementor_data['timetable_style'] : 'modern';
				$mec_data['sk-options']['timetable']['start_date_type']      			= isset( $elementor_data['timetable_start_date_type'] ) ? $elementor_data['timetable_start_date_type'] : 'start_current_week';
				$mec_data['sk-options']['timetable']['start_date']           			= isset( $elementor_data['timetable_start_date'] ) ? $elementor_data['timetable_start_date'] : '';
				$mec_data['sk-options']['timetable']['limit']                			= isset( $elementor_data['timetable_limit'] ) ? $elementor_data['timetable_limit'] : '';
				$mec_data['sk-options']['timetable']['include_local_time']				= isset( $elementor_data['timetable_include_local_time'] ) ? $elementor_data['timetable_include_local_time'] : '1';
				$mec_data['sk-options']['timetable']['number_of_days']					= isset( $elementor_data['timetable_number_of_days'] ) ? $elementor_data['timetable_number_of_days'] : '5';
				$mec_data['sk-options']['timetable']['week_start']						= isset( $elementor_data['timetable_week_start'] ) ? $elementor_data['timetable_week_start'] : '1';
				$mec_data['sk-options']['timetable']['display_label']					= isset( $elementor_data['timetable_display_label'] ) ? $elementor_data['timetable_display_label'] : '1';
				$mec_data['sk-options']['timetable']['reason_for_cancellation']			= isset( $elementor_data['timetable_reason_for_cancellation'] ) ? $elementor_data['timetable_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['timetable']['next_previous_button'] 			= isset( $elementor_data['timetable_next_previous_button'] ) ? $elementor_data['timetable_next_previous_button'] : '1';
				$mec_data['sk-options']['timetable']['sed_method']           			= isset( $elementor_data['timetable_sed_method'] ) ? $elementor_data['timetable_sed_method'] : '0';
				// Masonry skin
				$mec_data['sk-options']['masonry']['start_date_type']   				= isset( $elementor_data['masonry_start_date_type'] ) ? $elementor_data['masonry_start_date_type'] : 'today';
				$mec_data['sk-options']['masonry']['start_date']        				= isset( $elementor_data['masonry_start_date'] ) ? $elementor_data['masonry_start_date'] : '';
				$mec_data['sk-options']['masonry']['date_format1']      				= isset( $elementor_data['masonry_date_format1'] ) ? $elementor_data['masonry_date_format1'] : 'j';
				$mec_data['sk-options']['masonry']['date_format2']      				= isset( $elementor_data['masonry_date_format2'] ) ? $elementor_data['masonry_date_format2'] : 'F';
				$mec_data['sk-options']['masonry']['limit']             				= isset( $elementor_data['masonry_limit'] ) ? $elementor_data['masonry_limit'] : '';
				$mec_data['sk-options']['masonry']['include_local_time']				= isset( $elementor_data['masonry_include_local_time'] ) ? $elementor_data['masonry_include_local_time'] : '1';
				$mec_data['sk-options']['masonry']['display_label']						= isset( $elementor_data['masonry_display_label'] ) ? $elementor_data['masonry_display_label'] : '1';
				$mec_data['sk-options']['masonry']['reason_for_cancellation']			= isset( $elementor_data['masonry_reason_for_cancellation'] ) ? $elementor_data['masonry_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['masonry']['filter_by']         				= isset( $elementor_data['masonry_filter_by'] ) ? $elementor_data['masonry_filter_by'] : '';
				$mec_data['sk-options']['masonry']['masonry_like_grid'] 				= isset( $elementor_data['masonry_masonry_like_grid'] ) ? $elementor_data['masonry_masonry_like_grid'] : '0';
				$mec_data['sk-options']['masonry']['sed_method']        				= isset( $elementor_data['masonry_sed_method'] ) ? $elementor_data['masonry_sed_method'] : '0';
				// Cover skin
				$mec_data['sk-options']['cover']['style']                				= isset( $elementor_data['cover_style'] ) ? $elementor_data['cover_style'] : 'classic';
				$mec_data['sk-options']['cover']['date_format_clean1']   				= isset( $elementor_data['cover_date_format_clean1'] ) ? $elementor_data['cover_date_format_clean1'] : 'd';
				$mec_data['sk-options']['cover']['date_format_clean2']   				= isset( $elementor_data['cover_date_format_clean2'] ) ? $elementor_data['cover_date_format_clean2'] : 'M';
				$mec_data['sk-options']['cover']['date_format_clean3']   				= isset( $elementor_data['cover_date_format_clean3'] ) ? $elementor_data['cover_date_format_clean3'] : 'Y';
				$mec_data['sk-options']['cover']['date_format_classic1'] 				= isset( $elementor_data['cover_date_format_classic1'] ) ? $elementor_data['cover_date_format_classic1'] : 'F d';
				$mec_data['sk-options']['cover']['date_format_classic2'] 				= isset( $elementor_data['cover_date_format_classic2'] ) ? $elementor_data['cover_date_format_classic2'] : 'l';
				$mec_data['sk-options']['cover']['include_local_time']					= isset( $elementor_data['cover_include_local_time'] ) ? $elementor_data['cover_include_local_time'] : '1';
				$mec_data['sk-options']['cover']['display_label']						= isset( $elementor_data['cover_display_label'] ) ? $elementor_data['cover_display_label'] : '1';
				$mec_data['sk-options']['cover']['reason_for_cancellation']				= isset( $elementor_data['cover_reason_for_cancellation'] ) ? $elementor_data['cover_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['cover']['date_format_modern1']  				= isset( $elementor_data['cover_date_format_modern1'] ) ? $elementor_data['cover_date_format_modern1'] : 'l, F d Y';
				$mec_data['sk-options']['cover']['event_id']             				= isset( $elementor_data['cover_event'] ) ? $elementor_data['cover_event'] : '10';
				// Countdown skin
				$mec_data['sk-options']['countdown']['style']               			= isset( $elementor_data['countdown_style'] ) ? $elementor_data['countdown_style'] : 'style1';
				$mec_data['sk-options']['countdown']['date_format_style11'] 			= isset( $elementor_data['countdown_date_format_style11'] ) ? $elementor_data['countdown_date_format_style11'] : 'j F Y';
				$mec_data['sk-options']['countdown']['date_format_style21'] 			= isset( $elementor_data['countdown_date_format_style21'] ) ? $elementor_data['countdown_date_format_style21'] : 'j F Y';
				$mec_data['sk-options']['countdown']['date_format_style31'] 			= isset( $elementor_data['countdown_date_format_style31'] ) ? $elementor_data['countdown_date_format_style31'] : 'j';
				$mec_data['sk-options']['countdown']['date_format_style32'] 			= isset( $elementor_data['countdown_date_format_style32'] ) ? $elementor_data['countdown_date_format_style32'] : 'F';
				$mec_data['sk-options']['countdown']['date_format_style33'] 			= isset( $elementor_data['countdown_date_format_style33'] ) ? $elementor_data['countdown_date_format_style33'] : 'Y';
				$mec_data['sk-options']['countdown']['include_local_time']				= isset( $elementor_data['countdown_include_local_time'] ) ? $elementor_data['countdown_include_local_time'] : '1';
				$mec_data['sk-options']['countdown']['display_label']					= isset( $elementor_data['countdown_display_label'] ) ? $elementor_data['countdown_display_label'] : '1';
				$mec_data['sk-options']['countdown']['reason_for_cancellation']			= isset( $elementor_data['countdown_reason_for_cancellation'] ) ? $elementor_data['countdown_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['countdown']['event_id']            			= isset( $elementor_data['countdown_event'] ) ? $elementor_data['countdown_event'] : '-1';
				$mec_data['sk-options']['countdown']['bg_color']            			= isset( $elementor_data['countdown_bg_color'] ) ? $elementor_data['countdown_bg_color'] : '#437df9';
				// Available Spot skin
				$mec_data['sk-options']['available_spot']['date_format1'] 				= isset( $elementor_data['available_spot_date_format1'] ) ? $elementor_data['available_spot_date_format1'] : 'j';
				$mec_data['sk-options']['available_spot']['date_format2'] 				= isset( $elementor_data['available_spot_date_format2'] ) ? $elementor_data['available_spot_date_format2'] : 'F';
				$mec_data['sk-options']['available_spot']['include_local_time']			= isset( $elementor_data['available_spot_include_local_time'] ) ? $elementor_data['available_spot_include_local_time'] : '1';
				$mec_data['sk-options']['available_spot']['display_label']				= isset( $elementor_data['available_spot_display_label'] ) ? $elementor_data['available_spot_display_label'] : '1';
				$mec_data['sk-options']['available_spot']['reason_for_cancellation']	= isset( $elementor_data['available_spot_reason_for_cancellation'] ) ? $elementor_data['available_spot_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['available_spot']['event_id']     				= isset( $elementor_data['available_spot_event'] ) ? $elementor_data['available_spot_event'] : '-1';
				// Timeline skin
				$mec_data['sf-options']['timeline']['start_date_type']					= isset( $elementor_data['timeline_start_date_type'] ) ? $elementor_data['timeline_start_date_type'] : 'start_current_month';
				$mec_data['sf-options']['timeline']['start_date'] 						= isset( $elementor_data['timeline_start_date'] ) ? $elementor_data['timeline_start_date'] : '';
				$mec_data['sf-options']['timeline']['date_format1']	   					= isset( $elementor_data['timeline_timeline_date_format1'] ) ? $elementor_data['timeline_date_format1'] : 'd F Y';
				$mec_data['sf-options']['timeline']['limit'] 							= isset( $elementor_data['timeline_limit'] ) ? $elementor_data['timeline_limit'] : '';
				$mec_data['sf-options']['timeline']['load_more_button'] 				= isset( $elementor_data['timeline_load_more_button'] ) ? $elementor_data['timeline_load_more_button'] : '1';
				$mec_data['sk-options']['timeline']['include_local_time']				= isset( $elementor_data['timeline_include_local_time'] ) ? $elementor_data['timeline_include_local_time'] : '1';
				$mec_data['sk-options']['timeline']['display_label']					= isset( $elementor_data['timeline_display_label'] ) ? $elementor_data['timeline_display_label'] : '1';
				$mec_data['sk-options']['timeline']['reason_for_cancellation']			= isset( $elementor_data['timeline_reason_for_cancellation'] ) ? $elementor_data['timeline_reason_for_cancellation'] : '1';
				$mec_data['sf-options']['timeline']['month_divider'] 					= isset( $elementor_data['timeline_month_divider'] ) ? $elementor_data['timeline_month_divider'] : '0';
				$mec_data['sf-options']['timeline']['sed_method'] 						= isset( $elementor_data['timeline_sed_method'] ) ? $elementor_data['timeline_sed_method'] : '0';
				// Carousel skin
				$mec_data['sk-options']['carousel']['style']              				= isset( $elementor_data['carousel_style'] ) ? $elementor_data['carousel_style'] : 'type1';
				$mec_data['sk-options']['carousel']['start_date_type']    				= isset( $elementor_data['carousel_start_date_type'] ) ? $elementor_data['carousel_start_date_type'] : 'today';
				$mec_data['sk-options']['carousel']['start_date']         				= isset( $elementor_data['carousel_start_date'] ) ? $elementor_data['carousel_start_date'] : '';
				$mec_data['sk-options']['carousel']['type1_date_format1'] 				= isset( $elementor_data['carousel_type1_date_format1'] ) ? $elementor_data['carousel_type1_date_format1'] : 'd';
				$mec_data['sk-options']['carousel']['type1_date_format2'] 				= isset( $elementor_data['carousel_type1_date_format2'] ) ? $elementor_data['carousel_type1_date_format2'] : 'F';
				$mec_data['sk-options']['carousel']['type1_date_format3'] 				= isset( $elementor_data['carousel_type1_date_format3'] ) ? $elementor_data['carousel_type1_date_format3'] : 'Y';
				$mec_data['sk-options']['carousel']['type2_date_format1'] 				= isset( $elementor_data['carousel_type2_date_format1'] ) ? $elementor_data['carousel_type2_date_format1'] : 'M d, Y';
				$mec_data['sk-options']['carousel']['type3_date_format1'] 				= isset( $elementor_data['carousel_type3_date_format1'] ) ? $elementor_data['carousel_type3_date_format1'] : 'M d, Y';
				$mec_data['sk-options']['carousel']['count']              				= isset( $elementor_data['carousel_count'] ) ? $elementor_data['carousel_count'] : '2';
				$mec_data['sk-options']['carousel']['include_local_time']				= isset( $elementor_data['carousel_include_local_time'] ) ? $elementor_data['carousel_include_local_time'] : '1';
				$mec_data['sk-options']['carousel']['display_label']					= isset( $elementor_data['carousel_display_label'] ) ? $elementor_data['carousel_display_label'] : '1';
				$mec_data['sk-options']['carousel']['reason_for_cancellation']			= isset( $elementor_data['carousel_reason_for_cancellation'] ) ? $elementor_data['carousel_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['carousel']['limit']              				= isset( $elementor_data['carousel_limit'] ) ? $elementor_data['carousel_limit'] : '';
				$mec_data['sk-options']['carousel']['autoplay']           				= isset( $elementor_data['carousel_autoplay'] ) ? $elementor_data['carousel_autoplay'] : '';
				$mec_data['sk-options']['carousel']['archive_link']       				= isset( $elementor_data['carousel_archive_link'] ) ? $elementor_data['carousel_archive_link'] : '';
				$mec_data['sk-options']['carousel']['head_text']          				= isset( $elementor_data['carousel_head_text'] ) ? $elementor_data['carousel_head_text'] : '';
				// Slider skin
				$mec_data['sk-options']['slider']['style']              				= isset( $elementor_data['slider_style'] ) ? $elementor_data['slider_style'] : 't1';
				$mec_data['sk-options']['slider']['start_date_type']    				= isset( $elementor_data['slider_start_date_type'] ) ? $elementor_data['slider_start_date_type'] : 'today';
				$mec_data['sk-options']['slider']['start_date']         				= isset( $elementor_data['slider_start_date'] ) ? $elementor_data['slider_start_date'] : '';
				$mec_data['sk-options']['slider']['type1_date_format1'] 				= isset( $elementor_data['slider_type1_date_format1'] ) ? $elementor_data['slider_type1_date_format1'] : 'd';
				$mec_data['sk-options']['slider']['type1_date_format2'] 				= isset( $elementor_data['slider_type1_date_format2'] ) ? $elementor_data['slider_type1_date_format2'] : 'F';
				$mec_data['sk-options']['slider']['type1_date_format3'] 				= isset( $elementor_data['slider_type1_date_format3'] ) ? $elementor_data['slider_type1_date_format3'] : 'l';
				$mec_data['sk-options']['slider']['type2_date_format1'] 				= isset( $elementor_data['slider_type2_date_format1'] ) ? $elementor_data['slider_type2_date_format1'] : 'd';
				$mec_data['sk-options']['slider']['type2_date_format2'] 				= isset( $elementor_data['slider_type2_date_format2'] ) ? $elementor_data['slider_type2_date_format2'] : 'F';
				$mec_data['sk-options']['slider']['type2_date_format3'] 				= isset( $elementor_data['slider_type2_date_format3'] ) ? $elementor_data['slider_type2_date_format3'] : 'l';
				$mec_data['sk-options']['slider']['type3_date_format1'] 				= isset( $elementor_data['slider_type3_date_format1'] ) ? $elementor_data['slider_type3_date_format1'] : 'd';
				$mec_data['sk-options']['slider']['type3_date_format2'] 				= isset( $elementor_data['slider_type3_date_format2'] ) ? $elementor_data['slider_type3_date_format2'] : 'F';
				$mec_data['sk-options']['slider']['type3_date_format3'] 				= isset( $elementor_data['slider_type3_date_format3'] ) ? $elementor_data['slider_type3_date_format3'] : 'l';
				$mec_data['sk-options']['slider']['type4_date_format1'] 				= isset( $elementor_data['slider_type4_date_format1'] ) ? $elementor_data['slider_type4_date_format1'] : 'd';
				$mec_data['sk-options']['slider']['type4_date_format2'] 				= isset( $elementor_data['slider_type4_date_format2'] ) ? $elementor_data['slider_type4_date_format2'] : 'F';
				$mec_data['sk-options']['slider']['type4_date_format3'] 				= isset( $elementor_data['slider_type4_date_format3'] ) ? $elementor_data['slider_type4_date_format3'] : 'l';
				$mec_data['sk-options']['slider']['type5_date_format1'] 				= isset( $elementor_data['slider_type5_date_format1'] ) ? $elementor_data['slider_type5_date_format1'] : 'd';
				$mec_data['sk-options']['slider']['type5_date_format2'] 				= isset( $elementor_data['slider_type5_date_format2'] ) ? $elementor_data['slider_type5_date_format2'] : 'F';
				$mec_data['sk-options']['slider']['type5_date_format3'] 				= isset( $elementor_data['slider_type5_date_format3'] ) ? $elementor_data['slider_type5_date_format3'] : 'l';
				$mec_data['sk-options']['slider']['limit']              				= isset( $elementor_data['slider_limit'] ) ? $elementor_data['slider_limit'] : '';
				$mec_data['sk-options']['slider']['include_local_time']					= isset( $elementor_data['slider_include_local_time'] ) ? $elementor_data['slider_include_local_time'] : '1';
				$mec_data['sk-options']['slider']['display_label']						= isset( $elementor_data['slider_display_label'] ) ? $elementor_data['slider_display_label'] : '1';
				$mec_data['sk-options']['slider']['reason_for_cancellation']			= isset( $elementor_data['slider_reason_for_cancellation'] ) ? $elementor_data['slider_reason_for_cancellation'] : '1';
				$mec_data['sk-options']['slider']['autoplay']           				= isset( $elementor_data['slider_autoplay'] ) ? $elementor_data['slider_autoplay'] : '';

				update_post_meta( $post_id, 'sf_status', $mec_data['sf_status'] );
				update_post_meta( $post_id, 'sf-options', $mec_data['sf-options'] );
				update_post_meta( $post_id, 'skin', $mec_data['skin'] );
				update_post_meta( $post_id, 'sk-options', $mec_data['sk-options'] );
				update_post_meta( $post_id, 'show_past_events', $mec_data['show_past_events'] );
				update_post_meta( $post_id, 'show_only_past_events', $mec_data['show_only_past_events'] );
				update_post_meta( $post_id, 'show_only_ongoing_events', $mec_data['show_only_ongoing_events'] );
				update_post_meta( $post_id, 'show_ongoing_events', $mec_data['show_ongoing_events'] );
			}
		}
	}

	$w = new \MEC_addon_elementor_shortcode_builder_config();
	$w->init();
endif;
