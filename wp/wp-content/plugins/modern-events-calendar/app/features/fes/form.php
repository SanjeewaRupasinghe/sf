<?php
/** no direct access **/
defined('MECEXEC') or die();

// Generating javascript code of countdown module
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    var mec_fes_form_ajax = false;
    jQuery("#mec_fes_form").on("submit", function(event)
    {
        event.preventDefault();
        
        var $form = jQuery("#mec_fes_form");
        
        // Hide the message
        jQuery("#mec_fes_form_message").removeClass("mec-success").removeClass("mec-success").html("").hide();

        // Add loading Class to the form
        $form.addClass("mec-fes-loading");
        jQuery(".mec-fes-form-cntt").hide();
        jQuery(".mec-fes-form-sdbr").hide();
        jQuery(".mec-fes-submit-wide").hide();

        
        // Fix WordPress editor issue
        jQuery("#mec_fes_content-html").click();
        jQuery("#mec_fes_content-tmce").click();
        
        // Abort previous request
        if(mec_fes_form_ajax) mec_fes_form_ajax.abort();
        
        var data = $form.serialize();
        mec_fes_form_ajax = jQuery.ajax(
        {
            type: "POST",
            url: "'.admin_url('admin-ajax.php', NULL).'",
            data: data,
            dataType: "JSON",
            success: function(response)
            {
                // Remove the loading Class from the form
                jQuery("#mec_fes_form").removeClass("mec-fes-loading");
                jQuery(".mec-fes-form-cntt").show();
                jQuery(".mec-fes-form-sdbr").show();
                jQuery(".mec-fes-submit-wide").show();
                
                if(response.success == "1")
                {
                    // Show the message
                    jQuery("#mec_fes_form_message").removeClass("mec-success").addClass("mec-success").html(response.message).css("display","inline-block");
                    
                    // Set the event id
                    jQuery(".mec-fes-post-id").val(response.data.post_id);

                    // Redirect Currnet Page
                    if(response.data.redirect_to !== "")
                    {
                        setTimeout(function()
                        {
                            window.location.href = response.data.redirect_to;
                        },' . ((isset($this->settings['fes_thankyou_page_time']) and trim($this->settings['fes_thankyou_page_time']) != '') ? (int) $this->settings['fes_thankyou_page_time'] : 2000) . ');
                    }
                }
                else
                {
                    // Show the message
                    jQuery("#mec_fes_form_message").removeClass("mec-error").addClass("mec-error").html(response.message).css("display","inline-block");
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                // Remove the loading Class from the form
                jQuery("#mec_fes_form").removeClass("loading");
            }
        });
    });
});

function mec_fes_upload_featured_image()
{
    var fd = new FormData();
    fd.append("action", "mec_fes_upload_featured_image");
    fd.append("_wpnonce", "'.wp_create_nonce('mec_fes_upload_featured_image').'");
    fd.append("file", jQuery("#mec_featured_image_file").prop("files")[0]);
    
    jQuery("#mec_fes_thumbnail_error").html("").addClass("mec-util-hidden");
    
    jQuery.ajax(
    {
        url: "'.admin_url('admin-ajax.php', NULL).'",
        type: "POST",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    })
    .done(function(data)
    {
        if(data.success)
        {
            jQuery("#mec_fes_thumbnail").val(data.data.url);
            jQuery("#mec_featured_image_file").val("");
            jQuery("#mec_fes_thumbnail_img").html("<img src=\""+data.data.url+"\" />");
            jQuery("#mec_fes_remove_image_button").removeClass("mec-util-hidden");
        }
        else
        {
            jQuery("#mec_fes_thumbnail_error").html(data.message).removeClass("mec-util-hidden");
        }
    });
    
    return false;
}

function mec_fes_upload_location_thumbnail()
{
    var fd = new FormData();
    
    fd.append("action", "mec_fes_upload_featured_image");
    fd.append("_wpnonce", "'.wp_create_nonce('mec_fes_upload_featured_image').'");
    fd.append("file", jQuery("#mec_fes_location_thumbnail_file").prop("files")[0]);
    
    jQuery.ajax(
    {
        url: "'.admin_url('admin-ajax.php', NULL).'",
        type: "POST",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    })
    .done(function(data)
    {
        jQuery("#mec_fes_location_thumbnail").val(data.data.url);
        jQuery("#mec_fes_location_thumbnail_file").val("");
        jQuery("#mec_fes_location_thumbnail_img").html("<img src=\""+data.data.url+"\" />");
        jQuery("#mec_fes_location_remove_image_button").removeClass("mec-util-hidden");
    });
    
    return false;
}

function mec_fes_upload_organizer_thumbnail()
{
    var fd = new FormData();
    
    fd.append("action", "mec_fes_upload_featured_image");
    fd.append("_wpnonce", "'.wp_create_nonce('mec_fes_upload_featured_image').'");
    fd.append("file", jQuery("#mec_fes_organizer_thumbnail_file").prop("files")[0]);
    
    jQuery.ajax(
    {
        url: "'.admin_url('admin-ajax.php', NULL).'",
        type: "POST",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    })
    .done(function(data)
    {
        jQuery("#mec_fes_organizer_thumbnail").val(data.data.url);
        jQuery("#mec_fes_organizer_thumbnail_file").val("");
        jQuery("#mec_fes_organizer_thumbnail_img").html("<img src=\""+data.data.url+"\" />");
        jQuery("#mec_fes_organizer_remove_image_button").removeClass("mec-util-hidden");
    });
    
    return false;
}
</script>';

// Include javascript code into the footer
$this->factory->params('footer', $javascript);
?>
<div class="mec-fes-form">
    <?php if(is_user_logged_in()): ?>
    <div class="mec-fes-form-top-actions">
        <?php do_action('mec_fes_form_top_actions'); ?>
        <a class="mec-fes-form-back-to" href="<?php echo esc_url($this->link_list_events()); ?>"><?php echo esc_html__('Go back to events list', 'mec'); ?></a>
        <?php $status = $this->main->get_event_label_status(get_post_status($post_id)); ?>
        <?php if(trim($status['label']) != "Empty"): ?>
        <span class="post-status <?php echo sanitize_html_class($status['status_class']); ?>"><?php echo esc_html($status['label']);  ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <div class="mec-util-hidden" id="mec_fes_form_message"></div>
    <form id="mec_fes_form" enctype="multipart/form-data">
        <?php
            $allday = get_post_meta($post_id, 'mec_allday', true);
            $one_occurrence = get_post_meta($post_id, 'one_occurrence', true);
            $comment = get_post_meta($post_id, 'mec_comment', true);
            $hide_time = get_post_meta($post_id, 'mec_hide_time', true);
            $hide_end_time = get_post_meta($post_id, 'mec_hide_end_time', true);
        
            $start_date = get_post_meta($post_id, 'mec_start_date', true);

            // Advanced Repeating Day
		    $advanced_days = get_post_meta( $post->ID, 'mec_advanced_days', true );
		    $advanced_days = (is_array($advanced_days)) ? $advanced_days : array();
		    $advanced_str = (count($advanced_days)) ? implode('-', $advanced_days) : '';

            $start_time_hour = get_post_meta($post_id, 'mec_start_time_hour', true);
            if(trim($start_time_hour) == '') $start_time_hour = 8;

            $start_time_minutes = get_post_meta($post_id, 'mec_start_time_minutes', true);
            if(trim($start_time_minutes) == '') $start_time_minutes = 0;

            $start_time_ampm = get_post_meta($post_id, 'mec_start_time_ampm', true);
            if(trim($start_time_ampm) == '') $start_time_ampm = 'AM';

            $end_date = get_post_meta($post_id, 'mec_end_date', true);

            $end_time_hour = get_post_meta($post_id, 'mec_end_time_hour', true);
            if(trim($end_time_hour) == '') $end_time_hour = 6;

            $end_time_minutes = get_post_meta($post_id, 'mec_end_time_minutes', true);
            if(trim($end_time_minutes) == '') $end_time_minutes = 0;

            $end_time_ampm = get_post_meta($post_id, 'mec_end_time_ampm', true);
            if(trim($end_time_ampm) == '') $end_time_ampm = 'PM';

            $repeat_status = get_post_meta($post_id, 'mec_repeat_status', true);
            $repeat_type = get_post_meta($post_id, 'mec_repeat_type', true);
            if(trim($repeat_type) == '') $repeat_type = 'daily';

            $repeat_interval = get_post_meta($post_id, 'mec_repeat_interval', true);
            if(trim($repeat_interval) == '' and in_array($repeat_type, array('daily', 'weekly'))) $repeat_interval = 1;

            $certain_weekdays = get_post_meta($post_id, 'mec_certain_weekdays', true);
            if($repeat_type != 'certain_weekdays') $certain_weekdays = array();
            
            $in_days_str = get_post_meta($post_id, 'mec_in_days', true);
            $in_days = trim($in_days_str) ? explode(',', $in_days_str) : array();
            
            $mec_repeat_end = get_post_meta($post_id, 'mec_repeat_end', true);
            if(trim($mec_repeat_end) == '') $mec_repeat_end = 'never';

            $repeat_end_at_occurrences = get_post_meta($post_id, 'mec_repeat_end_at_occurrences', true);
            if(trim($repeat_end_at_occurrences) == '') $repeat_end_at_occurrences = 9;

            $repeat_end_at_date = get_post_meta($post_id, 'mec_repeat_end_at_date', true);

            // This date format used for datepicker
            $datepicker_format = (isset($this->settings['datepicker_format']) and trim($this->settings['datepicker_format'])) ? $this->settings['datepicker_format'] : 'Y-m-d';
            $imported_from_google = get_post_meta($post_id, 'mec_imported_from_google', true);

            $event_timezone = get_post_meta($post->ID, 'mec_timezone', true);
            if(trim($event_timezone) == '') $event_timezone = 'global';

            $countdown_method = get_post_meta($post->ID, 'mec_countdown_method', true);
            if(trim($countdown_method) == '') $countdown_method = 'global';

            // Public Event
            $public = get_post_meta($post->ID, 'mec_public', true);
            if(trim($public) === '') $public = 1;
        ?>

        <div class="mec-fes-form-cntt">
            <div class="mec-form-row mec-fes-title">
                <label for="mec_fes_title"><?php esc_html_e('Title', 'mec'); ?> <span class="mec-required">*</span></label>
                <input type="text" name="mec[title]" id="mec_fes_title" value="<?php echo (isset($post->post_title) ? esc_attr($post->post_title) : ''); ?>" required="required" />
            </div>
            <div class="mec-form-row mec-fes-editor">
                <?php wp_editor((isset($post->post_content) ? $post->post_content : ''), 'mec_fes_content', array('textarea_name'=>'mec[content]')); ?>
            </div>
            <?php if(isset($this->settings['fes_section_excerpt']) && $this->settings['fes_section_excerpt']): ?>
            <div class="mec-meta-box-fields mec-fes-excerpt" id="mec-excerpt">
                <h4><?php esc_html_e('Excerpt', 'mec'); ?> <?php echo ((isset($this->settings['fes_required_excerpt']) and $this->settings['fes_required_excerpt']) ? '<span class="mec-required">*</span>' : ''); ?></h4>
                <div class="mec-form-row">
                    <div class="mec-col-12">
                        <textarea name="mec[excerpt]" id="mec_fes_excerpt" class="widefat" rows="10" title="<?php esc_attr_e('Optional Event Excerpt', 'mec'); ?>" placeholder="<?php esc_attr_e('Optional Event Excerpt', 'mec'); ?>" <?php echo ((isset($this->settings['fes_required_excerpt']) and $this->settings['fes_required_excerpt']) ? 'required' : ''); ?>><?php echo (isset($post->post_excerpt) ? esc_textarea($post->post_excerpt) : ''); ?></textarea>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($imported_from_google): ?>
            <p class="info-msg"><?php esc_html_e("This event is imported from Google calendar so if you modify it would overwrite in the next import from Google.", 'mec'); ?></p>
            <?php endif; ?>

            <div class="mec-meta-box-fields mec-fes-datetime" id="mec-date-time">
                <h4><?php esc_html_e('Date and Time', 'mec'); ?></h4>
                <div id="mec_meta_box_date_form">
                    <div class="mec-title">
                        <span class="mec-dashicons dashicons dashicons-calendar-alt"></span>
                        <label for="mec_start_date"><?php esc_html_e('Start Date', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <input type="text" name="mec[date][start][date]" id="mec_start_date" value="<?php echo esc_attr($this->main->standardize_format($start_date, $datepicker_format)); ?>" placeholder="<?php esc_html_e('Start Date', 'mec'); ?>" autocomplete="off" />
                        </div>
                        <div class="mec-col-6 mec-time-picker <?php echo ($allday == 1) ? 'mec-util-hidden' : ''; ?>">
                            <?php $this->main->timepicker(array(
                                'method' => (isset($this->settings['time_format']) ? $this->settings['time_format'] : 12),
                                'time_hour' => $start_time_hour,
                                'time_minutes' => $start_time_minutes,
                                'time_ampm' => $start_time_ampm,
                                'name' => 'mec[date][start]',
                                'id_key' => 'start_',
                                'include_h0' => true,
                            )); ?>
                        </div>
                    </div>
                    <div class="mec-title">
                        <span class="mec-dashicons dashicons dashicons-calendar-alt"></span>
                        <label for="mec_end_date"><?php esc_html_e('End Date', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <input type="text" name="mec[date][end][date]" id="mec_end_date" value="<?php echo esc_attr($this->main->standardize_format($end_date, $datepicker_format)); ?>" placeholder="<?php esc_html_e('End Date', 'mec'); ?>" autocomplete="off" />
                        </div>
                        <div class="mec-col-6 mec-time-picker <?php echo ($allday == 1) ? 'mec-util-hidden' : ''; ?>">
                            <?php $this->main->timepicker(array(
                                'method' => (isset($this->settings['time_format']) ? $this->settings['time_format'] : 12),
                                'time_hour' => $end_time_hour,
                                'time_minutes' => $end_time_minutes,
                                'time_ampm' => $end_time_ampm,
                                'name' => 'mec[date][end]',
                                'id_key' => 'end_',
                            )); ?>
                        </div>
                    </div>
                    <div class="mec-form-row">
                        <input <?php if($allday == '1') echo 'checked="checked"'; ?> type="checkbox" name="mec[date][allday]" id="mec_allday" value="1" onchange="jQuery('.mec-time-picker').toggle();" /><label for="mec_allday"><?php esc_html_e('All-day Event', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <input <?php if($hide_time == '1') echo 'checked="checked"'; ?> type="checkbox" name="mec[date][hide_time]" id="mec_hide_time" value="1" /><label for="mec_hide_time"><?php esc_html_e('Hide Event Time', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <input <?php if($hide_end_time == '1') echo 'checked="checked"'; ?> type="checkbox" name="mec[date][hide_end_time]" id="mec_hide_end_time" value="1" /><label for="mec_hide_end_time"><?php esc_html_e('Hide Event End Time', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <input type="text" class="" name="mec[date][comment]" id="mec_comment" placeholder="<?php esc_html_e('Notes on the time', 'mec'); ?>" value="<?php echo esc_attr($comment); ?>" />
                            <p class="description"><?php esc_html_e('It shows next to event time on the Single Event Page. You can enter notes such as timezone in this field.', 'mec'); ?></p>
                        </div>
                    </div>

                    <?php if(isset($this->settings['tz_per_event']) and $this->settings['tz_per_event']): ?>
                    <div class="mec-form-row mec-timezone-event">
                        <div class="mec-title">
                            <label for="mec_event_timezone"><?php esc_html_e('Timezone', 'mec'); ?></label>
                        </div>
                        <div class="mec-form-row">
                            <div class="mec-col-4">
                                <select name="mec[timezone]" id="mec_event_timezone">
                                    <option value="global"><?php esc_html_e('Inherit from global options'); ?></option>
                                    <?php echo MEC_kses::element($this->main->timezones($event_timezone)); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(isset($this->settings['countdown_status']) and $this->settings['countdown_status'] and (!isset($this->settings['fes_section_countdown_method']) or (isset($this->settings['fes_section_countdown_method']) and $this->settings['fes_section_countdown_method']))): ?>
                    <h4><?php esc_html_e('Countdown Method', 'mec'); ?></h4>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <select name="mec[countdown_method]" id="mec_countdown_method" title="<?php esc_attr_e('Countdown Method', 'mec'); ?>">
                                <option value="global" <?php if('global' == $countdown_method) echo 'selected="selected"'; ?>><?php esc_html_e('Inherit from global options', 'mec'); ?></option>
                                <option value="start" <?php if('start' == $countdown_method) echo 'selected="selected"'; ?>><?php esc_html_e('Count to Event Start', 'mec'); ?></option>
                                <option value="end" <?php if('end' == $countdown_method) echo 'selected="selected"'; ?>><?php esc_html_e('Count to Event End', 'mec'); ?></option>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!isset($this->settings['fes_section_shortcode_visibility']) or (isset($this->settings['fes_section_shortcode_visibility']) and $this->settings['fes_section_shortcode_visibility'])): ?>
                    <h4><?php esc_html_e('Visibility', 'mec'); ?></h4>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <select name="mec[public]" id="mec_public" title="<?php esc_attr_e('Event Visibility', 'mec'); ?>">
                                <option value="1" <?php if('1' == $public) echo 'selected="selected"'; ?>><?php esc_html_e('Show on Shortcodes', 'mec'); ?></option>
                                <option value="0" <?php if('0' == $public) echo 'selected="selected"'; ?>><?php esc_html_e('Hide on Shortcodes', 'mec'); ?></option>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <div id="mec_meta_box_repeat_form">
                    <h4><?php esc_html_e('Repeating', 'mec'); ?></h4>
                    <div class="mec-form-row">
                        <input <?php if($repeat_status == '1') echo 'checked="checked"'; ?> type="checkbox" name="mec[date][repeat][status]" id="mec_repeat" value="1" /><label for="mec_repeat"><?php esc_html_e('Event Repeating', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-repeating-event-row">
                        <div class="mec-form-row">
                            <label class="mec-col-3" for="mec_repeat_type"><?php esc_html_e('Repeats', 'mec'); ?></label>
                            <select class="mec-col-2" name="mec[date][repeat][type]" id="mec_repeat_type">
                                <option <?php if($repeat_type == 'daily') echo 'selected="selected"'; ?> value="daily"><?php esc_html_e('Daily', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'weekday') echo 'selected="selected"'; ?> value="weekday"><?php esc_html_e('Every Weekday', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'weekend') echo 'selected="selected"'; ?> value="weekend"><?php esc_html_e('Every Weekend', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'certain_weekdays') echo 'selected="selected"'; ?> value="certain_weekdays"><?php esc_html_e('Certain Weekdays', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'weekly') echo 'selected="selected"'; ?> value="weekly"><?php esc_html_e('Weekly', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'monthly') echo 'selected="selected"'; ?> value="monthly"><?php esc_html_e('Monthly', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'yearly') echo 'selected="selected"'; ?> value="yearly"><?php esc_html_e('Yearly', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'custom_days') echo 'selected="selected"'; ?> value="custom_days"><?php esc_html_e('Custom Days', 'mec'); ?></option>
                                <option <?php if($repeat_type == 'advanced') echo 'selected="selected"'; ?> value="advanced"><?php esc_html_e('Advanced', 'mec'); ?></option>
                            </select>
                        </div>
                        <div class="mec-form-row" id="mec_repeat_interval_container">
                            <label class="mec-col-3" for="mec_repeat_interval"><?php esc_html_e('Repeat Interval', 'mec'); ?></label>
                            <input class="mec-col-2" type="text" name="mec[date][repeat][interval]" id="mec_repeat_interval" placeholder="<?php esc_html_e('Repeat interval', 'mec'); ?>" value="<?php echo ($repeat_type == 'weekly' ? ($repeat_interval/7) : $repeat_interval); ?>" />
                        </div>
                        <div class="mec-form-row" id="mec_repeat_certain_weekdays_container">
                            <label class="mec-col-3"><?php esc_html_e('Week Days', 'mec'); ?></label>
                            <label><input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="1" <?php echo (in_array(1, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Monday', 'mec'); ?></label>
                            <label>&nbsp;<input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="2" <?php echo (in_array(2, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Tuesday', 'mec'); ?></label>
                            <label>&nbsp;<input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="3" <?php echo (in_array(3, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Wednesday', 'mec'); ?></label>
                            <label>&nbsp;<input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="4" <?php echo (in_array(4, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Thursday', 'mec'); ?></label>
                            <label>&nbsp;<input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="5" <?php echo (in_array(5, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Friday', 'mec'); ?></label>
                            <label>&nbsp;<input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="6" <?php echo (in_array(6, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Saturday', 'mec'); ?></label>
                            <label>&nbsp;<input type="checkbox" name="mec[date][repeat][certain_weekdays][]" value="7" <?php echo (in_array(7, $certain_weekdays) ? 'checked="checked"' : ''); ?> /><?php esc_html_e('Sunday', 'mec'); ?></label>
                        </div>
                        <div class="mec-form-row" id="mec_exceptions_in_days_container">
                            <div class="mec-form-row">
                                <div class="mec-col-12">
                                    <div class="mec-form-row">
                                        <div class="mec-col-4">
                                            <input type="text" id="mec_exceptions_in_days_start_date" value="" placeholder="<?php esc_html_e('Start', 'mec'); ?>" title="<?php esc_html_e('Start', 'mec'); ?>" class="mec_date_picker_dynamic_format widefat" autocomplete="off"/>
                                        </div>
                                        <div class="mec-col-8">
                                            <?php $this->main->timepicker(array(
                                                'method' => (isset($this->settings['time_format']) ? $this->settings['time_format'] : 12),
                                                'time_hour' => $start_time_hour,
                                                'time_minutes' => $start_time_minutes,
                                                'time_ampm' => $start_time_ampm,
                                                'name' => 'mec[exceptionsdays][start]',
                                                'id_key' => 'exceptions_in_days_start_',
                                                'include_h0' => true,
                                            )); ?>
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <div class="mec-col-4">
                                            <input type="text" id="mec_exceptions_in_days_end_date" value="" placeholder="<?php esc_html_e('End', 'mec'); ?>" title="<?php esc_html_e('End', 'mec'); ?>" class="mec_date_picker_dynamic_format" autocomplete="off"/>
                                        </div>
                                        <div class="mec-col-8">
                                            <?php $this->main->timepicker(array(
                                                'method' => (isset($this->settings['time_format']) ? $this->settings['time_format'] : 12),
                                                'time_hour' => $end_time_hour,
                                                'time_minutes' => $end_time_minutes,
                                                'time_ampm' => $end_time_ampm,
                                                'name' => 'mec[exceptionsdays][end]',
                                                'id_key' => 'exceptions_in_days_end_',
                                            )); ?>
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <div class="mec-col-12">
                                            <button class="button" type="button" id="mec_add_in_days"><?php esc_html_e('Add', 'mec'); ?></button>
                                            <span class="mec-tooltip">
                                                <div class="box top">
                                                    <h5 class="title"><?php esc_html_e('Custom Days Repeating', 'mec'); ?></h5>
                                                    <div class="content">
                                                        <p>
                                                            <?php esc_attr_e('Add certain days to event occurrence dates. If you have a single day event, start and end dates should be the same, If you have a multiple day event, the start and end dates must be commensurate with the initial date.', 'mec'); ?>
                                                            <a href="https://webnus.net/dox/modern-events-calendar/date-and-time/" target="_blank"><?php esc_html_e('Read More', 'mec'); ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <i title="" class="dashicons-before dashicons-editor-help"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mec-form-row" id="mec_in_days">
                                <?php $i = 1; foreach($in_days as $in_day): ?>
                                    <?php
                                    $in_day = explode(':', $in_day);
                                    $first_date = $this->main->standardize_format($in_day[0], $datepicker_format);
                                    $second_date = $this->main->standardize_format($in_day[1], $datepicker_format);

                                    $in_day_start_time = '';
                                    $in_day_start_time_label = '';
                                    $in_day_end_time = '';
                                    $in_day_end_time_label = '';

                                    if(isset($in_day[2]) and isset($in_day[3]))
                                    {
                                        $in_day_start_time = $in_day[2];
                                        $in_day_end_time = $in_day[3];

                                        // If 24 hours format is enabled then convert it back to 12 hours
                                        if(isset($this->settings['time_format']) and $this->settings['time_format'] == 24)
                                        {
                                            $in_day_ex_start = explode('-', $in_day_start_time);
                                            $in_day_ex_end = explode('-', $in_day_end_time);

                                            $in_day_start_time_label = $this->main->to_24hours($in_day_ex_start[0], $in_day_ex_start[2]).':'.$in_day_ex_start[1];
                                            $in_day_end_time_label = $this->main->to_24hours($in_day_ex_end[0], $in_day_ex_end[2]).':'.$in_day_ex_end[1];
                                        }
                                        else
                                        {
                                            $pos = strpos($in_day_start_time, '-');
                                            if($pos !== false) $in_day_start_time_label = substr_replace($in_day_start_time, ':', $pos, 1);

                                            $pos = strpos($in_day_end_time, '-');
                                            if($pos !== false) $in_day_end_time_label = substr_replace($in_day_end_time, ':', $pos, 1);

                                            $in_day_start_time_label = str_replace('-', ' ', $in_day_start_time_label);
                                            $in_day_end_time_label = str_replace('-', ' ', $in_day_end_time_label);
                                        }
                                    }

                                    $in_day = $first_date . ':' . $second_date.(trim($in_day_start_time) ? ':'.$in_day_start_time : '').(trim($in_day_end_time) ? ':'.$in_day_end_time : '');
                                    $in_day_label = $first_date. (trim($in_day_start_time_label) ? ' '.$in_day_start_time_label : '') . ' - ' . $second_date. (trim($in_day_end_time_label) ? ' '.$in_day_end_time_label : '');
                                    ?>
                                    <div class="mec-form-row" id="mec_in_days_row<?php echo esc_attr($i); ?>">
                                        <input type="hidden" name="mec[in_days][<?php echo esc_attr($i); ?>]" value="<?php echo esc_attr($in_day); ?>"/>
                                        <span class="mec-not-in-days-day"><?php echo MEC_kses::element($in_day_label); ?></span>
                                        <span class="mec-not-in-days-remove" onclick="mec_in_days_remove(<?php echo esc_attr($i); ?>);">x</span>
                                    </div>
                                <?php $i++; endforeach; ?>
                            </div>
                            <input type="hidden" id="mec_new_in_days_key" value="<?php echo ($i+1); ?>" />
                            <div class="mec-util-hidden" id="mec_new_in_days_raw">
                                <div class="mec-form-row" id="mec_in_days_row:i:">
                                    <input type="hidden" name="mec[in_days][:i:]" value=":val:" />
                                    <span class="mec-not-in-days-day">:label:</span>
                                    <span class="mec-not-in-days-remove" onclick="mec_in_days_remove(:i:);">x</span>
                                </div>
                            </div>
                        </div>
                        <div id="mec-advanced-wraper">
                            <div class="mec-form-row">
                                <ul>
                                    <li>
                                        <?php esc_html_e('First', 'mec'); ?>
                                    </li>
                                    <ul>
                                        <?php $day_1th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 1); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_1th}.1"); ?>">
                                            <?php esc_html_e($day_1th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_1th); ?>.1-</span>
                                        </li>
                                        <?php $day_2th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 2); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_2th}.1"); ?>">
                                            <?php esc_html_e($day_2th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_2th); ?>.1-</span>
                                        </li>
                                        <?php $day_3th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 3); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_3th}.1"); ?>">
                                            <?php esc_html_e($day_3th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_3th); ?>.1-</span>
                                        </li>
                                        <?php $day_4th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 4); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_4th}.1"); ?>">
                                            <?php esc_html_e($day_4th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_4th); ?>.1-</span>
                                        </li>
                                        <?php $day_5th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 5); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_5th}.1"); ?>">
                                            <?php esc_html_e($day_5th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_5th); ?>.1-</span>
                                        </li>
                                        <?php $day_6th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 6); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_6th}.1"); ?>">
                                            <?php esc_html_e($day_6th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_6th); ?>.1-</span>
                                        </li>
                                        <?php $day_7th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 7); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_7th}.1"); ?>">
                                            <?php esc_html_e($day_7th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_7th); ?>.1-</span>
                                        </li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li>
                                        <?php esc_html_e('Second', 'mec'); ?>
                                    </li>
                                    <ul>
                                        <?php $day_1th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 1); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_1th}.2"); ?>">
                                            <?php esc_html_e($day_1th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_1th); ?>.2-</span>
                                        </li>
                                        <?php $day_2th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 2); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_2th}.2"); ?>">
                                            <?php esc_html_e($day_2th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_2th); ?>.2-</span>
                                        </li>
                                        <?php $day_3th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 3); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_3th}.2"); ?>">
                                            <?php esc_html_e($day_3th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_3th); ?>.2-</span>
                                        </li>
                                        <?php $day_4th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 4); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_4th}.2"); ?>">
                                            <?php esc_html_e($day_4th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_4th); ?>.2-</span>
                                        </li>
                                        <?php $day_5th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 5); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_5th}.2"); ?>">
                                            <?php esc_html_e($day_5th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_5th); ?>.2-</span>
                                        </li>
                                        <?php $day_6th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 6); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_6th}.2"); ?>">
                                            <?php esc_html_e($day_6th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_6th); ?>.2-</span>
                                        </li>
                                        <?php $day_7th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 7); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_7th}.2"); ?>">
                                            <?php esc_html_e($day_7th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_7th); ?>.2-</span>
                                        </li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li>
                                        <?php esc_html_e('Third', 'mec'); ?>
                                    </li>
                                    <ul>
                                        <?php $day_1th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 1); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_1th}.3"); ?>">
                                            <?php esc_html_e($day_1th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_1th); ?>.3-</span>
                                        </li>
                                        <?php $day_2th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 2); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_2th}.3"); ?>">
                                            <?php esc_html_e($day_2th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_2th); ?>.3-</span>
                                        </li>
                                        <?php $day_3th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 3); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_3th}.3"); ?>">
                                            <?php esc_html_e($day_3th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_3th); ?>.3-</span>
                                        </li>
                                        <?php $day_4th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 4); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_4th}.3"); ?>">
                                            <?php esc_html_e($day_4th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_4th); ?>.3-</span>
                                        </li>
                                        <?php $day_5th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 5); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_5th}.3"); ?>">
                                            <?php esc_html_e($day_5th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_5th); ?>.3-</span>
                                        </li>
                                        <?php $day_6th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 6); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_6th}.3"); ?>">
                                            <?php esc_html_e($day_6th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_6th); ?>.3-</span>
                                        </li>
                                        <?php $day_7th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 7); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_7th}.3"); ?>">
                                            <?php esc_html_e($day_7th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_7th); ?>.3-</span>
                                        </li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li>
                                        <?php esc_html_e('Fourth', 'mec'); ?>
                                    </li>
                                    <ul>
                                        <?php $day_1th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 1); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_1th}.4"); ?>">
                                            <?php esc_html_e($day_1th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_1th); ?>.4-</span>
                                        </li>
                                        <?php $day_2th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 2); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_2th}.4"); ?>">
                                            <?php esc_html_e($day_2th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_2th); ?>.4-</span>
                                        </li>
                                        <?php $day_3th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 3); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_3th}.4"); ?>">
                                            <?php esc_html_e($day_3th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_3th); ?>.4-</span>
                                        </li>
                                        <?php $day_4th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 4); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_4th}.4"); ?>">
                                            <?php esc_html_e($day_4th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_4th); ?>.4-</span>
                                        </li>
                                        <?php $day_5th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 5); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_5th}.4"); ?>">
                                            <?php esc_html_e($day_5th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_5th); ?>.4-</span>
                                        </li>
                                        <?php $day_6th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 6); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_6th}.4"); ?>">
                                            <?php esc_html_e($day_6th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_6th); ?>.4-</span>
                                        </li>
                                        <?php $day_7th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 7); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_7th}.4"); ?>">
                                            <?php esc_html_e($day_7th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_7th); ?>.4-</span>
                                        </li>
                                    </ul>
                                </ul>
                                <ul>
                                    <li>
                                        <?php esc_html_e('Last', 'mec'); ?>
                                    </li>
                                    <ul>
                                        <?php $day_1th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 1); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_1th}.l"); ?>">
                                            <?php esc_html_e($day_1th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_1th); ?>.l-</span>
                                        </li>
                                        <?php $day_2th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 2); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_2th}.l"); ?>">
                                            <?php esc_html_e($day_2th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_2th); ?>.l-</span>
                                        </li>
                                        <?php $day_3th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 3); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_3th}.l"); ?>">
                                            <?php esc_html_e($day_3th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_3th); ?>.l-</span>
                                        </li>
                                        <?php $day_4th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 4); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_4th}.l"); ?>">
                                            <?php esc_html_e($day_4th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_4th); ?>.l-</span>
                                        </li>
                                        <?php $day_5th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 5); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_5th}.l"); ?>">
                                            <?php esc_html_e($day_5th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_5th); ?>.l-</span>
                                        </li>
                                        <?php $day_6th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 6); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_6th}.l"); ?>">
                                            <?php esc_html_e($day_6th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_6th); ?>.l-</span>
                                        </li>
                                        <?php $day_7th = $this->main->advanced_repeating_sort_day($this->main->get_first_day_of_week(), 7); ?>
                                        <li class="<?php $this->main->mec_active($advanced_days, "{$day_7th}.l"); ?>">
                                            <?php esc_html_e($day_7th, 'mec'); ?>
                                            <span class="key"><?php echo esc_attr($day_7th); ?>.l-</span>
                                        </li>
                                    </ul>
                                </ul>
                                <input class="mec-col-2" type="hidden" name="mec[date][repeat][advanced]"
                                 id="mec_date_repeat_advanced"  value="<?php echo esc_attr($advanced_str); ?>" />
                            </div>
                        </div>
                        <div id="mec_end_wrapper">
                            <div class="mec-form-row">
                                <label for="mec_repeat_ends_never"><h5 class="mec-title"><?php esc_html_e('Ends Repeat', 'mec'); ?></h5></label>
                            </div>
                            <div class="mec-form-row">
                                <input <?php if($mec_repeat_end == 'never') echo 'checked="checked"'; ?> type="radio" value="never" name="mec[date][repeat][end]" id="mec_repeat_ends_never" />
                                <label for="mec_repeat_ends_never"><?php esc_html_e('Never', 'mec'); ?></label>
                            </div>
                            <div class="mec-form-row">
                                <div class="mec-col-3">
                                    <input <?php if($mec_repeat_end == 'date') echo 'checked="checked"'; ?> type="radio" value="date" name="mec[date][repeat][end]" id="mec_repeat_ends_date" />
                                    <label for="mec_repeat_ends_date"><?php esc_html_e('On', 'mec'); ?></label>
                                </div>
                                <input class="mec-col-2" type="text" name="mec[date][repeat][end_at_date]" id="mec_date_repeat_end_at_date" autocomplete="off" value="<?php echo esc_attr( $this->main->standardize_format( $repeat_end_at_date, $datepicker_format ) ); ?>" />
                            </div>
                            <div class="mec-form-row">
                                <div class="mec-col-3">
                                    <input <?php if($mec_repeat_end == 'occurrences') echo 'checked="checked"'; ?> type="radio" value="occurrences" name="mec[date][repeat][end]" id="mec_repeat_ends_occurrences" />
                                    <label for="mec_repeat_ends_occurrences"><?php esc_html_e('After', 'mec'); ?></label>
                                </div>
                                <input class="mec-col-2" type="text" name="mec[date][repeat][end_at_occurrences]" id="mec_date_repeat_end_at_occurrences" autocomplete="off" placeholder="<?php esc_html_e('Occurrences times', 'mec'); ?>"  value="<?php echo esc_attr(($repeat_end_at_occurrences+1)); ?>" />
                                <span class="mec-tooltip">
                                    <div class="box">
                                        <h5 class="title"><?php esc_html_e('Occurrences times', 'mec'); ?></h5>
                                        <div class="content"><p><?php esc_attr_e('The event will finish after certain repeats. For example if you set it to 10, the event will finish after 10 repeats.', 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/event-detailssingle-event-page/" target="_blank"><?php esc_html_e('Read More', 'mec'); ?></a></p></div>
                                    </div>
                                    <i title="" class="dashicons-before dashicons-editor-help"></i>
                                </span>	                                
                            </div>
                            <div class="mec-form-row">
                                <input
                                    <?php
                                    if ($one_occurrence == '1') {
                                        echo 'checked="checked"';
                                    }
                                    ?>
                                        type="checkbox" name="mec[date][one_occurrence]" id="mec-one-occurrence" value="1"/><label
                                        for="mec-one-occurrence"><?php esc_html_e('Show only one occurrence of this event', 'mec'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php do_action('mec_fes_metabox_details', $post); ?>
            
            <?php /* Note feature is enabled */ if($this->main->is_note_visible(get_post_status($post_id))): $note = get_post_meta($post_id, 'mec_note', true); ?>
            <div class="mec-meta-box-fields mec-fes-note" id="mec-event-note">
                <h4><?php esc_html_e('Note to reviewer', 'mec'); ?></h4>
                <div id="mec_meta_box_event_note">
                    <textarea name="mec[note]"><?php echo esc_textarea($note); ?></textarea>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
        
        <div class="mec-fes-form-sdbr">
            
            <!-- Guest Email and Name -->
            <?php if(!is_user_logged_in() and isset($this->settings['fes_guest_name_email']) and $this->settings['fes_guest_name_email']): ?>
            <?php
                $guest_email = get_post_meta($post_id, 'fes_guest_email', true);
                $guest_name = get_post_meta($post_id, 'fes_guest_name', true);
            ?>
            <div class="mec-meta-box-fields mec-fes-user-data" id="mec-guest-email-link">
                <h4><?php esc_html_e('User Data', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_guest_email"><?php esc_html_e('Email', 'mec'); ?><span>*</span></label>
                    <input class="mec-col-7" type="email" required="required" name="mec[fes_guest_email]" id="mec_guest_email" value="<?php echo esc_attr($guest_email); ?>" placeholder="<?php esc_html_e('eg. yourname@gmail.com', 'mec'); ?>" />
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_guest_name"><?php esc_html_e('Name', 'mec'); ?><span>*</span></label>
                    <input class="mec-col-7" type="text" required="required" name="mec[fes_guest_name]" id="mec_guest_name" value="<?php echo esc_attr($guest_name); ?>" placeholder="<?php esc_html_e('eg. John Smith', 'mec'); ?>" />
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Event Links Section -->
            <?php if(!isset($this->settings['fes_section_event_links']) or (isset($this->settings['fes_section_event_links']) and $this->settings['fes_section_event_links'])): ?>
            <?php
                $read_more = get_post_meta($post_id, 'mec_read_more', true);
                $more_info = get_post_meta($post_id, 'mec_more_info', true);
                $more_info_title = get_post_meta($post_id, 'mec_more_info_title', true);
                $more_info_target = get_post_meta($post_id, 'mec_more_info_target', true);
            ?>
            <div class="mec-meta-box-fields mec-fes-event-links" id="mec-event-links">
                <h4><?php esc_html_e('Event Links', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_read_more_link"><?php echo esc_html($this->main->m('read_more_link', esc_html__('Event Link', 'mec'))); ?> <?php echo ((isset($this->settings['fes_required_event_link']) and $this->settings['fes_required_event_link']) ? '<span class="mec-required">*</span>' : ''); ?></label>
                    <input class="mec-col-9" type="text" name="mec[read_more]" id="mec_read_more_link" value="<?php echo esc_attr($read_more); ?>" placeholder="<?php esc_html_e('eg. http://yoursite.com/your-event', 'mec'); ?>" <?php echo ((isset($this->settings['fes_required_event_link']) and $this->settings['fes_required_event_link']) ? 'required' : ''); ?> />
                    <p class="description"><?php esc_html_e('If you fill it, it will replace the default event page link. Insert full link including http(s)://', 'mec'); ?></p>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_more_info_link"><?php echo esc_html($this->main->m('more_info_link', esc_html__('More Info', 'mec'))); ?> <?php echo ((isset($this->settings['fes_required_more_info_link']) and $this->settings['fes_required_more_info_link']) ? '<span class="mec-required">*</span>' : ''); ?></label>
                    <input class="mec-col-5" type="text" name="mec[more_info]" id="mec_more_info_link" value="<?php echo esc_attr($more_info); ?>" placeholder="<?php esc_html_e('eg. http://yoursite.com/your-event', 'mec'); ?>" <?php echo ((isset($this->settings['fes_required_more_info_link']) and $this->settings['fes_required_more_info_link']) ? 'required' : ''); ?> />
                    <input class="mec-col-2" type="text" name="mec[more_info_title]" id="mec_more_info_title" value="<?php echo esc_attr($more_info_title); ?>" placeholder="<?php esc_html_e('More Information', 'mec'); ?>" />
                    <select class="mec-col-2" name="mec[more_info_target]" id="mec_more_info_target">
                        <option value="_self" <?php echo ($more_info_target == '_self' ? 'selected="selected"' : ''); ?>><?php esc_html_e('Current Window', 'mec'); ?></option>
                        <option value="_blank" <?php echo ($more_info_target == '_blank' ? 'selected="selected"' : ''); ?>><?php esc_html_e('New Window', 'mec'); ?></option>
                    </select>
                    <p class="description"><?php esc_html_e('If you fill it, it will be shown in event details page as an optional link. Insert full link including http(s)://', 'mec'); ?></p>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Event Cost Section -->
            <?php if(!isset($this->settings['fes_section_cost']) or (isset($this->settings['fes_section_cost']) and $this->settings['fes_section_cost'])): ?>
            <?php
                $cost = get_post_meta($post_id, 'mec_cost', true);
                $cost_type = ((isset($this->settings['single_cost_type']) and trim($this->settings['single_cost_type'])) ? $this->settings['single_cost_type'] : 'numeric');

                $cost_auto_calculate = get_post_meta($post_id, 'mec_cost_auto_calculate', true);

                $currency = get_post_meta($post_id, 'mec_currency', true);
                if(!is_array($currency)) $currency = array();

                $currency_per_event = ((isset($this->settings['currency_per_event']) and trim($this->settings['currency_per_event'])) ? $this->settings['currency_per_event'] : 0);

                $currencies = $this->main->get_currencies();
                $current_currency = (isset($currency['currency']) ? $currency['currency'] : (isset($this->settings['currency']) ? $this->settings['currency'] : NULL));
            ?>
            <div class="mec-meta-box-fields mec-fes-cost" id="mec-event-cost">
                <h4><?php echo esc_html($this->main->m('event_cost', esc_html__('Event Cost', 'mec'))); ?> <?php echo ((isset($this->settings['fes_required_cost']) and $this->settings['fes_required_cost']) ? '<span class="mec-required">*</span>' : ''); ?></h4>
                <div id="mec_meta_box_cost_form" class="<?php echo ($cost_auto_calculate ? 'mec-util-hidden' : ''); ?>">
                    <div class="mec-form-row">
                        <input type="<?php echo ($cost_type === 'alphabetic' ? 'text' : 'number'); ?>" <?php echo ($cost_type === 'numeric' ? 'min="0" step="any"' : ''); ?> class="mec-col-3" name="mec[cost]" id="mec_cost" value="<?php echo esc_attr($cost); ?>" placeholder="<?php esc_html_e('Cost', 'mec'); ?>" <?php echo ((isset($this->settings['fes_required_cost']) and $this->settings['fes_required_cost']) ? 'required' : ''); ?> />
                    </div>
                </div>

                <div class="mec-form-row">
                    <div class="mec-col-12">
                        <label for="mec_cost_auto_calculate">
                            <input type="hidden" name="mec[cost_auto_calculate]" value="0" />
                            <input type="checkbox" name="mec[cost_auto_calculate]" id="mec_cost_auto_calculate" <?php echo ($cost_auto_calculate == 1) ? 'checked="checked"' : ''; ?> value="1" onchange="jQuery('#mec_meta_box_cost_form').toggleClass('mec-util-hidden');">
                            <?php esc_html_e('Show the minimum price based on tickets', 'mec'); ?>
                        </label>
                    </div>
                </div>

                <?php if($currency_per_event): ?>
                <h4><?php echo esc_html__('Currency Options', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_currency_currency"><?php esc_html_e('Currency', 'mec'); ?></label>
                    <div class="mec-col-4">
                        <select name="mec[currency][currency]" id="mec_currency_currency">
                            <?php foreach($currencies as $c=>$currency_name): ?>
                                <option value="<?php echo esc_attr($c); ?>" <?php echo (($current_currency == $c) ? 'selected="selected"' : ''); ?>><?php echo esc_html($currency_name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_currency_currency_symptom"><?php esc_html_e('Currency Sign', 'mec'); ?></label>
                    <div class="mec-col-4">
                        <input type="text" name="mec[currency][currency_symptom]" id="mec_currency_currency_symptom" value="<?php echo (isset($currency['currency_symptom']) ? esc_attr($currency['currency_symptom']) : ''); ?>" />
                        <span class="mec-tooltip">
                            <div class="box left">
                                <h5 class="title"><?php esc_html_e('Currency Sign', 'mec'); ?></h5>
                                <div class="content"><p><?php esc_attr_e("Default value will be \"currency\" if you leave it empty.", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/currency-options/" target="_blank"><?php esc_html_e('Read More', 'mec'); ?></a></p></div>
                            </div>
                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                        </span>
                    </div>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_currency_currency_sign"><?php esc_html_e('Currency Position', 'mec'); ?></label>
                    <div class="mec-col-4">
                        <select name="mec[currency][currency_sign]" id="mec_currency_currency_sign">
                            <option value="before" <?php echo ((isset($currency['currency_sign']) and $currency['currency_sign'] == 'before') ? 'selected="selected"' : ''); ?>><?php esc_html_e('$10 (Before)', 'mec'); ?></option>
                            <option value="before_space" <?php echo ((isset($currency['currency_sign']) and $currency['currency_sign'] == 'before_space') ? 'selected="selected"' : ''); ?>><?php esc_html_e('$ 10 (Before with Space)', 'mec'); ?></option>
                            <option value="after" <?php echo ((isset($currency['currency_sign']) and $currency['currency_sign'] == 'after') ? 'selected="selected"' : ''); ?>><?php esc_html_e('10$ (After)', 'mec'); ?></option>
                            <option value="after_space" <?php echo ((isset($currency['currency_sign']) and $currency['currency_sign'] == 'after_space') ? 'selected="selected"' : ''); ?>><?php esc_html_e('10 $ (After with Space)', 'mec'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_currency_thousand_separator"><?php esc_html_e('Thousand Separator', 'mec'); ?></label>
                    <div class="mec-col-4">
                        <input type="text" name="mec[currency][thousand_separator]" id="mec_currency_thousand_separator" value="<?php echo (isset($currency['thousand_separator']) ? esc_attr($currency['thousand_separator']) : ','); ?>" />
                    </div>
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_currency_decimal_separator"><?php esc_html_e('Decimal Separator', 'mec'); ?></label>
                    <div class="mec-col-4">
                        <input type="text" name="mec[currency][decimal_separator]" id="mec_currency_decimal_separator" value="<?php echo (isset($currency['decimal_separator']) ? esc_attr($currency['decimal_separator']) : '.'); ?>" />
                    </div>
                </div>
                <div class="mec-form-row">
                    <div class="mec-col-12">
                        <label for="mec_currency_decimal_separator_status">
                            <input type="hidden" name="mec[currency][decimal_separator_status]" value="1" />
                            <input type="checkbox" name="mec[currency][decimal_separator_status]" id="mec_currency_decimal_separator_status" <?php echo ((isset($currency['decimal_separator_status']) and $currency['decimal_separator_status'] == '0') ? 'checked="checked"' : ''); ?> value="0" />
                            <?php esc_html_e('No decimal', 'mec'); ?>
                        </label>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Event Featured Image Section -->
            <?php if(!isset($this->settings['fes_section_featured_image']) or (isset($this->settings['fes_section_featured_image']) and $this->settings['fes_section_featured_image'])): ?>
            <?php
                $attachment_id = get_post_thumbnail_id($post_id);
                $featured_image = wp_get_attachment_image_src($attachment_id, 'large');
                if(isset($featured_image[0])) $featured_image = $featured_image[0];
            ?>
            <div class="mec-meta-box-fields mec-fes-featured-image" id="mec-featured-image">
                <h4><?php esc_html_e('Featured Image', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <span id="mec_fes_thumbnail_img"><?php echo (trim($featured_image) ? '<img src="'.esc_attr($featured_image).'" />' : ''); ?></span>
                    <input type="hidden" id="mec_fes_thumbnail" name="mec[featured_image]" value="<?php if(isset($attachment_id) and intval($attachment_id)) the_guid($attachment_id); ?>" />
                    <input type="file" id="mec_featured_image_file" onchange="mec_fes_upload_featured_image();" />
                    <span id="mec_fes_remove_image_button" class="<?php echo (trim($featured_image) ? '' : 'mec-util-hidden'); ?>"><?php esc_html_e('Remove Image', 'mec'); ?></span>

                    <div class="mec-error mec-util-hidden" id="mec_fes_thumbnail_error"></div>
                </div>

                <?php if(isset($this->settings['featured_image_caption']) and $this->settings['featured_image_caption']): ?>
                <div class="mec-form-row">
                    <input type="text" id="mec_fes_thumbnail_caption" name="mec[featured_image_caption]" value="<?php if(isset($attachment_id) and intval($attachment_id)) echo wp_get_attachment_caption($attachment_id); ?>" />
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Event Category Section -->
            <?php if(!isset($this->settings['fes_section_categories']) or (isset($this->settings['fes_section_categories']) and $this->settings['fes_section_categories'])): ?>
            <div class="mec-meta-box-fields mec-fes-category" id="mec-categories">
                <h4><?php echo esc_html($this->main->m('taxonomy_categories', esc_html__('Categories', 'mec'))); ?> <?php echo ((isset($this->settings['fes_required_category']) and $this->settings['fes_required_category']) ? '<span class="mec-required">*</span>' : ''); ?></h4>
                <div class="mec-form-row">
                    <?php 
                        wp_list_categories(array(
                            'taxonomy' => 'mec_category',
                            'hide_empty' => false,
                            'title_li' => '',
                            'walker' => new FES_Custom_Walker($post_id),
                        ));
                    ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Event Label Section -->
            <?php if(!isset($this->settings['fes_section_labels']) or (isset($this->settings['fes_section_labels']) and $this->settings['fes_section_labels'])): ?>
            <?php
                $post_labels = get_the_terms($post_id, 'mec_label');

                $labels = array();
                if($post_labels) foreach($post_labels as $post_label) $labels[] = $post_label->term_id;
                
                $label_terms = get_terms(array('taxonomy'=>'mec_label', 'hide_empty'=>false));
            ?>
            <?php if(count($label_terms)): ?>
            <div class="mec-meta-box-fields mec-fes-labels" id="mec-labels">
                <h4><?php echo esc_html($this->main->m('taxonomy_labels', esc_html__('Labels', 'mec'))); ?> <?php echo ((isset($this->settings['fes_required_label']) and $this->settings['fes_required_label']) ? '<span class="mec-required">*</span>' : ''); ?></h4>
                <div class="mec-form-row">
                    <?php foreach($label_terms as $label_term): ?>
                    <label for="mec_fes_labels<?php echo esc_attr($label_term->term_id); ?>">
                        <input type="checkbox" name="mec[labels][<?php echo esc_attr($label_term->term_id); ?>]" id="mec_fes_labels<?php echo esc_attr($label_term->term_id); ?>" value="1" <?php echo (in_array($label_term->term_id, $labels) ? 'checked="checked"' : ''); ?> />
                        <?php do_action('mec_label_to_checkbox_frontend', $label_term, $labels) ?>
                        <?php echo esc_html($label_term->name); ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            
            <!-- Event Color Section -->
            <?php if(!isset($this->settings['fes_section_event_color']) or (isset($this->settings['fes_section_event_color']) and $this->settings['fes_section_event_color'])): ?>
            <?php
                $color = get_post_meta($post_id, 'mec_color', true);
                $available_colors = $this->main->get_available_colors();

                if(!trim($color)) $color = $available_colors[0];
            ?>
            <?php if(count($available_colors)): ?>
            <div class="mec-meta-box-fields mec-fes-color" id="mec-event-color">
                <h4><?php esc_html_e('Event Color', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <div class="mec-form-row mec-available-color-row">
                        <input type="hidden" id="mec_event_color" name="mec[color]" value="#<?php echo esc_attr($color); ?>" />
                        <?php foreach($available_colors as $available_color): ?>
                        <span class="mec-color <?php echo ($available_color == $color ? 'color-selected' : ''); ?>" onclick="mec_set_event_color('<?php echo esc_attr($available_color); ?>');" style="background-color: #<?php echo esc_attr($available_color); ?>"></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            
            <!-- Event Tags Section -->
            <?php if(!isset($this->settings['fes_section_tags']) or (isset($this->settings['fes_section_tags']) and $this->settings['fes_section_tags'])): ?>
            <?php
                $post_tags = wp_get_post_terms($post_id, apply_filters('mec_taxonomy_tag', ''));

                $tags = '';
                foreach($post_tags as $post_tag) $tags .= $post_tag->name.',';
            ?>
            <div class="mec-meta-box-fields mec-fes-tags" id="mec-tags">
                <h4><?php esc_html_e('Tags', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <textarea name="mec[tags]" id="mec_fes_tags" placeholder="<?php esc_attr_e('Insert your desired tags, comma separated.', 'mec'); ?>"><?php echo (trim($tags) ? trim($tags, ', ') : ''); ?></textarea>
                </div>
            </div>
            <?php endif; ?>

            <!-- Event Speakers Section -->
            <?php if((isset($this->settings['speakers_status']) and $this->settings['speakers_status']) and isset($this->settings['fes_section_speaker']) and $this->settings['fes_section_speaker']): ?>
                <?php
                $post_speakers = get_the_terms($post_id, 'mec_speaker');

                $speakers = array();
                if($post_speakers) foreach($post_speakers as $post_speaker)
                {
                    if(!isset($post_speaker->term_id)) continue;
                    $speakers[] = $post_speaker->term_id;
                }

                $speaker_terms = get_terms(array('taxonomy'=>'mec_speaker', 'hide_empty'=>false));
                ?>
                    <div class="mec-meta-box-fields mec-fes-speakers" id="mec-speakers">
                        <h4><?php echo esc_html($this->main->m('taxonomy_speakers', esc_html__('Speakers', 'mec'))); ?></h4>
                        <div class="mec-form-row">
                            <input type="text" name="mec[speakers][datas][names]" id="mec_speaker_input_names" placeholder="<?php esc_html_e('Speakers Names', 'mec'); ?>" class="" />
                            <p><?php esc_html_e('Separate names with commas: Justin, Chris', 'mec'); ?></p>
                            <button class="button" type="button" id="mec_add_speaker_button"><?php esc_html_e('Add', 'mec'); ?></button>
                        </div>
                        <div class="mec-form-row" id="mec-fes-speakers-list">
                        <?php if(count($speaker_terms)): ?>
                            <?php foreach($speaker_terms as $speaker_term): ?>
                                <label for="mec_fes_speakers<?php echo esc_attr($speaker_term->term_id); ?>">
                                    <input type="checkbox" name="mec[speakers][<?php echo esc_attr($speaker_term->term_id); ?>]" id="mec_fes_speakers<?php echo esc_attr($speaker_term->term_id); ?>" value="1" <?php echo (in_array($speaker_term->term_id, $speakers) ? 'checked="checked"' : ''); ?> />
                                    <?php echo esc_html($speaker_term->name); ?>
                                </label>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php endif; ?>

            <!-- Virtual Section -->
            <?php
            if(isset($this->settings['fes_section_virtual_events']) && $this->settings['fes_section_virtual_events'])
            {
                if($post->ID != -1 && $post == "") $post = get_post_meta($post->ID, 'meta_box_virtual', true);

                do_action('mec_virtual_event_form', $post);
            }
            ?>

            <!-- Zoom Event Section -->
            <?php
            if(isset($this->settings['fes_section_zoom_integration']) && $this->settings['fes_section_zoom_integration'])
            {
                if($post->ID != -1 && $post == "") $post = get_post_meta($post->ID, 'meta_box_virtual', true);
                do_action('mec_zoom_event_form', $post);
            }
            ?>
        </div>
        <div class="mec-form-row mec-fes-submit-wide">

            <!-- Agreement Section -->
            <?php if(isset($this->settings['fes_agreement']) and $this->settings['fes_agreement']): ?>
            <label>
                <input type="hidden" name="mec[agreement]" value="0">
                <input type="checkbox" name="mec[agreement]" required value="1" <?php echo (isset($this->settings['fes_agreement_checked']) and $this->settings['fes_agreement_checked']) ? 'checked="checked"' : ''; ?>>

                <?php if(isset($this->settings['fes_agreement_page']) and $this->settings['fes_agreement_page']): ?>
                <span><?php echo sprintf(esc_html__('I accept the %s in order to submit an event.', 'mec'), '<a href="'.get_permalink($this->settings['fes_agreement_page']).'" target="_blank">'.esc_html__('Privacy Policy', 'mec').'</a>'); ?> <span class="mec-required">*</span></span>
                <?php else: ?>
                <span><?php esc_html_e('I accept the Privacy Policy in order to submit an event.', 'mec'); ?> <span class="mec-required">*</span></span>
                <?php endif; ?>
            </label>
            <?php endif; ?>

            <?php if($this->main->get_recaptcha_status('fes')): ?><div class="mec-form-row mec-google-recaptcha"><div class="g-recaptcha" data-sitekey="<?php echo esc_attr($this->settings['google_recaptcha_sitekey']); ?>"></div></div><?php endif; ?>
            <button class="mec-fes-sub-button" type="submit"><?php esc_html_e('Submit Event', 'mec'); ?></button>
            <div class="mec-util-hidden">
                <input type="hidden" name="mec[post_id]" value="<?php echo esc_attr($post_id); ?>" id="mec_fes_post_id" class="mec-fes-post-id" />
                <input type="hidden" name="action" value="mec_fes_form" />
                <?php wp_nonce_field('mec_fes_form'); ?>
                <?php wp_nonce_field('mec_event_data', 'mec_event_nonce'); ?>
            </div>

        </div>
    </form>
</div>

<?php do_action('mec_fes_form_footer', $post); ?>