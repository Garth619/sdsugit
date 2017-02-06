<h1 class="entry-title"><?php the_title(); ?></h1>




<?php if ( post_password_required() ) : ?>


<?php echo get_the_password_form();?>
   
<?php else: ?>

   

<?php if(get_field('table_of_contents_anchor_tags') == "yes"): ?>

<?php if( have_rows('layout_with_table_of_contents_option') ): while ( have_rows('layout_with_table_of_contents_option') ) : the_row(); ?> 
		
		
		<?php if( get_row_layout() == 'table_of_contents' ):?>
			<?php if(get_sub_field('table_of_contents_list')): $count=1; ?>
				<?php if(get_sub_field('table_of_contents_list_title')): ?>
					<h3><?php the_sub_field('table_of_contents_list_title'); ?></h3>
				<?php endif; ?>
				<ul class="anchors">
			<?php while(has_sub_field('table_of_contents_list')): $count++;?>								 
					<li><a title="<?php the_sub_field('table_of_contents_list_item'); ?>" class="dynamic_anchor" href="#anchor_<?php echo $count; ?>"><?php the_sub_field('table_of_contents_list_item'); ?></a></li>																	 
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?> <!-- table of contents -->
		
		<?php if( get_row_layout() == 'section' ):?>
			<?php if(get_sub_field('anchor_section')): $count=1; while(has_sub_field('anchor_section')): $count++;?>				<div class="toc_section">				 
					<h2><span id="anchor_<?php echo $count; ?>"><?php the_sub_field('anchor_section_title'); ?></span></h2>
					<?php the_sub_field('section_description'); ?>
			</div><!-- toc section -->																		 
				<?php endwhile; ?>	
																														 
			<?php endif; ?>
		<?php endif; ?>
		
		
	 <?php if( get_row_layout() == 'content' ): ?>
			<?php the_sub_field('regular_content'); ?>
		<?php endif; ?>
	
	
	<?php endwhile; ?>
<?php endif; ?>	

<?php else: ?>
	<?php the_field('editor'); ?>
<?php endif; ?>	
<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>

<?php endif;?> <!-- password -->															 
