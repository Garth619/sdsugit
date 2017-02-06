<?php
/**
 * Template Name: Contact Us
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
				<div id="content" class="contact_content" style="border-bottom:none;">
					<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php get_template_part( 'loop', 'page' ); ?>
					
					
				</div><!-- content -->
				<div class="contact_sidebar">
					<div class="image_wrapper">
						<?php the_field('google_map');?>
					</div><!-- image_wrapper -->
					<div class="image_wrapper">
						<div class="contact_banner">
							<span class="banner_text">Staff Directory</span>
						</div><!-- contact banner -->
						<?php $imageID = get_field('staff_picture'); ?>
						<?php $alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true); ?>
						<?php $staff_picture = wp_get_attachment_image_src(get_field('staff_picture'), 'full'); ?>
						<img alt="<?php echo $alt_text; ?>" src="<?php echo $staff_picture[0]; ?>"/>
						<span class="image_description">Staff contact information and biographies.</span><br/>
						<div class="view">
							<a title="View the Staff Directory" href="<?php bloginfo( 'url' ); ?>/staff-directory/">View</a>
						</div><!-- view -->
					</div><!-- image_wrapper -->
				</div><!-- contact sidebar -->
				<hr/>
				<a href="#top" class="back_to_top" title="Back to Top" style="clear:both;">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
