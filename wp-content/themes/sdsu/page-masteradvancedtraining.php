<?php
/**
 * Template Name: Master Advanced Training
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

get_header(); ?>
		
		<div id="container">
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
					 <?php //start by fetching the terms for the taxonomy
$terms = get_terms( 'master-training-categories', array(
    // 'orderby'    => 'count',
    'hide_empty' => 1 // use 0 if you want to display all. use this section to tweak order
) );
?>
				
				<?php
// now run a query for each category
foreach( $terms as $term ) {
 
    // Define the query
    $args = array(
        'post_type' => 'mastertraining',
        'master-training-categories' => $term->slug,
         'order' => 'ASC'
    );
    $query = new WP_Query( $args );
    
    echo '<div class="category_wrapper" style="border-bottom: 1px solid #ccc;margin-bottom:18px">';
             
    // output the term name in a heading tag                
    echo'<h2>' . $term->name . '</h2>';
     
    
     // Start the Loop
        while ( $query->have_posts() ) : $query->the_post(); ?>
 
        <?php include("my-curriculum-loop.php"); ?>
         
        <?php endwhile;
     
				echo '</div>';
     
    // use reset postdata to restore orginal query
    wp_reset_postdata();
    
    
 
} ?>	
         
        

				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>
