<?php

namespace MEC_Virtual_Events\Core\addEventOptions;

// don't load directly.
if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * MecCTP.
 *
 * @author      author
 * @package     package
 * @since       1.0.0
 */
class MecAddEventOptions
{

    /**
     * Instance of this class.
     *
     * @since   1.0.0
     * @access  public
     * @var     MEC_Virtual_Events
     */
    public static $instance;

    /**
     * The directory of the file.
     *
     * @access  public
     * @var     string
     */
    public static $dir;

    /**
     * The Args
     *
     * @access  public
     * @var     array
     */
    public static $args;

    /**
     * Provides access to a single instance of a module using the singleton pattern.
     *
     * @since   1.0.0
     * @return  object
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function __construct()
    {
        self::settingUp();
        self::setHooks($this);
        self::init();
    }

    /**
     * Set Hooks.
     *
     * @since   1.0.0
     */
    public static function setHooks($This)
    {
        add_filter('mec-single-event-meta-title', [$This, 'add_options'] , 99 , 2);
        add_filter('MEC_extra_info_gateways', [$This, 'display_password_in_booking'] , 99 , 2);
        
        add_filter('mec_monthly_virtual_badge', [$This, 'display_badge_in_monthly'] , 99 , 2);

        add_action('wp_enqueue_scripts', [$This, 'assets']);
        add_action('mec_metabox_details', [$This, 'meta_box_virtual'], 60);
        add_action('save_post', [$This, 'save_event']);
        add_action('mec_single_after_content', [$This, 'display_in_single_page']);
        add_action('mec_single_virtual_badge', [$This, 'display_badge_in_single'] , 99 ,1);
        add_action('mec_shortcode_virtual_badge', [$This, 'display_badge_in_shortcode'] , 99, 1);
        add_action('mec_extra_field_notifications', [$This, 'display_notification_field']);
        
        //add_filter( 'the_content', [$This,'display_in_single_page'], 1 );
        
    }

    /**
     * Global Variables.
     *
     * @since   1.0.0
     */
    public static function settingUp(){}

    public function assets() {
        wp_enqueue_style('mec-virtual-style', MECVIRTUALDASSETS . 'mec-virtual.css' );
    }

    /**
     * Global Variables.
     *
     * @since   1.0.0
     */
    public function add_options( $tabs, $activated ) {
        $virtualTab =  array(
            __('Virtual Event', 'mec-virtual') => 'mec-virtual',
        );
        $tabs = array_merge($tabs, $virtualTab);
        return $tabs;
    }

    public function meta_box_virtual($post)
    {
        $mec_virtual_event = get_post_meta($post->ID, 'mec_virtual_event', true);
        $mec_virtual_badge_shortcode = get_post_meta($post->ID, 'mec_virtual_badge_shortcode', true);
        $mec_virtual_badge_single = get_post_meta($post->ID, 'mec_virtual_badge_single', true);

        $virtual_link_url = get_post_meta($post->ID, 'mec_virtual_link_url', true);
        $virtual_link_title = get_post_meta($post->ID, 'mec_virtual_link_title', true);
        $virtual_link_target = get_post_meta($post->ID, 'mec_virtual_link_target', true);
        
        $virtual_embed = get_post_meta($post->ID, 'mec_virtual_embed', true);
        
        
        $virtual_hide_info_before_start = get_post_meta($post->ID, 'mec_virtual_hide_info_before_start', true);
        $virtual_show_info_time = get_post_meta($post->ID, 'mec_virtual_show_info_time', true);
        $virtual_show_info_hm = get_post_meta($post->ID, 'mec_virtual_show_info_hm', true);

        $mec_virtual_hide_info = get_post_meta($post->ID, 'mec_virtual_hide_info', true);
        
        $mec_virtual_password = get_post_meta($post->ID, 'mec_virtual_password', true);
        $mec_virtual_display_password_in_booking = get_post_meta($post->ID, 'mec_virtual_display_password_in_booking', true);

        $mec_virtual_display_link_in_booking = get_post_meta($post->ID, 'mec_virtual_display_link_in_booking', true);

        ?>
        <div class="mec-meta-box-fields mec-event-tab-content" id="mec-virtual">
            <h4><?php echo __('Virtual Event', 'mec-virtual'); ?></h4>
            <div class="mec-form-row">
                <input
                    <?php
                    if (isset($mec_virtual_event) and $mec_virtual_event == true) {
                        echo 'checked="checked"';
                    }
                    ?>
                        type="checkbox" name="mec[mec_virtual_event]" id="mec_virtual_event" value="1"/><label
                        for="mec_virtual_event"><input id="mec_virtual_event_hidden" type="hidden" value="" /><?php _e('Enable Virtual Event', 'mec-virtual'); ?></label>
            </div>
            <div class="mec-virtual-event-wrap" style="<?php echo (isset($mec_virtual_event) and $mec_virtual_event == true) ? 'display: block': 'display: none'; ?>">
                <div class="mec-form-row">
                    <input
                        <?php
                        if (isset($mec_virtual_badge_shortcode) and $mec_virtual_badge_shortcode == true) {
                            echo 'checked="checked"';
                        }
                        ?>
                            type="checkbox" name="mec[mec_virtual_badge_shortcode]" id="mec_virtual_badge_shortcode" value="1"/><label
                            for="mec_virtual_badge_shortcode"><?php _e('Display virtual badge in shortcode', 'mec-virtual'); ?></label>
                </div>
                <div class="mec-form-row">
                    <input
                        <?php
                        if (isset($mec_virtual_badge_single) and $mec_virtual_badge_single == true) {
                            echo 'checked="checked"';
                        }
                        ?>
                            type="checkbox" name="mec[mec_virtual_badge_single]" id="mec_virtual_badge_single" value="1"/><label
                            for="mec_virtual_badge_single"><?php _e('Display virtual badge in single event', 'mec-virtual'); ?></label>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-1" for="mec_virtual_link_url"><?php esc_html_e('Link' , 'mec-virtual'); ?></label>
                    <input class="mec-col-4" type="text" name="mec[mec_virtual_link_url]" id="mec_virtual_link_url" value="<?php echo esc_attr($virtual_link_url); ?>" placeholder="eg. https://youtube.com">
                    <input class="mec-col-2" type="text" name="mec[mec_virtual_link_title]" id="mec_virtual_link_title" value="<?php echo esc_attr($virtual_link_title); ?>" placeholder="Title">
                    <select class="mec-col-2" name="mec[mec_virtual_link_target]" id="mec_virtual_link_target">
                        <option value="_self" <?php echo($virtual_link_target == '_self' ? 'selected="selected"' : ''); ?>><?php _e('Current Window', 'mec-virtual'); ?></option>
                        <option value="_blank" <?php echo($virtual_link_target == '_blank' ? 'selected="selected"' : ''); ?>><?php _e('New Window', 'mec-virtual'); ?></option>
                    </select>
                    <label class="mec-col-3" for="mec_virtual_display_link_in_booking"><input
                        <?php
                        if (isset($mec_virtual_display_link_in_booking) and $mec_virtual_display_link_in_booking == true) {
                            echo 'checked="checked"';
                        }
                        ?>
                            type="checkbox"  name="mec[mec_virtual_display_link_in_booking]" id="mec_virtual_display_link_in_booking" value="1"/><?php esc_html_e('Display when booking is complete' , 'mec-virtual'); ?></label>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-1" for="mec_virtual_password"><?php esc_html_e('Password' , 'mec-virtual'); ?></label>
                    <input class="mec-col-6" type="text" name="mec[mec_virtual_password]" id="mec_virtual_password" value="<?php echo esc_attr($mec_virtual_password); ?>"/>
                    <label class="mec-col-5" for="mec_virtual_display_password_in_booking"><input
                        <?php
                        if (isset($mec_virtual_display_password_in_booking) and $mec_virtual_display_password_in_booking == true) {
                            echo 'checked="checked"';
                        }
                        ?>
                            type="checkbox"  name="mec[mec_virtual_display_password_in_booking]" id="mec_virtual_display_password_in_booking" value="1"/><?php esc_html_e('Display when booking is complete' , 'mec-virtual'); ?></label>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-1" for="mec_virtual_embed"><?php esc_html_e('Embed' , 'mec-virtual'); ?></label>
                    <textarea class="mec-col-11" type="text" name="mec[mec_virtual_embed]" id="mec_virtual_embed" ><?php echo esc_attr($virtual_embed); ?></textarea>
                </div>
                <div class="mec-form-row">
                    
                    <label class="mec-col-3" for="mec_virtual_hide_info_before_start"><input
                        <?php
                        if (isset($virtual_hide_info_before_start) and $virtual_hide_info_before_start == true) {
                            echo 'checked="checked"';
                        }
                        ?>
                            type="checkbox"  name="mec[mec_virtual_hide_info_before_start]" id="mec_virtual_hide_info_before_start" value="1"/><?php esc_html_e('Display above information' , 'mec-virtual'); ?></label>
                    <input class="mec-col-1" type="number" name="mec[mec_virtual_show_info_time]" value="<?php echo((isset($virtual_show_info_time) and trim($virtual_show_info_time)) ? esc_attr($virtual_show_info_time) : '0'); ?>" placeholder="<?php _e('e.g. 0', 'mec'); ?>">
                    <select class="mec-col-1" name="mec[mec_virtual_show_info_hm]" id="mec_virtual_show_info_hm">
                        <option value="day" <?php echo($virtual_show_info_hm == 'day' ? 'selected="selected"' : ''); ?>><?php _e('Day', 'mec-virtual'); ?></option>
                        <option value="hour" <?php echo($virtual_show_info_hm == 'hour' ? 'selected="selected"' : ''); ?>><?php _e('Hour', 'mec-virtual'); ?></option>
                        <option value="minute" <?php echo($virtual_show_info_hm == 'minute' ? 'selected="selected"' : ''); ?>><?php _e('Minute', 'mec-virtual'); ?></option>
                    </select>
                    <label class="mec-col-2" for="mec_virtual_show_info_time"><?php esc_html_e('before event start.' , 'mec-virtual'); ?></label>
                </div>
                <div class="mec-form-row">
                    <input
                        <?php
                        if (isset($mec_virtual_hide_info) and $mec_virtual_hide_info == true) {
                            echo 'checked="checked"';
                        }
                        ?>
                            type="checkbox" name="mec[mec_virtual_hide_info]" id="mec_virtual_hide_info" value="1"/><label
                            for="mec_virtual_hide_info"><?php _e('Hide above information when event is live', 'mec-virtual'); ?></label>
                </div>
            </div>
        </div>
        <script>
        jQuery(document).ready(function()
        {
            jQuery('input#mec_virtual_event').on('change', function()
            {
                if ( jQuery(this).attr('checked') == 'checked') {
                    jQuery('.mec-virtual-event-wrap').show();
                } else {
                    jQuery('.mec-virtual-event-wrap').hide();
                }

            });
        });
        </script>
        <?php
    }

    public function save_event($post_id)
    {
        // Check if our nonce is set.
        if(!isset($_POST['mec_event_nonce'])) return false;

        // Verify that the nonce is valid.
        if(!wp_verify_nonce(sanitize_text_field($_POST['mec_event_nonce']), 'mec_event_data')) return false;

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if(defined('DOING_AUTOSAVE') and DOING_AUTOSAVE) return false;

        // Get Modern Events Calendar Data
        $_mec = isset($_POST['mec']) ? $_POST['mec'] : array();

        $mec_virtual_event = (isset($_mec['mec_virtual_event']) and !empty($_mec['mec_virtual_event'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_event', $mec_virtual_event);

        $mec_virtual_badge_shortcode = (isset($_mec['mec_virtual_badge_shortcode']) and !empty($_mec['mec_virtual_badge_shortcode'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_badge_shortcode', $mec_virtual_badge_shortcode);

        $mec_virtual_badge_single = (isset($_mec['mec_virtual_badge_single']) and !empty($_mec['mec_virtual_badge_single'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_badge_single', $mec_virtual_badge_single);

        $mec_virtual_link_url = (isset($_mec['mec_virtual_link_url']) and !empty($_mec['mec_virtual_link_url'])) ? $_mec['mec_virtual_link_url'] : '';
        update_post_meta($post_id, 'mec_virtual_link_url', $mec_virtual_link_url);

        $mec_virtual_link_title = (isset($_mec['mec_virtual_link_title']) and !empty($_mec['mec_virtual_link_title'])) ? $_mec['mec_virtual_link_title'] : '';
        update_post_meta($post_id, 'mec_virtual_link_title', $mec_virtual_link_title);

        $mec_virtual_link_target = (isset($_mec['mec_virtual_link_target']) and !empty($_mec['mec_virtual_link_target'])) ? $_mec['mec_virtual_link_target'] : '';
        update_post_meta($post_id, 'mec_virtual_link_target', $mec_virtual_link_target);

        $mec_virtual_embed = (isset($_mec['mec_virtual_embed']) and !empty($_mec['mec_virtual_embed'])) ? $_mec['mec_virtual_embed'] : '';
        update_post_meta($post_id, 'mec_virtual_embed', $mec_virtual_embed);

        $mec_virtual_show_info_time = (isset($_mec['mec_virtual_show_info_time']) and !empty($_mec['mec_virtual_show_info_time'])) ? $_mec['mec_virtual_show_info_time'] : '';
        update_post_meta($post_id, 'mec_virtual_show_info_time', $mec_virtual_show_info_time);

        $mec_virtual_show_info_hm = (isset($_mec['mec_virtual_show_info_hm']) and !empty($_mec['mec_virtual_show_info_hm'])) ? $_mec['mec_virtual_show_info_hm'] : '';
        update_post_meta($post_id, 'mec_virtual_show_info_hm', $mec_virtual_show_info_hm);

        $mec_virtual_hide_info = (isset($_mec['mec_virtual_hide_info']) and !empty($_mec['mec_virtual_hide_info'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_hide_info', $mec_virtual_hide_info);

        $mec_virtual_hide_info_before_start = (isset($_mec['mec_virtual_hide_info_before_start']) and !empty($_mec['mec_virtual_hide_info_before_start'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_hide_info_before_start', $mec_virtual_hide_info_before_start);

        $mec_virtual_password = (isset($_mec['mec_virtual_password']) and !empty($_mec['mec_virtual_password'])) ? $_mec['mec_virtual_password'] : '';
        update_post_meta($post_id, 'mec_virtual_password', $mec_virtual_password);

        $mec_virtual_display_password_in_booking = (isset($_mec['mec_virtual_display_password_in_booking']) and !empty($_mec['mec_virtual_display_password_in_booking'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_display_password_in_booking', $mec_virtual_display_password_in_booking);
        
        $mec_virtual_display_link_in_booking = (isset($_mec['mec_virtual_display_link_in_booking']) and !empty($_mec['mec_virtual_display_link_in_booking'])) ? true : false;
        update_post_meta($post_id, 'mec_virtual_display_link_in_booking', $mec_virtual_display_link_in_booking);

        return true;
    }

    public function display_in_single_page($event) {
        $main = new \MEC_main();
        $event_id = $event->data->ID;
        $timestamp = $event->data->time['start_timestamp'];
        $timestamp = $main->get_start_time_of_multiple_days($event_id, $timestamp);

        $ex = explode(':', $timestamp);
        $timestamp = (int) $ex[0];

        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);
        $day = date('d', $timestamp);
        $hour = date('H', $timestamp);
        $minutes = date('i', $timestamp);

        // Ticket Selling Stop
        $event_date = date('Y-m-d h:i a', $timestamp);

        $virtual_link_url = get_post_meta($event_id, 'mec_virtual_link_url', true);
        $virtual_link_title = get_post_meta($event_id, 'mec_virtual_link_title', true);
        $virtual_link_target = get_post_meta($event_id, 'mec_virtual_link_target', true);
        $mec_virtual_display_link_in_booking = get_post_meta($event_id, 'mec_virtual_display_link_in_booking', true);

        $virtual_link = ($virtual_link_title and $mec_virtual_display_link_in_booking != '1')  ? '<a class="mec-event-virtual-link" href="'.$virtual_link_url.'" target="'.$virtual_link_target.'">'.$virtual_link_title.'</a>' : '' ;
        
        $virtual_embed = get_post_meta($event_id, 'mec_virtual_embed', true) ? '<div class="mec-event-virtual-embed">'.get_post_meta($event_id, 'mec_virtual_embed', true).'</div>' : '';

        $virtual_hide_info_before_start = get_post_meta($event_id, 'mec_virtual_hide_info_before_start', true);
        $virtual_show_info_time = get_post_meta($event_id, 'mec_virtual_show_info_time', true);
        $virtual_show_info_hm = get_post_meta($event_id, 'mec_virtual_show_info_hm', true);

        $mec_virtual_hide_info = get_post_meta($event_id, 'mec_virtual_hide_info', true);

        $virtual_display_password_in_booking = get_post_meta($event_id, 'mec_virtual_display_password_in_booking', true);
        $virtual_password = (get_post_meta($event_id, 'mec_virtual_password', true) and $virtual_display_password_in_booking != '1') ? '<div class="mec-virtual-password"><strong>'.esc_html__('Password:' ,'mec-virtual') . '</strong> <span>' .get_post_meta($event_id, 'mec_virtual_password', true) . '</span></div>' : '';



        $content = '
        <div class="mec-event-data-fields mec-frontbox">
            '.$virtual_embed.'
            '.$virtual_link.'
            '.$virtual_password.'
        </div>
        ';

        if ( $virtual_hide_info_before_start and $virtual_show_info_time > 0  and $main->check_date_time_validation('Y-m-d h:i a', strtolower($event_date)) and strtotime("-{$virtual_show_info_time}{$virtual_show_info_hm}", strtotime($event_date)) > current_time('timestamp', 0) and !$mec_virtual_hide_info) {
            echo $content;
        } elseif ( $mec_virtual_hide_info and !$main->is_ongoing($event)) {
            echo $content;
        } elseif (!$mec_virtual_hide_info and !$virtual_hide_info_before_start) {
           echo $content; 
        }
    }

    public function display_badge_in_single( $event_id ) {
        $get_meta = get_post_meta($event_id, 'mec_virtual_badge_single', true);

        if ($get_meta) {
            echo '
                <div class="mec-single-virtual-badge">
                    <i class="mec-sl-camrecorder"></i><h3>'.esc_html__('Virtual Event' , 'mec-virtual').'</h3>
                </div>
            ';
        }
    }

    public function display_badge_in_shortcode( $event_id ) {
        $get_meta = get_post_meta($event_id, 'mec_virtual_badge_shortcode', true);

        if ($get_meta) {
        ?>
            <span class="mec-shortcode-virtual-badge">
                <i class="mec-sl-camrecorder"></i><span><?php echo esc_html__('Virtual Event' , 'mec-virtual')?></span>
            </span>
        <?php
        }
    }

    public function display_badge_in_monthly($events_str,$event_id)
    {

        $get_meta = get_post_meta($event_id, 'mec_virtual_badge_shortcode', true);
        $new_events_str = '';
        if ($get_meta) {
            $new_events_str =
            '
            <span class="mec-shortcode-virtual-badge">
                <i class="mec-sl-camrecorder"></i><span>'.esc_html__('Virtual Event' , 'mec-virtual').'</span>
            </span>
            ';
        }
        $events_str = $new_events_str;

        return $events_str;
    }

    public function display_password_in_booking($content, $event_id) {
        $virtual_link_url = get_post_meta($event_id, 'mec_virtual_link_url', true);
        $virtual_link_title = get_post_meta($event_id, 'mec_virtual_link_title', true);
        $virtual_link_target = get_post_meta($event_id, 'mec_virtual_link_target', true);
        $mec_virtual_display_link_in_booking = get_post_meta($event_id, 'mec_virtual_display_link_in_booking', true);

        $virtual_link = ($virtual_link_title and $mec_virtual_display_link_in_booking == '1')  ? '<div class="mec-event-virtual-link-wrap"><strong>'.esc_html('Virtual Event Link:' ,'mec-virtual').'</strong> <a class="mec-virtual-link-in-booking" href="'.$virtual_link_url.'" target="'.$virtual_link_target.'">'.$virtual_link_title.'</a></div>' : '' ;
        
        $virtual_display_password_in_booking = get_post_meta($event_id, 'mec_virtual_display_password_in_booking', true);
        $virtual_password = (get_post_meta($event_id, 'mec_virtual_password', true) and $virtual_display_password_in_booking == '1') ? '<div class="mec-virtual-password-in-booking"><strong>'.esc_html__('Virtual Event Password:' ,'mec-virtual') . '</strong> <span>' .get_post_meta($event_id, 'mec_virtual_password', true) . '</span></div>' : '';
        
        $content .= $virtual_link . $virtual_password;

        return $content;
    }

    public function display_notification_field() {
        ?>
        <li><span>%%virtual_link%%</span>: <?php _e('Virtual link', 'mec-virtual'); ?></li>
        <li><span>%%virtual_password%%</span>: <?php _e('Virtual password', 'mec-virtual'); ?></li>
        <li><span>%%virtual_embed%%</span>: <?php _e('Virtual embed', 'mec-virtual'); ?></li>
        <?php
    }

    /**
     * Register Autoload Files
     *
     * @since     1.0.0
     */
    public function init()
    {
        if (!class_exists('\MEC_Virtual_Events\Autoloader')) {
            return;
        }
    }
} //MecCTP
