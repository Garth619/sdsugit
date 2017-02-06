<?php
/**
 * Template Name: Staff Intranet Upcoming Events
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

get_header('intranet'); ?>

		<div class="intranet_wrapper" style="margin-top:20px;">
			<h1 class="intranet_header"><?php the_title();?></h1>
				
				<?php get_template_part( 'loop', 'page' ); ?>

		</div><!-- intranet_wrapper -->


<?php get_footer('intranet'); ?>
