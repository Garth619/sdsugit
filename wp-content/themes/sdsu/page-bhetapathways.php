<?php
/**
 * Template Name: BHETA Pathways
 *

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
				<div id="content" style="overflow:hidden">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<div class="col_pathways">
						<?php the_field('col_1');?>
					</div><!-- col_pathways -->
					<div class="col_pathways">
						<?php the_field('col_2');?>
					</div><!-- col_pathways -->

				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
