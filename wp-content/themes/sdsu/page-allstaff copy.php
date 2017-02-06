<?php
/**
 * Template Name: All Staff
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
						<a href="<?php bloginfo( 'url' ); ?>/20th-anniversary"><img class="academy_logo svg" alt="Academy For Professional Excellence" style="max-width:264px" src="<?php bloginfo( 'template_directory' ); ?>/images/newlogo.jpg"/></a>
						<img class="sdsu_logo svg" alt="San Diego State University School Social Work" src="<?php bloginfo( 'template_directory' ); ?>/images/sdsu.svg"/>
						
						<div class="director_image_wrapper">
							<img class="director_image" src="<?php the_field('director_image', 3927); ?>"/>
						</div><!-- director_image_wrapper -->
						<div class="director_content">
							<h2 class="intranet_sub_header"><?php the_field('director_message_title', 3927); ?></h2>
								<?php the_field('director_excerpt', 3927); ?>
								<a class="intranet_read_more read_more_director" href="<?php bloginfo('url');?>/staff-intranet/directors-message/">Read More<img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a>
						</div><!-- director_content -->
						</div><!-- intranet_single_section -->
					
					
					<div class="intranet_single_section right_section">
						<h1 class="intranet_header header_toggle">Upcoming Events</h1>
						<div class="intranet_toggle">
							<div class="featured_event_wrapper">
							
							 <iframe id="myagenda_iframe" src="https://www.google.com/calendar/embed?mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=mail.sdsu.edu_2d34313638373536302d393636%40resource.calendar.google.com&amp;color=%23125A12&amp;ctz=America%2FLos_Angeles" style="border-width:0" frameborder="0" scrolling="no"></iframe>
							 
							 
<!--
							 
							 <div class="featured_event">
<img class="featured_event_image" src="<?php the_field('events_image'); ?>"/>
									<p><?php the_field('events_excerpt'); ?></p>

								</div>
								<div class="featured_event">
<img class="featured_event_image" src="<?php the_field('events_image_two'); ?>"/>
									<p><?php the_field('events_excerpt_two'); ?></p>

								</div>
-->

							 
							
							
							</div><!-- featured event wrapper -->
<!-- 							<a class="intranet_read_more see_all" href="<?php bloginfo('url');?>/staff-intranet/upcoming-events">See All Upcoming Events <img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a> -->
						</div><!-- intranet_toggle -->
					</div><!-- intranet_single_section -->
				</div><!-- intranet_inner_section -->
			
			<div class="intranet_inner_section">
				<div class="intranet_single_section left_section">
					<h1 class="intranet_header header_toggle">Staff Forum</h1>
						<div class="intranet_toggle">
							<?php echo do_shortcode('[bbp-forum-index]'); ?>
						</div><!-- intranet_toggle -->
				</div><!-- intranet_single_section -->
			<div class="intranet_single_section right_section">
					<h1 class="intranet_header header_toggle my_youtube">Youtube Videos</h1>
						<div class="intranet_toggle">
							<a class="intranet_read_more see_all" style="margin-bottom:20px;border-top:none;padding-top:0px;" href="https://www.youtube.com/channel/UCn4_PgokJtA6HgrxJlHqtsA" target="_blank">Visit Our Youtube Channel <img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a>
							<?php echo do_shortcode('[youtube_channel]'); ?>
						</div><!-- intranet_toggle -->
					</div><!-- intranet_single_section -->
			</div><!-- intranet_inner_section -->
			
			
			<div class="intranet_inner_section">
				<div class="intranet_single_section resources_desktop_width">
					<h1 class="intranet_header header_toggle">Additional Resources</h1>
					<div class="intranet_toggle" style="padding-top:10px;">
						
						<?php if(get_field('all_staff_additional_resources')): ?>
 
							<div class="resource_wrapper">
							
							<?php while(has_sub_field('all_staff_additional_resources')): ?>
 
							
							<div class="intranet_resource" title="<?php the_sub_field('hover_text'); ?>">
								
								<?php 

$selected = get_sub_field('open_in_new_tab');

if( in_array('Yes', $selected) ) :?>
	
	
<a href="<?php the_sub_field('resource_link'); ?>" target="_blank"><img class="resource_image" src="<?php the_sub_field('resource_icon'); ?>"/></a>
								<a href="<?php the_sub_field('resource_link'); ?>" class="resources_title" target="_blank"><?php the_sub_field('resource_title'); ?></a>

<?php else:?>

<a href="<?php the_sub_field('resource_link'); ?>"><img class="resource_image" src="<?php the_sub_field('resource_icon'); ?>"/></a>
								<a href="<?php the_sub_field('resource_link'); ?>" class="resources_title"><?php the_sub_field('resource_title'); ?></a>


<?php endif;?>
								
								
							</div><!-- intranet_resource -->
							
 
							<?php endwhile; ?>
							
							</div><!-- resource_wrapper -->
 
						<?php endif; ?>
						
						</div><!-- intranet_toggle -->
				</div><!-- intranet_single_section -->
			</div><!-- intranet_inner_section -->
			
			
		</div><!-- intranet_wrapper_inner -->
	</div><!-- intranet_wrapper -->
		
</main>
			<div class="intranet_inner_section quicklinks_inner_section">
				<div class="intranet_single_section quicklinks">
					<div class="quick_links_inner_wrapper">
						<h1 class="intranet_header header_toggle">Quick Links</h1>
						<div class="intranet_toggle">
							
							<?php if(get_field('quick_links')): ?>
 
								<ul class="quick_links_list">
							
								<?php while(has_sub_field('quick_links')): ?>
 
							
								<li><a href="<?php the_sub_field('list_item_link'); ?>" target="_blank"><?php the_sub_field('list_item_title'); ?> <img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a></li>
															
 
								<?php endwhile; ?>
							
								</ul><!-- quick_links_list -->
 
						<?php endif; ?>
						
						
						
						
						
						<?php if(get_field('quick_links_two')): ?>
 
								<ul class="quick_links_list">
							
								<?php while(has_sub_field('quick_links_two')): ?>
 
							
								<li><a href="<?php the_sub_field('list_item_link'); ?>" target="_blank"><?php the_sub_field('list_item_title'); ?> <img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a></li>
															
 
								<?php endwhile; ?>
							
								</ul><!-- quick_links_list -->
 
						<?php endif; ?>
						
						
						
						
						
						<?php if(get_field('quick_links_three')): ?>
 
								<ul class="quick_links_list">
							
								<?php while(has_sub_field('quick_links_three')): ?>
 
							
								<li><a href="<?php the_sub_field('list_item_link'); ?>" target="_blank"><?php the_sub_field('list_item_title'); ?> <img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a></li>
															
 
								<?php endwhile; ?>
							
								</ul><!-- quick_links_list -->
 
						<?php endif; ?>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
													
						</div><!-- intranet_toggle -->
					</div><!-- quick_links_inner_wrapper -->
				</div><!-- intranet_single_section -->
			</div><!-- intranet_inner_section -->

<!--
						<h1 class="intranet_header">Welcome User</h1>
						<img class="welcome_slide" src="<?php bloginfo('template_directory');?>/images/intranet-example.jpg"/>
-->

<?php get_footer('intranet'); ?>
