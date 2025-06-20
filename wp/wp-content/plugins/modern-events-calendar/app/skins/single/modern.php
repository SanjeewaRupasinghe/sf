<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_single $this */

/**
 * TODO: Optimize
 */
wp_enqueue_style('mec-lity-style', $this->main->asset('packages/lity/lity.min.css'));
wp_enqueue_script('mec-lity-script', $this->main->asset('packages/lity/lity.min.js'));

$booking_options = get_post_meta(get_the_ID(), 'mec_booking', true);
if(!is_array($booking_options)) $booking_options = array();

// Compatibility with Rank Math
$rank_math_options = '';
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if(is_plugin_active('schema-markup-rich-snippets/schema-markup-rich-snippets.php')) $rank_math_options = get_post_meta(get_the_ID(), 'rank_math_rich_snippet', true);

$more_info = (isset($event->data->meta['mec_more_info']) and trim($event->data->meta['mec_more_info']) and $event->data->meta['mec_more_info'] != 'http://') ? $event->data->meta['mec_more_info'] : '';
if(isset($event->date) and isset($event->date['start']) and isset($event->date['start']['timestamp'])) $more_info = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'more_info', $more_info);

$more_info_target = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'more_info_target', (isset($event->data->meta['mec_more_info_target']) ? $event->data->meta['mec_more_info_target'] : '_self'));
$more_info_title = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'more_info_title', ((isset($event->data->meta['mec_more_info_title']) and trim($event->data->meta['mec_more_info_title'])) ? $event->data->meta['mec_more_info_title'] : esc_html__('Read More', 'mec')));

$location_id = $this->main->get_master_location_id($event);
$location = ($location_id ? $this->main->get_location_data($location_id) : array());

$organizer_id = $this->main->get_master_organizer_id($event);
$organizer = ($organizer_id ? $this->main->get_organizer_data($organizer_id) : array());

$sticky_sidebar = isset($settings['sticky_sidebar']) ? $settings['sticky_sidebar'] : '';
if($sticky_sidebar == 1) $sticky_sidebar = 'mec-sticky';

// Event Cost
$cost = $this->main->get_event_cost($event);
?>
<div class="mec-wrap <?php echo sanitize_html_class($event_colorskin); ?> clearfix <?php echo esc_attr($this->html_class); ?>" id="mec_skin_<?php echo esc_attr($this->uniqueid); ?>">
    <?php do_action('mec_top_single_event', get_the_ID()); ?>
    <article class="row mec-single-event mec-single-modern <?php echo sanitize_html_class($sticky_sidebar); ?>">

        <!-- start breadcrumbs -->
        <?php
        $breadcrumbs_settings = isset($settings['breadcrumbs']) ? $settings['breadcrumbs'] : '';
        if($breadcrumbs_settings == '1'): $breadcrumbs = new MEC_skin_single(); ?>
            <div class="mec-breadcrumbs mec-breadcrumbs-modern">
                <?php $breadcrumbs->display_breadcrumb_widget(get_the_ID()); ?>
            </div>
        <?php endif; ?>
        <!-- end breadcrumbs -->

        <div class="mec-events-event-image">
            <?php echo MEC_kses::element($event->data->thumbnails['full']); ?>
            <?php if(isset($settings['featured_image_caption']) and $settings['featured_image_caption']) echo MEC_kses::element($this->main->display_featured_image_caption($event)); ?>
            <?php do_action('mec_custom_dev_image_section', $event); ?>
        </div>

        <div class="col-md-4<?php if(empty($event->data->thumbnails['full'])) echo ' mec-no-image'; ?>">

            <?php do_action('mec_single_virtual_badge', $event->data); ?>
            <?php do_action('mec_single_zoom_badge', $event->data); ?>

            <?php
                $GLOBALS['mec-widget-single'] = $this;
                $GLOBALS['mec-widget-event'] = $event;
                $GLOBALS['mec-widget-occurrence'] = $occurrence;
                $GLOBALS['mec-widget-occurrence_end_date'] = $occurrence_end_date;
                $GLOBALS['mec-widget-cost'] = $cost;
                $GLOBALS['mec-widget-more_info'] = $more_info;
                $GLOBALS['mec-widget-location_id'] = $location_id;
                $GLOBALS['mec-widget-location'] = $location;
                $GLOBALS['mec-widget-organizer_id'] = $organizer_id;
                $GLOBALS['mec-widget-organizer'] = $organizer;
                $GLOBALS['mec-widget-more_info_target'] = $more_info_target;
                $GLOBALS['mec-widget-more_info_title'] = $more_info_title;
            ?>
            <!-- Widgets -->
            <?php dynamic_sidebar('mec-single-sidebar'); ?>

        </div>
        <div class="col-md-8">
            <div class="mec-single-event-bar">
                <?php
                    // Event Date and Time
                    if(isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start']))
                    {
                        $midnight_event = $this->main->is_midnight_event($event);
                    ?>
                        <div class="mec-single-event-date">
                            <i class="mec-sl-calendar"></i>
                            <h3 class="mec-date"><?php esc_html_e('Date', 'mec'); ?></h3>
                            <dl>
                            <?php if($midnight_event): ?>
                            <dd><abbr class="mec-events-abbr"><?php echo MEC_kses::element($this->main->dateify($event, $this->date_format1)); ?></abbr></dd>
                            <?php else: ?>
                            <dd><abbr class="mec-events-abbr"><?php echo MEC_kses::element($this->main->date_label((trim($occurrence) ? array('date' => $occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date' => $occurrence_end_date) : (isset($event->date['end']) ? $event->date['end'] : NULL)), $this->date_format1, ' - ', true, 0, $event)); ?></abbr></dd>
                            <?php endif; ?>
                            </dl>
                            <?php echo MEC_kses::element($this->main->holding_status($event)); ?>
                        </div>

                        <?php
                        if(isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0')
                        {
                            $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
                            $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
                            ?>
                            <div class="mec-single-event-time">
                                <i class="mec-sl-clock " style=""></i>
                                <h3 class="mec-time"><?php esc_html_e('Time', 'mec'); ?></h3>
                                <i class="mec-time-comment"><?php echo (isset($time_comment) ? esc_html($time_comment) : ''); ?></i>
                                <dl>
                                <?php if($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])): ?>
                                <dd><abbr class="mec-events-abbr"><?php echo esc_html($event->data->time['start']); ?><?php echo (trim($event->data->time['end']) ? ' - '.esc_html($event->data->time['end']) : ''); ?></abbr></dd>
                                <?php else: ?>
                                <dd><abbr class="mec-events-abbr"><?php echo esc_html($this->main->m('all_day', esc_html__('All Day' , 'mec'))); ?></abbr></dd>
                                <?php endif; ?>
                                </dl>
                            </div>
                        <?php
                        }
                    }
                ?>

                <?php
                    if($cost)
                    {
                        ?>
                        <div class="mec-event-cost">
                            <i class="mec-sl-wallet"></i>
                            <h3 class="mec-cost"><?php echo esc_html($this->main->m('cost', esc_html__('Cost', 'mec'))); ?></h3>
                            <dl><dd class="mec-events-event-cost"><?php echo MEC_kses::element($cost); ?></dd></dl>
                        </div>
                        <?php
                    }
                ?>
                <?php do_action('print_extra_costs', $event); ?>
                <?php
                // Event labels
                if(isset($event->data->labels) && !empty($event->data->labels))
                {
                    $mec_items = count($event->data->labels);
                    $mec_i = 0; ?>
                    <div class="mec-single-event-label">
                        <i class="mec-fa-bookmark-o"></i>
                        <h3 class="mec-cost"><?php echo esc_html($this->main->m('taxonomy_labels', esc_html__('Labels', 'mec'))); ?></h3>
                        <?php
                            foreach($event->data->labels as $labels=>$label)
                            {
                                $seperator = (++$mec_i === $mec_items) ? '' : ',';
                                echo '<dl><dd style="color:' . esc_attr($label['color']) . '">' . esc_html($label["name"] . $seperator) . '</dd></dl>';
                            }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="mec-event-content">
                <?php echo MEC_kses::element($this->main->display_cancellation_reason($event, $this->display_cancellation_reason)); ?>
                <h1 class="mec-single-title"><?php the_title(); ?></h1>
                <div class="mec-single-event-description mec-events-content"><?php the_content(); ?><?php do_action('mec_custom_dev_content_section', $event); ?></div>
            </div>

            <?php do_action('mec_single_after_content', $event); ?>

            <!-- Custom Data Fields -->
            <?php $this->display_data_fields($event); ?>

            <!-- Links Module -->
            <?php echo MEC_kses::full($this->main->module('links.details', array('event' => $event))); ?>

            <!-- Google Maps Module -->
            <div class="mec-events-meta-group mec-events-meta-group-gmap">
                <?php echo MEC_kses::full($this->main->module('googlemap.details', array('event' => $this->events))); ?>
            </div>

            <!-- Export Module -->
            <?php echo MEC_kses::full($this->main->module('export.details', array('event' => $event))); ?>

            <!-- Countdown module -->
            <?php if($this->main->can_show_countdown_module($event)): ?>
            <div class="mec-events-meta-group mec-events-meta-group-countdown">
                <?php echo MEC_kses::full($this->main->module('countdown.details', array('event' => $this->events))); ?>
            </div>
            <?php endif; ?>

            <!-- Hourly Schedule -->
            <?php $this->display_hourly_schedules_widget($event); ?>

            <?php do_action('mec_before_booking_form', get_the_ID()); ?>

			<!-- Booking Module -->
            <?php if($this->main->is_sold($event) and count($event->dates) <= 1): ?>
            <div id="mec-events-meta-group-booking-<?php echo esc_attr($this->uniqueid); ?>" class="mec-sold-tickets warning-msg"><?php esc_html_e('Sold out!', 'mec'); do_action( 'mec_booking_sold_out',$event, null,null,array($event->date) );?> </div>
            <?php elseif($this->main->can_show_booking_module($event)): ?>
            <?php $data_lity_class = ''; if(isset($settings['single_booking_style']) and $settings['single_booking_style'] == 'modal' ) $data_lity_class = 'lity-hide '; ?>
            <div class="mec-single-event <?php echo sanitize_html_class($data_lity_class); ?>" id="mec-events-meta-group-booking-box-<?php echo esc_attr($this->uniqueid); ?>">
                <div id="mec-events-meta-group-booking-<?php echo esc_attr($this->uniqueid); ?>" class="mec-events-meta-group mec-events-meta-group-booking">
                    <?php
                        if(isset($settings['booking_user_login']) and $settings['booking_user_login'] == '1' and !is_user_logged_in()) echo do_shortcode('[MEC_login]');
                        elseif(isset($settings['booking_user_login']) and $settings['booking_user_login'] == '0' and !is_user_logged_in() and isset($booking_options['bookings_limit_for_users']) and $booking_options['bookings_limit_for_users'] == '1') echo do_shortcode('[MEC_login]');
                        else echo MEC_kses::full($this->main->module('booking.default', array('event' => $this->events)));
                    ?>
                </div>
            </div>
            <?php endif ?>

            <!-- Tags -->
            <div class="mec-events-meta-group mec-events-meta-group-tags">
                <?php echo get_the_term_list(get_the_ID(), apply_filters('mec_taxonomy_tag', ''), esc_html__('Tags: ', 'mec'), ', ', '<br />'); ?>
            </div>

        </div>
    </article>

    <?php $this->display_related_posts_widget($event->ID); ?>
    <?php $this->display_next_previous_events($event); ?>

</div>
<?php
    // MEC Schema
    if($rank_math_options != 'event') do_action('mec_schema', $event);
?>
<script>
jQuery(".mec-speaker-avatar a").on('click', function(e)
{
    e.preventDefault();

    var id = jQuery(this).attr('href');
    lity(id);
});

// Fix modal booking in some themes
jQuery(".mec-booking-button.mec-booking-data-lity").on('click', function(e)
{
    e.preventDefault();

    var book_id = jQuery(this).attr('href');
    lity(book_id);
});
</script>