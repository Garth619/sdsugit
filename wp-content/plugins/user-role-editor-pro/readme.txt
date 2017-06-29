=== User Role Editor Pro ===
Contributors: Vladimir Garagulya (https://www.role-editor.com)
Tags: user, role, editor, security, access, permission, capability
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 4.35.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

With User Role Editor WordPress plugin you may change WordPress user roles and capabilities easy.

== Description ==

With User Role Editor WordPress plugin you can change user role capabilities easy.
Just turn on check boxes of capabilities you wish to add to the selected role and click "Update" button to save your changes. That's done. 
Add new roles and customize its capabilities according to your needs, from scratch of as a copy of other existing role. 
Unnecessary self-made role can be deleted if there are no users whom such role is assigned.
Role assigned every new created user by default may be changed too.
Capabilities could be assigned on per user basis. Multiple roles could be assigned to user simultaneously.
You can add new capabilities and remove unnecessary capabilities which could be left from uninstalled plugins.
Multi-site support is provided.

== Installation ==

Installation procedure:

1. Deactivate plugin if you have the previous version installed.
2. Extract "user-role-editor-pro.zip" archive content to the "/wp-content/plugins/user-role-editor-pro" directory.
3. Activate "User Role Editor Pro" plugin via 'Plugins' menu in WordPress admin menu. 
4. Go to the "Settings"-"User Role Editor" and adjust plugin options according to your needs. For WordPress multisite URE options page is located under Network Admin Settings menu.
5. Go to the "Users"-"User Role Editor" menu item and change WordPress roles and capabilities according to your needs.

In case you have a free version of User Role Editor installed: 
Pro version includes its own copy of a free version (or the core of a User Role Editor). So you should deactivate free version and can remove it before installing of a Pro version. 
The only thing that you should remember is that both versions (free and Pro) use the same place to store their settings data. 
So if you delete free version via WordPress Plugins Delete link, plugin will delete automatically its settings data. 
You will have to configure User Role Editor Pro Settings again after that.
Right decision in this case is to delete free version folder (user-role-editor) via FTP, not via WordPress.


== Changelog ==

= [4.35.1] 11.06.2017 =
* Core version: 4.35
* Fix: Posts/pages edit access add-on: 
*   - Child pages ID list selection algorithm was fixed and optimized.
*   - 'Mine' view posts count shows valid quantity of current user posts.
* Fix: All add-ons: class 'ui-button-text' was added to all ui-dialog (update, cancel) buttons.
* Core was updated to version 4.35
* Update: Bulk capabilities selection checkbox is not shown for 'administrator' role for single site WP, and is shown if current user is superadmin for multisite WP. It was done to exclude sudden revoke of all capabilities from the 'administrator' role.
* Update: Full copy of JQuery UI 1.11.4 custom theme CSS file (jquery-ui.css) was included.
* Fix: User->User Role Editor page apparently loads own jQuery UI CSS (instead of use of WordPress default one) in order to exclude the conflicts with themes and plugins which can load own jQuery UI CSS globally not for own pages only.
* Fix: "Change Log" link was replaced with secure https://www.role-editor.com/changelog


= [4.35] 04.06.2017 =
* Core version: 4.34
* New: Widgets admin access add-on: It's possible to block access to sidebars.
* Fix: Admin menu access add-on: "block not selected" model redirected user to the 1st available URL from allowed URLs with different letter case parameters, like admin.php?page=PopupBuilder
* Update: Core version was updated to 4.34:
* New: Multisite 'upgrade_network' capability support was added for compatibility with WordPress 4.8.
* New: Multisite 'delete_sites' capability support was added.
* Fix: jQuery UI CSS was updated to fix minor view inconsistency at the URE's Settings page.
* Fix: "Reset" presentation code remainders were removed from the main User Role Editor page.
* Fix: 'manage_links' capability was included into a wrong subgroup instead of "Core->General". It was a mistake in the capabilities group counters for that reason.

= [4.34.3] 23.05.2017 =
* Core version: 4.33.1
* Fix: Content view restrictions add-on: PHP notice was removed: Undefined variable: self in /wp-content/plugins/user-role-editor-pro/pro/includes/classes/content-view-restrictions.php on line 795


= [4.34.2] 22.05.2017 =
* Core version: 4.33.1
* New: Posts/pages edit restrictions add-on: custom filter 'ure_edit_posts_access_restriction_type' was added. It allows to modify on a fly the restriction type for current user: 1 - prohibit, 2 - allow.
* Update: "Use jQuery UI CSS from jQuery CDN" option was removed from the "General" tab of User Role Editor Pro Settings page. URE uses CSS styles included into own installation package.
* Fix: Content view restrictions add-on: 
* - URE_Content_View_Restrictions::current_user_can_view() returned incorrect result for some restrictions settings.
* - URE_Content_View_Restrictions_Posts_List::do_not_restrict_editors() could intercept with Posts/pages edit restrictions add-on by recursive call of view filter when WP_Query selects posts available for editing.
* - ure_restrict_content_view_for_authors_and_editors filter was ignored for single page content.
* Update: Core version was updated to 4.33.1:
* Update: Core version: "Reset" button moved from the "Users->User Role Editor" main page to the "Settings->User Role Editor->Tools" tab.
* Update: Core version: "Users->Grant Roles" button worked only for superadmin or user with 'ure_manage_options' capability. User with 'edit_users' can use this feature now. 
* Update: Core version: Settings tabs and dialog windows style sheets was updated to jQuery UI 1.11.4 default theme.
* New: Core version: boolean filter 'ure_bulk_grant_roles' allows to not show "Users->Grant Roles" button if you don't need it.
* New: Core version: boolean filter 'ure_users_select_primary_role' can hide 'Primary role' selection controls from the user profile edit page. 
* New:  Core version: boolean filter 'ure_users_show_wp_change_role' can hide "Change Role" bulk action selection control from the Users page. So it's possible to configure permissions for user who can change just other roles of a user without changing his primary role.
* Fix: "Users->Without Roles", "Users->Grant Roles" are shown only to the users with 'edit_users' capability.
* Fix: Transients caching was removed from URE_Lib::_get_post_types() function. It cached post types list too early in some cases.


= [4.34.1] 24.04.2017 =
* Core version: 4.32.3
* Fix: Front end menu access add-on: a lot of pages became restricted for front-end menu due to logic mistake in an access checking code. As a result related menu items were hidden from menu without a visible reason.

= [4.34] 21.04.2017 =
* Core version: 4.32.3
* New: Front end menu access add-on: 
*   - "Not logged-in and logged-in users with selected roles" option was added.
*   - menu items with links to the posts/pages prohibited for view for current user by "Content view restrictions" add-on with 404 HTTP error action are excluded from menu automatically.
* New: Content view restrictions add-on: 
*   - Shortcode [user_role_editor] roles / except_roles attributes support '&&' role ID separator. For example roles="subscriber && customer" means that user should have both roles simultaneously, comparing to the roles="subscriber, customer" which works for subscribers or customers or (subscribers and customers).
*   - public static method URE_Content_View_Restrictions::current_user_can_view($post_id) was added. It returns boolean value.
* Update: Content view restrictions add-on:
*   - roles list opened at the post level is sorted by alphabet.
*   - Singleton pattern was applied to the URE_Content_View_Restrictions_Posts_List class.
* Update: Admin menu access add-on: "block not selected model": support was added for URL parameters added to users.php by "Ultimate Member" plugin.
* Fix: Content view restrictions add-on: 
*   - default setting for access error action "return HTTP 404 error" was not always applied to the new added post. 
*   - categories/tags/terms group selection checkboxes work separately now for every term group - categories, tags, etc.
* Fix: bbPress role support was broken, even administrator did not see bbPress menu and user roles in some cases while User Role Editor Pro was active.
* Fix: Admin menu access add-on: "block not selected model" did not allow to delete users and use other core WordPress functionality at "users.php' page redirecting user to the 1st available admin menu item.
 

= [4.33] 03.04.2017 =
* Core version: 4.32.3
* New: Content view restrictions add-on: authors list and own data only options were added for roles.
* Fix: Content view restrictions add-on: 
*   - filter by categories may work incorrectly due to mistake in the SQL query;
*   - content-view-restrictions-controller.php used not existed function URE_Lib_Pro::filter_int_array().
* Update: Admin menu access add-on: parameters added by 'Enable media replace' plugin were registered as allowed for upload.php link. Earlier 'Replace' link was blocked with a redirection to the 1st available menu item.
* Fix: Admin menu access add-on: "Block not selected" model: 
*   - search a user at "Users" page was finished by the automatic redirection to the 1st available menu item (Dashboard, etc.). The list of allowed parameters for 'Users' page was extended for the search and sort parameters used at this page by WordPress core.
*   - selection of 'Media Library->Add new' menu item was resulted by removing of 'Upload Files' tab at a dialog opened by "Add Media" button from the post/page editor screen.
* Fix: Bulk grant to users multiple roles JavaScript code is loaded now for users.php page only, not globally.
* Fix: nonexistent html_esc__() function was called instead of valid esc_html__() one at pro/includes/classes/posts-edit-access-bulk-action.php file.
* Fix: "Users->Grant Roles" button did not work with switched off option "Count Users without role" at "Settings->User Role Editor->Additional Modules" tab. "JQuery UI" library was not loaded.
* Fix: Boolean false was sent to WordPress core wp_enqueue_script() function as the 2nd parameter instead of an empty string. We should respect the type of parameter which code author supposed to use initially.
* Update: minimal PHP version was raised to 5.3.

= [4.32.3] 10.03.2017 =
* Core version: 4.32.1
* New: Button "Grant Roles" allows to "Assign multiple roles to the selected users" directly from the "Users" page.
* Update: singleton template was applied to the main class User Role Editor Pro. While GLOBALS['user-role-editor'] reference to the instance of User_Role_Editor_Pro class is still available for the compatibility reasons, call to User_Role_Editor_Pro::get_instance() is the best way now to get a reference to the instance of User_Role_Editor_Pro class.
* Fix: Content view restrictions add-on: PHP notice "Undefined index: ure_post_access_error_action in content-view-restrictions-controller.php" was removed.
* Fix: 'unfiltered_html' capability was added to the 'General' capabilities group.

= [4.32.2] 10.02.2017 =
* Core version: 4.31.1
* Fix: Content view restrictions add-on: restrictions were applied too early, some theme or plugin could replace 'access error' message from URE with original protected content. 
* Fix: Posts edit restrictions add-on: User with restrictions saws a full list of Media Library items in case he did not have own attachments in the list of allowed posts, minor code enhancements.
* Fix: It's possible to translate license key states: "Active, Expired, Invalid".
* Fix: Admin menu access add-on: Code responsible for a legacy data format conversion was excluded.

= [4.32.1] 07.01.2017 =
* Core version: 4.31.1
* Fix: Plugins access add-on: User with 'activate_plugins' capability but empty allowed plugins list did not see any plugins. When a restriction is not set, user should see a full plugins list.
* Update: Front-end menu access add-on: It works now according to the given permissions, if current user is a site admin too.
* Update: Posts edit access add-on: It's possible to modify posts/pages, custom post type ID list via filter 'ure_edit_posts_access_id_list'. ID list is a comma separated list of integers.

= [4.32] 06.01.2017 =
* Core version: 4.31.1
* New: Plugins access add-on: 
- It's possible to restrict access to the list of plugins available for activation/deactivation for the role.
- It's possible to change selection model: allow access to the selected or not selected plugins.
* Fix: bbPress roles changes were not saved.
* Fix: Admin menu access add-on: List of allowed URL parameters checked under "blocked not selected" model was extended for parameters used by "Gravity Forms" plugin.
* Fix: WP transients get/set were removed from URE_Own_Capabilities class. It leaded to the MySQL deadlock in some cases.
* Update: Base_Lib::get_request_var() sanitizes user input by PHP's filter_var() in addition to WordPress core's esc_attr().

Click [here](http://role-editor.com/changelog)</a> to look at [the full list of changes](http://role-editor.com/changelog) of User Role Editor plugin.
