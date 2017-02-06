=== User Role Editor Pro ===
Contributors: Vladimir Garagulya (https://www.role-editor.com)
Tags: user, role, editor, security, access, permission, capability
Requires at least: 4.0
Tested up to: 4.7
Stable tag: 4.31
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

= [4.31.1] 17.12.2016 =
* Core version: 4.31
* Fix: Admin menu access add-on: Blocked menu was not hidden in some cases.
* Fix: Gravity form access add-on: invalid redirection took place for many 'admin.php?page=some-page' URLs.
* New: Admin menu access add-on: 'ure_admin_menu_access_admin_bar' filter allows to extend the list of top admin menu bar items which could be hidden if their main admin menu was blocked.

= [4.31] 15.12.2016 =
* Core version: 4.31
* New: It's possible to remove unused user capabilities by list.
* Fix: There was no support for installations with a hidden/changed URL to wp-admin. URE uses 'admin_url()' now to get and check admin URL, instead of direct comparing URL with 'wp-admin' string.
* Fix: Admin menu access add-on: custom links under Settings menu were converted from /wp-admin/options-general.php?page=some-key to /wp-admin/some-key incorrectly in some cases.
* Fix: Front-end menu access add-on: access controls were shown at menu editing form for user without 'ure_front_end_menu_access' capability.
* Update: Admin menu access add-on: Contact Form 7 plugin URL parameters are supported to exclude URL with unknown parameters blocking and automatic redirection to dashboard.
* Update: Capability groups CSS classes are prefixed with 'ure-' in order to minimize possible CSS conflicts with other plugins/themes which may load styles with the same classes and break URE's markup.

= [4.30] 01.12.2016 =
* Core version: 4.30
* New: "Granted Only" checkbox to the right from "Quick Filter" input control allows to show only granted capabilities for the selected role.
* New: Front-end menu access add-on is available. It's possible to show menu items for everyone, logged-in users, logged-in users with selected role(s), not-logged-in visitors.
* Update: Admin menu access add-on: Top level menu items list is ordered similar way as WordPress itself uses. 
* Fix: Content view restrictions add-on: Content of a post prohibited for logged-in user with the selected role only was not shown for the not logged-in users. But it should be shown until this post is not prohibited apparently for the 'no_role' (No role for this site) virtual role too.
* Fix: Admin menu access add-on: There was automatic redirect to admin dashboard after WooCommerce->Coupons->Add New (or similar) button click under "Block menu items: Not Selected" model, in case "Posts->Add New" was not allowed.


= [4.29.1] 11.11.2016 =
* Core version: 4.29
* New: User Role Editor own user capabilities are grouped separately under Custom capabilities.
* Fix: Content View Restrictions add-on: Custom error message from the post editor was not shown in some cases, system global default message was shown instead.
* Fix: Content Edit Restrictions add-on: restricted user saw at post Visual editor a gallery with full list of available images instead of the allowed images included into this gallery only. 
* Update: Content Edit Restrictions add-on: user with 'create_%' capability (like 'create_posts') can add new items (posts) inspite of editing restrictions applied to him. One of the purposes of this update was to allow to a user create the child pages under the allowed parent page.
* Update: Automatic updates server URL was changed to https://update.role-editor.com
* Update: URE_Lib::is_super_admin() uses WordPress core is_super_admin() for multisite setup only. Superadmin is a user with 'administrator' role in the case of single site WordPress installation.
  This is the difference with the WordPress core which counts as a superadmin (for single site WP installation) any user with a 'delete_users' capability.
  So it's possible to apply add-on restrictions (e.g. admin menu access) to the users without administrator role, but with 'delete_users' capability.
* Update: BaseLib::option_selected() calls were replaced with the calls of a similar selected() function from WordPress core.  


= [4.29] 25.10.2016 =
* Core version: 4.28
* New: Meta Boxes access add-on: 'Remove' icon at admin page of this add-on allows to exclude from the list meta boxes which belong to the deleted plugins.
* Fix: Posts edit access restrictions add-on: 
    - some times restrictions were applied before a restricted custom post type was defined.
    - post quant by the post status were calculated incorrectly for the "Prohibit" option.
* Fix: Admin menu access add-on: 
    - The endless redirection loop could took place if the "Dashboard" menu was blocked ( URE_Admin_Menu_Access::update_menu_selected() );
    - URL for redirection to one of Jetpack submenu items was built incorrectly.
* Update: Admin menu access add-on: 
    - URL parameters 'action', 'menu' were registered as allowed for the 'nav-menus.php' ('Appearance->Menus') command to exclude unexpected redirections.
    - URL parameters 'category_name', 'tag' were registered as allowed for the 'edit.php' ('Posts') command  to exclude unexpected redirections.
    - WooCommerce products, orders, coupons filtering arguments in URLs are supported now.
      If you prohibited for the role 'Posts' menu, but allowed WooCommerce 'Products', 'Orders' or 'Coupons' (use the same edit.php in URL), 
      you could meet a problem with filtering  WooCommerce product by category or product type, etc. User would be redirected to the dashboard - 
      This means that URLs with filtering parameters in it (like product_cat, product_type) was blocked by URE.       
    - Block not selected model: URE does not block by default these admin menu bar items: Profile, Log Out. Menu items was checked by URL. 
      Menu item ID is checked now instead, as URL may be changed by plugins, like one which changes 'wp-admin' to the custom string. 
      It's possible to modify the list of not blocked menu bar items ID using custom filter 'ure_do_not_remove_from_admin_bar'.
* Update: Posts view restrictions add-on: input form and list of default values were enhanced/extended.
* Update: Meta boxes access add-on takes into account the meta boxes placed by BuddyPress plugin to the user profile "Extended Profile" tab.
* Update: Temporally raised permissions flag is taken into account when checking, if user has a superadmin privileges. WordPress is_super_admin() function was replaced with custom wrapper to define if current user is a real superadmin or just a local admin with the temporally raised (add/edit users pages) permissions.
* New: WooCommerce plugin user capabilities (if exist) are grouped separately.
* Update: various code optimization.

= [4.28.2] 16.09.2016 =
* Core version: 4.27.2
* Fix : PHP notices was removed: Undefined index: "some-index" in .../pro/includes/classes/admin-menu-access.php on line 204
* Fix: PHP notice was removed: Undefined property: URE_Role_View::$multisite in wp-content/plugins/user-role-editor/includes/classes/view.php on line 143
* Fix: WordPress multisite: Settings link under the URE plugin at the plugins list leads to the network admin now, not to the the single site settings page, which does not exist.
* Fix: WordPress multisite: conflict with "Visual Composer" plugin was resolved: single site administrators could now use Visual Composer editor.
* Fix: WordPress multisite: changed role name was not replicated to other sites when user clicked "Update" with "Apply to All Sites" option turned ON.
* Fix: Admin menu access add-on: allowed command arguments  array was returned by reference incorrectly - URE_Admin_Menu_URL_Allowed_Args::get_for_supported_plugins() line 30.
* Update: There was a conflict with plugins which use a '|' character at the custom user capabilities: e.g. 'Nginx Helper | Config' from "Nginx Helper' plugin.
* Update: Admin menu access add-on:
    - Available submenu item is shown for role now even if top level menu is not available for that role. For example Settings menu item protected by 'edit_posts' capability will be shown as available for blocking for 'author' role in spite of this role does not have 'manage_options' capability.
    - URE takes into account that "WCMp Commissions" menu from "WC Marketplace" plugin may be added as to "WooCommerce" menu, as a top level menu item.  
    - Some plugins build menu structure incorrectly and its menu item protected by non-grunted capabilities may stay available to the user.
      URE duplicates menu item access checking after "admin_menu" action for the most of plugins was executed (at very low priority).
    - menu separators checking was moved to the separate static method;
    - support was added for additional URL parameters which WordPress uses with 'edit.php', e.g.: trashed, untrashed, deleted, ids.
    - support was added for additional URL parameters from plugins: Ninja Forms, EventON.    
* Update: Posts edit restrictions add-on: URE does no replace posts statuses views (All, Mine, Published etc.) for the restricted user. It just refreshes the quant of posts for every status view.
* Update: Content edit restrictions: Shortcode [user_role_editor] supports 'role' and 'except_role' attributes in addition to the 'roles' and 'except_roles'. So use that is more convenient for you.
* Update: Information about compatibility with WordPress version is shown correctly at "Dashboard->Updates" page.

= [4.28.1] 22.08.2016 =
* Core version: 4.27.1
* Update: There was a conflict with plugins which use a '/' character at the custom user capabilities: e.g. vc_access_rules_backend_editor/disabled_ce_editor from Visual Composer.
* Update: add/delete, escape, validate user capability code extracted from URE_Lib to the separate URE_Capability class

= [4.28] 19.08.2016 =
* Core version: 4.27
* New: Total/Granted counters were added to the capabilities groups titles.
* New: "Columns" drop-down menu allows to change capabilities section layout to 1, 2 or 3 columns.
* New: Capabilities section is limited in height and has independent scrollbar.
* Update: User Role Editor form uses more available space on page.
* Update: URE_Ajax_Processor class allows to differentiate required user permissions according to action submitted by user.
* Update: Custom post type ID is converted to lower case when build post capability ID
* Fix: CSS updated to exclude text overlapping at capabilities groups section when custom post type name is not fitted into 1 line.
* Fix: required JavaScript files were not loaded at "Network Admin->Settings->User Role Editor" page.
* Fix:  "Notice: Undefined index ... in wp-content/plugins/user-role-editor-pro/pro/includes/classes/meta-boxes.php on line 86" was produced when URE tried to block not active meta box.
* Fix: class URE_Admin_Menu_URL_Allowed_Args produced PHP fatal error: "Parse error: syntax error, unexpected T_PAAMAYIM_NEKUDOTAYIM" at line 29 for PHP versions older 5.3. Compatible version of a code is used instead now.

= [4.27.1] 26.07.2016 =
* Core version: 4.26.4
* Fix: PHP versions prior to 5.5. produces fatal error: Can't use function return value in write context in .../content-view-restrictions-posts-list.php on line 488

= [4.27] 26.07.2016 =
* Core version: 4.26.4
* New: User capabilities were grouped by purpose/functionality for more convenience.
* New: Content view restrictions shortcode allows to use 'except_roles' attribute - to show content inside shortcode to all users except users with roles included into 'except_roles' attribute.
* Update: URE_Ajax_Processor class allows to differentiate required user permissions according to action submitted by user.
* Update: Admin menu access module: 
    - Filter 'ure_admin_menu_access_allowed_args' was added. Use it to register URL parameters in order URE does not block the links inside allowed pages.It happens generally when you use 'block not selected' model.
    - Admin menu copy creation was optimized. It's executed now just after any plugin activation and when URE's page is opened.    
* Update: Widgets Show Access add-on: It's enough to have 'ure_widgets_show_access' capability now to get access to this add-on functionality.
* Fix: Admin menu access module: 
    - Menu links were calculated incorrectly for some plugins (generally with page=admin.php inside). It's recommended to re-check your admin menu restrictions settings after this update. 
    - Sorting (by category, etc.) inside allowed posts/pages list page may lead to the redirection to the admin dashboard.
    - Added support for "Download Monitor", "Unite Gallery", "WPML" plugins additional URL parameters.
* Fix: Content View Restrictions module: 
    - Conflict was resolved with WPML plugin. It adds 'p' parameter to the queries for a single post.Titles of restricted posts were viewable for that reason.
* Fix: Edit posts/pages restrictions add-on: It did not allowed to edit the attachments for 'Own data only' option or authors ID list.
* Fix: required JavaScript files were not loaded at "Network Admin->Settings->User Role Editor" page.

= [4.26.1] 06.07.2016 =
* Core version: 4.25.4
* Fix: Admin menu access module: Posts sorting was not allowed for "block not selected" model. User was redirected to the dashboard when try to sort posts by title or date.
* Fix: bbPress roles were missed from the list of roles available at User Role Editor.

= [4.26] 05.07.2016 =
* Core version: 4.25.4
* Update: URE_KEY_CAPABILITY (allows to user to make anything with URE) constant was changed from 'ure_edit_roles' to 'ure_manage_options'. It's possible now to give to non-admin users the access to the User Role Editor without giving them access to the 'administrator' role and users with 'administrator' role.
* Update: User receives full access to User Role Editor under WordPress multisite if he has 'manage_network_plugins' capability instead of 'manager_network_users' as earlier. This allows to give to a user ability to edit the network users without giving him access to the User Role Editor.
* Update: Use WordPress's global $current_site->blog_id to define main blog ID instead of selecting the 1st one from the sorted list of blogs.
* New: Widgets Show Access additional module allows to manage which roles may see what widgets.
* New: Admin menu access, Meta boxes access, Other roles access modules: functionality is available from the Network Admin Center for WordPress multisite. Data is updated for the main site. To replicate module data to other sites use 'Network Update' button.
* New: Content edit restrictions: 'ure_post_edit_access_authors_list' filter allows to modify authors list which posts should be allowed/prohibited for editing.
* Fix: User was redirected to the main site  instead of returning back to the Network Admin after update additional module data from the User Role Editor page opened under the Network Admin.
* Fix: Content edit restrictions: 
    - Subpages were restricted automatically up to 2nd level only. Full tree is processed now.
    - add orders by product owner function did not respect custom DB prefix, it used hard coded 'wp_' instead.
    - added bookings from "WC Booking" plugin by product owner, not only by booking author. Return false by 'ure_edit_posts_access_add_bookings_by_product_owner' filter to switch this behavior OFF.
    - forced "WC Booking" plugin do not suppress filters during booking products selection.
    - when 'ure_auto_access_child_pages' filter returned false, code returned void instead of unchanged posts list array.
* Fix: Admin menu access with 'block not selected' model did not allow to switch between pages views, like 'Trash' and 
  did not respect 'lang' parameter added to links by WPML plugin.
* Custom post types own capabilities: moved code execution to the later priorities 98, 99 (comparing to earlier 11, 12) in order to exclude conflicts with plugins which register their custom post type with a later priority then a default 10. 
* Various code enhancements and optimization.


= [4.25.1] 17.05.2016 =
* Core version: 4.25.3
* Fix: Content View Restrictions module: 
    - Compatibility provided with WordPress versions earlier 4.4, which do not send 'post' parameter to "get_{$adjacent}_post_where" filter.
* Fix: Admin menu access module:
    - If the 1st submenu item was blocked, menu item was renamed and lost its submenu with not blocked menu items.
* New: Content Edit Restrictions module: filter 'ure_restrict_edit_post_type' was added. It allows to exclude some post type (you don't wish to restrict) from this module action.

= [4.25] 05.05.2016 =
* Core version: 4.25.2
* New: Edit posts restrictions module: 
    - It's possible to set edit posts/pages/custom post types restrictions for roles.
    - Option 'Own data only' was added to allow to edit/see at admin just own posts/pages, custom post type items.
    - Support was added for "Woocommerce Bookings" plugin.
* Fix: Edit posts restrictions module: 
    - It was not possible to use revisions with 'Allow' model.
    - edit restrictions were not applied to a user without 'edit_posts' or 'edit_pages' capability.
    - WooCommerce orders are filtered now with taking in account product owner ID, if you restricted a user by authors(product owners) ID. 
      It's possible to switch off this extention via filter 'ure_edit_posts_access_add_orders_by_product_owner'. It should return false for that.
    - Quant by views was shown wrong for some custom post types, e.g. WooCommerce Orders.
    - Bulk update from posts list wrote to the user profile wrong data.
* Fix: Admin menu access module:
    - 'user-edit.php' link was blocked by error with 'block not selected' model, which did not allow to edit a selected user.        
    - access was allowed by error via direct URL to some menu items blocked with "block not selected" model.
    - Jetpack menu was not blocked. Admin menu copy creation is linked to the action with priority 999, to be executed after Jetpack, 
      which uses priority 998 for some reason.
    - 'UpdraftPlus' topbar admin menu was not removed when 'Settings->UpdraftPlus Backup' menu item was blocked.
* Fix: Content view restrictions module:
    - Prohibited posts titles/URLs were shown as 'Previous' or 'Next' links at the single post page.
* Update: Edit posts restrictions module: bulk update is available for all custom post types, not for the posts and pages only as it was earlier. 
* Update: Admin menu access module:
    - Enhanced technique of blocking links: order and quant of URL parameters does not matter.
    - Internal admin menu copy is refreshed automatically after any plugin activation for synchronization with possible menu changes.
    - When menu item is not allowed, it's replaced by the 1st allowed item from a child submenu or removed.
    - Multisite "My Sites" top bar admin menu does not show 'Dashboard' menu item for site if it's blocked for that site. 
      'New Post', 'Manage Comments' menu items are shown for user who can edit posts.
    - Some plugins/themes produces Menu/Submenu glitches ((Ultimate, Avada) for users with changed permissions. Such menu inconsistencies are fixed automatically.
* Update: Enhanced inner processing of available custom post types list.
* Update: Uses 15 seconds transient cache in order to not count users without role twice when 'restrict_manage_users' action fires.
* Update: URE fires action 'profile_update' after direct update of user permissions in order other plugins may catch such change.
* Update: All URE's PHP classes files were renamed and moved to the includes/classes subdirectory. Pro version part was moved under the "pro" directory.

= [4.24.6] 15.04.2016 =
* Core version: 4.25.1
* Fix: Selected role's capabilities list was returned back to old after click "Update" button. It was showed correctly according to the recent updates just after additional page refresh.
* Update: deprecated function get_current_user_info() call was replaced with wp_get_current_user().

= [4.24.5] 02.04.2016 =
* Core version: 4.25
* Important security update: Any registered user could get an administrator access. Thanks to [John Muncaster](http://johnmuncaster.com/) for discovering and wisely reporting it.
* URE pages title tag was replaced from h2 to h1, for compatibility with other WordPress pages.

Click [here](http://role-editor.com/changelog)</a> to look at [the full list of changes](http://role-editor.com/changelog) of User Role Editor plugin.
