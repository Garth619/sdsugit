<?php
/**
 * Template Name: PCWTA Cirriculum
 *

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
					<?php
				
			$linkpath = get_bloginfo('url');
		
			$args = array();
			
			$args['relevanssi'] = true;
			
			$args['form'] = array('action' => $linkpath . '/programs/pcwta/pcwta-curriculum/pcwta-cirriculum-search-results-page');

			$args['wp_query'] = array('post_type' => 'pcwtacurriculum',
			                                //'posts_per_page' => 999,
			                                'order' => 'ASC',
			                                'orderby' => 'name');
			                                
			

			$args['fields'][] = array('type' => 'search',
			                                'label' => 'Search by Keywords:',
			                                'value' => '');

			$args['fields'][] = array('type' => 'taxonomy',
				                                // 'label' => 'Search by Category:',
				                                'taxonomy' => 'pcwta-curriculum-categories',
				                                'format' => 'radio',
				                                'operator' => 'AND');
      

			$args['fields'][] = array('type' => 'submit',
			                                'value' => 'Search');
			                                
			

			$my_search_object = new WP_Advanced_Search($args); ?>

			
			<?php $my_search_object->the_form(); { ?> 
				<a title="Reset the Search Filter" class="search_reset" href="<?php bloginfo( 'url') ?>/programs/pcwta/pcwta-curriculum">Reset</a><br/><hr style="margin:17px 0;"/>
			<?php } ?>
			
			
			<?php //start by fetching the terms for the taxonomy
$terms = get_terms( 'pcwta-curriculum-categories', array(
    // 'orderby'    => 'count',
    'hide_empty' => 1 // use 0 if you want to display all. use this section to tweak order
) );
?>
				
				<?php
// now run a query for each category
foreach( $terms as $term ) {
 
    // Define the query
    $args = array(
        'post_type' => 'pcwtacurriculum',
        'pcwta-curriculum-categories' => $term->slug
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
