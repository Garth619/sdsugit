<?php
/**
 * Template Name: SACHS Lit Review
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
					<?php $sachslitreview = new WP_Query( array( 'post_type' => 'sachslitreview','order' => 'ASC') ); while($sachslitreview->have_posts()) : $sachslitreview->the_post(); ?>
         	 <?php include('my-litreview-loop.php');?>
         	 
          <?php endwhile; ?>
          <?php wp_reset_postdata(); // reset the query ?>
			
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
