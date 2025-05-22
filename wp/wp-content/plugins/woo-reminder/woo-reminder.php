<?php
/*
  Plugin Name: WooReminder
  Plugin URI: http://wptowncenter.com/
  Description: WooReminder boosts sales of your WooCommerce Shop by sending reminder email to customers to re-order items/products that they have purchased earlier in your shop.
  Version: 1.6
  Author: WP Town Center
  Author URI: http://wptowncenter.com/
 */

require_once 'inc/ajax-actions.php';

function check_woo_active_nprocess() {
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        ?>
        <div class="error notice">
            <p>WooCommerce should be activated in order to use WooReminder. Please activate WooCommerce and then activate WooReminder.</p>
        </div>

        <?php
    }
}

add_action('admin_notices', 'check_woo_active_nprocess');

class PNQWooReminders {

    function __construct() {
        register_activation_hook(__FILE__, array($this, 'create_req_tables'));
        register_activation_hook(__FILE__, array($this, 'add_woo_remain_default_options'));
        add_action('admin_menu', array($this, 'register_woo_remain_settings_menu'));
        //add_action( 'admin_init', array( $this, 'register_woo_remain_options' ));

        add_action('woocommerce_product_options_general_product_data', array($this, 'add_wr_meta_data_to_wooproduct'));
        add_action('woocommerce_product_after_variable_attributes', array($this, 'add_wr_meta_data_to_wooproduct_variable'), 10, 3);
        add_action('woocommerce_process_product_meta', array($this, 'save_wr_meta_data_to_wooproduct'));
        add_action('woocommerce_save_product_variation', array($this, 'save_wr_meta_data_to_wooproduct_variable'), 10, 2);

        add_action('woocommerce_order_status_completed', array($this, 'add_order_items_to_rmdr_list'));

        //add in order actions
        add_filter('woocommerce_order_actions', array($this, 'add_items_to_rmdr_list_order_actions'));
        add_action('woocommerce_order_action_wrmdr_reorder_notice', array($this, 'send_reorder_reminder_from_order_page'));
    }

    function create_req_tables() {
        global $wpdb;
        $woo_email_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
        $woo_reminder_list = $wpdb->prefix . "woo_reminder_list";
        $charset_collate = $wpdb->get_charset_collate();

        $email_temp_creation = "CREATE TABLE IF NOT EXISTS $woo_email_tempaltes (
				ID BIGINT AUTO_INCREMENT PRIMARY KEY,
				title VARCHAR(290) NOT NULL,
				followup_days INT NOT NULL,
				subject VARCHAR(290) NOT NULL,
				message LONGTEXT NOT NULL,
				status TINYINT(1) NOT NULL DEFAULT '1',
				sent_count bigint(20) NOT NULL DEFAULT '0',
				open_count bigint(20) NOT NULL DEFAULT '0',
				return_count bigint(20) NOT NULL DEFAULT '0',
				UNIQUE(ID)
				) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($email_temp_creation);


        //rmdr_status
        // 1 - active
        // 2 - paused
        // 3 - finished
        $remaider_list_creation = "CREATE TABLE IF NOT EXISTS $woo_reminder_list (
				ID BIGINT AUTO_INCREMENT PRIMARY KEY,
				itime TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
				order_id BIGINT NOT NULL,
				c_name VARCHAR(250),
				email VARCHAR(255),
				prod_id BIGINT NOT NULL,
				prod_name TEXT,
				mail_date datetime,
				mail_sents VARCHAR(255) NOT NULL DEFAULT '[]',
				rmdr_logs TEXT,
				rmdr_roid BIGINT,
				rmdr_status TINYINT(1) DEFAULT '1',
				UNIQUE(ID)
				) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($remaider_list_creation);

        $default_f_temps = get_option('imported_d_f_temps');
        if ($default_f_temps != 1) {
            $defaults_followups = array(array("title" => "First Follow Up",
                    "followup_days" => 5,
                    "subject" => 'Shopping Reminder - Follow Up - [site_title_wrmdr]',
                    "message" => 'Dear [first_name] [last_name],<br>

<p>You are running out of  [product_title]. Please click on the [re_order_url anchor="Re-order"] link to buy it again from our shop.
Please let us know if you have any difficulties in Purchasing. </p>

Happy Shopping... <br>

Team - [site_title_wrmdr]',
                    "status" => 1),
                array("title" => "Follow Up with Coupon",
                    "followup_days" => 10,
                    "subject" => 'Shopping Reminder - Shop with Coupon - [site_title_wrmdr]',
                    "message" => 'Dear [first_name] [last_name],<br>

<p>We have coupons for you this time. You are running out of [product_title]. Please click on the [re_order_url anchor="Re-order"] link to buy it again from our shop.</p>

<p>Use coupon SHOP5 for 5% Discount.

Please let us know if you have any difficulties in Purchasing.</p>

Happy Shopping... <br>

Team - [site_title_wrmdr]',
                    "status" => 0)
            );

            foreach ($defaults_followups as $d_folloups) {
                $result = $wpdb->insert($woo_email_tempaltes, array("title" => $d_folloups['title'],
                    "followup_days" => $d_folloups['followup_days'],
                    "subject" => $d_folloups['subject'],
                    "message" => $d_folloups['message'],
                    "status" => $d_folloups['status']));
            }
            update_option('imported_d_f_temps', 1);
        }
    }

    function register_woo_remain_options() {
        register_setting('wrmdr_general', 'rmdr_order_land_page');
        register_setting('wrmdr_general', 'rmdr_mark_finished');
        register_setting('wrmdr_general', 'rmdr_mailing_interval');
        register_setting('wrmdr_general', 'rmdr_cus_int_hour');
        register_setting('wrmdr_general', 'inherit_woo_mail_styles');

        //register_setting( 'wrmdr_stats', 'wrmdr_main_opencount');
    }

    function add_woo_remain_default_options() {
        add_option('rmdr_order_land_page', 'checkout');
        add_option('rmdr_mark_finished', 'ordered');
        add_option('rmdr_mailing_interval', 'twicedaily');
        add_option('rmdr_cus_int_hour', 8);
        add_option('inherit_woo_mail_styles', "yes");
        add_option('wrmdr_email_heading', "Re-Order Shopping Reminder");

        //wooreminder opt in settings
        add_option('wrmdr_show_optin_checkout', "no");
        add_option('wrmdr_optin_checkout_sec_heading', "Opt In for Reminder Email");
        add_option('wrmdr_optin_checkout_label', "Remind me to order again");
        add_option('wrmdr_optin_default_checked', "yes");


        //default email template
        add_option('wr_email_subject', 'Shopping Reminder !!!! - [site_title_wrmdr]');
        add_option('wr_email_message', 'Dear [first_name] [last_name], <br>

<p>Its looks like the product [product_title] might have exhausted on a regular usage.  Please click on the [re_order_url anchor="Re-order"] link to buy it again from our shop before you run out of [product_title].</p>
<p>Running out of loved consumable products could spoil your mood of the day. Don"t let that happen.</p>

Happy Shopping... <br>

Team - [site_title_wrmdr]



');
    }

    function register_woo_remain_settings_menu() {

        $icon_url = plugins_url('/img/reminder-bell.png', __FILE__);
        $woor_page = add_menu_page('WooReminders', 'WooReminders', 'manage_options', 'woo-reminder', array($this, 'woo_remain_sett'), $icon_url);
        add_action('load-' . $woor_page, array($this, 'load_woor_admin_js_css')); //loading resources only to woor page
    }

    function load_woor_admin_js_css() {
        add_action('admin_enqueue_scripts', array($this, 'woo_remain_admin_scripts'));
    }

    function woo_remain_sett() {

        global $wpdb;
        ?>
        <style>
            .hidden {
                display: none !important;
            }
            .page-loading{
                background: white;
                position: absolute;
                left:0;
                right:10px;
                top:10px;
                bottom:0;
                height:1080px;
                opacity: 0.97;
                border-radius: 15px;
                z-index: 999999;
            }
            .loader-image {
                position: absolute;
                height: 200px;
                width: 400px;
                margin: -100px 0 0 -200px;
                top: 30%;
                left: 50%;
            }


            .spinnercss {
                width: 40px;
                height: 40px;
                background-color: #337ab7;

                margin: 100px auto;
                -webkit-animation: wr-loading 1.2s infinite ease-in-out;
                animation: wr-loading 1.2s infinite ease-in-out;
            }

            @-webkit-keyframes wr-loading {
                0% { -webkit-transform: perspective(120px) }
                50% { -webkit-transform: perspective(120px) rotateY(180deg) }
                100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
            }

            @keyframes wr-loading {
                0% { 
                    transform: perspective(120px) rotateX(0deg) rotateY(0deg);
                    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg) 
                } 50% { 
                    transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
                    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg) 
                } 100% { 
                    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                }
            }

            /* cube spinner */
            .spinner-cube {
                margin: 100px auto;
                width: 40px;
                height: 40px;
                position: fixed;
                top:40%;
                left:50%;
                z-index: 999999;
                display: none;
            }

            .cube1, .cube2 {
                background-color: #337ab7;
                width: 15px;
                height: 15px;
                position: absolute;
                top: 0;
                left: 0;

                -webkit-animation: sk-cubemove 1.8s infinite ease-in-out;
                animation: sk-cubemove 1.8s infinite ease-in-out;
            }

            .cube2 {
                -webkit-animation-delay: -0.9s;
                animation-delay: -0.9s;
            }

            @-webkit-keyframes sk-cubemove {
                25% { -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5) }
                50% { -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg) }
                75% { -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5) }
                100% { -webkit-transform: rotate(-360deg) }
            }

            @keyframes sk-cubemove {
                25% { 
                    transform: translateX(42px) rotate(-90deg) scale(0.5);
                    -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5);
                } 50% { 
                    transform: translateX(42px) translateY(42px) rotate(-179deg);
                    -webkit-transform: translateX(42px) translateY(42px) rotate(-179deg);
                } 50.1% { 
                    transform: translateX(42px) translateY(42px) rotate(-180deg);
                    -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg);
                } 75% { 
                    transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
                    -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
                } 100% { 
                    transform: rotate(-360deg);
                    -webkit-transform: rotate(-360deg);
                }
            }
        </style>
        <div class="page-loading">
            <div class="loader-image">
                <div class="spinnercss"></div>
            </div>
        </div>
        <?php
        global $wpdb;
        $wr_list_table = $wpdb->prefix . "woo_reminder_list";
        $select_sql = "SELECT r.ID,r.order_id,r.c_name,r.email,r.prod_id,r.prod_name,r.mail_date,r.mail_sents,r.rmdr_logs,r.rmdr_status FROM $wr_list_table AS r ORDER BY r.ID";

        $sel_result = $wpdb->get_results($select_sql);
        $formated_results = array();
        $date_format = get_option('date_format');
        foreach ($sel_result as $key => $res) {
            $rmdr_logs = json_decode($res->rmdr_logs, true);
            $sel_result[$key]->rmdr_logs = '<div style="margin:15px;"><ul><li>' . implode("</li><li>", $rmdr_logs) . '</li></ul></div>';
            $sel_result[$key]->rmdr_status = maybe_unserialize($res->rmdr_status);
        }
        ?>
        <script type="text/javascript">


            function browserSupportsCSSProperty(propertyName) {
                var elm = document.createElement('div');
                propertyName = propertyName.toLowerCase();

                if (elm.style[propertyName] != undefined)
                    return true;

                var propertyNameCapital = propertyName.charAt(0).toUpperCase() + propertyName.substr(1),
                        domPrefixes = 'Webkit Moz ms O'.split(' ');

                for (var i = 0; i < domPrefixes.length; i++) {
                    if (elm.style[domPrefixes[i] + propertyNameCapital] != undefined)
                        return true;
                }

                return false;
            }
            if (!browserSupportsCSSProperty('animation')) {
                jQuery('.loader-image').html('<img alt="Loading..." src="<?php echo admin_url() . 'images/spinner-2x.gif'; ?>" />');
            }

            var wooReminder = angular.module("wooReminder", ["ngTable", "ngRoute"]).config(function ($routeProvider, $locationProvider) {
                //$locationProvider.html5Mode(true);
                $routeProvider.when("/reminders", {
                    templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=rlist",
                    controller: 'rlist'
                });
                $routeProvider.when("/email", {
                    //templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=edi"
                });
                $routeProvider.when("/followup", {
                    //templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=edit"
                    controller: 'femailCtl'
                });
                $routeProvider.when("/followup/:id", {
                    //templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=edit"
                    controller: 'femailCtl'
                });
                $routeProvider.when("/settings", {
                    //templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=wooremset"
                    controller: 'genSetCtrl'
                });
                $routeProvider.when("/infos", {
                    //templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=wooremset"
                    controller: 'infosCtrl'
                });
                $routeProvider.otherwise({
                    templateUrl: "<?php echo admin_url(); ?>admin-ajax.php?action=rlist"
                });
            });
            //loading symbol
            wooReminder.run(function ($rootScope, $http) {

                $rootScope.$on('$routeChangeStart',
                        function (event, toState, toParams, fromState, fromParams) {
                            jQuery(".page-loading").removeClass("hidden");
                        });

                $rootScope.$on('$routeChangeSuccess',
                        function (event, toState, toParams, fromState, fromParams) {
                            jQuery(".page-loading").addClass("hidden");
                        });



                $rootScope.reminderList = <?php echo json_encode($sel_result, JSON_NUMERIC_CHECK); ?>;
            });

            wooReminder.directive('wrchartjs', function () {
                return function (scope, elem, attrs) {
                    var data = scope[attrs["wrchartjs"]];
                    var options = attrs["type"];
                    var chartType = attrs["type"];
                    ctx = elem[0].getContext("2d");
                    window.myBar2 = new Chart(ctx, {
                        type: chartType,
                        data: data,
                        options: options
                    });
                    //scope.$watch(scope[attrs["wrchartjs"]];,function(){
                    //	window.myBar2 = new Chart(ctx, {
                    //    type: chartType,
                    //    data: data,
                    //    options: options
                    //});
                    //});
                }
            });


            //Main controller
            wooReminder.controller('wrController', function ($scope, $location, NgTableParams, $http, $routeParams) {

                $scope.isActive = function (selectedView) {
                    var isActive = false;
                    if (selectedView == $location.path()) {
                        isActive = true;
                    } else if (selectedView == '/reminders' && $location.path() == '') {
                        isActive = true;
                    } else if (($location.path().indexOf('followup') > -1) && (selectedView.indexOf('followup') > -1)) {
                        isActive = true;
                    }
                    return isActive;
                }

                $scope.e_subject = '<?php echo addcslashes(get_option('wr_email_subject'),"\.'"); ?>';

                $scope.serializeData = function (data) {

                    if (!angular.isObject(data)) {
                        return((data == null) ? "" : data.toString());
                    }
                    var buffer = [];

                    for (var name in data) {
                        if (!data.hasOwnProperty(name)) {
                            continue;
                        }
                        var value = data[ name ];
                        buffer.push(
                                encodeURIComponent(name) +
                                "=" +
                                encodeURIComponent((value == null) ? "" : value)
                                );
                    }
                }

                $scope.saveEmailTemp = function () {
                    tinyMCE.triggerSave();
                    document.getElementById('saveEmailTemp').disabled = true;
                    jQuery('.spinner-cube').show();
                    if (jQuery("#wp-email_content-wrap").hasClass("tmce-active")) {
                        var msg = tinyMCE.get('email_content').getContent();
                    } else {
                        var msg = jQuery('#email_content').val();
                    }
                    var sub = $scope.e_subject;
                    var data = {
                        action: 'etemp',
                        message: msg,
                        subject: sub
                    };

                    $http({
                        method: 'POST',
                        url: ajaxurl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        transformRequest: function (obj) {
                            var str = [];
                            for (var p in obj)
                                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                            return str.join("&");
                        },
                        data: data
                    }).success(function (data) {
                        document.getElementById('saveEmailTemp').disabled = false;
                        jQuery('.spinner-cube').hide();

                        $scope.addToNotify("Email Template Saved", "success");
                        //var rdata = angular.fromJson(data);

                    });
                }


                $scope.addToNotify = function (message, cls) {
                    var new_elem = angular.element('<div class="alert alert-' + cls + '">' + message + '</div>');
                    angular.element(document.querySelector('#notifications')).append(new_elem);
                    window.setTimeout(function () {
                        new_elem.remove();
                    }, 2500);

                }


            });


            //reminder list controller
            angular.module("wooReminder").controller('rlist', function ($scope, NgTableParams, $http, $rootScope, $q) {

                var reminderList = $rootScope.reminderList;
                if (typeof reminderList !== 'undefined' && reminderList.length > 0) {
                    $scope.tableParams = new NgTableParams({}, {dataset: $rootScope.reminderList});
                } else {
                    $scope.noData = true;
                }

                $scope.del = function (ID, $event) {

                    var deleteRmdr = confirm('Are you sure, you want to delete reminder?');
                    if (deleteRmdr) {
                        var curDelBTN = $event.currentTarget;
                        $event.currentTarget.disabled = true;
                        var index = $scope.checkInArrayOb(reminderList, ID, 'ID');
                        var ajaxData = {
                            action: 'rmdr_delete',
                            ID: ID
                        };

                        jQuery('.spinner-cube').show();
                        $http({
                            method: 'POST',
                            url: ajaxurl,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            transformRequest: function (obj) {
                                var str = [];
                                for (var p in obj)
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                return str.join("&");
                            },
                            data: ajaxData
                        }).success(function (dataResponse) {

                            var index = $scope.checkInArrayOb(reminderList, ID, 'ID');

                            $rootScope.reminderList.splice(index, 1);
                            $scope.tableParams.reload();
                            var data = {res: dataResponse, index: index, btn: curDelBTN}

                            jQuery('.spinner-cube').hide();
                            $scope.$parent.addToNotify("Reminder Deleted!", "success");
                        }).error(function () {
                            jQuery('.spinner-cube').hide();
                            //alert('Something Went Wrong, Try Later');
                            $scope.$parent.addToNotify("Something Went Wrong, Try Later", "danger");
                            curDelBTN.disabled = false;
                            //q.reject(curDelBTN);
                        });

                    }
                }

                $scope.log = function (input, ID) {

                    var json = angular.fromJson(input);
                    angular.forEach(json, function (value, key) {
                        input = input + value + "<br>";
                    });
                    jQuery('#log_' + ID).html(input);
                }

                $scope.rmSearchChange = function () {

                    $scope.tableParams.filter({$: $scope.rmSearch});
                }

                $scope.checkInArrayOb = function (searchArray, searchTerm, property) {

                    for (var i = 0, len = searchArray.length; i < len; i++) {
                        if (searchArray[i][property] === searchTerm)
                            return i;
                    }
                    return -1;

                }

            });
            angular.module("wooReminder").filter('dateToWR', function () {
                return function (input) {

                    var date = new Date(input);
                    input = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                    return input;
                };
            });
            angular.module("wooReminder").filter('fromJS', function () {
                return function (input) {

                    var json = angular.fromJson(input);
                    angular.forEach(json, function (value, key) {
                        input = input + value + "<br>";
                    });

                    return input;
                };
            });

            //follo up email controller
            angular.module("wooReminder").controller('femailCtl', function ($scope, $location, $routeParams, $http, $filter) {
        <?php
        $woo_femail_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
        $select_sql = "SELECT * FROM $woo_femail_tempaltes";
        $result = $wpdb->get_results($select_sql);
        ?>
        <?php if (!empty($result)) { ?>
                    $scope.followUps = <?php echo json_encode($result); ?>;
        <?php } else { ?>
                    $scope.noFollowUps = true;
        <?php } ?>

                $scope.temp_status_options = {"Enabled": "1",
                    "Disabled": "0",
                };
                $scope.loadFTempEditor = function (id) {
                    if (!$scope.loadTinyMceTimer) {
                        setTimeout(function () {
                            $scope.loadTinyMceTimer = true;
                        }, 500);
                    }
                    if (id == 'addftemp') {
                        //just flash the datas and make it new
                        $scope.currentFTempId = 'new';
                        $scope.fe_title = '';
                        $scope.fe_subject = '';
                        $scope.e_followup_days = 10;
                        $scope.fe_temp_status = 1;
                        if ($scope.loadTinyMceTimer) {
                            if (jQuery("#wp-femail_content-wrap").hasClass("tmce-active")) {
                                tinyMCE.get('femail_content').setContent('');
                            } else {
                                jQuery('#femail_content').val('');
                            }
                        } else {
                            setTimeout(function () {
                                if (jQuery("#wp-femail_content-wrap").hasClass("tmce-active")) {
                                    tinyMCE.get('femail_content').setContent('');
                                } else {
                                    jQuery('#femail_content').val('');
                                }
                            }, 500);
                        }

                    } else {
                        //load the editor from data 
                        var currentItem = $filter('filter')($scope.followUps, {'ID': id})
                        $scope.currentFTempId = currentItem[0].ID;
                        $scope.fe_title = currentItem[0].title;
                        $scope.fe_subject = currentItem[0].subject;
                        $scope.e_followup_days = Number(currentItem[0].followup_days);
                        $scope.fe_temp_status = currentItem[0].status;
                        if ($scope.loadTinyMceTimer) {
                            if (jQuery("#wp-femail_content-wrap").hasClass("tmce-active")) {
                                tinyMCE.get('femail_content').setContent(currentItem[0].message);
                            } else {
                                jQuery('#femail_content').val(currentItem[0].message);
                            }

                        } else {
                            setTimeout(function () {
                                //tinyMCE.get('femail_content').setContent(currentItem[0].message);
                                if (jQuery("#wp-femail_content-wrap").hasClass("tmce-active")) {
                                    tinyMCE.get('femail_content').setContent(currentItem[0].message);
                                } else {
                                    jQuery('#femail_content').val(currentItem[0].message);
                                }
                            }, 500);
                        }

                    }
                }
                $scope.saveFEmailTemp = function () {

                    document.getElementById('saveFEmailTemp').disabled = true;
                    jQuery('.spinner-cube').show();
                    if (jQuery("#wp-femail_content-wrap").hasClass("tmce-active")) {
                        var fMsg = tinyMCE.get('femail_content').getContent();
                    } else {
                        var fMsg = jQuery('#femail_content').val();
                    }
                    var data = {
                        action: 'f_etemp_save',
                        temp_act: $scope.currentFTempId,
                        title: $scope.fe_title,
                        message: fMsg,
                        subject: $scope.fe_subject,
                        followup: $scope.e_followup_days,
                        status: $scope.fe_temp_status
                    };
                    $http({
                        method: 'POST',
                        url: ajaxurl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        transformRequest: function (obj) {
                            var str = [];
                            for (var p in obj)
                                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                            return str.join("&");
                        },
                        data: data
                    }).success(function (data) {
                        $scope.refreshFollowUp();
                        document.getElementById('saveFEmailTemp').disabled = false;
                        jQuery('.spinner-cube').hide();
                        $scope.$parent.addToNotify('Template Saved', 'success');
                        var rdata = angular.fromJson(data);
                        //tinyMCE.get('email_content').setContent(rdata.msg+"addit");
                    });
                }


                $scope.delFTemp = function (index, $event) {
                    var deleteFTemp = confirm('Are you sure, you want to delete?');
                    if (deleteFTemp) {
                        jQuery('.spinner-cube').show();
                        var curDelBTN = $event.currentTarget;
                        curDelBTN.disabled = true;
                        var data = {
                            action: 'f_etemp_del',
                            temp_id: $scope.followUps[index].ID,
                        };
                        $http({
                            method: 'POST',
                            url: ajaxurl,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            transformRequest: function (obj) {
                                var str = [];
                                for (var p in obj)
                                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                                return str.join("&");
                            },
                            data: data
                        }).success(function (data) {
                            jQuery('.spinner-cube').hide();
                            $scope.refreshFollowUp();
                            var rdata = angular.fromJson(data);
                            //tinyMCE.get('email_content').setContent(rdata.msg+"addit");
                            $scope.$parent.addToNotify('Follow Up Template Deleted', 'success');
                        }).error(function () {
                            jQuery('.spinner-cube').hide();
                            $scope.$parent.addToNotify('Something Went Wrong, Try Later', 'danger');
                            curDelBTN.disabled = false;
                        });
                    }

                }

                $scope.refreshFollowUp = function () {
                    $http.get("<?php echo admin_url(); ?>admin-ajax.php?action=f_etemp_list").success(function (data) {
                        if (data) {
                            $scope.followUps = data;
                        }
                    })
                            .error(function (error) {
                                //error 
                            });
                }

                $scope.$on("$routeChangeSuccess", function () {

                    if ($routeParams.id == "addftemp") {
                        $scope.currentEditor = 'new';
                        $scope.followTempEdit = true;
                        $scope.loadFTempEditor($routeParams.id);
                    } else if ($routeParams.id) {
                        $scope.followTempEdit = true;
                        $scope.loadFTempEditor($routeParams.id);
                    } else {
                        $scope.followTempEdit = false;
                    }
                    if ($location.path() == '/followup') {
                        $scope.refreshFollowUp();
                    }
                });
            });


            //general settings controller
            angular.module('wooReminder').controller('genSetCtrl', function ($scope, $http) {
                //settings page
                $scope.generalSettings = {landing_page: '<?php echo get_option('rmdr_order_land_page'); ?>',
                    mark_finished: '<?php echo get_option('rmdr_mark_finished'); ?>',
                    mailing_interval: '<?php echo get_option('rmdr_mailing_interval'); ?>',
                    cus_int_hour: '<?php echo get_option('rmdr_cus_int_hour'); ?>',
                    inherit_woo_mail_styles: '<?php echo get_option('inherit_woo_mail_styles'); ?>',
                    wrmdr_email_heading: '<?php echo addcslashes(get_option('wrmdr_email_heading'),"\.'"); ?>',
                    wrmdr_show_optin_checkout: '<?php echo get_option('wrmdr_show_optin_checkout'); ?>',
                    wrmdr_optin_checkout_sec_heading: '<?php echo addcslashes(get_option('wrmdr_optin_checkout_sec_heading'),"\.'"); ?>',
                    wrmdr_optin_checkout_label: '<?php echo get_option('wrmdr_optin_checkout_label'); ?>',
                    wrmdr_optin_default_checked: '<?php echo get_option('wrmdr_optin_default_checked'); ?>',
                };

                $scope.mailing_interval_options = {"Hourly": "hourly",
                    "Twice daily": "twicedaily",
                    "Daily": "daily",
                    "Custom Interval": "custom"};
                $scope.wrmdr_show_optin_checkout_options = {"Show": "yes",
                    "Do not show": "no"};
                $scope.wrmdr_optin_default_checked_options = {"Checked": "yes",
                    "Un Checked": "no"};

                $scope.saveGeneralSettings = function () {
                    document.getElementById('gen_set_save').disabled = true;
                    jQuery('.spinner-cube').show();
                    var data = {
                        action: 'wrmdr_save_gensettings',
                        landing_page: $scope.generalSettings.landing_page,
                        mark_finished: $scope.generalSettings.mark_finished,
                        mailing_interval: $scope.generalSettings.mailing_interval,
                        cus_int_hour: $scope.generalSettings.cus_int_hour,
                        inherit_woo_mail_styles: $scope.generalSettings.inherit_woo_mail_styles,
                        wrmdr_email_heading: $scope.generalSettings.wrmdr_email_heading,
                        wrmdr_show_optin_checkout: $scope.generalSettings.wrmdr_show_optin_checkout,
                        wrmdr_optin_checkout_sec_heading: $scope.generalSettings.wrmdr_optin_checkout_sec_heading,
                        wrmdr_optin_checkout_label: $scope.generalSettings.wrmdr_optin_checkout_label,
                        wrmdr_optin_default_checked: $scope.generalSettings.wrmdr_optin_default_checked
                    }
                    $http({
                        method: 'POST',
                        url: ajaxurl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        transformRequest: function (obj) {
                            var str = [];
                            for (var p in obj)
                                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                            return str.join("&");
                        },
                        data: data
                    }).success(function (data) {
                        document.getElementById('gen_set_save').disabled = false;
                        jQuery('.spinner-cube').hide();
                        $scope.$parent.addToNotify('Settings Saved', 'success');
                        //alert('saved');

                    });
                }
                $scope.sendTestEmail = function () {

                    document.getElementById('sendTestEmail').disabled = true;
                    jQuery('.spinner-cube').show();

                    var toEmail = this.testToEmail;
                    var data = {
                        action: 'wrmdr_test_email',
                        toEmail: toEmail
                    };

                    $http({
                        method: 'POST',
                        url: ajaxurl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        transformRequest: function (obj) {
                            var str = [];
                            for (var p in obj)
                                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                            return str.join("&");
                        },
                        data: data
                    }).success(function (data) {

                        document.getElementById('sendTestEmail').disabled = false;
                        jQuery('.spinner-cube').hide();
                        if (data == 'triggered') {
                            $scope.$parent.addToNotify('Email Triggered, but It doesn\'t meant that email is delivered.<br> There are multiple factors where an email can\'t be delivered. If the email is not received please check with your hosting.', 'success');
                        } else if (data == 'noemail') {
                            $scope.$parent.addToNotify('No To Email ID given', 'warning');
                        } else if (data == 'nottriggered') {
                            $scope.$parent.addToNotify('Problem In mail trigger, Email couldn\'t be sent.', 'danger');
                        } else {
                            $scope.$parent.addToNotify('Somehting went wrong, Please Try later', 'danger');
                        }

                    });

                }

            });
        <?php
        $woo_email_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
        $email_temp_counts = $wpdb->get_results("SELECT ID,title,sent_count,open_count,return_count FROM $woo_email_tempaltes");

        $sent_count = array();
        $open_count = array();
        $return_count = array();
        $f_temp_name = array();

//pull main template infos
        $f_temp_name[] = "Main Template";
        $main_sent = get_option('wrmdr_main_sent_count');
        $main_open = get_option('wrmdr_main_open_count');
        $main_return = get_option('wrmdr_main_return_count');
        $sent_count[] = ($main_sent) ? $main_sent : 0;
        $open_count[] = ($main_open) ? $main_open : 0;
        $return_count[] = ($main_return) ? $main_return : 0;
        $total_sent_count = $main_sent; //add the below follow ups
        $total_open_count = $main_open;
        $total_return_count = $main_return;
        if (!empty($email_temp_counts)) {
            foreach ($email_temp_counts as $email_count) {
                $f_temp_name[] = $email_count->title . " ( #" . $email_count->ID . " )";
                $sent_count[] = $email_count->sent_count;
                $open_count[] = $email_count->open_count;
                $return_count[] = $email_count->return_count;

                $total_sent_count = $total_sent_count + $email_count->sent_count;
                $total_open_count = $total_open_count + $email_count->open_count;
                $total_return_count = $total_return_count + $email_count->return_count;
            }
        }
        $postmeta = $wpdb->prefix . "postmeta";
        $post_table = $wpdb->prefix . "posts";
        $total_re_order = $wpdb->get_results("SELECT count(DISTINCT meta_value) AS total_reorder FROM $postmeta WHERE meta_key = 'reorder_from_wrmdr'");
        if (!empty($total_re_order)) {
            $total_re_order_count = array_shift($total_re_order)->total_reorder;
        } else {
            $total_re_order_count = 0;
        }
        $re_order_revenue = $wpdb->get_results("SELECT SUM(meta_value) AS re_order_revenue FROM $postmeta WHERE post_id IN (SELECT post_id FROM $postmeta WHERE meta_key='reorder_from_wrmdr') AND meta_key = '_order_total'");
        if (!empty($re_order_revenue)) {
            $re_order_revenue = array_shift($re_order_revenue)->re_order_revenue;
        } else {
            $re_order_revenue = 0;
        }

        $total_woo_order = $wpdb->get_results("SELECT count(*) AS total_woo_order FROM $post_table WHERE post_type = 'shop_order'");
        if (!empty($total_woo_order)) {
            $total_woo_order = array_shift($total_woo_order)->total_woo_order;
        } else {
            $total_woo_order = 0;
        }
        if ($total_woo_order == 0) {
            $rmdr_sales_percent = 0;
        } else {
            $rmdr_sales_percent = ($total_re_order_count / $total_woo_order) * 100;
            $rmdr_sales_percent = round($rmdr_sales_percent, 2); //limit to only two decimal digits	
        }
        global $woocommerce;
        $woo_currency_symbol = get_woocommerce_currency_symbol();
        $total_unsubscribed_count = get_option('wrmdr_unsubscribe_count');
        ?>
            //info controller
            angular.module('wooReminder').controller('infosCtrl', function ($scope, $http) {

                $scope.indvidualMTemp = {
                    labels: <?php echo json_encode($f_temp_name); ?>,
                    datasets: [
                        {
                            label: "Sent",
                            backgroundColor: "rgba(33, 163, 250, 0.38)",
                            borderColor: 'rgba(33,163,250,1)',
                            borderWidth: 1,
                            data: <?php echo json_encode($sent_count); ?>
                        },
                        {
                            label: "Open",
                            backgroundColor: "rgba(242,175,0, 0.38)",
                            borderColor: 'rgba(242,175,0,1)',
                            borderWidth: 1,
                            data: <?php echo json_encode($open_count); ?>
                        },
                        {
                            label: "Returned",
                            backgroundColor: "rgba(78,196,127, 0.38)",
                            borderColor: 'rgba(78,196,127,1)',
                            borderWidth: 1,
                            data: <?php echo json_encode($return_count); ?>
                        }

                    ]
                };

                $scope.allMtemp = {
                    labels: [
                        "Total Sent",
                        "Total Opened",
                        "Total Returned",
                        "Total Re-ordered",
                        "Total Unsubscribed"
                    ],
                    datasets: [
                        {
                            data: [<?php echo $total_sent_count . "," . $total_open_count . "," . $total_return_count . "," . $total_re_order_count . "," . $total_unsubscribed_count; ?>],
                            backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#45C473",
                                "#7f0000"
                            ],
                            hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#45C473",
                                "#7f0000"
                            ]
                        }]
                };
            });


        </script>
        <style type="text/css">
            .ng-table-filters th.filter{float:none !important;}
            body{
                background-color: transparent !important;
            }
            .main-bg{
                background-color: #fff;
                padding:20px;
                border-radius: 10px;
                min-height: 650px;
            }
            .nav-tabs > li > a:focus {
                box-shadow: none !important;
            }
            .mt-20{
                margin-top:20px;
            }

        </style>
        <div class="wrap">
            <div class="main-bg">
                <h1>Woo Reminder</h1>
                <div ng-app="wooReminder" ng-controller="wrController">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        <li role="presentation" ng-class="{ active: isActive('/reminders')}"><a href="#/reminders">Reminder List  <span class="badge">{{reminderList.length}}</span></a></li>
                        <li role="presentation" ng-class="{ active: isActive('/email')}"><a href="#/email">Email Template</a></li>
                        <li role="presentation" ng-class="{ active: isActive('/followup')}"><a href="#/followup">Follow Up Email</a></li>
                        <li role="presentation" ng-class="{ active: isActive('/settings')}"><a href="#/settings">Settings</a></li>
                        <li role="presentation" ng-class="{ active: isActive('/infos')}"><a href="#/infos">Stats and Infos</a></li>
                    </ul>
                    <div class="spinner-cube">
                        <div class="cube1"></div>
                        <div class="cube2"></div>
                    </div>

                    <div ng-show="isActive('/email')" id="default_email">
                        <div class="row">
                            <div class="col-mg-8 col-lg-8" style="min-height: 650px !important;">

                                <label>Email Subject</label>
                                <input type="text" class="form-control" name="email_subject" ng-model="e_subject">


                                <label>Email Message</label>
                                <?php $content = get_option('wr_email_message'); ?>
                                <?php wp_editor($content, 'email_content', array('editor_height' => 450)); ?>

                                <button ng-click="saveEmailTemp()" id="saveEmailTemp" class="btn btn-primary mt-20"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                            </div>
                        </div>
                    </div>

                    <div ng-show="isActive('/followup')" ng-controller="femailCtl" id="followup">
                        <a class="btn btn-default" href="<?php echo admin_url(); ?>admin.php?page=woo-reminder#/followup/addftemp" ng-hide="followTempEdit">Add New</a>
                        <a class="btn btn-default" href="<?php echo admin_url(); ?>admin.php?page=woo-reminder#/followup/" ng-show="followTempEdit"><span class="glyphicon glyphicon-chevron-left"></span> Back to FollowUp List</a>
                        <div class="row" ng-hide="followTempEdit">
                            <div class="col-mg-12 col-lg-12">
                                <table class="table table-striped" ng-hide="noFollowUps">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Subject</th>
                                            <th>Follow UP Day</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in followUps">
                                            <td>{{item.ID}}</td>
                                            <td>{{item.title}}</td>
                                            <td>{{item.subject}}</td>
                                            <td>{{item.followup_days}}</td>
                                            <td><span class="label {{(item.status == 1) ? 'label-success' : 'label-danger'}}" >{{(item.status == 1) ? 'Enabled' : 'Disabled'}}</span></td>
                                            <td><a class="btn btn-default" href="<?php echo admin_url(); ?>admin.php?page=woo-reminder#/followup/{{item.ID}}"><span class="glyphicon glyphicon-edit"></span> EDIT</a>  
                                                <button type="button" class="btn btn-danger" ng-click="delFTemp($index, $event)"><span class="glyphicon glyphicon-trash"></span> DELETE</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div ng-show="noFollowUps" class="alert alert-warning">
                                    No Follow Up Email Templates
                                </div>
                            </div>
                        </div>
                        <div class="row" ng-show="followTempEdit">
                            <div class="col-mg-8 col-lg-8" style="min-height:450px;margin-top:10px;">
                                <label>Template Title</label>
                                <input type="text" class="form-control" name="femail_title" ng-model="fe_title">			
                                <label>Email Subject</label>
                                <input type="text" class="form-control" name="femail_subject" ng-model="fe_subject">
                                <label>Follow UP days after default email reminder</label>
                                <input type="number" class="form-control" ng-model="e_followup_days">
                                <label>Email Message</label>
                                <?php wp_editor('', 'femail_content', array('editor_height' => 450)); ?>

                                <div class="select mt-20">
                                    <label>Template Status</label>
                                    <select ng-model="fe_temp_status" name="fe_temp_status" ng-options="x for (x,y) in temp_status_options">
                                    </select>

                                </div>

                                <a class="btn btn-default mt-20" href="<?php echo admin_url(); ?>admin.php?page=woo-reminder#/followup/" ng-show="followTempEdit"><span class="glyphicon glyphicon-chevron-left"></span> Back to FollowUp List</a>
                                <button ng-click="saveFEmailTemp()" id="saveFEmailTemp" style="margin-left:10px;" class="btn btn-primary mt-20"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</button>
                            </div>
                        </div>
                    </div>

                    <div id="settings-container" ng-show="isActive('/settings')" ng-controller="genSetCtrl">
                        <div>
                            <form name="generalSettingsForm" ng-submit="saveGeneralSettings()" class="form-horizontal">
                                <h3>General Settings</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Mark reminder as Finished When</label>
                                    <div class="col-md-9">
                                        <div class="radio"><input type="radio" ng-model="generalSettings.mark_finished" value="returned"  name="mark_finished" required> User returned to website from mail.</div>
                                        <div class="radio"><input type="radio" ng-model="generalSettings.mark_finished" value="ordered"  name="mark_finished" required> Only When User successfully made an order</div>
                                    </div>	
                                </div>

                                <div class="form-group">	

                                    <label class="control-label col-md-3">Re-Order Link URL should land to</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <input type="radio" ng-model="generalSettings.landing_page" value="cart"  name="landing_page" required>Cart Page
                                        </div>
                                        <div class="radio">
                                            <input type="radio" ng-model="generalSettings.landing_page" value="checkout"  name="landing_page" required>Checkout Page
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Mail Campaign Interval<span style="font-size:9px;">(CRON)</span></label>
                                    <div class="col-md-9" style="padding-left:0px;">
                                        <div class="select">
                                            <select ng-model="generalSettings.mailing_interval" name="mailing_interval" ng-options="x for (x,y) in mailing_interval_options">
                                            </select>

                                        </div>
                                        <div ng-show="generalSettings.mailing_interval == 'custom'" style="margin-top:10px;">
                                            <input type="text" name="cus_int_hour"  ng-model="generalSettings.cus_int_hour" > Hour(Enter in number eg: 8 )<br>

                                        </div>

                                    </div>	
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Use / Inherit WooCommerce Mail Template Style</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <input type="radio" ng-model="generalSettings.inherit_woo_mail_styles" value="yes"  name="inherit_woo_mail_styles" required>Yes
                                        </div>
                                        <div ng-show="generalSettings.inherit_woo_mail_styles == 'yes'" style="margin-top:10px;">
                                            <input type="text" name="wrmdr_email_heading"  ng-model="generalSettings.wrmdr_email_heading" > Email Heading <span style="font-size:10px;">(Woocommerce Template uses a heading)</span><br>

                                        </div>
                                        <div class="radio">
                                            <input type="radio" ng-model="generalSettings.inherit_woo_mail_styles" value="no"  name="inherit_woo_mail_styles" required>No
                                        </div>


                                    </div>	
                                </div>
                                <hr>
                                <h3>Reminder Opt In Settings <small>- You can show customer to opt in or not to reminder email in checkout page.</small></h3> 
                                <div class="form-group">
                                    <label class="control-label col-md-3">Show Reminder Opt-In on Checkout</label>
                                    <div class="col-md-9">
                                        <div class="select">
                                            <select ng-model="generalSettings.wrmdr_show_optin_checkout" name="wrmdr_show_optin_checkout" ng-options="x for (x,y) in wrmdr_show_optin_checkout_options">
                                            </select>

                                            <div ng-show="generalSettings.wrmdr_show_optin_checkout == 'no'" style="margin-top:10px;">
                                                <small> When not shown reminder is enabled for customer by default</small>

                                            </div>
                                            <div ng-show="generalSettings.wrmdr_show_optin_checkout == 'yes'" class="text">
                                                <input style="margin-top:10px;" type="text" name="wrmdr_optin_checkout_sec_heading"   ng-model="generalSettings.wrmdr_optin_checkout_sec_heading" >Opt-In/Out Section Heading<br>
                                                <input style="margin-top:10px;" type="text" name="wrmdr_optin_checkout_label"   ng-model="generalSettings.wrmdr_optin_checkout_label" >Opt-In/Out Label<br>
                                                <select style="margin-top:10px;" ng-model="generalSettings.wrmdr_optin_default_checked" name="wrmdr_optin_default_checked" ng-options="x for (x,y) in wrmdr_optin_default_checked_options">
                                                </select>Opt In checkbox
                                            </div> 



                                        </div>
                                    </div>	
                                </div>








                                <div class="col-md-offset-3 col-md-9">
                                    <button  type="submit" id="gen_set_save" value="save" ng-disabled="generalSettingsForm.$invalid" class="btn btn-primary mt-20">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save </button>
                                </div>


                            </form>
                        </div>

                        <hr>
                        <h3>Debug</h3>
                        <div>
                            <div class="row">
                                <div class="col-mg-8 col-lg-8">
                                    <form name="testEmail">
                                        <label class="control-label col-md-3">Email ID to send Test Email</label>
                                        <div class="col-md-9">
                                            <input type="email" ng-model="testToEmail" name="toEmail" required>
                                            <button ng-click="sendTestEmail()" ng-disabled="testEmail.$invalid" id="sendTestEmail" class="btn btn-primary">Trigger Test Email <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div ng-controller="infosCtrl" ng-if="isActive('/infos')">

                        <div class='row'>
                            <div class='col-md-12'>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Individual Mail Template's Info</div>
                                    <div class="panel-body">
                                        <canvas wrchartjs="indvidualMTemp" id="ind-m-temp" options="options" type="bar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Overall Info</div>
                                    <div class="panel-body">
                                        <canvas wrchartjs="allMtemp" id="all-m-temp" options="options" type="doughnut"></canvas>
                                    </div>
                                </div></div>
                            <div class='col-md-6'>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Sales with the help of WooReminder</div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Total Order(Re-Order) placed with WooReminder : <span class="badge"><?php echo $total_re_order_count; ?></span></li>
                                            <li class="list-group-item">Total Order(Re-Order) Value : <span class="badge"><?php echo $woo_currency_symbol . ' ' . $re_order_revenue; ?></span></li>
                                            <li class="list-group-item">Order(Re-Order) Percentage: <span class="badge"><?php echo $rmdr_sales_percent; ?> %</span></li>
                                            <li class="list-group-item">WooReminder is : 
                                                <?php
                                                if ($rmdr_sales_percent < 10) {
                                                    echo "<span class='badge'  style='background-color:#5bc0de;'>just getting started</span>";
                                                } elseif ($rmdr_sales_percent > 10 && $rmdr_sales_percent < 60) {
                                                    echo "<span class='badge'  style='background-color:#0275d8;'>doing good!</span>";
                                                } elseif ($rmdr_sales_percent > 60) {
                                                    echo "<span class='badge' style='background-color:#5cb85c;'>doing great!!!</span>";
                                                }
                                                ?></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">Special/Replaceable Codes In Mail Templates</div>

                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">[site_title_wrmdr] - for Site Name</li>
                                            <li class="list-group-item">[first_name] - for customer First Name</li>
                                            <li class="list-group-item">[last_name] - for customer Last Name</li>
                                            <li class="list-group-item">[re_order_url anchor="Link"] - for re-order link, where anchor is for anchor text for the link</li>
                                            <li class="list-group-item">[wrmdr_unsubscribe_url anchor="Link"] - for unsubscribe link, where anchor is for anchor text for the link</li>
                                            <li class="list-group-item">[ordered_date] - for date on which order placed.</li>
                                        </ul>
                                        <h6>Note: This codes will work only  in mail templates. As it is intended to work only on mail Templates</h6>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <ng-view />
                </div>
            </div>

            <script type="text/javascript">
                                                    jQuery(document).ready(function () {
                                                //jQuery('[data-toggle="tooltip"]').tooltip(); 
                                                jQuery('body').tooltip({
                                                    selector: '[data-toggle="tooltip"]', html: true
                                                });
                                                jQuery(document).on('click', '.rmdr_logs', function () {
                                                    jQuery('#rmdr_mdl_body').html(jQuery(this).data('original-title'));
                                                    jQuery('#rmdr_modal').modal('show');
                                                });
                                                //				jQuery('body').popover({
                                                //    selector: '[data-toggle="tooltip"]',html: true
                                                //});
                                            });
            </script>
            <!-- Modal bootstrap for showing reminder logs -->
            <div class="modal fade" id="rmdr_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Reminder Logs</h4>
                        </div>
                        <div class="modal-body" id="rmdr_mdl_body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="notifications" style="position: fixed;right:0;left:0;margin:0 auto;text-align: center;bottom:10%;width:310px;height:auto;z-index: 999999" class="clearfix"></div>

            <?php
        }

        function woo_remain_admin_scripts() {
            wp_enqueue_script('angular', plugins_url('js/angular.min.js', __FILE__));
            wp_enqueue_script('ng-route', plugins_url('ngmodules/angular-route.js', __FILE__), array('angular'));
            wp_enqueue_script('ng-table', plugins_url('js/ng-table.min.js', __FILE__), array('angular'));
            wp_enqueue_script('bootstrap', plugins_url('js/bootstrap.min.js', __FILE__), array('jquery'));

            wp_enqueue_style('bootstrap', plugins_url('css/bootstrap.min.css', __FILE__));
            wp_enqueue_style('ng-table', plugins_url('css/ng-table.min.css', __FILE__), array('bootstrap'));
            wp_enqueue_script('chartjs', plugins_url('js/Chart.min.js', __FILE__));
            wp_enqueue_media();
        }

        function add_wr_meta_data_to_wooproduct() {
            global $woocommerce, $post;

            echo '<div class="options_group">';

            woocommerce_wp_checkbox(
                    array(
                        'id' => 'enable_wr',
                        'wrapper_class' => '',
                        'label' => __('Enable Woo Reminder', 'woor'),
                        'description' => __('Check to enable reminder for this product', 'woor')
                    )
            );

            woocommerce_wp_text_input(
                    array(
                        'id' => 'woo_reminder',
                        'wrapper_class' => 'show_if_simple',
                        'label' => __('Reminder Days', 'woor'),
                        'placeholder' => '',
                        'description' => __('Enter how many days after the purchase of this product reminder should be sent.', 'woor'),
                        'type' => 'number',
                        'custom_attributes' => array(
                            'step' => 'any',
                            'min' => '0'
                        )
                    )
            );

            echo '</div>';
            ?>
            <style type="text/css">
                p.woo_reminder_field,p.reminder_variations{
                    display: none;
                }
            </style>
            <script type="text/javascript">
                                            jQuery(document).ready(function () {

                                                if (jQuery('#enable_wr').is(':checked')) {
                                                    if (jQuery('#product-type').val() == 'simple') {
                                                        jQuery('p.woo_reminder_field').show();
                                                    }
                                                } else {
                                                    jQuery('p.woo_reminder_field').hide();
                                                }
                                                jQuery('#woocommerce-product-data').on('click', '.woocommerce_variation', function () {

                                                    if (jQuery('#enable_wr').is(':checked')) {
                                                        jQuery('p.reminder_variations').show();
                                                    } else {
                                                        jQuery('p.reminder_variations').hide();
                                                    }
                                                });
                                                jQuery('#enable_wr,#product-type').change(function () {
                                                    if (jQuery('#enable_wr').is(':checked')) {
                                                        if (jQuery('#product-type').val() == 'simple') {
                                                            jQuery('p.woo_reminder_field').show();
                                                        } else {
                                                            jQuery('p.woo_reminder_field').hide();
                                                        }
                                                        if (jQuery('#product-type').val() == 'variable') {
                                                            jQuery('p.reminder_variations').show();
                                                        } else {
                                                            jQuery('p.reminder_variations').hide();
                                                        }
                                                    } else {
                                                        jQuery('p.woo_reminder_field').hide();
                                                    }
                                                });
                                            });
            </script>

            <?php
        }

        function add_wr_meta_data_to_wooproduct_variable($loop, $variation_data, $variation) {
            woocommerce_wp_text_input(
                    array(
                        'id' => 'woo_reminder[' . $variation->ID . ']',
                        'label' => __('Reminder Days', 'woor'),
                        'wrapper_class' => 'reminder_variations',
                        'placeholder' => 'Reaminder Days',
                        'desc_tip' => 'true',
                        'description' => __('Leave it empty or 0 to disbale reminder for this variation alone', 'woor'),
                        'value' => get_post_meta($variation->ID, 'woo_reminder', true)
                    )
            );
        }

        function save_wr_meta_data_to_wooproduct($post_id) {

            // enable reminder
            $woor_enable = isset($_POST['enable_wr']) ? 'yes' : 'no';
            update_post_meta($post_id, 'enable_wr', $woor_enable);

            // reminder days
            $woor_days = $_POST['woo_reminder'];
            if (!empty($woor_days))
                update_post_meta($post_id, 'woo_reminder', esc_attr($woor_days));
        }

        function save_wr_meta_data_to_wooproduct_variable($post_id) {

            $woor_days = $_POST['woo_reminder'][$post_id];
            if (!empty($woor_days)) {
                update_post_meta($post_id, 'woo_reminder', esc_attr($woor_days));
            }
        }

        function add_order_items_to_rmdr_list($order_id) {
            $add_to_list = false;
            if (get_option('wrmdr_show_optin_checkout') == 'no') {
                $add_to_list = true;
            } else {
                if (get_post_meta($order_id, 'wooreminder_optin', true) != 'no') { //customer didn't opt out
                    $add_to_list = true;
                    $cust_opt_in = true;
                }
            }
            if ($add_to_list) {

                $added_to_rmdr_list = get_post_meta($order_id, 'added_to_rmdr_list', true);
                if (!$added_to_rmdr_list) {
                    $order = new WC_Order($order_id);

                    $reminders_entries = array();
                    $reminders_to_delete = array();
                    foreach ($order->get_items() as $item) {
                        $product_idp = $item['product_id'];
                        $global_enable = get_post_meta($product_idp, 'enable_wr', true);
                        $product_id = ($item['variation_id']) ? $item['variation_id'] : $item['product_id'];
                        $reminder_days = get_post_meta($product_id, 'woo_reminder', true);
                        if ($global_enable && !empty($reminder_days) && $reminder_days > 0) {
                            $product = wc_get_product($product_id);
                            $product_title = $product->get_title();
                            if ($item['variation_id']) {
                                $product_title = $product_title . " ( ";
                                $attributes = $product->get_attributes();
                                $last = end($attributes);
                                foreach ($attributes as $attr_key => $attr) {

                                    if ($last != $attr) {
                                        $product_title = $product_title . $attr_key . ': ' . $item[$attr_key] . ', ';
                                    } else {
                                        $product_title = $product_title . $attr_key . ': ' . $item[$attr_key];
                                    }
                                }
                                $product_title = $product_title . " )";
                            }
                            if ($reminder_days) {
                                global $wpdb;
                                $wr_list_table = $wpdb->prefix . "woo_reminder_list";
                                $reminder_days = $reminder_days * $item['qty']; //multiply reminder days with qty

                                if ($cust_opt_in) {
                                    //get reminder days from customer setup if present
                                    $customer_reminder_datas = get_post_meta($order_id, 'wr_days_prods_checkout', true);
                                    if (array_key_exists('wrprod_' . $product_id, $customer_reminder_datas)) {
                                        $reminder_days = $customer_reminder_datas['wrprod_' . $product_id];
                                    }
                                }
                                $reminder_days_mysql = reminder_days_in_mysql($reminder_days);
                                $insert_date = current_time('mysql');
                                $customer_name = $order->billing_first_name . ' ' . $order->billing_last_name;

                                $insert_date_site_format = wrmdr_get_site_current_time();
                                $rmdr_logs_each = array('Added to WooReminder List on - ' . $insert_date_site_format);
                                $rmdr_logs_each = json_encode($rmdr_logs_each);
                                $reminders_entries[] = $wpdb->prepare("(%s,%d,%s,%s,%d,%s,%s,%s)", $insert_date, $order->id, $customer_name, $order->billing_email, $product_id, $product_title, $reminder_days_mysql, $rmdr_logs_each);
                                $reminders_to_delete[] = $product_id;
                            }
                        }
                    }

                    if (!empty($reminders_entries)) { //add to database only if there are any entries
                        
                        //remove existing reminder if same product is purchased for same user
                        $reminders_to_delete = implode(',', $reminders_to_delete);
                        $delete_sql = "DELETE FROM $wr_list_table WHERE prod_id IN($reminders_to_delete) AND email = '$order->billing_email' AND rmdr_status = 1";
                        $del_res = $wpdb->query($delete_sql);

                        $reminders_entries = implode(',', $reminders_entries);
                        $insert_sql = "INSERT INTO $wr_list_table ( itime, order_id, c_name, email, prod_id, prod_name, mail_date, rmdr_logs ) VALUES $reminders_entries; ";
                        $res = $wpdb->query($insert_sql);
                        if ($res !== false) {
                            update_post_meta($order->id, 'added_to_rmdr_list', true);
                        }
                    }
                }
            }
        }

        function add_items_to_rmdr_list_order_actions($actions) {
            global $theorder;

            if ($theorder->status != 'completed') {
                return $actions;
            }


            $actions['wrmdr_reorder_notice'] = __('Send Re-order Reminder Notification', '');
            return $actions;
        }

        //took copy from the default rmdr add function
        function send_reorder_reminder_from_order_page($order) {
            $order_id = $order->id;
            global $wpdb;
            $wr_list_table = $wpdb->prefix . "woo_reminder_list";
            //$added_to_rmdr_list = get_post_meta( $order_id, 'added_item_to_wrmdr_list_f_order_page', true );
            //if ( !$added_to_rmdr_list ) {
            //$order = new WC_Order( $order_id );

            $reminders_entries = array();
            foreach ($order->get_items() as $item) {
                $product_idp = $item['product_id'];
                $global_enable = get_post_meta($product_idp, 'enable_wr', true);
                $product_id = ($item['variation_id']) ? $item['variation_id'] : $item['product_id'];
                $reminder_days = get_post_meta($product_id, 'woo_reminder', true);
                if ($global_enable) {
                    $product = wc_get_product($product_id);
                    $product_title = $product->get_title();
                    if ($item['variation_id']) {
                        $product_title = $product_title . " ( ";
                        $attributes = $product->get_attributes();
                        $last = end($attributes);
                        foreach ($attributes as $attr_key => $attr) {

                            if ($last != $attr) {
                                $product_title = $product_title . $attr_key . ': ' . $item[$attr_key] . ', ';
                            } else {
                                $product_title = $product_title . $attr_key . ': ' . $item[$attr_key];
                            }
                        }
                        $product_title = $product_title . " )";
                    }


                    $exists_result = $wpdb->get_results("SELECT ID FROM $wr_list_table WHERE order_id = $order_id AND prod_id = $product_id");
                    if (empty($exists_result)) {

                        //$reminder_days = $reminder_days * $item['qty']; //multiply reminder days with qty
                        $reminder_days_mysql = gmdate('Y-m-d H:i:s');
                        $insert_date = current_time('mysql');
                        $customer_name = $order->billing_first_name . ' ' . $order->billing_last_name;

                        $insert_date_site_format = wrmdr_get_site_current_time();
                        $rmdr_logs_each = array('Added to WooReminder List manually from order page on - ' . $insert_date_site_format);
                        $rmdr_logs_each = json_encode($rmdr_logs_each);
                        $reminders_entries[] = $wpdb->prepare("(%s,%d,%s,%s,%d,%s,%s,%s)", $insert_date, $order->id, $customer_name, $order->billing_email, $product_id, $product_title, $reminder_days_mysql, $rmdr_logs_each);
                    }
                }
            }
            $reminders_entries = implode(',', $reminders_entries);
            $insert_sql = "INSERT INTO $wr_list_table ( itime, order_id, c_name, email, prod_id, prod_name, mail_date, rmdr_logs ) VALUES $reminders_entries; ";
            $res = $wpdb->query($insert_sql);
//				if ( $res !== false ) {
//					update_post_meta( $order->id, 'added_item_to_wrmdr_list_f_order_page', true );
//				}
            //}
            //send mail now - copied from reminde_customers



            $reminder_list_sql = "SELECT r.ID,r.order_id,r.prod_id,r.email,r.mail_date,r.mail_sents,r.rmdr_logs FROM $wr_list_table AS r WHERE r.rmdr_status = 1 AND r.order_id = $order_id";

            $reminders_result = $wpdb->get_results($reminder_list_sql);

            if (!empty($reminders_result)) {
                add_filter('wp_mail_content_type', 'set_content_type_to_html_rmdr');
                $inherit_woo_mail_styles = get_option('inherit_woo_mail_styles');
                $wrmdr_email_heading = get_option('wrmdr_email_heading');
                //$femail_temps = WooRemindersMagic::get_follow_up_temps();

                foreach ($reminders_result as $reminder) {
                    $m_mail_sub = get_option('wr_email_subject');
                    $m_mail_msg = get_option('wr_email_message');
                    //each reminder should be checked with all emails
                    $sent_emails = json_decode($reminder->mail_sents);

                    $rmdr_logs = json_decode($reminder->rmdr_logs);

                    //if ( is_array( $sent_emails ) ) {
                    //if ( !in_array( 'main', $sent_emails ) ) {
                    //send the default mail and mark it
                    //replace shortcodes in content
                    $m_mail_msg = WooRemindersMagic::replace_shortcode_in_contents($m_mail_msg, $reminder->order_id, $reminder->prod_id, $reminder->ID, "main");
                    $m_mail_msg = do_shortcode($m_mail_msg);
                    $m_mail_sub = WooRemindersMagic::replace_shortcode_in_contents($m_mail_sub, $reminder->order_id, $reminder->prod_id, $reminder->ID, "main", false);
                    $m_mail_sub = do_shortcode($m_mail_sub);

                    if ($inherit_woo_mail_styles == "yes") {
                        $m_mail_msg = WooRemindersMagic::wrmdr_inherit_woo_mail_temp($wrmdr_email_heading, $m_mail_msg);
                    }
                    if (wp_mail($reminder->email, $m_mail_sub, $m_mail_msg)) { //No matter what main mail will be sent on each order action
                        if (!in_array('main', $sent_emails)) { //just check to update the datas thats it. 
                            $sent_emails[] = 'main';
                        }
                        $wrmdr_current_time = wrmdr_get_site_current_time();
                        $rmdr_logs[] = "#Main Email sent from order page actions, on - $wrmdr_current_time";
                        $sent_count = get_option("wrmdr_main_sent_count");
                        $sent_count = ($sent_count) ? ++$sent_count : 1;
                        update_option("wrmdr_main_sent_count", $sent_count);
                    }
                    //}


                    $sent_emails = json_encode($sent_emails);
                    $rmdr_logs = json_encode($rmdr_logs);

                    $rupdated = $wpdb->update($wr_list_table, array("rmdr_logs" => $rmdr_logs, "mail_sents" => $sent_emails), array("ID" => $reminder->ID));
                    //}
                }
                $msg = sprintf(__('Re-Order Reminder sent by %s', ''), wp_get_current_user()->display_name);
                $order->add_order_note($msg);
            }
        }

    }

    new PNQWooReminders();

    function reminder_days_in_mysql($days) {

        $reminder_days = strtotime("+$days days") + ( get_option('gmt_offset') * HOUR_IN_SECONDS );
        return gmdate('Y-m-d H:i:s', $reminder_days);
    }

    class WooRemindersMagic {

        function __construct() {
            add_filter('cron_schedules', array($this, 'set_wrmdr_cron_interval'));
            register_activation_hook(__FILE__, array($this, 'set_wrmdr_cron'));

            add_action('wrmdr_mail_time', array($this, 'remaind_customers'));
            add_action('template_redirect', array($this, 'rmdr_order_redirect'));

            add_action('template_redirect', array($this, 'rmdr_unsubscribe'));

            add_action('woocommerce_checkout_update_order_meta', array($this, 'catch_reordered_orderid'), 10, 2);
        }

        public static function get_follow_up_temps() {
            global $wpdb;
            $woo_femail_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
            $woo_femail_temp_sql = "SELECT * FROM $woo_femail_tempaltes";
            return $wpdb->get_results($woo_femail_temp_sql);
        }

        public static function set_wrmdr_cron() {
            //verify event has not been scheduled
            if (!wp_next_scheduled('wrmdr_mail_time')) {
                //schedule the event to run hourly
                $rmdr_mailing_interval = get_option('rmdr_mailing_interval');
                if ($rmdr_mailing_interval == 'custom') {
                    wp_schedule_event(time(), 'wrmdr_interval', 'wrmdr_mail_time');
                } else {
                    wp_schedule_event(time(), $rmdr_mailing_interval, 'wrmdr_mail_time');
                }
            }
        }

        function set_wrmdr_cron_interval($schedules) {
            $rmdr_mailing_interval = get_option('rmdr_mailing_interval');
            if ($rmdr_mailing_interval == 'custom') {
                $rmdr_cus_int_hour = get_option('rmdr_cus_int_hour');
                //$rmdr_cus_int_hour = (int)$rmdr_cus_int_hour;
                $rmdr_cus_int_sec = $rmdr_cus_int_hour * 3600;
                $schedules['wrmdr_interval'] = array(
                    'interval' => $rmdr_cus_int_sec,
                    'display' => 'WR Mail Interval'
                );
            }

            return $schedules;
        }

        public static function remove_wrmdr_cron() {


            //get time of next scheduled run
            $timestamp = wp_next_scheduled('wrmdr_mail_time');
            if ($timestamp) {
                //unschedule custom action hook
                wp_unschedule_event($timestamp, 'wrmdr_mail_time');
                WooRemindersMagic::remove_wrmdr_cron();
            }
        }

        function remaind_customers() {

            global $wpdb;
            $wr_list_table = $wpdb->prefix . "woo_reminder_list";

            //take only active reminders
            $blog_time_now = current_time('mysql');

            $reminder_list_sql = "SELECT r.ID,r.order_id,r.prod_id,r.email,r.mail_date,r.mail_sents,r.rmdr_logs FROM $wr_list_table AS r WHERE r.rmdr_status = 1 AND r.mail_date <= '$blog_time_now'";

            $reminders_result = $wpdb->get_results($reminder_list_sql);
            if (!empty($reminders_result)) {
                add_filter('wp_mail_content_type', 'set_content_type_to_html_rmdr');
                $m_mail_sub = get_option('wr_email_subject');
                $m_mail_msg = get_option('wr_email_message');
                $inherit_woo_mail_styles = get_option('inherit_woo_mail_styles');
                $wrmdr_email_heading = get_option('wrmdr_email_heading');
                $femail_temps = WooRemindersMagic::get_follow_up_temps();

                foreach ($reminders_result as $reminder) {
                    // only allow if the order present
                    if( wc_get_order( $reminder->order_id ) ){
                    //each reminder should be checked with all emails
                    $sent_emails = json_decode($reminder->mail_sents);

                    $rmdr_logs = json_decode($reminder->rmdr_logs);

                    if (is_array($sent_emails)) {

                        if (!in_array('main', $sent_emails)) {
                            //send the default mail and mark it
                            //replace shortcodes in content
                            $m_mail_msg_bdy = $this->replace_shortcode_in_contents($m_mail_msg, $reminder->order_id, $reminder->prod_id, $reminder->ID, "main");
                            $m_mail_msg_bdy = do_shortcode($m_mail_msg_bdy);
                            $m_mail_sub = $this->replace_shortcode_in_contents($m_mail_sub, $reminder->order_id, $reminder->prod_id, $reminder->ID, "main", false);
                            $m_mail_sub = do_shortcode($m_mail_sub);

                            if ($inherit_woo_mail_styles == "yes") {
                                $m_mail_msg_bdy = $this->wrmdr_inherit_woo_mail_temp($wrmdr_email_heading, $m_mail_msg_bdy);
                            }
                            if (wp_mail($reminder->email, $m_mail_sub, $m_mail_msg_bdy)) {
                                $sent_emails[] = 'main';
                                $wrmdr_current_time = wrmdr_get_site_current_time();
                                $rmdr_logs[] = "#Main Email sent on - $wrmdr_current_time";
                                $sent_count = get_option("wrmdr_main_sent_count");
                                $sent_count = ($sent_count) ? ++$sent_count : 1;
                                update_option("wrmdr_main_sent_count", $sent_count);
                            }
                        }
                        //check in all follow up
                        if (is_array($femail_temps) && !empty($femail_temps)) {
                            foreach ($femail_temps as $femail_temp) {
                                if ($femail_temp->status == 1) {
                                    if (!in_array($femail_temp->ID, $sent_emails)) {
                                        $days = $femail_temp->followup_days;
                                        $mail_date = strtotime($reminder->mail_date);
                                        $followup_time = strtotime("+$days days", $mail_date);

                                        $blog_time_now = current_time('timestamp'); //making to timestamp type for compare
                                        //send mail and mark it
                                        if ($blog_time_now >= $followup_time) {

                                            //replace shortcode in content
                                            //replace shortcodes in content
                                            $f_mail_msg = $this->replace_shortcode_in_contents($femail_temp->message, $reminder->order_id, $reminder->prod_id, $reminder->ID, $femail_temp->ID);
                                            $f_mail_msg = do_shortcode($f_mail_msg);

                                            $f_mail_sub = $this->replace_shortcode_in_contents($femail_temp->subject, $reminder->order_id, $reminder->prod_id, $reminder->ID, $femail_temp->ID, false);
                                            $f_mail_sub = do_shortcode($femail_temp->subject);

                                            if ($inherit_woo_mail_styles == "yes") {
                                                $f_mail_msg = $this->wrmdr_inherit_woo_mail_temp($wrmdr_email_heading, $f_mail_msg);
                                            }
                                            if (wp_mail($reminder->email, $f_mail_sub, $f_mail_msg)) {
                                                $sent_emails[] = $femail_temp->ID;
                                                $wrmdr_current_time = wrmdr_get_site_current_time();
                                                $rmdr_logs[] = "#$femail_temp->ID Follow Up Email sent on - $wrmdr_current_time";
                                                update_wrmdr_femail_count($femail_temp->ID, "sent");
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $sent_emails = json_encode($sent_emails);
                        $rmdr_logs = json_encode($rmdr_logs);

                        $rupdated = $wpdb->update($wr_list_table, array("mail_sents" => $sent_emails, "rmdr_logs" => $rmdr_logs), array("ID" => $reminder->ID));
                    }
                }
            }
            }
        }

        function replace_shortcode_in_contents($content, $order_id, $prod_id, $rmdrid, $mailtemp, $observer = true) {
            $order = new WC_Order($order_id);
            $first_name_search = array('[first_name]', '["first_name"]', "['first_name']");
            $first_name_replace = $order->billing_first_name;
            $content = str_replace($first_name_search, $first_name_replace, $content);

            $last_name_search = array('[last_name]', '["last_name"]', "['last_name']");
            $last_name_replace = $order->billing_last_name;
            $content = str_replace($last_name_search, $last_name_replace, $content);

            $prod_title_search = array('[product_title]', '["product_title"]', "['product_title']");
            $product = wc_get_product($prod_id);
            $prod_title_replace = $product->get_title();
            $content = str_replace($prod_title_search, $prod_title_replace, $content);

            $reorder_url_search = array('[re_order_url]', 'http://[re_order_url]', '["re_order_url"]', "['re_order_url']");
            $reorder_url_replace = add_query_arg('rmdrid', $rmdrid, site_url());
            $content = str_replace($reorder_url_search, $reorder_url_replace, $content);

            $rmdr_id_search = array('rmdr="#"', "rmdr='#'");
            $rmdr_id_replace = 'rmdr="' . $rmdrid . '" mailtemp="' . $mailtemp . '"';
            $content = str_replace($rmdr_id_search, $rmdr_id_replace, $content);

            $reorder_url_search = array('[re_order_url', '["re_order_url', "['re_order_url");
            $reorder_url_replace = '[re_order_url rmdr="' . $rmdrid . '" mailtemp="' . $mailtemp . '"';
            $content = str_replace($reorder_url_search, $reorder_url_replace, $content);

            $ordered_date_search = array('[ordered_date]', '["ordered_date"]', "['ordered_date']");
            $ordered_date_replace = date(get_option('date_format'), strtotime($order->order_date));
            $content = str_replace($ordered_date_search, $ordered_date_replace, $content);

            $unsubscribe_url_search = array('[wrmdr_unsubscribe_url', '["wrmdr_unsubscribe_url', "['wrmdr_unsubscribe_url");
            $unsubscribe_url_replace = '[wrmdr_unsubscribe_url rmdr="' . $rmdrid . '" mailtemp="' . $mailtemp . '"';
            $content = str_replace($unsubscribe_url_search, $unsubscribe_url_replace, $content);

            if ($observer) {
                //add observer code at last
                $open_url = add_query_arg(array("wrmdrid-open" => $rmdrid, "wrmdr-tempid-open" => $mailtemp), site_url());
                $content = $content . "<img src='$open_url' />";
            }

            return $content;
        }

        function wrmdr_inherit_woo_mail_temp($email_heading, $message) {
            // load the mailer class
            $mailer = WC()->mailer();

            // create a new email
            $email = new WC_Email();

            // wrap the content with the email template and then add styles
            $message = apply_filters('woocommerce_mail_content', $email->style_inline($mailer->wrap_message($email_heading, $message)));

            return $message;
        }

        function rmdr_order_redirect() {
            if (isset($_GET['wrmdrid-return'])) {
                global $wpdb, $woocommerce;
                $wr_list_table = $wpdb->prefix . "woo_reminder_list";
                $select_sql = "SELECT r.order_id,r.prod_id,r.rmdr_logs FROM $wr_list_table AS r WHERE r.ID = %d";
                $sql = $wpdb->prepare($select_sql, $_GET['wrmdrid-return']);
                $results = $wpdb->get_results($sql);

                if (!empty($results) && $wpdb->num_rows >= 1) {
                    //set cookie info about this reminder
                    setcookie("wrmdrid", $_GET['wrmdrid-return'], time() + 2592000, "/"); //setcookie for 30 days
                    //add to cart
                    $sel_row = array_shift($results);
                    $add_to_cart_res = $woocommerce->cart->add_to_cart($sel_row->prod_id);
                    //update log in reminder table
                    $rmdr_logs = json_decode($sel_row->rmdr_logs);
                    $emailtemp_id = $_GET['mailtemp'];
                    $wrmdr_current_time = wrmdr_get_site_current_time();
                    if ($_GET['mailtemp'] == "main") {
                        $rmdr_logs[] = "Customer returned to website from #$emailtemp_id followup email on - $wrmdr_current_time";
                        $return_count = get_option("wrmdr_main_return_count");
                        $return_count = ($return_count) ? ++$return_count : 1;
                        update_option("wrmdr_main_return_count", $return_count);
                    } else {
                        $rmdr_logs[] = "Customer returned to website from #$emailtemp_id email on -$wrmdr_current_time";
                        update_wrmdr_femail_count($emailtemp_id, "return");
                    }
                    $rmdr_logs = json_encode($rmdr_logs);
                    if (get_option('rmdr_mark_finished') == 'returned') {
                        $wpdb->update($wr_list_table, array("rmdr_logs" => $rmdr_logs, "rmdr_status" => 3), array("ID" => $_GET['wrmdrid-return']));
                    } else {
                        $wpdb->update($wr_list_table, array("rmdr_logs" => $rmdr_logs), array("ID" => $_GET['wrmdrid-return']));
                    }


                    //redirect to 
                    if (get_option('rmdr_order_land_page') == 'cart') {
                        $redirect_url = $woocommerce->cart->get_cart_url();
                    } else {
                        $redirect_url = $woocommerce->cart->get_checkout_url();
                    }
                    wp_redirect($redirect_url);
                    exit();
                }
            }
        }

        function rmdr_unsubscribe() {
            if (isset($_GET['wrmdrid-unsubscribe'])) {
                //delete row from reminder table
                global $wpdb;
                $wr_list_table = $wpdb->prefix . "woo_reminder_list";
                $results = $wpdb->delete($wr_list_table, array('ID' => $_GET['wrmdrid-unsubscribe']), array('%d'));
                if ($results) {
                    $redirect_url = esc_url(home_url('/?wrmdr_unsub_msg=1'));
                    $unsubscribe_count = get_option("wrmdr_unsubscribe_count");
                    $unsubscribe_count = ($unsubscribe_count) ? ++$unsubscribe_count : 1;
                    update_option("wrmdr_unsubscribe_count", $unsubscribe_count);
                } else {
                    $redirect_url = esc_url(home_url('/?wrmdr_unsub_msg=2'));
                }
                wp_redirect($redirect_url);
                exit();
            }
        }

        function catch_reordered_orderid($order_id) {
            if (isset($_COOKIE["wrmdrid"])) {
                $rmdr_id = $_COOKIE["wrmdrid"];
                update_post_meta($order_id, 'reorder_from_wrmdr', $rmdr_id);
                //delte the cookie
                setcookie("wrmdrid", "", time() - 60, "/");
                //update reminder status, stop sending mail
                global $wpdb;
                $wr_list_table = $wpdb->prefix . "woo_reminder_list";
                $select_sql = "SELECT r.rmdr_logs FROM $wr_list_table AS r WHERE r.ID = %d";
                $sql = $wpdb->prepare($select_sql, $_COOKIE['wrmdrid']);
                $results = $wpdb->get_results($sql);
                $sel_row = array_shift($results);
                $rmdr_logs = json_decode($sel_row->rmdr_logs);
                $rmdr_logs[] = "Hooray! Re-ordered successfully. Re-ordered Order ID - #$order_id";
                $rmdr_logs = json_encode($rmdr_logs);
                $wpdb->update($wr_list_table, array("rmdr_status" => 3, "rmdr_roid" => $order_id, "rmdr_logs" => $rmdr_logs), array("ID" => $rmdr_id));
            }
        }

    }

    new WooRemindersMagic();

    function set_content_type_to_html_rmdr() {
        return "text/html";
    }

    function rmdr_link_url($atts) {
        $atts = shortcode_atts(
                array(
            'anchor' => 'link',
            'rmdr' => '#',
            'mailtemp' => '#'
                ), $atts, 're_order_url');
        $url = add_query_arg(array('wrmdrid-return' => $atts['rmdr'], 'mailtemp' => $atts['mailtemp']), site_url());
        return "<a href='$url'>" . $atts['anchor'] . "</a>";
    }

    add_shortcode('re_order_url', 'rmdr_link_url');

    function rmdr_unsubscribe_url($atts) {
        $atts = shortcode_atts(
                array(
            'anchor' => 'link',
            'rmdr' => '#',
            'mailtemp' => '#'
                ), $atts, 're_order_url');
        $url = add_query_arg(array('wrmdrid-unsubscribe' => $atts['rmdr'], 'mailtemp' => $atts['mailtemp']), site_url());
        return "<a href='$url'>" . $atts['anchor'] . "</a>";
    }

    add_shortcode('wrmdr_unsubscribe_url', 'rmdr_unsubscribe_url');

    function site_title_shortcode() {
        return get_option('blogname');
    }

    add_shortcode('site_title_wrmdr', 'site_title_shortcode');

    function rmdr_throw_png_observer() {
        if (isset($_GET['wrmdr-tempid-open'])) {
            $observer = plugin_dir_path(__FILE__) . "img/observer.png";

            global $wpdb;
            $woo_email_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
            $wr_list_table = $wpdb->prefix . "woo_reminder_list";
            $site_current_time = wrmdr_get_site_current_time();
            if ($_GET['wrmdr-tempid-open'] != "main") {

                $rmdr_msg = "Customer opened #" . $_GET['wrmdr-tempid-open'] . " followup mail on - $site_current_time";
                update_wrmdr_femail_count($_GET['wrmdr-tempid-open'], "open");
            } else {
                $rmdr_msg = "Customer opened #Main mail on - $site_current_time";
                $open_count = get_option('wrmdr_main_open_count');
                $open_count = ($open_count) ? ++$open_count : 1;
                update_option("wrmdr_main_open_count", $open_count);
            }
            if (isset($_GET['wrmdrid-open'])) {
                $rmdr_logs = get_wrmdr_logs($_GET['wrmdrid-open']);

                if (is_array($rmdr_logs)) {
                    $rmdr_logs[] = $rmdr_msg;
                    update_wrmdr_logs($_GET['wrmdrid-open'], $rmdr_logs);
                }
            }
            header("Content-type: image/png");
            header('Content-Length: ' . filesize($observer));
            header('Content-Length: ' . filesize($observer));
            readfile($observer);
            exit();
        }
    }

    add_action('init', 'rmdr_throw_png_observer');

    function get_wrmdr_logs($id) {
        global $wpdb;
        $wr_list_table = $wpdb->prefix . "woo_reminder_list";
        $rmdr_logs_res = $wpdb->get_col($wpdb->prepare("SELECT r.rmdr_logs FROM $wr_list_table AS r WHERE r.ID = %d", $id));
        if (!empty($rmdr_logs_res)) {

            $rmdr_logs_json = array_shift($rmdr_logs_res);

            $rmdr_logs = json_decode($rmdr_logs_json);
            return $rmdr_logs;
        } else {
            return false;
        }
    }

    function update_wrmdr_logs($id, $rmdr_logs) {
        global $wpdb;
        $wr_list_table = $wpdb->prefix . "woo_reminder_list";
        $rmdr_logs = json_encode($rmdr_logs);
        $wpdb->update($wr_list_table, array("rmdr_logs" => $rmdr_logs), array("ID" => $id));
    }

    function update_wrmdr_femail_count($ftempid, $count_type) {
        global $wpdb;
        $woo_email_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
        $count_type = $count_type . '_count';
        $res = $wpdb->get_col($wpdb->prepare("SELECT $count_type FROM $woo_email_tempaltes WHERE ID=%d", $ftempid));


        if (!empty($res)) {
            $count = array_shift($res);
            $count++;
            $wpdb->update($woo_email_tempaltes, array($count_type => $count), array("ID" => $ftempid));
        }
    }

    function wrmdr_get_site_current_time() {
        $site_time_format = get_option('date_format') . " " . get_option('time_format');
        $current_time = current_time($site_time_format);
        return $current_time;
    }

    function wooreminder_optin_checkbox() {

        $section_heading = get_option('wrmdr_optin_checkout_sec_heading');
        $wooreminder_option_label = get_option('wrmdr_optin_checkout_label');
        echo '<div class="wooreminder_optin"><h3>' . __($section_heading) . '</h3>';
        ?>
        <p class="form-row">
            <input type="checkbox" value="yes" class="input-checkbox" <?php checked("yes", get_option("wrmdr_optin_default_checked")); ?> name="wooreminder_optin" id="wooreminder_optin" >
            <label style="display: inline;" for="wooreminder_optin" class="wooreminder_optin_checkbox"><?php echo $wooreminder_option_label; ?></label>
        </p>

        <div id="woo_reminder_cust_days">
            <?php
            foreach (WC()->cart->get_cart() as $cart_item) {
                $global_enable = get_post_meta($cart_item['product_id'], 'enable_wr', true);
                $prod_id = ( $cart_item['variation_id'] ) ? $cart_item['variation_id'] : $cart_item['product_id'];
                $reminder_days = get_post_meta($prod_id, 'woo_reminder', true);
                if ($global_enable && !empty($reminder_days) && $reminder_days > 0) {
                    ?>
                    <p class="form-row">
                        <label for='wrprod_<?php echo $prod_id; ?>'> <?php echo $cart_item['data']->get_title(); ?> in </label><input type="number" class='woo_reminder_cust_days_prod' name="wrprod_<?php echo $prod_id; ?>" value="<?php echo $reminder_days * $cart_item['quantity']; ?>" /> days
                    </p>
                <?php }
            }
            ?>
        </div>
        <style>
            .woo_reminder_cust_days_prod{
                padding:10px !important;
            }
            <?php
            if (get_option("wrmdr_optin_default_checked") != "yes") {
                echo "#woo_reminder_cust_days{display:none;}";
            }
            ?>
        </style>
        <script>

                                        jQuery(document).ready(function () {
                                            jQuery('#wooreminder_optin').change(function () {
                                                if (this.checked) {
                                                    jQuery('#woo_reminder_cust_days').show();
                                                } else {
                                                    jQuery('#woo_reminder_cust_days').hide();
                                                }

                                            });
                                        });

        </script>

        <?php
        echo '</div>';
    }

    if (get_option('wrmdr_show_optin_checkout') == 'yes') {

        add_action('woocommerce_after_order_notes', 'wooreminder_optin_checkbox');
        add_action('woocommerce_checkout_update_order_meta', 'wooreminder_optin_checkout_save');
        add_action('woocommerce_checkout_process', 'check_wrmdr_days_checkout_input');
    }

    function wooreminder_optin_checkout_save($order_id) {

        global $woocommerce;
        if ($_POST['wooreminder_optin'] == "yes") {
            update_post_meta($order_id, 'wooreminder_optin', esc_attr($_POST['wooreminder_optin']));
            $checkout_wr_days = array();
            foreach ($_POST as $key => $value) {
                $pos = strpos($key, "wrprod_");
                if ($pos === 0) {
                    if (!is_numeric($value) || $value <= 0) {
                        continue;
                    }
                    $checkout_wr_days[$key] = $value;
                }
            }
            update_post_meta($order_id, 'wr_days_prods_checkout', $checkout_wr_days);
        } else {
            update_post_meta($order_id, 'wooreminder_optin', 'no');
        }
    }

    function check_wrmdr_days_checkout_input() {

        foreach ($_POST as $key => $value) {
            $pos = strpos($key, "wrprod_");
            if ($pos === 0) {
                if (!is_numeric($value)) {
                    wc_add_notice(__('Please enter valid number in reminder days fields.'), 'error');
                    return;
                }
                if ($value <= 0) {
                    wc_add_notice(__('Please enter reminder days greater than 0 in reminder days fields.'), 'error');
                    return;
                }
            }
        }
    }

    function wrmdr_unsubscribe_msg() {
        if (isset($_GET['wrmdr_unsub_msg'])) {
            if ($_GET['wrmdr_unsub_msg'] == 1) {
                echo "<script type='text/javascript'>alert('You have successfully unsubscribed from the reminder email');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Something went wrong, Please try again to unsubscribe.');</script>";
            }
        }
    }

    add_action('wp_head', 'wrmdr_unsubscribe_msg');
    ?>