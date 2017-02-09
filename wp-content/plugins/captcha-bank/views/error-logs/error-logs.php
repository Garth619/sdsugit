<?php
/**
* This Template is used for view Error logs.
*
* @author  Tech Banker
* @package captcha-bank/views/error-logs
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
	elseif(captcha_settings_captcha_bank == "1")
	{
		$error_logs_nonce = wp_create_nonce("error_logs_nonce");
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
					<?php echo $cpb_error_logs;?>
				</span>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box vivid-green">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-custom-shield"></i>
						<?php echo $cpb_error_logs;?>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="ux_frm_other_settings">
						<div class="form-body">
							<div class="form-actions">
								<div class="pull-right">
									<a href="<?php echo plugins_url("views/error-logs/error-logs.txt",dirname(dirname(__FILE__)));?>" download="error-logs.txt" type="button" class="btn vivid-green" id="ux_btn_download" name="ux_btn_download"><?php echo $cpb_error_logs_download ;?></a>
									<input type="button" class="btn vivid-green btn_clear_log" id="ux_btn_clear_log" name="ux_btn_clear_log" value="<?php echo $cpb_error_logs_clear ;?>">
								</div>
							</div>
							<div class="line-separator"></div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $cpb_error_logs_output ;?> :
										<i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_error_logs_output_tooltip ;?>" data-placement="right"></i>
									</label>
									<textarea rows="20"  readonly="true" class="form-control"><?php echo dbHelper_captcha_bank::file_reader(CAPTCHA_BANK_ERROR_LOG_FILE);?></textarea>
								</div>
								<div class="line-separator"></div>
								<div class="form-actions">
									<div class="pull-right">
										<a href="<?php echo plugins_url("views/error-logs/error-logs.txt",dirname(dirname(__FILE__)));?>" download="error-logs.txt" type="button" class="btn vivid-green" id="ux_btn_download" name="ux_btn_download"><?php echo $cpb_error_logs_download ;?></a>
										<input type="button" class="btn vivid-green btn_clear_log" id="ux_btn_clear_log" name="ux_btn_clear_log" value="<?php echo $cpb_error_logs_clear ;?>">
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
						<?php echo $cpb_error_logs;?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-shield"></i>
							<?php echo $cpb_error_logs;?>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
						 <strong><?php echo $cpb_user_access_message; ?></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
