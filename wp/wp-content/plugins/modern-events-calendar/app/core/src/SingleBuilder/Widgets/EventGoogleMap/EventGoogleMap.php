<?php

namespace MEC\SingleBuilder\Widgets\EventGoogleMap;

use MEC\Base;
use MEC\SingleBuilder\Widgets\WidgetBase;

class EventGoogleMap extends WidgetBase {

	/**
	 *  Get HTML Output
	 *
	 * @param int $event_id
	 * @param array $atts
	 *
	 * @return string
	 */
	public function output( $event_id = 0, $atts = array() ){

		if( !$event_id ){

			$event_id = $this->get_event_id();
		}

		if(!$event_id){
			return '';
		}

		$settings = $this->settings;
		$event_detail = $this->get_event_detail($event_id);
		$primary_location_id = isset($event_detail->data->meta['mec_location_id']) ? $event_detail->data->meta['mec_location_id'] : '';

		$html = '';

		if ( true === $this->is_editor_mode && ( !isset($settings['google_maps_status']) || !$settings['google_maps_status'] ) ) {

			$html = '<div class="mec-content-notification"><p>'
					.'<span>'. esc_html__('This option is disabled. In order for the widget in this page to be displayed correctly, please turn on  Google Maps Options and set the API for it there.', 'mec').'</span>'
					. '<a href="https://webnus.net/dox/modern-events-calendar/google-maps-options/" target="_blank">' . esc_html__('How to set Google Map', 'mec') . ' </a>'
				.'</p></div>';
		} elseif ( true === $this->is_editor_mode && !$primary_location_id ){

			$html = '<div class="mec-content-notification"><p>'
					.'<span>'. esc_html__('This widget is displayed if Google Map is set. In order for the widget in this page to be displayed correctly, please set Google Map for your last event.', 'mec').'</span>'
					. '<a href="https://webnus.net/dox/modern-events-calendar/google-maps-options/" target="_blank">' . esc_html__('How to set Google Map', 'mec') . ' </a>'
				.'</p></div>';
		} else {

			$html = '<div class="mec-events-meta-group mec-events-meta-group-gmap">'
						. Base::get_main()->module('googlemap.details', array('event' => [$event_detail])).
					'</div>';
		}

		return $html;
	}
}
