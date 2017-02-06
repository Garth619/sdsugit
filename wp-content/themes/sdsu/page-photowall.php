<?php
/**
 * Template Name: Staff Intranet Photo Wall Template
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

get_header('intranet'); ?>

		<div class="intranet_wrapper" style="margin-top:20px;">
			<h1 class="intranet_header"><?php the_title();?></h1>
				
				<div id="content" class="photowall">
				
				<div class="photowall_top_half">
					
					<?php the_field('photo_wall_content');?>
					
				</div>
				
				<div class="symbol_key_images photowall_top_half" style="display:none;">
					<h2>Symbol Key</h2>
					<div class="symbol_img_wrapper">
						<img src="<?php bloginfo('template_directory');?>/images/pw1.jpg"/>
						<span>San Diego Home Office</span>
					</div><!-- symbol_img_wrapper -->
					<div class="symbol_img_wrapper">
						<img src="<?php bloginfo('template_directory');?>/images/pw2.jpg"/>
						<span>Telecommuter</span>
					</div><!-- symbol_img_wrapper -->
					<div class="symbol_img_wrapper">
						<img src="<?php bloginfo('template_directory');?>/images/pw3.jpg"/>
						<span>Riverside Office</span>
					</div><!-- symbol_img_wrapper -->
				</div><!-- symbol_key_images -->
				
			
			
			<?php if(get_field('photo_wall_groups')): ?>
 
				<div class="photowall_section">
 
				<?php while(has_sub_field('photo_wall_groups')): ?>
				
					<h2><?php the_sub_field('name_of_bio_group');?></h2>
					
					<div class="photowall_bio_wrapper">
 
					<?php if(get_sub_field('bios')) : ?>
        	
    	
					<?php while(has_sub_field('bios')): ?>
					
					
						
						<div class="single_photowall_bio">
							
							<?php $photowallimg = wp_get_attachment_image_src(get_sub_field('photo_wall_image'), 'thumbnail'); ?>
            	<a href="<?php the_sub_field('link');?>"><img src="<?php echo $photowallimg[0]; ?>"/></a>
							<a href="<?php the_sub_field('link');?>"><?php the_sub_field('name');?></a>
						</div><!-- single_photowall_bio -->
    	
    	
				<?php endwhile; ?>
    	
    	<?php endif; ?>
    	
    	</div><!-- photowall_bio_wrapper -->
 
	<?php endwhile; ?>
	
					
 
				</div><!-- photowall_section -->
 
<?php endif; ?>

			
			
			
			
			
			
				
				
				
				
				</div><!-- photowall content -->
				
		</div><!-- intranet_wrapper -->


<?php get_footer('intranet'); ?>
