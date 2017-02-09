<?php
/**
* This file is used for unscheduling schedulers.
*
* @author Tech Banker
* @package wp-captcha/lib
* @version 3.0.0
*/
if(!defined("ABSPATH")) exit; //exit if accessed directly
if(defined("DOING_CRON") && DOING_CRON)
{
	if(wp_verify_nonce($nonce_unblock_script, "unblock_script"))
	{
		if(strstr(scheduler_name,"ip_address_unblocker_"))
		{
			$meta_id = explode("ip_address_unblocker_",scheduler_name);
		}
		else
		{
			$meta_id = explode("ip_range_unblocker_",scheduler_name);
		}

		$where_parent = array();
		$where = array();
		$where_parent["id"] = $meta_id[1];
		$where["meta_id"] = $meta_id[1];

		$type = $wpdb->get_var
		(
			$wpdb->prepare
			(
				"SELECT type FROM " . captcha_bank_parent(). " WHERE id=%d",
				$meta_id[1]
			)
		);

		if($type != "")
		{
			$manage_ip = $wpdb->get_var
			(
				$wpdb->prepare
				(
					"SELECT meta_value FROM " . captcha_bank_meta()." WHERE meta_id=%d AND meta_key=%s",
					$meta_id[1],
					$type
				)
			);

			$ip_address_data_array = unserialize($manage_ip);

			$wpdb->delete(captcha_bank_parent(),$where_parent);
			$wpdb->delete(captcha_bank_meta(),$where);
			$obj_dbMailer_captcha_bank = new dbMailer_captcha_bank();
			switch($type)
			{
				case"block_ip_range":

					$email_when_ip_range_is_unblocked = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT meta_value FROM " .captcha_bank_meta()." WHERE meta_key=%s",
							"alert_setup"
						)
					);
					$email_when_ip_range_is_unblocked_unserialized = unserialize($email_when_ip_range_is_unblocked);
					if($email_when_ip_range_is_unblocked_unserialized["email_when_an_ip_range_is_unblocked"] == "enable")
					{
						$template_for_ip_range_unblocked = $wpdb->get_var
						(
							$wpdb->prepare
							(
								"SELECT meta_value FROM " .captcha_bank_meta()." WHERE meta_key=%s",
								"template_for_ip_range_unblocked"
							)
						);

						$template_for_ip_range_unblocked_unserialized = unserialize($template_for_ip_range_unblocked);
						$obj_dbMailer_captcha_bank->ip_range_mailCommand_captcha_bank($template_for_ip_range_unblocked_unserialized,$ip_address_data_array);
					}
				break;

				case "block_ip_address":
					$email_when_address_unblocked = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT meta_value FROM " .captcha_bank_meta()." WHERE meta_key=%s",
							"alert_setup"
						)
					);

					$email_when_ip_address_unblocked_unserialized = unserialize($email_when_address_unblocked);
					if($email_when_ip_address_unblocked_unserialized["email_when_an_ip_address_is_unblocked"] == "enable")
					{
						$template_for_ip_address_unblocked = $wpdb->get_var
						(
							$wpdb->prepare
							(
								"SELECT meta_value FROM " .captcha_bank_meta()." WHERE meta_key=%s",
								"template_for_ip_address_unblocked"
							)
						);

						$template_for_ip_address_unblocked_unserialized = unserialize($template_for_ip_address_unblocked);
						$obj_dbMailer_captcha_bank->ip_address_mailCommand_captcha_bank($template_for_ip_address_unblocked_unserialized,$ip_address_data_array);
					}
				break;
			}
		}
		wp_unschedule_captcha_bank(scheduler_name);
	}
}
?>
