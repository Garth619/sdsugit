<?php
/**
 * Template Name: Mock Interviews
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

			
			<div class="content_wrapper" style="float:none;width:100%;">
				<div id="content">
					
					
					<h1 class="entry-title"><?php the_title();?></h1>
					
					
					<?php if ( post_password_required() ) : ?>


						<?php echo get_the_password_form();?>


							<?php else: ?>


							<h2><?php the_field('county_header');?></h2>


					
					
					<?php if(get_field('mock_interview_county')): ?>
					 
						
						
						<?php while(has_sub_field('mock_interview_county')): ?>
					 

					   <div class="county_wrapper">
					
						
						
						
						<span class="mock_interview_county"><?php the_sub_field('county_name');?></span><!-- mock_interview_county -->
						
						
						
						<?php if(get_sub_field('new_interview_row')): ?>
						 
							
							
							
							<?php while(has_sub_field('new_interview_row')): ?>
						 
							<div class="spokes_wrapper">
							
							
							<div class="spokes_col">
							
								<span class="mock_interview_titles"><?php the_sub_field('spokesperson');?></span><!-- mock_interview_titles -->
							
								<span class="mock_int_name"><?php the_sub_field('spokesperson_name');?></span><!-- mock_int_name -->
							
							</div><!-- spokes_col -->
							
							<div class="spokes_col">
							
								<span class="mock_interview_titles"><?php the_sub_field('reporter');?></span><!-- mock_interview_titles -->
							
								<span class="mock_int_name"><?php the_sub_field('reporter_name');?></span><!-- mock_int_name -->
							
							</div><!-- spokes_col -->
							
							
							
								
							<?php if(get_sub_field('media_relations_training')):?>
							
								<div class="spokes_col">
								
								
								<span class="mock_interview_titles"><?php the_sub_field('media_relations_title');?></span><!-- mock_interview_county -->
								
								
								<a href="<?php the_sub_field('media_relations_link');?>" target="_blank">
									
									<span>Click to View</span>
								
									<img class="mock_int_image" src="<?php the_sub_field('media_relations_training');?>"/>
								
								</a><!-- mock_int_image -->
								
								
								</div><!-- spokes_col -->
								
								
								<?php endif;?>
							
							<?php if(get_sub_field('board_of_supervisors_training')):?>
							
							<div class="spokes_col">
							
								<span class="mock_interview_titles"><?php the_sub_field('board_of_supervisors_title');?></span><!-- mock_interview_county -->
							
								<a href="<?php the_sub_field('board_of_supervisor_training_link');?>" target="_blank">
									
									<span>Click to View</span>
								
									<img class="mock_int_image" src="<?php the_sub_field('board_of_supervisors_training');?>"/>
								
								</a><!-- mock_int_image -->
								
								</div><!-- spokes_col -->
								
							
							<?php endif;?>
							
							
							</div><!-- spokes_wrapper -->
							
						    
							<?php endwhile; ?>
						 
						
							
						
						
						
						<?php endif; ?>
						
						
						
						
						
						
						
						
						
						</div><!-- county_wrapper -->
						
						
						<?php endwhile; ?>
					 
					
					
					
					
					
					<?php endif; ?>
					
					
					
					
					<?php endif;?> <!-- password -->
					
					
					
					
					
									
					
					
					
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
