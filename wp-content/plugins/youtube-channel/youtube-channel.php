<?php
/*
Plugin Name: YouTube Channel
Plugin URI: http://urosevic.net/wordpress/plugins/youtube-channel/
Description: Quick and easy embed latest or random videos from YouTube channel (user uploads, liked or favourited videos) or playlist. Use <a href="widgets.php">widget</a> for sidebar or shortcode for content. Works with <em>YouTube Data API v3</em>.
Version: 3.0.8.5
Author: Aleksandar Urošević
Author URI: http://urosevic.net/
Text Domain: youtube-channel
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists('WPAU_YOUTUBE_CHANNEL') )
{
	class WPAU_YOUTUBE_CHANNEL
	{

		const DB_VER = 14;
		const VER = '3.0.8.5';

		public $plugin_name   = "YouTube Channel";
		public $plugin_slug   = "youtube-channel";
		public $plugin_option = "youtube_channel_defaults";
		public $plugin_url;

		/**
		 * Construct class
		 */
		function __construct() {

			$this->plugin_url = plugin_dir_url(__FILE__);
			load_plugin_textdomain( $this->plugin_slug, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

			// Generate debug JSON
			if ( ! empty($_GET['ytc_debug_json_for']) ) {
				$this->generate_debug_json();
			}

			// Clear all YTC cache
			add_action( 'wp_ajax_ytc_clear_all_cache', array(&$this, 'clear_all_cache') );

			// Activation hook and maybe update trigger
			register_activation_hook( __FILE__, array($this, 'activate') );
			add_action( 'plugins_loaded', array($this, 'maybe_update') );

			$this->defaults = self::defaults();

			// TinyMCE AddOn
			if ( ! empty($this->defaults['tinymce']) ) {
				add_filter( 'mce_external_plugins', array($this, 'mce_external_plugins'), 998 );
				add_filter( 'mce_buttons', array($this, "mce_buttons"), 999 );
			}

			if ( is_admin() ) {

				// Initialize Plugin Settings Magic
				add_action( 'init', array($this, 'admin_init') );

				// Add various Dashboard notices (if needed)
				add_action( 'admin_notices', array($this, 'admin_notices') );

				// Enqueue scripts and styles for Widgets page
				add_action( 'admin_enqueue_scripts', array($this, 'widget_scripts') );

			} else { // ELSE if ( is_admin() )

				// Enqueue frontend scripts
				add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
				add_action( 'wp_footer', array($this, 'footer_scripts') );

			} // END if ( is_admin() )

			// Load widget
			require_once('inc/widget.php');

			// Register shortcodes `youtube_channel` and `ytc`
			add_shortcode( 'youtube_channel', array($this, 'shortcode') );
			add_shortcode( 'ytc', array($this, 'shortcode') );

		} // END function __construct()

		/**
		 * Activate the plugin
		 * Credits: http://solislab.com/blog/plugin-activation-checklist/#update-routines
		 */
		public static function activate() {

			global $WPAU_YOUTUBE_CHANNEL;
			$WPAU_YOUTUBE_CHANNEL->init_options();
			$WPAU_YOUTUBE_CHANNEL->maybe_update();

		} // end function activate

		/**
		 * Return initial options
		 * @return array Global defaults for current plugin version
		 */
		public function init_options() {

			$init = array(
				'vanity'         => '', // $this->vanity_id,
				'channel'        => '', // $this->channel_id,
				'username'       => '', // $this->username_id,
				'playlist'       => '', // $this->playlist_id,
				'resource'       => 0, // ex use_res
				'cache'          => 300, // 5 minutes // ex cache_time
				'fetch'          => 25, // ex maxrnd
				'num'            => 1, // ex vidqty
				'privacy'        => 0,

				'ratio'          => 3, // 3 - 16:9, 1 - 4:3 (deprecated: 2 - 16:10)
				'width'          => 306,
				'responsive'     => 1,
				'display'        => 'thumbnail', // thumbnail, iframe, iframe2, playlist (deprecated: chromeless, object)
				'themelight'     => 0,
				'fullscreen'     => 0,
				'controls'       => 0,
				'autoplay'       => 0,
				'autoplay_mute'  => 0,
				'norel'          => 0,
				'playsinline'    => 0, // play video on mobile devices inline instead in native device player
				'showtitle'      => 'none',
				'showdesc'       => 0,
				'desclen'        => 0,
				'modestbranding' => 0,
				'hideanno'       => 0,
				'hideinfo'       => 0,

				'goto_txt'       => 'Visit our channel',
				'popup_goto'     => 0, // 0 same window, 1 new window JS, 2 new window target
				'link_to'        => 'none', // 0 legacy username, 1 channel, 2 vanity
				'tinymce'        => 1 // show TInyMCE button by default
			);

			add_option('youtube_channel_version', self::VER, '', 'no');
			add_option('youtube_channel_db_ver', self::DB_VER, '', 'no');
			add_option($this->plugin_option, $init, '', 'no');

			return $init;

		} // END public function init_options()

		/**
		 * Check do we need to migrate options
		 */
		public function maybe_update() {

			// bail if this plugin data doesn't need updating
			if ( get_option( 'youtube_channel_db_ver' ) >= self::DB_VER ) {
				return;
			}

			require_once( dirname(__FILE__) . '/update.php' );
			au_youtube_channel_update();

		} // END public function maybe_update()

		/**
		 * Initialize Settings link for Plugins page and create Settings page
		 */
		function admin_init() {

			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_settings_link') );
			// add row to plugin page
			add_filter( 'plugin_row_meta', array($this, 'add_plugin_meta_links'), 10, 2 );

			require_once( 'inc/settings.php' );

			global $WPAU_YOUTUBE_CHANNEL_SETTINGS;
			if ( empty($WPAU_YOUTUBE_CHANNEL_SETTINGS) )
				$WPAU_YOUTUBE_CHANNEL_SETTINGS = new WPAU_YOUTUBE_CHANNEL_SETTINGS();

		} // END function admin_init_settings()

		/**
		 * Append Settings link for Plugins page
		 * @param array $links array of links on plugins page
		 */
		function add_settings_link($links) {

			$settings_title = __('Settings');
			$settings_link = "<a href=\"options-general.php?page={$this->plugin_slug}\">{$settings_title}</a>";
			array_unshift( $links, $settings_link );

			// Free some memory
			unset($settings_title, $settings_link);

			// Return updated array of links
			return $links;

		} // END function add_settings_link()

		/**
		 * Add link to official plugin page
		 */
		function add_plugin_meta_links($links, $file) {

			if ($file === 'youtube-channel/youtube-channel.php') {
				return array_merge(
					$links,
					array( sprintf(
						'<a href="https://wordpress.org/support/plugin/youtube-channel" target="_blank">%s</a>',
						__('Support')
					) )
				);
			}
			return $links;

		}
		/**
		 * Enqueue admin scripts and styles for widget customization
		 */
		function widget_scripts() {

			global $pagenow;

			// Enqueue only on widget or post pages
			if( $pagenow !== 'widgets.php' && $pagenow !== 'customize.php' && $pagenow !== 'options-general.php' && $pagenow !== 'post.php' ) {
				return;
			}

			// Enqueue on post page only if tinymce is enabled
			if ( $pagenow == 'post.php' && empty($this->defaults['tinymce']) ) {
				return;
			}

			/*
			wp_enqueue_script(
				$this->plugin_slug . '-admin',
				plugins_url( 'assets/js/admin.min.js', __FILE__ ),
				array('jquery'),
				self::VER
			);*/
			wp_enqueue_style(
				$this->plugin_slug . '-admin',
				plugins_url( 'assets/css/admin.css', __FILE__ ),
				array(),
				self::VER
			);

		} // END function widget_scripts()

		/**
		 * Print dashboard notice
		 * @return string Formatted notice with usefull explanation
		 */
		function admin_notices() {

			// Get array of dismissed notices
			$dismissed_notices = get_option('youtube_channel_dismissed_notices');

			// Dismiss notices if requested and then update option in DB
			if ( ! empty($_GET['ytc_dismiss_notice_old_php']) ) {
				$dismissed_notices['old_php'] = 1;
				update_option('youtube_channel_dismissed_notices', $dismissed_notices);
			}
			if ( ! empty($_GET['ytc_dismiss_notice_apikey_wpconfig']) ) {
				$dismissed_notices['apikey_wpconfig'] = 1;
				update_option('youtube_channel_dismissed_notices', $dismissed_notices);
			}
			if ( ! empty($_GET['ytc_dismiss_notice_vanity_option']) ) {
				$dismissed_notices['vanity_option'] = 1;
				update_option('youtube_channel_dismissed_notices', $dismissed_notices);
			}
			if ( ! empty($_GET['ytc_dismiss_notice_changed_shortcode_308']) ) {
				$dismissed_notices['changed_shortcode_308'] = 1;
				update_option('youtube_channel_dismissed_notices', $dismissed_notices);
			}

			// Prepare vars for notices
			$settings_page = 'options-general.php?page=youtube-channel';
			$notice = array(
				'error'   => '',
				'warning' => '',
				'info'    => ''
			);

			// Inform if PHP version is lower than 5.3
			if (
				version_compare(PHP_VERSION, "5.3", "<") &&
				(
					empty($dismissed_notices) ||
					( ! empty($dismissed_notices) && empty($dismissed_notices['old_php']) )
				)
			) {
				$notice['info'] .= sprintf(
					__('<p>Your website running on web server with PHP version %s. Please note that <strong>%s</strong> requires PHP at least 5.3 or newer to work properly. <a href="%s" class="dismiss">Dismiss</a></p>', 'youtube-channel'),
					PHP_VERSION,
					$this->plugin_name,
					'?ytc_dismiss_notice_old_php=1'
				);
			}

			// Inform if YOUTUBE_DATA_API_KEY is still in wp-config.php
			if (
				defined('YOUTUBE_DATA_API_KEY') &&
				empty($dismissed_notices['apikey_wpconfig'])
			) {
				$notice['info'] .= sprintf(
					__('<p>Since <strong>%s</strong> v3.0.6 we store <strong>YouTube Data API Key</strong> in plugin settings. So, you can safely remove %s define line from your <strong>wp-config.php</strong> file. <a href="%s" class="dismiss">Dismiss</a></p>', 'youtube-channel'),
					$this->plugin_name,
					'YOUTUBE_DATA_API_KEY',
					'?ytc_dismiss_notice_apikey_wpconfig=1'
				);
			}

			// No YouTube DATA Api Key?
			if ( empty($this->defaults['apikey']) ) {
				$notice['error'] .= sprintf(
					wp_kses(
						__(
							'<p>Please note, to make <strong>%1$s</strong> plugin v3+ work, generate <strong>%2$s</strong> in <a href="%3$s" target="_blank">%4$s</a>, as explained <a href="%5$s" target="_blank">here</a>, then add it to <a href="%6$s">%7$s</a>.<br><br>If you have any issue with new version of plugin, please ask for help on official <a href="%8$s" target="_blank">%9$s</a>.<br>This notice will disappear when you add missing key as mentioned above!</p>',
							'youtube-channel'
						),
						array(
							'a' => array( 'href' => array(), 'target' => array('_blank') ),
							'p' => array(),
							'strong' => array(),
							'br' => array(),
						)
					),
					$this->plugin_name,
					__('YouTube Data API Key', 'youtube-channel'),
					esc_url('https://console.developers.google.com/project'),
					__('Google Developers Console', 'youtube-channel'),
					esc_url('http://urosevic.net/wordpress/plugins/youtube-channel/#youtube_data_api_key'),
					esc_url('options-general.php?page=youtube-channel&tab=general'),
					__('General Settings', 'youtube-channel'),
					esc_url('https://wordpress.org/support/plugin/youtube-channel'),
					__('support forum', 'youtube-channel')
				);
			}

			if (
				empty($dismissed_notices) ||
				( ! empty($dismissed_notices) && empty($dismissed_notices['vanity_option']) )
			) {
				$notice['warning'] .= sprintf(
					__('<p><strong>%s</strong> since version 2.4 supports linking to channel through <em>Vanity/Custom</em> URL. Please review <a href="%s">global</a> and <a href="%s">widgets</a> settings. <a href="%s" class="dismiss">Dismiss</a>', 'youtube-channel'),
					$this->plugin_name,
					$settings_page,
					'widgets.php',
					'?ytc_dismiss_notice_vanity_option=1'
				 );
			}

			// v3.0.8.1 shortcode changes from v3.0.8
			if (
				empty($dismissed_notices) ||
				( ! empty($dismissed_notices) && empty($dismissed_notices['changed_shortcode_308']) )
			) {
				$notice['warning'] .= sprintf(
					__('<p><strong>%s</strong> changed shortcode parameters by removing <code>only_pl</code> and <code>showgoto</code>, and combining with parameters <code>display</code> and <code>link_to</code> respectively. Please check out <a href="%s&tab=help">%s</a> and update your shortcodes. <a href="%s" class="dismiss">Dismiss</a>', 'youtube-channel'),
					$this->plugin_name,
					$settings_page,
					'Help: How to use shortcode',
					'?ytc_dismiss_notice_changed_shortcode_308=1'
				 );
			}
			foreach ( $notice as $type => $message ) {
				if ( ! empty($message) ) {
					echo "<div class=\"notice notice-{$type}\">{$message}</div>";
				}
			}

		} // END function admin_notices()

		/**
		 * Get default options from DB
		 * @return array Latest global defaults
		 */
		public function defaults() {

			$defaults = get_option($this->plugin_option);
			if ( empty($defaults) ) {
				$this->init_options();
			}

			return $defaults;

		}

		/**
		 * Enqueue frontend scripts and styles
		 */
		function enqueue_scripts() {

			// Do we need our own lightbox?
			if ( empty($this->defaults['nolightbox']) ) {
				wp_enqueue_style(
					'magnific-popup-au',
					plugins_url('assets/lib/magnific-popup/magnific-popup.min.css', __FILE__),
					array(),
					self::VER
				);
				wp_enqueue_script(
					'magnific-popup-au',
					plugins_url('assets/lib/magnific-popup/jquery.magnific-popup.min.js', __FILE__),
					array('jquery'),
					self::VER,
					true
				);
			}

			wp_enqueue_style(
				'youtube-channel',
				plugins_url('assets/css/youtube-channel.css', __FILE__),
				array(),
				self::VER
			);
			/* Not needed for v3.0.8.x
			wp_enqueue_script(
				'youtube-channel',
				plugins_url('assets/js/youtube-channel.min.js', __FILE__),
				array('jquery'),
				self::VER,
				true
			);
			*/
		} // end function enqueue_scripts

		/**
		 * Generate comlete inline JavaScript code that conains
		 * Async video load and lightbox init for thumbnails
		 * @return string Compressed JavaScript code
		 */
		function footer_scripts() {

			$js = '';

			// Print YT API only if we have set ytc_html5_js in $_SESSION
			if ( ! empty($_SESSION['ytc_html5_js']) ) {
				$js .= "
					if (!window['YT']) {
						var tag=document.createElement('script');
						tag.src=\"//www.youtube.com/iframe_api\";
						var firstScriptTag=document.getElementsByTagName('script')[0];
						firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);
					}
					function ytc_create_ytplayers(){
						{$_SESSION['ytc_html5_js']}
					}
					try {
						ytc_create_ytplayers();
					} catch (e) {}
					function onYouTubeIframeAPIReady(){
						ytc_create_ytplayers();
					}
					function ytc_mute(event){event.target.mute();}
				";
			} // END if ( ! empty($_SESSION['ytc_html5_js']) )

			// Print Magnific Popup if not disabled
			if ( empty($this->defaults['nolightbox']) ) {
				$js .= "
					function ytc_init_MPAU() {
						jQuery('.ytc-lightbox').magnificPopupAU({
							disableOn:320,
							type:'iframe',
							mainClass:'ytc-mfp-lightbox',
							removalDelay:160,
							preloader:false,
							fixedContentPos:false
						});
					}
					jQuery(window).on('load',function(){
						ytc_init_MPAU();
					});
					jQuery(document).ajaxComplete(function(){
						ytc_init_MPAU();
					});
				";
			} // END if ( empty($this->defaults['nolightbox']) )

			if ( ! empty($js) ) {
				$js = "
				<!-- YouTube Channel 3 -->
				<script type=\"text/javascript\">
				$js
				</script>\n
				";

				if ( WP_DEBUG ) {
					// Uncompressed code if WP debug is enabled
					$js = str_replace(';var', ";\nvar", $js);
					$js = str_replace("\t", "", $js);
					// $js = str_replace(',', ",\n\t", $js);
					echo $js;
				} else {
					echo trim(preg_replace('/[\t\r\n]+/', '', $js));
				}
			}

		} // END function footer_scripts()

		public function shortcode($atts) {

			// get general default settings
			$instance = $this->defaults();

			// extract shortcode parameters
			extract(
				shortcode_atts(
					array(
						'vanity'         => $instance['vanity'],
						'channel'        => $instance['channel'],
						'username'       => $instance['username'],
						'playlist'       => $instance['playlist'],
						'res'            => '', // (deprecated, but leave for back compatibility) ex res
						'use_res'        => '', // (deprecated, but leave for back compatibility) ex use_res
						'resource'       => $instance['resource'], // ex use_res
						'only_pl'        => 0, // disabled by default (was: $instance['only_pl'],)
						'cache'          => $instance['cache'], // ex cache_time
						'privacy'        => $instance['privacy'], // ex showvidesc
						'fetch'          => $instance['fetch'], // ex maxrnd
						'num'            => $instance['num'], // ex vidqty

						'random'         => 0, // ex getrnd

						'ratio'          => $instance['ratio'],
						'width'          => $instance['width'],
						'responsive'     => ( ! empty($instance['responsive']) ) ? $instance['responsive'] : '0',

						'show'           => $instance['display'], // (deprecated, but keep for back compatibility) ex to_show
						'display'        => $instance['display'],
						'no_thumb_title' => 0,
						'themelight'     => $instance['themelight'],
						'controls'       => $instance['controls'],
						'autoplay'       => $instance['autoplay'],
						'mute'           => $instance['autoplay_mute'],
						'norel'          => $instance['norel'],
						'playsinline'    => $instance['playsinline'], // play video on mobile devices inline instead in native device player

						'showtitle'      => $instance['showtitle'], // none, above, below
						'showdesc'       => $instance['showdesc'], // ex showvidesc
						'nobrand'        => ( ! empty($instance['modestbranding']) ) ? $instance['modestbranding'] : '0',
						'desclen'        => $instance['desclen'], // ex videsclen
						'noinfo'         => $instance['hideinfo'],
						'noanno'         => $instance['hideanno'],

						'goto_txt'       => $instance['goto_txt'],
						'popup'          => $instance['popup_goto'],
						'link_to'        => $instance['link_to'], // none, vanity, channel, legacy

						'class'          => ( ! empty($instance['class']) ) ? $instance['class'] : ''
						),
					$atts
				)
			);

			// backward compatibility for show -> display shortcode parameter
			if ( ! empty($show) && $show !== $display && $show !== $instance['display'] ) {
				$display = $show;
			}
			// backward compatibility for use_res -> resource shortcode parameter
			if ( ! empty($use_res) ) {
				$resource = $use_res;
			} else if ( ! empty($res) ) {
				$resource = $res;
			}

			// prepare instance for output
			$instance['vanity']         = $vanity;
			$instance['channel']        = $channel;
			$instance['username']       = $username;
			$instance['playlist']       = $playlist;
			$instance['resource']       = $resource; // resource: 0 channel, 1 favorites, 2 playlist, 3 liked
			$instance['cache']          = $cache; // in seconds, def 5min - settings?
			$instance['privacy']        = $privacy; // enhanced privacy

			$instance['fetch']          = $fetch;
			$instance['num']            = $num; // num: 1

			$instance['random']         = $random; // use embedded playlist - false by default

			// Video Settings
			$instance['ratio']          = $ratio; // aspect ratio: 3 - 16:9, 2 - 16:10, 1 - 4:3
			$instance['width']          = $width; // 306
			$instance['responsive']     = $responsive; // enable responsivenes?
			$instance['display']        = $display; // thumbnail, iframe, iframe2, playlist
			$instance['no_thumb_title'] = $no_thumb_title; // hide tooltip for thumbnails

			$instance['themelight']     = $themelight; // use light theme, dark by default
			$instance['controls']       = $controls; // hide controls, false by default
			$instance['autoplay']       = $autoplay; // autoplay disabled by default
			$instance['autoplay_mute']  = $mute; // mute sound on autoplay - disabled by default
			$instance['norel']          = $norel; // hide related videos
			$instance['playsinline']    = $playsinline; // inline plaer for iOS

			// Content Layout
			$instance['showtitle']      = $showtitle; // show video title, disabled by default
			$instance['showdesc']       = $showdesc; // show video description, disabled by default
			$instance['modestbranding'] = $nobrand; // hide YT logo
			$instance['desclen']        = $desclen; // cut video description, number of characters
			$instance['hideinfo']       = $noinfo; // hide info by default
			$instance['hideanno']       = $noanno; // hide annotations, false by default

			// Link to Channel
			$instance['goto_txt']       = $goto_txt; // text for goto link - use settings
			$instance['popup_goto']     = $popup; // open channel in: 0 same window, 1 javascript new, 2 target new
			$instance['link_to']        = $link_to; // link to: none, vanity, legacy, channel

			// Customization
			$instance['class']          = $class; // custom additional class for container

			return implode(array_values($this->output($instance)));
		} // END public function shortcode()

		// Print out YTC block
		public function output($instance) {

			// Error message if no YouTube Data API Key
			if ( empty($this->defaults['apikey']) ) {

				$error_msg = sprintf(
					__('<strong>%s</strong> version 3+ requires <strong>YouTube DATA API Key</strong> to work. <a href="%s" target="_blank">Learn more here</a>.', 'youtube-channel'),
					$this->plugin_name,
					'http://urosevic.net/wordpress/plugins/youtube-channel/#youtube_data_api_key'
				);

				$output[] = $this->front_debug($error_msg);
				return $output;

			}

			// 1) Get resource from widget/shortcode
			// 2) If not set, get global default
			// 3) if no global, get plugin's default
			$resource = intval($instance['resource']);
			if ( empty($resource) && $resource !== 0 ) {
				$resource = intval($this->defaults['resource']);
				if ( empty($resource) ) {
					$resource = 0;
				}
			}

			// Get Channel or Playlist ID based on requested resource
			switch ($resource) {

				// Playlist
				case '2':
					// 1) Get Playlist from shortcode/widget
					// 2) If not set, use global default
					// 3) If no global, throw error
					if ( ! empty($instance['playlist']) ) {
						$playlist = trim($instance['playlist']);
					} else {
						$playlist = trim($this->defaults['playlist']);
					}
					// Now check has Playlist ID set or throw error
					if ( $playlist == "" ) {
						$output[] = $this->front_debug("Playlist selected as resource but no Playlist ID provided!");
						return $output;
					}
					break;

				// Channel, Favourites, Liked
				default:
					/* Channel */
					// 1) Get channel from shortcode/widget
					// 2) If not set, use global default
					// 3) If no global, throw error
					if ( ! empty($instance['channel']) ) {
						$channel = trim($instance['channel']);
					} else {
						$channel = trim($this->defaults['channel']);
					}
					// Now check is Channel ID set or throw error
					if ( $channel == '' ) {
						if ( $resource == 1 ) { $resource_name = 'Favourited videos'; }
						elseif ( $resource == 3 ) { $resource_name = 'Liked videos'; }
						else { $resource_name = 'Channel (User uploads)'; }
						$error_msg = sprintf('%s selected as resource but no Channel ID provided!', $resource_name);
						$output[] = $this->front_debug($error_msg);
						return $output;
					}

			} // END switch ($resource)

			/* OK, we have required resource (Playlist or Channel ID), so we can proceed to real job */

			// Set custom class and responsive if needed
			$class = $instance['class'] ? $instance['class'] : 'default';
			if ( ! empty($instance['responsive']) ) {
				$class .= ' responsive';
			}
			if ( ! empty($instance['display']) ) {
				$class .= " ytc_display_{$instance['display']}";
			}

			switch ($resource) {
				case 1: // Favourites
					$resource_name = 'favourites';
					$resource_id = preg_replace('/^UC/', 'FL', $channel);
					break;
				case 2: // Playlist
					$resource_name = 'playlist';
					$resource_id = $playlist;
					break;
				case 3: // Liked
					$resource_name = 'liked';
					$resource_id = preg_replace('/^UC/', 'LL', $channel);
					break;
				default: // Channel
					$resource_name = 'channel';
					$resource_id = preg_replace('/^UC/', 'UU', $channel);
			}

			// Start output array
			$output = array();

			$output[] = "<div class=\"youtube_channel {$class}\">";

			if ( $instance['display'] == 'playlist' ) { // Insert as Embedded playlist

				$output = array_merge( $output, self::embed_playlist($resource_id, $instance) );

			} else { // Individual videos from channel, favourites, liked or playlist

				// Get max items for random video
				$fetch = $instance['fetch'];
				if ( $fetch < 1 ) { $fetch = 10; } // default 10
				elseif ( $fetch > 50 ) { $fetch = 50; } // max 50

				$resource_key = "{$resource_id}_{$fetch}";

				// Do we need cache? Let we define cache fallback key
				$cache_key_fallback = 'ytc_' . md5($resource_key) . '_fallback';

				// Do cache magic
				if ( $instance['cache'] > 0 ) {

					// generate feed cache key for caching time
					$cache_key = 'ytc_' . md5($resource_key) . '_' . $instance['cache'];

					if ( ! empty($_GET['ytc_force_recache']) ) {
						delete_transient($cache_key);
					}

					// get/set transient cache
					if ( false === ($json = get_transient($cache_key)) || empty($json) ) {

						// no cached JSON, get new
						$json = $this->fetch_youtube_feed($resource_id, $fetch);

						// set decoded JSON to transient cache_key
						set_transient($cache_key, base64_encode($json), $instance['cache']);

					} else {

						// we already have cached feed JSON, get it encoded
						$json = base64_decode($json);

					}

				} else {

					// just get fresh feed if cache disabled
					$json = $this->fetch_youtube_feed($resource_id, $fetch);

				}

				// free some memory
				unset( $response );

				// decode JSON data
				$json_output = json_decode($json);

				// YTC 3.0.7: Do we need this, still?
				// if current feed is messed up, try to get it from fallback cache
				if ( is_wp_error($json_output) && ! is_object($json_output) && empty($json_output->items) ) {
					// do we have fallback cache?!
					if ( true === ( $json_fallback = get_transient( $cache_key_fallback ) ) && ! empty($json_fallback) ) {
						$json_output = json_decode( base64_decode($json_fallback) );
						// and free memory
						unset( $json_fallback );
					}
				}

				// Get resource nice name based on selected resource
				$resource_nice_name = $this->resource_nice_name($resource);

				// Prevent further checks if we have WP Error or empty record even after fallback
				if ( is_wp_error($json_output) ) {
					$output[] = $this->front_debug( $json_output->get_error_message() );
					return $output;
				}
				elseif ( isset($json_output->items) && sizeof($json_output->items) == 0 ) {
					$output[] = $this->front_debug(sprintf(__("You have set to display videos from %s [resource list ID: %s], but there have no public videos in that resouce."), $resource_nice_name, $resource_id ));
					return $output;
				}
				elseif ( empty($json_output) ) {
					$output[] = $this->front_debug(sprintf(__('We have empty record for this feed. Please read <a href="%s" target="_blank">FAQ</a> and if that does not help, contact <a href="%s" target="_blank">support</a>.'), 'https://wordpress.org/plugins/youtube-channel/faq/', 'https://wordpress.org/support/plugin/youtube-channel'));
					return $output;
				}

				// Predefine `max_items` to prevent undefined notices
				$max_items = 0;
				if ( is_object($json_output) && ! empty($json_output->items) ) {

					// Sort by date uploaded
					$json_entry = $json_output->items;

					$num = $instance['num'];
					if ( $num > $fetch ) { $fetch = $num; }
					$max_items = ( $fetch > sizeof($json_entry) ) ? sizeof($json_entry) : $fetch;

					if ( ! empty($instance['random']) ) {
						$items = array_slice($json_entry, 0, $max_items);
					} else {
						if ( ! $num ) $num = 1;
						$items = array_slice($json_entry, 0, $num);
					}
				}

				if ($max_items == 0) {

					// Append YouTube DATA API error reason as comment
					if ( ! empty($json_output) && is_object($json_output) && ! empty($json_output->error->errors) ) {

						// Error went in fetch_youtube_feed()
						if ( $json_output->error->errors[0]->reason == 'wpError' ) {
							$error_msg = $json_output->error->errors[0]->message;
						}
						// Playlist error from Google API
						elseif ( $json_output->error->errors[0]->reason == 'playlistNotFound' ) {
							if ( $resource_name == 'playlist' ) {
								$error_msg = "Please check did you set existing <em>Playlist ID</em>. You set to show videos from {$resource_nice_name}, but YouTube does not recognize <strong>{$resource_id}</strong> as existing and public playlist.";
							} else {
								$error_msg = "Please check did you set proper <em>Channel ID</em>. You set to show videos from {$resource_nice_name}, but YouTube does not recognize <strong>{$channel}</strong> as existing and public channel.";
							}
						}
						// Invalid YouTube Data API Key
						elseif ( $json_output->error->errors[0]->reason == 'keyInvalid' ) {
							$error_msg = sprintf(__("Double check <em>YouTube Data API Key</em> on <em>General</em> plugin tab and make sure it's correct. Read <a href=\"%s\" target=\"_blank\">Installation</a> document."), 'https://wordpress.org/plugins/youtube-channel/installation/');
						}
						// Restricted access YouTube Data API Key
						elseif ( $json_output->error->errors[0]->reason == 'ipRefererBlocked' ) {
							$error_msg = "Check <em>YouTube Data API Key</em> restrictions, empty cache if enabled by appending in browser address bar parameter <em>?ytc_force_recache=1</em>";
						}
						// (deprecated?) Non existing Channel ID set
						elseif ( $json_output->error->errors[0]->reason == 'invalidChannelId' ) {
							$error_msg = sprintf(__("You have set wrong Channel ID. Fix that in General plugin settings, Widget and/or shortcode. Read <a href=\"%s\" target=\"_blank\">FAQ</a> document."), 'https://wordpress.org/plugins/youtube-channel/faq/');
						}
						// Forbidden access to resource
						elseif ( $json_output->error->errors[0]->reason == 'playlistItemsNotAccessible' ) {
							$error_msg = sprintf(__("You do not have permission to access ressource <strong>%s</strong> (it's maybe set to private or even does not exists!)"), $resource_id);
						}

					} else { // ELSE ! empty($json_output->error->errors)

						$error_msg = "Unrecognized error experienced.";

					} // END ! empty($json_output->error->errors)

					$output[] = $this->front_debug($error_msg);

				} else { // ELSE if ($max_items == 0)

					// looks that feed is OK, let we update fallback that never expire
					set_transient($cache_key_fallback, base64_encode($json), 0);

					// and now free some memory
					unset ( $json, $json_output, $json_entry );

					// set array for unique random item
					if ( ! empty($instance['random']) ) {
						$random_used = array();
					}

					/* AU:20141230 reduce number of videos if requested > available */
					if ( $num > sizeof($items) ) {
						$num = sizeof($items);
					}

					for ( $y = 1; $y <= $num; ++$y ) {
						if ( ! empty($instance['random']) ) {

							$random_item = mt_rand( 0, (count($items)-1) );
							while ( $y > 1 && in_array($random_item, $random_used) ) {
								$random_item = mt_rand(0, (count($items)-1));
							}
							$random_used[] = $random_item;
							$item = $items[ $random_item ];
						} else {
							$item = $items[ $y - 1 ];
						}

						// Generate single video block
						$output = array_merge( $output, $this->ytc_print_video($item, $instance, $y) );
					}
					// Free some memory
					unset($random_used, $random_item, $json);

				} // END if ($max_items == 0)

			} // single playlist or ytc way

			// Append link to channel on bootom of the widget
			if ( ! empty($instance['link_to']) && $instance['link_to'] != 'none' ) {
				$output = array_merge( $output, $this->ytc_channel_link($instance) );
			}

			$output[] = '</div><!-- .youtube_channel -->';

			// fix overflow on crappy themes
			$output[] = '<div class="clearfix"></div>';

			return $output;

		} // END public function output($instance)

		// --- HELPER FUNCTIONS ---

		/**
		 * Download YouTube video feed through API 3.0
		 * @param  string $id       ID of resource
		 * @param  integer $items   Number of items to fetch (min 2, max 50)
		 * @return array            JSON with videos
		 */
		function fetch_youtube_feed($resource_id, $items) {

			$feed_url = 'https://www.googleapis.com/youtube/v3/playlistItems?';
			$feed_url .= 'part=snippet';
			$feed_url .= "&playlistId={$resource_id}";
			$feed_url .= '&fields=items(snippet(title%2Cdescription%2CpublishedAt%2CresourceId(videoId)))';
			$feed_url .= "&maxResults={$items}";
			$feed_url .= "&key={$this->defaults['apikey']}";

			$wprga = array(
				'timeout' => 5 // five seconds only
			);

			$response = wp_remote_get($feed_url, $wprga);

			// If we have WP error, make JSON with error
			if ( is_wp_error($response) ) {

				$json = "{\"error\":{\"errors\":[{\"reason\":\"wpError\",";
				$json .= "\"message\":\"{$response->get_error_message()}\",";
				$json .= "\"domain\":\"wpRemoteGet\"}]}}";

			} else {

				$json = wp_remote_retrieve_body( $response );

			}

			// Free some memory
			unset($response);

			return $json;

		} // END function fetch_youtube_feed($resource_id, $items)

		/**
		 * Print explanation of error for administrators (users with capability manage_options)
		 * and hidden message for lower users and visitors
		 * @param  string $message Error message
		 * @return string          FOrmatted message for error
		 */
		function front_debug($message) {

			// Show visible error to admin, Oops message to visitors and lower members
			if ( is_user_logged_in() && current_user_can('manage_options') ) {

				$output = "<p class=\"ytc_error\"><strong>YTC ERROR:</strong> $message</p>";

			} else {

				$output = __("Oops, something went wrong.", 'youtube-channel');
				$output .= "<!-- YTC ERROR:\n";
				$output .= strip_tags($message);
				$output .= "\n-->\n";

			}

			return $output;

		} // END function debug($message)

		/**
		 * Calculate height by provided width and aspect ratio
		 * @param  integer $width Width in pixels
		 * @param  integer $ratio Selected aspect ratio (1 for 4:3, other for 16:9)
		 * @return integer        Calculated height in pixels
		 */
		function height_ratio($width=306, $ratio) {

			switch ($ratio)
			{
				case 1:
					$height = round(($width / 4 ) * 3);
					break;
				case 2:
				case 3:
				default:
					$height = round(($width / 16 ) * 9);
			}
			return $height;
		} // END function height_ratio($width=306, $ratio)

		/**
		 * Generate link to YouTube channel/user
		 * @param  array $instance widget or shortcode settings
		 * @return array           components prepared for output
		 */
		function ytc_channel_link($instance) {

			// initialize array
			$output = array();

			// do we need to show goto link?
			if ( $instance['link_to'] != 'none' ) {

				$goto_url = "https://www.youtube.com/";

				switch ($instance['link_to']) {
					case 'vanity':
						$vanity   = trim($instance['vanity']);
						if ( empty($vanity) ) {
							return array("<!-- YTC ERROR: Selected Vanity custom URL to be linked but no Vanity Name provided! -->");
						}
						// sanity vanity content (strip all in front of last slash to cleanup vanity ID only)
						if ( ! empty( $vanity ) && strpos($vanity, 'youtube.com') !== false ) {
							$vanity = preg_replace('/^.*\//', '', $vanity);
						}
						$goto_url .= "c/$vanity";
						break;

					case 'legacy':
						$username = trim($instance['username']);
						if ( empty($username) ) {
							return array("<!-- YTC ERROR: Selected Legacy username to be linked but no Legacy username provided! -->");
						}
						$goto_url .= "user/$username";
						break;

					case 'channel':
						$channel  = trim($instance['channel']);
						if ( empty($channel) ) {
							return array("<!-- YTC ERROR: Selected Channel page to be linked but no Channel ID provided! -->");
						}
						$goto_url .= "channel/$channel";
						break;
				}

				$goto_txt = trim($instance['goto_txt']);
				if ( $goto_txt == "" ) {
					$goto_txt = __('Visit our YouTube channel', 'youtube-channel');
				}

				$newtab = __("in new window/tab", 'youtube-channel');

				$output[] = '<div class="clearfix"></div>';
				$output[] = '<div class="ytc_link">';
				$output[] = '<p>';
				switch ( $instance['popup_goto'] ) {
					case 1:
						$output[] = "<a href=\"javascript: window.open('{$goto_url}'); void 0;\" title=\"{$goto_txt} {$newtab}\">{$goto_txt}</a>";
						break;
					case 2:
						$output[] = "<a href=\"{$goto_url}\" target=\"_blank\" title=\"{$goto_txt} {$newtab}\">{$goto_txt}</a>";
						break;
					default:
						$output[] = "<a href=\"{$goto_url}\" title=\"{$goto_txt}\">$goto_txt</a>";
				} // switch popup_goto
				$output[] = '</p>';
				$output[] = '</div>';

			} // showgoto

			return $output;
		} // end function ytc_channel_link


		/**
		 * Generate output for single video block
		 * @param  object $item     Video object from JSON
		 * @param  array  $instance Settings from widget or shortcode
		 * @param  int    $y        Order number of video
		 * @return array            Prepared single video block as array to concatenate
		 */
		function ytc_print_video($item, $instance, $y) {

			// Calculate width and height
			if ( empty($instance['width']) ) {
				$instance['width'] = $this->defaults['width'];
			}
			$height = $this->height_ratio($instance['width'], $instance['ratio']);

			// How to display videos?
			if ( empty($instance['display']) ) {
				$instance['display'] = 'thumbnail';
			}

			// Extract details about video from Resource
			$yt_id    = $item->snippet->resourceId->videoId;
			$yt_title = $item->snippet->title;
			$yt_date  = $item->snippet->publishedAt;
			$yt_thumb  = "//img.youtube.com/vi/$yt_id/0.jpg"; // zero for HD thumb

			// Enhanced privacy?
			$youtube_domain = $this->youtube_domain($instance);

			switch ($y) {
				case 1:
					$vnumclass = 'first';
					break;
				case $instance['num']:
					$autoplay = false;
					$vnumclass = 'last';
					break;
				default:
					$vnumclass = 'mid';
					$autoplay = false;
					break;
			}

			// Set proper class for responsive thumbs per selected aspect ratio
			$arclass = $this->arclass($instance);

			$output[] = "<div class=\"ytc_video_container ytc_video_{$y} ytc_video_{$vnumclass} ${arclass}\" style=\"width:{$instance['width']}px\">";

			// Show video title above video?
			if ( ! empty($instance['showtitle']) && $instance['showtitle'] == 'above' ) {
				$output[] = "<h3 class=\"ytc_title ytc_title_above\">{$yt_title}</h3>";
			}

			// Print out video
			if ( $instance['display'] == "iframe" ) {

				// Start wrapper for responsive item
				if ( $instance['responsive'] ) {
					$output[] = '<div class="fluid-width-video-wrapper">';
				}

				$output[] = "<iframe title=\"YouTube Video Player\" width=\"{$instance['width']}\" height=\"{$height}\" src=\"//{$youtube_domain}/embed/{$yt_id}?wmode=opaque";

				if ( ! empty($instance['norel']) ) $output[] = "&amp;rel=0"; // disable related videos
				if ( ! empty($instance['controls']) ) $output[] = "&amp;controls=0";
				if ( ! empty($instance['hideinfo']) ) $output[] = "&amp;showinfo=0";
				if ( ! empty($instance['autoplay']) ) $output[] = "&amp;autoplay=1";
				if ( ! empty($instance['hideanno']) ) $output[] = "&amp;iv_load_policy=3";
				if ( ! empty($instance['themelight']) ) $output[] = "&amp;theme=light";
				if ( ! empty($instance['modestbranding']) ) $output[] = "&amp;modestbranding=1";
				if ( ! empty($instance['playsinline']) ) $output[] = "&amp;playsinline=1";

				$output[] = "\" style=\"border:0;\" allowfullscreen id=\"ytc_{$yt_id}\"></iframe>";

				// Close wrapper for responsive item
				if ( $instance['responsive'] ) {
					$output[] = '</div>';
				}

			} else if ( $instance['display'] == "iframe2" ) {

				// youtube API async
				$js_vars = '';
				$js_vars .= ( ! empty($instance['norel']) ) ? "rel:0," : '';
				$js_vars .= ( ! empty($instance['autoplay']) ) ? "autoplay:1," : '';
				$js_vars .= ( ! empty($instance['hideinfo']) ) ? "showinfo:0," : '';
				$js_vars .= ( ! empty($instance['controls']) ) ? "controls:0," : '';
				$js_vars .= ( ! empty($instance['themelight']) ) ? "theme:'light'," : '';
				$js_vars .= ( ! empty($instance['modestbranding']) ) ? "modestbranding:1," : '';
				$js_vars .= ( ! empty($instance['playsinline']) ) ? "playsinline:1," : '';
				$js_vars .= "wmmode:'opaque'";
				$js_vars = rtrim($js_vars, ",");

				$js_end = '';
				$js_end .= ( ! empty($instance['hideanno']) ) ? "iv_load_policy:3," : '';
				$js_end .= ( ! empty($instance['autoplay']) && ! empty($instance['autoplay_mute']) ) ? "events:{'onReady':ytc_mute}," : '';
				$js_end = rtrim($js_end, ',');

				$js_player_id      = str_replace('-', '_', $yt_id);

				// Start wrapper for responsive item
				if ( $instance['responsive'] ) {
					$output[] = '<div class="fluid-width-video-wrapper">';
				}

				$output[] = "<div id=\"ytc_player_{$js_player_id}\"></div>";

				// Close wrapper for responsive item
				if ( $instance['responsive'] ) {
					$output[] = '</div>';
				}

				$site_domain = $_SERVER['HTTP_HOST'];
				$ytc_html5_js = "var ytc_player_{$js_player_id};";
				$ytc_html5_js .= "ytc_player_{$js_player_id}=new YT.Player('ytc_player_{$js_player_id}',{height:'{$height}',width:'{$instance['width']}',";
				$ytc_html5_js .= "videoId:'{$yt_id}',enablejsapi:1,playerVars:{{$js_vars}},origin:'{$site_domain}',{$js_end}});";

				// prepare JS for footer
				if ( empty($_SESSION['ytc_html5_js']) ) {
					$_SESSION['ytc_html5_js'] = $ytc_html5_js;
				} else {
					$_SESSION['ytc_html5_js'] .= $ytc_html5_js;
				}

			} else { // default is thumbnail

				// Do we need tooltip for thumbnail?
				if ( empty($instance['no_thumb_title']) ) {
					$title = sprintf( __('Watch video %1$s published on %2$s', 'youtube-channel' ), $yt_title, $yt_date );
				}

				$p = '';
				if ( empty($instance['nolightbox']) ) {
					if ( ! empty($instance['norel']) ) $p .= '&amp;rel=0';
					if ( ! empty($instance['modestbranding']) ) $p .= "&amp;modestbranding=1";
					if ( ! empty($instance['controls']) ) $p .= "&amp;controls=0";
					if ( ! empty($instance['playsinline']) ) $p .= "&amp;playsinline=1";
				}

				// Do we need thumbnail w/ or w/o tooltip
				$tag_title = ( empty($instance['no_thumb_title']) ) ? $tag_title = "title=\"{$yt_title}\"" : "";
				$output[] = "<a href=\"//${youtube_domain}/watch?v=${yt_id}${p}\" ${tag_title} class=\"ytc_thumb ytc-lightbox {$arclass}\"><span style=\"background-image: url({$yt_thumb});\" ${tag_title} id=\"ytc_{$yt_id}\"></span></a>";

			} // what to show conditions

			// show video title below video?
			if ( ! empty($instance['showtitle']) && $instance['showtitle'] == 'below' ) {
				$output[] = "<h3 class=\"ytc_title ytc_title_below\">{$yt_title}</h3>";
			}

			// do we need to show video description?
			if ( ! empty($instance['showdesc']) ) {

				$video_description = $item->snippet->description;
				$etcetera = '';
				if ( $instance['desclen'] > 0 ) {
					if ( strlen($video_description) > $instance['desclen'] ) {
						$video_description = substr($video_description, 0, $instance['desclen']);
						$etcetera = '&hellip;';
					}
				}

				if ( ! empty($video_description) ) {
					$output[] = "<p class=\"ytc_description\">{$video_description}{$etcetera}</p>";
				}

			}

			$output[] = '</div><!-- .ytc_video_container -->';

			return $output;
		} // end function ytc_print_video

		/* function to print standard playlist embed code */
		function embed_playlist($resource_id, $instance) {

			$width          = ( empty($instance['width']) ) ? 306 : $instance['width'];
			$height         = self::height_ratio($width, $instance['ratio']);
			$autoplay       = (empty($instance['autoplay'])) ? '' : '&autoplay=1';
			$theme          = (empty($instance['themelight'])) ? '' : '&theme=light';
			$modestbranding = (empty($instance['modestbranding'])) ? '' : '&modestbranding=1';
			$rel            = (empty($instance['norel'])) ? '' : '&rel=0';
			$playsinline    = (empty($instance['playsinline'])) ? '' : '&playsinline=1';

			// enhanced privacy
			$youtube_domain = $this->youtube_domain($instance);
			$arclass = $this->arclass($instance);
			$output[] = "<div class=\"ytc_video_container ytc_video_1 ytc_video_single ytc_playlist_only {$arclass}\">";
			$output[] = "<div class=\"fluid-width-video-wrapper\">";
			$output[] = "<iframe src=\"//{$youtube_domain}/embed/videoseries?list={$resource_id}{$autoplay}{$theme}{$modestbranding}{$rel}\"";
			if ( ! empty($instance['fullscreen']) ) $output[] = " allowfullscreen";
			$output[] = " width=\"{$width}\" height=\"{$height}\" frameborder=\"0\"></iframe>";
			$output[] = "</div><!-- .fluid-width-video-wrapper -->";
			$output[] = "</div><!-- .ytc_video_container -->";

			return $output;

		} // END function embed_playlist($resource_id, $instance)

		// Helper function cache_time()
		function cache_time($cache_time)
		{
			$times = array(
				'minute' => array(
					1  => __("1 minute", 'youtube-channel'),
					5  => __("5 minutes", 'youtube-channel'),
					15 => __("15 minutes", 'youtube-channel'),
					30 => __("30 minutes", 'youtube-channel')
				),
				'hour' => array(
					1  => __("1 hour", 'youtube-channel'),
					2  => __("2 hours", 'youtube-channel'),
					5  => __("5 hours", 'youtube-channel'),
					10 => __("10 hours", 'youtube-channel'),
					12 => __("12 hours", 'youtube-channel'),
					18 => __("18 hours", 'youtube-channel')
				),
				'day' => array(
					1 => __("1 day", 'youtube-channel'),
					2 => __("2 days", 'youtube-channel'),
					3 => __("3 days", 'youtube-channel'),
					4 => __("4 days", 'youtube-channel'),
					5 => __("5 days", 'youtube-channel'),
					6 => __("6 days", 'youtube-channel')
				),
				'week' => array(
					1 => __("1 week", 'youtube-channel'),
					2 => __("2 weeks", 'youtube-channel'),
					3 => __("3 weeks", 'youtube-channel'),
					4 => __("1 month", 'youtube-channel')
				)
			);

			$out = "";
			foreach ($times as $period => $timeset)
			{
				switch ($period)
				{
					case 'minute':
						$sc = MINUTE_IN_SECONDS;
						break;
					case 'hour':
						$sc = HOUR_IN_SECONDS;
						break;
					case 'day':
						$sc = DAY_IN_SECONDS;
						break;
					case 'week':
						$sc = WEEK_IN_SECONDS;
						break;
				}

				foreach ($timeset as $n => $s)
				{
					$sec = $sc * $n;
					$out .='<option value="'.$sec.'" '. selected( $cache_time, $sec, 0 ).'>'.__($s, $this->plugin_slug).'</option>';
					unset($sec);
				}
			}
			return $out;
		} // end function cache_time


		/**
		 * Method to delete all YTC transient caches
		 * @return string Report message about success or failed purge cache
		 */
		function clear_all_cache() {

			global $wpdb;

			$ret = $wpdb->query(
				$wpdb->prepare(
					"DELETE FROM $wpdb->options
					 WHERE option_name LIKE %s
					 OR option_name LIKE %s
					",
					'_transient_timeout_ytc_%',
					'_transient_ytc_%'
				)
			);

			if ( false === $ret ) {
				echo "Oops, we did not cleared any YouTube Channel cache because some error occured";
			} else {
				if ( $ret == 0 ) {
					echo "Congratulations! You can chill, there is no YouTube Channel caches.";
				} else {
					echo "Success! We cleared $ret row/s with YouTube Channel caches.";
				}
			}
			exit();

		} // END function clear_all_cache()

		/**
		 * Return nice name for resource by provided resource ID
		 * @param  integer $resource_id Resource ID
		 * @return string               Resource nice name
		 */
		function resource_nice_name($resource_id) {
			if ( $resource_id == 0 ) { $resource_nice_name = 'Channel (User uploads)'; }
			elseif ( $resource_id == 1 ) { $resource_nice_name = 'Favourited videos'; }
			elseif ( $resource_id == 2 ) { $resource_nice_name = 'Liked videos'; }
			elseif ( $resource_id == 3 ) { $resource_nice_name = 'Liked videos'; }
			else { $resource_nice_name = 'Unknown resource'; }
			return $resource_nice_name;
		}

		function youtube_domain($instance) {
			$youtube_domain = ( !empty($instance['privacy']) ) ? 'www.youtube-nocookie.com' : 'www.youtube.com';
			return $youtube_domain;
		} // end function youtube_domain

		function arclass($instance) {
			return ( ! empty($instance['ratio']) && $instance['ratio'] == 1) ? 'ar4_3' : 'ar16_9';
		} // END function arclass()

		/**
		 * Register TinyMCE button for YTC
		 * @param  array $plugins Unmodified set of plugins
		 * @return array          Set of TinyMCE plugins with YTC addition
		 */
		function mce_external_plugins($plugins) {

			$plugins['youtube_channel'] = plugin_dir_url(__FILE__) . 'inc/tinymce/plugin.min.js';

			return $plugins;

		} // END function mce_external_plugins($plugins)

		/**
		 * Append TinyMCE button for YTC at the end of row 1
		 * @param  array $buttons Unmodified set of buttons
		 * @return array          Set of TinyMCE buttons with YTC addition
		 */
		function mce_buttons($buttons) {

			$buttons[] = 'youtube_channel_shortcode';
			return $buttons;

		} // END function mce_buttons($buttons)

		function generate_debug_json()
		{
			global $wp_version;

			// get widget ID from parameter
			$for = trim($_GET['ytc_debug_json_for']);

			if ( $for == 'global' ) {
				// global settings
				$options = get_option('youtube_channel_defaults');

				if ( ! is_array($options) ) {
					return;
				}

				// Remove YouTube Data API Key from config JSON
				unset($options['apikey']);

			} else {
				// widget
				$widget_id = (int)$for;
				$for = "youtube-channel-{$for}";

				// get YTC widgets options
				$widget_options = get_option('widget_youtube-channel');

				if ( ! is_array($widget_options[ $widget_id ]) ) {
					return;
				}

				$options = $widget_options[ $widget_id ];
				unset ($widget_options);
			}

			// prepare debug data with settings of current widget
			$data = array_merge(
				array(
					'date'   => date("r"),
					'server' => $_SERVER['SERVER_SOFTWARE'],
					'php'    => PHP_VERSION,
					'wp'     => $wp_version,
					'ytc'    => self::VER,
					'url'    => get_site_url(),
					'for'    => $for
				),
				$options
			);

			// Construct descriptive filename
			$date = date('ymdHis');
			$json_filename = "ytc3_{$_SERVER['HTTP_HOST']}_{$for}_{$date}.json";
			// Return JSON file
			header("Content-disposition: attachment; filename={$json_filename}");
			header('Content-Type: application/json');
			echo json_encode($data);

			// Destroy vars
			unset($data, $options, $widget_id, $option_name, $for, $date, $json_filename);

			// Exit now, because we need only debug data in JSON file, not settings or any other page
			exit;
		}
	} // end class
} // end class check

// add_action('plugins_loaded', create_function( '', '$WPAU_YOUTUBE_CHANNEL = new WPAU_YOUTUBE_CHANNEL();' ) );

global $WPAU_YOUTUBE_CHANNEL;
if ( empty($WPAU_YOUTUBE_CHANNEL) )
	$WPAU_YOUTUBE_CHANNEL = new WPAU_YOUTUBE_CHANNEL();


