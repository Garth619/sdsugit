<?php get_header(); ?>

<div id="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<span class="breadcrumbs">','</span>');
} ?>
			<div class="sidebar_wrapper">
				
				<?php get_sidebar(); ?>
				
			</div><!-- sidebar wrapper -->
			<div class="content_wrapper">
				<div id="content">
					
					
				
					
						<?php 
							
							// Academy Resources
							
							if(is_post_type_archive('academyresources')) {
							
							echo '<h1>Resources and Tools</h1>';}
							
							if(is_tax('academy-resources-categories')) {
								
								$term_title = wp_get_post_terms($post->ID, 'academy-resources-categories', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
							// Staff Directory
							
							if(is_post_type_archive('staffdirectory')) {
							
							echo '<div style="text-align:center"><a href="' . get_bloginfo('url') . '/staff-directory">Back to Directory</a><h2>Staff Biography</h2></div>'; }
								
							// BHETA Events
							
							if(is_post_type_archive('bhetaevents')) {
							
							echo '<h1>BHETA Calendar</h1>';}
							
							if(is_tax('bheta-events')) {
								
								$term_title = wp_get_post_terms($post->ID, 'bheta-events', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
							// BHETA Resources
							
							if(is_post_type_archive('bhetaresources')) {
							
							echo '<h1>BHETA Resources</h1>';}
							
							if(is_tax('bheta-resources-categories')) {
								
								$term_title = wp_get_post_terms($post->ID, 'bheta-resources-categories', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
							//BHETA Bios	
								
							if(is_post_type_archive('bhetabios')) {
							
							
							
							
							echo '<a href="' . get_bloginfo('url') . '/programs/bheta/bheta-calendar">Back to Calendar</a><h2>Tranier Biographies</h2>'; }
								
							// LIA Alumni
							
							if(is_post_type_archive('liaalumni')) {
							
							echo '<h1>LIA Alumni</h1>';}
							
							
							
							// Master Curriculum
							
							if(is_post_type_archive('mastercurriculum')) {
							
							echo '<h1>MASTER Core Curriculum</h1>'; }
							
							if(is_tax('master-curriculum-categories')) {
								
								$term_title = wp_get_post_terms($post->ID, 'master-curriculum-categories', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
								
								// Master Advanced Training
							
							if(is_post_type_archive('mastertraining')) {
							
							echo '<h1>MASTER Advanced Training</h1>'; }
							
							if(is_tax('master-training-categories')) {
								
								$term_title = wp_get_post_terms($post->ID, 'master-training-categories', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
							
							
							
							// PCWTA Curriculum
							
							if(is_post_type_archive('pcwtacurriculum')) {
							
							echo '<h1>PCWTA Curriculum</h1>'; }
							
							if(is_tax('pcwta-curriculum-categories')) {
								
								$term_title = wp_get_post_terms($post->ID, 'pcwta-curriculum-categories', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
							
							// PCWTA Lineworker
							
							if(is_post_type_archive('lineworkercore')) {
							
							
							
							
							
							echo '<h1>Lineworker Core</h1>';
							
							
							 }
							 
							 // PCWTA Supervisor
							
							if(is_post_type_archive('supervisorcore')) {
							
							
							
							
							
							echo '<h1>Supervisors Core</h1>';
							
							
							 }

							 // PCWTA Manager
							
							if(is_post_type_archive('managercore')) {
							
							
							
							
							
							echo '<h1>Manager Core</h1>';
							
							
							 }
							
							
							
							// PCWTA Bios
							
							if(is_post_type_archive('pcwtabios')) {
							
							
							
							
							echo '<a href="' . get_bloginfo('url') . '/programs/pcwta/trainer-bios/">Back to Directory</a><h2>Tranier Biographies</h2>'; }
							
							// PCWTA Newsletters
							
							if(is_post_type_archive('pcwtanewsletters')) {
							
							echo '<h1>PCWTA Newsletters</h1>'; }
								
							// SACHS Research
							
							if(is_post_type_archive('sachsresearch')) {
							
							echo '<h1>SACHS Research</h1>'; }
							
							// SACHS Lit Review
							
							if(is_post_type_archive('sachslitreview')) {
							
							echo '<h1>SACHS Literature Review</h1>'; }
							
							// SACHS Events
							
							if(is_post_type_archive('sachsevents')) {
							
							echo '<h1>SACHS Calendar</h1>'; }
							
							if(is_tax('sachs-events')) {
								
								$term_title = wp_get_post_terms($post->ID, 'sachs-events', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
								
							// Tribal Star Training Dates
							
							if(is_post_type_archive('tribalstarevents')) {
							
							echo '<h1>Tribal Star Events</h1>';}
							
							if(is_tax('tribal-star-training-dates')) {
								
								$term_title = wp_get_post_terms($post->ID, 'tribal-star-training-dates', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
								
						// Tribal Star Resources
							
							if(is_post_type_archive('tribalstarresources')) {
							
							echo '<h1>Tribal Star Resources</h1>';}
							
							if(is_tax('tribal-star-resources-categories')) {
								
								$term_title = wp_get_post_terms($post->ID, 'tribal-star-resources-categories', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
								
								
						
						// Tribal Star Events and Conferences
							
							if(is_post_type_archive('tribalstarconf')) {
							
							echo '<h1>Tribal Star Events and Conferences</h1>';}
							
							if(is_tax('tribal-star-event')) {
								
								$term_title = wp_get_post_terms($post->ID, 'tribal-star-event', array("fields" => "names"));
								
								echo '<h1>' . $term_title[0] . '</h1>'; }
						
						
						
							
							get_template_part( 'loop', 'archive' ); ?>
				
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
			</div><!-- content wrapper -->
		</div><!-- #container -->


<?php get_footer(); ?>






















