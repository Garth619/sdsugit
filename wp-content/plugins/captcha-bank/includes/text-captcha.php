<?php
/**
* This file contains text captcha code.
*
* @author  Tech Banker
* @package captcha-bank/includes
* @version 3.0.0
*/

if(!defined("ABSPATH")) exit; //exit if accessed directly
ob_start();
if("" == session_id())
{
	@session_start();
}

//get settings values
if(file_exists(CAPTCHA_BANK_DIR_PATH ."includes/captcha-setting.php"))
{
	include_once CAPTCHA_BANK_DIR_PATH ."includes/captcha-setting.php";
}
//include file where is_plugin_active() function is defined
if(file_exists(ABSPATH."wp-admin/includes/plugin.php"))
{
	include_once(ABSPATH."wp-admin/includes/plugin.php");
}

//add_action for login
if($display_setting[0] == "1")
{
	add_action("login_form","text_captcha_form");
	add_filter("authenticate","captcha_text_login_check",21,3);
}
else
{
	add_action("wp_authenticate","check_user_login_status",10,2);
}

//add_action for registration page
if($display_setting[1] == "1")
{
	add_action("register_form","text_captcha_form");
	add_action("register_post","captcha_register_check",10,3);
}

//add_action for lost-password
if($display_setting[2] == "1")
{
	add_action("lostpassword_form", "text_captcha_form");
	add_action("allow_password_reset","captcha_lostpassword_check",1);
}

//add_action for comment form
if($display_setting[3] == "1")
{
	add_action("comment_form_after_fields","captcha_comment_form",1);
	add_action("pre_comment_on_post","captcha_comment_check");
}

//add_action for admin comment form and hide captcha for other
if($display_setting[4] == "1")
{
	add_action("comment_form_logged_in_after","captcha_comment_form",1);
	add_action("pre_comment_on_post","captcha_comment_check");
}

//function to display captcha
if(!function_exists("text_captcha_form"))
{
	function text_captcha_form()
	{
		global $wpdb,$captcha_array;
		if(file_exists(CAPTCHA_BANK_DIR_PATH ."includes/captcha-frontend.php"))
		{
			include CAPTCHA_BANK_DIR_PATH ."includes/captcha-frontend.php";
		}
	}
}

//function to display error for login form
if (!function_exists("captcha_text_login_check"))
{
	function captcha_text_login_check($user,$username,$password)
	{
		global $wpdb,$captcha_array,$error_data_array;
		$err = captcha_login_errors();
		$ip_address = ip2long(getIpAddress_for_captcha_bank());
		if($err)
		{
			if($err == "empty")
			{
				$error = new WP_Error("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_captcha_empty_error"]);
			}
			else if($err == "invalid")
			{
				$error = new WP_Error("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_invalid_captcha_error"]);
			}
			user_log_in_fails($username,$ip_address);
			return $error;
		}
		elseif(isset($_REQUEST["ux_txt_captcha_challenge_field"]) && isset($_SESSION["captcha_code"]))
		{
			$captcha_array["case_sensitive"] == "enable" ? $captcha_challenge_field = trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])) : $captcha_challenge_field = strtolower(trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])));
			$captcha_array["case_sensitive"] == "enable" ? $captcha_code[] = $_SESSION["captcha_code"] : $captcha_code[] = array_map("strtolower",$_SESSION["captcha_code"]);
			if(in_array($captcha_challenge_field,$captcha_code[0]))
			{
				$userdata = get_user_by("login", $username);
				if($userdata && wp_check_password($password, $userdata->user_pass))
				{
					user_log_in_success($username,$ip_address);
					return $user;
				}
				else
				{
					user_log_in_fails($username,$ip_address);
				}
			}
		}
		else
		{
			if(isset($_REQUEST["log"]) && isset($_REQUEST["pwd"]))
			{
				/* captcha was not found in _REQUEST */
				$error = new WP_Error("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_captcha_empty_error"]);
				return $error;
			}
			else
			{
				/* it is not a submit */
				return $user;
			}
		}
	}
}

//function to dislpay error for lost-password form
if (!function_exists("captcha_lostpassword_check"))
{
	function captcha_lostpassword_check($user)
	{
		global $wpdb,$errors,$error_data_array;
		$err = captcha_errors();
		if($err)
		{
			if($errors == NULL) $errors;
			if($errors == NULL) $errors = new WP_Error();
			if($err == "empty")
			{
				$error = new WP_Error("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_captcha_empty_error"]);
			}
			else if($err == "invalid")
			{
				$error = new WP_Error("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_invalid_captcha_error"]);
			}
			return $error;
		}
		return $user;
	}
}

//function to display error for registration form
if (!function_exists("captcha_register_check"))
{
	function captcha_register_check($user,$email,$errors)
	{
		global $wpdb,$error_data_array;
		$err = captcha_errors();
		if($err)
		{
			if($err == "empty")
			{
				$errors->add("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_captcha_empty_error"]);
			}
			else if($err == "invalid")
			{
				$errors->add("captcha_wrong", "<strong>" . captcha_bank_logical_error. "</strong>: " .$error_data_array["for_invalid_captcha_error"]);
			}
		}
	}
}

//fucntion to display error for comment form
if(!function_exists("captcha_comment_check"))
{
	function captcha_comment_check()
	{
		global $wpdb,$error_data_array;
		$err = captcha_errors();
		if($err)
		{
			if($err == "empty")
			{
				wp_die( $error_data_array["for_captcha_empty_error"]);
			}
			else if($err == "invalid")
			{
				wp_die( $error_data_array["for_invalid_captcha_error"]);
			}
		}
		else
		{
			return;
		}
	}
}

//function to display captcha on admin comment form
if(!function_exists("captcha_comment_form"))
{
	function captcha_comment_form()
	{

		global $wpdb,$current_user,$user_role_permission,$display_setting;
		if(file_exists(CAPTCHA_BANK_DIR_PATH ."includes/captcha-setting.php"))
		{
			include_once CAPTCHA_BANK_DIR_PATH ."includes/captcha-setting.php";
		}
		if(is_user_logged_in())
		{
			if(is_super_admin())
			{
				$cpb_role="administrator";
			}
			else
			{
				$cpb_role = $wpdb->prefix."capabilities";
				$current_user->role = array_keys($current_user->$cpb_role);
				$cpb_role = $current_user->role[0];
			}
			if(($cpb_role == "administrator" && $display_setting[4] == "1") || ($cpb_role != "administrator" && $display_setting[5] == "0"))
			{
				if(file_exists(CAPTCHA_BANK_DIR_PATH ."includes/captcha-frontend.php"))
				{
					include CAPTCHA_BANK_DIR_PATH ."includes/captcha-frontend.php";
				}
			}
		}
		else
		{
			if(file_exists(CAPTCHA_BANK_DIR_PATH ."includes/captcha-frontend.php"))
			{
				include CAPTCHA_BANK_DIR_PATH ."includes/captcha-frontend.php";
			}
		}
	}
}

//function to check error for login page and return error type
if (!function_exists("captcha_login_errors"))
{
	function captcha_login_errors($errors = NULL)
	{
		global $wpdb,$captcha_array;
		if(isset($_REQUEST["ux_txt_captcha_challenge_field"]))
		{
			$captcha_array["case_sensitive"] == "enable" ? $captcha_challenge_field = trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])) : $captcha_challenge_field = strtolower(trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])));

			if(strlen($captcha_challenge_field)<=0)
			{
				$errors = "empty";
				$captcha_meta_settings["captcha_status"] = 0;
			}
			else
			{
				if(isset($_SESSION["captcha_code"]))
				{
					$captcha_array["case_sensitive"] == "enable" ? $code[] = $_SESSION["captcha_code"] : $code[] = array_map("strtolower",$_SESSION["captcha_code"]);
					if(!in_array($captcha_challenge_field,$code[0]))
					{
						$errors = "invalid";
						$captcha_meta_settings["captcha_status"] = 0;
					}
					else
					{
						$captcha_meta_settings["captcha_status"] = 1;
					}
				}
			}
		}
		return $errors;
	}
}

//function to check error for login page and return error type
if (!function_exists("captcha_login_errors_woo"))
{
	function captcha_login_errors_woo($errors = NULL)
	{
		global $wpdb,$captcha_array;
		if(isset($_REQUEST["ux_txt_captcha_challenge_field"]))
		{
			$captcha_array["case_sensitive"] == "enable" ? $captcha_challenge_field = trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])) : $captcha_challenge_field = strtolower(trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])));
			if(strlen($captcha_challenge_field)<=0)
			{
				$errors = "empty";
				$captcha_meta_settings["captcha_status"] = 0;
			}
			else
			{
				if(isset($_SESSION["captcha_code"]))
				{
					$captcha_array["case_sensitive"] == "enable" ? $code[] = $_SESSION["captcha_code"] : $code[] = array_map("strtolower",$_SESSION["captcha_code"]);
					if(!in_array($captcha_challenge_field,$code[0]))
					{
						$errors = "invalid";
						$captcha_meta_settings["captcha_status"] = 0;
					}
					else
					{
						$captcha_meta_settings["captcha_status"] = 1;
					}
				}
			}
		}
		return $errors;
	}
}

//function to check captcha error and return error type
if(!function_exists("captcha_errors"))
{
	function captcha_errors($errors = NULL)
	{
		global $wpdb,$captcha_array;
		if(isset($_REQUEST["ux_txt_captcha_challenge_field"]))
		{
			$captcha_array["case_sensitive"] == "enable" ? $captcha_challenge_field = trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])) : $captcha_challenge_field = strtolower(trim(esc_attr($_REQUEST["ux_txt_captcha_challenge_field"])));

			if(strlen($captcha_challenge_field)<=0)
			{
				$errors = "empty";
				$captcha_meta_settings["captcha_status"] = 0;
			}
			else
			{
				if(isset($_SESSION["captcha_code"]))
				{
					$captcha_array["case_sensitive"] == "enable" ? $code[] = $_SESSION["captcha_code"] : $code[] = array_map("strtolower",$_SESSION["captcha_code"]);
					if(!in_array($captcha_challenge_field,$code[0]))
					{
						$errors = "invalid";
						$captcha_meta_settings["captcha_status"] = 0;
					}
					else
					{
						$captcha_meta_settings["captcha_status"] = 1;
					}
				}
			}
		}
		return $errors;
	}
}
?>
