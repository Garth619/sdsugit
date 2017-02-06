<?php
/**
 * Template Name: All Staff New
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
			<div class="intranet_wrapper_inner">
				<div class="intranet_inner_section">
					<div class="intranet_single_section left_section">
						<h1 class="intranet_header">Welcome <?php global $current_user; get_currentuserinfo(); echo $current_user->user_firstname;?>!</h1>
						<a href="<?php bloginfo( 'url' ); ?>/20th-anniversary"><img class="academy_logo svg" alt="Academy For Professional Excellence" style="max-width:264px" src="<?php bloginfo( 'template_directory' ); ?>/images/newlogo.jpg"/></a>
						
						
						<div class="icons_box">
						
							<div class="icon_wrapper">
							
								<div class="icon">
							
									<a style="background:<?php the_field('color');?>" href="<?php the_field('icon_link');?>" target="_blank">
										
										
										<?php if( get_field('icon_choices') == 'my_image' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/1.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image2' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/2.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image3' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/3.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image4' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/4.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image5' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/5.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image6' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/6.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image7' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/7.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image8' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/8.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image9' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/9.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image10' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/10.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image11' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/11.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image12' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/12.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image13' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/13.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image14' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/14.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image15' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/15.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image16' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/16.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image17' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/17.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image18' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/18.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image19' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/19.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image20' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/20.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image21' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/21.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image22' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/22.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image23' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/23.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image24' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/24.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image25' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/25.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image26' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/26.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image27' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/27.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image28' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/28.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image29' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/29.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image30' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/30.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image31' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/31.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image32' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/32.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image33' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/33.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image34' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/34.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image35' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/35.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image36' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/36.png"/>
										
										<?php endif;?>

										<?php if( get_field('icon_choices') == 'my_image37' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/37.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image38' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/38.png"/>
										
										<?php endif;?>

										<?php if( get_field('icon_choices') == 'my_image39' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/39.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image40' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/40.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image41' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/41.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image42' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/42.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image43' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/43.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image44' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/44.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image45' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/45.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image46' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/46.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image47' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/47.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image48' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/48.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image49' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/49.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image50' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/50.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image51' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/51.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image52' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/52.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image53' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/53.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image54' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/54.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices') == 'my_image55' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/55.png"/>
										
										<?php endif;?>
										
									</a>
								
								</div><!-- icon -->
							
								<div class="icon_title">
								
									<a href="<?php the_field('icon_link');?>" target="_blank"><?php the_field('icon_title');?></a>
							
								</div><!-- icon_title -->
							
							</div><!-- icon_wrapper -->
							
							
							<div class="icon_wrapper">
							
								<div class="icon">
							
									<a style="background:<?php the_field('color_two');?>" href="<?php the_field('icon_link_two');?>" target="_blank">
										
										
										<?php if( get_field('icon_choices_two') == 'my_image' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/1.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image2' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/2.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image3' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/3.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image4' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/4.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image5' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/5.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image6' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/6.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image7' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/7.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image8' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/8.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image9' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/9.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image10' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/10.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image11' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/11.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image12' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/12.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image13' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/13.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image14' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/14.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image15' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/15.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image16' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/16.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image17' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/17.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image18' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/18.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image19' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/19.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image20' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/20.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image21' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/21.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image22' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/22.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image23' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/23.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image24' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/24.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image25' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/25.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image26' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/26.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image27' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/27.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image28' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/28.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image29' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/29.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image30' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/30.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image31' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/31.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image32' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/32.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image33' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/33.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image34' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/34.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image35' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/35.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image36' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/36.png"/>
										
										<?php endif;?>

										<?php if( get_field('icon_choices_two') == 'my_image37' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/37.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image38' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/38.png"/>
										
										<?php endif;?>

										<?php if( get_field('icon_choices_two') == 'my_image39' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/39.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image40' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/40.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image41' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/41.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image42' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/42.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image43' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/43.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image44' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/44.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image45' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/45.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image46' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/46.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image47' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/47.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image48' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/48.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image49' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/49.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image50' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/50.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image51' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/51.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image52' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/52.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image53' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/53.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image54' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/54.png"/>
										
										<?php endif;?>
										
										<?php if( get_field('icon_choices_two') == 'my_image55' ): ?>
										
											<img class="intranet_icon" src="<?php bloginfo('template_directory');?>/images/icons/white/55.png"/>
										
										<?php endif;?>
										
									</a>
								
								</div><!-- icon -->
							
								<div class="icon_title">
								
									<a href="<?php the_field('icon_link_two');?>" target="_blank"><?php the_field('icon_title_two');?></a>
							
								</div><!-- icon_title -->
							
							</div><!-- icon_wrapper -->
							
							
							
							
							
							
							
							
							
							
							
							
							
						
						
						</div><!-- icons_box -->
						
						
						
						<div class="director_image_wrapper">
							<img class="director_image" src="<?php the_field('director_image', 3927); ?>"/>
						</div><!-- director_image_wrapper -->
						<div class="director_content">
							<h2 class="intranet_sub_header"><?php the_field('director_message_title', 3927); ?></h2>
								<?php the_field('director_excerpt', 3927); ?>
								<a class="intranet_read_more read_more_director" href="<?php bloginfo('url');?>/staff-intranet/directors-message/">Read More<img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a>
						</div><!-- director_content -->
						</div><!-- intranet_single_section -->
					
					
					<div class="intranet_single_section right_section">
						<h1 class="intranet_header header_toggle">Upcoming Events</h1>
						<div class="intranet_toggle">
							<div class="featured_event_wrapper">
							
							 <iframe id="myagenda_iframe" src="https://www.google.com/calendar/embed?mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=mail.sdsu.edu_2d34313638373536302d393636%40resource.calendar.google.com&amp;color=%23125A12&amp;ctz=America%2FLos_Angeles" style="border-width:0" frameborder="0" scrolling="no"></iframe>
							 
							 


							 
							
							
							</div><!-- featured event wrapper -->

						</div><!-- intranet_toggle -->
					</div><!-- intranet_single_section -->
				</div><!-- intranet_inner_section -->
			
			<div class="intranet_inner_section">
				<div class="intranet_single_section left_section">
					<h1 class="intranet_header header_toggle">Staff Forum</h1>
						<div class="intranet_toggle">
							<?php echo do_shortcode('[bbp-forum-index]'); ?>
						</div><!-- intranet_toggle -->
				</div><!-- intranet_single_section -->
			<div class="intranet_single_section right_section">
					<h1 class="intranet_header header_toggle my_youtube">Youtube Videos</h1>
						<div class="intranet_toggle">
							<a class="intranet_read_more see_all" style="margin-bottom:20px;border-top:none;padding-top:0px;" href="https://www.youtube.com/channel/UCn4_PgokJtA6HgrxJlHqtsA" target="_blank">Visit Our Youtube Channel <img class="intranet_tri" src="<?php bloginfo('template_directory');?>/images/intranet-tri.png"/></a>
							<?php echo do_shortcode('[youtube_channel]'); ?>
						</div><!-- intranet_toggle -->
					</div><!-- intranet_single_section -->
			</div><!-- intranet_inner_section -->
			
			
			
			
			
		</div><!-- intranet_wrapper_inner -->
	</div><!-- intranet_wrapper -->
		
</main>
			
<?php get_footer('intranet'); ?>
