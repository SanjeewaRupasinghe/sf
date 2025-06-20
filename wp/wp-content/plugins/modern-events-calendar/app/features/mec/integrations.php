<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_feature_mec $this */
$settings = $this->main->get_settings();

// WordPress Pages
$pages = get_pages();

// MEC Categories
$categories = get_terms(array(
    'taxonomy' => 'mec_category',
    'hide_empty' => 0,
));
if(!is_array($categories)) $categories = array();
?>
<div class="wns-be-container wns-be-container-sticky">
    <div id="wns-be-infobar">
        <div class="mec-search-settings-wrap">
            <i class="mec-sl-magnifier"></i>
            <input id="mec-search-settings" type="text" placeholder="<?php esc_html_e('Search...' ,'mec'); ?>">
        </div>
        <a id="" class="dpr-btn dpr-save-btn"><?php esc_html_e('Save Changes', 'mec'); ?></a>
    </div>

    <div class="wns-be-sidebar">
        <?php $this->main->get_sidebar_menu('integrations'); ?>
    </div>

    <div class="wns-be-main">
        <div id="wns-be-notification"></div>
        <div id="wns-be-content">
            <div class="wns-be-group-tab">
                <div class="mec-container">

                    <form id="mec_integrations_form">

                        <?php if($this->main->getPRO()): ?>

                            <div id="mailchimp_option" class="mec-options-fields active">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('Mailchimp', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][mchimp_status]" value="0" />
                                        <input onchange="jQuery('#mec_mchimp_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][mchimp_status]" <?php if(isset($settings['mchimp_status']) and $settings['mchimp_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable Mailchimp Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_mchimp_status_container_toggle" class="<?php if((isset($settings['mchimp_status']) and !$settings['mchimp_status']) or !isset($settings['mchimp_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_mchimp_api_key"><?php esc_html_e('API Key', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_mchimp_api_key" name="mec[settings][mchimp_api_key]" value="<?php echo ((isset($settings['mchimp_api_key']) and trim($settings['mchimp_api_key']) != '') ? $settings['mchimp_api_key'] : ''); ?>" />
                                            <span class="mec-tooltip">
                                                <div class="box left">
                                                    <h5 class="title"><?php esc_html_e('API Key', 'mec'); ?></h5>
                                                    <div class="content"><p><?php esc_attr_e("Required!", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/mailchimp-integration/" target="_blank"><?php esc_html_e('Read More', 'mec'); ?></a></p></div>
                                                </div>
                                                <i title="" class="dashicons-before dashicons-editor-help"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_mchimp_list_id"><?php esc_html_e('List ID', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_mchimp_list_id" name="mec[settings][mchimp_list_id]" value="<?php echo ((isset($settings['mchimp_list_id']) and trim($settings['mchimp_list_id']) != '') ? $settings['mchimp_list_id'] : ''); ?>" />
                                            <span class="mec-tooltip">
                                                <div class="box left">
                                                    <h5 class="title"><?php esc_html_e('List ID', 'mec'); ?></h5>
                                                    <div class="content"><p><?php esc_attr_e("Required!", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/mailchimp-integration/" target="_blank"><?php esc_html_e('Read More', 'mec'); ?></a></p></div>
                                                </div>
                                                <i title="" class="dashicons-before dashicons-editor-help"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_mchimp_subscription_status"><?php esc_html_e('Subscription Status', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <select name="mec[settings][mchimp_subscription_status]" id="mec_settings_mchimp_subscription_status">
                                                <option value="subscribed" <?php if(isset($settings['mchimp_subscription_status']) and $settings['mchimp_subscription_status'] == 'subscribed') echo 'selected="selected"'; ?>><?php esc_html_e('Subscribe automatically', 'mec'); ?></option>
                                                <option value="pending" <?php if(isset($settings['mchimp_subscription_status']) and $settings['mchimp_subscription_status'] == 'pending') echo 'selected="selected"'; ?>><?php esc_html_e('Subscribe by verification', 'mec'); ?></option>
                                            </select>
                                            <span class="mec-tooltip">
                                                <div class="box left">
                                                    <h5 class="title"><?php esc_html_e('Subscription Status', 'mec'); ?></h5>
                                                    <div class="content"><p><?php esc_attr_e('If you choose "Subscribe by verification" then an email will be send to the user by mailchimp for subscription verification.', 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/mailchimp-integration/" target="_blank"><?php esc_html_e('Read More', 'mec'); ?></a></p></div>
                                                </div>
                                                <i title="" class="dashicons-before dashicons-editor-help"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label>
                                            <input type="hidden" name="mec[settings][mchimp_segment_status]" value="0" />
                                            <input value="1" type="checkbox" name="mec[settings][mchimp_segment_status]" <?php if(isset($settings['mchimp_segment_status']) and $settings['mchimp_segment_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable Segment Creation by Event Title and Booking Date', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="campaign_monitor_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('Campaign Monitor', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][campm_status]" value="0" />
                                        <input onchange="jQuery('#mec_campm_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][campm_status]" <?php if(isset($settings['campm_status']) and $settings['campm_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable Campaign Monitor Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_campm_status_container_toggle" class="<?php if((isset($settings['campm_status']) and !$settings['campm_status']) or !isset($settings['campm_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_campm_api_key"><?php esc_html_e('API Key', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_campm_api_key" name="mec[settings][campm_api_key]" value="<?php echo ((isset($settings['campm_api_key']) and trim($settings['campm_api_key']) != '') ? $settings['campm_api_key'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_campm_list_id"><?php esc_html_e('List ID', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_campm_list_id" name="mec[settings][campm_list_id]" value="<?php echo ((isset($settings['campm_list_id']) and trim($settings['campm_list_id']) != '') ? $settings['campm_list_id'] : ''); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="mailerlite_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('MailerLite', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][mailerlite_status]" value="0" />
                                        <input onchange="jQuery('#mec_mailerlite_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][mailerlite_status]" <?php if(isset($settings['mailerlite_status']) and $settings['mailerlite_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable MailerLite Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_mailerlite_status_container_toggle" class="<?php if((isset($settings['mailerlite_status']) and !$settings['mailerlite_status']) or !isset($settings['mailerlite_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_mailerlite_api_key"><?php esc_html_e('API Key', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_mailerlite_api_key" name="mec[settings][mailerlite_api_key]" value="<?php echo ((isset($settings['mailerlite_api_key']) and trim($settings['mailerlite_api_key']) != '') ? $settings['mailerlite_api_key'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_mailerlite_list_id"><?php esc_html_e('Group ID', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_mailerlite_list_id" name="mec[settings][mailerlite_list_id]" value="<?php echo ((isset($settings['mailerlite_list_id']) and trim($settings['mailerlite_list_id']) != '') ? $settings['mailerlite_list_id'] : ''); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="constantcontact_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('Constant Contact', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][constantcontact_status]" value="0" />
                                        <input onchange="jQuery('#mec_constantcontact_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][constantcontact_status]" <?php if(isset($settings['constantcontact_status']) and $settings['constantcontact_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable constantcontact Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_constantcontact_status_container_toggle" class="<?php if((isset($settings['constantcontact_status']) and !$settings['constantcontact_status']) or !isset($settings['constantcontact_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_constantcontact_api_key"><?php esc_html_e('API Key', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_constantcontact_api_key" name="mec[settings][constantcontact_api_key]" value="<?php echo ((isset($settings['constantcontact_api_key']) and trim($settings['constantcontact_api_key']) != '') ? $settings['constantcontact_api_key'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_constantcontact_access_token"><?php esc_html_e('Access Token', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_constantcontact_access_token" name="mec[settings][constantcontact_access_token]" value="<?php echo ((isset($settings['constantcontact_access_token']) and trim($settings['constantcontact_access_token']) != '') ? $settings['constantcontact_access_token'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <?php
                                    $lists = '';
                                    if(isset($settings['constantcontact_access_token']) and trim($settings['constantcontact_access_token']) != '' and isset($settings['constantcontact_api_key']) and trim($settings['constantcontact_api_key']) != '')
                                    {
                                        $api_key = $settings['constantcontact_api_key'];
                                        $lists  = wp_remote_retrieve_body(wp_remote_get("https://api.constantcontact.com/v2/lists?api_key=".$api_key, array(
                                            'body' => null,
                                            'timeout' => '10',
                                            'redirection' => '10',
                                            'headers' => array('Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $settings['constantcontact_access_token']),
                                        )));
                                    }
                                    ?>

                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_constantcontact_list_id"><?php esc_html_e('Select List', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <select name="mec[settings][constantcontact_list_id]" id="mec_settings_constantcontact_list_id">
                                                <?php
                                                if ( isset($lists) and !empty($lists)) {
                                                    foreach (json_decode($lists) as $list) {
                                                    ?>
                                                        <option <?php if(isset($settings['constantcontact_list_id']) and $list->id == $settings['constantcontact_list_id']) echo 'selected="selected"'; ?> value="<?php echo esc_attr($list->id); ?>"><?php echo esc_html($list->name); ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span class="mec-tooltip">
                                                <div class="box left">
                                                    <h5 class="title"><?php esc_html_e('Select List', 'mec'); ?></h5>
                                                    <div class="content"><p><?php esc_attr_e("Please fill in the API key and Access Token field and save settings. after that, please refresh the page and select a list.", 'mec'); ?></p></div>
                                                </div>
                                                <i title="" class="dashicons-before dashicons-editor-help"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="active_campaign_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('Active Campaign', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][active_campaign_status]" value="0" />
                                        <input onchange="jQuery('#mec_active_campaign_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][active_campaign_status]" <?php if(isset($settings['active_campaign_status']) and $settings['active_campaign_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable Active Campaign Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_active_campaign_status_container_toggle" class="<?php if((isset($settings['active_campaign_status']) and !$settings['active_campaign_status']) or !isset($settings['active_campaign_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_active_campaign_api_url"><?php esc_html_e('API URL', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_active_campaign_api_url" name="mec[settings][active_campaign_api_url]" value="<?php echo ((isset($settings['active_campaign_api_url']) and trim($settings['active_campaign_api_url']) != '') ? $settings['active_campaign_api_url'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_active_campaign_api_key"><?php esc_html_e('API Key', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_active_campaign_api_key" name="mec[settings][active_campaign_api_key]" value="<?php echo ((isset($settings['active_campaign_api_key']) and trim($settings['active_campaign_api_key']) != '') ? $settings['active_campaign_api_key'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_active_campaign_list_id"><?php esc_html_e('List ID', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_active_campaign_list_id" name="mec[settings][active_campaign_list_id]" value="<?php echo ((isset($settings['active_campaign_list_id']) and trim($settings['active_campaign_list_id']) != '') ? $settings['active_campaign_list_id'] : ''); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="aweber_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('AWeber', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][aweber_status]" value="0" />
                                        <input onchange="jQuery('#mec_aweber_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][aweber_status]" <?php if(isset($settings['aweber_status']) and $settings['aweber_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable AWeber Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_aweber_status_container_toggle" class="<?php if((isset($settings['aweber_status']) and !$settings['aweber_status']) or !isset($settings['aweber_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label class="mec-col-2" for="mec_settings_aweber_list_id"><?php esc_html_e('List ID', 'mec'); ?></label>
                                        <div class="mec-col-7">
                                            <input type="text" id="mec_settings_aweber_list_id" name="mec[settings][aweber_list_id]" value="<?php echo ((isset($settings['aweber_list_id']) and trim($settings['aweber_list_id']) != '') ? $settings['aweber_list_id'] : ''); ?>" />
                                        </div>
                                    </div>
                                    <p class="description"><?php echo sprintf(esc_html__("%s plugin should be installed and connected to your AWeber account.", 'mec'), '<a href="https://wordpress.org/plugins/aweber-web-form-widget/" target="_blank">AWeber for WordPress</a>'); ?></p>
                                    <p class="description"><?php echo sprintf(esc_html__('More information about the list ID can be found %s.', 'mec'), '<a href="https://help.aweber.com/hc/en-us/articles/204028426" target="_blank">'.esc_html__('here', 'mec').'</a>'); ?></p>
                                </div>
                            </div>

                            <div id="mailpoet_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('MailPoet', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][mailpoet_status]" value="0" />
                                        <input onchange="jQuery('#mec_mailpoet_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][mailpoet_status]" <?php if(isset($settings['mailpoet_status']) and $settings['mailpoet_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable MailPoet Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_mailpoet_status_container_toggle" class="<?php if((isset($settings['mailpoet_status']) and !$settings['mailpoet_status']) or !isset($settings['mailpoet_status'])) echo 'mec-util-hidden'; ?>">
                                    <?php if(class_exists(\MailPoet\API\API::class)): $mailpoet_api = \MailPoet\API\API::MP('v1'); $mailpoets_lists = $mailpoet_api->getLists(); ?>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_mailpoet_list_id"><?php esc_html_e('List', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <select name="mec[settings][mailpoet_list_id]" id="mec_settings_mailpoet_list_id">
                                                <option value="">-----</option>
                                                <?php foreach($mailpoets_lists as $mailpoets_list): ?>
                                                <option value="<?php echo esc_attr($mailpoets_list['id']); ?>" <?php echo ((isset($settings['mailpoet_list_id']) and trim($settings['mailpoet_list_id']) == $mailpoets_list['id']) ? 'selected="selected"' : ''); ?>><?php echo esc_html($mailpoets_list['name']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <p class="description"><?php echo sprintf(esc_html__("%s plugin should be installed and activated.", 'mec'), '<a href="https://wordpress.org/plugins/mailpoet/" target="_blank">MailPoet</a>'); ?></p>
                                </div>
                            </div>

                            <div id="sendfox_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('Sendfox', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][sendfox_status]" value="0" />
                                        <input onchange="jQuery('#mec_sendfox_status_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][sendfox_status]" <?php if(isset($settings['sendfox_status']) and $settings['sendfox_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable Sendfox Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_sendfox_status_container_toggle" class="<?php if((isset($settings['sendfox_status']) and !$settings['sendfox_status']) or !isset($settings['sendfox_status'])) echo 'mec-util-hidden'; ?>">

                                    <?php if(function_exists('gb_sf4wp_get_lists')): $sendfox_lists = gb_sf4wp_get_lists(); ?>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_sendfox_list_id"><?php esc_html_e('List ID', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <select name="mec[settings][sendfox_list_id]" id="mec_settings_sendfox_list_id">
                                                <?php foreach($sendfox_lists['result']['data'] as $sendfox_list): ?>
                                                <option value="<?php echo esc_attr($sendfox_list['id']); ?>" <?php echo ((isset($settings['sendfox_list_id']) and trim($settings['sendfox_list_id']) == $sendfox_list['id']) ? 'selected="selected"' : ''); ?>><?php echo esc_html($sendfox_list['name']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <p class="description"><?php echo sprintf(esc_html__("%s plugin should be installed and connected to your Sendfox account.", 'mec'), '<a href="https://wordpress.org/plugins/wp-sendfox/" target="_blank">WP Sendfox</a>'); ?></p>
                                </div>
                            </div>

                            <div id="buddy_option" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('BuddyPress', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][bp_status]" value="0" />
                                        <input onchange="jQuery('#mec_bp_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][bp_status]" <?php if(isset($settings['bp_status']) and $settings['bp_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable BuddyPress Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_bp_container_toggle" class="<?php if((isset($settings['bp_status']) and !$settings['bp_status']) or !isset($settings['bp_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <label>
                                            <input type="hidden" name="mec[settings][bp_show_]" value="0" />
                                            <input value="1" type="checkbox" name="mec[settings][bp_attendees_module]" <?php if(isset($settings['bp_attendees_module']) and $settings['bp_attendees_module']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Show "Attendees Module" in event details page', 'mec'); ?>
                                        </label>
                                    </div>
                                    <div class="mec-form-row">
                                        <label class="mec-col-3" for="mec_settings_bp_attendees_module_limit"><?php esc_html_e('Attendee Limit', 'mec'); ?></label>
                                        <div class="mec-col-9">
                                            <input type="text" id="mec_settings_bp_attendees_module_limit" name="mec[settings][bp_attendees_module_limit]" value="<?php echo ((isset($settings['bp_attendees_module_limit']) and trim($settings['bp_attendees_module_limit']) != '') ? $settings['bp_attendees_module_limit'] : '20'); ?>" />
                                        </div>
                                    </div>
                                    <div class="mec-form-row">
                                        <label>
                                            <input type="hidden" name="mec[settings][bp_add_activity]" value="0" />
                                            <input value="1" type="checkbox" name="mec[settings][bp_add_activity]" <?php if(isset($settings['bp_add_activity']) and $settings['bp_add_activity']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Add booking activity to user profile', 'mec'); ?>
                                        </label>
                                    </div>
                                    <div class="mec-form-row">
                                        <label>
                                            <input type="hidden" name="mec[settings][bp_profile_menu]" value="0" />
                                            <input value="1" type="checkbox" name="mec[settings][bp_profile_menu]" <?php if(isset($settings['bp_profile_menu']) and $settings['bp_profile_menu']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Add events menu to user profile', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="learndash_options" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('LearnDash', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][ld_status]" value="0" />
                                        <input value="1" type="checkbox" name="mec[settings][ld_status]" <?php if(isset($settings['ld_status']) and $settings['ld_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable LearnDash Integration', 'mec'); ?>
                                    </label>
                                </div>
                                <p class="description"><?php esc_html_e('LearnDash plugin should be installed and activated.'); ?></p>
                            </div>
                            <div id="pmp_options" class="mec-options-fields">
                                <h4 class="mec-form-subtitle"><?php esc_html_e('PaidMembership Pro', 'mec'); ?></h4>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][pmp_status]" value="0" />
                                        <input value="1" type="checkbox" name="mec[settings][pmp_status]" <?php if(isset($settings['pmp_status']) and $settings['pmp_status']) echo 'checked="checked"'; ?> /> <?php esc_html_e('Enable Event Restriction', 'mec'); ?>
                                    </label>
                                </div>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][pmp_booking_restriction]" value="0" />
                                        <input value="1" type="checkbox" name="mec[settings][pmp_booking_restriction]" <?php if(isset($settings['pmp_booking_restriction']) and $settings['pmp_booking_restriction']) echo 'checked="checked"'; ?> onchange="jQuery('#mec_integration_pmp_booking_restriction').toggleClass('mec-util-hidden');" /> <?php esc_html_e('Enable Booking Restriction', 'mec'); ?>
                                    </label>
                                </div>
                                <div class="mec-form-row <?php if(!isset($settings['pmp_booking_restriction']) or (isset($settings['pmp_booking_restriction']) and !$settings['pmp_booking_restriction'])) echo 'mec-util-hidden'; ?>" id="mec_integration_pmp_booking_restriction">
                                    <?php if(function_exists('pmpro_getAllLevels')): $levels = pmpro_getAllLevels(); $pmp_booking = ((isset($settings['pmp_booking']) and is_array($settings['pmp_booking'])) ? $settings['pmp_booking'] : array()); ?>
                                    <ul>
                                        <?php foreach($levels as $level): $level_options = ((isset($pmp_booking[$level->id]) and is_array($pmp_booking[$level->id])) ? $pmp_booking[$level->id] : array()); ?>
                                        <li>
                                            <h5><?php echo esc_html($level->name); ?></h5>
                                            <ul>
                                                <?php foreach($categories as $category): ?>
                                                <li>
                                                    <label>
                                                        <input value="<?php echo esc_attr($category->term_id); ?>" type="checkbox" name="mec[settings][pmp_booking][<?php echo esc_attr($level->id); ?>][]" <?php if(in_array($category->term_id, $level_options)) echo 'checked="checked"'; ?> /> <?php echo esc_html($category->name); ?>
                                                    </label>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                                <p class="description"><?php esc_html_e('PaidMembership Pro plugin should be installed and activated.'); ?></p>
                            </div>

                        <?php endif; ?>

                        <?php do_action('mec-settings-page-before-form-end', $settings); ?>

                        <div class="mec-options-fields">
                            <?php wp_nonce_field('mec_options_form'); ?>
                            <button style="display: none;" id="mec_integrations_form_button" class="button button-primary mec-button-primary" type="submit"><?php esc_html_e('Save Changes', 'mec'); ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="wns-be-footer">
        <a id="" class="dpr-btn dpr-save-btn"><?php esc_html_e('Save Changes', 'mec'); ?></a>
    </div>

</div>
<?php
$this->getFactory()->params('footer', function()
{
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function()
        {
            jQuery(".dpr-save-btn").on('click', function(event)
            {
                event.preventDefault();
                jQuery("#mec_integrations_form_button").trigger('click');
            });
        });

        var archive_value = jQuery('#mec_settings_default_skin_archive').val();
        function mec_archive_skin_style_changed(archive_value)
        {
            jQuery('.mec-archive-skins').hide();
            jQuery('.mec-archive-skins.mec-archive-'+archive_value+'-skins').show();
        }
        mec_archive_skin_style_changed(archive_value);

        var category_value = jQuery('#mec_settings_default_skin_category').val();
        function mec_category_skin_style_changed(category_value)
        {
            jQuery('.mec-category-skins').hide();
            jQuery('.mec-category-skins.mec-category-'+category_value+'-skins').show();
        }
        mec_category_skin_style_changed(category_value);

        jQuery("#mec_integrations_form").on('submit', function(event)
        {
            event.preventDefault();

            // Add loading Class to the button
            jQuery(".dpr-save-btn").addClass('loading').text("<?php echo esc_js(esc_attr__('Saved', 'mec')); ?>");
            jQuery('<div class="wns-saved-settings"><?php echo esc_js(esc_attr__('Settings Saved!', 'mec')); ?></div>').insertBefore('#wns-be-content');

            if(jQuery(".mec-purchase-verify").text() != '<?php echo esc_js(esc_attr__('Verified', 'mec')); ?>')
            {
                jQuery(".mec-purchase-verify").text("<?php echo esc_js(esc_attr__('Checking ...', 'mec')); ?>");
            }

            var settings = jQuery("#mec_integrations_form").serialize();
            jQuery.ajax(
            {
                type: "POST",
                url: ajaxurl,
                data: "action=mec_save_settings&"+settings,
                beforeSend: function () {
                    jQuery('.wns-be-main').append('<div class="mec-loarder-wrap mec-settings-loader"><div class="mec-loarder"><div></div><div></div><div></div></div></div>');
                },
                success: function(data)
                {
                    // Remove the loading Class to the button
                    setTimeout(function()
                    {
                        jQuery(".dpr-save-btn").removeClass('loading').text("<?php echo esc_js(esc_attr__('Save Changes', 'mec')); ?>");
                        jQuery('.wns-saved-settings').remove();
                        jQuery('.mec-loarder-wrap').remove();
                        if(jQuery(".mec-purchase-verify").text() != '<?php echo esc_js(esc_attr__('Verified', 'mec')); ?>')
                        {
                            jQuery(".mec-purchase-verify").text("<?php echo esc_js(esc_attr__('Please Refresh Page', 'mec')); ?>");
                        }
                    }, 1000);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Remove the loading Class to the button
                    setTimeout(function()
                    {
                        jQuery(".dpr-save-btn").removeClass('loading').text("<?php echo esc_js(esc_attr__('Save Changes', 'mec')); ?>");
                        jQuery('.wns-saved-settings').remove();
                        jQuery('.mec-loarder-wrap').remove();
                    }, 1000);
                }
            });
        });
    </script>
    <?php
});