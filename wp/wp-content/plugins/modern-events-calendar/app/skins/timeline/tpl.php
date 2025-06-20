<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_timeline $this */

// Get layout path
$render_path = $this->get_render_path();
$styling = $this->main->get_styling();

$dark_mode = (isset($styling['dark_mode']) ? $styling['dark_mode'] : '');
if($dark_mode == 1) $set_dark = 'mec-dark-mode';
else $set_dark = '';

ob_start();
include $render_path;
$items_html = ob_get_clean();

if(isset($this->atts['return_items']) and $this->atts['return_items'])
{
    echo json_encode(array('html' => $items_html, 'end_date' => $this->end_date, 'offset' => $this->next_offset, 'count' => $this->found, 'has_more_event' => (int) $this->has_more_events));
    exit;
}

$sed_method = $this->sed_method;
if($sed_method == 'new') $sed_method = '0';

// Generating javascript code tpl
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery("#mec_skin_'.esc_js($this->id).'").mecTimelineView(
    {
        id: "'.esc_js($this->id).'",
        start_date: "'.esc_js($this->start_date).'",
        end_date: "'.esc_js($this->end_date).'",
		offset: "'.esc_js($this->next_offset).'",
		limit: "'.esc_js($this->limit).'",
        atts: "'.http_build_query(array('atts' => $this->atts), '', '&').'",
        ajax_url: "'.admin_url('admin-ajax.php', NULL).'",
        sed_method: "'.esc_js($sed_method).'",
        image_popup: "'.esc_js($this->image_popup).'",
        sf:
        {
            container: "'.($this->sf_status ? '#mec_search_form_'.esc_js($this->id) : '').'",
            reset: '.($this->sf_reset_button ? 1 : 0).',
            refine: '.($this->sf_refine ? 1 : 0).',
        },
    });
});
</script>';

// Include javascript code into the page
if($this->main->is_ajax() or $this->main->preview()) echo MEC_kses::full($javascript);
else $this->factory->params('footer', $javascript);

do_action('mec_start_skin', $this->id);
do_action('mec_timeline_skin_head');
?>
<div class="mec-wrap mec-skin-timeline-container <?php echo esc_attr($this->html_class . ' ' . $set_dark); ?>" id="mec_skin_<?php echo esc_attr($this->id); ?>">
    
    <?php if($this->sf_status) echo MEC_kses::full($this->sf_search_form()); ?>
    
    <?php if($this->found): ?>
    <div class="mec-skin-timeline-events-container" id="mec_skin_events_<?php echo esc_attr($this->id); ?>">
        <?php echo MEC_kses::full($items_html); ?>
    </div>
    <div class="mec-skin-timeline-no-events-container mec-util-hidden" id="mec_skin_no_events_<?php echo esc_attr($this->id); ?>">
        <?php esc_html_e('No event found!', 'mec'); ?>
    </div>
    <?php else: ?>
    <div class="mec-skin-timeline-events-container" id="mec_skin_events_<?php echo esc_attr($this->id); ?>">
        <?php esc_html_e('No event found!', 'mec'); ?>
    </div>
    <?php endif; ?>
    
    <?php if($this->load_more_button and $this->found >= $this->limit): ?>
    <div class="mec-load-more-wrap"><div class="mec-load-more-button <?php echo ($this->has_more_events ? '' : 'mec-util-hidden'); ?>"><?php echo esc_html__('Load More', 'mec'); ?></div></div>
    <?php endif; ?>
    
</div>