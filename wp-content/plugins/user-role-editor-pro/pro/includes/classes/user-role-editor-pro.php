<?php
/*
 * User Role Editor Pro WordPress plugin - main class
 * Author: Vladimir Garagulya
 * Author email: support@role-editor.com
 * Author URI: https://www.role-editor.com
 * License: GPL v3
 * 
*/

class User_Role_Editor_Pro extends User_Role_Editor {
       
    public $screen_help = null;

    
    public static function get_instance() {
        if (self::$instance===null) {        
            self::$instance = new User_Role_Editor_Pro();
        }
        
        return self::$instance;
    }
    // end of get_instance()

    
    protected function __construct() {
        $this->lib = URE_Lib_Pro::get_instance('user_role_editor');
        
        add_action('ure_on_activation', array($this, 'execute_once'));
        parent::__construct();                                        
        add_action('plugins_loaded', array($this, 'load_addons'));                        
        new URE_Shortcodes();
        $this->allow_unfiltered_html(); 
        
        $this->init_updater();
                
    }
    // end of __construct()

    
    public function execute_once() {
        
        URE_Addons_Manager::execute_once();        
                
    }
    // end of update_on_activation()

        
    private function init_updater() {
        $multisite = $this->lib->get('multisite');
        if ((!$multisite && is_admin()) || 
            ($multisite && (is_network_admin() || (is_admin() && defined('DOING_AJAX') && DOING_AJAX)))) {
            require_once(URE_PLUGIN_DIR . 'pro/includes/plugin-update-checker.php');
            $ure_update_checker = new PluginUpdateChecker(URE_UPDATE_URL . '?action=get_metadata&slug=user-role-editor-pro', URE_PLUGIN_FULL_PATH);
            //Add the license key to query arguments.
            $ure_update_checker->addQueryArgFilter(array($this, 'filter_update_checks'));
        }
    }
    // end of init_updater()   
    

    public function plugin_init() {
        parent::plugin_init();

        add_action('ure_settings_update1', array($this, 'settings_update1'));
        add_action('ure_settings_update2', array($this, 'settings_update2'));
        add_action('ure_settings_show1', array($this, 'settings_show1'));
        add_action('ure_settings_show2', array($this, 'settings_show2'));
        
        $multisite = $this->lib->get('multisite');
        if ($multisite) {
            add_action('ure_settings_ms_show', array($this, 'settings_ms_show'));
            add_action('ure_settings_ms_update', array($this, 'settings_ms_update'));
        }
        
        add_action('ure_load_js', array($this, 'add_js'));        
        add_action('ure_load_js_settings', array($this, 'add_js_settings'));
        
        $active_for_network = $this->lib->get('active_for_network');
        if ($multisite && is_network_admin()) {
            if (!$active_for_network) {
                add_filter('network_admin_plugin_action_links_'. URE_PLUGIN_BASE_NAME, 
                           array($this, 'network_admin_plugin_action_links'), 10, 1);
            }
            add_action('ms_user_row_actions', array( $this, 'user_row'), 10, 2);
            add_action('ure_role_edit_toolbar_update', 'URE_Pro_View::add_role_update_network_button');
            add_action('ure_user_edit_toolbar_update', 'URE_Pro_View::add_user_update_network_button');
            add_action('ure_dialogs_html', 'URE_Pro_View::network_update_dialog_html');
            add_action('ure_load_js_settings', array($this, 'add_js_settings_ms'));
        }
                
        if (!$multisite) {
            $count_users_without_role = $this->lib->get_option('count_users_without_role', 0);
            if ($count_users_without_role) {
                add_action(URE_Assign_Role_Pro::CRON_ACTION_HOOK, array($this, 'assign_role_to_users_without_role'));
            }
        }
        
        $this->screen_help = new URE_Screen_Help_Pro();
    }
    // end of plugin_init()
    
    
    /**
     * Modify plugin action links
     * 
     * @param array $links
     * @param string $file
     * @return array
     */
    public function network_admin_plugin_action_links($links) {
/*
        $settings_link = "<a href='settings.php?page=settings-" . URE_PLUGIN_FILE . "'>" . esc_html__('Settings', 'user-role-editor') . "</a>";
        $links = array_merge($links, array($settings_link));
*/
        return $links;
    }
    // end of network_admin_plugin_action_links()

    
    /**
     * It is fully overriden version of the parent method
     */
    public function admin_css_action() {       
        
        wp_enqueue_style('wp-jquery-ui-dialog');
        if (stripos($_SERVER['REQUEST_URI'], 'settings-user-role-editor')!==false) {
            $use_jquery_cdn_for_ui_css = $this->lib->get_option('use_jquery_cdn_for_ui_css', false);
            if ($use_jquery_cdn_for_ui_css) {
                wp_enqueue_style('ure-jquery-ui-tabs', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css', array(), false, 'screen');
            } else {
                wp_enqueue_style('ure-jquery-ui-tabs', URE_PLUGIN_URL . 'css/jquery-ui-1.10.4.custom.min.css', array(), false, 'screen');
            }            
        }
        wp_enqueue_style('ure-admin-css', URE_PLUGIN_URL . 'css/ure-admin.css', array(), false, 'screen');        
                        
    }
    // end of admin_css_action()    
    
    
    protected function is_user_profile_extention_allowed() {
        // no limits for the Pro version
        return true;
    }
    // end of is_user_profile_extention_allowed()
    
    
    /**
     * Load additional modules
     * 
     */
    public function load_addons() {
        
        $show_notices_to_admin_only = $this->lib->get_option('show_notices_to_admin_only', false);
        if ($show_notices_to_admin_only) {
            add_action('admin_head', array($this, 'show_notices_to_admin_only'));
        }
        
        $activate_create_post_capability = $this->lib->get_option('activate_create_post_capability', false);
        if ($activate_create_post_capability) {       
            new URE_Create_Posts_Cap();
        }
        
        $force_custom_post_types_capabilities = $this->lib->get_option('force_custom_post_types_capabilities', false);
        if ($force_custom_post_types_capabilities) {
            new URE_Post_Types_Own_Caps();
        }
        
        $manager = URE_Addons_Manager::get_instance();
        $manager->load_addons();        

        if ((is_admin() || is_network_admin()) && (!(defined('DOING_AJAX') && DOING_AJAX))) {
            new Ure_Export_Import();
        }
                
    }
    // end of load_addons()
    
            
    /*
     * General options tab update
     */
    public function settings_update1() {
                
        $show_notices_to_admin_only = $this->lib->get_request_var('show_notices_to_admin_only', 'checkbox');
        $this->lib->put_option('show_notices_to_admin_only', $show_notices_to_admin_only);
        
        $use_jquery_cdn_for_ui_css = $this->lib->get_request_var('use_jquery_cdn_for_ui_css', 'checkbox');
        $this->lib->put_option('use_jquery_cdn_for_ui_css', $use_jquery_cdn_for_ui_css);
        
        $license_key = new URE_License_Key($this->lib);
        if ($license_key->is_editable()) {
            $license_key_value = $this->lib->get_request_var('license_key', 'post');            
            if (!empty($license_key_value) && strpos($license_key_value, '*')===false) {
                $this->lib->put_option('license_key', $license_key_value);
            }
        }
    }
    // end of settings_update1()
    
    
    /*
     * Additional Modules options tab update
     */
    public function settings_update2() {
                            
        $activate_admin_menu_access_module = $this->lib->get_request_var('activate_admin_menu_access_module', 'checkbox');
        $this->lib->put_option('activate_admin_menu_access_module', $activate_admin_menu_access_module);
        
        $activate_front_end_menu_access_module = $this->lib->get_request_var('activate_front_end_menu_access_module', 'checkbox');
        $this->lib->put_option('activate_front_end_menu_access_module', $activate_front_end_menu_access_module);
        
        $activate_widgets_access_module = $this->lib->get_request_var('activate_widgets_access_module', 'checkbox');
        $this->lib->put_option('activate_widgets_access_module', $activate_widgets_access_module);
        
        $activate_widgets_show_access_module = $this->lib->get_request_var('activate_widgets_show_access_module', 'checkbox');
        $this->lib->put_option('activate_widgets_show_access_module', $activate_widgets_show_access_module);
        
        $activate_meta_boxes_access_module = $this->lib->get_request_var('activate_meta_boxes_access_module', 'checkbox');
        $this->lib->put_option('activate_meta_boxes_access_module', $activate_meta_boxes_access_module);
        
        $activate_other_roles_access_module = $this->lib->get_request_var('activate_other_roles_access_module', 'checkbox');
        $this->lib->put_option('activate_other_roles_access_module', $activate_other_roles_access_module);
        
        $manage_plugin_activation_access = $this->lib->get_request_var('manage_plugin_activation_access', 'checkbox');
        $this->lib->put_option('manage_plugin_activation_access', $manage_plugin_activation_access);
        
        $manage_posts_edit_access = $this->lib->get_request_var('manage_posts_edit_access', 'checkbox');
        $this->lib->put_option('manage_posts_edit_access', $manage_posts_edit_access);

        if ($manage_posts_edit_access) {
            $activate_create_post_capability = 1;
        } else {
            $activate_create_post_capability = $this->lib->get_request_var('activate_create_post_capability', 'checkbox');
        }
        $this->lib->put_option('activate_create_post_capability', $activate_create_post_capability);
        
        $force_custom_post_types_capabilities = $this->lib->get_request_var('force_custom_post_types_capabilities', 'checkbox');
        $this->lib->put_option('force_custom_post_types_capabilities', $force_custom_post_types_capabilities);
        
        if (class_exists('GFForms')) {
            $manage_gf_access = $this->lib->get_request_var('manage_gf_access', 'checkbox');
            $this->lib->put_option('manage_gf_access', $manage_gf_access);
        }

        $activate_content_for_roles_shortcode = $this->lib->get_request_var('activate_content_for_roles_shortcode', 'checkbox');
        $this->lib->put_option('activate_content_for_roles_shortcode', $activate_content_for_roles_shortcode);
        
        $activate_content_for_roles = $this->lib->get_request_var('activate_content_for_roles', 'checkbox');
        $this->lib->put_option('activate_content_for_roles', $activate_content_for_roles);
        if (empty($activate_content_for_roles)) {
            return;
        }
        
        $content_view_allow_flag = $this->lib->get_request_var('content_view_allow_flag', 'int');
        $this->lib->put_option('content_view_allow_flag', $content_view_allow_flag);
        
        $content_view_whom = $this->lib->get_request_var('content_view_whom', 'int');
        $this->lib->put_option('content_view_whom', $content_view_whom);
        
        $content_view_access_error_action = $this->lib->get_request_var('content_view_access_error_action', 'int');
        $this->lib->put_option('content_view_access_error_action', $content_view_access_error_action);
        
        if ($content_view_access_error_action==2) {
            $content_view_access_error_message = $_POST['content_view_access_error_message'];
            $this->lib->put_option('post_access_error_message', $content_view_access_error_message);
        }
        
    }
    // end of settings_update2()
    

    
    // Update settings from Multisite tab
    public function settings_ms_update() {
        $multisite = $this->lib->get('multisite');
        if (!$multisite) {
            return;
        }
        
        if (defined('URE_ENABLE_SIMPLE_ADMIN_FOR_MULTISITE') && (URE_ENABLE_SIMPLE_ADMIN_FOR_MULTISITE == 1)) {
            $enable_simple_admin_for_multisite = 1;
        } else {
            $enable_simple_admin_for_multisite = $this->lib->get_request_var('enable_simple_admin_for_multisite', 'checkbox');
        }
        $this->lib->put_option('enable_simple_admin_for_multisite', $enable_simple_admin_for_multisite);
        
        $enable_unfiltered_html_ms = $this->lib->get_request_var('enable_unfiltered_html_ms', 'checkbox');
        $this->lib->put_option('enable_unfiltered_html_ms', $enable_unfiltered_html_ms);
                
        $manage_themes_access = $this->lib->get_request_var('manage_themes_access', 'checkbox');
        $this->lib->put_option('manage_themes_access', $manage_themes_access);
        
        $caps_access_restrict_for_simple_admin = $this->lib->get_request_var('caps_access_restrict_for_simple_admin', 'checkbox');
        $this->lib->put_option('caps_access_restrict_for_simple_admin', $caps_access_restrict_for_simple_admin);
        if ($caps_access_restrict_for_simple_admin) {
            $add_del_role_for_simple_admin = $this->lib->get_request_var('add_del_role_for_simple_admin', 'checkbox');
            $caps_allowed_for_single_admin = $this->lib->filter_existing_caps_input('caps_allowed_for_single_admin');            
        } else {
            $add_del_role_for_simple_admin = 1;
            $caps_allowed_for_single_admin = array();            
        }
        $this->lib->put_option('add_del_role_for_simple_admin', $add_del_role_for_simple_admin);
        $this->lib->put_option('caps_allowed_for_single_admin', $caps_allowed_for_single_admin);
        
    }
    // end of settings_ms_update()

    
    /**
     * Show options at General tab
     * 
     */
    public function settings_show1() {
		                
        $show_notices_to_admin_only = $this->lib->get_option('show_notices_to_admin_only', false);
        $use_jquery_cdn_for_ui_css = $this->lib->get_option('use_jquery_cdn_for_ui_css', false);
        
        $license_key = new URE_License_Key($this->lib);        
        $license_key_value = $license_key->get();
        $license_state = $license_key->validate($license_key_value);
        if ($license_state['state']=='active') {
            $license_state_color = 'green';
        } else {
            $license_state_color = 'red';
        }
        $multisite = $this->lib->get('multisite');
        $active_for_network = $this->lib->get('active_for_network');
        $license_key_only = $multisite && is_network_admin() && !$active_for_network;                
        if ($multisite) {
            $link = 'settings.php';
        } else {
            $link = 'options-general.php';
        }        
        
        require_once(URE_PLUGIN_DIR .'pro/includes/settings-template1.php');
    }
    // end of settings_show1()
     

    /**
     * Show options at Additional Modules tab
     * 
     */
    public function settings_show2() {
		                
        
        $activate_admin_menu_access_module = $this->lib->get_option('activate_admin_menu_access_module', false);
        $activate_front_end_menu_access_module = $this->lib->get_option('activate_front_end_menu_access_module', false);
        $activate_widgets_access_module = $this->lib->get_option('activate_widgets_access_module', false);  // Widgets Admin Access to widget configuration
        $activate_widgets_show_access_module = $this->lib->get_option('activate_widgets_show_access_module', false);    // Widgets Show/View Access (at front-end)
        $activate_meta_boxes_access_module = $this->lib->get_option('activate_meta_boxes_access_module', false);
        $activate_other_roles_access_module = $this->lib->get_option('activate_other_roles_access_module', false);
        $manage_plugin_activation_access = $this->lib->get_option('manage_plugin_activation_access', false);
        if (class_exists('GFForms')) {
            $manage_gf_access = $this->lib->get_option('manage_gf_access', false);
        }
        
// content editing restrictions        
        $activate_create_post_capability = $this->lib->get_option('activate_create_post_capability', false);
        $manage_posts_edit_access = $this->lib->get_option('manage_posts_edit_access', false);
        $force_custom_post_types_capabilities = $this->lib->get_option('force_custom_post_types_capabilities', false);

// content view restrictions
        $activate_content_for_roles_shortcode = $this->lib->get_option('activate_content_for_roles_shortcode', false);
        $activate_content_for_roles = $this->lib->get_option('activate_content_for_roles', false);
        // default values
        $content_view_allow_flag = $this->lib->get_option('content_view_allow_flag', 2);          
        // For whome
        $content_view_whom = $this->lib->get_option('content_view_whom', 3);   
        // Action
        $content_view_access_error_action = $this->lib->get_option('content_view_access_error_action', 2);
        // Access error message
        $content_view_access_error_message = stripslashes($this->lib->get_option('post_access_error_message', 
                '<p class="restricted">Not enough permissions to view this content.</p>'));
            
        $multisite = $this->lib->get('multisite');
        if ($multisite) {
            $link = 'settings.php';
        } else {
            $link = 'options-general.php';
        }
		
        require_once(URE_PLUGIN_DIR .'pro/includes/settings-template2.php');
    }
    // end of settings_show2()
    
    
    public function settings_ms_show() {
        $multisite = $this->lib->get('multisite');
        if (!$multisite) {
            return;
        }

        if (defined('URE_ENABLE_SIMPLE_ADMIN_FOR_MULTISITE') && (URE_ENABLE_SIMPLE_ADMIN_FOR_MULTISITE == 1)) {
            $enable_simple_admin_for_multisite = 1;
        } else {
            $enable_simple_admin_for_multisite = $this->lib->get_option('enable_simple_admin_for_multisite', 0);
        }
        $enable_unfiltered_html_ms = $this->lib->get_option('enable_unfiltered_html_ms', 0);
        $manage_themes_access = $this->lib->get_option('manage_themes_access', 0);
        $caps_access_restrict_for_simple_admin = $this->lib->get_option('caps_access_restrict_for_simple_admin', 0);
        if ($caps_access_restrict_for_simple_admin) {  
            $add_del_role_for_simple_admin = $this->lib->get_option('add_del_role_for_simple_admin', 1);
            $html_caps_blocked_for_single_admin = $this->lib->build_html_caps_blocked_for_single_admin();
            $html_caps_allowed_for_single_admin = $this->lib->build_html_caps_allowed_for_single_admin();
        }
        
        require_once(URE_PLUGIN_DIR . 'pro/includes/settings-template-ms.php');

    }
    // end of settings_ms_show()
            
 
    public function network_plugin_menu() {
        
        parent::network_plugin_menu();
        
        $multisite = $this->lib->get('multisite');
        if ($multisite) {
            $ure_page = add_submenu_page('users.php', esc_html__('User Role Editor', 'user-role-editor'), esc_html__('User Role Editor', 'user-role-editor'), 
            $this->key_capability, 'users-'.URE_PLUGIN_FILE, array($this, 'edit_roles'));
            add_action("admin_print_styles-$ure_page", array($this, 'admin_css_action'));        
        }
        
    } 
    // end of network_plugin_menu()
                
	
    public function filter_update_checks($query_args) {
    
        $license_key = new URE_License_Key($this->lib);
        $license_key_value = $license_key->get();
        if (!empty($license_key_value)) {
            $query_args['license_key'] = $license_key_value;
        }

        return $query_args;
    }
    // end of filter_update_checks()
    
    
    public function add_js() {
        
        wp_register_script( 'ure-js-pro', plugins_url( '/pro/js/ure-pro.js', URE_PLUGIN_FULL_PATH ) );
        wp_enqueue_script ( 'ure-js-pro' );
        
        $manager = URE_Addons_Manager::get_instance();
        $addons = $manager->get_replicatable();
        $replicators = array();
        foreach($addons as $addon) {
            $replicators[] = $manager->get_replicator_id($addon->id);
        }
        
        wp_localize_script( 'ure-js-pro', 'ure_data_pro', 
                array(
                    'update_network' => esc_html__('Update Network', 'user-role-editor'),
                    'replicators'=>$replicators
                ));
    }
    // end of add_js()
    

    public function add_js_settings() {
        
        wp_register_script( 'ure-settings', plugins_url( '/pro/js/settings.js', URE_PLUGIN_FULL_PATH ) );
        wp_enqueue_script ( 'ure-settings' );
        
    }
    // end of add_js_settings()
    
    
    public function add_js_settings_ms() {
        
        wp_register_script( 'ure-jquery-dual-listbox', plugins_url( '/pro/js/jquery.dualListBox-1.3.js', URE_PLUGIN_FULL_PATH ) );
        wp_enqueue_script ( 'ure-jquery-dual-listbox' );        
        
    }
    // end of add_js_settings_ms()

    
    public function edit_user_profile($user) {

        global $current_user;
    
        if (!is_network_admin()) {
            parent::edit_user_profile($user);
            return;
        }
        
        if (!$this->lib->user_is_admin($current_user->ID)) {
            return;
        }
?>
        <h3><?php _e('User Role Editor', 'user-role-editor'); ?></h3>
        <table class="form-table">
        		<tr>
        			<th scope="row"><?php _e('Roles', 'user-role-editor'); ?></th>
        			<td>
        <?php        
        $output = $this->lib->roles_text($user->roles);
        echo $output . '&nbsp;&nbsp;&gt;&gt;&nbsp;<a href="' . wp_nonce_url("users.php?page=users-".URE_PLUGIN_FILE."&object=user&amp;user_id={$user->ID}", "ure_user_{$user->ID}") . '">' . esc_html__('Edit', 'user-role-editor') . '</a>';
        ?>
        			</td>
        		</tr>
        </table>		
        <?php
    }
    // end of edit_user_profile()

    
    protected function allow_unfiltered_html() {
        
        $multisite = $this->lib->get('multisite');
        if ( !$multisite || !is_admin() ||  
             ((defined( 'DISALLOW_UNFILTERED_HTML' ) && DISALLOW_UNFILTERED_HTML)) ) {
            return;
        }
        
        $enable_unfiltered_html_ms = $this->lib->get_option('enable_unfiltered_html_ms', 0);
        if ($enable_unfiltered_html_ms) {
            add_filter('map_meta_cap', array($this, 'allow_unfiltered_html_filter'), 10, 2);
        }
        
    }
    // end of allow_unfiltered_html()
    
    
    public function allow_unfiltered_html_filter($caps, $cap='') {

        global $current_user;

        if ($cap=='unfiltered_html') {
            if (isset($current_user->allcaps['unfiltered_html']) && 
                $current_user->allcaps['unfiltered_html'] && $caps[0]=='do_not_allow') {
                $caps[0] = 'unfiltered_html';
                return $caps;
            }        
        }

        return $caps;

    }
    // end of allow_unfiltered_html_for_simple_admin()

    
    public function ure_ajax() {
                
        $ajax_processor = new URE_Pro_Ajax_Processor($this->lib);
        $ajax_processor->dispatch();
        
    }
    // end of ure_ajax()

    
    /**
     * Returns object with data about view access restrictions applied to the post with ID $post_id or
     * false in case there are not any view access restrictions for this post
     * 
     * @param int $post_id  Post ID
     * @return \stdClass|boolean
     */
    public function get_post_view_access_users($post_id) {
                    
        $activate_content_for_roles = $this->lib->get_option('activate_content_for_roles', false);
        if (!$activate_content_for_roles) {
            return false;
        }
        
        $result = URE_Content_View_Restrictions::get_post_view_access_users($post_id);
                        
        return $result;
    }
    // end of get_post_view_access_users($)
    
    
    // job to execute by WP Cron scheduler
    public function assign_role_to_users_without_role() {
        
        $assign_role = new URE_Assign_Role($this->lib);
        $assign_role->make();
    }
    // end of assign_role_to_users_without_role()

    
    public function show_notices_to_admin_only() {
        
        if (current_user_can('install_plugins')) {
            return;
        }
        echo '
<style>
    .update-nag, .notice { 
        display: none; 
    }
    #message.notice {
        display: block;
    }
</style>
';
    }
    // end of show_notices_to_admin_only()
    
}
// end of class User_Role_Editor_Pro