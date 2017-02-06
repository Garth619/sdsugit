				<div class="calendar_wrapper bios pcwtabios_feed" style="font-size:16px;">
					<div>
						<h2><a title="<?php the_field('bheta_bios_name'); ?>" href="<?php the_permalink(); ?>"><?php the_field('bheta_bios_name'); ?></a></h2>
						<?php if(get_field('bheta_bios_title')) { ?>
							<p style="font-weight:400;"><?php the_field('bheta_bios_title'); ?></p>
						<?php } ?>
				</div><!-- bio_center -->
					<p style="margin-top:15px;"><?php the_field('bheta_bios_excerpt'); ?>...</p>
					<a title="Read more about <?php the_field('bheta_bios_name'); ?>" href="<?php the_permalink(); ?>" class="read_more">Read More</a>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
				</div><!-- calendar wrapper -->
				
				
				