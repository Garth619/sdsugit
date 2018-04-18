<?php
/**
 * Template Name: New BHETA eLearning 10/1/15
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
		
		<div id="container-custom">
			<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<span class="breadcrumbs">','</span>');
} ?>
			<div class="sidebar_wrapper">
				<?php get_sidebar(); ?>
			</div><!-- sidebar wrapper -->
			<div class="content_wrapper">
				<div id="content">
					
					
					
					
			<h1 class="entry-title"><?php the_title(); ?></h1>




<?php if( have_rows('layout_with_table_of_contents_option_bheta_elearning') ): while ( have_rows('layout_with_table_of_contents_option_bheta_elearning') ) : the_row(); ?> 
		
		
		<?php if( get_row_layout() == 'table_of_contents_bheta_elearning' ):?>
			<?php if(get_sub_field('table_of_contents_list_bheta_elearning')): $count=1; ?>
				<?php if(get_sub_field('table_of_contents_list_title_bheta_elearning')): ?>
					<h3><?php the_sub_field('table_of_contents_list_title_bheta_elearning'); ?></h3>
				<?php endif; ?>
				<ul class="anchors">
			<?php while(has_sub_field('table_of_contents_list_bheta_elearning')): $count++;?>								 
					<li><a title="<?php the_sub_field('table_of_contents_list_item_bheta_elearning'); ?>" class="dynamic_anchor" href="#anchor_<?php echo $count; ?>"><?php the_sub_field('table_of_contents_list_item_bheta_elearning'); ?></a></li>																	 
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?> <!-- table of contents -->
		
		<?php if( get_row_layout() == 'section_bheta_elearning' ):?>
			<?php if(get_sub_field('anchor_section_bheta_elearning')): $count=1; while(has_sub_field('anchor_section_bheta_elearning')): $count++;?>				<div class="toc_section">				 
					<h2 class=""><span id="anchor_<?php echo $count; ?>"><?php the_sub_field('anchor_section_title_bheta_elearning'); ?></span></h2>
					
					
					
					
	<?php if(get_sub_field('elearning_bheta_elearning')): ?>
 

 
	<?php while(has_sub_field('elearning_bheta_elearning')): ?>
 
    	
    	<h2 style="text-transform: none;margin-bottom:5px;font-size:18px" class="bheta_header_new"><?php the_sub_field('new_elearning_titletwo'); ?></h2>
    	<div class="bheta_new_description_wrapper">
    	<?php the_sub_field('new_elearning_descriptiontwo'); ?>
    	
    </div>
 
	<?php endwhile; ?>
 

 
<?php endif; ?>

					
					
					
					
					
	
					
					
					
			</div><!-- toc section -->																		 
				<?php endwhile; ?>	
																														 
			<?php endif; ?>
		<?php endif; ?>
		
		
	 <?php if( get_row_layout() == 'content_bheta_elearning' ): ?>
			<?php the_sub_field('regular_content_bheta_elearning'); ?>
		<?php endif; ?>
	
	
	<?php endwhile; ?>
<?php endif; ?>	






<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span title="Edit" class="edit-link">', '</span>' ); ?>

																									 

				
				
				
				
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
