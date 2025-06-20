<?php if($single->found_value('data_time', $settings) == 'on' || $single->found_value('local_time', $settings) == 'on' || $single->found_value('event_cost', $settings) == 'on' || $single->found_value('more_info', $settings) == 'on' || $single->found_value('event_label', $settings) == 'on' || $single->found_value('event_location', $settings) == 'on' || $single->found_value('event_categories', $settings) == 'on' || $single->found_value('event_orgnizer', $settings) == 'on' || $single->found_value('register_btn', $settings) == 'on'  ) : ?>
    <div class="mec-event-info-desktop mec-event-meta mec-color-before mec-frontbox">
        <?php
        // Event Date and Time
        if(isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start']) and $single->found_value('data_time', $settings) == 'on')
        {
            $midnight_event = $single->main->is_midnight_event($event);
            ?>
            <div class="mec-single-event-date">
                <i class="mec-sl-calendar"></i>
                <h3 class="mec-date"><?php esc_html_e('Date', 'mec'); ?></h3>
                <dl>
                    <?php if($midnight_event): ?>
                        <dd><abbr class="mec-events-abbr"><?php echo MEC_kses::element($single->main->dateify($event, $single->date_format1)); ?></abbr></dd>
                    <?php else: ?>
                        <dd><abbr class="mec-events-abbr"><?php echo MEC_kses::element($single->main->date_label((trim($occurrence) ? array('date' => $occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date' => $occurrence_end_date) : (isset($event->date['end']) ? $event->date['end'] : NULL)), $single->date_format1, ' - ', true, 0, $event)); ?></abbr></dd>
                    <?php endif; ?>
                </dl>
                <?php echo MEC_kses::element($single->main->holding_status($event)); ?>
            </div>

            <?php
            if(isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0')
            {
                $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
                $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
                ?>
                <div class="mec-single-event-time">
                    <i class="mec-sl-clock " style=""></i>
                    <h3 class="mec-time"><?php esc_html_e('Time', 'mec'); ?></h3>
                    <i class="mec-time-comment"><?php echo (isset($time_comment) ? esc_html($time_comment) : ''); ?></i>
                    <dl>
                        <?php if($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])): ?>
                            <dd><abbr class="mec-events-abbr"><?php echo esc_html($event->data->time['start']); ?><?php echo esc_html(trim($event->data->time['end']) ? ' - '.esc_html($event->data->time['end']) : ''); ?></abbr></dd>
                        <?php else: ?>
                            <dd><abbr class="mec-events-abbr"><?php echo esc_html($single->main->m('all_day', esc_html__('All Day' , 'mec'))); ?></abbr></dd>
                        <?php endif; ?>
                    </dl>
                </div>
                <?php
            }
        }

        // Local Time Module
        if($single->found_value('local_time', $settings) == 'on') echo MEC_kses::full($single->main->module('local-time.details', array('event' => $event)));
        ?>

        <?php
        // Event Cost
        if($cost and $single->found_value('event_cost', $settings) == 'on')
        {
            ?>
            <div class="mec-event-cost">
                <i class="mec-sl-wallet"></i>
                <h3 class="mec-cost"><?php echo esc_html($single->main->m('cost', esc_html__('Cost', 'mec'))); ?></h3>
                <dl><dd class="mec-events-event-cost"><?php echo MEC_kses::element($cost); ?></dd></dl>
            </div>
            <?php
        }
        ?>

        <?php
        // More Info
        if($more_info and $single->found_value('more_info', $settings) == 'on')
        {
            ?>
            <div class="mec-event-more-info">
                <i class="mec-sl-info"></i>
                <h3 class="mec-cost"><?php echo esc_html($single->main->m('more_info_link', esc_html__('More Info', 'mec'))); ?></h3>
                <dl><dd class="mec-events-event-more-info"><a class="mec-more-info-button mec-color-hover" target="<?php echo esc_attr($more_info_target); ?>" href="<?php echo esc_url($more_info); ?>"><?php echo esc_html($more_info_title); ?></a></dd></dl>
            </div>
            <?php
        }
        ?>

        <?php
        // Event labels
        if(isset($event->data->labels) and !empty($event->data->labels) and $single->found_value('event_label', $settings) == 'on')
        {
            $mec_items = count($event->data->labels);
            $mec_i = 0; ?>
            <div class="mec-single-event-label">
                <i class="mec-fa-bookmark-o"></i>
                <h3 class="mec-cost"><?php echo esc_html($single->main->m('taxonomy_labels', esc_html__('Labels', 'mec'))); ?></h3>
                <?php foreach($event->data->labels as $labels=>$label) :
                    $seperator = (++$mec_i === $mec_items ) ? '' : ',';
                    echo '<dl><dd style="color:' . esc_attr($label['color']) . '">' . esc_html($label["name"] . $seperator) . '</dd></dl>';
                endforeach; ?>
            </div>
            <?php
        }
        ?>

        <?php do_action('mec_single_virtual_badge', $event->data ); ?>
        <?php do_action('mec_single_zoom_badge', $event->data ); ?>

        <?php
        // Event Location
        if($location_id and count($location) and $single->found_value('event_location', $settings) == 'on')
        {
            ?>
            <div class="mec-single-event-location">
                <?php if($location['thumbnail']): ?>
                    <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? esc_attr($location['name']) : ''); ?>">
                <?php endif; ?>
                <i class="mec-sl-location-pin"></i>
                <h3 class="mec-events-single-section-title mec-location"><?php echo esc_html($single->main->m('taxonomy_location', esc_html__('Location', 'mec'))); ?></h3>
                <dl>
                    <dd class="author fn org"><?php echo MEC_kses::element($single->get_location_html($location)); ?></dd>
                    <dd class="location"><address class="mec-events-address"><span class="mec-address"><?php echo (isset($location['address']) ? esc_html($location['address']) : ''); ?></span></address></dd>
                    <?php if(isset($location['url']) and trim($location['url'])): ?>
                        <dd class="mec-location-url">
                            <i class="mec-sl-sitemap"></i>
                            <h6><?php esc_html_e('Website', 'mec'); ?></h6>
                            <span><a href="<?php echo esc_url($location['url']); ?>" class="mec-color-hover" target="_blank"><?php echo esc_html($location['url']); ?></a></span>
                        </dd>
                    <?php endif;
                    $location_description_setting = isset( $settings['location_description'] ) ? $settings['location_description'] : ''; $location_terms = get_the_terms($event->data, 'mec_location'); if($location_description_setting == '1' and is_array($location_terms) and count($location_terms)): foreach($location_terms as $location_term) { if ($location_term->term_id == $location['id'] ) {  if(isset($location_term->description) && !empty($location_term->description)): ?>
                        <dd class="mec-location-description">
                            <p><?php echo esc_html($location_term->description);?></p>
                        </dd>
                    <?php endif; } } endif; ?>
                </dl>
            </div>
            <?php
            $single->show_other_locations($event); // Show Additional Locations
        }
        ?>

        <?php
        // Event Categories
        if(isset($event->data->categories) and !empty($event->data->categories) and $single->found_value('event_categories', $settings) == 'on')
        {
            ?>
            <div class="mec-single-event-category">
                <i class="mec-sl-folder"></i>
                <dt><?php echo esc_html($single->main->m('taxonomy_categories', esc_html__('Category', 'mec'))); ?></dt>
                <?php
                foreach($event->data->categories as $category)
                {
                    $color = ((isset($category['color']) and trim($category['color'])) ? $category['color'] : '');

                    $color_html = '';
                    if($color) $color_html .= '<span class="mec-event-category-color" style="--background-color: '.esc_attr($color).';background-color: '.esc_attr($color).'">&nbsp;</span>';

                    $icon = (isset($category['icon']) ? $category['icon'] : '');
                    $icon = isset($icon) && $icon != '' ? '<i class="' . esc_attr($icon) . ' mec-color"></i>' : '<i class="mec-fa-angle-right"></i>';

                    echo '<dl><dd class="mec-events-event-categories"><a href="'.get_term_link($category['id'], 'mec_category').'" class="mec-color-hover" rel="tag">' . MEC_kses::element($icon . esc_html($category['name']) . $color_html) . '</a></dd></dl>';
                }
                ?>
            </div>
            <?php
        }
        ?>
        <?php do_action('mec_single_event_under_category', $event); ?>
        <?php
        // Event Organizer
        if($organizer_id and count($organizer) and $single->found_value('event_orgnizer', $settings) == 'on')
        {
            ?>
            <div class="mec-single-event-organizer">
                <?php if(isset($organizer['thumbnail']) and trim($organizer['thumbnail'])): ?>
                    <img class="mec-img-organizer" src="<?php echo esc_url($organizer['thumbnail']); ?>" alt="<?php echo (isset($organizer['name']) ? esc_attr($organizer['name']) : ''); ?>">
                <?php endif; ?>
                <h3 class="mec-events-single-section-title"><?php echo esc_html($single->main->m('taxonomy_organizer', esc_html__('Organizer', 'mec'))); ?></h3>
                <dl>
                    <?php if(isset($organizer['thumbnail'])): ?>
                        <dd class="mec-organizer">
                            <i class="mec-sl-home"></i>
                            <h6><?php echo (isset($organizer['name']) ? esc_html($organizer['name']) : ''); ?></h6>
                        </dd>
                    <?php endif;
                    if(isset($organizer['tel']) && !empty($organizer['tel'])): ?>
                        <dd class="mec-organizer-tel">
                            <i class="mec-sl-phone"></i>
                            <h6><?php esc_html_e('Phone', 'mec'); ?></h6>
                            <a href="tel:<?php echo esc_attr($organizer['tel']); ?>"><?php echo esc_html($organizer['tel']); ?></a>
                        </dd>
                    <?php endif;
                    if(isset($organizer['email']) && !empty($organizer['email'])): ?>
                        <dd class="mec-organizer-email">
                            <i class="mec-sl-envelope"></i>
                            <h6><?php esc_html_e('Email', 'mec'); ?></h6>
                            <a href="mailto:<?php echo esc_attr($organizer['email']); ?>"><?php echo esc_html($organizer['email']);; ?></a>
                        </dd>
                    <?php endif;
                    if(isset($organizer['url']) && !empty($organizer['url']) and $organizer['url'] != 'http://'): ?>
                        <dd class="mec-organizer-url">
                            <i class="mec-sl-sitemap"></i>
                            <h6><?php esc_html_e('Website', 'mec'); ?></h6>
                            <span><a href="<?php echo esc_url($organizer['url']); ?>" class="mec-color-hover" target="_blank"><?php echo esc_html($organizer['url']); ?></a></span>
                            <?php do_action('mec_single_default_organizer', $organizer); ?>
                        </dd>
                    <?php endif;
                    $organizer_description_setting = isset( $settings['organizer_description'] ) ? $settings['organizer_description'] : ''; $organizer_terms = get_the_terms($event->data, 'mec_organizer'); if($organizer_description_setting == '1' and is_array($organizer_terms) and count($organizer_terms)): foreach($organizer_terms as $organizer_term) { if ($organizer_term->term_id == $organizer['id'] ) {  if(isset($organizer_term->description) && !empty($organizer_term->description)): ?>
                        <dd class="mec-organizer-description"><p><?php echo esc_html($organizer_term->description);?></p></dd>
                    <?php endif; } } endif; ?>
                </dl>
            </div>
            <?php
            $single->show_other_organizers($event); // Show Additional Organizers
        }
        ?>

        <!-- Register Booking Button -->
        <?php if($single->main->can_show_booking_module($event) and $single->found_value('register_btn', $settings) == 'on'): ?>
            <?php $data_lity_class = ''; if(isset($settings['single_booking_style']) and $settings['single_booking_style'] == 'modal' ){ $data_lity_class = 'mec-booking-data-lity'; }  ?>
            <a class="mec-booking-button mec-bg-color <?php echo sanitize_html_class($data_lity_class); ?> <?php if(isset($settings['single_booking_style']) and $settings['single_booking_style'] != 'modal' ) echo 'simple-booking'; ?>" href="#mec-events-meta-group-booking-<?php echo esc_attr($single->uniqueid); ?>"><?php echo esc_html($single->main->m('register_button', esc_html__('REGISTER', 'mec'))); ?></a>
        <?php elseif($single->found_value('register_btn', $settings) == 'on' and $more_info): ?>
            <a class="mec-booking-button mec-bg-color" target="<?php echo esc_attr($more_info_target); ?>" href="<?php echo esc_url($more_info); ?>"><?php if($more_info_title) echo esc_html__($more_info_title, 'mec'); else echo esc_html($single->main->m('register_button', esc_html__('REGISTER', 'mec'))); ?></a>
        <?php endif; ?>
    </div>
<?php endif; ?>

    <!-- Speakers Module -->
<?php if($single->found_value('event_speakers', $settings) == 'on') echo MEC_kses::full($single->main->module('speakers.details', array('event' => $event))); ?>

    <!-- Attendees List Module -->
<?php if($single->found_value('attende_module', $settings) == 'on') echo MEC_kses::full($single->main->module('attendees-list.details', array('event' => $event))); ?>

    <!-- Next Previous Module -->
<?php if($single->found_value('next_module', $settings) == 'on') echo MEC_kses::full($single->main->module('next-event.details', array('event' => $event))); ?>

    <!-- Links Module -->
<?php if($single->found_value('links_module', $settings) == 'on') echo MEC_kses::full($single->main->module('links.details', array('event' => $event))); ?>

    <!-- Weather Module -->
<?php if($single->found_value('weather_module', $settings) == 'on') echo MEC_kses::full($single->main->module('weather.details', array('event' => $event))); ?>

    <!-- Google Maps Module -->
<?php if ($single->found_value('google_map', $settings) == 'on'): ?>
    <div class="mec-events-meta-group mec-events-meta-group-gmap">
        <?php echo MEC_kses::full($single->main->module('googlemap.details', array('event' => $single->events))); ?>
    </div>
<?php endif; ?>

    <!-- QRCode Module -->
<?php if($single->found_value('qrcode_module', $settings) == 'on') echo MEC_kses::full($single->main->module('qrcode.details', array('event' => $event))); ?>

    <!-- Public Download Module -->
<?php if($single->found_value('public_download_module', $settings) == 'on') echo MEC_kses::full($single->display_public_download_module($event)); ?>

    <!-- Custom Fields Module -->
<?php if($single->found_value('custom_fields_module', $settings) == 'on') echo MEC_kses::full($single->display_data_fields($event, true)); ?>