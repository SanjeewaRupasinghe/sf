<?php

function r_list() {
	?>
	<div class="rlist" ng-controller="rlist">

		<div class="alert alert-warning" ng-show="noData">
			No Reminders to Display
		</div>
		<div class='row' style="margin-bottom: 10px;">
			<div class="col-md-4 col-lg-3 pull-right" ng-show="reminderList.length > 0">
				<input type='text' class="form-control" placeholder="Search" ng-model='rmSearch' ng-change='rmSearchChange()'>
			</div>
		</div>
		<table ng-hide="noData" ng-table="tableParams" class="table table-condensed table-bordered table-striped" show-filter="false">
			<tr ng-repeat="rmdr in $data">

				<td title="'ID'" filter="{ ID: 'number'}"  sortable="'ID'">
					{{rmdr.ID}}</td>
				<td title="'Order ID'" filter="{ order_id: 'number'}" sortable="'order_id'">
					{{rmdr.order_id}}</td>
				<td title="'Billing Name'" filter="{ c_name: 'text'}" sortable="'c_name'">
					{{rmdr.c_name}}</td>
				<td title="'Email'" filter="{ email: 'text'}" sortable="'email'">
					{{rmdr.email}}</td>
				<td title="'Product ID'" filter="{ prod_id: 'number'}" sortable="'prod_id'">
					{{rmdr.prod_id}}</td>
				<td title="'Product Name'" filter="{ prod_name: 'text'}" sortable="'prod_name'">
					{{rmdr.prod_name}}</td>
				<td title="'Email Date'" filter="{ email_date: 'text'}" sortable="'mail_date'">
					{{ rmdr.mail_date | dateToWR  }}</td>
	<!--						<td title="'Email Status'" filter="{ email_status: 'text'}" sortable="'mail_status'">
					{{rmdr.mail_status}}</td>-->
				<td title="'Reminder Status'" filter="{ rmdr_status: 'number'}" sortable="'rmdr_status'">
					{{ (rmdr.rmdr_status == 3) ? "Finished" : (rmdr.rmdr_status == 1) ? "Active" : (rmdr.rmdr_status == 2) ? "Paused" : "Stopped";}}</td>
				<td>
					<span class="btn btn-default rmdr_logs" data-toggle="tooltip" data-placement="left" title="{{rmdr.rmdr_logs}}">
						<span class="glyphicon glyphicon-info-sign"></span>
					</span>
					<button class="btn btn-danger btn-sm ng-scope" ng-click="del(rmdr.ID, $event)">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
				</td>
			</tr>
		</table>
	</div>


	<?php
	exit();
}

add_action( 'wp_ajax_rlist', 'r_list' );

function etempp() {
	update_option( 'wr_email_subject', stripslashes( $_POST['subject'] ) );
	update_option( 'wr_email_message', stripslashes( $_POST['message'] ) );
	$result = array( 'sub' => get_option( 'wr_email_subject' ), 'msg' => get_option( 'wr_email_message' ) );
	echo json_encode( $result );

	exit();
}

add_action( 'wp_ajax_etemp', 'etempp' );

function save_fetemp() {
	$id = stripslashes( $_POST['temp_act'] );
	$title = stripslashes( $_POST['title'] );
	$sub = stripslashes( $_POST['subject'] );
	$msg = stripslashes( $_POST['message'] );
	$followup = stripslashes( $_POST['followup'] );
	$status = stripslashes( $_POST['status'] );
	global $wpdb;
	$woo_email_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
	if ( $id == 'new' ) {
		$result = $wpdb->insert( $woo_email_tempaltes, array( "title" => $title, "followup_days" => $followup, "subject" => $sub, "message" => $msg, "status" => $status ) );
	} else {
		$result = $wpdb->update( $woo_email_tempaltes, array( "title" => $title, "followup_days" => $followup, "subject" => $sub, "message" => $msg, "status" => $status ), array( "ID" => $id ) );
	}
	echo json_encode( $result );
	exit();
}

add_action( 'wp_ajax_f_etemp_save', 'save_fetemp' );

function list_follow_temps() {
	global $wpdb;
	$woo_femail_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
	$select_sql = "SELECT * FROM $woo_femail_tempaltes";
	$result = $wpdb->get_results( $select_sql );
	echo json_encode( $result );
	exit();
}

add_action( 'wp_ajax_f_etemp_list', 'list_follow_temps' );

function delete_follow_temp() {
	global $wpdb;
	$temp_id = stripslashes( $_POST['temp_id'] );
	$woo_femail_tempaltes = $wpdb->prefix . "woo_followemail_tempaltes";
	$select_sql = "DELETE FROM $woo_femail_tempaltes WHERE id=$temp_id";
	$result = $wpdb->get_results( $select_sql );
	echo json_encode( $result );
	exit();
}

add_action( 'wp_ajax_f_etemp_del', 'delete_follow_temp' );

function delete_reminder_items() {
	global $wpdb;
	$rmdr_id = stripslashes( $_POST['ID'] );
	$wr_list_table = $wpdb->prefix . "woo_reminder_list";
	$select_sql = "DELETE FROM $wr_list_table WHERE id=$rmdr_id";
	$del_result = $wpdb->get_results( $select_sql );
	echo json_encode( $del_result );
	exit();
}

add_action( 'wp_ajax_rmdr_delete', 'delete_reminder_items' );

function reminder_list_data() {
	global $wpdb;
	$wr_list_table = $wpdb->prefix . "woo_reminder_list";
	$select_sql = "SELECT r.ID,r.order_id,r.c_name,r.email,r.prod_id,r.prod_name,r.mail_date,r.mail_status,r.rmdr_status FROM $wr_list_table AS r";
	$sel_result = $wpdb->get_results( $select_sql );
	echo json_encode( $sel_result );
	exit();
}

add_action( 'wp_ajax_rdata', 'reminder_list_data' );

function woo_rmdr_settings() {
	?>

	<div id="settings-container" ng-controller="genSetCtrl">
		<div>
			<form name="generalSettingsForm" ng-submit="saveGeneralSettings()">
				<h4>General Settings</h4>
				<label>Re-Order Link URL should land to</label>
				<div class="radio">
					<label><input type="radio" ng-model="generalSettings.landing_page" value="cart"  name="landing_page" required>Cart Page</label>
				</div>
				<div class="radio">
					<label><input type="radio" ng-model="generalSettings.landing_page" value="checkout"  name="landing_page" required>Checkout Page</label>
				</div>
				<input type="submit" id="gen_set_save" value="save" ng-disabled="generalSettingsForm.$invalid" class="btn btn-primary">
			</form>
		</div>
		<div>
			<div class="row">
				<div class="col-mg-8 col-lg-8" style="min-height: 650px !important;">
					<form name="testEmail">
						<label>Email ID to send Test Email</label>
						<input type="email" ng-model="testToEmail" name="toEmail" required>
					</form>
					<button ng-click="sendTestEmail()" ng-disabled="testEmail.$invalid" id="sendTestEmail" class="btn btn-primary mt-20">Trigger Test Email</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	exit();
}

add_action( 'wp_ajax_wooremset', 'woo_rmdr_settings' );

function wrmdr_save_gensettings() {
	if ( isset( $_POST['landing_page'] ) ) {
		update_option( 'rmdr_order_land_page', $_POST['landing_page'] );
	}

	if ( isset( $_POST['mark_finished'] ) ) {
		update_option( 'rmdr_mark_finished', $_POST['mark_finished'] );
	}

	if ( isset( $_POST['mailing_interval'] ) ) {
		update_option( 'rmdr_mailing_interval', $_POST['mailing_interval'] );
	}

	if ( isset( $_POST['cus_int_hour'] ) ) {
		update_option( 'rmdr_cus_int_hour', $_POST['cus_int_hour'] );
	}
        
	if ( isset( $_POST['inherit_woo_mail_styles'] ) ) {
		update_option( 'inherit_woo_mail_styles', $_POST['inherit_woo_mail_styles'] );
	}
        
        if ( isset( $_POST['wrmdr_email_heading'] ) ) {
		update_option( 'wrmdr_email_heading', $_POST['wrmdr_email_heading'] );
	}

	if ( isset( $_POST['mailing_interval'] ) || isset( $_POST['cus_int_hour'] ) ) {
		WooRemindersMagic::remove_wrmdr_cron();
		WooRemindersMagic::set_wrmdr_cron();
	}
        
        if ( isset( $_POST['wrmdr_show_optin_checkout'] ) ) {
		update_option( 'wrmdr_show_optin_checkout', $_POST['wrmdr_show_optin_checkout'] );
	}
        
        if ( isset( $_POST['wrmdr_optin_checkout_sec_heading'] ) ) {
		update_option( 'wrmdr_optin_checkout_sec_heading', $_POST['wrmdr_optin_checkout_sec_heading'] );
	}
        
        if ( isset( $_POST['wrmdr_optin_checkout_label'] ) ) {
		update_option( 'wrmdr_optin_checkout_label', $_POST['wrmdr_optin_checkout_label'] );
	}
        
        if ( isset( $_POST['wrmdr_optin_default_checked'] ) ) {
		update_option( 'wrmdr_optin_default_checked', $_POST['wrmdr_optin_default_checked'] );
	}

	echo "ok";
	exit();
}

add_action( 'wp_ajax_wrmdr_save_gensettings', 'wrmdr_save_gensettings' );

function send_test_email() {
	if ( isset( $_POST['toEmail'] ) ) {
		$blog_name = get_bloginfo( 'name' );
		if ( wp_mail( $_POST['toEmail'], 'Test Email - ' . $blog_name, 'This is an Test Email from ' . $blog_name . '. Your email system is working.' ) ) {
			$response = 'triggered';
		} else {
			$response = 'nottriggered';
		}
	} else {
		$response = 'noemail';
	}
	echo $response;
	exit();
}

add_action( 'wp_ajax_wrmdr_test_email', 'send_test_email' );