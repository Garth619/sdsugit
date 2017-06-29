<?php
/**
 * This file contains code for captcha settings  .
 *
 * @author  Tech Banker
 * @package captcha-bank/includes
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
global $wpdb, $captcha_array, $meta_data_array, $display_setting, $error_data_array;
$display_settings_data = $wpdb->get_var
    (
    $wpdb->prepare
        (
        "SELECT meta_value FROM " . captcha_bank_meta() . "
		WHERE meta_key = %s", "display_settings"
    )
);

$meta_data_array = maybe_unserialize($display_settings_data);

$display_setting = explode(",", isset($meta_data_array["settings"]) ? esc_attr($meta_data_array["settings"]) : "");
$error_data = $wpdb->get_var
    (
    $wpdb->prepare
        (
        "SELECT meta_value FROM " . captcha_bank_meta() . "
		WHERE meta_key = %s", "error_message"
    )
);
$error_data_array = maybe_unserialize($error_data);

$captcha_type_data = $wpdb->get_var
    (
    $wpdb->prepare
        (
        "SELECT meta_value FROM " . captcha_bank_meta() . "
		WHERE meta_key = %s", "captcha_type"
    )
);
$captcha_array = maybe_unserialize($captcha_type_data);

$captcha_character = esc_attr($captcha_array["captcha_characters"]);
$captcha_type = esc_attr($captcha_array["captcha_type"]);
$text_case = esc_attr($captcha_array["text_case"]);
$captcha_case_sensitive = esc_attr($captcha_array["case_sensitive"]);
$captcha_width = esc_attr($captcha_array["captcha_width"]);
$captcha_height = esc_attr($captcha_array["captcha_height"]);
$captcha_background = esc_attr($captcha_array["captcha_background"]);
$border_style = explode(",", esc_attr($captcha_array["border_style"]));
$lines = esc_attr($captcha_array["lines"]);
$lines_color = esc_attr($captcha_array["lines_color"]);
$noise_level = esc_attr($captcha_array["noise_level"]);
$noise_color = esc_attr($captcha_array["noise_color"]);
$text_transparency = esc_attr($captcha_array["text_transperancy"]);
$signature_text = esc_attr($captcha_array["signature_text"]);
$signature_style = explode(",", esc_attr($captcha_array["signature_style"]));
$signature_font = esc_attr($captcha_array["signature_font"]);
$text_shadow_color = esc_attr($captcha_array["text_shadow_color"]);
$captcha_font = esc_attr($captcha_array["text_font"]);
$captcha_font_style = explode(",", esc_attr($captcha_array["text_style"]));
