<?php

/**
 * This file is used for creating dbHelper class.
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
        /*
          Class Name: dbHelper_captcha_bank
          Parameters: No
          Description: This Class is used for Insert, Update & Delete Operations.
          Created On: 25-08-2016 10:02
          Created By: Tech Banker Team
         */

        class dbHelper_captcha_bank {
            /*
              Function Name: insertCommand
              Parameters: Yes($table_name,$data)
              Description: This Function is used to Insert data in database.
              Created On: 25-08-2016 10:04
              Created By: Tech Banker Team
             */

            function insertCommand($table_name, $data) {
                global $wpdb;
                $wpdb->insert($table_name, $data);
                return $wpdb->insert_id;
            }

            /*
              Function Name: updateCommand
              Parameters: Yes($table,$data,$where)
              Description: This function is used to update data in database.
              Created On: 25-08-2016 10:05
              Created By: Tech Banker Team
             */

            function updateCommand($table, $data, $where) {
                global $wpdb;
                $wpdb->update($table, $data, $where, $format = null, $where_format = null);
            }

            /*
              Function Name: deleteCommand
              Parameters: Yes($table_name,$where)
              Description: This function is used to delete data from database.
              Created On: 25-08-2016 10:06
              Created By: Tech Banker Team
             */

            function deleteCommand($table_name, $where) {
                global $wpdb;
                $wpdb->delete($table_name, $where);
            }

            /*
              Function Name: file_reader
              Parameters: No
              Decription: This function is used to file read.
              Created On: 05-01-2017 16:30
              Created By: Tech Banker Team
             */

            public static function file_reader($filePath) {
                $reader = "";
                if (file_exists($filePath)) {
                    $reader = file_get_contents($filePath);
                }
                return $reader;
            }

            /*
              Function Name: clear_error_log
              Parameters: No
              Decription: This function is used to clear Error Logs.
              Created On: 05-01-2017 16:30
              Created By: Tech Banker Team
             */

            public static function clear_error_log($filePath) {
                if (file_exists($filePath)) {
                    file_put_contents($filePath, "");
                }
            }

        }

        /*
          Class Name: plugin_info_captcha_bank
          Parameters: No
          Description: This Class is used to get the the information about plugins.
          Created On: 11-04-2017 11:19
          Created By: Tech Banker Team
         */

        class plugin_info_captcha_bank {
            /*
              Function Name: get_plugin_info_captcha_bank
              Parameters: No
              Decription: This function is used to return the information about plugins.
              Created On: 11-04-2017 11:19
              Created By: Tech Banker Team
             */

            function get_plugin_info_captcha_bank() {
                $active_plugins = (array) get_option("active_plugins", array());
                if (is_multisite()) {
                    $active_plugins = array_merge($active_plugins, get_site_option("active_sitewide_plugins", array()));
                }
                $plugins = array();
                if (count($active_plugins) > 0) {
                    $get_plugins = array();
                    foreach ($active_plugins as $plugin) {
                        $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);

                        $get_plugins["plugin_name"] = strip_tags($plugin_data["Name"]);
                        $get_plugins["plugin_author"] = strip_tags($plugin_data["Author"]);
                        $get_plugins["plugin_version"] = strip_tags($plugin_data["Version"]);
                        array_push($plugins, $get_plugins);
                    }
                    return $plugins;
                }
            }

        }

    }
}