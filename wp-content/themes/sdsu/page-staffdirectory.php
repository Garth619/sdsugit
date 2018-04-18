<?php
/**
 * Template Name: Staff Directory
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
		
		<div id="container-custom">
			<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<span class="breadcrumbs">','</span>');
} ?>
			<div class="sidebar_wrapper">
				<?php get_sidebar(); ?>
			</div><!-- sidebar wrapper -->
			<div class="content_wrapper">
				<div id="content">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
				<?php if( get_field('staff_directory_section') ): ?>
					
					<?php while(has_sub_field('staff_directory_section') ): ?>
						
						<div class="table_wrapper_mobile">
							
							<table class="table_mobile">
								
								<thead>
									
									<tr>
										
										<th colspan="3"><?php the_sub_field('table_title'); ?></th>
									
									</tr>
								
								</thead>
							
							<?php if(get_sub_field('staff_directory') ): ?>
								
								<tbody>
									
									<?php while(has_sub_field('staff_directory') ): ?>
									
									<tr>
										<td>
											
											<?php if(get_sub_field('will_this_person_have_a_bio') == "No"):?>
												
												<?php the_sub_field('name'); ?>
												
												<?php if( get_sub_field('leadership_team') == 'Yes' ): ?>
													<br/><span style="font-size:14px;font-style: italic;">Leadership Team</span>
												<?php endif; ?>
											
											<?php endif; ?>
											
											<?php if(get_sub_field('will_this_person_have_a_bio') == "Yes"):?>
												
												<?php if(get_sub_field('will_their_bio_be_on_this_site_or_an_outside_site') == "Internal Page"):?>
												
												<?php the_sub_field('name'); ?>
												<?php if( get_sub_field('leadership_team') == 'Yes' ): ?>
													<br/><span style="font-size:14px;font-style: italic;">Leadership Team</span>
												<?php endif; ?>
												<br/><a title="Read More About <?php the_sub_field('name'); ?>" style="font-size:13px;" href="<?php the_sub_field('bio'); ?>">View Bio</a>
											
											<?php endif; ?>
											
											<?php if(get_sub_field('will_their_bio_be_on_this_site_or_an_outside_site') == "Outside Link"):?>
												
												<?php the_sub_field('name'); ?>
												<?php if( get_sub_field('leadership_team') == 'Yes' ): ?>
													<br/><span style="font-size:14px;font-style: italic;">Leadership Team</span>
												<?php endif; ?>
												<br/><a target="_blank" title="Read More About <?php the_sub_field('name'); ?>" style="font-size:13px;" href="<?php the_sub_field('outside_link'); ?>">View Bio</a>
												
											<?php endif; ?>
										
										<?php endif; ?>
										
										<br/><?php the_sub_field('title'); ?><br/>
										
										<a title="<?php the_sub_field('email'); ?>" href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a><br/><?php the_sub_field('phone'); ?></td>
									</tr>
								
								<?php endwhile; ?>
								</tbody>
							
							<?php endif; ?>
							</table>
						</div><!-- table wrapper desktop -->
					<?php endwhile; ?>
				<?php endif;?>
				
				
				
				
				
				<?php if( get_field('staff_directory_section') ): ?>
					
					<?php while(has_sub_field('staff_directory_section') ): ?>
						
						<div class="table_wrapper_desktop">
							<table class="table_desktop persist-area">
								<thead>
									<tr class="persist-header">
										<th colspan="3"><?php the_sub_field('table_title'); ?></th>
									</tr>
								</thead>
							
							<?php if(get_sub_field('staff_directory') ): ?>
								
								<tbody>
									<tr>
										<td>Name and Biography</td>
										<td>Title</td>
										<td>E-mail/Phone</td>
									</tr>
								
								<?php while(has_sub_field('staff_directory') ): ?>
									
									<tr>
										<td>
										
										<?php if(get_sub_field('will_this_person_have_a_bio') == "No"):?>
											
											<?php the_sub_field('name'); ?><br/>
											
											<?php if( get_sub_field('leadership_team') == 'Yes' ): ?>
													<span style="font-size:14px;font-style: italic;">Leadership Team</span>
												<?php endif; ?>
										
										<?php endif; ?>	
										
										<?php if(get_sub_field('will_this_person_have_a_bio') == "Yes"):?>
											
											<?php if(get_sub_field('will_their_bio_be_on_this_site_or_an_outside_site') == "Internal Page"):?>
												
												<?php the_sub_field('name'); ?>
												<?php if( get_sub_field('leadership_team') == 'Yes' ): ?>
													<br/><span style="font-size:14px;font-style: italic;">Leadership Team</span>
												<?php endif; ?>
												
												<br/><a title="Read More About <?php the_sub_field('name'); ?>" style="font-size:13px;" href="<?php the_sub_field('bio'); ?>">View Bio</a>
											
											<?php endif; ?>
											
											<?php if(get_sub_field('will_their_bio_be_on_this_site_or_an_outside_site') == "Outside Link"):?>
												
												<?php the_sub_field('name'); ?>
												<?php if( get_sub_field('leadership_team') == 'Yes' ): ?>
													<br/><span style="font-size:14px;font-style: italic;">Leadership Team</span>
												<?php endif; ?>
												<br/><a target="_blank" title="Read More About <?php the_sub_field('name'); ?>" style="font-size:13px;" href="<?php the_sub_field('outside_link'); ?>">View Bio</a>
											
											<?php endif; ?>
								
								<?php endif; ?>
										
										</td>
										<td><?php the_sub_field('title'); ?></td>
										<td><a title="<?php the_sub_field('email'); ?>" href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a><br/><?php the_sub_field('phone'); ?></td>
									</tr>
								
								<?php endwhile; ?>
								
								</tbody>
							
							<?php endif; ?>
							
							</table>
						</div><!-- table wrapper desktop -->
					
					<?php endwhile; ?>
				
				<?php endif;?>
			
				</div><!-- content -->
				<a href="#top" class="back_to_top" title="Back to Top">Back To Top</a>
				<?php include("my-access-notes-loop.php"); ?>
			</div><!-- content wrapper -->
		</div><!-- #container -->

<script>
    function UpdateTableHeaders() {
       jQuery(".persist-area").each(function() {
       
           var el             = jQuery(this),
               offset         = el.offset(),
               scrollTop      = jQuery(window).scrollTop(),
               floatingHeader = jQuery(".floatingHeader", this)
           
           if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
               floatingHeader.css({
                "visibility": "visible"
               });
           } else {
               floatingHeader.css({
                "visibility": "hidden"
               });      
           };
       });
    }
    
    // DOM Ready      
    jQuery(function() {
    
       var clonedHeaderRow;
    
       jQuery(".persist-area").each(function() {
           clonedHeaderRow = jQuery(".persist-header", this);
           clonedHeaderRow
             .before(clonedHeaderRow.clone())
             .css("width", clonedHeaderRow.width())
             .addClass("floatingHeader");
             
       });
       
       jQuery(window)
        .scroll(UpdateTableHeaders)
        .trigger("scroll");
       
    });
  </script>
<?php get_footer(); ?>
