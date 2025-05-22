<?php
global $post;
$mec_base = new \MEC_MAIN;
$mec_feature = new \MEC_feature_mec;
$args = [
    'post_type'   => 'mec_designer',
    'post_status' => 'publish',
    'order'       => 'DESC',
];
$styles = new \WP_Query( $args ); ?>

<!-- Custom View -->

<div class="mec-skin-options-container mec-util-hidden" id="mec_custom_skin_options_container">
    <?php $sk_options_custom = isset($sk_options['custom']) ? $sk_options['custom'] : array(); ?>
    <div class="mec-form-row">
        <label class="mec-col-4" for="mec_skin_custom_style"><?php _e('Style', 'mec-shortcode-designer'); ?></label>
        <input type="hidden" class="mec-col-4" value="<?php echo esc_attr( isset($sk_options_custom['shortcode_id']) ? $sk_options_custom['shortcode_id'] : '' ) ?>">
        <select class="mec-col-4 wn-mec-select" name="mec[sk-options][custom][style]" id="mec_skin_custom_style">
            <?php foreach ( $styles->get_posts() as $post ) : ?>
                <option value="<?php echo esc_attr( $post->ID ) ?>" <?php isset( $sk_options_custom['style'] ) ? selected( $sk_options_custom['style'], $post->ID, true) : ''; ?> ><?php echo esc_html( $post->post_title ); ?></option>';
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-4" for="mec_skin_custom_start_date_type"><?php _e('Start Date', 'mec'); ?></label>
        <select class="mec-col-4 wn-mec-select" name="mec[sk-options][custom][start_date_type]" id="mec_skin_custom_start_date_type" onchange="if(this.value === 'date') jQuery('#mec_skin_custom_start_date_container').show(); else jQuery('#mec_skin_custom_start_date_container').hide();">
            <option value="today" <?php if(isset($sk_options_custom['start_date_type']) and $sk_options_custom['start_date_type'] == 'today') echo 'selected="selected"'; ?>><?php _e('Today', 'mec'); ?></option>
            <option value="tomorrow" <?php if(isset($sk_options_custom['start_date_type']) and $sk_options_custom['start_date_type'] == 'tomorrow') echo 'selected="selected"'; ?>><?php _e('Tomorrow', 'mec'); ?></option>
            <option value="start_current_month" <?php if(isset($sk_options_custom['start_date_type']) and $sk_options_custom['start_date_type'] == 'start_current_month') echo 'selected="selected"'; ?>><?php _e('Start of Current Month', 'mec'); ?></option>
            <option value="start_next_month" <?php if(isset($sk_options_custom['start_date_type']) and $sk_options_custom['start_date_type'] == 'start_next_month') echo 'selected="selected"'; ?>><?php _e('Start of Next Month', 'mec'); ?></option>
            <option value="date" <?php if(isset($sk_options_custom['start_date_type']) and $sk_options_custom['start_date_type'] == 'date') echo 'selected="selected"'; ?>><?php _e('On a certain date', 'mec'); ?></option>
        </select>
        <div class="mec-col-4 <?php if(!isset($sk_options_custom['start_date_type']) or (isset($sk_options_custom['start_date_type']) and $sk_options_custom['start_date_type'] != 'date')) echo 'mec-util-hidden'; ?>" id="mec_skin_custom_start_date_container">
            <input class="mec_date_picker" type="text" name="mec[sk-options][custom][start_date]" id="mec_skin_custom_start_date" placeholder="<?php echo sprintf(__('eg. %s', 'mec'), date('Y-n-d')); ?>" value="<?php if(isset($sk_options_custom['start_date'])) echo $sk_options_custom['start_date']; ?>" />
        </div>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-4" for="mec_skin_custom_count"><?php _e('Count in row', 'mec'); ?></label>
        <select class="mec-col-4 wn-mec-select" name="mec[sk-options][custom][count]" id="mec_skin_custom_count" onchange="if(this.value != '1') jQuery('.custom-month-divider').hide(); else jQuery('.custom-month-divider').show();">
            <option value="1" <?php echo (isset($sk_options_custom['count']) and $sk_options_custom['count'] == 1) ? 'selected="selected"' : ''; ?>>1</option>
            <option value="2" <?php echo (isset($sk_options_custom['count']) and $sk_options_custom['count'] == 2) ? 'selected="selected"' : ''; ?>>2</option>
            <option value="3" <?php echo (isset($sk_options_custom['count']) and $sk_options_custom['count'] == 3) ? 'selected="selected"' : ''; ?>>3</option>
            <option value="4" <?php echo (isset($sk_options_custom['count']) and $sk_options_custom['count'] == 4) ? 'selected="selected"' : ''; ?>>4</option>
            <option value="6" <?php echo (isset($sk_options_custom['count']) and $sk_options_custom['count'] == 6) ? 'selected="selected"' : ''; ?>>6</option>
            <option value="12" <?php echo (isset($sk_options_custom['count']) and $sk_options_custom['count'] == 12) ? 'selected="selected"' : ''; ?>>12</option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-4" for="mec_skin_custom_limit"><?php _e('Limit', 'mec'); ?></label>
        <input class="mec-col-4" type="number" name="mec[sk-options][custom][limit]" id="mec_skin_custom_limit" placeholder="<?php _e('eg. 6', 'mec'); ?>" value="<?php if(isset($sk_options_custom['limit'])) echo $sk_options_custom['limit']; ?>" />
    </div>
    <div class="mec-form-row mec-switcher">
        <div class="mec-col-4">
            <label for="mec_skin_custom_load_more_button"><?php _e('Load More Button', 'mec'); ?></label>
        </div>
        <div class="mec-col-4">
            <input type="hidden" name="mec[sk-options][custom][load_more_button]" value="0" />
            <input type="checkbox" name="mec[sk-options][custom][load_more_button]" id="mec_skin_custom_load_more_button" value="1" <?php if(!isset($sk_options_custom['load_more_button']) or (isset($sk_options_custom['load_more_button']) and $sk_options_custom['load_more_button'])) echo 'checked="checked"'; ?> />
            <label for="mec_skin_custom_load_more_button"></label>
        </div>
    </div>
    <div class="mec-form-row mec-switcher">
        <div class="mec-col-4">
            <label for="mec_skin_custom_map_on_top"><?php _e('Show Map on top', 'mec'); ?></label>
        </div>
        <div class="mec-col-4">
            <?php if(!$mec_base->getPRO()): ?>
            <div class="info-msg"><?php echo sprintf(__("%s is required to use this feature.", 'mec'), '<a href="'.$mec_base->get_pro_link().'" target="_blank">'.__('Pro version of Modern Events Calendar', 'mec').'</a>'); ?></div>
            <?php else: ?>
            <input type="hidden" name="mec[sk-options][custom][map_on_top]" value="0" />
            <input type="checkbox" name="mec[sk-options][custom][map_on_top]" id="mec_skin_custom_map_on_top" value="1" <?php if(isset($sk_options_custom['map_on_top']) and $sk_options_custom['map_on_top']) echo 'checked="checked"'; ?> onchange="mec_skin_map_toggle(this);"/>
            <label for="mec_skin_custom_map_on_top"></label>
            <?php endif; ?>
        </div>
    </div>
    <!-- Start Set Map Geolocation -->
    <div class="mec-form-row mec-switcher mec-set-geolocation <?php if(!isset($sk_options_custom['map_on_top']) or (isset($sk_options_custom['map_on_top']) and !$sk_options_custom['map_on_top'])) echo 'mec-util-hidden'; ?>">
        <div class="mec-col-4">
            <label for="mec_skin_custom_set_geo_location"><?php _e('Geolocation', 'mec'); ?></label>
        </div>
        <div class="mec-col-4">
            <input type="hidden" name="mec[sk-options][custom][set_geolocation]" value="0" />
            <input type="checkbox" name="mec[sk-options][custom][set_geolocation]" id="mec_skin_custom_set_geo_location" value="1"
                <?php if(isset($sk_options_custom['set_geolocation']) and trim($sk_options_custom['set_geolocation'])) echo 'checked="checked"'; ?> />
            <label for="mec_skin_custom_set_geo_location"></label>
        </div>
    </div>
    <!-- End Set Map Geolocation -->
    <div class="mec-form-row mec-switcher custom-month-divider <?php if((isset($sk_options_custom['count']) and $sk_options_custom['count'] != '1')) echo 'mec-util-hidden'; ?>">
        <div class="mec-col-4">
            <label for="mec_skin_custom_month_divider"><?php _e('Show Month Divider', 'mec'); ?></label>
        </div>
        <div class="mec-col-4">
            <input type="hidden" name="mec[sk-options][custom][month_divider]" value="0" />
            <input type="checkbox" name="mec[sk-options][custom][month_divider]" id="mec_skin_custom_month_divider" value="1" <?php if(isset($sk_options_custom['month_divider']) and $sk_options_custom['month_divider']) echo 'checked="checked"'; ?> />
            <label for="mec_skin_custom_month_divider"></label>
        </div>
    </div>
    <?php echo $mec_feature->sed_method_field('custom', (isset($sk_options_custom['sed_method']) ? $sk_options_custom['sed_method'] : 0), (isset($sk_options_custom['image_popup']) ? $sk_options_custom['image_popup'] : 0)); ?>
</div>