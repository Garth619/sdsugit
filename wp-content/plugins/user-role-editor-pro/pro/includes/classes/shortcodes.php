<?php
/*
 * Class: Add/Process shortcodes
 * Project: User Role Editor Pro WordPress plugin
 * Author: Vladimir Garagulya
 * email: support@role-editor.com
 * 
 */

class URE_Shortcodes {
 
    private $lib = null;
    
    public function __construct(Ure_Lib_Pro $lib) {
    
        $this->lib = $lib;
        $activate_content_for_roles_shortcode = $this->lib->get_option('activate_content_for_roles_shortcode', false);
        if ($activate_content_for_roles_shortcode) {
            add_action('init', array($this, 'add_content_shortcode_for_roles'));
        }
    }
    // end of __construct()
    
    
    public function add_content_shortcode_for_roles() {
                
        add_shortcode('user_role_editor', array($this, 'process_content_shortcode_for_roles'));        
        
    }
    // end of add_content_shortcode_for_roles()

    
    private function show_for_roles($roles) {
        global $current_user;
        
        $show_content = false;
        foreach($roles as $role) {
            $role = trim($role);
            if ($role=='none' && $current_user->ID==0) {
                $show_content = true;
                break;
            }
            if (current_user_can($role)) {
                $show_content = true;
                break;
            }
        }
        
        return $show_content;
    }
    // end of show_for_roles()
    
    
    private function show_for_all_except_roles($roles) {
        global $current_user;
        
        $show_content = true;
        foreach($roles as $role) {
            $role = trim($role);
            if ($role=='none' && $current_user->ID==0) {
                $show_content = false;
                break;
            }
            if (current_user_can($role)) {
                $show_content = false;
                break;
            }
        }
        
        return $show_content;
    }
    // end of show_for_all_except_roles()
    
    
    public function process_content_shortcode_for_roles($atts, $content=null) {                
        
        if (current_user_can('administrator')) {
            return do_shortcode($content);
        }
                
        $attrs = shortcode_atts(
                array(
                    'roles'=>'',
                    'role'=>'',
                    'except_roles'=>'',
                    'except_role'=>''
                ), 
                $atts);
        if (!empty($attrs['roles'])) {
            $roles = explode(',', $attrs['roles']);
        } elseif (!empty($attrs['role'])) {
            $roles = explode(',', $attrs['role']);
        } else {
            $roles = array();
        }        
        if (!empty($roles)) {   
            $show_content = $this->show_for_roles($roles);
        } else {
            if (!empty($attrs['except_roles'])) {
                $except_roles = explode(',', $attrs['except_roles']);
            } elseif (!empty($attrs['except_role'])) {
                $except_roles = explode(',', $attrs['except_role']);
            } else {
                $except_roles = array();
            }            
            $show_content = $this->show_for_all_except_roles($except_roles);    
        }
        if (!$show_content) {
            $content = '';
        } else {
            $content = do_shortcode($content);
        }
        
        return $content;
    }
    // end of process_content_shortcode_for_roles()
    
}
// end of URE_Shortcodes