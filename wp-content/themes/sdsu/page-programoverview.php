<?php
/**
 * Template Name: Program Overview
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
			<div class="sidebar_wrapper">
				<?php get_sidebar(); ?>
			</div><!-- sidebar wrapper -->
			<div class="content_wrapper">
				<div id="content">
					<h1><?php the_title(); ?></h1>
					<?php
				/*
				 * Run the loop to output the page.
				 * If you want to overload this in a child theme then include a file
				 * called loop-page.php and that will be used instead.
				 */
				get_template_part( 'loop', 'page' );
				?>
				</div><!-- content -->
				<?php if(get_field('programs')): ?>
					<?php while(has_sub_field('programs')): ?>
						<div class="program_overview">
							
							
						


							
							<?php $imageID = get_sub_field('program_image'); ?>
							<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
							
							<?php $program_image = wp_get_attachment_image_src(get_sub_field('program_image'), 'full'); ?>
                <a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link'); ?>"><img alt="<?php echo $alt_text; ?>" src="<?php echo $program_image[0]; ?>"/></a>
								<div class="overview_content">
								<h3><a title="Explore <?php echo $alt_text; ?>" href="<?php the_sub_field('program_link'); ?>"><?php the_sub_field('program_title'); ?></a></h3>
								<p><a title="<?php echo $alt_text; ?>" href="<?php the_sub_field('program_link'); ?>"><?php the_sub_field('program_description'); ?></a></p>
						</div><!-- overview content -->
				</div><!-- program overview -->
					<?php endwhile; ?>
				<?php endif; ?>
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
