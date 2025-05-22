<?php

namespace MEC_ShortcodeDesigner\Core;

/**
 * global $MEC_Events_dates
 * @version 1.0.0
 */
class EventsDateTimes{

    private static $instance;

    public static function instance(){

        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get_group_data($group_id){

        global $MEC_Events_dates,$MEC_Events_dates_groups;
		if( !isset($MEC_Events_dates_groups[$group_id]) || empty($MEC_Events_dates_groups[$group_id] ) ){

			$MEC_Events_dates_groups[$group_id] = $MEC_Events_dates;
		}

        return $MEC_Events_dates_groups[$group_id];
    }

    public function remove_event_datetime_data($group_id,$event_id,$key){

        global $MEC_Events_dates_groups;
        unset($MEC_Events_dates_groups[$group_id][$event_id][$key]);
    }

    public function get_datetimes($event_id,$group_id){

        $data = $this->get_group_data($group_id);
        $datetimes = array();

		if( isset($data[$event_id]) && is_array( $data[$event_id] ) ){

			$k = array_key_first($data[$event_id]);
			$datetimes = isset($data[$event_id][$k]) ? $data[$event_id][$k] : null;

            $this->remove_event_datetime_data($group_id,$event_id,$k);
		}

        /**
         * array(
         *      'start' => array(
         *          'date' => '2021:01:01',
         *          'time' => '11:00 pm',
         *          'timestamp' => '1234567890',
         *      ),
         *      'end' => array(
         *          'date' => '2021:01:01',
         *          'time' => '11:00 pm',
         *          'timestamp' => '1234567890',
         *      ),
         * )
         */

        return $datetimes;
    }
}