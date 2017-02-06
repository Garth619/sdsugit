<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

		
		<footer>
			<div class="bottom_footer">
					<div class="footer_wrap" style="padding:15px 0">
						<span class="copyright">&copy; <?php echo date("Y"); ?> San Diego State University School of Social Work, Academy for Professional&nbsp;Excellence</span>
					</div><!-- footer_wrap -->
				</div><!-- bottom_footer -->
		</footer>
	
</div><!-- #wrapper -->
<img class="preload_fix" width="0" height="0" alt="These Indicators Are For Visuals Only" src="<?php bloginfo( 'template_directory' ); ?>/images/gold-left.png"/>
<img class="preload_fix" width="0" height="0" alt="These Indicators Are For Visuals Only" src="<?php bloginfo( 'template_directory' ); ?>/images/gold-right.png"/>



<?php
	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<script src="<?php bloginfo( 'template_directory' ); ?>/respond-master/dest/respond.min.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/jQuery.mmenu-master/src/js/jquery.mmenu.min.all.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/enquire.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/min/jquery-functions-min.js" type="text/javascript"></script>
<?php $user = wp_get_current_user();
			$allowed_roles = array('staffintranet','staffintranetnoemail'); ?>
<?php if( array_intersect($allowed_roles, $user->roles ) ) {  ?> 
   
   <script type="text/javascript">
   
   jQuery(document).ready(function() {
   
   jQuery('body').addClass('staffintranet');
   
   });
   
   </script>

<?php } ?>
</body>
</html>
