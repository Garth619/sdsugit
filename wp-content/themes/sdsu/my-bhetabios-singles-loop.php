				<div class="calendar_wrapper bios pcwtabios_feed" style="font-size:16px;">
					<div style="text-align: center;">
						
						
						
						

						
						
						
						<?php $imageID = get_field('bheta_bio_image'); ?>
						<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
						<?php $bio_image = wp_get_attachment_image_src(get_field('bheta_bio_image'), 'full'); ?>
						<img alt="<?php echo $alt_text; ?>" src="<?php echo $bio_image[0]; ?>"/>
						<p style="font-weight:400"><?php the_field('bheta_bios_name'); ?></p>
					<?php if(get_field('pcwta_bios_title')) { ?>
							<p style="font-weight:400;"><?php the_field('bheta_bios_title'); ?></p>
						<?php } ?>
				</div><!-- bio_center -->
					<p style="margin-top:15px;"><?php the_field('bheta_bio_description'); ?></p>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
				</div><!-- calendar wrapper -->
				
				
				