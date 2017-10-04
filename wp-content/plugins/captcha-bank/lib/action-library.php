<?php
/**
 * This file is used for managing data in database.
 *
 * @author  Tech Banker
 * @package captcha-bank/lib
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
if (!is_user_logged_in()) {
   return;
} else {
   $access_granted = false;
   foreach ($user_role_permission as $permission) {
      if (current_user_can($permission)) {
         $access_granted = true;
         break;
      }
   }
   if (!$access_granted) {
      return;
   } else {

      function get_captcha_bank_unserialize_data($manage_data) {
         $unserialize_complete_data = array();
         foreach ($manage_data as $value) {
            $unserialize_data = maybe_unserialize($value->meta_value);

            $unserialize_data["meta_id"] = $value->meta_id;
            array_push($unserialize_complete_data, $unserialize_data);
         }
         return $unserialize_complete_data;
      }
      if (isset($_REQUEST["param"])) {
         $obj_dbHelper_captcha_bank = new dbHelper_captcha_bank();
         switch (esc_attr($_REQUEST["param"])) {
            case "wizard_captcha_bank":
               if (wp_verify_nonce((isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : ""), "captcha_bank_check_status")) {
                  $type = isset($_REQUEST["type"]) ? sanitize_text_field($_REQUEST["type"]) : "";
                  update_option("captcha-bank-wizard-set-up", $type);
                  if ($type == "opt_in") {
                     $plugin_info_captcha_bank = new plugin_info_captcha_bank();
                     global $wp_version;
                     $url = tech_banker_stats_url . "/wp-admin/admin-ajax.php";
                     $theme_details = array();

                     if ($wp_version >= 3.4) {
                        $active_theme = wp_get_theme();
                        $theme_details["theme_name"] = strip_tags($active_theme->Name);
                        $theme_details["theme_version"] = strip_tags($active_theme->Version);
                        $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
                     }

                     $plugin_stat_data = array();
                     $plugin_stat_data["plugin_slug"] = "captcha-bank";
                     $plugin_stat_data["type"] = "standard_edition";
                     $plugin_stat_data["version_number"] = captcha_bank_version_number;
                     $plugin_stat_data["status"] = $type;
                     $plugin_stat_data["event"] = "activate";
                     $plugin_stat_data["domain_url"] = site_url();
                     $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();
                     $plugin_stat_data["email"] = get_option("admin_email");
                     $plugin_stat_data["wp_version"] = $wp_version;
                     $plugin_stat_data["php_version"] = esc_html(phpversion());
                     $plugin_stat_data["mysql_version"] = $wpdb->db_version();
                     $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
                     $plugin_stat_data["operating_system"] = PHP_OS . "  (" . PHP_INT_SIZE * 8 . ") BIT";
                     $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit") ? ini_get("memory_limit") : "N/A";
                     $plugin_stat_data["extensions"] = get_loaded_extensions();
                     $plugin_stat_data["plugins"] = $plugin_info_captcha_bank->get_plugin_info_captcha_bank();
                     $plugin_stat_data["themes"] = $theme_details;
                     $response = wp_safe_remote_post($url, array
                         (
                         "method" => "POST",
                         "timeout" => 45,
                         "redirection" => 5,
                         "httpversion" => "1.0",
                         "blocking" => true,
                         "headers" => array(),
                         "body" => array("data" => serialize($plugin_stat_data), "site_id" => get_option("cpb_tech_banker_site_id") != "" ? get_option("cpb_tech_banker_site_id") : "", "action" => "plugin_analysis_data")
                     ));
                     if (!is_wp_error($response)) {
                        $response["body"] != "" ? update_option("cpb_tech_banker_site_id", $response["body"]) : "";
                     }
                  }
               }
               break;
            case "captcha_type_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_bank_file")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $captcha_type_data);
                  $arithmetic = isset($_REQUEST["arithmetic"]) ? array_map("intval",is_array(json_decode(stripcslashes($_REQUEST["arithmetic"]))) ? json_decode(stripcslashes($_REQUEST["arithmetic"])) : array()) : array();
                  $update_text_captcha = array();
                  $where = array();

                  $update_text_captcha["captcha_type_text_logical"] = isset($captcha_type_data["ux_ddl_captcha_type"]) ? sanitize_text_field($captcha_type_data["ux_ddl_captcha_type"]) : "";
                  $update_text_captcha["captcha_characters"] = isset($captcha_type_data["ux_txt_character"]) ? intval($captcha_type_data["ux_txt_character"]) : 0;
                  $update_text_captcha["captcha_type"] = isset($captcha_type_data["ux_ddl_alphabets"]) ? sanitize_text_field($captcha_type_data["ux_ddl_alphabets"]) : "";
                  $update_text_captcha["text_case"] = isset($captcha_type_data["ux_ddl_case"]) ? sanitize_text_field($captcha_type_data["ux_ddl_case"]) : "";
                  $update_text_captcha["case_sensitive"] = isset($captcha_type_data["ux_ddl_case_disable"]) ? sanitize_text_field($captcha_type_data["ux_ddl_case_disable"]) : "";
                  $update_text_captcha["captcha_width"] = isset($captcha_type_data["ux_txt_width"]) ? intval($captcha_type_data["ux_txt_width"]) : 0;
                  $update_text_captcha["captcha_height"] = isset($captcha_type_data["ux_txt_height"]) ? intval($captcha_type_data["ux_txt_height"]) : 0;
                  $update_text_captcha["captcha_background"] = "bg4.jpg";
                  $update_text_captcha["border_style"] = isset($captcha_type_data["ux_txt_border_style"]) ? sanitize_text_field(implode(",", $captcha_type_data["ux_txt_border_style"])) : "";
                  $update_text_captcha["lines"] = isset($captcha_type_data["ux_txt_line"]) ? intval($captcha_type_data["ux_txt_line"]) : "";
                  $update_text_captcha["lines_color"] = isset($captcha_type_data["ux_txt_color"]) ? sanitize_text_field($captcha_type_data["ux_txt_color"]) : "";
                  $update_text_captcha["noise_level"] = isset($captcha_type_data["ux_txt_noise_level"]) ? intval($captcha_type_data["ux_txt_noise_level"]) : 0;
                  $update_text_captcha["noise_color"] = isset($captcha_type_data["ux_txt_noise_color"]) ? sanitize_text_field($captcha_type_data["ux_txt_noise_color"]) : "";
                  $update_text_captcha["text_transperancy"] = isset($captcha_type_data["ux_txt_transperancy"]) ? intval($captcha_type_data["ux_txt_transperancy"]) : "";
                  $update_text_captcha["signature_text"] = "Captcha Bank";
                  $update_text_captcha["signature_style"] = "7,#ff0000";
                  $update_text_captcha["signature_font"] = "Roboto:100";
                  $update_text_captcha["text_shadow_color"] = isset($captcha_type_data["ux_txt_shadow_color"]) ? sanitize_text_field($captcha_type_data["ux_txt_shadow_color"]) : "";
                  $update_text_captcha["mathematical_operations"] = isset($captcha_type_data["ux_rdl_mathematical_captcha"]) ? sanitize_text_field($captcha_type_data["ux_rdl_mathematical_captcha"]) : "";
                  $update_text_captcha["arithmetic_actions"] = sanitize_text_field(implode(",", $arithmetic));
                  $update_text_captcha["relational_actions"] = "1,1";
                  $update_text_captcha["arrange_order"] = "1,1";
                  $update_text_captcha["text_style"] = "24,#000000";
                  $update_text_captcha["text_font"] = "Roboto";

                  $update_data = array();
                  $where["meta_key"] = "captcha_type";
                  $update_data["meta_value"] = serialize($update_text_captcha);
                  $obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(), $update_data, $where);
               }
               break;

            case "captcha_display_settings_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_bank_settings")) {
                  $checkbox_array = isset($_REQUEST["checkbox_array"]) ? array_map("intval", is_array(json_decode(stripcslashes($_REQUEST["checkbox_array"]))) ? json_decode(stripcslashes($_REQUEST["checkbox_array"])) : array()) : array();
                  $update_display_settings_array = array();
                  $update_display_settings_array["settings"] = sanitize_text_field(implode(",", $checkbox_array));

                  $where = array();
                  $update_data = array();
                  $where["meta_key"] = "display_settings";
                  $update_data["meta_value"] = serialize($update_display_settings_array);
                  $obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(), $update_data, $where);
               }
               break;

            case "captcha_log_delete_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_selected_logs_delete")) {
                  $where = array();
                  $meta_id = isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0;
                  $where["meta_id"] = $meta_id;
                  $where_parent["id"] = $meta_id;
                  $obj_dbHelper_captcha_bank->deleteCommand(captcha_bank_meta(), $where);
                  $obj_dbHelper_captcha_bank->deleteCommand(captcha_bank_parent(), $where_parent);
               }
               break;

            case "captcha_blocking_options_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_bank_options")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $blocking_option_data);
                  $update_captcha_type = array();
                  $where = array();

                  $update_captcha_type["auto_ip_block"] = isset($blocking_option_data["ux_ddl_auto_ip"]) ? sanitize_text_field($blocking_option_data["ux_ddl_auto_ip"]) : "";
                  $update_captcha_type["maximum_login_attempt_in_a_day"] = isset($blocking_option_data["ux_txt_login"]) ? intval($blocking_option_data["ux_txt_login"]) : 0;
                  $update_captcha_type["block_for_time"] = isset($blocking_option_data["ux_ddl_blocked_for"]) ? sanitize_text_field($blocking_option_data["ux_ddl_blocked_for"]) : "";

                  $update_blocking_options_data = array();
                  $where["meta_key"] = "blocking_options";
                  $update_blocking_options_data["meta_value"] = serialize($update_captcha_type);
                  $obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(), $update_blocking_options_data, $where);
               }
               break;

            case "captcha_manage_ip_address_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_manage_ip_address")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $advance_security_data);
                  $ip = isset($_REQUEST["ip_address"]) ? ip2long(sanitize_text_field($_REQUEST["ip_address"])) : 0;
                  $ip_address = long2ip($ip);
                  $get_ip = get_ip_location_captcha_bank($ip_address);
                  $blocked_for = isset($advance_security_data["ux_ddl_hour"]) ? sanitize_text_field($advance_security_data["ux_ddl_hour"]) : "";
                  $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;

                  $ip_address_count = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key = %s", "block_ip_address"
                      )
                  );
                  foreach ($ip_address_count as $data) {
                     $ip_address_unserialize = maybe_unserialize($data->meta_value);
                     $ip_address_match = isset($ip_address_unserialize["ip_address"]) ? doubleval($ip_address_unserialize["ip_address"]) : 0;
                     if ($ip == $ip_address_match) {
                        echo "1";
                        die();
                     }
                  }
                  $ip_address_ranges_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key = %s", "block_ip_range"
                      )
                  );
                  $ip_exists = false;
                  foreach ($ip_address_ranges_data as $data) {
                     $ip_range_unserialized_data = maybe_unserialize($data->meta_value);
                     $ip_range_match_data = isset($ip_range_unserialized_data["ip_range"]) ? sanitize_text_field($ip_range_unserialized_data["ip_range"]) : 0;
                     $data_range = explode(",", $ip_range_match_data);
                     if ($ip >= $data_range[0] && $ip <= $data_range[1]) {
                        $ip_exists = true;
                        break;
                     }
                  }
                  if ($ip_exists == true) {
                     echo 1;
                  } else {
                     $ip_address_parent_id = $wpdb->get_var
                         (
                         $wpdb->prepare
                             (
                             "SELECT id FROM " . captcha_bank_parent() . " WHERE type=%s", "advance_security"
                         )
                     );
                     $insert_manage_ip_address = array();
                     $insert_manage_ip_address["type"] = "block_ip_address";
                     $insert_manage_ip_address["parent_id"] = isset($ip_address_parent_id) ? intval($ip_address_parent_id) : 0;
                     $last_id = $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_parent(), $insert_manage_ip_address);

                     $insert_manage_ip_address = array();
                     $insert_manage_ip_address["ip_address"] = $ip;
                     $insert_manage_ip_address["blocked_for"] = $blocked_for;
                     $insert_manage_ip_address["location"] = isset($location) ? esc_html($location) : "";
                     $insert_manage_ip_address["comments"] = isset($advance_security_data["ux_txtarea_comments"]) ? sanitize_text_field($advance_security_data["ux_txtarea_comments"]) : "";
                     $insert_manage_ip_address["date_time"] = CAPTCHA_BANK_LOCAL_TIME;
                     $insert_manage_ip_address["meta_id"] = $last_id;

                     $insert_data = array();
                     $insert_data["meta_id"] = $last_id;
                     $insert_data["meta_key"] = "block_ip_address";
                     $insert_data["meta_value"] = serialize($insert_manage_ip_address);
                     $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_meta(), $insert_data);

                     if ($blocked_for != "permanently") {
                        $cron_name = "ip_address_unblocker_" . $last_id;
                        wp_schedule_captcha_bank($cron_name, $blocked_for);
                     }
                  }
               }
               break;

            case "captcha_delete_ip_address_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_manage_ip_address_delete")) {
                  $where = array();
                  $where_parent = array();
                  $id = isset($_REQUEST["id"]) ? intval($_REQUEST["id"]) : 0;
                  $where_parent["id"] = $id;
                  $where["meta_id"] = $id;
                  $cron_name = "ip_address_unblocker_" . $where["meta_id"];
                  wp_unschedule_captcha_bank($cron_name);
                  $obj_dbHelper_captcha_bank->deleteCommand(captcha_bank_meta(), $where);
                  $obj_dbHelper_captcha_bank->deleteCommand(captcha_bank_parent(), $where_parent);
               }
               break;

            case "captcha_manage_ip_ranges_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_manage_ip_ranges")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $ip_range_data);
                  $start_ip_range = isset($_REQUEST["start_range"]) ? ip2long(sanitize_text_field($_REQUEST["start_range"])) : 0;
                  $end_ip_range = isset($_REQUEST["end_range"]) ? ip2long(sanitize_text_field($_REQUEST["end_range"])) : 0;
                  
                  $blocked_for = isset($ip_range_data["ux_ddl_blocked"]) ? sanitize_text_field($ip_range_data["ux_ddl_blocked"]) : "";
                  $get_ip = get_ip_location_captcha_bank(long2ip($start_ip_range));
                  $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;

                  $ip_address_range_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT meta_value FROM " . captcha_bank_meta() . " WHERE meta_key = %s", "block_ip_range"
                      )
                  );
                  $ip_exists = false;
                  foreach ($ip_address_range_data as $data) {
                     $ip_range_unserialized_data = maybe_unserialize($data->meta_value);
                     $data_range = explode(",", $ip_range_unserialized_data["ip_range"]);
                     if (($start_ip_range >= $data_range[0] && $start_ip_range <= $data_range[1]) || ($end_ip_range >= $data_range[0] && $end_ip_range <= $data_range[1])) {
                        echo 1;
                        $ip_exists = true;
                        break;
                     } elseif (($start_ip_range <= $data_range[0] && $start_ip_range <= $data_range[1]) && ($end_ip_range >= $data_range[0] && $end_ip_range >= $data_range[1])) {
                        echo 1;
                        $ip_exists = true;
                        break;
                     }
                  }

                  if ($ip_exists == false) {
                     $ip_range_parent_id = $wpdb->get_var
                         (
                         $wpdb->prepare
                             (
                             "SELECT id FROM " . captcha_bank_parent() . " WHERE type=%s", "advance_security"
                         )
                     );
                     $insert_manage_ip_range = array();
                     $insert_manage_ip_range["type"] = "block_ip_range";
                     $insert_manage_ip_range["parent_id"] = isset($ip_range_parent_id) ? intval($ip_range_parent_id) : 0;
                     $last_id = $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_parent(), $insert_manage_ip_range);

                     $insert_manage_ip_range = array();
                     $insert_manage_ip_range["ip_range"] = $start_ip_range . "," . $end_ip_range;
                     $insert_manage_ip_range["blocked_for"] = $blocked_for;
                     $insert_manage_ip_range["location"] = $location;
                     $insert_manage_ip_range["comments"] = isset($ip_range_data["ux_txtarea_manage_ip_range"]) ? sanitize_text_field($ip_range_data["ux_txtarea_manage_ip_range"]) : "";
                     $insert_manage_ip_range["date_time"] = CAPTCHA_BANK_LOCAL_TIME;
                     $insert_manage_ip_range["meta_id"] = $last_id;

                     $insert_data = array();
                     $insert_data["meta_id"] = $last_id;
                     $insert_data["meta_key"] = "block_ip_range";
                     $insert_data["meta_value"] = serialize($insert_manage_ip_range);
                     $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_meta(), $insert_data);

                     if ($blocked_for != "permanently") {
                        $cron_name = "ip_range_unblocker_" . $last_id;
                        wp_schedule_captcha_bank($cron_name, $blocked_for);
                     }
                  }
               }
               break;

            case "captcha_delete_ip_range_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_manage_ip_ranges_delete")) {
                  $where = array();
                  $where_parent = array();
                  $id = isset($_REQUEST["id"]) ? intval($_REQUEST["id"]) : 0;
                  $where_parent["id"] = $id;
                  $where["meta_id"] = $id;
                  $cron_name = "ip_range_unblocker_" . $where["meta_id"];
                  wp_unschedule_captcha_bank($cron_name);
                  $obj_dbHelper_captcha_bank->deleteCommand(captcha_bank_meta(), $where);
                  $obj_dbHelper_captcha_bank->deleteCommand(captcha_bank_parent(), $where_parent);
               }
               break;

            case "captcha_type_email_templates_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_type_email_templates")) {
                  $templates = isset($_REQUEST["data"]) ? sanitize_text_field($_REQUEST["data"]) : "";
                  $email_templates_data = $wpdb->get_results
                      (
                      $wpdb->prepare
                          (
                          "SELECT * FROM " . captcha_bank_meta() .
                          " WHERE meta_key=%s", $templates
                      )
                  );

                  $email_template_data_unseralize = get_captcha_bank_unserialize_data($email_templates_data);
                  echo json_encode($email_template_data_unseralize);
               }
               break;

            case "captcha_bank_other_settings_module":
               if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? ($_REQUEST["_wp_nonce"]) : "", "captcha_bank_other_settings")) {
                  parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $update_array);
                  $update_captcha_type = array();
                  $where = array();

                  $update_captcha_type["remove_tables_at_uninstall"] = isset($update_array["ux_ddl_remove_tables"]) ? sanitize_text_field($update_array["ux_ddl_remove_tables"]) : "";
                  $update_captcha_type["live_traffic_monitoring"] = isset($update_array["ux_ddl_live_traffic_monitoring"]) ? sanitize_text_field($update_array["ux_ddl_live_traffic_monitoring"]) : "";
                  $update_captcha_type["visitor_logs_monitoring"] = isset($update_array["ux_ddl_visitor_log_monitoring"]) ? sanitize_text_field($update_array["ux_ddl_visitor_log_monitoring"]) : "";
                  $update_captcha_type["ip_address_fetching_method"] = isset($update_array["ux_ddl_ip_address_fetching_method"]) ? sanitize_text_field($update_array["ux_ddl_ip_address_fetching_method"]) : "";

                  $update_data = array();
                  $where["meta_key"] = "other_settings";
                  $update_data["meta_value"] = serialize($update_captcha_type);
                  $obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(), $update_data, $where);
               }
               break;
         }
         die();
      }
   }
}