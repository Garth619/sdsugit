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
			<div class="sidebar_wrapper">
				
				<?php get_sidebar(); ?>
				<?php get_sidebar('categories'); ?>
				
			</div><!-- sidebar wrapper -->
			<div class="content_wrapper">
			
			<div id="content">
					<h1>BHETA Calendar</h1>
					<?php include("my-calendar-loop.php"); ?>
			</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->
		
<?php get_footer(); ?>

