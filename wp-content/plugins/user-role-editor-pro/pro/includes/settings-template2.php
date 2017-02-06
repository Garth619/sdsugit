<?php
/*
 * User Role Editor Pro WordPress plugin options page
 * "Additional Modules" tab
 * @Author: Vladimir Garagulya
 * @URL: http://role-editor.com
 * @package UserRoleEditor
 *
 */

?>
      <tr>
        <td>
            <input type="checkbox" name="activate_admin_menu_access_module" id="activate_admin_menu_access_module" value="1" 
            <?php checked($activate_admin_menu_access_module, 1); ?> /> 
            <label for="activate_admin_menu_access_module"><?php esc_html_e('Activate Administrator Menu Access module', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="activate_front_end_menu_access_module" id="activate_front_end_menu_access_module" value="1" 
            <?php checked($activate_front_end_menu_access_module, 1); ?> /> 
            <label for="activate_front_end_menu_access_module"><?php esc_html_e('Activate Front End Menu Access module', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
      
      <tr>
        <td>
            <input type="checkbox" name="activate_widgets_access_module" id="activate_widgets_access_module" value="1" 
            <?php checked($activate_widgets_access_module, 1); ?> /> 
            <label for="activate_widgets_access_module"><?php esc_html_e('Activate Widgets Admin Access module', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="activate_widgets_show_access_module" id="activate_widgets_show_access_module" value="1" 
            <?php checked($activate_widgets_show_access_module, 1); ?> /> 
            <label for="activate_widgets_show_access_module"><?php esc_html_e('Activate Widgets Show Access module', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="activate_meta_boxes_access_module" id="activate_meta_boxes_access_module" value="1" 
                <?php checked($activate_meta_boxes_access_module, 1); ?> /> 
            <label for="activate_meta_boxes_access_module"><?php esc_html_e('Activate Meta Boxes Access module', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="activate_other_roles_access_module" id="activate_other_roles_access_module" value="1" 
                <?php checked($activate_other_roles_access_module, 1); ?> /> 
            <label for="activate_other_roles_access_module"><?php esc_html_e('Activate Other Roles Access module', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>      
      <tr>
        <td>
            <input type="checkbox" name="manage_plugin_activation_access" id="manage_plugin_activation_access" value="1" 
                <?php checked($manage_plugin_activation_access, 1); ?> /> 
            <label for="manage_plugin_activation_access"><?php esc_html_e('Activate per plugin user access management for plugins activation', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>      
      <tr>
          <td cospan="2"><h3><?php esc_html_e('Content editing restrictions', 'user-role-editor');?></h3></td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="activate_create_post_capability" id="activate_create_post_capability" value="1" 
                <?php checked($activate_create_post_capability, 1); ?> /> 
            <label for="activate_create_post_capability"><?php esc_html_e('Activate "Create" capability for posts/pages/custom post types', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>      
      <tr>
        <td>
            <input type="checkbox" name="manage_posts_edit_access" id="manage_posts_edit_access" value="1" 
                <?php checked($manage_posts_edit_access==1); ?> /> 
            <label for="manage_posts_edit_access"><?php esc_html_e('Activate user access management to editing selected posts, pages, custom post types', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="force_custom_post_types_capabilities" id="force_custom_post_types_capabilities" value="1" 
                <?php checked($force_custom_post_types_capabilities, 1); ?> /> 
            <label for="force_custom_post_types_capabilities"><?php esc_html_e('Force custom post types to use their own capabilities', 'user-role-editor'); ?></label>
        </td>
        <td>
        </td>
      </tr>
<?php
if (class_exists('GFForms')) {
?>
      <tr>
        <td>
            <input type="checkbox" name="manage_gf_access" id="manage_gf_access" value="1" <?php checked($manage_gf_access, 1); ?> />
            <label for="manage_gf_access"><?php esc_html_e('Activate per form user access management for Gravity Forms', 'user-role-editor'); ?></label>
        </td>
        <td> 
        </td>
      </tr>
<?php
    
}
?>
      <tr>
          <td cospan="2"><h3><?php esc_html_e('Content view restrictions', 'user-role-editor');?></h3></td>
      </tr>
      <tr>
          <td>
              <input type="checkbox" name="activate_content_for_roles_shortcode" id="activate_content_for_roles_shortcode" value="1" 
                    <?php checked($activate_content_for_roles_shortcode,1); ?> />
              <label for="activate_content_for_roles_shortcode"><?php esc_html_e('Activate [user_role_editor roles="role1, role2, ..."] shortcode', 'user-role-editor'); ?></label>
          </td>
          <td>              
          </td>
      </tr>
      <tr>
          <td>
              <input type="checkbox" name="activate_content_for_roles" id="activate_content_for_roles" value="1" onclick="ure_cvr_settings.refresh();"
                    <?php checked($activate_content_for_roles, 1); ?> />
              <label for="activate_content_for_roles"><?php esc_html_e('Activate content view restrictions', 'user-role-editor'); ?></label>              
          </td>
          <td>              
          </td>
      </tr>
      <tr id="ure_content_view_defaults" style="display:none;">
          <td colspan="2"style="padding-left:20px;">
              <div id="cvr_defaults" style="padding-left: 5px;">
                  <span style="font-size: 15px; font-weight: bold;"><?php esc_html_e('Defaults:', 'user-role-editor'); ?></span>
                  <div style="padding-left: 10px;">
                      <strong><?php esc_html_e('View access:', 'user-role-editor'); ?></strong>
                      <div style="padding-left: 20px;">
                          <input type="radio" id="content_view_allow_flag" name="content_view_allow_flag" value="2"  
                                 <?php checked($content_view_allow_flag, 2); ?> />
                          <label for="ure_allow_flag"><?php echo esc_html_e('Allow View', 'user-role-editor'); ?></label><br>
                          <input type="radio" id="content_view_prohibit_flag" name="content_view_allow_flag" value="1"  
                                 <?php checked($content_view_allow_flag, 1); ?> > 
                          <label for="ure_prohibit_flag"><?php echo esc_html_e('Prohibit View', 'user-role-editor'); ?></label>
                      </div>
                  </div>
                  <div style="padding-left: 10px;">
                        <strong><?php esc_html_e('For Users:', 'user-role-editor'); ?></strong>
                        <div style="padding-left: 20px;">
                            <input type="radio" id="content_view_whom_all" name="content_view_whom" value="1"  <?php checked($content_view_whom, 1); ?> > 
                            <label for="content_view_whom_all"><?php echo esc_html_e('All visitors (logged in or not)', 'user-role-editor'); ?></label><br>
                            <input type="radio" id="content_view_whom_any_role" name="content_view_whom" value="2"  <?php checked($content_view_whom, 2); ?> > 
                            <label for="content_view_whom_any_role"><?php echo esc_html_e('Any User Role (logged in only)', 'user-role-editor'); ?></label><br>
                            <input type="radio" id="content_view_whom_selected_roles" name="content_view_whom" value="3"  <?php checked($content_view_whom, 3); ?> > 
                            <label for="ure_content_view_selected_roles"><?php echo esc_html_e('Selected User Roles / (logged in only)', 'user-role-editor'); ?></label>
                        </div>
                  </div>
                  <div style="padding-left: 10px;">
                        <strong><?php esc_html_e('Action:', 'user-role-editor'); ?></strong>
                        <div style="padding-left: 20px;">
                            <input type="radio" id="content_view_show_access_error_message" name="content_view_access_error_action" 
                                   value="2"  <?php checked($content_view_access_error_action, 2); ?> 
                                   onclick="ure_cvr_settings.show_message_div();" > 
                            <label for="content_view_show_access_error_message"><?php echo esc_html_e('Show Access Error Message', 'user-role-editor'); ?></label><br>
                            <input type="radio" id="content_view_return_http_error_404" name="content_view_access_error_action" 
                                   value="1"  <?php checked($content_view_access_error_action, 1); ?> 
                                   onclick="ure_cvr_settings.hide_message_div();" > 
                            <label for="content_view_return_http_error_404"><?php echo esc_html_e('Return HTTP 404 error', 'user-role-editor'); ?></label><br>
                            <div id="content_view_access_error_message_container" style="display:none;">
                                <?php esc_html_e('Message for post access error:', 'user-role-editor'); ?><br/>
                                <textarea id="content_view_access_error_message" name="content_view_access_error_message" rows="5" cols="70"><?php echo $content_view_access_error_message; ?></textarea>
                            </div>
                        </div>
                  </div>                                    
              </div>
          </td>              
      </tr>      