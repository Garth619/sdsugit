<?php
/**
* This Template is used for saving email templates.
*
* @author  Tech Banker
* @package captcha-bank/views/email-templates
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
	elseif(general_settings_captcha_bank == "1")
	{
		$captcha_type_email_templates = wp_create_nonce("captcha_type_email_templates");
		?>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="icon-custom-home"></i>
						<a href="admin.php?page=captcha_bank">
							<?php echo $cpb_captcha_bank_title; ?>
						</a>
						<span>></span>
					</li>
					<li>
						<a href="admin.php?page=captcha_bank_notifications_setup">
							<?php echo $cpb_general_settings_menu; ?>
						</a>
						<span>></span>
					</li>
					<li>
						<span>
							<?php echo $cpb_email_templates_menu;?>
						</span>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box vivid-green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-custom-link"></i>
								<?php echo $cpb_email_templates_menu;?>
							</div>
						</div>
						<div class="portlet-body form">
							<form id="ux_frm_email_templates">
								<div class="form-body">
									<?php
									if($cpb_message_translate_help != "")
									{
										?>
										<div class="note note-danger">
											<h4 class="block">
												<?php echo $cpb_important_disclaimer; ?>
											</h4>
											<strong><?php echo $cpb_message_translate_help;?><br/><?php echo $cpb_kindly_click;?><a href="javascript:void(0);" data-popup-open="ux_open_popup_translator" class="custom_links" onclick="show_pop_up_captcha_bank();"><?php echo $cpb_message_translate_here; ?></a></strong>
										</div>
										<?php
									}
									?>
									<div class="form-group">
										<label class="control-label">
											<?php echo $cpb_email_templates_choose_title;?> :
											<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_email_templates_tooltip;?>" data-placement="right"></i>
											<span class="required" aria-required="true">*</span>
										</label>
										<select name="ux_ddl_user_success" id="ux_ddl_user_success" class="form-control" onchange="email_template_type_captcha_bank();">
											<option value="template_for_user_success"><?php echo $cpb_email_templates_successful_login; ?></option>
											<option value="template_for_user_failure"><?php echo $cpb_email_templates_failure_login; ?></option>
											<option value="template_for_ip_address_blocked"><?php echo $cpb_email_templates_ip_address_blocked; ?></option>
											<option value="template_for_ip_address_unblocked"><?php echo $cpb_email_templates_ip_address_unblocked; ?></option>
											<option value="template_for_ip_range_blocked"><?php echo $cpb_email_templates_ip_range_blocked; ?></option>
											<option value="template_for_ip_range_unblocked"><?php echo $cpb_email_templates_ip_range_unblocked; ?></option>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $cpb_email_templates_send_to_title;?> :
											<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_email_templates_send_to_email_tooltip;?>" data-placement="right"></i>
											<span class="required" area-required="true" >* <?php echo " ( ". $cpb_premium_editions_label." ) ";?></span>
										</label>
										<input type="text" class="form-control" name="ux_txt_send_to" id="ux_txt_send_to" value="" placeholder="<?php echo $cpb_email_templates_send_email_address_placeholder;?>">
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo $cpb_email_templates_cc_title;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_email_templates_cc_email_tooltip;?>" data-placement="right"></i>
													<span class="required" area-required="true" >* <?php echo " ( ". $cpb_premium_editions_label." ) ";?></span>
												</label>
												<input type="text" class="form-control" name="ux_txt_cc" id="ux_txt_cc" value="" placeholder="<?php echo $cpb_email_templates_cc_email_address_placeholder;?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">
													<?php echo $cpb_email_templates_bcc_title;?> :
													<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_email_templates_bcc_email_tooltip;?>" data-placement="right"></i>
													<span class="required" area-required="true" >* <?php echo " ( ". $cpb_premium_editions_label." ) ";?></span>
												</label>
												<input type="text" class="form-control" name="ux_txt_bcc" id="ux_txt_bcc" value="" placeholder="<?php echo $cpb_email_templates_bcc_email_address_placeholder;?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $cpb_email_subject_title;?> :
											<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_email_templates_subject_tooltip;?>" data-placement="right"></i>
											<span class="required" area-required="true" >* <?php echo " ( ". $cpb_premium_editions_label." ) ";?></span>
										</label>
										<input type="text" class="form-control" name="ux_txt_subject" id="ux_txt_subject" value="" placeholder="<?php echo $cpb_placeholder_subject;?>">
									</div>
									<div class="form-group">
										<label class="control-label">
											<?php echo $cpb_email_templates_cpb_message_title;?> :
											<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_email_templates_message_content_tooptip;?>" data-placement="right"></i>
											<span class="required" area-required="true" >* <?php echo " ( ". $cpb_premium_editions_label." ) ";?></span>
										</label>
										<?php
											$distribution = "";
											wp_editor( $distribution, $id ="ux_heading_content", array("media_buttons" => false, "textarea_rows" => 8, "tabindex" => 4 ) );
										?>
									</div>
									<div class="line-separator"></div>
									<div class="form-actions">
										<div class="pull-right">
											<input type="hidden" id="ux_email_template_meta_id" value=""/>
											<input type="submit" class="btn vivid-green" name="ux_btn_email_change" id="ux_btn_email_change" value="<?php echo $cpb_save_changes;?>">
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
							<?php echo $cpb_captcha_bank_title; ?>
						</a>
						<span>></span>
					</li>
					<li>
						<a href="admin.php?page=captcha_bank_notifications_setup">
							<?php echo $cpb_general_settings_menu; ?>
						</a>
						<span>></span>
					</li>
					<li>
						<span>
							<?php echo $cpb_email_templates_menu;?>
						</span>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box vivid-green">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-custom-link"></i>
								<?php echo $cpb_email_templates_menu;?>
							</div>
						</div>
						<div class="portlet-body form">
							<form id="ux_frm_email_templates">
								<div class="form-body">
									<strong><?php echo $cpb_user_access_message;?></strong>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php
	}
}
?>
