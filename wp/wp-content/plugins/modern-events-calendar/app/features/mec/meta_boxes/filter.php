<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC taxonomy walker class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_tax_walker extends Walker_Category_Checklist
{
    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0)
    {
		if(empty($args['taxonomy'])) $taxonomy = 'category';
        else $taxonomy = $args['taxonomy'];

		$args['popular_cats'] = empty($args['popular_cats']) ? array() : $args['popular_cats'];
		$class = in_array($category->term_id, $args['popular_cats']) ? ' class="popular-category"' : '';

		$args['selected_cats'] = empty($args['selected_cats']) ? array() : $args['selected_cats'];

		if(!empty($args['list_only']))
        {
			$aria_cheched = 'false';
			$inner_class = 'category';

			if(in_array($category->term_id, $args['selected_cats']))
            {
				$inner_class .= ' selected';
				$aria_cheched = 'true';
			}
            // Show only Terms with Posts
            if($category->count)
            {
                $output .= "\n".'<li '.$class.'>'.
                    '<div class="'.esc_attr($inner_class).'" data-term-id='.esc_attr($category->term_id).' tabindex="0" role="checkbox" aria-checked="'.esc_attr($aria_cheched).'">'.
                    esc_html(apply_filters('the_category', $category->name)).'</div>';
            }
		}
        else
        {
            // Show only Terms with Posts
            if($category->count)
            {
                $output .= "\n<option value='".esc_attr($category->term_id)."'";
                if(in_array($category->term_id, $args['selected_cats'])) $output .= " selected='selected'";
                $output .= ">".esc_html(apply_filters('the_category', $category->name)).'';
            }
		}
	}
}

$MEC_tax_walker = new MEC_tax_walker();
?>
<div class="mec-calendar-metabox">
    <?php
        // Add a nonce field so we can check for it later.
        wp_nonce_field('mec_calendar_data', 'mec_calendar_nonce');
    ?>
    <div id="mec_meta_box_calendar_no_filter" class="mec-util-hidden">
        <p><?php esc_html_e('No filter options applicable for this skin.', 'mec'); ?></p>
    </div>
    <div class="mec-meta-box-fields" id="mec_meta_box_calendar_filter">
        <div class="mec-create-shortcode-tabs-wrap">
            <div class="mec-create-shortcode-tabs-left">
                <a class="mec-create-shortcode-tabs-link mec-tab-active" data-href="mec_select_categories" href="#"><?php echo esc_html__('Categories' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_locations" href="#"><?php echo esc_html__('Locations' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_organizers" href="#"><?php echo esc_html__('Organizers' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_labels" href="#"><?php echo esc_html__('Labels' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_tags" href="#"><?php echo esc_html__('Tags' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_authors" href="#"><?php echo esc_html__('Authors' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_occurrences" href="#"><?php echo esc_html__('Occurrences' ,'mec'); ?></a>
                <a class="mec-create-shortcode-tabs-link" data-href="mec_select_holding_statuses" href="#"><?php echo esc_html__('Expired / Ongoing' ,'mec'); ?></a>
                <?php do_action( 'mec_shortcode_filters_tab_links', $post ); ?>
            </div>
            <div class="mec-add-booking-tabs-right">
                <div class="mec-form-row mec-create-shortcode-tab-content mec-tab-active" id="mec_select_categories">
                    <h3><?php echo esc_html($this->main->m('taxonomy_categories', esc_html__('Categories', 'mec'))); ?></h3>
                    <p class="description"><?php esc_html_e('Choose your desired categories for filtering the events.', 'mec'); ?></p>
                    <p class="description" style="color: red;"><?php esc_html_e('You will see only those categories that are associated to at-least one event.', 'mec'); ?></p>
                    <select name="mec_tax_input[mec_category][]" multiple="multiple">
                    <?php
                        $selected_categories = explode(',', get_post_meta($post->ID, 'category', true));
                        wp_terms_checklist(0, array(
                            'descendants_and_self'=>0,
                            'taxonomy'=>'mec_category',
                            'selected_cats'=>$selected_categories,
                            'popular_cats'=>false,
                            'checked_ontop'=>false,
                            'walker'=>$MEC_tax_walker
                        ));
                    ?>
                    </select>
                </div>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_locations">
                    <h3><?php echo esc_html($this->main->m('taxonomy_locations', esc_html__('Locations', 'mec'))); ?></h3>
                    <p class="description"><?php esc_html_e('Choose your desired locations for filtering the events.', 'mec'); ?></p>
                    <p class="description" style="color: red;"><?php esc_html_e('You will see only those locations that are associated to at-least one event.', 'mec'); ?></p>
                    <select name="mec_tax_input[mec_location][]" multiple="multiple">
                    <?php
                        $selected_locations = explode(',', get_post_meta($post->ID, 'location', true));
                        wp_terms_checklist(0, array(
                            'descendants_and_self'=>0,
                            'taxonomy'=>'mec_location',
                            'selected_cats'=>$selected_locations,
                            'popular_cats'=>false,
                            'checked_ontop'=>false,
                            'walker'=>$MEC_tax_walker,
                        ));
                    ?>
                    </select>
                </div>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_organizers">
                    <h3><?php echo esc_html($this->main->m('taxonomy_organizers', esc_html__('Organizers', 'mec'))); ?></h3>
                    <p class="description"><?php esc_html_e('Choose your desired organizers for filtering the events.', 'mec'); ?></p>
                    <p class="description" style="color: red;"><?php esc_html_e('You will see only those organizers that are associated to at-least one event.', 'mec'); ?></p>
                    <select name="mec_tax_input[mec_organizer][]" multiple="multiple">
                    <?php
                        $selected_organizers = explode(',', get_post_meta($post->ID, 'organizer', true));
                        wp_terms_checklist(0, array(
                            'descendants_and_self'=>0,
                            'taxonomy'=>'mec_organizer',
                            'selected_cats'=>$selected_organizers,
                            'popular_cats'=>false,
                            'checked_ontop'=>false,
                            'walker'=>$MEC_tax_walker
                        ));
                    ?>
                    </select>
                </div>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_labels">
                    <h3><?php echo esc_html($this->main->m('taxonomy_labels', esc_html__('Labels', 'mec'))); ?></h3>
                    <p class="description"><?php esc_html_e('Choose your desired labels for filtering the events.', 'mec'); ?></p>
                    <p class="description" style="color: red;"><?php esc_html_e('You will see only those labels that are associated to at-least one event.', 'mec'); ?></p>
                    <select name="mec_tax_input[mec_label][]" multiple="multiple">
                    <?php
                        $selected_labels = explode(',', get_post_meta($post->ID, 'label', true));
                        wp_terms_checklist(0, array(
                            'descendants_and_self'=>0,
                            'taxonomy'=>'mec_label',
                            'selected_cats'=>$selected_labels,
                            'popular_cats'=>false,
                            'checked_ontop'=>false,
                            'walker'=>$MEC_tax_walker
                        ));
                    ?>
                    </select>
                </div>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_tags">
                    <h3><?php esc_html_e('Tags', 'mec'); ?></h3>
                    <p class="description"><?php esc_html_e('Insert your desired tags separated by commas.', 'mec'); ?></p>
                    <?php $selected_tags = get_post_meta($post->ID, 'tag', true); ?>
                    <input type="text" name="mec_tax_input[mec_tag]" value="<?php echo esc_attr($selected_tags); ?>" class="widefat" />
                </div>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_authors">
                    <h3><?php esc_html_e('Authors', 'mec'); ?></h3>
                    <p class="description"><?php esc_html_e('Choose your desired authors for filtering the events.', 'mec'); ?></p>
                    <select name="mec_tax_input[mec_author][]" multiple="multiple">
                    <?php
                        $selected_authors = explode(',', get_post_meta($post->ID, 'author', true));
                        $authors = get_users(array(
                            'role__not_in'=>array('subscriber', 'contributor'),
                            'orderby'=>'post_count',
                            'order'=>'DESC',
                            'number'=>'-1',
                            'fields'=>array('ID', 'display_name')
                        ));

                        foreach($authors as $author)
                        {
                            ?>
                            <option <?php if(in_array($author->ID, $selected_authors)) echo 'selected="selected"'; ?> value="<?php echo esc_attr($author->ID); ?>"><?php echo esc_html($author->display_name); ?></option>
                            <?php
                        }
                    ?>
                    </select>
                </div>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_occurrences">
                    <h3><?php esc_html_e('Occurrences', 'mec'); ?></h3>
                    <?php $show_only_one_occurrence = get_post_meta($post->ID, 'show_only_one_occurrence', true); ?>
                    <div class="mec-form-row mec-switcher">
                        <div class="mec-col-4">
                            <label for="show_only_one_occurrence"><?php esc_html_e('Show only one occurrence of events', 'mec'); ?></label>
                        </div>
                        <div class="mec-col-4">
                            <input type="hidden" name="mec[show_only_one_occurrence]" value="0" />
                            <input type="checkbox" name="mec[show_only_one_occurrence]" id="show_only_one_occurrence" value="1" <?php if($show_only_one_occurrence == 1) echo 'checked="checked"'; ?> />
                            <label for="show_only_one_occurrence"></label>
                        </div>
                    </div>
                </div>
                <?php do_action('mec_shortcode_filters', $post->ID, $MEC_tax_walker); ?>
                <div class="mec-form-row mec-create-shortcode-tab-content" id="mec_select_holding_statuses">
                    <h3><?php esc_html_e('Expired Events', 'mec'); ?></h3>
                    <div class="mec-form-row mec-switcher">
                        <?php $show_past_events = get_post_meta($post->ID, 'show_past_events', true); ?>
                        <div class="mec-col-4">
                            <label for="mec_show_past_events"><?php esc_html_e('Include Expired Events', 'mec'); ?></label>
                        </div>
                        <div class="mec-col-4">
                            <input type="hidden" name="mec[show_past_events]" value="0" />
                            <input type="checkbox" name="mec[show_past_events]" class="mec-checkbox-toggle" id="mec_show_past_events" value="1" <?php if($show_past_events == '' or $show_past_events == 1) echo 'checked="checked"'; ?> />
                            <label for="mec_show_past_events"></label>
                        </div>
                        <p class="description"><?php esc_html_e('You can include past/expired events if you like so it will show upcoming and expired events based on start date that you selected.', 'mec'); ?></p>
                    </div>
                    <div id="mec_date_only_past_filter">
                        <div class="mec-form-row mec-switcher">
                            <?php $show_only_past_events = get_post_meta($post->ID, 'show_only_past_events', true); ?>
                            <div class="mec-col-4">
                                <label for="mec_show_only_past_events"><?php esc_html_e('Show Only Expired Events', 'mec'); ?></label>
                            </div>
                            <div class="mec-col-4">
                                <input type="hidden" name="mec[show_only_past_events]" value="0" />
                                <input type="checkbox" name="mec[show_only_past_events]" class="mec-checkbox-toggle" id="mec_show_only_past_events" value="1" <?php if($show_only_past_events == 1) echo 'checked="checked"'; ?> />
                                <label for="mec_show_only_past_events"></label>
                            </div>
                            <p class="description" style="color: red;"><?php echo sprintf(esc_html__('It shows %s expired/past events. It will use the selected start date as first day and then go to %s dates.', 'mec'), '<strong>'.esc_html__('only', 'mec').'</strong>', '<strong>'.esc_html__('older', 'mec').'</strong>'); ?></p>
                        </div>
                    </div>
                    <div id="mec_date_ongoing_filter">
                        <h3><?php esc_html_e('Ongoing Events', 'mec'); ?></h3>
                        <div class="mec-form-row mec-switcher">
                            <?php $show_ongoing_events = get_post_meta($post->ID, 'show_ongoing_events', true); ?>
                            <div class="mec-col-4">
                                <label for="mec_show_ongoing_events"><?php esc_html_e('Include Ongoing Events', 'mec'); ?></label>
                            </div>
                            <div class="mec-col-4">
                                <input type="hidden" name="mec[show_ongoing_events]" value="0" />
                                <input type="checkbox" name="mec[show_ongoing_events]" class="mec-checkbox-toggle" id="mec_show_ongoing_events" value="1" <?php if($show_ongoing_events == 1) echo 'checked="checked"'; ?> />
                                <label for="mec_show_ongoing_events"></label>
                            </div>
                            <p class="description"><?php esc_html_e('It includes ongoing events on List, Grid, Agenda and Timeline skins.', 'mec'); ?></p>
                        </div>
                        <div class="mec-form-row mec-switcher">
                            <?php $show_only_ongoing_events = get_post_meta($post->ID, 'show_only_ongoing_events', true); ?>
                            <div class="mec-col-4">
                                <label for="mec_show_only_ongoing_events"><?php esc_html_e('Show Only Ongoing Events', 'mec'); ?></label>
                            </div>
                            <div class="mec-col-4">
                                <input type="hidden" name="mec[show_only_ongoing_events]" value="0" />
                                <input type="checkbox" name="mec[show_only_ongoing_events]" class="mec-checkbox-toggle" id="mec_show_only_ongoing_events" value="1" <?php if($show_only_ongoing_events == 1) echo 'checked="checked"'; ?> />
                                <label for="mec_show_only_ongoing_events"></label>
                            </div>
                            <p class="description"><?php esc_html_e('It shows only ongoing events on List, Grid, Agenda and Timeline skins.', 'mec'); ?></p>
                        </div>
                    </div>
                </div>
                <?php do_action( 'mec_shortcode_filters_content', $post ); ?>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(".mec-create-shortcode-tabs-link").on("click", function(e)
{
    e.preventDefault();
    var href = jQuery(this).attr("data-href");

    jQuery(".mec-create-shortcode-tab-content,.mec-create-shortcode-tabs-link").removeClass("mec-tab-active");
    jQuery(this).addClass("mec-tab-active");
    jQuery("#" + href ).addClass("mec-tab-active");
});
</script>