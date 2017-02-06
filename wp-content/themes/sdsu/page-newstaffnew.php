<?php
/**
 * Template Name: New Staff New
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

		<div class="intranet_wrapper">
			
			
			
			<div class="photo_box_wrapper">
				
				<h1 class="intranet_header">Welcome <?php global $current_user; get_currentuserinfo(); echo $current_user->user_firstname;?>!</h1>
			
			
				<div class="photo_box">
				
					<img src="<?php the_field('team_image');?>"/>
				
				</div><!-- photo_box -->
			
			
				<div class="photo_box">
				
					<a href="<?php the_field('video_link');?>" target="_blank">
						<img src="<?php the_field('video_image');?>"/>
					</a>
				
				</div><!-- photo_box -->
			
			
			</div><!-- photo_box_wrapper -->
			
			<div class="col_wrapper">
				
				
				
				
				
				<?php if(get_field('resource_sections')): ?>
 

 
					<?php while(has_sub_field('resource_sections')): ?>
 
					
					<div class="icon_module">
						
					<h1 class="intranet_header"><?php the_sub_field('section_title');?></h1>
    	
    	
						<?php if(get_sub_field('icons')): ?>
 

 
							<?php while(has_sub_field('icons')): ?>
						
						
							<div class="icon_wrapper">
							
								<div class="icon">
							
									<a style="background:<?php the_sub_field('color');?>" href="<?php the_sub_field('icon_link');?>" target="_blank">
										
										
										<?php if( get_sub_field('icon_choices') == 'my_image' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/1.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image2' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/2.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image3' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/3.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image4' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/4.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image5' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/5.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image6' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/6.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image7' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/7.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image8' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/8.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image9' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/9.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image10' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/10.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image11' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/11.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image12' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/12.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image13' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/13.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image14' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/14.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image15' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/15.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image16' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/16.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image17' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/17.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image18' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/18.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image19' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/19.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image20' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/20.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image21' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/21.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image22' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/22.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image23' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/23.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image24' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/24.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image25' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/25.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image26' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/26.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image27' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/27.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image28' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/28.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image29' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/29.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image30' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/30.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image31' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/31.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image32' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/32.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image33' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/33.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image34' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/34.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image35' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/35.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image36' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/36.png"/>
										
										<?php endif;?>

										<?php if( get_sub_field('icon_choices') == 'my_image37' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/37.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image38' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/38.png"/>
										
										<?php endif;?>

										<?php if( get_sub_field('icon_choices') == 'my_image39' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/39.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image40' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/40.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image41' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/41.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image42' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/42.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image43' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/43.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image44' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/44.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image45' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/45.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image46' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/46.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image47' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/47.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image48' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/48.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image49' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/49.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image50' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/50.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image51' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/51.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image52' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/52.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image53' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/53.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image54' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/54.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image55' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/55.png"/>
										
										<?php endif;?>
										
									</a>
								
								</div><!-- icon -->
							
								<div class="icon_title">
								
									<a href="<?php the_sub_field('icon_link');?>" target="_blank"><?php the_sub_field('icon_title');?></a>
							
								</div><!-- icon_title -->
							
							</div><!-- icon_wrapper --> 
    	
 
							<?php endwhile; ?>
 

 
				<?php endif; ?>
    	
    	
    	
					</div><!-- icon_module -->
 
					<?php endwhile; ?>
 

 
				<?php endif; ?>
				

				
				
			</div><!-- col_wrapper -->
			
			
			<div class="col_wrapper">
				
				
				<?php if(get_field('resource_sections_two')): ?>
 

 
					<?php while(has_sub_field('resource_sections_two')): ?>
 
					
					<div class="icon_module">
						
					<h1 class="intranet_header"><?php the_sub_field('section_title');?></h1>
    	
    	
						<?php if(get_sub_field('icons')): ?>
 

 
							<?php while(has_sub_field('icons')): ?>
						
						
							<div class="icon_wrapper">
							
								<div class="icon">
							
									<a style="background:<?php the_sub_field('color');?>" href="<?php the_sub_field('icon_link');?>" target="_blank">
										
										
										<?php if( get_sub_field('icon_choices') == 'my_image' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/1.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image2' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/2.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image3' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/3.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image4' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/4.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image5' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/5.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image6' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/6.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image7' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/7.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image8' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/8.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image9' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/9.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image10' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/10.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image11' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/11.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image12' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/12.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image13' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/13.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image14' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/14.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image15' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/15.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image16' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/16.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image17' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/17.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image18' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/18.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image19' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/19.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image20' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/20.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image21' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/21.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image22' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/22.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image23' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/23.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image24' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/24.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image25' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/25.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image26' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/26.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image27' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/27.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image28' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/28.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image29' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/29.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image30' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/30.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image31' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/31.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image32' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/32.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image33' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/33.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image34' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/34.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image35' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/35.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image36' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/36.png"/>
										
										<?php endif;?>

										<?php if( get_sub_field('icon_choices') == 'my_image37' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/37.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image38' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/38.png"/>
										
										<?php endif;?>

										<?php if( get_sub_field('icon_choices') == 'my_image39' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/39.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image40' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/40.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image41' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/41.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image42' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/42.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image43' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/43.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image44' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/44.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image45' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/45.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image46' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/46.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image47' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/47.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image48' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/48.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image49' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/49.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image50' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/50.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image51' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/51.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image52' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/52.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image53' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/53.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image54' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/54.png"/>
										
										<?php endif;?>
										
										<?php if( get_sub_field('icon_choices') == 'my_image55' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/55.png"/>
										
										<?php endif;?>
										
									</a>
								
								</div><!-- icon -->
							
								<div class="icon_title">
								
									<a href="<?php the_sub_field('icon_link');?>" target="_blank"><?php the_sub_field('icon_title');?></a>
							
								</div><!-- icon_title -->
							
							</div><!-- icon_wrapper --> 
    	
 
							<?php endwhile; ?>
 

 
				<?php endif; ?>
    	
    	
    	
					</div><!-- icon_module -->
 
					<?php endwhile; ?>
 

 
				<?php endif; ?>				
				
				
				
				
				
				
				
				
			</div><!-- col_wrapper -->
		
		
		</div><!-- intranet_wrapper -->
		
</main>
			

						


<?php get_footer('intranet'); ?>
