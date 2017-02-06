<div class="ns-col-left">
	<form method="POST" action="options.php">
		<?php
		$saved_settings = get_option('ns_seo_automation_analysis');
		$post_types = get_post_types(array('public'=>true));
		settings_fields('ns_seo_automation_analysis');
		
		foreach( $post_types as $post_type):
			$post_object = get_post_type_object($post_type);
			$setting_name = "ns_seo_automation_analysis[$post_type]";
			$saved_vals = !empty($saved_settings[$post_type])? $saved_settings[$post_type] : array('');
			?>
			<div class='ns-ui-box'>
			<h3><?php echo $post_object->labels->name; ?></h3>
				<div class='ns-ui-box-content'>
					<h5><?php _e('Custom Field Name(s)','ns-seo-automation'); ?></h5>
					<ul class="ns-repeater">
					<?php foreach($saved_vals as $saved_val): ?>
						<li>
							<input type="text" name="<?php echo $setting_name; ?>[]" value="<?php echo $saved_val; ?>" />
							<span class="ns-repeater-remove" title="remove">-</span>
						</li>
					<?php endforeach; ?>
					</ul>
					<span class="button button-secondary ns-repeater-add"><?php _e('Add Field','ns-seo-automation'); ?></span>
					<p>
						<?php printf( __("Custom fields you list here will be included in the Yoast keyword analysis for %s.","ns-seo-automation"), strtolower($post_object->labels->name) ); ?>.
						<a class="thickbox" href="<?php echo $this->plugin_url; ?>img/diagram.png"><?php _e('Not sure what to put here?','ns-seo-automation'); ?></a>
					</p>
				</div>
			</div>
		<?php endforeach; ?>
		<?php if( isset($_GET['settings-updated']) ) echo '<p class="ns-saved">'.__('Settings updated!','ns-seo-automation').'</p>'; ?>
		<?php submit_button(); ?>
	</form>
</div>

<?php include("{$this->path}admin/sidebar.php"); ?>