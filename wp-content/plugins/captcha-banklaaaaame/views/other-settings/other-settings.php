<?php
/**
* This Template is used for managing other settings.
*
* @author  Tech Banker
* @package captcha-bank/views/general-settings
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
	elseif(other_settings_captcha_bank == "1")
	{
		$captcha_bank_other_settings = wp_create_nonce("captcha_bank_other_settings");
		?>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-custom-home"></i>
					<a href="admin.php?page=captcha_bank">
						<?php echo $cpb_captcha_bank_title;?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo $cpb_other_settings_menu;?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-settings"></i>
							<?php echo $cpb_other_settings_menu;?>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_other_settings">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo $cpb_other_settings_automatic_plugin_updates;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_other_settings_automatic_plugin_updates_tooltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_plugin_updates" id="ux_ddl_plugin_updates" class="form-control">
												<option value="enable"><?php echo $cpb_enable;?></option>
												<option value="disable"><?php echo $cpb_disable;?></option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo $cpb_other_settings_remove_tables;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_other_settings_remove_tables_tootltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_remove_tables" id="ux_ddl_remove_tables" class="form-control">
												<option value="enable"><?php echo $cpb_enable;?></option>
												<option value="disable"><?php echo $cpb_disable;?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo $cpb_other_settings_live_traffic_monitoring_label;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_other_settings_live_traffic_monitoring_tooltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_live_traffic_monitoring" id="ux_ddl_live_traffic_monitoring" class="form-control">
												<option value="enable"><?php echo $cpb_enable;?></option>
												<option value="disable"><?php echo $cpb_disable;?></option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo $cpb_other_settings_visitor_logs_monitoring_label;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_other_settings_visitor_logs_monitoring_tooltip;?>" data-placement="right"></i>
												<span class="required" aria-required="true">*</span>
											</label>
											<select name="ux_ddl_visitor_log_monitoring" id="ux_ddl_visitor_log_monitoring" class="form-control">
												<option value="enable"><?php echo $cpb_enable;?></option>
												<option value="disable"><?php echo $cpb_disable;?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $cpb_other_settings_ip_address_fetching_method ;?> :
										<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_other_settings_ip_address_tooltips;?>" data-placement="right"></i>
										<span class="required" aria-required="true">*</span>
									</label>
									<select name="ux_ddl_ip_address_fetching_method" id="ux_ddl_ip_address_fetching_method" class="form-control">
										<option value=""><?php echo $cpb_other_settings_ip_address_fetching_option1 ;?></option>
										<option value="REMOTE_ADDR"><?php echo $cpb_other_settings_ip_address_fetching_option2 ;?></option>
										<option value="HTTP_X_FORWARDED_FOR"><?php echo $cpb_other_settings_ip_address_fetching_option3 ;?></option>
										<option value="HTTP_X_REAL_IP"><?php echo $cpb_other_settings_ip_address_fetching_option4 ;?></option>
										<option value="HTTP_CF_CONNECTING_IP"><?php echo $cpb_other_settings_ip_address_fetching_option5 ;?></option>
									</select>
								</div>
								<div class="line-separator"></div>
								<div class="form-actions">
									<div class="pull-right">
										<input type="submit" class="btn vivid-green" name="ux_btn_save_changes" id="ux_btn_save_changes" value="<?php echo $cpb_save_changes;?>">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-custom-home"></i>
					<a href="admin.php?page=captcha_bank">
						<?php echo $cpb_captcha_bank_title;?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo $cpb_other_settings_menu;?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-settings"></i>
							<?php echo $cpb_other_settings_menu;?>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<strong><?php echo $cpb_user_access_message;?></strong>
 						</div>
	 				</div>
	 			</div>
			</div>
		</div>
		<?php
	}
}
?>
