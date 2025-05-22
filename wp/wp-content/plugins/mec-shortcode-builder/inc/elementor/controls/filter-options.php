<?php
namespace Elementor;

/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC elementor search form filter_options view class
 * @author Webnus <info@webnus.biz>
 */
class MEC_elementor_filter_options
{

    /**
     * Register Elementor search form filter_options options 
     * @author Webnus <info@webnus.biz>
     */
    public static function options( $self )
    {
		// Categories
        $terms = get_terms( 'mec_category' );
        $categories = array();
        if ($terms) {
            foreach ($terms as $term) {
                $categories[$term->term_id] = $term->name;
            }
        }
		$self->add_control(
            // mec_sk_options_
			'filter_options_categories',
			array(
				'label'		=> __('Categories', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'multiple'  => true,
				'options'	=> $categories,
            )
        );
        // locations
        $terms = get_terms( 'mec_location' );
        $locations = array();
        if ($terms) {
            foreach ($terms as $term) {
                $locations[$term->term_id] = $term->name;
            }
        }
		$self->add_control(
            // mec_sk_options_
			'filter_options_locations',
			array(
				'label'		=> __('Locations', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'multiple'  => true,
				'options'	=> $locations,
            )
        );
        // organizers
        $terms = get_terms( 'mec_organizer' );
        $organizers = array();
        if ($terms) {
            foreach ($terms as $term) {
                $organizers[$term->term_id] = $term->name;
            }
        }
		$self->add_control(
            // sk_options_
			'filter_options_organizers',
			array(
				'label'		=> __('Organizers', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'multiple'  => true,
				'options'	=> $organizers,
            )
        );
        // labels
        $terms = get_terms( 'mec_label' );
        $labels = array();
        if ($terms) {
            foreach ($terms as $term) {
                $labels[$term->term_id] = $term->name;
            }
        }
		$self->add_control(
            // sk_options_
			'filter_options_labels',
			array(
				'label'		=> __('Labels', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'multiple'  => true,
				'options'	=> $labels,
            )
        );
        // tags
        $terms = get_terms( 'post_tag' );
        $tags = array();
        if ($terms) {
            foreach ($terms as $term) {
                $tags[$term->name] = $term->name;
            }
        }
		$self->add_control(
            // mec_sk_options_
			'filter_options_tags',
			array(
				'label'		=> __('Tags', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'multiple'  => true,
				'options'	=> $tags,
            )
        );
        // authors
        $authors            = array();
        $users              = get_users(array(
            'role__not_in'  => array('Subscriber', 'contributor'),
            'orderby'       => 'post_count',
            'order'         => 'DESC',
            'number'        => '-1',
            'fields'        => array('ID', 'display_name')
        ));
        if ($users) {
            foreach ($users as $author) {
                $authors[$author->ID] = $author->display_name;
            }
        }
		$self->add_control(
            // mec_sk_options_
			'filter_options_authors',
			array(
				'label'		=> __('Authors', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'options'	=> $authors,
                'multiple'  => true,
            )
        );
		$self->add_control(
            // mec_sk_options_
			'filter_options_occurrence',
			array(
				'label'		=> __('Occurrences', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT,
                'default'	=> '0',
                'options'	=> [
                    '0'    => __('Disable','mec-shortcode-builder'),
                    'show-only-one-occurrence'  => __('Show only one occurrence of events','mec-shortcode-builder'),
                ],
            )
        );
		$self->add_control(
            // mec_sk_options_
			'filter_options_dates',
			array(
				'label'		=> __('Expired / Ongoing', 'mec-shortcode-builder'),
                'type'		=> \Elementor\Controls_Manager::SELECT2,
                'default'	=> 'include-expired-events',
                'options'	=> [
                    'include-expired-events'    => __('Include Expired Events','mec-shortcode-builder'),
                    'show-only-expired-events'  => __('Show Only Expired Events','mec-shortcode-builder'),
                    'show-ongoing-events'       => __('Include Ongoing Events','mec-shortcode-builder'),
                    'show-only-ongoing-events'  => __('Show Only Ongoing Events','mec-shortcode-builder'),
                ],
                'description' => __('<strong style="color: #000;">Expired Events:</strong><br /><br /><strong>— Include Expired Events:</strong><br />You can include past/expired events if you like so it will show upcoming and expired events based on start date that you selected.<br /><br /><strong>— Show Only Expired Events:</strong><br />It shows only expired/past events. It will use the selected start date as first day and then go to older dates.<br /><br /><strong style="color: #000;">Ongoing Events:</strong><br /><br /><strong>— Include Ongoing Events:</strong><br />It includes ongoing events on List, Grid, Agenda and Timeline skins.<br /><br /><strong>— Show Only Ongoing Events:</strong><br />It shows only ongoing events on List, Grid, Agenda and Timeline skins.<br /><br /><a href="https://webnus.net/dox/modern-events-calendar/setup-date-option-on-shortcodes/" target="_blank">More Information</a>', 'mec-shortcode-builder'),
            )
        );
    }
}