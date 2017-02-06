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
				<!-- search will go here -->
				
					<!--
<?php 
		
			$args = array();

			$args['wp_query'] = array('post_type' => array('page','sachsresearch','sachslitreview'),
			                                'posts_per_page' => 10,
			                                'order' => 'DESC',
			                                'orderby' => 'date');

			$args['fields'][] = array('type' => 'search',
			                                'label' => 'Search',
			                                'value' => '');

			$args['fields'][] = array('type' => 'post_type',
			                                'label' => 'Post Type',
			                                'values' => array('post' => 'Post', 'page' => 'Page'),
			                                'format' => 'select');				

			$args['fields'][] = array('type' => 'taxonomy',
				                                'label' => 'Category',
				                                'taxonomy' => 'category',
				                                'format' => 'multi-select',
				                                'operator' => 'AND');

			$args['fields'][] = array('type' => 'taxonomy',
				                                'label' => 'Tags',
				                                'taxonomy' => 'post_tag',
				                                'format' => 'checkbox',
				                                'operator' => 'IN');

			$args['fields'][] = array('type' => 'date',
			                                'label' => 'Month',
			                                'date_type' => 'month',
			                                'format' => 'multi-select');

			$args['fields'][] = array('type' => 'orderby',
                            				'label' => 'Order By',
                            				'values' => array('' => '', 'ID' => 'ID', 'title' => 'Title', 'date' => 'Date'),
                            				'format' => 'select');

			$args['fields'][] = array('type' => 'order',
                            				'label' => 'Order',
                            				'values' => array('' => '', 'ASC' => 'ASC', 'DESC' => 'DESC'),
                            				'format' => 'select');

			$args['fields'][] = array('type' => 'submit',
			                                'value' => 'Search');

			$my_search_object = new WP_Advanced_Search($args);

			$my_search_object->the_form();

			$temp_query = $wp_query;
			$wp_query = $my_search_object->query();

			if ( have_posts() ): 

				while ( have_posts() ): the_post();
				?>
					<div class="custom_post_type_wrapper">
            	<h2>
	            	<a href="<?php the_field('file_type'); ?>" target="_blank"><?php the_title(); ?></a>
	            </h2>
            	<p style="font-weight:400">Prepared By: <a href="<?php the_field('file_type'); ?>" target="_blank"><?php the_field('sachs_research_prepared_by'); ?></a>
	            </p>
            	<p style="font-weight:400">Purpose:</p> 
            	<a href="<?php the_field('file_type'); ?>" target="_blank"><?php the_field('sachs_research_purpose'); ?></a>
            	<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
         	 </div><!-- custom_post_type_wrapper -->
				<?php
				endwhile; 

			$my_search_object->pagination();

			else :

				echo 'Sorry, no posts matched your criteria.';

			endif;
			
			$wp_query = $temp_query;
			wp_reset_query();
		?>
-->
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
