<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	the_content();
endwhile;

echo '
<style>
    #elementor-panel-elements-wrapper,
    #elementor-add-new-section,
    .elementor-editor-element-add,
    .elementor-editor-element-remove,
    .elementor-section > .elementor-element-overlay .elementor-editor-element-edit,
    .elementor-panel-category-items .elementor-element-wrapper {
        display: none !important;
    }
</style>';

get_footer();
