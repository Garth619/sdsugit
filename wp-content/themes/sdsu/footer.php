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

		</main>

		<footer>
			<div class="footer_banner" role="contentinfo">
				<div class="inner_footer_banner">
					<span>Inspiring Innovative Solutions in <span class="line_break">Health and Human Services</span></span>
				</div><!-- inner_footer_banner -->
			</div><!-- footer banner -->
			<div class="bottom_footer">
					<div class="footer_wrap">
					
							<div class="block_a blocks">
								<div itemscope itemtype="http://schema.org/Organization">
									<span itemprop="name" class="footer_title">Academy <em>for</em> <span class="line_break">Professional Excellence</span></span>
								</div><!-- schema -->
							</div><!-- block_a -->
							<div class="block_b blocks">
								<span class="programs">Programs</span>
							</div><!-- block_b -->
							<div class="block_c blocks">
								<div class="block_c_col first">
									<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
									<p><span itemprop="streetAddress"><?php the_field('street_address','option'); ?></span><br/><span itemprop="addressLocality"><?php the_field('city','option'); ?>, <?php the_field('state','option'); ?></span> <span itemprop="postalCode"><?php the_field('zip_code','option'); ?></span></p>
									
									
									</div><!-- schema -->
<!-- 									<p><a href="mailto:academy@mail.sdsu.edu" title="academy@mail.sdsu.edu" class="footer_mail">academy@mail.sdsu.edu</a></p> -->
									<!-- <p>Social Links??</p> -->
								</div><!-- block_c_col -->
								<div class="block_c_col middle">
									<nav role="navigation">
										<?php wp_nav_menu( array( 'container_class' => 'menu-footer1', 'theme_location' => 'footer_menu1' ) ); ?>
									</nav>
								</div><!-- block_c_col middle -->
							</div><!-- block c -->
							<div class="block_d blocks">
								<div class="block_d_col first">
								<nav>
									<?php wp_nav_menu( array( 'container_class' => 'menu-footer2', 'theme_location' => 'footer_menu2' ) ); ?>
								</nav>
							</div><!-- block_d_col first -->
							<div class="block_d_col middle">
								<nav>
									<?php wp_nav_menu( array( 'container_class' => 'menu-footer2', 'theme_location' => 'footer_menu2b' ) ); ?>
								</nav>
							</div><!-- block_d_col middle -->
						</div><!-- block_d -->
						
						<span class="copyright">&copy; <?php echo date("Y"); ?> San Diego State University School of Social Work, Academy for Professional Excellence</span>
					</div><!-- footer_wrap -->
				</div><!-- bottom_footer -->
		</footer>
	
</div><!-- #wrapper -->
<!-- fixed right hand back to top -->

<a href="#top" class="back_to_top_righthand_side" title="Return to Top">Back To Top</a>

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
