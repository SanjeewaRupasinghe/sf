<?php
$mec_base = new \MEC_MAIN; ?>

<!-- Custom View -->
<div class="mec-search-form-options-container mec-util-hidden" id="mec_custom_search_form_options_container">
    <?php $sf_options_custom = isset($sf_options['custom']) ? $sf_options['custom'] : array(); ?>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_category"><?php echo $mec_base->m('taxonomy_category', __('Category', 'mec')); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][category][type]" id="mec_sf_custom_category">
            <option value="0" <?php if(isset($sf_options_custom['category']) and isset($sf_options_custom['category']['type']) and $sf_options_custom['category']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['category']) and isset($sf_options_custom['category']['type']) and $sf_options_custom['category']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_location"><?php echo $mec_base->m('taxonomy_location', __('Location', 'mec')); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][location][type]" id="mec_sf_custom_location">
            <option value="0" <?php if(isset($sf_options_custom['location']) and isset($sf_options_custom['location']['type']) and $sf_options_custom['location']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['location']) and isset($sf_options_custom['location']['type']) and $sf_options_custom['location']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_organizer"><?php echo $mec_base->m('taxonomy_organizer', __('Organizer', 'mec')); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][organizer][type]" id="mec_sf_custom_organizer">
            <option value="0" <?php if(isset($sf_options_custom['organizer']) and isset($sf_options_custom['organizer']['type']) and $sf_options_custom['organizer']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['organizer']) and isset($sf_options_custom['organizer']['type']) and $sf_options_custom['organizer']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_speaker"><?php echo $mec_base->m('taxonomy_speaker', __('Speaker', 'mec')); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][speaker][type]" id="mec_sf_custom_speaker">
            <option value="0" <?php if(isset($sf_options_custom['speaker']) and isset($sf_options_custom['speaker']['type']) and $sf_options_custom['speaker']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['speaker']) and isset($sf_options_custom['speaker']['type']) and $sf_options_custom['speaker']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_tag"><?php echo $mec_base->m('taxonomy_tag', __('Tag', 'mec')); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][tag][type]" id="mec_sf_custom_tag">
            <option value="0" <?php if(isset($sf_options_custom['tag']) and isset($sf_options_custom['tag']['type']) and $sf_options_custom['tag']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['tag']) and isset($sf_options_custom['tag']['type']) and $sf_options_custom['tag']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_label"><?php echo $mec_base->m('taxonomy_label', __('Label', 'mec')); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][label][type]" id="mec_sf_custom_label">
            <option value="0" <?php if(isset($sf_options_custom['label']) and isset($sf_options_custom['label']['type']) and $sf_options_custom['label']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['label']) and isset($sf_options_custom['label']['type']) and $sf_options_custom['label']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_month_filter"><?php _e('Month Filter', 'mec'); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][month_filter][type]" id="mec_sf_custom_month_filter">
            <option value="0" <?php if(isset($sf_options_custom['month_filter']) and isset($sf_options_custom['month_filter']['type']) and $sf_options_custom['month_filter']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="dropdown" <?php if(isset($sf_options_custom['month_filter']) and isset($sf_options_custom['month_filter']['type']) and $sf_options_custom['month_filter']['type'] == 'dropdown') echo 'selected="selected"'; ?>><?php _e('Dropdown', 'mec'); ?></option>
        </select>
    </div>
    <div class="mec-form-row">
        <label class="mec-col-12" for="mec_sf_custom_text_search"><?php _e('Text Search', 'mec'); ?></label>
        <select class="mec-col-12" name="mec[sf-options][custom][text_search][type]" id="mec_sf_custom_text_search">
            <option value="0" <?php if(isset($sf_options_custom['text_search']) and isset($sf_options_custom['text_search']['type']) and $sf_options_custom['text_search']['type'] == '0') echo 'selected="selected"'; ?>><?php _e('Disabled', 'mec'); ?></option>
            <option value="text_input" <?php if(isset($sf_options_custom['text_search']) and isset($sf_options_custom['text_search']['type']) and $sf_options_custom['text_search']['type'] == 'text_input') echo 'selected="selected"'; ?>><?php _e('Text Input', 'mec'); ?></option>
        </select>
    </div>
    <?php do_action('mec_custom_search_form',$sf_options_custom); ?>
</div>