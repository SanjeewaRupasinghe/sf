<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC Weekly view class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_skin_weekly_view extends MEC_skins
{
    /**
     * @var string
     */
    public $skin = 'weekly_view';

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
        $this->factory->action('wp_ajax_mec_weekly_view_load_month', array($this, 'load_month'));
        $this->factory->action('wp_ajax_nopriv_mec_weekly_view_load_month', array($this, 'load_month'));
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

        // Search Form Options
        $this->sf_options = (isset($this->atts['sf-options']) and isset($this->atts['sf-options'][$this->skin])) ? $this->atts['sf-options'][$this->skin] : array();

        // Search Form Status
        $this->sf_status = isset($this->atts['sf_status']) ? $this->atts['sf_status'] : true;
        $this->sf_display_label = isset($this->atts['sf_display_label']) ? $this->atts['sf_display_label'] : false;
        $this->sf_reset_button = isset($this->atts['sf_reset_button']) ? $this->atts['sf_reset_button'] : false;
        $this->sf_refine = isset($this->atts['sf_refine']) ? $this->atts['sf_refine'] : false;

        // Generate an ID for the skin
        $this->id = isset($this->atts['id']) ? $this->atts['id'] : mt_rand(100, 999);

        // Set the ID
        if(!isset($this->atts['id'])) $this->atts['id'] = $this->id;

        // Next/Previous Month
        $this->next_previous_button = isset($this->skin_options['next_previous_button']) ? $this->skin_options['next_previous_button'] : true;

        // HTML class
        $this->html_class = '';
        if(isset($this->atts['html-class']) and trim($this->atts['html-class']) != '') $this->html_class = $this->atts['html-class'];

        // Booking Button
        $this->booking_button = isset($this->skin_options['booking_button']) ? (int) $this->skin_options['booking_button'] : 0;

        // SED Method
        $this->sed_method = isset($this->skin_options['sed_method']) ? $this->skin_options['sed_method'] : '0';

        // Image popup
        $this->image_popup = isset($this->skin_options['image_popup']) ? $this->skin_options['image_popup'] : '0';

        // reason_for_cancellation
        $this->reason_for_cancellation = isset($this->skin_options['reason_for_cancellation']) ? $this->skin_options['reason_for_cancellation'] : false;

        // display_label
        $this->display_label = isset($this->skin_options['display_label']) ? $this->skin_options['display_label'] : false;

        // From Widget
        $this->widget = (isset($this->atts['widget']) and trim($this->atts['widget'])) ? true : false;

        // From Full Calendar
        $this->from_full_calendar = (isset($this->skin_options['from_fc']) and trim($this->skin_options['from_fc'])) ? true : false;

        // Display Price
        $this->display_price = (isset($this->skin_options['display_price']) and trim($this->skin_options['display_price'])) ? true : false;

        // Detailed Time
        $this->display_detailed_time = (isset($this->skin_options['detailed_time']) and trim($this->skin_options['detailed_time'])) ? true : false;

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
        $this->limit = (isset($this->skin_options['limit']) and trim($this->skin_options['limit'])) ? $this->skin_options['limit'] : 12;

        $this->args['posts_per_page'] = $this->limit;
        $this->args['paged'] = $this->paged;

        // Sort Options
        $this->args['orderby'] = 'meta_value_num';
        $this->args['order'] = 'ASC';
        $this->args['meta_key'] = 'mec_start_day_seconds';

        // Show Only Expired Events
        $this->show_only_expired_events = (isset($this->atts['show_only_past_events']) and trim($this->atts['show_only_past_events'])) ? '1' : '0';

        // Show Past Events
        if($this->show_only_expired_events) $this->atts['show_past_events'] = '1';

        // Show Past Events
        $this->args['mec-past-events'] = isset($this->atts['show_past_events']) ? $this->atts['show_past_events'] : '0';

        // Start Date
        list($this->year, $this->month, $this->day) = $this->get_start_date();

        $this->today = $this->year.'-'.$this->month.'-'.$this->day;
        $this->start_date = $this->year.'-'.$this->month.'-01';

        // Set the maximum date in current month
        if($this->show_only_expired_events) $this->maximum_date = date('Y-m-d H:i:s', current_time('timestamp', 0));

        // We will extend the end date in the loop
        $this->end_date = $this->start_date;

        $this->weeks = $this->main->split_to_weeks($this->start_date, date('Y-m-t', strtotime($this->start_date)));

        $this->week_of_days = array();
        foreach($this->weeks as $week_number=>$week) foreach($week as $day) $this->week_of_days[$day] = $week_number;

        $this->maximum_dates = isset($this->atts['maximum_dates']) ? $this->atts['maximum_dates'] : 1;

        do_action('mec-weekly-initialize-end', $this);
    }

    /**
     * Search and returns the filtered events
     * @author Webnus <info@webnus.biz>
     * @return array of objects
     */
    public function search()
    {
        if($this->show_only_expired_events)
        {
            $start =  date('Y-m-d H:i:s', current_time('timestamp', 0));
            $end = $this->main->array_key_first($this->week_of_days);
        }
        else
        {
            $start = $this->main->array_key_first($this->week_of_days);
            $end = $this->maximum_date ? $this->maximum_date : $this->main->array_key_last($this->week_of_days);
        }

        // Date Events
        $dates = $this->period($start, $end, true);

        $s = $this->start_date;
        $sorted = array();
        while(date('m', strtotime($s)) == $this->month)
        {
            if(isset($dates[$s])) $sorted[$s] = $dates[$s];
            else $sorted[$s] = array();

            $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
        }

        $dates = array_merge($sorted, $dates);
        uksort($dates, array($this, 'sort_dates'));

        // Limit
        $this->args['posts_per_page'] = $this->limit;

        $events = array();
        $qs = array();

        foreach($dates as $date=>$IDs)
        {
            // Check Finish Date
            if(isset($this->maximum_date) and strtotime($date) > strtotime($this->maximum_date))
            {
                $events[$date] = array();
                continue;
            }

            // Include Available Events
            $this->args['post__in'] = array_unique($IDs);

            // Count of events per day
            $IDs_count = array_count_values($IDs);

            // Extending the end date
            $this->end_date = $date;

            // The Query
            $this->args = apply_filters('mec_skin_query_args', $this->args, $this);

            // Query Key
            $q_key = base64_encode(json_encode($this->args));

            // Get From Cache
            if(isset($qs[$q_key])) $query = $qs[$q_key];
            // Search & Cache
            else
            {
                $query = new WP_Query($this->args);
                $qs[$q_key] = $query;
            }

            if(is_array($IDs) and count($IDs) and $query->have_posts())
            {
                if(!isset($events[$date])) $events[$date] = array();

                // Day Events
                $d = array();

                // The Loop
                while($query->have_posts())
                {
                    $query->the_post();
                    $ID = get_the_ID();

                    $ID_count = isset($IDs_count[$ID]) ? $IDs_count[$ID] : 1;
                    for($i = 1; $i <= $ID_count; $i++)
                    {
                        $rendered = $this->render->data($ID);

                        $repeat_type = !empty($rendered->meta['mec_repeat_type']) ?  $rendered->meta['mec_repeat_type'] : '';
                        $occurrence = $date;

                        if(strtotime($occurrence) and in_array($repeat_type, array('certain_weekdays', 'custom_days', 'weekday', 'weekend'))) $occurrence = date('Y-m-d', strtotime($occurrence));
                        elseif(strtotime($occurrence)) $occurrence = date('Y-m-d', strtotime('-1 day', strtotime($occurrence)));
                        else $occurrence = NULL;

                        $dates = $this->render->dates(get_the_ID(), $rendered, $this->maximum_dates, $occurrence);

                        $data = new stdClass();
                        $data->ID = $ID;
                        $data->data = $rendered;

                        $data->dates = $dates;
                        $data->date = array
                        (
                            'start' => array('date' => $date),
                            'end' => array('date' => $this->main->get_end_date($date, $rendered))
                        );

                        $d[] = $this->render->after_render($data, $this, $i);
                    }
                }

                usort($d, array($this, 'sort_day_events'));
                $events[$date] = $d;
            }
            else
            {
                $events[$date] = array();
            }

            // Restore original Post Data
            wp_reset_postdata();
        }

        // Initialize Occurrences' Data
        MEC_feature_occurrences::fetch($events);

        return $events;
    }

    /**
     * Returns start day of skin for filtering events
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_start_date()
    {
        // Default date
        $date = current_time('Y-m-d');

        // Weekdays
        $weekdays = $this->main->get_weekday_labels();

        if(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'start_current_week')
        {
            if(date('w') == $this->main->get_first_day_of_week()) $date = date('Y-m-d', strtotime('This '.$weekdays[0]));
            else $date = date('Y-m-d', strtotime('Last '.$weekdays[0]));
        }
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'start_next_week') $date = date('Y-m-d', strtotime('Next '.$weekdays[0]));
        elseif(isset($this->skin_options['start_date_type']) and $this->skin_options['start_date_type'] == 'start_last_week') $date = date('Y-m-d', strtotime('Last '.$weekdays[0]));
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
            $yesterday = date('Y-m-d', strtotime('Yesterday'));
            if(strtotime($date) > strtotime($yesterday)) $date = $yesterday;
        }

        $time = strtotime($date);
        return array(date('Y', $time), date('m', $time), date('d', $time));
    }

    /**
     * Load month for AJAX requert
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function load_month()
    {
        $this->sf = $this->request->getVar('sf', array());
        $apply_sf_date = sanitize_text_field($this->request->getVar('apply_sf_date', 1));
        $atts = $this->sf_apply($this->request->getVar('atts', array()), $this->sf, $apply_sf_date);
        $navigator_click = sanitize_text_field($this->request->getVar('navigator_click', false));

        // Initialize the skin
        $this->initialize($atts);

        //  Weekly view search repeat if not found in current month
        $c = 0;
        $break = false;

        do
        {
            if($c > 12) $break=true;
            if($c and !$break)
            {
                if(intval($this->month == 12))
                {
                    $this->year = intval($this->year)+1;
                    $this->month = '01';
                }

                $this->month = sprintf("%02d", intval($this->month)+1);
            }
            else
            {
                // Start Date
                $this->year = sanitize_text_field($this->request->getVar('mec_year', date('Y')));
                $this->month = sanitize_text_field($this->request->getVar('mec_month', date('m')));
            }

            $this->week = 1;

            $this->start_date = $this->year.'-'.$this->month.'-01';

            // We will extend the end date in the loop
            $this->end_date = $this->start_date;

            // Weeks
            $this->weeks = $this->main->split_to_weeks($this->start_date, date('Y-m-t', strtotime($this->start_date)));

            // Get week of days
            $this->week_of_days = array();
            foreach($this->weeks as $week_number=>$week) foreach($week as $day) $this->week_of_days[$day] = $week_number;

            // Some times some months have 6 weeks but next month has 5 or even 4 weeks
            if(!isset($this->weeks[$this->week])) $this->week = $this->week-1;
            if(!isset($this->weeks[$this->week])) $this->week = $this->week-1;

            $this->today = $this->weeks[$this->week][0];

            // Return the events
            $this->atts['return_items'] = true;

            // Fetch the events
            $this->fetch();

            // Break the loop if not resault
            if($break) break;
            if($navigator_click) break;

            $c++;
        }
        while(!array_filter($this->events) and count($this->sf));

        // Return the output
        $output = $this->output();

        echo json_encode($output);
        exit;
    }
}