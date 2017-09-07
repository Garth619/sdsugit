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
			
			<div class="content_wrapper" style="float:none;width:100%;">
				<div id="content">
					<div style="text-align:center">
						<a href="<?php bloginfo('url');?>/programs/sdigec/student-stipend-recipients">Back to Student Stipend Recipients</a>
							<h2>Stipend Recipient's Biography</h2>
						</div>
						<?php include('my-sdigec-recipients-singles-loop.php');?>

				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->
		
			
<?php get_footer(); ?>
