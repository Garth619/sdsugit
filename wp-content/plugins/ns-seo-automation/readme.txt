=== NS Automation for WordPress SEO ===
Contributors: neversettle
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RM625PKSQGCCY&rm=2
Requires at least: 3.0.1
Tested up to: 4.0.1

== Description ==

Soup up WordPress SEO by Yoast with custom field integration. NS Automation will enable you to easily include unlimited custom fields in the Yoast keyword analysis + build smart meta descriptions from custom field content.This add-on brings a powerful Search and Replace mode to the Cloner. It can be used during cloning to find and update unlimited text pairs on the new site. But it doesn't stop there - it can also search and replace on unlimited values inside existing sites and even your entire WordPress Multisite Network. It works at the database level and is serial-array safe for settings and other data that is store that way in WordPress.

Ever wanted to have your custom fields evaluated as part of the post’s content in the Yoast WordPress SEO plugin’s keyword statistics? Or automatically generate meta descriptions from a custom field instead of the main content area? With NS Automation for WordPress SEO, now you can!

For architecturally-advanced sites that use ACF (Advanced Custom Fields) or another post meta framework to store different parts of a post/page/custom post type’s content, WordPress SEO’s usually-helpful keyword statistics and meta description generation can become skewed since it doesn’t take all that custom field content into account.

That is a problem of the past with this premium plugin, though, which enables you to effortlessly:

* Include an unlimited number of custom fields (included Advanced Custom Fields – text, wysiwyg, repeater AND flexible content!) in the WordPress SEO content analysis statistics & scoring.
* Define separately which fields will be included in the scoring for each content type – pages, posts, and of course custom post types!
* Specify a custom field (also configurable separately per post type) to generate the SEO meta description from in place of the main content editor. The plugin will perform a smart-analysis on the field if it’s too long and shorten it while avoiding awkward partial sentences.
* Create multiple meta description fallbacks (which support WordPress SEO variables like %%title%% for increased flexibility!) which will be used in case the specified custom field for a particular post is empty, thus ensuring that even if the field you were extracting meta descriptions from gets left empty somehow on a post here and there, they will still have solid, unique meta descriptions.

If you build or manage a site or sites that use custom fields for content and Yoast’s WordPress SEO for great SEO results, NS Automation is a risk-free investment that will help you kick that process to the next level.

== Installation ==

= How to install =

1. Make sure you have already installed <a href="http://wordpress.org/plugins/wordpress-seo">WordPress SEO by Yoast</a>.
2. Log in to your WordPress site and use the Dashboard > Plugins > Add New tools to install the add-on by uploading its zip file that you downloaded from NeverSettle.it
3. Activate the add-on in the Plugins area
4. Go to SEO > NS Automation in your admin menu
5. Enter the names of as many custom fields as you'd like to be counted as content for SEO purposes. Done!

== Frequently Asked Questions ==

= How do I add ACF (Advanced Custom Fields) repeater, flex content, and gallery fields? Do I have to enter each sub field in the NS Automation settings? =
All you have to do is add the parent field name for the repeater, flex or gallery. NS Automation will automatically pick up content from all sub fields inside it! It even works for nested repeaters and flex fields.

== Changelog ==

= 2.0.2.7 = 
* Sidebar update

= 2.0.2.6 = 
* Meta description bugfixes

= 2.0.2.4 =
* Fixed image detection conflict that was causing fatal error for some types of fields

= 2.0.2.4 = 
* Fixed bug for image detection in fields
* Enabled ACF Flex and Repeater fields to be used for generating meta descriptions
* Fixed incorrect meta description keyword count bug

= 2.0.2.2 = 
* Fixed bugs for js keyword detection and meta descriptions with quotes in them

= 2.0.2 = 
* Added bugfix / enhancement for more accurate keyword counting in the Yoast "General" preview panel

= 2.0.0 =
* Custom field based meta descriptions now previewed correctly for admins, not just set on the front end
* Enabled inclusion of fields from an Advanced Custom Fields options page
* Added compatibility for Advanced Custom Fields V5
* Updated for compatibility with latest version of WP SEO by Yoast
* Multiple bugfixes and improvements

= 1.0.0 =
* First public release

== Upgrade Notice ==

= 2.0.0 =
* Custom field based meta descriptions now previewed correctly for admins, not just set on the front end
* Enabled inclusion of fields from an Advanced Custom Fields options page
* Added compatibility for Advanced Custom Fields V5
* Updated for compatibility with latest version of WP SEO by Yoast
* Multiple bugfixes and improvements

= 1.0.0 =
* First public release
