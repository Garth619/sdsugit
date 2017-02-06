<?php if (is_archive() && is_tax() || is_post_type_archive() || is_search()) :?> 
	<div class="custom_post_type_wrapper list resource_feed" style="padding-top:12px;padding-bottom:12px;">
	<?php else: ?>
	<div class="custom_post_type_wrapper resource_feed" style="padding-bottom:7px;">
<?php endif; ?>
	<h3>
		<?php if(get_field('file_or_link') == "File") { ?>
		<a title="Read more about <?php the_title(); ?>" href="<?php the_field('file'); ?>" target="_blank"><?php the_title(); ?></a>
		<?php } ?>
		<?php if(get_field('file_or_link') == "Link") { ?>
		<a title="Read More - <?php the_title(); ?>" href="<?php the_field('outside_website_link'); ?>" target="_blank"><?php the_title(); ?></a>
		<?php } ?>
		<?php if(get_field('file_or_link') == "") { ?>
		<span style="color:#a6252f"><?php the_title(); ?></span>
		<?php } ?>
	</h3>
  <?php the_field('description'); ?>
  
  <!-- academy resources and tools -->
  
  <!--
<?php global $post; if (is_tax( 'academy-resources-categories' ) || is_search() || is_post_type_archive('academyresources') || is_singular('academyresources') || is_page(72) || is_page(815) || is_post_type_archive('academyresources')) { ?>
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'academy-resources-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
	<?php } ?>
-->
  
  
  <!-- BHETA Resources -->
 	
 	<!--
<?php global $post; if (is_tax( 'bheta-resources-categories' ) || is_search() || is_post_type_archive('bhetaresources') || is_singular('bhetaresources') || is_page(44) || is_page(796) || is_post_type_archive('bhetaresources')) { ?>
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'bheta-resources-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
	<?php } ?>
-->
	
	
	<!-- Tribal Star Resources -->
<!--
 	
 	<?php global $post; if (is_tax( 'tribal-star-resources-categories' ) || is_search() ||  is_post_type_archive('tribalstarresources') || is_singular('tribalstarresources') || is_page(222) || is_page(1084) || is_post_type_archive('tribalstarresources')) { ?>
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'tribal-star-resources-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		
	<?php } ?>
-->
	
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>

	
	




</div><!-- custom_post_type_wrapper --> 