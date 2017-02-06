				<div class="calendar_wrapper bios staffdirectory_feed">
					<div style="text-align: center;">
						<?php if(get_field('bio_image')):?>
						<?php $imageID = get_field('bio_image'); ?>
						<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
						<?php $bio_image = wp_get_attachment_image_src(get_field('bio_image'), 'full'); ?>
            <img alt="<?php echo $alt_text; ?>" src="<?php echo $bio_image[0]; ?>"/>
            <?php endif;?>
						<p style="font-weight:400"><?php the_field('name'); ?><br/>
					<?php the_field('title'); ?><br/>
					<?php if(get_field('email')) { ?>
						<a title="Email <?php the_field('name'); ?>" href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a><br/>
					<?php } ?>
					<?php if(get_field('phone')) { ?>
						<?php the_field('phone'); ?></p>
					<?php } ?>
					</div><!-- bio_center -->
					<p style="margin-top:15px;"><?php the_field('bio_description'); ?></p>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
				</div><!-- calendar wrapper -->
				
				
				