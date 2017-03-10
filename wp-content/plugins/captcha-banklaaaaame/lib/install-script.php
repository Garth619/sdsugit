<?php
/**
* This file is used for creating database on activation Hook.
*
* @author  Tech Banker
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
		/*
		Class Name: dbHelper_install_script_captcha_bank
		Parameters: No
		Description: This Class is used for Database Operations.
		Created On: 25-08-2016 09:38
		Created By: Tech Banker Team
		*/

		if(!class_exists("dbHelper_install_script_captcha_bank"))
		{
			class dbHelper_install_script_captcha_bank
			{
				/*
				Function Name: insertCommand
				Parameters: Yes($table_name,$data)
				Description: This Function is used for Insert data in database.
				Created On: 25-08-2016 10:00
				Created By: Tech Banker Team
				*/

				function insertCommand($table_name,$data)
				{
					global $wpdb;
					$wpdb->insert($table_name,$data);
					return $wpdb->insert_id;
				}

				/*
				Function Name: updateCommand
				Parameters: Yes($table_name,$data,$where)
				Description: This function is used for Update data.
				Created On: 25-08-2016 10:00
				Created By: Tech Banker Team
				*/

				function updateCommand($table_name,$data,$where)
				{
					global $wpdb;
					$wpdb->update($table_name,$data,$where);
				}
			}
		}

		require_once ABSPATH ."wp-admin/includes/upgrade.php";
		$captcha_version_no = get_option("captcha-bank-version-number");

		/*
		Function Name: cpb_captcha_bank_parent
		Parameter: No
		Description: This function is used for creating "captcha_bank" table in database.
		Created On: 25-08-2016 13:13
		Created By: Tech Banker Team
		*/

		if(!function_exists("cpb_captcha_bank_parent"))
		{
			function cpb_captcha_bank_parent()
			{
				global $wpdb;
				$obj_dbHelper_install_parent = new dbHelper_install_script_captcha_bank();
				$sql = "CREATE TABLE IF NOT EXISTS ". captcha_bank_parent() ."
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`type` longtext NOT NULL,
					`parent_id` int(10) NOT NULL,
					PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COLLATE= utf8_general_ci";
				dbDelta($sql);

				$data = "INSERT INTO ". captcha_bank_parent() ." (`type`, `parent_id`) VALUES
				('captcha_setup', 0),
				('general_settings', 0),
				('logs','0'),
				('other_settings', 0),
				('advance_security', 0);";
				dbDelta($data);

				$parent_table_data = $wpdb->get_results
				(
					"SELECT * FROM ".captcha_bank_parent()
				);

				foreach($parent_table_data as $row)
				{
					switch($row->type)
					{
						case "captcha_setup":
							$insert_captcha_setup_array = array();
							$insert_captcha_setup_array["captcha_type"] = $row->id;
							$insert_captcha_setup_array["display_settings"] = $row->id;

							$insert_captcha_setup_data = array();
							foreach($insert_captcha_setup_array as $key => $value)
							{
								$insert_captcha_setup_data["type"] = $key;
								$insert_captcha_setup_data["parent_id"] = $value;
								$obj_dbHelper_install_parent->insertCommand(captcha_bank_parent(),$insert_captcha_setup_data);
							}
						break;

						case "general_settings":
							$insert_parent_data = array();
							$insert_parent_data["alert_setup"] = $row->id;
							$insert_parent_data["error_message"] = $row->id;
							$insert_parent_data["email_templates"] = $row->id;
							$insert_parent_data["roles_and_capabilities"] = $row->id;
							foreach($insert_parent_data as $key => $value)
							{
								$parent_value = array();
								$parent_value["type"] = $key;
								$parent_value["parent_id"] = $value;
								$obj_dbHelper_install_parent->insertCommand(captcha_bank_parent(),$parent_value);
							}
						break;

						case "advance_security":
							$insert_advance_security_array = array();
							$insert_advance_security_array["blocking_options"] = $row->id;
							$insert_advance_security_array["country_blocks"] = $row->id;

							$insert_advance_security_data = array();
							foreach($insert_advance_security_array as $key =>$value)
							{
								$insert_advance_security_data["type"] = $key;
								$insert_advance_security_data["parent_id"] = $value;
								$obj_dbHelper_install_parent->insertCommand(captcha_bank_parent(),$insert_advance_security_data);
							}
						break;
					}
				}
			}
		}

		/*
		Function Name: cpb_captcha_bank_meta
		Parameter: No
		Description: This function is used for creating "captcha_bank_meta" table in database.
		Created On: 25-08-2016 13:15
		Created By: Tech Banker Team
		*/

		if(!function_exists("cpb_captcha_bank_meta"))
		{
			function cpb_captcha_bank_meta()
			{
				global $wpdb;
				$obj_dbHelper_install_meta_table = new dbHelper_install_script_captcha_bank();
				$sql = "CREATE TABLE IF NOT EXISTS ". captcha_bank_meta() ."
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`meta_id` int(10) NOT NULL,
					`meta_key` varchar(200) NOT NULL,
					`meta_value` longtext NOT NULL,
					PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COLLATE= utf8_general_ci";
				dbDelta($sql);
				$admin_email = get_option("admin_email");
				$admin_name = get_option("blogname");
				$parent_table_data = $wpdb->get_results
				(
					"SELECT * FROM ".captcha_bank_parent()
				);

				foreach($parent_table_data as $row)
				{
					switch($row->type)
					{
						case "captcha_type":
							$captcha_type_array = array();
							$captcha_type_array["captcha_type_text_logical"] = "logical_captcha";
							$captcha_type_array["captcha_characters"] = "4";
							$captcha_type_array["captcha_type"] = "alphabets_and_digits";
							$captcha_type_array["text_case"] = "upper_case";
							$captcha_type_array["case_sensitive"] = "enable";
							$captcha_type_array["captcha_width"] = "225";
							$captcha_type_array["captcha_height"] = "70";
							$captcha_type_array["captcha_background"] = "bg4.jpg";
							$captcha_type_array["border_style"] = "0,solid,#cccccc";
							$captcha_type_array["lines"] = "5";
							$captcha_type_array["lines_color"] = "#707070";
							$captcha_type_array["noise_level"] = "100";
							$captcha_type_array["noise_color"] = "#707070";
							$captcha_type_array["text_transperancy"] = "10";
							$captcha_type_array["signature_text"] = "Captcha Bank";
							$captcha_type_array["signature_style"] = "7,#ff0000";
							$captcha_type_array["signature_font"] = "Roboto:100";
							$captcha_type_array["text_shadow_color"] = "#cfc6cf";
							$captcha_type_array["mathematical_operations"] = "arithmetic";
							$captcha_type_array["arithmetic_actions"] = "1,1,1,1";
							$captcha_type_array["relational_actions"] = "1,1";
							$captcha_type_array["arrange_order"] = "1,1";
							$captcha_type_array["text_style"] = "24,#000000";
							$captcha_type_array["text_font"] = "Roboto";

							$captcha_type_data = array();
							$captcha_type_data["meta_id"] = $row->id;
							$captcha_type_data["meta_key"] = "captcha_type";
							$captcha_type_data["meta_value"] = serialize($captcha_type_array);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$captcha_type_data);
						break;

						case "error_message":
							$error_message_data = array();
							$error_message_data["for_login_attempts_error"] = "<p>Your Maximum Login Attempts left : <strong>[maxAttempts]</strong></p>";
							$error_message_data["for_invalid_captcha_error"] = "You have entered an Invalid Captcha. Please try again.";
							$error_message_data["for_blocked_ip_address_error"] = "<p>Your IP Address <strong>[ip_address]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the Website Administrator for more details.</p>";
							$error_message_data["for_captcha_empty_error"] = "Your Captcha is Empty. Please enter Captcha and try again.";
							$error_message_data["for_blocked_ip_range_error"] = "<p>Your IP Range <strong>[ip_range]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the Website Administrator for more details.</p>";
							$error_message_data["for_blocked_country_error"] = "<p>Unfortunately, your country location <strong>[country_location]</strong> has been blocked by the Administrator for security purposes.</p><p>Please contact the website Administrator for more details.</p>";

							$insert_error_message_data = array();
							$insert_error_message_data["meta_id"] = $row->id;
							$insert_error_message_data["meta_key"] = "error_message";
							$insert_error_message_data["meta_value"] = serialize($error_message_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_error_message_data);
						break;

						case "display_settings":
							$display_setting_data = array();
							$display_setting_data["settings"] = "1,1,1,1,0,1,0,0,0";

							$insert_display_settings_data = array();
							$insert_display_settings_data["meta_id"] = $row->id;
							$insert_display_settings_data["meta_key"] = "display_settings";
							$insert_display_settings_data["meta_value"] = serialize($display_setting_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_display_settings_data);
						break;

						case "alert_setup":
							$alert_setup_data = array();
							$alert_setup_data["email_when_a_user_fails_login"] = "enable";
							$alert_setup_data["email_when_a_user_success_login"] = "enable";
							$alert_setup_data["email_when_an_ip_address_is_blocked"] = "enable";
							$alert_setup_data["email_when_an_ip_address_is_unblocked"] = "enable";
							$alert_setup_data["email_when_an_ip_range_is_blocked"] = "enable";
							$alert_setup_data["email_when_an_ip_range_is_unblocked"] = "enable";

							$insert_alert_setup_data = array();
							$insert_alert_setup_data["meta_id"] = $row->id;
							$insert_alert_setup_data["meta_key"] = "alert_setup";
							$insert_alert_setup_data["meta_value"] = serialize($alert_setup_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_alert_setup_data);
						break;

						case "roles_and_capabilities":
							$roles_and_capabilities_data = array();
							$roles_and_capabilities_data["roles_and_capabilities"] = "1,1,1,0,0,0,1";
							$roles_and_capabilities_data["administrator_privileges"] = "1,1,1,1,1,1,1,1,1";
							$roles_and_capabilities_data["author_privileges"] = "0,0,1,1,0,1,0,0,1";
							$roles_and_capabilities_data["editor_privileges"] = "0,0,1,0,0,1,0,1,1";
							$roles_and_capabilities_data["contributor_privileges"] = "0,0,1,0,0,1,0,0,1";
							$roles_and_capabilities_data["subscriber_privileges"] = "0,0,0,0,0,0,0,0,0";
							$roles_and_capabilities_data["others_full_control_capability"] = "0";
							$roles_and_capabilities_data["other_privileges"] = "0,0,0,0,0,0,0,0,0";
							$roles_and_capabilities_data["show_captcha_bank_top_bar_menu"] = "enable";

							$user_capabilities = get_others_capabilities_captcha_bank();
							$other_roles_array = array();
							$other_roles_access_array = array(
								"manage_options",
								"edit_plugins",
								"edit_posts",
								"publish_posts",
								"publish_pages",
								"edit_pages",
								"read"
							);
							foreach($other_roles_access_array as $role)
							{
								if(in_array($role,$user_capabilities))
								{
									array_push($other_roles_array,$role);
								}
							}
							$roles_and_capabilities_data["capabilities"] = $other_roles_array;

							$insert_roles_and_capabilities_data = array();
							$insert_roles_and_capabilities_data["meta_id"] = $row->id;
							$insert_roles_and_capabilities_data["meta_key"] = "roles_and_capabilities";
							$insert_roles_and_capabilities_data["meta_value"] = serialize($roles_and_capabilities_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_roles_and_capabilities_data);
						break;

						case "blocking_options":
							$blocking_options_data = array();
							$blocking_options_data["auto_ip_block"] = "enable";
							$blocking_options_data["maximum_login_attempt_in_a_day"] = "5";
							$blocking_options_data["block_for_time"] = "1Hour";

							$insert_blocking_options_data = array();
							$insert_blocking_options_data["meta_id"] = $row->id;
							$insert_blocking_options_data["meta_key"] = "blocking_options";
							$insert_blocking_options_data["meta_value"] = serialize($blocking_options_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_blocking_options_data);
						break;

						case "country_blocks":
							$blocking_options_data = array();
							$blocking_options_data["country_block_data"] = "";

							$insert_blocking_options_data = array();
							$insert_blocking_options_data["meta_id"] = $row->id;
							$insert_blocking_options_data["meta_key"] = "country_blocks";
							$insert_blocking_options_data["meta_value"] = serialize($blocking_options_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_blocking_options_data);
						break;

						case "email_templates":
							$email_templates_data = array();
							$email_templates_data["template_for_user_success"] = "<p>Hi,</p><p>A login attempt has been successfully made to your website [site_url] from user <strong>[username]</strong> at [date_time] from IP Address <strong>[ip_address]</strong>.</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Username:</strong> [username]</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]</p><p><strong>IP Address:</strong>[ip_address]</p><p><strong>Resource:</strong>[resource]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
							$email_templates_data["template_for_user_failure"] = "<p>Hi,</p><p>An unsuccessful attempt to login at your website [site_url] was being made by user <strong>[username]</strong> at [date_time] from IP Address <strong>[ip_address]</strong>.</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Username:</strong> [username]</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]<p><strong>IP Address:</strong> [ip_address]</p><strong>Resource:</strong>[resource]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
							$email_templates_data["template_for_ip_address_blocked"] = "<p>Hi,</p><p>An IP Address <strong>[ip_address]</strong> has been Blocked <strong>[blocked_for]</strong> to your website [site_url].</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p><strong>Resource:</strong>[resource]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
							$email_templates_data["template_for_ip_address_unblocked"] = "<p>Hi,</p><p>An IP Address <strong>[ip_address]</strong> has been Unblocked from your website [site_url] </p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p>Thanks & Regards</p><p>Technical Support Team</p><p>[site_url]</p>";
							$email_templates_data["template_for_ip_range_blocked"] = "<p>Hi,</p><p>An IP Range from <strong>[start_ip_range]</strong> to <strong>[end_ip_range]</strong> has been Blocked <strong>[blocked_for]</strong> to your website [site_url].</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]</p><strong>IP Address:</strong> [ip_range]</p><p><strong>Resource:</strong>[resource]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
							$email_templates_data["template_for_ip_range_unblocked"] = "<p>Hi,</p><p>An IP Range from <strong>[start_ip_range]</strong> to <strong>[end_ip_range]</strong> has been Unblocked from your website [site_url] .</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_range]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";

							$email_templates_message = array("Login Success Notification- Captcha Bank","Login Failure Notification- Captcha Bank","IP Address Blocked Notification - Captcha Bank","IP Address Unblocked Notification - Captcha Bank","IP Range Blocked Notification - Captcha Bank","IP Range Unblocked Notification - Captcha Bank");
							$count = 0;
							foreach($email_templates_data as $key => $value)
							{
								$email_templates_data_array = array();
								$email_templates_data_array["send_to"] = $admin_email;
								$email_templates_data_array["email_cc"] = "";
								$email_templates_data_array["email_bcc"] = "";
								$email_templates_data_array["email_subject"] = $email_templates_message[$count];
								$email_templates_data_array["email_message"] = $value;
								$count++;

								$insert_email_templates_data = array();
								$insert_email_templates_data["meta_id"] = $row->id;
								$insert_email_templates_data["meta_key"] = $key;
								$insert_email_templates_data["meta_value"] = serialize($email_templates_data_array);
								$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_email_templates_data);
							}
						break;

						case "other_settings":
							$other_settings_data = array();
							$other_settings_data["automatic_plugin_updates"] = "disable";
							$other_settings_data["remove_tables_at_uninstall"] = "enable";
							$other_settings_data["live_traffic_monitoring"] = "disable";
							$other_settings_data["visitor_logs_monitoring"] = "disable";
							$other_settings_data["ip_address_fetching_method"] = "";

							$insert_other_settings_data = array();
							$insert_other_settings_data["meta_id"] = $row->id;
							$insert_other_settings_data["meta_key"] = "other_settings";
							$insert_other_settings_data["meta_value"] = serialize($other_settings_data);
							$obj_dbHelper_install_meta_table->insertCommand(captcha_bank_meta(),$insert_other_settings_data);
						break;
					}
				}
			}
		}


		$obj_dbHelper_captcha_bank = new dbHelper_install_script_captcha_bank();
		switch($captcha_version_no)
		{
			case "":
				cpb_captcha_bank_parent();
				cpb_captcha_bank_meta();
			break;

			default:
				if(wp_next_scheduled("check_plugin_updates-captcha-bank-pro-edition"))
				{
					wp_clear_scheduled_hook("check_plugin_updates-captcha-bank-pro-edition");
				}
				if(wp_next_scheduled("wp_captcha_bank_scheduler"))
				{
					wp_clear_scheduled_hook("wp_captcha_bank_scheduler");
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '" . captcha_bank_parent() . "'")) == 0)
				{
					cpb_captcha_bank_parent();
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '" . captcha_bank_meta() . "'")) == 0)
				{
					cpb_captcha_bank_meta();
				}
				else
				{
					$other_settings_data = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT meta_value FROM ".captcha_bank_meta().
							" WHERE meta_key = %s",
							"other_settings"
						)
					);
					$other_settings_unserialize_data = unserialize($other_settings_data);

					$other_settings_unserialize_data["live_traffic_monitoring"] = "disable";
					$other_settings_unserialize_data["visitor_logs_monitoring"] = "disable";
					if(!array_key_exists("ip_address_fetching_method", $other_settings_unserialize_data))
					{
						$other_settings_unserialize_data["ip_address_fetching_method"] = "";
					}

					$where = array();
					$update_other_settings_data = array();

					$where["meta_key"] = "other_settings";
					$update_other_settings_data["meta_value"] = serialize($other_settings_unserialize_data);
					$obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(),$update_other_settings_data,$where);
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '". $wpdb->prefix."captcha_bank_settings'")) != 0)
				{
					$old_captcha_settings = $wpdb->get_results
					(
						"SELECT * FROM ".$wpdb->prefix."captcha_bank_settings"
					);
					$wpdb->query("DROP TABLE ".$wpdb->prefix."captcha_bank_settings");
					if(count($old_captcha_settings) > 0)
					{
						$captcha_setup_data = array();
						$captcha_display_settings = "";
						$captcha_display = "";
						$display_settings_data = array();
						$cb_message_settings_data = array();
						$blockage_settings_data = array();
						$border_style = "";
						$font_style = "";
						$font_style1 = "";
						foreach($old_captcha_settings as $key)
						{
							switch($key->settings_key)
							{
								case "captcha_characters" :
									$captcha_setup_data["captcha_characters"] = isset($key->settings_value) ? $key->settings_value : "4";
								break;
								case "captcha_type" :
									$captcha_setup_data["captcha_type"] = isset($key->settings_value) && (($key->settings_value) == "both") ? "alphabets_and_digits" : ((($key->settings_value) == "alphabets") ? "only_alphabets" : "only_digits");
								break;
								case "text_case" :
									$captcha_setup_data["text_case"] = isset($key->settings_value) && (($key->settings_value) == "upper") ? "upper_case" : ((($key->settings_value) == "lower") ? "lower_case" : "random");
								break;
								case "captcha_case_sensitive" :
									$captcha_setup_data["case_sensitive"] = isset($key->settings_value) ? $key->settings_value == 1 ? "enable" : "disable" : "enable";
								break;
								case "captcha_width" :
									$captcha_setup_data["captcha_width"] = isset($key->settings_value) ? $key->settings_value : "180";
								break;
								case "captcha_height" :
									$captcha_setup_data["captcha_height"] = isset($key->settings_value) ? $key->settings_value : "60";
								break;
								case "background_image" :
									$captcha_setup_data["captcha_background"] = isset($key->settings_value) ? $key->settings_value : "bg4.jpg";
								break;
								case "font_size" :
									$font_style = isset($key->settings_value) ? $key->settings_value : "20";
								break;
								case "captcha_text_color" :
									$font_style1 = isset($key->settings_value) ? $key->settings_value : "#000000";
								break;
								case "captcha_font" :
									$captcha_setup_data["text_font"] = "Roboto";
								break;
								case "border_size" :
									$border = isset($key->settings_value) ? $key->settings_value : "0";
									$border_style = $border.",solid,";
								break;
								case "border_color" :
									$border_style .= isset($key->settings_value) ? $key->settings_value : "#cccccc";
									$captcha_setup_data["border_style"] = $border_style;
								break;
								case "no_of_lines" :
									$captcha_setup_data["lines"] = isset($key->settings_value) ? $key->settings_value : "2";
								break;
								case "lines_color" :
									$captcha_setup_data["lines_color"] = isset($key->settings_value) ? $key->settings_value : "#cc1f1f";
								break;
								case "noise_level" :
									$captcha_setup_data["noise_level"] =  isset($key->settings_value) ? $key->settings_value : "5";
								break;
								case "noise_color" :
									$captcha_setup_data["noise_color"] = isset($key->settings_value) ? $key->settings_value : "#cc1f1f";
								break;
								case "trasparency_percentage" :
									$captcha_setup_data["text_transperancy"] = isset($key->settings_value) ? $key->settings_value : "10";
								break;
								case "signature" :
									$captcha_setup_data["signature_text"] = isset($key->settings_value) ? $key->settings_value : "Captcha Bank";
								break;
								case "signature_color" :
									$signature_color = isset($key->settings_value) ? $key->settings_value : "#cccccc";
									$captcha_setup_data["signature_style"] = "8," .$signature_color;
								break;
								case "captcha_for_login" :
									$captcha_display_settings = isset($key->settings_value) ? $key->settings_value."," : "1,";
								break;
								case "captcha_for_register" :
									$captcha_display_settings .= isset($key->settings_value) ? $key->settings_value."," : "1,";
								break;
								case "captcha_for_reset_password" :
									$captcha_display_settings .= isset($key->settings_value) ? $key->settings_value."," : "1,";
								break;
								case "captcha_for_comment" :
									$captcha_display_settings .= isset($key->settings_value) ? $key->settings_value."," : "1,";
								break;
								case "captcha_for_admin_comment" :
									$captcha_display_settings .= isset($key->settings_value) ? $key->settings_value."," : "0,";
								break;
								case "hide_captcha_for_reg_user" :
									$captcha_display_settings .= isset($key->settings_value) ? $key->settings_value."," : "0,";
								break;
								case "captcha_empty_msg" :
									$cb_message_settings_data["for_captcha_empty_error"] = isset($key->settings_value) ? $key->settings_value : "Your Captcha is Empty. Please enter Captcha and try again.";
								break;
								case "captcha_invalid_msg" :
									$cb_message_settings_data["for_invalid_captcha_error"] = isset($key->settings_value) ? $key->settings_value : "You have entered an Invalid Captcha. Please try again.";
								break;
								case "ip_block_msg" :
									$cb_message_settings_data["for_blocked_ip_address_error"] = isset($key->settings_value) ? $key->settings_value : "<p>Your IP Address <strong>[ip_address]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the Website Administrator for more details.</p>";
								break;
								case "max_login_msg" :
									$cb_message_settings_data["for_login_attempts_error"] = isset($key->settings_value) ? $key->settings_value : "<p>Your Maximum Login Attempts left : <strong>[maxAttempts]</strong></p>";
								break;
								case "auto_ip_block" :
									$blockage_settings_data["auto_ip_block"] = isset($key->settings_value) ? $key->settings_value == 1 ? "enable" : "disable" : "disable";
								break;
								case "max_login_attempts" :
									$blockage_settings_data["maximum_login_attempt_in_a_day"] = isset($key->settings_value) ? $key->settings_value : "5";
								break;
							}
						}

						$captcha_setup_data["captcha_type_text_logical"] = "logical_captcha";
						$captcha_setup_data["text_style"] = $font_style.",".$font_style1;
						$captcha_setup_data["signature_font"] = "Roboto:100";
						$captcha_setup_data["text_shadow_color"] = "#cfc6cf";
						$captcha_setup_data["mathematical_operations"] = "arithmetic";
						$captcha_setup_data["arithmetic_actions"] = "1,1,1,1";
						$captcha_setup_data["relational_actions"] = "1,1";
						$captcha_setup_data["arrange_order"] = "1,1";
						$captcha_display = "0,0,0";
						$cb_message_settings_data["for_blocked_ip_range_error"] = "<p><p>Your IP Range <strong>[ip_range]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the Website Administrator for more details.</p>";
						$cb_message_settings_data["for_blocked_country_error"] = "<p>Unfortunately, your country location <strong>[country_location]</strong> has been blocked by the Administrator for security purposes.</p><p>Please contact the website Administrator for more details.</p>";
						$blockage_settings_data["block_for_time"] = "1Hour";

						$display_settings_data["settings"] = $captcha_display_settings. $captcha_display;
						$captcha_setup_where = array();
						$display_settings_where = array();
						$message_settings_where = array();
						$blockage_settings_where = array();
						$captcha_setup_update_serialize = array();
						$display_settings_update_serialize = array();
						$message_settings_update_serialize = array();
						$blockage_settings_update_serialize = array();
						$captcha_setup_where["meta_key"] = "captcha_type";
						$display_settings_where["meta_key"] = "display_settings";
						$message_settings_where["meta_key"] = "error_message";
						$blockage_settings_where["meta_key"] = "blocking_options";
						$captcha_setup_update_serialize["meta_value"] = serialize($captcha_setup_data);
						$display_settings_update_serialize["meta_value"] = serialize($display_settings_data);
						$message_settings_update_serialize["meta_value"] = serialize($cb_message_settings_data);
						$blockage_settings_update_serialize["meta_value"] = serialize($blockage_settings_data);
						$obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(),$captcha_setup_update_serialize,$captcha_setup_where);
						$obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(),$display_settings_update_serialize,$display_settings_where);
						$obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(),$message_settings_update_serialize,$message_settings_where);
						$obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(),$blockage_settings_update_serialize,$blockage_settings_where);
					}
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '". $wpdb->prefix."captcha_bank_login_log'")) != 0)
				{
					$old_login_logs_data = $wpdb->get_results
					(
						"SELECT * FROM ".$wpdb->prefix."captcha_bank_login_log"
					);
					$wpdb->query("DROP TABLE ".$wpdb->prefix."captcha_bank_login_log");
					if(count($old_login_logs_data) > 0)
					{
						$get_parent_id = $wpdb->get_var
						(
							$wpdb->prepare
							(
								"SELECT id FROM " . captcha_bank_parent()."
								WHERE type = %s",
								"logs"
							)
						);
						foreach($old_login_logs_data as $login_data)
						{
							$insert_parent_data = array();
							$insert_parent_data["type"]= "login_log";
							$insert_parent_data["parent_id"]= $get_parent_id;
							$last_id = $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_parent(),$insert_parent_data);
							$insert_user_login = array();
							$insert_user_login["username"] = isset($login_data->username) ? $login_data->username : "";
							$insert_user_login["user_ip_address"] = isset($login_data->ip_address) ? ip2long($login_data->ip_address) : "";
							$insert_user_login["resources"] = "";
							$insert_user_login["http_user_agent"] = "";
							$insert_user_login["location"] = isset($login_data->geo_location) ? $login_data->geo_location : "";
							$insert_user_login["latitude"] = isset($login_data->latitude) ? $login_data->latitude : "";
							$insert_user_login["longitude"] = isset($login_data->longitude) ? $login_data->longitude : "";
							$insert_user_login["date_time"] = isset($login_data->date_time) ? strtotime($login_data->date_time) : "";
							$insert_user_login["status"] = isset($login_data->captcha_status) ? $login_data->captcha_status == 1 ? "Success" : "Failure" : "";
							$insert_user_login["meta_id"] = isset($last_id) ? $last_id : 0;
							$insert_data = array();
							$insert_data["meta_id"] = isset($last_id) ? $last_id : 0;
							$insert_data["meta_key"] = "recent_login_data";
							$insert_data["meta_value"] = serialize($insert_user_login);
							$obj_dbHelper_captcha_bank->insertCommand(captcha_bank_meta(),$insert_data);
							if($login_data->block_ip == 1)
							{
								$insert_block_ip_address = array();
								$insert_block_ip_address["type"] = "block_ip_address";
								$insert_block_ip_address["parent_id"] = 0;
								$last_id = $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_parent(),$insert_block_ip_address);
								$insert_block_ip_address = array();
								$insert_block_ip_address["ip_address"] = isset($login_data->ip_address) ? ip2long($login_data->ip_address) : "";
								$insert_block_ip_address["blocked_for"] = "permanently";
								$insert_block_ip_address["location"] = isset($login_data->geo_location) ? $login_data->geo_location : "";
								$insert_block_ip_address["comments"] = "";
								$insert_block_ip_address["date_time"] =  isset($login_data->date_time) ? strtotime($login_data->date_time) : "";
								$insert_block_ip_address["meta_id"] = isset($last_id) ? $last_id : 0;
								$insert_data = array();
								$insert_data["meta_id"] = isset($last_id) ? $last_id : 0;
								$insert_data["meta_key"] = "block_ip_address";
								$insert_data["meta_value"] = serialize($insert_block_ip_address);
								$obj_dbHelper_captcha_bank->insertCommand(captcha_bank_meta(),$insert_data);
							}
						} // end foreach
					}
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '". $wpdb->prefix."captcha_bank_plugin_settings'")) != 0)
				{
					$wpdb->query("DROP TABLE ".$wpdb->prefix."captcha_bank_plugin_settings");
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '". $wpdb->prefix."captcha_bank_block_single_ip'")) != 0)
				{
					$old_captcha_bank_block_single_ip = $wpdb->get_results
					(
						"SELECT * FROM ".$wpdb->prefix."captcha_bank_block_single_ip"
					);
					$wpdb->query("DROP TABLE ".$wpdb->prefix."captcha_bank_block_single_ip");
					if(count($old_captcha_bank_block_single_ip) > 0)
					{
						foreach($old_captcha_bank_block_single_ip as $single_ip)
						{
							$insert_block_ip_address = array();
							$insert_block_ip_address["type"] = "block_ip_address";
							$insert_block_ip_address["parent_id"] = 0;
							$last_id = $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_parent(),$insert_block_ip_address);
							$insert_block_ip_address = array();
							$insert_block_ip_address["ip_address"] = isset($single_ip->block_ip_address) ? ip2long($single_ip->block_ip_address) : "";
							$insert_block_ip_address["blocked_for"] = "permanently";
							$insert_block_ip_address["location"] = "";
							$insert_block_ip_address["comments"] = "";
							$insert_block_ip_address["date_time"] = time();
							$insert_block_ip_address["meta_id"] = isset($last_id) ? $last_id : 0;
							$insert_data = array();
							$insert_data["meta_id"] = isset($last_id) ? $last_id : 0;
							$insert_data["meta_key"] = "block_ip_address";
							$insert_data["meta_value"] = serialize($insert_block_ip_address);
							$obj_dbHelper_captcha_bank->insertCommand(captcha_bank_meta(),$insert_data);
						}
					}
				}
				if(count($wpdb->get_var("SHOW TABLES LIKE '". $wpdb->prefix."captcha_bank_block_range_ip'")) != 0)
				{
					$old_captcha_bank_block_ip_range = $wpdb->get_results
					(
						"SELECT * FROM ".$wpdb->prefix."captcha_bank_block_range_ip"
					);
					$wpdb->query("DROP TABLE ".$wpdb->prefix."captcha_bank_block_range_ip");
					if(count($old_captcha_bank_block_ip_range) > 0)
					{
						foreach($old_captcha_bank_block_ip_range as $range_ip)
						{
							$insert_manage_ip_range = array();
							$insert_manage_ip_range["type"] = "block_ip_range";
							$insert_manage_ip_range["parent_id"] = "0";
							$last_id = $obj_dbHelper_captcha_bank->insertCommand(captcha_bank_parent(),$insert_manage_ip_range);
							$start_ip_address =	$range_ip->block_start_range;
							$end_ip_address = $range_ip->block_end_range;
							$insert_manage_ip_range = array();
							$insert_manage_ip_range["ip_range"] = ip2long($start_ip_address).",".ip2long($end_ip_address);
							$insert_manage_ip_range["blocked_for"] = "permanently";
							$insert_manage_ip_range["location"] = "";
							$insert_manage_ip_range["comments"] = "";
							$insert_manage_ip_range["date_time"] = time();
							$insert_manage_ip_range["meta_id"] = $last_id;
							$insert_data = array();
							$insert_data["meta_id"] = $last_id;
							$insert_data["meta_key"] = "block_ip_range";
							$insert_data["meta_value"] = serialize($insert_manage_ip_range);
							$obj_dbHelper_captcha_bank->insertCommand(captcha_bank_meta(),$insert_data);
						}
					}
				}

				$get_roles_settings_data = $wpdb->get_var
				(
					$wpdb->prepare
					(
						"SELECT meta_value FROM ".captcha_bank_meta().
						" WHERE meta_key=%s",
						"roles_and_capabilities"
					)
				);

				$get_roles_settings_data_array = unserialize($get_roles_settings_data);

				if(array_key_exists("roles_and_capabilities", $get_roles_settings_data_array))
				{
					$roles_and_capabilities_data = isset($get_roles_settings_data_array["roles_and_capabilities"]) ? explode("," ,$get_roles_settings_data_array["roles_and_capabilities"]) : array();
					$administrator_privileges_data = isset($get_roles_settings_data_array["administrator_privileges"]) ? explode("," ,$get_roles_settings_data_array["administrator_privileges"]) : array();
					$author_privileges_data = isset($get_roles_settings_data_array["author_privileges"]) ? explode("," ,$get_roles_settings_data_array["author_privileges"]) : array();
					$editor_privileges_data  = isset($get_roles_settings_data_array["editor_privileges"]) ? explode("," ,$get_roles_settings_data_array["editor_privileges"]) : array();
					$contributor_privileges_data  = isset($get_roles_settings_data_array["contributor_privileges"]) ? explode("," ,$get_roles_settings_data_array["contributor_privileges"]) : array();
					$subscriber_privileges_data  = isset($get_roles_settings_data_array["subscriber_privileges"]) ? explode("," ,$get_roles_settings_data_array["subscriber_privileges"]) : array();
					$other_privileges_data  = isset($get_roles_settings_data_array["other_privileges"]) ? explode("," ,$get_roles_settings_data_array["other_privileges"]) : array();

					if(count($roles_and_capabilities_data) == 5)
					{
						array_push($roles_and_capabilities_data,0);
						$get_roles_settings_data_array["roles_and_capabilities"] = implode(",",$roles_and_capabilities_data);
					}

					if(count($administrator_privileges_data) == 8)
					{
						$administrator_privileges_data[8] = $administrator_privileges_data[7];
						$administrator_privileges_data[7] = 1;
						$get_roles_settings_data_array["administrator_privileges"] = implode(",",$administrator_privileges_data);
					}

					if(count($author_privileges_data) == 8)
					{
						$author_privileges_data[8] = $author_privileges_data[7];
						$author_privileges_data[7] = 0;
						$get_roles_settings_data_array["author_privileges"] = implode(",",$author_privileges_data);
					}

					if(count($editor_privileges_data) == 8)
					{
						$editor_privileges_data[8] = $editor_privileges_data[7];
						$editor_privileges_data[7] = 0;
						$get_roles_settings_data_array["editor_privileges"] = implode(",",$editor_privileges_data);
					}

					if(count($contributor_privileges_data) == 8)
					{
						$contributor_privileges_data[8] = $contributor_privileges_data[7];
						$contributor_privileges_data[7] = 0;
						$get_roles_settings_data_array["contributor_privileges"] = implode(",",$contributor_privileges_data);
					}

					if(count($subscriber_privileges_data) == 8)
					{
						$subscriber_privileges_data[8] = $subscriber_privileges_data[7];
						$subscriber_privileges_data[7] = 0;
						$get_roles_settings_data_array["subscriber_privileges"] = implode(",",$contributor_privileges_data);
					}

					if(count($other_privileges_data) == 8)
					{
						$other_privileges_data[8] = $other_privileges_data[7];
						$other_privileges_data[7] = 0;
						$get_roles_settings_data_array["other_privileges"] = implode(",",$other_privileges_data);
					}
					else
					{
							$get_roles_settings_data_array["other_privileges"] = "0,0,0,0,0,0,0,0,0";
					}

					if(!array_key_exists("others_full_control_capability", $get_roles_settings_data_array))
					{
						$get_roles_settings_data_array["others_full_control_capability"] = "0";
					}

					if(!array_key_exists("capabilities", $get_roles_settings_data_array))
					{
						$user_capabilities = get_others_capabilities_captcha_bank();
						$other_roles_array = array();
						$other_roles_access_array = array(
							"manage_options",
							"edit_plugins",
							"edit_posts",
							"publish_posts",
							"publish_pages",
							"edit_pages",
							"read"
						);
						foreach($other_roles_access_array as $role)
						{
							if(in_array($role,$user_capabilities))
							{
								array_push($other_roles_array,$role);
							}
						}
						$get_roles_settings_data_array["capabilities"] = $other_roles_array;
					}

					$where = array();
					$roles_capabilities_array = array();
					$where["meta_key"] = "roles_and_capabilities";
					$roles_capabilities_array["meta_value"] = serialize($get_roles_settings_data_array);
					$obj_dbHelper_captcha_bank->updateCommand(captcha_bank_meta(),$roles_capabilities_array, $where);
				}
			break;
		}
		update_option("captcha-bank-version-number","3.0.2");
	}
}
?>
