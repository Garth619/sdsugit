<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'> 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=21" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/*
	 * We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
		
		
	  		
	  
<!--[if lt IE 9]>
    <script src="<?php bloginfo( 'template_directory' ); ?>/html5shiv-master/dist/html5shiv.min.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64091433-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<a title="Skip to Mobile Content" href="#skip_mobile_nav" style="position:absolute;left:-9999px">Skip to Content</a>
<div id="wrapper" class="hfeed">
	<a title="top anchor" name="top"></a>
	
		<header role="banner">
			<div class="top">
				<div class="top_wrap">
					<a class="back_to_main" href="<?php bloginfo( 'url' ); ?>"><img alt="Gold Tri" class="gold_tri" src="<?php bloginfo( 'template_directory' ); ?>/images/gold_tri.png"/> Back to Main Site</a>
					<div class="top_right">
						<a class="welcome_settings" href="<?php bloginfo( 'url' ); ?>/wp-admin/profile.php"><?php mt_profile_img() ?>Welcome <?php global $current_user; get_currentuserinfo(); echo $current_user->user_firstname;?> <img alt="Gold Tri" class="settings" src="<?php bloginfo( 'template_directory' ); ?>/images/settings.png"/></a><a class="logout" href="<?php echo wp_logout_url( home_url() ); ?>">| Log Out</a> 
						<div class="search" role="search">
							<img alt="Search Our Database Below" class="search_click" src="<?php bloginfo( 'template_directory' ); ?>/images/search.png"/>
							<div class="search_dropdown">
								<?php get_search_form(); ?>
							</div><!-- search_dropdown -->
						</div><!-- search -->
					</div><!-- top_right -->
				</div><!-- top_wrap -->
			</div><!-- top -->
			<div class="banner">
				<div class="header_wrap">
					<div id="logo">

						<a title="Professional Excellence - San Diego State University School of Social Work - Staff Intranet" class="logo_academy" href="<?php bloginfo( 'url' ); ?>/staff-intranet/all-staff"><span class="academy_word">Academy</span> <span class="for_word">for</span> <span class="line_break">Professional Excellence</span></a>
						<a title="Professional Excellence - San Diego State University School of Social Work" href="<?php bloginfo( 'url' ); ?>/staff-intranet/all-staff" class="logo_sdsu">San Diego State University <span class="line_break">School of Social Work - Staff&nbsp;Intranet</span></a>
					</div><!-- logo -->
				</div><!-- header_wrap -->
			</div><!-- banner -->
			<div class="menu_wrapper intranet_menu_wrapper">
				<div class="inner_menu">
										   
   <nav id="desktop_menu">
		
		<div class="menu-header intranet_header">
			<ul>
				<li><a class="intranet_menu_item_1" href="<?php bloginfo( 'url' ); ?>/staff-intranet/all-staff">Academy Connects</a></li>
				<li><a class="intranet_menu_item_2" href="<?php bloginfo( 'url' ); ?>/staff-intranet/resources">Resources</a></li>
			</ul>
		</div><!-- menu-header -->
	</nav><!-- desktop menu -->


					
				
					
				
				</div><!-- inner menu -->
			</div><!-- menu wrapper -->
		</header>
		<main role="main" style="margin-bottom:75px;">
		<div id="skip_mobile_nav"></div><!-- skip_mobile_nav -->
