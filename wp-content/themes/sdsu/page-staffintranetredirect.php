<?php $user = wp_get_current_user();
			$allowed_roles = array('staffintranet','administrator'); ?>
<?php if( array_intersect($allowed_roles, $user->roles ) ) {  ?> 
   
  <?php header('Location:' . get_bloginfo( 'url' ) . '/staff-intranet/all-staff'); ?> 

<?php } ?>


<?php
/**
 * Template Name: Staff Intranet Redirect
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

?>
 

	<?php
/**
 * Template Name: Staff Intranet Inner Page Template
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

		<div class="intranet_wrapper" style="margin-top:20px;height:300px;">
			<h1 class="intranet_header"><?php the_title();?></h1>
				
				You must <a href="<?php bloginfo('url');?>/academy-login">login</a> to view the Staff Intranet

		</div><!-- intranet_wrapper -->


<?php get_footer(); ?>
	
	
	
	
	
	
	
	
	
