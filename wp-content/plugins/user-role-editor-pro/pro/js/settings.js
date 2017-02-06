/* 
 * User Role Editor Pro WordPress plugin
 * Author: Vladimir Garagulya
 * email: support@role-editor.com
 * 
 * Settings section support
 * 
 */


ure_cvr_settings = {    
    
    // Show / Hide Content View Restriction default values section on add-on activation/deactivation
    refresh: function() {
        var checked = jQuery('input[name="activate_content_for_roles"]:checked').length;
        var trow = jQuery('#ure_content_view_defaults');
        if (checked>0) { 
            trow.show();
            var checked1 = jQuery('#content_view_show_access_error_message:checked').length;
            var cont_div = jQuery('#content_view_access_error_message_container');
            if (checked1>0) {
                cont_div.show();
            } else {
                cont_div.hide();
            }
        } else {
            trow.hide();
        }
    },
    
    show_message_div: function() {
        jQuery('#content_view_access_error_message_container').show();
        
    },
    
    hide_message_div: function() {
        jQuery('#content_view_access_error_message_container').hide();
        
    }
};

jQuery(function() {
    ure_cvr_settings.refresh();
});



