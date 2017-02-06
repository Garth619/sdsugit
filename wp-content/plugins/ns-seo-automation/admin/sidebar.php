<?php require_once(plugin_dir_path(__FILE__).'../ns-sidebar/ns-sidebar.php'); ?>
<div class="ns-col-right">
	<h3><?php _e('Thanks for using NS Automation!','ns-seo-automation'); ?></h3>
	<?php if (function_exists('ns_sidebar::css')) ns_sidebar::css(); ?>
	<?php ns_sidebar::widget( 'featured'); ?>
	<?php ns_sidebar::widget( 'subscribe' ); ?>
	<?php ns_sidebar::widget( 'share', array('plugin_url'=>'http://neversettle.it/buy/wordpress-plugins/ns-automation-for-wordpress-seo/','plugin_desc'=>'Power up WordPress SEO by Yoast with custom fields','text'=>'Would anyone else you know enjoy NS Automation?') ); ?>
	<?php ns_sidebar::widget( 'support' ); ?>
</div>
<!-- END Right Column -->