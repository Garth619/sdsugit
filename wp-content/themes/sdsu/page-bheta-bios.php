<?php
/**
 * Template Name: BHETA Bios
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
				<div id="content">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php get_template_part( 'loop', 'page' ); ?>
					<hr/>
					
<?php $bhetabios= new WP_Query( array( 'post_type' => 'bhetabios','order' => 'ASC' ) ); while($bhetabios->have_posts()) : $bhetabios->the_post(); ?>
            <?php include("my-bhetabios-loop.php"); ?>
           <?php endwhile; ?>
            <?php wp_reset_postdata(); // reset the query ?>

				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
