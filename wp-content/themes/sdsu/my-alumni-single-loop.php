
          <div class="calendar_wrapper alumni_feed">
	         	 <?php $imageID = get_field('group_picture'); ?>
					 	 <?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
					 	 <?php $grouppicture = wp_get_attachment_image_src(get_field('group_picture'), 'full'); ?>
					 	 <img alt="<?php echo $alt_text; ?>" src="<?php echo $grouppicture[0]; ?>" />
					 	 <h2><?php the_title();?></h2>
					 	 <?php if(get_field('counties')) { ?>
					 	 <p>
					 	 	<?php while(has_sub_field('counties')) { ?>
					 	 		<strong><?php the_sub_field('county_name'); ?>:</strong> <?php the_sub_field('names'); ?><br/>
					 	 	<?php } ?>
					 	 </p>
					 	 <?php } ?>
					 	 <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
					</div><!-- wrapper -->
