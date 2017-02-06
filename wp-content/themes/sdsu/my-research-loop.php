	 <div class="custom_post_type_wrapper research_feed" style="border-bottom: 1px solid #ccc;">
            	<h2>
	            	<a title="Read more about <?php the_title(); ?>" href="<?php the_field('sachs_research_file_type'); ?>" target="_blank"><?php the_title(); ?></a>
	            </h2>
            	<p style="font-weight:400">Prepared By: <?php the_field('sachs_research_prepared_by'); ?>
	            </p>
            	<p style="font-weight:400">Purpose:</p> 
            	<?php the_field('sachs_research_purpose'); ?>
            	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
   </div><!-- custom_post_type_wrapper -->
  