<?php
/**
 * Template Name: Intranet FAQs
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
		
		<div id="container-custom">
			<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<span class="breadcrumbs">','</span>');
} ?>
			
			
			
			
			
			
			<div class="content_wrapper">
				<div id="content">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php get_template_part( 'loop', 'page' ); ?>
					<?php if(get_field('faqs')): ?>
						<?php while(has_sub_field('faqs')): ?>
							<div class="faq_wrapper">
								<h3 class="faq_question"><?php the_sub_field('question'); ?></h3>
								<div class="faq_answer">
								<?php the_sub_field('answer'); ?>
								</div><!-- faq_answer -->
							</div><!-- faq wrapper -->
						<?php endwhile; ?>
					<?php endif; ?>
					
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer('intranet'); ?>
