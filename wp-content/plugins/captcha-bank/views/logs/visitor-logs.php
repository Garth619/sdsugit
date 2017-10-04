<?php
/**
 * This Template is used for managing visitor logs.
 *
 * @author  Tech Banker
 * @package captcha-bank/views/logs
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
   } elseif (logs_captcha_bank == "1") {
      $cpb_selected_logs_delete = wp_create_nonce("captcha_selected_logs_delete");
      $timestamp = time();
      $start_date = $timestamp - 86340;
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
               <a href="admin.php?page=captcha_bank_login_logs">
                  <?php echo $cpb_logs_menu; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpb_visitor_logs_title; ?>
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
                     <?php echo $cpb_visitor_logs_on_world_map; ?>
                  </div>
                  <p class="premium-editions">
                     <?php echo $cpb_upgrade_need_help ?><a href="https://captcha-bank.tech-banker.com/" target="_blank" class="premium-editions-documentation"><?php echo $cpb_documentation ?></a><?php echo $cpb_read_and_check; ?><a href="https://captcha-bank.tech-banker.com/frontend-demos/" target="_blank" class="premium-editions-documentation"><?php echo $cpb_demos_section; ?></a> 
                  </p>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_visitor_log">
                     <div class="form-body">
                        <div id="map_canvas" class="custom-map"></div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-users"></i>
                     <?php echo $cpb_visitor_logs_title; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_visitor_logs">
                     <div class="form-body">
                        <?php
                        if ($visitor_logs_data_unserialize["visitor_logs_monitoring"] == "enable") {
                           ?>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">
                                       <?php echo $cpb_start_date_heading; ?> :
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_live_traffic_start_date_tooltip; ?>" data-placement="right"></i>
                                       <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                                    </label>
                                    <div class="input-icon-custom right">
                                       <input type="text" class="form-control" name="ux_txt_cpb_start_date" value="<?php echo date("m/d/Y", $start_date) ?>" onkeypress="prevent_data_captcha_bank(event);" id="ux_txt_cpb_start_date"  placeholder="<?php echo $cpb_start_date_placeholder; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label">
                                       <?php echo $cpb_end_date_heading; ?> :
                                       <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_live_traffic_end_date_tooltip; ?>" data-placement="right"></i>
                                       <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                                    </label>
                                    <input type="text" class="form-control" name="ux_txt_cpb_end_date" value="<?php echo date("m/d/Y", $timestamp) ?>" id="ux_txt_cpb_end_date" onkeypress="prevent_data_captcha_bank(event);" placeholder="<?php echo $cpb_end_date_placeholder; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="form-actions">
                              <div class="pull-right">
                                 <input type="submit" class="btn vivid-green" name="ux_btn_visitor_logs" id="ux_btn_visitor_logs" value="<?php echo $cpb_submit; ?>">
                              </div>
                           </div>
                           <div class="line-separator"></div>
                           <div class="table-top-margin">
                              <select name="ux_ddl_visitor_logs" id="ux_ddl_visitor_logs" class="custom-bulk-width" onChange="captcha_bank_show_time_for('#ux_ddl_visitor_logs', '#ux_ddl_visitor_logs_block_for');">
                                 <option value=""><?php echo $cpb_bulk_action; ?></option>
                                 <option value="delete" style="color: red;"><?php echo $cpb_delete . " ( " . $cpb_premium_editions_label . " ) "; ?></option>
                                 <option value="block" style="color: red;"><?php echo $cpb_block . " ( " . $cpb_premium_editions_label . " ) "; ?></option>
                              </select>
                              <select name="ux_ddl_visitor_logs_block_for" id="ux_ddl_visitor_logs_block_for" style="display:none" class="custom-bulk-width">
                                 <option value="1Hour"><?php echo $cpb_one_hour; ?></option>
                                 <option value="12Hour"><?php echo $cpb_twelve_hours; ?></option>
                                 <option value="24hours"><?php echo $cpb_twenty_four_hours; ?></option>
                                 <option value="48hours"><?php echo $cpb_forty_eight_hours; ?></option>
                                 <option value="week"><?php echo $cpb_one_week; ?></option>
                                 <option value="month"><?php echo $cpb_one_month; ?></option>
                                 <option value="permanently"><?php echo $cpb_permanently; ?></option>
                              </select>
                              <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" onclick='premium_edition_notification_captcha_bank();' value="<?php echo $cpb_apply; ?>">
                           </div>
                           <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_visitor_logs">
                              <thead>
                                 <tr>
                                    <th style="text-align:center;width: 5% !important;" class="chk-action">
                                       <input type="checkbox" name="ux_chk_visitor_logs" id="ux_chk_visitor_logs">
                                    </th>
                                    <th style="width:15%;">
                                       <label class="control-label">
                                          <?php echo $cpb_user_name; ?>
                                       </label>
                                    </th>
                                    <th style="width:15%;">
                                       <label class="control-label">
                                          <?php echo $cpb_ip_address; ?>
                                       </label>
                                    </th>
                                    <th style="width:15%;">
                                       <label class="control-label">
                                          <?php echo $cpb_location; ?>
                                       </label>
                                    </th>
                                    <th style="width:25%;">
                                       <label class="control-label">
                                          <?php echo $cpb_details; ?>
                                       </label>
                                    </th>
                                    <th style="width:15%;">
                                       <label class="control-label">
                                          <?php echo $cpb_date_time; ?>
                                       </label>
                                    </th>
                                    <th style="text-align:center;width: 10%;" class="chk-action">
                                       <label class="control-label">
                                          <?php echo $cpb_action; ?>
                                       </label>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody id="dynamic_table_filter">
                                 <?php
                                 foreach ($cpb_data_logs as $row) {
                                    ?>
                                    <tr>
                                       <td style="text-align: center;width: 5% !important;">
                                          <input type="checkbox" onclick="check_all_captcha_bank('#ux_chk_visitor_logs');" name="ux_chk_details_<?php echo intval($row["meta_id"]) ?>" id="ux_chk_details_<?php echo intval($row["meta_id"]) ?>" value="<?php echo intval($row["meta_id"]) ?>">
                                       </td>
                                       <td style="width: 15%;">
                                          <label>
                                             <?php echo $row["username"] != "" ? esc_html($row["username"]) : $cpb_na ?>
                                          </label>
                                       </td>
                                       <td style="width: 15%;">
                                          <label>
                                             <?php echo long2ip($row["user_ip_address"]) ?>
                                          </label>
                                       </td>
                                       <td style="width: 15%;">
                                          <label>
                                             <?php echo $row["location"] != "" ? esc_html($row["location"]) : $cpb_na; ?>
                                          </label>
                                       </td>
                                       <td style="width: 25%;">
                                          <label>
                                             <?php echo $cpb_resources; ?>: <?php echo esc_html($row["resources"]); ?><br/>
                                             <?php echo $cpb_http_user_agent; ?>: <?php echo esc_html($row["http_user_agent"]); ?>
                                          </label>
                                       </td>
                                       <td style="width: 15%;">
                                          <label>
                                             <?php echo date_i18n('d M Y h:i A', esc_attr($row["date_time"])); ?>
                                          </label>
                                       </td>
                                       <td class="custom-alternative" style="width: 10%;">
                                          <a href="javascript:void(0);" class="icon-custom-trash tooltips custom-delete-icon-custom-live" data-original-title="<?php echo $cpb_delete; ?>" onclick='delete_selected_log_captcha_bank(<?php echo $row["meta_id"]; ?>, <?php echo json_encode($cpb_delete_visitor_logs); ?>, "admin.php?page=captcha_bank_visitor_logs");' data-placement="top"></a>
                                          <a href="javascript:void(0);" class="icon-custom-ban tooltips" data-original-title="<?php echo $cpb_block_ip_address; ?>" data-placement="right" onclick="premium_edition_notification_captcha_bank();"></a>
                                       </td>
                                    </tr>
                                    <?php
                                 }
                                 ?>
                              </tbody>
                           </table>
                           <?php
                        } else {
                           ?>
                           <strong>
                              <?php echo $cpb_visitor_logs_monitoring_message; ?>
                           </strong>
                           <?php
                        }
                        ?>
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
               <a href="admin.php?page=captcha_bank_login_logs">
                  <?php echo $cpb_logs_menu; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpb_visitor_logs_title; ?>
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
                     <?php echo $cpb_visitor_logs_title; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_visitor_log">
                     <div class="form-body">
                        <strong><?php echo $cpb_user_access_message; ?></strong>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php
   }
}