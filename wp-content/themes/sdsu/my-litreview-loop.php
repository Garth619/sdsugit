<div class="custom_post_type_wrapper litreview_feed" style="border-bottom: 1px solid #ccc;">
            	<h3>
	            	<a title="<?php the_title(); ?>" href="<?php the_field('litreview_file_link'); ?>" target="_blank"><?php the_title(); ?></a>
	            </h3>
            	<p><em>(<?php the_field('litreview_date'); ?>)</em><br/>
							Prepared by: <?php the_field('prepared_by'); ?></p>
            	<?php  edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
</div><!-- custom_post_type_wrapper -->
