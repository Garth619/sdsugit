<?php

/**
 * This file is used for creating sidebar menus.
 *
 * @author  Tech Banker
 * @package captcha-bank/lib
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
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
        $flag = 0;

        $roles_and_capabilities_data = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . captcha_bank_meta() . "
				WHERE meta_key=%s", "roles_and_capabilities"
                )
        );
        $roles_and_capabilities_data_unserialize = unserialize($roles_and_capabilities_data);
        $roles_and_capabilities_data_unserialize_data = isset($roles_and_capabilities_data_unserialize["roles_and_capabilities"]) ? $roles_and_capabilities_data_unserialize["roles_and_capabilities"] : "";
        $roles = explode(",", $roles_and_capabilities_data_unserialize_data);

        if (is_super_admin()) {
            $cpb_role = "administrator";
        } else {
            $cpb_role = check_user_roles_captcha_bank();
        }
        switch ($cpb_role) {
            case "administrator":
                $privileges = "administrator_privileges";
                $flag = $roles[0];
                break;

            case "author":
                $privileges = "author_privileges";
                $flag = $roles[1];
                break;

            case "editor":
                $privileges = "editor_privileges";
                $flag = $roles[2];
                break;

            case "contributor":
                $privileges = "contributor_privileges";
                $flag = $roles[3];
                break;

            case "subscriber":
                $privileges = "subscriber_privileges";
                $flag = $roles[4];
                break;

            default:
                $privileges = "other_privileges";
                $flag = $roles[5];
        }
        foreach ($roles_and_capabilities_data_unserialize as $key => $value) {
            if ($privileges == $key) {
                $privileges_value = $value;
                break;
            }
        }

        $full_control = explode(",", $privileges_value);
        if (!defined("full_control")) {
            define("full_control", "$full_control[0]");
        }
        if (!defined("captcha_settings_captcha_bank")) {
            define("captcha_settings_captcha_bank", "$full_control[1]");
        }
        if (!defined("general_settings_captcha_bank")) {
            define("general_settings_captcha_bank", "$full_control[2]");
        }
        if (!defined("logs_captcha_bank")) {
            define("logs_captcha_bank", "$full_control[3]");
        }
        if (!defined("other_settings_captcha_bank")) {
            define("other_settings_captcha_bank", "$full_control[4]");
        }
        if (!defined("security_settings_captcha_bank")) {
            define("security_settings_captcha_bank", "$full_control[5]");
        }
        if (!defined("system_information_captcha_bank")) {
            define("system_information_captcha_bank", "$full_control[6]");
        }
        if (!defined("error_logs_captcha_bank")) {
            define("error_logs_captcha_bank", "$full_control[7]");
        }
        $check_captcha_bank_wizard = get_option("captcha-bank-wizard-set-up");
        if ($flag == "1") {
            if ($check_captcha_bank_wizard) {
                add_menu_page($cpb_captcha_bank_title, $cpb_captcha_bank_title, "read", "captcha_bank", "", plugins_url("assets/global/img/icon.png", dirname(__FILE__)));
            } else {
                add_menu_page($cpb_captcha_bank_title, $cpb_captcha_bank_title, "read", "captcha_bank_wizard", "", plugins_url("assets/global/img/icon.png", dirname(__FILE__)));
                add_submenu_page($cpb_captcha_bank_title, $cpb_captcha_bank_title, "", "read", "captcha_bank_wizard", "captcha_bank_wizard");
            }
            add_submenu_page("captcha_bank", $cpb_captcha_setup_menu, $cpb_captcha_settings_label, "read", "captcha_bank", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank");
            add_submenu_page($cpb_display_settings_title, $cpb_display_settings_title, "", "read", "captcha_bank_display_settings", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_display_settings");

            add_submenu_page("captcha_bank", $cpb_notification_setup_label, $cpb_general_settings_menu, "read", "captcha_bank_notifications_setup", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_notifications_setup");
            add_submenu_page($cpb_message_settings_label, $cpb_message_settings_label, "", "read", "captcha_bank_message_settings", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_message_settings");
            add_submenu_page($cpb_email_templates_menu, $cpb_email_templates_menu, "", "read", "captcha_bank_email_templates", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_email_templates");
            add_submenu_page($cpb_roles_and_capabilities_menu, $cpb_roles_and_capabilities_menu, "", "read", "captcha_bank_roles_capabilities", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_roles_capabilities");

            add_submenu_page("captcha_bank", $cpb_recent_login_log_title, $cpb_logs_menu, "read", "captcha_bank_login_logs", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_login_logs");
            add_submenu_page($cpb_visitor_logs_title, $cpb_visitor_logs_title, "", "read", "captcha_bank_visitor_logs", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_visitor_logs");
            add_submenu_page($cpb_live_traffic_title, $cpb_live_traffic_title, "", "read", "captcha_bank_live_traffic", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_live_traffic");
            add_submenu_page("captcha_bank", $cpb_other_settings_menu, $cpb_other_settings_menu, "read", "captcha_bank_other_settings", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_other_settings");
            add_submenu_page("captcha_bank", $cpb_blockage_settings_label, $cpb_security_settings_label, "read", "captcha_bank_blockage_settings", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_blockage_settings");
            add_submenu_page($cpb_block_unblock_ip_address_label, $cpb_block_unblock_ip_address_label, "", "read", "captcha_bank_block_unblock_ip_addresses", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_block_unblock_ip_addresses");
            add_submenu_page($cpb_block_unblock_ip_range_label, $cpb_block_unblock_ip_range_label, "", "read", "captcha_bank_block_unblock_ip_ranges", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_block_unblock_ip_ranges");
            add_submenu_page($cpb_block_unblock_countries_label, $cpb_block_unblock_countries_label, "", "read", "captcha_bank_block_unblock_countries", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_block_unblock_countries");
            add_submenu_page("captcha_bank", $cpb_feature_requests, $cpb_feature_requests, "read", "captcha_bank_feature_requests", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_feature_requests");
            add_submenu_page("captcha_bank", $cpb_system_information_menu, $cpb_system_information_menu, "read", "captcha_bank_system_information", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_system_information");
            add_submenu_page("captcha_bank", $cpb_error_logs, $cpb_error_logs, "read", "captcha_bank_error_logs", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_error_logs");
            add_submenu_page("captcha_bank", $cpb_upgrade, $cpb_upgrade, "read", "captcha_bank_premium_editions", $check_captcha_bank_wizard == "" ? "captcha_bank_wizard" : "captcha_bank_premium_editions");
        }

        /*
          Function Name: captcha_bank_wizard
          Parameters: No
          Description: This function is used to create wizard menu.
          Created On: 11-04-2017  10:53
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_wizard")) {

            function captcha_bank_wizard() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/wizard/wizard.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/wizard/wizard.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank
          Parameters: No
          Description: This function is used to create captcha setup menu.
          Created On: 25-08-2016 13:02
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank")) {

            function captcha_bank() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "lib/web-fonts.php")) {
                    $web_font_list = include_once CAPTCHA_BANK_DIR_PATH . "lib/web-fonts.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/captcha-settings/captcha-setup.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/captcha-settings/captcha-setup.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_display_settings
          Parameters: No
          Description: This function is used to create display settings menu.
          Created On: 25-08-2016 14:02
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_display_settings")) {

            function captcha_bank_display_settings() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/captcha-settings/display-settings.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/captcha-settings/display-settings.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_notifications_setup
          Parameters: No
          Description: This function is used to create notification setup menu .
          Created On: 25-08-2016 14:35
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_notifications_setup")) {

            function captcha_bank_notifications_setup() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/general-settings/notification-setup.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/general-settings/notification-setup.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_message_settings
          Parameters: No
          Description: This function is used to create message settings menu .
          Created On: 25-08-2016 14:40
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_message_settings")) {

            function captcha_bank_message_settings() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/general-settings/message-settings.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/general-settings/message-settings.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_email_templates
          Parameters: No
          Description: This function is used to create email templates menu .
          Created On: 25-08-2016 14:45
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_email_templates")) {

            function captcha_bank_email_templates() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/general-settings/email-templates.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/general-settings/email-templates.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_roles_capabilities
          Parameters: No
          Description: This function is used to create roles and capabilities menu .
          Created On: 25-08-2016 14:50
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_roles_capabilities")) {

            function captcha_bank_roles_capabilities() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/general-settings/roles-and-capabilities.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/general-settings/roles-and-capabilities.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_login_logs
          Parameters: No
          Description: This function is used to create login logs menu .
          Created On: 25-08-2016 14:55
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_login_logs")) {

            function captcha_bank_login_logs() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();

                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/logs/login-logs.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/logs/login-logs.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_visitor_logs
          Parameters: No
          Description: This function is used to create visitor logs menu .
          Created On: 25-08-2016 15:00
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_visitor_logs")) {

            function captcha_bank_visitor_logs() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();

                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/logs/visitor-logs.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/logs/visitor-logs.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_live_traffic
          Parameters: No
          Description: This function is used to create live traffic menu .
          Created On: 25-08-2016 15:04
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_live_traffic")) {

            function captcha_bank_live_traffic() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();

                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/logs/live-traffic.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/logs/live-traffic.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_other_settings
          Parameters: No
          Description: This function is used to create other settings menu .
          Created On: 25-08-2016 15:08
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_other_settings")) {

            function captcha_bank_other_settings() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();

                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/other-settings/other-settings.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/other-settings/other-settings.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_blockage_settings
          Parameters: No
          Description: This function is used to create blockage settings menu .
          Created On: 25-08-2016 15:12
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_blockage_settings")) {

            function captcha_bank_blockage_settings() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/security-settings/blockage-settings.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/security-settings/blockage-settings.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_block_unblock_ip_addresses
          Parameters: No
          Description: This function is used to create block unblock ip address menu .
          Created On: 25-08-2016 15:16
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_block_unblock_ip_addresses")) {

            function captcha_bank_block_unblock_ip_addresses() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/security-settings/block-unblock-ip-address.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/security-settings/block-unblock-ip-address.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_block_unblock_ip_ranges
          Parameters: No
          Description: This function is used to create block unblock ip range menu .
          Created On: 25-08-2016 15:21
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_block_unblock_ip_ranges")) {

            function captcha_bank_block_unblock_ip_ranges() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/security-settings/block-unblock-ip-range.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/security-settings/block-unblock-ip-range.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_block_unblock_countries
          Parameters: No
          Description: This function is used to create block unblock country menu .
          Created On: 25-08-2016 15:21
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_block_unblock_countries")) {

            function captcha_bank_block_unblock_countries() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/security-settings/block-unblock-countries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/security-settings/block-unblock-countries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_feature_requests
          Parameters: No
          Description: This function is used to create feature request menu .
          Created On: 25-08-2016 15:25
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_feature_requests")) {

            function captcha_bank_feature_requests() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/feature-requests/feature-requests.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/feature-requests/feature-requests.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_system_information
          Parameters: No
          Description: This function is used to create system information .
          Created On: 25-08-2016 15:30
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_system_information")) {

            function captcha_bank_system_information() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();

                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/system-information/system-information.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/system-information/system-information.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_error_logs
          Parameters: No
          Description: This function is used for creating captcha_bank_error_logs menu.
          Created On: 4-01-2017 17:00
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_error_logs")) {

            function captcha_bank_error_logs() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/error-logs/error-logs.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/error-logs/error-logs.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }

        /*
          Function Name: captcha_bank_premium_editions
          Parameters: No
          Description: This function is used to create  premium_editions menu.
          Created On: 26-08-2016 11:59
          Created By: Tech Banker Team
         */

        if (!function_exists("captcha_bank_premium_editions")) {

            function captcha_bank_premium_editions() {
                global $wpdb;
                $user_role_permission = get_users_capabilities_captcha_bank();
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/translations.php")) {
                    include CAPTCHA_BANK_DIR_PATH . "includes/translations.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/header.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/header.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/sidebar.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/queries.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/queries.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "views/premium-editions/premium-editions.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "views/premium-editions/premium-editions.php";
                }
                if (file_exists(CAPTCHA_BANK_DIR_PATH . "includes/footer.php")) {
                    include_once CAPTCHA_BANK_DIR_PATH . "includes/footer.php";
                }
            }

        }
    }
}