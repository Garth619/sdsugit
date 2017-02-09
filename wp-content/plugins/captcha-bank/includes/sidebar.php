<?php
/**
* This file is used for displaying sidebar menus.
*
* @author  Tech Banker
* @package captcha-bank/includes
* @version 3.0.0
*/
if(!defined("ABSPATH")) exit; // Exit if accessed directly
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
		?>
		<div class="page-sidebar-wrapper-tech-banker">
			<div class="page-sidebar-tech-banker navbar-collapse collapse">
				<div class="sidebar-menu-tech-banker">
					<ul class="page-sidebar-menu-tech-banker" data-slide-speed="200">
						<div class="sidebar-search-wrapper" style="padding:20px;text-align:center">
							<a class="plugin-logo" href="<?php echo tech_banker_beta_url;?>" target="_blank">
								<img src="<?php echo plugins_url("assets/global/img/logo-captcha-bank.png",dirname(__FILE__));?>">
							</a>
						</div>
						<li class="" id="ux_li_captcha_settings">
							<a href="javascript:;">
								<i class="icon-custom-grid"></i>
								<span class="title">
									<?php echo $cpb_captcha_settings_label;?>
								</span>
							</a>
							<ul class="sub-menu">
								<li id="ux_li_captcha_setup">
									<a href="admin.php?page=captcha_bank">
										<i class="icon-custom-layers"></i>
										<?php echo $cpb_captcha_setup_menu;?>
									</a>
								</li>
								<li id="ux_li_display_settings">
									<a href="admin.php?page=captcha_bank_display_settings">
										<i class=icon-custom-paper-clip></i>
										<?php echo $cpb_display_settings_title; ?>
									</a>
								</li>
							</ul>
						</li>
						<li class="" id="ux_li_general_settings">
							<a href="javascript:;">
								<i class="icon-custom-settings"></i>
								<span class="title">
									<?php echo $cpb_general_settings_menu; ?>
								</span>
							</a>
							<ul class="sub-menu">
								<li id="ux_li_notification_setup">
									<a href="admin.php?page=captcha_bank_notifications_setup">
										<i class="icon-custom-bell"></i>
										<?php echo $cpb_notification_setup_label; ?>
									</a>
								</li>
								<li id="ux_li_message_settings">
									<a href="admin.php?page=captcha_bank_message_settings">
										<i class="icon-custom-envelope"></i>
										<?php echo $cpb_message_settings_label; ?>
										<span class=badge>Pro</span>
									</a>
								</li>
								<li id="ux_li_email_templates">
									<a href="admin.php?page=captcha_bank_email_templates">
										<i class="icon-custom-link"></i>
										<?php echo $cpb_email_templates_menu; ?>
										<span class=badge>Pro</span>
									</a>
								</li>
								<li id="ux_li_roles_capabilities">
									<a href="admin.php?page=captcha_bank_roles_capabilities">
										<i class="icon-custom-users"></i>
										<?php echo $cpb_roles_and_capabilities_menu; ?>
										<span class=badge>Pro</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="" id="ux_li_logs">
							<a href="javascript:;">
								<i class="icon-custom-docs"></i>
								<span class="title">
									<?php echo $cpb_logs_menu;?>
								</span>
							</a>
							<ul class="sub-menu">
								<li id="ux_li_login_logs">
									<a href="admin.php?page=captcha_bank_login_logs">
										<i class="icon-custom-clock"></i>
										<?php echo $cpb_recent_login_log_title;?>
									</a>
								</li>
								<li id="ux_li_visitor_logs">
									<a href="admin.php?page=captcha_bank_visitor_logs">
										<i class=icon-custom-users></i>
										<?php echo $cpb_visitor_logs_title;?>
									</a>
								</li>
								<li id="ux_li_live_traffic">
									<a href="admin.php?page=captcha_bank_live_traffic">
										<i class=icon-custom-directions></i>
										<?php echo $cpb_live_traffic_title;?>
									</a>
								</li>
							</ul>
						</li>
						<li id="ux_li_other_settings">
							<a href="admin.php?page=captcha_bank_other_settings">
								<i class="icon-custom-wrench"></i>
								<span class="title">
									<?php echo $cpb_other_settings_menu; ?>
								</span>
							</a>
						</li>
						<li class="" id="ux_li_security_settings">
							<a href="javascript:;">
								<i class="icon-custom-lock"></i>
								<span class="title">
									<?php echo $cpb_security_settings_label;?>
								</span>
							</a>
							<ul class="sub-menu">
								<li id="ux_li_blockage_settings">
									<a href="admin.php?page=captcha_bank_blockage_settings">
										<i class="icon-custom-shield"></i>
										<?php echo $cpb_blockage_settings_label;?>
									</a>
								</li>
								<li id="ux_li_block_unblock_ip_address">
									<a href="admin.php?page=captcha_bank_block_unblock_ip_addresses">
										<i class=icon-custom-globe></i>
										<?php echo $cpb_block_unblock_ip_address_label;?>
									</a>
								</li>
								<li id="ux_li_block_unblock_ip_range">
									<a href="admin.php?page=captcha_bank_block_unblock_ip_ranges">
										<i class=icon-custom-wrench></i>
										<?php echo $cpb_block_unblock_ip_range_label;?>
									</a>
								</li>
								<li id="ux_li_block_unblock_countries">
									<a href="admin.php?page=captcha_bank_block_unblock_countries">
										<i class=icon-custom-target></i>
										<?php echo $cpb_block_unblock_countries_label;?>
									</a>
								</li>
							</ul>
						</li>
						<li id="ux_li_feature_requests">
							<a href="admin.php?page=captcha_bank_feature_requests">
								<i class="icon-custom-call-out"></i>
								<span class="title">
									<?php echo $cpb_feature_requests; ?>
								</span>
							</a>
						</li>
						<li id="ux_li_system_information">
							<a href="admin.php?page=captcha_bank_system_information">
								<i class="icon-custom-screen-desktop"></i>
								<span class="title">
									<?php echo $cpb_system_information_menu; ?>
								</span>
							</a>
						</li>
						<li id="ux_li_error_logs">
							<a href="admin.php?page=captcha_bank_error_logs">
								<i class="icon-custom-shield"></i>
								<span class="title">
									<?php echo $cpb_error_logs;?>
								</span>
							</a>
						</li>
						<li id="ux_li_premium_editions">
							<a href="admin.php?page=captcha_bank_premium_editions">
								<i class="icon-custom-briefcase"></i>
								<span class="title">
									<?php echo $cpb_premium_editions_menu; ?>
								</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content-wrapper">
			<div class="page-content">
				<a href="http://beta.tech-banker.com/products/captcha-bank/" target="_blank">
					<img src="<?php echo plugins_url("assets/global/img/banner-captcha-bank.png",dirname(__FILE__));?>" title="Captcha Bank" style="width: 100%;">
				</a>
				<div class="row">
					<div class="col-md-4">
						<a href="http://beta.tech-banker.com/products/captcha-bank/" target="_blank">
							<img  title="Find out More!" src="<?php echo plugins_url("assets/global/img/captcha-bank-features-button.png",dirname(__FILE__));?>" style="width: 100%;">
						</a>
					</div>
					<div class="col-md-4">
						<a href="http://beta.tech-banker.com/products/captcha-bank/user-guide/" target="_blank">
							<img  title="Need Help?" src="<?php echo plugins_url("assets/global/img/captcha-bank-user-guide-button.png",dirname(__FILE__));?>" style="width:100%;">
						</a>
					</div>
					<div class="col-md-4">
						<a href="http://beta.tech-banker.com/products/captcha-bank/demos/" target="_blank">
							<img title="Find out How it works?" src="<?php echo plugins_url("assets/global/img/captcha-bank-demos-button.png",dirname(__FILE__));?>" style="width: 100%;">
						</a>
					</div>
				</div>
		<?php
	}
}
?>
