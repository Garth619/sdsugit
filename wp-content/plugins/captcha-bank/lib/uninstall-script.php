<?php
/**
* This file contains code for remove tables and options at uninstall.
*
* @author	Tech Banker
* @package captcha-bank/lib
* @version 3.0.0
*/
if(!defined("ABSPATH")) exit; //exit if accessed directly
if(!is_user_logged_in())
{
	return;
}
else
{
	if(!current_user_can("manage_options"))
	{
		return;
	}
	else
	{
		global $wp_version, $wpdb;
		$user_role_permission = get_users_capabilities_captcha_bank();
		if(file_exists(CAPTCHA_BANK_DIR_PATH."lib/helper.php"))
		{
			include_once CAPTCHA_BANK_DIR_PATH."lib/helper.php";
		}
		$url = tech_banker_stats_url."/wp-admin/admin-ajax.php";
		$type = get_option("captcha-bank-wizard-set-up");

		delete_option("captcha-bank-wizard-set-up");

		$theme_details = array();

		if($wp_version >= 3.4)
		{
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
		$plugin_stat_data["event"] = "uninstall";
		$plugin_stat_data["domain_url"] = site_url();
		$plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();

		switch($type)
		{
			case "opt_in" :
				$plugin_stat_data["email"] = get_option("admin_email");
				$plugin_stat_data["wp_version"] = $wp_version;
				$plugin_stat_data["php_version"] = esc_html(phpversion());
				$plugin_stat_data["mysql_version"] = $wpdb->db_version();
				$plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
				$plugin_stat_data["operating_system"] =  PHP_OS ."  (".PHP_INT_SIZE * 8 .") BIT";
				$plugin_stat_data["php_memory_limit"] = ini_get("memory_limit")  ? ini_get("memory_limit") : "N/A";
				$plugin_stat_data["extensions"] = get_loaded_extensions();
				$plugin_stat_data["plugins"] = plugin_info_captcha_bank::get_plugin_info_captcha_bank();
				$plugin_stat_data["themes"] = $theme_details;
			break;
		}

		if(function_exists("curl_init"))
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
			http_build_query(array( "data" => serialize($plugin_stat_data), "site_id" => get_option("cpb_tech_banker_site_id") !="" ? get_option("cpb_tech_banker_site_id") : "", "action"=>"plugin_analysis_data")));
			$result = curl_exec($ch);
			delete_option("cpb_tech_banker_site_id");
			curl_close($ch);
		}
		else
		{
			$response = wp_safe_remote_post($url, array
			(
				"method" => "POST",
				"timeout" => 45,
				"redirection" => 5,
				"httpversion" => "1.0",
				"blocking" => false,
				"headers" => array(),
				"body" => array( "data" => serialize($plugin_stat_data), "site_id" => get_option("cpb_tech_banker_site_id") != "" ? get_option("cpb_tech_banker_site_id") : "", "action"=>"plugin_analysis_data")
			));
			if(!is_wp_error($response))
			{
				$response["body"] != "" ? delete_option("cpb_tech_banker_site_id") : "";
			}
			else
			{
				delete_option("cpb_tech_banker_site_id");
			}
		}
		if(count($wpdb->get_var("SHOW TABLES LIKE '" . captcha_bank_meta() . "'")) != 0 && count($wpdb->get_var("SHOW TABLES LIKE '" . captcha_bank_parent() . "'")) != 0)
		{
			$other_settings = $wpdb->get_var
			(
				$wpdb->prepare
				(
					"SELECT meta_value FROM " .captcha_bank_meta() .
					" WHERE meta_key = %s ",
					"other_settings"
				)
			);
			$other_settings_data = unserialize($other_settings);

			if($other_settings_data["remove_tables_at_uninstall"] == "enable")
			{

				$block_unblock_ip_range_and_address_scheduled = $wpdb->get_results
				(
					$wpdb->prepare
					(
						"SELECT * FROM ".captcha_bank_parent().
						" WHERE type IN(%s, %s) ",
						"block_ip_address",
						"block_ip_range"
					)
				);

				if(count($block_unblock_ip_range_and_address_scheduled) > 0)
				{
					foreach($block_unblock_ip_range_and_address_scheduled as $value)
					{
						if($value->type == "block_ip_address")
						{
							if(wp_next_scheduled("ip_address_unblocker_".$value->id))
							{
								wp_clear_scheduled_hook("ip_address_unblocker_".$value->id);
							}
						}
						elseif($value->type == "block_ip_range")
						{
							if(wp_next_scheduled("ip_range_unblocker_".$value->id))
							{
								wp_clear_scheduled_hook("ip_range_unblocker_".$value->id);
							}
						}
					}
				}

				$wpdb->query("DROP TABLE IF EXISTS " .captcha_bank_parent());
				$wpdb->query("DROP TABLE IF EXISTS " .captcha_bank_meta());

				delete_option("captcha-bank-version-number");
				delete_option("captcha_option");
			}

			if (wp_next_scheduled("automatic_updates_captcha_bank"))
			{
				wp_clear_scheduled_hook("automatic_updates_captcha_bank");
			}
			if (wp_next_scheduled("check_plugin_updates-captcha-bank"))
			{
				wp_clear_scheduled_hook("check_plugin_updates-captcha-bank");
			}
		}
	}
}
?>
