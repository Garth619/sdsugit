<?php
/**
 * Template Name: PW Test */

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
					
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<?php the_content();?>
				
					<?php endwhile; // end of loop ?> 

				<?php endif; ?>

					
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
