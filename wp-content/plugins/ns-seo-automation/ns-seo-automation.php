<?php
/*
Plugin Name: NS Automation for WordPress SEO
Plugin URI: http://neversettle.it
Description: Include content from custom fields in Yoast WordPress SEO page analysis and automate dynamic meta description generation to make sure every single page and post-type has one (WordPress SEO by Yoast is required).
Author: Never Settle
Version: 2.0.2.7
Author URI: http://neversettle.it
License: GPLv2 or later
Text Domain: ns-seo-automation
Domain Path: /lang/
*/

/*
Copyright 2013 Never Settle (email : dev@neversettle.it)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} 

// Support plugin auto-updates
require_once('wp-updates-plugin.php');
new WPUpdatesPluginUpdater_635( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));

class NS_SEO_Automation {
	
	var $path; // path to plugin dir
	var $plugin_url; // url to plugin dir
	var $menu_url; // url to admin menu
	var $ns_plugin_page; // url to pro plugin page on ns.it
	var $social_desc; // title for social sharing buttons
	
	var $log_path;
	var $is_debug;
	
	function __construct(){
		$this->is_debug = false;
		$this->log_path = WP_PLUGIN_DIR . '/' . dirname(plugin_basename(__FILE__)).'/logs/' . date("Ymd-His", time()) . '.txt';
		
		$this->path = plugin_dir_path( __FILE__ );
		$this->plugin_url = plugins_url( '/', __FILE__ );
		$this->menu_url = admin_url('admin.php?page=ns_seo_automation');
		$this->ns_plugin_page = "http://neversettle.it/shop/ns-automation-for-wordpress-seo/";
		$this->social_desc = "Power up WordPress SEO (by Yoast) with Custom Field Automation!";
		
		add_action( 'plugins_loaded', array($this, 'setup_plugin') );
		add_action( 'admin_notices', array($this,'admin_notices') );
		add_action( 'network_admin_notices', array($this, 'admin_notices'), 11 );
		add_action( 'admin_init', array($this,'register_settings_field') );
		add_action( 'admin_menu', array($this,'register_settings_page'), 20 );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_assets') );
		add_action( 'admin_print_footer_scripts', array($this, 'add_javascript'), 100 );
		add_action( 'wp_ajax_get_post_meta', array($this, 'ajax_get_post_meta') );
		add_filter( 'wpseo_pre_analysis_post_content', array($this,'add_fields_to_analysis') );
		add_filter( 'wpseo_sitemap_urlimages', array($this,'add_images_to_sitemap'), 10, 2 );
		add_action( 'wpseo_metadesc', array($this,'do_description') );		
		add_filter( 'get_post_metadata',array($this,'filter_metadesc_results'),10,4);

		register_deactivation_hook( __FILE__, create_function('','delete_option("ns_seo_automation_installed");') );
	}
	
	/*********************************
	 * PLUGIN SETUP / LOCALIZATION
	 */
	 
	 function setup_plugin(){
		load_plugin_textdomain( 'ns-seo-automation', false, dirname(plugin_basename(__FILE__)).'/lang' );
	 }
	 
	function admin_notices(){
		// if plugin has just been installed, show message
		if( !get_option('ns_seo_automation_installed') ){
			//if yoast is not installed, tell them to add yoast
			if( !is_plugin_active('wordpress-seo/wp-seo.php') ){
				$message =
					__('Thanks for activating NS Automation for WordPress SEO!','ns-seo-automation').
					'&nbsp;'.
					sprintf( __('Please be aware that this plugin will not function until you install <a target="_blank" href="%s">Yoast WordPress SEO</a>.','ns-seo-automation'), 'http://wordpress.org/plugins/wordpress-seo/' ).
					'&nbsp;';
				$message .= get_current_screen()->is_network?
					__('After you do that, you can access the plugin\'s settings in each site\'s menu via SEO > NS Automation.','ns-seo-automation'):
					__('After you do that, you can access this plugin\'s settings in the menu via SEO > NS Automation.','ns-seo-automation');				;
			}
			//if yoast is installed, tell them where to find plugin settings
			else{
				$message =
					__('Thanks for activating NS Automation for WordPress SEO!','ns-seo-automation').
					   '&nbsp;'.
					   '<a href="'.$this->menu_url.'">'.
							(get_current_screen()->is_network?
								__('Visit the settings page (SEO > NS Automation) on each site to set it up.','ns-seo-automation'):
								__('Visit the settings page (SEO >NS Automation) to set it up.','ns-seo-automation')
							).
					   '</a>';
			}   
			echo "<div class='updated'><p>$message</p></div>";
			add_option('ns_seo_automation_installed',true);
		}
	}

	function admin_assets($page){		
		wp_register_style( 'ns-seo-automation', plugins_url("css/ns-seo-automation.css",__FILE__), false, '1.0.0' );
		wp_register_script( 'ns-seo-automation', plugins_url("js/ns-seo-automation.js",__FILE__), false, '1.0.0' );
		if( $page=='seo_page_ns_seo_automation' ){
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( 'ns-seo-automation' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_script( 'ns-seo-automation' );
		}	   
	}
	
	/*****************************
	 * SETTINGS PAGE
	 */
	 
	function register_settings_field(){
		register_setting( 'ns_seo_automation_analysis', 'ns_seo_automation_analysis', array($this,'validate_settings_field') );
		register_setting( 'ns_seo_automation_metadesc', 'ns_seo_automation_metadesc', array($this,'validate_settings_field') );
	}
	
	function validate_settings_field($setting){
		if( is_array($setting) ){
			foreach($setting as &$item){
				$item = $this->validate_settings_field($item);
			}
			$setting = array_filter($setting);
		}
		else{
			$setting = trim($setting);
		}
		return $setting;
	}
	
	function register_settings_page(){
		add_submenu_page(
			'wpseo_dashboard',
			__('NS Automation','ns-seo-automation'),
			__('NS Automation','ns-seo-automation'),
			'manage_options',
			'ns_seo_automation',
			array( $this, 'show_settings_page' )
		);
	}
	
	function show_settings_page(){
		$current_tab = isset($_GET['tab'])? $_GET['tab'] : 'analysis';
		$tabs = array( 'analysis'=>'Keyword Analysis', 'metadesc'=>'Meta Descriptions');
		if( !array_key_exists($current_tab,$tabs) ){
			echo 'Invalid settings page.';
			return;
		}
		?>
		<div class="wrap">
			<h2><?php $this->plugin_image('ns-automation-header.png'); ?></h2>
			<h2 class="nav-tab-wrapper">
				<?php
				foreach($tabs as $tab=>$label){
					$class = ($current_tab==$tab)? 'nav-tab-active' : '';
					echo "<a href='{$this->menu_url}&tab={$tab}' class='nav-tab {$class}'>{$label}</a>";
				}
				?>
			</h2>
			<?php include("{$this->path}admin/{$current_tab}-settings.php"); ?>
		</div>
		<?php
	}
	
	// Ouput an image from the plugin /img/ dir
	function plugin_image( $filename, $alt='', $class='' ){
		echo "<img src='$this->plugin_url/img/$filename' alt='$alt' class='$class' />";
	}
	
	
	/**********************************
	 * FUNCTIONALITY
	 */
	
	// set meta descriptions based on custom field settings
	function do_description( $desc, $post_id=0, $force_custom_field=false ){
		$post = get_post($post_id);
		if( is_null($post) ) return $desc;
		// if manually entered a metadesc just for this post, use it
		$manual_metadesc = $this->get_unmodified_metadesc($post->ID); 
		if( !empty($manual_metadesc) && !$force_custom_field ) return $manual_metadesc;
		// otherwise, try to get from custom field
		$custom_desc_data = (array) get_option( 'ns_seo_automation_metadesc' );
		if( is_object($post) && array_key_exists( $post->post_type, $custom_desc_data ) ){
			$field_data = $custom_desc_data[ $post->post_type ];
			// handle acf fields
			if( function_exists('get_field_object') && $acf_field_data=get_field_object($field_data['fieldname'],$post_id) ){
				$field_value = $this->get_acf_field_value( $acf_field_data, $post_id );
			}
			// handle normal fields
			else {
				$field_value = $this->array_flatten_to_string( get_post_meta($post_id,$field_data['fieldname']) );
			}
			$field_fallback = isset($field_data['fallbacks'])? $field_data['fallbacks'] : array();
			//use the field if it has a value
			if( !empty($field_value) ){
				return $this->trim_to_156( $field_value );
			}
			//otherwise use one of the fallbacks, using wp_seo_replace_vars so the WP SEO tokens like
			// %%title%%, %%sep%%, etc can be used in the fallback
			elseif( !empty($field_fallback) ){
				$selected_fallback = $field_fallback[ array_rand($field_fallback) ];
				return $this->trim_to_156( wpseo_replace_vars( $selected_fallback, (array) $post ) );
			}
		}
		return $desc;
	}
	
	//include custom field values in content before running keyword %ages
	function add_fields_to_analysis( $content ){
		global $post;
		$saved_post = $post;
		$fieldnames = (array)get_option('ns_seo_automation_analysis');
		if( isset($fieldnames[$post->post_type]) ){
			foreach( (array) $fieldnames[$post->post_type] as $fieldname ){
				// set post id here in loop so it gets reset from an option field value
				$post_id = $post->ID;
				// do setup for acf options fields
				if( preg_match('/^options ?> ?/',$fieldname) ){
					$fieldname = preg_replace( '/^options ?> ?/', '', $fieldname);
					$post_id = 'options';
				}
				// handle acf fields
				if( function_exists('get_field_object') && $field_data=get_field_object($fieldname,$post_id) ){
					$value = $this->get_acf_field_value( $field_data, $post_id );
				}
				// handle wp types fields
				if( !get_post_meta($post_id,$fieldname) && get_post_meta($post_id,"wpcf-$fieldname") ){
					$value = $this->get_types_field_value( $fieldname, $post_id );
				}
				// handle normal fields
				else {
					$value = $this->array_flatten_to_string( get_post_meta($post_id,$fieldname) );
				}
				// add custom field content before or after main content depending on filter
				// TODO make this an admin setting
				if( apply_filters('ns_seo_automation_custom_content_first',true,$post_id) ){
					$content = "$value $content";
				}
				else {
					$content = "$content $value";	
				}
				$post = $saved_post;
			}
		}
		// TODO: debugging
		if ($this->is_debug) error_log("CONTENT: \n---\n".$content."\n---\n", 3, $this->log_path);
		return $content;
	}
	
	// Include images from custom fields in image list for sitemap generation
	function add_images_to_sitemap( $images, $post_id ){		
		global $wpdb, $post, $wpseo_sitemaps;
		remove_action( 'posts_where', array($wpseo_sitemaps,'invalidate_main_query') );
		$saved_post = $post;
		$post = get_post($post_id);
		$html = $this->add_fields_to_analysis('');
		$parsed_home = parse_url( home_url() );
		$host        = '';
		$scheme      = 'http';
		if ( isset( $parsed_home['host'] ) && ! empty( $parsed_home['host'] ) ) {
			$host = str_replace( 'www.', '', $parsed_home['host'] );
		}
		if ( isset( $parsed_home['scheme'] ) && ! empty( $parsed_home['scheme'] ) ) {
			$scheme = $parsed_home['scheme'];
		}
		if ( preg_match_all( '`<img [^>]+>`', $html, $matches ) ) {
			foreach( $matches[0] as $img ){
				if ( preg_match( '`src=["\']([^"\']+)["\']`', $img, $match ) ) {
					$src = $match[1];
					// handle relative urls
					if( strpos( $src, 'http' ) !== 0 && strpos( $src, '//' ) !== 0 ){
						$src = home_url( $src );
					}
					// handle absolute protocol-less urls
					elseif( strpos( $src, '//' ) === 0 ){
						$src = "$scheme:$src";
					}
					// skip anything bad
					if ( empty($src) || $src != esc_url($src) || strpos($src,$host)===false ) {
						continue;
					}
					// add titles and alts if they exist
					$xml_image = array( 'src' => $src );
					if ( preg_match( '`title=["\']([^"\']+)["\']`', $img, $match ) ) {
						$xml_image['title'] = str_replace( array( '-', '_' ), ' ', $match[1] );
					}	
					if ( preg_match( '`alt=["\']([^"\']+)["\']`', $img, $match ) ) {
						$xml_image['alt'] = str_replace( array( '-', '_' ), ' ', $match[1] );
					}	
					$images[] = $xml_image;
				}
			}
		}
		$post = $saved_post;
		add_action( 'posts_where', array($wpseo_sitemaps,'invalidate_main_query') );
		return $images;
	}

	// Replace yoast keyword analysis javascript function to support custom fields
	function add_javascript(){
	  if( get_current_screen()->parent_base!='edit' || !isset($_GET['post']) ) return;
	  else $post = get_post($_GET['post']);
	  $fieldnames = get_option('ns_seo_automation_analysis');
	  $screen = get_current_screen();
	  

	  $desc_unmodified = addslashes($this->get_unmodified_metadesc($post->ID));
	  $desc_from_custom_field = addslashes($this->do_description('',$post->ID,true));
	  ?>
	  <script>
	  jQuery(function($){
	  	var md = $('#yoast_wpseo_metadesc');
	  	<?php if( empty($desc_unmodified) ): ?>
		// trigger the yoast search result preview to show the metadesc from the custom field if applicable
		md.val('<?php echo $desc_from_custom_field; ?>');
	 	if( typeof yst_updateDesc === 'function' ) yst_updateDesc();
	 	<?php endif; ?>
		// set custom field value as placeholder in metadesc textarea (will show if no manual one is entered),
		// and then reset the value back to whatever was manually entered (not custom field value) if a manual override was specified
	 	md.attr('placeholder','<?php echo $desc_from_custom_field; ?>')
	 	md.val('<?php echo $desc_unmodified; ?>');
	 	// set metadesc value to custom field value when focuskw is changed, and then move back to placeholder
	 	$('body').on('change', '#'+wpseoMetaboxL10n.field_prefix+'focuskw', function(){
	 		if( md.val().length < 1 ){
	 			md.val( md.attr('placeholder') );
	 			window.setTimeout( function(){md.val('')}, 500 );
	 		}
	 	});
	  });
	  </script>
	  <?php
	  // keyword stats
	  if( !empty($fieldnames[ $screen->post_type ]) ){ ?>
		<script>
		jQuery(function($){
			$('.deletemeta').click(function(){
				$(this).parents('tr').find('input[type=text]').addClass('deleted');
			});
			$('#newmeta-submit').click( yst_testFocusKw );
			$('#yoast_wpseo_focuskw').keyup( yst_testFocusKw );
			$('#postcustomstuff, .acf_postbox, .postbox').find('input,textarea,select').change( yst_testFocusKw );
		})
		yst_testFocusKw = function() {
			//** CUSTOM ADDITION TO YOAST FUNCTION
			var custom_field_content = ' <?php echo addslashes( join( " ", $this->get_acf_option_values($fieldnames[$screen->post_type]) ) ); ?>';
			var enabled_custom_fields = ['<?php echo join( "','", $fieldnames[$screen->post_type] ); ?>'];
			//get values for acf fields + any other postmeta frameworks which use the fieldname as the name attribute of the input
			jQuery.each( enabled_custom_fields, function(i,val){
				var acf_fields = jQuery('#acf-'+val+', .acf-field[data-name="'+val+'"]').find('input,select,textarea').filter(function(i,el){
					return jQuery(el).not('input[type=button],input[type=password],input[type=hidden]') && !jQuery(el).parents('.acf-field .clones').length
				});
				var other_fields = jQuery('input,select,textarea').not('input[type=button],input[type=password],input[type=hidden]').filter( function(i,el){
					if( jQuery(el).attr('name') ){
						return jQuery(el).attr('name').match(new RegExp('^'+val+'($|\\[)'));
					}
					return false;
				});
				acf_fields.add(other_fields).each(function(i,el){
					custom_field_content += ' '+jQuery(el).val(); 
				});
			});
			// get values for default wp meta fields
			jQuery('#postcustomstuff input[type=text]:visible').each(function(){
				if( jQuery.inArray( jQuery(this).val(), enabled_custom_fields ) > -1 ){
					custom_field_content += jQuery(this).parents('tr').find('textarea').val() + ' ';
				}
			})
			//** END CUSTOM ADDITION			
			// Retrieve focus keyword and trim
			var focuskw = jQuery.trim(jQuery('#' + wpseoMetaboxL10n.field_prefix + 'focuskw').val());
			focuskw = yst_escapeFocusKw(focuskw).toLowerCase();
		
			var postname = jQuery('#editable-post-name-full').text();
			var url = wpseoMetaboxL10n.wpseo_permalink_template.replace('%postname%', postname).replace('http://', '');
			var p = new RegExp("(^|[ \s\n\r\t\.,'\(\"\+;!?:\-])" + focuskw + "($|[ \s\n\r\t.,'\)\"\+!?:;\-])", 'gim');
			//remove diacritics of a lower cased focuskw for url matching in foreign lang
			var focuskwNoDiacritics = removeLowerCaseDiacritics(focuskw);
			var p2 = new RegExp(focuskwNoDiacritics.replace(/\s+/g, "[-_\\\//]"), 'gim');

			var focuskwresults = jQuery('#focuskwresults');
			var metadesc = jQuery('#wpseosnippet').find('.desc span.content').text();
		
			if (focuskw != '') {
				var html = '<p>' + wpseoMetaboxL10n.keyword_header + '</p>';
				html += '<ul>';
				html += '<li>' + wpseoMetaboxL10n.article_header_text + ptest(jQuery('#title').val(), p) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.page_title_text + ptest(jQuery('#wpseosnippet_title').text(), p) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.page_url_text + ptest(url, p2) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.content_text + ptest(jQuery('#content').val() + custom_field_content, p) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.meta_description_text + ptest(metadesc, p) + '</li>';
				html += '</ul>';
				focuskwresults.html(html);
			} else {
				focuskwresults.html('');
			}
		}
		</script>
	  <?php
	  }
	}

	function filter_metadesc_results($data,$post_id,$meta_key,$single){
		remove_filter( 'get_post_metadata', array($this,'filter_metadesc_results') );
		if( empty($meta_key) && !isset($data['_yoast_wpseo_metadesc']) && !$single && is_array($data) ){
			$data['_yoast_wpseo_metadesc'] = array( $this->do_description('') );
		}
		add_filter( 'get_post_metadata', array($this,'filter_metadesc_results'), 10, 4 );
		return $data;
	}
	
	/*********************************
	 * UTILITY
	 */
	
	// Take a (possibly) multimensional array and concatenate it's vals into a string
	function array_flatten_to_string( $arr ){
		$arr = (array)$arr;
		$str = '';
		foreach( $arr as $item ){
			switch( gettype($item) ){
				case 'array':
					$str .= $this->array_flatten_to_string($item);
					break;
				case 'integer':
					$str .= "$item ";
					break;
				case 'string':
					$str .= "$item ";
					break;
			}
		}
		return $str;
	}
	
	// Take a string and trim it down to meta desc size (~156 chars) but with a clean break
	// at the last sentence before that (i.e. no partial sentence dangling at the end)
	// plus remove linebreaks and html tags that would cause problems
	function trim_to_156( $str ){
		$str = preg_replace( '/\s+/', ' ', strip_tags( (string)$str ) );
		if( strlen($str) > 156 ){
			$shortened = substr( strip_tags($str), 0, 156);
			// if it contains a period in the last 60 characters, trim back to the end of the last sentence
			if( preg_match( '/\..{0,60}$/', $shortened ) ){
				$shortened = preg_replace( '/(?<=\.)\s.{0,60}$/', '', $shortened );
			}
			// otherwise we'd be stripping too much to cut back to last sentence, so just strip back to the 
			// end of the last word (no partial words) and add ellipsis to indicate it has been shortened
			else{
				if( substr($str,153,1)!=' ' ){
					$shortened = preg_replace( '/\s\S*$/', '', substr($shortened,0,153) );
				}
				$shortened .= '...';
			}
			$str = $shortened;
		}
		return $str;
	}
	
	// Return true/false whether an associative array contains a set of values
	function array_contains( $needle, $haystack ){
		return $haystack != array_diff( $haystack, needle );
	} 
	
	// Take an acf field key and get the seo value
	function get_acf_field_value( $field ){
		$value = '';
		$field_type = isset($field['type'])? $field['type'] : '';
		$field_value = isset($field['value'])? $field['value'] : '';
		// handle crazy new ACF image format type
		if ( is_array( $field_value ) && isset( $field_value['mime_type'] ) && strpos( $field_value['mime_type'], 'image' ) !== false ) {
			$field_type = 'image';
		}
		switch( $field_type ){
			// generate an image tag for image fields so that it will register for yoast's images-in-content count
			case 'image':
				$src = '';
				$alt = '';
				if( is_numeric($field_value) ){
					$image = wp_get_attachment_image_src( $field_value, 'full' );
					$src = $image[0];
					$alt = get_post_meta( $field_value, '_wp_attachment_image_alt', true );
				}
				elseif( is_array($field_value) ){
					$src = $field_value['url'];
					$alt = $field_value['alt'];
				}
				else{
					$src = $field_value;
					$alt = '';
				}
				$value = "<img src=\"$src\" alt=\"$alt\" />";
				break;
			// for a repeater or flexible content field, recurse this function on each subfield and return the concatenated value of all of them
			case 'repeater':
				foreach( (array) $field['value'] as $row=>$sub_field_values ){
					foreach( (array) $sub_field_values as $name=>$sub_field_value ){
						$sub_field = $this->get_acf_sub_field( $name, $field );
						$sub_field['value'] = $sub_field_value;
						$value .= $this->get_acf_field_value( $sub_field );
					}
				}
				break;
			case 'flexible_content':
				foreach( (array) $field['value'] as $row=>$sub_field_values ){
					if( !isset($sub_field_values['acf_fc_layout']) ) continue;
					$layout = $sub_field_values['acf_fc_layout']; //layout name will always come at beginning as acf_fc_layout - save it but don't count as content
					foreach( (array) $sub_field_values as $name=>$sub_field_value ){
						if( $name=='acf_fc_layout' ) continue; 
						$sub_field = $this->get_acf_sub_field( $name, $field, $layout );
						$sub_field['value'] = $sub_field_value;
						$value .= $this->get_acf_field_value( $sub_field );
					}
				}
				break;
			// for a gallery field, count it as a series of image fields so image count will go up and word count won't
			case 'gallery':
				foreach( (array) $field_value as $img){
					$value .= $this->get_acf_field_value( array('type'=>'image','value'=>$img) );
				}
				break;
			// for all other fields, just do our best - autodetect links for the yoast outbound links count, and flatten the field value if it's an array
			default:
				 $value = $this->array_flatten_to_string( $field_value );
				 if( apply_filters('ns_seo_automation_autodetect_links',true,$field) ){
				 	$value = preg_replace( '/(?<!=[\'"])((http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}((\/|\?)[\w\/#&?%~]*)?)/', '<a href="$1">$1</a>', $value );				 	
				 }
		}
		// TODO: debugging
		if ($this->is_debug) error_log("FIELD: \n---\n".print_r($field, true)."\n---\n", 3, $this->log_path);
		if ($this->is_debug) error_log("FIELD VALUE ($field_type): \n---\n".$value."\n---\n", 3, $this->log_path);
		return $value;
	}

	function get_acf_sub_field( $sub_field_name, $parent_field, $layout_name=false ){
		$sub_fields = array();
		// for flex content
		if( isset($parent_field['type']) && isset($parent_field['layouts']) && $parent_field['type']=='flexible_content' ){
			foreach( (array) $parent_field['layouts'] as $index=>$layout ){
				if(
					( isset($layout['name']) && $layout['name']==$layout_name ) ||
					( isset($layout['key']) && $layout['key']==$layout_name )
				){
					break;
				}
			}
			$sub_fields = $layout['sub_fields'];
		}
		// for repeaters
		elseif( isset($parent_field['type']) && isset($parent_fields['sub_fields']) && $parent_field['type']=='repeater' ){
			$sub_fields = $parent_field['sub_fields'];
		}
		foreach( (array) $sub_fields as $sub_field ){
			if(
				( isset($sub_field['_name']) && $sub_field['_name']==$sub_field_name ) || // post v5 acf
				( isset($sub_field['name']) && $sub_field['name']==$sub_field_name ) ||   // pre v5 acf
				( isset($sub_field['key']) && $sub_field['key']==$sub_field_name )
			){
				
				return $sub_field;
			}
		}
		return array();
	}
	
	function get_acf_option_values( $all_fieldnames ){
		$values = array();
		$option_fieldnames = preg_grep( '/^options ?> ?/', $all_fieldnames );
		foreach( $option_fieldnames as $fieldname ){
			$values[] = get_field( preg_replace('/^options ?> ?/','',$fieldname), 'option' );
		}
		return $values;
	}
	
	// Take a toolset types field key and get the seo value
	function get_types_field_value( $fieldname, $post_id ){
		$string_value = "";
		$value = get_post_meta( $post_id, "wpcf-$fieldname" );
		foreach( (array)$value as $value_item ){
			// detect images
			$value_item = preg_replace( '#^https?://.+/wp-content/uploads/.+(png|gif|jpe?g)$#i', '<img src="$0" />', $value_item );
			$string_value .= "$value_item ";
		}
		return $string_value;
	}
	
	function get_unmodified_metadesc( $post_id=0 ){		
		remove_filter( 'get_post_metadata', array($this,'filter_metadesc_results') );
		$metadesc = WPSEO_Meta::get_value('metadesc',$post_id);
		add_filter( 'get_post_metadata', array($this,'filter_metadesc_results'), 10, 4 );
		return $metadesc;
	}
	 
}
new NS_SEO_Automation();
