<div class="newsletter newsletter_feed">
	<?php $imageID = get_field('newsletter_screenshot'); ?>
	<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
	<?php $newsletter = wp_get_attachment_image_src(get_field('newsletter_screenshot'), 'full'); ?>
	<a title="<?php the_title(); ?>" href="<?php the_field('pcwta_newsletter_file_type');?>" target="_blank">
		<img alt="<?php echo $alt_text; ?>" src="<?php echo $newsletter[0]; ?>"/>
	</a>
	<p><?php the_field('month_and_year'); ?></p>
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
</div><!-- newsletter -->