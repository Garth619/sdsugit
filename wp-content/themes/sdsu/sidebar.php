<?php
/**
 * Sidebar template 
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>



<?php global $post;
					
					if ( 
					
					// Pages
					is_page(10) || $post->post_parent==10 || is_page(796) || $post->post_parent==949
					
					// Resources
					|| is_post_type_archive('bhetaresources') || is_singular('bhetaresources') 
					
					// Events
					|| is_post_type_archive('bhetaevents') || is_singular('bhetaevents') || is_tax('bheta-resources-categories')) 
					
					{ 
						
						$imageID = get_field('bheta_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('bheta_sidebar_image','option'),'full');
						
						echo '<img class="sidebar_program_banner" style="margin-bottom:16px;" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
						
						$imagetwoID = get_field('lms_sidebar_image','option');
						$alt_texttwo = get_post_meta($imagetwoID , '_wp_attachment_image_alt', true);
						$sidebartwo = wp_get_attachment_image_src(get_field('lms_sidebar_image','option'),'full');
						$sidebarimage = get_bloginfo('template_directory');
						
						echo '<span class="browse lms_title">LMS Login</span><a class="lms_img" title="LMS Login" target="_blank" href="https://academy.sumtotal.host/broker/Account/Login.aspx?wtrealm=https%3A%2F%2FACADEMY.sumtotal.host%2Fcore%2F&init=true&domainid=6414A1F8CEA393B7A1E609CAA96B0702"><img class="sidebar_program_banner" alt="LMS Login" src="' . $sidebarimage . '/images/sidebar.png"/></a>';
												
												
					} ?>



<div class="sidebar" role="complementary">
	<?php wp_nav_menu(array(
		'theme_location' => 'primary',
		'walker' => new Walker_SubNav_Menu(), // with ID
	)); ?>
</div><!-- sidebar -->

<?php global $post; if (is_tax( 'academy-resources-categories' ) || is_post_type_archive('academyresources') || is_singular('academyresources') || is_page(72) || $post->post_parent==72 || is_page(815) || is_post_type_archive('academyresources')) { ?>
<!-- Academy Resources and Tools -->
	<a href="<?php bloginfo( 'url' ); ?>/resources-and-tools" class="browse">Search Resources and Tools</a>
	<span class="browse">Browse Resource Categories</span>
	<div class="sidebar">
<?php $terms = get_terms( 'academy-resources-categories' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
  $term_link = get_term_link( $term );
  $class = $currentterm->slug == $term->slug ? 'current_category' : '' ;
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<!-- End of Academy Resources and Tools -->
<?php } ?>




<?php global $post; if (is_tax( 'bheta-events' ) || is_post_type_archive('bhetaevents') || is_singular('bhetaevents') || is_page(42)) { ?>
<!-- BHETA Events -->
	<span class="browse">Browse By Month:</span>
	<div class="sidebar" role="complementary">
<?php

$terms = get_terms( 'bheta-events' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
  $class = $currentterm->slug == $term->slug ? 'current_category' : '' ; // i dont know how but i got this to work
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>


<?php global $post; if (is_tax( 'bheta-resources-categories' ) || is_post_type_archive('bhetaresources') || is_singular('bhetaresources') || is_page(44) || is_page(796)) { ?>
<!-- BHETA Resources -->
	<a href="<?php bloginfo( 'url' ); ?>/programs/bheta/bheta-resources" class="browse">Search BHETA Resources</a>
	<span class="browse">Browse Resource Categories</span>
	<div class="sidebar" role="complementary">
<?php $terms = get_terms( 'bheta-resources-categories' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
	$class = $currentterm->slug == $term->slug ? 'current_category' : '' ; // i dont know how but i got this to work
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>








<!--

<?php global $post; if (is_page(949)) { ?>

	<span class="browse">CCA Menu</span>
	<div class="sidebar" role="complementary">
		<?php $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0"); ?>
		<ul>
			<?php echo $children; ?>
  	</ul>
	</div>
<?php } ?>

<?php global $post; if ($post->post_parent==949) { ?>
	<span class="browse">CCA Menu</span>
	<div class="sidebar" role="complementary">
		<?php $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); ?>
		<ul>
			<?php echo $children; ?>
  	</ul>
	</div>
<?php } ?>
-->



<!--
<?php global $post; if (is_page(953)) { ?>

	<span class="browse">Pathways Menu</span>
	<div class="sidebar" role="complementary">
		<?php $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0"); ?>
		<ul>
			<?php echo $children; ?>
  	</ul>
	</div>
<?php } ?>

<?php global $post; if ($post->post_parent==953) { ?>
	<span class="browse">Pathways Menu</span>
	<div class="sidebar" role="complementary">
		<?php $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); ?>
		<ul>
			<?php echo $children; ?>
  	</ul>
	</div>
<?php } ?>
-->




<!--
<?php global $post; if (is_page(994)) { ?>

	<span class="browse">R2R Menu</span>
	<div class="sidebar" role="complementary">
		<?php $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0"); ?>
		<ul>
			<?php echo $children; ?>
  	</ul>
	</div>
<?php } ?>

<?php global $post; if ($post->post_parent==994) { ?>
	<span class="browse">R2R Menu</span>
	<div class="sidebar" role="complementary">
		<?php $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); ?>
		<ul>
			<?php echo $children; ?>
  	</ul>
	</div>
<?php } ?>
-->








<?php global $post; 
	
	if (
	// Pages
	is_page(130) ||
	
	is_tax( 'master-curriculum-categories' ) || is_post_type_archive('mastercurriculum') || is_singular('mastercurriculum')) 
	
	{ ?>
	<!-- MASTER Cirriculum -->
	
	<span class="browse">Browse Curriculum</span>
	<div class="sidebar" role="complementary">
		
<?php $terms = get_terms( 'master-curriculum-categories' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	$class = $currentterm->slug == $term->slug ? 'current_category' : '' ;
	// The $term is an object, so we don't need to specify the $taxonomy.
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>




<?php global $post; 
	
	if (
	// Pages
	is_page(132) ||
	
	is_tax( 'master-training-categories' ) || is_post_type_archive('mastertraining') || is_singular('mastertraining')) 
	
	{ ?>
	<!-- MASTER Advanced Training -->
	
	<span class="browse">Browse Training</span>
	<div class="sidebar" role="complementary">
		
<?php $terms = get_terms( 'master-training-categories' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	$class = $currentterm->slug == $term->slug ? 'current_category' : '' ;
	// The $term is an object, so we don't need to specify the $taxonomy.
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>



<?php global $post; 
	
	if (
	// Pages
	is_page(149) || is_page(855) ||
	
	is_tax( 'pcwta-curriculum-categories' ) || is_post_type_archive('pcwtacurriculum') || is_singular('pcwtacurriculum')) 
	
	{ ?>
	
<!-- PCWTA Cirriculum -->
	
	<a href="<?php bloginfo( 'url' ); ?>/programs/pcwta/pcwta-curriculum" class="browse">Search PCWTA Curriculum</a>
	<span class="browse">Browse Curriculum</span>
	<div class="sidebar" role="complementary">
		
<?php $terms = get_terms( 'pcwta-curriculum-categories' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	$class = $currentterm->slug == $term->slug ? 'current_category' : '' ;
	// The $term is an object, so we don't need to specify the $taxonomy.
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>


<?php global $post; if (is_tax( 'sachs-events' ) || is_post_type_archive('sachsevents') || is_singular('sachsevents') || is_page(189)) { ?>
<!-- SACHS Events -->
	<span class="browse">Browse By Month:</span>
	<div class="sidebar" role="complementary">
<?php

$terms = get_terms( 'sachs-events' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
  $class = $currentterm->slug == $term->slug ? 'current_category' : '' ; // i dont know how but i got this to work
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>


<?php global $post; if (is_tax( 'tribal-star-training-dates' ) || is_post_type_archive('tribalstarevents') || is_singular('tribalstarevents') || is_page(1047)) { ?>
<!-- Tribal Star Training Dates -->
	<span class="browse">Browse By Month:</span>
	<div class="sidebar" role="complementary">
<?php

$terms = get_terms( 'tribal-star-training-dates' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
  $class = $currentterm->slug == $term->slug ? 'current_category' : '' ; // i dont know how but i got this to work
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>




<?php global $post; if (is_tax( 'tribal-star-resources-categories' ) || is_post_type_archive('tribalstarresources') || is_singular('tribalstarresources') || is_page(222) || is_page(1084)) { ?>
<!-- Tribal Star Resources -->
	<a href="<?php bloginfo( 'url' ); ?>/programs/tribal-star/resources" class="browse">Search Tribal Star Resources</a>
	<span class="browse">Browse Resource Categories</span>
	<div class="sidebar" role="complementary">
<?php $terms = get_terms( 'tribal-star-resources-categories' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
	$class = $currentterm->slug == $term->slug ? 'current_category' : '' ; // i dont know how but i got this to work
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>





<?php global $post; if (is_tax( 'tribal-star-event' ) || is_post_type_archive('tribalstarconf') || is_singular('tribalstarconf') || is_page(224)) { ?>
<!-- Tribal Star Events and Conferences -->
	<span class="browse">Browse By Month:</span>
	<div class="sidebar" role="complementary">
<?php

$terms = get_terms( 'tribal-star-event' );
$currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo '<ul>';
foreach ( $terms as $term ) {
	// The $term is an object, so we don't need to specify the $taxonomy.
  $class = $currentterm->slug == $term->slug ? 'current_category' : '' ; // i dont know how but i got this to work
  $term_link = get_term_link( $term );
   // If there was an error, continue to the next term.
   if ( is_wp_error( $term_link ) ) {
        continue;
    }
	// We successfully got a link. Print it out.
  echo '<li><a class="' . $class . '"  href="' . esc_url( $term_link ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
}

echo '</ul>'; ?>	

</div><!-- sidebar -->
<?php } ?>









<!-- program banners -->

<?php global $post;
					
/*
					if ( 
					
					// Pages
					is_page(10) || $post->post_parent==10 || is_page(796) || $post->post_parent==949
					
					// Resources
					|| is_post_type_archive('bhetaresources') || is_singular('bhetaresources') 
					
					// Events
					|| is_post_type_archive('bhetaevents') || is_singular('bhetaevents') || is_tax('bheta-resources-categories')) 
					
					{ 
						
						$imageID = get_field('bheta_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('bheta_sidebar_image','option'),'full');
						
												
						$imagetwoID = get_field('lms_sidebar_image','option');
						$alt_texttwo = get_post_meta($imagetwoID , '_wp_attachment_image_alt', true);
						$sidebartwo = wp_get_attachment_image_src(get_field('lms_sidebar_image','option'),'full');
						
						echo '<span class="browse">LMS Login</span><a title="LMS Login" target="_blank" href="http://rod.sumtotalsystems.com/academy/app/SYS_Login.aspx?DomainId=700D22DE18EA1836C728CC881F3D5545954EA89A739D81C68772EBE2ADD833E5A7D69A0D04A83982031457387C1BBAB4D98FB8421FE7A129&lang=en-US"><img class="sidebar_program_banner" alt="' . $alt_texttwo . '" src="' . $sidebartwo[0] . '"/></a>';
						
						
					}
*/
					
					
					
					
					
					if ( 
					
					// Pages
					is_page(10)) 
					
					{ 
						
						
						$imagethreeID = get_field('livewell_sidebar_image','option');
						$alt_textthree = get_post_meta($imagethreeID , '_wp_attachment_image_alt', true);
						$sidebarthree = wp_get_attachment_image_src(get_field('livewell_sidebar_image','option'),'full');
						
						echo '';
						
						
					}
					
					
					
					if 
					
					( is_page(18) || $post->post_parent==18
					// Alumni
					|| is_post_type_archive('liaalumni') || is_singular('liaalumni')
					
					) 
					
					{ 
						
						$imageID = get_field('lia_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('lia_sidebar_image','option'),'full');
						echo '<img class="sidebar_program_banner" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
					
					}
					if ( 
					
					is_page(12) || $post->post_parent==12 ||
					
					// Cirriculum
					is_post_type_archive('mastercurriculum') || is_singular('mastercurriculum') || is_tax('master-curriculum-categories') ||
					
					// Advanced Training
					is_post_type_archive('mastertraining') || is_singular('mastertraining') || is_tax('master-training-categories') 
					
					
					) 
					
					{ 
						
						$imageID = get_field('master_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('master_sidebar_image','option'),'full');
						echo '<img class="sidebar_program_banner" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
					
					}
					
					if ( 
					// Pages
					is_page(14) || $post->post_parent==14 || is_page(855) ||
					
					// Cirriculum
					is_post_type_archive('pcwtacurriculum') || is_singular('pcwtacurriculum') || is_tax('pcwta-curriculum-categories') ||
					
					// Bios
					is_post_type_archive('pcwtabios') || is_singular('pcwtabios') ||
					
					// Newsletter
					is_post_type_archive('pcwtanewsletters') || is_singular('pcwtanewsletters') ||
					
					// Lineworker
					is_post_type_archive('lineworkercore') || is_singular('lineworkercore') ||
					
					// Supervisor
					is_post_type_archive('supervisorcore') || is_singular('supervisorcore') ||
					
					// Manager
					is_post_type_archive('managercore') || is_singular('managercore')
					
					)
					
					{ 
						$imageID = get_field('pcwta_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('pcwta_sidebar_image','option'),'full');
						echo '<img class="sidebar_program_banner" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
					}
					
					
					
					if ( 
					
					// Pages
					is_page(14)) 
					
					{ 
						
						
						$imagethreeID = get_field('livewell_sidebar_image','option');
						$alt_textthree = get_post_meta($imagethreeID , '_wp_attachment_image_alt', true);
						$sidebarthree = wp_get_attachment_image_src(get_field('livewell_sidebar_image','option'),'full');
						
						echo '<span class="browse">Live Well San Diego</span><a title="Live Well San Diego" target="_blank" href="' . get_field('live_well_file','option') .'"><img class="sidebar_program_banner" alt="' . $alt_textthree . '" src="' . $sidebarthree[0] . '"/></a>';
						
						
					}
					
					
					
					if 
					
					( 
					
					
					// Pages
					
					is_page(16) || $post->post_parent==16 || is_page(189)
					
					// Events
					|| is_post_type_archive('sachsevents') || is_singular('sachsevents') || is_tax('sachs-events')
					
					// Research
					|| is_post_type_archive('sachsresearch') || is_singular('sachsresearch')
					
					// Lit Review
					|| is_post_type_archive('sachslitreview') || is_singular('sachslitreview')
					
					
					) 
					
					{ 
						$imageID = get_field('sachs_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('sachs_sidebar_image','option'),'full');
						echo '<img class="sidebar_program_banner" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
					}
					
					if ( is_page(21) || $post->post_parent==21 ) { 
						$imageID = get_field('serve_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('serve_sidebar_image','option'),'full');
						echo '<img class="sidebar_program_banner" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
					}
					if 
					
					( 
					
					is_page(23) || $post->post_parent==23 || is_page(1084) ||
					
					// Training Dates
					is_post_type_archive('tribalstarevents') || is_singular('tribalstarevents') || is_tax('tribal-star-training-dates') ||
					
					// Events
					is_post_type_archive('tribalstarconf') || is_singular('tribalstarconf') || is_tax('tribal-star-event') || 
					
					// Resources
					is_post_type_archive('tribalstarresources') || is_singular('tribalstarresources') || is_tax('tribal-star-resources-categories')
					
					) 
					
					{ 
						$imageID = get_field('tribal_star_sidebar_image','option');
						$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
						$sidebar = wp_get_attachment_image_src(get_field('tribal_star_sidebar_image','option'),'full');
						echo '<img class="sidebar_program_banner" alt="' . $alt_text . '" src="' . $sidebar[0] . '"/>';
					}
					echo	'<a href="' . get_bloginfo('url') . '/20th-anniversary"><img style="max-width:264px"  alt="Academy For Professional Excellence Health and Human Services" class="main_page_logos afpe" src="' . get_bloginfo( 'template_directory' ) . '/images/newlogo.jpg"/></a>';
					 ?>
 
 
 
 
 

