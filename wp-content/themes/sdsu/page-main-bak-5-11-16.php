<?php
/**
 * Template Name: Home Page Back up 5-11-16
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
<?php if(get_field('slideshow')): ?>
 <div class="cycle-slideshow" data-cycle-slides="> .slide" data-cycle-prev=".prev"
    data-cycle-next=".next">
		<?php while(has_sub_field('slideshow')): ?>
    	<div class="slide" style="background: url(<?php the_sub_field('slide_image'); ?>) no-repeat scroll center top / cover;">
				<div class="description_wrapper">
					<div class="description">
						<h1><?php the_sub_field('title'); ?></h1>
						<p><?php the_sub_field('description'); ?></p>
					</div><!-- description -->
				</div><!-- description_wrapper -->
				<div class="description_bg"></div><!-- description bg -->
			</div><!-- slide -->
     <?php endwhile; ?>
		<div class="slide_buttons"> 
					<div class="prev"></div>
					<div class="next"></div>
				</div><!-- slide_buttons -->
   </div><!-- cycle slideshow -->
<?php endif; ?>
<div class="main_inner">
	<div class="main_col main_col_1">
		<img class="main_page_logos afpe" alt="Academy For Professional Excellence" style="max-width:264px" src="<?php bloginfo( 'template_directory' ); ?>/images/logo-home.svg"/>
<!-- 		<img class="main_page_logos" alt="San Diego State University School Social Work" src="<?php bloginfo( 'template_directory' ); ?>/images/sdsu.svg"/> -->
		<div class="testimonial">
			<p class="testimonial_content"><?php the_field('tesimonial'); ?></p>
		</div><!-- testimonial -->
	</div><!-- main col -->
	<div class="main_col main_col_2">
		<h1>Areas of Service</h1>
		<?php if(get_field('areas_of_service')): ?>
		<ul>
			<?php while(has_sub_field('areas_of_service')): ?>
			<li class="tool_tip_hover">
				<?php the_sub_field('service_bullet_point'); ?>
				<img class="service_tri" alt="Hover - <?php the_sub_field('service_bullet_point'); ?>" src="<?php bloginfo( 'template_directory' ); ?>/images/hover.png"/>
				<?php if(get_sub_field('description')):?>
				<div class="tool_tip">
					<p><?php the_sub_field('description'); ?></p>
					<span class="tool_tip_close">Close</span>
				</div>
				<?php endif; ?>
			</li>
			<?php endwhile; ?>
 		</ul>
 		
 		<?php endif; ?>
		</div><!-- main col -->
	<div class="main_col main_col_3">
		<h1>Hot Topics</h1>
		<?php if(get_field('hot_topics')): ?>
			<?php while(has_sub_field('hot_topics')): ?>
				<div class="hot_topic">
					<?php $imageID = get_sub_field('image'); ?>
					<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
					<?php $hot_topic_image = wp_get_attachment_image_src(get_sub_field('image'), 'hot-topic'); ?>
           <img alt="<?php echo $alt_text; ?>" src="<?php echo $hot_topic_image[0]; ?>"/>
					<div class="hot_topic_content_wrapper">
						<h3><?php the_sub_field('hot_topic_title'); ?></h3>
						<?php the_sub_field('hot_topic_content'); ?>
					</div><!-- hot_topic_content_wrapper -->
				</div><!-- hot topic -->
			<?php endwhile; ?>
		<?php endif; ?>
	</div><!-- main_col -->
	<div class="main_col academy_col">
		<div class="academy_header">
		<h1><span>Academy Programs</span></h1>
		</div><!-- academy header -->
		<div class="academy_programs">
			
				<?php if( get_field('academy_programs') ): ?>
					
					<?php while(has_sub_field('academy_programs') ): ?>
						<?php if(get_sub_field('program_row') ): ?>
							<?php while(has_sub_field('program_row') ): ?>
								
							<div class="program_row">
							<div class="program_row_inner">
							<?php if( get_sub_field('program_title1') ): ?>
								<div class="academy_programs_wrapper">
									<div class="academy_programs_inner_wrapper">
										
										
										
										<?php $imageID = get_sub_field('image1'); ?>
										<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
										<?php $program_image = wp_get_attachment_image_src(get_sub_field('image1'), 'academy-programs'); ?>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link1'); ?>"><img alt="<?php echo $alt_text; ?>" src="<?php echo $program_image[0]; ?>"/></a>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link1'); ?>"><?php the_sub_field('program_title1'); ?></a>
										<?php if( get_sub_field('program_description1') ): ?>
										<a title="<?php echo $alt_text; ?>" class="main_program_description" href="<?php the_sub_field('program_link1'); ?>"><?php the_sub_field('program_description1'); ?></a>
										<?php endif; ?>
									</div><!-- academy_programs_inner_wrapper -->
								</div><!-- academy_programs_wrapper -->
							<?php endif; ?>
							
							
							
							<?php if( get_sub_field('program_title2') ): ?>
								<div class="academy_programs_wrapper">
									<div class="academy_programs_inner_wrapper">
										<?php $imageID = get_sub_field('image2'); ?>
										<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
										<?php $program_image = wp_get_attachment_image_src(get_sub_field('image2'), 'academy-programs'); ?>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link2'); ?>"><img alt="<?php echo $alt_text; ?>" src="<?php echo $program_image[0]; ?>"/></a>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link2'); ?>"><?php the_sub_field('program_title2'); ?></a>
										<?php if( get_sub_field('program_description2') ): ?>
										<a title="<?php echo $alt_text; ?>" class="main_program_description" href="<?php the_sub_field('program_link2'); ?>"><?php the_sub_field('program_description2'); ?></a>
										<?php endif; ?>
									</div><!-- academy_programs_inner_wrapper -->
								</div><!-- academy_programs_wrapper -->
							<?php endif; ?>
							</div><!-- program_row_inner -->
							
							<div class="program_row_inner">
							<?php if( get_sub_field('program_title3') ): ?>
								<div class="academy_programs_wrapper">
									<div class="academy_programs_inner_wrapper">
										<?php $imageID = get_sub_field('image3'); ?>
										<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
										<?php $program_image = wp_get_attachment_image_src(get_sub_field('image3'), 'academy-programs'); ?>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link3'); ?>"><img alt="<?php echo $alt_text; ?>" src="<?php echo $program_image[0]; ?>"/></a>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link3'); ?>"><?php the_sub_field('program_title3'); ?></a>
										<?php if( get_sub_field('program_description3') ): ?>
										<a title="<?php echo $alt_text; ?>" class="main_program_description" href="<?php the_sub_field('program_link3'); ?>"><?php the_sub_field('program_description3'); ?></a>
										<?php endif; ?>
									</div><!-- academy_programs_inner_wrapper -->
								</div><!-- academy_programs_wrapper -->
							<?php endif; ?>
							
							
							
							<?php if( get_sub_field('program_title4') ): ?>
								<div class="academy_programs_wrapper">
									<div class="academy_programs_inner_wrapper">
										<?php $imageID = get_sub_field('image4'); ?>
										<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
										<?php $program_image = wp_get_attachment_image_src(get_sub_field('image4'), 'academy-programs'); ?>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link4'); ?>"><img alt="<?php echo $alt_text; ?>" src="<?php echo $program_image[0]; ?>"/></a>
										<a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link4'); ?>"><?php the_sub_field('program_title4'); ?></a>
										<?php if( get_sub_field('program_description4') ): ?>
										<a title="<?php echo $alt_text; ?>" class="main_program_description" href="<?php the_sub_field('program_link4'); ?>"><?php the_sub_field('program_description4'); ?></a>
										<?php endif; ?>
									</div><!-- academy_programs_inner_wrapper -->
								</div><!-- academy_programs_wrapper -->
							<?php endif; ?>
							</div><!-- program _row_inner -->
							</div><!-- program row -->
						
							<?php endwhile; ?>
						<?php endif; ?>
					<?php endwhile; ?>
					
				<?php endif;?>	
		</div><!-- academy programs -->
	</div><!-- main_col -->
</div><!-- main_inner -->
<div style="display:none;">
	<?php include('my-access-notes-loop.php');?>
</div>
<?php get_footer(); ?>
