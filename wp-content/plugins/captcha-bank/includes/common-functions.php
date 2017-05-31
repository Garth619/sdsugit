<?php

/**
 * This file contains user's login details code.
 *
 * @author  Tech Banker
 * @package captcha-bank/includes
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} //exit if accessed directly
/*
  Function Name: user_log_in_fails
  Parameter: yes($username)
  Description: This function is used to create entry when user fails to log in.
  Created On: 29-08-2016 11:30
  Created By: Tech Banker Team
 */

function user_log_in_fails($username) {

    global $wpdb, $alert_setup_data_array;
    $ip = getIpAddress_for_captcha_bank();
    $ip_address = $ip == "::1" ? ip2long("0.0.0.0") : ip2long($ip);
    $get_ip = get_ip_location_captcha_bank(long2ip($ip_address));
    $logs_parent_id = $wpdb->get_var
            (
            $wpdb->prepare
                    (
                    "SELECT id FROM " . captcha_bank_parent() . " WHERE type=%s", "logs"
            )
    );
    $insert_user_login = array();
    $insert_user_login["type"] = "login_log";
    $insert_user_login["parent_id"] = intval($logs_parent_id);
    $wpdb->insert(captcha_bank_parent(), $insert_user_login);
    $last_id = $wpdb->insert_id;

    $insert_user_login = array();
    $insert_user_login["username"] = $username;
    $insert_user_login["user_ip_address"] = $ip_address;
    $insert_user_login["resources"] = isset($_SERVER["REQUEST_URI"]) ? esc_attr($_SERVER["REQUEST_URI"]) : "";
    $insert_user_login["http_user_agent"] = isset($_SERVER["HTTP_USER_AGENT"]) ? esc_attr($_SERVER["HTTP_USER_AGENT"]) : "";
    $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;
    $insert_user_login["location"] = $location;
    $insert_user_login["latitude"] = $get_ip->latitude;
    $insert_user_login["longitude"] = $get_ip->longitude;
    $insert_user_login["date_time"] = CAPTCHA_BANK_LOCAL_TIME;
    $insert_user_login["status"] = "Failure";
    $insert_user_login["meta_id"] = $last_id;
    $insert_data = array();
    $insert_data["meta_id"] = $last_id;
    $insert_data["meta_key"] = "recent_login_data";
    $insert_data["meta_value"] = serialize($insert_user_login);
    $wpdb->insert(captcha_bank_meta(), $insert_data);

    
    function get_user_data_remove_unwanted_users($data, $date, $blocked_time, $ip_address) {
        $array_details = array();
        foreach ($data as $raw_row) {
            $row = unserialize($raw_row->meta_value);
            if ($row["user_ip_address"] == $ip_address) {
                if ($blocked_time != "permanently") {
                    if ($row["status"] == "Failure" && $row["date_time"] + $blocked_time >= $date) {
                        array_push($array_details, $row);
                    }
                } else {
                    if ($row["status"] == "Failure") {
                        array_push($array_details, $row);
                    }
                }
            }
        }
        return $array_details;
    }

    $blocking_options_data = $wpdb->get_var
            (
            $wpdb->prepare
                    (
                    "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key=%s", "blocking_options"
            )
    );
    $blocking_options_unserialized_data = unserialize($blocking_options_data);
    if (esc_attr($blocking_options_unserialized_data["auto_ip_block"]) == "enable") {
        $get_ip = get_ip_location_captcha_bank(long2ip($ip_address));
        $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;

        $date = CAPTCHA_BANK_LOCAL_TIME;
        $get_all_user_data = $wpdb->get_results
                (
                $wpdb->prepare
                        (
                        "SELECT * FROM " . captcha_bank_meta() . "
					WHERE meta_key= %s", "recent_login_data"
                )
        );

        $blocked_for_time = $blocking_options_unserialized_data["block_for_time"];

        switch ($blocked_for_time) {
            case "1Hour":
                $this_time = 60 * 60;
                break;

            case "12Hour":
                $this_time = 12 * 60 * 60;
                break;

            case "24hours":
                $this_time = 24 * 60 * 60;
                break;

            case "48hours":
                $this_time = 2 * 24 * 60 * 60;
                break;

            case "week":
                $this_time = 7 * 24 * 60 * 60;
                break;

            case "month":
                $this_time = 30 * 24 * 60 * 60;
                break;

            case "permanently":
                $this_time = "permanently";
                break;
        }

        $user_data = COUNT(get_user_data_remove_unwanted_users($get_all_user_data, $date, $this_time, $ip_address));
        if (!defined("cpb_count_login_status")) {
            define("cpb_count_login_status", $user_data);
        }
        if ($user_data >= esc_attr($blocking_options_unserialized_data["maximum_login_attempt_in_a_day"])) {
            $ip_address_parent_id = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT id FROM " . captcha_bank_parent() . " WHERE type=%s", "advance_security"
                    )
            );

            $ip_address_block = array();
            $ip_address_block["type"] = "block_ip_address";
            $ip_address_block["parent_id"] = $ip_address_parent_id;
            $wpdb->insert(captcha_bank_parent(), $ip_address_block);
            $last_id = $wpdb->insert_id;

            $ip_address_block_meta = array();
            $ip_address_block_meta["ip_address"] = $ip_address;
            $ip_address_block_meta["blocked_for"] = $blocked_for_time;
            $ip_address_block_meta["location"] = $location;
            $ip_address_block_meta["comments"] = "IP ADDRESS AUTOMATIC BLOCKED!";
            $ip_address_block_meta["date_time"] = CAPTCHA_BANK_LOCAL_TIME;
            $ip_address_block_meta["meta_id"] = $last_id;

            $insert_data = array();
            $insert_data["meta_id"] = $last_id;
            $insert_data["meta_key"] = "block_ip_address";
            $insert_data["meta_value"] = serialize($ip_address_block_meta);
            $wpdb->insert(captcha_bank_meta(), $insert_data);

            if ($blocked_for_time != "permanently") {
                $cron_name = "ip_address_unblocker_" . $last_id;
                wp_schedule_captcha_bank($cron_name, $blocked_for_time);
            }
            $error_data = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key=%s", "error_message"
                    )
            );
            $error_messages_unserialized_data = unserialize($error_data);
            $replace_address = str_replace("[ip_address]", long2ip($ip_address), esc_html($error_messages_unserialized_data["for_blocked_ip_address_error"]));
            wp_die($replace_address);
        }
        add_filter("login_errors", "login_error_messages_captcha_bank", 10, 1);
    }
}

/*
  Function Name: user_log_in_success
  Parameter: yes($username)
  Description: This function is used to create entry when user logged in successfully.
  Created On: 31-08-2016 11:00
  Created By: Tech Banker Team
 */

function user_log_in_success($username) {

    global $wpdb, $alert_setup_data_array;
    $ip = getIpAddress_for_captcha_bank();
    $ip_address = $ip == "::1" ? ip2long("127.0.0.1") : ip2long($ip);
    $get_ip = get_ip_location_captcha_bank(long2ip($ip_address));
    $logs_parent_id = $wpdb->get_var
            (
            $wpdb->prepare
                    (
                    "SELECT id FROM " . captcha_bank_parent() . " WHERE type=%s", "logs"
            )
    );
    $insert_user_login = array();
    $insert_user_login["type"] = "login_log";
    $insert_user_login["parent_id"] = $logs_parent_id;
    $wpdb->insert(captcha_bank_parent(), $insert_user_login);

    $last_id = $wpdb->insert_id;

    $insert_user_login = array();
    $insert_user_login["username"] = $username;
    $insert_user_login["user_ip_address"] = $ip_address;
    $insert_user_login["resources"] = isset($_SERVER["REQUEST_URI"]) ? esc_attr($_SERVER["REQUEST_URI"]) : "";
    $insert_user_login["http_user_agent"] = isset($_SERVER["HTTP_USER_AGENT"]) ? esc_attr($_SERVER["HTTP_USER_AGENT"]) : "";
    $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;
    $insert_user_login["location"] = $location;
    $insert_user_login["latitude"] = $get_ip->latitude;
    $insert_user_login["longitude"] = $get_ip->longitude;
    $insert_user_login["date_time"] = CAPTCHA_BANK_LOCAL_TIME;
    $insert_user_login["status"] = "Success";
    $insert_user_login["meta_id"] = $last_id;

    $insert_data = array();
    $insert_data["meta_id"] = $last_id;
    $insert_data["meta_key"] = "recent_login_data";
    $insert_data["meta_value"] = serialize($insert_user_login);
    $wpdb->insert(captcha_bank_meta(), $insert_data);

}

/*
  Function Name: check_user_login_status
  Parameter: yes($username,$password)
  Description: This function is used to call the functions user_log_in_fails and user_log_in_success.
  Created On: 01-09-2016 14:30
  Created By: Tech Banker Team
 */

function check_user_login_status($username, $password) {
    $userdata = get_user_by("login", $username);
    if ($userdata && wp_check_password($password, $userdata->user_pass)) {
        user_log_in_success($username);
    } else {
        if ($username == "" && $password == "") {
            return;
        } else {
            user_log_in_fails($username);
        }
    }
}

/*
  Function Name: login_error_messages_captcha_bank
  Parameter: Yes($default_error_message)
  Description: This function is used to return the login attempts error message.
  Created On: 01-09-2016 15:00
  Created By: Tech Banker Team
 */

function login_error_messages_captcha_bank($default_error_message) {
    global $wpdb;

    $blocking_options_data = $wpdb->get_var
            (
            $wpdb->prepare
                    (
                    "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key=%s", "blocking_options"
            )
    );
    $blocking_options_unserialized_data = unserialize($blocking_options_data);

    $error_message_login_attempts = $wpdb->get_var
            (
            $wpdb->prepare
                    (
                    "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key=%s", "error_message"
            )
    );
    $error_message_login_attempts_unserialized = unserialize($error_message_login_attempts);
    $login_attempts = $blocking_options_unserialized_data["maximum_login_attempt_in_a_day"] - cpb_count_login_status;
    $replace_login_attempts = str_replace("[maxAttempts]", $login_attempts, $error_message_login_attempts_unserialized["for_login_attempts_error"]);
    $display_error_message = $default_error_message . " " . $replace_login_attempts;

    return $display_error_message;
}

/*
  Function Name: plugin_get_version
  Parameter: Yes($plugin)
  Description: This function is used to returns the version of active plugins.
  Created On: 31-08-2016 16:44
  Created By: Tech Banker Team
 */

function plugin_get_version($plugin) {
    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);
    $plugin_version = $plugin_data["Version"];
    return $plugin_version;
}
