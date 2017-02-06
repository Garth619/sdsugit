<?php
/**
 * Template for displaying all single posts
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
			<div id="content" style="min-height:300px;">
					
					
         	 <div class="custom_post_type_wrapper">
            	<?php
			/* Run the loop to output the post.
			 * If you want to overload this in a child theme then include a file
			 * called loop-single.php and that will be used instead.
			 */
			get_template_part( 'loop', 'single' );
			?>
         	 </div><!-- custom_post_type_wrapper -->
        
					
				</div><!-- content -->
		</div><!-- #container -->
		
<?php get_footer(); ?>
