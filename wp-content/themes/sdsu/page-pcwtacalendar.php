<?php
/**
 * Template Name: PCWTA Calendar
 *

 */

get_header(); ?>
		
		<div id="container">

<span style="border-bottom: 1px solid #ccc;display: block;font-size: 13px;font-weight: 400;margin: 20px 0 23px;padding: 0 0 0.3em;width: 100%;"></span>

			<div class="sidebar_wrapper">
				<?php get_sidebar(); ?>
			</div><!-- sidebar wrapper -->
			<div class="content_wrapper">
				<div id="content">
					<h1 class="entry-title">PCWTA Calendar</h1>
					<?php get_template_part( 'loop', 'page' ); ?>
					

				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
<!-- padding-top: 38px; -->