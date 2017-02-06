<div class="custom_post_type_wrapper curric_feed" style="border-bottom:none;padding-bottom:5px;">
	<h3><span style="color:#a6252f"><?php the_title(); ?></span></h3>
  <?php the_field('curriculum_description'); ?>
 
	
	 <!-- MASTER Curriculum -->
 	
 <!--
	<?php global $post; if (is_tax( 'master-curriculum-categories' ) || is_post_type_archive('mastercurriculum') || is_singular('mastercurriculum') || is_page(130) || is_post_type_archive('mastercurriculum')) { ?>
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'master-curriculum-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		
	<?php } ?>
-->
	  
	  
	  
	  <!-- PCWTA Curriculum -->
 	
 	<!--
<?php global $post; if (is_tax( 'pcwta-curriculum-categories' ) || is_post_type_archive('pcwtacurriculum') || is_singular('pcwtacurriculum') || is_page(149) || is_page(855) || is_post_type_archive('pcwtacurriculum')) { ?>
 		<span class="my_posted"><?php echo get_the_term_list( $post->ID, 'pcwta-curriculum-categories', 'Posted In:<br/>', '<br/>' ); ?></span><br/>
 		
	<?php } ?>
-->
	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>


</div><!-- custom_post_type_wrapper --> 