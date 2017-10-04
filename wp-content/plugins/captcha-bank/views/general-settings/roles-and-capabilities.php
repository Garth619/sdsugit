<?php
/**
 * This Template is used for managing roles and capabilities.
 *
 * @author  Tech Banker
 * @package captcha-bank/views/roles-and-capabilities
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
if (!is_user_logged_in()) {
   return;
} else {
   $access_granted = false;
   foreach ($user_role_permission as $permission) {
      if (current_user_can($permission)) {
         $access_granted = true;
         break;
      }
   }
   if (!$access_granted) {
      return;
   } elseif (general_settings_captcha_bank == "1") {
      $roles_and_capabilities = explode(",", isset($details_roles_capabilities["roles_and_capabilities"]) ? esc_attr($details_roles_capabilities["roles_and_capabilities"]) : "");
      $author = explode(",", isset($details_roles_capabilities["author_privileges"]) ? esc_attr($details_roles_capabilities["author_privileges"]) : "");
      $editor = explode(",", isset($details_roles_capabilities["editor_privileges"]) ? esc_attr($details_roles_capabilities["editor_privileges"]) : "");
      $contributor = explode(",", isset($details_roles_capabilities["contributor_privileges"]) ? esc_attr($details_roles_capabilities["contributor_privileges"]) : "");
      $subscriber = explode(",", isset($details_roles_capabilities["subscriber_privileges"]) ? esc_attr($details_roles_capabilities["subscriber_privileges"]) : "");
      $others = explode(",", isset($details_roles_capabilities["other_privileges"]) ? esc_attr($details_roles_capabilities["other_privileges"]) : "");
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
                  <?php echo $cpb_roles_and_capabilities_menu; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-users"></i>
                     <?php echo $cpb_roles_and_capabilities_menu; ?>
                  </div>
                  <p class="premium-editions">
                     <?php echo $cpb_upgrade_need_help ?><a href="https://captcha-bank.tech-banker.com/" target="_blank" class="premium-editions-documentation"><?php echo $cpb_documentation ?></a><?php echo $cpb_read_and_check; ?><a href="https://captcha-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpb_demos_section; ?></a> 
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_roles_and_capabilities">
                     <div class="form-body">
                        <div id="ux_div_plugin_settings">
                           <label class="control-label">
                              <?php echo $cpb_show_roles_and_capabilities_menu; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_menu_tooltip; ?>" data-placement="right"></i>
                              <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                           </label>
                           <table class="table table-striped table-bordered table-margin-top" id="ux_tbl_plugin_settings">
                              <thead>
                                 <tr>
                                    <th>
                                       <input type="checkbox" name="ux_chk_administrator" id="ux_chk_administrator" checked="checked" disabled="disabled" value="1" <?php echo $roles_and_capabilities[0] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpb_roles_and_capabilities_administrator; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox" name="ux_chk_author" id="ux_chk_author" value="1" onclick="show_roles_capabilities_captcha_bank(this, 'ux_div_author_roles');" <?php echo $roles_and_capabilities[1] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpb_roles_and_capabilities_author; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox" name="ux_chk_editor" id="ux_chk_editor" value="1" onclick="show_roles_capabilities_captcha_bank(this, 'ux_div_editor_roles');" <?php echo $roles_and_capabilities[2] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpb_roles_and_capabilities_editor; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox"  name="ux_chk_contributor" id="ux_chk_contributor" value="1" onclick="show_roles_capabilities_captcha_bank(this, 'ux_div_contributor_roles');" <?php echo $roles_and_capabilities[3] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpb_roles_and_capabilities_contributor; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox" name="ux_chk_subscriber" id="ux_chk_subscriber" value="1" onclick="show_roles_capabilities_captcha_bank(this, 'ux_div_subscriber_roles');" <?php echo $roles_and_capabilities[4] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpb_roles_and_capabilities_subscriber; ?>
                                    </th>
                                    <th>
                                       <input type="checkbox" name="ux_chk_other" id="ux_chk_other" value="1" onclick="show_roles_capabilities_captcha_bank(this, 'ux_div_other_roles');" <?php echo $roles_and_capabilities[5] == "1" ? "checked = checked" : "" ?>>
                                       <?php echo $cpb_roles_and_capabilities_others; ?>
                                    </th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpb_roles_and_capabilities_topbar_menu; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_topbar_menu_tooltip; ?>" data-placement="right"></i>
                              <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                           </label>
                           <select name="ux_ddl_settings" id="ux_ddl_settings" class="form-control">
                              <option value="enable"><?php echo $cpb_enable; ?></option>
                              <option value="disable"><?php echo $cpb_disable; ?></option>
                           </select>
                        </div>
                        <div class="line-separator"></div>
                        <div class="form-group">
                           <div id="ux_div_administrator_roles">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_administrator_role; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_administrator_role_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_administrator">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_administrator" id="ux_chk_full_control_administrator" checked="checked" disabled="disabled" value="1">
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_captcha_setup_admin" disabled="disabled" checked="checked" id="ux_chk_captcha_setup_admin" value="1">
                                             <?php echo $cpb_captcha_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_admin" disabled="disabled" checked="checked" id="ux_chk_general_settings_admin" value="1">
                                             <?php echo $cpb_general_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_admin" disabled="disabled" checked="checked" id="ux_chk_logs_admin" value="1">
                                             <?php echo $cpb_logs_menu; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_template_admin" disabled="disabled" checked="checked" id="ux_chk_template_admin" value="1">
                                             <?php echo $cpb_other_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_admin" disabled="disabled" checked="checked" id="ux_chk_advance_security_admin" value="1">
                                             <?php echo $cpb_security_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_admin" disabled="disabled" checked="checked" id="ux_chk_system_information_admin" value="1">
                                             <?php echo $cpb_system_information_menu; ?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_author_roles">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_author_role; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_author_role_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_author">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_author" id="ux_chk_full_control_author" value="1"  onclick="full_control_function_captcha_bank(this, 'ux_div_author_roles');"  <?php echo isset($author) && $author[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_captcha_setup_author" id="ux_chk_captcha_setup_author" value="1" <?php echo isset($author) && $author[1] == "1" ? "checked = checked" : "" ?>?>
                                             <?php echo $cpb_captcha_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_author" id="ux_chk_general_settings_author" value="1" <?php echo isset($author) && $author[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_general_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_author" id="ux_chk_logs_author" value="1" <?php echo isset($author) && $author[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_logs_menu; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_author" id="ux_chk_templates_author" value="1" <?php echo isset($author) && $author[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_other_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_author" id="ux_chk_advance_security_author" value="1" <?php echo isset($author) && $author[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_security_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_author" id="ux_chk_system_information_author" value="1" <?php echo isset($author) && $author[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_system_information_menu; ?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_editor_roles">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_editor_role; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_editor_role_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_editor">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_editor" id="ux_chk_full_control_editor" value="1" onclick="full_control_function_captcha_bank(this, 'ux_div_editor_roles');" <?php echo isset($editor) && $editor[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_captcha_setup_editor" id="ux_chk_captcha_setup_editor" value="1" <?php echo isset($editor) && $editor[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_captcha_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_editor" id="ux_chk_general_settings_editor" value="1" <?php echo isset($editor) && $editor[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_general_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_editor" id="ux_chk_logs_editor" value="1" <?php echo isset($editor) && $editor[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_logs_menu; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_editor" id="ux_chk_templates_editor" value="1" <?php echo isset($editor) && $editor[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_other_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_editor" id="ux_chk_advance_security_editor" value="1" <?php echo isset($editor) && $editor[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_security_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_editor" id="ux_chk_system_information_editor" value="1" <?php echo isset($editor) && $editor[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_system_information_menu; ?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_contributor_roles">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_contributor_role; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_contributor_role_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_contributor">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_contributor" id="ux_chk_full_control_contributor" value="1" onclick="full_control_function_captcha_bank(this, 'ux_div_contributor_roles');" <?php echo isset($contributor) && $contributor[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_captcha_setup_contributor" id="ux_chk_captcha_setup_contributor" value="1" <?php echo isset($contributor) && $contributor[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_captcha_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_contributor" id="ux_chk_general_settings_contributor" value="1" <?php echo isset($contributor) && $contributor[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_general_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_contributor" id="ux_chk_logs_contributor" value="1" <?php echo isset($contributor) && $contributor[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_logs_menu; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_contributor" id="ux_chk_templates_contributor" value="1" <?php echo isset($contributor) && $contributor[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_other_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_contributor" id="ux_chk_advance_security_contributor" value="1" <?php echo isset($contributor) && $contributor[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_security_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_contributor" id="ux_chk_system_information_contributor" value="1" <?php echo isset($contributor) && $contributor[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_system_information_menu; ?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_subscriber_roles">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_subscriber_role; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_subscriber_role_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_subscriber">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_subscriber" id="ux_chk_full_control_subscriber" value="1" onclick="full_control_function_captcha_bank(this, 'ux_div_subscriber_roles');" <?php echo isset($subscriber) && $subscriber[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_captcha_setup_subscriber" id="ux_chk_captcha_setup_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_captcha_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_subscriber" id="ux_chk_general_settings_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_general_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_subscriber" id="ux_chk_logs_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_logs_menu; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_subscriber" id="ux_chk_templates_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_other_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_subscriber" id="ux_chk_advance_security_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_security_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_subscriber" id="ux_chk_system_information_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_system_information_menu; ?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_other_roles">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_other_role; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_other_role_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_other">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_others" id="ux_chk_full_control_others" value="1" onclick="full_control_function_captcha_bank(this, 'ux_div_other_roles');" <?php echo isset($others) && $others[0] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_captcha_setup_others" id="ux_chk_captcha_setup_others" value="1" <?php echo isset($others) && $others[1] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_captcha_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_general_settings_others" id="ux_chk_general_settings_others" value="1" <?php echo isset($others) && $others[2] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_general_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_logs_others" id="ux_chk_logs_others" value="1" <?php echo isset($others) && $others[3] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_logs_menu; ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <input type="checkbox" name="ux_chk_templates_others" id="ux_chk_templates_others" value="1" <?php echo isset($others) && $others[4] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_other_settings_menu; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_advance_security_others" id="ux_chk_advance_security_others" value="1" <?php echo isset($others) && $others[5] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_security_settings_label; ?>
                                          </td>
                                          <td>
                                             <input type="checkbox" name="ux_chk_system_information_others" id="ux_chk_system_information_others" value="1" <?php echo isset($others) && $others[6] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_system_information_menu; ?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div id="ux_div_other_roles_capabilities">
                              <label class="control-label">
                                 <?php echo $cpb_roles_and_capabilities_other_roles_capabilities; ?> :
                                 <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_roles_and_capabilities_other_roles_capabilities_tooltip; ?>" data-placement="right"></i>
                                 <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                              </label>
                              <div class="table-margin-top">
                                 <table class="table table-striped table-bordered table-hover" id="ux_tbl_other_roles">
                                    <thead>
                                       <tr>
                                          <th style="width: 40% !important;">
                                             <input type="checkbox" name="ux_chk_full_control_other_roles" id="ux_chk_full_control_other_roles" value="1" onclick="full_control_function_captcha_bank(this, 'ux_div_other_roles_capabilities');" <?php echo $details_roles_capabilities["others_full_control_capability"] == "1" ? "checked = checked" : "" ?>>
                                             <?php echo $cpb_roles_and_capabilities_full_control; ?>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $flag = 0;
                                       $user_capabilities = get_others_capabilities_captcha_bank();
                                       foreach ($user_capabilities as $key => $value) {
                                          $other_roles = in_array($value, $other_roles_array) ? "checked=checked" : "";
                                          $flag++;
                                          if ($key % 3 == 0) {
                                             ?>
                                             <tr>
                                                <?php
                                             }
                                             ?>
                                             <td>
                                                <input type="checkbox" name="ux_chk_other_capabilities_<?php echo $value; ?>" id="ux_chk_other_capabilities_<?php echo $value; ?>" value="<?php echo $value; ?>" <?php echo $other_roles; ?>>
                                                <?php echo $value; ?>
                                             </td>
                                             <?php
                                             if (count($user_capabilities) == $flag && $flag % 3 == 1) {
                                                ?>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <?php
                                             }
                                             ?>
                                             <?php
                                             if (count($user_capabilities) == $flag && $flag % 3 == 2) {
                                                ?>
                                                <td>
                                                </td>
                                                <?php
                                             }
                                             ?>
                                             <?php
                                             if ($flag % 3 == 0) {
                                                ?>
                                             </tr>
                                             <?php
                                          }
                                       }
                                       ?>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="line-separator"></div>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="submit" class="btn vivid-green" name="ux_btn_plugin_change" id="ux_btn_plugin_change" value="<?php echo $cpb_save_changes; ?>">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php
   } else {
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
                  <?php echo $cpb_roles_and_capabilities_menu; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-users"></i>
                     <?php echo $cpb_roles_and_capabilities_menu; ?>
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