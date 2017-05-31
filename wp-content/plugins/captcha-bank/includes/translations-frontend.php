<?php

/**
 * This file is used for translation strings of frontend.
 *
 * @author  Tech Banker
 * @package captcha-bank/includes
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} //exit if accessed directly
// mailer-class
$cpb_one_hour = __("1 Hour", "captcha-bank");
$cpb_twelve_hours = __("12 Hours", "captcha-bank");
$cpb_twenty_four_hours = __("24 Hours", "captcha-bank");
$cpb_forty_eight_hours = __("48 Hours", "captcha-bank");
$cpb_one_week = __("1 Week", "captcha-bank");
$cpb_one_month = __("1 Month", "captcha-bank");
$cpb_permanently = __("Permanently", "captcha-bank");
$cpb_for = __("for ", "captcha-bank");

//captcha-frontend
if (!defined("enter_captcha")) {
    define("enter_captcha", __("Enter Captcha Here", "captcha-bank"));
}
//logical Captcha
if (!defined("captcha_bank_ascending_order")) {
    define("captcha_bank_ascending_order", __("Arrange in Ascending Order", "captcha-bank"));
}
if (!defined("captcha_bank_descending_order")) {
    define("captcha_bank_descending_order", __("Arrange in Descending Order", "captcha-bank"));
}
if (!defined("captcha_bank_seperate_numbers")) {
    define("captcha_bank_seperate_numbers", __(" (Use ',' to separate the numbers) :", "captcha-bank"));
}
if (!defined("captcha_bank_larger_number")) {
    define("captcha_bank_larger_number", __("Which Number is Larger ", "captcha-bank"));
}
if (!defined("captcha_bank_smaller_number")) {
    define("captcha_bank_smaller_number", __("Which Number is Smaller ", "captcha-bank"));
}
if (!defined("captcha_bank_logical_error")) {
    define("captcha_bank_logical_error", __("ERROR", "captcha-bank"));
}
if (!defined("captcha_bank_logical_or")) {
    define("captcha_bank_logical_or", __(" or ", "captcha-bank"));
}
if (!defined("captcha_bank_encryption")) {
    define("captcha_bank_encryption", __("Encryption password is not set", "captcha-bank"));
}
if (!defined("captcha_bank_decryption")) {
    define("captcha_bank_decryption", __("Decryption password is not set", "captcha-bank"));
}
if (!defined("captcha_bank_arithemtic")) {
    define("captcha_bank_arithemtic", __("Solve"));
}