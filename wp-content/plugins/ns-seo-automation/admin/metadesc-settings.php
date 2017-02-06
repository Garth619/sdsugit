<div class="ns-col-left">
	<form method="POST" action="options.php">
		<?php
		$saved_settings = get_option('ns_seo_automation_metadesc');
		$post_types = get_post_types(array('public'=>true));
		settings_fields('ns_seo_automation_metadesc');
		
		foreach( $post_types as $post_type ):
			$post_object = get_post_type_object($post_type);
			$setting_name = "ns_seo_automation_metadesc[$post_type]";
			$saved_fieldname = isset($saved_settings[$post_type]['fieldname'])? $saved_settings[$post_type]['fieldname'] : '';
			$saved_fallbacks = !empty($saved_settings[$post_type]['fallbacks'])? $saved_settings[$post_type]['fallbacks'] : array('');
			?>
			<div class='ns-ui-box'>
			<h3><?php echo $post_object->labels->name; ?></h3>
				<div class='ns-ui-box-content'>
					<h5><?php _e('Custom Field Name','ns-seo-automation'); ?></h5>
					<input type="text" name="<?php echo $setting_name; ?>[fieldname]" value="<?php echo $saved_fieldname; ?>" />
					<p>
						<?php _e("The custom field you list here will be used as the meta description for ","ns-seo-automation"); echo strtolower($post_object->labels->name); ?>.
						<a class="thickbox" href="<?php echo $this->plugin_url; ?>img/diagram.png"><?php _e('Not sure what the correct "fieldname" is?','ns-seo-automation'); ?></a>
					</p>
					<h5>Fallback(s)</h5>
					<ul class="ns-repeater">
					<?php foreach($saved_fallbacks as $fallback): ?>
						<li>
							<textarea name="<?php echo $setting_name; ?>[fallbacks][]"><?php echo $fallback; ?></textarea>
							<span class="ns-repeater-remove" title="remove">-</span>
						</li>
					<?php endforeach; ?>
					</ul>
					<span class="button button-secondary ns-repeater-add">Add Fallback</span>
					<p>
						<?php printf( __("This fallback will be shown if the custom field you specified is empty on a particular %s.","ns-seo-automation"), strtolower($post_object->labels->singular_name) ); ?>
						<?php _e("If more than one fallback, they will be randomly rotated.","ns-seo-automation"); ?>
						<?php printf( __("<a target=\"_blank\" href=\"%s\">WordPress SEO variables</a> are allowed.","ns-seo-automation"), admin_url('admin.php?page=wpseo_titles#top#template_help') ); ?>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
		<?php if( isset($_GET['settings-updated']) ) echo '<p class="ns-saved">'.__('Settings updated!','ns-seo-automation').'</p>'; ?>
		<?php submit_button(); ?>
	</form>
</div>

<?php include("{$this->path}admin/sidebar.php"); ?>
