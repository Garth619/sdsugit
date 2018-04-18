<?php
/**
 * Template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>



	<div id="container-custom" style="height:350px;">
		<div id="content" role="main">
			<div id="post-0" class="post error404 not-found">
				<?php $host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if($host == 'theacademy.sdsu.edu/academy-login'): ?>
    
     <h1 style="margin-top:30px;" class="entry-title">Website is Closed</h1>
				<div class="entry-content">
				<p>Apologies, but the website is temporarily closed for maintenance. Please try again soon.</p>
    </div><!-- .entry-content -->

<?php else: ?>
   
   		<h1 style="margin-top:30px;" class="entry-title">Login</h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Or it may be because you are not signed in.', 'twentyten' ); ?></p>
					<a href="<?php bloginfo('url');?>/wp-admin" class="lost_login">Log In Here >></a><br/>
					
					<br/>
					
					<hr/>
					
					<p>Or try searching again for what you are looking for below:</p>
					<?php get_search_form(); ?>
					
					
					</div><!-- .entry-content -->
   
   <?php endif;?>
					
	</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
