<?php if (is_archive() && is_tax() || is_post_type_archive() || is_search()) :?> 
	<div class="custom_post_type_wrapper list curric_feed" style="padding-top:12px;padding-bottom:12px;">
	<?php else: ?>
	<div class="custom_post_type_wrapper curric_feed" style="padding-bottom:20px;">
<?php endif; ?>
	<h3 style="color:#9b010a;"><a href="<?php the_permalink(); ?>" title="Read more - <?php the_title(); ?>"><?php the_title(); ?></a></h3>
  <?php the_field('excerpt'); ?><a title="Read more - <?php the_title(); ?>" href="<?php the_permalink(); ?>" class="read_more">Read More</a>
  

 <!-- Master Curriculum -->
 	
 	<!--
<?php global $post; if (is_search() || is_tax( 'master-curriculum-categories' ) || is_post_type_archive('mastercurriculum') || is_singular('mastercurriculum') || is_page(130) || is_post_type_archive('mastercurriculum')) { ?>
 	
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'master-curriculum-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		
	<?php } ?>
-->


<!-- PCWTA Curriculum -->
 	
 	<!--
<?php global $post; if (is_search() || is_tax( 'pcwta-curriculum-categories' ) || is_post_type_archive('pcwtacurriculum') || is_singular('pcwtacurriculum') || is_page(149) || is_page(855) || is_post_type_archive('pcwtacurriculum')) { ?>
 	
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'pcwta-curriculum-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		
	<?php } ?>
-->
	
  <?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>
</div><!-- custom_post_type_wrapper --> 