<?php
/*
 * Class: Access restrict to posts/pages on per site - per user - per post/page basis 
 * Project: User Role Editor Pro WordPress plugin
 * Author: Vladimir Garagulya
 * email: support@role-editor.com
 * 
 */

class URE_Posts_Edit_Access {
    
    private $lib = null;
    private $user = null;   // URE_Posts_Edit_Access_User class instance        

    
    public function __construct() {
    
        $this->lib = Ure_Lib_Pro::get_instance();        
        new URE_Posts_Edit_Access_Role();
        new URE_Posts_Edit_Access_Bulk_Action();
        $this->user = new URE_Posts_Edit_Access_User($this);                
        
        add_action('admin_init', array($this, 'set_final_hooks'));
        add_filter('map_meta_cap', array($this, 'block_edit_post'), 10, 4);
                
    }
    // end of __construct()                
            
    
    public function set_final_hooks() {
                
        $wc_bookings_active = URE_Plugin_Presence::is_active('woocommerce-bookings');   // Woocommerce Bookings plugin 
        if ($wc_bookings_active) {
            URE_WC_Bookings::separate_user_transients();            
        }
        
        if (!$this->user->is_restriction_applicable()) {
            return;
        }
        
        // apply restrictions to the post query
        add_action('pre_get_posts', array($this, 'restrict_posts_list' ), 55);

        // apply restrictions to the pages list from stuff respecting get_pages filter
        add_filter('get_pages', array($this, 'restrict_pages_list'));

        // Refresh counters at the Views by post statuses
        add_filter('wp_count_posts', array($this, 'recount_wp_posts'), 10, 3);

        // restrict categories available for selection at the post editor
        add_filter('list_terms_exclusions', array($this, 'exclude_terms'));        
        // Auto assign to a new create post the 1st from allowed terms
        add_filter('wp_insert_post', array($this, 'auto_assign_term'), 10, 3);
        
        if ($wc_bookings_active) {  
            new URE_WC_Bookings($this->user);
        }
        
    }
    // end of set_final_hooks()
    
        
    public function recount_wp_posts($counts, $type, $perm) {
        global $wpdb;

        if (!post_type_exists($type)) {
            return new stdClass;
        }        
        if (!$this->should_apply_restrictions_to_wp_page()) {
            return $counts;
        }                                
        // do not limit user with Administrator role or the user for whome posts/pages edit restrictions were not set
        if (!$this->user->is_restriction_applicable()) {
            return $counts;
        }    
        
        $restrict_it = apply_filters('ure_restrict_edit_post_type', $type);
        if (empty($restrict_it)) {
            return $counts;
        }

        $cache_key = 'ure_'._count_posts_cache_key($type, $perm);
        $counts = wp_cache_get($cache_key, 'counts');
        if (false !== $counts) {
            return $counts;
        }

        $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";
        if ('readable' == $perm && is_user_logged_in()) {
            $post_type_object = get_post_type_object($type);
            if (!current_user_can($post_type_object->cap->read_private_posts)) {
                $query .= $wpdb->prepare(" AND (post_status != 'private' OR ( post_author = %d AND post_status = 'private' ))", get_current_user_id());
            }
        }
        $restriction_type = $this->user->get_restriction_type();
        $posts_list = $this->user->get_posts_list();
        if ($restriction_type==1) {   // Allow
            if (count($posts_list)==0) {
                $query = false;
            } else {
                $posts_list_str = implode(',', $posts_list);            
                $query .= "AND ID IN ($posts_list_str)";
            }
        } elseif ($restriction_type==2) {    // Prohibit
            if (count($posts_list)>0) {
                $posts_list_str = implode(',', $posts_list);            
                $query .= "AND ID NOT IN ($posts_list_str)";
            }
        }                
        if (!empty($query)) {
            $query .= ' GROUP BY post_status';
            $results = (array) $wpdb->get_results($wpdb->prepare($query, $type), ARRAY_A);
        } else {
            $results = array();
        }
        $counts = array_fill_keys(get_post_stati(), 0);
        foreach ($results as $row) {
            $counts[$row['post_status']] = $row['num_posts'];
        }
        $counts = (object) $counts;
        wp_cache_set($cache_key, $counts, 'counts');

        return $counts;
    }
    // end of recount_wp_posts()
            
    
    public function block_edit_post($caps, $cap='', $user_id=0, $args=array()) {
        
        global $current_user;
        
        if (empty($current_user->ID)) {
            return $caps;
        }
        
        if (count($args)>0) {
            $post_id = $args[0];
        } else {
            $post_id = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT);
        }
        if (empty($post_id)) {
            return $caps;
        }
        
        remove_filter('map_meta_cap', array($this, 'block_edit_post'), 10); //  exclude possible recursion
        $is_super_admin = $this->lib->is_super_admin();
        add_filter('map_meta_cap', array($this, 'block_edit_post'), 10, 4);
        if ($is_super_admin) {
            return $caps;
        }
         
        $post = get_post($post_id);
        if (empty($post)) {
            return $caps;
        }
        if (!post_type_exists($post->post_type)) {
            return $caps;
        }
        
        $custom_caps = $this->lib->get_edit_custom_post_type_caps();
        if (!in_array($cap, $custom_caps)) {
            return $caps;
        }
        
        if (!empty($_POST['original_post_status']) && $_POST['original_post_status']=='auto-draft' &&
            !empty($_POST['auto_draft']) && $_POST['auto_draft']==1) {  
            // allow to save new post/page
            // that's admin responsibility if user with 'create_posts' 
            // then will not can edit a new created post due to existing editing restrictions
            return $caps;
        }
        
        $posts_list = $this->user->get_posts_list();                                   
        if (count($posts_list)==0) {        
            return $caps;
        }                                
                        
        remove_filter('map_meta_cap', array($this, 'block_edit_post'), 10, 4);  // do not allow endless recursion
        $restrict_it = apply_filters('ure_restrict_edit_post_type', $post->post_type);
        add_filter('map_meta_cap', array($this, 'block_edit_post'), 10, 4);     // restore filter
        if (empty($restrict_it)) {            
            return $caps;
        }        
        
        if ($post->post_type=='revision') { // Check access to the related post, not to the revision
            $post_id = $post->post_parent;
        }
                        
        $do_not_allow = in_array($post_id, $posts_list);    // not edit these
        $restriction_type = $this->user->get_restriction_type();
        if ($restriction_type==1) {
            $do_not_allow = !$do_not_allow;   // not edit others
        }
        if ($do_not_allow) {
            $caps[] = 'do_not_allow';
        }                    
        
        return $caps;
    }
    // end of block_edit_post()
                               
    
    private function update_post_query($query) {
        
        $restriction_type = $this->user->get_restriction_type();
        $posts_list = $this->user->get_posts_list();
        if ($restriction_type==1) {   // Allow
            if (count($posts_list)==0) {
                $query->set('p', -1);   // return empty list
            } else {
                $query->set('post__in', $posts_list);
            }
        } elseif ($restriction_type==2) {    // Prohibit
            if (count($posts_list)>0) {
                $query->set('post__not_in', $posts_list);
            }
        }
    }
    // end of update_post_query()
    
             
    private function should_apply_restrictions_to_wp_page() {
    
        global $pagenow;
        
        if (!($pagenow == 'edit.php' || $pagenow == 'upload.php' || 
            ($pagenow=='admin-ajax.php' && !empty($_POST['action']) && $_POST['action']=='query-attachments'))) {
            if (!function_exists('cms_tpv_get_options')) {   // if  "CMS Tree Page View" plugin is not active
                return false;
            } elseif ($pagenow!=='index.php') { //  add Dashboard page for "CMS Tree Page View" plugin widget
                return false;
            }            
        }
        
        return true;
        
    }
    // end of should_apply_restrictions_to_wp_page()
    
    /**
     * Exclude from $query->query['post__in'] ID, which is not included into $list
     * @param WP_Query $query
     * @param array $list
     */
    private function leave_just_allowed($query, $list) {        
        $list1 = array();
        foreach ($query->query['post__in'] as $id) {
            if (in_array($id, $list)) {
                $list1[] = $id;
            }
        }
        if (empty($list1)) {
            $list1[] = -1;
        }
        $query->set('post__in', $list1);
    }
    // end of leave_just_allowed()
    
    
    public function restrict_posts_list($query) {                

        if (!$this->should_apply_restrictions_to_wp_page()) {
            return;
        }                        
        
        // do not limit user with Administrator role or the user for whome posts/pages edit restrictions were not set
        if (!$this->user->is_restriction_applicable()) {
            return;
        }

        $suppressing_filters = $query->get('suppress_filters'); // Filter suppression on?

        if ($suppressing_filters) {
            return;
        }                   
        
        if (!empty($query->query['post_type'])) {
            $restrict_it = apply_filters('ure_restrict_edit_post_type', $query->query['post_type']);
            if (empty($restrict_it)) {
                return;
            }         
        }
        
        if ($query->query['post_type']=='attachment') {             
            $show_full_list = apply_filters('ure_attachments_show_full_list', false);
            if ($show_full_list) { // show full list of attachments
                return;
            }            
            $restriction_type = $this->user->get_restriction_type();
            $attachments_list = $this->user->get_attachments_list();
            if ($restriction_type==1) {   // Allow
                if (count($attachments_list)==0) {
                    $attachments_list[] = -1;
                    $query->set('post__in', $attachments_list);
                } elseif (empty($query->query['post__in'])) {
                    $query->set('post__in', $attachments_list);
                } else {
                    $this->leave_just_allowed($query, $attachments_list);
                }
            } else {    // Prohibit
                $query->set('post__not_in', $attachments_list);
            }            
        } else {
            $this->update_post_query($query);
        }
                       
    }
    // end of restrict_posts_list()

            
    public function restrict_pages_list($pages) {
                
        if (!$this->should_apply_restrictions_to_wp_page()) {
            return $pages;
        }                        
        
        // do not limit user with Administrator role
        if (!$this->user->is_restriction_applicable()) {
            return $pages;
        }
        
        $restrict_it = apply_filters('ure_restrict_edit_post_type', 'page');
        if (empty($restrict_it)) {
            return;
        }
        
        $posts_list = $this->user->get_posts_list();
        if (count($posts_list)==0) {
            return $pages;
        } 
        
        $restriction_type = $this->user->get_restriction_type();
        
        $pages1 = array();
        foreach($pages as $page) {
            if ($restriction_type==1) { // Allow: not edit others
                if (in_array($page->ID, $posts_list)) {    // not edit others
                    $pages1[] = $page;
                    
                }
            } else {    // Prohibit: Not edit these
                if (!in_array($page->ID, $posts_list)) {    // not edit these
                    $pages1[] = $page;                    
                }                
            }
        }
        
        return $pages1;
    }
    // end of restrict pages_list()
        

    public function exclude_terms($exclusions) {
        
        global $pagenow;
        
        if (!in_array($pagenow, array('edit.php', 'post.php', 'post-new.php'))) {
            return $exclusions;
        }
        
        $terms_list_str = $this->user->get_post_categories_list();
        if (empty($terms_list_str)) {
            return $exclusions;
        }
        
        $restriction_type = $this->user->get_restriction_type();
        if ($restriction_type == 1) {   // allow
            // exclude all except included to the list
            remove_filter('list_terms_exclusions', array($this, 'exclude_terms'));  // delete our filter in order to avoid recursion when we call get_all_category_ids() function
            
            $taxonomies = array_keys(get_taxonomies(array(), 'names')); // get array of registered taxonomies names
            $all_terms = get_terms($taxonomies, array('fields'=>'ids', 'hide_empty'=>0)); // take full categories list from WordPress
            add_filter('list_terms_exclusions', array($this, 'exclude_terms'));  // restore our filter back            
            $terms_list = explode(',', str_replace(' ','',$terms_list_str));
            $terms_to_exclude = array_diff($all_terms, $terms_list); // delete terms ID, to which we allow access, from the full terms list
            $terms_to_exclude_str = implode(',', $terms_to_exclude); 
        } else {    // prohibit
            $terms_to_exclude_str = $terms_list_str;
        }

        $exclusions .= " AND (t.term_id not IN ($terms_to_exclude_str))";   // build WHERE expression for SQL-select command
        
        return $exclusions;
    }
    // end of exclude_terms()
    
    
    /**
     * Assign to a new created post the 1st available taxonomy from allowed taxonomies list
     * 
     * @global string $pagenow
     * @global WPDB $wpdb
     * @param int $post_id
     * @param WP_POST $post
     * @param bool $update
     * @return void
     */
    public function auto_assign_term($post_id, $post, $update) {
        global $pagenow, $wpdb;
        
        if ($pagenow !=='post-new.php') {   // for new added post only
            return;
        }
        
        $terms_list_str = $this->user->get_post_categories_list();
        if (empty($terms_list_str)) {
            return;
        }
        
        $restriction_type = $this->user->get_restriction_type();
        if ($restriction_type!=1) {   // allow
            return;
        }
        $terms_list = explode(',', str_replace(' ','',$terms_list_str));
        
        $registered_taxonomies = get_object_taxonomies($post->post_type, 'names');
        if (empty($registered_taxonomies)) {
            return;
        }
        
        foreach($terms_list as $term_id) {        
            $query = $wpdb->prepare('select taxonomy from '. $wpdb->term_taxonomy .' where term_id=%d', $term_id);
            $taxonomy = $wpdb->get_var($query);
            if (empty($taxonomy)) {
                continue;
            }
            if (in_array($taxonomy, $registered_taxonomies)) {
                // use as a default the 1st taxonomy from the allowed list, available for this post type
                wp_set_post_terms( $post_id, $term_id, $taxonomy);
                break;
            }
        }
        
    }
    // end of auto_assign_term()
    
}
// end of URE_Posts_Edit_Access