<?php
/**
 * This file contains code for remove tables and options at uninstall.
 *
 * @author	Tech Banker
 * @package     captcha-bank
 * @version     3.0.0
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
   die;
} else {
   if (!current_user_can("manage_options")) {
      return;
   } else {

      $version = get_option("captcha-bank-version-number");
      if ($version != "") {
         global $wp_version, $wpdb;
         $other_settings = $wpdb->get_var
             (
             $wpdb->prepare
                 (
                 "SELECT meta_value FROM " . $wpdb->prefix . "captcha_bank_meta
                             WHERE meta_key = %s ", "other_settings"
             )
         );
         $other_settings_data = maybe_unserialize($other_settings);

         if (esc_attr($other_settings_data["remove_tables_at_uninstall"]) == "enable") {


            $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "captcha_bank");
            $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "captcha_bank_meta");

            delete_option("captcha-bank-version-number");
            delete_option("captcha-bank-wizard-set-up");
            delete_option("cpb_tech_banker_site_id");
            delete_option("captcha_option");
         }
      }
   }
}
