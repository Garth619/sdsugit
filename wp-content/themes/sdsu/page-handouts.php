<?php
/**
 * Template Name: Handouts Main Page
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
		
		<div id="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<span class="breadcrumbs">','</span>');
} ?>
			
			<div class="content_wrapper">
				<div id="content">
					
					<h1><?php the_title();?></h1>
					
					
					<div class="handouts_wrapper">
					
					<h2><a href="<?php the_field('riverside_link');?>"><?php the_field('riverside_title');?>&nbsp;<span style="color:#B5936A;">>></span></a></h2>
					
					
					
				<?php the_field('riverside_description');?>
					
					
					<?php if(get_field('riverside_link_repeater')): ?>
 
						<div class="handout_inner_wrapper">
						
						<?php while(has_sub_field('riverside_link_repeater')): ?>
 
						<?php if(get_sub_field('new_window') == "No"):?>

							
							<h3><a href="<?php the_sub_field('repeater_link');?>"><?php the_sub_field('repeater_title');?>&nbsp;<span style="color:#B5936A;">>></span></a></h3>
							
						
					<?php endif;?>
					
					
					<?php if(get_sub_field('new_window') == "Yes"):?>

							
							<h3><a target="_blank" href="<?php the_sub_field('repeater_link');?>"><?php the_sub_field('repeater_title');?>&nbsp;<span style="color:#B5936A;">>></span></a></h3>
							
						
					<?php endif;?>
							
						
						
							<?php the_sub_field('repeater_description');?>
							
						
						<?php endwhile; ?>
 
						</div>
					
					<?php endif; ?>
					
					
					
				<hr>
				
				
				
				
				
				
				<h2><a href="<?php the_field('san_diego_page_link');?>"><?php the_field('san_diego_title');?>&nbsp;<span style="color:#B5936A;">>></span></a></h2>
					
					
					
				<?php the_field('san_diego_page_description');?>
					
					
					<?php if(get_field('san_diego_link_repeater')): ?>
 
						<div class="handout_inner_wrapper">
						
						<?php while(has_sub_field('san_diego_link_repeater')): ?>
 
						<?php if(get_sub_field('new_window') == "No"):?>

							
							<h3><a href="<?php the_sub_field('repeater_link');?>"><?php the_sub_field('repeater_title');?>&nbsp;<span style="color:#B5936A;">>></span></a></h3>
							
						
					<?php endif;?>
					
					
					<?php if(get_sub_field('new_window') == "Yes"):?>

							
							<h3><a target="_blank" href="<?php the_sub_field('repeater_link');?>"><?php the_sub_field('repeater_title');?>&nbsp;<span style="color:#B5936A;">>></span></a></h3>
							
						
					<?php endif;?>
							
						
						
							<?php the_sub_field('repeater_description');?>
							
						
						<?php endwhile; ?>
 
						</div>
					
					<?php endif; ?>
				
				
				
				
				

					
					
					</div><!-- handouts wrapper -->
					
										
					
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
