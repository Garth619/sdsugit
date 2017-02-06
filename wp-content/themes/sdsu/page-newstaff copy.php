<?php
/**
 * Template Name: New Staff
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

		<div class="intranet_wrapper">
			<div class="intranet_wrapper_inner">
				<div class="intranet_inner_section">
					<div class="intranet_single_section left_section">
						<h1 class="intranet_header">Welcome <?php global $current_user; get_currentuserinfo(); echo $current_user->user_firstname;?>!</h1>
						<div class="cycle-slideshow-intrnanet">
							<div class="slide_image_wrapper">
								<img class="welcome_slide" src="<?php the_field('new_staff_banner'); ?>"/>
								<?php if(get_field('banner_description')): ?>
									<div class="slide_banner">
										<span><?php the_field('banner_description'); ?></span>
									</div><!-- slide_banner -->
								<?php endif;?>
							</div><!-- slide_image -->
							
						</div><!-- slideshow -->
						
						<div class="slide_content" style="margin-bottom:35px;">
								<?php the_field('new_staff_content'); ?>
							</div><!-- slide_content -->
						
						</div><!-- intranet_single_section -->
						
						
						
					<div class="intranet_single_section right_section">
					<h1 class="intranet_header">Additional Resources</h1>
					<div class="intranet_toggle" style="padding-top:10px;display: block">
						
							
								
								<?php if(get_field('new_staff_additional_resources')): ?>
 
						<div class="resource_wrapper new_staff_resource_wrapper">
							
							<?php while(has_sub_field('new_staff_additional_resources')): ?>
 
							
							<div class="intranet_resource new_staff_resource" title="<?php the_sub_field('hover_text'); ?>">
								
								
								
								<?php 

$selected = get_sub_field('open_in_new_tab');

if( in_array('Yes', $selected) ) :?>
	
	<a href="<?php the_sub_field('resource_link'); ?>" target="_blank"><img class="resource_image new_staff_resource_image" src="<?php the_sub_field('resource_icon'); ?>"/></a>
								<a href="<?php the_sub_field('resource_link'); ?>" class="resources_title new_staff_resource_title" target="_blank"><?php the_sub_field('resource_title'); ?></a>
	
	

<?php else:?>


<a href="<?php the_sub_field('resource_link'); ?>"><img class="resource_image new_staff_resource_image" src="<?php the_sub_field('resource_icon'); ?>"/></a>
								<a href="<?php the_sub_field('resource_link'); ?>" class="resources_title new_staff_resource_title"><?php the_sub_field('resource_title'); ?></a>



<?php endif;?>
								
								
								
							
							
							
							
							
							</div><!-- intranet_resource -->
							
														
							
 
							<?php endwhile; ?>
							
							</div><!-- resource_wrapper -->
 
						<?php endif; ?>
								
								
								
								
								
								
														
							
						</div><!-- resource_wrapper -->
					</div><!-- intranet_toggle -->
				</div><!-- intranet_single_section -->
					
								

			
			
		</div><!-- intranet_wrapper_inner -->
	</div><!-- intranet_wrapper -->
		
</main>
			

						


<?php get_footer('intranet'); ?>
