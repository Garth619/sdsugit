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
    
    public function __construct() {
    
        $this->lib = Ure_Lib_Pro::get_instance();
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


    /**
     * Check if current user has at least one of roles inside $roles array
     * @global WP_User $current_user
     * @param array $roles
     * @return boolean
     */
    private function show_for_roles_or($roles) {
        global $current_user;

        if (empty($roles)) {
            return false;
        }
        
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
    // end of show_for_roles_or()
    
    
    /**
     * Check if current user has all roles inside $roles array simultaneously
     * @global WP_User $current_user
     * @param array $roles
     * @return boolean
     */
    private function show_for_roles_and($roles) {
        global $current_user;
        
        if (empty($roles)) {
            return false;
        }
        
        $show_content = true;
        foreach($roles as $role) {
            $role = trim($role);
            if ($role=='none' && $current_user->ID==0) {
                break;
            }
            if (!current_user_can($role)) {
                $show_content = false;
                break;
            }
        }
        
        return $show_content;
    }
    // end of show_for_roles_and()
    
    
    private function show_for_all_except_roles_or($roles) {
        global $current_user;
        
        if (empty($roles)) {
            return false;
        }
        
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
    // end of show_for_all_except_roles_or()
    
    
    /**
     * Check if current user does not have all roles inside $roles array simultaneously
     * @global WP_User $current_user
     * @param array $roles
     * @return boolean
     */
    private function show_for_all_except_roles_and($roles) {
        global $current_user;
        
        if (empty($roles)) {
            return false;
        }
        
        $show_content = true; 
        foreach($roles as $role) {
            $role = trim($role);
            if ($role=='none' && $current_user->ID==0) {
                $show_content = false;
                break;
            }
        }
        if (!$show_content) {
            return false;
        }
        
        $can_it = 0;
        foreach($roles as $role) {
            if (current_user_can($role)) {
                $can_it++;
            }
        }
        if ($can_it==count($roles)) {   // user can all roles inside $roles array
            $show_content = false;
        }
        
        return $show_content;
    }
    // end of show_for_all_except_roles_and()
    
    
    private function extract_roles($key, $value) {
        
        if (!empty($key) && substr($key, -1)!=='s') {
            $key .= 's';    // use 'roles' instead of possible 'role'
        }
        $logic = ''; $roles = null;
        if (!empty($value)) {
            if (strpos($value, ',')!==false) {
                $roles = explode(',', $value);
                $logic = 'or';
            } elseif (strpos($value, '&&')!==false) {
                $roles = explode('&&', $value);
                $logic = 'and';
            } else {
                $roles = array($value);
                $logic = 'or';
            }
        }
        
        if (!empty($roles)) {
            $roles = array_map('trim', $roles);
        }
        
        $control = array(
            // or: 'role1, role2': check if user has role1 or role2; 
            // and: role1 && role2': check if user has both role1 and role2.simultaneously
            'logic'=>$logic,
            // roles or except_roles
            'check'=>$key,
            'roles'=>$roles
        );
        
        return $control;
    }
    // end of extract_roles()
    
    
    private function is_show_content($control) {        
        if (empty($control['roles']) || empty($control['check'])) {
            return false;
        }
        
        $show_content = true;
        if ($control['check']=='roles') {
            if ($control['logic']=='or') {
                $show_content = $this->show_for_roles_or($control['roles']);
            } else {
                $show_content = $this->show_for_roles_and($control['roles']);
            }
        } elseif($control['check']=='except_roles') {
            if ($control['logic']=='or') {
                $show_content = $this->show_for_all_except_roles_or($control['roles']);
            } else {
                $show_content = $this->show_for_all_except_roles_and($control['roles']);
            }
        }

        return $show_content;
    }
    // end of is_show_content()
    
    
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
        foreach($attrs as $key=>$value) {
            $control = $this->extract_roles($key, $value);
            if (!empty($control['roles'])) {
                break;
            }
        }                        
        
        $show_content = $this->is_show_content($control);        
        if (!$show_content) {
            $content = '';
        } else {
            $content = do_shortcode($content);
        }
        
        return $content;
    }
    // end of process_content_shortcode_for_roles()
    
}
// end of URE_Shortcodes class