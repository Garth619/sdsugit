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

				$wpdb->query("DROP TABLE " .captcha_bank_parent());
				$wpdb->query("DROP TABLE " .captcha_bank_meta());

				delete_option("captcha-bank-version-number");
				delete_option("captcha_option");
			}

			if (wp_next_scheduled("automatic_updates_captcha_bank"))
			{
				wp_clear_scheduled_hook("automatic_updates_captcha_bank");
			}
			if (wp_next_scheduled("check_plugin_updates-captcha-bank-business-edition"))
			{
				wp_clear_scheduled_hook("check_plugin_updates-captcha-bank-business-edition");
			}
		}
	}
}
?>
