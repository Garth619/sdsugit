<?php
/**
* This Template is used for displaying Premium Editions.
*
* @author tech-banker
* @package Captcha-bank/views/premium-editions
* @version 3.0.0
*/

if(!defined("ABSPATH")) exit; // exit if accessed directly
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
						<?php echo $cpb_upgrade;?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-briefcase"></i>
							<?php echo $cpb_upgrade;?>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_premium_editions">
							<div class="form-body">
								<div class="wpb_wrapper">
									 <div id="go-pricing-table-862" style="margin-bottom:20px;">
											<div class="gw-go gw-go-clearfix gw-go-enlarge-current gw-go-disable-box-shadow gw-go-3cols" data-id="862" data-colnum="3" data-equalize="{&quot;column&quot;:1,&quot;body&quot;:1,&quot;footer&quot;:1}" data-views="{&quot;tp&quot;:{&quot;min&quot;:&quot;768&quot;,&quot;max&quot;:&quot;959&quot;,&quot;cols&quot;:&quot;&quot;},&quot;ml&quot;:{&quot;min&quot;:&quot;480&quot;,&quot;max&quot;:&quot;767&quot;,&quot;cols&quot;:&quot;2&quot;},&quot;mp&quot;:{&quot;min&quot;:&quot;&quot;,&quot;max&quot;:&quot;479&quot;,&quot;cols&quot;:&quot;1&quot;}}" style="opacity: 1;">
												 <div class="gw-go-col-wrap gw-go-col-wrap-0 gw-go-hover gw-go-disable-enlarge gw-go-disable-hover" data-current="1" data-col-index="0" style="height: 760px;">
														<div class="gw-go-col gw-go-clean-style14">
															 <div class="gw-go-col-inner">
																	<div class="gw-go-col-inner-layer"></div>
																	<div class="gw-go-col-inner-layer-over"></div>
																	<div class="gw-go-header"></div>
																	<ul class="gw-go-body">
																		 <li data-row-index="0">
																				<div class="gw-go-body-cell" style="height: 79px;"><span style="font-size:20px;"><br>PERSONAL</span>
																					 <br>Ideal for Individuals
																				</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="1">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li data-row-index="2">
																				<div class="gw-go-body-cell" style="height: 75px;"><span style="color:#A4CD39;">$</span><span style="font-size:52px;color:#A4CD39;">29<br></span><span style="color:#A4CD39;">It's a one time purchase.</span></div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="3">
																				<div class="gw-go-body-cell" style="height: 16px;">1 Installation per License</div>
																		 </li>
																		 <li data-row-index="4">
																				<div class="gw-go-body-cell" style="height: 16px;">1 week of Technical Support</div>
																		 </li>

																		 <li class="gw-go-even" data-row-index="5">
																				<div class="gw-go-body-cell" style="height: 16px;">1 year of Free Updates</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="7">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li data-row-index="6">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li data-row-index="8">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																	</ul>
																	<div class="gw-go-footer-wrap">
																		 <div class="gw-go-footer-spacer"></div>
																		 <div class="gw-go-footer">
																				<div class="gw-go-footer-rows">
																					 <div class="gw-go-footer-row" data-row-index="0">
																							<div class="gw-go-footer-row-inner" style="height: 44px;"><a href="http://beta.tech-banker.com/product/captcha-bank-personal-edition/" class="gw-go-btn gw-go-btn-large"><span class="gw-go-btn-inner">BUY NOW</span></a></div>
																					 </div>
																					 <div class="gw-go-footer-row gw-go-even" data-row-index="1">
																							<div class="gw-go-footer-row-inner" style="height: 0px;"></div>
																					 </div>
																					 <div class="gw-go-footer-row" data-row-index="2">
																							<div class="gw-go-footer-row-inner" style="height: 10px;">&nbsp;</div>
																					 </div>
																				</div>
																		 </div>
																	</div>
															 </div>
															 <div class="gw-go-tooltip"></div>
														</div>
												 </div>
												 <div class="gw-go-col-wrap gw-go-col-wrap-1 gw-go-hover gw-go-disable-enlarge gw-go-disable-hover" data-current="1" data-col-index="1" style="height: 687px;">
														<div class="gw-go-col gw-go-clean-style14">
															 <div class="gw-go-col-inner">
																	<div class="gw-go-col-inner-layer"></div>
																	<div class="gw-go-col-inner-layer-over"></div>
																	<div class="gw-go-ribbon-right"><img src="<?php echo plugins_url("assets/global/img/ribbon_green_right_top.png", dirname(dirname(__FILE__)));?>"></div>
																	<div class="gw-go-header"></div>
																	<ul class="gw-go-body">
																		 <li data-row-index="0">
																				<div class="gw-go-body-cell" style="height: 79px;"><span style="font-size:20px;"><br>BUSINESS</span>
																					 <br>Ideal for Businesses
																				</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="1">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li data-row-index="2">
																				<div class="gw-go-body-cell" style="height: 75px;"><span style="color:#A4CD39;">$</span><span style="font-size:52px;color:#A4CD39;">39<br></span><span style="color:#A4CD39;">It's a one time purchase.</span></div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="3">
																				<div class="gw-go-body-cell" style="height: 16px;">1 Installation per License</div>
																		 </li>
																		 <li data-row-index="4">
																				<div class="gw-go-body-cell" style="height: 16px;">1 month of Technical Support</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="5">
																				<div class="gw-go-body-cell" style="height: 16px;">1 year of Free Updates</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">Captcha for WooCommerce</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="7">
																				<div class="gw-go-body-cell" style="height: 16px;">Captcha for Contact Form 7</div>
																		 </li>
																		 <li data-row-index="8">
																				<div class="gw-go-body-cell" style="height: 16px;">Captcha for BuddyPress</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">Hide Captcha for Registered Users</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="7">
																				<div class="gw-go-body-cell" style="height: 16px;">Block/Unblock Countries</div>
																		 </li>
																		 <li data-row-index="8">
																				<div class="gw-go-body-cell" style="height: 16px;">Bulk Deletion Records</div>
																		 </li>
																	</ul>
																	<div class="gw-go-footer-wrap">
																		 <div class="gw-go-footer-spacer"></div>
																		 <div class="gw-go-footer">
																				<div class="gw-go-footer-rows">
																					 <div class="gw-go-footer-row" data-row-index="0">
																							<div class="gw-go-footer-row-inner" style="height: 44px;"><a href="http://beta.tech-banker.com/product/captcha-bank-business-edition/" class="gw-go-btn gw-go-btn-large"><span class="gw-go-btn-inner">BUY NOW</span></a></div>
																					 </div>
																					 <div class="gw-go-footer-row gw-go-even" data-row-index="1">
																							<div class="gw-go-footer-row-inner" style="height: 0px;"></div>
																					 </div>
																					 <div class="gw-go-footer-row" data-row-index="2">
																							<div class="gw-go-footer-row-inner" style="height: 10px;">&nbsp;</div>
																					 </div>
																				</div>
																		 </div>
																	</div>
															 </div>
															 <div class="gw-go-tooltip"></div>
														</div>
												 </div>
												 <div class="gw-go-col-wrap gw-go-col-wrap-2 gw-go-hover gw-go-disable-enlarge gw-go-disable-hover" data-current="1" data-col-index="2" style="height: 687px;">
														<div class="gw-go-col gw-go-clean-style14">
															 <div class="gw-go-col-inner">
																	<div class="gw-go-col-inner-layer"></div>
																	<div class="gw-go-col-inner-layer-over"></div>
																	<div class="gw-go-header"></div>
																	<ul class="gw-go-body">
																		 <li data-row-index="0">
																				<div class="gw-go-body-cell" style="height: 79px;"><span style="font-size:20px;"><br>DEVELOPER</span>
																					 <br>Ideal for Webmasters
																				</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="1">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li data-row-index="2">
																				<div class="gw-go-body-cell" style="height: 75px;"><span style="color:#A4CD39;">$</span><span style="font-size:52px;color:#A4CD39;">139<br></span><span style="color:#A4CD39;">It's a one time purchase.</span></div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="3">
																				<div class="gw-go-body-cell" style="height: 16px;">5 Installations per License</div>
																		 </li>
																		 <li data-row-index="4">
																				<div class="gw-go-body-cell" style="height: 16px;">6 months of Technical Support </div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="5">
																				<div class="gw-go-body-cell" style="height: 16px;">Life Time Free Updates</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">____</div>
																		 </li>
																		 <li data-row-index="6">
																				<div class="gw-go-body-cell" style="height: 16px;">Captcha for WooCommerce</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="9">
																				<div class="gw-go-body-cell" style="height: 16px;">Captcha for Contact Form 7</div>
																		 </li>
																		 <li class="gw-go-even" data-row-index="7">
																				<div class="gw-go-body-cell" style="height: 16px;">Captcha for BuddyPress</div>
																		 </li>
																		 <li data-row-index="8">
																				<div class="gw-go-body-cell" style="height: 16px;">Hide Captcha for Registered Users</div>
																		 </li>
																		 <li data-row-index="8">
																				<div class="gw-go-body-cell" style="height: 16px;">Block/Unblock Countries</div>
																		 </li>
																		 <li data-row-index="8">
																				<div class="gw-go-body-cell" style="height: 16px;">Bulk Deletion Records</div>
																		 </li>
																	</ul>
																	<div class="gw-go-footer-wrap">
																		 <div class="gw-go-footer-spacer"></div>
																		 <div class="gw-go-footer">
																				<div class="gw-go-footer-rows">
																					 <div class="gw-go-footer-row" data-row-index="0">
																							<div class="gw-go-footer-row-inner" style="height: 44px;"><a href="http://beta.tech-banker.com/product/captcha-bank-developer-edition/" class="gw-go-btn gw-go-btn-large"><span class="gw-go-btn-inner">BUY NOW</span></a></div>
																					 </div>
																					 <div class="gw-go-footer-row gw-go-even" data-row-index="1">
																							<div class="gw-go-footer-row-inner" style="height: 0px;"></div>
																					 </div>
																					 <div class="gw-go-footer-row" data-row-index="2">
																							<div class="gw-go-footer-row-inner" style="height: 10px;">&nbsp;</div>
																					 </div>
																				</div>
																		 </div>
																	</div>
															 </div>
														</div>
												 </div>
											</div>
									 </div>
								</div>
									<h3>All Plans Include</h3>
									<h5 style="color: rgba(0,0,0,0.64);">(This Plugin comes Packed Full with Features which are specified below for every user.)</h5>
									<div class="hr-thin style-line" style="width: 100%;border-top-width: 5px;"></div>
									<div class="row">
										<div class="col-md-4">
											<div class="standard-arrow">
												<ul>
													<li>Automatic Plugin Updates</li>
													<li>Auto IP Address Block / Unblock</li>
													<li>Text Captcha</li>
													<li>Logical Captcha</li>
													<li>Display Settings</li>
													<li>Email Notifications</li>
													<li>Captcha General Settings</li>
													<li>Enhanced Security</li>
													<li>Compatibility with Other Plugins</li>
													<li>Alert Setup Settings</li>
												</ul>
											</div>
										</div>
										<div class="col-md-4">
											<div class="standard-arrow">
												<ul>
													<li>Email Templates</li>
													<li>Login Logs Information</li>
													<li>Live Traffic Information</li>
													<li>Visitor Logs Information</li>
													<li>Block IP Addresses</li>
													<li>Unblock IP Addresses</li>
													<li>Block IP Ranges</li>
													<li>Unblock IP Ranges</li>
													<li>Captcha Layout Settings</li>
													<li>Captcha Font Settings/li>
												</ul>
											</div>
										</div>
										<div class="col-md-4">
											<div class="standard-arrow">
												<ul>
													<li>Captcha For Login</li>
													<li>Captcha For Registration</li>
													<li>Captcha For Comments</li>
													<li>Captcha For Admin Comments</li>
													<li>Captcha For Reset/Lost Password</li>
													<li>Error Messages Settings</li>
													<li>Roles and Capabilities</li>
												</ul>
											</div>
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
}
?>
