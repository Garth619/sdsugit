<?php
/**
* This file is used for fetching data from database.
*
* @author  Tech Banker
* @package captcha-bank/includes
* @version 3.0.0
*/

if(!defined("ABSPATH")) exit; //exit if accessed directly
if(!is_user_logged_in())
{
	return;
}
else
{
	$access_granted = false;
	foreach($user_role_permission as $permission)
	{
		if(current_user_can($permission))
		{
			$access_granted = true;
			break;
		}
	}
	if(!$access_granted)
	{
		return;
	}
	else
	{
		$cpb_data_logs = array();

		if(!function_exists("get_captcha_bank_log_data_unserialize"))
		{
			function get_captcha_bank_log_data_unserialize($data,$start_date,$end_date)
			{
				$array_details = array();
				foreach ($data as $raw_row)
				{
					$row = unserialize($raw_row->meta_value);

					if($row["date_time"] >=$start_date && $row["date_time"] <= $end_date)
					array_push($array_details,$row);
				}
				return $array_details;
			}
		}

		if(!function_exists("get_captcha_bank_meta_data"))
		{
			function get_captcha_bank_meta_data($meta_key)
			{
				global $wpdb;
				$data = $wpdb->get_var
				(
					$wpdb->prepare
					(
						"SELECT meta_value FROM ".captcha_bank_meta()."
						WHERE meta_key=%s",
						$meta_key
					)
				);
				return unserialize($data);
			}
		}
		if(isset($_GET["page"]))
		{
			switch(esc_attr($_GET["page"]))
			{
				case "captcha_bank":
					$meta_data_array = get_captcha_bank_meta_data("captcha_type");
					if(!function_exists("get_fonts_captcha_bank"))
					{
						function get_fonts_captcha_bank($url)
						{
							if(function_exists("curl_init"))
							{
								$curl_handler = curl_init();
								curl_setopt($curl_handler,CURLOPT_URL,$url);
								curl_setopt($curl_handler,CURLOPT_RETURNTRANSFER,TRUE);
								curl_setopt($curl_handler, CURLOPT_CONNECTTIMEOUT, 5);
								curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER, false);
								$font = curl_exec($curl_handler);
							}
							else
							{
								$font = @file_get_contents($url);
							}
							return $font;
						}
					}
				break;

				case "captcha_bank_message_settings":
					$error_messages_unserialize_data = get_captcha_bank_meta_data("error_message");
				break;

				case "captcha_bank_display_settings":
					$display_settings_unserialized_data = get_captcha_bank_meta_data("display_settings");
					$captcha_type_unserialized_data = get_captcha_bank_meta_data("captcha_type");
				break;

				case "captcha_bank_notifications_setup":
					$meta_data_array = get_captcha_bank_meta_data("alert_setup");
				break;

				case "captcha_bank_live_traffic":
					$live_traffic_data_unserialize = get_captcha_bank_meta_data("other_settings");
					if($live_traffic_data_unserialize["live_traffic_monitoring"] == "enable")
					{
						$end_date = time();
						$start_date = $end_date - 60;
						$captcha_manage = $wpdb->get_results
						(
							$wpdb->prepare
							(
								"SELECT * FROM ".captcha_bank_meta()."
								WHERE meta_key = %s ORDER BY meta_id DESC",
								"visitor_logs_data"
							)
						);
						$cpb_data_logs = get_captcha_bank_log_data_unserialize($captcha_manage,$start_date,$end_date);
					}
				break;

				case "captcha_bank_login_logs":
					$end_date = time() + 86340;
					$start_date = $end_date - 691140;
					$captcha_manage = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM ".captcha_bank_meta(). "
							WHERE meta_key = %s ORDER BY meta_id DESC",
							"recent_login_data"
						)
					);
					$cpb_data_logs = get_captcha_bank_log_data_unserialize($captcha_manage,$start_date,$end_date);
				break;

				case "captcha_bank_visitor_logs":
					$visitor_logs_data_unserialize = get_captcha_bank_meta_data("other_settings");
					if($visitor_logs_data_unserialize["visitor_logs_monitoring"] == "enable")
					{
						$end_date = time() + 86340;
						$start_date = $end_date - 691140;
						$captcha_manage = $wpdb->get_results
						(
							$wpdb->prepare
							(
								"SELECT * FROM ".captcha_bank_meta()."
								WHERE meta_key = %s ORDER BY meta_id DESC",
								"visitor_logs_data"
							)
						);
						$cpb_data_logs = get_captcha_bank_log_data_unserialize($captcha_manage,$start_date,$end_date);
					}
				break;

				case "captcha_bank_blockage_settings":
					$blocking_options_unserialized_data = get_captcha_bank_meta_data("blocking_options");
				break;

				case "captcha_bank_block_unblock_ip_addresses":
					$end_date = time() + 86340;
					$start_date = $end_date - 691140;
					$manage_ip = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM ".captcha_bank_meta()."
							WHERE meta_key = %s ORDER BY meta_id DESC",
							"block_ip_address"
						)
					);
					$manage_ip_address_date = get_captcha_bank_log_data_unserialize($manage_ip,$start_date,$end_date);
				break;

				case "captcha_bank_block_unblock_ip_ranges":
					$end_date = time() + 86340;
					$start_date = $end_date - 691140;
					$manage_range = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM ".captcha_bank_meta()."
							WHERE meta_key = %s ORDER BY meta_id DESC",
							"block_ip_range"
						)
					);
					$manage_ip_range_date = get_captcha_bank_log_data_unserialize($manage_range,$start_date,$end_date);
				break;

				case "captcha_bank_block_unblock_countries":
					$country_data_array = get_captcha_bank_meta_data("country_blocks");
				break;

				case "captcha_bank_other_settings":
					$meta_data_array = get_captcha_bank_meta_data("other_settings");
				break;

				case "captcha_bank_roles_capabilities":
					$details_roles_capabilities = get_captcha_bank_meta_data("roles_and_capabilities");
					$other_roles_array = $details_roles_capabilities["capabilities"];
				break;
			}
		}
	}
}
?>