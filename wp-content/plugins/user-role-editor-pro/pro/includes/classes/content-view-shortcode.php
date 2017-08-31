<?php
/*
 * Class: Add/Process Content view shortcode
 * Project: User Role Editor Pro WordPress plugin
 * Author: Vladimir Garagulia
 * email: support@role-editor.com
 * 
 */

class URE_Content_View_Shortcode {
     
    public function __construct() {
            
        add_action('init', array($this, 'add'));
        
    }
    // end of __construct()
    
    
    public function add() {

        if (current_user_can('administrator')) {    // There are no content view restrictions for administrator
            return;
        }
        
        add_shortcode('user_role_editor', array($this, 'process'));        
        
    }
    // end of add()
                    
                                
    public function process($atts, $content=null) {
        
        $show = URE_Content_View_Shortcode_Users::is_show($atts);
        if ($show===URE_Content_View_Shortcode_Users::NOT_FOUND) {
            $show = URE_Content_View_Shortcode_Roles::is_show($atts);
        }
        
        if (!$show) {
            $content = '';
        } else {
            $content = do_shortcode($content);
        }
        
        return $content;
    }
    // end of process_content_view_shortcode()
    
}
// end of URE_Content_View_Shortcode class