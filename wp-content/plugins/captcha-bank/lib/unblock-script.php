<?php

/**
 * This file is used for unscheduling schedulers.
 *
 * @author Tech Banker
 * @package wp-captcha-bank/lib
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} //exit if accessed directly
if (defined("DOING_CRON") && DOING_CRON) {
    if (wp_verify_nonce($nonce_unblock_script, "unblock_script")) {
        if (strstr(scheduler_name, "ip_address_unblocker_")) {
            $meta_id = explode("ip_address_unblocker_", scheduler_name);
        } else {
            $meta_id = explode("ip_range_unblocker_", scheduler_name);
        }
        $where_parent = array();
        $where = array();
        $where_parent["id"] = $meta_id[1];
        $where["meta_id"] = $meta_id[1];

        $type = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT type FROM " . captcha_bank_parent() . " WHERE id=%d", $meta_id[1]
                )
        );

        if ($type != "") {
            $manage_ip = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_id=%d AND meta_key=%s", $meta_id[1], $type
                    )
            );
            $ip_address_data_array = unserialize($manage_ip);
            $wpdb->delete(captcha_bank_parent(), $where_parent);
            $wpdb->delete(captcha_bank_meta(), $where);
            
        }
        wp_unschedule_captcha_bank(scheduler_name);
    }
}