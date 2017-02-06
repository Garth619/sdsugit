<?php
/**
 * Template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container" style="max-width:1105px;margin:35px auto;">
			<div id="content" role="main">
				


<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				
				<?php
				
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>
<?php endif; ?>

<div style="margin-top:15px">
<?php include("my-access-notes-loop.php"); ?>
</div>
			</div><!-- #content -->
			<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
		</div><!-- #container -->


<?php get_footer(); ?>
