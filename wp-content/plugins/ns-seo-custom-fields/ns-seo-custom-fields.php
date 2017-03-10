<?php
/*
Plugin Name: NS Custom Fields Analysis for WordPress SEO
Plugin URI: http://neversettle.it
Description: Include content from custom fields in the Yoast WordPress SEO plugin keyword analysis (WordPress SEO by Yoast is required).
Author: Never Settle
Version: 2.1.8
Author URI: http://neversettle.it
License: GPLv2 or later
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

class NS_SEO_Custom_Fields {
	
	var $path; // path to plugin dir
	var $wp_plugin_page; // url to plugin page on wp.org
	var $ns_plugin_page; // url to pro plugin page on ns.it
	var $social_desc; // title for social sharing buttons
	
	function __construct(){
		if( class_exists('NS_SEO_Automation') ) return;
		
		$this->path = plugin_dir_path( __FILE__ );
		$this->wp_plugin_page = "http://wordpress.org/plugins/ns-seo-custom-fields";
		$this->ns_plugin_page = "http://neversettle.it/ns-automation-wp-seo";
		$this->social_desc = "Power up WordPress SEO (by Yoast) with Custom Field Automation!";
		
		add_action( 'plugins_loaded', array($this, 'setup_plugin') );
		add_action( 'admin_notices', array($this,'admin_notices'), 11 );
		add_action( 'network_admin_notices', array($this, 'admin_notices'), 11 );
		add_action( 'admin_init', array($this,'register_settings_field') );
		add_action( 'admin_menu', array($this,'register_settings_page'), 20 );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_assets') );
		add_action( 'admin_print_footer_scripts', array($this, 'add_javascript'), 100 );
	    if ( ! function_exists( 'get_plugins' ) ) {
	        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	    }

	    $yoast_version = get_plugin_data( WPSEO_FILE, false, false)['Version'];
		if ($yoast_version < 3.0) { 
			add_filter( 'wpseo_pre_analysis_post_content', array($this,'add_fields_to_analysis') );
		}

		register_deactivation_hook( __FILE__, create_function('','delete_option("ns_seo_custom_installed");') );
	}
	
	/*********************************
	 * NOTICES & LOCALIZATION
	 */
	 
	 function setup_plugin(){
	 	load_plugin_textdomain( 'ns-seo-custom', false, dirname(plugin_basename(__FILE__)).'/lang' ); 
	 }
	
	function admin_notices(){
		// if plugin has just been installed, show message
		if( !get_option('ns_seo_custom_installed') ){
			//if yoast is not installed, tell them to add yoast
			if( !is_plugin_active('wordpress-seo/wp-seo.php') ){
				$message =
					__('Thanks for activating NS Custom Fields for WordPress SEO!','ns-seo-custom').
					'&nbsp;'.
					sprintf( __('Please be aware that this plugin will not function until you install <a target="_blank" href="%s">Yoast WordPress SEO</a>.','ns-seo-custom'), 'http://wordpress.org/plugins/wordpress-seo/' ).
					'&nbsp;';
				$message .=	get_current_screen()->is_network?
					__('After you do that, you can access the plugin\'s settings in each site\'s menu via SEO > NS Custom Analysis.','ns-seo-custom'):
					__('After you do that, you can access this plugin\'s settings in the menu via SEO > NS Custom Analysis.','ns-seo-custom');
			}
			//if yoast is installed, tell them where to find plugin settings
			else{
				$message =
					__('Thanks for activating NS Custom Fields for WordPress SEO! ','ns-seo-custom').
					   '<a href="'.admin_url('admin.php?page=ns_seo_custom').'">'.
					   		(get_current_screen()->is_network?
					   			__('Visit the settings page (SEO > NS Custom Analysis) on each site to set it up.','ns-seo-custom'):
					   			__('Visit the settings page (SEO > NS Custom Analysis) to set it up.','ns-seo-custom')
					   		).
					   '</a>';
			}	
			echo "<div class='updated'><p>$message</p></div>";
			add_option('ns_seo_custom_installed',true);
		}
	}

	function admin_assets($page){
	 	wp_register_style( 'ns-seo-custom', plugins_url("css/ns-seo-custom.css",__FILE__), false, '1.0.0' );
	 	wp_register_script( 'ns-seo-custom', plugins_url("js/ns-seo-custom.js",__FILE__), false, '1.0.0' );
		wp_register_script( 'ns-seo-api', plugins_url("js/ns-seo-api.js",__FILE__), false, '1.0.0' );		 	
		if( $page=='seo_page_ns_seo_custom' ){
			wp_enqueue_style( 'ns-seo-custom' );
			wp_enqueue_script( 'ns-seo-custom' );
		}	
		if( $page=='post.php' || $page=='post-new.php' ){
			wp_enqueue_script( 'ns-seo-api' );
		}				
	}
	
	/**********************************
	 * SETTINGS PAGE
	 */
	
	function register_settings_field(){
		$label = __('Custom field','ns-seo-custom');
		add_settings_section( 'default', false, false, 'ns_seo_custom' );
		add_settings_field( 'ns_seo_custom_fieldname', "$label 1<br/> $label 2<br/> $label 3<br/>", array($this,'show_settings_field'), 'ns_seo_custom', 'default' );
		register_setting( 'ns_seo_custom', 'ns_seo_custom_fieldname', array($this, 'sanitize_settings_field') );
	}	

	function register_settings_page(){
		add_submenu_page(
			'wpseo_dashboard',
			__('NS Custom Fields','ns-seo-custom'),
			__('NS Custom Fields','ns-seo-custom'),
			'manage_options',
			'ns_seo_custom',
			array( $this, 'show_settings_page' )
		);
	}
	
	function show_settings_page(){
		?>
		<div class="wrap">
			<h2><?php $this->plugin_image( 'banner.jpg', __('NS Custom Field Analysis Settings','ns-seo-custom') ); ?></h2>
			
			<!-- BEGIN Left Column -->
			<div class="ns-col-left">
				
				<form method="POST" action="options.php">
					<?php settings_fields('ns_seo_custom'); ?>
					<?php do_settings_sections('ns_seo_custom'); ?>
					<p class="description">
						<?php $this->plugin_image('help.png','How does it work?','ns-help-handle'); ?>
						<?php _e('Enter the names of custom fields you\'d like to include in the Yoast Keyword analysis.','ns-seo-custom'); ?>
					</p>
					<p class="ns-help">
						<?php $this->plugin_image('diagram.png'); ?>
					</p>
					<?php submit_button(); ?>
				</form>
				
				<div class="ns-cta">
					<h5>If you found this useful, could you please:</h5>					
					<div class="ns-cta-rate">
						<strong>Rate This</strong>
						plugin with <br/> 5 stars! <br/>
						<a class="button button-primary" target="_blank" href="<?php echo $this->wp_plugin_page; ?>?rate=5#postform">RATE IT</a>
					</div>
					<div class="ns-cta-share">
						<strong>Share</strong>
						the Pro <br/> Version! <br/>
						<a class="facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($this->ns_plugin_page); ?>&amp;t=<?php echo urlencode($this->social_desc); ?>" target="_blank">
							<?php $this->plugin_image('share-facebook16x16.png'); ?>
						</a>
						<a class="twitter" href="http://twitter.com/share?url=<?php echo urlencode($this->ns_plugin_page); ?>&amp;text=<?php echo urlencode($this->social_desc); ?>&amp;via=" target="_blank">
							<?php $this->plugin_image('share-twitter16x16.png'); ?>
						</a>
						<a class="google" href="http://plus.google.com/share?url=<?php echo urlencode($this->ns_plugin_page); ?>" target="_blank">
							<?php $this->plugin_image('share-googleplus16x16.png'); ?>
						</a>
						<a class="stumbleupon" href="http://www.stumbleupon.com/submit?url=h<?php echo urlencode($this->ns_plugin_page); ?>&amp;title=<?php echo urlencode($this->social_desc); ?>" target="_blank">
							<?php $this->plugin_image('share-stumbleupon16x16.png'); ?>
						</a>
						<a class="reddit" href="http://www.reddit.com/submit?url=h<?php echo urlencode($this->ns_plugin_page); ?>" target="_blank">
							<?php $this->plugin_image('share-reddit16x16.png'); ?>
						</a>
					</div>
					<div class="ns-cta-donate">	
						<strong>Help Us</strong>
						provide support <br/> and updates <br/>		
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="RM625PKSQGCCY">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div>
				</div>		
				<div class="ns-connect">
					<a target="_blank" href="http://neversettle.it/"><?php $this->plugin_image('cta-visit.png','Visit Never Settle'); ?></a>
					<a target="_blank" href="http://www.facebook.com/neversettle.it"><?php $this->plugin_image('cta-like.png','Like Never Settle'); ?></a>
					<a target="_blank" href="https://twitter.com/neversettleit"><?php $this->plugin_image('cta-follow.png','Follow Never Settle'); ?></a>
				</div>
				
			</div>
			<!-- END Left Column -->
			
			<!-- BEGIN Right Column -->			
			<div class="ns-col-right">
				<div class="ns-col-section">
					<h3>Pro Features</h3>
					<p>Our <a href="<?php echo $this->ns_plugin_page; ?>" target="_blank">Pro version</a> is NOW AVAILABLE with amazing new features like:</p>
					<ul class="ns-pro-features">
						<li>Ability to include an unlimted # of custom fields</li>
						<li>Option to set different fields for each post type</li>
						<li>Full support for ACF repeater, flex & gallery fields</li>
						<li>Effortlessly formulate meta descriptions from custom fields</li>
					</ul>
					<p class="cloner-adopter">
						<a href="<?php echo $this->ns_plugin_page; ?>" target="_blank">
							<?php $this->plugin_image("cta-pro.jpg","Never Settle WP SEO Automation"); ?>
						</a>
					</p>
				</div>
			</div>
			<!-- END Right Column -->
				
		</div>
		<?php
	}

	function show_settings_field($args){
		$saved_values = (array) get_option('ns_seo_custom_fieldname');
		for( $x=0; $x<3; $x++ ){
			if( !isset($saved_values[$x]) ){
				$saved_values[$x] = '';
			}
		}
		foreach( array($saved_values[0],$saved_values[1],$saved_values[2]) as $value){
			echo '<input type="text" name="ns_seo_custom_fieldname[]" value="'.$value.'" /><br/>';
		}
	}

	function sanitize_settings_field($value){
		return array_map( 'trim', $value );
	}
	
	/*************************************
	 * FUNCTIONALITY
	 */
	
	// Mod yoast keyword analysis php function to support custom fields
	function add_fields_to_analysis( $content ){
		// Thank you @tncdesigns for this fix that allows this to work on New Post edit page before an ID exists
		//-------------------------------------------------------------------
		global $post;
		$post_id = isset($_GET['post']) ? $_GET['post'] : $post->ID;
		//-------------------------------------------------------------------
		// Also thank you to @tncdesigns for fix that prevents invalid array error if no fieldnames are set
		if( is_array(get_option('ns_seo_custom_fieldname')) ){
			foreach(get_option('ns_seo_custom_fieldname') as $fieldname){
				// get meta
				$meta = get_post_meta( $post_id, $fieldname, true );
				// autodetect outbound links
				$meta = preg_replace( '/(?<!href=[\'"])((http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}((\/|\?)[\w\/#&?%~]*)?)/', '<a href="$1">$1</a>', (string)$meta );
				// append it to the content
				$content .= " " .(string)$meta;
			}
		}
		return $content;
	}
		
	// Replace yoast keyword analysis javascript function to support custom fields
	function add_javascript(){
	  $fieldnames = get_option('ns_seo_custom_fieldname');
	  if( !empty($fieldnames) ){ ?>
		<script>
		jQuery(function($){
			$('.deletemeta').click(function(){
				$(this).parents('tr').find('input[type=text]').addClass('deleted');
			});
			$('#newmeta-submit').click( ystTestFocusKw );
			$('#yoast_wpseo_focuskw').keyup( ystTestFocusKw );
			$('#postcustomstuff, .acf_postbox').find('input,textarea,select').change( ystTestFocusKw )
		})
		ystTestFocusKw = function() {
			//** CUSTOM ADDITION TO YOAST FUNCTION
			var custom_field_content = ' ';
			var enabled_custom_fields = ['<?php echo join( "','", $fieldnames ); ?>'];
			jQuery.each( enabled_custom_fields, function(i,val){
				//get values for acf fields
				if( jQuery("#acf-"+val+', .acf-field[data-name="'+val+'"]').length ){
					var acf_fields = jQuery('#acf-'+val+', .acf-field[data-name="'+val+'"]').find('input,select,textarea').not('input[type=button],input[type=password],input[type=hidden]');
					var other_fields = jQuery('input,select,textarea').not('input[type=button],input[type=password],input[type=hidden]').filter( function(i,el){
						if( jQuery(el).attr('name') ){
							return jQuery(el).attr('name').match(new RegExp('^'+val+'($|\\[)'));
						}
						return false;
					});
					acf_fields.add(other_fields).each(function(i,el){
						custom_field_content += ' '+jQuery(el).val(); 
					});
				}
				// get values for wp-types fields and other fields that use ID
				if( jQuery("#poststuff #"+val).length ){
					custom_field_content += ' '+jQuery("#poststuff #"+val).val();
				}
			});
			// get values for default wp meta fields
			jQuery('#postcustomstuff input[type=text]:visible').each(function(){
				if( jQuery.inArray( jQuery(this).val(), enabled_custom_fields ) > -1 ){
					custom_field_content += jQuery(this).parents('tr').find('textarea').val() + ' ';
				}
			})
			//** END CUSTOM ADDITION
					
			var focuskw = jQuery.trim(jQuery('#'+wpseoMetaboxL10n.field_prefix+'focuskw').val());
			focuskw = yst_escapeFocusKw(focuskw).toLowerCase();
		
			var postname = jQuery('#editable-post-name-full').text();
			var url = wpseoMetaboxL10n.wpseo_permalink_template.replace('%postname%', postname).replace('http://', '');
		
			var p = new RegExp("(^|[ \s\n\r\t\.,'\(\"\+;!?:\-])" + focuskw + "($|[ \s\n\r\t.,'\)\"\+!?:;\-])", 'gim');
			//remove diacritics of a lower cased focuskw for url matching in foreign lang
			var focuskwNoDiacritics = removeLowerCaseDiacritics(focuskw);
			var p2 = new RegExp(focuskwNoDiacritics.replace(/\s+/g, "[-_\\\//]"), 'gim');
		
			var focuskwresults = jQuery('#focuskwresults');
			var	metadesc = jQuery('#wpseosnippet').find('.desc span.content').text();

			if (focuskw != '') {
				var html = '<p>' + wpseoMetaboxL10n.keyword_header + '</p>';
				html += '<ul>';
				html += '<li>' + wpseoMetaboxL10n.article_header_text + ptest(jQuery('#title').val(), p) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.page_title_text + ptest(jQuery('#wpseosnippet_title').text(), p) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.page_url_text + ptest(url, p2) + '</li>';
				html += '<li>' + wpseoMetaboxL10n.content_text + ptest(jQuery('#content').val()+custom_field_content, p) + '</li>';
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
	
	/*************************************
	 * UITILITY
	 */
	 
	 function plugin_image( $filename, $alt='', $class='' ){
	 	echo "<img src='".plugins_url("/img/$filename",__FILE__)."' alt='$alt' class='$class' />";
	 }
	
}

add_action('plugins_loaded','construct_my_class'); function construct_my_class(){ $controller = new NS_SEO_Custom_Fields(); }
