<?php
/**
 * Template for displaying all single posts
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
			
			<div class="photowall_single_wrapper">
			
			<div id="content">
					
					<h1 style="margin-bottom:2px;"><?php the_title();?></h1>
					<h2><?php the_field('bio_position');?></h2>
					
					<div class="photowall_sidebar">
						
						
						<?php if(get_field('bio_location') == "San Diego Home Office"):?>
						
							<img class="pw_sidebar_symbol_img" src="<?php bloginfo('template_directory');?>/images/pw1.jpg"/>
						
						<?endif;?>
						
						<?php if(get_field('bio_location') == "Telecommuter"):?>
						
							<img class="pw_sidebar_symbol_img" src="<?php bloginfo('template_directory');?>/images/pw2.jpg"/>
						
						<?endif;?>
						
						<?php if(get_field('bio_location') == "Riverside Office"):?>
						
							<img class="pw_sidebar_symbol_img" src="<?php bloginfo('template_directory');?>/images/pw3.jpg"/>
						
						<?endif;?>
						
						
						
						
						<?php if(get_field('photo_wall_bio_pics')): ?>
 
							<div class="bio_image_single_wrapper">
							
							<?php while(has_sub_field('photo_wall_bio_pics')): ?>
							
								<img class="photowall_single_bio_img" src="<?php the_sub_field('image');?>">
    	 
							<?php endwhile; ?>
							
							</div><!-- bio_image_single_wrapper -->
 
						<?php endif; ?>
						
						
						
						
						
						<h2 class="strengths">Strengths</h2>
						
						
						<?php if(get_field('strengths')): ?>
						
							<ul class="strengths_list">
 
							<?php while(has_sub_field('strengths')): ?>
							
								<li><?php the_sub_field('strength_list');?></li>
    	 
							<?php endwhile; ?>
							
							</ul>
 
						<?php endif; ?>
						
						
					</div><!-- photowall_sidebar -->
					
					<div class="photowall_single_bio_content">
						
						<?php the_field('bio_content');?>
											
					</div><!-- photowall_single_bio_content -->
					
					
        
			</div><!-- content -->
			</div><!-- photowall_single_wrapper -->
			
		</div><!-- #container -->
		
<?php get_footer(); ?>
