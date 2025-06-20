<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_daily_view $this */

$this->localtime = isset($this->skin_options['include_local_time']) ? $this->skin_options['include_local_time'] : false;
$display_label = isset($this->skin_options['display_label']) ? $this->skin_options['display_label'] : false;
$reason_for_cancellation = isset($this->skin_options['reason_for_cancellation']) ? $this->skin_options['reason_for_cancellation'] : false;
?>
<ul class="mec-daily-view-dates-events">
    <?php foreach($this->events as $date=>$events): ?>
    <li class="mec-daily-view-date-events mec-util-hidden" id="mec_daily_view_date_events<?php echo esc_attr($this->id); ?>_<?php echo date('Ymd', strtotime($date)); ?>">
        <?php if(count($events)): ?>
        <?php foreach($events as $event): ?>
            <?php
                $location_id = $this->main->get_master_location_id($event);
                $location = ($location_id ? $this->main->get_location_data($location_id) : array());

                $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
                $end_time = (isset($event->data->time) ? $event->data->time['end'] : '');
                $event_color =  isset($event->data->meta['mec_color']) ? '<span class="event-color" style="background: #'.esc_attr($event->data->meta['mec_color']).'"></span>' : '';
                $event_start_date = !empty($event->date['start']['date']) ? $event->date['start']['date'] : '';

                $mec_data = $this->display_custom_data($event);
                $custom_data_class = !empty($mec_data) ? 'mec-custom-data' : ''; 

                // MEC Schema
                do_action('mec_schema', $event);
            ?>
            <article class="<?php echo (isset($event->data->meta['event_past']) and trim($event->data->meta['event_past'])) ? 'mec-past-event ' : ''; ?>mec-event-article <?php echo esc_attr($this->get_event_classes($event)); ?> <?php echo sanitize_html_class($custom_data_class); ?>">
                <div class="mec-event-image"><?php echo MEC_kses::element($event->data->thumbnails['thumbnail']); ?></div>
                <?php echo MEC_kses::element($this->get_label_captions($event)); ?>

                <?php if($this->display_detailed_time and $this->main->is_multipleday_occurrence($event)): ?>
                <div class="mec-event-detailed-time mec-event-time mec-color"><i class="mec-sl-clock-o"></i> <?php echo MEC_kses::element($this->display_detailed_time($event)); ?></div>
                <?php elseif(trim($start_time)): ?>
                <div class="mec-event-time mec-color"><i class="mec-sl-clock-o"></i> <?php echo esc_html($start_time.(trim($end_time) ? ' - '.$end_time : '')); ?></div>
                <?php endif; ?>

                <h4 class="mec-event-title"><?php echo MEC_kses::element($this->display_link($event)); ?><?php echo MEC_kses::element($this->main->get_flags($event).$event_color.$this->main->get_normal_labels($event, $display_label).$this->main->display_cancellation_reason($event, $reason_for_cancellation)); ?><?php do_action('mec_shortcode_virtual_badge', $event->data->ID); ?></h4>
                <?php if($this->localtime) echo MEC_kses::full($this->main->module('local-time.type3', array('event' => $event))); ?>
                <div class="mec-event-detail"><div class="mec-event-loc-place"><?php echo (isset($location['name']) ? esc_html($location['name']) : ''); ?></div></div>
                <?php echo MEC_kses::element($this->display_categories($event)); ?>
                <?php echo MEC_kses::element($this->display_organizers($event)); ?>
                <?php echo MEC_kses::element($this->display_cost($event)); ?>
                <?php echo MEC_kses::form($this->booking_button($event)); ?>
                <?php echo MEC_kses::element($this->display_custom_data($event)); ?>
            </article>
        <?php endforeach; ?>
        <?php else: ?>
            <article class="mec-event-article"><div class="mec-daily-view-no-event mec-no-event"><?php esc_html_e('No event', 'mec'); ?></div></article>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<div class="mec-event-footer"></div>