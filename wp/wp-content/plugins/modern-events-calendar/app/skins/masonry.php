<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC masonry class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_skin_masonry extends MEC_skins
{
    /**
     * @var string
     */
    public $skin = 'masonry';
    public $date_format_1 = 'j';
    public $date_format_2 = 'F';
    public $filter_by = 'category';
    public $masonry_like_grid;
    public $fit_to_row;

    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Registers skin actions into WordPress
     * @author Webnus <info@webnus.biz>
     */
    public function actions()
    {
        $this->factory->action('wp_ajax_mec_masonry_load_more', array($this, 'load_more'));
        $this->factory->action('wp_ajax_nopriv_mec_masonry_load_more', array($this, 'load_more'));
    }
    
    /**
     * Initialize the skin
     * @author Webnus <info@webnus.biz>
     * @param array $atts
     */
    public function initialize($atts)
    {
        $this->atts = $atts;
        
        // Skin Options
        $this->skin_options = (isset($this->atts['sk-options']) and isset($this->atts['sk-options'][$this->skin])) ? $this->atts['sk-options'][$this->skin] : array();
        
        // Date Formats
        $this->date_format_1 = (isset($this->skin_options['date_format1']) and trim($this->skin_options['date_format1'])) ? $this->skin_options['date_format1'] : 'j';
        $this->date_format_2 = (isset($this->skin_options['date_format2']) and trim($this->skin_options['date_format2'])) ? $this->skin_options['date_format2'] : 'F';

        // Filter By
        $this->filter_by = (isset($this->skin_options['filter_by']) and trim($this->skin_options['filter_by'])) ? $this->skin_options['filter_by'] : '';
        
        // Search Form Options
        $this->sf_options = (isset($this->atts['sf-options']) and isset($this->atts['sf-options'][$this->skin])) ? $this->atts['sf-options'][$this->skin] : array();
        
        // Search Form Status
        $this->sf_status = isset($this->atts['sf_status']) ? $this->atts['sf_status'] : true;
        $this->sf_display_label = isset($this->atts['sf_display_label']) ? $this->atts['sf_display_label'] : false;
        $this->sf_reset_button = isset($this->atts['sf_reset_button']) ? $this->atts['sf_reset_button'] : false;
        $this->sf_refine = isset($this->atts['sf_refine']) ? $this->atts['sf_refine'] : false;
        
        // Generate an ID for the sking
        $this->id = isset($this->atts['id']) ? $this->atts['id'] : mt_rand(100, 999);
        
        // Set the ID
        if(!isset($this->atts['id'])) $this->atts['id'] = $this->id;
        
        // Show "Load More" button or not
        $this->load_more_button = isset($this->skin_options['load_more_button']) ? $this->skin_options['load_more_button'] : true;

        // Show Masonry like grid
        $this->masonry_like_grid = isset($this->skin_options['masonry_like_grid']) ? $this->skin_options['masonry_like_grid'] : true;

        // Show "Sort by date" button or not
        $this->fit_to_row = isset($this->skin_options['fit_to_row']) ? $this->skin_options['fit_to_row'] : true;

        // HTML class
        $this->html_class = '';
        if(isset($this->atts['html-class']) and trim($this->atts['html-class']) != '') $this->html_class = $this->atts['html-class'];

        // Booking Button
        $this->booking_button = isset($this->skin_options['booking_button']) ? (int) $this->skin_options['booking_button'] : 0;

        // SED Method
        $this->sed_method = isset($this->skin_options['sed_method']) ? $this->skin_options['sed_method'] : '0';

        // Order Method
        $this->order_method = (isset($this->skin_options['order_method']) and trim($this->skin_options['order_method'])) ? $this->skin_options['order_method'] : 'ASC';

        // Image popup
        $this->image_popup = isset($this->skin_options['image_popup']) ? $this->skin_options['image_popup'] : '0';

        // reason_for_cancellation
        $this->reason_for_cancellation = isset($this->skin_options['reason_for_cancellation']) ? $this->skin_options['reason_for_cancellation'] : false;

        // display_label
        $this->display_label = isset($this->skin_options['display_label']) ? $this->skin_options['display_label'] : false;
        
        // From Widget
        $this->widget = (isset($this->atts['widget']) and trim($this->atts['widget'])) ? true : false;
        
        // Init MEC
        $this->args['mec-init'] = true;
        $this->args['mec-skin'] = $this->skin;
        
        // Post Type
        $this->args['post_type'] = $this->main->get_main_post_type();

        // Post Status
        $this->args['post_status'] = 'publish';
        
        // Keyword Query
        $this->args['s'] = $this->keyword_query();
        
        // Taxonomy
        $this->args['tax_query'] = $this->tax_query();
        
        // Meta
        $this->args['meta_query'] = $this->meta_query();
        
        // Tag
        if(apply_filters('mec_taxonomy_tag', '') === 'post_tag') $this->args['tag'] = $this->tag_query();
        
        // Author
        $this->args['author'] = $this->author_query();
        
        // Pagination Options
        $this->paged = get_query_var('paged', 1);
        $this->limit = (isset($this->skin_options['limit']) and trim($this->skin_options['limit'])) ? $this->skin_options['limit'] : 24;
        
        $this->args['posts_per_page'] = $this->limit;
        $this->args['paged'] = $this->paged;
        
        // Sort Options
        $this->args['orderby'] = 'meta_value_num';
        $this->args['order'] = (in_array($this->order_method, array('ASC', 'DESC')) ? $this->order_method : 'ASC');
        $this->args['meta_key'] = 'mec_start_day_seconds';
        
        // Exclude Posts
        if(isset($this->atts['exclude']) and is_array($this->atts['exclude']) and count($this->atts['exclude'])) $this->args['post__not_in'] = $this->atts['exclude'];
        
        // Include Posts
        if(isset($this->atts['include']) and is_array($this->atts['include']) and count($this->atts['include'])) $this->args['post__in'] = $this->atts['include'];

        // Show Only Expired Events
        $this->show_only_expired_events = (isset($this->atts['show_only_past_events']) and trim($this->atts['show_only_past_events'])) ? '1' : '0';

        // Maximum Date Range.
        $this->maximum_date_range = $this->get_end_date();

        if($this->show_only_expired_events)
        {
            $this->atts['show_past_events'] = '1';
            $this->args['order'] = 'DESC';
        }

        // Show Past Events
        $this->args['mec-past-events'] = isset($this->atts['show_past_events']) ? $this->atts['show_past_events'] : '0';

        // Start Date
        $this->start_date = $this->get_start_date();
        
        // We will extend the end date in the loop
        $this->end_date = $this->start_date;
        
        // Set start time
        if(isset($this->atts['seconds']))
        {
            $this->args['mec-seconds'] = $this->atts['seconds'];
            $this->args['mec-seconds-date'] = isset($this->atts['seconds_date']) ? $this->atts['seconds_date'] : $this->start_date;
        }
        
        // Apply Maximum Date
        if($this->request->getVar('apply_sf_date', 0) == 1 and isset($this->sf) and isset($this->sf['month']) and trim($this->sf['month'])) $this->maximum_date = date('Y-m-t', strtotime($this->start_date));
        
        // Found Events
        $this->found = 0;

        do_action('mec-masonry-initialize-end', $this);
    }
    
    /**
     * Returns start day of skin for filtering events
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_start_date()
    {
        // Default date
        $date = current_time('Y-m-d');
        
        if(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'today') $date = current_time('Y-m-d');
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'tomorrow') $date = date('Y-m-d', strtotime('Tomorrow'));
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'yesterday') $date = date('Y-m-d', strtotime('Yesterday'));
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'start_last_month') $date = date('Y-m-d', strtotime('first day of last month'));
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'start_current_month') $date = date('Y-m-d', strtotime('first day of this month'));
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'start_next_month') $date = date('Y-m-d', strtotime('first day of next month'));
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'date') $date = date('Y-m-d', strtotime($this->skin_options['start_date']));
        
        // Hide past events
        if(isset($this->atts['show_past_events']) and !trim($this->atts['show_past_events']))
        {
            $today = current_time('Y-m-d');
            if(strtotime($date) < strtotime($today)) $date = $today;
        }

        // Show only expired events
        if(isset($this->show_only_expired_events) and $this->show_only_expired_events)
        {
            $now = date('Y-m-d H:i:s', current_time('timestamp', 0));
            if(strtotime($date) > strtotime($now)) $date = $now;
        }
        
        return $date;
    }

    /**
     * Load more events for AJAX requert
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function load_more()
    {
        $this->sf = $this->request->getVar('sf', array());

        $mec_filter_by = sanitize_text_field($this->request->getVar('mec_filter_by', ''));
        $mec_filter_value = sanitize_text_field($this->request->getVar('mec_filter_value', ''));
        if($mec_filter_by and ($mec_filter_value and $mec_filter_value != '*')) $this->sf[$mec_filter_by] = $mec_filter_value;

        $apply_sf_date = sanitize_text_field($this->request->getVar('apply_sf_date', 1));
        $atts = $this->sf_apply($this->request->getVar('atts', array()), $this->sf, $apply_sf_date);
        
        // Initialize the skin
        $this->initialize($atts);
        
        // Override variables
        $this->start_date = sanitize_text_field($this->request->getVar('mec_start_date', date('y-m-d')));
        $this->end_date = $this->start_date;
        $this->offset = sanitize_text_field($this->request->getVar('mec_offset', 0));
		
        // Apply Maximum Date
        if($apply_sf_date == 1 and isset($this->sf) and isset($this->sf['month']) and trim($this->sf['month'])) $this->maximum_date = date('Y-m-t', strtotime($this->start_date));
        
        // Return the events
        $this->atts['return_items'] = true;
        
        // Fetch the events
        $this->fetch();
        
        // Return the output
        $output = $this->output();
        
        echo json_encode($output);
        exit;
    }

    public function filter_by()
    {
        $output = '<div class="mec-events-masonry-cats"><a href="#" class="mec-masonry-cat-selected" data-filter="*">'.esc_html__('All', 'mec').'</a>';

        $taxonomy = $this->filter_by_get_taxonomy();
        $terms = get_terms($taxonomy, array
        (
            'hide_empty' => true,
            'include' => ((isset($this->atts[$this->filter_by]) and trim($this->atts[$this->filter_by])) ? $this->atts[$this->filter_by] : ''),
        ));

        foreach($terms as $term) $output .= '<a href="#" data-filter=".mec-t'.esc_attr($term->term_id).'">'.esc_html($term->name).'</a>';

        $output .= '</div>';
        return $output;
    }

    public function filter_by_get_taxonomy()
    {
        if($this->filter_by == 'label') $taxonomy = 'mec_label';
        elseif($this->filter_by == 'location') $taxonomy = 'mec_location';
        elseif($this->filter_by == 'organizer') $taxonomy = 'mec_organizer';
        else $taxonomy = 'mec_category';

        return $taxonomy;
    }

    public function filter_by_classes($event_id)
    {
        $output = '';

        $taxonomy = $this->filter_by_get_taxonomy();
        $terms = wp_get_post_terms($event_id, $taxonomy, array
        (
            'hide_empty' => true,
        ));

        foreach($terms as $term) $output .= ' mec-t'.$term->term_id;
        return trim($output);
    }
}