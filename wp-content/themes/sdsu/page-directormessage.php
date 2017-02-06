<?php
/**
 * Template Name: Director's Message
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

		<div class="intranet_wrapper" style="margin:30px auto;">
			<h1 class="intranet_header"><?php the_title();?></h1>
				
				<div class="director_content_page">
					<?php the_field('director_message_content');?>
					<img src="<?php the_field('director_image');?>"/></div><br/>
					<strong>~Jen TT</strong>
				</div>

		</div><!-- intranet_wrapper -->


<?php get_footer('intranet'); ?>
