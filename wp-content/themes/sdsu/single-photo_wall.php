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
			<span class="breadcrumbs"><a href="<?php bloginfo('url');?>/academy-photo-wall">Back to the Photo Wall</a></span>			
			<div class="content_wrapper" style="width:100%;">
				<div id="content">
					
					
					
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				
					<h1 class="entry-title"><?php the_title(); ?></h1>

					
					
						<?php the_content(); ?>
						


						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
			

				

<?php endwhile; // end of the loop. ?>

					
					
					
					
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->

		
<?php get_footer(); ?>
